<?php

/**
 * Class mttramite
 */
class mttramite extends CI_Model
{


	/**
	 * mttramite constructor.
	 */
	public function __construct()
	{
		parent::__construct();
	}

	/**
	 * Busca un tipo de producto
	 * @param string $entidad
	 * @param string $id
	 * @return array|mixed|object|null
	 */
	public function buscarTipoProducto(string $entidad, string $id)
	{
		$this->db->select('
			mtramitereguladora.zctipocategoriaproducto as id,
			ttabla.dregistro as text
		');
		$this->db->from('mtramitereguladora');
		$this->db->join('ttabla', 'mtramitereguladora.zctipocategoriaproducto = ttabla.ctipo', 'inner');
		$this->db->where('mtramitereguladora.centidadregula', $entidad);
		$this->db->where('mtramitereguladora.zctipocategoriaproducto', $id);
		$query = $this->db->get();
		if (!$query) {
			return [];
		}
		return ($query->num_rows() > 0) ? $query->row() : [];
	}

	/**
	 * @param string $search
	 * @param string $entidad
	 * @return array|array[]|object|object[]
	 */
	public function autoCompletadoTipoProducto(string $search, string $entidad): array
	{
		$this->db->select('
			mtramitereguladora.zctipocategoriaproducto as id,
			ttabla.dregistro as text
		');
		$this->db->from('mtramitereguladora');
		$this->db->join('ttabla', 'mtramitereguladora.zctipocategoriaproducto = ttabla.ctipo', 'inner');
		$this->db->where('mtramitereguladora.centidadregula', $entidad);
		$this->db->like('ttabla.dregistro', $search);
		$this->db->order_by('ttabla.dregistro', 'ASC');
		$this->db->limitAnyWhere(LIMITE_AUTOCOMPLETADO);
		$this->db->group_by("mtramitereguladora.zctipocategoriaproducto, ttabla.dregistro");
		$query = $this->db->get();
		if (!$query) {
			return [];
		}
		return ($query->num_rows() > 0) ? $query->result() : [];
	}

}
