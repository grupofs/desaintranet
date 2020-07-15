<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Cregctrolprov extends CI_Controller {
	function __construct() {
		parent:: __construct();	
		$this->load->model('at/ctrlprov/mregctrolprov');
		$this->load->model('mglobales');
		$this->load->library('encryption');
		$this->load->helper(array('form','url','download','html','file'));
		$this->load->library('form_validation');
    }
    
   /** CONTROL DE PROVEEDORES **/ 
    public function getcboclieserv() {	// Visualizar Clientes del servicio en CBO	
        
		$resultado = $this->mregctrolprov->getcboclieserv();
		echo json_encode($resultado);
	}
    public function getcboprovxclie() {	// Visualizar Proveedor por cliente en CBO	
        
        $parametros = array(
            '@ccliente'   => $this->input->post('ccliente')
        );
		$resultado = $this->mregctrolprov->getcboprovxclie($parametros);
		echo json_encode($resultado);
	}
    public function getcbomaqxprov() {	// Visualizar Maquilador por proveedor en CBO	
        
        $parametros = array(
            '@cproveedor'   => $this->input->post('cproveedor')
        );
		$resultado = $this->mregctrolprov->getcbomaqxprov($parametros);
		echo json_encode($resultado);
	}
    public function getcboinspector() {	// Visualizar Inspectores en CBO	
        
		$resultado = $this->mregctrolprov->getcboinspector();
		echo json_encode($resultado);
	}
    public function getcboestado() {	// Visualizar Estado en CBO	
        
		$resultado = $this->mregctrolprov->getcboestado();
		echo json_encode($resultado);
	}
    public function getcbocalif() {	// Visualizar Calificacion en CBO	
        
		$resultado = $this->mregctrolprov->getcbocalif();
		echo json_encode($resultado);
	}
    
}
?>