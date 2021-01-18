<?php
class Cctrlproveedores extends CI_Controller 
{
    function __construct()
	{
		parent:: __construct();	
		$this->load->model('oi/mctrlproveedores');
		$this->load->helper(array('form','url','download','html','file'));
    }

    // Lista de consolidado
    public function getconsolidadocencosud() 
    {	
		$varnull 	= 	'';	
		$estado	= 	'';	

		$varestado = $this->input->post('estado');

		foreach($varestado as $destado)
		{
			$estado = $destado.','.$estado;
		}
		$countestado =strlen($estado) ;
		$estado = substr($estado,0,$countestado-1);

		$fini = $this->input->post('fini');
		$ffin = $this->input->post('ffin');

		$parametros = array(
			'@CCIA' 	    	=>	$this->input->post('ccia'),
			'@CAREA' 	    	=>	$this->input->post('carea'),
			'@CSERVICIO' 		=>	$this->input->post('cservicio'),
			'@ANIO' 	    	=>	$this->input->post('anio'),
			'@MES' 	        	=>	$this->input->post('mes'),
			'@FINI' 			=>  ($this->input->post('fini') == '%') ? NULL : substr($fini, 6, 4).'-'.substr($fini,3 , 2).'-'.substr($fini, 0, 2), 
			'@FFIN' 			=>  ($this->input->post('ffin') == '%') ? NULL : substr($ffin, 6, 4).'-'.substr($ffin,3 , 2).'-'.substr($ffin, 0, 2),  
			'@CLIENTE' 	    	=>	'00654',
			'@CCLIENTEPROV'		=>	$this->input->post('proveedor'),
			'@CCLIENTEMAQ' 		=>	$this->input->post('maquilador'),
			'@CIUDAD' 			=>  ($this->input->post('ciudad') == $varnull) ? '%' : '%'.$this->input->post('ciudad').'%',
			'@DMARCA' 			=>  ($this->input->post('marca') == $varnull) ? '%' : '%'.$this->input->post('marca').'%',
			'@TIPOESTADO' 		=>  $estado,
			'@AREACLTE' 		=>  $this->input->post('areaclie'),
			'@ESCONCESIONARIO' 	=>  $this->input->post('esconcesionario'),
		);
		$resultado = $this->mctrlproveedores->getconsolidadocencosud($parametros);
		echo json_encode($resultado);

    }
    
}
?>		