<?php

/**
 * Class mproveedorextends
 */
class Mproveedor extends CI_Model
{

    /**
     * Mevalproductos constructor.
     */
    function __construct()
    {
        parent::__construct();
    }

    /**
     * Lista de proveedores
     * @param $ccliente
     * @param $nombre
     * @param $ruc
     * @return array
     */
    public function lista($ccliente, $nombre, $ruc)
    {
        $this->db->select('
            id_proveedor,
            nombre,
            contacto_p,
            email_p,
            contacto_q,
            email_q,
            telefono,
            ruc,
            estado
        ');
        $this->db->from('evalprod_proveedor');
        $this->db->where('ccliente', $ccliente);
        $this->db->group_start();
        $this->db->like('nombre', $nombre, 'both', false);
        $this->db->like('ruc', $ruc, 'both', false);
        $this->db->group_end();
        $this->db->order_by('id_proveedor', 'DESC');
        $query = $this->db->get();
        if (!$query) return [];
        return ($query->num_rows() > 0) ? $query->result() : [];
    }

    /**
     * Busqueda de proveedores
     * @param $ccliente
     * @param $busqueda
     * @return bool
     */
    public function autoCompletado($ccliente, $busqueda)
    {
        $this->db->select('
             id_proveedor,
             nombre,
             contacto_p,
             email_p,
             contacto_q,
             email_q,
             telefono,
             ruc,
             estado,
             id_proveedor as id,
             nombre as text,
        ');
        $this->db->from('evalprod_proveedor');
        $this->db->where('ccliente', $ccliente);
        $this->db->group_start();
        $this->db->like('nombre', $busqueda, 'both', false);
        $this->db->or_like('ruc', $busqueda, 'both', false);
        $this->db->group_end();
        $this->db->order_by('nombre', 'asc');
        $this->db->limitAnyWhere(LIMITE_AUTOCOMPLETADO);
        $query = $this->db->get();
        if (!$query) return [];
        return ($query->num_rows() > 0) ? $query->result() : [];
    }

    /**
     * Guarda proveedor
     * @param $parametros
     * @return mixed
     */
    public function guardar($parametros)
    {
        $procedure = "call usp_ar_evalprod_setproveedor(?,?,?,?,?,?,?,?,?,?);";
        $query = $this->db->query($procedure, $parametros);
        return $query->result();
    }

    /**
     * Busqueda de un proveedor por el RUC
     * @param $ruc
     * @param $id
     * @return mixed|null
     */
    public function buscarPorRuc($ruc, $id = 0)
    {
        $this->db->select('*');
        $this->db->from('evalprod_proveedor');
        $this->db->where('ruc', $ruc);
        if ($id > 0) {
            $this->db->where('id_proveedor !=', $id);
        }
        $query = $this->db->get();
        if (!$query) return null;
        return ($query->num_rows() > 0) ? $query->row() : null;
    }

    /**
     * Busqueda de un proveedor
     * @param $idProveedor
     * @return mixed|null
     */
    public function buscarPorId($idProveedor)
    {
        $query = $this->db->select('*')
            ->from('evalprod_proveedor')
            ->where('id_proveedor', $idProveedor)
            ->get();
        if (!$query) return null;
        return ($query->num_rows() > 0) ? $query->row() : null;
    }

}