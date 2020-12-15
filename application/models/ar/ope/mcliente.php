<?php

/**
 * Class mcliente
 */
class mcliente extends CI_Model
{

	/**
	 * mcliente constructor.
	 */
	public function __construct()
	{
		parent::__construct();
	}

	/**
	 * Busca un cliente
	 * @param $id
	 * @return array|mixed|object|null
	 */
	public function buscar($id)
	{
		$this->db->from('mcliente');
		$this->db->where('ccliente', $id);
		$query = $this->db->get();
		if (!$query) {
			return null;
		}
		return ($query->num_rows() > 0) ? $query->row() : null;
	}

	/**
	 * @param string $search
	 * @param string $grupoEmpresarial
	 * @return array|array[]|object|object[]
	 */
	public function autoCompletado(string $search, string $grupoEmpresarial = ''): array
	{
		$this->db->select('
			ccliente as id,
			drazonsocial as text
		');
		$this->db->from('mcliente');
		$this->db->like('drazonsocial', $search);
		$this->db->where('sregistro', 'A');
		if (!empty($grupoEmpresarial)) {
			$this->db->where('cgrupoempresarial', $grupoEmpresarial);
		}
		$this->db->order_by('drazonsocial', 'ASC');
		$this->db->limitAnyWhere(LIMITE_AUTOCOMPLETADO);
		$query = $this->db->get();
		if (!$query) {
			return [];
		}
		return ($query->num_rows() > 0) ? $query->result() : [];
	}

}
