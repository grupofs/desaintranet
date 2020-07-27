<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Mservcliente extends CI_Model {
	function __construct() {
		parent:: __construct();	
		$this->load->library('session');
    }
    
   /** TRAMITES **/ 
    public function getproconvequipo($parametros) { // Visualizar tipo de tramite en CBO	
        
        $procedure = "call sp_appweb_pt_getproconvequipo(?)";
		$query = $this->db-> query($procedure,$parametros);

		if ($query->num_rows() > 0) { 
			return $query->result();
		}{
			return False;
		}	
    }
    public function getproconvproducto($parametros) { // Visualizar tipo de tramite en CBO	
        
        $procedure = "call sp_appweb_pt_getproconvproducto(?)";
		$query = $this->db-> query($procedure,$parametros);

		if ($query->num_rows() > 0) { 
			return $query->result();
		}{
			return False;
		}	
    }	
    public function getcalfrioproducto($parametros) { // Visualizar tipo de tramite en CBO	
        
        $procedure = "call sp_appweb_pt_getcalfrioproducto(?)";
		$query = $this->db-> query($procedure,$parametros);

		if ($query->num_rows() > 0) { 
			return $query->result();
		}{
			return False;
		}	
    }	
    public function getcalfrioequipo($parametros) { // Visualizar tipo de tramite en CBO	
        
        $procedure = "call sp_appweb_pt_getcalfrioequipo(?)";
		$query = $this->db-> query($procedure,$parametros);

		if ($query->num_rows() > 0) { 
			return $query->result();
		}{
			return False;
		}	
    }	
}
?>