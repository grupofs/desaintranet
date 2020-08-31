<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Csistemas extends CI_Controller {
	function __construct() {
		parent:: __construct();	
		$this->load->model('adm/ti/msistemas');
		$this->load->model('mglobales');
		$this->load->library('encryption');
		$this->load->helper(array('form','url','download','html','file'));
		$this->load->library('form_validation');
    }
    
   /** SISTEMAS **/ 	
    public function getlistarmodulos() { // Visualizar listado de modulos	
        
		$resultado = $this->msistemas->getlistarmodulos();
		echo json_encode($resultado);
	}	
	public function setmodulo() { // Registra el modulo
		$parametros = array(
			'@id_modulo' 	=>  $this->input->post('mhdnIdmodulo'),
			'@ccompania' 	=>  $this->input->post('cboCia'),
			'@carea' 		=>  $this->input->post('mcboArea'),
			'@servicios' 	=>  null,
			'@desc_modulo' 	=>  $this->input->post('mtxtDescrMod'),
			'@tipo_modulo' 	=>  $this->input->post('cbotipo'),
			'@class_icono' 	=>  $this->input->post('mtxticono'),
			'@accion' 		=>  $this->input->post('mhdnAccionMod')
		);
		$retorna = $this->msistemas->setmodulo($parametros);
		echo $retorna;		
    }

    public function getlistaropciones() { // Visualizar listado de opciones	
        
		$resultado = $this->msistemas->getlistaropciones();
		echo json_encode($resultado);
	}	
	public function setopcion() { // Registra el opcion del menu
	
		$parametros = array(
			'@id_modulo' 		=>  $this->input->post('cboModulo'),
			'@id_opcion' 		=>  $this->input->post('mhdnIdopcion'),
			'@desc_opcion' 		=>  $this->input->post('mtxtDescOpc'),
			'@vista_opcion' 	=>  $this->input->post('mtxtVentana'),
			'@script_opcion' 	=>  $this->input->post('mtxtJavascript'),
			'@accion' 			=>  $this->input->post('mhdnAccionOpc')
		);
		$retorna = $this->msistemas->setopcion($parametros);
		echo $retorna;		
    }
    public function getmoduloxcia() { // Recuperar opciones por compañia
        
		$parametros = array(
			'@id_cia' 		=>  $this->input->post('ccia')
		);
		$resultado = $this->msistemas->getmoduloxcia($parametros);
		echo json_encode($resultado);
	}	

    public function getlistarroles() { // Visualizar listado de roles	
        
		$resultado = $this->msistemas->getlistarroles();
		echo json_encode($resultado);
	}
	public function setrol() { // Registra el modulo
		$parametros = array(
			'@id_rol' 		=>  $this->input->post('mhdnIdrol'),
			'@desc_rol' 	=>  $this->input->post('mtxtDescRol'),
			'@ccompania' 	=>  $this->input->post('cboCiarol'),
			'@comentario' 	=>  $this->input->post('mtxtComentario'),
			'@accion' 		=>  $this->input->post('mhdnAccionRol')
		);
		$retorna = $this->msistemas->setrol($parametros);
		echo $retorna;		
    }
    public function getrolxcia() { // Recuperar opciones por compañia
        
		$parametros = array(
			'@id_cia' 		=>  $this->input->post('ccia')
		);
		$resultado = $this->msistemas->getrolxcia($parametros);
		echo json_encode($resultado);
	} 

    public function getlistarperm() { // Visualizar listado de permisos	
        
		$parametros = array(
			'@id_rol' 		=>  $this->input->post('idrol')
		);
		$resultado = $this->msistemas->getlistarperm($parametros);
		echo json_encode($resultado);
	}	
    public function getcborol() { // Visualizar cbo de roles	
        
		$resultado = $this->msistemas->getcborol();
		echo json_encode($resultado);
	}

    public function getrolpermisos() { // Visualizar listado de permisos por roles	
        
		$parametros = array(
			'@id_rol' 		=>  $this->input->post('idrol'),
			'@id_modulo' 	=>  $this->input->post('idmodulo'),
			'@sele' 		=>  $this->input->post('sele')
		);
		$resultado = $this->msistemas->getrolpermisos($parametros);
		echo json_encode($resultado);
	}	

    public function setasignarperm() { // Registrar Permisos	
        
		$parametros = array(
			'@id_rol' 		=>  $this->input->post('idrol'),
			'@id_modulo' 	=>  $this->input->post('idmodulo'),
			'@id_opcion' 	=>  $this->input->post('idopcion'),
			'@sele' 		=>  $this->input->post('sele')
		);
		$resultado = $this->msistemas->setasignarperm($parametros);
		echo json_encode($resultado);
	}		
	
}
?>