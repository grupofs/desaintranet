<style type="text/css">
	<!--

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
		font-size: 14pt;
	}

	.text-16 {
		font-size: 16px;
	}

	.text-sm {
		font-size: 8pt;
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

	h1 {
		padding: 0;
		margin: 0;
		font-size: 12pt;
		font-weight: normal;
	}

	h3 {
		font-size: 12pt;
		font-weight: normal;
		padding-bottom: 20px;
	}

	h4 {
		font-size: 12pt;
		font-weight: normal;
		margin-top: 0;
		padding-top: 0;
		padding-bottom: 20px;
	}

	.pt {
		padding-top: 20px;
	}

	.pb {
		padding-bottom: 20px;
	}

	.px {
		padding: 20px 0;
	}

	-->
</style>
<page backtop="20mm" backbottom="5mm" backleft="10mm" backright="10mm" style="font-size: 12pt">
	<page_header>
		<div class="col-12">
			<table class="table">
				<tr>
					<td class="col-8" style="">
						<img src="<?php echo base64ResourceConvert(base_url('assets/images/logoGrupoFS.jpg')) ?>"
							 alt="GRUPOFS" style="width: 200px; height: 60px">
					</td>
					<td class="col-4 text-right" style="vertical-align: top; font-size: 10px">
						Av. Del Pinar 110 of. 405 - 407 <br>
						Urb. Chacarilla del Estanque <br>
						Santiago de Surco - Lima - Perú <br>
						(51-1)372-1734 / 372-8182 <br>
						www.grupofs.com
					</td>
				</tr>
			</table>
		</div>
	</page_header>
	<page_footer>
		<div style="text-align: right; font-weight: bold;">
			Pag. [[page_cu]] de [[page_nb]]
		</div>
	</page_footer>
	<div class="col-12 text-caratula">
		<table class="table">
			<tr>
				<td class="col-12 text-center"
					style="vertical-align: middle; height: 100px">
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
	<div style="page-break-after:always"></div>
	<div class="col-12">
		<table class="table">
			<tr>
				<td class="col-12 text-center">
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
					<table class="table table-bordered" cellpadding="0">
						<tr>
							<th colspan="2" class="col-12 text-center bg-gray">
								CALIFICACIÓN DEL PROVEEDOR -&nbsp;
								<?php
								$fservicio = explode('-', $cuadro1->fservicio);
								echo getMonthText($fservicio[1]) . ' ' . $fservicio[0];
								?>
							</th>
						</tr>
						<tr>
							<td class="col-4 text-center">
								Puntaje Final
							</td>
							<td class="col-6 text-center">
								<?php echo $cuadro1->presultadochecklist ?>%
							</td>
						</tr>
						<tr>
							<td class="col-4 text-center">
								Calificación
							</td>
							<td class="col-8 text-center" style="padding: 0">
								<table class="table" border="0" cellspacing="0">
									<tr>
										<td class="col-4 text-center">
											<?php echo $cuadro1->descripcion_result ?>
										</td>
										<td class="col-8 text-center bg-green">
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
	<div style="page-break-after:always"></div>
	<div class="col-12">
		<table class="table">
			<tr>
				<td class="col-12 text-center" style="padding: 10px;">
					RESULTADO DE LA INSPECCION
				</td>
			</tr>
		</table>
		<table class="table table-bordered text-sm">
			<tr>
				<td colspan="7" class="text-center bg-gray">
					Listado de Verificación
				</td>
			</tr>
			<tr>
				<td class="text-center bg-gray" style="width: 30px">
					N°
				</td>
				<td class="text-center bg-gray" style="width: 240px">
					Aspecto Evaluado
				</td>
				<td class="text-center bg-gray" style="width: 50px">
					Puntaje <br> Maximo
				</td>
				<td class="text-center bg-gray" style="width: 50px">
					Puntaje <br> Obtenido
				</td>
				<td class="text-center bg-gray" style="width: 55px">
					% de <br> Conformidad
				</td>
				<td class="text-center bg-gray" style="width: 30px">
					% <br> Peso
				</td>
				<td class="text-center bg-gray" style="width: 55px">
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
						<td class="text-left" style="width: 240px">
							<?php echo $value->drequisito ?>
						</td>
						<td class="text-center" style="width: 50px">
							<?php echo $value->nvalorrequisito ?>
						</td>
						<td class="text-center" style="width: 50px">
							<?php echo $value->mayor_val ?>
						</td>
						<td class="text-center" style="width: 55px">
							<?php echo ($value->mayor_val > 0) ? round(($value->nvalorrequisito * 100) / $value->mayor_val, 2) . '%' : '0%'; ?>
						</td>
						<td class="text-center bg-gray" style="width: 30px">
							<?php echo '' ?>
						</td>
						<td class="text-center bg-gray" style="width: 55px">
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
	<?php if (!empty($imgGrafico2)) { ?>
		<div class="col-12">
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
			</table>
		</div>
	<?php } ?>
	<div style="page-break-after:always"></div>
	<h1 class="text-center">ASPECTOS EVALUADOS</h1>
	<h3 class="text-left">I. INFORMACIÓN GENERAL</h3>
	<table class="table table-bordered">
		<tr>
			<td colspan="2" class="text-left bg-gray">
				DATOS DEL PROVEEDOR
			</td>
		</tr>
		<tr>
			<td class="text-left" style="width: 200px">
				Razon Social
			</td>
			<td class="text-left" style="width: 430px">
				<?php echo (!empty($cuadro3)) ? $cuadro3->prov_drazonsocial : ''; ?>
			</td>
		</tr>
		<tr>
			<td class="text-left" style="width: 200px">
				R.U.C
			</td>
			<td class="text-left" style="width: 430px">
				<?php echo (!empty($cuadro3)) ? $cuadro3->prov_nruc : ''; ?>
			</td>
		</tr>
		<tr>
			<td class="text-left" style="width: 200px">
				Dirección
			</td>
			<td class="text-left" style="width: 430px">
				<?php echo (!empty($cuadro3)) ? $cuadro3->prov_ddireccioncliente . ' ' . $cuadro3->prov_ubigeo : ''; ?>
			</td>
		</tr>
		<tr>
			<td class="text-left" style="width: 200px">
				Representante
			</td>
			<td class="text-left" style="width: 430px">
				<?php echo (!empty($cuadro3)) ? $cuadro3->drepresentante : ''; ?>
			</td>
		</tr>
		<tr>
			<td colspan="2" class="text-left bg-gray">
				DATOS DE LA EMPRESA MAQUILADORA
			</td>
		</tr>
		<tr>
			<td class="text-left" style="width: 200px">
				Razon Social
			</td>
			<td class="text-left" style="width: 430px">
				<?php echo (!empty($cuadro3)) ? $cuadro3->maqui_drazonsocial : ''; ?>
			</td>
		</tr>
		<tr>
			<td class="text-left" style="width: 200px">
				R.U.C
			</td>
			<td class="text-left" style="width: 430px">
				<?php echo (!empty($cuadro3)) ? $cuadro3->maqui_nruc : ''; ?>
			</td>
		</tr>
		<tr>
			<td class="text-left" style="width: 200px">
				Dirección
			</td>
			<td class="text-left" style="width: 430px">
				<?php echo (!empty($cuadro3) && !empty($cuadro3->maqui_ddireccioncliente)) ? $cuadro3->maqui_ddireccioncliente . ' ' . $cuadro3->maqui_ubigeo : ''; ?>
			</td>
		</tr>
		<tr>
			<td colspan="2" class="text-left bg-gray">
				INFORMACION ADICIONAL
			</td>
		</tr>
		<tr>
			<td class="text-left" style="width: 200px">
				Fecha de Inspección
			</td>
			<td class="text-left" style="width: 430px">
				<?php
				if (!empty($cuadro3)) {
					$fechaInsp = explode('-', $cuadro3->fservicio);
					echo $fechaInsp[2] . ' ' . getMonthText(intval($fechaInsp[1]) . ' ' . $fechaInsp[0]);
				}
				?>
			</td>
		</tr>
		<tr>
			<td class="text-left" style="width: 200px">
				Lugar de Inspección
			</td>
			<td class="text-left" style="width: 430px">
				<?php echo (!empty($cuadro3)) ? $cuadro3->DIRESTPROV . ' ' . $cuadro3->UBIGEOESTCLTE : ''; ?>
			</td>
		</tr>
		<tr>
			<td class="text-left" style="width: 200px">
				Responsable de la inspección
			</td>
			<td class="text-left" style="width: 430px">
				<?php echo (!empty($cuadro3)) ? $cuadro3->dapepat . ' ' . $cuadro3->dapemat . ' ' . $cuadro3->dnombre : '-'; ?>
				(Jefe de Gestión de la Calidad)
			</td>
		</tr>
		<tr>
			<td class="text-left" style="width: 200px">
				Licencias de Funcionamiento
			</td>
			<td class="text-left" style="width: 430px">
				<?php echo (!empty($cuadro3)) ? $cuadro3->dadicionallicencia : ''; ?>
			</td>
		</tr>
		<tr>
			<td class="text-left" style="width: 200px">
				Certificados / otros
			</td>
			<td class="text-left" style="width: 430px">
				<?php echo (!empty($cuadro3)) ? $cuadro3->CERTIFICACION . '-' . $cuadro3->dpermisoautoridadsanitaria : ''; ?>
			</td>
		</tr>
		<tr>
			<td class="text-left" style="width: 200px">
				Inspector
			</td>
			<td class="text-left" style="width: 430px">
				<?php echo (!empty($cuadro3)) ? $cuadro3->insp_dnombre . ' ' . $cuadro3->insp_dapepat . ' ' . $cuadro3->insp_dapemat : ''; ?>
			</td>
		</tr>
	</table>
	<h3>II. OBJETIVOS</h3>
	<div class="text-left text-justify" style="width: 680px">
		Verificar las condiciones sanitarias del proceso de producción de alimentos, en
		cumplimiento a los criterios de inspección, que permita a <?php echo $caratula->nomcliente ?>
		asegurar la calidad sanitaria de sus diferentes establecimientos ubicados a nivel
		nacional.
	</div>
	<div>
		<h3>III. ALCANSE</h3>
		<div class="text-left text-justify">
			<table class="table">
				<tr>
					<td style="width: 80px">
						Linea
					</td>
					<td style="width: 565px">
						: <?php echo (!empty($cuadro1)) ? $cuadro1->alcance : ''; ?>
					</td>
				</tr>
				<tr>
					<td style="width: 80px">
						Marca
					</td>
					<td style="width: 565px">
						: <?php echo (!empty($cuadro1)) ? $cuadro1->marca : ''; ?>
					</td>
				</tr>
			</table>
		</div>
	</div>
	<div>
		<h3>IV. CRITERIOS DE INSPECCION</h3>
		<div class="text-justify" style="width: 680px">
			<?php echo (!empty($criterioInspeccion)) ? nl2br($criterioInspeccion->dcriterios) : ''; ?>
		</div>
	</div>
	<h3>V. CRITERIOS DE EVALUACION Y CALIFICACION</h3>
	<table class="table table-bordered">
		<tr>
			<td class="text-center bg-gray" style="width: 653px;">
				Criterios de evaluación
			</td>
		</tr>
	</table>
	<table class="table table-bordered">
		<?php if (!empty($criterioEvaluacion)) { ?>
			<?php foreach ($criterioEvaluacion as $key => $value) { ?>
				<tr>
					<td class="text-left text-justify" style="width: 200px">
						<?php echo $value->ddetallevalor ?>
					</td>
					<td class="text-left text-justify" style="width: 430px">
						<?php echo $value->dvaloracion ?>
					</td>
				</tr>
			<?php } ?>
		<?php } ?>
	</table>
	<div class="text-left text-justify pt" style="width: 675px;">
		La inspeccción es realizada con la ayuda de una lista de verificación es pecífica para la linea
		inspeccionada,
		acorde a la normativa sanitaria aplicable, el cual permite evaluar los requisitos sanitarios referidos a los
		Programas de Prerequisitos (PPR), al Sistema de Análisis de Peligros y puntos Críticos de Control (HACCP)
		en caso aplique y al Sistema de Gestión de Inocuidad. <br>
		Cada requisito es valorado de acuerdo a lo indicado en la siguiente escala:
	</div>
	<table class="table table-bordered pt">
		<tr>
			<td colspan="2" class="text-center bg-gray">
				Criterios de Calificación
			</td>
		</tr>
		<?php if (!empty($escalaValoracion)) { ?>
			<?php foreach ($escalaValoracion as $key => $value) { ?>
				<tr>
					<td class="text-center" style="width: 70px">
						<?php echo $value->ddetallevalor ?>
					</td>
					<td class="text-left text-justify" style="width: 560px">
						<?php echo $value->dvaloracion ?>
					</td>
				</tr>
			<?php } ?>
		<?php } ?>
	</table>
	<div class="text-justify pt" style="width: 675px">
		<?php echo $parrafoExcluyentes; ?>
	</div>
	<table class="table table-bordered pt">
		<tr>
			<td class="text-center bg-gray" style="width: 653px">
				Requisitos excluyentes
			</td>
		</tr>
	</table>
	<table class="table table-bordered">
		<tr>
			<td class="text-center bg-gray" style="width: 77px;">
				N° <br> Requisito
			</td>
			<td class="text-center bg-gray" style="width: 120px;">
				Título
			</td>
			<td class="text-center bg-gray" style="width: 410px;">
				Descripción del requisito
			</td>
		</tr>
	</table>
	<table class="table table-bordered">
		<?php if (!empty($requisitosExcluyentes)) { ?>
			<?php foreach ($requisitosExcluyentes as $key => $value) { ?>
				<tr>
					<td class="text-left" style="width: 77px">
						<?php echo $value->dnumerador ?>
					</td>
					<td class="text-left" style="width: 120px">
						<?php echo $value->titulo ?>
					</td>
					<td class="text-left text-justify" style="width: 410px">
						<?php echo $value->drequisito ?>
					</td>
				</tr>
			<?php } ?>
		<?php } ?>
	</table>
	<div class="text-justify pt pb" style="width: 675px;">
		En función al puntaje obtenido por el proveedor en la inspección sanitaria, puede ser clasificado según la
		siguiente escala; asi mismo se le asigna una identificación por color.
	</div>
	<table class="table table-bordered pb">
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
	<div class="text-justify" style="width: 675px">
		Nota: En caso un establecimiento hay asido calificado con una No Conformidad en alguno de los requisitos
		excluyentes, bajará al nivel inmediato inferior; cabe señalar, que por cada excluyente incumplido, bajará
		un nivel y sele asignará el porcentaje mayor del rango de cumplimiento en el que se ubique.
	</div>
	<div style="page-break-after:always"></div>
	<h3>VI. RESULTADOS</h3>
	<table class="table table-bordered">
		<thead>
		<tr>
			<td class="text-center bg-gray" style="width: 50px">
				N°
			</td>
			<td class="text-center bg-gray" style="width: 140px">
				Requisito
			</td>
			<td class="text-center bg-gray" style="width: 100px">
				Normativa
			</td>
			<td class="text-center bg-gray" style="width: 50px">
				Punt. <br> Max.
			</td>
			<td class="text-center bg-gray" style="width: 50px">
				Punt. <br> Obt.
			</td>
			<td class="text-center bg-gray" style="width: 70px">
				Hallazgo / Seguimiento
			</td>
			<td class="text-center bg-gray" style="width: 80px">
				Criterio <br> Calificación
			</td>
		</tr>
		</thead>
		<tbody>
		<?php $totalValorMaxRequisito = 0; ?>
		<?php $totalValorRequisito = 0; ?>
		<?php foreach ($cuadro4 as $key => $value) { ?>
			<?php $bgGray = (count(explode('.', $value->DNUMERADOR)) <= 2) ? 'bg-gray' : ''; ?>
			<tr>
				<td class="text-left <?php echo $bgGray; ?>" style="width: 50px">
					<?php echo $value->DNUMERADOR ?>
				</td>
				<td class="text-left text-justify <?php echo $bgGray; ?>" style="width: 140px">
					<?php echo $value->DREQUISITO ?>
				</td>
				<td class="text-left text-justify <?php echo $bgGray; ?>" style="width: 100px">
					<?php echo $value->DNORMATIVA ?>
				</td>
				<td class="text-center <?php echo $bgGray; ?>" style="width: 50px">
					<?php echo $value->NVALORMAXREQUISITO ?>
				</td>
				<td class="text-center <?php echo $bgGray; ?>" style="width: 50px">
					<?php echo $value->NVALORREQUISITO ?>
				</td>
				<td class="text-lef text-justify <?php echo $bgGray; ?>" style="width: 70px">
					<?php echo $value->DHALLAZGOTEXT ?>
				</td>
				<td class="text-lef text-justify <?php echo $bgGray; ?>" style="width: 80px">
					<?php echo $value->DDETALLEVALOR ?>
				</td>
			</tr>
			<?php $totalValorMaxRequisito += $value->NVALORMAXREQUISITO; ?>
			<?php $totalValorRequisito += $value->NVALORREQUISITO; ?>
		<?php } ?>
		</tbody>
		<tr>
			<td class=""></td>
			<td class="text-center">
				Puntaje Final
			</td>
			<td class="text-center">
				<?php echo $totalValorMaxRequisito; ?>
			</td>
			<td class="text-center">
				<?php echo $totalValorRequisito; ?>
			</td>
			<td colspan="3"></td>
		</tr>
	</table>
	<div style="page-break-after:always"></div>
	<h3>VII. CONCLUSIONES</h3>
	<h4>7.1 Generales</h4>
	<div class="text-justify pb" style="width: 675px;">
		<?php echo $conclucionesGenerales; ?>
	</div>
	<h4 style="padding-top: 0; margin-top: 0">7.2 Espcíficas</h4>
	<table class="table table-bordered pb">
		<tr>
			<td class="text-center bg-gray" style="padding: 10px; width: 633px">
				Conformidades
			</td>
		</tr>
		<tr>
			<td class="text-left" style="width: 633px">
				<?php echo (!empty($conclucionesEspecificasConformidades)) ? nl2br($conclucionesEspecificasConformidades->dinfoadicional) : ''; ?>
			</td>
		</tr>
		<?php if (!empty($conclucionesEspecificasObservaciones) && !empty($conclucionesEspecificasObservaciones->dinfoadicional)) { ?>
			<tr>
				<td class="text-center bg-gray" style="padding: 10px; width: 633px">
					Observaciones
				</td>
			</tr>
			<tr>
				<td class="text-left" style="width: 633px">
					<?php echo nl2br($conclucionesEspecificasObservaciones->dinfoadicional); ?>
				</td>
			</tr>
		<?php } ?>
	</table>
	<?php if (!empty($peligros)) { ?>
		<?php if ($peligros[0]->dproducto != 'SIN PRODUCTO') { ?>
			<h4>7.3 Tabla de Peligros</h4>
			<table class="table table-bordered pb">
				<tr>
					<td class="text-center" style="width: 20px">
						N°
					</td>
					<td class="text-center" style="width: 120px;">
						Producto
					</td>
					<td class="text-center" style="width: 100px;">
						Peligro Cliente
					</td>
					<td class="text-center" style="width: 100px;">
						Peligro Proveedor
					</td>
					<td class="text-center" style="width: 100px;">
						Peligro Inspeccion
					</td>
					<td class="text-center" style="width: 100px;">
						Observacion
					</td>
				</tr>
				<?php foreach ($peligros as $key => $value) { ?>
					<tr>
						<td class="text-center" style="width: 20px">
							<?php echo($key + 1) ?>
						</td>
						<td class="text-left" style="width: 120px;">
							<?php echo $value->dproducto ?>
						</td>
						<td class="text-left" style="width: 100px;">
							<?php echo $value->dpeligrocliente ?>
						</td>
						<td class="text-left" style="width: 100px;">
							<?php echo $value->dpeligroproveedor ?>
						</td>
						<td class="text-left" style="width: 100px;">
							<?php echo $value->dpeligroinspeccion ?>
						</td>
						<td class="text-left" style="width: 100px;">
							<?php echo $value->observacion ?>
						</td>
					</tr>
				<?php } ?>
			</table>
		<?php } ?>
	<?php } ?>
	<h3 style="padding-top: 0; margin-top: 0">VIII. PLAN DE ACCIONES CORRECTIVAS</h3>
	<div class="text-justify" style="width: 675px">
		<?php echo $planAccionParrafo1; ?> <br>
		<?php echo $planAccionParrafo2; ?> <br>
		<?php echo $planAccionParrafo3; ?> <br>
	</div>
	<div class="col-6 pt">
		<table style="width: 100%" border="0" cellspacing="0" cellpadding="0">
			<tr>
				<td class="col-12 text-center" style="border: none">
					<img src="<?php echo base64ResourceConvert('https://upload.wikimedia.org/wikipedia/commons/thumb/f/f8/Firma_Len%C3%ADn_Moreno_Garc%C3%A9s.png/1200px-Firma_Len%C3%ADn_Moreno_Garc%C3%A9s.png') ?>"
						 alt="Firma Digital" style="width: 220px; height: 100px">
				</td>
			</tr>
			<tr>
				<td class="col-12 text-center" style="border-top: 1px solid #000;">
					<?php echo (!empty($cuadro3)) ? $cuadro3->insp_dnombre . ' ' . $cuadro3->insp_dapepat . ' ' . $cuadro3->insp_dapemat : ''; ?>
					<br>
					INSPECTOR <br>
					GRUPO FS S.A.C.
				</td>
			</tr>
		</table>
	</div>
</page>
