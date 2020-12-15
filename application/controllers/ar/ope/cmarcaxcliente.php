<?php

/**
 * Class centidadreguladora
 *
 * @property mmarcaxcliente mmarcaxcliente
 */
class cmarcaxcliente extends FS_Controller
{

	/**
	 * centidadreguladora constructor.
	 */
	public function __construct()
	{
		parent::__construct();
		$this->load->model('ar/ope/mmarcaxcliente', 'mmarcaxcliente');
	}

	/**
	 * Crea o Actualiza una marca
	 */
	public function guardar(): void
	{
		if (!$this->input->is_ajax_request()) {
			show_404();
		}
		try {
			$marca_id = (string) $this->input->post('marca_id');
			$cliente_id = (string) $this->input->post('codigo_cliente_id');
			$marca_nombre = (string) $this->input->post('marca_nombre');
			$marca_estado = (string) $this->input->post('marca_estado');
			if (empty($marca_nombre)) {
				throw new Exception('Debe ingresar el nombre de la marca.');
			}

			$marca = $this->mmarcaxcliente->guardar($marca_id, $cliente_id, $marca_nombre, $marca_estado);

			$this->result['status'] = 200;
			$this->result['message'] = "Marca creada correctamente.";
			$this->result['data'] = $marca;
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
		$result = $this->mmarcaxcliente->autoCompletado($search, $ccliente);
		echo json_encode(['items' => $result]);
	}

}
