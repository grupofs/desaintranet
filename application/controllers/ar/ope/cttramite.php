<?php

/**
 * Class centidadreguladora
 *
 * @property mttramite mttramite
 */
class cttramite extends FS_Controller
{


	/**
	 * centidadreguladora constructor.
	 */
	public function __construct()
	{
		parent::__construct();
		$this->load->model('ar/ope/mttramite', 'mttramite');
	}

	/**
	 * Auto completado de los tipos de productos
	 */
	public function autocompletado_tipo_producto(): void
	{
		if (!$this->input->is_ajax_request()) {
			show_404();
		}
		$search = $this->input->post('busqueda');
		$params = $this->input->post('params');
		$search = (is_null($search)) ? '' : $search;
		$entidad = (isset($params['entidad']) && !empty($params['entidad'])) ? $params['entidad'] : '';
		$result = $this->mttramite->autoCompletadoTipoProducto($search, $entidad);
		echo json_encode(['items' => $result]);
	}

}
