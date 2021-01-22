<?php
class Cclientereportes extends CI_Controller 
{
    function __construct()
	{
		parent:: __construct();	
		$this->load->model('ar/evalprod/mclientereportes');
		$this->load->helper(array('form','url','download','html','file'));
    }    
    
    public function getproveedoreseval(){
        $ccliente = $this->input->post('ccliente');

        $resultado = $this->mclientereportes->getproveedoreseval($ccliente);
        echo json_encode($resultado);
	} 
    
    public function getareaeval(){
        $ccliente = $this->input->post('ccliente');

        $resultado = $this->mclientereportes->getareaeval($ccliente);
        echo json_encode($resultado);
    }
    
    public function getvistageneral() 
    {	
		$varnull 	= 	'';	
			
        $eanmultiple = $this->input->post('eanmultiple');
        $stringEAN = preg_replace("/[\r\n|\n|\r]+/", ",", trim($eanmultiple));
        
        $skumultiple = $this->input->post('skumultiple');
        $stringSKU = preg_replace("/[\r\n|\n|\r]+/", ",", trim($skumultiple));

		$fini = $this->input->post('fini');
		$ffin = $this->input->post('ffin');

		$parametros = array(
            '@ccliente' 		=>	$this->input->post('ccliente'),
            '@fini' 	    	=>	($this->input->post('fini') == '%') ? NULL : substr($fini, 6, 4).'-'.substr($fini,3 , 2).'-'.substr($fini, 0, 2), 
            '@ffin' 	    	=>	($this->input->post('ffin') == '%') ? NULL : substr($ffin, 6, 4).'-'.substr($ffin,3 , 2).'-'.substr($ffin, 0, 2), 
            '@id_area' 			=>	$this->input->post('id_area'),
            '@status' 			=>	$this->input->post('status'),
            '@proveedor_nuevo' 	=>	$this->input->post('proveedor_nuevo'),
            '@id_proveedor' 	=>	$this->input->post('id_proveedor'),
            '@expediente' 		=>	($this->input->post('expediente') == $varnull) ? '%' : '%'.$this->input->post('expediente').'%',
            '@rs' 				=>	($this->input->post('rs') == $varnull) ? '%' : '%'.$this->input->post('rs').'%',
            '@codigo' 			=>	($this->input->post('codigo') == $varnull) ? '%' : '%'.$this->input->post('codigo').'%',
            '@marca' 			=>	($this->input->post('marca') == $varnull) ? '%' : '%'.$this->input->post('marca').'%',
            '@descripcion' 		=>	($this->input->post('descripcion') == $varnull) ? '%' : '%'.$this->input->post('descripcion').'%',
            '@fabricante' 		=>	($this->input->post('fabricante') == $varnull) ? '%' : '%'.$this->input->post('fabricante').'%',
            '@eanmultiple' 		=>	(ltrim($stringEAN) == $varnull) ? '-' : $stringEAN, 
            '@skumultiple' 		=>	(ltrim($stringSKU) == $varnull) ? '-' : $stringSKU, 
		);
		$resultado = $this->mclientereportes->getvistageneral($parametros);
		echo json_encode($resultado);

    }
    
}
?>	