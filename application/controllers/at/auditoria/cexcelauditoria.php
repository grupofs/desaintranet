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

  
    public function excelinformes($cauditoriainspeccion,$fservicio,$cchecklist) {
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
            ->setSize(10);
                
     /*Cabecera	*/
        $sheet->setCellValue('A1', '5S Formulario de auditoría rutinaría')
            ->mergeCells('A1:M1')
            ->setCellValue('B3','Nro Reporte:')
            ->setCellValue('B5','Fecha auditoria:')
            ->setCellValue('B7','Auditor:')
            ->setCellValue('B9','Sede auditada:')
            ->setCellValue('B11','Id')
            ->setCellValue('B12','S1')
            ->setCellValue('B13','S2')
            ->setCellValue('B14','S3')
            ->setCellValue('B15','S4')
            ->setCellValue('B16','S5')
            ->setCellValue('C11','5S')
            ->setCellValue('C12','Clasificar (Seiri)')
            ->setCellValue('C13','Ordenar (Seiton)')
            ->setCellValue('C14','Limpiar (Seiso)')
            ->setCellValue('C15','Estandarizar (Seiketsu)')
            ->setCellValue('C16','Disciplinar (Shitsuke)')
            ->setCellValue('C19','CONCLUSIÓN:')			
            ->setCellValue('D11','Título')
            ->setCellValue('D12','"Separar lo necesario de lo innecesario"')
            ->setCellValue('D13','"Un sitio para cada cosa y cada cosa en su sitio"')
            ->setCellValue('D14','"Limpiar el puesto de trabajo y los equipos y prevenir la suciedad y el desorden"')
            ->setCellValue('D15','"Formular las normas para la consolidación de las 3 primeras S "')
            ->setCellValue('D16','"Respetar las normas establecidas"')
            ->setCellValue('E11','Puntos')
            ->setCellValue('D17','Puntuación 5S')
            ->setCellValue('G10','Auditorías Previas')
            ->mergeCells('G10:M10')
            ->setCellValue('G11','1')
            ->setCellValue('H11','2')
            ->setCellValue('I11','3')
            ->setCellValue('J11','4')
            ->setCellValue('K11','5')
            ->setCellValue('L11','6')
            ->setCellValue('M11','Objetivo')
            ->setCellValue('M12','10')
            ->setCellValue('M13','10')
            ->setCellValue('M14','10')
            ->setCellValue('M15','10')
            ->setCellValue('M16','10')
            ->setCellValue('M17','50');
        
        $sheet->getStyle('A1:M1')->applyFromArray($titulo);
        $sheet->getStyle('B3:B9')->applyFromArray($resumen);
        $sheet->getStyle('B11:E11')->applyFromArray($cabecera);
        $sheet->getStyle('G11:M11')->applyFromArray($cabecera);
        $sheet->getStyle('B12:B16')->applyFromArray($celdastextocentronegrita);
        $sheet->getStyle('C12:D16')->applyFromArray($celdastexto);
        $sheet->getStyle('E12:E16')->applyFromArray($celdastextocentronegrita);
        $sheet->getStyle('G12:M16')->applyFromArray($celdastextocentro);
        $sheet->getStyle('D17')->applyFromArray($cabecera);
        $sheet->getStyle('E17')->applyFromArray($celdastextocentronegrita);
        $sheet->getStyle('G17:M17')->applyFromArray($celdastextocentroazul);
        $sheet->getStyle('G18')->applyFromArray($texto90grados);
        $sheet->getStyle('C19')->applyFromArray($cabecera);
        $sheet->getStyle('D19')->applyFromArray($celdastextocentronegrita);
        

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
        $sheet->getRowDimension('2')->setRowHeight(33.10);
        $sheet->getRowDimension('3')->setRowHeight(23.10);
        $sheet->getRowDimension('5')->setRowHeight(23.10);
        $sheet->getRowDimension('7')->setRowHeight(23.10);
        $sheet->getRowDimension('9')->setRowHeight(23.10);
        $sheet->getRowDimension('10')->setRowHeight(23.10);
        $sheet->getRowDimension('12')->setRowHeight(33.10);
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
            '@fechaaudi'	=> $fservicio
        );
        $rptCabecera = $this->mexcelauditoria->xlschecklistresult($parametrosCabecera);
        $icabe = 12;
        foreach($rptCabecera as $rowCabecera){
            
            $nroinforme = $rowCabecera->nroinforme;
            $fechaaudi = $rowCabecera->fechaaudi;
            $auditor = $rowCabecera->auditor;
            $sedeaudi = $rowCabecera->sedeaudi;
            $resultado = $rowCabecera->resultado;
            $calificacion = $rowCabecera->calificacion;
            $valorsubtotal = $rowCabecera->valorsubtotal;
            $crequisitochecklist = $rowCabecera->crequisitochecklist;
            $cualidad = $rowCabecera->cualidad;            

            $sheet->setCellValue('E'.$icabe,$valorsubtotal);

            $parametrosS = array( 
                '@idaudi'	=> $cauditoriainspeccion,
                '@fechaaudi'	=> $fservicio,
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
                $sheetS->getRowDimension('2')->setRowHeight(28.10);
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
        $sheet->setCellValue('E17',$resultado);
        $sheet->setCellValue('D19',$calificacion);	
    
     /*.Data*/

     /*Grafico*/
        
        $dataSeriesLabels = [
            new DataSeriesValues(DataSeriesValues::DATASERIES_TYPE_STRING, null, null, 1), // 2011
        ];
        $xAxisTickValues = [
            new DataSeriesValues(DataSeriesValues::DATASERIES_TYPE_STRING, 'S0!$C$12:$C$16', null, 5), // Jan to Dec
        ];
        $dataSeriesValues = [
            new DataSeriesValues(DataSeriesValues::DATASERIES_TYPE_NUMBER, 'S0!$E$12:$E$16', null, 5),
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
        
        $chart->setTopLeftPosition('D2');
        $chart->setBottomRightPosition('F10');
        
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
}
?>