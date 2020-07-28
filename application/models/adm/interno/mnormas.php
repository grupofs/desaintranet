<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Mnormas extends CI_Model {
	function __construct() {
		parent::__construct();	
		$this->load->library('session');
    }
	
	public function getDocumentos(){ //Obtener documentos
		$procedure = "call sp_appweb_gettipo_documento()";
		$query = $this->db-> query($procedure);
        
        if ($query->num_rows() > 0) {

            $listas = '<option value="%" >TODOS</option>';
            
            foreach ($query->result() as $row)
            {
                $listas .= '<option value="'.$row->ID.'">'.$row->VALUE.'</option>';  
            }
               return $listas;
        }{
            return false;
        }	
    }
    
    public function getidioma() /* Lista los Idiomas */
    { 
        $sql = "CALL sp_appweb_get_idiomas()";
        $query  = $this->db->query($sql);
        
        if ($query->num_rows() > 0) {
            return $query -> result();
        }{
            return false;
        }		   
    }

    public function getpais() /* Lista los Paises */
    { 
        $sql = "CALL sp_appweb_get_pais()";
        $query  = $this->db->query($sql);
        
        if ($query->num_rows() > 0) {
            return $query -> result();
        }{
            return false;
        }		   
    }

    public function getinstitucion() /* Lista las Instituciones */
    { 
        $sql = "CALL sp_appweb_get_institucion()";
        $query  = $this->db->query($sql);
        
        if ($query->num_rows() > 0) {
            return $query -> result();
        }{
            return false;
        }		   
    }	

    /*****************************/  
		/** BUSQUEDA DE NORMATIVAS **/

    public function getbuscarnomativa($parametros) /* Lista la Busqueda por SP con parametros */
    {
        $procedure = "call sp_appweb_gestdoc_buscarnormas(?,?,?,?,?,?,?,?,?,?,?)";
        $query = $this->db-> query($procedure,$parametros);

        if ($query->num_rows() > 0) { 
            return $query->result();
        }{
            return False;
        }		   
    }
}
?>