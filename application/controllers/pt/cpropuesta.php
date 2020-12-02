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
use PhpOffice\PhpSpreadsheet\IOFactory;

class Cpropuesta extends CI_Controller {
	function __construct() {
		parent:: __construct();	
		$this->load->model('pt/mpropuesta');
		$this->load->model('mglobales');
		$this->load->library('encryption');
		$this->load->helper(array('form','url','download','html','file'));
		$this->load->library('form_validation');
    }
    
   /** PROPUESTA **/ 	
    public function getclientepropu() {	// Visualizar Clientes con propuestas en CBO	
        
		$resultado = $this->mpropuesta->getclientepropu();
		echo json_encode($resultado);
	}
    public function getclienteinternopt() {	// Visualizar Clientes en CBO	
        
		$resultado = $this->mpropuesta->getclienteinternopt();
		echo json_encode($resultado);
	}
    public function getServicio() {	// Visualizar Servicios en CBO	
        
		$resultado = $this->mpropuesta->getServicio();
		echo json_encode($resultado);
	}
    public function getbuscarpropuesta() {	// Recupera Listado de Propuestas	
        
		$varnull 			= 	'';
		$celservicio 		= 	'';
		$celestado			= 	'';

		$ccliente   = $this->input->post('ccliente');
		$fini       = $this->input->post('fdesde');
		$ffin       = $this->input->post('fhasta');
		$cservicio  = $this->input->post('cservicio');
		$cestado    = $this->input->post('cestado');
		$dnrodet    = $this->input->post('dnrodet');
		$vigente    = $this->input->post('vigente');

        if(isset($cservicio)){
            foreach($cservicio as $dtiposerv){
                $celservicio = $dtiposerv.','.$celservicio;
            }
            $count =strlen($celservicio) ;
            $celservicio = substr($celservicio,0,$count-1);
        }
	
        if(isset($cestado)){
            foreach($cestado as $dest){
                $celestado = $dest.','.$celestado;
            }
            $countest =strlen($celestado) ;
            $celestado = substr($celestado,0,$countest-1);
        }
            
        $parametros = array(
			'@ccliente'     => ($this->input->post('ccliente') == '') ? '0' : $ccliente,
			'@fini'         => ($this->input->post('fdesde') == '%') ? NULL : substr($fini, 6, 4).'-'.substr($fini,3 , 2).'-'.substr($fini, 0, 2),
			'@ffin'         => ($this->input->post('fhasta') == '%') ? NULL : substr($ffin, 6, 4).'-'.substr($ffin,3 , 2).'-'.substr($ffin, 0, 2),
			'@cservicio'    => ($celservicio == $varnull) ? '%' :$celservicio,
			'@cestado'      => ($celestado == $varnull) ? '%' :$celestado,
			'@dnrodet'      => ($this->input->post('dnrodet') == $varnull) ? '%' : "%".$dnrodet."%",
			'@vigente'      => $vigente,
		);		
		$resultado = $this->mpropuesta->getbuscarpropuesta($parametros);
		echo json_encode($resultado);
	}

	public function excelpropu() {
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
        $celdasnumero = [
            'alignment' => [
                'horizontal' => Alignment::HORIZONTAL_RIGHT,
                'vertical' => Alignment::VERTICAL_CENTER,
                'wrapText' => true,
            ],
        ];
        $celdascentro = [
            'alignment' => [
                'horizontal' => Alignment::HORIZONTAL_CENTER,
                'vertical' => Alignment::VERTICAL_CENTER,
                'wrapText' => true,
            ],
        ];
	 /*Estilos */	
		$spreadsheet = new Spreadsheet();
		$sheet = $spreadsheet->getActiveSheet();
		$sheet->setTitle('Listado - Propuestas');

        $spreadsheet->getDefaultStyle()
            ->getFont()
            ->setName('Arial')
            ->setSize(9);
		
		$sheet->setCellValue('A1', 'Listado de Propuestas')
			->mergeCells('A1:I1')
			->setCellValue('A3', '#')
			->setCellValue('B3', 'Nro Propuesta')
			->setCellValue('C3', 'Fecha Propuesta')
			->setCellValue('D3', 'Cliente')
			->setCellValue('E3', 'Estado')
			->setCellValue('F3', 'Servicio')
			->setCellValue('G3', 'Detalle')
			->setCellValue('H3', 'Costo')
			->setCellValue('I3', 'Establecimiento');

		$sheet->getStyle('A1:I1')->applyFromArray($titulo);
        $sheet->getStyle('A3:I3')->applyFromArray($cabecera);

		$sheet->getColumnDimension('A')->setAutoSize(false)->setWidth(4.10);
		$sheet->getColumnDimension('B')->setAutoSize(false)->setWidth(20.10);
		$sheet->getColumnDimension('C')->setAutoSize(false)->setWidth(14.10);
		$sheet->getColumnDimension('D')->setAutoSize(false)->setWidth(41.10);
		$sheet->getColumnDimension('E')->setAutoSize(false)->setWidth(14.10);
		$sheet->getColumnDimension('F')->setAutoSize(false)->setWidth(45.10);
		$sheet->getColumnDimension('G')->setAutoSize(false)->setWidth(60.10);
		$sheet->getColumnDimension('H')->setAutoSize(false)->setWidth(12.10);
		$sheet->getColumnDimension('I')->setAutoSize(false)->setWidth(60.10);
		

		$varnull 			= 	'';
		$celservicio 		= 	'';
		$celestado			= 	'';

		$ccliente   = $this->input->post('cboClie');
		$fini       = $this->input->post('txtFIni');
		$ffin       = $this->input->post('txtFFin');
		$cservicio  = $this->input->post('cboServ');
		$cestado    = $this->input->post('cboEst');
		$dnrodet    = $this->input->post('txtnrodet');
		$vigente    = $this->input->post('swVigencia');

        if(isset($cservicio)){
            foreach($cservicio as $dtiposerv){
                $celservicio = $dtiposerv.','.$celservicio;
            }
            $count =strlen($celservicio) ;
            $celservicio = substr($celservicio,0,$count-1);
        }
	
        if(isset($cestado)){
            foreach($cestado as $dest){
                $celestado = $dest.','.$celestado;
            }
            $countest =strlen($celestado) ;
            $celestado = substr($celestado,0,$countest-1);
		}
		
		if($vigente == 'on'){
			$cvigente = 'A';
		}else{
			$cvigente = 'I';
		}
            
        $parametros = array(
			'@ccliente'     => ($this->input->post('cboClie') == '') ? '0' : $ccliente,
			'@fini'         => ($this->input->post('txtFIni') == '') ? NULL : substr($fini, 6, 4).'-'.substr($fini,3 , 2).'-'.substr($fini, 0, 2),
			'@ffin'         => ($this->input->post('txtFFin') == '') ? NULL : substr($ffin, 6, 4).'-'.substr($ffin,3 , 2).'-'.substr($ffin, 0, 2),
			'@cservicio'    => ($celservicio == $varnull) ? '%' :$celservicio,
			'@cestado'      => ($celestado == $varnull) ? '%' :$celestado,
			'@dnrodet'      => ($this->input->post('txtnrodet') == $varnull) ? '%' : "%".$dnrodet."%",
			'@vigente'      => $cvigente,
		);		
		$rpt = $this->mpropuesta->getbuscarpropuesta($parametros);
		$i = 1;
		$irow = 4;
        if ($rpt){
        	foreach($rpt as $row){
            
				$NROPROPU = $row->NROPROPU;
				$FECHPROPU = $row->FECHPROPU;
				$RAZONSOCIAL = $row->RAZONSOCIAL;
				$ESTPROPU = $row->ESTPROPU;
				$DESCRIPSERV = $row->DESCRIPSERV;
				$DETAPROPU = $row->DETAPROPU;
				$COSTOPROPU = $row->COSTOPROPU;
				$DESCRIPESTABLE = $row->DESCRIPESTABLE;							
				
                if($ESTPROPU == '1'){
                    $DESCESTADO = 'Aceptado';
				}  
                if($ESTPROPU == '2'){
                    $DESCESTADO = 'Pendiente';
				}  
                if($ESTPROPU == '3'){
                    $DESCESTADO = 'Rechazado';
				}  
                if($ESTPROPU == '4'){
                    $DESCESTADO = 'Reemplazada';
				}  
                if($ESTPROPU == '5'){
                    $DESCESTADO = 'Referencial';
				}  
				
				$sheet->setCellValue('A'.$irow,$i);
				$sheet->setCellValue('B'.$irow,$NROPROPU);
				$sheet->setCellValue('C'.$irow,$FECHPROPU);
				$sheet->setCellValue('D'.$irow,$RAZONSOCIAL);
				$sheet->setCellValue('E'.$irow,$DESCESTADO);
				$sheet->setCellValue('F'.$irow,$DESCRIPSERV);
				$sheet->setCellValue('G'.$irow,$DETAPROPU);
				$sheet->setCellValue('H'.$irow,$COSTOPROPU);
				$sheet->setCellValue('I'.$irow,$DESCRIPESTABLE);

				$i++;
				$irow++;
			}
		}
		$pos = $irow - 1;
		$sheet->getStyle('A4:I'.$pos)->applyFromArray($celdastexto);
		$sheet->getStyle('A4:A'.$pos)->applyFromArray($celdasnumero);
		$sheet->getStyle('H4:H'.$pos)->applyFromArray($celdasnumero);
		$sheet->getStyle('C4:C'.$pos)->applyFromArray($celdascentro);
		$sheet->getStyle('E4:E'.$pos)->applyFromArray($celdascentro);

		$sheet->setAutoFilter('B3:I'.$pos);
		

		$filename = 'listadoPropuestas-'.time().'.xlsx';

		// Redirect output to a client's web browser (Xlsx)
		header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
		header('Content-Disposition: attachment;filename="'.$filename.'"');
		header('Cache-Control: max-age=0');
		// If you're serving to IE 9, then the following may be needed
		header('Cache-Control: max-age=1');		
		// If you're serving to IE over SSL, then the following may be needed
		header('Expires: Mon, 26 Jul 2017 05:00:00 GMT'); // Date in the past
		header('Last-Modified: ' . gmdate('D, d M Y H:i:s') . ' GMT'); // always modified
		header('Cache-Control: cache, must-revalidate'); // HTTP/1.1
		header('Pragma: public'); // HTTP/1.

		$writer = IOFactory::createWriter($spreadsheet, 'Xlsx');
		$writer->save('php://output');
	}
	public function excelpropujs() {
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
        $celdasnumero = [
            'alignment' => [
                'horizontal' => Alignment::HORIZONTAL_RIGHT,
                'vertical' => Alignment::VERTICAL_CENTER,
                'wrapText' => true,
            ],
        ];
        $celdascentro = [
            'alignment' => [
                'horizontal' => Alignment::HORIZONTAL_CENTER,
                'vertical' => Alignment::VERTICAL_CENTER,
                'wrapText' => true,
            ],
        ];
	 /*Estilos */	
		$spreadsheet = new Spreadsheet();
		$sheet = $spreadsheet->getActiveSheet();
		$sheet->setTitle('Listado - Propuestas');

        $spreadsheet->getDefaultStyle()
            ->getFont()
            ->setName('Arial')
            ->setSize(9);
		
		$sheet->setCellValue('A1', 'Listado de Propuestas')
			->mergeCells('A1:I1')
			->setCellValue('A3', '#')
			->setCellValue('B3', 'Nro Propuesta')
			->setCellValue('C3', 'Fecha Propuesta')
			->setCellValue('D3', 'Cliente')
			->setCellValue('E3', 'Estado')
			->setCellValue('F3', 'Servicio')
			->setCellValue('G3', 'Detalle')
			->setCellValue('H3', 'Costo')
			->setCellValue('I3', 'Establecimiento');

		$sheet->getStyle('A1:I1')->applyFromArray($titulo);
        $sheet->getStyle('A3:I3')->applyFromArray($cabecera);

		$sheet->getColumnDimension('A')->setAutoSize(false)->setWidth(4.10);
		$sheet->getColumnDimension('B')->setAutoSize(false)->setWidth(20.10);
		$sheet->getColumnDimension('C')->setAutoSize(false)->setWidth(14.10);
		$sheet->getColumnDimension('D')->setAutoSize(false)->setWidth(41.10);
		$sheet->getColumnDimension('E')->setAutoSize(false)->setWidth(14.10);
		$sheet->getColumnDimension('F')->setAutoSize(false)->setWidth(45.10);
		$sheet->getColumnDimension('G')->setAutoSize(false)->setWidth(60.10);
		$sheet->getColumnDimension('H')->setAutoSize(false)->setWidth(12.10);
		$sheet->getColumnDimension('I')->setAutoSize(false)->setWidth(60.10);
		

		$varnull 			= 	'';
		$celservicio 		= 	'';
		$celestado			= 	'';

		$ccliente   = $this->input->post('ccliente');
		$fini       = $this->input->post('fdesde');
		$ffin       = $this->input->post('fhasta');
		$cservicio  = $this->input->post('cservicio');
		$cestado    = $this->input->post('cestado');
		$dnrodet    = $this->input->post('dnrodet');
		$vigente    = $this->input->post('vigente');

        if(isset($cservicio)){
            foreach($cservicio as $dtiposerv){
                $celservicio = $dtiposerv.','.$celservicio;
            }
            $count =strlen($celservicio) ;
            $celservicio = substr($celservicio,0,$count-1);
        }
	
        if(isset($cestado)){
            foreach($cestado as $dest){
                $celestado = $dest.','.$celestado;
            }
            $countest =strlen($celestado) ;
            $celestado = substr($celestado,0,$countest-1);
		}
		
		if($vigente == 'on'){
			$cvigente = 'A';
		}else{
			$cvigente = 'I';
		}
            
        $parametros = array(
			'@ccliente'     => ($this->input->post('ccliente') == '') ? '0' : $ccliente,
			'@fini'         => ($this->input->post('fdesde') == '%') ? NULL : substr($fini, 6, 4).'-'.substr($fini,3 , 2).'-'.substr($fini, 0, 2),
			'@ffin'         => ($this->input->post('fhasta') == '%') ? NULL : substr($ffin, 6, 4).'-'.substr($ffin,3 , 2).'-'.substr($ffin, 0, 2),
			'@cservicio'    => ($celservicio == $varnull) ? '%' :$celservicio,
			'@cestado'      => ($celestado == $varnull) ? '%' :$celestado,
			'@dnrodet'      => ($this->input->post('dnrodet') == $varnull) ? '%' : "%".$dnrodet."%",
			'@vigente'      => $vigente,
		);		
		$rpt = $this->mpropuesta->getbuscarpropuesta($parametros);
		$i = 1;
		$irow = 4;
        if ($rpt){
        	foreach($rpt as $row){
            
				$NROPROPU = $row->NROPROPU;
				$FECHPROPU = $row->FECHPROPU;
				$RAZONSOCIAL = $row->RAZONSOCIAL;
				$ESTPROPU = $row->ESTPROPU;
				$DESCRIPSERV = $row->DESCRIPSERV;
				$DETAPROPU = $row->DETAPROPU;
				$COSTOPROPU = $row->COSTOPROPU;
				$DESCRIPESTABLE = $row->DESCRIPESTABLE;							
				
                if($ESTPROPU == '1'){
                    $DESCESTADO = 'Aceptado';
				}  
                if($ESTPROPU == '2'){
                    $DESCESTADO = 'Pendiente';
				}  
                if($ESTPROPU == '3'){
                    $DESCESTADO = 'Rechazado';
				}  
                if($ESTPROPU == '4'){
                    $DESCESTADO = 'Reemplazada';
				}  
                if($ESTPROPU == '5'){
                    $DESCESTADO = 'Referencial';
				}  
				
				$sheet->setCellValue('A'.$irow,$i);
				$sheet->setCellValue('B'.$irow,$NROPROPU);
				$sheet->setCellValue('C'.$irow,$FECHPROPU);
				$sheet->setCellValue('D'.$irow,$RAZONSOCIAL);
				$sheet->setCellValue('E'.$irow,$DESCESTADO);
				$sheet->setCellValue('F'.$irow,$DESCRIPSERV);
				$sheet->setCellValue('G'.$irow,$DETAPROPU);
				$sheet->setCellValue('H'.$irow,$COSTOPROPU);
				$sheet->setCellValue('I'.$irow,$DESCRIPESTABLE);

				$i++;
				$irow++;
			}
		}
		$pos = $irow - 1;
		$sheet->getStyle('A4:I'.$pos)->applyFromArray($celdastexto);
		$sheet->getStyle('A4:A'.$pos)->applyFromArray($celdasnumero);
		$sheet->getStyle('H4:H'.$pos)->applyFromArray($celdasnumero);
		$sheet->getStyle('C4:C'.$pos)->applyFromArray($celdascentro);
		$sheet->getStyle('E4:E'.$pos)->applyFromArray($celdascentro);

		$sheet->setAutoFilter('B3:I'.$pos);
		

		$writer = new Xlsx($spreadsheet);		
		$filename = 'listadoPropuestas-'.time().'.xlsx';
		$ruta = "tmp_html/";
		try{
			$writer->save($ruta.'eder.xlsx');
			echo "    Archivo Creado";
		}
		catch(Exception $e){
			echo $e->getMessage();
		}
	}

    public function getnropropuesta() {	// Obtener numero de propuesta	
		
		$parametros = array(
            '@yearPropu'   => $this->input->post('yearPropu')
        );
		$resultado = $this->mpropuesta->getnropropuesta($parametros);
		echo json_encode($resultado);
	}
    public function getbuscarCliente() { // Tabla de busqueda de clientes	
        
		$resultado = $this->mpropuesta->getbuscarCliente();
		echo json_encode($resultado);
	}
    public function buscar_establexcliente() {	// Obtener numero de propuesta	
        $parametros = array(
            '@CCLIENTE'   => $this->input->post('ccliente')
        );
		$resultado = $this->mpropuesta->buscar_establexcliente($parametros);
		echo json_encode($resultado);
	}
    public function setpropuesta() { // Registrar informe PT
		$varnull = '';
		
		$idptpropuesta 		= $this->input->post('mhdnIdPropu');
		$ccliente 			= $this->input->post('mcboClie');
		$nro_propu 			= $this->input->post('mtxtNropropuesta');
		$fpropu 			= $this->input->post('mtxtFpropu');
		$idptservicio 		= $this->input->post('mcboServPropu');
		$detalle_propu 		= $this->input->post('mtxtDetaPropu');
		$costo_propu 		= $this->input->post('mtxtCostoPropu');
		$estado_propu 		= $this->input->post('mhdnEstadoPropu');
		$contacto_propu 	= $this->input->post('mtxtContacPropu');
		$observacion_propu 	= $this->input->post('mtxtObspropu');
		$servnuevomejor 	= $this->input->post('mtxtservnew');
		$clienpotencial 	= $this->input->post('mtxtClientePote');
		$usuario_creacion 	= $this->input->post('mtxtuserpropu');
		$tipo_costo 		= $this->input->post('txtTipomoneda');
		$idusuario 			= $this->input->post('mtxtidusupropu');
		$cestablecimiento 	= $this->input->post('mcboEstable');
		$accion 			= $this->input->post('mhdnAccionPropu');
        
        $parametros = array(
            '@idptpropuesta'   		=>  $idptpropuesta,
            '@ccliente'   			=>  $ccliente,
            '@nro_propu'      		=>  $nro_propu,
            '@fecha_propu'    		=>  substr($fpropu, 6, 4).'-'.substr($fpropu,3 , 2).'-'.substr($fpropu, 0, 2),
			'@idptservicio'    		=>  $idptservicio,
			'@detalle_propu'    	=>  $detalle_propu,
			'@costo_propu'    		=>  $costo_propu,
			'@estado_propu'    		=>  $estado_propu,
			'@contacto_propu'   	=>  $contacto_propu,
			'@observacion_propu'    =>  $observacion_propu,
			'@servnuevomejor'    	=>  $servnuevomejor,
			'@clienpotencial'    	=>  $clienpotencial,
			'@usuario_creacion'    	=>  $usuario_creacion,
			'@tipo_costo'    		=>  $tipo_costo,
            '@idusuario'      		=>  $idusuario,
            '@cestablecimiento'     =>  ($cestablecimiento == $varnull || $cestablecimiento == '%') ? '000000' : $this->input->post('mcboEstable'),
            '@accion'           	=>  $accion
        );
        $retorna = $this->mpropuesta->setpropuesta($parametros);
        echo json_encode($retorna);		
	}
	public function subirArchivo() {	// Subir Acrhivo 
        $IDPROPU    = $this->input->post('mhdnIdPropu');
        $ANIO       = substr($this->input->post('mtxtFpropu'),-4);
        $NOMBARCH 	= 'PROP'.substr($this->input->post('mtxtNropropuesta'),0,4).substr($this->input->post('mtxtNropropuesta'),5,4).'PTFS';
        
        $RUTAARCH   = 'FTPfileserver/Archivos/10201/'.$ANIO.'/';

        !is_dir($RUTAARCH) && @mkdir($RUTAARCH, 0777, true);

		//RUTA DONDE SE GUARDAN LOS FICHEROS
		$config['upload_path'] 		= $RUTAARCH;
		$config['allowed_types'] 	= 'pdf|xlsx|docx|xls|doc';
		$config['max_size'] 		= '60048';
		$config['overwrite'] 		= TRUE;
		$config['file_name']        = $NOMBARCH;
		
		$this->load->library('upload',$config);
		$this->upload->initialize($config);
		
		if (!($this->upload->do_upload('mtxtArchivopropu'))) {
			//si al subirse hay algun error 
			$data['uploadError'] = $this->upload->display_errors();
			$error = '';
			return $error;					
		}else{
			$data = $this->upload->data();
			$parametros = array(
                '@idptpropuesta'   	=>  $IDPROPU,
                '@propu_archivo'    =>  $data['file_name'],
                '@propu_ruta'       =>  $config['upload_path'],
                '@propu_nombarch'   =>  $this->input->post('mtxtNomarchpropu'),
            );
            $retorna = $this->mpropuesta->subirArchivo($parametros);
            echo json_encode($retorna);
		}	
	}
	public function delpropuesta() {	// Eliminar de propuesta	
		$idptpropuesta = $this->input->post('idptpropuesta');	
		$parametros = array(
			'@idptpropuesta' =>  $idptpropuesta
		);	
		$resultado = $this->mpropuesta->delpropuesta($parametros);
		echo json_encode($resultado);
	}
	public function updestadopropuesta() {	// Actualizar estado de propuesta
		$parametros = array(
			'@idptpropuesta' =>  $this->input->post('idpropu'),
			'@estado_propu' =>  $this->input->post('est')
		);	
		$resultado =  $this->mpropuesta->updestadopropuesta($parametros);
		echo json_encode($resultado);

	}		        
	public function getbuscardetapropu() {	// Recupera Listado de Documentos Propuestas		

		$parametros = array(
			'@idptpropuesta' =>  $this->input->post('idptpropuesta')
		);		
		$resultado = $this->mpropuesta->getbuscardetapropu($parametros);
		echo json_encode($resultado);
	}
	public function archivo_detpropuesta() {	// Subir Acrhivo detalle propuesta
        $ANIO           = substr($this->input->post('mtxtfechadetapropu'),-4); 
        $NROPROPU       = $this->input->post('mtxtnrodetapropu');
        $CANTDET        = $this->input->post('mtxtcantdetapropu');
        $NOMBARCH 	    = substr($NROPROPU,0,4).substr($NROPROPU,5,4).'PTFS';
        $RUTAARCH       = 'FTPfileserver/Archivos/10201/VARIOS/'.$ANIO.'/';

        !is_dir($RUTAARCH) && @mkdir($RUTAARCH, 0777, true);
		
		$data = array();
		$cpt = count($_FILES['mtxtDetArchivopropu']['name']);

		for($i=0; $i<$cpt; $i++)
		{
			$_FILES['userFile']['name']= $_FILES['mtxtDetArchivopropu']['name'][$i];
			$_FILES['userFile']['type']= $_FILES['mtxtDetArchivopropu']['type'][$i];
			$_FILES['userFile']['tmp_name']= $_FILES['mtxtDetArchivopropu']['tmp_name'][$i];
			$_FILES['userFile']['error']= $_FILES['mtxtDetArchivopropu']['error'][$i];
			$_FILES['userFile']['size']= $_FILES['mtxtDetArchivopropu']['size'][$i]; 

			//RUTA DONDE SE GUARDAN LOS FICHEROS
			$config['upload_path']      = $RUTAARCH;
			$config['allowed_types']    = 'pdf|xlsx|docx|xls|doc';
			$config['max_size']         = '60048';
			$config['remove_spaces']    = FALSE;
            $config['overwrite'] 		= TRUE;
            $config['file_name']        = 'PROP-VAR'.$NOMBARCH.'-'.substr('000'.($CANTDET+$i), -3);
			
			$this->load->library('upload',$config);
			$this->upload->initialize($config);

			if ($this->upload->do_upload('userFile')) {
				$fileData =  $this->upload->data(); 
				$data = array("upload_data" => $this->upload->data());
				$datos = array(
					"idptpropuesta" => $_POST['mtxtiddetapropu'],
					"ruta" => $RUTAARCH,
					"nombarchivo" => $data['upload_data']['file_name'],
					"descarchivo" => $data['upload_data']['client_name']
				);

				if ($this->mpropuesta->guardar_multiarchivopropu($datos)) {
					//echo "Registro guardado";
					$info[$i] = array(
						"archivo" => $data['upload_data']['file_name'],
						"mensaje" => "Archivo subido y guardado"
					);
				}
				else{
					//echo "Error al intentar guardar la informacion";
					$info[$i] = array(
						"archivo" => $data['upload_data']['file_name'],
						"mensaje" => "Archivo subido pero no guardado "
					);
				}				
			}else{
				$info[$i] = array(
					"archivo" => $_FILES['archivo']['name'],
					"mensaje" => "Archivo no subido ni guardado"
				);
			}	
		}

		$envio = "";
		foreach ($info as $key) {
			$envio .= "Archivo : ".$key['archivo']." - ".$key["mensaje"]."\n";
		}
		echo json_encode($envio);
	}
	public function deldetpropuesta(){ // Eliminar detalle propuesta				
		$item = $this->input->post('item');
		$respuesta = $this->mpropuesta->deldetpropuesta($item);
		echo json_encode($respuesta);									
	}
    public function getextnropropuesta() {	// Extender numero de propuesta	
		
		$parametros = array(
            '@nropropuesta'   => $this->input->post('nropropuesta')
        );
		$resultado = $this->mpropuesta->getextnropropuesta($parametros);
		echo json_encode($resultado);
	}
    
}
?>