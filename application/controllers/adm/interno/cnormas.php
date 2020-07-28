<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Cnormas extends CI_Controller { 
	function __construct()
	{
		parent:: __construct();	
		$this->load->model('adm/interno/mnormas');
		$this->load->library('encryption');
		$this->load->helper(array('form','url','download','html','file'));
		$this->load->library('form_validation');	
    }

    // Vista principal
	public function index(){				
		$this->load->view('adm/interno/vnormas');		
	}

	public function getDocumentos(){
		$resultado = $this->mnormas->getDocumentos();
		echo json_encode($resultado);
	}

	public function getidioma() /*Lista los Idiomas*/
	{				
		$resultado = $this->mnormas->getidioma();
		echo json_encode($resultado);
	}	

	public function getpais() /*Lista los Paises*/
	{				
		$resultado = $this->mnormas->getpais();
		echo json_encode($resultado);
	}	

	public function getinstitucion() /*Lista los Instituciones*/
	{				
		$resultado = $this->mnormas->getinstitucion();
		echo json_encode($resultado);
	}

	// Recuperar listado
	public function getbuscarnormativa() /*Recupera las Normas a buscar por el Tipo de Documento*/
	{		
		$varnull 			= 	'';
		$celtipodoc 		= 	'';
		$celarearesp		=	'';	
		$celidioma			= 	'';
		$celpais			= 	'';
		$celinstitucion		= 	'';

		$TIPODOC = $this->input->post('TIPODOC');
		$RESP = $this->input->post('RESP');
		$IDIOMA = $this->input->post('IDIOMA');
		$PAIS = $this->input->post('PAIS');
		$INSTITUCION = $this->input->post('INSTITUCION');
		$DESCRIPCION = $this->input->post('DESCRI');
		$PALACLAVE = $this->input->post('PALCLAVE');

		$FechaIni = $this->input->post('fi');
		$FechaFin = $this->input->post('ff');

		foreach($TIPODOC as $dtipod)
		{
			$celtipodoc = $dtipod.','.$celtipodoc;
		}
		$count =strlen($celtipodoc) ;
		$celtipodoc = substr($celtipodoc,0,$count-1);

		foreach($RESP as $dresp)
		{
			$celarearesp = $dresp.','.$celarearesp;
		}
		$countresp =strlen($celarearesp) ;
		$celarearesp = substr($celarearesp,0,$countresp-1);

		foreach($IDIOMA as $didioma)
		{
			$celidioma = $didioma.','.$celidioma;
		}
		$countidioma =strlen($celidioma) ;
		$celidioma = substr($celidioma,0,$countidioma-1);

		foreach($PAIS as $dpais)
		{
			$celpais = $dpais.','.$celpais;
		}
		$countpais =strlen($celpais) ;
		$celpais = substr($celpais,0,$countpais-1);

		foreach($INSTITUCION as $dinsti)
		{
			$celinstitucion = $dinsti.','.$celinstitucion;
		}
		$countinsti =strlen($celinstitucion) ;
		$celinstitucion = substr($celinstitucion,0,$countinsti-1);



		$parametros = array(
			'@TIPODOC' =>  $celtipodoc,
			'@DESCRI' =>  ($this->input->post('DESCRI') == $varnull) ? '%' : '%'.$DESCRIPCION.'%',
			'@RESP' =>  $celarearesp,
			'@EST' =>  ($this->input->post('EST') == $varnull) ? '%' : $this->input->post('EST'),
			'@IDIOMA' =>  $celidioma,
			'@PAIS' =>  $celpais,
			'@INSTITUCION' =>  $celinstitucion,
			'@PLACLAVE' =>  ($this->input->post('PALCLAVE') == $varnull) ? '%' : '%'.$PALACLAVE.'%',
			'@allf' =>  $this->input->post('allf'),
			'@fi' => substr($FechaIni, 6, 4).'-'.substr($FechaIni,3 , 2).'-'.substr($FechaIni, 0, 2),
			'@ff' =>  substr($FechaFin, 6, 4).'-'.substr($FechaFin,3 , 2).'-'.substr($FechaFin, 0, 2),

		);		
		$resultado = $this->mnormas->getbuscarnomativa($parametros);
		echo json_encode($resultado);
	}
}