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
	 * Se obtien un nuevo ID del AR
	 * @return int
	 * @throws Exception
	 */
	private function obtenerNuevoID()
	{
		$query = $this->db->select('MAX(CASUNTOREGULATORIO) as id')
			->from('pasuntoregulatorio')
			->get();
		if (!$query) {
			throw new Exception('Error al encontrar el Código AR');
		}
		return intval($query->row()->id) + 1;
	}

	/**
	 * @param $codigo
	 * @param $fechaInicio
	 * @param $fechaCierre
	 * @param $estado
	 * @param $internopte
	 * @param $clienteID
	 * @see crear
	 * @see actualizar
	 * @return array
	 * @throws Exception
	 */
	public function guardar($codigo, $fechaInicio, $fechaCierre, $estado, $internopte, $clienteID): array
	{
		if ($estado !== 'A' && $estado !== 'C') {
			throw new Exception('El valor del estado es invalido.');
		}
		if (empty($internopte)) {
			throw new Exception('El valor del codigo interno pte no es valido.');
		}
		if (empty($clienteID)) {
			throw new Exception('El valor del cliente es invalido.');
		}
		if (!validateDate($fechaInicio, 'Y-m-d')) {
			throw new Exception('El formato de la fecha incio es invalido.');
		}
		if (!empty($fechaCierre)) {
			if (!validateDate($fechaCierre, 'Y-m-d')) {
				throw new Exception('El formato de la fecha final es invalido.');
			}
		}
		$data = [
			'CASUNTOREGULATORIO' => $codigo,
			'CINTERNOPTE' => $internopte,
			'NORDEN' => 1,
			'FAPERTURA' => $fechaInicio,
			'FCIERRE' => $fechaCierre,
			'SCIERRE' => $estado,
			'CCLIENTE' => $clienteID,
			'CUSUARIOCREA' => '',
			'TCREACION' => date('Y-m-d H:i:s'),
			'CUSUARIOMODIFICA' => null,
			'TMODIFICACION' => null,
			'SREGISTRO' => 'A',
		];
		$res = (empty($codigo)) ? $this->crear($data) : $this->actualizar($codigo, $data);
		if (!$res) {
			throw new Exception('Error al intentar guardar el AR.');
		}
		return $data;
	}

	/**
	 * Crea un nuevo AR
	 * @param array $datos
	 * @return bool
	 * @throws Exception
	 */
	public function crear(array &$datos): bool
	{
		$datos['CASUNTOREGULATORIO'] = $this->obtenerNuevoID();
		$datos['CUSUARIOMODIFICA'] = null;
		$datos['TMODIFICACION'] = null;
		$res = $this->db->insert('pasuntoregulatorio', $datos);
		if (!$res) {
			throw new Exception('El A.R. no pudo ser creado correctamente.');
		}
		return $res;
	}

	/**
	 * Edita un AR
	 * @param string $id
	 * @param array $datos
	 * @return bool
	 * @throws Exception
	 */
	public function actualizar(string $id, array &$datos): bool
	{
		if (empty($id)) {
			throw new Exception('El AR no es valido para actualizar.');
		}
		$datos['TMODIFICACION'] = date('Y-m-d H:i:s');
		if (isset($datos['TCREACION'])) unset($datos['TCREACION']);
		if (isset($datos['CUSUARIOCREA'])) unset($datos['CUSUARIOCREA']);
		$res = $this->db->update('pasuntoregulatorio', $datos, ['CASUNTOREGULATORIO' => $id]);
		if (!$res) {
			throw new Exception('El A.R. no pudo ser actualizado correctamente.');
		}
		return $res;
	}

	/**
	 * Busca un AR
	 * @param $id
	 * @return array|mixed|object|null
	 */
	public function buscar($id)
	{
		$query = $this->db->where('CASUNTOREGULATORIO', $id)->get('pasuntoregulatorio');
		if (!$query) {
			return null;
		}
		return ($query->num_rows() > 0) ? $query->row() : null;
	}

	/**
	 * Filtro de los Asuntos Regulatorios
	 *
	 * @param string $fechaInicio
	 * @param string $fechaFinal
	 * @param string $tipoEstado
	 * @param string $cliente
	 * @param string $nroAR
	 * @param string $codigoRs
	 * @param string $estadoTramite
	 * @param string $entidad
	 * @param string $tipoProducto
	 * @param string $tramite
	 * @param string $categoria
	 * @param string $producto
	 * @param string $marca
	 * @param string $expediente
	 * @param int $limit
	 * @param int $offset
	 * @return array|array[]|object|object[]
	 */
	public function filtrarTramites(string $fechaInicio,
									string $fechaFinal,
									string $tipoEstado,
									string $cliente,
									string $nroAR,
									string $codigoRs,
									string $estadoTramite,
									string $entidad,
									string $tipoProducto,
									string $tramite,
									string $categoria,
									string $producto,
									string $marca,
									string $expediente,
									int $limit,
									int $offset = 1
	)
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
		$this->_filtro($fechaInicio,
			$fechaFinal,
			$tipoEstado,
			$cliente,
			$nroAR,
			$codigoRs,
			$estadoTramite,
			$entidad,
			$tipoProducto,
			$tramite,
			$categoria,
			$producto,
			$marca,
			$expediente);
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
	 * Total de los Asuntos Regulatorios
	 *
	 * @param string $fechaInicio
	 * @param string $fechaFinal
	 * @param string $tipoEstado
	 * @param string $cliente
	 * @param string $nroAR
	 * @param string $codigoRs
	 * @param string $estadoTramite
	 * @param string $entidad
	 * @param string $tipoProducto
	 * @param string $tramite
	 * @param string $categoria
	 * @param string $producto
	 * @param string $marca
	 * @param string $expediente
	 * @return int
	 */
	public function filtrarTramitesTotal(string $fechaInicio,
										 string $fechaFinal,
										 string $tipoEstado,
										 string $cliente,
										 string $nroAR,
										 string $codigoRs,
										 string $estadoTramite,
										 string $entidad,
										 string $tipoProducto,
										 string $tramite,
										 string $categoria,
										 string $producto,
										 string $marca,
										 string $expediente
	)
	{
		$this->db->select('COUNT(pasuntoregulatorio.casuntoregulatorio) AS total');
		$this->_filtro($fechaInicio,
			$fechaFinal,
			$tipoEstado,
			$cliente,
			$nroAR,
			$codigoRs,
			$estadoTramite,
			$entidad,
			$tipoProducto,
			$tramite,
			$categoria,
			$producto,
			$marca,
			$expediente
		);
		$query = $this->db->get();
		if (!$query) {
			return 0;
		}
		return ($query->num_rows()) ? (int)$query->row()->total : 0;
	}

	/**
	 * Realiza la consulta general del filtro de tramites
	 *
	 * @param string $fechaInicio
	 * @param string $fechaFinal
	 * @param string $tipoEstado
	 * @param string $cliente
	 * @param string $nroAR
	 * @param string $codigoRs
	 * @param string $estadoTramite
	 * @param string $entidad
	 * @param string $tipoProducto
	 * @param string $tramite
	 * @param string $categoria
	 * @param string $producto
	 * @param string $marca
	 * @param string $expediente
	 */
	private function _filtro(string $fechaInicio,
							 string $fechaFinal,
							 string $tipoEstado,
							 string $cliente,
							 string $nroAR,
							 string $codigoRs,
							 string $estadoTramite,
							 string $entidad,
							 string $tipoProducto,
							 string $tramite,
							 string $categoria,
							 string $producto,
							 string $marca,
							 string $expediente
	): void
	{
		$this->db->from('pasuntoregulatorio');
		$this->db->join('mcliente', 'pasuntoregulatorio.CCLIENTE = mcliente.CCLIENTE', 'inner');
		$this->db->join('pdpte', 'pasuntoregulatorio.CINTERNOPTE = pdpte.CINTERNOPTE', 'inner');
		$this->db->join('musuario', 'pasuntoregulatorio.CUSUARIOCREA = musuario.CUSUARIO', 'left');
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
		if (!empty($codigoRs)) {
			$this->db->like('mproductocliente.dregistrosanitario', $codigoRs, 'both');
		}
		if (!empty($estadoTramite)) {
			// $this->db->like('mproductocliente.dregistrosanitario', $estadoTramite, 'both');
		}
		if (!empty($entidad)) {
			// $this->db->like('mproductocliente.dregistrosanitario', $codigoRs, 'both');
		}
	}
}
