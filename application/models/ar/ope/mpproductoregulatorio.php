<?php

/**
 * Class mpproductoregulatorio
 */
class mpproductoregulatorio extends CI_Model
{

	/**
	 * mptramiteregulatoriopte constructor.
	 */
	public function __construct()
	{
		parent::__construct();
	}

	/**
	 * @param $CASUNTOREGULATORIO
	 * @return array|array[]|object|object[]
	 */
	public function buscarProductos($CASUNTOREGULATORIO)
	{
		$this->db->select("
			MPRODUCTOCLIENTE.*,
			DATEFORMAT(PPRODUCTOXPTEREGULATORIO.FFECHAESTIMADA, 'DD/MM/YYYY') AS FFECHAESTIMADA,
			PPRODUCTOXPTEREGULATORIO.DCOMENTARIO
		");
		$this->db->from('PPRODUCTOXPTEREGULATORIO');
		$this->db->join('MPRODUCTOCLIENTE', 'PPRODUCTOXPTEREGULATORIO.CPRODUCTOFS = MPRODUCTOCLIENTE.CPRODUCTOFS', 'inner');
		$this->db->where('PPRODUCTOXPTEREGULATORIO.CASUNTOREGULATORIO', $CASUNTOREGULATORIO);
		$query = $this->db->get();
		if (!$query) {
			return [];
		}
		return ($query->num_rows() > 0) ? $query->result() : [];
	}

	/**
	 * @param $CASUNTOREGULATORIO
	 * @param $CPRODUCTOFS
	 * @return array|mixed|object|null
	 */
	public function buscar($CASUNTOREGULATORIO, $CPRODUCTOFS)
	{
		$this->db->select('*');
		$this->db->from('PPRODUCTOXPTEREGULATORIO');
		$this->db->where('CASUNTOREGULATORIO', $CASUNTOREGULATORIO);
		$this->db->where('CPRODUCTOFS', $CPRODUCTOFS);
		$query = $this->db->get();
		if (!$query) {
			return null;
		}
		return ($query->num_rows() > 0) ? $query->row() : null;
	}

	/**
	 * @param $CASUNTOREGULATORIO
	 * @param $CPRODUCTOFS
	 * @param $FFECHAESTIMADA
	 * @param $DCOMENTARIO
	 * @param $CUSUARIOCREA
	 * @param $CUSUARIOMODIFICA
	 * @param $SREGISTRO
	 * @return array
	 * @throws Exception
	 */
	public function guardar(
		$CASUNTOREGULATORIO,
		$CPRODUCTOFS,
		$FFECHAESTIMADA,
		$DCOMENTARIO,
		$CUSUARIOCREA,
		$CUSUARIOMODIFICA,
		$SREGISTRO
	)
	{
		if (empty($CASUNTOREGULATORIO)) {
			throw new Exception('Producto: El código de asunto regulatorio no puede estar vacío.');
		}

		if (empty($CPRODUCTOFS)) {
			throw new Exception('Producto: El código de asunto regulatorio no puede estar vacío.');
		}

		if (!empty($FFECHAESTIMADA)) {
			if (!validateDate($FFECHAESTIMADA, 'Y-m-d')) {
				throw new Exception('Producto: El formato de la fecha estimada no es invalido.');
			}
		}

		$data = [
			'CASUNTOREGULATORIO' => $CASUNTOREGULATORIO,
			'CPRODUCTOFS' => $CPRODUCTOFS,
			'FFECHAESTIMADA' => $FFECHAESTIMADA,
			'DCOMENTARIO' => $DCOMENTARIO,
			'CUSUARIOCREA' => $CUSUARIOCREA,
			'TCREACION' => date('Y-m-d H:i:s'),
			'CUSUARIOMODIFICA' => $CUSUARIOMODIFICA,
			'TMODIFICACION' => null,
			'SREGISTRO' => $SREGISTRO,
		];

		// Validar si se crea o edita
		$objProducto = $this->buscar($CASUNTOREGULATORIO, $CPRODUCTOFS);

		$res = (empty($objProducto)) ? $this->crear($data) : $this->actualizar($CASUNTOREGULATORIO, $CPRODUCTOFS, $data);
		if (!$res) {
			throw new Exception('Producto: Error al intentar guardar el AR.');
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
		$datos['CUSUARIOMODIFICA'] = null;
		$datos['TMODIFICACION'] = null;
		$res = $this->db->insert('PPRODUCTOXPTEREGULATORIO', $datos);
		if (!$res) {
			throw new Exception('Producto: El A.R. no pudo ser creado correctamente.');
		}
		return $res;
	}

	/**
	 * @param $CASUNTOREGULATORIO
	 * @param $CPRODUCTOFS
	 * @param array $datos
	 * @return bool
	 * @throws Exception
	 */
	public function actualizar($CASUNTOREGULATORIO, $CPRODUCTOFS, array &$datos): bool
	{
		if (empty($CASUNTOREGULATORIO) || empty($CPRODUCTOFS)) {
			throw new Exception('Producto: El AR no es valido para actualizar.');
		}
		$datos['TMODIFICACION'] = date('Y-m-d H:i:s');
		$res = $this->db->update('PPRODUCTOXPTEREGULATORIO', $datos, [
			'CASUNTOREGULATORIO' => $CASUNTOREGULATORIO,
			'CPRODUCTOFS' => $CPRODUCTOFS,
		]);
		if (!$res) {
			throw new Exception('Producto: El A.R. no pudo ser actualizado correctamente.');
		}
		return $res;
	}

	/**
	 * Elimina todos los productos del AR
	 * @param $CASUNTOREGULATORIO
	 * @return false|mixed|string
	 */
	public function eliminarTodo($CASUNTOREGULATORIO)
	{
		return $this->db->delete('PPRODUCTOXPTEREGULATORIO', ['CASUNTOREGULATORIO' => $CASUNTOREGULATORIO]);
	}

}
