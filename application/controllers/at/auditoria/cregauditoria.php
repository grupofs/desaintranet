<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Cregauditoria extends CI_Controller {
	function __construct() {
		parent:: __construct();	
		$this->load->model('at/auditoria/mregauditoria');
		$this->load->model('mglobales');
		$this->load->library('encryption');
		$this->load->helper(array('form','url','download','html','file'));
		$this->load->library('form_validation');
    }
    
   /** AUDITORIA **/ 
    public function getcboclieserv() {	// Visualizar Clientes del servicio en CBO	
        
		$resultado = $this->mregauditoria->getcboclieserv();
		echo json_encode($resultado);
	} 
    public function getcbosubserv() {	// Visualizar Sub Servicio de los Clientes en CBO	
        
        $parametros = array(
            '@ccliente'   => $this->input->post('ccliente')
        );
		$resultado = $this->mregauditoria->getcbosubserv($parametros);
		echo json_encode($resultado);
	}
    public function getestableaudi() {	// Visualizar Establecimiento por Clientes en CBO	
        
        $parametros = array(
            '@ccliente'   => $this->input->post('ccliente')
        );
		$resultado = $this->mregauditoria->getestableaudi($parametros);
		echo json_encode($resultado);
	}
    public function getcboauditor() {	// Visualizar Auditores en CBO	
        
		$resultado = $this->mregauditoria->getcboauditor();
		echo json_encode($resultado);
	}
    public function getsistemaaudi() {	// Visualizar Sistema en CBO	
        
		$resultado = $this->mregauditoria->getsistemaaudi();
		echo json_encode($resultado);
	}
    public function getcborubro() {	// Visualizar Rubro en CBO	
        
        $parametros = array(
            '@idnorma'   => $this->input->post('idnorma')
        );
		$resultado = $this->mregauditoria->getcborubro($parametros);
		echo json_encode($resultado);
	}
    public function getcbochecklist() {	// Visualizar Checklist en CBO	
        
        $parametros = array(
            '@idnorma'   => $this->input->post('idnorma'),
            '@idsubnorma'   => $this->input->post('idsubnorma'),
            '@ccliente'   => $this->input->post('ccliente')
        );
		$resultado = $this->mregauditoria->getcbochecklist($parametros);
		echo json_encode($resultado);
	}
    public function getcboformula() {	// Visualizar Formula en CBO	
        
        $parametros = array(
            '@idchceklist'   => $this->input->post('idchceklist')
        );
		$resultado = $this->mregauditoria->getcboformula($parametros);
		echo json_encode($resultado);
	}
    public function getcbocriterio() {	// Visualizar Criterio en CBO	
        
        $parametros = array(
            '@idchceklist'   => $this->input->post('idchceklist')
        );
		$resultado = $this->mregauditoria->getcbocriterio($parametros);
		echo json_encode($resultado);
	}
    public function setauditoria() { // Registrar informe PT
		$varnull = '';
		
		$id_audi 			= $this->input->post('mhdnIdaudi');
		$ccliente 			= $this->input->post('cboregClie');
		$cestablecimiento 	= $this->input->post('cboregEstable');
		$faudi 				= $this->input->post('txtFAudi');
		$idauditor 			= $this->input->post('cboregAuditor');
		$idnorma 			= $this->input->post('cboregSistema');
		$idsubnorma 		= $this->input->post('cboregRubro');
		$idchecklist 		= $this->input->post('cboregChecklist');
		$idformula 			= $this->input->post('cboregFormula');
		$idcriterio 		= $this->input->post('cboregCriterio');
		$cinternopte 		= $this->input->post('cboregSubserv');
		$accion 			= $this->input->post('mhdnAccionAudi');
        
        $parametros = array(
            '@id_audi'   			=>  $id_audi,
            '@ccliente'   			=>  $ccliente,
            '@cestablecimiento'     =>  ($cestablecimiento == $varnull || $cestablecimiento == '%') ? '000000' : $this->input->post('cboregEstable'),
            '@faudi'				=>  substr($faudi, 6, 4).'-'.substr($faudi,3 , 2).'-'.substr($faudi, 0, 2),
            '@idauditor'      		=>  $idauditor,
            '@idnorma'      		=>  $idnorma,
            '@idsubnorma'      		=>  $idsubnorma,
            '@idchecklist'      	=>  $idchecklist,
            '@idformula'      		=>  $idformula,
            '@idcriterio'      		=>  $idcriterio,
            '@cinternopte'      	=>  $cinternopte,
            '@accion'           	=>  $accion
        );
        $resultado = $this->mregauditoria->setauditoria($parametros);
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
		$resultado = $this->mregauditoria->getbuscarauditoria($parametros);
		echo json_encode($resultado);
	}
    public function getcboregAreazona() {	// Visualizar Criterio en CBO	
        
        $parametros = array(
            '@cestablecimiento'   => $this->input->post('cestablecimiento')
        );
		$resultado = $this->mregauditoria->getcboregAreazona($parametros);
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
		$resultado = $this->mregauditoria->getlistarchecklist($parametros);
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
		$resultado = $this->mregauditoria->setregchecklist($parametros);
		echo json_encode($resultado);
	}
    public function setcalcularchecklist() {	// Recupera Listado de Propuestas	
        
		$varnull 			= 	'';

		$idaudi   = $this->input->post('idaudi');
		$fechaaudi   = $this->input->post('fechaaudi');
		$cchecklist   = $this->input->post('cchecklist');
            
        $parametros = array(
			'@idaudi'     	=> $idaudi,
			'@fechaaudi'   	=> $fechaaudi,
			'@cchecklist'  	=> $cchecklist
		);		
		$resultado = $this->mregauditoria->setcalcularchecklist($parametros);
		echo json_encode($resultado);
	}
}
?>