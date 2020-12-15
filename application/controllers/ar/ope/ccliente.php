<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Class ccliente
 *
 * @property mcliente mcliente
 */
class ccliente extends FS_Controller
{
	/**
	 * ccliente constructor.
	 */
	public function __construct()
	{
		parent::__construct();
		$this->load->model('ar/ope/mcliente', 'mcliente');
	}

	/**
	 * Busqueda
	 */
	public function autocompletado()
	{
		if (!$this->input->is_ajax_request()) {
			show_404();
		}
		$search = $this->input->post('busqueda');
		$search = (is_null($search)) ? '' : $search;
		$params = $this->input->post('params');
		$grupo_empresarial = (isset($params['grupo_empresarial']) && !empty($params['grupo_empresarial'])) ? $params['grupo_empresarial'] : '';
		$result = $this->mcliente->autoCompletado($search, $grupo_empresarial);
		echo json_encode(['items' => $result]);
	}
}
