<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Mglobales extends CI_Model{
	function __construct() {
		parent::__construct();
		$this->load->library('session');
    }
		
    public function getconfigemail($idemail) { // Datos del Email
        $query = $this->db->get_where('mmail', array('cmail' => $idemail));

        if($query->num_rows() === 1)
        {
            return $query->row();
        }
    }

    public function getmeses() { // recupera meses del año
       $sql = "select id_mes, mes from adm_mes order by id_mes;";
       $query  = $this->db->query($sql);
           
       if ($query->num_rows() > 0) {

            $listas = '<option value="0">::Elija</option>';
        
            foreach ($query->result() as $row)
            {
                $listas .= '<option value="'.$row->id_mes.'">'.$row->mes.'</option>';  
            }
           return $listas;
        }else{
            return false;
        }		   
    }

    public function getanios() { // recupera los años 
       $sql = "select id_anio, anio, enejercicio from adm_anio order by id_anio desc;";
       $query  = $this->db->query($sql);
           
       if ($query->num_rows() > 0) {
        $listas = '<option value="">" "</option>';                
            foreach ($query->result() as $row){
                if($row->enejercicio == '1'){
                    $listas .= '<option value="'.$row->anio.'" selected="selected">'.$row->anio.'</option>'; 
                }else{
                    $listas .= '<option value="'.$row->anio.'">'.$row->anio.'</option>'; 
                } 
            }
               return $listas;
        }else{
            return false;
        }		   
    }

    public function getareacia($ccia) { // recupera areas por cia 
       $sql = "select ccompania, carea, darea, dcorta, id_jefatura from adm_area where ccompania = '".$ccia."' order by ccompania asc, carea asc;";
       $query  = $this->db->query($sql);
           
       if ($query->num_rows() > 0) {

            $listas = '<option value="0">::Elija</option>';
            
            foreach ($query->result() as $row){
                $listas .= '<option value="'.$row->carea.'">'.$row->darea.'</option>';  
            }
               return $listas;
        }else{
            $listas = '<option value="0">::Todos</option>';
            return $listas;
        }		   
    }

    public function getpaises() { // recupera los paises 
       $sql = "select ctipo, dregistro from ttabla where ctabla = 11 order by dregistro;";
       $query  = $this->db->query($sql);
           
       if ($query->num_rows() > 0) {

            $listas = '<option value="">Elige</option>';
            
            foreach ($query->result() as $row) {
                $listas .= '<option value="'.$row->ctipo.'">'.$row->dregistro.'</option>';  
            }
               return $listas;
        }else{
            return false;
        }		   
    }

    public function getdepartamentos() { // recupera departamentos 
       $sql = "select distinct(cdepartamento) as 'cdepartamento', ddepartamento from tubigeo where cpais = '290' order by ddepartamento asc;";
       $query  = $this->db->query($sql);
           
       if ($query->num_rows() > 0) {

            $listas = '<option value="">Elige</option>';
            
            foreach ($query->result() as $row) {
                $listas .= '<option value="'.$row->cdepartamento.'">'.$row->ddepartamento.'</option>';  
            }
               return $listas;
        }else{
            return false;
        }		   
    }
    public function getprovincias($cdepa) { // recupera provincias
       $sql = "select distinct(cprovincia) as 'cprovincia', dprovincia from tubigeo where cdepartamento = '".$cdepa."' and cpais = '290' order by dprovincia asc;";
       $query  = $this->db->query($sql);
           
       if ($query->num_rows() > 0) {

            $listas = '<option value="">Elige</option>';
            
            foreach ($query->result() as $row) {
                $listas .= '<option value="'.$row->cprovincia.'">'.$row->dprovincia.'</option>';  
            }
               return $listas;
        }{
            return false;
        }		   
    }
    public function getdistritos($cdepa,$cpro) { // recupera distritos
       $sql = "select cdistrito, cubigeo, ddistrito from tubigeo where cprovincia = '".$cpro."' and cdepartamento = '".$cdepa."' and cpais = '290' order by dprovincia asc;";
       $query  = $this->db->query($sql);
           
       if ($query->num_rows() > 0) {

            $listas = '<option value="">Elige</option>';
            
            foreach ($query->result() as $row) {
                $listas .= '<option value="'.$row->cubigeo.'">'.$row->ddistrito.'</option>';  
            }
               return $listas;
        }{
            return false;
        }		   
    }

    public function getubigeo() { // recupera ubigeo
       $sql = "select cubigeo, (ddepartamento+' - '+dprovincia+' - '+ddistrito) as dubigeo from tubigeo ;";
       $query  = $this->db->query($sql);
           
       if ($query->num_rows() > 0) {

            $listas = '<option value="">Elige</option>';
            
            foreach ($query->result() as $row) {
                $listas .= '<option value="'.$row->cubigeo.'">'.$row->dubigeo.'</option>';  
            }
               return $listas;
        }{
            return false;
        }		   
    }

    public function seladministrado($parametros) { // Visualizar listado de modulos
        $procedure = "call usp_adm_seladministrado(?);";
        $query = $this->db-> query($procedure,$parametros);
   
        if ($query->num_rows() > 0) { 
               return $query->result();
        }{
               return False;
        }		
    }  
}
?>