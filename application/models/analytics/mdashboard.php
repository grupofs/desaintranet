<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Mdashboard extends CI_Model {
	function __construct() {
		parent::__construct();	
		$this->load->library('session');
    }

    public function getresumenpermisos($parametros) { // Informacion resumen de empleado
        
		$procedure = "call sp_formato_ctrlpermisos_resumenpermisos_cabecera(?)";
		$query = $this->db-> query($procedure,$parametros);

		if ($query->num_rows() > 0) { 
            $data = $query->result();
			$query->free_result(); 
            return $data;
		}{
			return False;
		}	
    }
	public function getlisthorasextras($parametros) { //Listado de Horas Extras x empleado
        $procedure = "call sp_formato_ctrlpermisos_resumenpermisos_detextra(?)";
		$query = $this->db->query($procedure,$parametros);

		if ($query->num_rows() > 0) {
            $data = $query->result();
			$query->free_result(); 
			return $data;
		}{
			return False;
		}	
    }
	public function getlistpermisos($parametros) { //Listado de Horas de permisos x empleado
        $procedure = "call sp_formato_ctrlpermisos_resumenpermisos_detperm(?)";
		$query = $this->db->query($procedure,$parametros);

		if ($query->num_rows() > 0) {
            $data = $query->result();
			$query->free_result(); 
			return $data;
		}{
			return False;
		}	
    }
	public function guardarpermiso($parametros) { // Registrar Permisos		
        $this->db->trans_begin();
    
        $procedure = "call sp_appweb_rrhh_insertpermiso(?,?,?,?,?,?,?,?,?,?,?)";
        $query = $this->db-> query($procedure,$parametros); 
           
        if ($this->db->trans_status() === FALSE){
            $this->db->trans_rollback();
        }
        else{
            $this->db->trans_commit();
            if ($query->num_rows() > 0) {
                return $query->result();
            }{
                return False;
            }	
        }   
    }
    public function getpermisosvacaciones($idpermisosvacaciones) { // lista solo un empleado
    		
        $sql = "select c.datosrazonsocial, a.fecha_salida, a.fecha_retorno, a.hora_salida, a.hora_retorno
                from adm_rrhh_permisosvacaciones a 
                    join adm_rrhh_empleado b on a.id_empleado = b.id_empleado 
                    join adm_administrado c on b.id_administrado = c.id_administrado
                where a.id_permisosvacaciones = ".$idpermisosvacaciones.";";
        $query  = $this->db->query($sql);

       if ($query->num_rows() > 0) {
            return $query->row();
        }{
            return false;
        }         
    }	
}
?>