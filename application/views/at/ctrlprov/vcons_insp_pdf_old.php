<html lang="es">
<head>
	<title>Ficha tecnica</title>
	<meta http-equiv="Content-Type" content="charset=utf-8"/>
	<style type="text/css">
		@page {
			margin: 48px;
			font-size: 16px;
			font-family: Arial;
		}

		#header {
			position: fixed;
			top: 0px;
			left: 0px;
			right: 0px;
			height: 100px;
		}

		.wrapper-page {
			width: 100%;
			height: 100%;
		}

		.new-page {
			margin-top: 120px;
		}

		.col-1 {
			width: 8.333333%;
		}

		.col-2 {
			width: 16.666667%;
		}

		.col-3 {
			width: 25%;
		}

		.col-4 {
			width: 33.333333%;
		}

		.col-5 {
			width: 41.666667%;
		}

		.col-6 {
			width: 50%;
		}

		.col-7 {
			width: 58.333333%;
		}

		.col-8 {
			width: 66.666667%;
		}

		.col-9 {
			width: 75%;
		}

		.col-10 {
			width: 83.333333%;
		}

		.col-11 {
			width: 91.666667%;
		}

		.col-12 {
			width: 100%;
		}

		.text-center {
			text-align: center;
		}

		.text-left {
			text-align: left;
		}

		.text-right {
			text-align: right;
		}

		.text-justify {
			text-align: justify;
		}

		.uppercase {
			text-transform: uppercase;
		}

		.font-weigth-bold {
			font-weight: bold;
		}

		.text-caratula {
			font-size: 20px;
		}

		.text-16 {
			font-size: 16px;
		}

		.text-12 {
			font-size: 12px;
		}

		.text-14 {
			font-size: 14px;
		}

		.bg-gray {
			background: #a2a1a1;
		}

		.border-gray {
			border: 1px solid #6b6a6a
		}

		.bg-green {
			background: #31a721;
		}

		.table {
			width: 100%;
			border-spacing: 0 0;
			border-collapse: collapse;
			border-color: #6b6a6a;
		}

		.table-bordered {
			border: 1px solid #6b6a6a;
		}

		.table td {
			padding: 5px;
		}

		.table th {
			padding: 8px;
		}

		.table-bordered td, .table-bordered th {
			border: 1px solid #6b6a6a;
		}
	</style>
</head>
<body>
<div id="header">
	<div class="col-12">
		<table class="table">
			<tr>
				<td class="col-8">
					<img src="<?php echo base64ResourceConvert(base_url('assets/images/logoGrupoFS.jpg')) ?>"
						 alt="GRUPOFS" style="width: 320px; height: 100px">
				</td>
				<td class="col-4 text-right" style="vertical-align: top">
					Av. Del Pinar 110 of. 405 - 407 <br>
					Urb. Chacarilla del Estanque <br>
					Santiago de Surco - Lima - Perú <br>
					(51-1)372-1734 / 372-8182 <br>
					www.grupofs.com
				</td>
			</tr>
		</table>
	</div>
</div>
<script type="text/php">
    if (isset($pdf)) {
        $text = "Pag. {PAGE_NUM} de {PAGE_COUNT}";
        $size = 14;
        $font = $fontMetrics->getFont("Arial");
        $width = $fontMetrics->get_text_width($text, $font, $size) / 2;
        $x = $pdf->get_width() - $width + 25;
        $y = $pdf->get_height() - 35;
		$pdf->page_text($x, $y, $text, $font, $size);
    }

</script>
<page>
	<div class="col-12 text-caratula new-page">
		<table class="table" style="">
			<tr>
				<td class="col-12 text-center"
					style="height: 200px; vertical-align: middle;">
					INFORME TECNICO N° <?php echo $caratula->dinforme ?>
				</td>
			</tr>
			<tr>
				<td class="col-12" style="border: 0; padding: 0;">
					<table class="table bg-gray border-gray">
						<tr>
							<td class="col-12 text-center font-weigth-bold">
								INSPECCION SANITARIA
							</td>
						</tr>
						<tr>
							<td class="col-12 text-center font-weigth-bold uppercase" style="padding: 15px">
								PROGRAMA DE <?php echo $caratula->dsubservicio ?> <br>
								<?php echo $caratula->nomcliente ?>
							</td>
						</tr>
					</table>
				</td>
			</tr>
			<tr>
				<td class="col-12 text-center" style="height: 200px; vertical-align: middle">
					<p class="uppercase">
						<?php echo $caratula->proveedor; ?>
					</p>
				</td>
			</tr>
			<tr>
				<td class="col-12 text-center" style="height: 150px; vertical-align: middle">
					<p class="uppercase">
						LINEA: <?php echo $caratula->lineaprocesoclte ?>
					</p>
				</td>
			</tr>
			<tr>
				<td class="col-12 text-center" style="height: 220px; vertical-align: middle">
					<p class="uppercase">
						<?php
						$fservicio = explode('-', $caratula->fservicio);
						echo $fservicio[2] . ' DE ' . getMonthText($fservicio[1]) . ' DE ' . $fservicio[0];
						?>
					</p>
				</td>
			</tr>
		</table>
	</div>
</page>
<page>
	<div class="col-12 new-page">
		<table class="table">
			<tr>
				<td class="col-12 text-center" style="padding: 10px;">
					RESUMEN EJECUTIVO
				</td>
			</tr>
			<tr>
				<td class="col-12 text-justify">
					<?php echo $parrafo1Pt1; ?> <br>
					<?php echo $parrafo1Pt2; ?>
				</td>
			</tr>
			<tr>
				<td class="col-12" style="">
					<table class="table" cellpadding="0">
						<tr>
							<th colspan="2" class="col-12 text-center bg-gray border-gray">
								CALIFICACIÓN DEL PROVEEDOR -&nbsp;
								<?php
								$fservicio = explode('-', $cuadro1->fservicio);
								echo getMonthText($fservicio[1]) . ' ' . $fservicio[0];
								?>
							</th>
						</tr>
						<tr>
							<td class="col-4 text-center border-gray">
								Puntaje Final
							</td>
							<td class="col-6 text-center border-gray">
								<?php echo $cuadro1->presultadochecklist ?>%
							</td>
						</tr>
						<tr>
							<td class="col-4 text-center border-gray">
								Calificación
							</td>
							<td class="text-6 text-center" style="padding: 0">
								<table class="table">
									<tr>
										<td class="col-4 text-center border-gray">
											<?php echo $cuadro1->descripcion_result ?>
										</td>
										<td class="col-6 text-center bg-green border-gray">
											&nbsp;
										</td>
									</tr>
								</table>
							</td>
						</tr>
					</table>
				</td>
			</tr>
			<tr>
				<td class="col-12 text-justify">
					<?php echo $parrafo2; ?>
				</td>
			</tr>
			<tr>
				<td class="col-12 text-center" style="padding: 10px">
					CUMPLIMIENTO ENTRE INSPECCIONES
				</td>
			</tr>
			<tr>
				<td class="col-12">
					<img src="<?php echo base64ResourceConvert($imgGrafico1); ?>" alt="Grafico-1"
						 style="width: 100%; height: 450px">
				</td>
			</tr>
		</table>
	</div>
</page>
<page>
	<div class="col-12 new-page" style="width: 100%; height: 83%">
		<table class="table">
			<tr>
				<td class="col-12 text-center" style="padding: 10px;">
					RESULTADO DE LA INSPECCION
				</td>
			</tr>
		</table>
		<table class="table table-bordered text-12">
			<tr>
				<td colspan="7" class="col-12 text-center bg-gray">
					Listado de Verificación
				</td>
			</tr>
			<tr>
				<td class="text-center bg-gray" style="width: 30px">
					N°
				</td>
				<td class="text-center bg-gray" style="width: 300px">
					Aspecto Evaluado
				</td>
				<td class="text-center bg-gray" style="width: 60px">
					Puntaje <br> Maximo
				</td>
				<td class="text-center bg-gray" style="width: 60px">
					Puntaje <br> Obtenido
				</td>
				<td class="text-center bg-gray">
					% de <br> Conformidad
				</td>
				<td class="text-center bg-gray" style="width: 60px">
					% <br> Peso
				</td>
				<td class="text-center bg-gray" style="width: 60px">
					% de <br> Conf. Final
				</td>
			</tr>
			<?php
			$totalRequisitos = 0;
			$totalMayorVal = 0;
			?>
			<?php if (!empty($cuadro2)) { ?>
				<?php foreach ($cuadro2 as $key => $value) { ?>
					<tr>
						<td class="text-center" style="width: 30px">
							<?php echo $value->dnumerador ?>
						</td>
						<td class="text-left" style="width: 300px">
							<?php echo $value->drequisito ?>
						</td>
						<td class="text-center" style="width: 60px">
							<?php echo $value->nvalorrequisito ?>
						</td>
						<td class="text-center" style="width: 60px">
							<?php echo $value->mayor_val ?>
						</td>
						<td class="text-center">
							<?php echo round(($value->nvalorrequisito * 100) / $value->mayor_val, 2) . '%'; ?>
						</td>
						<td class="text-center bg-gray" style="width: 60px">
							<?php echo '' ?>
						</td>
						<td class="text-center bg-gray" style="width: 60px">
							<?php echo '' ?>
						</td>
					</tr>
					<?php
					$totalRequisitos += $value->nvalorrequisito;
					$totalMayorVal += $value->mayor_val;
					?>
				<?php } ?>
			<?php } ?>
			<tr>
				<td class="text-center" colspan="2">
					Puntaje Parcial
				</td>
				<td class="text-center">
					<?php echo $totalRequisitos; ?>
				</td>
				<td class="text-center">
					<?php echo $totalMayorVal; ?>
				</td>
				<td class="text-center" colspan="3">
					<?php echo ($totalMayorVal > 0) ? round(($totalRequisitos * 100) / $totalMayorVal, 2) : 0; ?>%
				</td>
			</tr>
			<tr>
				<td class="text-center" colspan="2">
					Puntaje Final
				</td>
				<td class="text-center" colspan="5">
					<?php echo '100.00%'; ?>
				</td>
			</tr>
		</table>
	</div>
</page>
<page>
	<div class="col-12 new-page" style="width: 100%; height: 83%">
		<?php if (!empty($imgGrafico2)) { ?>
			<table class="table">
				<tr>
					<td class="col-12 text-center uppercase" style="padding: 10px;">
						<?php echo $caratula->proveedor; ?>
					</td>
				</tr>
				<tr>
					<td class="col-12">
						<img src="<?php echo base64ResourceConvert($imgGrafico2); ?>" alt="Grafico-1"
							 style="width: 100%; height: 350px">
					</td>
				</tr>
				<tr>
					<td class="col-12 text-center">
						Aspectos Evaluados
					</td>
				</tr>
			</table>
		<?php } ?>
		<div class="text-left uppercase" style="margin-bottom: 10px">
			I. <span style="margin-left: 5px">INFORMACIÓN GENERAL</span>
		</div>
		<table class="table table-bordered text-12">
			<tr>
				<td colspan="2" class="col-12 text-left bg-gray">
					DATOS DEL PROVEEDOR
				</td>
			</tr>
			<tr>
				<td class="col-3 text-left">
					Razon Social
				</td>
				<td class="col-9 text-left">
					<?php echo (!empty($cuadro3)) ? $cuadro3->prov_drazonsocial : ''; ?>
				</td>
			</tr>
			<tr>
				<td class="col-3 text-left">
					R.U.C
				</td>
				<td class="col-9 text-left">
					<?php echo (!empty($cuadro3)) ? $cuadro3->prov_nruc : ''; ?>
				</td>
			</tr>
			<tr>
				<td class="col-3 text-left">
					Dirección
				</td>
				<td class="col-9 text-left">
					<?php echo (!empty($cuadro3)) ? $cuadro3->prov_ddireccioncliente . ' ' . $cuadro3->prov_ubigeo : ''; ?>
				</td>
			</tr>
			<tr>
				<td class="col-3 text-left">
					Representante
				</td>
				<td class="col-9 text-left">
					<?php echo (!empty($cuadro3)) ? $cuadro3->drepresentante : ''; ?>
				</td>
			</tr>
			<tr>
				<td colspan="2" class="col-12 text-left bg-gray">
					DATOS DE LA EMPRESA MAQUILADORA
				</td>
			</tr>
			<tr>
				<td class="col-3 text-left">
					Razon Social
				</td>
				<td class="col-9 text-left">
					<?php echo (!empty($cuadro3)) ? $cuadro3->maqui_drazonsocial : ''; ?>
				</td>
			</tr>
			<tr>
				<td class="col-3 text-left">
					R.U.C
				</td>
				<td class="col-9 text-left">
					<?php echo (!empty($cuadro3)) ? $cuadro3->maqui_nruc : ''; ?>
				</td>
			</tr>
			<tr>
				<td class="col-3 text-left">
					Dirección
				</td>
				<td class="col-9 text-left">
					<?php echo (!empty($cuadro3) && !empty($cuadro3->maqui_ddireccioncliente)) ? $cuadro3->maqui_ddireccioncliente . ' ' . $cuadro3->maqui_ubigeo : ''; ?>
				</td>
			</tr>
			<tr>
				<td colspan="2" class="col-12 text-left bg-gray">
					INFORMACION ADICIONAL
				</td>
			</tr>
			<tr>
				<td class="col-3 text-left">
					Fecha de Inspección
				</td>
				<td class="col-9 text-left">
					<?php
					if (!empty($cuadro3)) {
						$fechaInsp = explode('-', $cuadro3->fservicio);
						echo $fechaInsp[2] . ' ' . getMonthText(intval($fechaInsp[1]) . ' ' . $fechaInsp[0]);
					}
					?>
				</td>
			</tr>
			<tr>
				<td class="col-3 text-left">
					Lugar de Inspección
				</td>
				<td class="col-9 text-left">
					<?php echo (!empty($cuadro3)) ? $cuadro3->DIRESTPROV . ' ' . $cuadro3->UBIGEOESTCLTE : ''; ?>
				</td>
			</tr>
			<tr>
				<td colspan="2" class="col-12 text-left">
					Responsable de la
					inspección <?php echo (!empty($cuadro3)) ? $cuadro3->dapepat . ' ' . $cuadro3->dapemat . ' ' . $cuadro3->dnombre : '-'; ?>
					(Jefe de Gestión de la Calidad)
				</td>
			</tr>
			<tr>
				<td colspan="2" class="col-12 text-left">
					<?php echo (!empty($cuadro3)) ? $cuadro3->dadicionallicencia : ''; ?>
				</td>
			</tr>
			<tr>
				<td class="col-3 text-left">
					Certificados / otros
				</td>
				<td class="col-9 text-left">
					<?php echo (!empty($cuadro3)) ? $cuadro3->CERTIFICACION . '-' . $cuadro3->dpermisoautoridadsanitaria : ''; ?>
				</td>
			</tr>
			<tr>
				<td class="col-3 text-left">
					Inspector
				</td>
				<td class="col-9 text-left">
					<?php echo (!empty($cuadro3)) ? $cuadro3->insp_dnombre . ' ' . $cuadro3->insp_dapepat . ' ' . $cuadro3->insp_dapemat : ''; ?>
				</td>
			</tr>
		</table>
	</div>
</page>
<page>
	<div class="col-12 new-page">
		<div class="text-left uppercase" style="margin-bottom: 10px">
			II. <span style="margin-left: 5px">OBJETIVOS</span>
		</div>
		<div class="text-left text-justify">
			Verificar las condiciones sanitarias del proceso de producción de alimentos, en
			cumplimiento a los criterios de inspección, que permita a <?php echo $caratula->nomcliente ?>
			asegurar la calidad sanitaria de sus diferentes establecimientos ubicados a nivel
			nacional.
		</div>
		<div class="text-left uppercase" style="margin: 10px 0">
			III. <span style="margin-left: 5px">ALCANSE</span>
		</div>
		<div class="text-left text-justify">
			<table class="table">
				<tr>
					<td class="col-2">
						Linea
					</td>
					<td class="col-10">
						: <?php echo (!empty($cuadro1)) ? $cuadro1->alcance : ''; ?>
					</td>
				</tr>
				<tr>
					<td class="col-2">
						Marca
					</td>
					<td class="col-10">
						: <?php echo (!empty($cuadro1)) ? $cuadro1->marca : ''; ?>
					</td>
				</tr>
			</table>
		</div>
		<div class="text-left uppercase" style="margin: 10px 0">
			IV. <span style="margin-left: 5px">CRITERIOS DE INSPECCION</span>
		</div>
		<div class="col-12 text-justify">
			<div class="col-12">
				<?php echo (!empty($criterioInspeccion)) ? nl2br($criterioInspeccion->dcriterios) : ''; ?>
			</div>
		</div>
		<div class="text-left uppercase" style="margin: 10px 0">
			V. <span style="margin-left: 5px">CRITERIOS DE EVALUACION Y CALIFICACION</span>
		</div>
		<div class="text-left text-justify">
			<div class="col-12">5.1 <span style="margin-left: 5px">Criterios de evaluación</span></div>
			<table class="table table-bordered text-12" style="margin: 10px 0">
				<?php if (!empty($criterioEvaluacion)) { ?>
					<?php foreach ($criterioEvaluacion as $key => $value) { ?>
						<tr>
							<td style="text-align: center; width: 100px" >
								<?php echo $value->cdetallevalor ?>
							</td>
							<td style="text-align: center; width: 180px" >
								<?php echo $value->ddetallevalor ?>
							</td>
							<td style="text-align: center; width: 360px" >
								<?php echo $value->dvaloracion ?>
							</td>
						</tr>
					<?php } ?>
				<?php } ?>
			</table>
		</div>
	</div>
</page>
<page>
	<div class="col-12 new-page">
		<div class="col-12">5.1.8 <span style="margin-left: 5px">Observacion levantada (OL)</span><br>
			Es el cumplimiento de las correcciones o acciones correctivas para eliminar una
			observación identificada previamente.
		</div>
		<div class="col-12">5.1.9 <span style="margin-left: 5px">No conformidad levantada (NCL)</span><br>
			Es el cumplimiento de las correcciones o acciones correctivas para eliminar una
			conformidad identificada previamente.
		</div>
		<div class="col-12">5.2 <span style="margin-left: 5px">Criterios de calificación</span></div>
		<div class="col-12 text-justify">
			La inspeccción es realizada con la ayuda de una lista de verificación es pecífica para la linea
			inspeccionada,
			acorde a la normativa sanitaria aplicable, el cual permite evaluar los requisitos sanitarios referidos a los
			Programas de Prerequisitos (PPR), al Sistema de Análisis de Peligros y puntos Críticos de Control (HACCP)
			en caso aplique y al Sistema de Gestión de Inocuidad. <br>
			Cada requisito es valorado de acuerdo a lo indicado en la siguiente escala:
			<table class="table table-bordered" style="margin: 10px 0">
				<tr>
					<td colspan="2" class="col-12 text-center bg-gray">
						Escala de Valoración
					</td>
				</tr>
				<tr>
					<td class="text-center" style="width: 60px">4</td>
					<td class="text-left" style="width: 550px">Cumplimiento total del requisito</td>
				</tr>
				<tr>
					<td class="text-center" style="width: 60px">2</td>
					<td class="text-left" style="width: 550px">Cumplimiento parcial del requisito</td>
				</tr>
				<tr>
					<td class="text-center" style="width: 60px">0</td>
					<td class="text-left text-justify" style="width: 550px">
						Incumplimiento total del requisito evaluado o incumplimiento reiterativo. Esta
						valoración se utiliza cuando se detecta una No Conformidad, o un incumplimiento
						parcial o total relacionado a trazabilidad, rotulado y quejas.
					</td>
				</tr>
				<tr>
					<td class="text-center" style="width: 60px">N.A.</td>
					<td class="text-left" style="width: 550px">Requisito no aplica</td>
				</tr>
				<tr>
					<td class="text-center" style="width: 60px">N.E.</td>
					<td class="text-left" style="width: 550px">Requisito no evaluado</td>
				</tr>
				<tr>
					<td class="text-center" style="width: 60px">S.C.</td>
					<td class="text-left" style="width: 550px">Sin calificar</td>
				</tr>
			</table>
		</div>
		<div class="col-12 text-justify">
			Cabe señalar que la lista de verificación contiene 8 requisitos ex cluyentes que son considerados
			estrarégicos
			para <?php echo $caratula->nomcliente ?> por su importancia para asegurar la calidad sanitaria e inocuidad
			de los productos que comercializa.
		</div>
		<table class="table table-bordered" style="margin-top: 10px">
			<tr>
				<td colspan="2" class="text-center bg-gray">
					Requisitos excluyentes
				</td>
			</tr>
			<tr>
				<td class="text-center bg-gray" style="width: 80px;">
					N° <br> Requisito
				</td>
				<td class="text-center bg-gray" style="width: 530px;">
					Descripción del requisito
				</td>
			</tr>
			<tr>
				<td class="text-left" style="width: 80px">
					1.1.2.1
				</td>
				<td class="text-left text-justify" style="width: 530px">
					El diseño del establecimiento permite el flujo adecuado de personal; materia
					prima e insumos; equipos rodantes; residuos; aire; ubicación de dispositivos de
					control de plagas, laboratorio, otros, evitando la contaminación cruzada.
				</td>
			</tr>
			<tr>
				<td class="text-left" style="width: 80px">
					1.1.10.1
				</td>
				<td class="text-left text-justify" style="width: 530px">
					Los equipos, superficies de trabajo y otros materiales se encuentran en
					adecuadas condiciones de limpieza y/o desinfección.
				</td>
			</tr>
			<tr>
				<td class="text-left" style="width: 80px">
					1.1.11.1
				</td>
				<td class="text-left text-justify" style="width: 530px">
					El establecimiento está libre de insectos, roedores, pájaros, animales
					domésticos o silvestres o de señales (heces, manchas de grasa, senderos,
					etc.) que pudieran indicar la presencia de éstos en las áreas de
					procesamiento, almacenes y exteriores.
				</td>
			</tr>
			<tr>
				<td class="text-left" style="width: 80px">
					1.2.1.1
				</td>
				<td class="text-left text-justify" style="width: 530px">
					El personal demuestra la aplicación de buenas prácticas de manufactura en
					cuanto al aseo y presentación personal así como en las actividades que
					desarrolla (Ej.: No transita por áreas no autorizadas, se lava las manos cuando
					es necesario, no porta joyas u otros elementos decorativos, practica los
					buenos hábitos, etc.).
				</td>
			</tr>
		</table>
	</div>
</page>
<page>
	<div class="col-12 new-page" style="width: 100%; height: 83%">
		<table class="table table-bordered" style="margin-bottom: 10px">
			<tr>
				<td class="text-left" style="width: 80px">
					1.2.4.1
				</td>
				<td class="text-left text-justify" style="width: 530px">
					Se ha establecido un programa para la formación del personal, tomando en
					cuenta los requisitos del producto y las necesidades de formación del personal.
					Este programa incluye: temas, frecuencia, lista de participantes, expositor,
					entre otra información relevante; así mismo, está dirigido a todo el personal
					(permanente, eventual, operario, técnico, gerencial). Los registros que se
					llevan demuestran que el programa se cumple de acuerdo a lo establecido.
				</td>
			</tr>
			<tr>
				<td class="text-left" style="width: 80px">
					1.3.2.1
				</td>
				<td class="text-left text-justify" style="width: 530px">
					Se han establecido sistemas que permitan reducir el riesgo de contaminación
					de los alimentos por materias extrañas y peligros físicos (fragmentos de
					vidrios, plástico quebradizo, plástico duro, metal, astillas de madera u otros
					elementos).
				</td>
			</tr>
			<tr>
				<td class="text-left" style="width: 80px">
					1.3.3.1
				</td>
				<td class="text-left text-justify" style="width: 530px">
					Se han establecido sistemas que permitan reducir el riesgo de contaminación
					de los alimentos por peligros químicos (polvo, humo nocivo y sustancias
					químicas indeseables).
				</td>
			</tr>
			<tr>
				<td class="text-left" style="width: 80px">
					1.4.4.1
				</td>
				<td class="text-left text-justify" style="width: 530px">
					Se identifican y controlan parámetros críticos en las etapas de procesamiento,
					que repercutan en la inocuidad del producto final. Los resultados del monitoreo
					y las acciones que de el deriven se registran.
				</td>
			</tr>
		</table>
		<div class="col-12 text-justify">
			En función al puntaje obtenido por el proveedor en la inspección sanitaria, puede ser clasificado según la
			siguiente escala; asi mismo se le asigna una identificación por color.
		</div>
		<table class="table table-bordered" style="margin: 10px 0">
			<tr>
				<td colspan="3" class="text-center bg-gray">
					Escala de Clasificación del Proveedor
				</td>
			</tr>
			<tr>
				<td class="text-center bg-gray" style="width: 150px;">
					Calificación
				</td>
				<td class="text-center bg-gray" style="width: 220px;">
					Rango de Cumplimiento
				</td>
				<td class="text-center bg-gray" style="width: 240px;">
					Identifiación por Color
				</td>
			</tr>
			<tr>
				<td class="text-center" style="width: 150px">
					Muy Bueno
				</td>
				<td class="text-center" style="width: 220px">
					86% a 100%
				</td>
				<td class="text-center" style="width: 240px; background: green; padding: 3px;">
					&nbsp;
				</td>
			</tr>
			<tr>
				<td class="text-center" style="width: 150px">
					Bueno
				</td>
				<td class="text-center" style="width: 220px">
					71% a 85.99%
				</td>
				<td class="text-center" style="width: 240px; background: blue; padding: 3px;">
					&nbsp;
				</td>
			</tr>
			<tr>
				<td class="text-center" style="width: 150px">
					Regular
				</td>
				<td class="text-center" style="width: 220px">
					51% a 70.99%
				</td>
				<td class="text-center" style="width: 240px; background: yellow; padding: 3px;">
					&nbsp;
				</td>
			</tr>
			<tr>
				<td class="text-center" style="width: 150px">
					Deficiente
				</td>
				<td class="text-center" style="width: 220px">
					0% a 50.99%
				</td>
				<td class="text-center" style="width: 240px; background: red; padding: 3px;">
					&nbsp;
				</td>
			</tr>
		</table>
		<div class="col-12 text-justify">
			Nota: En caso un establecimiento hay asido calificado con una No Conformidad en alguno de los requisitos
			excluyentes, bajará al nivel inmediato inferior; cabe señalar, que por cada excluyente incumplido, bajará
			un nivel y sele asignará el porcentaje mayor del rango de cumplimiento en el que se ubique.
		</div>
	</div>
</page>
<?php $contador = 0; ?>
<?php $nextPage = false; ?>
<?php if (!empty($cuadro4)) { ?>
<?php foreach ($cuadro4 as $key => $value) { ?>
<?php if ($nextPage) { ?>
	</table>
	</div>
	</page>
<?php } ?>
<?php if ($key === 0 || $nextPage) { ?>
<page>
	<div class="col-12 new-page" style="width: 100%; height: 85%">
		<?php } ?>
		<?php if ($key === 0) { ?>
			<div class="text-left uppercase" style="margin: 10px 0">
				VI. <span style="margin-left: 5px">RESULTADOS</span>
			</div>
		<?php } ?>
		<?php if ($key === 0 || $nextPage) { ?>
		<table class="table table-bordered text-14">
			<tr>
				<td class="text-center bg-gray" style="width: 50px">
					N°
				</td>
				<td class="text-center bg-gray" style="width: 210px">
					Requisito
				</td>
				<td class="text-center bg-gray" style="width: 50px">
					Punt. <br> Max.
				</td>
				<td class="text-center bg-gray" style="width: 50px">
					Punt. <br> Obt.
				</td>
				<td class="text-center bg-gray" style="width: 150px">
					Hallazgo / Seguimiento
				</td>
				<td class="text-center bg-gray" style="width: 100px">
					Criterio <br> Calificación
				</td>
			</tr>
			<?php } ?>
			<?php $bgGray = (count(explode('.', $value->DNUMERADOR)) <= 2) ? 'bg-gray' : ''; ?>
			<tr>
				<td class="text-left <?php echo $bgGray; ?>">
					<?php echo $value->DNUMERADOR ?>
				</td>
				<td class="text-left text-justify <?php echo $bgGray; ?>">
					<?php echo $value->DREQUISITO ?>
				</td>
				<td class="text-center <?php echo $bgGray; ?>">
					<?php echo $value->NVALORMAXREQUISITO ?>
				</td>
				<td class="text-center <?php echo $bgGray; ?>">
					<?php echo $value->NVALORREQUISITO ?>
				</td>
				<td class="text-lef text-justify <?php echo $bgGray; ?>">
					<?php echo $value->DHALLAZGOTEXT ?>
				</td>
				<td class="text-lef text-justify <?php echo $bgGray; ?>">
					<?php echo $value->DDETALLEVALOR ?>
				</td>
			</tr>
			<?php
			++$contador;
			$nextPage = false;
			if (($contador % 6) == 0) {
				$nextPage = true;
			}
			?>
			<?php } ?>
			<?php } ?>
			<page >
				<div class="col-12 new-page" style="page-break-before: always;">
					<div class="text-left uppercase">
						VII. <span style="margin-left: 5px">CONCLUSIONES</span>
					</div>
					<div class="text-left uppercase" style="margin: 10px 0">
						7.1 <span style="margin-left: 5px">Generales</span>
					</div>
					<div class="col-12 text-justify">
						<?php echo $conclucionesGenerales; ?>
					</div>
					<div class="text-left uppercase" style="margin: 10px 0">
						7.2 <span style="margin-left: 5px">Espcíficas</span>
					</div>
					<table class="table table-bordered" style="margin: 10px 0" >
						<tr>
							<td class="col-12 text-center bg-gray" style="padding: 10px" >
								Conformidades
							</td>
						</tr>
						<tr>
							<td class="col-12 text-left" style="" >
								<?php echo (!empty($conclucionesEspecificasConformidades)) ? nl2br($conclucionesEspecificasConformidades->dinfoadicional) : ''; ?>
							</td>
						</tr>
						<?php if (!empty($conclucionesEspecificasObservaciones) && !empty($conclucionesEspecificasObservaciones->dinfoadicional)) { ?>
							<tr>
								<td class="col-12 text-center bg-gray" style="padding: 10px" >
									Observaciones
								</td>
							</tr>
							<tr>
								<td class="col-12 text-left" style="" >
									<?php echo nl2br($conclucionesEspecificasObservaciones->dinfoadicional); ?>
								</td>
							</tr>
						<?php } ?>
					</table>
					<div class="text-left uppercase" style="margin: 10px 0">
						7.3 <span style="margin-left: 5px">Tabla de Peligros</span>
					</div>
					<table class="table table-bordered" >
						<tr>
							<td class="text-center" style="width: 40px" >
								N°
							</td>
							<td class="text-center" style="width: 114px;" >
								Producto
							</td>
							<td class="text-center" style="width: 114px;" >
								Peligro Cliente
							</td>
							<td class="text-center" style="width: 114px;" >
								Peligro Proveedor
							</td>
							<td class="text-center" style="width: 114px;" >
								Peligro Inspeccion
							</td>
							<td class="text-center" style="width: 114px;" >
								Observacion
							</td>
						</tr>
						<tr>
							<td class="text-left" >1</td>
							<td class="text-left" >SIN PRODUCTO</td>
							<td class="text-left" >-</td>
							<td class="text-left" >-</td>
							<td class="text-left" >-</td>
							<td class="text-left" >-</td>
						</tr>
					</table>
					<div class="text-left uppercase" style="margin: 10px 0">
						VIII. <span style="margin-left: 5px">PLAN DE ACCIONES CORRECTIVAS</span>
					</div>
					<div class="col-12 text-justify">
						<?php echo $planAccionParrafo1; ?> <br>
						<?php echo $planAccionParrafo2; ?> <br>
						<?php echo $planAccionParrafo3; ?> <br>
					</div>
					<div class="col-6" style="margin-top: 10px" >
						<table class="table" >
							<tr>
								<td class="col-12 text-center" style="border: none" >
									<img src="<?php echo base64ResourceConvert('https://upload.wikimedia.org/wikipedia/commons/thumb/f/f8/Firma_Len%C3%ADn_Moreno_Garc%C3%A9s.png/1200px-Firma_Len%C3%ADn_Moreno_Garc%C3%A9s.png') ?>"
										 alt="Firma Digital" style="width: 220px; height: 100px" >
								</td>
							</tr>
							<tr>
								<td class="col-12 text-center" style="border-top: 1px solid #000; border-left: none; border-right: none; border-bottom: none;" >
									<?php echo (!empty($cuadro3)) ? $cuadro3->insp_dnombre . ' ' . $cuadro3->insp_dapepat . ' ' . $cuadro3->insp_dapemat : ''; ?> <br>
									INSPECTOR <br>
									GRUPO FS S.A.C.
								</td>
							</tr>
						</table>
					</div>
				</div>
			</page>
</body>
</html>
