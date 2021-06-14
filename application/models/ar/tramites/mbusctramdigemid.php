<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Mbusctramdigemid extends CI_Model {
    function __construct() {
        parent::__construct();	
        $this->load->library('session');
    }
    
   /** TRAMITES DIGEMID **/ 

    public function getclientexusu($idusu) { // Visualizar Clientes del servicio en CBO	
        
        $sql = "select b.ccliente, b.drazonsocial 
		  		from segu_usuario_rol_cliente a 
					join mcliente b on b.ccliente = a.ccliente
				where a.id_usuario = ".$idusu."
                    and a.ccliente in (select distinct ccliente 
                                from PASUNTOREGULATORIO a 
                                join PTRAMITEREGULATORIOPTE b on b.casuntoregulatorio = a.casuntoregulatorio
                                where b.centidadregula = '002')
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
        $entidad = '002';
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
        $centidad = '002';
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
		$procedure = "call sp_appweb_tramdoc_buscartramite(?,?,?)";
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

	public function getArchivos(string $CASUNTOREGULATORIO, string $CENTIDADREGULA, string $CTRAMITE, string $CDOCUMENTO) {
		$this->db->select('DUBICACIONFILESERVER');
		$this->db->from('PDOCUMENTOREGULATORIOARCHIVOS');
		$this->db->where('CASUNTOREGULATORIO', $CASUNTOREGULATORIO);
		$this->db->where('CENTIDADREGULA', $CENTIDADREGULA);
		$this->db->where('CTRAMITE', $CTRAMITE);
		$this->db->where('CDOCUMENTO', $CDOCUMENTO);
		$this->db->where('SREGISTRO', 'A');
		$query = $this->db->get();
		if (!$query) {
			return [];
		}
		return ($query->num_rows()) ? $query->result() : [];
	}

    public function setregproducto($parametros) {  // Registrar evaluacion PT
        $this->db->trans_begin();

        $procedure = "call usp_ar_tramite_setproducto(?,?,?,?,?);";
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

}
?>
