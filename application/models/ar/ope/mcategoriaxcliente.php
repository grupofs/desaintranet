<?php

/**
 * Class mcategoriaxcliente
 */
class mcategoriaxcliente extends CI_Model
{

	/**
	 * mttramite constructor.
	 */
	public function __construct()
	{
		parent::__construct();
	}

	/**
	 * @param string $search
	 * @param string $ccliente
	 * @return array
	 */
	public function autoCompletado(string $search, string $ccliente): array
	{
		$this->db->select('
			ccategoriacliente as id,
			dcategoriacliente as text,
			*
		');
		$this->db->from('mcategoriacliente');
		$this->db->where('ccliente', $ccliente);
		$this->db->where('sregistro', 'A');
		$this->db->like('dcategoriacliente', $search);
		$this->db->order_by('dcategoriacliente', 'ASC');
		$this->db->limitAnyWhere(LIMITE_AUTOCOMPLETADO);
		$query = $this->db->get();
		if (!$query) {
			return [];
		}
		return ($query->num_rows() > 0) ? $query->result() : [];
	}

}
