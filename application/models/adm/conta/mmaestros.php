<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Mmaestros extends CI_Model {
	function __construct() {
		parent:: __construct();	
		$this->load->library('session');
    }
    
   /** SISTEMAS **/
    public function getlistarcodigo() { // Visualizar listado de modulos
        $procedure = "call usp_adm_conta_getlistarcodigo();";
		$query = $this->db-> query($procedure);

		if ($query->num_rows() > 0) { 
			return $query->result();
		}{
			return False;
		}		
    }          
    public function setcodigo($parametros) { // Guardar modulo
        $this->db->trans_begin();

        $procedure = "call usp_adm_conta_setcodigo(?,?,?,?,?);";
        $this->db-> query($procedure,$parametros);

        if ($this->db->trans_status() === FALSE)
        {
            $this->db->trans_rollback();
        }
        else
        {
            $this->db->trans_commit();
            return 'Guardo Correctamente';
        }   
    }   
}
?>