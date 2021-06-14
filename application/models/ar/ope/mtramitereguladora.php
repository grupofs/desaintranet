<?php

/**
 * Class mtramitereguladora
 */
class mtramitereguladora extends CI_Model
{

	/**
	 * mtramite constructor.
	 */
	public function __construct()
	{
		parent::__construct();
	}

	/**
	 * @param $centidad
	 * @param $ctramite
	 * @return array|mixed|object|null
	 */
	public function buscarTramite($centidad, $ctramite)
	{
		$this->db->select('
			ctramite as id,
			dtramite as text,
			*
		');
		$this->db->from('MTRAMITEREGULADORA');
		$this->db->where('SREGISTRO', 'A');
		$this->db->where('CENTIDADREGULA', $centidad, false);
		$this->db->where('CTRAMITE', $ctramite, false);
		$query = $this->db->get();
		if (!$query) {
			return null;
		}
		return ($query->num_rows() > 0) ? $query->row() : null;
	}

	/**
	 * Devuelve las entidades reguladoras
	 * @param string $search
	 * @param string $centidad
	 * @param string $ctipoProducto
	 * @return array
	 */
	public function autoCompletado(string $search, string $centidad, string $ctipoProducto): array
	{
		$this->db->select('
			ctramite as id,
			dtramite as text,
			*
		');
		$this->db->from('MTRAMITEREGULADORA');
		$this->db->where('SREGISTRO', 'A');
		$this->db->where('CENTIDADREGULA', $centidad, false);
		$this->db->where('zctipocategoriaproducto', $ctipoProducto, false);
		$this->db->like('dtramite', $search, 'both', false);
		$this->db->where('SREGISTRO', 'A');
		$this->db->order_by('dtramite', 'ASC');
		// $this->db->limitAnyWhere(LIMITE_AUTOCOMPLETADO);
		$query = $this->db->get();
		if (!$query) {
			return [];
		}
		return ($query->num_rows() > 0) ? $query->result() : [];
	}

}
