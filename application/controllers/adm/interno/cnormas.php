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

	
	public function getpublicacion() /*Listado Publicación */
	{				
		$resultado = $this->mnormas->getpublicacion();
		echo json_encode($resultado);
	}	
	// Recuperar listado
	public function getbuscarnormativa(){ /*Recupera las Normas a buscar por el Tipo de Documento*/
			
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

	// Subir Archivos	
	public function subirArchivo(){
		//RUTA DONDE SE GUARDAN LOS FICHEROS
	   $config['upload_path'] = 'FTPfileserver/Archivos/Normas/';
	   $config['allowed_types'] = 'pdf|xlsx|docx|doc|xls';
	   $config['max_size'] = '60048';
	   $this->load->library('upload',$config);
	   $this->upload->initialize($config);
	   //if (!($this->upload->do_upload('mtxtArchivopropu') || $this->upload->do_upload('mtxtArchivo'))) {

	   if (!($this->upload->do_upload('mtxtArchivoNewnorma') || $this->upload->do_upload('mtxtArchivo'))) {
		   //si al subirse hay algun error 
		   $data['uploadError'] = $this->upload->display_errors();
		   $error = '';
		   return $error;
			
	   } else {

		   $data = $this->upload->data();

		   $path = array(
					$prueba1 = $data['file_name'],
				   $prueba2 = $config['upload_path'],
		   );
		   echo json_encode($path);
	   }
	   
	}	

	// Subir Archivos	
	public function subirArchivoEdit(){
		//RUTA DONDE SE GUARDAN LOS FICHEROS
	   $config['upload_path'] = 'FTPfileserver/Archivos/Normas/';
	   $config['allowed_types'] = 'pdf|xlsx|docx|doc|xls';
	   $config['max_size'] = '60048';
	   $this->load->library('upload',$config);
	   $this->upload->initialize($config);
	   //if (!($this->upload->do_upload('mtxtArchivopropu') || $this->upload->do_upload('mtxtArchivo'))) {

	   if (!($this->upload->do_upload('mtxtArchivoNormaEdit') || $this->upload->do_upload('mtxtArchivo'))) {
		   //si al subirse hay algun error 
		   $data['uploadError'] = $this->upload->display_errors();
		   $error = '';
		   return $error;
			
	   } else {

		   $data = $this->upload->data();

		   $path = array(
					$prueba1 = $data['file_name'],
				   $prueba2 = $config['upload_path'],
		   );
		   echo json_encode($path);
	   }
	   
	}	
	   
	//AGREGAR NORMA 
	public function guardarnormativa(){

		$varnull = '';
		$fechapubli = $this->input->post('txtFechaPublicacion');
		$fechavenc = $this->input->post('txtFechaVencimiento');

		$fechavig1 = $this->input->post('txtFechaVigencia1');
		$fechavig2 = $this->input->post('txtFechaVigencia2');
		$fechavig3 = $this->input->post('txtFechaVigencia3');
		$fechavig4 = $this->input->post('txtFechaVigencia4');


		$parametros['@codigo'] = $this->input->post('txtCodigoNew');
		$parametros['@tipodoc'] = $this->input->post('cboDocumentoNew');
		$parametros['@idioma'] = $this->input->post('cboIdiomaNew');
		$parametros['@pais'] = $this->input->post('cboPaisNew');
		$parametros['@institucion'] = $this->input->post('cboInstitucioNew');
		$parametros['@publicacion'] = $this->input->post('mtxtPublicacion');
		$parametros['@titulo'] = $this->input->post('mtxtTitulo');
		$parametros['@fpublicacion'] = ($fechapubli == $varnull) ? NULL : substr($fechapubli, 6, 4).'-'.substr($fechapubli,3 , 2).'-'.substr($fechapubli, 0, 2);
		$parametros['@fvencimiento'] = ($fechavenc == $varnull) ? NULL : substr($fechavenc, 6, 4).'-'.substr($fechavenc,3 , 2).'-'.substr($fechavenc, 0, 2);
		$parametros['@version'] = $this->input->post('mtxtVersionNew');
		$parametros['@palabrasclaves'] = $this->input->post('mtxtClaveNew');
		$parametros['@arearesp'] = $this->input->post('cboResponsableNew');
		$parametros['@comentario'] = $this->input->post('mtxtComentariosNew');
		$parametros['@archivo'] = $this->input->post('txtNombreArchivo');
		$parametros['@ruta'] = $this->input->post('txtruta');

		$parametros['@fvigencia1'] = ($fechavig1 == $varnull) ? NULL : substr($fechavig1, 6, 4).'-'.substr($fechavig1,3 , 2).'-'.substr($fechavig1, 0, 2);
		$parametros['@fvigencia2'] = ($fechavig2 == $varnull) ? NULL : substr($fechavig2, 6, 4).'-'.substr($fechavig2,3 , 2).'-'.substr($fechavig2, 0, 2);
		$parametros['@fvigencia3'] = ($fechavig3 == $varnull) ? NULL : substr($fechavig3, 6, 4).'-'.substr($fechavig3,3 , 2).'-'.substr($fechavig3, 0, 2);
		$parametros['@fvigencia4'] = ($fechavig4 == $varnull) ? NULL : substr($fechavig4, 6, 4).'-'.substr($fechavig4,3 , 2).'-'.substr($fechavig4, 0, 2);

		$parametros['@nota1'] = $this->input->post('mtxtNota1');
		$parametros['@nota2'] = $this->input->post('mtxtNota2');
		$parametros['@nota3'] = $this->input->post('mtxtNota3');
		$parametros['@nota4'] = $this->input->post('mtxtNota4');
		$parametros['@idusuario'] = $this->session->userdata('s_idusuario');

		$respuesta = $this->mnormas->guardarnormativa($parametros);
		echo json_encode($respuesta);
	}

	//EDITAR NORMA 
	public function editarnormativa(){

		
		$varnull = 'null';
		$var = '';
		$fechavencedit = $this->input->post('txtFechaVencimientoEdit');
		$fechapublicedit = $this->input->post('txtFechaPublicacionEdit');

		$fechavigencia1 = $this->input->post('txtFechaVigencia1Edit');
		$fechavigencia2 = $this->input->post('txtFechaVigencia2Edit');
		$fechavigencia3 = $this->input->post('txtFechaVigencia3Edit');
		$fechavigencia4 = $this->input->post('txtFechaVigencia4Edit');

		
		$parametros['@idnorma'] = $this->input->post('mtxtidNorma');
		$parametros['@codigo'] = $this->input->post('txtCodigoEdit');
		$parametros['@tipodoc'] = $this->input->post('cboDocumentoEdit');
		$parametros['@idioma'] = $this->input->post('cboIdiomaEdit');
		$parametros['@pais'] = $this->input->post('cboPaisEdit');
		$parametros['@institucion'] = $this->input->post('cboInstitucioEdit');
		$parametros['@publicacion'] = $this->input->post('mtxtPublicacionEdit');
		$parametros['@titulo'] = $this->input->post('mtxtTituloEdit');
		$parametros['@fpublicacion'] = ($fechapublicedit == $varnull or $fechapublicedit == $var) ? NULL : substr($fechapublicedit, 6, 4).'-'.substr($fechapublicedit,3 , 2).'-'.substr($fechapublicedit, 0, 2);
		$parametros['@fvencimiento'] = ($fechavencedit == $varnull or $fechavencedit == $var) ? NULL : substr($fechavencedit, 6, 4).'-'.substr($fechavencedit,3 , 2).'-'.substr($fechavencedit, 0, 2);
		$parametros['@version'] = $this->input->post('mtxtVersionEdit');
		$parametros['@palabrasclaves'] = $this->input->post('mtxtClaveEdit');
		$parametros['@arearesp'] = $this->input->post('cboResponsableEdit');
		$parametros['@comentario'] = $this->input->post('mtxtComentarioEdit');
		$parametros['@archivo'] = $this->input->post('txtNombreArchivoEdit');
		$parametros['@fase'] = $this->input->post('cboFaseEdit');
		$parametros['@ruta'] = $this->input->post('txtrutaEdit');
	
		$parametros['@fvigencia1'] = ($fechavigencia1 == $varnull or $fechavigencia1 == $var) ? NULL : substr($fechavigencia1, 6, 4).'-'.substr($fechavigencia1,3 , 2).'-'.substr($fechavigencia1, 0, 2);
		$parametros['@fvigencia2'] = ($fechavigencia2 == $varnull or $fechavigencia2 == $var) ? NULL : substr($fechavigencia2, 6, 4).'-'.substr($fechavigencia2,3 , 2).'-'.substr($fechavigencia2, 0, 2);
		$parametros['@fvigencia3'] = ($fechavigencia3 == $varnull or $fechavigencia3 == $var) ? NULL : substr($fechavigencia3, 6, 4).'-'.substr($fechavigencia3,3 , 2).'-'.substr($fechavigencia3, 0, 2);
		$parametros['@fvigencia4'] = ($fechavigencia4 == $varnull or $fechavigencia4 == $var) ? NULL : substr($fechavigencia4, 6, 4).'-'.substr($fechavigencia4,3 , 2).'-'.substr($fechavigencia4, 0, 2);
		$parametros['@nota1'] = $this->input->post('mtxtNota1Edit');
		$parametros['@nota2'] = $this->input->post('mtxtNota2Edit');
		$parametros['@nota3'] = $this->input->post('mtxtNota3Edit');
		$parametros['@nota4'] = $this->input->post('mtxtNota4Edit');
		$parametros['@idusuario'] = $this->session->userdata('s_idusuario');
		

		$respuesta = $this->mnormas->editarnormativa($parametros);
		echo json_encode($respuesta);
	}

	// ELIMINAR NORMA
	public function deleteNormativa(){
		$idnorma = $this->input->post('idnorma');	
		$resultado = $this->mnormas->deleteNormativa($idnorma);
		echo json_encode($resultado);
	}

	//BUSCAR GUIA

	public function getbuscarguia(){

		$parametros['@idnorma'] = $this->input->post('IDNORMA');				
		$resultado = $this->mnormas->getbuscarguia($parametros);
			
		echo json_encode($resultado);
	}


    public function getlistnormas(){				
        $resultado = $this->mnormas->getlistnormas();
        echo json_encode($resultado);
	}
	
	

    public function guardarguia(){
        $parametros['@id_norma'] = $this->input->post('mtxtidnormag');
        $parametros['@detalleguia'] = $this->input->post('detalle_guia');
        $parametros['@observacionguia'] = $this->input->post('observacion_guia');
        $parametros['@itemguia'] = $this->input->post('mtxtitemguia');
        $parametros['@archivo'] = $this->input->post('normaArchivo');
        $parametros['@urlguia'] = $this->input->post('url_guia');
        $parametros['@normaarch'] = $this->input->post('archivoGuia');
        $respuesta = $this->mnormas->guardarguia($parametros);
        echo json_encode($respuesta);
                        
	}
	
	public function delete_guia(){
					
		$parametros['@idguia'] = $this->input->post('id_guia');
		$respuesta = $this->mnormas->delete_guia($parametros);
		echo json_encode($respuesta);									
	}

	public function subirArchivoguia(){

		$config['upload_path'] = 'FTPfileserver/Archivos/Normas/';
		$config['allowed_types'] = 'pdf|xlsx|docx|doc|xls';
		$config['max_size'] = '60048';
		$this->load->library('upload',$config);
		$this->upload->initialize($config);
		if (!$this->upload->do_upload('mtxtguianormarch')) {
			$data['uploadError'] = $this->upload->display_errors();
			$error = '';
			return $error;
			 
		} else {

			 $data = $this->upload->data();

			 $path = array(
					 $prueba1 = $data['file_name'],
					 $prueba2 = $config['upload_path'],
			 );
			 echo json_encode($path);

		}
	}


}