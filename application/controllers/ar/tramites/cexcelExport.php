<?php
defined('BASEPATH') OR exit('No direct script access allowed');

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

class CexcelExport extends CI_Controller {
	function __construct() {
		parent:: __construct();
		$this->load->model('ar/tramites/mconstramdigesa');
		$this->load->model('ar/tramites/mconsregporvencer');
		$this->load->model('ar/tramites/mbusctramdigemid', 'mconstramdigemid');
		$this->load->model('ar/evalprod/mclientereportes', 'mclientereportes');
		$this->load->model('ar/evalprod/mexpediente', 'mexpediente');
	}

	public function viewtramite() { // COCINADOR-SECADOR-HORNO
		$this->layout->js(array(public_url('script/ar/tramitedigesa/constramdigesa.js')));
		$data['content_for_layout'] = 'ar/tramitedigesa/vconstramdigesa';
		$this->parser->parse('seguridad/vprincipalClie',$data);
	}

	public function exceltramardigesa() {
		/*Estilos */
		$titulo = [
			'font'	=> [
				'name' => 'Arial',
				'size' =>12,
				'color' => array('rgb' => 'FFFFFF'),
				'bold' => true,
			],
			'fill'	=>[
				'fillType' => Fill::FILL_SOLID,
				'startColor' => [
					'rgb' => '29B037'
				]
			],
			'borders'	=>[
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
			'font'	=> [
				'name' => 'Arial',
				'size' =>10,
				'color' => array('rgb' => 'FFFFFF'),
				'bold' => true,
			],
			'fill'	=>[
				'fillType' => Fill::FILL_SOLID,
				'startColor' => [
					'rgb' => '29B037'
				]
			],
			'borders'	=>[
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
			'borders'	=>[
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

		$codprod = 		($this->input->post('txtcodprodu') == $varnull) ? '%' : '%'.$this->input->post('txtcodprodu').'%';
		$nomprod = 		($this->input->post('txtdescprodu') == $varnull) ? '%' : '%'.$this->input->post('txtdescprodu').'%';
		$regsan = 		($this->input->post('txtnrors') == $varnull) ? '%' : '%'.$this->input->post('txtnrors').'%';
		$tono = 		($this->input->post('txtcaractprodu') == $varnull) ? '%' : '%'.$this->input->post('txtcaractprodu').'%';
		$estado = 		($this->input->post('cboesttramite') == $varnull) ? '%' : '%'.$this->input->post('cboesttramite').'%';
		$marca = 		($this->input->post('cbomarca') == $varnull) ? '%' : '%'.$this->input->post('cbomarca').'%';
		$allf = 		$this->input->post('chkFreg');
		$fini = 		$this->input->post('txtFIni');
		$ffin = 		$this->input->post('txtFFin');
		$ccliente = 	($this->input->post('hdnccliente') == $varnull) ? $this->input->post('cbocliente') : $this->input->post('hdnccliente');
		$numexpdiente = ($this->input->post('txtnroexpe') == $varnull) ? '%' : '%'.$this->input->post('txtnroexpe').'%';
		$ccategoria = 	'%';
		$est = 			($this->input->post('cboestproducto') == $varnull) ? '%' : '%'.$this->input->post('cboestproducto').'%';
		$tipoest = 		$this->input->post('restado');
		$tiporeporte = 	'E';
		$iln = 		    '%';


		if($allf == 'on'){
			$CFECHA = 'N';
		}else{
			$CFECHA = 'S';
		}


		$parametros = array(
			'@codprod' 		=>	$codprod,
			'@nomprod' 		=>  $nomprod,
			'@regsan' 		=>  $regsan,
			'@tono' 		=>  $tono,
			'@estado'		=>  $estado,
			'@marca' 		=>  $marca,
			'@tramite' 		=>  '%001%',
			'@allf' 		=>  $CFECHA,
			'@fi' 			=>  substr($fini, 6, 4).'-'.substr($fini,3 , 2).'-'.substr($fini, 0, 2),
			'@ff' 			=>  substr($ffin, 6, 4).'-'.substr($ffin,3 , 2).'-'.substr($ffin, 0, 2),
			'@ccliente' 	=>  $ccliente,
			'@numexpdiente' =>  $numexpdiente,
			'@ccategoria' 	=>  $ccategoria,
			'@est' 			=>  $est,
			'@tipoest' 		=>  $tipoest,
			'@TIPOREPORTE'	=>	$tiporeporte,
			'@iln'			=>	$iln
		);

		$rpt = $this->mconstramdigesa->getconsulta_excel_tr($parametros);
		$irow = 5;
		if ($rpt){
			foreach($rpt as $row){

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

				$sheet->setCellValue('A'.$irow,$CODIGOPROD);
				$sheet->setCellValue('B'.$irow,$DES_SAP);
				$sheet->setCellValue('C'.$irow,$NOMBREPROD);
				$sheet->setCellValue('D'.$irow,$MARCAPROD);
				$sheet->setCellValue('E'.$irow,$DCATEGORIACLIENTE);
				$sheet->setCellValue('F'.$irow,$DPRESENTACION);
				$sheet->setCellValue('G'.$irow,$TONOPROD);
				$sheet->setCellValue('H'.$irow,$FABRIPROD);
				$sheet->setCellValue('I'.$irow,$PAISPROD);
				$sheet->setCellValue('J'.$irow,$tcreacion);
				$sheet->setCellValue('K'.$irow,$TRAMITEPROD);
				$sheet->setCellValue('L'.$irow,$ESTADO);
				$sheet->setCellValue('M'.$irow,$NUMEXP);
				$sheet->setCellValue('N'.$irow,$REGSANIPROD);
				$sheet->setCellValue('O'.$irow,$DNUMERODR);
				$sheet->setCellValue('P'.$irow,$FEMI);
				$sheet->setCellValue('Q'.$irow,$FECHAVENCE);
				$sheet->setCellValue('R'.$irow,$SREGISTROPDTO);

				$irow++;
			}
		}
		$sheet->setCellValue('B2',$CLIENTE);
		$pos = $irow - 1;

		$sheet->getStyle('A5:R'.$pos)->applyFromArray($celdastexto);

		$sheet->setAutoFilter('A4:R'.$pos);

		$writer = new Xlsx($spreadsheet);
		$filename = 'Report';
		ob_end_clean();
		header('Content-Type: application/vnd.ms-excel');
		header('Content-Disposition: attachment;filename="'.$filename.'.xlsx"');
		header('Cache-Control: max-age=0');

		$writer->save('php://output');
	}

	public function exceltramardigemid() {
		/*Estilos */
		$titulo = [
			'font'	=> [
				'name' => 'Arial',
				'size' =>12,
				'color' => array('rgb' => 'FFFFFF'),
				'bold' => true,
			],
			'fill'	=>[
				'fillType' => Fill::FILL_SOLID,
				'startColor' => [
					'rgb' => '29B037'
				]
			],
			'borders'	=>[
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
			'font'	=> [
				'name' => 'Arial',
				'size' =>10,
				'color' => array('rgb' => 'FFFFFF'),
				'bold' => true,
			],
			'fill'	=>[
				'fillType' => Fill::FILL_SOLID,
				'startColor' => [
					'rgb' => '29B037'
				]
			],
			'borders'	=>[
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
			'borders'	=>[
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

		$codprod = 		($this->input->post('txtcodprodu') == $varnull) ? '%' : '%'.$this->input->post('txtcodprodu').'%';
		$nomprod = 		($this->input->post('txtdescprodu') == $varnull) ? '%' : '%'.$this->input->post('txtdescprodu').'%';
		$regsan = 		($this->input->post('txtnrors') == $varnull) ? '%' : '%'.$this->input->post('txtnrors').'%';
		$tono = 		($this->input->post('txtcaractprodu') == $varnull) ? '%' : '%'.$this->input->post('txtcaractprodu').'%';
		$estado = 		($this->input->post('cboesttramite') == $varnull) ? '%' : '%'.$this->input->post('cboesttramite').'%';
		$marca = 		($this->input->post('cbomarca') == $varnull) ? '%' : '%'.$this->input->post('cbomarca').'%';
		$allf = 		$this->input->post('chkFreg');
		$fini = 		$this->input->post('txtFIni');
		$ffin = 		$this->input->post('txtFFin');
		$ccliente = 	($this->input->post('hdnccliente') == $varnull) ? $this->input->post('cbocliente') : $this->input->post('hdnccliente');
		$numexpdiente = ($this->input->post('txtnroexpe') == $varnull) ? '%' : '%'.$this->input->post('txtnroexpe').'%';
		$ccategoria = 	'%';
		$est = 			($this->input->post('cboestproducto') == $varnull) ? '%' : '%'.$this->input->post('cboestproducto').'%';
		$tipoest = 		$this->input->post('restado');
		$tiporeporte = 	'E';
		$iln = 		    '%';


		if($allf == 'on'){
			$CFECHA = 'N';
		}else{
			$CFECHA = 'S';
		}


		$parametros = array(
			'@codprod' 		=>	$codprod,
			'@nomprod' 		=>  $nomprod,
			'@regsan' 		=>  $regsan,
			'@tono' 		=>  $tono,
			'@estado'		=>  $estado,
			'@marca' 		=>  $marca,
			'@tramite' 		=>  '%002%',
			'@allf' 		=>  $CFECHA,
			'@fi' 			=>  substr($fini, 6, 4).'-'.substr($fini,3 , 2).'-'.substr($fini, 0, 2),
			'@ff' 			=>  substr($ffin, 6, 4).'-'.substr($ffin,3 , 2).'-'.substr($ffin, 0, 2),
			'@ccliente' 	=>  $ccliente,
			'@numexpdiente' =>  $numexpdiente,
			'@ccategoria' 	=>  $ccategoria,
			'@est' 			=>  $est,
			'@tipoest' 		=>  $tipoest,
			'@TIPOREPORTE'	=>	$tiporeporte,
			'@iln'			=>	$iln
		);

		$rpt = $this->mconstramdigemid->getconsulta_excel_tr($parametros);
		$irow = 5;
		if ($rpt){
			foreach($rpt as $row){

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

				$sheet->setCellValue('A'.$irow,$CODIGOPROD);
				$sheet->setCellValue('B'.$irow,$DES_SAP);
				$sheet->setCellValue('C'.$irow,$NOMBREPROD);
				$sheet->setCellValue('D'.$irow,$MARCAPROD);
				$sheet->setCellValue('E'.$irow,$DCATEGORIACLIENTE);
				$sheet->setCellValue('F'.$irow,$DPRESENTACION);
				$sheet->setCellValue('G'.$irow,$TONOPROD);
				$sheet->setCellValue('H'.$irow,$FABRIPROD);
				$sheet->setCellValue('I'.$irow,$PAISPROD);
				$sheet->setCellValue('J'.$irow,$tcreacion);
				$sheet->setCellValue('K'.$irow,$TRAMITEPROD);
				$sheet->setCellValue('L'.$irow,$ESTADO);
				$sheet->setCellValue('M'.$irow,$NUMEXP);
				$sheet->setCellValue('N'.$irow,$REGSANIPROD);
				$sheet->setCellValue('O'.$irow,$DNUMERODR);
				$sheet->setCellValue('P'.$irow,$FEMI);
				$sheet->setCellValue('Q'.$irow,$FECHAVENCE);
				$sheet->setCellValue('R'.$irow,$SREGISTROPDTO);

				$irow++;
			}
		}
		$sheet->setCellValue('B2',$CLIENTE);
		$pos = $irow - 1;

		$sheet->getStyle('A5:R'.$pos)->applyFromArray($celdastexto);

		$sheet->setAutoFilter('A4:R'.$pos);

		$writer = new Xlsx($spreadsheet);
		$filename = 'Report';
		ob_end_clean();
		header('Content-Type: application/vnd.ms-excel');
		header('Content-Disposition: attachment;filename="'.$filename.'.xlsx"');
		header('Cache-Control: max-age=0');

		$writer->save('php://output');
	}

	public function excelregporvencer() {
		/*Estilos */
		$titulo = [
			'font'	=> [
				'name' => 'Arial',
				'size' =>12,
				'color' => array('rgb' => 'FFFFFF'),
				'bold' => true,
			],
			'fill'	=>[
				'fillType' => Fill::FILL_SOLID,
				'startColor' => [
					'rgb' => '29B037'
				]
			],
			'borders'	=>[
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
			'font'	=> [
				'name' => 'Arial',
				'size' =>10,
				'color' => array('rgb' => 'FFFFFF'),
				'bold' => true,
			],
			'fill'	=>[
				'fillType' => Fill::FILL_SOLID,
				'startColor' => [
					'rgb' => '29B037'
				]
			],
			'borders'	=>[
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
			'borders'	=>[
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
		$sheet->setTitle('Listado - Registros por Vencer');

		$spreadsheet->getDefaultStyle()
			->getFont()
			->setName('Arial')
			->setSize(9);

		$sheet->setCellValue('A1', 'LISTADO DE REGISTROS POR VENCER')
			->mergeCells('A1:K1')
			->setCellValue('A2', 'CLIENTE:')
			->mergeCells('B2:D2')
			->setCellValue('A4', 'Nro')
			->setCellValue('B4', 'Código')
			->setCellValue('C4', 'Descripcion SAP')
			->setCellValue('D4', 'Nombre del Producto')
			->setCellValue('E4', 'Modelo / Tono / Variedades / Sub-Marca')
			->setCellValue('F4', 'Marca')
			->setCellValue('G4', 'Categoria')
			->setCellValue('H4', 'Fabricante(s)')
			->setCellValue('I4', 'País(es)')
			->setCellValue('J4', 'NSO')
			->setCellValue('K4', 'F. Vence');

		$sheet->getStyle('A1:K1')->applyFromArray($titulo);
		$sheet->getStyle('A4:K4')->applyFromArray($cabecera);

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

		$varnull = '';

		$ccliente       = $this->input->post('cbocliente');
		$descripcion    = $this->input->post('txtdescripcion');
		$porvencer    = $this->input->post('rporvencer');


		if($porvencer == '180'){
			$varporvencer = 180;
		}else{
			$varporvencer = 360;
		};


		$parametros = array(
			'@ccliente' 		=>	$ccliente,
			'@descripcion' 		=>  ($this->input->post('txtdescripcion') == '') ? '%' : '%'.$descripcion.'%',
			'@porvencer'		=> $varporvencer,
		);

		$rpt = $this->mconsregporvencer->getbuscarregporvencer($parametros);
		$irow = 5;
		$ipos = 1;
		if ($rpt){
			foreach($rpt as $row){

				$CLIENTE = $row->DRAZONSOCIAL;
				$CPRODUCTOCLIENTE = $row->CPRODUCTOCLIENTE;
				$DPRODUCTOCLIENTE = $row->DPRODUCTOCLIENTE;
				$DNOMBREPRODUCTO = $row->DNOMBREPRODUCTO;
				$DMODELOPRODUCTO = $row->DMODELOPRODUCTO;
				$DMARCA = $row->DMARCA;
				$DREGISTRO = $row->DREGISTRO;
				$FABRICANTES = $row->FABRICANTES;
				$PAISFABRICANTES = $row->PAISFABRICANTES;
				$DREGISTROSANITARIO = $row->DREGISTROSANITARIO;
				$FFINREGSANITARIO = $row->FFINREGSANITARIO;

				$sheet->setCellValue('A'.$irow,$ipos);
				$sheet->setCellValue('B'.$irow,$CPRODUCTOCLIENTE);
				$sheet->setCellValue('C'.$irow,$DPRODUCTOCLIENTE);
				$sheet->setCellValue('D'.$irow,$DNOMBREPRODUCTO);
				$sheet->setCellValue('E'.$irow,$DMODELOPRODUCTO);
				$sheet->setCellValue('F'.$irow,$DMARCA);
				$sheet->setCellValue('G'.$irow,$DREGISTRO);
				$sheet->setCellValue('H'.$irow,$FABRICANTES);
				$sheet->setCellValue('I'.$irow,$PAISFABRICANTES);
				$sheet->setCellValue('J'.$irow,$DREGISTROSANITARIO);
				$sheet->setCellValue('K'.$irow,$FFINREGSANITARIO);

				$ipos++;
				$irow++;
			}
		}
		$sheet->setCellValue('B2',$CLIENTE);
		$pos = $irow - 1;

		$sheet->getStyle('A5:K'.$pos)->applyFromArray($celdastexto);

		$sheet->setAutoFilter('A4:K'.$pos);

		$writer = new Xlsx($spreadsheet);
		$filename = 'Report';
		ob_end_clean();
		header('Content-Type: application/vnd.ms-excel');
		header('Content-Disposition: attachment;filename="'.$filename.'.xlsx"');
		header('Cache-Control: max-age=0');

		$writer->save('php://output');
	}

	public function exportar_registros_evalprod()
	{
		if (!$this->input->is_ajax_request()) {
			show_404();
		}
		try {

			$fdesde = $this->input->post('fdesde');
			$fhasta = $this->input->post('fhasta');
			$ccliente = $this->input->post('ccliente');
			$cproveedor = $this->input->post('cproveedor');
			$expedientes = $this->input->post('expediente');
			$mostrarVencidos = $this->input->post('mostrar_vencidos');
			$mostrarVencidos = (empty($mostrarVencidos)) ? 0 : $mostrarVencidos;

			$ccliente = (empty($ccliente)) ? '00005' : $ccliente;
			$fdesde = ($fdesde == '') ? null : substr($fdesde, 6, 4) . '-' . substr($fdesde, 3, 2) . '-' . substr($fdesde, 0, 2);
			$fhasta = ($fhasta == '') ? null : substr($fhasta, 6, 4) . '-' . substr($fhasta, 3, 2) . '-' . substr($fhasta, 0, 2);

			$parametros = array(
				'@ccliente' => $ccliente,
				'@cproveedor' => (empty($cproveedor)) ? 0 : $cproveedor,
				'@expediente' => (empty($expedientes)) ? '%' : "%{$expedientes}%",
				'@fdesde' => $fdesde,
				'@fhasta' => $fhasta,
			);
			$resultado = $this->mexpediente->lista($parametros);

			$spreadsheet = new Spreadsheet();
			$sheet = $spreadsheet->getActiveSheet();
			$sheet->setTitle('Registro de Expedientes');

			$spreadsheet->getDefaultStyle()
				->getFont()
				->setName('Arial')
				->setSize(10);

			$sheet->setCellValue('A1', 'LISTA DE EXPEDIENTES')
				->mergeCells('A1:AN1');

			$sheet->setCellValue('A2', 'EXPEDIENTE')
				->setCellValue('B2', 'PROVEEDOR')
				->setCellValue('C2', 'TOTAL')
				->setCellValue('D2', 'FECHA INGRESO')
				->setCellValue('E2', 'FECHA LIMITE')
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

	public function exportar_registros_exp()
	{
		if (!$this->input->is_ajax_request()) {
			show_404();
		}
		try {

			$fdesde = $this->input->post('fdesde');
			$fhasta = $this->input->post('fhasta');
			$ccliente = $this->input->post('ccliente');
			$cproveedor = $this->input->post('cproveedor');
			$expedientes = $this->input->post('expediente');
			$mostrarVencidos = $this->input->post('mostrar_vencidos');
			$mostrarVencidos = (empty($mostrarVencidos)) ? 0 : $mostrarVencidos;

			$ccliente = (empty($ccliente)) ? '00005' : $ccliente;
			$fdesde = ($fdesde == '') ? null : substr($fdesde, 6, 4) . '-' . substr($fdesde, 3, 2) . '-' . substr($fdesde, 0, 2);
			$fhasta = ($fhasta == '') ? null : substr($fhasta, 6, 4) . '-' . substr($fhasta, 3, 2) . '-' . substr($fhasta, 0, 2);

			$parametros = array(
				'@ccliente' => $ccliente,
				'@cproveedor' => (empty($cproveedor)) ? 0 : $cproveedor,
				'@expediente' => (empty($expedientes)) ? '%' : "%{$expedientes}%",
				'@fdesde' => $fdesde,
				'@fhasta' => $fhasta,
			);
			$resultado = $this->mexpediente->lista($parametros);

			$spreadsheet = new Spreadsheet();
			$sheet = $spreadsheet->getActiveSheet();
			$sheet->setTitle('Registro de Expedientes');

			$spreadsheet->getDefaultStyle()
				->getFont()
				->setName('Arial')
				->setSize(10);

			$sheet->setCellValue('A1', 'LISTA DE EXPEDIENTES')
				->mergeCells('A1:F1');

			$sheet->setCellValue('A2', 'EXPEDIENTE')
				->setCellValue('B2', 'PROVEEDOR')
				->setCellValue('C2', 'TOTAL')
				->setCellValue('D2', 'FECHA INGRESO')
				->setCellValue('E2', 'FECHA LIMITE')
				->setCellValue('F2', 'ESTADO');

			if (!empty($resultado)) {
				$pos = 3;
				foreach ($resultado as $key => $value) {
					$sheet->setCellValue('A' . $pos, $value->expediente);
					$sheet->setCellValue('B' . $pos, $value->proveedor);
					$sheet->setCellValue('C' . $pos, $value->total);
					$sheet->setCellValue('D' . $pos, $value->fecha);
					$sheet->setCellValue('E' . $pos, $value->flimite);
					$sheet->setCellValue('F' . $pos, $value->destado);
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
			$sheet->getStyle('A1:F1')->applyFromArray($titulo);
			$sheet->getStyle('A2:F2')->applyFromArray($cabecera);

			foreach (range('A', 'F') as $column) {
				$sheet->getColumnDimension($column)->setAutoSize(true);
			}

			$writer = new Xlsx($spreadsheet);
			$filename = 'expediente_' . date('Ymd') . '.xlsx';
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
