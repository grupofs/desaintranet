<?php

/**
 * Class Marea
 */
class Marea extends CI_Model
{

    /**
     * Mevalproductos constructor.
     */
    function __construct()
    {
        parent::__construct();
    }

    /**
     * Busqueda del nuevo ID
     *
     * @return int
     */
    public function obtenerNuevoID()
    {
        $this->db->select('ISNULL(max(id_area), 0) as idActual');
        $this->db->from('evalprod_area');
        $query = $this->db->get();
        if (!$query) return 0;
        return ($query->num_rows() > 0) ? intval($query->row()->idActual) + 1 : 0;
    }

    /**
     * @param $ccliente
     * @param $nombre
     * @return array
     */
    public function lista($ccliente, $nombre)
    {
        $this->db->select('*');
        $this->db->from('evalprod_area');
        $this->db->like('nombre', $nombre);
        $this->db->where('ccliente', $ccliente);
        $this->db->order_by('nombre', 'asc');
        $query = $this->db->get();
        if (!$query) return [];
        return ($query->num_rows() > 0) ? $query->result() : [];
    }

    /**
     * Crea una nueva área
     *
     * @param $id
     * @param $nombre
     * @param $estado
     * @param $ccliente
     * @return bool
     */
    public function crear($id, $nombre, $estado, $ccliente)
    {
        return $this->db->insert('evalprod_area', [
            'id_area' => $id,
            'nombre' => trim($nombre),
            'contacto' => '',
            'cargo' => '',
            'email' => '',
            'rpc' => '',
            'telefono' => '',
            'anexo' => '',
            'estado' => $estado,
            'ccliente' => $ccliente,
        ]);
    }

    /**
     * Edita una área
     *
     * @param $id
     * @param $nombre
     * @param $estado
     * @return bool
     */
    public function editar($id, $nombre, $estado)
    {
        return $this->db->update('evalprod_area', [
            'nombre' => trim($nombre),
            'estado' => $estado,
        ], ['id_area' => $id]);
    }

    /**
     * Lsita todas la areas
     * @param $ccliente
     * @return bool|string
     */
    public function autoCompletado($ccliente, $busqueda)
    {
        $this->db->select('
            id_area,
            nombre,
            id_area as id,
            nombre as text,
        ');
        $this->db->from('evalprod_area');
        $this->db->where('ccliente', $ccliente);
        $this->db->like('nombre', $busqueda, 'both', false);
        $this->db->where('estado', 1); // TODO: PREGUNTAR SI ES USADO O NO
        $this->db->order_by('nombre', 'asc');
        $this->db->limitAnyWhere(LIMITE_AUTOCOMPLETADO);
        $query = $this->db->get();
        if (!$query) return [];
        return ($query->num_rows() > 0) ? $query->result() : [];
    }

    /**
     * Busca una area por el ID
     *
     * @param $idArea
     * @return mixed|null
     */
    public function buscarPorId($idArea)
    {
        $query = $this->db->select('*')
            ->from('evalprod_area')
            ->where('id_area', $idArea)
            ->get();
        if (!$query) return null;
        return ($query->num_rows() > 0) ? $query->row() : null;
    }

}