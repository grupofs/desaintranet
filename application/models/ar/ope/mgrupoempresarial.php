<?php

/**
 * Class mgrupoempresarial
 */
class mgrupoempresarial extends CI_Model
{

	/**
	 * mtramite constructor.
	 */
	public function __construct()
	{
		parent::__construct();
	}

	/**
	 * Busqueda de un grupo empresarial
	 *
	 * @param $id
	 * @return array|mixed|object|null
	 */
	public function buscar($id)
	{
		$this->db->select('
			pcpte.cgrupoempresarial,
			mgrupoempresarial.dgrupoempresarial,
			pcpte.cinternopte
		');
		$this->db->from('pcpte');
		$this->db->join('pdpte', 'pcpte.cinternopte = pdpte.cinternopte AND pcpte.ccompania = pdpte.ccompania', 'inner');
		$this->db->join('mgrupoempresarial', 'mgrupoempresarial.cgrupoempresarial = pcpte.cgrupoempresarial', 'inner');
		$this->db->where('pcpte.ccompania', '1');
		$this->db->where('pcpte.carea', '04');
		$this->db->where('pcpte.sregistro', 'A');
		$this->db->like('mgrupoempresarial.cgrupoempresarial', $id);
		$this->db->limitAnyWhere(LIMITE_AUTOCOMPLETADO);
		$query = $this->db->get();
		if (!$query) {
			return null;
		}
		return ($query->num_rows() > 0) ? $query->row() : null;
	}

	/**
	 * Devuelve las entidades reguladoras
	 * @param $search
	 * @return array
	 */
	public function autoCompletado($search): array
	{
		$this->db->select('
			pcpte.cgrupoempresarial as id,
			mgrupoempresarial.dgrupoempresarial as text
		');
		$this->db->from('pcpte');
		$this->db->join('pdpte', 'pcpte.cinternopte = pdpte.cinternopte AND pcpte.ccompania = pdpte.ccompania', 'inner');
		$this->db->join('mgrupoempresarial', 'mgrupoempresarial.cgrupoempresarial = pcpte.cgrupoempresarial', 'inner');
		$this->db->where('pcpte.ccompania', '1');
		$this->db->where('pcpte.carea', '04');
		$this->db->where('pcpte.sregistro', 'A');
		$this->db->like('mgrupoempresarial.dgrupoempresarial', $search);
		$this->db->order_by('mgrupoempresarial.dgrupoempresarial', 'ASC');
		$this->db->limitAnyWhere(LIMITE_AUTOCOMPLETADO);
		$query = $this->db->get();
		if (!$query) {
			return [];
		}
		return ($query->num_rows() > 0) ? $query->result() : [];
	}

}
