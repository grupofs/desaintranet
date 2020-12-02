<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

use PhpOffice\PhpSpreadsheet\Style\Alignment;
use PhpOffice\PhpSpreadsheet\Style\Fill;
use PhpOffice\PhpSpreadsheet\Style\Border;
use PhpOffice\PhpSpreadsheet\Style\Color;
use PhpOffice\PhpSpreadsheet\Style\NumberFormat;
use PhpOffice\PhpSpreadsheet\Style\Conditional;

use PhpOffice\PhpSpreadsheet\Chart\Chart;
use PhpOffice\PhpSpreadsheet\Chart\DataSeries;
use PhpOffice\PhpSpreadsheet\Chart\DataSeriesValues;
use PhpOffice\PhpSpreadsheet\Chart\Layout;
use PhpOffice\PhpSpreadsheet\Chart\Legend;
use PhpOffice\PhpSpreadsheet\Chart\PlotArea;
use PhpOffice\PhpSpreadsheet\Chart\Title;
use PhpOffice\PhpSpreadsheet\Helper\Sample;

use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\Spreadsheet;

require __DIR__ . "/../../../../vendor/phpoffice/phpspreadsheet/samples/Header.php";


class Cexcelauditoria extends CI_Controller {
	function __construct() {
		parent:: __construct();	
		$this->load->model('at/auditoria/mexcelauditoria');
		$this->load->model('mglobales');
		$this->load->library('encryption');
		$this->load->helper(array('form','url','download','html','file'));
		$this->load->library('form_validation');
    }

  
    public function excelinformes($cauditoriainspeccion,$fservicio,$cchecklist,$cestablearea) {
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
        $resumen = [
            'font'	=> [
                'name' => 'Arial',
                'size' =>10,
                'color' => array('rgb' => '000000'),
                'bold' => true,
            ], 
            'alignment' => [
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
        $celdastextonegrita = [
            'font'	=> [
                'name' => 'Arial',
                'size' =>10,
                'color' => array('rgb' => 'FFFFFF'),
                'bold' => true,
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
                'horizontal' => Alignment::HORIZONTAL_LEFT,
                'vertical' => Alignment::VERTICAL_CENTER,
                'wrapText' => true,
            ],
        ];
        $celdastextocentronegrita = [
            'font'	=> [
                'name' => 'Arial',
                'size' =>12,
                'color' => array('rgb' => '000000'),
                'bold' => true,
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
        $celdastextocentro = [
            'font'	=> [
                'name' => 'Arial',
                'size' => 10,
                'color' => array('rgb' => '000000'),
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
        $celdastextocentroazul = [
            'font'	=> [
                'name' => 'Arial',
                'size' => 10,
                'color' => array('rgb' => '146DD6'),
                'bold' => true,
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
        $texto90grados = [
            'alignment' => [
                'textRotation' => 90,
                'vertical' => Alignment::VERTICAL_BOTTOM,
                'wrapText' => true,
            ],
        ];
        $textochecklist = [
            'font'	=> [
                'name' => 'Arial',
                'size' => 14,
                'bold' => true,
            ], 
            'alignment' => [
                'vertical' => Alignment::VERTICAL_CENTER,
                'wrapText' => true,
            ],
        ];       


     /*.Estilos*/

        $helper = new Sample();
        $spreadsheet  = new Spreadsheet();
        $sheet  = $spreadsheet ->getActiveSheet();

        $sheet->setTitle('S0');

        $spreadsheet->getDefaultStyle()
            ->getFont()
            ->setName('Arial')
            ->setSize(9);
                
     /*Cabecera	*/
        $sheet->setCellValue('A1', '5S Formulario de auditoría rutinaría')
            ->mergeCells('A1:M1')
            ->setCellValue('B3','Nro Reporte:')
            ->setCellValue('B5','Fecha auditoria:')
            ->setCellValue('B7','Auditor:')
            ->setCellValue('B9','Sede auditada:')
            ->setCellValue('B11','Area o zona:')
            ->setCellValue('B13','Id')
            ->setCellValue('B14','S1')
            ->setCellValue('B15','S2')
            ->setCellValue('B16','S3')
            ->setCellValue('B17','S4')
            ->setCellValue('B18','S5')
            ->setCellValue('C13','5S')
            ->setCellValue('C14','Clasificar (Seiri)')
            ->setCellValue('C15','Ordenar (Seiton)')
            ->setCellValue('C16','Limpiar (Seiso)')
            ->setCellValue('C17','Estandarizar (Seiketsu)')
            ->setCellValue('C18','Disciplinar (Shitsuke)')
            ->setCellValue('C22','CONCLUSIÓN:')			
            ->setCellValue('D13','Título')
            ->setCellValue('D14','"Separar lo necesario de lo innecesario"')
            ->setCellValue('D15','"Un sitio para cada cosa y cada cosa en su sitio"')
            ->setCellValue('D16','"Limpiar el puesto de trabajo y los equipos y prevenir la suciedad y el desorden"')
            ->setCellValue('D17','"Formular las normas para la consolidación de las 3 primeras S "')
            ->setCellValue('D18','"Respetar las normas establecidas"')
            ->setCellValue('E13','Puntos')
            ->setCellValue('D19','Puntuación 5S')
            ->setCellValue('G12','Auditorías Previas')
            ->mergeCells('G12:M12')
            ->setCellValue('G13','1')
            ->setCellValue('H13','2')
            ->setCellValue('I13','3')
            ->setCellValue('J13','4')
            ->setCellValue('K13','5')
            ->setCellValue('L13','6')
            ->setCellValue('M13','Objetivo')
            ->setCellValue('M14','10')
            ->setCellValue('M15','10')
            ->setCellValue('M16','10')
            ->setCellValue('M17','10')
            ->setCellValue('M18','10')
            ->setCellValue('M19','50');
        
        $sheet->getStyle('A1:M1')->applyFromArray($titulo);
        $sheet->getStyle('B3:B11')->applyFromArray($resumen);
        $sheet->getStyle('B13:E13')->applyFromArray($cabecera);
        $sheet->getStyle('G13:M13')->applyFromArray($cabecera);
        $sheet->getStyle('B14:B18')->applyFromArray($celdastextocentronegrita);
        $sheet->getStyle('C14:D18')->applyFromArray($celdastexto);
        $sheet->getStyle('E14:E18')->applyFromArray($celdastextocentronegrita);
        $sheet->getStyle('G14:M18')->applyFromArray($celdastextocentro);
        $sheet->getStyle('D19')->applyFromArray($cabecera);
        $sheet->getStyle('E19')->applyFromArray($celdastextocentronegrita);
        $sheet->getStyle('G19:M19')->applyFromArray($celdastextocentroazul);
        $sheet->getStyle('G21')->applyFromArray($texto90grados);
        $sheet->getStyle('C22')->applyFromArray($cabecera);
        $sheet->getStyle('D22')->applyFromArray($celdastextocentronegrita);
        

        $sheet->getColumnDimension('A')->setAutoSize(false)->setWidth(4.10);
        $sheet->getColumnDimension('B')->setAutoSize(false)->setWidth(18.10);
        $sheet->getColumnDimension('C')->setAutoSize(false)->setWidth(31.10);
        $sheet->getColumnDimension('D')->setAutoSize(false)->setWidth(61.10);
        $sheet->getColumnDimension('E')->setAutoSize(false)->setWidth(10.10);
        $sheet->getColumnDimension('F')->setAutoSize(false)->setWidth(3.10);
        $sheet->getColumnDimension('G')->setAutoSize(false)->setWidth(6.10);
        $sheet->getColumnDimension('H')->setAutoSize(false)->setWidth(6.10);
        $sheet->getColumnDimension('I')->setAutoSize(false)->setWidth(6.10);
        $sheet->getColumnDimension('J')->setAutoSize(false)->setWidth(6.10);
        $sheet->getColumnDimension('K')->setAutoSize(false)->setWidth(6.10);
        $sheet->getColumnDimension('L')->setAutoSize(false)->setWidth(6.10);
        $sheet->getColumnDimension('M')->setAutoSize(false)->setWidth(10.10);

        $sheet->getRowDimension('1')->setRowHeight(23.10);
        $sheet->getRowDimension('2')->setRowHeight(23.10);
        $sheet->getRowDimension('3')->setRowHeight(23.10);
        $sheet->getRowDimension('5')->setRowHeight(23.10);
        $sheet->getRowDimension('7')->setRowHeight(23.10);
        $sheet->getRowDimension('9')->setRowHeight(23.10);
        $sheet->getRowDimension('11')->setRowHeight(23.10);
        $sheet->getRowDimension('12')->setRowHeight(23.10);
        $sheet->getRowDimension('13')->setRowHeight(33.10);
        $sheet->getRowDimension('14')->setRowHeight(33.10);
        $sheet->getRowDimension('15')->setRowHeight(33.10);
        $sheet->getRowDimension('16')->setRowHeight(33.10);
        
     /*.Cabecera*/

     /*Hoja1*/
        $spreadsheet->createSheet();
        $spreadsheet->setActiveSheetIndex(1)->setCellValue('A1','"Separar lo necesario de lo innecesario"')
                    ->mergeCells('A1:D1')
                    ->setCellValue('A2','N°')
                    ->setCellValue('B2','S1=Seiri=Clasificar')
                    ->setCellValue('C2','Cumple / No Cumple')
                    ->setCellValue('D2','Observaciones, comentarios, sugerencias de mejora que se encuentran en etapa de verificación S1')
                    ->setCellValue('B13','Puntuación')
                    ->setCellValue('A15','Nota: En caso que la pregunta no aplique para el área auditada se debera considerar puntaje en la calificación.')
                    ->mergeCells('A15:D15');

        $spreadsheet->getActiveSheet()->setTitle('S1');
     /*.Hoja1*/

     /*Hoja2*/
        $spreadsheet->createSheet();
        $spreadsheet->setActiveSheetIndex(2)->setCellValue('A1','"Un sitio para cada cosa y cada cosa en su sitio"')
                    ->mergeCells('A1:D1')
                    ->setCellValue('A2','N°')
                    ->setCellValue('B2','S2=Seiton=Ordenar')
                    ->setCellValue('C2','Cumple / No cumple')
                    ->setCellValue('D2','Observaciones, comentarios, sugerencias de mejora que se encuentran en etapa de verificación S2')
                    ->setCellValue('B13','Puntuación')
                    ->setCellValue('A15','Nota: En caso que la pregunta no aplique para el área auditada se debera considerar puntaje en la calificación.')
                    ->mergeCells('A15:D15');

        $spreadsheet->getActiveSheet()->setTitle('S2');
     /*.Hoja2*/

     /*Hoja3*/
        $spreadsheet->createSheet();
        $spreadsheet->setActiveSheetIndex(3)->setCellValue('A1','"Limpiar el puesto de trabajo y los equipos y prevenir la suciedad y el desorden"')
                    ->mergeCells('A1:D1')
                    ->setCellValue('A2','N°')
                    ->setCellValue('B2','S3=Seiso=Limpiar')
                    ->setCellValue('C2','Cumple / No cumple')
                    ->setCellValue('D2','Observaciones, comentarios, sugerencias de mejora que se encuentran en etapa de verificación S3')
                    ->setCellValue('B13','Puntuación')
                    ->setCellValue('A15','Nota: En caso que la pregunta no aplique para el área auditada se debera considerar puntaje en la calificación.')
                    ->mergeCells('A15:D15');

        $spreadsheet->getActiveSheet()->setTitle('S3');
     /*.Hoja3*/

     /*Hoja4*/
        $spreadsheet->createSheet();
        $spreadsheet->setActiveSheetIndex(4)->setCellValue('A1','"Eliminar anomalías evidentes con controles visuales"')
                    ->mergeCells('A1:D1')
                    ->setCellValue('A2','N°')
                    ->setCellValue('B2','S4=Seiketsu=Estandarizar')
                    ->setCellValue('C2','Cumple / No cumple')
                    ->setCellValue('D2','Observaciones, comentarios, sugerencias de mejora que se encuentran en etapa de verificación S4')
                    ->setCellValue('B13','Puntuación')
                    ->setCellValue('A15','Nota: En caso que la pregunta no aplique para el área auditada se debera considerar puntaje en la calificación.')
                    ->mergeCells('A15:D15');
        $spreadsheet->getActiveSheet()->setTitle('S4');

     /*.Hoja4*/

     /*Hoja5*/
        $spreadsheet->createSheet();
        $spreadsheet->setActiveSheetIndex(5)->setCellValue('A1','"Hacer el hábito de la obediencia a las reglas"')
                    ->mergeCells('A1:D1')
                    ->setCellValue('A2','N°')
                    ->setCellValue('B2','S5=Shitsuke=Disciplinar')
                    ->setCellValue('C2','Cumple / No cumple')
                    ->setCellValue('D2','Observaciones, comentarios, sugerencias de mejora que se encuentran en etapa de verificación S5')
                    ->setCellValue('B13','Puntuación')
                    ->setCellValue('A15','Nota: En caso que la pregunta no aplique para el área auditada se debera considerar puntaje en la calificación.')
                    ->mergeCells('A15:D15');

        $spreadsheet->getActiveSheet()->setTitle('S5');
     /*.Hoja5*/

     /*Data*/
        $parametrosCabecera = array( 
            '@idaudi'	=> $cauditoriainspeccion,
            '@fechaaudi'	=> $fservicio,
            '@cestablearea'	=> $cestablearea
        );
        $rptCabecera = $this->mexcelauditoria->xlschecklistresult($parametrosCabecera);
        $icabe = 14;
        foreach($rptCabecera as $rowCabecera){
            
            $nroinforme = $rowCabecera->nroinforme;
            $fechaaudi = $rowCabecera->fechaaudi;
            $auditor = $rowCabecera->auditor;
            $sedeaudi = $rowCabecera->sedeaudi;
            $zona = $rowCabecera->zona;
            $resultado = $rowCabecera->resultado;
            $calificacion = $rowCabecera->calificacion;
            $valorsubtotal = $rowCabecera->valorsubtotal;
            $crequisitochecklist = $rowCabecera->crequisitochecklist;
            $cualidad = $rowCabecera->cualidad;
                        

            $sheet->setCellValue('E'.$icabe,$valorsubtotal);

            $parametrosS = array( 
                '@idaudi'	=> $cauditoriainspeccion,
                '@fechaaudi'	=> $fservicio,
                '@cestablearea'	=> $cestablearea,
                '@cchecklist'	=> $cchecklist,
                '@cchecklistpadre'	=> $crequisitochecklist
            );
            $rptS = $this->mexcelauditoria->xlschecklistdetalle($parametrosS);
            $iS = 3;
            $i=1;
            foreach($rptS as $rowS){
                
                $requisito = $rowS->requisito;
                $valor = $rowS->valor;
                $hallazgo = $rowS->hallazgo;
                
                if($crequisitochecklist == '0001'){
                    $sheetS = $spreadsheet->setActiveSheetIndex(1);
                }
                if($crequisitochecklist == '0002'){
                    $sheetS = $spreadsheet->setActiveSheetIndex(2);
                }
                if($crequisitochecklist == '0003'){
                    $sheetS = $spreadsheet->setActiveSheetIndex(3);
                }
                if($crequisitochecklist == '0004'){
                    $sheetS = $spreadsheet->setActiveSheetIndex(4);
                }
                if($crequisitochecklist == '0005'){
                    $sheetS = $spreadsheet->setActiveSheetIndex(5);
                }                    

                $sheetS->setCellValue('A'.$iS,$i);
                $sheetS->setCellValue('B'.$iS,$requisito);
                $sheetS->setCellValue('C'.$iS,$valor);
                $sheetS->setCellValue('D'.$iS,$hallazgo);

                $sheetS->setCellValue('C13',$valorsubtotal);
                $sheetS->setCellValue('D13',$cualidad);

                $sheetS->getColumnDimension('A')->setAutoSize(false)->setWidth(6.10);
                $sheetS->getColumnDimension('B')->setAutoSize(false)->setWidth(70.10);
                $sheetS->getColumnDimension('C')->setAutoSize(false)->setWidth(12.10);
                $sheetS->getColumnDimension('D')->setAutoSize(false)->setWidth(80.10);

                $sheetS->getRowDimension('1')->setRowHeight(45.10);
                $sheetS->getRowDimension('2')->setRowHeight(33.10);
                $sheetS->getRowDimension('3')->setRowHeight(26.50);
                $sheetS->getRowDimension('4')->setRowHeight(26.50);
                $sheetS->getRowDimension('5')->setRowHeight(26.50);
                $sheetS->getRowDimension('6')->setRowHeight(26.50);
                $sheetS->getRowDimension('7')->setRowHeight(26.50);
                $sheetS->getRowDimension('8')->setRowHeight(26.50);
                $sheetS->getRowDimension('9')->setRowHeight(26.50);
                $sheetS->getRowDimension('10')->setRowHeight(26.50);
                $sheetS->getRowDimension('11')->setRowHeight(26.50);
                $sheetS->getRowDimension('12')->setRowHeight(26.50);
                $sheetS->getRowDimension('13')->setRowHeight(25.10);
                $sheetS->getRowDimension('13')->setRowHeight(20.10);

                $sheetS->getStyle('A1:D1')->applyFromArray($textochecklist);
                $sheetS->getStyle('A2:D2')->applyFromArray($cabecera);
                $sheetS->getStyle('A3:D12')->applyFromArray($celdastexto);
                $sheetS->getStyle('C3:C12')->applyFromArray($celdastextocentro);
                $sheetS->getStyle('B13')->applyFromArray($celdastextocentronegrita);
                $sheetS->getStyle('C13:D13')->applyFromArray($celdastextocentronegrita);
                $sheetS->getStyle('A15:D15')->applyFromArray($cabecera);

                $iS++;
                $i++;
            }

            $icabe++;
        }

        $sheet->setCellValue('C3',$nroinforme);
        $sheet->setCellValue('C5',$fechaaudi);
        $sheet->setCellValue('C7',$auditor);
        $sheet->setCellValue('C9',$sedeaudi);
        $sheet->setCellValue('C11',$zona);
        $sheet->setCellValue('E19',$resultado);
        $sheet->setCellValue('D22',$calificacion);	
    
     /*.Data*/

     /*Grafico*/
        
        $dataSeriesLabels = [
            new DataSeriesValues(DataSeriesValues::DATASERIES_TYPE_STRING, null, null, 1), // 2011
        ];
        $xAxisTickValues = [
            new DataSeriesValues(DataSeriesValues::DATASERIES_TYPE_STRING, 'S0!$C$14:$C$18', null, 5), // Jan to Dec
        ];
        $dataSeriesValues = [
            new DataSeriesValues(DataSeriesValues::DATASERIES_TYPE_NUMBER, 'S0!$E$14:$E$18', null, 5),
        ];
        
        $series = new DataSeries(
            DataSeries::TYPE_RADARCHART, // plotType
            null, // plotGrouping (Radar charts don't have any grouping)
            range(0, count($dataSeriesValues) - 1), // plotOrder
            $dataSeriesLabels, // plotLabel
            $xAxisTickValues, // plotCategory
            $dataSeriesValues, // plotValues
            null, // plotDirection
            null, // smooth line
            DataSeries::STYLE_MARKER  // plotStyle
        );
        
        $layout = new Layout();
        
        $plotArea = new PlotArea($layout, [$series]);
        $legend = new Legend(Legend::POSITION_RIGHT, null, false);
        
        $title = new Title('Test Radar Chart');
        
        $chart = new Chart(
            'chart1', // name
            null, // title
            null, // legend
            $plotArea, // plotArea
            true, // plotVisibleOnly
            'gap', // displayBlanksAs
            null, // xAxisLabel
            null   // yAxisLabel - Radar charts don't have a Y-Axis
        );
        
        $chart->setTopLeftPosition('D3');
        $chart->setBottomRightPosition('F11');
        
        $sheet->addChart($chart);
        
     /*.Grafico*/
        
        // Save Excel 2007 file
        $filename = 'ReporteInforme.xlsx';
        $namesheet = 'temp/'.$filename;
        $writer = IOFactory::createWriter($spreadsheet, 'Xlsx');
        $writer->setIncludeCharts(true);
        $writer->save($namesheet);
        $data = file_get_contents($namesheet); 
        force_download($filename,$data); 
    }
    

	public function pdfinformes($cauditoriainspeccion,$fservicio,$cchecklist) { // recupera los cartas a proveedores
		$this->load->library('pdfgenerator');
		$filename = "Document_name";

		/*$html = '<html>
                <head>
                    <title>Informe</title>
					<style>
						@page {
                            margin-top: 50px;
                            margin-right: 40px;
                            margin-left: 40px;
						}
                        body{
                            font-family: Arial, Helvetica, sans-serif;
                            font-size: 9pt;
                        } 
                        header { 
                            position: fixed; 
                            left: 0px; 
                            right: 0px;  
                            text-align: center;
                        }
                        main {
                            margin-top: 200px;
                            left: 0px; 
                            right: 0px;  
                        } 
                        #cover { 
                            margin-top: 200px;
                            left: 0px; 
                            right: 0px;  
                            text-align: center; 
                            font-size: 12pt;
                            line-height:200%;
                            page-break-after:always;
                        }
                        #cover table{ 
                            text-align: center;
                        }
                        #contained { 
                            margin-top: 100px;
                            left: 0px; 
                            right: 0px;  
                            text-align: center; 
                            font-size: 9pt;
                            line-height:200%;
                        }
                        .marco-sup{
                            border-collapse: collapse;
                            border: 1px solid black;
                            border-bottom-style: hidden;
                            background: #eee;
                        }
                        .marco-medio{
                            border-collapse: collapse;
                            border: 1px solid black;
                            border-bottom-style: hidden;
                            border-top-style: hidden;
                            background: #eee;
                        }
                        .marco-inf{
                            border-collapse: collapse;
                            border: 1px solid black;
                            border-top-style: hidden;
                            background: #eee;
                        }
						.teacherPage {
								page: teacher;
								page-break-after: always;
                        }
                        .saltopagina{
                            page-break-before:always;
                        }
                        table {
                            border-collapse: collapse;
                        } 

                        th{
                            border-collapse: collapse;
                            border: 1px solid black;
                            background: #eee;
                        }
						.cuerpo {
							text-align: justify;
                        }
                        img.izquierda {
                            float: left;
                        }
                        img.derecha {
                            float: right;
                        }
					</style>
				</head>
				<body>';
        
                    			
		$resultado = $this->mexcelauditoria->getpdfdatosaudi($cauditoriainspeccion,$fservicio);
		if ($resultado){
			foreach($resultado as $row){
				$NROINFORME     = $row->NROINFORME;	
				$SERVICIO       = $row->SERVICIO;	
				$SUBSERVICIO    = $row->SUBSERVICIO;	
				$CLIENTE        = $row->CLIENTE;	
                $FSERVICIO      = $row->FSERVICIO;
                $ESTABLECIMIENTO = $row->ESTABLECIMIENTO;
                $TEXTFECHA = $row->TEXTFECHA;	
				
				$html .= '
                    <header>	                    				
                        <table width="700px" align="center" >
                            <tr>
                                <td width="80px" rowspan="5">
                                    <img class="izquierda" src="./FTPfileserver/Imagenes/formatos/1/logoFS.png" width="180" height="80" />
                                </td>
                                <td align="right">Av. Del Pinar 110 of. 405 - 407</td>
                            </tr>
                            <tr>
                                <td align="right">Urb. Chacarilla del Estanque</td>
                            </tr>
                            <tr>
                                <td align="right">Santiago de Surco, Lima - Perú</td>
                            </tr>
                            <tr>
                                <td align="right">(51-1)372-1734 / 372-8182</td>
                            </tr>
                            <tr>
                                <td align="right">www.grupofs.com</td>
                            </tr>   
                        </table> 
                    </header>
                    <main> 
                    <div id="cover">
                        <table width="500px" align="center">
                        <tr>
                            <td>INFORME N° '.$NROINFORME.'</td>
                        </tr>
                        <tr>
                            <td style="height:100px;"></td>
                        </tr>
                        <tr>
                            <td class="marco-sup">'.$SERVICIO.' - '.$SUBSERVICIO.'</td>
                        </tr>
                        <tr>
                            <td class="marco-medio" style="height:10px;"></td>
                        </tr>
                        <tr>
                            <td class="marco-inf">'.$CLIENTE.'</td>
                        </tr>
                        <tr>
                            <td class="marco-inf">'.$ESTABLECIMIENTO.'</td>
                        </tr>
                        <tr>
                            <td style="height:300px" >&nbsp;</td>
                        </tr>
                        <tr>
                            <td>'.$TEXTFECHA.'</td>
                        </tr>
                        </table>
                    </div>
                    <div id="contained">
                        <b>RESUMEN</b> <br>&nbsp;<br>
                        <table width="500px" align="center" style="border: 1px solid black;">
                        <thead>
                        <tr>
                            <td align="center" colspan="3"><b>PUNTUACION POR AREA</b></td>
                        </tr>
                        <tr>
                            <th>AREA/ZONA</th>
                            <th>NOTA</th>
                            <th>CALIFICACION</th>
                        </tr>
                        </thead>
                        <tbody>';
                        $reszona = $this->mexcelauditoria->getpdfcalifzona($cauditoriainspeccion,$fservicio);
                        if ($reszona){
                        foreach($reszona as $rowzona){
                            $destablearea     = $rowzona->destablearea;	
                            $calificacion     = $rowzona->calificacion;	
                            $ddetallecriterioresultado     = $rowzona->ddetallecriterioresultado;
                        $html .= 
                        '<tr>
                            <td>'.$destablearea.'</td>
                            <td align="center">'.$calificacion.'</td>
                            <td>'.$ddetallecriterioresultado.'</td>
                        </tr>';
                        }
                        }
                        $html .= '</tbody></table>
                        <br>&nbsp;<br>
                        <br>&nbsp;<br>
                        <b>DETALLE</b> <br>&nbsp;<br>';

                        if ($reszona){
                        foreach($reszona as $rowdet){
                            $destableareadet     = $rowdet->destablearea;
                            $establearea    =  $rowdet->cestablearea;
                            	
                        $html .= '                        
                        <table width="500px" align="center" style="border: 1px solid black;">
                        
                        <tr>
                            <td align="center" colspan="4"><b>'.$destableareadet.'</b></td>
                        </tr>
                        <tr>
                            <th>ID</th>
                            <th>5S</th>
                            <th>TITULO</th>
                            <th>PUNTOS</th>
                        </tr>';
                        
                        $parametrosCabecera = array( 
                            '@idaudi'	=> $cauditoriainspeccion,
                            '@fechaaudi'	=> $fservicio,
                            '@cestablearea'	=> $establearea
                        );
                        $rptCabecera = $this->mexcelauditoria->xlschecklistresult($parametrosCabecera);
                        if ($rptCabecera){                            
                            $icabe = 0;
                            foreach($rptCabecera as $rowcabecera){
                                $valorsubtotal = $rowcabecera->valorsubtotal;	
                                $icabe++;
                        $html .= '
                        <tr>
                            <td>S'.$icabe.'</td>
                            <td>5S</td>
                            <td>TITULO</td>
                            <td>PUNTOS</td>
                        </tr>';
                            }
                        }
                        $html .= '</table>
                        <br>&nbsp;<br>';
                        }
                    }
                    $html .= '
                    </div>';
			}
		}
        $html .= '</main></body></html>';*/
        
        $html = '<html>
        <head>
            <style>
                @page {
                    margin-top: 30px;
                    margin-right: 40px;
                    margin-left: 40px;
                }
    
                body {
                    margin-top: 3cm;
                    margin-left: 2cm;
                    margin-right: 2cm;
                    margin-bottom: 2cm;
                    font-family: Arial, Helvetica, sans-serif;
                    font-size: 9pt;
                }
    
                header {
                    position: fixed;
                    top: 0cm;
                    left: 0cm;
                    right: 0cm;
                }

                main {
                    top: 0cm;
                    left: 0cm;
                    right: 0cm;
                }
    
                #cover { 
                    margin-top: 200px;
                    left: 0px; 
                    right: 0px;  
                    text-align: center; 
                    font-size: 12pt;
                    line-height:200%;
                    page-break-after:always;
                }
                #cover table{ 
                    text-align: center;
                }
                
                #contained { 
                }
                
                table {
                    border-collapse: collapse;
                }         
                .marco-sup{
                    border-collapse: collapse;
                    border: 1px solid black;
                    border-bottom-style: hidden;
                    background: #eee;
                }
                .marco-medio{
                    border-collapse: collapse;
                    border: 1px solid black;
                    border-bottom-style: hidden;
                    border-top-style: hidden;
                    background: #eee;
                }
                .marco-inf{
                    border-collapse: collapse;
                    border: 1px solid black;
                    border-top-style: hidden;
                    background: #eee;
                }                

                th{
                    border-collapse: collapse;
                    border: 1px solid black;
                    background: #eee;
                }
            </style>
            <title>Informe</title>
        </head>
        <body>
            <header>
                
                <table width="700px" align="center" >
                    <tr>
                        <td width="80px" rowspan="5">
                            <img class="izquierda" src="./FTPfileserver/Imagenes/formatos/1/logoFS.png" width="180" height="80" />
                        </td>
                        <td align="right">Av. Del Pinar 110 of. 405 - 407</td>
                    </tr>
                    <tr>
                        <td align="right">Urb. Chacarilla del Estanque</td>
                    </tr>
                    <tr>
                        <td align="right">Santiago de Surco, Lima - Perú</td>
                    </tr>
                    <tr>
                        <td align="right">(51-1)372-1734 / 372-8182</td>
                    </tr>
                    <tr>
                        <td align="right">www.grupofs.com</td>
                    </tr>   
                </table>

            </header>';

            $resultado = $this->mexcelauditoria->getpdfdatosaudi($cauditoriainspeccion,$fservicio);
            if ($resultado){
                foreach($resultado as $row){
                    $NROINFORME     = $row->NROINFORME;	
                    $SERVICIO       = $row->SERVICIO;	
                    $SUBSERVICIO    = $row->SUBSERVICIO;	
                    $CLIENTE        = $row->CLIENTE;	
                    $FSERVICIO      = $row->FSERVICIO;
                    $ESTABLECIMIENTO = $row->ESTABLECIMIENTO;
                    $TEXTFECHA = $row->TEXTFECHA;
                }
            }
            $html .= '
            <main>    

            <div id="cover">
                <table width="500px" align="center">
                <tr>
                    <td>INFORME N° '.$NROINFORME.'</td>
                </tr>
                <tr>
                    <td style="height:100px;"></td>
                </tr>
                <tr>
                    <td class="marco-sup">'.$SERVICIO.' - '.$SUBSERVICIO.'</td>
                </tr>
                <tr>
                    <td class="marco-medio" style="height:10px;"></td>
                </tr>
                <tr>
                    <td class="marco-inf">'.$CLIENTE.'</td>
                </tr>
                <tr>
                    <td class="marco-inf">'.$ESTABLECIMIENTO.'</td>
                </tr>
                <tr>
                    <td style="height:300px" >&nbsp;</td>
                </tr>
                <tr>
                    <td>'.$TEXTFECHA.'</td>
                </tr>
                </table>

            </div>  

            <div id="contained">
                <b>RESUMEN</b> 
                <br>&nbsp;<br>

                <table width="600px" align="center" style="border: 1px solid black;">
                <thead>
                    <tr>
                        <td align="center" colspan="3"><b>PUNTUACION POR AREA</b></td>
                    </tr>
                    <tr>
                        <th>AREA/ZONA</th>
                        <th>NOTA</th>
                        <th>CALIFICACION</th>
                    </tr>
                </thead>
                <tbody>';   
                $reszona = $this->mexcelauditoria->getpdfcalifzona($cauditoriainspeccion,$fservicio);
                if ($reszona){
                foreach($reszona as $rowzona){
                    $destablearea     = $rowzona->destablearea;	
                    $calificacion     = $rowzona->calificacion;	
                    $ddetallecriterioresultado     = $rowzona->ddetallecriterioresultado;
                $html .= 
                    '<tr>
                        <td>'.$destablearea.'</td>
                        <td align="center">'.$calificacion.'</td>
                        <td>'.$ddetallecriterioresultado.'</td>
                    </tr>';
                }
                }
                $html .= '
                </tbody>
                </table>
                <br>&nbsp;<br>
                <br>&nbsp;<br>
                <b>DETALLE</b> 
                <br>&nbsp;<br>';

                if ($reszona){
                foreach($reszona as $rowdet){
                    $destableareadet     = $rowdet->destablearea;
                    $establearea    =  $rowdet->cestablearea;
                        
                $html .= '                        
                <table width="600px" align="center" style="border: 1px solid black;">
                <thead>
                    <tr>
                        <td align="center" colspan="4"><b>'.$destableareadet.'</b></td>
                    </tr>
                    <tr>
                        <th align="center">ID</th>
                        <th>5S</th>
                        <th>TITULO</th>
                        <th align="center">PUNTOS</th>
                    </tr>
                </thead>';
            
                $parametrosCabecera = array( 
                    '@idaudi'	=> $cauditoriainspeccion,
                    '@fechaaudi'	=> $fservicio,
                    '@cestablearea'	=> $establearea
                );
                $rptCabecera = $this->mexcelauditoria->xlschecklistresult($parametrosCabecera);
                if ($rptCabecera){                            
                    $icabe = 0;
                    foreach($rptCabecera as $rowcabecera){
                        $cincoS = $rowcabecera->cincoS;
                        $titulo = $rowcabecera->titulo;
                        $valorsubtotal = $rowcabecera->valorsubtotal;	
                        
                        $icabe++;
                $html .= '
                    <tr>
                        <td>S'.$icabe.'</td>
                        <td>'.$cincoS.'</td>
                        <td>'.$titulo.'</td>
                        <td>'.$valorsubtotal.'</td>
                    </tr>';
                    }
                }
                $html .= '
                </table>
                <br>&nbsp;<br>
                <br>&nbsp;<br>';
                }
                }
                $html .= '
                <b>HALLAZGOS</b> 
                <br>&nbsp;<br>';
                if ($reszona){
                foreach($reszona as $rowhallazgozona){
                    $destableareazona     = $rowhallazgozona->destablearea;
                    $cestableareazona    =  $rowhallazgozona->cestablearea;
                    $cchecklist    =  $rowhallazgozona->cchecklist;
                        
                $html .= '                        
                <table width="600px" align="center" style="border: 1px solid black;">
                <thead>
                    <tr>
                        <td align="center" colspan="3"><b>'.$destableareazona.'</b></td>
                    </tr>';   
                $reshallazgocab  = $this->mexcelauditoria->getpdfhallazgocab($cauditoriainspeccion,$fservicio,$cchecklist,$cestableareazona);
                if ($reshallazgocab){
                foreach($reshallazgocab as $rowhallazgocab){
                    $crequisitohcab     = $rowhallazgocab->crequisito;	
                    $drequisitohcab     = $rowhallazgocab->drequisito;
                $html .= '
                    <tr>
                        <th align="center">ID</th>
                        <th>'.$drequisitohcab.'</th>
                        <th>HALLAZGOS</th>
                    </tr>
                </thead>';
                    $reshallazgodet  = $this->mexcelauditoria->getpdfhallazgodet($cauditoriainspeccion,$fservicio,$cchecklist,$cestableareazona,$crequisitohcab);
                    if ($reshallazgodet){                         
                        $idet = 0;
                    foreach($reshallazgodet as $rowhallazgodet){
                        $drequisito     = $rowhallazgodet->drequisito;	
                        $dhallazgo     = $rowhallazgodet->dhallazgo;
                        $foto	= $rowhallazgodet->foto;
                        $idet++;
                        
                    $html .= '
                    <tbody>
                    <tr>
                        <td>'.$idet.'</td>
                        <td>'.$drequisito.'</td>
                        <td>'.$dhallazgo.'</td>
                    </tr>
                    <tr>
                        <td style="border: 1px solid black;" colspan="3"><img class="izquierda" src="./'.$foto.'" width="360" height="160" /></td>
                    </tr>
                    ';
                    }}
                    $html .= '
                    <tr>
                        <td style="height:30px" colspan="3">&nbsp;</td>
                    </tr>';
                }}
                $html .= '               
                </tbody>
                </table>';
                }
                }
            $html .= '
            </div>
            </main>
        </body>
        </html>';
		//echo $html;
		$this->pdfgenerator->generate($html, $filename);
	}
}
?>