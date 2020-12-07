<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Class centidadregulatoria
 *
 * @property mentidadregulatoria mentidadregulatoria
 */
class centidadregulatoria extends FS_Controller
{
	/**
	 * ccliente constructor.
	 */
	public function __construct()
	{
		parent::__construct();
		$this->load->model('ar/ope/mentidadregulatoria', 'mentidadregulatoria');
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
		$result = $this->mentidadregulatoria->autoCompletado($search);
		echo json_encode(['items' => $result]);
	}
}
