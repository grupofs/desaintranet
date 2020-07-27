<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Cservcliente extends CI_Controller {
	function __construct() {
		parent:: __construct();	
		$this->load->model('pt/mservcliente');
		$this->load->model('mglobales');
		$this->load->helper(array('form','url','download','html','file'));
		$this->load->library('form_validation');
    }
    
    public function viewmapter() { // MAPEO TÉRMICO		
		
		$this->layout->js(array(public_url('script/pt/servclienteperfilusuario.js')));

		$data['content_for_layout'] = 'pt/servcliente/vservcliemapter';
        $this->parser->parse('seguridad/vprincipalClie',$data);
    }
    
    public function viewcalfrio() { // LLENADO EN CALIENTE - FRIO		
		
		$this->layout->js(array(public_url('script/pt/servcliente/servcliecalfrio.js')));

		$data['content_for_layout'] = 'pt/servcliente/vservcliecalfrio';
        $this->parser->parse('seguridad/vprincipalClie',$data);
    }
    
    public function viewcocsechor() { // COCINADOR-SECADOR-HORNO		
		
		$this->layout->js(array(public_url('script/pt/servcliente/perfilusuario.js')));

		$data['content_for_layout'] = 'pt/servcliente/vservcliecocsechor';
        $this->parser->parse('seguridad/vprincipalClie',$data);
    }
    
    public function viewevaldesvi() { // EVALUACIÓN DE DESVIACIONES		
		
		$this->layout->js(array(public_url('script/pt/servcliente/perfilusuario.js')));

		$data['content_for_layout'] = 'pt/servcliente/vservclieevaldesvi';
        $this->parser->parse('seguridad/vprincipalClie',$data);
    }
    
    public function viewproacep() { // PROCESAMIENTO ASÉPTICO		
		
		$this->layout->js(array(public_url('script/pt/servcliente/perfilusuario.js')));

		$data['content_for_layout'] = 'pt/servcliente/vservclieproacep';
        $this->parser->parse('seguridad/vprincipalClie',$data);
    }
    
    public function viewproconv() { // PROCESAMIENTO CONVENCIONAL		
		
		$this->layout->js(array(public_url('script/pt/servcliente/servclieproconv.js')));

		$data['content_for_layout'] = 'pt/servcliente/vservclieproconv';
        $this->parser->parse('seguridad/vprincipalClie',$data);
    }


    public function getproconvequipo() {	// Obtener numero de propuesta	
		
		$parametros = array(
            '@ccliente'   => $this->input->post('ccliente')
        );
		$resultado = $this->mservcliente->getproconvequipo($parametros);
		echo json_encode($resultado);
	}
    public function getproconvproducto() {	// Obtener numero de propuesta	
		
		$parametros = array(
            '@ccliente'   => $this->input->post('ccliente')
        );
		$resultado = $this->mservcliente->getproconvproducto($parametros);
		echo json_encode($resultado);
	}
    public function getcalfrioproducto() {	// Obtener numero de propuesta	
		
		$parametros = array(
            '@ccliente'   => $this->input->post('ccliente')
        );
		$resultado = $this->mservcliente->getcalfrioproducto($parametros);
		echo json_encode($resultado);
	}
    public function getcalfrioequipo() {	// Obtener numero de propuesta	
		
		$parametros = array(
            '@ccliente'   => $this->input->post('ccliente')
        );
		$resultado = $this->mservcliente->getcalfrioequipo($parametros);
		echo json_encode($resultado);
	}
}
?>