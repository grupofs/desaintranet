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
		$afecha = (int)$this->input->post('afecha');
		$fini = $this->input->post('fini');
		$ffin = $this->input->post('ffin');
		$ccliente = $this->session->userdata('s_ccliente');
		$cclienteprov = $this->input->post('filtro_proveedor');
		$cclientemaquila = $this->input->post('filtro_maquilador');
		$careacliente = $this->input->post('filtro_cliente_area');
		$tipoestado = $this->input->post('filtro_tipo_estado');
		$peligro = $this->input->post('filtro_peligro');
		$sevalprod = $this->input->post('sevalprod');
		$filtro_calificacion = $this->input->post('filtro_calificacion');
		$establecimientoMaqui = $this->input->post('filtro_establecimiento_maqui');
		$dirEstablecimientoMaqui = $this->input->post('filtro_dir_establecimiento_maqui');
		$nroInforme = $this->input->post('filtro_nro_informe');

		$inspecciones = '';
		if (!empty($ccliente)) {
			$area = self::AREA;
			$cservicio = self::SERVICIO;
			$cclienteprov = (empty($cclienteprov)) ? '%' : $cclienteprov;
			$cclientemaquila = (empty($cclientemaquila)) ? '%' : $cclientemaquila;
			$careacliente = (empty($careacliente)) ? [] : $careacliente;
			$establecimientoMaqui = is_null($establecimientoMaqui) ? '%' : "%{$establecimientoMaqui}%";
			$dirEstablecimientoMaqui = is_null($dirEstablecimientoMaqui) ? '%' : "%{$dirEstablecimientoMaqui}%";
			$nroInforme = is_null($nroInforme) ? '%' : "%{$nroInforme}%";
			$tipoestado = (empty($tipoestado)) ? [] : $tipoestado;
			$peligro = empty($peligro) ? '%' : $peligro;
			$sevalprod = is_null($sevalprod) ? '0' : $sevalprod;
			$filtro_calificacion = is_null($filtro_calificacion) ? [] : $filtro_calificacion;

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

			$calificacion = clearLabel($filtro_calificacion, false);
			$tipoestado = clearLabel($tipoestado, false);
			$careacliente = clearLabel($careacliente, false);

			$inspecciones = $this->mcons_insp->buscarInspecciones(
				$ccia,
				$area,
				$cservicio,
				$ccliente,
				$cclienteprov,
				$cclientemaquila,
				$careacliente,
				$establecimientoMaqui,
				$dirEstablecimientoMaqui,
				$nroInforme,
				$tipoestado,
				$fini,
				$ffin,
				$peligro,
				$sevalprod,
				$calificacion
			);
		}
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
			$afecha = (int)$this->input->post('afecha');
			$fini = $this->input->post('fini');
			$ffin = $this->input->post('ffin');
			$ccliente = $this->session->userdata('s_ccliente');
			$cclienteprov = $this->input->post('filtro_proveedor');
			$cclientemaquila = $this->input->post('filtro_maquilador');
			$careacliente = $this->input->post('filtro_cliente_area');
			$tipoestado = $this->input->post('filtro_tipo_estado');
			$peligro = $this->input->post('filtro_peligro');
			$sevalprod = $this->input->post('sevalprod');
			$filtro_calificacion = $this->input->post('filtro_calificacion');
			$establecimientoMaqui = $this->input->post('filtro_establecimiento_maqui');
			$dirEstablecimientoMaqui = $this->input->post('filtro_dir_establecimiento_maqui');
			$nroInforme = $this->input->post('filtro_nro_informe');

			$inspecciones = '';
			$area = self::AREA;
			$cservicio = self::SERVICIO;
			$cclienteprov = (empty($cclienteprov)) ? '%' : $cclienteprov;
			$cclientemaquila = (empty($cclientemaquila)) ? '%' : $cclientemaquila;
			$careacliente = (empty($careacliente)) ? [] : $careacliente;
			$establecimientoMaqui = is_null($establecimientoMaqui) ? '%' : "%{$establecimientoMaqui}%";
			$dirEstablecimientoMaqui = is_null($dirEstablecimientoMaqui) ? '%' : "%{$dirEstablecimientoMaqui}%";
			$nroInforme = is_null($nroInforme) ? '%' : "%{$nroInforme}%";
			$tipoestado = (empty($tipoestado)) ? [] : $tipoestado;
			$peligro = empty($peligro) ? '%' : $peligro;
			$sevalprod = is_null($sevalprod) ? '0' : $sevalprod;
			$filtro_calificacion = is_null($filtro_calificacion) ? [] : $filtro_calificacion;

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

			$calificacion = clearLabel($filtro_calificacion, false);
			$tipoestado = clearLabel($tipoestado, false);
			$careacliente = clearLabel($careacliente, false);

			$inspecciones = $this->mcons_insp->buscarInspecciones(
				$ccia,
				$area,
				$cservicio,
				$ccliente,
				$cclienteprov,
				$cclientemaquila,
				$careacliente,
				$establecimientoMaqui,
				$dirEstablecimientoMaqui,
				$nroInforme,
				$tipoestado,
				$fini,
				$ffin,
				$peligro,
				$sevalprod,
				$calificacion
			);

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
				->setCellValue('B2', 'RUC')
				->setCellValue('C2', 'Proveedor')
				->setCellValue('D2', 'Establecimiento / Maquilador')
				->setCellValue('E2', 'Dirección Establecimiento / Maquilador')
				->setCellValue('F2', 'Área Cliente')
				->setCellValue('G2', 'Línea')
				->setCellValue('H2', 'Tipo Estado Servicio')
				->setCellValue('I2', 'Comentario')
				->setCellValue('J2', 'Nro de Informe')
				->setCellValue('K2', 'Calificación')
				->setCellValue('L2', 'Acción Correctiva')
				->setCellValue('M2', 'Consultor')
				->setCellValue('N2', 'Certificación')
				->setCellValue('O2', 'Estado Certificación')
				->setCellValue('P2', 'Licencia de Funcionamiento')
				->setCellValue('Q2', 'Empresa Inspectora')
				->setCellValue('R2', 'Eval. Prod.')
				->setCellValue('S2', 'Es Peligro');

			if (!empty($inspecciones)) {
				$pos = 3;
				foreach ($inspecciones as $key => $value) {
					$sheet->setCellValue('A' . $pos, \Carbon\Carbon::createFromFormat('Y-m-d', $value->FECHAINSPECCION)->format('d/m/Y'));
					$sheet->setCellValue('B' . $pos, $value->nruc);
					$sheet->setCellValue('C' . $pos, $value->PROVEEDOR);
					$establecimiento = (!empty($value->DIRECCIONPROV)) ? $value->DIRECCIONPROV . ' - ' . $value->MAQUILADOR : $value->MAQUILADOR;
					$sheet->setCellValue('D' . $pos, $establecimiento);
					$direccion = (!empty($value->DIRECCIONPROV)) ? $value->DIRECCIONPROV . ' ' . $value->UBIGEOPROV : $value->DIRECCIONMAQUILA . ' ' . $value->UBIGEOMAQUILA;
					$sheet->setCellValue('E' . $pos, $direccion);
					$sheet->setCellValue('F' . $pos, $value->AREACLIENTE);
					$sheet->setCellValue('G' . $pos, $value->LINEA);
					$sheet->setCellValue('H' . $pos, $value->TIPOESTADOSERVICIO);
					$sheet->setCellValue('I' . $pos, $value->COMENTARIO);
					$sheet->setCellValue('J' . $pos, $value->dinformefinal);
					$RESULTADOCHECKLIST = (!empty($value->RESULTADOCHECKLIST)) ? $value->RESULTADOCHECKLIST . '%' : '';
					$RESULTADOTEXTO = (!empty($value->RESULTADOTEXTO)) ? $value->RESULTADOTEXTO : '';
					$sheet->setCellValue('K' . $pos, $RESULTADOCHECKLIST . ' ' . $RESULTADOTEXTO);
					$sheet->setCellValue('L' . $pos, $value->ACCIONCORRECTIVA);
					$sheet->setCellValue('M' . $pos, $value->CONSULTOR);
					$CERTIFICADORA = (!empty($value->CERTIFICADORA)) ? $value->CERTIFICADORA : '';
					$CERTIFICACION = (!empty($value->CERTIFICACION)) ? $value->CERTIFICACION : '';
					$certificacion = '';
					if ($CERTIFICADORA || $CERTIFICACION) {
						$certificacion = $CERTIFICADORA . ' ' . $CERTIFICACION;
					} else {
						$tipoEstado = mb_strtolower(trim($value->TIPOESTADOSERVICIO), 'utf-8');
						$EMPRESAINSPECTORA = mb_strtolower(trim($value->EMPRESAINSPECTORA), 'utf-8');
						if ($tipoEstado === 'convalidado' && (
								$EMPRESAINSPECTORA === 'digemid' ||
								$EMPRESAINSPECTORA === 'senasa' ||
								$EMPRESAINSPECTORA === 'digesa' ||
								$EMPRESAINSPECTORA === 'sanipes'
							)) {
							$certificacion = $value->EMPRESAINSPECTORA;
						}
					}
					$sheet->setCellValue('N' . $pos, $certificacion);
					$sheet->setCellValue('O' . $pos, $value->SCERTIFICACION);
					$LICENCIADEFUNCIONAMIENTO = (!empty($value->LICENCIADEFUNCIONAMIENTO)) ? $value->LICENCIADEFUNCIONAMIENTO : '';
					$ESTADOLICENCIADEFUNCIONAMIENTO = (!empty($value->ESTADOLICENCIADEFUNCIONAMIENTO)) ? $value->ESTADOLICENCIADEFUNCIONAMIENTO : '';
					$sheet->setCellValue('P' . $pos, $ESTADOLICENCIADEFUNCIONAMIENTO . ' ' . $LICENCIADEFUNCIONAMIENTO);
					$sheet->setCellValue('Q' . $pos, $value->EMPRESAINSPECTORA);
					$sheet->setCellValue('R' . $pos, $value->SEVALPROD);
					$sheet->setCellValue('S' . $pos, $value->espeligro);
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
