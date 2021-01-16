<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Musuario extends CI_Model {
	function __construct() {
		parent:: __construct();	
		$this->load->library('session');
    }
    
   /** USUARIO **/    	
   public function getbuscarusuarios($parametros) { // Buscar Usuario        
        $procedure = "call usp_segu_usuarios_getbuscarusuarios(?,?,?)";
        $query = $this->db-> query($procedure,$parametros);

        if ($query->num_rows() > 0) { 
            return $query->result();
        }{
            return False;
        }	
    }	

    public function getpersonas() { // Buscar Usuario        
         $procedure = "call usp_adm_getpersonas()";
         $query = $this->db-> query($procedure);
 
         if ($query->num_rows() > 0) { 
             return $query->result();
         }{
             return False;
         }	
     }
    
}
?>