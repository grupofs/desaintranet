<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

//require __DIR__ . "/vendor/autoload.php";

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use PhpOffice\PhpSpreadsheet\Style\Fill;
use PhpOffice\PhpSpreadsheet\Style\Border;
use PhpOffice\PhpSpreadsheet\Style\Color;
use PhpOffice\PhpSpreadsheet\Style\NumberFormat;
use PhpOffice\PhpSpreadsheet\Style\Conditional;

class Cindicadoresmes extends CI_Controller {
	function __construct() {
		parent:: __construct();	
		$this->load->model('adm/mrecursoshumanos');
		$this->load->model('mglobales');
		$this->load->library('encryption');
		$this->load->helper(array('form','url','download','html','file'));
		$this->load->library('form_validation');
  }
     	
  public function genexcelindicadores() {	// Recuperar Indicadores mensual	
              
    $spreadsheet = new Spreadsheet();
    $sheet = $spreadsheet->getActiveSheet();
    //$sheet->setCellValue('A1', 'Hello World !');
  
    $sheet->setCellValue('A1','Listado de Permisos por Area')
      ->mergeCells('A1:M1')									
      ->setCellValue('A3','Area:')				
      ->setCellValue('E4','Vacaciones')
      ->mergeCells('E4:I4')
      ->setCellValue('J4','Permisos')
      ->mergeCells('J4:L4')
      ->setCellValue('A5','Nro.')
      ->setCellValue('B5','Empleado')
      ->setCellValue('C5','F. Ingreso')
      ->setCellValue('D5','F. Termino')
      ->setCellValue('E5','Periodo Vacaciones')
      ->setCellValue('F5','Dias Vacaciones')
      ->setCellValue('G5','Medio dias Cuentas Vacaciones')
      ->setCellValue('H5','Dias Tomados Vacaciones')
      ->setCellValue('I5','Dias Pendientes')
      ->setCellValue('J5','Horas Extras')
      ->setCellValue('K5','Horas Permisos')
      ->setCellValue('L5','Pendiente a Usar')
      ->setCellValue('M5','Descansos Medico');    
  
    $sheet->setTitle('Permisos_area');
     /* $writer = new Xlsx($spreadsheet);
    $namesheet = "PermisosxArea.xlsx";
    header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
    header('Content-Disposition: attachment;filename="'.$namesheet.'"');
    header('Cache-Control: max-age=0');*/	                                                    
    //$writer->save('php://output');
  
    $writer = new Xlsx($spreadsheet);
    $writer->save('export.xlsx');
    header('Content-Type: application/vnd.ms-excel');
    header('Content-Disposition: attachment; filename="export.xlsx"');
    $writer->save("php://output");
    exit;
  }
  }
  ?>