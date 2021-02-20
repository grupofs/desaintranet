<html lang="es">
<head>
	<title>Ficha tecnica</title>
	<style>
		@page {
			margin: 0.5in 0.5in 0.5in 0.5in;
			font-size: 16px;
		}

		.teacherPage {

		}

		header {
			position: fixed;
			top: 0px;
			left: 0px;
			right: 0px;
			height: 150px;
			min-height: 150px;
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
<header>
	<div class="col-12">
		<table class="table">
			<tr>
				<td class="col-4">
					<img src="<?php echo base64ResourceConvert('https://ii.ct-stc.com/3/logos/empresas/2009/03/11/grupo-fs-sac-F18D179794F775FFthumbnail.gif') ?>"
						 alt="GRUPOFS">
				</td>
				<td class="col-8 text-right text-12">
					Av. Del Pinar 110 of. 405 - 407 <br>
					Urb. Chacarilla del Estanque <br>
					Santiago de Surco - Lima - Perú <br>
					(51-1)372-1734 / 372-8182 <br>
					www.grupofs.com
				</td>
			</tr>
		</table>
	</div>
</header>
<page>
	<div class="col-12 text-caratula">
		<table class="table"
			   style="height: 380px; vertical-align: middle">
			<tr>
				<td class="col-12 text-center">INFORME TECNICO N° <?php echo $caratula->dinforme ?></td>
			</tr>
		</table>
		<table class="table bg-gray border-gray">
			<tr>
				<td class="col-12 text-center font-weigth-bold" style="padding: 10px;">
					INSPECCION SANITARIA
				</td>
			</tr>
			<tr>
				<td class="col-12 text-center font-weigth-bold uppercase" style="padding: 15px;">
					PROGRAMA DE <?php echo $caratula->dsubservicio ?> <br>
					<?php echo $caratula->nomcliente ?>
				</td>
			</tr>
		</table>
	</div>
	<div class="col-12 text-center text-caratula" style="margin-top: 35px">
		<p class="uppercase">
			<?php echo $caratula->proveedor; ?>
		</p>
	</div>
	<div class="col-12 text-center text-caratula" style="margin-top: 95px">
		<p class="uppercase">
			LINEA: <?php echo $caratula->lineaprocesoclte ?>
		</p>
	</div>
	<div class="col-12 text-center text-caratula" style="margin-top: 120px">
		<p class="uppercase">
			<?php
			$fservicio = explode('-', $caratula->fservicio);
			echo $fservicio[2] . ' DE ' . getMonthText($fservicio[1]) . ' DE ' . $fservicio[0];
			?>
		</p>
	</div>
</page>
<page>
	<div class="col-12" style="margin-top: 100px">
		<table class="table">
			<tr>
				<td class="col-12 text-center" style="padding: 10px">
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
				<td class="col-12" style="padding: 20px 70px;">
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
				<td class="col-12">
					<img src="<?php echo $imgGrafico1; ?>" style="width: 100%; height: 450px">
				</td>
			</tr>
		</table>
	</div>
</page>
<div style="margin-top: 120px">
	<table class="table">
		<tr>
			<td class="col-12 text-center uppercase" style="padding: 10px;">
				RESULTADO DE LA INSPECCION
			</td>
		</tr>
	</table>
	<table class="table table-bordered">
		<thead>
		<tr class="bg-gray">
			<th colspan="7" class="col-12 text-center">
				Listado de Verificación
			</th>
		</tr>
		<tr class="bg-gray">
			<td class="col-1 text-center">
				N°
			</td>
			<td class="col-5 text-center">
				Aspecto Evaluado
			</td>
			<td class="col-2 text-center">
				Puntajo <br> Maximo
			</td>
			<td class="col-2 text-center">
				Puntaje <br> Obtenido
			</td>
			<td class="col-2 text-center">
				% de <br> Confirmado
			</td>
			<td class="col-1 text-center">
				% <br> Peso
			</td>
			<td class="col-1 text-center">
				% de <br> Conf. Final
			</td>
		</tr>
		</thead>
		<tbody>
		<?php if (!empty($cuadro2)) { ?>
			<?php foreach ($cuadro2 as $keyCuadro2 => $itemCuadro2) { ?>
				<tr>
					<td class="col-1 text-center">
						<?php echo $itemCuadro2->dnumerador ?>
					</td>
					<td class="col-7 text-left">
						<?php echo $itemCuadro2->drequisito ?>
					</td>
					<td class="col-2 text-center">
						<?php echo $itemCuadro2->nvalorrequisito ?>
					</td>
					<td class="col-2 text-center">
						<?php echo $itemCuadro2->mayor_val ?>
					</td>
					<td class="col-2 text-center">
						100%
					</td>
					<td class="col-2 text-center bg-gray">
						&nbsp;
					</td>
					<td class="col-1 text-left bg-gray">
						&nbsp;
					</td>
				</tr>
			<?php } ?>
		<?php } ?>
		</tbody>
		<tfoot>
		<tr>
			<td colspan="2" class="text-center" >
				Puntaje Parcial
			</td>
			<td class="text-center" >
				572
			</td>
			<td class="text-center" >
				572
			</td>
			<td colspan="3" class="text-left" >
				100%
			</td>
		</tr>
		<tr>
			<td colspan="2" class="text-center" >
				Puntaje Final
			</td>
			<td colspan="5" class="text-center" >
				100.00%
			</td>
		</tr>
		</tfoot>
	</table>
	<div class="col-12" style="margin-top: 30px" >
		<img src="<?php echo $imgGrafico2 ?>" style="width: 100%; height: 350px">
	</div>
</div>
<page>
	<div class="col-12" style="margin-top: 50px" >
		<table class="table" >
			<tbody>
			<tr class="bg-gray" >
				<th colspan="2" class="col-12 text-left uppercase" >DATOS DEL PROVEEDOR</th>
			</tr>
			<tr>
				<td class="col-4 text-left" >
					Razon Social
				</td>
				<td class="col-8 text-left" >
					AGRO INDUSTRIAL PARAMONGA S.A.A
				</td>
			</tr>
			<tr>
				<td class="col-4 text-left" >
					R.U.C.
				</td>
				<td class="col-8 text-left" >
					20135948641
				</td>
			</tr>
			<tr>
				<td class="col-4 text-left" >
					Dirección
				</td>
				<td class="col-8 text-left" >
					Av. Ferrocarril N° 212 Paramonga (Lima - Barranca - Paramonga)
				</td>
			</tr>
			<tr>
				<td class="col-4 text-left" >
					Representante
				</td>
				<td class="col-8 text-left" >
					Ing. Percy Muente Kunigami
				</td>
			</tr>
			<tr class="bg-gray">
				<th colspan="2" class="col-12 text-left uppercase" >DATOS DE LA EMPRESA MAQUILLADORA</th>
			</tr>
			</tbody>
		</table>
	</div>
</page>
</body>
</html>
