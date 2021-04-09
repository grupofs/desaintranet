<?php
$codcliente = $this->session->userdata('s_ccliente');
$idusuario = $this->session->userdata('s_idusuario');
$idrol = $this->session->userdata('s_idrol');
$cia = $this->session->userdata('s_cia');
?>

<div class="content-header">
	<div class="container-fluid">
		<div class="row mb-2">
			<div class="col-sm-6">
				<h1 class="m-0 text-dark">
					CONSULTA DE INSPECCIÓN A PROVEEDORES
				</h1>
			</div>
			<div class="col-sm-6">
				<ol class="breadcrumb float-sm-right">
					<li class="breadcrumb-item"><a href="<?php echo public_base_url(); ?>cprincipal/principal">Home</a>
					</li>
					<li class="breadcrumb-item active">Consulta de Inspecciones</li>
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
								   aria-controls="tabReg1" aria-selected="true">LISTADO</a>
							</li>
						</ul>
					</div>
					<div class="card-body">
						<div class="tab-content">
							<div class="tab-pane fade show active" id="tabReg1" role="tabpanel">
								<!--Contenedor de consulta-->
								<div class="card card-success">
									<div class="card-header">
										<h3 class="card-title">Busqueda</h3>

										<div class="card-tools">
											<button type="button" class="btn btn-tool" data-card-widget="collapse"><i
														class="fas fa-minus"></i></button>
										</div>
									</div>
									<div class="card-body">
										<form class="form-horizontal" id="frmBuscarTramite">
											<input type="hidden" id="idcliente"
												   value="<?php echo $codcliente ?>">
											<input type="hidden" id="idusuario"
												   value="<?php echo $idusuario; ?>">
											<input type="hidden" id="idrol"
												   value="<?php echo $idrol; ?>">
											<input type="hidden" id="idcia" name="idcia"
												   value="<?php echo $cia ?>">

											<div class="row"> <!--fila01-->
												<div class="col-xl-3 col-lg-3 col-md-4 col-sm-4 col-12">
													<div class="form-group">
														<div class="custom-control custom-checkbox mb-2">
															<input type="checkbox" class="custom-control-input"
																   checked
																   id="activar_fecha">
															<label for="activar_fecha" class="custom-control-label">
																Fecha de Inspección
															</label>
														</div>
														<div class="input-group">
															<input type="text" class="form-control datepicker"
																   id="fini" name="fini" aria-label=""
																   value="<?php echo '01/01/' .  date('Y'); ?>"/>
															<div class="input-group-prepend">
																<span class="input-group-text">hasta</span>
															</div>
															<input type="text" class="form-control datepicker"
																   id="ffin" name="ffin" aria-label=""
																   value="<?php echo date('d/m/Y'); ?>"/>
														</div>
													</div>
												</div>
												<div class="col-xl-6 col-lg-5 col-md-12 col-sm-12 col-12">
													<div class="form-group">
														<label for="" class="d-block">
															Tipo de Cliente
														</label>
														<div class="custom-control custom-control-inline custom-radio">
															<input type="radio" id="tipo1" name="tipo"
																   checked
																   class="custom-control-input">
															<label class="custom-control-label" for="tipo1">
																Cliente
															</label>
														</div>
<!--														<div class="custom-control custom-control-inline custom-radio">-->
<!--															<input type="radio" id="tipo2" name="tipo"-->
<!--																   class="custom-control-input">-->
<!--															<label class="custom-control-label" for="tipo2">-->
<!--																Proveedor-->
<!--															</label>-->
<!--														</div>-->
<!--														<div class="custom-control custom-control-inline custom-radio">-->
<!--															<input type="radio" id="tipo3" name="tipo"-->
<!--																   class="custom-control-input">-->
<!--															<label class="custom-control-label" for="tipo3">-->
<!--																Maquillador-->
<!--															</label>-->
<!--														</div>-->
													</div>
												</div>
											</div>
											<div class="row" >
												<div class="col-xl-3 col-lg-3 col-md-6 col-sm-6 col-12">
													<div class="form-group">
														<label for="filtro_cliente">Cliente</label>
														<div class="input-group">
															<select name="filtro_cliente" id="filtro_cliente" class="custom-select"></select>
														</div>
													</div>
												</div>
<!--												<div class="col-xl-3 col-lg-3 col-md-6 col-sm-6 col-12">-->
<!--													<div class="form-group">-->
<!--														<label for="filtro_cliente_area">Área Cliente</label>-->
<!--														<div class="input-group">-->
<!--															<select name="filtro_cliente_area"-->
<!--																	id="filtro_cliente_area" class="custom-select"></select>-->
<!--														</div>-->
<!--													</div>-->
<!--												</div>-->
<!--												<div class="col-xl-3 col-lg-3 col-md-6 col-sm-6 col-12">-->
<!--													<div class="form-group">-->
<!--														<label for="filtro_ubigeo_proveedor">Ubigeo Proveedor</label>-->
<!--														<div class="input-group">-->
<!--															<select name="filtro_ubigeo_proveedor"-->
<!--																	id="filtro_ubigeo_proveedor" class="custom-select"></select>-->
<!--														</div>-->
<!--													</div>-->
<!--												</div>-->
<!--												<div class="col-xl-3 col-lg-3 col-md-6 col-sm-6 col-12">-->
<!--													<div class="form-group">-->
<!--														<label for="filtro_ubigeo_proveedor">Ubigeo Maquilador</label>-->
<!--														<div class="input-group">-->
<!--															<select name="filtro_ubigeo_proveedor"-->
<!--																	id="filtro_ubigeo_proveedor" class="custom-select"></select>-->
<!--														</div>-->
<!--													</div>-->
<!--												</div>-->
											</div>
											<div class="row" >
<!--												<div class="col-xl-3 col-lg-3 col-md-6 col-sm-6 col-12">-->
<!--													<div class="form-group">-->
<!--														<label for="filtro_tipo_estado">Tipo Estado</label>-->
<!--														<div class="input-group">-->
<!--															<select name="filtro_tipo_estado"-->
<!--																	id="filtro_tipo_estado" class="custom-select">-->
<!--																<option value="1">Abierto</option>-->
<!--																<option value="0" selected >Cerrado</option>-->
<!--															</select>-->
<!--														</div>-->
<!--													</div>-->
<!--												</div>-->
<!--												<div class="col-xl-3 col-lg-3 col-md-6 col-sm-6 col-12">-->
<!--													<div class="form-group">-->
<!--														<label for="" class="d-block">&nbsp;</label>-->
<!--														<div class="custom-control custom-checkbox">-->
<!--															<input type="checkbox" class="custom-control-input" id="filtro_evalprod">-->
<!--															<label class="custom-control-label" for="filtro_evalprod">-->
<!--																Por Evaluación de Productos-->
<!--															</label>-->
<!--														</div>-->
<!--													</div>-->
<!--												</div>-->
												<div class="col-xl-3 col-lg-3 col-md-6 col-sm-6 col-12">
													<div class="form-group">
														<label for="" class="d-block">
															Peligro
														</label>
														<div class="custom-control custom-control-inline custom-radio">
															<input type="radio" id="filtro_peligro_1" name="filtro_peligro"
																   class="custom-control-input" value="S" >
															<label class="custom-control-label" for="filtro_peligro_1">
																Si
															</label>
														</div>
														<div class="custom-control custom-control-inline custom-radio">
															<input type="radio" id="filtro_peligro_2" name="filtro_peligro"
																   class="custom-control-input" value="N" >
															<label class="custom-control-label" for="filtro_peligro_2">
																No
															</label>
														</div>
														<div class="custom-control custom-control-inline custom-radio">
															<input type="radio" id="filtro_peligro_3" name="filtro_peligro"
																   checked
																   class="custom-control-input" value="" >
															<label class="custom-control-label" for="filtro_peligro_3">
																Todos
															</label>
														</div>
													</div>
												</div>
											</div>
										</form>
									</div>
									<!--Contenedor de botones-->
									<div class="card-footer">
										<div class="d-flex flex-row justify-content-end">
											<div class="col-sm-6 col-12 text-right">
												<button type="button" class="btn btn-default" id="btnBuscar">
													<i class="fa fa-fw fa-search"></i> Buscar
												</button>
											</div>
										</div>
									</div>
								</div>
								<!--FIN Contenedor de consulta-->
								<!--Contenedor del DataTable-->
								<div class="card card-success">
									<div class="card-header with-border">
										<h3 class="card-title">Listado</h3>
									</div>
									<div class="card-body">
										<div>
											<table id="tblInspecciones" class="table table-striped table-bordered"
												   style="width:100%">
												<thead>
												<tr>
													<th style="width: 140px; min-width: 140px" ></th>
<!--													<th style="width: 20px" >N°</th>-->
													<th>Código</th>
													<th>Fecha Inspección</th>
													<th>Fecha Creación</th>
													<th>Cliente</th>
													<th>Proveedor</th>
													<th>RUC</th>
													<th>Dirección Proveedor</th>
													<th>Ubigeo Proveedor</th>
													<th>Maquilador</th>
													<th>Dirección Maquilador</th>
													<th>Ubigeo Maquilador</th>
													<th>Área Cliente</th>
													<th>Línea</th>
													<th>Resultado CheckList (%)</th>
													<th>Resultado Texto</th>
													<th>Tamaño Empresa Proveedor</th>
													<th>Tipo Estado Servicio</th>
													<th>Comentario</th>
													<th>Certificadora</th>
													<th>Certificación</th>
													<th>Estado Certificación</th>
													<th>Licencia de Funcionamiento</th>
													<th>Estado Licencia de Funcionamiento</th>
													<th>Consultor</th>
													<th>Empresa Inspectora</th>
													<th>Convalidado</th>
													<th>Acción Correctiva</th>
<!--													<th>Archivos Subidos</th>-->
													<th>Nro de Informe</th>
													<th>Eval. Prod.</th>
													<th>Es Peligro</th>
													<th>C. Checklist</th>
													<th>CheckList</th>
													<th>Entidad</th>
													<th>Sistema</th>
													<th>Rubro</th>
												</tr>
												</thead>
												<tbody></tbody>
												<tfoot>
												<tr>
													<th></th>
												</tr>
												</tfoot>
											</table>
										</div>
									</div>
								</div>
								<!--FIN Contenedor del DataTable-->
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>

<div class="modal fade" id="modalPDF" data-backdrop="static" data-keyboard="false" tabindex="-1"
	 aria-labelledby="staticBackdropLabel" aria-hidden="true">
	<div class="modal-dialog modal-xl">
		<div class="modal-content">
			<div class="modal-header bg-success">
				<h5 class="modal-title fs w-100 font-weight-bold" id="staticBackdropLabel">INFOME TECNICO</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body"
				 style="background-color:#ffffff; border-top: 1px solid #00a65a; border-bottom: 1px solid #00a65a;">
				<div class="row">
					<div class="col-xl-3 col-lg-4 col-md-5 col-sm-8 col-12">
						<button class="btn btn-danger mb-3" id="closePDF">
							<i class="fa fa-save"></i> Cerrar Informe Técnico
						</button>
					</div>
					<div class="col-12">
						<div class="embed-responsive embed-responsive-21by9" style="min-height: 480px; zoom: 1;">
							<iframe class="embed-responsive-item" id="framePDF" src="" frameborder="0"></iframe>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
