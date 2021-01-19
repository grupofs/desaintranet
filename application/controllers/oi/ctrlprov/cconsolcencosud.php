<?php
class Cconsolcencosud extends CI_Controller 
{
    function __construct()
	{
		parent:: __construct();	
		$this->load->model('oi/ctrlprov/mconsolcencosud');
		$this->load->helper(array('form','url','download','html','file'));
    }
    
    public function getProveedorxCliente(){
        $ccliente = $this->input->post('ccliente');

        $parametros = array(
            '@cliente' => $ccliente
        );

        $resultado = $this->mconsolcencosud->getProveedorxCliente($parametros);
        echo json_encode($resultado);
	}
    
    public function getareaxcliente(){
        $ccliente = $this->input->post('ccliente');

        $parametros = array(
            '@cliente' => $ccliente
        );

        $resultado = $this->mconsolcencosud->getareaxcliente($parametros);
        echo json_encode($resultado);
	}
    
    public function getmaquilaxproveedor(){
        $cproveedor = $this->input->post('cproveedor');

        $parametros = array(
            '@cproveedor' => $cproveedor
        );

        $resultado = $this->mconsolcencosud->getmaquilaxproveedor($parametros);
        echo json_encode($resultado);
	}
	

    // Lista de consolidado
    public function getconsolidadocencosud() 
    {	
		$varnull 	= 	'';	
		
		/*$estado	= 	'';	
		$varestado = $this->input->post('estado');
		foreach($varestado as $destado)
		{
			$estado = $destado.','.$estado;
		}
		$countestado =strlen($estado) ;
		$estado = substr($estado,0,$countestado-1);*/

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
			'@CLIENTE' 	    	=>	$this->input->post('ccliente'),
			'@CCLIENTEPROV'		=>	$this->input->post('cclienteprov'),
			'@CCLIENTEMAQ' 		=>	($this->input->post('cclientemaquila') == $varnull) ? '0' : $this->input->post('cclientemaquila'),
			'@AREACLTE' 		=>  $this->input->post('areaclte'),
			'@TIPOESTADO' 		=>  $this->input->post('tipoestado'),
		);
		$resultado = $this->mconsolcencosud->getconsolidadocencosud($parametros);
		echo json_encode($resultado);

    }
    
}
?>		