<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Mservcliente extends CI_Model {
	function __construct() {
		parent:: __construct();	
		$this->load->library('session');
    }
    
   /** TRAMITES **/ 
    public function getmapterequipo($parametros) { // Obtener equipo mapeo termico	
        
        $procedure = "call sp_appweb_pt_getmapterequipo(?)";
		$query = $this->db-> query($procedure,$parametros);

		if ($query->num_rows() > 0) { 
			return $query->result();
		}{
			return False;
		}	
	}
    public function getmapterrecinto($parametros) { // Obtener recinto mapeo termico	
        
        $procedure = "call sp_appweb_pt_getmapterrecinto(?)";
		$query = $this->db-> query($procedure,$parametros);

		if ($query->num_rows() > 0) { 
			return $query->result();
		}{
			return False;
		}	
    }
    public function getmapterestudio($parametros) { // Obtener estudio mapeo termico	
        
        $procedure = "call sp_appweb_pt_getmapterestudio(?)";
		$query = $this->db-> query($procedure,$parametros);

		if ($query->num_rows() > 0) { 
			return $query->result();
		}{
			return False;
		}	
    }
    public function getmapterproducto($parametros) { // Obtener producto mapeo termico	
        
        $procedure = "call sp_appweb_pt_getmapterproducto(?)";
		$query = $this->db-> query($procedure,$parametros);

		if ($query->num_rows() > 0) { 
			return $query->result();
		}{
			return False;
		}	
    }
	
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
	
    public function getproasepproducto($parametros) { // Visualizar tipo de tramite en CBO	
        
        $procedure = "call sp_appweb_pt_getproasepproducto(?)";
		$query = $this->db-> query($procedure,$parametros);

		if ($query->num_rows() > 0) { 
			return $query->result();
		}{
			return False;
		}	
	}
	
    public function getevaldesviestudio($parametros) { // Obtener estudio mapeo termico	
        
        $procedure = "call sp_appweb_pt_getevaldesviestudio(?)";
		$query = $this->db-> query($procedure,$parametros);

		if ($query->num_rows() > 0) { 
			return $query->result();
		}{
			return False;
		}	
    }	
}
?>