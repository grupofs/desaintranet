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
		font-size: 14px;
	}

	.text-sm {
		font-size: 8px;
	}

	.bg-gray {
		background: #a2a1a1;
	}

	.border-gray {
		border: 1px solid #4c4c4c
	}

	.bg-green {
		background: #31a721;
	}

	.table {
		width: 100%;
		border-spacing: 0 0;
		border-collapse: collapse;
		border-color: #4c4c4c;
		font-size: 11px;
	}

	.table-bordered {
		border: 1px solid #4c4c4c;
	}

	.table td {
		padding: 5px;
		font-size: 11px;
	}

	.table th {
		padding: 8px;
		font-size: 11px;
	}

	.table-bordered td, .table-bordered th {
		border: 1px solid #4c4c4c;
	}

	h1 {
		padding: 0;
		margin: 0;
		font-size: 10px;
		font-weight: normal;
	}

	h3 {
		font-size: 10px;
		font-weight: normal;
		padding-bottom: 20px;
	}

	h4 {
		font-size: 10px;
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
<page backtop="20mm" backbottom="3mm" backleft="10mm" backright="10mm" style="font-size: 11px">
	<page_header>
		<div style="padding: 15px 40px;">
			<table class="" border="0" cellpadding="0" cellspacing="0">
				<tr>
					<td style="width: 447px;">
						<img src="<?php echo base64ResourceConvert(base_url('assets/images/logoGrupoFS.jpg')) ?>"
							 alt="GRUPOFS" style="width: 150px; height: 40px">
					</td>
					<td class="text-right" style="width: 220px; vertical-align: top; font-size: 8px">
						Av. Del Pinar 110 of. 405 - 407 <br>
						Urb. Chacarilla del Estanque <br>
						Santiago de Surco - Lima - Perú <br>
						(51-1) 480-0561 <br>
						www.grupofs.com
					</td>
				</tr>
			</table>
		</div>
	</page_header>
	<page_footer>
		<div style="text-align: right; font-size: 11px; padding: 0 27px">
			Pag. [[page_cu]] de [[page_nb]]
		</div>
	</page_footer>
	<div class="col-12 text-caratula">
		<table class="table">
			<tr>
				<td class="col-12 text-center"
					style="vertical-align: middle; height: 250px">
					<span class="text-caratula">INFORME TECNICO N° <?php echo $caratula->dinforme ?></span>
				</td>
			</tr>
			<tr>
				<td class="col-12" style="border: 0; padding: 80px;">
					<table class="table bg-gray border-gray">
						<tr>
							<td class="col-12 text-center font-weigth-bold" style="padding-top: 15px" >
								<span class="text-caratula">INSPECCION SANITARIA</span>
							</td>
						</tr>
						<tr>
							<td class="col-12 text-center font-weigth-bold uppercase" style="padding: 15px">
								<span class="text-caratula">PROGRAMA DE <?php echo $caratula->dsubservicio ?></span>
								<br>
								<span class="text-caratula"><?php echo $caratula->nomcliente ?></span>
							</td>
						</tr>
					</table>
				</td>
			</tr>
			<tr>
				<td class="col-12 text-center" style="height: 200px; vertical-align: middle">
					<p class="uppercase pb text-caratula">
						<?php echo $caratula->proveedor; ?>
					</p>
					<p class="uppercase text-caratula" style="margin-top: 0; padding-top: 0">
						LINEA: <?php echo $caratula->lineaprocesoclte ?>
					</p>
				</td>
			</tr>
			<tr>
				<td class="col-12 text-center" style="height: 120px; vertical-align: middle">
					<p class="uppercase text-caratula">
						<?php
						$fservicio = explode('-', $caratula->finformefin);
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
				<td class="col-12 text-center pb">
					RESUMEN EJECUTIVO
				</td>
			</tr>
		</table>
		<div class="col-12 pb" >
			<?php echo $parrafo1Pt1; ?>
		</div>
		<div class="col-12 pb" >
			<?php echo $parrafo1Pt2; ?>
		</div>
		<table class="table">
			<tr>
				<td class="col-12" style="padding-left: 130px; padding-right: 130px">
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
								<?php echo round($cuadro1->presultadochecklist) ?>%
							</td>
						</tr>
						<tr>
							<td class="col-4 text-center">
								Calificación
							</td>
							<td class="col-8 text-center" style="padding: 0">
								<table class="table" border="0" cellspacing="0">
									<tr>
										<td class="col-4 text-center" style="border: none" >
											<?php echo $cuadro1->descripcion_result ?>
										</td>
										<td class="col-8 text-center"
											style="background-color: <?php echo getColor($cuadro1->presultadochecklist); ?>; border: none;"></td>
									</tr>
								</table>
							</td>
						</tr>
					</table>
				</td>
			</tr>
			<tr>
				<td class="col-12 text-justify pt">
					<?php echo $parrafo2; ?>
				</td>
			</tr>
			<tr>
				<td class="col-12 text-center pt">
					<table class="col-12" >
						<tr>
							<td class="col-2" ></td>
							<td class="col-8 border-gray text-center" style="padding: 20px" >
								<p style="padding-top: 0; margin-top: 0; padding-bottom: 20px;" >CUMPLIMIENTO ENTRE INSPECCIONES</p>
								<img src="<?php echo base64ResourceConvert($imgGrafico1); ?>" alt="Grafico-1"
									 style="width: 100%; height: 220px">
							</td>
							<td class="col-2" ></td>
						</tr>
					</table>
				</td>
			</tr>
		</table>
	</div>
	<div style="page-break-after:always"></div>
	<div class="col-12">
		<table class="table">
			<tr>
				<td class="col-12 text-center pb">
					RESULTADO DE LA INSPECCION
				</td>
			</tr>
		</table>
		<table class="table table-bordered text-sm">
			<tr>
				<td colspan="7" class="text-center bg-gray">
					<span class="text-sm">Listado de Verificación</span>
				</td>
			</tr>
			<tr>
				<td class="text-center bg-gray" style="width: 20px">
					<span class="text-sm">N°</span>
				</td>
				<td class="text-center bg-gray" style="width: 278px">
					<span class="text-sm">Aspecto Evaluado</span>
				</td>
				<td class="text-center bg-gray" style="width: 40px">
					<span class="text-sm">Puntaje <br> Maximo</span>
				</td>
				<td class="text-center bg-gray" style="width: 40px">
					<span class="text-sm">Puntaje <br> Obtenido</span>
				</td>
				<td class="text-center bg-gray" style="width: 55px">
					<span class="text-sm">% de <br> Conformidad</span>
				</td>
				<td class="text-center bg-gray" style="width: 30px">
					<span class="text-sm">% <br> Peso</span>
				</td>
				<td class="text-center bg-gray" style="width: 50px">
					<span class="text-sm">% de <br> Conf. Final</span>
				</td>
			</tr>
			<?php
			$totalRequisitos = 0;
			$totalMayorVal = 0;
			?>
			<?php if (!empty($cuadro2)) { ?>
				<?php foreach ($cuadro2 as $key => $value) { ?>
					<tr>
						<td class="text-center" style="width: 20px">
							<span class="text-sm" ><?php echo $value->dnumerador ?></span>
						</td>
						<td class="text-left" style="width: 278px">
							<span class="text-sm"><?php echo $value->drequisito ?></span>
						</td>
						<td class="text-center" style="width: 40px">
							<span class="text-sm"><?php echo round($value->mayor_val) ?></span>
						</td>
						<td class="text-center" style="width: 40px">
							<span class="text-sm"><?php echo round($value->nvalorrequisito) ?></span>
						</td>
						<td class="text-center" style="width: 55px">
							<span class="text-sm">
								<?php echo ($value->mayor_val > 0) ? round(($value->nvalorrequisito * 100) / $value->mayor_val) : '0'; ?>%
							</span>
						</td>
						<td class="text-center bg-gray" style="width: 30px">
							<?php echo '' ?>
						</td>
						<td class="text-center bg-gray" style="width: 50px">
							<?php echo '' ?>
						</td>
					</tr>
					<?php
					$nro = count(explode('.', $value->dnumerador));
					if ($nro == 1) {
						$totalRequisitos += $value->nvalorrequisito;
						$totalMayorVal += $value->mayor_val;
					}
					?>
				<?php } ?>
			<?php } ?>
			<tr>
				<td class="text-center" colspan="2">
					<span class="text-sm">Puntaje Parcial</span>
				</td>
				<td class="text-center">
					<span class="text-sm"><?php echo $totalMayorVal; ?></span>
				</td>
				<td class="text-center">
					<span class="text-sm"><?php echo $totalRequisitos; ?></span>
				</td>
				<td class="text-center" colspan="3">
					<span class="text-sm">
						<?php echo ($totalMayorVal > 0) ? round(($totalRequisitos * 100) / $totalMayorVal) : 0; ?>%
					</span>
				</td>
			</tr>
			<tr>
				<td class="text-center" colspan="2">
					<span class="text-sm">Puntaje Final</span>
				</td>
				<td class="text-center" colspan="5">
					<span class="text-sm">
						<?php echo ($totalMayorVal > 0) ? round(($totalRequisitos * 100) / $totalMayorVal) : 0; ?>%
					</span>
				</td>
			</tr>
		</table>
	</div>
	<?php if (!empty($imgGrafico2)) { ?>
		<div class="col-12">
			<table class="col-12" >
				<tr>
					<td class="col-2" ></td>
					<td class="col-8 border-gray text-center" style="padding: 20px" >
						<p style="padding-top: 0; margin-top: 0; padding-bottom: 20px;"
						   class="uppercase" >
							<?php echo $caratula->proveedor; ?>
						</p>
						<img src="<?php echo base64ResourceConvert($imgGrafico2); ?>" alt="Grafico-2"
							 style="width: 100%; height: 280px">
					</td>
					<td class="col-2" ></td>
				</tr>
			</table>
		</div>
	<?php } ?>
	<div style="page-break-after:always"></div>
	<h1 class="text-center">ASPECTOS EVALUADOS</h1>
	<h3 class="text-left">I. INFORMACIÓN GENERAL</h3>
	<div style="padding-left: 8px" >
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
				<td class="text-left" style="width: 423px">
					<?php echo (!empty($cuadro3)) ? $cuadro3->prov_drazonsocial : ''; ?>
				</td>
			</tr>
			<tr>
				<td class="text-left" style="width: 200px">
					R.U.C
				</td>
				<td class="text-left" style="width: 423px">
					<?php echo (!empty($cuadro3)) ? $cuadro3->prov_nruc : ''; ?>
				</td>
			</tr>
			<tr>
				<td class="text-left" style="width: 200px">
					Dirección
				</td>
				<td class="text-left" style="width: 423px">
					<?php echo (!empty($cuadro3)) ? $cuadro3->prov_ddireccioncliente . ' ' . $cuadro3->prov_ubigeo : ''; ?>
				</td>
			</tr>
			<tr>
				<td class="text-left" style="width: 200px">
					Representante
				</td>
				<td class="text-left" style="width: 423px">
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
				<td class="text-left" style="width: 423px">
					<?php echo (!empty($cuadro3)) ? $cuadro3->maqui_drazonsocial : ''; ?>
				</td>
			</tr>
			<tr>
				<td class="text-left" style="width: 200px">
					R.U.C
				</td>
				<td class="text-left" style="width: 423px">
					<?php echo (!empty($cuadro3)) ? $cuadro3->maqui_nruc : ''; ?>
				</td>
			</tr>
			<tr>
				<td class="text-left" style="width: 200px">
					Dirección
				</td>
				<td class="text-left" style="width: 423px">
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
				<td class="text-left" style="width: 423px">
					<?php
					if (!empty($cuadro3)) {
						$fechaInsp = explode('-', $cuadro3->fservicio);
						echo $fechaInsp[2] . ' ' . getMonthText(intval($fechaInsp[1])) . ' ' . $fechaInsp[0];
					}
					?>
				</td>
			</tr>
			<tr>
				<td class="text-left" style="width: 200px">
					Lugar de Inspección
				</td>
				<td class="text-left" style="width: 423px">
					<?php echo (!empty($cuadro3)) ? $cuadro3->DIRESTPROV . ' ' . $cuadro3->UBIGEOESTCLTE : ''; ?>
				</td>
			</tr>
			<tr>
				<td class="text-left" style="width: 200px">
					Responsable de la inspección
				</td>
				<td class="text-left" style="width: 423px">
					<?php echo (!empty($cuadro3)) ? $cuadro3->dapepat . ' ' . $cuadro3->dapemat . ' ' . $cuadro3->dnombre : '-'; ?>
					(Jefe de Gestión de la Calidad)
				</td>
			</tr>
			<tr>
				<td class="text-left" style="width: 200px">
					Licencias de Funcionamiento
				</td>
				<td class="text-left" style="width: 423px">
					<?php echo (!empty($cuadro3)) ? $cuadro3->dadicionallicencia : ''; ?>
				</td>
			</tr>
			<tr>
				<td class="text-left" style="width: 200px">
					Certificados / otros
				</td>
				<td class="text-left" style="width: 423px">
					<?php echo (!empty($cuadro3)) ? $cuadro3->CERTIFICACION . ' - ' . $cuadro3->SCERTIFICACION . ' - ' . $cuadro3->dpermisoautoridadsanitaria : ''; ?>
				</td>
			</tr>
			<tr>
				<td class="text-left" style="width: 200px">
					Inspector
				</td>
				<td class="text-left" style="width: 423px">
					<Ing class=""></Ing> <?php echo (!empty($cuadro3)) ? ucwords(strtolower($cuadro3->insp_dnombre)) . ' ' . ucwords(strtolower($cuadro3->insp_dapepat)) . ' ' . ucwords(strtolower($cuadro3->insp_dapemat)) : ''; ?>
				</td>
			</tr>
		</table>
	</div>
	<h3>II. OBJETIVOS</h3>
	<div class="text-left text-justify col-12" >
		Verificar las condiciones sanitarias del proceso de producción de alimentos, en
		cumplimiento a los criterios de inspección, que permita a <?php echo $caratula->nomcliente ?>
		asegurar la calidad sanitaria de sus diferentes establecimientos ubicados a nivel
		nacional.
	</div>
	<div>
		<h3>III. ALCANCE</h3>
		<div class="text-left text-justify" style="padding-left: 8px" >
			<table class="table pb">
				<tr>
					<td class="col-1" >
						Linea
					</td>
					<td class="col-11" >
						: <?php echo (!empty($cuadro1)) ? $cuadro1->alcance : ''; ?>
					</td>
				</tr>
				<tr>
					<td class="col-1" >
						Marca
					</td>
					<td class="col-11" >
						: <?php echo (!empty($cuadro1)) ? $cuadro1->marca : ''; ?>
					</td>
				</tr>
			</table>
		</div>
	</div>
	<div>
		<h3 style="margin-top: 0; padding-top: 0">IV. CRITERIOS DE INSPECCION</h3>
		<div class="text-justify col-12 " >
			<?php echo (!empty($criterioInspeccion)) ? nl2br($criterioInspeccion->dcriterios) : ''; ?>
		</div>
	</div>
	<h3>V. CRITERIOS DE EVALUACION Y CALIFICACION</h3>
	<table class="table table-bordered" style="padding-left: 12px" >
		<tr>
			<td class="text-center bg-gray" style="width: 640px;">
				Criterios de evaluación
			</td>
		</tr>
	</table>
	<table class="table table-bordered pb" style="padding-left: 12px" >
		<?php if (!empty($criterioEvaluacion)) { ?>
			<?php foreach ($criterioEvaluacion as $key => $value) { ?>
				<tr>
					<td class="text-left text-left" style="width: 200px">
						<?php echo $value->ddetallevalor ?>
					</td>
					<td class="text-left text-justify" style="width: 417px">
						<?php echo $value->dvaloracion ?>
					</td>
				</tr>
			<?php } ?>
		<?php } ?>
	</table>
	<div class="text-left text-justify pb col-12" >
		<p class="pb" style="margin-bottom: 0; padding-top: 0; margin-top: 0">
			La inspeccción es realizada con la ayuda de una lista de verificación específica para la linea
			inspeccionada,
			acorde a la normativa sanitaria aplicable, el cual permite evaluar los requisitos sanitarios referidos a los
			Programas de Prerequisitos (PPR), al Sistema de Análisis de Peligros y puntos Críticos de Control (HACCP)
			en caso aplique y al Sistema de Gestión de Inocuidad.
		</p>
		Cada requisito es valorado de acuerdo a lo indicado en la siguiente escala:
	</div>
	<table class="table table-bordered" style="padding-left: 12px" >
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
					<td class="text-left text-justify" style="width: 550px">
						<?php echo $value->dvaloracion ?>
					</td>
				</tr>
			<?php } ?>
		<?php } ?>
	</table>
	<div class="text-justify pt col-12">
		<?php echo $parrafoExcluyentes; ?>
	</div>
	<table class="table table-bordered pt" style="padding-left: 12px" >
		<tr>
			<td class="text-center bg-gray" style="width: 643px">
				Requisitos excluyentes
			</td>
		</tr>
	</table>
	<table class="table table-bordered" style="padding-left: 12px" >
		<tr>
			<td class="text-center bg-gray" style="width: 75px;">
				N° <br> Requisito
			</td>
			<td class="text-center bg-gray" style="width: 120px;">
				Título
			</td>
			<td class="text-center bg-gray" style="width: 402px;">
				Descripción del requisito
			</td>
		</tr>
	</table>
	<table class="table table-bordered" style="padding-left: 12px" >
		<?php if (!empty($requisitosExcluyentes)) { ?>
			<?php foreach ($requisitosExcluyentes as $key => $value) { ?>
				<tr>
					<td class="text-left" style="width: 75px">
						<?php echo $value->dnumerador ?>
					</td>
					<td class="text-left" style="width: 120px">
						<?php echo $value->titulo ?>
					</td>
					<td class="text-left text-justify" style="width: 402px">
						<?php echo $value->drequisito ?>
					</td>
				</tr>
			<?php } ?>
		<?php } ?>
	</table>
	<div class="text-justify pt pb col-12" >
		En función al puntaje obtenido por el proveedor en la inspección sanitaria, puede ser clasificado según la
		siguiente escala; asi mismo se le asigna una identificación por color.
	</div>
	<table class="table table-bordered pb" style="padding-left: 100px" >
			<tr>
				<td colspan="3" class="text-center bg-gray">
					Escala de Clasificación del Proveedor
				</td>
			</tr>
			<tr>
				<td class="text-center bg-gray" style="width: 100px;">
					Calificación
				</td>
				<td class="text-center bg-gray" style="width: 180px;">
					Rango de Cumplimiento
				</td>
				<td class="text-center bg-gray" style="width: 150px;">
					Identifiación por Color
				</td>
			</tr>
			<tr>
				<td class="text-center" style="width: 100px">
					Muy Bueno
				</td>
				<td class="text-center" style="width: 180px">
					86% a 100%
				</td>
				<td class="text-center" style="width: 150px; background: <?php echo getColor(100); ?>; padding: 3px;">
					&nbsp;
				</td>
			</tr>
			<tr>
				<td class="text-center" style="width: 100px">
					Bueno
				</td>
				<td class="text-center" style="width: 180px">
					71% a 85.99%
				</td>
				<td class="text-center" style="width: 150px; background: <?php echo getColor(80); ?>; padding: 3px;">
					&nbsp;
				</td>
			</tr>
			<tr>
				<td class="text-center" style="width: 100px">
					Regular
				</td>
				<td class="text-center" style="width: 180px">
					51% a 70.99%
				</td>
				<td class="text-center" style="width: 150px; background: <?php echo getColor(60); ?>; padding: 3px;">
					&nbsp;
				</td>
			</tr>
			<tr>
				<td class="text-center" style="width: 100px">
					Deficiente
				</td>
				<td class="text-center" style="width: 180px">
					0% a 50.99%
				</td>
				<td class="text-center" style="width: 150px; background: <?php echo getColor(10); ?>; padding: 3px;">
					&nbsp;
				</td>
			</tr>
		</table>
	<div class="text-justify col-12">
		Nota: En caso un establecimiento haya sido calificado con una No Conformidad en alguno de los requisitos
		excluyentes, bajará al nivel inmediato inferior; cabe señalar, que por cada excluyente incumplido, bajará
		un nivel y se le asignará el porcentaje mayor del rango de cumplimiento en el que se ubique.
	</div>
	<div style="page-break-after:always"></div>
	<h3 style="margin-top: 0; padding-top: 0">VI. RESULTADOS</h3>
	<table class="table table-bordered text-sm">
		<thead>
		<tr>
			<td class="text-center bg-gray" style="width: 20px">
				<span class="text-sm">N°</span>
			</td>
			<td class="text-center bg-gray" style="width: 140px">
				<span class="text-sm">Requisito</span>
			</td>
			<td class="text-center bg-gray" style="width: 100px">
				<span class="text-sm">Normativa</span>
			</td>
			<td class="text-center bg-gray" style="width: 20px">
				<span class="text-sm">Punt. <br> Max.</span>
			</td>
			<td class="text-center bg-gray" style="width: 20px">
				<span class="text-sm">Punt. <br> Obt.</span>
			</td>
			<td class="text-center bg-gray" style="width: 140px">
				<span class="text-sm">Hallazgo / Seguimiento</span>
			</td>
			<td class="text-center bg-gray" style="width: 75px">
				<span class="text-sm">Criterio <br> Calificación</span>
			</td>
		</tr>
		</thead>
		<tbody>
		<?php $totalValorMaxRequisito = 0; ?>
		<?php $totalValorRequisito = 0; ?>
		<?php foreach ($cuadro4 as $key => $value) { ?>
			<?php
			$bgGray = (count(explode('.', $value->DNUMERADOR)) <= 2) ? 'bg-gray' : '';
			$NVALORMAXREQUISITO = round($value->NVALORMAXREQUISITO);
			$NVALORREQUISITO = round($value->NVALORREQUISITO);
			if ($NVALORMAXREQUISITO <= 0 && $NVALORREQUISITO <= 0) {
				$NVALORMAXREQUISITO = 'N.A.';
				$NVALORREQUISITO = 'N.A.';
			}
			?>
			<tr>
				<td class="text-left <?php echo $bgGray; ?>" style="width: 20px">
					<span class="text-sm"><?php echo $value->DNUMERADOR ?></span>
				</td>
				<td class="text-left text-justify <?php echo $bgGray; ?>" style="width: 140px">
					<span class="text-sm"><?php echo $value->DREQUISITO ?></span>
				</td>
				<td class="text-left <?php echo $bgGray; ?>" style="width: 100px">
					<span class="text-sm"><?php echo $value->DNORMATIVA ?></span>
				</td>
				<td class="text-center <?php echo $bgGray; ?>" style="width: 20px">
					<span class="text-sm"><?php echo $NVALORMAXREQUISITO ?></span>
				</td>
				<td class="text-center <?php echo $bgGray; ?>" style="width: 20px">
					<span class="text-sm"><?php echo $NVALORREQUISITO ?></span>
				</td>
				<td class="text-lef text-justify <?php echo $bgGray; ?>" style="width: 140px">
					<span class="text-sm"><?php echo $value->DHALLAZGOTEXT ?></span>
				</td>
				<td class="text-lef <?php echo $bgGray; ?>" style="width: 75px">
					<span class="text-sm"><?php echo $value->DDETALLEVALOR ?></span>
				</td>
			</tr>
			<?php
			$nro = count(explode('.', $value->DNUMERADOR));
			if ($nro == 1) {
				$totalValorMaxRequisito += $value->NVALORMAXREQUISITO;
				$totalValorRequisito += $value->NVALORREQUISITO;
			}
			?>
		<?php } ?>
		</tbody>
		<tr>
			<td class=""></td>
			<td class=""></td>
			<td class="text-center">
				<span class="text-sm">Puntaje Total</span>
			</td>
			<td class="text-center">
				<span class="text-sm"><?php echo round($totalValorMaxRequisito); ?></span>
			</td>
			<td class="text-center">
				<span class="text-sm"><?php echo round($totalValorRequisito); ?></span>
			</td>
			<td colspan="2"></td>
		</tr>
	</table>
	<div style="page-break-after:always"></div>
	<h3 class="pb" style="margin-top: 0; padding-top: 0">VII. CONCLUSIONES</h3>
	<div class="text-justify pb co-12">
		<?php echo $conclucionesGenerales; ?>
	</div>
	<?php if (!empty($peligros)) { ?>
		<?php if ($peligros[0]->dproducto != 'SIN PRODUCTO') { ?>
			<h4>Tabla de Peligros</h4>
			<table class="table table-bordered pb">
				<tr>
					<td class="text-center bg-gray" style="width: 20px">
						N°
					</td>
					<td class="text-center bg-gray" style="width: 105px;">
						Producto
					</td>
					<td class="text-center bg-gray" style="width: 110px;">
						Peligro Cliente
					</td>
					<td class="text-center bg-gray" style="width: 110px;">
						Peligro Proveedor
					</td>
					<td class="text-center bg-gray" style="width: 100px;">
						Peligro Inspeccion
					</td>
					<td class="text-center bg-gray" style="width: 100px;">
						Observacion
					</td>
				</tr>
				<?php foreach ($peligros as $key => $value) { ?>
					<tr>
						<td class="text-center" style="width: 20px">
							<?php echo($key + 1) ?>
						</td>
						<td class="text-left" style="width: 105px;">
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
	<div class="">
		<h3 style="padding-top: 0; margin-top: 0">VIII. PLAN DE ACCIONES CORRECTIVAS</h3>
		<div class="text-justify col-12" >
			<p class="pb" style="margin-bottom: 0; padding-top: 0; margin-top: 0"><?php echo $planAccionParrafo1; ?></p>
			<p class="pb" style="margin-bottom: 0; padding-top: 0; margin-top: 0"><?php echo $planAccionParrafo2; ?></p>
			<p style="margin-bottom: 0; padding-bottom: 0; padding-top: 0; margin-top: 0"><?php echo $planAccionParrafo3; ?></p>
		</div>
	</div>
	<div class="col-6 pt">
		<table style="width: 100%" border="0" cellspacing="0" cellpadding="0">
			<tr>
				<td class="col-12 text-center" style="border: none">
					<?php if (!empty($rutafirma)) { ?>
						<img src="<?php echo $rutafirma ?>"
							 alt="Firma Digital" style="width: 220px; height: 100px">
					<?php } ?>
				</td>
			</tr>
			<tr>
				<td class="col-12 text-center" style="border-top: 1px solid #000;">
					Ing. <?php echo (!empty($inspector)) ? $inspector->dnombre . ' ' . $inspector->dapepat . ' ' . $inspector->dapemat : ''; ?>
					<br>
					INSPECTOR <br>
					GRUPO FS S.A.C.
				</td>
			</tr>
		</table>
	</div>
</page>
