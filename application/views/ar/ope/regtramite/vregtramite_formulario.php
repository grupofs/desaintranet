<form action="<?php echo base_url('ar/ope/ctramite/guardar') ?>" id="formAR" accept-charset="UTF-8">
	<div class="row">
		<div class="col-xl-3 col-lg-3 col-md-3 col-sm-4 col-12">
			<div class="form-group row">
				<label for="ar_fecha_inicio" class="col-xl-5 col-lg-6 col-md-12 col-sm-12 col-12">
					Fecha Inicio
				</label>
				<div class="col-xl-7 col-lg-6 col-md-12 col-sm-12 col-12">
					<input type="text" class="form-control" readonly
						   id="ar_fecha_inicio" name="ar_fecha_inicio"
						   value=""/>
				</div>
			</div>
		</div>
		<div class="col-xl-3 col-lg-3 col-md-3 col-sm-4 col-12">
			<div class="form-group row">
				<label for="ar_fecha_cierre" class="col-xl-5 col-lg-6 col-md-12 col-sm-12 col-12">
					Fecha Cierre
				</label>
				<div class="col-xl-7 col-lg-6 col-md-12 col-sm-12 col-12">
					<input type="text" class="form-control" readonly
						   id="ar_fecha_cierre" name="ar_fecha_cierre"
						   value=""/>
				</div>
			</div>
		</div>
		<div class="col-xl-3 col-lg-3 col-md-3 col-sm-4 col-12">
			<div class="form-group row">
				<label for="ar_estado_text" class="col-xl-5 col-lg-6 col-md-12 col-sm-12 col-12">
					Estado
				</label>
				<div class="col-xl-7 col-lg-6 col-md-12 col-sm-12 col-12">
					<input type="text" class="form-control" readonly
						   id="ar_estado_text"
						   value=""/>
					<input type="hidden" class="d-none" readonly maxlength="0"
						   id="ar_estado" name="ar_estado"
						   value="A"/>
				</div>
			</div>
		</div>
		<div class="col-xl-3 col-lg-3 col-md-3 col-sm-4 col-12">
			<div class="form-group row">
				<label for="ar_codigo" class="col-xl-5 col-lg-6 col-md-12 col-sm-12 col-12">
					Código A.R.
				</label>
				<div class="col-xl-7 col-lg-6 col-md-12 col-sm-12 col-12">
					<input type="text" class="form-control" readonly
						   id="ar_codigo" name="ar_codigo"
						   value=""/>
				</div>
			</div>
		</div>
	</div>
	<div class="row">
		<div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
			<div class="form-group row">
				<label for="ar_grupo_empresarial" class="col-xl-4 col-lg-5 col-md-5 col-sm-12 col-12">
					Grupo Empresarial
					<span class="fs-requerido text-danger">*</span>:
				</label>
				<div class="col-xl-8 col-lg-7 col-md-7 col-sm-12 col-12">
					<select class="custom-select" id="ar_grupo_empresarial" name="ar_grupo_empresarial"></select>
				</div>
			</div>
		</div>
		<div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
			<div class="form-group row">
				<label for="ar_cliente_id" class="col-xl-2 col-lg-3 col-md-3 col-sm-12 col-12">
					Cliente
					<span class="fs-requerido text-danger">*</span>:
				</label>
				<div class="col-xl-10 col-lg-9 col-md-9 col-sm-12 col-12">
					<select class="custom-select" id="ar_cliente_id" name="ar_cliente_id">
						<option value=""></option>
					</select>
				</div>
			</div>
		</div>
	</div>
	<div class="row justify-content-end">
		<div class="col-xl-2 col-lg-2 col-md-4 col-sm-5 col-12">
			<button type="button" role="button" class="btn btn-danger btn-block" style="display: none" id="btnSaveAR">
				<i class="fa fa-save"></i> Guardar A.R.
			</button>
		</div>
	</div>
</form>
<form action="<?php echo base_url('ar/ope/ctramite/guardar_datos') ?>" id="formTramite" accept-charset="UTF-8">
	<fieldset class="scheduler-border">
		<legend class="scheduler-border text-primary">
			Datos de la entidad/tramite
		</legend>
		<div class="row">
			<div class="col-xl-5 col-lg-12 col-md-12 col-sm-12 col-12">
				<div class="box-body">
					<div class="form-group row">
						<label for="tramite_entidad_id" class="col-xl-4 col-lg-4 col-md-12 col-sm-12 col-12">
							Entidad
							<span class="fs-requerido text-danger">*</span>
						</label>
						<div class="col-xl-8 col-lg-8 col-md-12 col-sm-12 col-12">
							<select name="tramite_entidad_id" id="tramite_entidad_id" class="custom-select">
								<option value=""></option>
							</select>
						</div>
					</div>
					<div class="form-group row">
						<label for="tramite_tipo_producto_id" class="col-xl-4 col-lg-4 col-md-12 col-sm-12 col-12">
							Tipo Producto
							<span class="fs-requerido text-danger">*</span>
						</label>
						<div class="col-xl-8 col-lg-8 col-md-12 col-sm-12 col-12">
							<select name="tramite_tipo_producto_id" id="tramite_tipo_producto_id" class="custom-select">
								<option value=""></option>
							</select>
						</div>
					</div>
					<div class="table-responsive">
						<table class="table table-bordered table-valign-middle table-hover" id="tblTramite">
							<thead>
							<tr>
								<th class="text-center" style="min-width: 150px">
									Tramite
									<span class="fs-requerido text-danger">*</span>
								</th>
								<th class="text-center" style="width: 50px; min-width: 50px">OP</th>
							</tr>
							</thead>
							<tbody>
							</tbody>
							<tfoot>
							<tr>
								<td colspan="2">
									<button type="button" role="button" class="btn btn-link btn-sm"
											id="btnAgregarTramite">
										<i class="fa fa-plus"></i> Agregar nuevo tramite
									</button>
								</td>
							</tr>
							</tfoot>
						</table>
					</div>
				</div>
			</div>
			<div class="col-xl-7 col-lg-12 col-md-12 col-sm-12 col-12">
				<div class="row">
					<div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
						<div class="form-group row">
							<label for="carga_registro_nro_seguimiento"
								   class="col-xl-4 col-lg-4 col-md-12 col-sm-12 col-12">
								Nro. Seguimiento
							</label>
							<div class="col-xl-8 col-lg-8 col-md-12 col-sm-12 col-12">
								<input type="text" class="form-control"
									   id="carga_registro_nro_seguimiento"
									   name="carga_registro_nro_seguimiento"
									   value=""/>
							</div>
						</div>
					</div>
					<div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
						<div class="form-group row">
							<label for="carga_registro_nro_expediente"
								   class="col-xl-4 col-lg-4 col-md-12 col-sm-12 col-12">
								N° de Expediente
							</label>
							<div class="col-xl-8 col-lg-8 col-md-12 col-sm-12 col-12">
								<input type="text" class="form-control"
									   id="carga_registro_nro_expediente"
									   name="carga_registro_nro_expediente"
									   value=""/>
							</div>
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
						<div class="form-group row">
							<label for="carga_registro_nro_dr" class="col-xl-4 col-lg-4 col-md-12 col-sm-12 col-12"
								   title="Hoja de Resumen del Documento Resolutivo" >
								Nro. DR
							</label>
							<div class="col-xl-8 col-lg-8 col-md-12 col-sm-12 col-12">
								<input type="text" class="form-control"
									   id="carga_registro_nro_dr"
									   name="carga_registro_nro_dr"
									   value=""/>
							</div>
						</div>
					</div>
					<div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
						<div class="form-group row">
							<label for="carga_registro_estado" class="col-xl-4 col-lg-4 col-md-12 col-sm-12 col-12">
								Estado
							</label>
							<div class="col-xl-8 col-lg-8 col-md-12 col-sm-12 col-12">
								<select class="custom-select"
										id="carga_registro_estado"
										name="carga_registro_estado">
<!--									<option value="P">En proceso</option>-->
<!--									<option value="O">Observado DG</option>-->
									<option value="A">Aprobado</option>
									<option value="T">Trunco</option>
									<option value="G">Rechazado DG</option>
								</select>
							</div>
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
						<div class="form-group row">
							<label for="carga_registro_nro_rs" class="col-xl-2 col-lg-2 col-md-12 col-sm-12 col-12">
								Registro Sanitario
							</label>
							<div class="col-xl-10 col-lg-10 col-md-12 col-sm-12 col-12">
								<input type="text" class="form-control"
									   id="carga_registro_nro_rs"
									   name="carga_registro_nro_rs"
									   value=""/>
							</div>
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
						<div class="form-group row">
							<label for="carga_registro_fecha_inicio"
								   class="col-xl-4 col-lg-4 col-md-12 col-sm-12 col-12">
								Fecha Emisión
								<span class="fs-requerido text-danger">*</span>
							</label>
							<div class="col-xl-8 col-lg-8 col-md-12 col-sm-12 col-12">
								<input type="text" class="form-control datepicker"
									   id="carga_registro_fecha_inicio"
									   name="carga_registro_fecha_inicio"
									   value=""/>
							</div>
						</div>
					</div>
					<div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
						<div class="form-group row">
							<label for="carga_registro_fecha_final"
								   class="col-xl-4 col-lg-4 col-md-12 col-sm-12 col-12">
								Fecha Venc.
								<span class="fs-requerido text-danger">*</span>
							</label>
							<div class="col-xl-8 col-lg-8 col-md-12 col-sm-12 col-12">
								<input type="text" class="form-control datepicker"
									   id="carga_registro_fecha_final"
									   name="carga_registro_fecha_final"
									   value=""/>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</fieldset>
	<div class="row">
		<div class="col-12">
			<fieldset class="scheduler-border">
				<legend class="scheduler-border text-primary">
					Datos de los Productos
				</legend>
				<div class="box-body">
					<div class="table-responsive">
						<table class="table table-bordered table-valign-middle table-hover" id="tblTramiteProductos">
							<thead>
							<tr>
								<th class="text-center" style="width: 50px; min-width: 50px">
									N°
								</th>
								<th class="text-center" style="width: 220px; min-width: 220px">
									SKU
									<span class="fs-requerido text-danger">*</span>
								</th>
								<th class="text-center" style="min-width: 400px">
									Descripción del producto
									<span class="fs-requerido text-danger">*</span>
								</th>
								<th class="text-center" style="width: 320px; min-width: 320px">
									Comentario
								</th>
								<th class="text-center" style="width: 50px; min-width: 50px">OP</th>
							</tr>
							</thead>
							<tbody>
							</tbody>
							<tfoot>
							<tr>
								<td colspan="6">
									<div class="d-flex justify-content-between">
										<button type="button" role="button" class="btn btn-link btn-sm"
												id="btnAgregarProducto"
												data-toggle="modal" data-target="#modalSelectProduct">
											<i class="fa fa-plus"></i> Agregar nuevo producto
										</button>
										<button type="button" role="button" class="btn btn-link btn-sm"
												id="btnEliminarProductosElegidos">
											<i class="fa fa-trash"></i> Eliminar productos
										</button>
									</div>
								</td>
							</tr>
							</tfoot>
						</table>
					</div>
				</div>
			</fieldset>
		</div>
	</div>
	<div class="row">
		<div class="col-12">
			<fieldset class="scheduler-border">
				<legend class="scheduler-border text-primary">
					Documentos del tramite
				</legend>
				<div class="box-body">
					<ul class="nav nav-tabs" id="myTab" role="tablist">
						<li class="nav-item" role="presentation">
							<a class="nav-link border-left active" id="home-tab" data-toggle="tab" href="#listaDocumentos" role="tab"
							   aria-controls="home" aria-selected="true">Lista de Documentos</a>
						</li>
						<li class="nav-item" role="presentation">
							<a class="nav-link" id="profile-tab" data-toggle="tab" href="#rutaDocumentos" role="tab"
							   aria-controls="profile" aria-selected="false">Archivos (<span id="totalRutaDocumentos" >0</span>)</a>
						</li>
					</ul>
					<div class="tab-content border border-top-0" id="myTabContent">
						<div class="tab-pane fade show active" id="listaDocumentos" role="tabpanel" aria-labelledby="home-tab">
							<div class="table-responsive">
								<table class="table table-bordered table-valign-middle table-hover" id="tblDocumentos">
									<thead>
									<tr>
										<th class="text-center" style="width: 50px; min-width: 50px;">
											N°
										</th>
										<th class="text-center" style="min-width: 150px; width: 150px">
											Tipo
										</th>
										<th class="text-center" style="min-width: 200px">
											Documento
										</th>
										<th class="text-center" style="width: 100px; min-width: 100px;">
											Adjuntos
										</th>
										<th class="text-center" style="width: 50px; min-width: 50px">OP</th>
									</tr>
									</thead>
									<tbody>
									</tbody>
									<tfoot>
									<tr>
										<td colspan="10">
											<button type="button" role="button" class="btn btn-link btn-sm"
													id="btnDocumentoAgregar">
												<i class="fa fa-plus"></i> Agregar requisito
											</button>
										</td>
									</tr>
									</tfoot>
								</table>
							</div>
						</div>
						<div class="tab-pane fade" id="rutaDocumentos" role="tabpanel" aria-labelledby="profile-tab">
							<div class="table-responsive" >
								<table class="table table-bordered table-striped" id="btnRutaDocumentos" >
									<thead>
									<tr>
										<th class="text-center" style="width: 60px; min-width: 60px" >#</th>
										<th class="text-left" style="min-width: 250px" >Ruta</th>
									</tr>
									</thead>
									<tbody>
									</tbody>
								</table>
							</div>
						</div>
					</div>
				</div>
			</fieldset>
		</div>
	</div>
	<div class="form-group row justify-content-end">
		<div class="col-sm-6 col-12 text-right">
			<button type="button" id="btnTramiteCerrar" style="display: none"
					class="btn btn-danger">
				<i class="fa fa-times"></i>
				<span>Cerrar A.R.</span>
			</button>
			<button type="button" id="btnTramiteAbrir" style="display: none"
					class="btn btn-info">
				<i class="fa fa-sync-alt"></i>
				<span>Abrir A.R.</span>
			</button>
			<button type="button" id="btnTramiteGuardar"
					class="btn btn-success">
				<i class="fa fa-save"></i>
				<span>Guardar A.R.</span>
			</button>
			<button type="button" class="btn btn-primary"
					id="btnRetornarLista"><i
						class="fa fa-fw fa-undo-alt"></i> Retornar
			</button>
		</div>
	</div>
</form>

<!-- Modal -->
<?php $this->load->view('ar/ope/regtramite/vproducto_lista'); ?>
<?php $this->load->view('ar/ope/regtramite/vproducto_formulario'); ?>
<?php $this->load->view('ar/ope/regtramite/vmarca_formulario'); ?>
<?php $this->load->view('ar/ope/regtramite/vfabricante_formulario'); ?>

<!-- Modal para cargar registros -->
<div class="modal fade" id="modalUploadFile" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-lg modal-dialog-scrollable">
		<div class="modal-content">
			<div class="modal-header bg-success">
				<h5 class="modal-title fs w-100 font-weight-bold">
					Cargar archivo(s)
				</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body"
				 style="background-color:#ffffff; border-top: 1px solid #00a65a; border-bottom: 1px solid #00a65a;">
				<input type="hidden" class="d-none" id="archivo_documento_position" value=""/>
				<div class="table-responsive">
					<table class="table table-bordered table-striped" id="tblDocumentoArchivos">
						<thead>
						<tr>
							<th class="text-left" style="min-width: 220px;">Archivo</th>
							<th class="text-center" style="width: 130px; min-width: 130px;">OP</th>
						</tr>
						</thead>
						<tbody>
						</tbody>
						<tfoot>
						<tr>
							<th class="text-left" colspan="5">
								<button type="button" role="button" class="btn btn-link" id="btnArchivoAgregar">
									<i class="fa fa-plus"></i> Agregar nuevo archivo
								</button>
							</th>
						</tr>
						</tfoot>
					</table>
				</div>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-danger" id="btnSaveUploadFile">
					<i class="fa fa-save"></i> Guardar
				</button>
			</div>
		</div>
	</div>
</div>
