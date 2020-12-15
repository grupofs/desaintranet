<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Mingresos extends CI_Model {
    function __construct() {
        parent::__construct();	
        $this->load->library('session');
    }
    
   /** AUDITORIA **/ 
    public function getcboempresa() { // Visualizar Clientes del servicio en CBO	
        
        $procedure = "call usp_adm_conta_getcboempresa()";
		$query = $this->db-> query($procedure);
        
        if ($query->num_rows() > 0) {

            $listas = '<option value="0" selected="selected">::Elegir</option>';
            
            foreach ($query->result() as $row)
            {
                $listas .= '<option value="'.$row->CCLIENTE.'">'.$row->DCLIENTE.'</option>';  
            }
               return $listas;
        }{
            $listas = '<option value="" selected="selected">Sin Datos...</option>';
            return $listas;
        }	
    } 

    public function getbuscaringresos($parametros) { // Recupera Listado de Propuestas      
		$procedure = "call usp_adm_conta_getbuscardocingresos(?,?,?,?,?,?)";
		$query = $this->db-> query($procedure,$parametros);

		if ($query->num_rows() > 0) { 
			return $query->result();
		}{
			return False;
		}	
    }

    public function getlistaringresos($docingresos) { // Recupera Listado de Propuestas      
        $sql = "select cast(id_anio as char(4)) as 'ANIO',f_getconvert_nummes(id_mes) as 'MES', left(MES,3)+'-'+ANIO as 'PERIODO',fecha_pago,tipo_pago,monto_pago,id_ingresos 
                from adm_conta_ingresos where id_docingresos = ".$docingresos.";";
		$query = $this->db-> query($sql);

		if ($query->num_rows() > 0) { 
			return $query->result();
		}{
			return False;
		}	
    }

    public function setdocingreso($parametros) {  // Registrar informe PT
        $this->db->trans_begin();

        $procedure = "call usp_adm_conta_setdocingreso(?,?,?);";
        $query = $this->db->query($procedure,$parametros);

        if ($this->db->trans_status() === FALSE){
            $this->db->trans_rollback();
        }else{
            $this->db->trans_commit();
            return $query->result(); 
        }   
    }

    public function setpago($parametros) {  // Registrar informe PT
        $this->db->trans_begin();

        $procedure = "call usp_adm_conta_setpagar(?,?,?,?,?,?,?,?,?,?,?,?,?);";
        $query = $this->db->query($procedure,$parametros);

        if ($this->db->trans_status() === FALSE){
            $this->db->trans_rollback();
        }else{
            $this->db->trans_commit();
            return $query->result(); 
        }   
    }

    public function getcodigocontain() { // Visualizar Clientes del servicio en CBO	
        
        $sql = "select id_codigo as 'ID', (codigo+' - '+descodigo) as 'CODIGO' from adm_conta_codigos where grupo_codigo = 'IN' order by codigo;";
		$query = $this->db-> query($sql);
        
        if ($query->num_rows() > 0) {

            $listas = '<option value="0" selected="selected">::Elegir</option>';
            
            foreach ($query->result() as $row)
            {
                $listas .= '<option value="'.$row->ID.'">'.$row->CODIGO.'</option>';  
            }
               return $listas;
        }{
            return false;
        }	
    } 

    public function getctabancos() { // Visualizar Clientes del servicio en CBO	
        
        $sql = "select id_ctabanco as 'ID', descripcion_cta as 'CTABANCO' from adm_conta_ctabancaria order by id_banco;";
		$query = $this->db-> query($sql);
        
        if ($query->num_rows() > 0) {

            $listas = '<option value="0" selected="selected">::Elegir</option>';
            
            foreach ($query->result() as $row)
            {
                $listas .= '<option value="'.$row->ID.'">'.$row->CTABANCO.'</option>';  
            }
               return $listas;
        }{
            return false;
        }	
    } 

}
?>