<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Cconscapa extends CI_Controller {
	function __construct() {
		parent:: __construct();	
		$this->load->model('at/capa/mconscapa');
		$this->load->model('mglobales');
		$this->load->library('encryption');
		$this->load->helper(array('form','url','download','html','file'));
		$this->load->library('form_validation');
    }
    
    public function getclientecapa() {	// Visualizar Clientes con propuestas en CBO	
        
		$resultado = $this->mconscapa->getclientecapa();
		echo json_encode($resultado);
	}	
    public function getbusquedacapa() { // Registra el modulo
        $parametros = array(
            '@CCLIENTE' 	=>  $this->input->post('ccliente'),
        );
        $retorna = $this->mconscapa->getbusquedacapa($parametros);
        echo $retorna;		
    }
}
?>