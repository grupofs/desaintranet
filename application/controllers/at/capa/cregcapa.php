<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Cregcapa extends CI_Controller {
	function __construct() {
		parent:: __construct();	
		$this->load->model('at/capa/mregcapa');
		$this->load->model('mglobales');
		$this->load->library('encryption');
		$this->load->helper(array('form','url','download','html','file'));
		$this->load->library('form_validation');
    }
    
   /** CAPACITACIONES **/ 
    public function getclientecapa() {	// Visualizar Clientes con propuestas en CBO	
        
		$resultado = $this->mregcapa->getclientecapa();
		echo json_encode($resultado);
	}	
    public function getcursocapa() {	// Visualizar Clientes con propuestas en CBO	
        
		$resultado = $this->mregcapa->getcursocapa();
		echo json_encode($resultado);
	}	
    public function getexpositorcapa() {	// Visualizar Clientes con propuestas en CBO	
        
		$resultado = $this->mregcapa->getexpositorcapa();
		echo json_encode($resultado);
	}	
    public function getclienteinternoat() {	// Visualizar Clientes con propuestas en CBO	
        
		$resultado = $this->mregcapa->getclienteinternoat();
		echo json_encode($resultado);
	}
    public function buscar_establexcliente() {	// Obtener numero de propuesta	
        $parametros = array(
            '@CCLIENTE'   => $this->input->post('ccliente')
        );
		$resultado = $this->mregcapa->buscar_establexcliente($parametros);
		echo json_encode($resultado);
	}
    public function getbuscarcapa() {	// Recupera Listado de Propuestas	
        
		$varnull 			= 	'';

		$ccliente   = $this->input->post('ccliente');
		$fini       = $this->input->post('fdesde');
		$ffin       = $this->input->post('fhasta');
		$idcurso  = $this->input->post('idcurso');
		$idexpositor    = $this->input->post('idexpositor');
            
        $parametros = array(
			'@ccliente'     => ($this->input->post('ccliente') == '') ? '0' : $ccliente,
			'@fini'         => ($this->input->post('fdesde') == '%') ? NULL : substr($fini, 6, 4).'-'.substr($fini,3 , 2).'-'.substr($fini, 0, 2),
			'@ffin'         => ($this->input->post('fhasta') == '%') ? NULL : substr($ffin, 6, 4).'-'.substr($ffin,3 , 2).'-'.substr($ffin, 0, 2),
			'@idcurso'    	=> $idcurso,
			'@idexpositor'	=> $idexpositor,
		);		
		$resultado = $this->mregcapa->getbuscarcapa($parametros);
		echo json_encode($resultado);
	}
    public function setcapa() { // Registrar informe PT
		$varnull = '';
		
		$id_capa 			= $this->input->post('mtxtidcapa');
		$ccliente 			= $this->input->post('cboregClie');
		$cestablecimiento 	= $this->input->post('cboregEstab');
		$comentarios 		= $this->input->post('mtxtComentarios');
		$finicio 		= $this->input->post('mtxtFinicio');
		$ffin 			= $this->input->post('mtxtFfin');
		$accion 			= $this->input->post('hdnAccionregcapa');
        
        $parametros = array(
            '@id_capa'   			=>  $id_capa,
            '@ccliente'   			=>  $ccliente,
            '@cestablecimiento'     =>  ($cestablecimiento == $varnull || $cestablecimiento == '%') ? '000000' : $this->input->post('cboregEstab'),
            '@fini'					=>  substr($finicio, 6, 4).'-'.substr($finicio,3 , 2).'-'.substr($finicio, 0, 2),
            '@ffin'					=>  substr($ffin, 6, 4).'-'.substr($ffin,3 , 2).'-'.substr($ffin, 0, 2),
            '@comentarios'      	=>  $comentarios,
            '@accion'           	=>  $accion
        );
        $retorna = $this->mregcapa->setcapa($parametros);
        echo json_encode($retorna);		
	}
    public function gettemaxcurso() {	// Obtener numero de propuesta	
        $parametros = array(
            '@id_capacurso'   => $this->input->post('idcurso')
        );
		$resultado = $this->mregcapa->gettemaxcurso($parametros);
		echo json_encode($resultado);
	}
    public function setcapadet() { // Registrar informe PT
		$varnull = '';
		
		$id_capa 		= $this->input->post('mhdnIdCapa');
		$id_capadet 	= $this->input->post('mhdnIdCapaDet');
		$id_capacurso 	= $this->input->post('mcboCurso');
		$id_capamodulo 	= $this->input->post('mcboTema');
		$accion 		= $this->input->post('mhdnAccionCapa');
        
        $parametros = array(
            '@id_capa'   		=>  $id_capa,
            '@id_capadet'		=>  $id_capadet,
            '@id_capacurso'     =>  $id_capacurso,
            '@id_capamodulo'	=>  $id_capamodulo,
            '@accion'			=>  $accion
        );
        $retorna = $this->mregcapa->setcapadet($parametros);
        echo json_encode($retorna);		
	}
	public function subirPresent() {	// Subir Acrhivo 
        $IDCAPADET  = $this->input->post('mhdnIdCapaDet');
        $CCLIENTE	= $this->input->post('mhdnIdCliente');
        $ANIO       = substr($this->input->post('mtxtFinicio'),-4);
        $NOMBARCH 	= 'PRESE'.$ANIO.$CCLIENTE.substr('000'.($IDCAPADET), -3).'ATFS';
        
        $RUTAARCH   = 'FTPfileserver/Archivos/10104/'.$ANIO.'/'.$CCLIENTE.'/';

        !is_dir($RUTAARCH) && @mkdir($RUTAARCH, 0777, true);

		//RUTA DONDE SE GUARDAN LOS FICHEROS
		$config['upload_path'] 		= $RUTAARCH;
		$config['allowed_types'] 	= 'pdf|xlsx|docx|xls|doc';
		$config['max_size'] 		= '60048';
		$config['overwrite'] 		= TRUE;
		$config['file_name']        = $NOMBARCH;
		
		$this->load->library('upload',$config);
		$this->upload->initialize($config);
		
		if (!($this->upload->do_upload('mtxtArchivopresent'))) {
			//si al subirse hay algun error 
			$data['uploadError'] = $this->upload->display_errors();
			$error = '';
			return $error;					
		}else{
			$data = $this->upload->data();
			$parametros = array(
                '@id_capadet'   		=>  $IDCAPADET,
                '@ruta_presentacion'    =>  $config['upload_path'].$data['file_name'],
                '@nomb_presentacion'   	=>  $this->input->post('mtxtNomarchpresent'),
            );
            $retorna = $this->mregcapa->subirPresent($parametros);
            echo json_encode($retorna);
		}	
	}
	public function subirTaller() {	// Subir Acrhivo 
        $IDCAPADET  = $this->input->post('mhdnIdCapaDet');
        $CCLIENTE	= $this->input->post('mhdnIdCliente');
        $ANIO       = substr($this->input->post('mtxtFinicio'),-4);
        $NOMBARCH 	= 'TALLE'.$ANIO.$CCLIENTE.substr('000'.($IDCAPADET), -3).'ATFS';
        
        $RUTAARCH   = 'FTPfileserver/Archivos/10104/'.$ANIO.'/'.$CCLIENTE.'/';

        !is_dir($RUTAARCH) && @mkdir($RUTAARCH, 0777, true);

		//RUTA DONDE SE GUARDAN LOS FICHEROS
		$config['upload_path'] 		= $RUTAARCH;
		$config['allowed_types'] 	= 'pdf|xlsx|docx|xls|doc';
		$config['max_size'] 		= '60048';
		$config['overwrite'] 		= TRUE;
		$config['file_name']        = $NOMBARCH;
		
		$this->load->library('upload',$config);
		$this->upload->initialize($config);
		
		if (!($this->upload->do_upload('mtxtArchivotaller'))) {
			//si al subirse hay algun error 
			$data['uploadError'] = $this->upload->display_errors();
			$error = '';
			return $error;					
		}else{
			$data = $this->upload->data();
			$parametros = array(
                '@id_capadet'   	=>  $IDCAPADET,
                '@ruta_taller'    	=>  $config['upload_path'].$data['file_name'],
                '@nomb_taller'   	=>  $this->input->post('mtxtNomarchtaller'),
            );
            $retorna = $this->mregcapa->subirTaller($parametros);
            echo json_encode($retorna);
		}	
	}
	public function subirExamen() {	// Subir Acrhivo 
        $IDCAPADET  = $this->input->post('mhdnIdCapaDet');
        $CCLIENTE	= $this->input->post('mhdnIdCliente');
        $ANIO       = substr($this->input->post('mtxtFinicio'),-4);
        $NOMBARCH 	= 'EXAME'.$ANIO.$CCLIENTE.substr('000'.($IDCAPADET), -3).'ATFS';
        
        $RUTAARCH   = 'FTPfileserver/Archivos/10104/'.$ANIO.'/'.$CCLIENTE.'/';

        !is_dir($RUTAARCH) && @mkdir($RUTAARCH, 0777, true);

		//RUTA DONDE SE GUARDAN LOS FICHEROS
		$config['upload_path'] 		= $RUTAARCH;
		$config['allowed_types'] 	= 'pdf|xlsx|docx|xls|doc';
		$config['max_size'] 		= '60048';
		$config['overwrite'] 		= TRUE;
		$config['file_name']        = $NOMBARCH;
		
		$this->load->library('upload',$config);
		$this->upload->initialize($config);
		
		if (!($this->upload->do_upload('mtxtArchivoexamen'))) {
			//si al subirse hay algun error 
			$data['uploadError'] = $this->upload->display_errors();
			$error = '';
			return $error;					
		}else{
			$data = $this->upload->data();
			$parametros = array(
                '@id_capadet'   	=>  $IDCAPADET,
                '@ruta_examen'    	=>  $config['upload_path'].$data['file_name'],
                '@nomb_examen'   	=>  $this->input->post('mtxtNomarchexamen'),
            );
            $retorna = $this->mregcapa->subirExamen($parametros);
            echo json_encode($retorna);
		}	
	}
	public function subirLista() {	// Subir Acrhivo 
        $IDCAPADET  = $this->input->post('mhdnIdCapaDet');
        $CCLIENTE	= $this->input->post('mhdnIdCliente');
        $ANIO       = substr($this->input->post('mtxtFinicio'),-4);
        $NOMBARCH 	= 'LISTA'.$ANIO.$CCLIENTE.substr('000'.($IDCAPADET), -3).'ATFS';
        
        $RUTAARCH   = 'FTPfileserver/Archivos/10104/'.$ANIO.'/'.$CCLIENTE.'/';

        !is_dir($RUTAARCH) && @mkdir($RUTAARCH, 0777, true);

		//RUTA DONDE SE GUARDAN LOS FICHEROS
		$config['upload_path'] 		= $RUTAARCH;
		$config['allowed_types'] 	= 'pdf|xlsx|docx|xls|doc';
		$config['max_size'] 		= '60048';
		$config['overwrite'] 		= TRUE;
		$config['file_name']        = $NOMBARCH;
		
		$this->load->library('upload',$config);
		$this->upload->initialize($config);
		
		if (!($this->upload->do_upload('mtxtArchivolista'))) {
			//si al subirse hay algun error 
			$data['uploadError'] = $this->upload->display_errors();
			$error = '';
			return $error;					
		}else{
			$data = $this->upload->data();
			$parametros = array(
                '@id_capadet'   	=>  $IDCAPADET,
                '@ruta_lista'    	=>  $config['upload_path'].$data['file_name'],
                '@nomb_lista'   	=>  $this->input->post('mtxtNomarchlista'),
            );
            $retorna = $this->mregcapa->subirLista($parametros);
            echo json_encode($retorna);
		}	
	}
	public function subirCerti() {	// Subir Acrhivo 
        $IDCAPADET  = $this->input->post('mhdnIdCapaDet');
        $CCLIENTE	= $this->input->post('mhdnIdCliente');
        $ANIO       = substr($this->input->post('mtxtFinicio'),-4);
        $NOMBARCH 	= 'CERTI'.$ANIO.$CCLIENTE.substr('000'.($IDCAPADET), -3).'ATFS';
        
        $RUTAARCH   = 'FTPfileserver/Archivos/10104/'.$ANIO.'/'.$CCLIENTE.'/';

        !is_dir($RUTAARCH) && @mkdir($RUTAARCH, 0777, true);

		//RUTA DONDE SE GUARDAN LOS FICHEROS
		$config['upload_path'] 		= $RUTAARCH;
		$config['allowed_types'] 	= 'pdf|xlsx|docx|xls|doc';
		$config['max_size'] 		= '60048';
		$config['overwrite'] 		= TRUE;
		$config['file_name']        = $NOMBARCH;
		
		$this->load->library('upload',$config);
		$this->upload->initialize($config);
		
		if (!($this->upload->do_upload('mtxtArchivocerti'))) {
			//si al subirse hay algun error 
			$data['uploadError'] = $this->upload->display_errors();
			$error = '';
			return $error;					
		}else{
			$data = $this->upload->data();
			$parametros = array(
                '@id_capadet'   	=>  $IDCAPADET,
                '@ruta_certi'    	=>  $config['upload_path'].$data['file_name'],
                '@nomb_certi'   	=>  $this->input->post('mtxtNomarchcerti'),
            );
            $retorna = $this->mregcapa->subirCerti($parametros);
            echo json_encode($retorna);
		}	
	}
    public function getlistcapadet() {	// Recupera Listado de Propuestas	
        
		$varnull 			= 	'';

		$id_capa   = $this->input->post('id_capa');
            
        $parametros = array(
			'@id_capa'     => $id_capa,
		);		
		$resultado = $this->mregcapa->getlistcapadet($parametros);
		echo json_encode($resultado);
	}
    public function setprograma() { // Registrar informe PT
		$varnull = '';
		
		$id_capa 			= $this->input->post('mhdnIdCapap');
		$id_capadet 		= $this->input->post('mhdnIdCapaDetp');
		$id_capaprogra 		= $this->input->post('mhdnIdcapaprogra');
		$id_capaexpo 		= $this->input->post('mcboCapaexpo');
		$fecha_capa 		= $this->input->post('mtxtFprogra');
		$hora_inicapa 		= $this->input->post('mtxtHoraini');
		$hora_fincapa 		= $this->input->post('mtxtHorafin');
		$accion 			= $this->input->post('mhdnAccionprogr');
        
        $parametros = array(
            '@id_capa'   		=>  $id_capa,
            '@id_capadet'		=>  $id_capadet,
            '@id_capaprogra'    =>  $id_capaprogra,
            '@id_capaexpo'		=>  $id_capaexpo,
            '@fecha_capa'		=>  substr($fecha_capa, 6, 4).'-'.substr($fecha_capa,3 , 2).'-'.substr($fecha_capa, 0, 2),
            '@hora_inicapa'		=>  $hora_inicapa,
            '@hora_fincapa'		=>  $hora_fincapa,
            '@accion'			=>  $accion
        );
        $retorna = $this->mregcapa->setprograma($parametros);
        echo json_encode($retorna);		
	}
    public function getlistprograma() {	// Recupera Listado de Propuestas	
        
		$varnull 			= 	'';

		$id_capadet   = $this->input->post('id_capadet');
            
        $parametros = array(
			'@id_capadet'     => $id_capadet,
		);		
		$resultado = $this->mregcapa->getlistprograma($parametros);
		echo json_encode($resultado);
	}
	public function delcapadet(){ // Eliminar detalle propuesta				
		$id_capadet = $this->input->post('id_capadet');
		$parametros = array(
			'@id_capadet'     => $id_capadet,
		);
		$respuesta = $this->mregcapa->delcapadet($parametros);
		echo json_encode($respuesta);									
	}
	public function delprogram(){ // Eliminar programa				
		$id_capaprogra = $this->input->post('id_capaprogra');
		$parametros = array(
			'@id_capaprogra'     => $id_capaprogra,
		);
		$respuesta = $this->mregcapa->delprogram($parametros);
		echo json_encode($respuesta);									
	}
	public function adjPresent() {	// Subir Acrhivo 
        $IDCAPADET  = $this->input->post('mhdnIdCapaDetpresent');
        $CCLIENTE	= $this->input->post('mhdncclientepresent');
        $ANIO       = substr($this->input->post('mhdnfinipresent'),-4);
        $NOMBARCH 	= 'PRESE'.$ANIO.$CCLIENTE.substr('000'.($IDCAPADET), -3).'ATFS';
        
        $RUTAARCH   = 'FTPfileserver/Archivos/10104/'.$ANIO.'/'.$CCLIENTE.'/';

        !is_dir($RUTAARCH) && @mkdir($RUTAARCH, 0777, true);

		//RUTA DONDE SE GUARDAN LOS FICHEROS
		$config['upload_path'] 		= $RUTAARCH;
		$config['allowed_types'] 	= 'pdf|xlsx|docx|xls|doc';
		$config['max_size'] 		= '60048';
		$config['overwrite'] 		= TRUE;
		$config['file_name']        = $NOMBARCH;
		
		$this->load->library('upload',$config);
		$this->upload->initialize($config);
		
		if (!($this->upload->do_upload('stxtArchivopresent'))) {
			//si al subirse hay algun error 
			$data['uploadError'] = $this->upload->display_errors();
			$error = '';
			return $error;					
		}else{
			$data = $this->upload->data();
			$parametros = array(
                '@id_capadet'   		=>  $IDCAPADET,
                '@ruta_presentacion'    =>  $config['upload_path'].$data['file_name'],
                '@nomb_presentacion'   	=>  $this->input->post('stxtNomarchpresent'),
            );
            $retorna = $this->mregcapa->subirPresent($parametros);
            echo json_encode($retorna);
		}	
	}
	public function adjTaller() {	// Subir Acrhivo 
        $IDCAPADET  = $this->input->post('mhdnIdCapaDettaller');
        $CCLIENTE	= $this->input->post('mhdncclientetaller');
        $ANIO       = substr($this->input->post('mhdnfinitaller'),-4);
        $NOMBARCH 	= 'TALLE'.$ANIO.$CCLIENTE.substr('000'.($IDCAPADET), -3).'ATFS';
        
        $RUTAARCH   = 'FTPfileserver/Archivos/10104/'.$ANIO.'/'.$CCLIENTE.'/';

        !is_dir($RUTAARCH) && @mkdir($RUTAARCH, 0777, true);

		//RUTA DONDE SE GUARDAN LOS FICHEROS
		$config['upload_path'] 		= $RUTAARCH;
		$config['allowed_types'] 	= 'pdf|xlsx|docx|xls|doc';
		$config['max_size'] 		= '60048';
		$config['overwrite'] 		= TRUE;
		$config['file_name']        = $NOMBARCH;
		
		$this->load->library('upload',$config);
		$this->upload->initialize($config);
		
		if (!($this->upload->do_upload('stxtArchivotaller'))) {
			//si al subirse hay algun error 
			$data['uploadError'] = $this->upload->display_errors();
			$error = '';
			return $error;					
		}else{
			$data = $this->upload->data();
			$parametros = array(
                '@id_capadet'   	=>  $IDCAPADET,
                '@ruta_taller'    	=>  $config['upload_path'].$data['file_name'],
                '@nomb_taller'   	=>  $this->input->post('stxtNomarchtaller'),
            );
            $retorna = $this->mregcapa->subirTaller($parametros);
            echo json_encode($retorna);
		}	
	}
	public function adjExamen() {	// Subir Acrhivo 
        $IDCAPADET  = $this->input->post('mhdnIdCapaDetexamen');
        $CCLIENTE	= $this->input->post('mhdncclienteexamen');
        $ANIO       = substr($this->input->post('mhdnfiniexamen'),-4);
        $NOMBARCH 	= 'EXAME'.$ANIO.$CCLIENTE.substr('000'.($IDCAPADET), -3).'ATFS';
        
        $RUTAARCH   = 'FTPfileserver/Archivos/10104/'.$ANIO.'/'.$CCLIENTE.'/';

        !is_dir($RUTAARCH) && @mkdir($RUTAARCH, 0777, true);

		//RUTA DONDE SE GUARDAN LOS FICHEROS
		$config['upload_path'] 		= $RUTAARCH;
		$config['allowed_types'] 	= 'pdf|xlsx|docx|xls|doc';
		$config['max_size'] 		= '60048';
		$config['overwrite'] 		= TRUE;
		$config['file_name']        = $NOMBARCH;
		
		$this->load->library('upload',$config);
		$this->upload->initialize($config);
		
		if (!($this->upload->do_upload('stxtArchivoexamen'))) {
			//si al subirse hay algun error 
			$data['uploadError'] = $this->upload->display_errors();
			$error = '';
			return $error;					
		}else{
			$data = $this->upload->data();
			$parametros = array(
                '@id_capadet'   	=>  $IDCAPADET,
                '@ruta_examen'    	=>  $config['upload_path'].$data['file_name'],
                '@nomb_examen'   	=>  $this->input->post('stxtNomarchexamen'),
            );
            $retorna = $this->mregcapa->subirExamen($parametros);
            echo json_encode($retorna);
		}	
	}
	public function adjLista() {	// Subir Acrhivo 
        $IDCAPADET  = $this->input->post('mhdnIdCapaDetlista');
        $CCLIENTE	= $this->input->post('mhdncclientelista');
        $ANIO       = substr($this->input->post('mhdnfinilista'),-4);
        $NOMBARCH 	= 'LISTA'.$ANIO.$CCLIENTE.substr('000'.($IDCAPADET), -3).'ATFS';
        
        $RUTAARCH   = 'FTPfileserver/Archivos/10104/'.$ANIO.'/'.$CCLIENTE.'/';

        !is_dir($RUTAARCH) && @mkdir($RUTAARCH, 0777, true);

		//RUTA DONDE SE GUARDAN LOS FICHEROS
		$config['upload_path'] 		= $RUTAARCH;
		$config['allowed_types'] 	= 'pdf|xlsx|docx|xls|doc';
		$config['max_size'] 		= '60048';
		$config['overwrite'] 		= TRUE;
		$config['file_name']        = $NOMBARCH;
		
		$this->load->library('upload',$config);
		$this->upload->initialize($config);
		
		if (!($this->upload->do_upload('stxtArchivolista'))) {
			//si al subirse hay algun error 
			$data['uploadError'] = $this->upload->display_errors();
			$error = '';
			return $error;					
		}else{
			$data = $this->upload->data();
			$parametros = array(
                '@id_capadet'   	=>  $IDCAPADET,
                '@ruta_lista'    	=>  $config['upload_path'].$data['file_name'],
                '@nomb_lista'   	=>  $this->input->post('stxtNomarchlista'),
            );
            $retorna = $this->mregcapa->subirLista($parametros);
            echo json_encode($retorna);
		}	
	}
	public function adjcerti() {	// Subir Acrhivo 
        $IDCAPADET  = $this->input->post('mhdnIdCapaDetcerti');
        $CCLIENTE	= $this->input->post('mhdncclientecerti');
        $ANIO       = substr($this->input->post('mhdnfinicerti'),-4);
        $NOMBARCH 	= 'CERTI'.$ANIO.$CCLIENTE.substr('000'.($IDCAPADET), -3).'ATFS';
        
        $RUTAARCH   = 'FTPfileserver/Archivos/10104/'.$ANIO.'/'.$CCLIENTE.'/';

        !is_dir($RUTAARCH) && @mkdir($RUTAARCH, 0777, true);

		//RUTA DONDE SE GUARDAN LOS FICHEROS
		$config['upload_path'] 		= $RUTAARCH;
		$config['allowed_types'] 	= 'pdf|xlsx|docx|xls|doc';
		$config['max_size'] 		= '60048';
		$config['overwrite'] 		= TRUE;
		$config['file_name']        = $NOMBARCH;
		
		$this->load->library('upload',$config);
		$this->upload->initialize($config);
		
		if (!($this->upload->do_upload('stxtArchivocerti'))) {
			//si al subirse hay algun error 
			$data['uploadError'] = $this->upload->display_errors();
			$error = '';
			return $error;					
		}else{
			$data = $this->upload->data();
			$parametros = array(
                '@id_capadet'   	=>  $IDCAPADET,
                '@ruta_certi'    	=>  $config['upload_path'].$data['file_name'],
                '@nomb_certi'   	=>  $this->input->post('stxtNomarchcerti'),
            );
            $retorna = $this->mregcapa->subirCerti($parametros);
            echo json_encode($retorna);
		}	
	}
    public function getlistparticipante() {	// Recupera Listado de Propuestas	
        
		$varnull 			= 	'';

		$id_capa   = $this->input->post('id_capa');
            
        $parametros = array(
			'@id_capa'     => $id_capa,
		);		
		$resultado = $this->mregcapa->getlistparticipante($parametros);
		echo json_encode($resultado);
	}

	public function import_parti() {
	
		$config['upload_path'] = 'FTPfileserver/Archivos/Temp/';
		$config['allowed_types'] = 'csv|xlsx|xls';
		$config['max_size'] = '60048';
		
		$this->load->library('upload',$config);
		$this->upload->initialize($config);
		
		if (!$this->upload->do_upload('file')) {
			//si al subirse hay algun error 
			$data['uploadError'] = $this->upload->display_errors();
			$error = '';
			echo $error;
			 
		} else {
			$data = $this->upload->data();
			@chmod($data['full_path'], 0777);

			$this->load->library('Spreadsheet_Excel_Reader');
			$this->spreadsheet_excel_reader->setOutputEncoding('CP1251');

			$this->spreadsheet_excel_reader->read($data['full_path']);
			$sheets = $this->spreadsheet_excel_reader->sheets[0];
			error_reporting(0);
			
			$data_excel = array();
			for ($i = 2; $i <= $sheets['numRows']; $i++) {
				if ($sheets['cells'][$i][1] == '') break;

				$data_excel[$i - 1]['@idmicro']         = null;
				$data_excel[$i - 1]['@fmicro']          = $sheets['cells'][$i][1];
				$data_excel[$i - 1]['@idtienda']        = $sheets['cells'][$i][2];
				$data_excel[$i - 1]['@idareatienda']    = $sheets['cells'][$i][3];
				$data_excel[$i - 1]['@tipo_monitoreo']  = $sheets['cells'][$i][4];
				$data_excel[$i - 1]['@nroconforme']     = $sheets['cells'][$i][5];
				$data_excel[$i - 1]['@nronoconforme']   = $sheets['cells'][$i][6];
				$data_excel[$i - 1]['@parametro']       = $sheets['cells'][$i][7];
				$data_excel[$i - 1]['@condicion']       = $sheets['cells'][$i][8];
				$data_excel[$i - 1]['@accion']         = 'N';

				//$procedure = "call sp_appweb_inspectienda_insertemicro(?,?,?,?,?,?,?,?,?,?)";
				//$query = $this->db-> query($procedure,$data_excel[$i - 1]);
			}
	   
			//redirect('cinsptiendamicro/insptiendamicro');
		}
	}
}
?>