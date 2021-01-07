<?php

/**
 * Class centidadreguladora
 *
 * @property mcategoriaxcliente mcategoriaxcliente
 */
class ccategoriaxcliente extends FS_Controller
{

	/**
	 * centidadreguladora constructor.
	 */
	public function __construct()
	{
		parent::__construct();
		$this->load->model('ar/ope/mcategoriaxcliente', 'mcategoriaxcliente');
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
		$result = $this->mcategoriaxcliente->autoCompletado($search, $ccliente);
		echo json_encode(['items' => $result]);
	}

}
