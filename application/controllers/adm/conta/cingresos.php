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
			'@ccliente'     => $ccliente,
			'@fini'         => ($this->input->post('fdesde') == '%') ? NULL : substr($fini, 6, 4).'-'.substr($fini,3 , 2).'-'.substr($fini, 0, 2),
			'@ffin'         => ($this->input->post('fhasta') == '%') ? NULL : substr($ffin, 6, 4).'-'.substr($ffin,3 , 2).'-'.substr($ffin, 0, 2),
			'@ccia' 		=> $ccia,
			'@carea'		=> $carea,
			'@nrodoc'		=> '%'.$nrodoc.'%',
		);		
		$resultado = $this->mingresos->getbuscaringresos($parametros);
		echo json_encode($resultado);
	}

	public function setingreso() {	//
		$varnull = '';

		$accion 			= $this->input->post('mhdnAccionIngreso');
		
		$id_docingresos 	= $this->input->post('mhdnIddocingreso');
		$id_ingresos 			= $this->input->post('mhdnIdingreso');
		if($accion == 'P'){
			if($id_ingresos == ''){
				$vaccion = 'N';
			} else {
				$vaccion = 'A';
			}
			$id_anio 			= $this->input->post('mcboanio');
			$id_mes 			= $this->input->post('mcbomes');
			$ccompania 			= $this->input->post('mcbocia');
			$carea 			= $this->input->post('mcboarea');
			$id_codigo 		= $this->input->post('mcbocodigo');
			$fecha_pago 		= $this->input->post('mtxtFpago');
			$monto_pago 			= $this->input->post('mtxtmontopagar');
			$tipo_pago 		= $this->input->post('mcbotipopago');
			$observacion 		= $this->input->post('mtxtObserva');
        
			$parametros = array(
				'@id_docingresos'   	=>  $id_docingresos,
				'@id_ingresos'   		=>  $id_ingresos,
				'@id_anio'   			=>  $id_anio,
				'@tipo_doc'   			=>  $id_mes,
				'@serie_doc'      		=>  $ccompania,
				'@nro_doc'      		=>  $carea,
				'@monto_base'      		=>  $id_codigo,
				'@fecha_emision'		=>  substr($fecha_pago, 6, 4).'-'.substr($fecha_pago,3 , 2).'-'.substr($fecha_pago, 0, 2),
				'@monto_igv'      		=>  $monto_pago,
				'@monto_total'      	=>  $tipo_pago,
				'@tipo_moneda'      	=>  $observacion,
				'@accion'           	=>  $vaccion
			);
			$resultado = $this->mingresos->setingreso($parametros);
			echo json_encode($resultado);

		}else{
			$ccliente 			= $this->input->post('mcboempresa');
			$tipo_doc 			= $this->input->post('mcbotipodoc');
			$serie_doc 			= $this->input->post('mtxtcorredoc');
			$nro_doc 			= $this->input->post('mtxtnrodoc');
			$fecha_emision 		= $this->input->post('mtxtFemidoc');
			$monto_base 		= $this->input->post('mtxtmontobase');
			$monto_igv 			= $this->input->post('mtxtmontoigv');
			$monto_total 		= $this->input->post('mtxtmontototal');
			$tipo_moneda 		= $this->input->post('mcbotipomoneda');
        
			$parametros = array(
				'@id_docingresos'   	=>  $id_docingresos,
				'@ccliente'   			=>  $ccliente,
				'@tipo_doc'   			=>  $tipo_doc,
				'@serie_doc'      		=>  $serie_doc,
				'@nro_doc'      		=>  $nro_doc,
				'@fecha_emision'		=>  substr($fecha_emision, 6, 4).'-'.substr($fecha_emision,3 , 2).'-'.substr($fecha_emision, 0, 2),
				'@monto_base'      		=>  $monto_base,
				'@monto_igv'      		=>  $monto_igv,
				'@monto_total'      	=>  $monto_total,
				'@tipo_moneda'      	=>  $tipo_moneda,
				'@accion'           	=>  $accion
			);
			$resultado = $this->mingresos->setingreso($parametros);
			echo json_encode($resultado);
		}
	}

	public function import_nubefact() {

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
			$this->spreadsheet_excel_reader->setOutputEncoding('UTF-8');

			$this->spreadsheet_excel_reader->read($data['full_path']);
			$sheets = $this->spreadsheet_excel_reader->sheets[0];
			error_reporting(0);
			
			$data_excel = array();
			for ($i = 3; $i <= $sheets['numRows']; $i++) {
				if ($sheets['cells'][$i][1] == '') break;
                $fechaemi = $sheets['cells'][$i][1];
				$data_excel[$i - 1]['@fechaemi']        = substr($fechaemi, 6, 4).'-'.substr($fechaemi,3 , 2).'-'.substr($fechaemi, 0, 2);
				$data_excel[$i - 1]['@tipo']            = $sheets['cells'][$i][3];
				$data_excel[$i - 1]['@serie']           = $sheets['cells'][$i][4];
				$data_excel[$i - 1]['@numero']  	    = $sheets['cells'][$i][5];
				$data_excel[$i - 1]['@doc_entidad']     = $sheets['cells'][$i][7];
				$data_excel[$i - 1]['@ruc']   	        = $sheets['cells'][$i][8];
				$data_excel[$i - 1]['@empresa']   		= $sheets['cells'][$i][9];
				$data_excel[$i - 1]['@moneda']   		= $sheets['cells'][$i][10];
				$data_excel[$i - 1]['@gravada']   		= $sheets['cells'][$i][12];
				$data_excel[$i - 1]['@inafecta']   		= $sheets['cells'][$i][14];
				$data_excel[$i - 1]['@igv']   		    = $sheets['cells'][$i][16];
				$data_excel[$i - 1]['@total']   		= $sheets['cells'][$i][19];
				$data_excel[$i - 1]['@sdetraccion'] 	= $sheets['cells'][$i][24];
				$data_excel[$i - 1]['@anulado']   		= $sheets['cells'][$i][26];
				$data_excel[$i - 1]['@concepto']   		= $sheets['cells'][$i][27];

				$this->db->trans_begin();				
				$procedure = "call usp_adm_conta_migralist_nubefact(?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)";
				$query = $this->db-> query($procedure,$data_excel[$i - 1]);
				if ($this->db->trans_status() === FALSE){
					$this->db->trans_rollback();
				}else{
					$this->db->trans_commit();
				} 
			}
			
			$respuesta = 'Importo Correctamente!'; 
			echo json_encode($respuesta);
			//redirect('cinsptiendamicro/insptiendamicro');
		}
	}

}
?>

