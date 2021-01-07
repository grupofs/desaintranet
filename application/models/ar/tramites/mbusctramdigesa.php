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
                    and a.ccliente in (select distinct ccliente 
                                from PASUNTOREGULATORIO a 
                                join PTRAMITEREGULATORIOPTE b on b.casuntoregulatorio = a.casuntoregulatorio
                                where b.centidadregula = '001')
				order by b.drazonsocial asc;";
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

	public function getcbomarcaxclie($ccliente){
		$this->db->select('
			cmarca as id,
			dmarca as text,
			*
		');
		$this->db->from('mmarcaxcliente');
		$this->db->where('ccliente', $ccliente);
		$this->db->where('sregistro', 'A');
		$this->db->order_by('dmarca', 'ASC');
		$query = $this->db->get();
		        
        if ($query->num_rows() > 0) {

            $listas = '<option value="0" selected="selected">::Elegir</option>';
            
            foreach ($query->result() as $row)
            {
                $listas .= '<option value="'.$row->id.'">'.$row->text.'</option>';  
            }
               return $listas;
        }{
            $listas = '<option value="" selected="selected">Sin Datos...</option>';
            return $listas;
        }	
    }

	public function getcbotipoprodxentidad(){
        $entidad = '001';
		$this->db->select('
			mtramitereguladora.zctipocategoriaproducto as id,
			ttabla.dregistro as text
		');
		$this->db->from('mtramitereguladora');
		$this->db->join('ttabla', 'mtramitereguladora.zctipocategoriaproducto = ttabla.ctipo', 'inner');
		$this->db->where('mtramitereguladora.centidadregula', $entidad);
		$this->db->order_by('ttabla.dregistro', 'ASC');
		$this->db->group_by("mtramitereguladora.zctipocategoriaproducto, ttabla.dregistro");
		$query = $this->db->get();
		        
        if ($query->num_rows() > 0) {

            $listas = '<option value="0" selected="selected">::Elegir</option>';
            
            foreach ($query->result() as $row)
            {
                $listas .= '<option value="'.$row->id.'">'.$row->text.'</option>';  
            }
               return $listas;
        }{
            $listas = '<option value="" selected="selected">Sin Datos...</option>';
            return $listas;
        }	
    }

	public function getcbotramitextipoproducto($ctipoProducto){
        $centidad = '001';
		$this->db->select('
			ctramite as id,
			dtramite as text,
			*
		');
		$this->db->from('MTRAMITEREGULADORA');
		$this->db->where('SREGISTRO', 'A');
		$this->db->where('CENTIDADREGULA', $centidad, false);
		$this->db->where('zctipocategoriaproducto', $ctipoProducto, false);
		$this->db->order_by('dtramite', 'ASC');
		$query = $this->db->get();
		        
        if ($query->num_rows() > 0) {

            $listas = '<option value="0" selected="selected">::Elegir</option>';
            
            foreach ($query->result() as $row)
            {
                $listas .= '<option value="'.$row->id.'">'.$row->text.'</option>';  
            }
               return $listas;
        }{
            $listas = '<option value="" selected="selected">Sin Datos...</option>';
            return $listas;
        }	
    }
    
        

    public function getconsulta_grid_tr($parametros) { // Recupera Listado de Propuestas      
		$procedure = "call usp_ar_tramite_getconsulta_grid_tr(?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)";
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