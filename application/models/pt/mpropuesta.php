<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Mpropuesta extends CI_Model {
	function __construct() {
		parent:: __construct();	
		$this->load->library('session');
    }
    
   /** PROPUESTA **/ 
    public function getclientepropu() { // Visualizar Clientes con propuestas en CBO	
        
        $procedure = "call sp_appweb_pt_getclientepropu()";
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
    public function getclienteinternopt() { // Visualizar Clientes en CBO	
        
        $procedure = "call sp_appweb_pt_getclienteinterno()";
		$query = $this->db-> query($procedure);
        
        if ($query->num_rows() > 0) {

            $listas = '<option value="0">::Elegir</option>';
            
            foreach ($query->result() as $row)
            {
                $listas .= '<option value="'.$row->CCLIENTE.'">'.$row->RAZONSOCIAL.'</option>';  
            }
               return $listas;
        }{
            return false;
        }	
    }	
    public function getServicio() { // Visualizar Servicios en CBO	
        
        $procedure = "call sp_appweb_pt_getservicio()";
		$query = $this->db-> query($procedure);
        
        if ($query->num_rows() > 0) {

            $listas = '';
            
            foreach ($query->result() as $row)
            {
                $listas .= '<option value="'.$row->IDSERVI.'">'.$row->DESCRIPSERV.'</option>';  
            }
               return $listas;
        }{
            return false;
        }	
    }	
    public function getbuscarpropuesta($parametros) { // Recupera Listado de Propuestas        
		$procedure = "call sp_appweb_pt_buscarpropuesta(?,?,?,?,?,?,?)";
		$query = $this->db-> query($procedure,$parametros);

		if ($query->num_rows() > 0) { 
			return $query->result();
		}{
			return False;
		}	
    }
    public function getnropropuesta($parametros) { // Obtener numero de propuesta
        
		$procedure = "call sp_appweb_pt_getnropropuesta(?)";
		$query = $this->db-> query($procedure,$parametros);

		if ($query->num_rows() > 0) { 
			return $query->result();
		}{
			return False;
		}	
    }	
    public function getbuscarCliente() { // Tabla de busqueda de clientes
        
		$procedure = "call sp_appweb_pt_buscarcliente()";
		$query = $this->db-> query($procedure);

		if ($query->num_rows() > 0) { 
			return $query->result();
		}{
			return False;
		}	
    }
    public function buscar_establexcliente($parametros) { // Visualizar Servicios en CBO	
        
        $procedure = "call sp_appweb_pt_getestablexcliente(?)";
		$query = $this->db-> query($procedure,$parametros);
        
        if ($query->num_rows() > 0) {

            $listas = '<option value="%" selected="selected">::Elija</option>';
            
            foreach ($query->result() as $row)
            {
                $listas .= '<option value="'.$row->CESTABLE.'">'.$row->DESCRIPESTA.'</option>';  
            }
               return $listas;
        }{
            return false;
        }	
    }	
    public function setpropuesta($parametros) {  // Registrar informe PT
        $this->db->trans_begin();

        $procedure = "call sp_appweb_pt_setpropuesta(?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?);";
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
    public function subirArchivo($parametros) {  // Registrar tramite PT
        $this->db->trans_begin();

        $procedure = "call sp_appweb_pt_propusubirarchivo(?,?,?,?);";
        $query = $this->db->query($procedure,$parametros);

        if ($this->db->trans_status() === FALSE){
            $this->db->trans_rollback();
        }
        else{
            $this->db->trans_commit();
            return $query->result(); 
        }   
    } 		
    public function delpropuesta($parametros) {	// Eliminar de propuesta
        $this->db->trans_begin();

        $procedure = "call sp_appweb_pt_deletepropuesta(?);";
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
    public function updestadopropuesta($parametros) {	// Actualizar estado de propuesta
        $procedure = "call sp_appweb_pt_update_estadopropuesta(?,?)";
        $query = $this->db-> query($procedure,$parametros);

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
    public function getbuscardetapropu($parametros) {	// Recupera Listado de Documentos Propuestas
        $procedure = "call sp_appweb_pt_buscardetapropu(?)";
        $query = $this->db-> query($procedure,$parametros);

        if ($query->num_rows() > 0) { 
            return $query->result();
        }{
            return False;
        }		   
    }
    public function guardar_multiarchivopropu($datos) { // Guardar multiples archivos
        return $this->db->insert("pt_detpropuestaarch", $datos);
    }
    public function deldetpropuesta($item) { // Eliminar detalle propuesta    
        $this->db->trans_begin();
        $this->db->delete('pt_detpropuestaarch', array('item' => $item));
        if ($this->db->trans_status() === FALSE){
            $this->db->trans_rollback();
        }else{
            $this->db->trans_commit();
            return true; 
        }
    }
    public function getextnropropuesta($parametros) { // Extender numero de propuesta        
		$procedure = "call sp_appweb_pt_getextnropropuesta(?)";
		$query = $this->db-> query($procedure,$parametros);

		if ($query->num_rows() > 0) { 
			return $query->result();
		}{
			return False;
		}	
    }

}
?>