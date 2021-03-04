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

		.new-page {
			margin-top: 100px;
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
<div id="header">
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
				<td class="col-12" style="border: 0; padding: 0;" >
					<table class="table bg-gray border-gray" >
						<tr>
							<td class="col-12 text-center font-weigth-bold">
								INSPECCION SANITARIA
							</td>
						</tr>
						<tr>
							<td class="col-12 text-center font-weigth-bold uppercase" style="padding: 15px" >
								PROGRAMA DE <?php echo $caratula->dsubservicio ?> <br>
								<?php echo $caratula->nomcliente ?>
							</td>
						</tr>
					</table>
				</td>
			</tr>
			<tr>
				<td class="col-12 text-center" style="height: 200px; vertical-align: middle" >
					<p class="uppercase">
						<?php echo $caratula->proveedor; ?>
					</p>
				</td>
			</tr>
			<tr>
				<td class="col-12 text-center" style="height: 150px; vertical-align: middle" >
					<p class="uppercase">
						LINEA: <?php echo $caratula->lineaprocesoclte ?>
					</p>
				</td>
			</tr>
			<tr>
				<td class="col-12 text-center" style="height: 220px; vertical-align: middle" >
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
	<div class="col-12 new-page" >
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
</body>
</html>
