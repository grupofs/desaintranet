<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Mservcliente extends CI_Model {
	function __construct() {
		parent:: __construct();	
		$this->load->library('session');
    }
    
   /** TRAMITES **/ 
    public function gettipotramite() { // Visualizar tipo de tramite en CBO	
        
        $procedure = "call sp_appweb_pt_gettipotramite()";
		$query = $this->db-> query($procedure);
        
        if ($query->num_rows() > 0) {

            $listas = '';
            
            foreach ($query->result() as $row)
            {
                $listas .= '<option value="'.$row->IDTIPOTRAM.'">'.$row->DESCRIPTIPOTRAM.'</option>';  
            }
               return $listas;
        }{
            return false;
        }	
    }	
}
?>