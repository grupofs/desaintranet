<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
define("DOMPDF_ENABLE_REMOTE", true);

/**
 * Class ccons_insp
 * @property mcons_insp mcons_insp
 */
class ccons_insp extends FS_Controller
{
	/**
	 * Ruta para los PDF de las inpescciones tecnicas
	 * @var string
	 */
	private $carpetaAT = 'AT/';

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
		$cclienteprov = $this->input->post('cclienteprov');
		$cclientemaquila = $this->input->post('cclientemaquila');
		$careacliente = $this->input->post('careacliente');
		$ubigeoprov = $this->input->post('ubigeoprov');
		$ubigeomaquila = $this->input->post('ubigeomaquila');
		$tipoestado = $this->input->post('tipoestado');
		$cond = $this->input->post('cond');
		$peligro = $this->input->post('filtro_peligro');
		$nrorow = $this->input->post('nrorow');
		$sevalprod = $this->input->post('sevalprod');
		$ultinsp = $this->input->post('ultinsp');

		$inspecciones = '';
		if (!empty($ccliente)) {
			$area = is_null($area) ? '01' : $area;
			$cservicio = is_null($cservicio) ? '02' : $cservicio;
//			$ccliente = is_null($ccliente) ? '00005' : $ccliente;
			$cclienteprov = is_null($cclienteprov) ? '%' : $cclienteprov;
			$cclientemaquila = is_null($cclientemaquila) ? '%' : $cclientemaquila;
			$careacliente = is_null($careacliente) ? '%' : $careacliente;
			$ubigeoprov = is_null($ubigeoprov) ? '%' : $ubigeoprov;
			$ubigeomaquila = is_null($ubigeomaquila) ? '%' : $ubigeomaquila;
			$tipoestado = is_null($tipoestado) ? '%' : $tipoestado;
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
			$dompdf = $this->_pdf($codigo, $fecha);
			$dompdf->stream("ficha_tenica.pdf", array("Attachment" => 0));
		} catch (Exception $ex) {
			show_error($ex->getMessage(), 500, 'Error al realizar la carga de PDF');
		}
	}

	/**
	 * Recurso para obtener el PDF
	 * @param string $codigo
	 * @param string $pdf
	 * @return \Dompdf\Dompdf
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
					$grafico1->TF1 . ' ' . $grafico1->CERT1,
					$grafico1->TF2 . ' ' . $grafico1->CERT2,
					$grafico1->TF3 . ' ' . $grafico1->CERT3,
					$grafico1->TF4 . ' ' . $grafico1->CERT4,
					$grafico1->TF5 . ' ' . $grafico1->CERT5,
				],
				[
					floatval($grafico1->TR1),
					floatval($grafico1->TR2),
					floatval($grafico1->TR3),
					floatval($grafico1->TR4),
					floatval($grafico1->TR5),
				]
			);
		}
		$imgGrafico2 = '';
		if (!empty($grafico2)) {
			$totalRows = (count($grafico2) / 2);
			$labels = range(1, $totalRows);
			$dataMaximo = implode(',', getValueGraphic2($grafico2, 'máximo'));
			$dataObtenido = implode(',', getValueGraphic2($grafico2, 'obtenido'));
			$datasets = "{label:'Maximo',data:[{$dataMaximo}]}";
			$datasets .= ",{label:'Obtenido',data:[{$dataObtenido}]}";
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
		$peligros = $this->mcons_insp->pdfPeligros($data);
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
		], TRUE);
//		$options = new \Dompdf\Options();
//		$options->set('dpi', 100);
//		$options->set('isPhpEnabled', TRUE);
//		// Realiza la creación del PDF
//		$dompdf = new \Dompdf\Dompdf($options);
//		$dompdf->loadHtml($content);
//		$dompdf->setPaper('A4', 'portrait');
//		$dompdf->render();
//		return $dompdf;
		$html2pdf = new \Spipu\Html2Pdf\Html2Pdf();
		$html2pdf->writeHTML($content);
		$html2pdf->output('file.pdf', 'I');
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
			$inspeccion = $this->mcons_insp->buscarInspccion($codigo, $fecha);
			if (empty($inspeccion)) {
				throw new Exception('La inspección no pudo ser encontrada.');
			}
			$fileName = 'inspeccion_' . date('Ymdhis') . ' .pdf';
			$filePath = $this->carpetaAT . $fileName;
			$dompdf = $this->_pdf($codigo, $fecha);
			$saveFile = file_put_contents(RUTA_ARCHIVOS . $filePath, $dompdf->output());
			if (!$saveFile) {
				throw new Exception('Error al guardar el archivo PDF.');
			}

			$validate = $this->db->update('PDAUDITORIAINSPECCION',
				[
					'DUBICACIONFILESERVERPDF' => $filePath,
				],
				[
					'CAUDITORIAINSPECCION' => $inspeccion->CAUDITORIAINSPECCION,
					'FSERVICIO' => $inspeccion->FSERVICIO,
				]
			);
			if (!$validate) {
				throw new Exception('La inspección no pudo ser actualizada correctamente.');
			}
			$inspeccion->DUBICACIONFILESERVERPDF = $filePath;

			$this->result['status'] = 200;
			$this->result['message'] = 'Descarga del archivo correctamente.';
			$this->result['data'] = $inspeccion;
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

}
