<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Mbusctramdigesa extends CI_Model {
    function __construct() {
        parent::__construct();	
        $this->load->library('session');
    }
    
   /** TRAMITES DIGESA **/ 

    public function getclientexusu($idusu) { // Visualizar Clientes del servicio en CBO	
        
        $sql = "select b.ccliente, b.drazonsocial 
		  		from segu_usuario_rol_cliente a 
					join mcliente b on b.ccliente = a.ccliente
				where a.id_usuario = ".$idusu."
				order by b.drazonsocial desc;";
		$query = $this->db-> query($sql);
        
        if ($query->num_rows() > 0) {

            $listas = '<option value="0" selected="selected">::Elegir</option>';
            
            foreach ($query->result() as $row)
            {
                $listas .= '<option value="'.$row->ccliente.'">'.$row->drazonsocial.'</option>';  
            }
               return $listas;
        }{
            return false;
        }	
	} 
	
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

    public function getconsulta_grid_tr($parametros) { // Recupera Listado de Propuestas      
		$procedure = "call sp_appweb_aarr_consulta_grid_tr(?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)";
		$query = $this->db-> query($procedure,$parametros);

		if ($query->num_rows() > 0) { 
			return $query->result();
		}{
			return False;
		}	
    }

    public function getconsulta_excel_tr($parametros) { // Recupera Listado de Propuestas      
		$procedure = "call sp_appweb_aarr_consulta_excel_tr(?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)";
		$query = $this->db-> query($procedure,$parametros);

		if ($query->num_rows() > 0) { 
			return $query->result();
		}{
			return False;
		}	
    }

    public function getbuscartramite($parametros) { // Recupera Listado de Propuestas      
		$procedure = "call sp_appweb_tramdoc_buscartramite(?,?)";
		$query = $this->db-> query($procedure,$parametros);

		if ($query->num_rows() > 0) { 
			return $query->result();
		}{
			return False;
		}	
    }

    public function getdocum_aarr($parametros) { // Recupera Listado de Propuestas      
		$procedure = "call sp_appweb_tramdoc_docum_aarr(?,?,?,?)";
		$query = $this->db-> query($procedure,$parametros);

		if ($query->num_rows() > 0) { 
			return $query->result();
		}{
			return False;
		}	
    }

}
?>