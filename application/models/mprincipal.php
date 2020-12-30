<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Mprincipal extends CI_Model{
	function __construct() {
		parent::__construct();
		$this->load->library('session');
    }
    
   /** MENU **/
	public function getareasacceso($idcia,$idrol) { //Recuperar Areas del Usuario
        $sql = "select distinct c.carea, c.darea, c.dcorta, b.ccompania as 'ccia'
                from segu_rol_permisos a join sist_modulo b on b.id_modulo = a.id_modulo
                join adm_area c on c.ccompania = b.ccompania and c.carea = b.carea
                where a.id_rol = ".$idrol." and (b.CCOMPANIA = '".$idcia."' or '".$idcia."' = '0') and b.clase_modulo = 'W' and b.tipo_modulo = 'M' order by c.carea;";
		$query = $this->db-> query($sql);

		if ($query->num_rows() > 0) {
            $data = $query->result();
			$query->free_result(); 
			return $data;
		}{
			return False;
		}	
    }
	public function getmenumodulo($idcia,$idrol,$idarea) { //Recuperar Modulos del Usuario
        $sql = "select distinct b.id_modulo, b.desc_modulo, class_icono 
                from segu_rol_permisos a join sist_modulo b on b.id_modulo = a.id_modulo
                where a.id_rol = ".$idrol." and b.CCOMPANIA = '".$idcia."' and b.carea = '".$idarea."' and b.clase_modulo = 'W' and b.tipo_modulo = 'M' order by b.id_modulo;";
		$query = $this->db-> query($sql);

		if ($query->num_rows() > 0) {
            $data = $query->result();
			$query->free_result(); 
			return $data;
		}{
			return False;
		}	
    }
	public function getmenuopciones($idrol,$idmodulo) { //Recuperar Opciones del Usuario
        $sql = "select distinct a.id_opcion, c.desc_opcion, c.vista_opcion, c.script_opcion, c.posicion
				from segu_rol_permisos a 
					join sist_modulo b on b.id_modulo = a.id_modulo
					join sist_opcion c on c.id_opcion = a.id_opcion and c.id_modulo = a.id_modulo  
				where a.id_rol = ".$idrol." and a.id_modulo = '".$idmodulo."' order by c.posicion;";
		$query = $this->db-> query($sql);

		if ($query->num_rows() > 0) {
            $data = $query->result();
			$query->free_result(); 
			return $data;
		}{
			return False;
		}	
	}

}
?>