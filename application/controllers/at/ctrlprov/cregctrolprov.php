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
    public function getbuscarctrlprov() {	// Busca Control de Proveedores	
        
		$varnull = 	'';

		$ccia 			= '1';
		$carea 			= '01';
		$cservicio 		= '02';
		$fini       	= $this->input->post('fdesde');
		$ffin       	= $this->input->post('fhasta');
		$ccliente   	= $this->input->post('ccliente');
		$cclienteprov   = $this->input->post('cclienteprov');
		$cclientemaq   	= $this->input->post('cclientemaq');
		$inspector    	= $this->input->post('inspector');
            
        $parametros = array(
			'@ccia'     	=> $ccia,
			'@carea'     	=> $carea,
			'@cservicio'    => $cservicio,
			'@fini'         => ($this->input->post('fdesde') == '%') ? NULL : substr($fini, 6, 4).'-'.substr($fini,3 , 2).'-'.substr($fini, 0, 2),
			'@ffin'         => ($this->input->post('fhasta') == '%') ? NULL : substr($ffin, 6, 4).'-'.substr($ffin,3 , 2).'-'.substr($ffin, 0, 2),
			'@ccliente'     => $ccliente,
			'@cclienteprov' => ($this->input->post('cclienteprov') == '') ? '%' : $cclienteprov, 
			'@cclientemaq'  => ($this->input->post('cclientemaq') == '') ? '%' : $cclientemaq,
			'@inspector'	=> ($this->input->post('inspector') == '') ? '%' : $inspector,
		);		
		$resultado = $this->mregctrolprov->getbuscarctrlprov($parametros);
		echo json_encode($resultado);
	}
    public function getrecuperainsp() {	// Visualizar Maquilador por proveedor en CBO	
        
        $parametros = array(
            '@idinspeccion'   => $this->input->post('idinspeccion')
        );
		$resultado = $this->mregctrolprov->getrecuperainsp($parametros);
		echo json_encode($resultado);
	}
	
    
}
?>