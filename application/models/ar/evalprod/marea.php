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
        $this->db->order_by('nombre', 'asc');
        $this->db->limitAnyWhere(LIMITE_AUTOCOMPLETADO);
        $query = $this->db->get();
        if (!$query) return [];
        return ($query->num_rows() > 0) ? $query->result() : [];
    }

    /**
     * Lista de Lista de contactos de un area
     * @param $ccliente
     * @param $idarea
     * @param $busqueda
     * @return array
     */
    public function autoCompletadoContacto($ccliente, $idarea, $busqueda)
    {
        $this->db->select('contacto');
        $this->db->from('evalprod_area');
        $this->db->where('ccliente', $ccliente);
        $this->db->where('id_area', $idarea);
        $this->db->like('contacto', $busqueda, 'both', false);
        $this->db->order_by('contacto', 'asc');
        $this->db->limitAnyWhere(LIMITE_AUTOCOMPLETADO);
        $query = $this->db->get();
        $data = '';
        if ($query) {
            $data = ($query->num_rows() > 0) ? $query->row()->contacto : '';
        }
        $items = [];
        if (!empty($data)) {
            $arrayData = explode('-', $data);
            if ($arrayData !== false && is_array($arrayData)) {
                foreach ($arrayData as $value) {
                    $items[] = [
                        'id' => $value,
                        'text' => $value
                    ];
                }
            }
        }
        return $items;
    }

    /**
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