<?php

/**
 * Class Mevaluar
 */
class Mevaluar extends CI_Model
{

    /**
     * Mevalproductos constructor.
     */
    function __construct()
    {
        parent::__construct();
    }

    /**
     * Guarda el expediente evaluado
     * @param $parametros
     * @return mixed
     */
    public function guardar($parametros)
    {
        $procedure = "call usp_ar_evalprod_setevaluacion(?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?);";
        $query = $this->db->query($procedure, $parametros);
        return $query->result();
    }

    /**
     * Elimina una evaluación
     * @param $id
     * @return bool|mixed
     */
    public function eliminar($id)
    {
        if (empty($id)) {
            return false;
        }
        return $this->db->delete('evalprod_evaluador', ['id_evaluador' => $id]);
    }

    /**
     * Guarda los datos del producto de un expediente de una evaluación
     * @param $parametros
     * @return mixed
     */
    public function guardarProducto($parametros)
    {
        $procedure = "call usp_ar_evalprod_setproductoeval(?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?);";
        $query = $this->db->query($procedure, $parametros);
        return $query->result();
    }

    /**
     * Busqueda de la evaluacion por el ID
     * @param $id
     * @return mixed|null
     */
    public function buscarPorId($id)
    {
        $this->db->select('*');
        $this->db->from('evalprod_evaluador');
        $this->db->where('id_evaluador', $id);
        $query = $this->db->get();
        if (!$query) return null;
        return ($query->num_rows() > 0) ? $query->row() : null;
    }

    /**
     * Devuelve la evaluacion del expediente con el producto
     * @param $idExpediente
     * @param $idProducto
     * @return mixed|null
     */
    public function buscarExpediente($idExpediente, $idProducto)
    {
        $this->db->select("
            evalprod_evaluador.*,
            IFNULL(evalprod_paises.id_paises, '', evalprod_paises.id_paises) as idPais,
            IFNULL(evalprod_paises.id_paises, '', evalprod_paises.nombre) as textPais
        ");
        $this->db->from('evalprod_evaluador');
        $this->db->join('evalprod_paises', 'evalprod_evaluador.pais = evalprod_paises.id_paises', 'left');
        $this->db->where('id_expediente', $idExpediente);
        $this->db->where('id_producto', $idProducto);
        $query = $this->db->get();
        if (!$query) return null;
        return ($query->num_rows() > 0) ? $query->row() : null;
    }

    /**
     * Auto completado de paises
     * @param string $busqueda
     * @return mixed|null
     */
    public function autoCompletadoPais($busqueda)
    {
        $this->db->select('
            id_paises AS id,
            nombre as text
        ');
        $this->db->from('evalprod_paises');
        $this->db->like('nombre', $busqueda, 'both', false);
        $this->db->order_by('nombre', 'asc');
        $this->db->limitAnyWhere(LIMITE_AUTOCOMPLETADO);
        $query = $this->db->get();
        if (!$query) return null;
        return ($query->num_rows() > 0) ? $query->result() : null;
    }

    /**
     * Obtener el agrupado de estados
     * @param $idExpediente
     * @return array|null
     */
    public function obtenerCantidadEstados($idExpediente)
    {
        $this->db->select('
            COUNT(id_producto) as total,
            status as flagEstado
        ');
        $this->db->from('evalprod_evaluador');
        $this->db->where('id_expediente', $idExpediente);
        $this->db->group_by('status');
        $query = $this->db->get();
        if (!$query) return [];
        return ($query->num_rows() > 0) ? $query->result() : [];
    }

}
