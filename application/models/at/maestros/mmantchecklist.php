<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Mmantchecklist extends CI_Model {
	function __construct() {
		parent:: __construct();	
		$this->load->library('session');
    }
    
   /** CHECKLIST **/
    public function getlistarcurso() { // Visualizar listado de cursos
        $procedure = "call usp_at_capa_getlistarcurso();";
        $query = $this->db-> query($procedure);
 
        if ($query->num_rows() > 0) { 
            return $query->result();
        }{
            return False;
        }		
    }   
}
?>