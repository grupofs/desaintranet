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
		$ccliente = $this->input->post('ccliente');
		$cclienteprov = $this->input->post('cclienteprov');
		$cclientemaquila = $this->input->post('cclientemaquila');
		$careacliente = $this->input->post('careacliente');
		$ubigeoprov = $this->input->post('ubigeoprov');
		$ubigeomaquila = $this->input->post('ubigeomaquila');
		$tipoestado = $this->input->post('tipoestado');
		$cond = $this->input->post('cond');
		$peligro = $this->input->post('peligro');
		$nrorow = $this->input->post('nrorow');
		$sevalprod = $this->input->post('selvaprod');
		$ultinsp = $this->input->post('ultinsp');

		$area = is_null($area) ? '01' : $area;
		$cservicio = is_null($cservicio) ? '02' : $cservicio;
		$ccliente = is_null($ccliente) ? '00005' : $ccliente;
		$cclienteprov = is_null($cclienteprov) ? '%' : $cclienteprov;
		$cclientemaquila = is_null($cclientemaquila) ? '%' : $cclientemaquila;
		$careacliente = is_null($careacliente) ? '%' : $careacliente;
		$ubigeoprov = is_null($ubigeoprov) ? '%' : $ubigeoprov;
		$ubigeomaquila = is_null($ubigeomaquila) ? '%' : $ubigeomaquila;
		$tipoestado = is_null($tipoestado) ? '%' : $tipoestado;
		$cond = is_null($cond) ? '0' : $cond;
		$peligro = is_null($peligro) ? '%' : $peligro;
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
		echo json_encode(['items' => $inspecciones]);
	}

	/**
	 * Impresión del PDF de la inspección tecnica
	 */
	public function pdf()
	{
		try {
			$dompdf = $this->_pdf();
			$dompdf->stream("ficha_tenica.pdf", array("Attachment" => 0));
		} catch (Exception $ex) {
			show_error($ex->getMessage(), 500, 'Error al realizar la carga de PDF');
		}
	}

	/**
	 * Recurso para obtener el PDF
	 * @return \Dompdf\Dompdf
	 */
	private function _pdf()
	{
		$codigo = $this->input->get('codigo');
		$fecha = $this->input->get('fecha');
		$data = [
			'@CAUDI' => $codigo,
			'@FSERV' => $fecha,
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
		$imgGrafico1 = '';
		if (!empty($grafico1)) {
			$imgGrafico1 = base64ResourceConvert(getLinkFormChartBar('CUMPLIMIENTO ENTRE INSPECCIONES',
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
			));
		}
		$imgGrafico2 = base64ResourceConvert("https://quickchart.io/chart?c={type:'bar',data:{labels:['1','2','3'],datasets:[{label:'Maximo',data:[400,110,40]},{label:'Obtenido',data:[400,100,40]}]}}");
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
		], TRUE);
		$options = new \Dompdf\Options();
		$options->set('dpi', 100);
		$options->set('isPhpEnabled', TRUE);
		// Realiza la creación del PDF
		$dompdf = new \Dompdf\Dompdf($options);
		$dompdf->loadHtml($content);
		$dompdf->setPaper('A4', 'portrait');
		$dompdf->render();
		return $dompdf;
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
			$id = $this->input->post('id');
			$inspeccion = $this->mcons_insp->buscarInspccion($id);
			if (empty($inspeccion)) {
				throw new Exception('La inspección no pudo ser encontrada.');
			}
			$fileName = 'inspeccion_' . date('Ymdhis') . ' .pdf';
			$filePath = $this->carpetaAT . $fileName;
			$dompdf = $this->_pdf();
			$saveFile = file_put_contents(RUTA_ARCHIVOS . $filePath, $dompdf->output());
			if (!$saveFile) {
				throw new Exception('Error al guardar el archivo PDF.');
			}

			$validate = $this->db->update('PCAUDITORIAINSPECCION',
				[
					'LINKPDF' => $filePath,
				],
				[
					'CAUDITORIAINSPECCION' => $inspeccion->CAUDITORIAINSPECCION,
				]
			);
			if (!$validate) {
				throw new Exception('La inspección no pudo ser actualizada correctamente.');
			}
			$inspeccion->LINKPDF = $filePath;

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
