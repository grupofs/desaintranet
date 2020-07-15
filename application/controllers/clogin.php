<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Clogin extends CI_Controller {
	public function __construct(){
		parent:: __construct();	
		$this->load->model('mlogin');
		$this->load->library('encryption');
		$this->load->library('form_validation');
		$this->load->library('session');
		$this->load->helper(array('form','url','download','html','file'));

	}
	
/*****************************/
/** LOGEARSE **/ 
	public function index(){
		$this->load->view('Error403');
	}

	// Vista principal
	public function fs(){		
		$data['cia'] = '1';
		$data['alerta'] = '0';		
		$this->load->view('seguridad/vlogin',$data);		
	}

	public function fsc(){
		$data['cia'] = '2';	
		$data['alerta'] = '0';
		$this->load->view('seguridad/vlogin',$data);		
	}

	public function ext(){
		$data['cia'] = '1';	
		$data['alerta'] = '0';
		$this->load->view('seguridad/vloginext',$data);		
	}

	public function principal(){
		redirect('cprincipal/principal');		
	}

	public function principalClie(){
		redirect('cprincipal/principalClie');		
	}
	
	public function ingresar(){ // Ingresar con usuario y clave
		if (!isset($_SESSION['contadorLogin'])) {
			$_SESSION['contadorLogin'] = 0;
		}		
		
		$ccia = $this->input->post('cia');
		if ($ccia == '1') :
			$cia = 'fs';
		elseif ($ccia == '2') :
			$cia = 'fsc';
		endif;
		
		$parametros = array(
			'@USUARIO' =>  $this->input->post('txtemail'),
			'@CCIA' =>  $this->input->post('cia')
		);

		$respuesta = $this->mlogin->ingresar($parametros);
		$valor = $respuesta['valor'];
			
		if ($valor == 1) { //Acceso Correcto
			$rol = $this->session->userdata('s_idrol');
			$tipousu = $this->session->userdata('s_tipousu');

			if ($tipousu == 'I'):
				$respvalor = 1;
			else:
				$respvalor = 99;
			endif;
			
			$retorno = array(
				'respuesta' =>  "",
				'valor' 	=>  $respvalor
			);			
			echo json_encode($retorno);	

		}else if($valor == -3){ //Acceso restablecer clave bloqueada
			echo json_encode($respuesta);

		}else if($valor == 0){ //Acceso cambio clave
			echo json_encode($respuesta);

		}else if($valor == -2){ //Usuario Incorrecto
			echo json_encode($respuesta);

		}else{ //clave Incorrecta
			if ($_SESSION['contadorLogin']<5): 
				echo json_encode($respuesta);	
				$_SESSION['contadorLogin'] = $_SESSION['contadorLogin'] + 1;

			else:				
				$parametros = array(
					"user_id"			=>	$this-> session-> userdata('s_idusuario'),
					"fecha_bloqueo"		=>	date('Y-m-d H:i:sa'),
					"motivo_bloqueo"	=>	'Agoto las veces de intento para acceder',
					"tipo_acceso"		=>	'B',
				);

				//si el password se ha cambiado correctamente y actualizado los datos para Bloqueo
				if($this->mlogin->changepasw_login($parametros) === TRUE)
				{	
					unset ($_SESSION['contadorLogin']);
					$_SESSION['contadorLogin'] = 0;
											
					$retorno = array(
						'respuesta' =>  "¿Desea Desbloquear Usuario?",
						'valor' 	=>  -3
					);
					echo json_encode($retorno);	
				}				
			endif;
		}

		
	}

	
/*****************************/
/** RECUPERAR PASSWORD **/ 		
	public function change_pass($cia = "") { // Restablecer Cuenta Bloqueada
		$data = array();
		$data["ccia"] = $cia;
		$data['idusuario'] = $this-> session-> userdata('s_idusuario');
		$data['dmail'] = $this-> session-> userdata('s_dmail');
		$data['tipo'] = '2';

		if ($cia  == 'fs' or $cia  == 'fsc') :
			$this->load->view("seguridad/vlogin_changepwd", $data);
		else:
			$this->load->view('welcome_message');
		endif;		
	}
	
	public function changepasw_login() { //procesa el formulario para cambiar el password del usuario	
		$cia = $this->input->post("cia");
		$ccia = $this->input->post("ccia");

		if($this->input->post("tipo") == '2'){
			$parametros = array(
				'@USUARIO' =>  $this-> session -> userdata('s_dmail'),
				'@CIA' =>  $this->input->post('cia')
			);
	
			$respuesta = $this->mlogin->validarpass($parametros);
	
			if ($respuesta != 1) {				
				$retorno = array(
					'respuesta' =>  "Debe de ingresar bien su contraseña actual.",
					'valor' 	=>  -4
				);
				echo json_encode($retorno);		
			}else{
				$this->change_pwd();
			}
		}else{
			$this->change_pwd();
		}				
	}

	private function change_pwd() { // Cambia la contraseña del usuario
		date_default_timezone_set('America/Lima');
		$parametros = array(
			"clave_web"			=>	password_hash($this->input->post("conf_password"),PASSWORD_DEFAULT),
			"user_id"			=>	$this->input->post("idusuario"),
			"fcambiopwd"		=>	date('Y-m-d H:i:sa'),
			"change_clave"		=>	'1',
			"tipo_acceso"		=>	'N',
			"fecha_bloqueo"		=>	null,
			"motivo_bloqueo"	=>	'',
			"token"				=>	$this->token(), //ponemos otro token nuevo,
		);

		//si el password se ha cambiado correctamente y actualizado los datos
		if($this->mlogin->changepasw_login($parametros) === TRUE){						
			$retorno = array(
				'respuesta' =>  "Su password ha sido modificado correctamente.",
				'valor' 	=>  2
			);
			echo json_encode($retorno);	
		}else{ //en otro caso error					
			$retorno = array(
				'respuesta' =>  "Ha ocurrido un error modificando su password.",
				'valor' 	=>  -5
			);
			echo json_encode($retorno);	
		}
	}

	public function unlock_pass($cia='') { // Recuperar Password	
		$data = array();
		$data['ccia'] = $cia;
		$data['idusuario'] = $this-> session-> userdata('s_idusuario');
		$data['dmail'] = $this-> session-> userdata('s_dmail');
		$data['tipo'] = '2';
		$this->load->view('seguridad/vlogin_recoverpwd',$data);
	}

	public function recover_pass($cia='') { // Recuperar Password	
		$data = array();
		$data['ccia'] = $cia;
		$data['idusuario'] = $this-> session-> userdata('s_idusuario');
		$data['dmail'] = $this-> session-> userdata('s_dmail');
		$data['tipo'] = '1';
		$this->load->view('seguridad/vlogin_recoverpwd',$data);
	}
	
	public function request_password() { // recuperar Password		
		$tipo = $this->input->post("tipo");
		$ccia = $this->input->post("ccia");
		$comp = $this->input->post("cia");
		$validar = '0';
		
        if($validar == '0'){  	
        	//obtenemos los datos del usuario porque existe el email
        	$userData = $this->mlogin->getUserData($this->input->post("email"));
        	//si se ha actualiado el request_token y todo ha ido bien
        	//enviamos un email al usuario
        	if($userData){
        		if($this->sendMailRecoveryPass($userData,$comp) === TRUE){							
					$retorno = array(
						'respuesta' =>  "Se ha enviado un email a su correo para recuperar su password, tiene 20 minutos",
						'valor' 	=>  3
					);
					echo json_encode($retorno);	
        		}else{						
					$retorno = array(
						'respuesta' =>  "Ha ocurrido un error enviando el email, pruebe más tarde.",
						'valor' 	=>  -6
					);
					echo json_encode($retorno);	
        		}
        	}else{					
				$retorno = array(
					'respuesta' =>  "Ha ocurrido un error validando email, use otro.",
					'valor' 	=>  -6
				);
				echo json_encode($retorno);	
			}
        }
	}
	
	private function sendMailRecoveryPass($userdata, $comp) { // Envio de Email
        //cargamos la libreria email de ci
		$this->load->library("email");
		
		$iduser = $userdata->id_usuario;

		$emailData = $this->mlogin->getconfigemail('000');
		if($emailData){
			$mailhost = $emailData->DSERVER;
			$mailport = $emailData->NPUERTO;
			$mailuser = $emailData->DUSER;
			$mailpass = $emailData->DPASSWORD;
		}
		
		//configuracion para grupofs
		$configGrupofs = array(
			'protocol' => 'smtp',
			'smtp_host' => $mailhost,
			'smtp_port' => $mailport,
			'smtp_user' => $mailuser ,
			'smtp_pass' => $mailpass,
			'mailtype' => 'html',
			'charset' => 'utf-8',
			'newline' => "\r\n"
		);	
 
        //cargamos la configuración para enviar con gmail
        $this->email->initialize($configGrupofs);
 
        $this->email->from('sistemas@grupofs.com');
        $this->email->to($userdata->email_acceso);
        $this->email->subject('Recuperación de contraseña de plataforma');
		$VarToken = $userdata->token;
		
			
		$html = '<h3>Estimado(a),</h3><br>';
		$html .= '<table><tr><td align="justify" colspan="3">La presente es para dar atención a la solicitud de recuperación de contraseña para su cuenta de acceso a nuestra plataforma. Para continuar con el procedimiento haz click en el el boton de enlace.
			<br><h3><small>Si no haz solicitado recuperar tu contraseña, solo ignora este mensaje.</small></h3></td></tr>';
		$html .= '<tr><td colspan="3"></td></tr>';
		$html .= '<tr ><td></td><td align="center" >';
		$html .= '<table cellpadding="0" cellmargin="0" border="0" height="44" width="320" style="border-radius: 8px; border:5px solid #0080FF">
			<tr>
		  		<td bgcolor="#0080FF" valign="middle" align="center" width="320">
					<div style="font-size: 18px; color: #ffffff; line-height: 1; margin: 0; padding: 0; mso-table-lspace:0; mso-table-rspace:0;">
			  			<a href="'.base_url("/clogin/recovery_password/$VarToken/$comp/$iduser").'" style="text-decoration: none; color: #ffffff; border: 0; font-family: Arial, arial, sans-serif; mso-table-lspace:0; mso-table-rspace:0;" border="0">Recuperar contraseña</a>
					</div>
		  		</td>
			</tr>
	  	</table>'; 
	  	$html .= '</td><td></td></tr></table>';
		$html .= '<br><b>Recuerda :: </b>Si tienes dudas nos puedes contactar en el siguiente email - sistemas@grupofs.com<br><br>Atentamente,<br><br> Area de Sistemas.<br><br>';
		
		
		$this->email->message($html);

        if($this->email->send())
        {
        	return TRUE;
		}else{
        	return FALSE;
		}		
	}
	
	public function recovery_password($token = "",$cia = "",$iduser ="") { // Ejecuta el proceso TOKEN enviado a email
		//si el password ha caducado
		if($this->checkIsLiveToken($token) === FALSE)
		{
			$this->session->set_flashdata(
				"expired_request", "Si necesita recuperar su password rellene el 
				formulario con su email y le haremos llegar un correo con instrucciones"
			);
			redirect(base_url("clogin/request_password"),"refresh");
		}

		$datosuser = $this->mlogin->getUser($iduser);

		$s_usuario = array(
			's_idusuario' 	=> $iduser, 
			's_cia' 		=> $cia,
			's_dmail' 		=> $datosuser->email_acceso,
			'login' 		=> TRUE
		);
		   
		$this -> session -> set_userdata($s_usuario);

		if($cia  == 1){
			$ccia = 'fs';
		}else if($cia  == 2){
			$ccia = 'fsc';
		}

		$data = array();		
		$data["idcia"] = $cia;
		$data["tipo"] = '1';		
		$data["ccia"] = $ccia;		
		$data["idusuario"] = $this-> session-> userdata('s_idusuario');	
		$data["dmail"] = $this-> session-> userdata('s_dmail');
		$data['tipo'] = '1';
		
		$this->session->set_userdata("id_user_recovery_pass", $this->checkIsLiveToken($token)->id_usuario);
		
		if ($cia  == 1 or $cia  == 2) :
			$this->load->view("seguridad/vlogin_changepwd", $data);
		else:
			$this->load->view('welcome_message');
		endif;
	}
	
	private function checkIsLiveToken($token) { // Verifica si el TOKEN a expirado
		return $this->mlogin->checkIsLiveToken($token);
	}
	
	private function token() { // Genera un Token para cada usuario
        return sha1(uniqid(rand(),true));
	}
}
?>
