<?php

/**
 * Class mpdocumentoregulatorioarchivo
 */
class mpdocumentoregulatorioarchivo extends CI_Model
{

	/**
	 * mpdocumentoregulatorioarchivo constructor.
	 */
	public function __construct()
	{
		parent::__construct();
	}

	/**
	 * @param string $codigo
	 * @return mixed
	 */
	public function buscar(string $codigo)
	{
		$this->db->select('*');
		$this->db->from('PDOCUMENTOREGULATORIOARCHIVOS');
		$this->db->where('CDOCUMENTOREGULAARCHIVO', $codigo);
		$query = $this->db->get();
		if (!$query) {
			return null;
		}
		return ($query->num_rows()) ? $query->row() : null;
	}

	/**
	 * @param $id
	 * @return mixed|string
	 * @throws Exception
	 */
	public function delete($id)
	{
		$query = $this->db->delete('PDOCUMENTOREGULATORIOARCHIVOS', ['CDOCUMENTOREGULAARCHIVO' => $id]);
		if (!$query) {
			throw new Exception('El archivo no pudo ser eliminado.');
		}
		return $query;
	}

	/**
	 * Se obtien un nuevo ID
	 * @return int
	 * @throws Exception
	 */
	private function obtenerNuevoID(): int
	{
		$query = $this->db->select('MAX(CDOCUMENTOREGULAARCHIVO) as id')
			->from('PDOCUMENTOREGULATORIOARCHIVOS')
			->get();
		if (!$query) {
			return 1;
		}
		return intval($query->row()->id) + 1;
	}

	/**
	 * @param string $CASUNTOREGULATORIO
	 * @param string $CENTIDADREGULA
	 * @param string $CTRAMITE
	 * @param string $CDOCUMENTO
	 * @return array|array[]|object|object[]
	 */
	public function buscarDocumentos(string $CASUNTOREGULATORIO, string $CENTIDADREGULA, string $CTRAMITE, string $CDOCUMENTO)
	{
		$this->db->select('*');
		$this->db->from('PDOCUMENTOREGULATORIOARCHIVOS');
		$this->db->where('CASUNTOREGULATORIO', $CASUNTOREGULATORIO);
		$this->db->where('CENTIDADREGULA', $CENTIDADREGULA);
		$this->db->where('CTRAMITE', $CTRAMITE);
		$this->db->where('CDOCUMENTO', $CDOCUMENTO);
		$query = $this->db->get();
		if (!$query) {
			return [];
		}
		return ($query->num_rows()) ? $query->result() : [];
	}

	/**
	 * @param $codigo
	 * @param $CASUNTOREGULATORIO
	 * @param $CENTIDADREGULA
	 * @param $CTRAMITE
	 * @param $CDOCUMENTO
	 * @param $DUBICACIONFILESERVER
	 * @param $USUARIO
	 * @param $SREGISTRO
	 * @throws Exception
	 */
	public function guardar($codigo, $CASUNTOREGULATORIO, $CENTIDADREGULA, $CTRAMITE, $CDOCUMENTO, $DUBICACIONFILESERVER, $USUARIO, $SREGISTRO)
	{
		if (empty($CASUNTOREGULATORIO)) {
			throw new Exception('El documento del archivo AR no puede estar vacío.');
		}
		if (empty($CENTIDADREGULA)) {
			throw new Exception('El documento del archivo Entidad no puede estar vacío.');
		}
		if (empty($CTRAMITE)) {
			throw new Exception('El documento del archivo Tramite no puede estar vacío.');
		}
		if (empty($CDOCUMENTO)) {
			throw new Exception('El documento del archivo no puede estar vacío.');
		}
		$SCARGADOCUMENTO = 'E';
		if (!empty($DUBICACIONFILESERVER)) {
			$SCARGADOCUMENTO = 'R';
		}
		if ($SREGISTRO != 'A' && $SREGISTRO != 'I') {
			throw new Exception('El estado del documento no es valido.');
		}

		$data = [
			'CDOCUMENTOREGULAARCHIVO' => $codigo,
			'CASUNTOREGULATORIO' => $CASUNTOREGULATORIO,
			'CENTIDADREGULA' => $CENTIDADREGULA,
			'CTRAMITE' => $CTRAMITE,
			'CDOCUMENTO' => $CDOCUMENTO,
			'DUBICACIONFILESERVER' => $DUBICACIONFILESERVER,
			'SCARGADOCUMENTO' => $SCARGADOCUMENTO,
			'CUSUARIOCREA' => $USUARIO,
			'CUSUARIOMODIFICA' => $USUARIO,
			'SREGISTRO' => $SREGISTRO,
		];

		$res = (empty($codigo))
			? $this->crear($data)
			: $this->actualizar($codigo, $data);
		if (!$res) {
			throw new Exception('Error al intentar guardar el archivo del documento.');
		}
		return $data;
	}

	/**
	 * Crea un nuevo registro
	 * @param array $datos
	 * @return bool
	 * @throws Exception
	 */
	public function crear(array &$datos): bool
	{
		$datos['CDOCUMENTOREGULAARCHIVO'] = $this->obtenerNuevoID();
		$datos['CUSUARIOMODIFICA'] = null;
		$datos['TMODIFICACION'] = null;
		$datos['TCREACION'] = date('Y-m-d H:i:s');
		$res = $this->db->insert('PDOCUMENTOREGULATORIOARCHIVOS', $datos);
		if (!$res) {
			throw new Exception('El Documento no pudo ser creado correctamente.');
		}
		return $res;
	}

	/**
	 * Edita el registro
	 * @param string $codigo
	 * @param array $datos
	 * @return bool
	 * @throws Exception
	 */
	public function actualizar(string $codigo, array &$datos): bool
	{
		if (empty($codigo)) {
			throw new Exception('El Documento no es valido para actualizar.');
		}
		$datos['TMODIFICACION'] = date('Y-m-d H:i:s');
		unset(
			$datos['TCREACION'],
			$datos['CUSUARIOCREA'],
			$datos['CASUNTOREGULATORIO'],
			$datos['CENTIDADREGULA'],
			$datos['CTRAMITE'],
			$datos['CDOCUMENTO']
		);
		$res = $this->db->update('PDOCUMENTOREGULATORIOARCHIVOS', $datos, [
			'CDOCUMENTOREGULAARCHIVO' => $codigo,
		]);
		if (!$res) {
			throw new Exception('El Documento no pudo ser actualizado correctamente.');
		}
		return $res;
	}

}
