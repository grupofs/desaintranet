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
	 * @param $id
	 * @return array|bool|mixed|object|null
	 */
	public function buscarInspccion($id)
	{
		$this->db->select('*');
		$this->db->from('PCAUDITORIAINSPECCION');
		$this->db->where('CAUDITORIAINSPECCION', $id);
		$query = $this->db->get();
		if (!$query) {
			return null;
		}
		return ($query->num_rows() > 0) ? $query->row() : null;
	}

	/**
	 * Pruebas
	 * @return string[][]
	 */
	private function dataRef()
	{
		return [
			[
				'ID' => '00003491',
				'DATA' => $this->buscarInspccion('00003491'),
				'CODIGO' => '00000303',
				'FECHAINSPECCION' => '01/10/2021',
				'FCREACION' => '01/10/2021',
				'CLIENTE' => 'HIPERMERCADOS TOTTUS S.A',
				'PROVEEDOR' => 'AGRO INDUSTRIAL PARAMONGA S.A.A',
				'ESTABLECIMIENTOPROV' => '',
				'DIRECCIONPROV' => 'Av. Ferrocarril Nro. 212',
				'UBIGEOPROV' => 'Lima-Barranca-Paramonga',
				'RUC' => '20135948641',
				'MAQUILADOR' => '', 'ESTABLECIMIENTOMAQUILA' => '', 'DIRECCIONMAQUILA' => '', 'UBIGEOMAQUILA' => '', 'AREACLIENTE' => '', 'LINEA' => '', 'RESULTADOCHECKLIST' => '', 'RESULTADOTEXTO' => '', 'TAMANOEMPRESAPROV' => '', 'TIPOESTADOSERVICIO' => '', 'COMENTARIO' => '', 'LICENCIADEFUNCIONAMIENTO' => '', 'ESTADOLICENCIADEFUNCIONAMIENTO' => '', 'CONSULTOR' => '', 'EMPRESAINSPECTORA' => '', 'CONVALIDADO' => '', 'ACCIONCORRECTIVA' => '', 'DUBICACIONFILESERVER' => '', 'COLOR' => '', 'CPROVEEDOR' => '', 'CERTIFICADORA' => '', 'CERTIFICACION' => '', 'SCERTIFICACION' => '', 'dmarca' => '', 'dmarca2' => '', 'DDESTINO' => '', 'SISTEMA' => '', 'CHECKLIST' => '', 'dinformefinal' => '', 'SEVALPROD' => '', 'ESPELIGRO' => '', 'CCHECKLIST' => '', 'DNORMA' => '', 'DSISTEMA' => '', 'DSUBNORMA' => '',
			],
			[
				'ID' => '00003490',
				'DATA' => $this->buscarInspccion('00003490'),
				'CODIGO' => '00000303',
				'FECHAINSPECCION' => '09/10/2020',
				'FCREACION' => '01/06/2020',
				'CLIENTE' => 'HIPERMERCADOS TOTTUS S.A',
				'PROVEEDOR' => 'AGRO INDUSTRIAL PARAMONGA S.A.A',
				'ESTABLECIMIENTOPROV' => '',
				'DIRECCIONPROV' => 'Av. Ferrocarril Nro. 212',
				'UBIGEOPROV' => 'Lima-Barranca-Paramonga',
				'RUC' => '20135948641',
				'MAQUILADOR' => '', 'ESTABLECIMIENTOMAQUILA' => '', 'DIRECCIONMAQUILA' => '', 'UBIGEOMAQUILA' => '', 'AREACLIENTE' => '', 'LINEA' => '', 'RESULTADOCHECKLIST' => '', 'RESULTADOTEXTO' => '', 'TAMANOEMPRESAPROV' => '', 'TIPOESTADOSERVICIO' => '', 'COMENTARIO' => '', 'LICENCIADEFUNCIONAMIENTO' => '', 'ESTADOLICENCIADEFUNCIONAMIENTO' => '', 'CONSULTOR' => '', 'EMPRESAINSPECTORA' => '', 'CONVALIDADO' => '', 'ACCIONCORRECTIVA' => '', 'DUBICACIONFILESERVER' => '', 'COLOR' => '', 'CPROVEEDOR' => '', 'CERTIFICADORA' => '', 'CERTIFICACION' => '', 'SCERTIFICACION' => '', 'dmarca' => '', 'dmarca2' => '', 'DDESTINO' => '', 'SISTEMA' => '', 'CHECKLIST' => '', 'dinformefinal' => '', 'SEVALPROD' => '', 'ESPELIGRO' => '', 'CCHECKLIST' => '', 'DNORMA' => '', 'DSISTEMA' => '', 'DSUBNORMA' => '',
			],
			[
				'ID' => '00003489',
				'DATA' => $this->buscarInspccion('00003489'),
				'CODIGO' => '00000303',
				'FECHAINSPECCION' => '02/12/2019',
				'FCREACION' => '02/12/2019',
				'CLIENTE' => 'HIPERMERCADOS TOTTUS S.A',
				'PROVEEDOR' => 'AGRO INDUSTRIAL PARAMONGA S.A.A',
				'ESTABLECIMIENTOPROV' => '',
				'DIRECCIONPROV' => 'Av. Ferrocarril Nro. 212',
				'UBIGEOPROV' => 'Lima-Barranca-Paramonga',
				'RUC' => '20135948641',
				'MAQUILADOR' => '', 'ESTABLECIMIENTOMAQUILA' => '', 'DIRECCIONMAQUILA' => '', 'UBIGEOMAQUILA' => '', 'AREACLIENTE' => '', 'LINEA' => '', 'RESULTADOCHECKLIST' => '', 'RESULTADOTEXTO' => '', 'TAMANOEMPRESAPROV' => '', 'TIPOESTADOSERVICIO' => '', 'COMENTARIO' => '', 'LICENCIADEFUNCIONAMIENTO' => '', 'ESTADOLICENCIADEFUNCIONAMIENTO' => '', 'CONSULTOR' => '', 'EMPRESAINSPECTORA' => '', 'CONVALIDADO' => '', 'ACCIONCORRECTIVA' => '', 'DUBICACIONFILESERVER' => '', 'COLOR' => '', 'CPROVEEDOR' => '', 'CERTIFICADORA' => '', 'CERTIFICACION' => '', 'SCERTIFICACION' => '', 'dmarca' => '', 'dmarca2' => '', 'DDESTINO' => '', 'SISTEMA' => '', 'CHECKLIST' => '', 'dinformefinal' => '', 'SEVALPROD' => '', 'ESPELIGRO' => '', 'CCHECKLIST' => '', 'DNORMA' => '', 'DSISTEMA' => '', 'DSUBNORMA' => '',
			],
			[
				'ID' => '00003488',
				'DATA' => $this->buscarInspccion('00003488'),
				'CODIGO' => '00000303',
				'FECHAINSPECCION' => '02/12/2018',
				'FCREACION' => '02/06/2018',
				'CLIENTE' => 'HIPERMERCADOS TOTTUS S.A',
				'PROVEEDOR' => 'AGRO INDUSTRIAL PARAMONGA S.A.A',
				'ESTABLECIMIENTOPROV' => '',
				'DIRECCIONPROV' => 'Av. Ferrocarril Nro. 212',
				'UBIGEOPROV' => 'Lima-Barranca-Paramonga',
				'RUC' => '20135948641',
				'MAQUILADOR' => '', 'ESTABLECIMIENTOMAQUILA' => '', 'DIRECCIONMAQUILA' => '', 'UBIGEOMAQUILA' => '', 'AREACLIENTE' => '', 'LINEA' => '', 'RESULTADOCHECKLIST' => '', 'RESULTADOTEXTO' => '', 'TAMANOEMPRESAPROV' => '', 'TIPOESTADOSERVICIO' => '', 'COMENTARIO' => '', 'LICENCIADEFUNCIONAMIENTO' => '', 'ESTADOLICENCIADEFUNCIONAMIENTO' => '', 'CONSULTOR' => '', 'EMPRESAINSPECTORA' => '', 'CONVALIDADO' => '', 'ACCIONCORRECTIVA' => '', 'DUBICACIONFILESERVER' => '', 'COLOR' => '', 'CPROVEEDOR' => '', 'CERTIFICADORA' => '', 'CERTIFICACION' => '', 'SCERTIFICACION' => '', 'dmarca' => '', 'dmarca2' => '', 'DDESTINO' => '', 'SISTEMA' => '', 'CHECKLIST' => '', 'dinformefinal' => '', 'SEVALPROD' => '', 'ESPELIGRO' => '', 'CCHECKLIST' => '', 'DNORMA' => '', 'DSISTEMA' => '', 'DSUBNORMA' => '',
			],
			[
				'ID' => '00003487',
				'DATA' => $this->buscarInspccion('00003487'),
				'CODIGO' => '00000303',
				'FECHAINSPECCION' => '01/11/2016',
				'FCREACION' => '01/11/2016',
				'CLIENTE' => 'HIPERMERCADOS TOTTUS S.A',
				'PROVEEDOR' => 'AGRO INDUSTRIAL PARAMONGA S.A.A',
				'ESTABLECIMIENTOPROV' => '',
				'DIRECCIONPROV' => 'Av. Ferrocarril Nro. 212',
				'UBIGEOPROV' => 'Lima-Barranca-Paramonga',
				'RUC' => '20135948641',
				'MAQUILADOR' => '', 'ESTABLECIMIENTOMAQUILA' => '', 'DIRECCIONMAQUILA' => '', 'UBIGEOMAQUILA' => '', 'AREACLIENTE' => '', 'LINEA' => '', 'RESULTADOCHECKLIST' => '', 'RESULTADOTEXTO' => '', 'TAMANOEMPRESAPROV' => '', 'TIPOESTADOSERVICIO' => '', 'COMENTARIO' => '', 'LICENCIADEFUNCIONAMIENTO' => '', 'ESTADOLICENCIADEFUNCIONAMIENTO' => '', 'CONSULTOR' => '', 'EMPRESAINSPECTORA' => '', 'CONVALIDADO' => '', 'ACCIONCORRECTIVA' => '', 'DUBICACIONFILESERVER' => '', 'COLOR' => '', 'CPROVEEDOR' => '', 'CERTIFICADORA' => '', 'CERTIFICACION' => '', 'SCERTIFICACION' => '', 'dmarca' => '', 'dmarca2' => '', 'DDESTINO' => '', 'SISTEMA' => '', 'CHECKLIST' => '', 'dinformefinal' => '', 'SEVALPROD' => '', 'ESPELIGRO' => '', 'CCHECKLIST' => '', 'DNORMA' => '', 'DSISTEMA' => '', 'DSUBNORMA' => '',
			],
			[
				'ID' => '00003486',
				'DATA' => $this->buscarInspccion('00003486'),
				'CODIGO' => '00000303',
				'FECHAINSPECCION' => '01/09/2015',
				'FCREACION' => '01/09/2015',
				'CLIENTE' => 'HIPERMERCADOS TOTTUS S.A',
				'PROVEEDOR' => 'AGRO INDUSTRIAL PARAMONGA S.A.A',
				'ESTABLECIMIENTOPROV' => '',
				'DIRECCIONPROV' => 'Av. Ferrocarril Nro. 212',
				'UBIGEOPROV' => 'Lima-Barranca-Paramonga',
				'RUC' => '20135948641',
				'MAQUILADOR' => '', 'ESTABLECIMIENTOMAQUILA' => '', 'DIRECCIONMAQUILA' => '', 'UBIGEOMAQUILA' => '', 'AREACLIENTE' => '', 'LINEA' => '', 'RESULTADOCHECKLIST' => '', 'RESULTADOTEXTO' => '', 'TAMANOEMPRESAPROV' => '', 'TIPOESTADOSERVICIO' => '', 'COMENTARIO' => '', 'LICENCIADEFUNCIONAMIENTO' => '', 'ESTADOLICENCIADEFUNCIONAMIENTO' => '', 'CONSULTOR' => '', 'EMPRESAINSPECTORA' => '', 'CONVALIDADO' => '', 'ACCIONCORRECTIVA' => '', 'DUBICACIONFILESERVER' => '', 'COLOR' => '', 'CPROVEEDOR' => '', 'CERTIFICADORA' => '', 'CERTIFICACION' => '', 'SCERTIFICACION' => '', 'dmarca' => '', 'dmarca2' => '', 'DDESTINO' => '', 'SISTEMA' => '', 'CHECKLIST' => '', 'dinformefinal' => '', 'SEVALPROD' => '', 'ESPELIGRO' => '', 'CCHECKLIST' => '', 'DNORMA' => '', 'DSISTEMA' => '', 'DSUBNORMA' => '',
			],
		];
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
}
