<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Cconstramdigesa extends CI_Controller {
	function __construct() {
		parent:: __construct();	
		$this->load->model('ar/tramites/mconstramdigesa');
		$this->load->model('mglobales');
		$this->load->library('encryption');
		$this->load->helper(array('form','url','download','html','file'));
		$this->load->library('form_validation');
    }
    
   /** TRAMITES DIGESA  **/  

    public function getconsulta_grid_tr() {	// Recupera Listado de Propuestas	
        		
        $varnull = '';

        $codprod = 		($this->input->post('codprod') == $varnull) ? '%' : '%'.$this->input->post('codprod').'%';
        $nomprod = 		($this->input->post('nomprod') == $varnull) ? '%' : '%'.$this->input->post('nomprod').'%';
        $regsan = 		($this->input->post('regsan') == $varnull) ? '%' : '%'.$this->input->post('regsan').'%';
        $tono = 		($this->input->post('tono') == $varnull) ? '%' : '%'.$this->input->post('tono').'%';
        $estado = 		($this->input->post('estado') == $varnull) ? '%' : '%'.$this->input->post('estado').'%';
        $marca = 		($this->input->post('marca') == $varnull) ? '%' : '%'.$this->input->post('marca').'%';
        $tramite = 		($this->input->post('tramite') == $varnull) ? '%' : '%'.$this->input->post('tramite').'%';
        $allf = 		$this->input->post('allf');
        $fini = 		$this->input->post('fi');
        $ffin = 		$this->input->post('ff');
        $ccliente = 	$this->input->post('ccliente'); 
        $numexpdiente = ($this->input->post('numexpdiente') == $varnull) ? '%' : '%'.$this->input->post('numexpdiente').'%';
        $ccategoria = 	($this->input->post('ccategoria') == $varnull) ? '%' : '%'.$this->input->post('ccategoria').'%';
        $est = 			($this->input->post('est') == $varnull) ? '%' : '%'.$this->input->post('est').'%';	
        $tipoest = 		($this->input->post('tipoest') == $varnull) ? '%' : $this->input->post('tipoest');
        $tiporeporte = 	'G'; 
        $iln = 		    ($this->input->post('iln') == $varnull) ? '%' : '%'.$this->input->post('iln').'%';
            
        $parametros = array(
            '@codprod' 		=>	$codprod,
            '@nomprod' 		=>  $nomprod,
            '@regsan' 		=>  $regsan,
            '@tono' 		=>  $tono,
            '@estado'		=>  $estado,
            '@marca' 		=>  $marca,
            '@tramite' 		=>  $tramite,
            '@allf' 		=>  $allf,
            '@fi' 			=>  substr($fini, 6, 4).'-'.substr($fini,3 , 2).'-'.substr($fini, 0, 2),
            '@ff' 			=>  substr($ffin, 6, 4).'-'.substr($ffin,3 , 2).'-'.substr($ffin, 0, 2),
            '@ccliente' 	=>  $ccliente,
            '@numexpdiente' =>  $numexpdiente,
            '@ccategoria' 	=>  $ccategoria,		
            '@est' 			=>  $est,
            '@tipoest' 		=>  $tipoest,
            '@TIPOREPORTE'	=>	$tiporeporte,
            '@iln'			=>	$iln
		);		
		$resultado = $this->mconstramdigesa->getconsulta_grid_tr($parametros);
		echo json_encode($resultado);
	}
    public function getconsulta_excel_tr() {	// Recupera Listado de Propuestas	
        		
        $varnull = '';

        $codprod = 		($this->input->post('codprod') == $varnull) ? '%' : '%'.$this->input->post('codprod').'%';
        $nomprod = 		($this->input->post('nomprod') == $varnull) ? '%' : '%'.$this->input->post('nomprod').'%';
        $regsan = 		($this->input->post('regsan') == $varnull) ? '%' : '%'.$this->input->post('regsan').'%';
        $tono = 		($this->input->post('tono') == $varnull) ? '%' : '%'.$this->input->post('tono').'%';
        $estado = 		($this->input->post('estado') == $varnull) ? '%' : '%'.$this->input->post('estado').'%';
        $marca = 		($this->input->post('marca') == $varnull) ? '%' : '%'.$this->input->post('marca').'%';
        $tramite = 		($this->input->post('tramite') == $varnull) ? '%' : '%'.$this->input->post('tramite').'%';
        $allf = 		$this->input->post('allf');
        $fini = 		$this->input->post('fi');
        $ffin = 		$this->input->post('ff');
        $ccliente = 	$this->input->post('ccliente'); 
        $numexpdiente = ($this->input->post('numexpdiente') == $varnull) ? '%' : '%'.$this->input->post('numexpdiente').'%';
        $ccategoria = 	($this->input->post('ccategoria') == $varnull) ? '%' : '%'.$this->input->post('ccategoria').'%';
        $est = 			($this->input->post('est') == $varnull) ? '%' : '%'.$this->input->post('est').'%';	
        $tipoest = 		($this->input->post('tipoest') == $varnull) ? '%' : $this->input->post('tipoest');
        $tiporeporte = 	'E'; 
        $iln = 		    ($this->input->post('iln') == $varnull) ? '%' : '%'.$this->input->post('iln').'%';
            
        $parametros = array(
            '@codprod' 		=>	$codprod,
            '@nomprod' 		=>  $nomprod,
            '@regsan' 		=>  $regsan,
            '@tono' 		=>  $tono,
            '@estado'		=>  $estado,
            '@marca' 		=>  $marca,
            '@tramite' 		=>  $tramite,
            '@allf' 		=>  $allf,
            '@fi' 			=>  substr($fini, 6, 4).'-'.substr($fini,3 , 2).'-'.substr($fini, 0, 2),
            '@ff' 			=>  substr($ffin, 6, 4).'-'.substr($ffin,3 , 2).'-'.substr($ffin, 0, 2),
            '@ccliente' 	=>  $ccliente,
            '@numexpdiente' =>  $numexpdiente,
            '@ccategoria' 	=>  $ccategoria,		
            '@est' 			=>  $est,
            '@tipoest' 		=>  $tipoest,
            '@TIPOREPORTE'	=>	$tiporeporte,
            '@iln'			=>	$iln
		);		
		$resultado = $this->mconstramdigesa->getconsulta_excel_tr($parametros);
		echo json_encode($resultado);
	}

    public function getbuscartramite(){
        $parametros['@codprod'] = $this->input->post('codprod');
        $parametros['@tipo'] = $this->input->post('tipo');
        
        $resultado = $this->mconstramdigesa->getbuscartramite($parametros);
        echo json_encode($resultado);
    }

    public function getdocum_aarr(){
        $parametros['@casuntoregula'] = $this->input->post('casuntoregula');
        $parametros['@centidad'] = $this->input->post('centidad');
        $parametros['@ctramite'] = $this->input->post('ctramite');
        $parametros['@csumario'] = $this->input->post('csumario');
        
        $resultado = $this->mconstramdigesa->getdocum_aarr($parametros);
        echo json_encode($resultado);
    }	

}
?>

