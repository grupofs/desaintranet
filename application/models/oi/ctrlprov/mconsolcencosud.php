<?php
class Mconsolcencosud extends CI_Model
{
    function __construct()
	{
		parent::__construct();
    }

    // Lista de consolidado cencosud
    public function getconsolidadocencosud($parametros)
    {
        $procedure = "call usp_oi_ctrlprov_getconsolidadocencosud(?,?,?,?,?,?,?,?,?,?,?,?)";
        $query = $this->db-> query($procedure,$parametros);

        if ($query->num_rows() > 0) { 
            return $query->result();
        }{
            return False;
        }		   
    }

    public function getProveedorxCliente($parametros){
        $procedure = "call usp_oi_ctrlprov_getproveedorxcliente(?)";
		$query = $this->db-> query($procedure,$parametros);

		if ($query->num_rows() > 0) {

            $listas = '<option value="0" selected="selected">::Elegir</option>';
            
            foreach ($query->result() as $row)
            {
                $listas .= '<option value="'.$row->IDPROV.'">'.$row->DESCRIPPROV.'</option>';  
            }
               return $listas;
        }{
            return false;
        }	
    }

    public function getmaquilaxproveedor($parametros) { // Visualizar Maquilador por proveedor en CBO	
        
        $procedure = "call usp_oi_ctrlprov_getmaquilaxproveedor(?)";
		$query = $this->db-> query($procedure,$parametros);
        
        if ($query->num_rows() > 0) {

            $listas = '<option value="0" selected="selected">::Elegir</option>';
            
            foreach ($query->result() as $row)
            {
                $listas .= '<option value="'.$row->IDMAQ.'">'.$row->DESCRIPMAQ.'</option>';  
            }
               return $listas;
        }{
            return false;
        }	
    }	

    public function getareaxcliente($parametros){
        $procedure = "call usp_oi_ctrlprov_getareaxcliente(?)";
		$query = $this->db-> query($procedure,$parametros);

		if ($query->num_rows() > 0) {

            $listas = '<option value="0" selected="selected">::Elegir</option>';
            
            foreach ($query->result() as $row)
            {
                $listas .= '<option value="'.$row->IDAREACLIE.'">'.$row->DESCAREACLIE.'</option>';  
            }
               return $listas;
        }{
            return false;
        }	
    }
}
?>