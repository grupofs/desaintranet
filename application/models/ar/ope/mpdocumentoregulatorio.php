<?php


class mpdocumentoregulatorio extends CI_Model
{

	/**
	 * mpdocumentoregulatorio constructor.
	 */
	public function __construct()
	{
		parent::__construct();
	}

	/**
	 * @param string $CASUNTOREGULATORIO
	 * @param string $CENTIDADREGULA
	 * @param string $CTRAMITE
	 * @param $CDOCUMENTO
	 * @return array|int
	 */
	public function buscar(string $CASUNTOREGULATORIO,
						   string $CENTIDADREGULA,
						   string $CTRAMITE,
						   $CDOCUMENTO = '')
	{
		$this->db->select('
			PDOCUMENTOREGULATORIO.*,
			MDOCUMENTOTRAMITEREGULA.DDOCUMENTO
		');
		$this->db->from('PDOCUMENTOREGULATORIO');
		$this->db->join('MDOCUMENTOTRAMITEREGULA', 'PDOCUMENTOREGULATORIO.CENTIDADREGULA = MDOCUMENTOTRAMITEREGULA.CENTIDADREGULA AND PDOCUMENTOREGULATORIO.CTRAMITE = MDOCUMENTOTRAMITEREGULA.CTRAMITE AND PDOCUMENTOREGULATORIO.CDOCUMENTO = MDOCUMENTOTRAMITEREGULA.CDOCUMENTO', 'inner');
		$this->db->where('PDOCUMENTOREGULATORIO.CASUNTOREGULATORIO', $CASUNTOREGULATORIO);
		$this->db->where('PDOCUMENTOREGULATORIO.CENTIDADREGULA', $CENTIDADREGULA);
		$this->db->where('PDOCUMENTOREGULATORIO.CTRAMITE', $CTRAMITE);
		if (!empty($CDOCUMENTO)) {
			$this->db->where('PDOCUMENTOREGULATORIO.CDOCUMENTO', $CDOCUMENTO);
		}
		$this->db->order_by('PDOCUMENTOREGULATORIO.CDOCUMENTO', 'ASC');
		$query = $this->db->get();
		if (!$query) {
			return [];
		}
		return ($query->num_rows()) ? $query->result() : [];
	}

	/**
	 * @param $CASUNTOREGULATORIO
	 * @param $CENTIDADREGULA
	 * @param $CTRAMITE
	 * @param $CDOCUMENTO
	 * @param $documentoTipo
	 * @param $DNUEVODOCUMENTO
	 * @param $DUBICACIONFILESERVER
	 * @param $CUSUARIOCREA
	 * @param $CUSUARIOMODIFICA
	 * @param $SREGISTRO
	 * @return array
	 * @throws Exception
	 */
	public function guardar(string $CASUNTOREGULATORIO,
							string $CENTIDADREGULA,
							string $CTRAMITE,
							string $CDOCUMENTO,
							int $documentoTipo,
							string $DNUEVODOCUMENTO,
							string $DUBICACIONFILESERVER,
							string $CUSUARIO,
							string $SREGISTRO)
	{
		if (empty($CASUNTOREGULATORIO)) {
			throw new Exception('El código de AR no puede estar vacío.');
		}
		if (empty($CENTIDADREGULA)) {
			throw new Exception('El código de la entidad no puede estar vacío.');
		}
		if (empty($CTRAMITE)) {
			throw new Exception('El código del tramite no puede estar vacío.');
		}
		if (empty($CDOCUMENTO)) {
			throw new Exception('El código del documento no puede estar vacío.');
		}
		$SCARGADOCUMENTO = 'E';
		if (!empty($DUBICACIONFILESERVER)) {
			$SCARGADOCUMENTO = 'R';
		}

		if ($SREGISTRO != 'A' && $SREGISTRO != 'I') {
			throw new Exception('El estado del documento no es valido.');
		}

		$data = [
			'CASUNTOREGULATORIO' => $CASUNTOREGULATORIO,
			'CENTIDADREGULA' => $CENTIDADREGULA,
			'CTRAMITE' => $CTRAMITE,
			'CDOCUMENTO' => $CDOCUMENTO,
			'TIPO' => $documentoTipo,
			'DNUEVODOCUMENTO' => $DNUEVODOCUMENTO,
			'DUBICACIONFILESERVER' => $DUBICACIONFILESERVER,
			'SCARGADOCUMENTO' => $SCARGADOCUMENTO,
			'CUSUARIOCREA' => $CUSUARIO,
			'CUSUARIOMODIFICA' => $CUSUARIO,
			'SREGISTRO' => $SREGISTRO,
		];

		$objDocument = $this->buscar(
			$CASUNTOREGULATORIO,
			$CENTIDADREGULA,
			$CTRAMITE,
			$CDOCUMENTO);

		$res = (empty($objDocument))
			? $this->crear($data)
			: $this->actualizar(
				$CASUNTOREGULATORIO,
				$CENTIDADREGULA,
				$CTRAMITE,
				$CDOCUMENTO,
				$data
			);
		if (!$res) {
			throw new Exception('Error al intentar guardar la marca.');
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
		$datos['CUSUARIOMODIFICA'] = null;
		$datos['TMODIFICACION'] = null;
		$datos['TCREACION'] = date('Y-m-d');
		$res = $this->db->insert('PDOCUMENTOREGULATORIO', $datos);
		if (!$res) {
			throw new Exception('El Documento no pudo ser creado correctamente.');
		}
		return $res;
	}

	/**
	 * Edita el registro
	 * @param string $CASUNTOREGULATORIO
	 * @param string $CENTIDADREGULA
	 * @param string $CTRAMITE
	 * @param string $CDOCUMENTO
	 * @param array $datos
	 * @return bool
	 * @throws Exception
	 */
	public function actualizar(string $CASUNTOREGULATORIO, string $CENTIDADREGULA, string $CTRAMITE, string $CDOCUMENTO, array &$datos): bool
	{
		if (empty($CASUNTOREGULATORIO) || empty($CENTIDADREGULA) || empty($CTRAMITE) || empty($CDOCUMENTO)) {
			throw new Exception('El Documento no es valido para actualizar.');
		}
		$datos['TMODIFICACION'] = date('Y-m-d H:i:s');
		if(isset($datos['TCREACION'])) unset($datos['TCREACION']);
		if(isset($datos['CUSUARIOCREA'])) unset($datos['CUSUARIOCREA']);
		$res = $this->db->update('PDOCUMENTOREGULATORIO', $datos, [
			'CASUNTOREGULATORIO' => $CASUNTOREGULATORIO,
			'CENTIDADREGULA' => $CENTIDADREGULA,
			'CTRAMITE' => $CTRAMITE,
			'CDOCUMENTO' => $CDOCUMENTO,
		]);
		if (!$res) {
			throw new Exception('El Documento no pudo ser actualizado correctamente.');
		}
		return $res;
	}

	/**
	 * @param string $CASUNTOREGULATORIO
	 * @param string $CENTIDADREGULA
	 * @param string $CTRAMITE
	 * @param string $CDOCUMENTO
	 * @throws Exception
	 */
	public function eliminar(string $CASUNTOREGULATORIO, string $CENTIDADREGULA, string $CTRAMITE, string $CDOCUMENTO)
	{
		if (empty($CASUNTOREGULATORIO) || empty($CENTIDADREGULA) || empty($CTRAMITE) || empty($CDOCUMENTO)) {
			throw new Exception('El Documento no es valido para eliminar.');
		}
		$res = $this->db->delete('PDOCUMENTOREGULATORIO', [
			'CASUNTOREGULATORIO' => $CASUNTOREGULATORIO,
			'CENTIDADREGULA' => $CENTIDADREGULA,
			'CTRAMITE' => $CTRAMITE,
			'CDOCUMENTO' => $CDOCUMENTO,
		]);
		if (!$res) {
			throw new Exception('El Documento no pudo ser eliminado correctamente.');
		}
		return $res;
	}

}
