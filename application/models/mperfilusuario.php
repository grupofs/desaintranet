<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Mperfilusuario extends CI_Model{
	function __construct() {
		parent::__construct();
		$this->load->library('session');
    }
		
    public function getresumenperfil($parametros) { // Datos del Empleado
        
      $procedure = "call usp_segu_perfil_datoempleado(?)";
      $query = $this->db-> query($procedure,$parametros);
  
      if ($query->num_rows() > 0) { 
              $data = $query->result();
        $query->free_result(); 
              return $data;
      }{
        return False;
      }	
        
    }

    public function getdatospersonales($parametros) { // Recuperar datos personales
      $procedure = "call usp_segu_perfil_datopersonal(?)";
      $query = $this->db-> query($procedure,$parametros);
  
      if ($query->num_rows() > 0) { 
              $data = $query->result();
        $query->free_result(); 
              return $data;
      }{
        return False;
      }	
    }

    public function setimagen_perfil($datos = array()) { // Guardar multiples archivos
      $this->db->where("id_usuario",$datos["id_usuario"]);
      
      if($this->db->update("segu_usuario", $datos)){
        
	   		$s_usuario = array(
          's_druta'		=> $datos["ruta_imagen"],
        );             
        $this -> session -> set_userdata($s_usuario);
        return TRUE;
      }else{
        return FALSE;
      }
    }

    public function setperfil($parametros) { // Registrar Datos del Perfil
      
      $procedure = "call usp_segu_perfil_updateperfil(?,?,?,?,?,?,?,?,?,?)";
      $query = $this->db-> query($procedure,$parametros);
  
      if ($query->num_rows() > 0) { 
              $data = $query->result();
        $query->free_result(); 
              return $data;
      }{
        return False;
      }	
        
    }
    
}
?>