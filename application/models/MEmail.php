<?php

/**
 * Class MEmail
 */
class Memail extends CI_Model
{

    /**
     * MEmail constructor.
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Busca la configuración del envío de correo
     *
     * @param $id
     * @return mixed|null
     */
    public function obtenerConfiguracion($id)
    {
        $query = $this->db->from('mmail')
            ->select('*')
            ->where('cmail', $id)
            ->get();
        if (!$query) return null;
        return ($query->num_rows() > 0) ? $query->row() : null;
    }

    /**
     * Busqueda de un expediente para el envío de correo electronico
     *
     * @param $id
     * @return array
     */
    public function buscarExpediente($id)
    {
        $select = "
            select distinct
            a.id_expediente,
            a.id_proveedor,
            a.expediente,
            b.nombre as 'proveedor',
            a.fecha,
            DATEFORMAT(DATEADD(day, 15, a.fecha),'dd-mm-yyyy') as 'flimite',
            a.estado,
            if isnull(b.email_q, '0') = '0' or len(b.email_q) = 0
                then b.email_p
                else b.email_p + ',' + b.email_q
            end if as 'destino',
            (select list(z.email) from evalprod_areacontacto z where (z.id_area = a.id_area or z.id_area = 0) and z.estado = 'A') as 'cc',
            c.status
        ";
        // (select list(z.email) from evalprod_areacontacto z where (z.id_area = a.id_area or z.id_area = 0) and z.estado = 'A') as 'cc',
        $from = "
            from evalprod_expediente a
            join evalprod_proveedor b on b.id_proveedor = a.id_proveedor
            join evalprod_evaluador c on c.id_expediente = a.id_expediente
        ";
        $where = "
            where a.estado != 6
            and a.id_expediente = '{$id}'
            order by c.status;
        ";
        $query = $this->db->query($select . $from . $where);
        if (!$query) return [];
        return ($query->num_rows() > 0) ? $query->result() : [];
    }

    /**
     * Busqueda del detalle de la evaluación del expedientes
     *
     * @param $id
     * @param $status
     * @return array
     */
    public function buscarExpedienteDetalle($id, $status)
    {
        $select = "
            select
            DATEFORMAT(a.fecha,'dd/mm/yyyy') as 'fechaingreso',
            DATEFORMAT(b.f_evaluado,'dd/mm/yyyy') as 'f_evaluado',
            DATEFORMAT(b.f_levantamiento,'dd/mm/yyyy') as 'f_levantamiento',
            left(d.nombre,3) as 'area',
            b.codigo,
            b.descripcion,
            b.marca,
            b.presentacion,
            b.fabricante,
            e.nombre as 'proveedor',
            b.rs,
            b.fecha_emision,
            b.fecha_vcto,
            c.c_c, c.t_v_u,
            c.tiempo_m,
            f.nombre as 'pais',
            c.observacion,
            c.acuerdo,
            c.responsable,
            DATEFORMAT(c.fecha,'dd/mm/yyyy') as 'fecha'
        ";
        $from = "
            from evalprod_expediente a
                join evalprod_producto b on a.id_expediente = b.id_expediente
                join evalprod_evaluador c on b.id_expediente = c.id_expediente and b.id_producto = c.id_producto
                join evalprod_area d on a.id_area = d.id_area
                join evalprod_proveedor e on e.id_proveedor = a.id_proveedor
                join evalprod_paises f on f.id_paises = c.pais
        ";
        $where = "
            where a.estado!= 6 and a.id_expediente = " . $id . " and c.status = " . $status . " order by b.id_producto;
        ";
        $query = $this->db->query($select . $from . $where);
        if (!$query) return [];
        return ($query->num_rows() > 0) ? $query->result() : [];
    }

}
