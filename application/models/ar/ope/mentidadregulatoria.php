<?php

/**
 * Class mentidadregulatoria
 */
class mentidadregulatoria extends CI_Model
{

	/**
	 * mcliente constructor.
	 */
	public function __construct()
	{
		parent::__construct();
	}

	/**
	 * @param $id
	 * @return array|mixed|object|null
	 */
	public function buscar($id)
	{
		$this->db->from('mentidadregulatoria');
		$this->db->where('centidadregula', $id);
		$query = $this->db->get();
		if (!$query) {
			return null;
		}
		return ($query->num_rows() > 0) ? $query->row() : null;
	}

	/**
	 * @param string $search
	 * @return array|array[]|object|object[]
	 */
	public function autoCompletado(string $search): array
	{
		$this->db->select('
			centidadregula as id,
			dentidadregula as text
		');
		$this->db->from('mentidadregulatoria');
		$this->db->like('dentidadregula', $search);
		$this->db->where('sregistro', 'A');
		$this->db->order_by('dentidadregula', 'ASC');
		$this->db->limitAnyWhere(LIMITE_AUTOCOMPLETADO);
		$query = $this->db->get();
		if (!$query) {
			return [];
		}
		return ($query->num_rows() > 0) ? $query->result() : [];
	}

}
