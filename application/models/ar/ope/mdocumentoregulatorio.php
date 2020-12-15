<?php

/**
 * Class mdocumentoregulatorio
 */
class mdocumentoregulatorio extends CI_Model
{

	/**
	 * mdocumentoregulatorio constructor.
	 */
	public function __construct()
	{
		parent::__construct();
	}

	/**
	 * Se obtien un nuevo ID
	 * @return string
	 * @throws Exception
	 */
	private function obtenerNuevoID($CENTIDADREGULA, $CTRAMITE): string
	{
		$query = $this->db->select('MAX(CDOCUMENTO) as id')
			->from('MDOCUMENTOTRAMITEREGULA')
			->where('CENTIDADREGULA', $CENTIDADREGULA)
			->where('CTRAMITE', $CTRAMITE)
			->get();
		if (!$query) {
			throw new Exception('Error al encontrar el Código de producto');
		}
		$newId = intval($query->row()->id) + 1;
		return str_pad($newId, 3, '0', STR_PAD_LEFT);
	}

	/**
	 * @param $CENTIDADREGULA
	 * @param $CTRAMITE
	 * @param $CDOCUMENTO
	 * @return array|mixed|object|null
	 */
	public function buscar($CENTIDADREGULA, $CTRAMITE, $CDOCUMENTO)
	{
		$this->db->select('*');
		$this->db->from('MDOCUMENTOTRAMITEREGULA');
		$this->db->where('CENTIDADREGULA', $CENTIDADREGULA);
		$this->db->where('CTRAMITE', $CTRAMITE);
		$this->db->where('CDOCUMENTO', $CDOCUMENTO);
		$this->db->where('SREGISTRO', 'A');
		$query = $this->db->get();
		if (!$query) {
			return null;
		}
		return ($query->num_rows() > 0) ? $query->row() : [];
	}

	/**
	 * @param $CENTIDADREGULA
	 * @param $CTRAMITE
	 * @return array|array[]|object|object[]
	 */
	public function obtenerDocumentos($CENTIDADREGULA, $CTRAMITE)
	{
		$this->db->select('
			CDOCUMENTO AS id,
			DDOCUMENTO AS text,
			*
		');
		$this->db->from('MDOCUMENTOTRAMITEREGULA');
		$this->db->where('CENTIDADREGULA', $CENTIDADREGULA);
		$this->db->where('CTRAMITE', $CTRAMITE);
		$this->db->where('SREGISTRO', 'A');
		$query = $this->db->get();
		if (!$query) {
			return [];
		}
		return ($query->num_rows() > 0) ? $query->result() : [];
	}

	/**
	 * @param $CDOCUMENTO
	 * @param $CENTIDADREGULA
	 * @param $CTRAMITE
	 * @param $DDOCUMENTO
	 * @param $CUSUARIO
	 * @param $SREGISTRO
	 * @return object
	 * @throws Exception
	 */
	public function guardar($CDOCUMENTO, $CENTIDADREGULA, $CTRAMITE, $DDOCUMENTO, $CUSUARIO, $SREGISTRO)
	{
		if (empty($CENTIDADREGULA)) {
			throw new Exception('Falta de entidad para registrar el documento.');
		}
		if (empty($CTRAMITE)) {
			throw new Exception('Falta de tramite para registrar el documento.');
		}
		if (empty($DDOCUMENTO)) {
			throw new Exception('Debes ingresar el nombre del documento.');
		}
		$data = [
			'CDOCUMENTO' => $CDOCUMENTO,
			'CENTIDADREGULA' => $CENTIDADREGULA,
			'CTRAMITE' => $CTRAMITE,
			'DDOCUMENTO' => $DDOCUMENTO,
			'CUSUARIOCREA' => $CUSUARIO,
			'CUSUARIOMODIFICA' => $CUSUARIO,
			'SREGISTRO' => $SREGISTRO,
		];
		(empty($CDOCUMENTO)) ? $this->crear($data) : $this->actualizar($CDOCUMENTO, $CENTIDADREGULA, $CTRAMITE, $data);
		return (Object) $data;
	}

	/**
	 * Crea un nuevo registro
	 * @param array $datos
	 * @return bool
	 * @throws Exception
	 */
	public function crear(array &$datos): bool
	{
		$datos['CDOCUMENTO'] = $this->obtenerNuevoID($datos['CENTIDADREGULA'], $datos['CTRAMITE']);
		$datos['CUSUARIOMODIFICA'] = null;
		$datos['TMODIFICACION'] = null;
		$datos['TCREACION'] = date('Y-m-d');
		$res = $this->db->insert('MDOCUMENTOTRAMITEREGULA', $datos);
		if (!$res) {
			throw new Exception('El Documento no pudo ser creado correctamente.');
		}
		return $res;
	}

	/**
	 * Edita el registro
	 * @param string $CENTIDADREGULA
	 * @param string $CTRAMITE
	 * @param string $CDOCUMENTO
	 * @param array $datos
	 * @return bool
	 * @throws Exception
	 */
	public function actualizar(string $CENTIDADREGULA, string $CTRAMITE, string $CDOCUMENTO, array &$datos): bool
	{
		if (empty($CENTIDADREGULA) || empty($CTRAMITE) || empty($CDOCUMENTO)) {
			throw new Exception('El Documento no es valido para actualizar.');
		}
		$datos['TMODIFICACION'] = date('Y-m-d H:i:s');
		unset($datos['TCREACION']);
		unset($datos['CUSUARIOCREA']);
		$res = $this->db->update('MDOCUMENTOTRAMITEREGULA', $datos, [
			'CENTIDADREGULA' => $CENTIDADREGULA,
			'CTRAMITE' => $CTRAMITE,
			'CDOCUMENTO' => $CDOCUMENTO,
		]);
		if (!$res) {
			throw new Exception('El Documento no pudo ser actualizado correctamente.');
		}
		return $res;
	}

}
