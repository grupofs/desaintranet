<?php


class mproducto extends CI_Model
{

	/**
	 * mtramite constructor.
	 */
	public function __construct()
	{
		parent::__construct();
	}

	/**
	 * Busqueda de productos de un tramite
	 * @param $id
	 * @return array|array[]|object|object[]
	 */
	public function buscarPorTraimite($id)
	{
		$this->db->select("
			pproductoxpteregulatorio.casuntoregulatorio,
			mproductocliente.cproductocliente,
			mproductocliente.dproductocliente, 
			mmarcaxcliente.dmarca,
			mproductocliente.dnombreproducto,
			mproductocliente.dmodeloproducto, 
			mproductocliente.dregistrosanitario,
			DATEFORMAT(mproductocliente.ffinregsanitario, 'DD/MM/YYYY') as ffinregsanitario
		");
		$this->db->from('pproductoxpteregulatorio');
		$this->db->join('mproductocliente', 'pproductoxpteregulatorio.cproductofs = mproductocliente.cproductofs', 'inner');
		$this->db->join('mmarcaxcliente', 'mproductocliente.ccliente = mmarcaxcliente.ccliente AND mproductocliente.cmarca = mmarcaxcliente.cmarca', 'inner');
		$this->db->where('pproductoxpteregulatorio.casuntoregulatorio', $id);
		$query = $this->db->get();
		if (!$query) {
			return [];
		}
		return ($query->num_rows() > 0) ? $query->result() : [];
	}

}
