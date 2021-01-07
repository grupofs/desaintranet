<?php


/**
 * Class mttabla
 */
class mttabla extends CI_Model
{

	/**
	 * ttabla constructor.
	 */
	public function __construct()
	{
		parent::__construct();
	}

	/**
	 * Auto completado de pais
	 * @param $search
	 * @return array|array[]|object|object[]
	 */
	public function autoCompletadoPais($search)
	{
		$this->db->select('
			ctipo as id,
			dregistro as text,
			*
		');
		$this->db->from('ttabla');
		$this->db->where('ctabla', 11);
		$this->db->where('sregistro', 'A');
		$this->db->like('dregistro', $search);
		$this->db->order_by('dregistro', 'ASC');
		$this->db->limitAnyWhere(LIMITE_AUTOCOMPLETADO);
		$query = $this->db->get();
		if (!$query) {
			return [];
		}
		return ($query->num_rows() > 0) ? $query->result() : [];
	}

}
