<?php

/**
 * Class Mproducto
 */
class Mproducto extends CI_Model
{

    /**
     * Mevalproductos constructor.
     */
    function __construct()
    {
        parent::__construct();
    }

    /**
     * Guardar Cantidad de productos elegidos para el expedientes
     * @param $parametros
     * @return mixed
     */
    public function guardarCantidad($parametros)
    {
        $procedure = "call usp_ar_evalprod_setitemproducto(?,?);";
        $query = $this->db->query($procedure, $parametros);
        return $query->result();
    }

    /**
     * Devuelve la lista de productos
     * @param $parametros
     * @return array
     */
    public function lista($parametros)
    {
        $procedure = "call usp_ar_evalprod_getlistproductos(?)";
        $query = $this->db->query($procedure, $parametros);
        if (!$query) return [];
        return ($query->num_rows() > 0) ? $query->result() : [];
    }

	/**
	 * @param $idExpediente
	 * @return array|mixed|object|null
	 */
    public function primerProducto($idExpediente)
	{
		$this->db->select('*');
		$this->db->from('evalprod_producto');
		$this->db->where('id_expediente', $idExpediente);
		$this->db->order_by('id_producto', 'ASC');
		$query = $this->db->get();
		if (!$query) return null;
		return ($query->num_rows() > 0) ? $query->row() : null;
	}

    /**
     * Buscar
     * @param $id
     * @return mixed|null
     */
    public function buscarPorId($id)
    {
        $query = $this->db->select('*')
            ->from('evalprod_producto')
            ->where('id_producto', $id)
            ->get();
        if (!$query) return null;
        return ($query->num_rows() > 0) ? $query->row() : null;
    }

    /**
     * Guarda los datos del producto de un expediente
     * @param $parametros
     * @return mixed
     */
    public function guardar($parametros)
    {
        $procedure = "call usp_ar_evalprod_setproducto(?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?);";
        $query = $this->db->query($procedure,$parametros);
        return $query->result();
    }

    /**
     * Elimina un producto
     * @param $idProducto
     * @param $idExpediente
     * @return boolean
     */
    public function eliminar($idProducto, $idExpediente)
    {
        if (empty($idProducto) || empty($idExpediente)) {
            return false;
        }
        return $this->db->delete('evalprod_producto', ['id_producto' => $idProducto, 'id_expediente' => $idExpediente]);
    }

}


