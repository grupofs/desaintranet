<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Mtramites extends CI_Model {
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
  
    public function getclieproptram() { // Visualizar Clientes con propuestas tramite en CBO	
         
         $procedure = "call sp_appweb_pt_getclieproptram()";
         $query = $this->db-> query($procedure);
         
         if ($query->num_rows() > 0) {
 
             $listas = '<option value="0" selected="selected">::Elegir</option>';
             
             foreach ($query->result() as $row)
             {
                 $listas .= '<option value="'.$row->IDCLIE.'">'.$row->DESCRIPCLIE.'</option>';  
             }
                return $listas;
         }{
             return false;
         }	
    }

    public function getbuscartramites($parametros) { // Recupera Listado de Tramites        
		$procedure = "call sp_appweb_pt_buscartramites(?,?,?,?,?)";
		$query = $this->db-> query($procedure,$parametros);

		if ($query->num_rows() > 0) { 
			return $query->result();
		}{
			return False;
		}	
    }

    public function getproputram($parametros) { // Visualizar NRO propuestas a evaluaren CBO	
         
        $procedure = "call sp_appweb_pt_getproputram(?)";
        $query = $this->db-> query($procedure,$parametros);
         
        if ($query->num_rows() > 0) {
 
            $listas = '<option value="%" selected="selected">::Elegir</option>';
             
            foreach ($query->result() as $row){
                $listas .= '<option value="'.$row->IDPTPROPU.'">'.$row->NROPROPU.'</option>';  
            }
            return $listas;
        }{
            return false;
        }	
    }

    public function getpropuclie($parametros) { // Visualizar NRO propuestas a evaluaren CBO	
         
        $procedure = "call sp_appweb_pt_getpropuclie(?)";
        $query = $this->db-> query($procedure,$parametros);
         
        if ($query->num_rows() > 0) {
 
            $listas = '<option value="%" selected="selected">::Elegir</option>';
             
            foreach ($query->result() as $row){
                $listas .= '<option value="'.$row->IDPTPROPU.'">'.$row->NROPROPU.'</option>';  
            }
            return $listas;
        }{
            return false;
        }	
    }

    public function settramite($parametros) {  // Registrar tramite PT
        $this->db->trans_begin();

        $procedure = "call sp_appweb_pt_settramite(?,?,?,?,?,?,?,?,?,?);";
        $query = $this->db->query($procedure,$parametros);

        if ($this->db->trans_status() === FALSE){
            $this->db->trans_rollback();
        }
        else{
            $this->db->trans_commit();
            return $query->result(); 
        }   
    } 

    public function subirArchivo($parametros) {  // Registrar tramite PT
        $this->db->trans_begin();

        $procedure = "call sp_appweb_pt_subirarchivo(?,?,?,?);";
        $query = $this->db->query($procedure,$parametros);

        if ($this->db->trans_status() === FALSE){
            $this->db->trans_rollback();
        }
        else{
            $this->db->trans_commit();
            return $query->result(); 
        }   
    } 	

    public function subirCarta($parametros) {  // Registrar tramite PT
        $this->db->trans_begin();

        $procedure = "call sp_appweb_pt_subircarta(?,?,?,?);";
        $query = $this->db->query($procedure,$parametros);

        if ($this->db->trans_status() === FALSE){
            $this->db->trans_rollback();
        }
        else{
            $this->db->trans_commit();
            return $query->result(); 
        }   
    } 

    public function getbuscaradjuntos($parametros) {	// Recupera Listado de Documentos Propuestas
        $procedure = "call sp_appweb_pt_buscaradjtram(?)";
        $query = $this->db-> query($procedure,$parametros);

        if ($query->num_rows() > 0) { 
            return $query->result();
        }{
            return False;
        }		   
    }

    public function guardar_multiadj($datos) { // Guardar multiples archivos        
        $this->db->trans_begin();

        $procedure = "call sp_appweb_pt_subirtramadj(?,?,?,?);";
        $query = $this->db->query($procedure,$datos);

        if ($this->db->trans_status() === FALSE){
            $this->db->trans_rollback();
        }
        else{
            $this->db->trans_commit();
            return $query->result(); 
        }   
    }
    public function deldetadj($id_tramiteadj) { // Eliminar detalle propuesta    
        $this->db->trans_begin();
        $this->db->delete('pt_tramite_adj', array('id_tramiteadj' => $id_tramiteadj));
        if ($this->db->trans_status() === FALSE){
            $this->db->trans_rollback();
        }else{
            $this->db->trans_commit();
            return true; 
        }
    }
}
?>