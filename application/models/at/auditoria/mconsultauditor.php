<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Mconsultauditor extends CI_Model {
    function __construct() {
        parent::__construct();	
        $this->load->library('session');
    }
    
   /** AUDITORIA **/ 
    public function getcboclieserv() { // Visualizar Clientes del servicio en CBO	
        
        $procedure = "call usp_at_audi_getcboclieserv()";
		$query = $this->db-> query($procedure);
        
        if ($query->num_rows() > 0) {

            $listas = '<option value="" selected="selected">::Elegir</option>';
            
            foreach ($query->result() as $row)
            {
                $listas .= '<option value="'.$row->IDCLIE.'">'.$row->DESCRIPCLIE.'</option>';  
            }
               return $listas;
        }{
            return false;
        }	
    }
    public function getcbosubserv($parametros) { // Visualizar Clientes del servicio en CBO	
        
        $procedure = "call usp_at_audi_getcbosubserv(?)";
		$query = $this->db-> query($procedure,$parametros);
        
        if ($query->num_rows() > 0) {

            $listas = '<option value="" selected="selected">::Elegir</option>';
            
            foreach ($query->result() as $row)
            {
                $listas .= '<option value="'.$row->CPTE.'">'.$row->SUBSERVICIO.'</option>';  
            }
               return $listas;
        }{
            return false;
        }	
    }
    public function getestableaudi($parametros) { // Visualizar Establecimiento por Clientes en CBO	
        
        $procedure = "call usp_at_audi_getestableaudi(?)";
		$query = $this->db-> query($procedure,$parametros);
        
        if ($query->num_rows() > 0) {

            $listas = '<option value="" selected="selected">::Elegir</option>';
            
            foreach ($query->result() as $row)
            {
                $listas .= '<option value="'.$row->IDESTABLE.'">'.$row->DESCRIPESTABLE.'</option>';  
            }
               return $listas;
        }{
            return false;
        }	
    }    
    public function getbuscarauditoria($parametros) { // Recupera Listado de Propuestas      
		$procedure = "call usp_at_audi_getbuscarauditoria(?,?,?,?,?)";
		$query = $this->db-> query($procedure,$parametros);

		if ($query->num_rows() > 0) { 
			return $query->result();
		}{
			return False;
		}	
    }
    public function getcboregAreazona($parametros) { // Visualizar Criterio en CBO	
        
        $procedure = "call usp_at_audi_getcboregAreazona(?)";
		$query = $this->db-> query($procedure,$parametros);
        
        if ($query->num_rows() > 0) {

            $listas = '<option value="" selected="selected">::Elegir</option>';
            
            foreach ($query->result() as $row)
            {
                $listas .= '<option value="'.$row->CESTABLEAREA.'">'.$row->DESTABLEAREA.'</option>';  
            }
               return $listas;
        }{
            return false;
        }	
    }
    public function getlistarchecklist($parametros) { // Recupera Listado de Propuestas  

		$procedure = "call usp_at_audi_getlistarchecklist(?,?,?,?)";   
		$query = $this->db-> query($procedure,$parametros);

		if ($query->num_rows() > 0) { 
			return $query->result();
		}{
			return False;
		}	
    }
    public function setregchecklist($parametros) {  // Registrar informe PT
        $this->db->trans_begin();

        $procedure = "call usp_at_audi_setregchecklist(?,?,?,?,?,?,?);";
        $query = $this->db->query($procedure,$parametros);

        if ($this->db->trans_status() === FALSE){
            $this->db->trans_rollback();
        }else{
            $this->db->trans_commit();
            return $query->result(); 
        }   
    }
    public function subirArchivoeviden($parametros) {  // Registrar tramite PT
        $this->db->trans_begin();

        $procedure = "call usp_at_audi_subirArchivoeviden(?,?,?,?,?,?,?,?,?);";
        $query = $this->db->query($procedure,$parametros);

        if ($this->db->trans_status() === FALSE){
            $this->db->trans_rollback();
        }
        else{
            $this->db->trans_commit();
            return $query->result(); 
        }   
    } 
    public function setcalcularchecklist($parametros,$dataobject) {  // Registrar informe PT
        $this->db->trans_begin();
       
		$procedure = "call ".$dataobject."(?,?,?)";   
		$query = $this->db-> query($procedure,$parametros);

        if ($this->db->trans_status() === FALSE){
            $this->db->trans_rollback();
        }else{
            $this->db->trans_commit();
            return $query->result(); 
        }   
    }
    

}
?>

