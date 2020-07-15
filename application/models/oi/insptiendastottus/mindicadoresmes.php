<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Mindicadoresmes extends CI_Model {
	function __construct() {
		parent:: __construct();	
		$this->load->library('session');
    }
    
    public function getrepzonalmensual($parametros) { // recuperar reporte zonal mensual	
        
        $procedure = "call sp_appweb_getinsptienda_repIHSacumZonales(?,?)";
        $query = $this->db-> query($procedure,$parametros);
        
        if ($query->num_rows() > 0) { 
            return $query->result();
        }{
            return False;
        }
        
    }
}
?>	