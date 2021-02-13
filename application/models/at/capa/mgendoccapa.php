<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Mgendoccapa extends CI_Model {
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

}
?>