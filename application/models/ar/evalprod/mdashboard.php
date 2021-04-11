<?php


class mdashboard extends CI_Model
{
	function __construct()
	{
		parent::__construct();
	}

	/**
	 * @param $parametros
	 * @return array
	 */
	public function getTendenciaAnualRendi($parametros)
	{
		$query = $this->db->query('call sp_report_ar_evalprod_tendenciaanualrendimiento(?,?)', $parametros);
		if (!$query) {
			return [];
		}
		return ($query->num_rows() > 0) ? $query->result() : [];
	}

	/**
	 * @param $parametros
	 * @return array
	 */
	public function getDistProductoLinea($parametros)
	{
		$query = $this->db->query('call sp_report_ar_evalprod_distproductolinea(?,?,?)', $parametros);
		if (!$query) {
			return [];
		}
		return ($query->num_rows() > 0) ? $query->result() : [];
	}

	/**
	 * @param $parametros
	 * @return array
	 */
	public function getUnicaproProdLinea($parametros)
	{
		$query = $this->db->query('call sp_report_ar_evalprod_porcaproprodlinea(?,?,?)', $parametros);
		if (!$query) {
			return [];
		}
		return ($query->num_rows() > 0) ? $query->result() : [];
	}

	/**
	 * @param $parametros
	 * @return array
	 */
	public function getGrafCaproProdLinea($parametros)
	{
		$query = $this->db->query('call sp_report_ar_evalprod_grafaproprodlinea(?,?,?)', $parametros);
		if (!$query) {
			return [];
		}
		return ($query->num_rows() > 0) ? $query->result() : [];
	}

}
