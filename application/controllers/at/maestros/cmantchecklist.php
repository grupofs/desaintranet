<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Cmantchecklist extends CI_Controller {
	function __construct() {
		parent:: __construct();	
		$this->load->model('at/maestros/mmantchecklist');
		$this->load->model('mglobales');
		$this->load->library('encryption');
		$this->load->helper(array('form','url','download','html','file'));
		$this->load->library('form_validation');
    }
    
   /** CHECKLIST **/ 	
    public function getlistarcurso() { // Visualizar listado de cursos	
         
        $resultado = $this->mmantchecklist->getlistarcurso();
        echo json_encode($resultado);
    }	
    public function setcurso() { // Registra el modulo
        $parametros = array(
            '@id_capacurso' 	=>  $this->input->post('mhdnIdcurso'),
            '@desc_curso' 	    =>  $this->input->post('mtxtDescCur'),
            '@comentario' 		=>  $this->input->post('mtxtComenCur'),
            '@accion' 		    =>  $this->input->post('mhdnAccionCur')
        );
        $retorna = $this->mmantchecklist->setcurso($parametros);
        echo $retorna;		
    }
}
?>