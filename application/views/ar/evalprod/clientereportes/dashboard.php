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
									Tendencia anual de rendimiento (%)
								</a>
							</li>
							<li class="nav-item">
								<a class="nav-link" style="color: #000000;" id="tabReg1-tab"
								   data-toggle="pill" href="#tabReg2" role="tab"
								   aria-controls="tabReg1" aria-selected="true">
									Distribución de Productos por línea
								</a>
							</li>
							<li class="nav-item">
								<a class="nav-link" style="color: #000000;" id="tabReg1-tab"
								   data-toggle="pill" href="#tabReg3" role="tab"
								   aria-controls="tabReg1" aria-selected="true">
									Unidades de Aprobación de productos por Linea
								</a>
							</li>
							<li class="nav-item">
								<a class="nav-link" style="color: #000000;" id="tabReg1-tab"
								   data-toggle="pill" href="#tabReg4" role="tab"
								   aria-controls="tabReg1" aria-selected="true">
									Porcentaje de Aprobación de productos por Linea
								</a>
							</li>
						</ul>
					</div>
					<div class="card-body">
						<div class="row" >
							<div class="col-xl-2 col-lg-2 col-md-4 col-sm-4 col-12" >
								<div class="form-group" >
									<label for="anio">
										Año
									</label>
									<select name="anio" id="anio" class="custom-select d-block" style="width: 100% !important;" >
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
							<div class="col-xl-2 col-lg-2 col-md-4 col-sm-4 col-12" >
								<div class="form-group" >
									<label for="mes">
										Mes
									</label>
									<select name="mes" id="mes" class="custom-select d-block" style="width: 100% !important;" >
										<option value="">::Todos::</option>
										<option value="1">Enero</option>
										<option value="2">Febrero</option>
										<option value="3">Marzo</option>
										<option value="4">Abril</option>
										<option value="5">Mayo</option>
										<option value="6">Junio</option>
										<option value="7">Julio</option>
										<option value="8">Agosto</option>
										<option value="9">Setiembre</option>
										<option value="10">Octubre</option>
										<option value="11">Noviembre</option>
										<option value="12">Diciembre</option>
									</select>
								</div>
							</div>
							<div class="col-xl-2 col-lg-2 col-md-4 col-sm-4 col-12" >
								<label for="" class="d-block" >
									&nbsp;
								</label>
								<button type="button" role="button" class="btn btn-primary" id="btnBuscarResultado" >
									<i class="fa fa-search" ></i> Buscar Resultado
								</button>
							</div>
						</div>
						<div class="tab-content">
							<div class="tab-pane fade show active" id="tabReg1" role="tabpanel">
								<div class="row" >
									<div class="col-xl-4 col-lg-4 col-md-4 col-sm-12 col-12" >
										<div class="table-responsive" >
											<table class="table table-striped table-bordered" id="tblTendenciaAnualRendi" >
												<thead>
												<tr class="bg-secondary text-white" >
													<th class="text-center" >N° Mes</th>
													<th class="text-left" >Mes</th>
													<th class="text-right" >% Indicador</th>
													<th class="text-right" >N° de muestras</th>
												</tr>
												</thead>
												<tbody></tbody>
											</table>
										</div>
									</div>
									<div class="col-xl-8 col-lg-8 col-md-8 col-sm-12 col-12" >
										<div id="grafTendenciaAnualRendi" style="width: 100%; height: 400px" ></div>
									</div>
								</div>
							</div>
							<div class="tab-pane fade" id="tabReg2" role="tabpanel">
								<div class="row" >
									<div class="col-xl-4 col-lg-4 col-md-4 col-sm-12 col-12" >
										<div class="table-responsive" >
											<table class="table table-striped table-bordered" id="tblDistProductoLinea" >
												<thead>
												<tr class="bg-secondary text-white" >
													<th class="text-center" >N°</th>
													<th class="text-left" >Área</th>
													<th class="text-right" >Cantidad</th>
													<th class="text-right" >Total %</th>
												</tr>
												</thead>
												<tbody></tbody>
											</table>
										</div>
									</div>
									<div class="col-xl-8 col-lg-8 col-md-8 col-sm-12 col-12" >
										<div id="grafDistProductoLinea" style="width: 100%; height: 400px" ></div>
									</div>
								</div>
							</div>
							<div class="tab-pane fade" id="tabReg3" role="tabpanel">
								<div class="row" >
									<div class="col-xl-5 col-lg-5 col-md-6 col-sm-12 col-12" >
										<div class="table-responsive" >
											<table class="table table-striped table-bordered" id="tblUnicaproProdlinea" >
												<thead>
												<tr class="bg-secondary text-white" >
													<th rowspan="2" class="text-center align-middle" >N°</th>
													<th rowspan="2" class="text-left align-middle" >Área</th>
													<th rowspan="2" class="text-center align-middle" >Aprobados</th>
													<th colspan="4" class="text-left" >No Aprobados</th>
												</tr>
												<tr class="bg-secondary text-white" >
													<th class="text-right" >Obs.</th>
													<th class="text-right" >Rechaz.</th>
													<th class="text-right" >Pendiente Vida Util</th>
													<th class="text-right" >Total No aprobados</th>
												</tr>
												</thead>
												<tbody></tbody>
											</table>
										</div>
									</div>
									<div class="col-xl-7 col-lg-7 col-md-6 col-sm-12 col-12" >
										<div id="grafUniCaproProdlinea" style="width: 100%; height: 400px" ></div>
									</div>
								</div>
							</div>
							<div class="tab-pane fade" id="tabReg4" role="tabpanel">
								<div class="row" >
									<div class="col-xl-5 col-lg-5 col-md-6 col-sm-12 col-12" >
										<div class="table-responsive" >
											<table class="table table-striped table-bordered" id="tblPorCaproProdlinea" >
												<thead>
												<tr class="bg-secondary text-white" >
													<th rowspan="2" class="text-center align-middle" >N°</th>
													<th rowspan="2" class="text-left align-middle" >Área</th>
													<th rowspan="2" class="text-center align-middle" >Aprobados</th>
													<th colspan="4" class="text-left" >No Aprobados</th>
												</tr>
												<tr class="bg-secondary text-white" >
													<th class="text-right" >Obs.</th>
													<th class="text-right" >Rechaz.</th>
													<th class="text-right" >Pendiente Vida Util</th>
													<th class="text-right" >Total No aprobados</th>
												</tr>
												</thead>
												<tbody></tbody>
											</table>
										</div>
									</div>
									<div class="col-xl-7 col-lg-7 col-md-6 col-sm-12 col-12" >
										<div id="grafPorCaproProdlinea" style="width: 100%; height: 400px" ></div>
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
