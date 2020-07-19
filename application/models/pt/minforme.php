<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Minforme extends CI_Model {
	function __construct() {
		parent:: __construct();	
		$this->load->library('session');
    }
    
   /** INFORME **/ 		
    public function getServicio() { // Visualizar Servicios en CBO	
        
        $procedure = "call sp_appweb_pt_getservicio()";
		$query = $this->db-> query($procedure);
        
        if ($query->num_rows() > 0) {

            $listas = '<option value="%" selected="selected">::Elegir</option>';
            
            foreach ($query->result() as $row)
            {
                $listas .= '<option value="'.$row->IDSERVI.'">'.$row->DESCRIPSERV.'</option>';  
            }
               return $listas;
        }{
            return false;
        }	
    }
    public function getclienteinfor() { // Visualizar Clientes con informes en CBO	
        
        $procedure = "call sp_appweb_pt_getclienteinfor()";
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
    public function getbuscarinforme($parametros) { // Recupera Listado de informes
        
		$procedure = "call sp_appweb_pt_buscarinforme(?,?,?,?,?,?,?)";
		$query = $this->db-> query($procedure,$parametros);

		if ($query->num_rows() > 0) { 
			return $query->result();
		}{
			return False;
		}	
    }
    public function getpropuevaluar($parametros) { // Visualizar NRO propuestas a evaluaren CBO	
        
        $procedure = "call sp_appweb_pt_getpropuevaluar(?)";
		$query = $this->db-> query($procedure,$parametros);
        
        if ($query->num_rows() > 0) {

            $listas = '<option value="" selected="selected">::Elegir</option>';
            
            foreach ($query->result() as $row)
            {
                $listas .= '<option value="'.$row->IDPTPROPU.'">'.$row->NROPROPU.'</option>';  
            }
               return $listas;
        }{
            return false;
        }	
    }	
    public function getservicioevaluar($parametros) { // Visualizar servicios a evaluaren CBO	
        
        $procedure = "call sp_appweb_pt_getservicioevaluar(?)";
		$query = $this->db-> query($procedure,$parametros);
        
        if ($query->num_rows() > 0) {
            return $query->result();
        }{
            return false;
        }	
    }
    public function setevaluacion($parametros) {  // Registrar evaluacion PT
        $this->db->trans_begin();

        $procedure = "call sp_appweb_pt_setevaluacion(?,?,?);";
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
    public function getnroinforme($parametros) { // Obtener numero de propuesta
        
		$procedure = "call sp_appweb_pt_getnroinforme(?)";
		$query = $this->db-> query($procedure,$parametros);

		if ($query->num_rows() > 0) { 
			return $query->result();
		}{
			return False;
		}	
    }	
    public function setinforme($parametros) {  // Registrar informe PT
        $this->db->trans_begin();

        $procedure = "call sp_appweb_pt_setinforme(?,?,?,?,?,?,?);";
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

        $procedure = "call sp_appweb_pt_inforsubirarchivo(?,?,?,?);";
        $query = $this->db->query($procedure,$parametros);

        if ($this->db->trans_status() === FALSE){
            $this->db->trans_rollback();
        }
        else{
            $this->db->trans_commit();
            return $query->result(); 
        }   
    } 	
    public function delinforme($idptinforme) { // Recuperar Password
    
        $data = array("vigencia" => 'I');

        $this->db->where("idptinforme", $idptinforme);
        if($this->db->update("pt_informe", $data))
        {
            return TRUE;
        }
    }	
    public function getlistinforme($parametros) { // Recupera Listado de Reg. informes
        
		$procedure = "call sp_appweb_pt_getlistinforme(?)";
		$query = $this->db-> query($procedure,$parametros);

		if ($query->num_rows() > 0) { 
			return $query->result();
		}{
			return False;
		}	
    }    	
    public function getlistregistro($parametros) { // Recupera Listado de Registros
        
		$procedure = "call sp_appweb_pt_getlistregistros(?,?)";
		$query = $this->db-> query($procedure,$parametros);

		if ($query->num_rows() > 0) { 
			return $query->result();
		}{
			return False;
		}	
    } 	
    public function getrecuperaregequi($parametros) { // Recupera datos del equipo
        
		$procedure = "call sp_appweb_pt_getrecuperaregequi(?)";
		$query = $this->db-> query($procedure,$parametros);

		if ($query->num_rows() > 0) { 
			return $query->result();
		}{
			return False;
		}	
    }
    public function getrecuperaregproduc($parametros) { // Recupera datos del producto
        
		$procedure = "call sp_appweb_pt_getrecuperaregproduc(?)";
		$query = $this->db-> query($procedure,$parametros);

		if ($query->num_rows() > 0) { 
			return $query->result();
		}{
			return False;
		}	
    }
    public function getrecuperaregproducequi($parametros) { // Recupera datos del producto y equipo
        
		$procedure = "call sp_appweb_pt_getrecuperaregproducequi(?)";
		$query = $this->db-> query($procedure,$parametros);

		if ($query->num_rows() > 0) { 
			return $query->result();
		}{
			return False;
		}	
    }
    public function getrecuperaregrecinto($parametros) { // Recupera datos del producto y equipo
        
		$procedure = "call sp_appweb_pt_getrecuperaregrecinto(?)";
		$query = $this->db-> query($procedure,$parametros);

		if ($query->num_rows() > 0) { 
			return $query->result();
		}{
			return False;
		}	
    }
    public function getrecuperaregequiproduc($parametros) { // Recupera datos del producto y equipo
        
		$procedure = "call sp_appweb_pt_getrecuperaregequiproduc(?)";
		$query = $this->db-> query($procedure,$parametros);

		if ($query->num_rows() > 0) { 
			return $query->result();
		}{
			return False;
		}	
    }
    public function getrecuperaregestuproduc($parametros) { // Recupera datos del producto y equipo
        
		$procedure = "call sp_appweb_pt_getrecuperaregestuproduc(?)";
		$query = $this->db-> query($procedure,$parametros);

		if ($query->num_rows() > 0) { 
			return $query->result();
		}{
			return False;
		}	
    }
    public function getrecuperaregestu($parametros) { // Recupera datos del producto y equipo
        
		$procedure = "call sp_appweb_pt_getrecuperaregestu(?)";
		$query = $this->db-> query($procedure,$parametros);

		if ($query->num_rows() > 0) { 
			return $query->result();
		}{
			return False;
		}	
    }
    public function getrecuperaregestuproducequi($parametros) { // Recupera datos del producto y equipo
        
		$procedure = "call sp_appweb_pt_getrecuperaregestuproducequi(?)";
		$query = $this->db-> query($procedure,$parametros);

		if ($query->num_rows() > 0) { 
			return $query->result();
		}{
			return False;
		}	
    }
    public function getEstudio($parametros) { // Visualizar Servicios en CBO	
        
        $procedure = "call sp_appweb_pt_getEstudio(?)";
		$query = $this->db-> query($procedure,$parametros);
        
        if ($query->num_rows() > 0) {

            $listas = '<option value="" selected="selected">::Elegir</option>';            
            foreach ($query->result() as $row){
                $listas .= '<option value="'.$row->IDESTU.'">'.$row->DESCRIPESTU.'</option>';  
            }
            return $listas;
        }{
            return false;
        }	
    }
    public function setregestudio01($parametros) {  // Registrar estudio 01 PT
        $this->db->trans_begin();

        $procedure = "call sp_appweb_pt_setregistro01(?,?,?,?,?,?,?,?,?,?,?,?);";
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
    public function setregestudio03($parametros) {  // Registrar estudio 03 PT
        $this->db->trans_begin();

        $procedure = "call sp_appweb_pt_setregistro03(?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?);";
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
    public function setregestudio06($parametros) {  // Registrar estudio 06 PT
        $this->db->trans_begin();

        $procedure = "call sp_appweb_pt_setregistro06(?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?);";
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
    public function setregestudio08($parametros) {  // Registrar estudio 08 PT
        $this->db->trans_begin();

        $procedure = "call sp_appweb_pt_setregistro08(?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?);";
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
    public function setregestudio09($parametros) {  // Registrar estudio 09 PT
        $this->db->trans_begin();

        $procedure = "call sp_appweb_pt_setregistro09(?,?,?,?,?,?,?,?,?,?,?);";
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
    public function setregestudio10($parametros) {  // Registrar estudio 10 PT
        $this->db->trans_begin();

        $procedure = "call sp_appweb_pt_setregistro10(?,?,?,?,?,?,?,?,?,?,?,?,?);";
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
    public function setregestudio11($parametros) {  // Registrar estudio 11 PT
        $this->db->trans_begin();

        $procedure = "call sp_appweb_pt_setregistro11(?,?,?,?,?,?,?,?,?,?,?);";
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
    public function setregestudio12($parametros) {  // Registrar estudio 12 PT
        $this->db->trans_begin();

        $procedure = "call sp_appweb_pt_setregistro12(?,?,?,?,?,?,?,?,?,?,?,?,?,?);";
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
    public function setregestudio13($parametros) {  // Registrar estudio 13 PT
        $this->db->trans_begin();

        $procedure = "call sp_appweb_pt_setregistro13(?,?,?,?,?,?,?,?,?,?,?,?,?,?,?);";
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
    public function setregestudio14($parametros) {  // Registrar estudio 14 PT
        $this->db->trans_begin();

        $procedure = "call sp_appweb_pt_setregistro14(?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?);";
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
    public function setregestudio15($parametros) {  // Registrar estudio 14 PT
        $this->db->trans_begin();

        $procedure = "call sp_appweb_pt_setregistro15(?,?,?,?,?,?,?,?);";
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
    public function getlistequipoxprod($parametros) { // Recupera Listado de Registros
        
		$procedure = "call sp_appweb_pt_getlistequipoxprod(?)";
		$query = $this->db-> query($procedure,$parametros);

		if ($query->num_rows() > 0) { 
			return $query->result();
		}{
			return False;
		}	
    } 
    public function getTipoequipo($parametros) { // Visualizar los Tipo Equipos de Registro	
        
        $procedure = "call sp_appweb_pt_getequipo(?)";
		$query = $this->db-> query($procedure,$parametros);
        
        if ($query->num_rows() > 0) {

            $listas = '<option value="" selected="selected">::Elegir</option>';
            
            foreach ($query->result() as $row)
            {
                $listas .= '<option value="'.$row->IDEQUI.'">'.$row->DESCRIPEQUI.'</option>';  
            }
               return $listas;
        }{
            return false;
        }	
    }
    public function getTiporecinto($parametros) { // Visualizar los Tipo recinto de Registro	
        
        $procedure = "call sp_appweb_pt_getrecinto(?)";
		$query = $this->db-> query($procedure,$parametros);
        
        if ($query->num_rows() > 0) {

            $listas = '<option value="" selected="selected">::Elegir</option>';
            
            foreach ($query->result() as $row)
            {
                $listas .= '<option value="'.$row->IDRECI.'">'.$row->DESCRIPRECI.'</option>';  
            }
               return $listas;
        }{
            return false;
        }	
    }
    public function getMediocalen($parametros) { // Visualizar los Medio de de Registro	
        
        $procedure = "call sp_appweb_pt_getmedio_calentamiento(?)";
		$query = $this->db-> query($procedure,$parametros);
        
        if ($query->num_rows() > 0) {

            $listas = '<option value="" selected="selected">::Elegir</option>';
            
            foreach ($query->result() as $row)
            {
                $listas .= '<option value="'.$row->IDMEDIOCAL.'">'.$row->DESCRIPCAL.'</option>';  
            }
               return $listas;
        }{
            return false;
        }	
    }
    public function getFabricante($parametros) { // Visualizar los Fabricantes	
        
        $procedure = "call sp_appweb_pt_getfabricante(?)";
		$query = $this->db-> query($procedure,$parametros);
        
        if ($query->num_rows() > 0) {

            $listas = '<option value="" selected="selected">::Elegir</option>';
            
            foreach ($query->result() as $row)
            {
                $listas .= '<option value="'.$row->IDFAB.'">'.$row->DESCRIPFAB.'</option>';  
            }
               return $listas;
        }{
            return false;
        }	
    }
    public function getTipoproducto($parametros) { // Visualizar los Tipos de productos	
        
        $procedure = "call sp_appweb_pt_getproducto(?)";
		$query = $this->db-> query($procedure,$parametros);
        
        if ($query->num_rows() > 0) {

            $listas = '<option value="" selected="selected">::Elegir</option>';
            
            foreach ($query->result() as $row)
            {
                $listas .= '<option value="'.$row->IDPRO.'">'.$row->DESCRIPPRO.'</option>';  
            }
               return $listas;
        }{
            return false;
        }	
    }
    public function getParticulas($parametros) { // Visualizar los Tipos de productos	
        
        $procedure = "call sp_appweb_pt_getdetaparticula(?)";
		$query = $this->db-> query($procedure,$parametros);
        
        if ($query->num_rows() > 0) {

            $listas = '<option value="" selected="selected">::Elegir</option>';
            
            foreach ($query->result() as $row)
            {
                $listas .= '<option value="'.$row->IDDETAPARTI.'">'.$row->DESCRIPDETAPARTI.'</option>';  
            }
               return $listas;
        }{
            return false;
        }	
    }
    public function getLiquidogob($parametros) { // Visualizar los Liquido Gobierno	
        
        $procedure = "call sp_appweb_pt_getliquido_gobierno(?)";
		$query = $this->db-> query($procedure,$parametros);
        
        if ($query->num_rows() > 0) {

            $listas = '<option value="" selected="selected">::Elegir</option>';
            
            foreach ($query->result() as $row)
            {
                $listas .= '<option value="'.$row->IDLIQUIDGOB.'">'.$row->DESCRIPLIQUIDGOB.'</option>';  
            }
               return $listas;
        }{
            return false;
        }	
    }
    public function getEnvases($parametros) { // Visualizar los Envases	
        
        $procedure = "call sp_appweb_pt_getenvase(?)";
		$query = $this->db-> query($procedure,$parametros);
        
        if ($query->num_rows() > 0) {

            $listas = '<option value="" selected="selected">::Elegir</option>';
            
            foreach ($query->result() as $row)
            {
                $listas .= '<option value="'.$row->IDENV.'">'.$row->DESCRIPENV.'</option>';  
            }
               return $listas;
        }{
            return false;
        }	
    }
    public function getServicioAudi() { // Visualizar Servicios en CBO	
        
        $procedure = "call sp_appweb_pt_getservicioaudi()";
		$query = $this->db-> query($procedure);
        
        if ($query->num_rows() > 0) {

            $listas = '<option value="%" selected="selected">::Elegir</option>';
            
            foreach ($query->result() as $row)
            {
                $listas .= '<option value="'.$row->IDSERVI.'">'.$row->DESCRIPSERV.'</option>';  
            }
               return $listas;
        }{
            return false;
        }	
    }
    

}
?>