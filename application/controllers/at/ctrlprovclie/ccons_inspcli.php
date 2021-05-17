<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
define("DOMPDF_ENABLE_REMOTE", true);

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use PhpOffice\PhpSpreadsheet\Style\Fill;
use PhpOffice\PhpSpreadsheet\Style\Border;
use PhpOffice\PhpSpreadsheet\Style\Color;
use PhpOffice\PhpSpreadsheet\Style\NumberFormat;
use PhpOffice\PhpSpreadsheet\Style\Conditional;
use PhpOffice\PhpSpreadsheet\Writer\IWriter;
use PhpOffice\PhpSpreadsheet\IOFactory;

/**
 * Class ccons_insp
 * @property mcons_insp mcons_insp
 */
class ccons_inspcli extends FS_Controller
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
		$ccliente = $this->session->userdata('s_ccliente');
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
				? \Carbon\Carbon::createFromFormat('d/m/Y', $fini, 'America/Lima')->format('Y-m-d')
				: $now;
			$ffin = (validateDate($ffin, 'd/m/Y'))
				? \Carbon\Carbon::createFromFormat('d/m/Y', $ffin, 'America/Lima')->format('Y-m-d')
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
	 *
	 */
	public function exportar_registros()
	{
		if (!$this->input->is_ajax_request()) {
			show_404();
		}

		try {

			$ccia = $this->input->post('ccia');
			$area = $this->input->post('area');
			$cservicio = $this->input->post('cservicio');
			$afecha = (int)$this->input->post('afecha');
			$fini = $this->input->post('fini');
			$ffin = $this->input->post('ffin');
			$ccliente = $this->session->userdata('s_ccliente');
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
					? \Carbon\Carbon::createFromFormat('d/m/Y', $fini, 'America/Lima')->format('Y-m-d')
					: $now;
				$ffin = (validateDate($ffin, 'd/m/Y'))
					? \Carbon\Carbon::createFromFormat('d/m/Y', $ffin, 'America/Lima')->format('Y-m-d')
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

			$spreadsheet = new Spreadsheet();
			$sheet = $spreadsheet->getActiveSheet();
			$sheet->setTitle('INSPECCIONES DEL PROVEEDOR');

			$spreadsheet->getDefaultStyle()
				->getFont()
				->setName('Arial')
				->setSize(10);

			$sheet->setCellValue('A1', 'INSPECCIONES DEL PROVEEDOR')
				->mergeCells('A1:T1');

			$sheet->setCellValue('A2', 'Fecha Inspección')
				->setCellValue('B2', 'Proveedor')
				->setCellValue('C2', 'RUC')
				->setCellValue('D2', 'Establecimiento / Maquilador')
				->setCellValue('E2', 'Dirección Maquilador')
				->setCellValue('F2', 'Ubigeo Maquilador')
				->setCellValue('G2', 'Área Cliente')
				->setCellValue('H2', 'Línea')
				->setCellValue('I2', 'Calificación')
				->setCellValue('J2', 'Nro de Informe')
				->setCellValue('K2', 'Acción Correctiva')
				->setCellValue('L2', 'Tipo Estado Servicio')
				->setCellValue('M2', 'Comentario')
				->setCellValue('N2', 'Estado Certificación')
				->setCellValue('O2', 'Certificación')
				->setCellValue('P2', 'Licencia de Funcionamiento')
				->setCellValue('Q2', 'Consultor')
				->setCellValue('R2', 'Empresa Inspectora')
				->setCellValue('S2', 'Eval. Prod.')
				->setCellValue('T2', 'Es Peligro');

			if (!empty($inspecciones)) {
				$pos = 3;
				foreach ($inspecciones as $key => $value) {
					$sheet->setCellValue('A' . $pos, \Carbon\Carbon::createFromFormat('Y-m-d', $value->FECHAINSPECCION)->format('d/m/Y'));
					$sheet->setCellValue('B' . $pos, $value->PROVEEDOR);
					$sheet->setCellValue('C' . $pos, $value->nruc);
					$establecimiento = (empty($value->DIRECCIONPROV)) ? $value->MAQUILADOR : $value->MAQUILADOR;
					$sheet->setCellValue('D' . $pos, $establecimiento);
					$sheet->setCellValue('E' . $pos, $value->DIRECCIONMAQUILA);
					$sheet->setCellValue('F' . $pos, $value->UBIGEOMAQUILA);
					$sheet->setCellValue('G' . $pos, $value->AREACLIENTE);
					$sheet->setCellValue('H' . $pos, $value->LINEA);
					$RESULTADOCHECKLIST = (!empty($value->RESULTADOCHECKLIST)) ? $value->RESULTADOCHECKLIST . '%' : '';
					$RESULTADOTEXTO = (!empty($value->RESULTADOTEXTO)) ? $value->RESULTADOTEXTO : '';
					$sheet->setCellValue('I' . $pos, $RESULTADOCHECKLIST . ' ' . $RESULTADOTEXTO);
					$sheet->setCellValue('J' . $pos, $value->dinformefinal);
					$sheet->setCellValue('K' . $pos, $value->ACCIONCORRECTIVA);
					$sheet->setCellValue('L' . $pos, $value->TIPOESTADOSERVICIO);
					$sheet->setCellValue('M' . $pos, $value->COMENTARIO);
					$sheet->setCellValue('N' . $pos, $value->SCERTIFICACION);
					$CERTIFICADORA = (!empty($value->CERTIFICADORA)) ? $value->CERTIFICADORA : '';
					$CERTIFICACION = (!empty($value->CERTIFICACION)) ? $value->CERTIFICACION : '';
					$sheet->setCellValue('O' . $pos, $CERTIFICADORA . ' ' . $CERTIFICACION);
					$LICENCIADEFUNCIONAMIENTO = (!empty($value->LICENCIADEFUNCIONAMIENTO)) ? $value->LICENCIADEFUNCIONAMIENTO : '';
					$ESTADOLICENCIADEFUNCIONAMIENTO = (!empty($value->ESTADOLICENCIADEFUNCIONAMIENTO)) ? $value->ESTADOLICENCIADEFUNCIONAMIENTO : '';
					$sheet->setCellValue('P' . $pos, $LICENCIADEFUNCIONAMIENTO . ' ' . $ESTADOLICENCIADEFUNCIONAMIENTO);
					$sheet->setCellValue('Q' . $pos, $value->CONSULTOR);
					$sheet->setCellValue('R' . $pos, $value->EMPRESAINSPECTORA);
					$sheet->setCellValue('S' . $pos, $value->SEVALPROD);
					$sheet->setCellValue('T' . $pos, $value->espeligro);
					++$pos;
				}
			}

			$titulo = [
				'font' => [
					'name' => 'Arial',
					'size' => 12,
					'color' => array('rgb' => 'FFFFFF'),
					'bold' => true,
				],
				'fill' => [
					'fillType' => Fill::FILL_SOLID,
					'startColor' => [
						'rgb' => '29B037'
					]
				],
				'borders' => [
					'allBorders' => [
						'borderStyle' => Border::BORDER_THIN,
						'color' => [
							'rgb' => '000000'
						]
					]
				],
			];
			$cabecera = [
				'font' => [
					'name' => 'Arial',
					'size' => 10,
					'color' => array('rgb' => 'FFFFFF'),
					'bold' => true,
				],
				'fill' => [
					'fillType' => Fill::FILL_SOLID,
					'startColor' => [
						'rgb' => '29B037'
					]
				],
				'borders' => [
					'allBorders' => [
						'borderStyle' => Border::BORDER_THIN,
						'color' => [
							'rgb' => '000000'
						]
					]
				],
				'alignment' => [
					'horizontal' => Alignment::HORIZONTAL_CENTER,
					'vertical' => Alignment::VERTICAL_CENTER,
					'wrapText' => true,
				],
			];
			$sheet->getStyle('A1:T1')->applyFromArray($titulo);
			$sheet->getStyle('A2:T2')->applyFromArray($cabecera);

			foreach (range('A', 'T') as $column) {
				$sheet->getColumnDimension($column)->setAutoSize(true);
			}

			$writer = new Xlsx($spreadsheet);
			$filename = 'consulta_inspeccion_proveedores_' . date('Ymd') . '.xlsx';
			$path = RUTA_ARCHIVOS . '../../temp/' . $filename;
			$writer->save($path);

			$this->result['status'] = 200;
			$this->result['message'] = 'Se realizo la exportación correctamente.';
			$this->result['data'] = $filename;
		} catch (Exception $ex) {
			$this->result['message'] = $ex->getMessage();
		}
		responseResult($this->result);
	}

}
