<style>
	select.custom-select {
		width: 100% !important;
	}
	.swal2-content {
		padding: 1rem 1rem 1rem;
	}
</style>

<div class="content-header">
	<div class="container-fluid">
		<div class="row mb-2">
			<div class="col-sm-6">
				<h1 class="m-0 text-dark">
					REGISTRO DE TRAMITE
					<small>Módulo de Asunto Regulatorio</small>
				</h1>
			</div>
			<div class="col-sm-6">
				<ol class="breadcrumb float-sm-right">
					<li class="breadcrumb-item">
						<a href="<?php echo public_base_url(); ?>cprincipal/principal">Inicio</a>
					</li>
					<li class="breadcrumb-item">Asuntos Regulatorio</li>
					<li class="breadcrumb-item">A.R. Operaciones</li>
					<li class="breadcrumb-item active">Reg. Tramite</li>
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
								<a class="nav-link active" style="color: #000000;" id="tab-list-ar"
								   data-toggle="pill" href="#tabReg1" role="tab"
								   aria-controls="tabReg1" aria-selected="true">LISTADO</a>
							</li>
							<li class="nav-item">
								<a class="nav-link" style="color: #000000;" id="tab-registro-ar" data-toggle="pill"
								   href="#tabReg2" role="tab" aria-controls="tabReg2"
								   aria-selected="false">REGISTRO</a>
							</li>
						</ul>
					</div>
					<div class="card-body">
						<div class="tab-content">
							<div class="tab-pane fade show active" id="tabReg1" role="tabpanel">
								<div class="card card-success">
									<div class="card-header">
										<h3 class="card-title">Buscar</h3>

										<div class="card-tools">
											<button type="button" class="btn btn-tool" data-card-widget="collapse"><i
														class="fas fa-minus"></i></button>
										</div>
									</div>
									<div class="card-body">
										<form action="<?php echo base_url('ar/ope/ctramite/filtro') ?>" id="frmFiltro"
											  method="POST" onsubmit="return false;"
											  accept-charset="UTF-8">
											<input type="hidden" class="d-none" id="filtro_limit" name="filtro_limit"
												   value="1000">
											<input type="hidden" class="d-none" id="filtro_offset" name="filtro_offset"
												   value="0">
											<input type="hidden" class="d-none" id="type_result" name="type_result"
												   value="1">
											<div class="row">
												<div class="form-group col-xl-3 col-lg-4 col-md-8 col-sm-12 col-12">
													<label for="filtro_cliente">Cliente</label>
													<select class="custom-select"
															name="filtro_cliente" id="filtro_cliente"></select>
												</div>
												<div class="form-group col-xl-1 col-lg-2 col-md-4 col-sm-12 col-12">
													<label for="filtro_nro_ar">Nro. A.R.</label>
													<input type="text" name="filtro_nro_ar" id="filtro_nro_ar"
														   class="form-control" value="">
												</div>
												<div class="form-group col-xl-3 col-lg-4 col-md-6 col-sm-12 col-12">
													<label for="filtro_fecha">F. Inicio</label>
													<div class="input-group">
														<input type="text" class="form-control datepicker"
															   aria-label=""
															   id="filtro_fecha_inicio" name="filtro_fecha_inicio"
															   value=""/>
														<div class="input-group-prepend">
															<span class="input-group-text">hasta</span>
														</div>
														<input type="text" class="form-control datepicker"
															   aria-label=""
															   id="filtro_fecha_fin" name="filtro_fecha_fin"
															   value=""/>
													</div>
												</div>
												<div class="form-group col-xl-2 col-lg-2 col-md-6 col-sm-12 col-12">
													<label for="filtro_tipo_estado">Tipo Estado</label>
													<select name="filtro_tipo_estado" id="filtro_tipo_estado"
															class="custom-select">
														<option value="">Todos</option>
														<option value="A">Abiertos</option>
														<option value="C">Cerrados</option>
													</select>
												</div>
												<div class="form-group text-xl-center text-lg-center col-xl-2 col-lg-2 col-md-12 col-sm-12 col-12">
													<label for="displayElements">Despliegue de elementos</label>
													<div class="custom-control custom-switch">
														<input type="checkbox" class="custom-control-input"
															   id="displayElements"
															   value="1">
														<label class="custom-control-label"
															   for="displayElements"></label>
													</div>
												</div>
												<div class="form-group col-12">
													<button type="button" role="button"
															class="btn btn-light btn-sm mb-2"
															data-toggle="collapse"
															href="#advancedFilter"
															aria-expanded="false"
															aria-controls="advancedFilter">
														<i class="fa fa-filter"></i> Busqueda avanzada
													</button>
													<div class="collapse fade" id="advancedFilter">
														<div class="row">
															<div class="form-group col-xl-2 col-lg-2 col-md-4 col-sm-4 col-12">
																<label for="filter_codigo_rs">
																	Código RS
																</label>
																<input type="text" class="form-control"
																	   id="filter_codigo_rs" name="filter_codigo_rs"
																	   value="">
															</div>
															<div class="form-group col-xl-2 col-lg-2 col-md-4 col-sm-4 col-12">
																<label for="filter_estado_tramite">
																	Estado de Trámite
																</label>
																<select class="custom-select"
																		name="filter_estado_tramite"
																		id="filter_estado_tramite">
																	<option value="">Todos</option>
																	<option value="P">En proceso</option>
																	<option value="V">En trámite en la entidad</option>
																	<option value="O">Observado DG</option>
																	<option value="R">Aprobado</option>
																	<option value="T">Trunco</option>
																	<option value="C">Rechazado DG</option>
																</select>
															</div>
															<div class="form-group col-xl-2 col-lg-2 col-md-4 col-sm-4 col-12">
																<label for="filter_entidad">
																	Entidad
																</label>
																<select class="custom-select"
																		name="filter_entidad"
																		id="filter_entidad">
																	<option value="">Todos</option>
																	<option value="0002">DIGEMID</option>
																	<option value="001">DIGESA</option>
																	<option value="004">ITP</option>
																	<option value="005">SANIPES</option>
																	<option value="003">SENASA</option>
																</select>
															</div>
															<div class="form-group col-xl-2 col-lg-2 col-md-4 col-sm-4 col-12">
																<label for="filter_tipo_producto">
																	Tipo Producto
																</label>
																<select class="custom-select"
																		name="filter_tipo_producto"
																		id="filter_tipo_producto">
																</select>
															</div>
															<div class="form-group col-xl-2 col-lg-2 col-md-4 col-sm-4 col-12">
																<label for="filter_tramite">
																	Tramite
																</label>
																<select class="custom-select"
																		name="filter_tramite"
																		id="filter_tramite">
																</select>
															</div>
															<div class="form-group col-xl-2 col-lg-2 col-md-4 col-sm-4 col-12">
																<label for="filter_categoria">
																	Categoría
																</label>
																<select class="custom-select"
																		name="filter_categoria"
																		id="filter_categoria"></select>
															</div>
														</div>
														<div class="row">
															<div class="form-group col-xl-3 col-lg-3 col-md-6 col-sm-6 col-12">
																<label for="filter_producto">
																	Código / Nombre del producto /Descripción SAP
																</label>
																<input type="text" class="form-control"
																	   id="filter_producto"
																	   name="filter_producto"
																	   value="">
															</div>
															<div class="form-group col-xl-2 col-lg-2 col-md-4 col-sm-4 col-12">
																<label for="filter_marca">
																	Marca
																</label>
																<select class="custom-select"
																		name="filter_marca"
																		id="filter_marca">
																</select>
															</div>
															<div class="form-group col-xl-2 col-lg-2 col-md-4 col-sm-4 col-12">
																<label for="filter_expediente">
																	N° de Expediente
																</label>
																<input type="text" class="form-control"
																	   id="filter_expediente" name="filter_expediente"
																	   value="">
															</div>
														</div>
													</div>
												</div>
											</div>
										</form>
									</div>
									<div class="card-footer">
										<div class="col-12 text-right">
											<button type="button" class="btn btn-default" id="btnBuscar">
												<i class="fa fa-fw fa-search"></i> Buscar
											</button>
											<button type="button" class="btn btn-primary" id="btnNuevoAR">
												<i class="fa fa-fw fa-plus"></i> Nuevo A.R.
											</button>
										</div>
									</div>
								</div>
								<div class="card card-success">
									<div class="card-header with-border">
										<h3 class="card-title">Listado</h3>
									</div>
									<div class="card-body">
										<div class="table-responsive">
											<table id="tblLista" class="table table-bordered"></table>
										</div>
										<!-- Modal de productos -->
										<div class="modal fade" id="modalProducts" tabindex="-1"
											 aria-labelledby="staticBackdropLabel" aria-hidden="true">
											<div class="modal-dialog modal-dialog-scrollable modal-xl">
												<div class="modal-content">
													<div class="modal-header bg-success">
														<h5 class="modal-title fs w-100 font-weight-bold"
															id="titleProducts">
															Productos
														</h5>
														<button type="button" class="close" data-dismiss="modal"
																aria-label="Close">
															<span aria-hidden="true">&times;</span>
														</button>
													</div>
													<div class="modal-body"
														 style="background-color:#ffffff; border-top: 1px solid #00a65a; border-bottom: 1px solid #00a65a;">
														<div class="table-responsive">
															<table class="table table-bordered table-striped"
																   id="tblProducts">
																<thead class="bg-secondary">
																<tr>
																	<th class="text-left"
																		style="min-width: 90px; width: 90px;">Cod.
																		Producto
																	</th>
																	<th class="text-left" style="min-width: 220px;">
																		Descripción SAP
																	</th>
																	<th class="text-left" style="min-width: 220px;">
																		Producto
																	</th>
																	<th class="text-left"
																		style="min-width: 150px; width: 150px;">Marca
																	</th>
<!--																	<th class="text-left"-->
<!--																		style="min-width: 150px; width: 150px;">-->
<!--																		Modelo/Tono <br>Variedades/Sub-marca-->
<!--																	</th>-->
																	<th class="text-left"
																		style="min-width: 150px; width: 150px;">Registro
																		Sanitario
																	</th>
																	<th class="text-center"
																		style="min-width: 100px; width: 100px;">Fecha
																		Venc.
																	</th>
																</tr>
																</thead>
																<tbody></tbody>
															</table>
														</div>
													</div>
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
							<div class="tab-pane fade" id="tabReg2" role="tabpanel">
								<?php $this->load->view('ar/ope/regtramite/vregtramite_formulario'); ?>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>
