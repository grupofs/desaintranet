<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Cexpired extends CI_Controller { 
	function __construct()
	{
		parent:: __construct();	
		$this->load->library('session');		
    }

    public function session_expired($cia = "") { // Restablecer Cuenta Bloqueada
		$data = array();
		$data["ccia"] = $cia;
		$data['idusuario'] = $this-> session-> userdata('s_idusuario');
		$data['dmail'] = $this-> session-> userdata('s_dmail');
		$data['ruta'] = $this-> session-> userdata('s_druta');
		$data['usuario'] = $this-> session-> userdata('s_usuario');
		$data['nombre'] = $this-> session-> userdata('s_nombre');

		if ($cia  == 'fs' or $cia  == 'fsc') :
			$this->load->view("seguridad/vexpired", $data);
		else:
			$this->load->view('welcome_message');
		endif;		
	}
    
	public function validarAcceso(){ // Valida el tiempo de expiracion de session
		$parametros = array(
			'@USUARIO' =>  $this->input->post('hdusuario'),
			'@CIA' =>  $this->input->post('hdcia')
		);
        $this->load->model('mlogin');
        
		$respuesta = $this->mlogin->validarpass($parametros);
		if ($respuesta != 1) {				
			$retorno = array(
				'respuesta' =>  "Debe de ingresar bien su contraseña actual.",
				'valor' 	=>   0
			);
			echo json_encode($retorno);		
		}else{		
			$retorno = array(
				'valor' 	=>   1
			);
			echo json_encode($retorno);	
		}
	}

}
?>