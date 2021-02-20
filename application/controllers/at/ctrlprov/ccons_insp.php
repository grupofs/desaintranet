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
		$inspecciones = $this->mcons_insp->buscarInspecciones([
			"@CCIA" => '1',
			"@CAREA" => '01',
			"@CSERVICIO" => '02',
			"@FINI" => null,
			"@FFIN" => null,
			"@CCLIENTE" => '00005',
			"@CCLIENTEPROV" => '%',
			"@CCLIENTEMAQUILA" => '%',
			"@CAREACLIENTE" => '%',
			"@UBIGEOPROV" => '%',
			"@UBIGEOMAQUILA" => '%',
			"@TIPOESTADO" => '%',
			"@COND" => '0',
			"@PELIGRO" => '%',
			"@NROROW" => 0,
			"@SEVALPROD" => '0',
			"@ULTINSP" => '0'
		]);
		echo json_encode(['items' => $inspecciones]);
	}

	/**
	 * Impresión del PDF de la inspección tecnica
	 */
	public function pdf()
	{
		$dompdf = $this->_pdf();
		$dompdf->stream("ficha_tenica.pdf", array("Attachment" => 0));
	}

	/**
	 * Recurso para obtener el PDF
	 * @return \Dompdf\Dompdf
	 */
	private function _pdf()
	{
		$data = [
			'@CAUDI' => '00000303',
			'@FSERV' => '2020-10-09',
		];
		$caratula = $this->mcons_insp->pdfCaratula($data);
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
		// Realiza la creación del PDF
		$dompdf = new \Dompdf\Dompdf();
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
