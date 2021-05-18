<?php

/**
 * Class mproductocliente
 */
class mproductocliente extends CI_Model
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
		$query = $this->db->select('MAX(CPRODUCTOFS) as id')
			->from('MPRODUCTOCLIENTE')
			->get();
		if (!$query) {
			throw new Exception('Error al encontrar el Código de producto');
		}
		return intval($query->row()->id) + 1;
	}

	/**
	 * Busqueda de productos para el AR
	 * @param $ccliente
	 * @param $tipoProducto
	 * @param $busqueda
	 * @return array|array[]|object|object[]
	 */
	public function filtrarTotal($ccliente, $tipoProducto, $busqueda)
	{
		$this->db->select("COUNT(MPRODUCTOCLIENTE.CPRODUCTOFS) AS total");
		$this->_filtro($ccliente, $tipoProducto, $busqueda);
		$query = $this->db->get();
		if (!$query) {
			return 0;
		}
		return ($query->num_rows()) ? (int)$query->row()->total : 0;
	}

	/**
	 * Busqueda de productos para el AR
	 * @param $ccliente
	 * @param $tipoProducto
	 * @param $busqueda
	 * @param int $limit
	 * @param int $offset
	 * @return array|array[]|object|object[]
	 */
	public function filtrar($ccliente, $tipoProducto, $busqueda, int $limit, int $offset = 1)
	{
		$this->db->select("
			MPRODUCTOCLIENTE.CPRODUCTOFS,
			MPRODUCTOCLIENTE.CPRODUCTOCLIENTE,
			MPRODUCTOCLIENTE.DPRODUCTOCLIENTE,
			MPRODUCTOCLIENTE.DNOMBREPRODUCTO,
			MMARCAXCLIENTE.DMARCA,
			MFABRICANTEXCLIENTE.DFABRICANTE,
			TTABLA.DREGISTRO,
			MFABRICANTEXCLIENTE2.CFABRICANTE AS CFABRICANTE2,
			MFABRICANTEXCLIENTE2.DFABRICANTE AS DFABRICANTE2,
			TTABLA2.CTIPO AS CTIPO2,
			TTABLA2.DREGISTRO AS DREGISTRO2,
			MCATEGORIACLIENTE.DCATEGORIACLIENTE,
			MPRODUCTOCLIENTE.DREGISTROSANITARIO,
			DATEFORMAT(MPRODUCTOCLIENTE.FINICIOREGSANITARIO, 'DD/MM/YYYY') as FINICIOREGSANITARIO,
			DATEFORMAT(MPRODUCTOCLIENTE.FFINREGSANITARIO, 'DD/MM/YYYY') as FFINREGSANITARIO
		");
		$this->_filtro($ccliente, $tipoProducto, $busqueda);
		if ($limit > 0) {
			$this->db->limitAnyWhere($limit, $offset);
		}
		$this->db->order_by('MPRODUCTOCLIENTE.TCREACION', 'DESC');
		$query = $this->db->get();
		if (!$query) {
			return [];
		}
		return ($query->num_rows() > 0) ? $query->result() : [];
	}

	/**
	 * @param $ccliente
	 * @param $tipoProducto
	 * @param $busqueda
	 * @param $tipo
	 */
	private function _filtro($ccliente, $tipoProducto, $busqueda, $tipo = null): void
	{
		$this->db->from('MPRODUCTOCLIENTE');
		$this->db->join('MMARCAXCLIENTE', 'MPRODUCTOCLIENTE.CMARCA = MMARCAXCLIENTE.CMARCA AND MPRODUCTOCLIENTE.CCLIENTE = MMARCAXCLIENTE.CCLIENTE', 'left');
		$this->db->join('MFABRICANTEXCLIENTE', 'MPRODUCTOCLIENTE.CFABRICANTE = MFABRICANTEXCLIENTE.CFABRICANTE AND MPRODUCTOCLIENTE.CCLIENTE = MFABRICANTEXCLIENTE.CCLIENTE', 'left');
		$this->db->join('MFABRICANTEXCLIENTE MFABRICANTEXCLIENTE2', 'MPRODUCTOCLIENTE.CFABRICANTE2 = MFABRICANTEXCLIENTE2.CFABRICANTE AND MPRODUCTOCLIENTE.CCLIENTE = MFABRICANTEXCLIENTE2.CCLIENTE', 'left');
		$this->db->join('MCATEGORIACLIENTE', 'MPRODUCTOCLIENTE.CCATEGORIACLIENTE = MCATEGORIACLIENTE.CCATEGORIACLIENTE AND MPRODUCTOCLIENTE.CCLIENTE = MCATEGORIACLIENTE.CCLIENTE', 'left');
		$this->db->join('TTABLA', 'MPRODUCTOCLIENTE.ZCPAISFABRICANTE = TTABLA.CTIPO', 'left');
		$this->db->join('TTABLA AS TTABLA2', 'MPRODUCTOCLIENTE.ZCPAISFABRICANTE2 = TTABLA2.CTIPO', 'left');
		$this->db->where('MPRODUCTOCLIENTE.CCLIENTE', $ccliente);
		$this->db->where('MPRODUCTOCLIENTE.ZCTIPOCATEGORIAPRODUCTO', $tipoProducto);
		$this->db->where('MPRODUCTOCLIENTE.SREGISTRO', 'A');
		if (empty($tipo)) {
			$this->db->group_start();
			$this->db->like('MPRODUCTOCLIENTE.CPRODUCTOCLIENTE', $busqueda, 'both', false);
			$this->db->or_like('MPRODUCTOCLIENTE.DPRODUCTOCLIENTE', $busqueda, 'both', false);
			$this->db->or_like('MPRODUCTOCLIENTE.DREGISTROSANITARIO', $busqueda, 'both', false);
			$this->db->group_end();
		}
		// Busqueda por RS
		if ($tipo == 1) {
			$this->db->where('MPRODUCTOCLIENTE.DREGISTROSANITARIO', $busqueda);
		}
		// Busqueda por Codigo
		if ($tipo == 2) {
			$this->db->where('MPRODUCTOCLIENTE.CPRODUCTOFS', $busqueda);
		}
	}

	/**
	 * @param $CPRODUCTOFS
	 * @return array|mixed|object|null
	 */
	public function buscarDatos($CPRODUCTOFS)
	{
		$this->db->select("
			MPRODUCTOCLIENTE.CPRODUCTOFS,
			MPRODUCTOCLIENTE.CPRODUCTOCLIENTE,
			MPRODUCTOCLIENTE.DPRODUCTOCLIENTE,
			MPRODUCTOCLIENTE.DNOMBREPRODUCTO,
			MMARCAXCLIENTE.DMARCA,
			MFABRICANTEXCLIENTE.DFABRICANTE,
			TTABLA.DREGISTRO,
			MCATEGORIACLIENTE.DCATEGORIACLIENTE,
			MPRODUCTOCLIENTE.DREGISTROSANITARIO,
			DATEFORMAT(MPRODUCTOCLIENTE.FINICIOREGSANITARIO, 'DD/MM/YYYY') as FINICIOREGSANITARIO,
			DATEFORMAT(MPRODUCTOCLIENTE.FFINREGSANITARIO, 'DD/MM/YYYY') as FFINREGSANITARIO
		");
		$this->db->from('MPRODUCTOCLIENTE');
		$this->db->join('MMARCAXCLIENTE', 'MPRODUCTOCLIENTE.CMARCA = MMARCAXCLIENTE.CMARCA AND MPRODUCTOCLIENTE.CCLIENTE = MMARCAXCLIENTE.CCLIENTE', 'left');
		$this->db->join('MFABRICANTEXCLIENTE', 'MPRODUCTOCLIENTE.CFABRICANTE = MFABRICANTEXCLIENTE.CFABRICANTE AND MPRODUCTOCLIENTE.CCLIENTE = MFABRICANTEXCLIENTE.CCLIENTE', 'left');
		$this->db->join('MCATEGORIACLIENTE', 'MPRODUCTOCLIENTE.CCATEGORIACLIENTE = MCATEGORIACLIENTE.CCATEGORIACLIENTE AND MPRODUCTOCLIENTE.CCLIENTE = MCATEGORIACLIENTE.CCLIENTE', 'left');
		$this->db->join('TTABLA', 'MPRODUCTOCLIENTE.ZCPAISFABRICANTE = TTABLA.CTIPO', 'left');
		$this->db->where('MPRODUCTOCLIENTE.CPRODUCTOFS', $CPRODUCTOFS);
		$query = $this->db->get();
		if (!$query) {
			return null;
		}
		return ($query->num_rows() > 0) ? $query->row() : null;
	}

	/**
	 * @param string $id
	 * @param string $idCliente
	 * @param string $idTipoProducto
	 * @param string $codigo
	 * @param $idCategoria
	 * @param string $registroSanitario
	 * @param string $fechaEmision
	 * @param string $fechaVencimiento
	 * @param string $descripcion
	 * @param string $nombre
	 * @param $idMarca
	 * @param string $presentacion
	 * @param $idPais
	 * @param $idFabricante
	 * @param string $direccionFabricante
	 * @param string $vidaUtil
	 * @param $idFabricante2
	 * @param $idPais2
	 * @param $dformacosmetica
	 * @param $dmodeloProducto
	 * @param $codigoFormula
	 * @param $sinflamable
	 * @param $stramitable
	 * @param string $estado
	 * @return array
	 * @throws Exception
	 */
	public function guardar(string $id,
							string $idCliente,
							string $idTipoProducto,
							string $codigo,
							$idCategoria,
							string $registroSanitario,
							string $fechaEmision,
							string $fechaVencimiento,
							string $descripcion,
							string $nombre,
							$idMarca,
							string $presentacion,
							$idPais,
							$idFabricante,
							string $direccionFabricante,
							string $vidaUtil,
							$idFabricante2,
							$idPais2,
							$dformacosmetica,
							$dmodeloProducto,
							$codigoFormula,
							$sinflamable,
							$stramitable,
							string $estado
	): array
	{
		if (empty($idCliente)) {
			throw new Exception('Falta el ID del cliente');
		}
		if (empty($idTipoProducto)) {
			throw new Exception('Falta el ID del Tipo de Producto');
		}
		if (empty($registroSanitario)) {
			throw new Exception('Debe ingresar el RS.');
		}
		if (empty($fechaEmision) || !validateDate($fechaEmision, 'd/m/Y')) {
			throw new Exception('Debe ingresar la Fecha de Emisión');
		}
		if (empty($fechaEmision) || !validateDate($fechaVencimiento, 'd/m/Y')) {
			throw new Exception('Debe ingresar la Fecha de Vencimiento');
		}
		if (empty($nombre)) {
			throw new Exception('Debe ingresar el nombre del producto.');
		}
		if ($estado != 'A' && $estado != 'I') {
			throw new Exception('Debe elegir un estado para su producto.');
		}

		$fechaEmision = \Carbon\Carbon::createFromFormat('d/m/Y', $fechaEmision, 'America/Lima')->format('Y-m-d');
		$fechaVencimiento = \Carbon\Carbon::createFromFormat('d/m/Y', $fechaVencimiento, 'America/Lima')->format('Y-m-d');

		$validate = $this->validarSKU($codigo, $registroSanitario, $id);
		if (!empty($validate)) {
			throw new Exception('El RS + SKU ya existe registro un un producto.');
		}

		$data = [
			'CPRODUCTOFS' => $id,
			'CCLIENTE' => $idCliente,
			'ZCTIPOCATEGORIAPRODUCTO' => $idTipoProducto,
			'CPRODUCTOCLIENTE' => $codigo,
			'DNOMBREPRODUCTO' => $nombre,
			'DPRODUCTOCLIENTE' => $descripcion,
			'SINFLAMABLE' => $sinflamable,
			'STRAMITABLE' => $stramitable,
			'DMODELOPRODUCTO' => $dmodeloProducto,
			'DPRESENTACION' => $presentacion,
			'CFABRICANTE' => $idFabricante,
			'ZCPAISFABRICANTE' => $idPais,
			'DDIRECCIONFABRICANTE' => $direccionFabricante,
			'CMARCA' => $idMarca,
			'CFABRICANTE2' => $idFabricante2,
			'ZCPAISFABRICANTE2' => $idPais2,
			'DREGISTROSANITARIO' => $registroSanitario,
			'FINICIOREGSANITARIO' => $fechaEmision,
			'FFINREGSANITARIO' => $fechaVencimiento,
			'CUSUARIOCREA' => '',
			'TCREACION' => date('Y-m-d H:i:s'),
			'CUSUARIOMODIFICA' => null,
			'TMODIFICACION' => null,
			'SREGISTRO' => $estado,
			'CCATEGORIACLIENTE' => $idCategoria,
			'DFORMACOSMETICA' => $dformacosmetica,
			'DCODIGOFORMULA' => $codigoFormula,
			'VIDAUTIL' => $vidaUtil,
		];
		$res = (empty($id)) ? $this->crear($data) : $this->actualizar($id, $data);
		if (!$res) {
			throw new Exception('Error al intentar guardar el producto.');
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
		$datos['CPRODUCTOFS'] = $this->obtenerNuevoID();
		$datos['CUSUARIOMODIFICA'] = null;
		$datos['TMODIFICACION'] = null;
		$res = $this->db->insert('MPRODUCTOCLIENTE', $datos);
		if (!$res) {
			throw new Exception('El Producto no pudo ser creado correctamente.');
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
			throw new Exception('El Producto no es valido para actualizar.');
		}
		$datos['TMODIFICACION'] = date('Y-m-d H:i:s');
		$res = $this->db->update('MPRODUCTOCLIENTE', $datos, ['CPRODUCTOFS' => $id]);
		if (!$res) {
			throw new Exception('El Producto no pudo ser actualizado correctamente.');
		}
		return $res;
	}

	/**
	 * @param $CPRODUCTOCLIENTE
	 * @param $DREGISTROSANITARIO
	 * @param $CPRODUCTOFS
	 * @return array|mixed|object|null
	 */
	public function validarSKU($CPRODUCTOCLIENTE, $DREGISTROSANITARIO, $CPRODUCTOFS = 0)
	{
		$this->db->select('*');
		$this->db->from('MPRODUCTOCLIENTE');
		$this->db->where('CPRODUCTOCLIENTE', $CPRODUCTOCLIENTE);
		$this->db->where('DREGISTROSANITARIO', $DREGISTROSANITARIO);
		if (!empty($CPRODUCTOFS)) {
			$this->db->where('CPRODUCTOFS !=', $CPRODUCTOFS);
		}
		$query = $this->db->get();
		if (!$query) {
			return null;
		}
		return ($query->num_rows() > 0) ? $query->row() : null;
	}

	/**
	 * @param $ccliente
	 * @param $tipoProducto
	 * @param $tipo
	 * @param $buscar
	 * @return array|mixed|object|null
	 */
	public function buscar($ccliente, $tipoProducto, $tipo, $buscar)
	{
		$this->db->select("
			MPRODUCTOCLIENTE.*,
			MMARCAXCLIENTE.CMARCA,
			MMARCAXCLIENTE.DMARCA,
			MFABRICANTEXCLIENTE.CFABRICANTE,
			MFABRICANTEXCLIENTE.DFABRICANTE,
			TTABLA.CTIPO,
			TTABLA.DREGISTRO,
			MFABRICANTEXCLIENTE2.CFABRICANTE AS CFABRICANTE2,
			MFABRICANTEXCLIENTE2.DFABRICANTE AS DFABRICANTE2,
			TTABLA2.CTIPO AS CTIPO2,
			TTABLA2.DREGISTRO AS DREGISTRO2,
			MCATEGORIACLIENTE.CCATEGORIACLIENTE,
			MCATEGORIACLIENTE.DCATEGORIACLIENTE,
			DATEFORMAT(MPRODUCTOCLIENTE.FINICIOREGSANITARIO, 'DD/MM/YYYY') as FINICIOREGSANITARIO,
			DATEFORMAT(MPRODUCTOCLIENTE.FFINREGSANITARIO, 'DD/MM/YYYY') as FFINREGSANITARIO
		");
		$this->_filtro($ccliente, $tipoProducto, $buscar, $tipo);
		$query = $this->db->get();
		if (!$query) {
			return [];
		}
		return ($query->num_rows() > 0) ? $query->result() : [];
	}

}
