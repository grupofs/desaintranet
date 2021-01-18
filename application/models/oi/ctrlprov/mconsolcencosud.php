<?php
class Mctrlproveedores extends CI_Model
{
    function __construct()
	{
		parent::__construct();
    }

    // Lista de consolidado cencosud
    public function getconsolidadocencosud($parametros)
    {
        $procedure = "call usp_oi_ctrlprov_getconsolidadocencosud(?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)";
        $query = $this->db-> query($procedure,$parametros);

        if ($query->num_rows() > 0) { 
            return $query->result();
        }{
            return False;
        }		   
    }
}
?>