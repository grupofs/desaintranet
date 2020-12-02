<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Cmaestros extends CI_Controller {
	function __construct() {
		parent:: __construct();	
		$this->load->model('adm/conta/mmaestros');
		$this->load->model('mglobales');
		$this->load->library('encryption');
		$this->load->helper(array('form','url','download','html','file'));
		$this->load->library('form_validation');
    }
    
   /** SISTEMAS **/ 	
    public function getlistarcodigo() { // Visualizar listado de modulos	
        
		$resultado = $this->mmaestros->getlistarcodigo();
		echo json_encode($resultado);
	}	
	public function setcodigo() { // Registra el modulo
		$parametros = array(
			'@id_modulo' 	=>  $this->input->post('mhdnIdcodigo'),
			'@codigo' 	    =>  $this->input->post('mtxtcodigo'),
			'@descodigo' 	=>  $this->input->post('mtxtcodigodesc'),
			'@grupo_codigo' =>  $this->input->post('cbogrupocod'),
			'@accion' 		=>  $this->input->post('mhdnAccionCod')
		);
		$retorna = $this->mmaestros->setcodigo($parametros);
		echo $retorna;		
    }		
}
?>