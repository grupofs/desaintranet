<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Cperfilusuario extends CI_Controller { 
	function __construct()
	{
		parent:: __construct();	
		$this->load->model('mperfilusuario');
	}

	public function getdatospersonales() { // Recuperar datos personales
		
		$parametros = array(
            '@idadministrado'   => $this->input->post('idadministrado')
        );
		$resultado = $this->mperfilusuario->getdatospersonales($parametros);
		echo json_encode($resultado);
    }
	public function imagen_perfil() {	// Subir Imagen Perfil

		$newfilename = $this->input->post('hdnCusuario');

		$config['upload_path'] 		= 'FTPfileserver/Imagenes/user';
		$config['allowed_types'] 	= 'gif|jpg|png|jpeg';
		$config['max_size'] 		= '60048';
		$config['overwrite'] 		= TRUE;
		$config['file_name']        = $newfilename;
		$config["width"]    		= 215;
		$config["height"]   		= 215;

		$this->load->library('upload',$config);
		$this->upload->initialize($config);

		if (!($this->upload->do_upload('file-input'))) {
			//si al subirse hay algun error 
			$data['uploadError'] = $this->upload->display_errors();
			$error = '';
			return $error;					
		}else{			
			
			$data = $this->upload->data();
			$datos = array(
				"id_usuario" => $_POST['hdnIdusu'],
				"ruta_imagen" => $data['file_name']
			);
			//Image Resizing 
			$config_img['image_library'] = 'gd2';
			$config_img['source_image'] = 'FTPfileserver/Imagenes/user/'.$data['file_name'];
			$config_img['new_image'] =  'FTPfileserver/Imagenes/user/'.$data['file_name'];
			$config_img['maintain_ratio'] = FALSE;
			$config_img['width'] = 215;
			$config_img['height'] = 215; 

			$this->load->library('image_lib', $config_img); 
			if ( ! $this->image_lib->resize()){				
				//si al cambiar tamaño hay algun error 
				$data['uploadError'] = $this->image_lib->display_errors();
				$error = '';
				return $error;	
			}else{
				if ($this->mperfilusuario->setimagen_perfil($datos)) {				
					$path = array(
						$nombreArch = $data['file_name'],
						$rutaArch = $config['upload_path'],
						$estado = '1',
					);
				}else{
					$path = array(
						$estado = '0',
					);
				}
			}
			echo json_encode($path);
		}	
	}
	public function setperfil() { // Registrar Datos del Perfil
		
        $parametros = array(
            '@id_administrado'   	=>  $this->input->post('hdnIdadm'),
			'@nroDoc'   			=>  $this->input->post('txtNrodoc'),
			'@paterno'   			=>  $this->input->post('txtapepatperfil'),
			'@materno'   			=>  $this->input->post('txtapematperfil'),
			'@nombres'   			=>  $this->input->post('txtnombperfil'),
			'@celular'   			=>  $this->input->post('txtcelperfil'),
			'@email'   				=>  $this->input->post('txtemailperfil'),
			'@direccion'   			=>  $this->input->post('txtdirperfil'),
			'@fono_fijo'   			=>  $this->input->post('txtfonoperfil'),
			'@tipoDoc'   			=>  $this->input->post('txtTipodoc'),
		);
        $retorna = $this->mperfilusuario->setperfil($parametros);
        echo json_encode($retorna);		
    }
}
?>