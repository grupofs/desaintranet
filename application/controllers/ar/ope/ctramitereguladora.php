<?php

/**
 * Class centidadreguladora
 *
 * @property mtramitereguladora mtramitereguladora
 */
class ctramitereguladora extends FS_Controller
{


	/**
	 * centidadreguladora constructor.
	 */
	public function __construct()
	{
		parent::__construct();
		$this->load->model('ar/ope/mtramitereguladora', 'mtramitereguladora');
	}

	/**
	 * Busqueda del producto
	 */
	public function autocompletado()
	{
		if (!$this->input->is_ajax_request()) {
			show_404();
		}
		$search = $this->input->post('busqueda');
		$params = $this->input->post('params');
		$search = (is_null($search)) ? '' : $search;
		$entidad = (isset($params['entidad']) && !empty($params['entidad'])) ? $params['entidad'] : '';
		$tipoProducto = (isset($params['tipo_producto']) && !empty($params['tipo_producto'])) ? $params['tipo_producto'] : '';
		$result = $this->mtramitereguladora->autoCompletado($search, $entidad, $tipoProducto);
		echo json_encode(['items' => $result]);
	}

}
