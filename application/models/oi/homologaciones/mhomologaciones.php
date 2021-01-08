
<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Mhomologaciones extends CI_Model {
	function __construct() {
		parent::__construct();	
		$this->load->library('session');
    }
    
    public function getClientes(){
        $procedure = "call sp_appweb_oi_listar_clientes()";
        $query = $this->db-> query($procedure);

        if ($query->num_rows() > 0) {

            $listas = '<option value="" >::Elegir</option>';
            
            foreach ($query->result() as $row)
            {
                $listas .= '<option value="'.$row->CODIGO.'">'.$row->CLIENTE.'</option>';  
            }
               return $listas;
        }{
            return false;
        }	

    }

    public function getEstadoExp(){
        $procedure = "select ctipo as 'ID', upper(dregistro) as 'VALUE' from ttabla where ctabla = '28'";
        $query = $this->db->query($procedure);
        
        if ($query->num_rows() > 0) {

            $listas = '<option value="%" selected>::Elegir</option>';
            
            foreach ($query->result() as $row)
            {
                $listas .= '<option value="'.$row->ID.'">'.$row->VALUE.'</option>';  
            }
               return $listas;
        }{
            return false;
        }	
        

    }

    public function getArea(){
        $procedure = "call sp_appweb_oi_listar_areaxcliente()";
        $query = $this->db->query($procedure);
        
        if ($query->num_rows() > 0) {

            $listas = '<option value="" selected>::Elegir</option>';
            
            foreach ($query->result() as $row)
            {
                $listas .= '<option value="'.$row->careacliente.'">'.$row->dareacliente.'</option>';  
            }
               return $listas;
        }{
            return false;
        }	
        

    }

    public function getRequisitos(){
        $procedure = "call sp_appweb_oi_listar_areaxcliente()";
        $query = $this->db->query($procedure);
        
        if ($query->num_rows() > 0) {

            $listas = '<option value="" selected>::Elegir</option>';
            
            foreach ($query->result() as $row)
            {
                $listas .= '<option value="'.$row->careacliente.'">'.$row->dareacliente.'</option>';  
            }
               return $listas;
        }{
            return false;
        }	
        

    }

    

    public function getbuscarexpediente($parametros){
        $procedure = "call sp_appweb_oi_buscar_expediente(?,?,?,?)";
		$query = $this->db-> query($procedure,$parametros);

		if ($query->num_rows() > 0) { 
			return $query->result();
		}{
			return false;
		}	
    }

    public function getbuscarproductoxespediente($parametros){
        $procedure = "call sp_appweb_oi_buscar_productoxexpediente(?)";
		$query = $this->db-> query($procedure,$parametros);

		if ($query->num_rows() > 0) { 
			return $query->result();
		}{
			return false;
		}	
    }

    public function getClienteDetallado($parametros){
        $procedure = "call sp_appweb_oi_clientes_detallado(?)";
		$query = $this->db-> query($procedure,$parametros);

		if ($query->num_rows() > 0) { 
			return $query->result();
		}{
			return false;
		}	
    }

    public function getContactoProveedor($parametros){
      // $procedure = "call sp_appweb_oi_buscar_contactoxproveedor(?)";
        $procedure = "SELECT distinct(contact.ccontacto) as 'IDCONTACTO', contact.DNOMBRE+' '+contact.DAPEPAT AS'NOMBRE', contact.DMAIL AS 'EMAIL' FROM MCONTACTO contact INNER JOIN PEVALUACIONPRODUCTO prod on contact.ccliente = prod.cproveedorcliente  WHERE prod.cproveedorcliente LIKE '%".$parametros."'"; 


		$query = $this->db-> query($procedure,$parametros);

		if ($query->num_rows() > 0) {

            $listas = '<option value="%" >::Elegir</option>';
            
            foreach ($query->result() as $row)
            {
                $listas .= '<option email="'.$row->EMAIL.'" value="'.$row->IDCONTACTO.'">'.$row->NOMBRE.'</option>';  
            }
               return $listas;
        }{
            return false;
        }	
    }

    public function getProveedorxCliente($parametros){
        $procedure = "call sp_appweb_oi_buscar_proveedorxcliente(?)";

        // $procedure = "select cliente.drazonsocial as 'NOMBRE',cliente.ccliente as 'ID' FROM MCLIENTE cliente
        // INNER JOIN PEVALUACIONPRODUCTO prod on cliente.ccliente = prod.cproveedorcliente where prod.cevaluacionproducto = '".$parametros."'";
		$query = $this->db-> query($procedure,$parametros);

		if ($query->num_rows() > 0) {

            $listas = '<option value="%" >::Elegir</option>';
            
            foreach ($query->result() as $row)
            {
                $listas .= '<option value="'.$row->ID.'">'.$row->NOMBRE.'</option>';  
            }
               return $listas;
        }{
            return false;
        }	
    }

    public function getbuscarequisitoxproducto($parametros){
        $procedure = "call sp_appweb_oi_requisitos_producto(?,?)";

        $query = $this->db-> query($procedure,$parametros);

		if ($query->num_rows() > 0) { 
			return $query->result();
		}{
			return false;
		}	
    }

    public function getbuscarobservacionxproducto($parametros){
        $procedure = "call sp_appweb_oi_observacion_producto(?,?)";

        $query = $this->db-> query($procedure,$parametros);

		if ($query->num_rows() > 0) { 
			return $query->result();
		}{
			return false;
		}	
    }

    public function insert($parametros){
		    $procedure = "call sp_appweb_oi_insert_prodxevaluar(?,?,?,?,?,?,?,?,?,?,?,?,?,?,?);";
			$query = $this->db->query($procedure,$parametros);
            return ($query == true) ? 1 : false;  	
    }
    
    public function update($parametros){
        $procedure = "call sp_appweb_oi_update_producto(?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?);";
        $query = $this->db->query($procedure,$parametros);
        return ($query == true) ? 1 : false; 
    }

    public function delete($parametros){
        // DESACTIVARA EL PRODUCTO PARA NO SER VISUALIZAR
        $procedure = "call sp_appweb_oi_delete_producto(?,?)";
        $query = $this->db->query($procedure,$parametros);
        return ($query == true) ? 1 : false; 
    }

    public function insertarObsRequisito($parametros){
        $procedure = "call sp_appweb_oi_insert_observacion_requisito_prod(?,?,?,?,?,?,?,?,?,?,?);";
        $query = $this->db->query($procedure,$parametros);
        return ($query == true) ? 1 : false;
        
    }

    public function updateProductoProveedor($parametros){
        $procedure = "call sp_appweb_oi_insertar_productoproveedor(?,?,?,?,?,?,?);";
        $query = $this->db->query($procedure,$parametros);
        return ($query == true) ? 1 : false;
    }

    public function getTipoRequisito($parametros){
        $procedure = "call sp_appweb_oi_listar_tipo_req_producto(?)";
        $query = $this->db->query($procedure,$parametros);
        
        if ($query->num_rows() > 0) {

            $listas = '<option value="" selected>::Elegir</option>';
            
            foreach ($query->result() as $row)
            {
                $listas .= '<option value="'.$row->ID.'">'.$row->DOCUMENTO.'</option>';  
            }
            return $listas;
        }{
            return false;
        }	
    }
    
    public function insertarRequisitoProducto($parametros){
        $procedure = "call sp_appweb_oi_registrar_req_prod(?,?,?,?,?,?,?,?,?);";
        $query = $this->db->query($procedure,$parametros);
        return ($query == true) ? 1 : false;
    }

    public function deleteRequisitoProd($parametros){
        // DESACTIVARA EL REQUISITO PARA NO SER VISUALIZAR
        $procedure = "call sp_appweb_oi_delete_requisito_producto(?,?,?)";
        $query = $this->db->query($procedure,$parametros);
        return ($query == true) ? 1 : false; 
    }

    public function updateRequisitoProducto($parametros){
        $procedure = "call sp_appweb_oi_update_req_prod(?,?,?,?,?,?,?,?,?);";
        $query = $this->db->query($procedure,$parametros);
        return ($query == true) ? 1 : false;
    }
}
?>