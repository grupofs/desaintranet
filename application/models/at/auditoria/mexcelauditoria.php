<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Mexcelauditoria extends CI_Model {
	function __construct() {
		parent::__construct();	
		$this->load->library('session');
    }
    public function xlschecklistpadres($parametros) { // Recupera datos del empleado para resumen    
        $procedure = "call usp_at_audi_xlschecklistpadres(?,?,?)";
        $query = $this->db-> query($procedure,$parametros);
        
        if ($query->num_rows() > 0) { 
            return $query->result();
        }{
            return False;
        }
    }		
    public function xlschecklistresult($parametros) { // Recupera datos del empleado para resumen    
        $procedure = "call usp_at_audi_xlschecklistresult(?,?)";
        $query = $this->db-> query($procedure,$parametros);
        
        if ($query->num_rows() > 0) { 
            return $query->result();
        }{
            return False;
        }
    }		
    public function xlschecklistdetalle($parametros) { // Recupera datos del empleado para resumen    
        $procedure = "call usp_at_audi_xlschecklistdetalle(?,?,?,?)";
        $query = $this->db-> query($procedure,$parametros);
        
        if ($query->num_rows() > 0) { 
            return $query->result();
        }{
            return False;
        }
    }
}
?>