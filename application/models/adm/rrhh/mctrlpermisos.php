<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Mctrlpermisos extends CI_Model {
	function __construct() {
		parent::__construct();	
		$this->load->library('session');
    }
    
   /** CONTROL PERMISOS - VACACIONES - EXTRAS **/ 

    public function getempleados($ccia,$carea) { // recupera los empleados     
        $sql = "select id_empleado, (nrodoc+' - '+b.datosrazonsocial) as 'empleado' 
        from adm_rrhh_empleado a join adm_administrado b on b.id_administrado = a.id_administrado
        where (a.ccompania = '".$ccia."' or '".$ccia."' = '0') and (a.carea = '".$carea."' or '".$carea."' = '0') ;";
        $query  = $this->db->query($sql);
            
        if ($query->num_rows() > 0) {
            $listas = '<option value="-1">::Todos</option>';            
            foreach ($query->result() as $row) {
                $listas .= '<option value="'.$row->id_empleado.'">'.$row->empleado.'</option>';  
            }
            return $listas;
        }{
            return false;
        }		   
    }		
    public function getlistempleadosperm($parametros) { // Recupera listado empleados     
        $procedure = "call sp_appweb_rrhh_getempleadosperm(?,?,?)";
        $query = $this->db-> query($procedure,$parametros);
        
        if ($query->num_rows() > 0) { 
            return $query->result();
        }{
            return False;
        }
    }		
    public function getexcelresumenperm_cabecera($parametros) { // Recupera datos del empleado para resumen    
        $procedure = "call sp_formato_ctrlpermisos_resumenpermisos_cabecera(?)";
        $query = $this->db-> query($procedure,$parametros);
        
        if ($query->num_rows() > 0) { 
            return $query->result();
        }{
            return False;
        }
    }		
    public function getexcelresumenperm_listvaca($parametros) { // Recupera listado de vacaciones del empleado    
        $procedure = "call sp_formato_ctrlpermisos_resumenpermisos_detvaca(?)";
        $query = $this->db-> query($procedure,$parametros);
        
        if ($query->num_rows() > 0) { 
            return $query->result();
        }{
            return False;
        }
    }	
    public function getexcelresumenperm_listext($parametros) { // Recupera listado de vacaciones del empleado    
        $procedure = "call sp_formato_ctrlpermisos_resumenpermisos_detextra(?)";
        $query = $this->db-> query($procedure,$parametros);
        
        if ($query->num_rows() > 0) { 
            return $query->result();
        }{
            return False;
        }
    }
    public function getexcelresumenperm_listperm($parametros) { // Recupera listado de vacaciones del empleado    
        $procedure = "call sp_formato_ctrlpermisos_resumenpermisos_detperm(?)";
        $query = $this->db-> query($procedure,$parametros);
        
        if ($query->num_rows() > 0) { 
            return $query->result();
        }{
            return False;
        }
    }
	public function getlistvacaciones($parametros) { //Listado dedias de vacaciones x empleado
        $procedure = "call usp_adm_rrhh_getlistarvacaciones(?)";
		$query = $this->db->query($procedure,$parametros);

		if ($query->num_rows() > 0) {
            $data = $query->result();
			$query->free_result(); 
			return $data;
		}{
			return False;
		}	
    }
	public function setvacaciones($parametros) { // Registrar Vacaciones		
        $this->db->trans_begin();
    
        $procedure = "call usp_adm_rrhh_setvacaciones(?,?,?,?,?,?,?)";
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
	public function getlistpermisos($parametros) { //Listado dedias de vacaciones x empleado
        $procedure = "call usp_adm_rrhh_getlistarpermisos(?)";
		$query = $this->db->query($procedure,$parametros);

		if ($query->num_rows() > 0) {
            $data = $query->result();
			$query->free_result(); 
			return $data;
		}{
			return False;
		}	
    }

	public function delPermisos($parametros) { //Eliminar Registro		
        $this->db->trans_begin();

		$procedure = "call sp_appweb_rrhh_deletelistvacacionespermisos(?)";
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


   /* ------------- */

}
?>
