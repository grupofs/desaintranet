<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Ctramites extends CI_Controller {
	function __construct() {
		parent:: __construct();	
		$this->load->model('pt/mtramites');
		$this->load->model('mglobales');
		$this->load->library('encryption');
		$this->load->helper(array('form','url','download','html','file'));
		$this->load->library('form_validation');
    }
    
   /** TRAMITES **/ 	
    public function gettipotramite() {	// Visualizar tipo de tramite en CBO		
        
		$resultado = $this->mtramites->gettipotramite();
		echo json_encode($resultado);
    }	
    public function getclieproptram() {	// Visualizar Clientes con propuestas tramite en CBO	
        
		$resultado = $this->mtramites->getclieproptram();
		echo json_encode($resultado);
    }
    public function getbuscartramites() {	// Recupera Listado de Propuestas	
        
		$varnull 			= 	'';
		$celtramite 		= 	'';

		$ccliente   = $this->input->post('ccliente');
		$fini       = $this->input->post('fdesde');
		$ffin       = $this->input->post('fhasta');
		$ctipotram  = $this->input->post('idtipotram');
		$dnropropu    = $this->input->post('dnropropu');

        if(isset($ctipotram)){
            foreach($ctipotram as $dtipotram){
                $celtramite = $dtipotram.','.$celtramite;
            }
            $count =strlen($celtramite) ;
            $celtramite = substr($celtramite,0,$count-1);
        }
            
        $parametros = array(
			'@ccliente'         => ($this->input->post('ccliente') == '') ? '0' : $ccliente,
			'@fini'             => ($this->input->post('fdesde') == '%') ? NULL : substr($fini, 6, 4).'-'.substr($fini,3 , 2).'-'.substr($fini, 0, 2),
			'@ffin'             => ($this->input->post('fhasta') == '%') ? NULL : substr($ffin, 6, 4).'-'.substr($ffin,3 , 2).'-'.substr($ffin, 0, 2),
			'@idtipotram'       => ($celtramite == $varnull) ? '%' :$celtramite,
			'@nropropu'         => ($this->input->post('dnropropu') == $varnull) ? '%' : "%".$dnropropu."%"
		);		
		$resultado = $this->mtramites->getbuscartramites($parametros);
		echo json_encode($resultado);
	}
    public function getproputram() {	// Visualizar NRO propuestas a tramitar en CBO	
		
		$parametros = array(
            '@IDCLIE'   => $this->input->post('ccliente')
        );
		$resultado = $this->mtramites->getproputram($parametros);
		echo json_encode($resultado);
	}	
    public function getpropuclie() {	// Visualizar NRO propuestas a tramitar en CBO	
		
		$parametros = array(
            '@IDCLIE'   => $this->input->post('ccliente')
        );
		$resultado = $this->mtramites->getpropuclie($parametros);
		echo json_encode($resultado);
	}	
    public function settramite() {	// Registrar tramite PT        
        $varnull = '';
		
		$ftram = $this->input->post('mtxtFtram');
        $parametros = array(
            '@idpttramite'   	=>  $this->input->post('mhdnIdTram'),
            '@id_tipotramite'   =>  $this->input->post('mcboTipotram'),
            '@idptpropuesta'    =>  $this->input->post('mcboNropropu'),
            '@fecha_tramite'    =>  substr($ftram, 6, 4).'-'.substr($ftram,3 , 2).'-'.substr($ftram, 0, 2),
            '@idresponsable'    =>  $this->input->post('mcboRespon'),
            '@codigo'           =>  $this->input->post('mtxtCodigo'),
            '@nombproducto'     =>  $this->input->post('mtxtNombprod'),
            '@descripcion'      =>  $this->input->post('mtxtDescrip'),
            '@comentarios'      =>  $this->input->post('mtxtComentario'),
            '@accion'           =>  $this->input->post('mhdnAccionTram')
        );
        $retorna = $this->mtramites->settramite($parametros);
        echo json_encode($retorna);
    }	

	public function subirArchivo() {	// Subir Acrhivo 
        $CCLIE      = $this->input->post('mcboClienprop');
        $TRAM       = $this->input->post('mcboTipotram');
        $IDTRAM     = $this->input->post('mhdnIdTram');
        $ANIO       = substr($this->input->post('mtxtFtram'),-4);
        
        $RUTAARCH   = 'FTPfileserver/Archivos/10203/'.$ANIO.'/'.$CCLIE.'/';

        !is_dir($RUTAARCH) && @mkdir($RUTAARCH, 0777, true);
        
        if($TRAM == 1){
            $iniTram = 'REG-FFRN';
        }elseif($TRAM == 2){
            $iniTram = 'REG-FCE';
        }elseif($TRAM == 3){
            $iniTram = 'REG-SID';
        }elseif($TRAM == 4){
            $iniTram = 'REM-ALER-IMP';
        }

        $NOMBARCH = $iniTram.$CCLIE.substr('0000'.$IDTRAM, -4).$ANIO.'PTFS';

		//RUTA DONDE SE GUARDAN LOS FICHEROS
		$config['upload_path'] 		= $RUTAARCH;
		$config['allowed_types'] 	= 'pdf|xlsx|docx|xls|doc';
		$config['max_size'] 		= '60048';
		$config['overwrite'] 		= TRUE;
		$config['file_name']        = $NOMBARCH;
		
		$this->load->library('upload',$config);
		$this->upload->initialize($config);
		
		if (!($this->upload->do_upload('mtxtArchivotram'))) {
			//si al subirse hay algun error 
			$data['uploadError'] = $this->upload->display_errors();
			$error = '';
			return $error;					
		}else{
			$data = $this->upload->data();
			$parametros = array(
                '@idpttramite'   	=>  $IDTRAM,
                '@adj_docum'        =>  $data['file_name'],
                '@ruta_docum'       =>  $config['upload_path'],
				'@nomb_docum'   	=>  $this->input->post('mtxtNombarch'),
            );
            $retorna = $this->mtramites->subirArchivo($parametros);
            echo json_encode($retorna);
		}	
	}

	public function subirCarta() {	// Subir Carta
        $CCLIE      = $this->input->post('mcboClienprop');
        $TRAM       = $this->input->post('mcboTipotram');
        $IDTRAM     = $this->input->post('mhdnIdTram');
        $ANIO       = substr($this->input->post('mtxtFtram'),-4);
        
        $RUTAARCH   = 'FTPfileserver/Archivos/10203/'.$ANIO.'/'.$CCLIE.'/';

        !is_dir($RUTAARCH) && @mkdir($RUTAARCH, 0777, true);
        
        if($TRAM == 1){
            $iniTram = 'REG-FFRN';
        }elseif($TRAM == 2){
            $iniTram = 'REG-FCE';
        }elseif($TRAM == 3){
            $iniTram = 'REG-SID';
        }elseif($TRAM == 4){
            $iniTram = 'REM-ALER-IMP';
        }

        $NOMBARCH = $iniTram.$CCLIE.substr('0000'.$IDTRAM, -4).$ANIO.'Carta-PTFS';

		//RUTA DONDE SE GUARDAN LOS FICHEROS
		$config['upload_path'] 		= $RUTAARCH;
		$config['allowed_types'] 	= 'pdf|xlsx|docx|xls|doc';
		$config['max_size'] 		= '60048';
		$config['overwrite'] 		= TRUE;
		$config['file_name']        = $NOMBARCH;
		
		$this->load->library('upload',$config);
		$this->upload->initialize($config);
		
		if (!($this->upload->do_upload('mtxtCartatram'))) {
			//si al subirse hay algun error 
			$data['uploadError'] = $this->upload->display_errors();
			$error = '';
			return $error;					
		}else{
			$data = $this->upload->data();
			$parametros = array(
                '@idpttramite'   	=>  $IDTRAM,
                '@adj_carta'        =>  $data['file_name'],
                '@ruta_carta'       =>  $config['upload_path'],
				'@nomb_carta'   	=>  $this->input->post('mtxtNombcarta'),
            );
            $retorna = $this->mtramites->subirCarta($parametros);
            echo json_encode($retorna);
		}	
    }
    	        
	public function getbuscaradjuntos() {	// Recupera Listado de Documentos Propuestas		

		$parametros = array(
			'@idpttramite' =>  $this->input->post('idpttramite')
		);		
		$resultado = $this->mtramites->getbuscaradjuntos($parametros);
		echo json_encode($resultado);
    }
    
	public function subirTramadj() {	// Subir Archivos adjuntos varios
        $ANIO           = substr($this->input->post('mtxtfechaadjtram'),-4); 
        $NROPROPU       = $this->input->post('mtxtidpttramite');
        $NOMBARCH 	    = substr('000'.($NROPROPU), -3).'PTFS';
		$RUTAARCH       = 'FTPfileserver/Archivos/10203/VARIOS/'.$ANIO.'/';

        !is_dir($RUTAARCH) && @mkdir($RUTAARCH, 0777, true);
        
		$data = array();
		$cpt = count($_FILES['mtxtTramAdj']['name']);

		for($i=0; $i<$cpt; $i++)
		{
			$_FILES['userFile']['name']= $_FILES['mtxtTramAdj']['name'][$i];
			$_FILES['userFile']['type']= $_FILES['mtxtTramAdj']['type'][$i];
			$_FILES['userFile']['tmp_name']= $_FILES['mtxtTramAdj']['tmp_name'][$i];
			$_FILES['userFile']['error']= $_FILES['mtxtTramAdj']['error'][$i];
			$_FILES['userFile']['size']= $_FILES['mtxtTramAdj']['size'][$i]; 

			//RUTA DONDE SE GUARDAN LOS FICHEROS
			$config['upload_path']      = $RUTAARCH;
			$config['allowed_types']    = 'pdf|xlsx|docx|xls|doc';
			$config['max_size']         = '60048';
            $config['remove_spaces']    = FALSE;
            $config['overwrite'] 		= TRUE;
            $config['file_name']        = 'adj'.$i.'-'.$NOMBARCH;
            
			
			$this->load->library('upload',$config);
			$this->upload->initialize($config);

			if ($this->upload->do_upload('userFile')) {
				$fileData =  $this->upload->data(); 
				$data = array("upload_data" => $this->upload->data());
				$datos = array(
                    "@idpttramite"  => $_POST['mtxtidpttramite'],
					"@ruta_adj"     => $RUTAARCH,
					"@nomb_adj"     => $data['upload_data']['file_name'],
					"@desc_adj" 	=> $data['upload_data']['client_name']
				);

				if ($this->mtramites->guardar_multiadj($datos)) {
					//echo "Registro guardado";
					$info[$i] = array(
						"archivo" => $data['upload_data']['file_name'],
						"mensaje" => "Archivo subido y guardado"
					);
				}
				else{
					//echo "Error al intentar guardar la informacion";
					$info[$i] = array(
						"archivo" => $data['upload_data']['file_name'],
						"mensaje" => "Archivo subido pero no guardado "
					);
				}				
			}else{
				$info[$i] = array(
					"archivo" => $_FILES['userFile']['name'],
					"mensaje" => "Archivo no subido ni guardado"
				);
			}	
		}

		$envio = "";
		foreach ($info as $key) {
			$envio .= "Archivo : ".$key['archivo']." - ".$key["mensaje"]."\n";
		}
		echo json_encode($envio);
	}

	public function deldetadj(){ // Eliminar detalle propuesta				
		$id_tramiteadj = $this->input->post('id_tramiteadj');
		$respuesta = $this->mtramites->deldetadj($id_tramiteadj);
		echo json_encode($respuesta);									
	}
}
?>