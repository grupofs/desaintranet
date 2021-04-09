<div class="content-header">
	<div class="container-fluid">
		<div class="row mb-2">
			<div class="col-sm-6">
				<h1 class="m-0 text-dark">DASHBOARD</h1>
			</div>
			<div class="col-sm-6">
				<ol class="breadcrumb float-sm-right">
					<li class="breadcrumb-item"><a href="">Home</a></li>
					<!--<li class="breadcrumb-item active">Dashboard Interno</li>-->
				</ol>
			</div>
		</div>
	</div>
</div>

<section class="content">
	<div class="container-fluid">
		<div class="row">
			<div class="col-12">
				<div class="card card-success card-outline card-tabs">
					<div class="card-header p-0 pt-1 border-bottom-0">
						<ul class="nav nav-tabs" id="tabptcliente" style="background-color: #28a745;" role="tablist">
							<li class="nav-item">
								<a class="nav-link active" style="color: #000000;" id="tabReg1-tab"
								   data-toggle="pill" href="#tabReg1" role="tab"
								   aria-controls="tabReg1" aria-selected="true">
									PROGRAMACION DE INSPECCIONES
								</a>
							</li>
							<li class="nav-item">
								<a class="nav-link" style="color: #000000;" id="tabReg1-tab"
								   data-toggle="pill" href="#tabReg2" role="tab"
								   aria-controls="tabReg1" aria-selected="true">
									CUADRO INSPECCIONES REALIZADAS POR AREAS
								</a>
							</li>
							<li class="nav-item">
								<a class="nav-link" style="color: #000000;" id="tabReg1-tab"
								   data-toggle="pill" href="#tabReg3" role="tab"
								   aria-controls="tabReg1" aria-selected="true">
									INSPECCIONES NO REALIZADAS
								</a>
							</li>
						</ul>
					</div>
					<div class="card-body">
						<div class="row" >
							<div class="col-xl-4 col-lg-4 col-md-4 col-sm-6 col-12" >
								<div class="form-group" >
									<label for="periodo">
										Año
									</label>
									<select name="periodo" id="periodo" class="custom-select d-block" >
										<?php
										$options = '';
										$minYear = 2010;
										$currentYear = date('Y');
										$refCurrentYear = $currentYear;
										while($minYear <= $currentYear) {
											$selected = ($currentYear === $refCurrentYear) ? 'selected' : '';
											$options .= '<option value="' . $refCurrentYear . '" ' . $selected . ' >' . $refCurrentYear . '</option>';
											++$minYear;
											--$refCurrentYear;
										}
										echo $options;
										?>
									</select>
								</div>
							</div>
						</div>
						<div class="tab-content">
							<div class="tab-pane fade show active" id="tabReg1" role="tabpanel">
								<div class="row" >
									<div class="col-xl-3 col-lg-3 col-md-4 col-sm-12 col-12" >
										<div class="table-responsive" >
											<table class="table table-sm table-bordered" >
												<thead>
												<tr>
													<th class="text-center bg-secondary text-white" >MESES</th>
													<th class="text-center bg-secondary text-white" >Cuenta de Línea</th>
												</tr>
												</thead>
												<tbody>
												<tr>
													<td class="text-center" >Ene</td>
													<td class="text-center" >48</td>
												</tr>
												<tr>
													<td class="text-center" >Feb</td>
													<td class="text-center" >48</td>
												</tr>
												<tr>
													<td class="text-center" >Mar</td>
													<td class="text-center" >48</td>
												</tr>
												<tr>
													<td class="text-center" >Abr</td>
													<td class="text-center" >48</td>
												</tr>
												<tr>
													<td class="text-center" >May</td>
													<td class="text-center" >48</td>
												</tr>
												<tr>
													<td class="text-center" >Jun</td>
													<td class="text-center" >48</td>
												</tr>
												<tr>
													<td class="text-center" >Jul</td>
													<td class="text-center" >48</td>
												</tr>
												<tr>
													<td class="text-center" >Ago</td>
													<td class="text-center" >48</td>
												</tr>
												<tr>
													<td class="text-center" >Set</td>
													<td class="text-center" >48</td>
												</tr>
												<tr>
													<td class="text-center" >Oct</td>
													<td class="text-center" >48</td>
												</tr>
												<tr>
													<td class="text-center" >Nov</td>
													<td class="text-center" >48</td>
												</tr>
												<tr>
													<td class="text-center" >Dic</td>
													<td class="text-center" >48</td>
												</tr>
												<tr>
													<td class="text-center bg-secondary text-white" >Total general</td>
													<td class="text-center bg-secondary text-white" >480</td>
												</tr>
												</tbody>
											</table>
										</div>
									</div>
									<div class="col-xl-9 col-lg-9 col-md-8 col-sm-12 col-12" >
										<div class="table-responsive" >
											<table class="table table-sm table-bordered" >
												<thead>
												<tr>
													<th class="text-center bg-secondary text-white" >Etiquetas de fila</th>
													<th class="text-center bg-secondary text-white" >Concluido Ok</th>
													<th class="text-center bg-secondary text-white" >Convalidado</th>
													<th class="text-center bg-secondary text-white" >Informe por Quejas</th>
													<th class="text-center bg-secondary text-white" >No proveedor</th>
													<th class="text-center bg-secondary text-white" >Marca Propia</th>
													<th class="text-center bg-secondary text-white" >No hay respuesta</th>
													<th class="text-center bg-secondary text-white" >Programado</th>
													<th class="text-center bg-secondary text-white" >Total General</th>
												</tr>
												</thead>
												<tbody>
												<tr>
													<td class="text-center" >Ene</td>
													<td class="text-center" >2</td>
													<td class="text-center" >11</td>
													<td class="text-center" >0</td>
													<td class="text-center" >15</td>
													<td class="text-center" >1</td>
													<td class="text-center" >8</td>
													<td class="text-center" >11</td>
													<td class="text-center" >48</td>
												</tr>
												<tr>
													<td class="text-center" >Feb</td>
													<td class="text-center" >2</td>
													<td class="text-center" >11</td>
													<td class="text-center" >0</td>
													<td class="text-center" >15</td>
													<td class="text-center" >1</td>
													<td class="text-center" >8</td>
													<td class="text-center" >11</td>
													<td class="text-center" >48</td>
												</tr>
												<tr>
													<td class="text-center" >Mar</td>
													<td class="text-center" >2</td>
													<td class="text-center" >11</td>
													<td class="text-center" >0</td>
													<td class="text-center" >15</td>
													<td class="text-center" >1</td>
													<td class="text-center" >8</td>
													<td class="text-center" >11</td>
													<td class="text-center" >48</td>
												</tr>
												<tr>
													<td class="text-center" >Abr</td>
													<td class="text-center" >2</td>
													<td class="text-center" >11</td>
													<td class="text-center" >0</td>
													<td class="text-center" >15</td>
													<td class="text-center" >1</td>
													<td class="text-center" >8</td>
													<td class="text-center" >11</td>
													<td class="text-center" >48</td>
												</tr>
												<tr>
													<td class="text-center" >May</td>
													<td class="text-center" >2</td>
													<td class="text-center" >11</td>
													<td class="text-center" >0</td>
													<td class="text-center" >15</td>
													<td class="text-center" >1</td>
													<td class="text-center" >8</td>
													<td class="text-center" >11</td>
													<td class="text-center" >48</td>
												</tr>
												<tr>
													<td class="text-center" >Jun</td>
													<td class="text-center" >2</td>
													<td class="text-center" >11</td>
													<td class="text-center" >0</td>
													<td class="text-center" >15</td>
													<td class="text-center" >1</td>
													<td class="text-center" >8</td>
													<td class="text-center" >11</td>
													<td class="text-center" >48</td>
												</tr>
												<tr>
													<td class="text-center" >Jul</td>
													<td class="text-center" >2</td>
													<td class="text-center" >11</td>
													<td class="text-center" >0</td>
													<td class="text-center" >15</td>
													<td class="text-center" >1</td>
													<td class="text-center" >8</td>
													<td class="text-center" >11</td>
													<td class="text-center" >48</td>
												</tr>
												<tr>
													<td class="text-center" >Ago</td>
													<td class="text-center" >2</td>
													<td class="text-center" >11</td>
													<td class="text-center" >0</td>
													<td class="text-center" >15</td>
													<td class="text-center" >1</td>
													<td class="text-center" >8</td>
													<td class="text-center" >11</td>
													<td class="text-center" >48</td>
												</tr>
												<tr>
													<td class="text-center" >Set</td>
													<td class="text-center" >2</td>
													<td class="text-center" >11</td>
													<td class="text-center" >0</td>
													<td class="text-center" >15</td>
													<td class="text-center" >1</td>
													<td class="text-center" >8</td>
													<td class="text-center" >11</td>
													<td class="text-center" >48</td>
												</tr>
												<tr>
													<td class="text-center" >Oct</td>
													<td class="text-center" >2</td>
													<td class="text-center" >11</td>
													<td class="text-center" >0</td>
													<td class="text-center" >15</td>
													<td class="text-center" >1</td>
													<td class="text-center" >8</td>
													<td class="text-center" >11</td>
													<td class="text-center" >48</td>
												</tr>
												<tr>
													<td class="text-center" >Nov</td>
													<td class="text-center" >2</td>
													<td class="text-center" >11</td>
													<td class="text-center" >0</td>
													<td class="text-center" >15</td>
													<td class="text-center" >1</td>
													<td class="text-center" >8</td>
													<td class="text-center" >11</td>
													<td class="text-center" >48</td>
												</tr>
												<tr>
													<td class="text-center" >Dic</td>
													<td class="text-center" >2</td>
													<td class="text-center" >11</td>
													<td class="text-center" >0</td>
													<td class="text-center" >15</td>
													<td class="text-center" >1</td>
													<td class="text-center" >8</td>
													<td class="text-center" >11</td>
													<td class="text-center" >48</td>
												</tr>
												<tr>
													<td class="text-center bg-secondary text-white" >Total general</td>
													<td class="text-center bg-secondary text-white" >253</td>
													<td class="text-center bg-secondary text-white" >87</td>
													<td class="text-center bg-secondary text-white" >1</td>
													<td class="text-center bg-secondary text-white" >53</td>
													<td class="text-center bg-secondary text-white" >36</td>
													<td class="text-center bg-secondary text-white" >15</td>
													<td class="text-center bg-secondary text-white" >35</td>
													<td class="text-center bg-secondary text-white" >480</td>
												</tr>
												</tbody>
											</table>
										</div>
									</div>
								</div>
							</div>
							<div class="tab-pane fade" id="tabReg2" role="tabpanel">
								<div class="table-responsive" >
									<table class="table table-sm table-bordered" >
										<thead>
										<tr>
											<th class="text-center bg-secondary text-white" >Áreas</th>
											<th class="text-center bg-secondary text-white" >Líneas Programadas</th>
											<th class="text-center bg-secondary text-white" >Líneas Inspeccionadas Grupo FS</th>
											<th class="text-center bg-secondary text-white" >Convaliados</th>
											<th class="text-center bg-secondary text-white" >%</th>
											<th class="text-center bg-secondary text-white" >No Inspeccionados</th>
											<th class="text-center bg-secondary text-white" >% Inspecciones No realizadas</th>
										</tr>
										</thead>
										<tbody>
										<tr>
											<td class="text-center" >ABARROTES</td>
											<td class="text-center" >189</td>
											<td class="text-center" >91</td>
											<td class="text-center" >44</td>
											<td class="text-center" >71%</td>
											<td class="text-center" >54</td>
											<td class="text-center" >29%</td>
										</tr>
										<tr>
											<td class="text-center" >CARNICERÍA</td>
											<td class="text-center" >189</td>
											<td class="text-center" >91</td>
											<td class="text-center" >44</td>
											<td class="text-center" >71%</td>
											<td class="text-center" >54</td>
											<td class="text-center" >29%</td>
										</tr>
										<tr>
											<td class="text-center" >CONGELADOS</td>
											<td class="text-center" >189</td>
											<td class="text-center" >91</td>
											<td class="text-center" >44</td>
											<td class="text-center" >71%</td>
											<td class="text-center" >54</td>
											<td class="text-center" >29%</td>
										</tr>
										<tr>
											<td class="text-center" >CONTACTO DIRECTO CON ALIMENTOS</td>
											<td class="text-center" >189</td>
											<td class="text-center" >91</td>
											<td class="text-center" >44</td>
											<td class="text-center" >71%</td>
											<td class="text-center" >54</td>
											<td class="text-center" >29%</td>
										</tr>
										<tr>
											<td class="text-center" >FIAMBRES</td>
											<td class="text-center" >189</td>
											<td class="text-center" >91</td>
											<td class="text-center" >44</td>
											<td class="text-center" >71%</td>
											<td class="text-center" >54</td>
											<td class="text-center" >29%</td>
										</tr>
										<tr>
											<td class="text-center" >FRUTAS Y VERDURAS</td>
											<td class="text-center" >189</td>
											<td class="text-center" >91</td>
											<td class="text-center" >44</td>
											<td class="text-center" >71%</td>
											<td class="text-center" >54</td>
											<td class="text-center" >29%</td>
										</tr>
										<tr>
											<td class="text-center" >LACTEOS</td>
											<td class="text-center" >189</td>
											<td class="text-center" >91</td>
											<td class="text-center" >44</td>
											<td class="text-center" >71%</td>
											<td class="text-center" >54</td>
											<td class="text-center" >29%</td>
										</tr>
										<tr>
											<td class="text-center" >LÍQUIDOS</td>
											<td class="text-center" >189</td>
											<td class="text-center" >91</td>
											<td class="text-center" >44</td>
											<td class="text-center" >71%</td>
											<td class="text-center" >54</td>
											<td class="text-center" >29%</td>
										</tr>
										<tr>
											<td class="text-center" >OPERADORES LOGISTICOS</td>
											<td class="text-center" >189</td>
											<td class="text-center" >91</td>
											<td class="text-center" >44</td>
											<td class="text-center" >71%</td>
											<td class="text-center" >54</td>
											<td class="text-center" >29%</td>
										</tr>
										<tr>
											<td class="text-center" >PANADERÍA Y PASTELERÍA</td>
											<td class="text-center" >189</td>
											<td class="text-center" >91</td>
											<td class="text-center" >44</td>
											<td class="text-center" >71%</td>
											<td class="text-center" >54</td>
											<td class="text-center" >29%</td>
										</tr>
										<tr>
											<td class="text-center" >PESCADERIA</td>
											<td class="text-center" >189</td>
											<td class="text-center" >91</td>
											<td class="text-center" >44</td>
											<td class="text-center" >71%</td>
											<td class="text-center" >54</td>
											<td class="text-center" >29%</td>
										</tr>
										<tr>
											<td class="text-center" >PLATOS PREPARADOS</td>
											<td class="text-center" >189</td>
											<td class="text-center" >91</td>
											<td class="text-center" >44</td>
											<td class="text-center" >71%</td>
											<td class="text-center" >54</td>
											<td class="text-center" >29%</td>
										</tr>
										<tr>
											<td class="text-center bg-secondary text-white" >TOTAL</td>
											<td class="text-center bg-secondary text-white" >480</td>
											<td class="text-center bg-secondary text-white" >253</td>
											<td class="text-center bg-secondary text-white" >87</td>
											<td class="text-center bg-secondary text-white" >71%</td>
											<td class="text-center bg-secondary text-white" >140</td>
											<td class="text-center bg-secondary text-white" >29%</td>
										</tr>
										</tbody>
									</table>
								</div>
							</div>
							<div class="tab-pane fade" id="tabReg3" role="tabpanel">
								<div class="row" >
									<div class="col-xl-4 col-lg-4 col-md-4 col-sm-12 col-12" >
										<div class="table-responsive" >
											<table class="table table-sm table-bordered" >
												<thead class="bg-secondary text-white" >
												<tr>
													<th colspan="3" class="text-center" >SEGÚN ESTADOS</th>
												</tr>
												<tr>
													<th class="text-center" rowspan="3" >Estado</th>
												</tr>
												<tr>
													<th class="text-center" colspan="2" >Enero hasta Diciembre 2021</th>
												</tr>
												<tr>
													<th class="text-center" >PROVEEDORES</th>
													<th class="text-center" >%</th>
												</tr>
												</thead>
												<tbody>
												<tr>
													<td class="text-left" >
														No proveedor
													</td>
													<td class="text-center" >53</td>
													<td class="text-center" >23%</td>
												</tr>
												<tr>
													<td class="text-left" >
														Marca Propia
													</td>
													<td class="text-center" >36</td>
													<td class="text-center" >16%</td>
												</tr>
												<tr>
													<td class="text-left" >
														No hay respuesta
													</td>
													<td class="text-center" >15</td>
													<td class="text-center" >7%</td>
												</tr>
												<tr>
													<td class="text-left" >
														Reprogramado
													</td>
													<td class="text-center" >35</td>
													<td class="text-center" >15%</td>
												</tr>
												<tr>
													<td class="text-left" >
														Convalidado
													</td>
													<td class="text-center" >35</td>
													<td class="text-center" >15%</td>
												</tr>
												</tbody>
												<tfoot class="bg-secondary text-white" >
												<tr>
													<td class="text-center" >Total general</td>
													<td class="text-center" >226</td>
													<td class="text-center" >100%</td>
												</tr>
												</tfoot>
											</table>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>
