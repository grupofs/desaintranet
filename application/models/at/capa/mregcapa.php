<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Mregcapa extends CI_Model {
	function __construct() {
		parent:: __construct();	
		$this->load->library('session');
    }
    
   /** CAPACITACIONES **/ 
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
    public function getcursocapa() { // Visualizar Servicios en CBO	
        
        $procedure = "call usp_at_capa_getcbocurso()";
		$query = $this->db-> query($procedure);
        
        if ($query->num_rows() > 0) {
            $listas = '<option value="0" selected="selected">::Elija</option>';            
            foreach ($query->result() as $row){
                $listas .= '<option value="'.$row->id_capacurso.'">'.$row->desc_curso.'</option>';  
            }
               return $listas;
        }{
            return false;
        }	
    }
    public function getexpositorcapa() { // Visualizar Servicios en CBO	
        
        $procedure = "call usp_at_capa_getcboexpositor()";
		$query = $this->db-> query($procedure);
        
        if ($query->num_rows() > 0) {
            $listas = '<option value="0" selected="selected">::Elija</option>';            
            foreach ($query->result() as $row){
                $listas .= '<option value="'.$row->id_capaexpo.'">'.$row->datosrazonsocial.'</option>';  
            }
               return $listas;
        }{
            return false;
        }	
    }
    public function getbuscarcapa($parametros) { // Recupera Listado de Propuestas        
		$procedure = "call usp_at_capa_getbuscarcapa(?,?,?,?,?)";
		$query = $this->db-> query($procedure,$parametros);

		if ($query->num_rows() > 0) { 
			return $query->result();
		}{
			return False;
		}	
    }
	public function getclienteinternoat() { // Visualizar Clientes con propuestas en CBO			 
		$procedure = "call usp_at_capa_getclienteinternoat()";
		$query = $this->db-> query($procedure);
		 
		if ($query->num_rows() > 0) {
 
			 $listas = '<option value="0" selected="selected">::Elegir</option>';
			 
			 foreach ($query->result() as $row)
			 {
				 $listas .= '<option value="'.$row->CCLIENTE.'">'.$row->RAZONSOCIAL.'</option>';  
			 }
				return $listas;
		}{
			 return false;
		}	
	}
    public function buscar_establexcliente($parametros) { // Visualizar Servicios en CBO	
        
        $procedure = "call usp_at_capa_getestablexcliente(?)";
		$query = $this->db-> query($procedure,$parametros);
        
        if ($query->num_rows() > 0) {

            $listas = '<option value="%" selected="selected">::Elija</option>';            
            foreach ($query->result() as $row){
                $listas .= '<option value="'.$row->CESTABLE.'">'.$row->DESCRIPESTA.'</option>';  
            }
               return $listas;
        }{
            return false;
        }	
    }
    public function setcapa($parametros) {  // Registrar informe PT
        $this->db->trans_begin();

        $procedure = "call usp_at_capa_setcapa(?,?,?,?,?,?);";
        $query = $this->db->query($procedure,$parametros);

        if ($this->db->trans_status() === FALSE){
            $this->db->trans_rollback();
        }else{
            $this->db->trans_commit();
            return $query->result(); 
        }   
    } 	
    public function gettemaxcurso($parametros) { // Visualizar Servicios en CBO	
        
        $procedure = "call usp_at_capa_getcbotemaxcurso(?)";
		$query = $this->db-> query($procedure,$parametros);
        
        if ($query->num_rows() > 0) {
            $listas = '<option value="0" selected="selected">::Elija</option>';            
            foreach ($query->result() as $row){
                $listas .= '<option value="'.$row->id_capamodulo.'">'.$row->desc_modulo.'</option>';  
            }
               return $listas;
        }{
            return false;
        }	
    }
    public function setcapadet($parametros) {  // Registrar informe PT
        $this->db->trans_begin();

        $procedure = "call usp_at_capa_setcapadet(?,?,?,?,?);";
        $query = $this->db->query($procedure,$parametros);

        if ($this->db->trans_status() === FALSE){
            $this->db->trans_rollback();
        }else{
            $this->db->trans_commit();
            return $query->result(); 
        }   
    } 
    public function subirPresent($parametros) {  // Registrar tramite PT
        $this->db->trans_begin();

        $procedure = "call usp_at_capa_subirPresent(?,?,?);";
        $query = $this->db->query($procedure,$parametros);

        if ($this->db->trans_status() === FALSE){
            $this->db->trans_rollback();
        }
        else{
            $this->db->trans_commit();
            return $query->result(); 
        }   
    } 
    public function subirTaller($parametros) {  // Registrar tramite PT
        $this->db->trans_begin();

        $procedure = "call usp_at_capa_subirTaller(?,?,?);";
        $query = $this->db->query($procedure,$parametros);

        if ($this->db->trans_status() === FALSE){
            $this->db->trans_rollback();
        }
        else{
            $this->db->trans_commit();
            return $query->result(); 
        }   
    } 
    public function subirExamen($parametros) {  // Registrar tramite PT
        $this->db->trans_begin();

        $procedure = "call usp_at_capa_subirExamen(?,?,?);";
        $query = $this->db->query($procedure,$parametros);

        if ($this->db->trans_status() === FALSE){
            $this->db->trans_rollback();
        }
        else{
            $this->db->trans_commit();
            return $query->result(); 
        }   
    } 
    public function subirLista($parametros) {  // Registrar tramite PT
        $this->db->trans_begin();

        $procedure = "call usp_at_capa_subirLista(?,?,?);";
        $query = $this->db->query($procedure,$parametros);

        if ($this->db->trans_status() === FALSE){
            $this->db->trans_rollback();
        }
        else{
            $this->db->trans_commit();
            return $query->result(); 
        }   
    }
    public function subirCerti($parametros) {  // Registrar tramite PT
        $this->db->trans_begin();

        $procedure = "call usp_at_capa_subirCerti(?,?,?);";
        $query = $this->db->query($procedure,$parametros);

        if ($this->db->trans_status() === FALSE){
            $this->db->trans_rollback();
        }
        else{
            $this->db->trans_commit();
            return $query->result(); 
        }   
    }
    public function getlistcapadet($parametros) { // Recupera Listado de Propuestas        
		$procedure = "call usp_at_capa_getlistcapadet(?)";
		$query = $this->db-> query($procedure,$parametros);

		if ($query->num_rows() > 0) { 
			return $query->result();
		}{
			return False;
		}	
    }
    public function setprograma($parametros) {  // Registrar informe PT
        $this->db->trans_begin();

        $procedure = "call usp_at_capa_setprograma(?,?,?,?,?,?,?,?);";
        $query = $this->db->query($procedure,$parametros);

        if ($this->db->trans_status() === FALSE){
            $this->db->trans_rollback();
        }else{
            $this->db->trans_commit();
            return $query->result(); 
        }   
    } 
    public function getlistprograma($parametros) { // Recupera Listado de Propuestas        
		$procedure = "call usp_at_capa_getlistprograma(?)";
		$query = $this->db-> query($procedure,$parametros);

		if ($query->num_rows() > 0) { 
			return $query->result();
		}{
			return False;
		}	
    }
    public function delcapadet($parametros) {	// Eliminar de propuesta
        $this->db->trans_begin();

        $procedure = "call usp_at_capa_deletecapadet(?);";
        $query = $this->db->query($procedure,$parametros);

        if ($this->db->trans_status() === FALSE)
        {
            $this->db->trans_rollback();
        }
        else
        {
            $this->db->trans_commit();
            return $query->result(); 
        }   
    } 
    public function delprogram($parametros) {	// Eliminar de propuesta
        $this->db->trans_begin();

        $procedure = "call usp_at_capa_deleteprogram(?);";
        $query = $this->db->query($procedure,$parametros);

        if ($this->db->trans_status() === FALSE)
        {
            $this->db->trans_rollback();
        }
        else
        {
            $this->db->trans_commit();
            return $query->result(); 
        }   
    } 
    public function getlistparticipante($parametros) { // Recupera Listado de Propuestas        
		$procedure = "call usp_at_capa_getlistparticipante(?)";
		$query = $this->db-> query($procedure,$parametros);

		if ($query->num_rows() > 0) { 
			return $query->result();
		}{
			return False;
		}	
    }
    public function setparticipante($parametros) {  // Registrar informe PT
        $this->db->trans_begin();

        $procedure = "call usp_at_capa_setparticipante(?,?,?,?,?);";
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