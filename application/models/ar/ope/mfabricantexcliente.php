<?php

/**
 * Class mfabricantexcliente
 */
class mfabricantexcliente extends CI_Model
{

	/**
	 * mfabricantexcliente constructor.
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
	private function obtenerNuevoID($ccliente): string
	{
		$query = $this->db->select('MAX(cfabricante) as id')
			->from('mfabricantexcliente')
			->where('ccliente', $ccliente)
			->get();
		if (!$query) {
			throw new Exception('Error al encontrar el Código de fabricante');
		}
		$newId = intval($query->row()->id) + 1;
		return str_pad($newId, 4, '0', STR_PAD_LEFT);
	}

	/**
	 * @param string $id
	 * @param string $idCliente
	 * @param string $nombre
	 * @param string $estado
	 * @return array
	 * @throws Exception
	 */
	public function guardar(string $id, string $idCliente, string $nombre, string $estado): array
	{
		if (empty($nombre)) {
			throw new Exception('Debe ingresar el nombre del fabricante.');
		}
		if ($estado != 'A' && $estado != 'I') {
			throw new Exception('Debe elegir un estado para su fabricante.');
		}

		$data = [
			'CCLIENTE' => $idCliente,
			'CFABRICANTE' => $id,
			'DFABRICANTE' => $nombre,
			'CUSUARIOCREA' => '',
			'TCREACION' => date('Y-m-d H:i:s'),
			'CUSUARIOMODIFICA' => null,
			'TMODIFICACION' => null,
			'SREGISTRO' => $estado,
		];
		$res = (empty($id)) ? $this->crear($data) : $this->actualizar($id, $data);
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
		$datos['CFABRICANTE'] = $this->obtenerNuevoID($datos['CCLIENTE']);
		$datos['CUSUARIOMODIFICA'] = null;
		$datos['TMODIFICACION'] = null;
		$res = $this->db->insert('mfabricantexcliente', $datos);
		if (!$res) {
			throw new Exception('La Marca no pudo ser creado correctamente.');
		}
		return $res;
	}

	/**
	 * Edita un registro
	 * @param string $id
	 * @param array $datos
	 * @return bool
	 * @throws Exception
	 */
	public function actualizar(string $id, array &$datos): bool
	{
		if (empty($id)) {
			throw new Exception('La Marca no es valido para actualizar.');
		}
		$datos['TMODIFICACION'] = date('Y-m-d H:i:s');
		$res = $this->db->update('mfabricantexcliente', $datos, ['CFABRICANTE' => $id]);
		if (!$res) {
			throw new Exception('La Marca no pudo ser actualizado correctamente.');
		}
		return $res;
	}

	/**
	 * @param string $search
	 * @param string $ccliente
	 * @return array
	 */
	public function autoCompletado(string $search, string $ccliente): array
	{
		$this->db->select('
			cfabricante as id,
			dfabricante as text,
			*
		');
		$this->db->from('mfabricantexcliente');
		$this->db->where('ccliente', $ccliente);
		$this->db->where('sregistro', 'A');
		$this->db->like('dfabricante', $search);
		$this->db->order_by('dfabricante', 'ASC');
		$this->db->limitAnyWhere(LIMITE_AUTOCOMPLETADO);
		$query = $this->db->get();
		if (!$query) {
			return [];
		}
		return ($query->num_rows() > 0) ? $query->result() : [];
	}

}
