<?php


class mcons_insp extends CI_Model
{

	/**
	 * mcons_insp constructor.
	 */
	public function __construct()
	{
		parent::__construct();
	}

	/**
	 * Busqueda de todos las inspecciones
	 * @return array
	 */
	public function buscarInspecciones(array $data): array
	{
		$query = $this->db->query('CALL sp_consulta_inspeccionprov_fs(?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)', $data);
		if (!$query) {
			return [];
		}
		return ($query->num_rows() > 0) ? $query->result() : [];
	}

	/**
	 * Busca una inspección con su ID
	 * @param $CAUDITORIAINSPECCION, $CINTERNOPTE
	 * @return array|bool|mixed|object|null
	 */
	public function buscarInspccion($CAUDITORIAINSPECCION, $CINTERNOPTE)
	{
		$this->db->select('*');
		$this->db->from('PDAUDITORIAINSPECCION');
		$this->db->where('CAUDITORIAINSPECCION', $CAUDITORIAINSPECCION);
		$this->db->where('FSERVICIO', $CINTERNOPTE);
		$query = $this->db->get();
		if (!$query) {
			return null;
		}
		return ($query->num_rows() > 0) ? $query->row() : null;
	}

	/**
	 * Busca una inspección con su ID
	 * @param $CAUDITORIAINSPECCION
	 * @return array|bool|mixed|object|null
	 */
	public function buscarInspccionCab($CAUDITORIAINSPECCION)
	{
		$this->db->select('*');
		$this->db->from('PCAUDITORIAINSPECCION');
		$this->db->where('CAUDITORIAINSPECCION', $CAUDITORIAINSPECCION);
		$query = $this->db->get();
		if (!$query) {
			return null;
		}
		return ($query->num_rows() > 0) ? $query->row() : null;
	}

	/**
	 * @param array $data
	 */
	public function pdfCaratula(array $data)
	{
		$query = $this->db->query("CALL sp_consulta_ctrlprov_pdf_caratula(?, ?)", $data);
		if (!$query) {
			return null;
		}
		return ($query->num_rows() > 0) ? $query->row() : null;
	}

	/**
	 * @param array $data
	 */
	public function pdfParrafo1Parte1(array $data): string
	{
		$query = $this->db->query("CALL sp_consulta_ctrlprov_pdf_parrafo1_pt1(?, ?)", $data);
		if (!$query) {
			return '';
		}
		return ($query->num_rows() > 0) ? $query->row()->parrafo : '';
	}

	/**
	 * @param array $data
	 */
	public function pdfParrafo1Parte2(array $data): string
	{
		$query = $this->db->query("CALL sp_consulta_ctrlprov_pdf_parrafo1_pt2(?, ?)", $data);
		if (!$query) {
			return '';
		}
		return ($query->num_rows() > 0) ? $query->row()->parrafo : '';
	}

	/**
	 * @param array $data
	 */
	public function pdfCuadro1(array $data)
	{
		$query = $this->db->query("CALL sp_consulta_ctrlprov_pdf_cuadro1(?, ?)", $data);
		if (!$query) {
			return null;
		}
		return ($query->num_rows() > 0) ? $query->row() : null;
	}

	/**
	 * @param array $data
	 */
	public function pdfParrafo2(array $data): string
	{
		$query = $this->db->query("CALL sp_consulta_ctrlprov_pdf_parrafo2(?, ?)", $data);
		if (!$query) {
			return '';
		}
		return ($query->num_rows() > 0) ? $query->row()->parrafo : '';
	}

	/**
	 * @param array $data
	 */
	public function pdfGrafico1(array $data)
	{
		$query = $this->db->query("CALL sp_graf_01(?, ?)", $data);
		if (!$query) {
			return null;
		}
		return ($query->num_rows() > 0) ? $query->row() : null;
	}

	/**
	 * @param array $data
	 */
	public function pdfCuadro2(array $data): array
	{
		$query = $this->db->query("CALL sp_consulta_ctrlprov_pdf_cuadro2(?, ?)", $data);
		if (!$query) {
			return [];
		}
		return ($query->num_rows() > 0) ? $query->result() : [];
	}

	/**
	 * @param array $data
	 */
	public function pdfGrafico2(array $data): array
	{
		$query = $this->db->query("CALL sp_consulta_ctrlprov_pdf_grafico2(?, ?)", $data);
		if (!$query) {
			return [];
		}
		return ($query->num_rows() > 0) ? $query->result() : [];
	}

	/**
	 * @param array $data
	 */
	public function pdfCuadro3(array $data)
	{
		$query = $this->db->query("CALL sp_consulta_ctrlprov_pdf_cuadro3(?, ?)", $data);
		if (!$query) {
			return null;
		}
		return ($query->num_rows() > 0) ? $query->row() : null;
	}

	/**
	 * @param array $data
	 */
	public function pdfCuadro4(array $data)
	{
		$query = $this->db->query("CALL sp_consulta_ctrlprov_pdf_cuadro4(?, ?)", $data);
		if (!$query) {
			return [];
		}
		return ($query->num_rows() > 0) ? $query->result() : [];
	}

	/**
	 * @param array $data
	 */
	public function pdfConclucionesGeneral(array $data)
	{
		$query = $this->db->query("CALL sp_consulta_ctrlprov_pdf_concluciones(?, ?)", $data);
		if (!$query) {
			return '';
		}
		return ($query->num_rows() > 0) ? $query->row()->parrafo : '';
	}

	/**
	 * @param array $data
	 */
	public function pdfConclucionesEspecificas(array $data)
	{
		$query = $this->db->query("CALL sp_consulta_ctrlprov_pdf_concluciones_especificas(?, ?)", $data);
		if (!$query) {
			return [];
		}
		return ($query->num_rows() > 0) ? $query->result() : [];
	}

	/**
	 * @param array $data
	 */
	public function pdfPlanAccionParrafo1(array $data)
	{
		$query = $this->db->query("CALL sp_consulta_ctrlprov_pdf_plan_acciones_parrafo1(?, ?)", $data);
		if (!$query) {
			return '';
		}
		return ($query->num_rows() > 0) ? $query->row()->parrafo : '';
	}

	/**
	 * @param array $data
	 */
	public function pdfPlanAccionParrafo2(array $data)
	{
		$query = $this->db->query("CALL sp_consulta_ctrlprov_pdf_plan_acciones_parrafo2(?, ?)", $data);
		if (!$query) {
			return '';
		}
		return ($query->num_rows() > 0) ? $query->row()->parrafo : '';
	}

	/**
	 * @param array $data
	 */
	public function pdfPlanAccionParrafo3(array $data)
	{
		$query = $this->db->query("CALL sp_consulta_ctrlprov_pdf_plan_acciones_parrafo3(?, ?)", $data);
		if (!$query) {
			return '';
		}
		return ($query->num_rows() > 0) ? $query->row()->parrafo : '';
	}

	/**
	 * @param array $data
	 * @return null
	 */
	public function pdfCriteriosInspeccion(array $data)
	{
		$query = $this->db->query("CALL sp_consulta_ctrlprov_pdf_criterio_insp(?, ?)", $data);
		if (!$query) {
			return null;
		}
		return ($query->num_rows() > 0) ? $query->row() : null;
	}

	/**
	 * @param array $data
	 * @return null
	 */
	public function pdfCriteriosEvaluacion(array $data)
	{
		$query = $this->db->query("CALL sp_consulta_ctrlprov_pdf_criterio_eval(?, ?)", $data);
		if (!$query) {
			return [];
		}
		return ($query->num_rows() > 0) ? $query->result() : [];
	}

	/**
	 * @param array $data
	 * @return null
	 */
	public function pdfEscalaValoracion(array $data)
	{
		$query = $this->db->query("CALL sp_consulta_ctrlprov_pdf_escala_val(?, ?)", $data);
		if (!$query) {
			return [];
		}
		return ($query->num_rows() > 0) ? $query->result() : [];
	}

	/**
	 * @param array $data
	 * @return null
	 */
	public function pdfParrafoRequisitos(array $data)
	{
		$query = $this->db->query("CALL sp_consulta_ctrlprov_pdf_parrafo_requisitos(?, ?)", $data);
		if (!$query) {
			return '';
		}
		return ($query->num_rows() > 0) ? $query->row()->parrafo : '';
	}

	/**
	 * @param array $data
	 * @return null
	 */
	public function pdfRequisitoExcluyentes(array $data)
	{
		$query = $this->db->query("CALL sp_consulta_ctrlprov_pdf_requisitos_excl(?, ?)", $data);
		if (!$query) {
			return [];
		}
		return ($query->num_rows() > 0) ? $query->result() : [];
	}

	/**
	 * @param array $params
	 * @return mixed
	 */
	public function getDatosInspector(array $params)
	{
		$query = $this->db->query("CALL sp_consulta_ctrlprov_pdf_inspector(?,?)", $params);
		if (!$query) {
			return null;
		}
		return ($query->num_rows() > 0) ? $query->row() : null;
	}

	/**
	 * @param array $data
	 * @return null
	 */
	public function pdfPeligros(array $data)
	{
		$query = $this->db->query("CALL sp_peligros_inspeccion(?, ?)", $data);
		if (!$query) {
			return [];
		}
		return ($query->num_rows() > 0) ? $query->result() : [];
	}

	/**
	 * @param array $data
	 * @return null
	 */
	public function pdfExcluyentes(array $data)
	{
		$query = $this->db->query("CALL sp_consulta_ctrlprov_pdf_excluyentes(?, ?)", $data);
		if (!$query) {
			return [];
		}
		return ($query->num_rows() > 0) ? $query->result() : [];
	}

	/**
	 * @param array $params
	 * @return array
	 */
	public function getAccionesCorrectiva(array $params)
	{
		$query = $this->db->query("CALL sp_consulta_ctrlprov_accion_correctiva(?, ?)", $params);
		if (!$query) {
			return [];
		}
		return ($query->num_rows() > 0) ? $query->result() : [];
	}

	/**
	 * @param array $params
	 * @return array
	 */
	public function getProveedor(array $params)
	{
		$query = $this->db->query("CALL sp_consulta_ctrlprov_buscar_proveedor(?)", $params);
		if (!$query) {
			return null;
		}
		return ($query->num_rows() > 0) ? $query->row() : null;
	}

	/**
	 * @param array $params
	 * @return mixed
	 */
	public function getProveedorEstablecimiento(array $params)
	{
		$query = $this->db->query("CALL sp_consulta_ctrlprov_buscar_proveedor_establecimiento(?)", $params);
		if (!$query) {
			return null;
		}
		return ($query->num_rows() > 0) ? $query->row() : null;
	}

	/**
	 * @param array $params
	 * @return array
	 */
	public function getProveedorLinea(array $params)
	{
		$query = $this->db->query("CALL sp_consulta_ctrlprov_buscar_proveedor_linea(?,?)", $params);
		if (!$query) {
			return null;
		}
		return ($query->num_rows() > 0) ? $query->row()->DLINEACLIENTEE : null;
	}

	/**
	 * @param array $params
	 * @return array
	 */
	public function getProveedorContactos(array $params)
	{
		$query = $this->db->query("CALL sp_consulta_ctrlprov_buscar_proveedor_contactos(?,?)", $params);
		if (!$query) {
			return [];
		}
		return ($query->num_rows() > 0) ? $query->result() : [];
	}

	/**
	 * @param array $params
	 * @return array
	 */
	public function getAreaCliente(array $params)
	{
		$query = $this->db->query("CALL sp_consulta_ctrlprov_area_cliente(?)", $params);
		if (!$query) {
			return [];
		}
		return ($query->num_rows() > 0) ? $query->result() : [];
	}
}
