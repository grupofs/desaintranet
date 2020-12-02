<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Mingresos extends CI_Model {
    function __construct() {
        parent::__construct();	
        $this->load->library('session');
    }
    
   /** AUDITORIA **/ 
    public function getcboempresa() { // Visualizar Clientes del servicio en CBO	
        
        $procedure = "call usp_adm_conta_getcboempresa()";
		$query = $this->db-> query($procedure);
        
        if ($query->num_rows() > 0) {

            $listas = '<option value="0" selected="selected">::Elegir</option>';
            
            foreach ($query->result() as $row)
            {
                $listas .= '<option value="'.$row->CCLIENTE.'">'.$row->DCLIENTE.'</option>';  
            }
               return $listas;
        }{
            return false;
        }	
    } 

    public function getbuscaringresos($parametros) { // Recupera Listado de Propuestas      
		$procedure = "call usp_adm_conta_getbuscardocingresos(?,?,?,?,?,?)";
		$query = $this->db-> query($procedure,$parametros);

		if ($query->num_rows() > 0) { 
			return $query->result();
		}{
			return False;
		}	
    }

    public function setingreso($parametros) {  // Registrar informe PT
        $this->db->trans_begin();

        $procedure = "call usp_adm_conta_setingreso(?,?,?,?,?,?,?,?,?,?,?);";
        $query = $this->db->query($procedure,$parametros);

        if ($this->db->trans_status() === FALSE){
            $this->db->trans_rollback();
        }else{
            $this->db->trans_commit();
            return $query->result(); 
        }   
    }

    public function setpagar($parametros) {  // Registrar informe PT
        $this->db->trans_begin();

        $procedure = "call usp_adm_conta_setpagar(?,?,?,?,?,?,?,?,?,?,?,?);";
        $query = $this->db->query($procedure,$parametros);

        if ($this->db->trans_status() === FALSE){
            $this->db->trans_rollback();
        }else{
            $this->db->trans_commit();
            return $query->result(); 
        }   
    }

}
?>