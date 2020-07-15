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
		
		$this->layout->js(array(public_url('script/perfilusuario.js')));

		$data['content_for_layout'] = 'pt/servcliente/vservcliemapter';
        $this->parser->parse('seguridad/vprincipalClie',$data);
    }
    
    public function viewcalfrio() { // LLENADO EN CALIENTE - FRIO		
		
		$this->layout->js(array(public_url('script/perfilusuario.js')));

		$data['content_for_layout'] = 'pt/servcliente/vservcliecalfrio';
        $this->parser->parse('seguridad/vprincipalClie',$data);
    }
    
    public function viewcocsechor() { // COCINADOR-SECADOR-HORNO		
		
		$this->layout->js(array(public_url('script/perfilusuario.js')));

		$data['content_for_layout'] = 'pt/servcliente/vservcliecocsechor';
        $this->parser->parse('seguridad/vprincipalClie',$data);
    }
    
    public function viewevaldesvi() { // EVALUACIÓN DE DESVIACIONES		
		
		$this->layout->js(array(public_url('script/perfilusuario.js')));

		$data['content_for_layout'] = 'pt/servcliente/vservclieevaldesvi';
        $this->parser->parse('seguridad/vprincipalClie',$data);
    }
    
    public function viewproacep() { // PROCESAMIENTO ASÉPTICO		
		
		$this->layout->js(array(public_url('script/perfilusuario.js')));

		$data['content_for_layout'] = 'pt/servcliente/vservclieproacep';
        $this->parser->parse('seguridad/vprincipalClie',$data);
    }
    
    public function viewproconv() { // PROCESAMIENTO CONVENCIONAL		
		
		$this->layout->js(array(public_url('script/perfilusuario.js')));

		$data['content_for_layout'] = 'pt/servcliente/vservclieproconv';
        $this->parser->parse('seguridad/vprincipalClie',$data);
    }
}
?>