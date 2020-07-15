<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Cglobales extends CI_Controller {
	function __construct() {
		parent:: __construct();	
		$this->load->model('mglobales');
		$this->load->library('encryption');
		$this->load->helper(array('form','url','download','html','file'));
		$this->load->library('form_validation');
    }

    public function getmeses() { // recupera meses del año    				
        $resultado = $this->mglobales->getmeses();
        echo json_encode($resultado);
    }

    public function getanios() { // recupera los años    				
        $resultado = $this->mglobales->getanios();
        echo json_encode($resultado);  
    }

	public function getareacia() { // Lista horas extras x empleado			
		$ccia =  $this->input->post('ccia');	
		$resultado = $this->mglobales->getareacia($ccia);
		echo json_encode($resultado);
	}	

	public function getpaises() { // recupera los paises			
		$resultado = $this->mglobales->getpaises();
		echo json_encode($resultado);  
	}
	
	public function getdepartamentos() { // recupera departamentos				
		$resultado = $this->mglobales->getdepartamentos();
		echo json_encode($resultado);  
	}

	public function getprovincias() { // recupera provincias			
		$cdepa =  $this->input->post('cdepa');	
		$resultado = $this->mglobales->getprovincias($cdepa);
		echo json_encode($resultado);  
	}

	public function getdistritos() { // recupera distritos				
		$cdepa =  $this->input->post('cdepa');
		$cprov =  $this->input->post('cprov');
		$resultado = $this->mglobales->getdistritos($cdepa,$cprov);
		echo json_encode($resultado);  
	}

	public function getubigeo() { // recupera ubigeo
		$resultado = $this->mglobales->getubigeo();
		echo json_encode($resultado);  
	}

	public function seladministrado() { // recupera administrados
		$varnull 	= 	'';	
        $parametros = array(
			'@buscar' 	=>  ($this->input->post('buscar') == $varnull) ? '%' : '%'.$this->input->post('buscar').'%'
        );
        $resultado = $this->mglobales->seladministrado($parametros);
        echo json_encode($resultado);		
	}
	
    public function setadministrado() { // Registra el modulo
        $parametros = array(
            '@id_capacurso' 	=>  $this->input->post('mhdnIdcurso'),
            '@desc_curso' 	    =>  $this->input->post('mtxtDescCur'),
            '@comentario' 		=>  $this->input->post('mtxtComenCur'),
            '@desc_curso' 	    =>  $this->input->post('mtxtDescCur'),
            '@comentario' 		=>  $this->input->post('mtxtComenCur'),
            '@desc_curso' 	    =>  $this->input->post('mtxtDescCur'),
            '@comentario' 		=>  $this->input->post('mtxtComenCur'),
            '@accion' 		    =>  $this->input->post('mhdnAccionCur')
        );
        $resultado = $this->mglobales->setadministrado($parametros);
        echo json_encode($resultado);		
    }
}
?>