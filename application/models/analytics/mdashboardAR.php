<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class MdashboardAR extends CI_Model {
	function __construct() {
		parent::__construct();	
		$this->load->library('session');
    }

    public function gettendenciaanualrendi($parametros)
    {
        $procedure = "call sp_report_ar_evalprod_tendenciaanualrendimiento(?,?)";
        $query = $this->db-> query($procedure,$parametros);

        if ($query->num_rows() > 0) { 
            return $query->result();
        }{
            return False;
        }		   
    }

    public function getdistproductolinea($parametros)
    {
        $procedure = "call sp_report_ar_evalprod_distproductolinea(?,?,?)";
        $query = $this->db-> query($procedure,$parametros);

        if ($query->num_rows() > 0) { 
            return $query->result();
        }{
            return False;
        }		   
    }

    public function getgrafcaproprodlinea($parametros)
    {
        $procedure = "call sp_report_ar_evalprod_grafaproprodlinea(?,?,?)";
        $query = $this->db-> query($procedure,$parametros);

        if ($query->num_rows() > 0) { 
            return $query->result();
        }{
            return False;
        }		   
    }

    public function getporcaproprodlinea($parametros)
    {
        $procedure = "call sp_report_ar_evalprod_porcaproprodlinea(?,?,?)";
        $query = $this->db-> query($procedure,$parametros);

        if ($query->num_rows() > 0) { 
            return $query->result();
        }{
            return False;
        }		   
    }
}
?>