<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Mexcelauditoria extends CI_Model {
	function __construct() {
		parent::__construct();	
		$this->load->library('session');
    }
    public function xlschecklistpadres($parametros) { // Recupera datos del empleado para resumen    
        $procedure = "call usp_at_audi_xlschecklistpadres(?,?,?)";
        $query = $this->db-> query($procedure,$parametros);
        
        if ($query->num_rows() > 0) { 
            return $query->result();
        }{
            return False;
        }
    }		
    public function xlschecklistresult($parametros) { // Recupera datos del empleado para resumen    
        $procedure = "call usp_at_audi_xlschecklistresult(?,?,?)";
        $query = $this->db-> query($procedure,$parametros);
        
        if ($query->num_rows() > 0) { 
            return $query->result();
        }{
            return False;
        }
    }		
    public function xlschecklistdetalle($parametros) { // Recupera datos del empleado para resumen    
        $procedure = "call usp_at_audi_xlschecklistdetalle(?,?,?,?,?)";
        $query = $this->db-> query($procedure,$parametros);
        
        if ($query->num_rows() > 0) { 
            return $query->result();
        }{
            return False;
        }
    }

    public function getpdfdatosaudi($idaudi,$fservi) { // Listar Ensayos	
        $sql = "select a.dinformefinal as 'NROINFORME', d.dservicio as 'SERVICIO', e.dsubservicio as 'SUBSERVICIO', f.drazonsocial as 'CLIENTE', a.fservicio as 'FSERVICIO', 
                    g.destablecimiento as 'ESTABLECIMIENTO',uf_fecha_texto(a.fservicio) as 'TEXTFECHA', a.cauditoriainspeccion 
                from pdauditoriainspeccion a 
                    join pcauditoriainspeccion b on b.cauditoriainspeccion = a.cauditoriainspeccion
                    join pdpte c on c.cinternopte = b.cinternopte and c.norden = b.norden
                    join mservicio d on d.ccompania = c.ccompania and d.cservicio = c.cservicio
                    join msubservicio e on e.ccompania = c.ccompania and e.cservicio = c.cservicio and e.csubservicio = c.csubservicio
                    join mcliente f on f.ccliente = b.ccliente
                    join mestablecimientocliente g on g.cestablecimiento = b.cestablecimiento 
                where ( a.cauditoriainspeccion = '".$idaudi."' ) and  
                    ( a.fservicio = '".$fservi."' ) ;";
        $query  = $this->db->query($sql);

		if ($query->num_rows() > 0) { 
			return $query->result();
		}{
			return False;
		}		
    }

    public function getpdfcalifzona($idaudi,$fservi) { // Listar Ensayos	
        $sql = "select d.destablearea, c.calificacion, e.ddetallecriterioresultado, d.cestablecimeinto, d.cestablearea ,
                    a.cchecklist
                from pdauditoriainspeccion a
                    join pcauditoriainspeccion b on b.cauditoriainspeccion = a.cauditoriainspeccion
                    join pvaloracalificacion c on c.cauditoriainspeccion = a.cauditoriainspeccion and c.fservicio = a.fservicio
                    join mestablecimientoarea d on d.cestablecimeinto = b.cestablecimiento and d.cestablearea = c.cestablearea
                    join mdetallecriterioresultado e on e.ccriterioresultado = c.ccriterioresultado and e.cdetallecriterioresultado = c.cdetallecriterioresultado
                where ( a.cauditoriainspeccion = '".$idaudi."' ) and  
                    ( a.fservicio = '".$fservi."' ) ;";
        $query  = $this->db->query($sql);

		if ($query->num_rows() > 0) { 
			return $query->result();
		}{
			return False;
		}		
    }

    public function getpdfhallazgocab($idaudi,$fservi,$cchecklist,$cestablearea) { // Listar Ensayos	
        $sql = "select a.crequisitochecklist as 'crequisito', a.drequisito as 'drequisito'
                from mrequisitochecklist a
                    join pvalorchecklist b on b.cchecklist = a.cchecklist and b.crequisitochecklist = a.crequisitochecklist
                where ( b.cauditoriainspeccion = '".$idaudi."' ) and  
                    ( b.fservicio = '".$fservi."' ) and
                    ( b.cestablearea = '".$cestablearea."' ) and
                    ( a.cchecklist = '".$cchecklist."' ) and
                    ( a.crequisitochecklistpadre = '0000' ) and
                    ( (select  sum(len(trim(isnull(z.dhallazgo,'')))) from pvalorchecklist z join mrequisitochecklist y on y.cchecklist = z.cchecklist and y.crequisitochecklist = z.crequisitochecklist  where z.cauditoriainspeccion = b.cauditoriainspeccion and z.fservicio = b.fservicio and z.cestablearea = b.cestablearea and z.cchecklist = a.cchecklist and y.crequisitochecklistpadre = a.crequisitochecklist) > 0);";
        $query  = $this->db->query($sql);

		if ($query->num_rows() > 0) { 
			return $query->result();
		}{
			return False;
		}		
    }

    public function getpdfhallazgodet($idaudi,$fservi,$cchecklist,$cestablearea,$crequisitochecklist) { // Listar Ensayos	
        $sql = "select a.crequisitochecklist as 'crequisito', a.drequisito as 'drequisito', b.dhallazgo as 'dhallazgo', c.drutaevidencia+'/'+c.darchivoevidencia as 'foto'
                from mrequisitochecklist a
                    join pvalorchecklist b on b.cchecklist = a.cchecklist and b.crequisitochecklist = a.crequisitochecklist
                    left outer join pvalorevidencias c on c.cauditoriainspeccion = b.cauditoriainspeccion and c.fservicio = b.fservicio and c.cestablearea = b.cestablearea and c.cchecklist = a.cchecklist and c.crequisitochecklist = a.crequisitochecklist
                where ( b.cauditoriainspeccion = '".$idaudi."' ) and  
                    ( b.fservicio = '".$fservi."' ) and
                    ( b.cestablearea = '".$cestablearea."' ) and
                    ( a.cchecklist = '".$cchecklist."' ) and
                    ( a.crequisitochecklistpadre = '".$crequisitochecklist."' ) and
                    ( (len(trim(isnull(b.dhallazgo,'')))) > 0);";
        $query  = $this->db->query($sql);

		if ($query->num_rows() > 0) { 
			return $query->result();
		}{
			return False;
		}		
    }
}
?>