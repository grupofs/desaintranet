<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Ccartasprov extends CI_Controller {
	function __construct() {
		parent:: __construct();	
		$this->load->model('at/ctrlprov/mcartasprov');
		$this->load->model('mglobales');
		$this->load->library('encryption');
		$this->load->helper(array('form','url','download','html','file'));
		$this->load->library('form_validation');
    }

	public function getclientes() { // recupera los clientes			
		$resultado = $this->mcartasprov->getclientes();
		echo json_encode($resultado);  
	}

	public function getbuscarcartas() { // recupera los cartas a proveedores
		$parametros = array(
            '@anio'   		=> $this->input->post('anio'),
            '@mes'   		=> $this->input->post('mes'),
            '@ccliente'   	=> $this->input->post('ccliente')
        );			
		$resultado = $this->mcartasprov->getbuscarcartas($parametros);
		echo json_encode($resultado);  
	}

	public function genpdfcartasprov($anio,$mes,$ccliente) { // recupera los cartas a proveedores
		$this->load->library('pdfgenerator');
		$filename = "Document_name";

		$html = "<html>
				<head>
					<style>
						@page {
							margin: 2cm 1.5cm;
							margin-top: 0.5cm;
							margin-bottom: 0.5cm;
						}
						.teacherPage {
								page: teacher;
								page-break-after: always;
						}
						table tbody tr td{
							font-family: 'Helvetica';
							font-size: 9pt;
						}
						.cuerpo {
							text-align: justify;
						}
					</style>
				</head>
				<body>";
		$parametros = array( 
            '@CCLIENTE'   	=> $ccliente,
            '@ANIO'   		=> $anio,
            '@MES'   		=> $mes,
            '@MESINSP'   	=> $mes,
		);			
		$resultado = $this->mcartasprov->getcartasprov($parametros);
		if ($resultado){
			foreach($resultado as $row){
				$contacto 				= $row->contacto;
				$cargo_contacto 		= $row->cargo_contacto;
				$empresa_contacto 		= $row->empresa_contacto;
				$cliente_drazonsocial 	= $row->cliente_drazonsocial;
				$fecha 					= $row->fecha;
				$dir_contacto 			= $row->dir_contacto;
				$departamento 			= $row->departamento;
				$drazonsocial 			= $row->drazonsocial;
				$establecimiento 		= $row->establecimiento;
				$mes 					= $row->mes;
				$costo 					= $row->costo;
				$firmante 				= $row->firmante;
				$cargo_firmante 		= $row->cargo_firmante;
				
				

				$html .= '<div class="teacherPage">				
					<page>					
					<table >
					<tbody>
						<tr>
							<td ALIGN="right">
								<img src="'.public_url_ftp().'Imagenes/formatos/1/01/02/cartas/00005/logo_tottus.jpg" width="160" height="70" />
							</td>
						</tr>
						<tr>
							<td>
								<span>'.$fecha.' </span>
								<p>&nbsp;</p>
								<span style="margin-top: 1mm;">Señor(a) </span><br>
								<span style="margin-top: 1mm;"><b>'.$contacto.'</b></span><br>
								<span style="margin-top: 1mm;">'.$cargo_contacto.'</span><br>
								<span style="margin-top: 1mm;"><b>'.$empresa_contacto.'</b> </span><br>
								<span style="margin-top: 1mm;">'.$dir_contacto.' </span><br>
								<span style="margin-top: 1mm;"><u><b>'.$departamento.' </b></u></span><br><br>
								<span style="margin-top: 6mm;">Estimado(a) Señor(a) </span><br><br>
							</td>
						</tr>
						<tr>
							<td class="cuerpo">
								<p>Me dirijo a usted para saludarle y en el marco del Programa de vigilancia y control de proveedores de '.$cliente_drazonsocial.', comunicarle que el establecimiento <b>'.$establecimiento.'</b> será inspeccionado en el transcurso del mes de <b>'.$mes.' - '.$anio.'</b>, por un inspector calificado de la empresa '.$drazonsocial.'.</p>
								<p>En tal sentido, se le recuerda que el objeto de la inspección  es verificar el nivel de cumplimiento de los Principios Generales de Higiene y del Sistema HACCP (en caso aplique) en el proceso de sus productos, a fin de garantizar la calidad  sanitaria de los productos que comercializan en '.$cliente_drazonsocial.', siendo el costo de la inspección de  <b>S/.  '.$costo.'</b>  más IGV, monto que será retenido de la facturación mensual. </p>
								<p>Adicionalmente, los proveedores ubicados a nivel nacional (excepto Lima Metropolitana) deberán asumir los gastos de pasajes, hospedaje y alimentación que incurra el inspector, los mismos que serán compartidos  entre los proveedores programados en la misma ciudad. Cabe señalar que este gasto puede ser retenido de la facturación mensual de Tottus o financiados directamente, previa coordinación con '.$drazonsocial.'.</p>
								<p>Asi mismo, se hace mencion que de darse una inspección trunca por no permitir el ingreso del inspector al establecimiento tendrá un costo según se muestra en la siguiente tabla:</p>
							</td>
						</tr>
						<tr>
							<td>
								<table style="width: 100%; border-collapse: collapse; margin-top: 2mm; ">
									<thead>
										<tr>
											<th style="border: solid 1px #000; width: 110px; border-collapse: collapse; text-align:center;">UBICACIONES</th>
											<th style="border: solid 1px #000; width: 490px; border-collapse: collapse; text-align:center;">COSTOS</th>
										</tr>
									</thead>
									<tbody >
										<tr>
											<td style="border: solid 1px #000; width: 110px; border-collapse: collapse; text-align:center;">LIMA</td>
											<td style="border: solid 1px #000; width: 490px; border-collapse: collapse; text-align:justify; padding: 0mm 2mm 0mm 2mm;">El costo por inspecciones canceladas con menos de dos dias utiles a la inspección,incluidas las cancelas cuando el inspector ha llegado al establecimiento, será del 30% en base al costo de la inspección mas IGV .</td>
										</tr>
										<tr>
											<td style="border: solid 1px #000; width: 110px; border-collapse: collapse; text-align:center;">A NIVEL NACIONAL (excepto Lima Metropolitana)</td>
											<td style="border: solid 1px #000; width: 490px; border-collapse: collapse; text-align:justify; padding: 0mm 2mm 0mm 2mm;">El costo por inspecciones canceladas con menos de 15 dias útiles de anticipación, incluidas las canceladas cuando el inspector ha llegado al establecimiento, será del 30% en base al costo de la inspección más IGV, según tipo de establecimiento, así como los gastos de viáticos que incurra el inspector.</td>
										</tr>
									</tbody>
								</table>
							</td>
						</tr>         
						<tr>
							<td class="cuerpo">
								<p>Asimismo, se hace de su conocimiento que la inspección a su establecimiento es un requisito para continuar como proveedor autorizado; por lo que, agradeceremos su cooperación a fin que la inspección se efectúe de la mejor manera y obtenga el mayor provecho de la asistencia técnica brindada por el inspector.</p>
								<p>Sin otro particular, agradeciendo de antemano la atención prestada, quedo de usted.</p>
								<p>Atentamente,</p><br>
							</td>
						</tr>         
						<tr>
						<td>
						<div>
							<table>
							<tr>
								<td style="text-align:center;">
									<img src="'.public_url_ftp().'Imagenes/formatos/1/01/02/cartas/00005/firma_PFano.jpg" width="180" height="120">
								</td>
								<td>&nbsp;</td>
							</tr>
							<tr>
								<td style="text-align:center;">------------------------------------------</td>
								<td>&nbsp;</td>
							</tr>
							<tr>
								<td style="text-align:center;">'.$firmante.'</td>
								<td>&nbsp;</td>
							</tr>
							<tr>
								<td style="text-align:center;">'.$cargo_firmante.'</td>
								<td>&nbsp;</td>
							</tr>
							<tr>
								<td style="text-align:center;">'.$cliente_drazonsocial.'</td>
								<td>&nbsp;</td>
							</tr>
							</table>
						</div>
						</td>
						</tr>  
					</tbody>
					</table>        
				 	</page>
				</div>';
			}
		}
		$html .= '</body></html>';
		//echo $html;
		$this->pdfgenerator->generate($html, $filename);
	}

	
}
?>