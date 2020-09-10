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

class Cctrlpermisos extends CI_Controller {
	function __construct() {
		parent:: __construct();	
		$this->load->model('adm/rrhh/mctrlpermisos');
		$this->load->model('mglobales');
		$this->load->library('encryption');
		$this->load->helper(array('form','url','download','html','file'));
		$this->load->library('form_validation');
    }

   /** CONTROL PERMISOS - VACACIONES - EXTRAS **/ 
	
    public function getempleados() { // Recupera empleado CBO	   
		
		$ccia =  $this->input->post('ccia');
		$carea =  $this->input->post('carea');		

		$resultado = $this->mctrlpermisos->getempleados($ccia,$carea);
		echo json_encode($resultado);
	}

	public function getlistempleadosperm() { // Recupera listado empleados
		$parametros = array( 
			'@id_empleado'	=> $this->input->post('id_empleado'),
			'@ccompania'	=> $this->input->post('ccia'),
			'@carea'	=> $this->input->post('carea'),
		);			
		$resultado = $this->mctrlpermisos->getlistempleadosperm($parametros);		
		echo json_encode($resultado);
	}

	public function excellistempleadosperm() { // Recupera listado empleados en excel	
		$id_empleado = $this->input->post('cboEmpleado');
		$carea = $this->input->post('cboArea');
		$ccompania = $this->input->post('cboCia');

			$parametros = array( 
				'@id_empleado'	=> $id_empleado,
				'@ccompania'	=> $ccompania,
				'@carea'		=> $carea,
			);			
			$resultado = $this->mctrlpermisos->getlistempleadosperm($parametros);

		  /*Estilos*/ 
			$estilotitulo = [
				'font'	=> [
					'name' => 'SansSerif',
					'size' =>14,
					'bold' => true,
				], 
				'fill'	=>[
					'fillType' => Fill::FILL_SOLID,
					'startColor' => [
						'rgb' => '07C134'
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
				],
			];

			$estilocabecera = [
				'font'	=> [
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
			
			$formatonroundec = [
				'numberFormat' => [
					'formatCode' => '#,##0.0',
				],
			];

		  /* .Estilos*/ 

			$spreadsheet = new Spreadsheet();
			$sheet = $spreadsheet->getActiveSheet();

			$spreadsheet->getDefaultStyle()
				->getFont()
				->setName('Arial')
				->setSize(10);	
	
			$sheet->getColumnDimension('A')->setAutoSize(false)->setWidth(5.10);
			$sheet->getColumnDimension('B')->setAutoSize(false)->setWidth(58.10);
			$sheet->getColumnDimension('C')->setAutoSize(false)->setWidth(12.10);
			$sheet->getColumnDimension('D')->setAutoSize(false)->setWidth(12.10);
			$sheet->getColumnDimension('E')->setAutoSize(false)->setWidth(13.10);
			$sheet->getColumnDimension('F')->setAutoSize(false)->setWidth(13.10);
			$sheet->getColumnDimension('G')->setAutoSize(false)->setWidth(13.10);
			$sheet->getColumnDimension('H')->setAutoSize(false)->setWidth(13.10);
			$sheet->getColumnDimension('I')->setAutoSize(false)->setWidth(13.10);
			$sheet->getColumnDimension('J')->setAutoSize(false)->setWidth(13.10);
			$sheet->getColumnDimension('K')->setAutoSize(false)->setWidth(13.10);
			$sheet->getColumnDimension('L')->setAutoSize(false)->setWidth(13.10);
			$sheet->getColumnDimension('M')->setAutoSize(false)->setWidth(13.10);
	
			$sheet->getRowDimension('5')->setRowHeight(46.10);

			$sheet->freezePane('C6');

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
			$i = 6;
			foreach($resultado as $row){
				$area 				= $row->area;
				$nro 				= $row->nro;
				$empleado 			= $row->empleado;
				$fingreso 			= $row->fingreso;
				$fcumplevaca 		= $row->fcumplevaca;
				$periodovaca 		= $row->periodovaca;
				$diasvaca 			= $row->diasvaca;
				$nro_permcuentavaca = $row->nro_permcuentavaca;
				$nro_vacaciones 	= $row->nro_vacaciones;
				$diaspendientes 	= $row->diaspendientes;
				$nro_horasextras 	= $row->nro_horasextras;
				$nro_permisos 		= $row->nro_permisos;
				$horaspendientes 	= $row->horaspendientes;
				$nro_descansomedico = $row->nro_descansomedico;
				
				$sheet->setCellValue('A'.$i,$nro)				
					->setCellValue('B'.$i,$empleado)
					->setCellValue('C'.$i,$fingreso)
					->setCellValue('D'.$i,$fcumplevaca)
					->setCellValue('E'.$i,$periodovaca)
					->setCellValue('F'.$i,$diasvaca)
					->setCellValue('G'.$i,$nro_permcuentavaca)
					->setCellValue('H'.$i,$nro_vacaciones)
					->setCellValue('I'.$i,$diaspendientes)
					->setCellValue('J'.$i,$nro_horasextras)
					->setCellValue('K'.$i,$nro_permisos)
					->setCellValue('L'.$i,$horaspendientes)
					->setCellValue('M'.$i,$nro_descansomedico);
				$i++;
			}
			$sheetrow = $i-1;

			$sheet->setCellValue('B3',$area);
		
			$sheet->getStyle('A1:M1')->applyFromArray($estilotitulo);
			$sheet->getStyle('A5:M5')->applyFromArray($estilocabecera);
			$sheet->getStyle('E4:I4')->applyFromArray($estilocabecera);
			$sheet->getStyle('J4:L4')->applyFromArray($estilocabecera);
			$sheet->getStyle('G6:I'.$sheetrow)->applyFromArray($formatonroundec);	
			
			$conditional1 = new Conditional();
			$conditional1->setConditionType( Conditional::CONDITION_CELLIS);
			$conditional1->setOperatorType( Conditional::OPERATOR_LESSTHAN);
			$conditional1->addCondition('0');
			$conditional1->getStyle()->getFont()->getColor()->setARGB( Color::COLOR_RED);
			$conditional1->getStyle()->getFont()->setBold(true);

			$conditional2 = new Conditional();
			$conditional2->setConditionType( Conditional::CONDITION_CELLIS);
			$conditional2->setOperatorType( Conditional::OPERATOR_GREATERTHANOREQUAL);
			$conditional2->addCondition('0');
			$conditional2->getStyle()->getFont()->getColor()->setARGB( Color::COLOR_BLUE);
			$conditional2->getStyle()->getFont()->setBold(true);

			$conditionalStyles = $sheet->getStyle('I6')->getConditionalStyles();
			$conditionalStyles[] = $conditional1;
			$conditionalStyles[] = $conditional2;

			$sheet->getStyle('I6:I'.$sheetrow)->setConditionalStyles($conditionalStyles);
			/*$sheet->duplicateStyle(
				$sheet->getStyle('I6'),
				'I7:I'.$sheetrow
			);*/

			$firstRow=5;
			$lastRow=$i-1;
			$sheet->setAutoFilter("B".$firstRow.":F".$lastRow);

			$sheet->setTitle('Permisos_area');

			$writer = new Xlsx($spreadsheet);

			$namesheet = "PermisosxArea--".$area.".xlsx";

			header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
			header('Content-Disposition: attachment;filename="'.$namesheet.'"');
			header('Cache-Control: max-age=0');										
														
			$writer->save('php://output');
			
	}

	public function excelresumenperm($id_empleado) { // Recupera resumen de permisos por empleados en excel	
		
	 /*Estilos*/ 
		$estilotitulo = [
			'font'	=> [
				'name' => 'SansSerif',
				'size' =>12,
				'bold' => true,
			], 
			'alignment' => [
				'horizontal' => Alignment::HORIZONTAL_CENTER,
			],
		];
		$estilocabecera = [
			'font'	=> [
				'bold' => true,
			], 
			'fill'	=>[
				'fillType' => Fill::FILL_SOLID,
				'startColor' => [
					'rgb' => 'ccffcc'
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
		$estiloceldas = [
			'borders'	=>[
				'allBorders' => [
					'borderStyle' => Border::BORDER_THIN,
					'color' => [ 
						'rgb' => '000000'
					]
				]
			],
			'alignment' => [
				'horizontal' => Alignment::HORIZONTAL_RIGHT,
				'vertical' => Alignment::VERTICAL_TOP,
				'wrapText' => true,
			],
		];
		$estilotexto = [
			'alignment' => [
				'horizontal' => Alignment::HORIZONTAL_LEFT,
				'vertical' => Alignment::VERTICAL_CENTER,
				'wrapText' => true,
			],
		];
		$nombempleado = [
			'font'	=> [
				'name' => 'SansSerif',
				'size' => 9,
				'bold' => true,
			], 
			'alignment' => [
				'horizontal' => Alignment::HORIZONTAL_CENTER,
				'vertical' => Alignment::VERTICAL_CENTER,
				'wrapText' => true,
			],
			'fill'	=>[
				'fillType' => Fill::FILL_SOLID,
				'startColor' => [
					'rgb' => '79ABF4'
				]
			],
		];
	 /* .Estilos*/
		
		$spreadsheet = new Spreadsheet();
		$sheet = $spreadsheet->getActiveSheet();

		$spreadsheet->getDefaultStyle()
			->getFont()
			->setName('SansSerif')
			->setSize(8);	

	 /*Cabecera*/	
		$sheet->setCellValue('A1','RESUMEN DE CONTROL DE PERMISOS')
			->mergeCells('A1:N1')
			->setCellValue('B3','EMPLEADO')
			->mergeCells('B3:F3')
			->setCellValue('G3','FECHA DE INGRESO')
			->setCellValue('B7','FECHA CUMPLE VACACIONES')
			->setCellValue('C7','PERIODOS DE VACACIONES')
			->setCellValue('D7','DIAS DE VACACIONES')
			->setCellValue('E7','MEDIOS DIAS A CUENTA DE VACACIONES')
			->setCellValue('F7','DIAS TOMADOS POR VACACIONES')
			->setCellValue('G7','DIAS PENDIENTES')
			->setCellValue('I7','TOTAL HORAS EXTRAS ACUMULADAS')
			->mergeCells('I7:J7')
			->setCellValue('K7','TOTAL HORAS PERMISOS ACUMULADOS')
			->mergeCells('K7:L7')
			->setCellValue('M7','HORAS PENDIENTES A USAR')
			->mergeCells('M7:N7')
			->setCellValue('B11','FECHAS DE SALIDA VACACIONES')
			->setCellValue('C11','FECHAS DE RETORNO VACACIONES')
			->setCellValue('D11','DIAS TOMADOS')
			->setCellValue('E11','OBSERVACIONES')
			->mergeCells('E11:G11')
			->setCellValue('I11','FECHA HORA EXTRA')
			->setCellValue('J11','HORAS EXTRAS')
			->setCellValue('K11','TOTAL HORAS')
			->setCellValue('L11','FECHA HORA PERMISOS')
			->setCellValue('M11','HORAS PERMISOS')
			->setCellValue('N11','HORAS UTILIZADAS');
	
		$sheet->getStyle('A1:M1')->applyFromArray($estilotitulo);
		$sheet->getStyle('B3:G3')->applyFromArray($estilocabecera);
		$sheet->getStyle('B7:G7')->applyFromArray($estilocabecera);
		$sheet->getStyle('I7:N7')->applyFromArray($estilocabecera);
		$sheet->getStyle('B11:G11')->applyFromArray($estilocabecera);
		$sheet->getStyle('I11:N11')->applyFromArray($estilocabecera);
		$sheet->getStyle('B4:G4')->applyFromArray($estiloceldas);
		$sheet->getStyle('B8:G8')->applyFromArray($estiloceldas);
		$sheet->getStyle('I8:N8')->applyFromArray($estiloceldas);

		$sheet->getColumnDimension('A')->setAutoSize(false)->setWidth(3.10);
		$sheet->getColumnDimension('B')->setAutoSize(false)->setWidth(14.10);
		$sheet->getColumnDimension('C')->setAutoSize(false)->setWidth(14.10);
		$sheet->getColumnDimension('D')->setAutoSize(false)->setWidth(13.10);
		$sheet->getColumnDimension('E')->setAutoSize(false)->setWidth(15.10);
		$sheet->getColumnDimension('F')->setAutoSize(false)->setWidth(15.10);
		$sheet->getColumnDimension('G')->setAutoSize(false)->setWidth(12.10);
		$sheet->getColumnDimension('H')->setAutoSize(false)->setWidth(3.10);
		$sheet->getColumnDimension('I')->setAutoSize(false)->setWidth(13.10);
		$sheet->getColumnDimension('J')->setAutoSize(false)->setWidth(12.10);
		$sheet->getColumnDimension('K')->setAutoSize(false)->setWidth(10.10);
		$sheet->getColumnDimension('L')->setAutoSize(false)->setWidth(13.10);
		$sheet->getColumnDimension('M')->setAutoSize(false)->setWidth(12.10);
		$sheet->getColumnDimension('N')->setAutoSize(false)->setWidth(12.10);

		$sheet->getRowDimension('3')->setRowHeight(23.10);
		$sheet->getRowDimension('7')->setRowHeight(33.10);
		$sheet->getRowDimension('11')->setRowHeight(33.10);
	 /* .Cabecera*/

	 /*Data*/
		$parametros = array( 
			'@idempleado'	=> $id_empleado
		);			
		$rptCabecera = $this->mctrlpermisos->getexcelresumenperm_cabecera($parametros);
		foreach($rptCabecera as $row){
			$empleado 				= $row->empleado;
			$fingreso 				= $row->fingreso;
			$fcumplevaca 			= $row->fcumplevaca;
			$periodovaca 			= $row->periodovaca;
			$diasvaca 				= $row->diasvaca;
			$nro_permcuentavaca 	= $row->nro_permcuentavaca;
			$nro_vacaciones 		= $row->nro_vacaciones;
			$totalvaca				= $nro_permcuentavaca + $nro_vacaciones;
			$diaspendientes 		= $row->diaspendientes;
			$nro_horasextras 		= $row->nro_horasextras;
			$nro_permisos 			= $row->nro_permisos;
			$horaspendientes 		= $row->horaspendientes;
			$estadoresultperm 		= $row->estadoresultperm;
			$estadoresultvaca 		= $row->estadoresultvaca;

			$sheet->setCellValue('B4',$empleado)				
					->setCellValue('G4',$fingreso)
					->mergeCells('B4:F4')
					->setCellValue('B8',$fcumplevaca)
					->setCellValue('C8',$periodovaca)
					->setCellValue('D8',$diasvaca)
					->setCellValue('E8',$nro_permcuentavaca)
					->setCellValue('F8',$nro_vacaciones)
					->setCellValue('G8',$diaspendientes)				
					->setCellValue('I8',$nro_horasextras)
					->mergeCells('I8:J8')				
					->setCellValue('K8',$nro_permisos)
					->mergeCells('K8:L8')				
					->setCellValue('M8',$horaspendientes)
					->mergeCells('M8:N8');

			$sheet->getStyle('G8')->getFill()->setFillType(Fill::FILL_SOLID);
			if($estadoresultvaca == '-'){
				$sheet->getStyle('G8')->getFill()->getStartColor()->setARGB('FF0000');
			}else{
				$sheet->getStyle('G8')->getFill()->getStartColor()->setARGB('FFFF00');
			}
			$sheet->getStyle('M8')->getFill()->setFillType(Fill::FILL_SOLID);
			if($estadoresultperm == '-'){
				$sheet->getStyle('M8')->getFill()->getStartColor()->setARGB('FF0000');
			}else{
				$sheet->getStyle('M8')->getFill()->getStartColor()->setARGB('FFFF00');
			}
		}
	
		$iv = 12;
		$rptVaca = $this->mctrlpermisos->getexcelresumenperm_listvaca($parametros);
		if ($rptVaca){
		foreach($rptVaca as $rowvaca){
			$vfecha_salida 		= $rowvaca->fecha_salida;
			$fecha_retorno 		= $rowvaca->fecha_retorno;
			$diastomados 		= $rowvaca->diastomados;
			$fundamentacion 	= $rowvaca->fundamentacion;

			$sheet->setCellValue('B'.$iv,$vfecha_salida)				
					->setCellValue('C'.$iv,$fecha_retorno)
					->setCellValue('D'.$iv,$diastomados)
					->setCellValue('E'.$iv,$fundamentacion)
					->mergeCells('E'.$iv.':G'.$iv);
			
			$sheet->getStyle('B'.$iv.':G'.$iv)->applyFromArray($estiloceldas);
			$sheet->getStyle('E'.$iv)->applyFromArray($estilotexto);

			$iv++;
		}}
		$sheet->setCellValue('B'.$iv,'TOTAL')
				->mergeCells('B'.$iv.':C'.$iv)
				->setCellValue('D'.$iv,$totalvaca);
		$sheet->getStyle('B'.$iv.':D'.$iv)->applyFromArray($estiloceldas);
		$sheet->getStyle('B'.$iv)->applyFromArray($estilotexto);
	
		$ix = 12;
		$rptExt = $this->mctrlpermisos->getexcelresumenperm_listext($parametros);
		if ($rptExt){
		foreach($rptExt as $rowext){
			$xfecha_salida 	= $rowext->fecha_salida;
			$horaextra 		= $rowext->horaextra;
			$totalhoras 	= $rowext->totalhoras;

			$sheet->setCellValue('I'.$ix,$xfecha_salida)				
					->setCellValue('J'.$ix,$horaextra)
					->setCellValue('K'.$ix,$totalhoras);
			
			$sheet->getStyle('I'.$ix.':K'.$ix)->applyFromArray($estiloceldas);

			$ix++;
		}}
		$sheet->setCellValue('I'.$ix,'TOTAL')
				->mergeCells('I'.$ix.':J'.$ix)
				->setCellValue('K'.$ix,$nro_horasextras);
		$sheet->getStyle('I'.$ix.':K'.$ix)->applyFromArray($estiloceldas);
		$sheet->getStyle('I'.$ix)->applyFromArray($estilotexto);
	
		$ip = 12;
		$rptPerm = $this->mctrlpermisos->getexcelresumenperm_listperm($parametros);
		if ($rptPerm){
		foreach($rptPerm as $rowperm){
			$pfecha_salida 	= $rowperm->fecha_salida;
			$horapermisos 	= $rowperm->horapermisos;
			$horasuso 		= $rowperm->horasuso;

			$sheet->setCellValue('L'.$ip,$pfecha_salida)				
					->setCellValue('M'.$ip,$horapermisos)
					->setCellValue('N'.$ip,$horasuso);
			
			$sheet->getStyle('L'.$ip.':N'.$ip)->applyFromArray($estiloceldas);

			$ip++;
		}}
		$sheet->setCellValue('L'.$ip,'TOTAL')
				->mergeCells('L'.$ip.':M'.$ip)
				->setCellValue('N'.$ip,$nro_permisos);
		$sheet->getStyle('L'.$ip.':N'.$ip)->applyFromArray($estiloceldas);
		$sheet->getStyle('L'.$ip)->applyFromArray($estilotexto);

		$sheet->getStyle('B4')->applyFromArray($estilotexto);
		$sheet->getStyle('B4')->applyFromArray($nombempleado);

	 /*. Data*/

		$sheet->setTitle('Resumen_Permisos');

		$writer = new Xlsx($spreadsheet);

		$namesheet = "ResumenPermiso-".$empleado.".xlsx";

		header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
		header('Content-Disposition: attachment;filename="'.$namesheet.'"');
		header('Cache-Control: max-age=0');										
														
		$writer->save('php://output');		
	}

	public function getlistvacaciones() { // Lista vacaciones x empleado   
		$parametros = array(
			'@id_empleado'    =>  $this->input->post('id_empleado')
		);		
		$resultado = $this->mctrlpermisos->getlistvacaciones($parametros);
		echo json_encode($resultado);
	}

	public function setvacaciones() {	// Registrar Vacaciones		
		$varnull = 	'';	

		$fecharegistro = $this->input->post('mtxtFregistrovaca');
		$fechasalida = $this->input->post('mtxtFsalvaca');
		$fecharetorno = $this->input->post('mtxtFretovaca');

		$parametros = array(
			'@idvacaciones' =>  $this->input->post('mhdnIdVaca'),
			'@fregistro'    =>  ($fecharegistro == $varnull) ? NULL : substr($fecharegistro, 6, 4).'-'.substr($fecharegistro,3 , 2).'-'.substr($fecharegistro, 0, 2),
			'@fsalida'    	=>  ($fechasalida == $varnull) ? NULL : substr($fechasalida, 6, 4).'-'.substr($fechasalida,3 , 2).'-'.substr($fechasalida, 0, 2),
			'@fretorno'    	=>  ($fecharetorno == $varnull) ? NULL : substr($fecharetorno, 6, 4).'-'.substr($fecharetorno,3 , 2).'-'.substr($fecharetorno, 0, 2),
			'@comentario'   =>  $this->input->post('mtxtFundamentovaca'),
			'@idempleado'   =>  $this->input->post('mhdnEmpVaca'),
			'@accion'    	=>  $this->input->post('mhdnAccionVaca'),
		);				
		$respuesta = $this->mctrlpermisos->setvacaciones($parametros);
		echo json_encode($respuesta);
	}

	public function getlistpermisos() { // Lista vacaciones x empleado   
		$parametros = array(
			'@id_empleado'    =>  $this->input->post('id_empleado')
		);		
		$resultado = $this->mctrlpermisos->getlistpermisos($parametros);
		echo json_encode($resultado);
	}


	public function getlisthorasextras() { // Lista horas extras x empleado	   
		$parametros = array(
			'@id_empleado'    =>  $this->input->post('id_empleado')
		);		
		$resultado = $this->mctrlpermisos->getlisthorasextras($parametros);
		echo json_encode($resultado);
	}		
	public function getlistpermisos1() { // Lista permisos x empleado	   
		$parametros = array(
			'@id_empleado'    =>  $this->input->post('id_empleado')
		);		
		$resultado = $this->mctrlpermisos->getlistpermisos($parametros);
		echo json_encode($resultado);
	}		
	public function guardarpermiso() {	// Registrar Permisos		
		$varnull 			= 	'';
		
		$fecharegistro = $this->input->post('mtxtFregistroperm');
		$fechasalida = $this->input->post('mtxtFsalperm');
		$fecharecupera = $this->input->post('mtxtFrecuperm');
		
        $parametros['@idpermiso'] 		= $this->input->post('mhdnIdpermiso');
        $parametros['@fregistro'] 		= ($fecharegistro == $varnull) ? NULL : substr($fecharegistro, 6, 4).'-'.substr($fecharegistro,3 , 2).'-'.substr($fecharegistro, 0, 2);
    	$parametros['@fsalida'] 		= ($fechasalida == $varnull) ? NULL : substr($fechasalida, 6, 4).'-'.substr($fechasalida,3 , 2).'-'.substr($fechasalida, 0, 2);
        $parametros['@hsalida'] 		= $this->input->post('mtxtHsalperm');
        $parametros['@hretorno'] 		= $this->input->post('mtxtHretorperm');
        $parametros['@motivo'] 			= $this->input->post('mcboMotivo');
        $parametros['@recuperahora'] 	= $this->input->post('cboRecuperahora');
        $parametros['@frecupera'] 		= ($fecharecupera == $varnull) ? NULL : substr($fecharecupera, 6, 4).'-'.substr($fecharecupera,3 , 2).'-'.substr($fecharecupera, 0, 2);
        $parametros['@fundamento'] 		= $this->input->post('mtxtFundamentoperm');
		$parametros['@accion'] 			= $this->input->post('mhdnAccionperm');
		$parametros['@idempleado'] 		= $this->input->post('hdregIdempleadoperm');
			
		$respuesta = $this->mctrlpermisos->guardarpermiso($parametros);
		echo json_encode($respuesta);
	}		
	public function sendEmailValidar() {  // Envio de Email para visto bueno  
		$emailrespomsable = $this->input->post('emailrespomsable');
		$tipo = $this->input->post('tipo');
		$token = $this->input->post('token');
		$idempleado = $this->input->post('idempleado');
		$idpermisosvacaciones = $this->input->post('idpermisosvacaciones');

		$datopermisosvacaciones = $this->mctrlpermisos->getpermisosvacaciones($idpermisosvacaciones);

		//cargamos la libreria email de CI
		$this->load->library("email");

		$empleado = $datopermisosvacaciones->datosrazonsocial;

		if($tipo = 'P'){
			$asunto = 'Solicitud de Permiso para '.$empleado;
			$tipopermiso = 'permiso para el dia '.$datopermisosvacaciones->fecha_salida.', desde '.$datopermisosvacaciones->hora_salida.' hasta '.$datopermisosvacaciones->hora_retorno;
		}else if($tipo = 'V'){
			$asunto = 'Solicitud de Vacaciones para '.$empleado;
			$tipopermiso = 'vacaciones desde el dia '.$datopermisosvacaciones->fecha_salida.' hasta '.$datopermisosvacaciones->fecha_retorno;
		}else if($tipo = 'X'){			
			$asunto = 'Horas fuera de horario laboral para '.$empleado;
			$tipopermiso = 'ingreso el dia '.$datopermisosvacaciones->fecha_salida.', desde '.$datopermisosvacaciones->fecha_retorno.' hasta '.$datopermisosvacaciones->hora_retorno;
		}			

		$emailData = $this->mglobales->getconfigemail('001');
		if($emailData){
			$mailhost = $emailData->DSERVER;
			$mailport = $emailData->NPUERTO;
			$mailuser = $emailData->DUSER;
			$mailpass = $emailData->DPASSWORD;
		}
		
		//configuracion para grupofs
		$configGrupofs = array(
			'protocol' => 'smtp',
			'smtp_host' => $mailhost,
			'smtp_port' => $mailport,
			'smtp_user' => $mailuser ,
			'smtp_pass' => $mailpass,
			'mailtype' => 'html',
			'charset' => 'utf-8',
			'newline' => "\r\n"
		);
 
        //cargamos la configuración para enviar con gmail
        $this->email->initialize($configGrupofs);
 
        $this->email->from('sistemas@grupofs.com');
        $this->email->to($emailrespomsable);
        $this->email->subject($asunto);
		$VarToken = $token;
		
			
		$html = '<h3>Estimado(a),</h3><br>';
		$html .= '<table><tr><td align="justify" colspan="3">La presente es para dar a conocer que el personal : '.$empleado.', a realizado una solicitud de '.$tipopermiso.'.
			<br><h3><small>Si esta de acuerdo Aceptar la solicitud, de lo contrario Cancelar.</small></h3></td></tr>';
		$html .= '<tr><td colspan="3"></td></tr>';
		$html .= '<tr ><td></td><td align="center" >';
		$html .= '<table cellpadding="0" cellmargin="0" border="0" height="44" width="320" style="border-radius: 8px; border:5px solid #0080FF">
			<tr>
		  		<td bgcolor="#0080FF" valign="middle" align="center" width="320">
					<div style="font-size: 18px; color: #ffffff; line-height: 1; margin: 0; padding: 0; mso-table-lspace:0; mso-table-rspace:0;">
			  			<a href="'.base_url("/crecursoshumanos/setValidarPermiso/$VarToken/$idempleado/$idpermisosvacaciones/1").'" style="text-decoration: none; color: #ffffff; border: 0; font-family: Arial, arial, sans-serif; mso-table-lspace:0; mso-table-rspace:0;" border="0">ACEPTAR SOLICITUD</a>
					</div>
		  		</td>
		  		<td bgcolor="#E11515" valign="middle" align="center" width="320">
					<div style="font-size: 18px; color: #ffffff; line-height: 1; margin: 0; padding: 0; mso-table-lspace:0; mso-table-rspace:0;">
			  			<a href="'.base_url("/crecursoshumanos/setValidarPermiso/$VarToken/$idempleado/$idpermisosvacaciones/2").'" style="text-decoration: none; color: #ffffff; border: 0; font-family: Arial, arial, sans-serif; mso-table-lspace:0; mso-table-rspace:0;" border="0">CANCELAR SOLICITUD</a>
					</div>
		  		</td>
			</tr>
	  	</table>'; 
	  	$html .= '</td><td></td></tr></table>';
		$html .= '<br><b>Recuerda :: </b>Si tienes dudas nos puedes contactar en el siguiente email - sistemas@grupofs.com<br><br>Atentamente,<br><br> Area de Sistemas.<br><br>';
		
		
		$this->email->message($html);

        if($this->email->send())
        {
        	return TRUE;
		}	
		else
		{
			return FALSE;
		}			
	}


	public function excelinformes() { // Recupera resumen de permisos por empleados en excel	

		$spreadsheet = new Spreadsheet();
		$sheet = $spreadsheet->getActiveSheet();

		$spreadsheet->getDefaultStyle()
			->getFont()
			->setName('Arial')
			->setSize(10);	

		$sheet->setCellValue('A1','Listado de Permisos por Area')									
			->setCellValue('A3','Area:')				
			->setCellValue('E4','Vacaciones')
			->setCellValue('J4','Permisos')
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

		$writer = new Xlsx($spreadsheet);

		$namesheet = "PermisosxArea.xlsx";

		header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
		header('Content-Disposition: attachment;filename="'.$namesheet.'"');
		header('Cache-Control: max-age=0');										
													
		$writer->save('php://output');
	}
   /* ------------- */

   

}
?>