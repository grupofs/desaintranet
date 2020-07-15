<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Mptcliente extends CI_Model {
	function __construct() {
		parent:: __construct();	
		$this->load->library('session');
    }

    public function getbuscarclientes($parametros) { // Lista de consultas de Cliente
        $procedure = "call sp_appweb_mantgeneral_buscarcliente(?)";
        $query = $this->db-> query($procedure,$parametros);

        if ($query->num_rows() > 0) { 
            return $query->result();
        }{
            return False;
        }		   
    }
		
    public function setptcliente($parametros) { // Guardar Cliente
        $this->db->trans_begin();

        $procedure = "call sp_appweb_mantgeneral_setcliente(?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)";
        $query = $this->db-> query($procedure,$parametros);

        if ($this->db->trans_status() === FALSE){
            $this->db->trans_rollback();
        }else {
            $this->db->trans_commit();
            return $query->result(); 
        }   
    } 

    public function getbuscarestablecimiento($parametros) { // Lista de consultas de Cliente
        $procedure = "call sp_appweb_mantgeneral_buscarestablecimiento(?)";
        $query = $this->db-> query($procedure,$parametros);

        if ($query->num_rows() > 0) { 
            return $query->result();
        }{
            return False;
        }		   
    }
		
    public function mantgral_establecimiento($parametros) { // Guardar Cliente
        $this->db->trans_begin();

        $procedure = "call sp_appweb_pt_mantgeneral_establecimiento(?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)";
        $query = $this->db-> query($procedure,$parametros);

        if ($this->db->trans_status() === FALSE){
            $this->db->trans_rollback();
        }else {
            $this->db->trans_commit();
            return $query->result(); 
        }   
    } 

}
?>