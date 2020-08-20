<?php

/**
 * Class Mexpediente
 */
class Mexpediente extends CI_Model
{

    /**
     * Mevalproductos constructor.
     */
    function __construct()
    {
        parent::__construct();
    }

    /**
     * Lista la busqueda de expedientes
     * @param $parametros
     * @return bool
     */
    public function lista($parametros)
    {
        $procedure = "call usp_ar_evalprod_listaexpediente(?,?,?,?,?)";
        $query = $this->db->query($procedure, $parametros);
        if (!$query) {
            return [];
        }
        return ($query->num_rows() > 0) ? $query->result() : [];
    }

    /**
     * Busqueda de un proveedor
     * @param $idExpediente
     * @return mixed|null
     */
    public function buscarPorId($idExpediente)
    {
        $query = $this->db->select('*')
            ->from('evalprod_expediente')
            ->where('id_expediente', $idExpediente)
            ->get();
        if (!$query) return null;
        return ($query->num_rows() > 0) ? $query->row() : null;
    }

    /**
     * Guarda el expediente
     * @param $parametros
     * @return mixed
     */
    public function guardar($parametros)
    {
        $procedure = "call usp_ar_evalprod_setexpediente(?,?,?,?,?,?,?,?,?,?,?,?);";
        $query = $this->db->query($procedure, $parametros);
        return $query->result();
    }

    /**
     * Elimina el expediente
     * @param $id
     * @return bool|mixed
     */
    public function eliminar($id)
    {
        if (empty($id)) {
            return false;
        }
        return $this->db->delete('evalprod_expediente', ['id_expediente' => $id]);
    }

    /**
     * Guarda el expediente
     * @param $parametros
     * @return mixed
     */
    public function guardarEvaluacion($parametros)
    {
        $procedure = "call usp_ar_evalprod_setevaluacion(?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?);";
        $query = $this->db->query($procedure, $parametros);
        return $query->result();
    }

    /**
     * Actualiza los datos de un expediente
     * @param $id
     * @param $datos
     * @return bool
     */
    public function actualizar($id, $datos)
    {
        return $this->db->update("evalprod_expediente", $datos, ['id_expediente' => $id]);
    }

}


