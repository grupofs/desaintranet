<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Mmantcapa extends CI_Model {
	function __construct() {
		parent:: __construct();	
		$this->load->library('session');
    }
    
   /** CURSOS **/
    public function getlistarcurso() { // Visualizar listado de cursos
        $procedure = "call usp_at_capa_getlistarcurso();";
        $query = $this->db-> query($procedure);
 
        if ($query->num_rows() > 0) { 
            return $query->result();
        }{
            return False;
        }		
    }          
    public function setcurso($parametros) { // Guardar cursos
        $this->db->trans_begin();
 
        $procedure = "call usp_at_capa_setcurso(?,?,?,?);";
        $this->db-> query($procedure,$parametros);
 
        if ($this->db->trans_status() === FALSE) {
            $this->db->trans_rollback();
        } else {
            $this->db->trans_commit();
            return 'Guardo Correctamente';
        }   
    } 
    
   /** MODULOS **/
    public function getlistarmodulo() { // Visualizar listado de modulos
        $procedure = "call usp_at_capa_getlistarmodulo();";
        $query = $this->db-> query($procedure);
   
        if ($query->num_rows() > 0) { 
               return $query->result();
        }{
               return False;
        }		
    }    
   public function getcbocurso() { // Visualizar cbo de curso	
        $procedure = "call usp_at_capa_getcbocurso();";
        $query = $this->db-> query($procedure);
               
        if ($query->num_rows() > 0) {
            $listas = '<option value="">::Elejir</option>';            
            foreach ($query->result() as $row) {
                $listas .= '<option value="'.$row->id_capacurso.'">'.$row->desc_curso.'</option>';  
            }
            return $listas;
        }{
            return false;
        }	
    }      
    public function setmodulo($parametros) { // Registra el modulo
        $this->db->trans_begin();
   
        $procedure = "call usp_at_capa_setmodulo(?,?,?,?,?);";
        $this->db-> query($procedure,$parametros);
   
        if ($this->db->trans_status() === FALSE) {
           $this->db->trans_rollback();
        } else {
           $this->db->trans_commit();
           return 'Guardo Correctamente';
        }   
    }
    
   /** EXPOSITOR **/
    public function getlistarexpositor() { // Visualizar listado de modulos
        $procedure = "call usp_at_capa_getlistarexpositor();";
        $query = $this->db-> query($procedure);
   
        if ($query->num_rows() > 0) { 
               return $query->result();
        }{
               return False;
        }		
    }  
    public function getcboExpositor() { // Visualizar Servicios en CBO	
        
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
    public function setexpositor($parametros) { // Registra el modulo
        $this->db->trans_begin();
   
        $procedure = "call usp_at_capa_setexpositor(?,?,?,?);";
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