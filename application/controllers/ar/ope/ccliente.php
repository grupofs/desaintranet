<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Class ccliente
 */
class ccliente extends CI_Controller
{
	/**
	 * ccliente constructor.
	 */
	public function __construct()
	{
		parent::__construct();
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
}
