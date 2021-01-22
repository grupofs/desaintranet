<?php
class Mclientereportes extends CI_Model
{
    function __construct()
	{
		parent::__construct();
    }

    public function getproveedoreseval($ccliente){
        $sql = "select id_proveedor, nombre from evalprod_proveedor where ccliente = '".$ccliente."' order by nombre asc;";
		$query  = $this->db->query($sql);

		if ($query->num_rows() > 0) {

            $listas = '<option value="" selected="selected">::Elegir</option>';
            
            foreach ($query->result() as $row)
            {
                $listas .= '<option value="'.$row->id_proveedor.'">'.$row->nombre.'</option>';  
            }
               return $listas;
        }{
            return false;
        }	
    }

    public function getareaeval($ccliente){
        $sql = "select id_area, nombre from evalprod_area where ccliente = '".$ccliente."' order by nombre asc;";
		$query  = $this->db->query($sql);

		if ($query->num_rows() > 0) {

            $listas = '<option value="" selected="selected">::Elegir</option>';
            
            foreach ($query->result() as $row)
            {
                $listas .= '<option value="'.$row->id_area.'">'.$row->nombre.'</option>';  
            }
               return $listas;
        }{
            return false;
        }	
    }

    public function getvistageneral($parametros)
    {
        $procedure = "call usp_ar_evalprod_getvistageneral(?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)";
        $query = $this->db-> query($procedure,$parametros);

        if ($query->num_rows() > 0) { 
            return $query->result();
        }{
            return False;
        }		   
    }

    public function getlistarexpedientes($parametros)
    {
        $procedure = "call usp_ar_evalprod_listaexpediente(?,?,?,?,?)";
        $query = $this->db-> query($procedure,$parametros);

        if ($query->num_rows() > 0) { 
            return $query->result();
        }{
            return False;
        }		   
    }
    
}
?>