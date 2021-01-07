<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Cingresos extends CI_Controller {
	function __construct() {
		parent:: __construct();	
		$this->load->model('adm/conta/mingresos');
		$this->load->model('mglobales');
		$this->load->library('encryption');
		$this->load->helper(array('form','url','download','html','file'));
		$this->load->library('form_validation');
    }
    
   /** INGRESOS **/ 
    public function getcboempresa() {	// Visualizar Clientes del servicio en CBO	
        
		$resultado = $this->mingresos->getcboempresa();
		echo json_encode($resultado);
	} 

    public function getbuscaringresos() {	// Recupera Listado de Propuestas	
        
		$varnull 			= 	'';

		$ccliente   = $this->input->post('ccliente');
		$fini       = $this->input->post('fdesde');
		$ffin       = $this->input->post('fhasta');
		$ccia    = $this->input->post('ccia');
		$carea    = $this->input->post('carea');
		$nrodoc    = $this->input->post('dnrodoc');
            
        $parametros = array(
			'@ccliente'     => ($this->input->post('ccliente') == '') ? '0' : $ccliente,
			'@fini'         => ($this->input->post('fdesde') == '%') ? NULL : substr($fini, 6, 4).'-'.substr($fini,3 , 2).'-'.substr($fini, 0, 2),
			'@ffin'         => ($this->input->post('fhasta') == '%') ? NULL : substr($ffin, 6, 4).'-'.substr($ffin,3 , 2).'-'.substr($ffin, 0, 2),
			'@ccia' 		=> $ccia,
			'@carea'		=> ($this->input->post('carea') == '') ? '0' : $carea,
			'@nrodoc'		=> ($this->input->post('dnrodoc') == '') ? '%' : '%'.$nrodoc.'%',
		);		
		$resultado = $this->mingresos->getbuscaringresos($parametros);
		echo json_encode($resultado);
	}

	public function getlistaringresos() {
		$docingresos   = $this->input->post('id_docingresos');
		$resultado = $this->mingresos->getlistaringresos($docingresos);
		echo json_encode($resultado);
	}

	public function setdocingreso() {	//
		$varnull = '';

		$accion 			= $this->input->post('mhdnAccionIngreso');		
		$id_docingresos 	= $this->input->post('mhdnIddocingreso');
		$carea 				= $this->input->post('cbomcarea');
        
		$parametros = array(
			'@id_docingresos'   =>  $id_docingresos,
			'@carea'   			=>  $carea,
			'@accion'           =>  $accion
		);
		$resultado = $this->mingresos->setdocingreso($parametros);
		echo json_encode($resultado);
		
	}

	public function import_nubefact() {
		
		$ccia    = $this->input->post('hdmccia');

		$RUTAARCH   = 'FTPfileserver/Archivos/Temp/';

		!is_dir($RUTAARCH) && @mkdir($RUTAARCH, 0777, true);

		$config['upload_path'] 		= $RUTAARCH;
		$config['allowed_types'] 	= 'xls';
		$config['max_size'] 		= '60048';
		$config['overwrite'] 		= TRUE;
		
		$this->load->library('upload',$config);
		$this->upload->initialize($config);
		
		if (!($this->upload->do_upload('fileMigra'))) {
			//si al subirse hay algun error 
			$data['uploadError'] = $this->upload->display_errors();
			$error = '';
			return $error;
			 
		} else {
			$data = $this->upload->data();
			@chmod($data['full_path'], 0777);

			$this->load->library('Spreadsheet_Excel_Reader');
			$this->spreadsheet_excel_reader->setOutputEncoding('utf-8');

			$this->spreadsheet_excel_reader->read($data['full_path']);
			$sheets = $this->spreadsheet_excel_reader->sheets[0];
			error_reporting(0);
			
			$data_excel = array();
			for ($i = 2; $i <= $sheets['numRows']; $i++) {
				if ($sheets['cells'][$i][1] == '') break;

                $fechaemi = $sheets['cells'][$i][1];
				$data_excel[$i - 1]['@fechaemi']        = substr($fechaemi, 6, 4).'-'.substr($fechaemi,3 , 2).'-'.substr($fechaemi, 0, 2);
				$data_excel[$i - 1]['@tipodoc']         = $sheets['cells'][$i][3];
				$data_excel[$i - 1]['@seriedoc']        = $sheets['cells'][$i][4];
				$data_excel[$i - 1]['@numerodoc']  	    = $sheets['cells'][$i][5];
				$data_excel[$i - 1]['@doc_entidad']     = $sheets['cells'][$i][7];
				$data_excel[$i - 1]['@ruc']   	        = $sheets['cells'][$i][8];
				$data_excel[$i - 1]['@empresa']   		= utf8_encode($sheets['cells'][$i][9]);
				$data_excel[$i - 1]['@moneda']   		= $sheets['cells'][$i][10];
				$data_excel[$i - 1]['@gravada']   		= $sheets['cells'][$i][12];
				$data_excel[$i - 1]['@inafecta']   		= $sheets['cells'][$i][14];
				$data_excel[$i - 1]['@igv']   		    = $sheets['cells'][$i][16];
				$data_excel[$i - 1]['@total']   		= $sheets['cells'][$i][19];
				$data_excel[$i - 1]['@sdetraccion'] 	= $sheets['cells'][$i][24];
				$data_excel[$i - 1]['@anulado']   		= $sheets['cells'][$i][26];
				$data_excel[$i - 1]['@concepto']   		= utf8_encode($sheets['cells'][$i][27]);
				$data_excel[$i - 1]['@observacion']   	= utf8_encode($sheets['cells'][$i][28]);
				$data_excel[$i - 1]['@tipodocmodif']   	= $sheets['cells'][$i][29];
				$data_excel[$i - 1]['@seriedocmodif']   = $sheets['cells'][$i][30];
				$data_excel[$i - 1]['@numerodocmodif']  = $sheets['cells'][$i][31];
				$data_excel[$i - 1]['@ccia']  = $ccia;

				$this->db->trans_begin();				
				$procedure = "call usp_adm_conta_migralist_nubefact(?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)";
				$query = $this->db-> query($procedure,$data_excel[$i - 1]);
				if ($this->db->trans_status() === FALSE){
					$this->db->trans_rollback();
				}else{
					$this->db->trans_commit();
				} 
			}
			
			$respuesta = 'Importo Correctamente!'; 
			echo json_encode($respuesta);
		}
	}

    public function getcodigocontain() {	// Visualizar Clientes del servicio en CBO	
        
		$resultado = $this->mingresos->getcodigocontain();
		echo json_encode($resultado);
	} 

    public function getctabancos() {	// Visualizar Clientes del servicio en CBO	
        
		$resultado = $this->mingresos->getctabancos();
		echo json_encode($resultado);
	} 
	
	public function setpago() {	//
		$varnull = '';

		$accion 			= $this->input->post('mhdnpAccionIngreso');
		
		$id_docingresos 	= $this->input->post('mhdnpIddocingreso');
		$id_ingresos 		= $this->input->post('mhdnpIdingreso');
		
			$id_anio 		= $this->input->post('mcboanio');
			$id_mes 		= $this->input->post('mcbomes');
			$ccompania 		= $this->input->post('mcbocia');
			$carea 			= $this->input->post('mcboarea');
			$id_codigo 		= $this->input->post('mcbocodigo');
			$fecha_pago 	= $this->input->post('mtxtFpago');
			$monto_pago 	= $this->input->post('mtxtmontopagar');
			$tipo_pago 		= $this->input->post('mcbotipopago');
			$observacion 	= $this->input->post('mtxtObserva');
			$id_ctabanco 	= $this->input->post('mcbobanco');
			$carea 			= $this->input->post('mcboparea');
			$monto_saldo 	= $this->input->post('mtxtsaldopagar');
        
			$parametros = array(
				'@id_docingresos'   =>  $id_docingresos,
				'@id_ingresos'   	=>  $id_ingresos,
				'@id_anio'   		=>  $id_anio,
				'@id_mes'   		=>  $id_mes,
				'@id_codigo'  		=>  $id_codigo,
				'@fecha_pago'		=>  substr($fecha_pago, 6, 4).'-'.substr($fecha_pago,3 , 2).'-'.substr($fecha_pago, 0, 2),
				'@monto_pago'      	=>  str_replace(',', '', $monto_pago), //$monto_pago,
				'@tipo_pago'      	=>  $tipo_pago,
				'@observacion'      =>  $observacion,
				'@id_ctabanco'      =>  $id_ctabanco,
				'@carea'      		=>  $carea,
				'@monto_saldo'      =>  str_replace(',', '', $monto_saldo), //$monto_saldo,
				'@accion'           =>  $accion
			);
			$resultado = $this->mingresos->setpago($parametros);
			echo json_encode($resultado);

	}

}
?>

