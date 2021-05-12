<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
define("DOMPDF_ENABLE_REMOTE", true);

/**
 * Class ccons_insp
 * @property mcons_insp mcons_insp
 */
class ccons_insp extends FS_Controller
{
	/**
	 * CODIGO CIA
	 */
	const CIA = '1';

	/**
	 * CODIGO DE AREA
	 */
	const AREA = '01';

	/**
	 * CODIGO DE SERVICIO
	 */
	const SERVICIO = '02';

	/**
	 * ccons_insp constructor.
	 */
	public function __construct()
	{
		parent::__construct();
		$this->load->helper('consinsp');
		$this->load->model('at/ctrlprov/mcons_insp', 'mcons_insp');
	}

	/**
	 * Busqueda de areas del cliente
	 */
	public function get_areas()
	{
		if (!$this->input->is_ajax_request()) {
			show_404();
		}
		$ccliente = $this->input->post('ccliente');
		$items = $this->mcons_insp->getAreaCliente([
			'@AS_CCLIENTE' => $ccliente,
		]);
		echo json_encode(['items' => $items]);
	}

	/**
	 * Devuelve las inspecciones
	 */
	public function search()
	{
		$ccia = $this->input->post('ccia');
		$area = $this->input->post('area');
		$cservicio = $this->input->post('cservicio');
		$afecha = (int)$this->input->post('afecha');
		$fini = $this->input->post('fini');
		$ffin = $this->input->post('ffin');
		$ccliente = $this->input->post('filtro_cliente');
		$cclienteprov = $this->input->post('filtro_proveedor');
		$cclientemaquila = $this->input->post('filtro_maquilador');
		$careacliente = $this->input->post('filtro_cliente_area');
		$ubigeoprov = null; // $this->input->post('ubigeoprov');
		$ubigeomaquila = null; // $this->input->post('ubigeomaquila');
		$tipoestado = $this->input->post('filtro_tipo_estado');
		$cond = $this->input->post('cond');
		$peligro = $this->input->post('filtro_peligro');
		$nrorow = $this->input->post('nrorow');
		$sevalprod = $this->input->post('sevalprod');
		$ultinsp = $this->input->post('ultinsp');

		$inspecciones = '';
		if (!empty($ccliente)) {
			$area = self::AREA;
			$cservicio = self::SERVICIO;
//			$ccliente = is_null($ccliente) ? '00005' : $ccliente;
			$cclienteprov = (empty($cclienteprov)) ? '%' : $cclienteprov;
			$cclientemaquila = (empty($cclientemaquila)) ? '%' : $cclientemaquila;
			$careacliente = (empty($careacliente)) ? '%' : $careacliente;
			$ubigeoprov = is_null($ubigeoprov) ? '%' : $ubigeoprov;
			$ubigeomaquila = is_null($ubigeomaquila) ? '%' : $ubigeomaquila;
			$tipoestado = (empty($tipoestado)) ? '%' : $tipoestado;
			$cond = is_null($cond) ? '0' : $cond;
			$peligro = empty($peligro) ? '%' : $peligro;
			$nrorow = is_null($nrorow) ? 0 : $nrorow;
			$sevalprod = is_null($sevalprod) ? '0' : $sevalprod;
			$ultinsp = is_null($ultinsp) ? '0' : $ultinsp;

			// Se verifica si filtrara con fecha o no
			$now = \Carbon\Carbon::now('America/Lima')->format('Y-m-d');
			if (!$afecha) {
				$fini = null;
				$ffin = null;
			} else {
				// En caso sea un formato invalido se tomara la fecha de hoy
				$fini = (validateDate($fini, 'd/m/Y'))
					? \Carbon\Carbon::createFromFormat('d/m/Y', $fini, 'America/Lima')->format('Y-m-m')
					: $now;
				$ffin = (validateDate($ffin, 'd/m/Y'))
					? \Carbon\Carbon::createFromFormat('d/m/Y', $ffin, 'America/Lima')->format('Y-m-m')
					: $now;
			}

			$inspecciones = $this->mcons_insp->buscarInspecciones([
				"@CCIA" => $ccia,
				"@CAREA" => $area,
				"@CSERVICIO" => $cservicio,
				"@FINI" => $fini,
				"@FFIN" => $ffin,
				"@CCLIENTE" => $ccliente,
				"@CCLIENTEPROV" => $cclienteprov,
				"@CCLIENTEMAQUILA" => $cclientemaquila,
				"@CAREACLIENTE" => $careacliente,
				"@UBIGEOPROV" => $ubigeoprov,
				"@UBIGEOMAQUILA" => $ubigeomaquila,
				"@TIPOESTADO" => $tipoestado,
				"@COND" => $cond,
				"@PELIGRO" => $peligro,
				"@NROROW" => $nrorow,
				"@SEVALPROD" => $sevalprod,
				"@ULTINSP" => $ultinsp
			]);
		}
		echo json_encode(['items' => $inspecciones]);
	}

	/**
	 * Impresión del PDF de la inspección tecnica
	 */
	public function pdf()
	{
		try {
			$codigo = $this->input->get('codigo');
			$fecha = $this->input->get('fecha');
			$html2pdf = $this->_pdf($codigo, $fecha);
//			$dompdf->stream("ficha_tenica.pdf", array("Attachment" => 0));
			$html2pdf->output('file.pdf', 'I');
		} catch (Exception $ex) {
			show_error($ex->getMessage(), 500, 'Error al realizar la carga de PDF');
		}
	}

	/**
	 * Recurso para obtener el PDF
	 * @param string $codigo
	 * @param string $pdf
	 */
	private function _pdf($codigo, $fecha)
	{
		$data = [
			'@CAUDI' => $codigo, // '00000303',
			'@FSERV' => $fecha, // '2020-10-09',
		];
		$caratula = $this->mcons_insp->pdfCaratula($data);
		if (empty($caratula)) {
			throw new Exception('El control de proveedor no pudo ser encontrado.');
		}
		$parrafo1Pt1 = $this->mcons_insp->pdfParrafo1Parte1($data);
		$parrafo1Pt2 = $this->mcons_insp->pdfParrafo1Parte2($data);
		$cuadro1 = $this->mcons_insp->pdfCuadro1($data);
		$parrafo2 = $this->mcons_insp->pdfParrafo2($data);
		$grafico1 = $this->mcons_insp->pdfGrafico1($data);
		$cuadro2 = $this->mcons_insp->pdfCuadro2($data);
		$grafico2 = $this->mcons_insp->pdfGrafico2($data);
		$imgGrafico1 = '';
		if (!empty($grafico1)) {
			$imgGrafico1 = getLinkFormChartBar(
				[
					date('d/m/Y', strtotime($grafico1->TF1)) . " " . $grafico1->CERT1,
					date('d/m/Y', strtotime($grafico1->TF2)) . " " . $grafico1->CERT2,
					date('d/m/Y', strtotime($grafico1->TF3)) . " " . $grafico1->CERT3,
					date('d/m/Y', strtotime($grafico1->TF4)) . " " . $grafico1->CERT4,
					date('d/m/Y', strtotime($grafico1->TF5)) . " " . $grafico1->CERT5,
				],
				[
					floatval(round($grafico1->TR1)),
					floatval(round($grafico1->TR2)),
					floatval(round($grafico1->TR3)),
					floatval(round($grafico1->TR4)),
					floatval(round($grafico1->TR5)),
				],
				[
					getColorRgba($grafico1->TR1),
					getColorRgba($grafico1->TR2),
					getColorRgba($grafico1->TR3),
					getColorRgba($grafico1->TR4),
					getColorRgba($grafico1->TR5),
				]
			);
		}
		$imgGrafico2 = '';
		if (!empty($grafico2)) {
			$lenRows = count($grafico2);
			$totalRows = ($lenRows / 2);
			$labels = range(1, $totalRows);
			$dataMaximo = implode(',', getValueGraphic2($grafico2, 'máximo'));
			$dataObtenido = implode(',', getValueGraphic2($grafico2, 'obtenido'));
			$backgroundColorMaximo = "'rgba(255,0,0,1)'";
			$backgroundColorObtenido = "'rgba(0,128,0,1)'";
			if ($lenRows == 4) {
				$backgroundColorMaximo = "'rgba(255,0,0,1)','rgba(255,0,0,1)'";
				$backgroundColorObtenido = "'rgba(0,128,0,1)','rgba(0,128,0,1)'";
			}
			if ($lenRows > 4) {
				$backgroundColorMaximo = "'rgba(255,0,0,1)','rgba(255,0,0,1)','rgba(255,0,0,1)'";
				$backgroundColorObtenido = "'rgba(0,128,0,1)','rgba(0,128,0,1)','rgba(0,128,0,1)'";
			}
			$datasets = "{label:'Maximo',data:[{$dataMaximo}],backgroundColor:[{$backgroundColorMaximo}]}";
			$datasets .= ",{label:'Obtenido',data:[{$dataObtenido}],backgroundColor:[{$backgroundColorObtenido}]}";
			$imgGrafico2 = getLinkFormChartBar2($labels, $datasets);
		}
		$cuadro3 = $this->mcons_insp->pdfCuadro3($data);
		$cuadro4 = $this->mcons_insp->pdfCuadro4($data);
		$criterioInspeccion = $this->mcons_insp->pdfCriteriosInspeccion($data);
		$criterioEvaluacion = $this->mcons_insp->pdfCriteriosEvaluacion($data);
		$conclucionesGenerales = $this->mcons_insp->pdfConclucionesGeneral($data);
		$conclucionesEspecificas = $this->mcons_insp->pdfConclucionesEspecificas($data);
		$keyConclucionesEspecificasConformidades = array_search('Conformidades', array_column($conclucionesEspecificas, 'dregistro'));
		$conclucionesEspecificasConformidades = ($keyConclucionesEspecificasConformidades !== false) ? $conclucionesEspecificas[$keyConclucionesEspecificasConformidades] : null;
		$keyConclucionesEspecificasObservaciones = array_search('Observaciones', array_column($conclucionesEspecificas, 'dregistro'));
		$conclucionesEspecificasObservaciones = ($keyConclucionesEspecificasObservaciones !== false) ? $conclucionesEspecificas[$keyConclucionesEspecificasObservaciones] : null;
		$planAccionParrafo1 = $this->mcons_insp->pdfPlanAccionParrafo1($data);
		$planAccionParrafo2 = $this->mcons_insp->pdfPlanAccionParrafo2($data);
		$planAccionParrafo3 = $this->mcons_insp->pdfPlanAccionParrafo3($data);
		$escalaValoracion = $this->mcons_insp->pdfEscalaValoracion($data);
		$parrafoExcluyentes = $this->mcons_insp->pdfParrafoRequisitos($data);
		$requisitosExcluyentes = $this->mcons_insp->pdfRequisitoExcluyentes($data);
		$inspector = $this->mcons_insp->getDatosInspector($data);
		$peligros = $this->mcons_insp->pdfPeligros($data);
		$excluyentes = $this->mcons_insp->pdfExcluyentes($data);
		$rutafirma = null;
		if (!empty($inspector)) {
			$rutafirma = 'http://plataforma.grupofs.com:82/demointranet/FTPfileserver/Imagenes/internos/firmas/' . $inspector->rutafirma;
			if (file_exists($rutafirma)) {
				$rutafirma = base64ResourceConvert($rutafirma);
			}
		}
		// Contenedor de la ficha tecnica
		$content = $this->load->view('at/ctrlprov/vcons_insp_pdf', [
			'caratula' => $caratula,
			'parrafo1Pt1' => $parrafo1Pt1,
			'parrafo1Pt2' => $parrafo1Pt2,
			'cuadro1' => $cuadro1,
			'parrafo2' => $parrafo2,
			'imgGrafico1' => $imgGrafico1,
			'cuadro2' => $cuadro2,
			'imgGrafico2' => $imgGrafico2,
			'cuadro3' => $cuadro3,
			'cuadro4' => $cuadro4,
			'criterioInspeccion' => $criterioInspeccion,
			'criterioEvaluacion' => $criterioEvaluacion,
			'conclucionesGenerales' => $conclucionesGenerales,
			'conclucionesEspecificasConformidades' => $conclucionesEspecificasConformidades,
			'conclucionesEspecificasObservaciones' => $conclucionesEspecificasObservaciones,
			'planAccionParrafo1' => $planAccionParrafo1,
			'planAccionParrafo2' => $planAccionParrafo2,
			'planAccionParrafo3' => $planAccionParrafo3,
			'escalaValoracion' => $escalaValoracion,
			'parrafoExcluyentes' => $parrafoExcluyentes,
			'requisitosExcluyentes' => $requisitosExcluyentes,
			'peligros' => $peligros,
			'rutafirma' => $rutafirma,
			'inspector' => $inspector,
			'excluyentes' => $excluyentes,
		], TRUE);
		$html2pdf = new \Spipu\Html2Pdf\Html2Pdf();
//		$html2pdf->setDefaultFont('arial');
		$html2pdf->writeHTML($content);
		return $html2pdf;
	}

	/**
	 * Cierre de la inspeccion tecnica
	 */
	public function close_download()
	{
		if (!$this->input->is_ajax_request()) {
			show_404();
		}
		try {
			$codigo = $this->input->post('codigo');
			$fecha = $this->input->post('fecha');
			$inspecciondet = $this->mcons_insp->buscarInspccion($codigo, $fecha);
			if (empty($inspecciondet)) {
				throw new Exception('La inspección no pudo ser encontrada.');
			}
			$inspeccioncab = $this->mcons_insp->buscarInspccionCab($codigo);
			if (empty($inspeccioncab)) {
				throw new Exception('La inspección cabecera no pudo ser encontrada.');
			}
			// codigo | fecha .pdf
			$fileName = $codigo . str_replace('-', '', $fecha) . '.pdf';
			$dompdf = $this->_pdf($codigo, $fecha);

			// Separado por Archivos / cia|area|servicio / ccliente / caudi
			$rutaCarpeta = '1' . self::AREA.self::SERVICIO . '/' . $inspeccioncab->CCLIENTE . '/' .  $inspeccioncab->CAUDITORIAINSPECCION;
			if (!file_exists(RUTA_ARCHIVOS. $rutaCarpeta)) {
				mkdir(RUTA_ARCHIVOS . $rutaCarpeta, '0777', true);
			}
			$filePath = $rutaCarpeta . '/' . $fileName;
			$dompdf->output(RUTA_ARCHIVOS . $filePath, 'F');

			$validate = $this->db->update('PDAUDITORIAINSPECCION',
				[
					'DUBICACIONFILESERVERPDF' => $filePath,
				],
				[
					'CAUDITORIAINSPECCION' => $inspecciondet->CAUDITORIAINSPECCION,
					'FSERVICIO' => $inspecciondet->FSERVICIO,
				]
			);
			if (!$validate) {
				throw new Exception('La inspección no pudo ser actualizada correctamente.');
			}
			$inspecciondet->DUBICACIONFILESERVERPDF = $filePath;

			$this->result['status'] = 200;
			$this->result['message'] = 'Descarga del archivo correctamente.';
			$this->result['data'] = $inspecciondet;
		} catch (Exception $ex) {
			$this->result['message'] = $ex->getMessage();
		}
		responseResult($this->result);
	}

	/**
	 * Realiza la descarga del archivo
	 */
	public function download()
	{
		$fileName = $this->input->get('filename');
		$this->load->helper('download');
		$pathFile = RUTA_ARCHIVOS . $fileName;
		if (!file_exists($pathFile)) {
			show_404();
		}
		force_download($pathFile, null, false);
	}

	/**
	 * Busqueda de las acciones correctiva
	 */
	public function get_accion_correctiva()
	{
		if (!$this->input->is_ajax_request()) {
			show_404();
		}
		$codigo = $this->input->post('codigo');
		$fecha = $this->input->post('fecha');
		$items = $this->mcons_insp->getAccionesCorrectiva([
			'@CAUDI' => $codigo,
			'@FSERV' => $fecha,
		]);
		echo json_encode(['items' => $items]);
	}

	/**
	 * Busqueda de las acciones correctiva
	 */
	public function get_proveedor()
	{
		if (!$this->input->is_ajax_request()) {
			show_404();
		}
		$caudi = $this->input->post('caudi');
		$id_proveedor = $this->input->post('proveedor');
		$proveedor = $this->mcons_insp->getProveedor([
			'@AS_CCLIENTE' => $id_proveedor,
		]);
		$establecimiento = $this->mcons_insp->getProveedorEstablecimiento([
			'@AS_CAUDITORIAINSPECCION' => $caudi,
		]);
		$linea = $this->mcons_insp->getProveedorLinea([
			'@AS_CCLIENTE' => $id_proveedor,
			'@AS_CCIA' => 1,
		]);
		$contactos = $this->mcons_insp->getProveedorContactos([
			'@AS_CCLIENTE' => $id_proveedor,
			'@AS_CESTABLECIMIENTO' => (!empty($establecimiento)) ? $establecimiento->cestablecimientoprov : '',
		]);
		echo json_encode([
			'proveedor' => $proveedor,
			'establecimiento' => (!empty($establecimiento)) ? $establecimiento->ESTABLECIMIENTO : '',
			'linea' => $linea,
			'contactos' => $contactos,
		]);
	}

}
