<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Musuario extends CI_Model {
	function __construct() {
		parent:: __construct();	
		$this->load->library('session');
    }
    
   /** PROPUESTA **/    	
   public function getbuscarusuarios($parametros) { // Recupera Listado de Propuestas        
        $procedure = "call usp_segu_usuarios_getbuscarusuarios(?,?,?)";
        $query = $this->db-> query($procedure,$parametros);

        if ($query->num_rows() > 0) { 
            return $query->result();
        }{
            return False;
        }	
    }
    
}
?>