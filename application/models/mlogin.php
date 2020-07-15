<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Mlogin extends CI_Model{
	function __construct() {
		parent::__construct();
		$this->load->library('session');
	} 
	
/*****************************/
/** LOGEARSE **/ 
	public function ingresar($parametros) { //Ingreso de USU y PASS
		
		if($parametros["@CCIA"] == '1' || $parametros["@CCIA"] == '2'){
			$procedure = "call usp_segu_acceso_intranet(?,?)";
		}else if($parametros["@CCIA"] == '0'){
			$procedure = "call usp_segu_acceso_extranet(?,?)";
		}
		
		$query = $this->db-> query($procedure,$parametros);
		$retorno = 0;
    			   
		if ($query->num_rows() == 1) {
			$row = $query -> row(); 
			if($row -> SACCESO == 'B' ) {						
				$retorno = array(
					'respuesta' =>  "¿Desea Desbloquear Usuario?",
					'valor' 	=>  -3
				);
			}else{
				if ($row -> STIPOPWD == "S") { 
					if(password_verify($this->input->post('txtpassword'), $row -> DCLAVE)) {							
						if($row -> CHANGEPASS == "1") { 											
							$retorno = array(
								'respuesta' =>  "",
								'valor' 	=>  1
							);
						}else{					
							$retorno = array(
								'respuesta' =>  "",
								'valor' 	=>  0
							);
						}
					}else{
						$contador = 5 - $_SESSION['contadorLogin'];						
						$retorno = array(
							'respuesta' =>  "Clave incorrecta! Tienes ".$contador." intentos.",
							'valor' 	=>  -1
						);
					}
				}else{
					$contador = 5 - $_SESSION['contadorLogin'];						
					$retorno = array(
						'respuesta' =>  "Clave incorrecta! Tienes ".$contador." intentos.",
						'valor' 	=>  -1
					);
				}
			}				
		}else{			
			$retorno = array(
				'respuesta' =>  "No existe usuario ingresado.",
				'valor' 	=>  -2
			);
		}

		$valor = $retorno['valor'];
		if (($valor == 1)||($valor == 0)){
			$s_usuario = array(
			 	's_idusuario' 		=> $row -> IDUSUARIO, 
				's_cusuario' 		=> $row -> CUSUARIO, 
				's_usuario' 		=> $row -> USUARIO,  
				's_idrol' 			=> $row -> IDROL,
				's_cia' 			=> $row -> CCOMPANIA,
				's_nombre'			=> $row -> DDATOS,
				's_infodato'		=> $row -> INFODATO,
				's_idempleado'		=> $row -> IDEMPLEADO,
				's_idadministrado'	=> $row -> IDADMINISTRADO,
				's_usu'				=> $row -> NOMBRES,
				's_changepassw' 	=> $row -> CHANGEPASS,	
			 	's_tipopwd'			=> $row -> STIPOPWD,
			 	's_tipousu'			=> $row -> TIPO_USU,
			 	's_dmail' 			=> $row -> DMAIL,
			 	's_passw' 			=> $row -> DCLAVE,
			 	's_druta'			=> $row -> RUTA,				
				'login' 			=> TRUE
		 	);
			
		 	$this->session->set_userdata($s_usuario);
			$this->session->time = time();
			

		}else if(($valor == -1)||($valor == -3)){				
			$s_usuario = array(
				's_idusuario'	=> $row -> IDUSUARIO,
				's_dmail'		=> $row -> DMAIL
			);
		   
			$this -> session -> set_userdata($s_usuario); 
		}
			
		$query->free_result();
		return $retorno;
	}  
		
/*****************************/
/** RECUPERAR PASSWORD **/ 	
	public function changepasw_login($parametros = array()) { // Comprobar Email
		$this->db->where("id_usuario",$parametros["user_id"]);
		unset($parametros['user_id']);//eliminamos la clave user_id del array
		if($this->db->update("segu_usuario", $parametros)){
			return TRUE;
		}else{
			return FALSE;
		}
	}

	public function getUserData($email) { // Datos del Email
		$query = $this->db->get_where('segu_usuario', array('email_acceso' => $email));
		if($query->num_rows() === 1){
			//actualizamos el campo request_token del usuario y 
			//le damos 20 minutos para recuperar el password
			if($this->startRecoveryPassword($query->row()->id_usuario)){
				return $query->row();
			}
		}
	} 
		
	private function startRecoveryPassword($user_id) { // Recuperar Password
		//damos 20 minutos al usuario para recuperar su password
		$expire_stamp = date('Y-m-d H:i:s', strtotime("+20 min"));
		$data = array("fcambiopwd" => $expire_stamp);

		$this->db->where("id_usuario", $user_id);
		if($this->db->update("segu_usuario", $data)){
			return TRUE;
		}
	}

	public function checkIsLiveToken($token) { //Comprueba si el campo request_token es menor que la fecha actual	
		$current_stamp = date('Y-m-d H:i:s');
		$query = $this->db->select("id_usuario")
				->from("segu_usuario")
				->where("token",$token)
				->where("fcambiopwd >",$current_stamp)
				->get();

		if($query->num_rows() === 1){
			return $query->row();
		}else{
			return FALSE;
		}
	}

	public function getUser($iduser) { // Datos del Usuario	
		$query = $this->db->get_where('segu_usuario', array('id_usuario' => $iduser));
		if($query->num_rows() === 1){
			return $query->row();
		}
	}

	public function validarpass($parametros) { //Validar usuario y password
		$procedure = "call sp_appweb_seguridad_acceso_intranet(?,?)";
		$query = $this->db-> query($procedure,$parametros);
    			   
		if ($query->num_rows() == 1) {
	   		$row = $query -> row(); 
	   		$s_usuario = array(
				's_idusuario' 	=> $row -> IDUSUARIO, 
	   			's_cusuario' 	=> $row -> CUSUARIO, 
	   			's_usuario' 	=> $row -> USUARIO,  
	   			's_idrol' 		=> $row -> IDROL,
				's_cia' 		=> $row -> CCOMPANIA,
				's_dmail' 		=> $row -> DMAIL,
				's_passw' 		=> $row -> DCLAVE,
				's_changepassw' => $row -> CHANGEPASS,
				's_druta'		=> $row -> RUTA,
				's_tipopwd'		=> $row -> STIPOPWD,
				's_tipousu'		=> $row -> TIPO_USU,
	   			'login' 		=> TRUE
			);
				   
			$this -> session -> set_userdata($s_usuario);
				
			if(password_verify($this->input->post('txtpassword'), $row -> DCLAVE)){
				return 1;
			}else{
				return 0;
			}				
		}else{
			return -1;
		}
	}

	public function verifica_email($email) { // Comprobar Email
		$query = $this->db-> get_where('segu_usuario', array('email_acceso' => $email));
		if($query->num_rows() === 1){
			return TRUE;
		}
	}
		
	public function getconfigemail($idemail) { // Datos del Email
		$query = $this->db->get_where('mmail', array('cmail' => $idemail));
		if($query->num_rows() === 1){
			return $query->row();
		}
	}

}
?>
