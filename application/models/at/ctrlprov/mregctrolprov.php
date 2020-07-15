<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Mregctrolprov extends CI_Model {
	function __construct() {
		parent:: __construct();	
		$this->load->library('session');
    }
    
   /** CONTROL DE PROVEEDORES **/ 
    public function getcboclieserv() { // Visualizar Clientes del servicio en CBO	
        
        $procedure = "call usp_at_ctrlprov_getcboclieserv()";
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
    public function getcboprovxclie($parametros) { // Visualizar Proveedor por cliente en CBO	
        
        $procedure = "call usp_at_ctrlprov_getcboprovxclie(?)";
		$query = $this->db-> query($procedure,$parametros);
        
        if ($query->num_rows() > 0) {

            $listas = '<option value="" selected="selected">::Elegir</option>';
            
            foreach ($query->result() as $row)
            {
                $listas .= '<option value="'.$row->IDPROV.'">'.$row->DESCRIPPROV.'</option>';  
            }
               return $listas;
        }{
            return false;
        }	
    }
    public function getcbomaqxprov($parametros) { // Visualizar Maquilador por proveedor en CBO	
        
        $procedure = "call usp_at_ctrlprov_getcbomaqxprov(?)";
		$query = $this->db-> query($procedure,$parametros);
        
        if ($query->num_rows() > 0) {

            $listas = '<option value="" selected="selected">::Elegir</option>';
            
            foreach ($query->result() as $row)
            {
                $listas .= '<option value="'.$row->IDMAQ.'">'.$row->DESCRIPMAQ.'</option>';  
            }
               return $listas;
        }{
            return false;
        }	
    }	
    public function getcboinspector() { // Visualizar Clientes del servicio en CBO	
        
        $procedure = "call usp_at_ctrlprov_getcboinspector()";
		$query = $this->db-> query($procedure);
        
        if ($query->num_rows() > 0) {

            $listas = '<option value="" selected="selected">::Elegir</option>';
            
            foreach ($query->result() as $row)
            {
                $listas .= '<option value="'.$row->IDINSP.'">'.$row->DESCRIPINSP.'</option>';  
            }
               return $listas;
        }{
            return false;
        }	
    }	
    public function getcboestado() {	// Visualizar Estado en CBO	
        
        $procedure = "call usp_at_ctrlprov_getcboestado()";
		$query = $this->db-> query($procedure);
        
        if ($query->num_rows() > 0) {

            $listas = '<option value="" selected="selected">::Elegir</option>';
            
            foreach ($query->result() as $row)
            {
                $listas .= '<option value="'.$row->IDESTADO.'">'.$row->DESCRIPESTADO.'</option>';  
            }
               return $listas;
        }{
            return false;
        }	
    }
    public function getcbocalif() { // // Visualizar Calificacion en CBO	
        
        $procedure = "call usp_at_ctrlprov_getcbocalif()";
		$query = $this->db-> query($procedure);
        
        if ($query->num_rows() > 0) {

            $listas = '<option value="" selected="selected">::Elegir</option>';
            
            foreach ($query->result() as $row)
            {
                $listas .= '<option value="'.$row->IDCALIF.'">'.$row->DESCRIPCALIF.'</option>';  
            }
               return $listas;
        }{
            return false;
        }	
    }

}
?>