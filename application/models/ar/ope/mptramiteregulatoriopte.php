<?php


class mptramiteregulatoriopte extends CI_Model
{

	/**
	 * mptramiteregulatoriopte constructor.
	 */
	public function __construct()
	{
		parent::__construct();
	}

	/**
	 * Busqueda del tramite por el asunto regulatorio
	 * @param $CASUNTOREGULATORIO
	 * @return array|array[]|object|object[]
	 */
	public function buscarAR($CASUNTOREGULATORIO)
	{
		$this->db->select('
			ptramiteregulatoriopte.*,
			MTRAMITEREGULADORA.DTRAMITE as DTRAMITE,
		');
		$this->db->from('ptramiteregulatoriopte');
		$this->db->join('MTRAMITEREGULADORA', 'ptramiteregulatoriopte.CTRAMITE = MTRAMITEREGULADORA.CTRAMITE AND ptramiteregulatoriopte.CENTIDADREGULA = MTRAMITEREGULADORA.CENTIDADREGULA', 'inner');
		$this->db->where('ptramiteregulatoriopte.CASUNTOREGULATORIO', $CASUNTOREGULATORIO);
		$query = $this->db->get();
		if (!$query) {
			return [];
		}
		return ($query->num_rows() > 0) ? $query->result() : [];
	}

	/**
	 * @param $CASUNTOREGULATORIO
	 * @param $CENTIDADREGULA
	 * @param $CTRAMITE
	 * @return array|mixed|object|null
	 */
	public function buscar($CASUNTOREGULATORIO, $CENTIDADREGULA, $CTRAMITE)
	{
		$this->db->select('*');
		$this->db->from('ptramiteregulatoriopte');
		$this->db->where('CASUNTOREGULATORIO', $CASUNTOREGULATORIO);
		$this->db->where('CENTIDADREGULA', $CENTIDADREGULA);
		$this->db->where('CTRAMITE', $CTRAMITE);
		$query = $this->db->get();
		if (!$query) {
			return null;
		}
		return ($query->num_rows() > 0) ? $query->row() : null;
	}

	/**
	 * @param $CASUNTOREGULATORIO
	 * @param $CENTIDADREGULA
	 * @param $CTRAMITE
	 * @param string $SVISTOBUENO
	 * @param string $SREGISTROENTIDAD
	 * @param string $SOBSERVADOENTIDAD
	 * @param string $FREGISTROENTIDAD
	 * @param string $DTRACKIDTRAMITE
	 * @param string $DNUMEROREGISTRO
	 * @param string $DNUMEROEXPEDIENTE
	 * @param $FEMISIONREGISTRO
	 * @param $FVENCIMIENTOREGISTRO
	 * @param string $STRAMITE
	 * @param string $CUSUARIO
	 * @param string $SREGISTRO
	 * @param string $DNUMERODR
	 * @return array
	 * @throws Exception
	 */
	public function guardar(
		$CASUNTOREGULATORIO,
		$CENTIDADREGULA,
		$CTRAMITE,
		string $SVISTOBUENO,
		string $SREGISTROENTIDAD,
		string $SOBSERVADOENTIDAD,
		string $FREGISTROENTIDAD,
		string $DTRACKIDTRAMITE,
		string $DNUMEROREGISTRO,
		string $DNUMEROEXPEDIENTE,
		$FEMISIONREGISTRO,
		$FVENCIMIENTOREGISTRO,
		string $STRAMITE,
		string $CUSUARIO,
		string $SREGISTRO,
		string $DNUMERODR
	)
	{
		if (empty($CASUNTOREGULATORIO)) {
			throw new Exception('Tramite: El código de asunto regulatorio no puede estar vacío.');
		}

		if (empty($CENTIDADREGULA)) {
			throw new Exception('Tramite: El código la entidad no puede estar vacío.');
		}

		if (empty($CTRAMITE)) {
			throw new Exception('Tramite: El código de tramite no puede estar vacío.');
		}

		if (!validateDate($FREGISTROENTIDAD, 'Y-m-d')) {
			throw new Exception('Tramite: El formato de la fecha de registro entidad es incorrecto.');
		}
		if (!validateDate($FEMISIONREGISTRO, 'Y-m-d')) {
			throw new Exception('Tramite: El formato de la fecha de emisión es incorrecto.');
		}
		if (!empty($FVENCIMIENTOREGISTRO)) {
			if (!validateDate($FVENCIMIENTOREGISTRO, 'Y-m-d')) {
				throw new Exception('Tramite: El formato de la fecha vencimiento de registro es incorrecto.');
			}
		}
		$data = [
			'CASUNTOREGULATORIO' => $CASUNTOREGULATORIO,
			'CENTIDADREGULA' => $CENTIDADREGULA,
			'CTRAMITE' => $CTRAMITE,
			'SVISTOBUENO' => $SVISTOBUENO,
			'SREGISTROENTIDAD' => $SREGISTROENTIDAD,
			'SOBSERVADOENTIDAD' => $SOBSERVADOENTIDAD,
			'FREGISTROENTIDAD' => $FREGISTROENTIDAD,
			'DTRACKIDTRAMITE' => $DTRACKIDTRAMITE,
			'DNUMEROREGISTRO' => $DNUMEROREGISTRO,
			'DNUMEROEXPEDIENTE' => $DNUMEROEXPEDIENTE,
			'FEMISIONREGISTRO' => $FEMISIONREGISTRO,
			'FVENCIMIENTOREGISTRO' => $FVENCIMIENTOREGISTRO,
			'STRAMITE' => $STRAMITE,
			'CUSUARIOCREA' => $CUSUARIO,
			'TCREACION' => date('Y-m-d H:i:s'),
			'CUSUARIOMODIFICA' => $CUSUARIO,
			'TMODIFICACION' => null,
			'SREGISTRO' => $SREGISTRO,
			'DNUMERODR' => $DNUMERODR,
		];

		// Validar si se crea o se edita
		$objTramite = $this->buscar($CASUNTOREGULATORIO, $CENTIDADREGULA, $CTRAMITE);

		$res = (empty($objTramite)) ? $this->crear($data) : $this->actualizar($CASUNTOREGULATORIO, $CENTIDADREGULA, $CTRAMITE, $data);
		if (!$res) {
			throw new Exception('Tramite: Error al intentar guardar el AR.');
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
		$res = $this->db->insert('ptramiteregulatoriopte', $datos);
		if (!$res) {
			throw new Exception('Tramite: El A.R. no pudo ser creado correctamente.');
		}
		return $res;
	}

	/**
	 * @param $CASUNTOREGULATORIO
	 * @param $CENTIDADREGULA
	 * @param $CTRAMITE
	 * @param array $datos
	 * @return bool
	 * @throws Exception
	 */
	public function actualizar($CASUNTOREGULATORIO, $CENTIDADREGULA, $CTRAMITE, array &$datos): bool
	{
		if (empty($CASUNTOREGULATORIO) || empty($CENTIDADREGULA) || empty($CTRAMITE)) {
			throw new Exception('Tramite: El AR no es valido para actualizar.');
		}
		if (isset($datos['CUSUARIOCREA'])) unset($datos['CUSUARIOCREA']);
		if (isset($datos['TCREACION'])) unset($datos['TCREACION']);
		$datos['TMODIFICACION'] = date('Y-m-d H:i:s');
		$res = $this->db->update('ptramiteregulatoriopte', $datos, [
			'CASUNTOREGULATORIO' => $CASUNTOREGULATORIO,
			'CENTIDADREGULA' => $CENTIDADREGULA,
			'CTRAMITE' => $CTRAMITE,
		]);
		if (!$res) {
			throw new Exception('Tramite: El A.R. no pudo ser actualizado correctamente.');
		}
		return $res;
	}

}
