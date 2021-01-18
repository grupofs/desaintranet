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
		
		$this->layout->js(array(public_url('script/pt/servcliente/servcliemapter.js')));

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
		
		$this->layout->js(array(public_url('script/pt/servcliente/servclieevaldesvi.js')));

		$data['content_for_layout'] = 'pt/servcliente/vservclieevaldesvi';
        $this->parser->parse('seguridad/vprincipalClie',$data);
    }    
    public function viewproacep() { // PROCESAMIENTO ASÉPTICO		
		
		$this->layout->js(array(public_url('script/pt/servcliente/servclieproasep.js')));

		$data['content_for_layout'] = 'pt/servcliente/vservclieproacep';
        $this->parser->parse('seguridad/vprincipalClie',$data);
	}	
    public function viewproconv() { // PROCESAMIENTO CONVENCIONAL		
		
		$this->layout->js(array(public_url('script/pt/servcliente/servclieproconv.js')));

		$data['content_for_layout'] = 'pt/servcliente/vservclieproconv';
        $this->parser->parse('seguridad/vprincipalClie',$data);
    }

    public function getmapterequipo() {	// Obtener equipo mapeo termico	
		
		$parametros = array(
            '@ccliente'   => $this->input->post('ccliente')
        );
		$resultado = $this->mservcliente->getmapterequipo($parametros);
		echo json_encode($resultado);
	}
    public function getmapterrecinto() {	// Obtener recinto mapeo termico	
		
		$parametros = array(
            '@ccliente'   => $this->input->post('ccliente')
        );
		$resultado = $this->mservcliente->getmapterrecinto($parametros);
		echo json_encode($resultado);
	}
    public function getmapterestudio() {	// Obtener estudio mapeo termico	
		
		$parametros = array(
            '@ccliente'   => $this->input->post('ccliente')
        );
		$resultado = $this->mservcliente->getmapterestudio($parametros);
		echo json_encode($resultado);
	}
    public function getmapterproducto() {	// Obtener producto mapeo termico	
		
		$parametros = array(
            '@ccliente'   => $this->input->post('ccliente')
        );
		$resultado = $this->mservcliente->getmapterproducto($parametros);
		echo json_encode($resultado);
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
            '@CCLIENTE'   => $this->input->post('ccliente'),
            '@IDINFORME'   => $this->input->post('idinforme'),
            '@IDREGISTRO'   => $this->input->post('idregistro'),
            '@IDREGESTUDIO'   => $this->input->post('idregestudio')
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
	
    public function getproasepproducto() {	// Obtener numero de propuesta	
		
		$parametros = array(
            '@ccliente'   => $this->input->post('ccliente')
        );
		$resultado = $this->mservcliente->getproasepproducto($parametros);
		echo json_encode($resultado);
	}
	
    public function getevaldesviestudio() {	// Obtener estudio mapeo termico	
		
		$parametros = array(
            '@ccliente'   => $this->input->post('ccliente')
        );
		$resultado = $this->mservcliente->getevaldesviestudio($parametros);
		echo json_encode($resultado);
	}
}
?>