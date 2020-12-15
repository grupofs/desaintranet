<?php

/**
 * Class centidadreguladora
 *
 * @property mttabla mttabla
 */
class cttabla extends FS_Controller
{

	/**
	 * centidadreguladora constructor.
	 */
	public function __construct()
	{
		parent::__construct();
		$this->load->model('ar/ope/mttabla', 'mttabla');
	}

	/**
	 * Auto completado
	 */
	public function autocompletado_pais(): void
	{
		if (!$this->input->is_ajax_request()) {
			show_404();
		}
		$search = $this->input->post('busqueda');
		$search = (is_null($search)) ? '' : $search;
		$result = $this->mttabla->autoCompletadoPais($search);
		echo json_encode(['items' => $result]);
	}

}
