<?php

/**
 * Class mentidadreguladora
 */
class mentidadreguladora extends CI_Model
{

	/**
	 * mtramite constructor.
	 */
	public function __construct()
	{
		parent::__construct();
	}

	/**
	 * Devuelve las entidades reguladoras
	 * @param $search
	 * @return array
	 */
	public function autoCompletado($search): array
	{
		$this->db->select('
			centidadregula as id,
			dentidadregula as text,
			*
		');
		$this->db->from('MENTIDADREGULATORIA');
		$this->db->where('SREGISTRO', 'A');
		$this->db->like('dentidadregula', $search);
		$this->db->order_by('dentidadregula', 'ASC');
		$this->db->limitAnyWhere(LIMITE_AUTOCOMPLETADO);
		$query = $this->db->get();
		if (!$query) {
			return [];
		}
		return ($query->num_rows() > 0) ? $query->result() : [];
	}

}
