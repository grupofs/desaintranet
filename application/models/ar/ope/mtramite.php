<?php

/**
 * Class mtramite
 */
class mtramite extends CI_Model
{

	/**
	 * mtramite constructor.
	 */
	public function __construct()
	{
		parent::__construct();
	}

	/**
	 * Filtro de los Asuntos Regulatorios
	 *
	 * @param string $fechaInicio
	 * @param string $fechaFinal
	 * @param string $tipoEstado
	 * @param string $cliente
	 * @param string $nroAR
	 * @param int $limit
	 * @param int $offset
	 * @return mixed
	 */
	public function filtrarTramites(string $fechaInicio, string $fechaFinal, string $tipoEstado, string $cliente, string $nroAR, int $limit, int $offset = 1)
	{
		$this->db->select("
			pasuntoregulatorio.casuntoregulatorio,
			pasuntoregulatorio.cinternopte,
			pasuntoregulatorio.norden,
			DATEFORMAT(pasuntoregulatorio.fapertura, 'DD/MM/YYYY') as fapertura,
			pasuntoregulatorio.sregistro,
			pasuntoregulatorio.ccliente, 
			mcliente.drazonsocial,
			pasuntoregulatorio.scierre,
			CASE
				WHEN pasuntoregulatorio.scierre = 'A' THEN 'Abierto'
				WHEN pasuntoregulatorio.scierre = 'C' THEN 'Cerrado'
				ELSE '---'
			END as textoscierre,
			STRING(musuario.dapepat, ' ', musuario.dapemat, ' ', musuario.dnombre) as responsable,
			mproductocliente.cproductocliente,
			mproductocliente.dproductocliente, 
			mmarcaxcliente.dmarca,
			mproductocliente.dnombreproducto,
			mproductocliente.dmodeloproducto, 
			mproductocliente.dregistrosanitario,
			DATEFORMAT(mproductocliente.ffinregsanitario, 'DD/MM/YYYY') as ffinregsanitario
		");
		$this->_filtro($fechaInicio, $fechaFinal, $tipoEstado, $cliente, $nroAR);
		$this->db->order_by('mcliente.drazonsocial', 'ASC');
		$this->db->order_by('pasuntoregulatorio.casuntoregulatorio', 'ASC');
		if ($limit > 0) {
			$this->db->limitAnyWhere($limit, $offset);
		}
		$query = $this->db->get();
		if (!$query) {
			return [];
		}
		return ($query->num_rows()) ? $query->result() : [];
	}

	/**
	 * Filtro de los Asuntos Regulatorios
	 *
	 * @param string $fechaInicio
	 * @param string $fechaFinal
	 * @param string $tipoEstado
	 * @param string $cliente
	 * @param string $nroAR
	 * @param int $limit
	 * @param int $offset
	 * @return mixed
	 */
	public function filtrarTramitesTotal(string $fechaInicio, string $fechaFinal, string $tipoEstado, string $cliente, string $nroAR)
	{
		$this->db->select('COUNT(pasuntoregulatorio.casuntoregulatorio) AS total');
		$this->_filtro($fechaInicio, $fechaFinal, $tipoEstado, $cliente, $nroAR);
		$query = $this->db->get();
		if (!$query) {
			return 0;
		}
		return ($query->num_rows()) ? (int) $query->row()->total : 0;
	}

	/**
	 * Realiza la consulta general del filtro de tramites
	 * @param string $fechaInicio
	 * @param string $fechaFinal
	 * @param string $tipoEstado
	 * @param string $cliente
	 * @param string $nroAR
	 */
	private function _filtro(string $fechaInicio, string $fechaFinal, string $tipoEstado, string $cliente, string $nroAR): void
	{
		$this->db->from('pasuntoregulatorio');
		$this->db->join('mcliente', 'pasuntoregulatorio.CCLIENTE = mcliente.CCLIENTE', 'inner');
		$this->db->join('musuario', 'pasuntoregulatorio.CUSUARIOCREA = musuario.CUSUARIO', 'inner');
		$this->db->join('pdpte', 'pasuntoregulatorio.CINTERNOPTE = pdpte.CINTERNOPTE', 'inner');
		$this->db->join('pproductoxpteregulatorio', 'pasuntoregulatorio.casuntoregulatorio = pproductoxpteregulatorio.casuntoregulatorio', 'left outer');
		$this->db->join('mproductocliente', 'pproductoxpteregulatorio.cproductofs = mproductocliente.cproductofs', 'left outer');
		$this->db->join('mmarcaxcliente', 'mproductocliente.ccliente = mmarcaxcliente.ccliente AND mproductocliente.cmarca = mmarcaxcliente.cmarca', 'left outer');
		$this->db->where('pasuntoregulatorio.fapertura >=', $fechaInicio);
		$this->db->where('pasuntoregulatorio.fapertura <=', $fechaFinal);
		if (!empty($tipoEstado)) {
			$this->db->where('pasuntoregulatorio.scierre', $tipoEstado);
		}
		if (!empty($cliente)) {
			$this->db->where('pasuntoregulatorio.ccliente', $cliente);
		}
		if (!empty($nroAR)) {
			$this->db->like('pasuntoregulatorio.casuntoregulatorio', $nroAR, 'after');
		}
	}
}
