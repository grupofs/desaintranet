<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class CdashboardAR extends CI_Controller {
	function __construct() {
		parent:: __construct();	
		$this->load->model('analytics/mdashboardAR');
		$this->load->model('mglobales');
		$this->load->library('encryption');
		$this->load->helper(array('form','url','download','html','file'));
		$this->load->library('form_validation');
    }
    
    public function gettendenciaanualrendi() 
    {	
		$parametros = array(            
			'@ccliente' =>  $this->input->post('ccliente'),
            '@anio' =>  $this->input->post('anio'),
        );
		$resultado = $this->mdashboardAR->gettendenciaanualrendi($parametros);
		echo json_encode($resultado);

    }
    
    public function getdistproductolinea() 
    {	
		$parametros = array(            
			'@ccliente' =>  $this->input->post('ccliente'),
            '@anio' =>  $this->input->post('anio'),
            '@mes' =>  $this->input->post('mes'),
        );
		$resultado = $this->mdashboardAR->getdistproductolinea($parametros);
		echo json_encode($resultado);

    }
    
    public function getgrafcaproprodlinea() 
    {	
		$parametros = array(            
			'@ccliente' =>  $this->input->post('ccliente'),
            '@anio' =>  $this->input->post('anio'),
            '@mes' =>  $this->input->post('mes'),
        );
		$resultado = $this->mdashboardAR->getgrafcaproprodlinea($parametros);
		echo json_encode($resultado);

    }
    
    public function getporcaproprodlinea() 
    {	
		$parametros = array(            
			'@ccliente' =>  $this->input->post('ccliente'),
            '@anio' =>  $this->input->post('anio'),
            '@mes' =>  $this->input->post('mes'),
        );
		$resultado = $this->mdashboardAR->getporcaproprodlinea($parametros);
		echo json_encode($resultado);

    }
}
?>