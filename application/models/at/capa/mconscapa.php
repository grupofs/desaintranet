<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Mconscapa extends CI_Model {
	function __construct() {
		parent:: __construct();	
		$this->load->library('session');
    }

    public function getclientecapa() { // Visualizar Servicios en CBO	
        
        $procedure = "call usp_at_capa_getclientecapa()";
		$query = $this->db-> query($procedure);
        
        if ($query->num_rows() > 0) {
            $listas = '<option value="0" selected="selected">::Elija</option>';            
            foreach ($query->result() as $row){
                $listas .= '<option value="'.$row->IDCLIE.'">'.$row->DESCRIPCLIE.'</option>';  
            }
               return $listas;
        }{
            return false;
        }	
    }
    public function getbusquedacapa($parametros) { // Registra el modulo
        $this->db->trans_begin();
   
        $procedure = "call usp_at_capa_getbusquedacapa(?);";
        $this->db-> query($procedure,$parametros);
   
        if ($this->db->trans_status() === FALSE) {
           $this->db->trans_rollback();
        } else {
           $this->db->trans_commit();
           return 'Guardo Correctamente';
        }   
    }
}
?>