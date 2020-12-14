<?php

/**
 * Class centidadreguladora
 *
 * @property mfabricantexcliente mfabricantexcliente
 */
class cfabricantexcliente extends FS_Controller
{

	/**
	 * centidadreguladora constructor.
	 */
	public function __construct()
	{
		parent::__construct();
		$this->load->model('ar/ope/mfabricantexcliente', 'mfabricantexcliente');
	}

	/**
	 * Crea o Actualiza un fabricante
	 */
	public function guardar(): void
	{
		if (!$this->input->is_ajax_request()) {
			show_404();
		}
		try {
			$id = (string) $this->input->post('fabricante_id');
			$cliente_id = (string) $this->input->post('codigo_cliente_id');
			$nombre = (string) $this->input->post('fabricante_nombre');
			$estado = (string) $this->input->post('fabricante_estado');
			if (empty($nombre)) {
				throw new Exception('Debe ingresar el nombre del fabricante.');
			}

			$fabricante = $this->mfabricantexcliente->guardar($id, $cliente_id, $nombre, $estado);

			$this->result['status'] = 200;
			$this->result['message'] = "Fabricante creada correctamente.";
			$this->result['data'] = $fabricante;
		} catch (Exception $ex) {
			$this->result['message'] = $ex->getMessage();
		}
		responseResult($this->result);
	}

	/**
	 * Auto completado de los tipos de productos
	 */
	public function autocompletado(): void
	{
		if (!$this->input->is_ajax_request()) {
			show_404();
		}
		$search = $this->input->post('busqueda');
		$params = $this->input->post('params');
		$search = (is_null($search)) ? '' : $search;
		$ccliente = (isset($params['ccliente']) && !empty($params['ccliente'])) ? $params['ccliente'] : '';
		$result = $this->mfabricantexcliente->autoCompletado($search, $ccliente);
		echo json_encode(['items' => $result]);
	}

}
