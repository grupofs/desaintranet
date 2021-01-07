<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Cconsultauditor extends CI_Controller {
	function __construct() {
		parent:: __construct();	
		$this->load->model('at/auditoria/mconsultauditor');
		$this->load->model('mglobales');
		$this->load->library('encryption');
		$this->load->helper(array('form','url','download','html','file'));
		$this->load->library('form_validation');
    }
    
   /** AUDITORIA **/ 
    public function getcboclieserv() {	// Visualizar Clientes del servicio en CBO	
        
		$resultado = $this->mconsultauditor->getcboclieserv();
		echo json_encode($resultado);
	} 
    public function getcbosubserv() {	// Visualizar Sub Servicio de los Clientes en CBO	
        
        $parametros = array(
            '@ccliente'   => $this->input->post('ccliente')
        );
		$resultado = $this->mconsultauditor->getcbosubserv($parametros);
		echo json_encode($resultado);
	}
    public function getestableaudi() {	// Visualizar Establecimiento por Clientes en CBO	
        
        $parametros = array(
            '@ccliente'   => $this->input->post('ccliente')
        );
		$resultado = $this->mconsultauditor->getestableaudi($parametros);
		echo json_encode($resultado);
	}
    public function getbuscarauditoria() {	// Recupera Listado de Propuestas	
        
		$varnull 			= 	'';

		$ccliente   = $this->input->post('ccliente');
		$cestablecimiento  = $this->input->post('cestablecimiento');
		$fini       = $this->input->post('fini');
		$ffin       = $this->input->post('ffin');
		$idauditor    = $this->input->post('idauditor');
            
        $parametros = array(
			'@ccliente'     	=> $ccliente,
			'@cestablecimiento' => ($this->input->post('cestablecimiento') == '') ? '%' : $cestablecimiento,
			'@fini'         	=> ($this->input->post('fini') == '%') ? NULL : substr($fini, 6, 4).'-'.substr($fini,3 , 2).'-'.substr($fini, 0, 2),
			'@ffin'         	=> ($this->input->post('ffin') == '%') ? NULL : substr($ffin, 6, 4).'-'.substr($ffin,3 , 2).'-'.substr($ffin, 0, 2),
			'@idauditor'		=> ($this->input->post('idauditor') == '') ? '%' : $idauditor,
		);		
		$resultado = $this->mconsultauditor->getbuscarauditoria($parametros);
		echo json_encode($resultado);
	}
    public function getcboregAreazona() {	// Visualizar Criterio en CBO	
        
        $parametros = array(
            '@cestablecimiento'   => $this->input->post('cestablecimiento')
        );
		$resultado = $this->mconsultauditor->getcboregAreazona($parametros);
		echo json_encode($resultado);
	}
    public function getlistarchecklist() {	// Recupera Listado de Propuestas	
        
		$varnull 			= 	'';

		$idaudi   = $this->input->post('idaudi');
		$fechaaudi   = $this->input->post('fechaaudi');
		$cchecklist   = $this->input->post('cchecklist');
		$cestablearea   = $this->input->post('cestablearea');
            
        $parametros = array(
			'@idaudi'     	=> $idaudi,
			'@fechaaudi'   	=> $fechaaudi,
			'@cchecklist'  	=> $cchecklist,
			'@cestablearea' => $cestablearea
		);		
		$resultado = $this->mconsultauditor->getlistarchecklist($parametros);
		echo json_encode($resultado);
	}
    public function setregchecklist() {	// Recupera Listado de Propuestas	
        
		$varnull 			= 	'';

		$idaudi   = $this->input->post('mhdncauditoriainspeccion');
		$fechaaudi   = $this->input->post('mhdnfservicio');
		$cchecklist   = $this->input->post('mhdncchecklist');
		$crequisitochecklist   = $this->input->post('mhdncrequisitochecklist');
		$cdetvalrequisito   = $this->input->post('mhdncdetallevalor');
		$dhallazgo   = $this->input->post('mtxthallazgo');
		$cestablearea = $this->input->post('mhdncestablearea');
            
        $parametros = array(
			'@idaudi'     	=> $idaudi,
			'@fechaaudi'   	=> $fechaaudi,
			'@cchecklist'  	=> $cchecklist,
			'@crequisitochecklist' => $crequisitochecklist,
			'@cdetvalrequisito' => $cdetvalrequisito,
			'@dhallazgo'  	=> $dhallazgo,
			'@cestablearea'  	=> $cestablearea
		);		
		$resultado = $this->mconsultauditor->setregchecklist($parametros);
		echo json_encode($resultado);
	}
	public function subirArchivoeviden() {	// Subir Acrhivo 
		$idaudi   = $this->input->post('mhdncauditoriainspeccion');
		$fechaaudi   = $this->input->post('mhdnfservicio');
		$cchecklist   = $this->input->post('mhdncchecklist');
        $crequisitochecklist   = $this->input->post('mhdncrequisitochecklist');
        $ccliente   = $this->input->post('mhdnccliente');
        $Descripcion   = $this->input->post('mtxtDescripcion');   
        $cestablearea   = $this->input->post('mhdncestablearea'); 
        
        
        $NOMBARCH 	= 'FOTO-'.$cchecklist.'-'.$crequisitochecklist.'-'.$cestablearea.'-ATFS';
        
        $RUTAARCH   = 'FTPfileserver/Archivos/10103/'.$ccliente.'/'.$idaudi.'/'.$fechaaudi.'/Evidencias';

        !is_dir($RUTAARCH) && @mkdir($RUTAARCH, 0777, true);

		//RUTA DONDE SE GUARDAN LOS FICHEROS
		$config['upload_path'] 		= $RUTAARCH;
		$config['file_name']        = $NOMBARCH;
		$config['allowed_types'] 	= '*';
		$config['max_size'] 		= '5000';
		$config['max_width'] 		= '2000';
		$config['max_height'] 		= '2000';
		$config['overwrite'] 		= TRUE;
		
		$this->load->library('upload',$config);
		$this->upload->initialize($config);
		
		if (!($this->upload->do_upload('mtxtArchivoeviden'))) {
			//si al subirse hay algun error 
			$data['uploadError'] = $this->upload->display_errors();
			$error = '';
			return $error;					
		}else{
			$data = $this->upload->data();
			$parametros = array(
                '@cauditoriainspeccion'   	=>  $idaudi,
                '@fservicio'   	    =>  $fechaaudi,
                '@cestablearea'   	=>  $cestablearea,
                '@cchecklist'   	=>  $cchecklist,
                '@crequisitochecklist'   	=>  $crequisitochecklist,
                '@ddescripcionevidencia'   	=>  $Descripcion ,
                '@darchivoevidencia'        =>  $data['file_name'],
                '@drutaevidencia'           =>  $config['upload_path'],
                '@dnombarchivoevidencia'    =>  $this->input->post('mtxtNombarcheviden'),
            );
            $retorna = $this->mconsultauditor->subirArchivoeviden($parametros);
            echo json_encode($retorna);
		}	
	}
    public function setcalcularchecklist() {	// Recupera Listado de Propuestas	
        
        $varnull = 	'';
        
        $dataobject   = $this->input->post('dataobject');

		$idaudi         = $this->input->post('idaudi');
		$fechaaudi      = $this->input->post('fechaaudi');
        $cchecklist     = $this->input->post('cchecklist');        
            
        $parametros = array(
			'@idaudi'     	=> $idaudi,
			'@fechaaudi'   	=> $fechaaudi,
			'@cchecklist'  	=> $cchecklist
		);		
		$resultado = $this->mconsultauditor->setcalcularchecklist($parametros,$dataobject);
		echo json_encode($resultado);
	}
}
?>