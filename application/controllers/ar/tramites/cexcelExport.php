<?php
defined('BASEPATH') or exit('No direct script access allowed');

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
 * Class CexcelExport
 *
 * @property mclientereportes mclientereportes
 */
class CexcelExport extends FS_Controller
{
	function __construct()
	{
		parent:: __construct();
		$this->load->model('ar/tramites/mconstramdigesa');
		$this->load->model('ar/tramites/mbusctramdigemid', 'mconstramdigemid');
		$this->load->model('ar/evalprod/mclientereportes', 'mclientereportes');
	}

	public function exceltramardigesa()
	{
		/*Estilos */
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
			'alignment' => [
				'horizontal' => Alignment::HORIZONTAL_CENTER,
				'vertical' => Alignment::VERTICAL_CENTER,
				'wrapText' => true,
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
		$celdastexto = [
			'borders' => [
				'allBorders' => [
					'borderStyle' => Border::BORDER_THIN,
					'color' => [
						'rgb' => '000000'
					]
				]
			],
			'alignment' => [
				'horizontal' => Alignment::HORIZONTAL_LEFT,
				'vertical' => Alignment::VERTICAL_CENTER,
				'wrapText' => true,
			],
		];
		/*Estilos */

		$spreadsheet = new Spreadsheet();
		$sheet = $spreadsheet->getActiveSheet();
		$sheet->setTitle('Listado - Tramites');

		$spreadsheet->getDefaultStyle()
			->getFont()
			->setName('Arial')
			->setSize(9);

		$sheet->setCellValue('A1', 'LISTADO DE TRAMITES AR')
			->mergeCells('A1:R1')
			->setCellValue('A2', 'CLIENTE:')
			->mergeCells('B2:D2')
			->setCellValue('A4', 'CÓDIGO')
			->setCellValue('B4', 'DESCRIPCIÓN SAP')
			->setCellValue('C4', 'NOMBRE DEL PRODUCTO')
			->setCellValue('D4', 'MARCA')
			->setCellValue('E4', 'CATEGORIA')
			->setCellValue('F4', 'PRESENTACIÓN')
			->setCellValue('G4', 'MODELO')
			->setCellValue('H4', 'FABRICANTE(S)')
			->setCellValue('I4', 'PAIS(ES)')
			->setCellValue('J4', 'FECHA INGRESO')
			->setCellValue('K4', 'TRÁMITE')
			->setCellValue('L4', 'ESTADO')
			->setCellValue('M4', 'N° EXPEDIENTE')
			->setCellValue('N4', 'RS')
			->setCellValue('O4', 'NRO DR')
			->setCellValue('P4', 'FECHA EMISIÓN')
			->setCellValue('Q4', 'FECHA VENCIMIENTO')
			->setCellValue('R4', 'ACTIVO/ INACTIVO');

		$sheet->getStyle('A1:R1')->applyFromArray($titulo);
		$sheet->getStyle('A4:R4')->applyFromArray($cabecera);

		$sheet->getColumnDimension('A')->setAutoSize(false)->setWidth(12.10);
		$sheet->getColumnDimension('B')->setAutoSize(false)->setWidth(32.10);
		$sheet->getColumnDimension('C')->setAutoSize(false)->setWidth(55.10);
		$sheet->getColumnDimension('D')->setAutoSize(false)->setWidth(32.10);
		$sheet->getColumnDimension('E')->setAutoSize(false)->setWidth(22.10);
		$sheet->getColumnDimension('F')->setAutoSize(false)->setWidth(55.10);
		$sheet->getColumnDimension('G')->setAutoSize(false)->setWidth(55.10);
		$sheet->getColumnDimension('H')->setAutoSize(false)->setWidth(32.10);
		$sheet->getColumnDimension('I')->setAutoSize(false)->setWidth(22.10);
		$sheet->getColumnDimension('J')->setAutoSize(false)->setWidth(15.10);
		$sheet->getColumnDimension('K')->setAutoSize(false)->setWidth(32.10);
		$sheet->getColumnDimension('L')->setAutoSize(false)->setWidth(12.10);
		$sheet->getColumnDimension('M')->setAutoSize(false)->setWidth(22.10);
		$sheet->getColumnDimension('N')->setAutoSize(false)->setWidth(22.10);
		$sheet->getColumnDimension('O')->setAutoSize(false)->setWidth(18.10);
		$sheet->getColumnDimension('P')->setAutoSize(false)->setWidth(15.10);
		$sheet->getColumnDimension('Q')->setAutoSize(false)->setWidth(15.10);
		$sheet->getColumnDimension('R')->setAutoSize(false)->setWidth(12.10);

		$varnull = '';

		$codprod = ($this->input->post('txtcodprodu') == $varnull) ? '%' : '%' . $this->input->post('txtcodprodu') . '%';
		$nomprod = ($this->input->post('txtdescprodu') == $varnull) ? '%' : '%' . $this->input->post('txtdescprodu') . '%';
		$regsan = ($this->input->post('txtnrors') == $varnull) ? '%' : '%' . $this->input->post('txtnrors') . '%';
		$tono = ($this->input->post('txtcaractprodu') == $varnull) ? '%' : '%' . $this->input->post('txtcaractprodu') . '%';
		$estado = ($this->input->post('cboesttramite') == $varnull) ? '%' : '%' . $this->input->post('cboesttramite') . '%';
		$marca = ($this->input->post('cbomarca') == $varnull) ? '%' : '%' . $this->input->post('cbomarca') . '%';
		$allf = $this->input->post('chkFreg');
		$fini = $this->input->post('txtFIni');
		$ffin = $this->input->post('txtFFin');
		$ccliente = ($this->input->post('hdnccliente') == $varnull) ? $this->input->post('cbocliente') : $this->input->post('hdnccliente');
		$numexpdiente = ($this->input->post('txtnroexpe') == $varnull) ? '%' : '%' . $this->input->post('txtnroexpe') . '%';
		$ccategoria = '%';
		$est = ($this->input->post('cboestproducto') == $varnull) ? '%' : '%' . $this->input->post('cboestproducto') . '%';
		$tipoest = $this->input->post('restado');
		$tiporeporte = 'E';
		$iln = '%';


		if ($allf == 'on') {
			$CFECHA = 'N';
		} else {
			$CFECHA = 'S';
		}


		$parametros = array(
			'@codprod' => $codprod,
			'@nomprod' => $nomprod,
			'@regsan' => $regsan,
			'@tono' => $tono,
			'@estado' => $estado,
			'@marca' => $marca,
			'@tramite' => '%001%',
			'@allf' => $CFECHA,
			'@fi' => substr($fini, 6, 4) . '-' . substr($fini, 3, 2) . '-' . substr($fini, 0, 2),
			'@ff' => substr($ffin, 6, 4) . '-' . substr($ffin, 3, 2) . '-' . substr($ffin, 0, 2),
			'@ccliente' => $ccliente,
			'@numexpdiente' => $numexpdiente,
			'@ccategoria' => $ccategoria,
			'@est' => $est,
			'@tipoest' => $tipoest,
			'@TIPOREPORTE' => $tiporeporte,
			'@iln' => $iln
		);

		$rpt = $this->mconstramdigesa->getconsulta_excel_tr($parametros);
		$irow = 5;
		if ($rpt) {
			foreach ($rpt as $row) {

				$CLIENTE = $row->CLIENTE;
				$CODIGOPROD = $row->CODIGOPROD;
				$DES_SAP = $row->DES_SAP;
				$NOMBREPROD = $row->NOMBREPROD;
				$MARCAPROD = $row->MARCAPROD;
				$DCATEGORIACLIENTE = $row->DCATEGORIACLIENTE;
				$DPRESENTACION = $row->DPRESENTACION;
				$TONOPROD = $row->TONOPROD;
				$FABRIPROD = $row->FABRIPROD;
				$PAISPROD = $row->PAISPROD;
				$tcreacion = $row->tcreacion;
				$TRAMITEPROD = $row->TRAMITEPROD;
				$ESTADO = $row->ESTADO;
				$NUMEXP = $row->NUMEXP;
				$REGSANIPROD = $row->REGSANIPROD;
				$DNUMERODR = $row->DNUMERODR;
				$FEMI = $row->FEMI;
				$FECHAVENCE = $row->FECHAVENCE;
				$SREGISTROPDTO = $row->SREGISTROPDTO;

				$sheet->setCellValue('A' . $irow, $CODIGOPROD);
				$sheet->setCellValue('B' . $irow, $DES_SAP);
				$sheet->setCellValue('C' . $irow, $NOMBREPROD);
				$sheet->setCellValue('D' . $irow, $MARCAPROD);
				$sheet->setCellValue('E' . $irow, $DCATEGORIACLIENTE);
				$sheet->setCellValue('F' . $irow, $DPRESENTACION);
				$sheet->setCellValue('G' . $irow, $TONOPROD);
				$sheet->setCellValue('H' . $irow, $FABRIPROD);
				$sheet->setCellValue('I' . $irow, $PAISPROD);
				$sheet->setCellValue('J' . $irow, $tcreacion);
				$sheet->setCellValue('K' . $irow, $TRAMITEPROD);
				$sheet->setCellValue('L' . $irow, $ESTADO);
				$sheet->setCellValue('M' . $irow, $NUMEXP);
				$sheet->setCellValue('N' . $irow, $REGSANIPROD);
				$sheet->setCellValue('O' . $irow, $DNUMERODR);
				$sheet->setCellValue('P' . $irow, $FEMI);
				$sheet->setCellValue('Q' . $irow, $FECHAVENCE);
				$sheet->setCellValue('R' . $irow, $SREGISTROPDTO);

				$irow++;
			}
		}
		$sheet->setCellValue('B2', $CLIENTE);
		$pos = $irow - 1;

		$sheet->getStyle('A5:R' . $pos)->applyFromArray($celdastexto);

		$sheet->setAutoFilter('A4:R' . $pos);

		$writer = new Xlsx($spreadsheet);
		$filename = 'Report';
		ob_end_clean();
		header('Content-Type: application/vnd.ms-excel');
		header('Content-Disposition: attachment;filename="' . $filename . '.xlsx"');
		header('Cache-Control: max-age=0');

		$writer->save('php://output');
	}

	public function exceltramardigemid()
	{
		/*Estilos */
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
			'alignment' => [
				'horizontal' => Alignment::HORIZONTAL_CENTER,
				'vertical' => Alignment::VERTICAL_CENTER,
				'wrapText' => true,
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
		$celdastexto = [
			'borders' => [
				'allBorders' => [
					'borderStyle' => Border::BORDER_THIN,
					'color' => [
						'rgb' => '000000'
					]
				]
			],
			'alignment' => [
				'horizontal' => Alignment::HORIZONTAL_LEFT,
				'vertical' => Alignment::VERTICAL_CENTER,
				'wrapText' => true,
			],
		];
		/*Estilos */

		$spreadsheet = new Spreadsheet();
		$sheet = $spreadsheet->getActiveSheet();
		$sheet->setTitle('Listado - Tramites');

		$spreadsheet->getDefaultStyle()
			->getFont()
			->setName('Arial')
			->setSize(9);

		$sheet->setCellValue('A1', 'LISTADO DE TRAMITES AR')
			->mergeCells('A1:R1')
			->setCellValue('A2', 'CLIENTE:')
			->mergeCells('B2:D2')
			->setCellValue('A4', 'CÓDIGO')
			->setCellValue('B4', 'DESCRIPCIÓN SAP')
			->setCellValue('C4', 'NOMBRE DEL PRODUCTO')
			->setCellValue('D4', 'MARCA')
			->setCellValue('E4', 'CATEGORIA')
			->setCellValue('F4', 'PRESENTACIÓN')
			->setCellValue('G4', 'MODELO')
			->setCellValue('H4', 'FABRICANTE(S)')
			->setCellValue('I4', 'PAIS(ES)')
			->setCellValue('J4', 'FECHA INGRESO')
			->setCellValue('K4', 'TRÁMITE')
			->setCellValue('L4', 'ESTADO')
			->setCellValue('M4', 'N° EXPEDIENTE')
			->setCellValue('N4', 'NSO')
			->setCellValue('O4', 'NRO DR')
			->setCellValue('P4', 'FECHA EMISIÓN')
			->setCellValue('Q4', 'FECHA VENCIMIENTO')
			->setCellValue('R4', 'ACTIVO/ INACTIVO');

		$sheet->getStyle('A1:R1')->applyFromArray($titulo);
		$sheet->getStyle('A4:R4')->applyFromArray($cabecera);

		$sheet->getColumnDimension('A')->setAutoSize(false)->setWidth(12.10);
		$sheet->getColumnDimension('B')->setAutoSize(false)->setWidth(32.10);
		$sheet->getColumnDimension('C')->setAutoSize(false)->setWidth(55.10);
		$sheet->getColumnDimension('D')->setAutoSize(false)->setWidth(32.10);
		$sheet->getColumnDimension('E')->setAutoSize(false)->setWidth(22.10);
		$sheet->getColumnDimension('F')->setAutoSize(false)->setWidth(55.10);
		$sheet->getColumnDimension('G')->setAutoSize(false)->setWidth(55.10);
		$sheet->getColumnDimension('H')->setAutoSize(false)->setWidth(32.10);
		$sheet->getColumnDimension('I')->setAutoSize(false)->setWidth(22.10);
		$sheet->getColumnDimension('J')->setAutoSize(false)->setWidth(15.10);
		$sheet->getColumnDimension('K')->setAutoSize(false)->setWidth(32.10);
		$sheet->getColumnDimension('L')->setAutoSize(false)->setWidth(12.10);
		$sheet->getColumnDimension('M')->setAutoSize(false)->setWidth(22.10);
		$sheet->getColumnDimension('N')->setAutoSize(false)->setWidth(22.10);
		$sheet->getColumnDimension('O')->setAutoSize(false)->setWidth(18.10);
		$sheet->getColumnDimension('P')->setAutoSize(false)->setWidth(15.10);
		$sheet->getColumnDimension('Q')->setAutoSize(false)->setWidth(15.10);
		$sheet->getColumnDimension('R')->setAutoSize(false)->setWidth(12.10);

		$varnull = '';

		$codprod = ($this->input->post('txtcodprodu') == $varnull) ? '%' : '%' . $this->input->post('txtcodprodu') . '%';
		$nomprod = ($this->input->post('txtdescprodu') == $varnull) ? '%' : '%' . $this->input->post('txtdescprodu') . '%';
		$regsan = ($this->input->post('txtnrors') == $varnull) ? '%' : '%' . $this->input->post('txtnrors') . '%';
		$tono = ($this->input->post('txtcaractprodu') == $varnull) ? '%' : '%' . $this->input->post('txtcaractprodu') . '%';
		$estado = ($this->input->post('cboesttramite') == $varnull) ? '%' : '%' . $this->input->post('cboesttramite') . '%';
		$marca = ($this->input->post('cbomarca') == $varnull) ? '%' : '%' . $this->input->post('cbomarca') . '%';
		$allf = $this->input->post('chkFreg');
		$fini = $this->input->post('txtFIni');
		$ffin = $this->input->post('txtFFin');
		$ccliente = ($this->input->post('hdnccliente') == $varnull) ? $this->input->post('cbocliente') : $this->input->post('hdnccliente');
		$numexpdiente = ($this->input->post('txtnroexpe') == $varnull) ? '%' : '%' . $this->input->post('txtnroexpe') . '%';
		$ccategoria = '%';
		$est = ($this->input->post('cboestproducto') == $varnull) ? '%' : '%' . $this->input->post('cboestproducto') . '%';
		$tipoest = $this->input->post('restado');
		$tiporeporte = 'E';
		$iln = '%';


		if ($allf == 'on') {
			$CFECHA = 'N';
		} else {
			$CFECHA = 'S';
		}


		$parametros = array(
			'@codprod' => $codprod,
			'@nomprod' => $nomprod,
			'@regsan' => $regsan,
			'@tono' => $tono,
			'@estado' => $estado,
			'@marca' => $marca,
			'@tramite' => '%002%',
			'@allf' => $CFECHA,
			'@fi' => substr($fini, 6, 4) . '-' . substr($fini, 3, 2) . '-' . substr($fini, 0, 2),
			'@ff' => substr($ffin, 6, 4) . '-' . substr($ffin, 3, 2) . '-' . substr($ffin, 0, 2),
			'@ccliente' => $ccliente,
			'@numexpdiente' => $numexpdiente,
			'@ccategoria' => $ccategoria,
			'@est' => $est,
			'@tipoest' => $tipoest,
			'@TIPOREPORTE' => $tiporeporte,
			'@iln' => $iln
		);

		$rpt = $this->mconstramdigemid->getconsulta_excel_tr($parametros);
		$irow = 5;
		if ($rpt) {
			foreach ($rpt as $row) {

				$CLIENTE = $row->CLIENTE;
				$CODIGOPROD = $row->CODIGOPROD;
				$DES_SAP = $row->DES_SAP;
				$NOMBREPROD = $row->NOMBREPROD;
				$MARCAPROD = $row->MARCAPROD;
				$DCATEGORIACLIENTE = $row->DCATEGORIACLIENTE;
				$DPRESENTACION = $row->DPRESENTACION;
				$TONOPROD = $row->TONOPROD;
				$FABRIPROD = $row->FABRIPROD;
				$PAISPROD = $row->PAISPROD;
				$tcreacion = $row->tcreacion;
				$TRAMITEPROD = $row->TRAMITEPROD;
				$ESTADO = $row->ESTADO;
				$NUMEXP = $row->NUMEXP;
				$REGSANIPROD = $row->REGSANIPROD;
				$DNUMERODR = $row->DNUMERODR;
				$FEMI = $row->FEMI;
				$FECHAVENCE = $row->FECHAVENCE;
				$SREGISTROPDTO = $row->SREGISTROPDTO;

				$sheet->setCellValue('A' . $irow, $CODIGOPROD);
				$sheet->setCellValue('B' . $irow, $DES_SAP);
				$sheet->setCellValue('C' . $irow, $NOMBREPROD);
				$sheet->setCellValue('D' . $irow, $MARCAPROD);
				$sheet->setCellValue('E' . $irow, $DCATEGORIACLIENTE);
				$sheet->setCellValue('F' . $irow, $DPRESENTACION);
				$sheet->setCellValue('G' . $irow, $TONOPROD);
				$sheet->setCellValue('H' . $irow, $FABRIPROD);
				$sheet->setCellValue('I' . $irow, $PAISPROD);
				$sheet->setCellValue('J' . $irow, $tcreacion);
				$sheet->setCellValue('K' . $irow, $TRAMITEPROD);
				$sheet->setCellValue('L' . $irow, $ESTADO);
				$sheet->setCellValue('M' . $irow, $NUMEXP);
				$sheet->setCellValue('N' . $irow, $REGSANIPROD);
				$sheet->setCellValue('O' . $irow, $DNUMERODR);
				$sheet->setCellValue('P' . $irow, $FEMI);
				$sheet->setCellValue('Q' . $irow, $FECHAVENCE);
				$sheet->setCellValue('R' . $irow, $SREGISTROPDTO);

				$irow++;
			}
		}
		$sheet->setCellValue('B2', $CLIENTE);
		$pos = $irow - 1;

		$sheet->getStyle('A5:R' . $pos)->applyFromArray($celdastexto);

		$sheet->setAutoFilter('A4:R' . $pos);

		$writer = new Xlsx($spreadsheet);
		$filename = 'Report';
		ob_end_clean();
		header('Content-Type: application/vnd.ms-excel');
		header('Content-Disposition: attachment;filename="' . $filename . '.xlsx"');
		header('Cache-Control: max-age=0');

		$writer->save('php://output');
	}

	public function exportar_registros_evalprod()
	{
		if (!$this->input->is_ajax_request()) {
			show_404();
		}
		try {

			$varnull = '';

			$eanmultiple = $this->input->post('eanmultiple');
			$stringEAN = preg_replace("/[\r\n|\n|\r]+/", ",", trim($eanmultiple));

			$skumultiple = $this->input->post('skumultiple');
			$stringSKU = preg_replace("/[\r\n|\n|\r]+/", ",", trim($skumultiple));

			$fini = $this->input->post('fini');
			$ffin = $this->input->post('ffin');

			$parametros = array(
				'@ccliente' => $this->input->post('ccliente'),
				'@fini' => ($this->input->post('fini') == '%') ? NULL : substr($fini, 6, 4) . '-' . substr($fini, 3, 2) . '-' . substr($fini, 0, 2),
				'@ffin' => ($this->input->post('ffin') == '%') ? NULL : substr($ffin, 6, 4) . '-' . substr($ffin, 3, 2) . '-' . substr($ffin, 0, 2),
				'@id_area' => $this->input->post('id_area'),
				'@status' => $this->input->post('status'),
				'@proveedor_nuevo' => $this->input->post('proveedor_nuevo'),
				'@id_proveedor' => $this->input->post('id_proveedor'),
				'@expediente' => ($this->input->post('expediente') == $varnull) ? '%' : '%' . $this->input->post('expediente') . '%',
				'@rs' => ($this->input->post('rs') == $varnull) ? '%' : '%' . $this->input->post('rs') . '%',
				'@codigo' => ($this->input->post('codigo') == $varnull) ? '%' : '%' . $this->input->post('codigo') . '%',
				'@marca' => ($this->input->post('marca') == $varnull) ? '%' : '%' . $this->input->post('marca') . '%',
				'@descripcion' => ($this->input->post('descripcion') == $varnull) ? '%' : '%' . $this->input->post('descripcion') . '%',
				'@fabricante' => ($this->input->post('fabricante') == $varnull) ? '%' : '%' . $this->input->post('fabricante') . '%',
				'@eanmultiple' => (ltrim($stringEAN) == $varnull) ? '-' : $stringEAN,
				'@skumultiple' => (ltrim($stringSKU) == $varnull) ? '-' : $stringSKU,
			);
			$resultado = $this->mclientereportes->getvistageneral($parametros);

			$spreadsheet = new Spreadsheet();
			$sheet = $spreadsheet->getActiveSheet();
			$sheet->setTitle('Evaluación de productos');

			$spreadsheet->getDefaultStyle()
				->getFont()
				->setName('Arial')
				->setSize(10);

			$sheet->setCellValue('A1', 'LISTA DE EVALUACIÓN DE PRODUCTOS')
				->mergeCells('A1:AN1');

			$sheet->setCellValue('A2', 'NRO DE EXPEDIENTE')
				->setCellValue('B2', 'FECHA DE INGRESO')
				->setCellValue('C2', 'FECHA DE EVALUADO')
				->setCellValue('D2', 'FECHA LEV. OBS')
				->setCellValue('E2', 'AREA')
				->setCellValue('F2', 'EAN/GTIN')
				->setCellValue('G2', 'SKU')
				->setCellValue('H2', 'PRODUCTO')
				->setCellValue('I2', 'FABRICANTE')
				->setCellValue('J2', 'PROVEEDOR')
				->setCellValue('K2', 'COD. R.S./NSO/RD')
				->setCellValue('L2', 'FECHA DE EMISIÓN DE R.S./N.S.O./A.S.')
				->setCellValue('M2', 'FECHA VENC. R.S./ N.S.O./ A.S.')
				->setCellValue('N2', 'LIC. DE FUNCION.')
				->setCellValue('O2', 'PAIS PROCEDENCIA')
				->setCellValue('P2', 'FEC. VENC.')
				->setCellValue('Q2', 'COD. O LOTE PROD.')
				->setCellValue('R2', 'LISTA DE INGRED.')
				->setCellValue('S2', 'COND. DE CONS. DEL PRODUCTO')
				->setCellValue('T2', 'CONDICIONES DE CONSERVACION COMPLETA (TRANSPORTE, ALMACENAMIENTO, PRODUCTO)')
				->setCellValue('U2', 'CONDICIONES DE CONSERVACION DEL PRODUCTO')
				->setCellValue('V2', 'CONT. NETO')
				->setCellValue('W2', 'NUM. RUC')
				->setCellValue('X2', 'DIRECCION IMPORTAD.')
				->setCellValue('Y2', 'TIEMPO DE VIDA UTIL')
				->setCellValue('Z2', 'FECHA INSPECCION HIGIENICO SANITARIA')
				->setCellValue('AA2', 'ENTIDAD')
				->setCellValue('AB2', 'RESPONSABLE')
				->setCellValue('AC2', 'FECHA')
				->setCellValue('AD2', 'STATUS')
				->setCellValue('AE2', 'AGOTAMIENTO DE STOCK')
				->setCellValue('AF2', 'FECHA VENCIMIENTO AGOTAMIENTO DE STOCK')
				->setCellValue('AG2', 'DOCUMENTACION PENDIENTE')
				->setCellValue('AH2', 'OBSERVADO X LICENCIA')
				->setCellValue('AI2', 'OBS. X T. NUTR.')
				->setCellValue('AJ2', 'GRASAS SATURADAS')
				->setCellValue('AK2', 'AZÚCAR')
				->setCellValue('AL2', 'SODIO')
				->setCellValue('AM2', 'GRASAS TRANS')
				->setCellValue('AN2', 'OBSERVACIONES');

			if (!empty($resultado)) {
				$pos = 3;
				foreach ($resultado as $key => $value) {
					$sheet->setCellValue('A' . $pos, $value->expediente);
					$sheet->setCellValue('B' . $pos, $value->fecha);
					$sheet->setCellValue('C' . $pos, $value->f_evaluado);
					$sheet->setCellValue('D' . $pos, $value->f_levantamiento);
					$sheet->setCellValue('E' . $pos, $value->area);
					$sheet->setCellValue('F' . $pos, $value->codigo);
					$sheet->setCellValue('G' . $pos, $value->codsku);
					$sheet->setCellValue('H' . $pos, $value->producto);
					$sheet->setCellValue('I' . $pos, $value->fabricante);
					$sheet->setCellValue('J' . $pos, $value->proveedor);
					$sheet->setCellValue('K' . $pos, $value->rs);
					$sheet->setCellValue('L' . $pos, $value->fecha_emision);
					$sheet->setCellValue('M' . $pos, $value->fecha_vcto);
					$sheet->setCellValue('N' . $pos, $value->c_f);
					$sheet->setCellValue('O' . $pos, $value->pais);
					$sheet->setCellValue('P' . $pos, $value->f_v);
					$sheet->setCellValue('Q' . $pos, $value->c_l_p);
					$sheet->setCellValue('R' . $pos, $value->l_i);
					$sheet->setCellValue('S' . $pos, $value->c_c_p);
					$sheet->setCellValue('T' . $pos, $value->c_c);
					$sheet->setCellValue('U' . $pos, $value->c_c_r);
					$sheet->setCellValue('V' . $pos, $value->c_n);
					$sheet->setCellValue('W' . $pos, $value->n_r);
					$sheet->setCellValue('X' . $pos, $value->d_i);
					$sheet->setCellValue('Y' . $pos, $value->t_v_u);
					$sheet->setCellValue('Z' . $pos, $value->f_i_h);
					$sheet->setCellValue('AA' . $pos, $value->entidad);
					$sheet->setCellValue('AB' . $pos, $value->responsable);
					$sheet->setCellValue('AC' . $pos, $value->fecha);
					$sheet->setCellValue('AD' . $pos, $value->status);
					$sheet->setCellValue('AE' . $pos, $value->a_s);
					$sheet->setCellValue('AF' . $pos, $value->f_a_v_s);
					$sheet->setCellValue('AG' . $pos, $value->d_p);
					$sheet->setCellValue('AH' . $pos, $value->o_l);
					$sheet->setCellValue('AI' . $pos, $value->o_n);
					$sheet->setCellValue('AJ' . $pos, $value->grasas_saturadas);
					$sheet->setCellValue('AK' . $pos, $value->azucar);
					$sheet->setCellValue('AL' . $pos, $value->sodio);
					$sheet->setCellValue('AM' . $pos, $value->grasas_trans);
					$sheet->setCellValue('AN' . $pos, $value->observacion_cli);
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
				'alignment' => [
					'horizontal' => Alignment::HORIZONTAL_CENTER,
					'vertical' => Alignment::VERTICAL_CENTER,
					'wrapText' => true,
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
			$sheet->getStyle('A1:AN1')->applyFromArray($titulo);
			$sheet->getStyle('A2:AN2')->applyFromArray($cabecera);

			foreach (range('A', 'AN') as $column) {
				$sheet->getColumnDimension($column)->setAutoSize(true);
			}

			$writer = new Xlsx($spreadsheet);
			$filename = 'evaluacion_producto_' . date('Ymd') . '.xlsx';
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

	/**
	 * Realiza la descarga del archivo
	 */
	public function download()
	{
		$fileName = $this->input->get('filename');
		$this->load->helper('download');
		$pathFile = RUTA_ARCHIVOS . '../../temp/' . $fileName;
		if (!file_exists($pathFile)) {
			show_404();
		}
		force_download($pathFile, null, false, true);
	}

}

?>
