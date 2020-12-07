<?php

/**
 * Class cdocumentoregulatorio
 *
 * @property mdocumentoregulatorio mdocumentoregulatorio
 */
class cdocumentoregulatorio extends FS_Controller
{

	/**
	 * cdocumentoregulatorio constructor.
	 */
	public function __construct()
	{
		parent::__construct();
		$this->load->model('ar/ope/mdocumentoregulatorio', 'mdocumentoregulatorio');
	}

	/**
	 * Obtiene los documentos apartir de la entidad y el tramite
	 */
	public function obtener_documentos()
	{
		if (!$this->input->is_ajax_request()) {
			show_404();
		}
		$centidadregula = $this->input->post('entidad_regula_id');
		$ctramite = $this->input->post('tramite_id');
		$items = $this->mdocumentoregulatorio->obtenerDocumentos($centidadregula, $ctramite);
		echo json_encode(['items' => $items]);
	}

}
