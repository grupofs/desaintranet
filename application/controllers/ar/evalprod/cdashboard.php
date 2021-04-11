<?php

/**
 * Class cdashboard
 *
 * @property mdashboard mdashboard
 */
class cdashboard extends FS_Controller
{

	/**
	 * ccons_insp constructor.
	 */
	public function __construct()
	{
		parent::__construct();
		$this->load->model('ar/evalprod/mdashboard', 'mdashboard');
	}

	/**
	 * Reporte
	 */
	public function get_tendencia_anual_rendi()
	{
		if (!$this->input->is_ajax_request()) {
			show_404();
		}
		$ccliente = $this->session->userdata('s_ccliente');
		$anio = $this->input->post('anio');
		$mes = $this->input->post('mes');
		$parametros = array(
			'@ccliente' => $ccliente,
			'@anio' => $anio,
		);
		$resultado = $this->mdashboard->getTendenciaAnualRendi($parametros);
		$items = [];
		if (!empty($resultado)) {
			foreach ($resultado as $key => $value) {
				if (!empty($mes)) {
					if (intval($value->mes) != intval($mes)) {
						continue;
					}
				}
				$items[] = $value;
			}
		}
		$this->result['status'] = 200;
		$this->result['data'] = $items;
		responseResult($this->result);
	}

	/**
	 * Reporte
	 */
	public function get_dist_producto_linea()
	{
		if (!$this->input->is_ajax_request()) {
			show_404();
		}
		$ccliente = $this->session->userdata('s_ccliente');
		$anio = $this->input->post('anio');
		$mes = $this->input->post('mes');
		$parametros = array(
			'@ccliente' => $ccliente,
			'@anio' => $anio,
			'@mes' =>  $mes,
		);
		$items = $this->mdashboard->getDistProductoLinea($parametros);
		$this->result['status'] = 200;
		$this->result['data'] = $items;
		responseResult($this->result);
	}

	/**
	 * Reporte
	 */
	public function get_unicapro_prodlinea()
	{
		if (!$this->input->is_ajax_request()) {
			show_404();
		}
		$ccliente = $this->session->userdata('s_ccliente');
		$anio = $this->input->post('anio');
		$mes = $this->input->post('mes');
		$parametros = array(
			'@ccliente' => $ccliente,
			'@anio' => $anio,
			'@mes' =>  $mes,
		);
		$items = $this->mdashboard->getUnicaproProdLinea($parametros);
		$grafico = $this->mdashboard->getGrafCaproProdLinea($parametros);
		$this->result['status'] = 200;
		$this->result['data'] = [
			'items' => $items,
			'grafico' => $grafico,
		];
		responseResult($this->result);
	}

}
