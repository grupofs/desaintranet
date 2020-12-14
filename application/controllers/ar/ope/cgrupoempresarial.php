<?php

/**
 * Class cgrupoempresarial
 *
 * @property mgrupoempresarial mgrupoempresarial
 */
class cgrupoempresarial extends FS_Controller
{


	/**
	 * centidadreguladora constructor.
	 */
	public function __construct()
	{
		parent::__construct();
		$this->load->model('ar/ope/mgrupoempresarial', 'mgrupoempresarial');
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
		$result = $this->mgrupoempresarial->autoCompletado($search);
		echo json_encode(['items' => $result]);
	}

}
