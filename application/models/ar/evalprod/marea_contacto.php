<?php

/**
 * Class Marea_contacto
 */
class Marea_contacto extends CI_Model
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
        $this->db->select('ISNULL(max(id_contacto), 0) as idActual');
        $this->db->from('evalprod_areacontacto');
        $query = $this->db->get();
        if (!$query) return 0;
        return ($query->num_rows() > 0) ? intval($query->row()->idActual) + 1 : 0;
    }

    /**
     * @param $idArea
     * @param $id
     * @param $contacto
     * @param $email
     * @param $estado
     * @return bool
     */
    public function crear($idArea, $id, $contacto, $email, $estado)
    {
        return $this->db->insert('evalprod_areacontacto', [
            'id_area' => $idArea,
            'id_contacto' => $id,
            'contacto' => trim($contacto),
            'cargo' => '',
            'email' => trim($email),
            'celular' => '',
            'telefono' => '',
            'anexo' => '',
            'estado' => $estado,
        ]);
    }

    /**
     * @param $id
     * @param $contacto
     * @param $email
     * @param $estado
     * @return bool
     */
    public function editar($id, $contacto, $email, $estado)
    {
        return $this->db->update('evalprod_areacontacto', [
            'contacto' => trim($contacto),
            'cargo' => '',
            'email' => trim($email),
            'celular' => '',
            'telefono' => '',
            'anexo' => '',
            'estado' => $estado,
        ], ['id_contacto' => $id]);
    }

    /**
     * Elimina un contacto
     *
     * @param $id
     * @return mixed
     */
    public function eliminar($id)
    {
        return $this->db->delete('evalprod_areacontacto', [
            'id_contacto' => $id,
        ]);
    }

    /**
     * Busca un contacto por el ID
     *
     * @param $id
     * @return mixed|null
     */
    public function buscarPorId($id)
    {
        $query = $this->db->select('*')
            ->from('evalprod_areacontacto')
            ->where('id_contacto', $id)
            ->get();
        if (!$query) return null;
        return ($query->num_rows() > 0) ? $query->row() : null;
    }

    /**
     * Busca un contacto por el nombre del contacto
     *
     * @param $contacto
     * @return mixed|null
     */
    public function buscarPorNombre($contacto)
    {
        $query = $this->db->select('*')
            ->from('evalprod_areacontacto')
            ->like('contacto', $contacto, 'both', false)
            ->order_by('id_contacto', 'ASC')
            ->get();
        if (!$query) return null;
        return ($query->num_rows() > 0) ? $query->row() : null;
    }

    /**
     * Busqueda de todos los contactos de una area
     *
     * @param $idArea
     * @return array|mixed
     */
    public function areaContactos($idArea)
    {
        $query = $this->db->select('*')
            ->from('evalprod_areacontacto')
            ->where('id_area', $idArea)
            ->get();
        if (!$query) return [];
        return ($query->num_rows() > 0) ? $query->result() : [];
    }

    /**
     * Autocomplado de area
     *
     * @param $idarea
     * @param $busqueda
     * @return array
     */
    public function autocompletado($idarea, $busqueda)
    {
        $this->db->select('
            id_contacto as id,
            contacto as text
        ');
        $this->db->from('evalprod_areacontacto');
        $this->db->where('id_area', $idarea);
        $this->db->like('contacto', $busqueda, 'both', false);
        $this->db->order_by('contacto', 'asc');
        $this->db->limitAnyWhere(LIMITE_AUTOCOMPLETADO);
        $query = $this->db->get();
        if (!$query) return [];
        return ($query->num_rows() > 0) ? $query->result() : [];
    }

}