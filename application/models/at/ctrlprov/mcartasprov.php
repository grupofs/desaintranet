<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Mcartasprov extends CI_Model {
	function __construct() {
		parent:: __construct();	
		$this->load->library('session');
    }

    public function getclientes() { // recupera los clientes 
       $sql = "select c.ccliente, c.drazonsocial from PDPTE a 
					join PCPTE b on b.cinternopte = a.cinternopte
					join MCLIENTE c on c.cgrupoempresarial = b.cgrupoempresarial
				where a.ccompania = '1' and a.carea = '01' and a.cservicio = '02';";
       $query  = $this->db->query($sql);
           
       if ($query->num_rows() > 0) {

            $listas = '<option value="">Elige</option>';
            
            foreach ($query->result() as $row){
                $listas .= '<option value="'.$row->ccliente.'">'.$row->drazonsocial.'</option>';  
            }
               return $listas;
        }{
            return false;
        }		   
	}
		
    public function getbuscarcartas($parametros) {  // recupera los cartas a proveedores
        $this->db->trans_begin();

        $procedure = "call usp_at_ctrlprov_getlistcartas(?,?,?);";
        $query = $this->db->query($procedure,$parametros);

        if ($this->db->trans_status() === FALSE)        {
            $this->db->trans_rollback();
        }else{
            $this->db->trans_commit();
            return $query->result(); 
        }   
    } 
		
    public function getcartasprov($parametros) {  // recupera los cartas a proveedores
        $this->db->trans_begin();

        $procedure = "call sp_formatocartas_ip(?,?,?,?);";
        $query = $this->db->query($procedure,$parametros);

        if ($this->db->trans_status() === FALSE)        {
            $this->db->trans_rollback();
        }else{
            $this->db->trans_commit();
            return $query->result(); 
        }   
    } 

}
?>