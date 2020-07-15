<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Cmantcapa extends CI_Controller {
	function __construct() {
		parent:: __construct();	
		$this->load->model('at/capa/mmantcapa');
		$this->load->model('mglobales');
		$this->load->library('encryption');
		$this->load->helper(array('form','url','download','html','file'));
		$this->load->library('form_validation');
    }
    
   /** CURSOS **/ 	
    public function getlistarcurso() { // Visualizar listado de cursos	
         
        $resultado = $this->mmantcapa->getlistarcurso();
        echo json_encode($resultado);
    }	
    public function setcurso() { // Registra el modulo
        $parametros = array(
            '@id_capacurso' 	=>  $this->input->post('mhdnIdcurso'),
            '@desc_curso' 	    =>  $this->input->post('mtxtDescCur'),
            '@comentario' 		=>  $this->input->post('mtxtComenCur'),
            '@accion' 		    =>  $this->input->post('mhdnAccionCur')
        );
        $retorna = $this->mmantcapa->setcurso($parametros);
        echo $retorna;		
    }
    
   /** MODULOS **/ 	
     public function getlistarmodulo() { // Visualizar listado de modulos	
          
         $resultado = $this->mmantcapa->getlistarmodulo();
         echo json_encode($resultado);
     }		
     public function getcbocurso() { // Visualizar cbo de curso	
         
         $resultado = $this->mmantcapa->getcbocurso();
         echo json_encode($resultado);
     }
     public function setmodulo() { // Registra el modulo
         $parametros = array(
             '@id_capamodulo' 	=>  $this->input->post('mhdnIdmodulo'),
             '@id_capacurso' 	=>  $this->input->post('mcboCurso'),
             '@desc_modulo'     =>  $this->input->post('mtxtDescMod'),
             '@comentario' 		=>  $this->input->post('mtxtComenMod'),
             '@accion' 		    =>  $this->input->post('mhdnAccionMod')
         );
         $retorna = $this->mmantcapa->setmodulo($parametros);
         echo $retorna;		
     }
    
   /** EXPOSITOR **/ 	
     public function getlistarexpositor() { // Visualizar listado de modulos	
          
         $resultado = $this->mmantcapa->getlistarexpositor();
         echo json_encode($resultado);
     }		
     public function getcboExpositor() { // Visualizar cbo de curso	
         
         $resultado = $this->mmantcapa->getcboExpositor();
         echo json_encode($resultado);
     }
     public function setexpositor() { // Registra el modulo
         $parametros = array(
             '@id_capaexpo' 	=>  $this->input->post('mhdnIdexpositor'),
             '@id_administrado' 	=>  $this->input->post('hdnidadmi'),
             '@cole_expositor'     =>  $this->input->post('mtxtnrocole'),
             '@accion' 		    =>  $this->input->post('mhdnAccionExpo')
         );
         $retorna = $this->mmantcapa->setexpositor($parametros);
         echo $retorna;		
     }
}
?>