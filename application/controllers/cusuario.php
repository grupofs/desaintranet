<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Cusuario extends CI_Controller {
	function __construct() {
		parent:: __construct();	
		$this->load->model('musuario');
		$this->load->library('encryption');
		$this->load->helper(array('form','url','download','html','file'));
		$this->load->library('form_validation');
    }
    
   /** USUARIO **/ 	
    public function getbuscarusuarios() {	// Buscar Usuario	
        $varnull 			= 	'';

        $usuario    = $this->input->post('usuario');
        $tipo_usuario    = $this->input->post('tusuario');
        $vigente    = $this->input->post('vigencia');
        
		$parametros = array(
            '@usuario'      =>  ($this->input->post('usuario') == $varnull) ? '%' : "%".$usuario."%",
			'@tipo_usuario' =>  $tipo_usuario,
			'@estado'       =>  $vigente
		);	
		$resultado = $this->musuario->getbuscarusuarios($parametros);
		echo json_encode($resultado);
	}   
		
    public function getpersonas() {	// Buscar Usuario
		$resultado = $this->musuario->getpersonas();
		echo json_encode($resultado);
    }    
}
?>