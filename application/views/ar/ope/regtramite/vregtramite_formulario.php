<form action="" class="" accept-charset="UTF-8">
	<div class="row">
		<div class="col-xl-3 col-lg-3 col-md-3 col-sm-4 col-12">
			<div class="form-group row">
				<label for="fecha_inicio" class="col-xl-5 col-lg-6 col-md-12 col-sm-12 col-12">
					Fecha Inicio
				</label>
				<div class="col-xl-7 col-lg-6 col-md-12 col-sm-12 col-12">
					<input type="text" class="form-control" readonly
						   id="fecha_inicio" name="fecha_inicio"
						   value=""/>
				</div>
			</div>
		</div>
		<div class="col-xl-3 col-lg-3 col-md-3 col-sm-4 col-12">
			<div class="form-group row">
				<label for="fecha_cierre" class="col-xl-5 col-lg-6 col-md-12 col-sm-12 col-12">
					Fecha Cierre
				</label>
				<div class="col-xl-7 col-lg-6 col-md-12 col-sm-12 col-12">
					<input type="text" class="form-control" readonly
						   id="fecha_cierre" name="fecha_cierre"
						   value=""/>
				</div>
			</div>
		</div>
		<div class="col-xl-3 col-lg-3 col-md-3 col-sm-4 col-12">
			<div class="form-group row">
				<label for="estado" class="col-xl-5 col-lg-6 col-md-12 col-sm-12 col-12">
					Estado
				</label>
				<div class="col-xl-7 col-lg-6 col-md-12 col-sm-12 col-12">
					<input type="text" class="form-control" readonly
						   id="estado" name="estado"
						   value=""/>
				</div>
			</div>
		</div>
		<div class="col-xl-3 col-lg-3 col-md-3 col-sm-4 col-12">
			<div class="form-group row">
				<label for="codigo_ar" class="col-xl-5 col-lg-6 col-md-12 col-sm-12 col-12">
					Código A.R.
				</label>
				<div class="col-xl-7 col-lg-6 col-md-12 col-sm-12 col-12">
					<input type="text" class="form-control" readonly
						   id="codigo_ar" name="codigo_ar"
						   value=""/>
				</div>
			</div>
		</div>
	</div>
	<div class="row">
		<div class="col-xl-5 col-lg-6 col-md-6 col-sm-12 col-12">
			<div class="form-group row">
				<label for="grupo_empresarial" class="col-xl-4 col-lg-5 col-md-5 col-sm-12 col-12">
					Grupo Empresarial
					<span class="fs-requerido text-danger">*</span>:
				</label>
				<div class="col-xl-8 col-lg-7 col-md-7 col-sm-12 col-12">
					<select class="custom-select" id="grupo_empresarial" name="grupo_empresarial">
						<option value=""></option>
					</select>
				</div>
			</div>
		</div>
		<div class="col-xl-5 col-lg-6 col-md-6 col-sm-12 col-12">
			<div class="form-group row">
				<label for="cliente_id" class="col-xl-2 col-lg-3 col-md-3 col-sm-12 col-12">
					Cliente
					<span class="fs-requerido text-danger">*</span>:
				</label>
				<div class="col-xl-10 col-lg-9 col-md-9 col-sm-12 col-12">
					<select class="custom-select" id="cliente_id" name="cliente_id">
						<option value=""></option>
					</select>
				</div>
			</div>
		</div>
	</div>
	<div class="row">
		<div class="col-xl-5 col-lg-12 col-md-12 col-sm-12 col-12">
			<fieldset class="scheduler-border">
				<legend class="scheduler-border text-primary">
					Datos de la entidad/tramite
				</legend>
				<div class="box-body">
					<div class="form-group row">
						<label for="entidad_id" class="col-xl-4 col-lg-4 col-md-12 col-sm-12 col-12">
							Entidad
							<span class="fs-requerido text-danger">*</span>:
						</label>
						<div class="col-xl-8 col-lg-8 col-md-12 col-sm-12 col-12">
							<select name="entidad_id" id="entidad_id" class="custom-select">
								<option value=""></option>
							</select>
						</div>
					</div>
					<div class="form-group row">
						<label for="linea_id" class="col-xl-4 col-lg-4 col-md-12 col-sm-12 col-12">
							Línea
							<span class="fs-requerido text-danger">*</span>:
						</label>
						<div class="col-xl-8 col-lg-8 col-md-12 col-sm-12 col-12">
							<select name="linea_id" id="linea_id" class="custom-select">
								<option value=""></option>
							</select>
						</div>
					</div>
					<div class="table-responsive">
						<table class="table table-bordered table-valign-middle table-hover">
							<thead>
							<tr>
								<th class="text-center" style="min-width: 150px">
									Tramite
								</th>
								<th class="text-center" style="width: 50px; min-width: 50px">OP</th>
							</tr>
							</thead>
							<tbody>
							<tr>
								<td class="text-left" style="min-width: 150px">
									<div class="form-group mb-0">
										<select name="tramite_id[0]" id="tramite_id[0]"
												aria-label=""
												class="custom-select">
											<option value=""></option>
										</select>
									</div>
								</td>
								<td class="text-center" style="width: 50px; min-width: 50px">
									<button type="button" role="button" class="btn btn-light btn-sm dropdown-toggle"
											data-boundary="viewport"
											data-toggle="dropdown"
											aria-haspopup="true"
											aria-expanded="false">
										<i class="fa fa-bars"></i>
									</button>
									<div class="dropdown-menu dropdown-menu-right">
										<h6 class="dropdown-header">Opciones</h6>
										<button type="button" role="button" class="dropdown-item">
											<i class="fa fa-trash"></i> Eliminar
										</button>
									</div>
								</td>
							</tr>
							</tbody>
							<tfoot>
							<tr>
								<td colspan="2">
									<button type="button" role="button" class="btn btn-link btn-sm">
										<i class="fa fa-plus"></i> Agregar nuevo tramite
									</button>
								</td>
							</tr>
							</tfoot>
						</table>
					</div>
				</div>
			</fieldset>
		</div>
		<div class="col-xl-7 col-lg-12 col-md-12 col-sm-12 col-12" >
			<fieldset class="scheduler-border">
				<legend class="scheduler-border text-primary">
					Carga de Registro
				</legend>
				<div class="table-responsive">
					<table class="table table-bordered table-valign-middle table-hover">
						<thead>
						<tr>
							<th class="text-center" style="min-width: 150px">
								Tramite
							</th>
							<th class="text-center">
								N° de seguimiento
							</th>
							<th class="text-center">
								N° de Expediente
							</th>
							<th class="text-center">
								Estado
							</th>
							<th class="text-center">
								Nro. DR
							</th>
							<th class="text-center" style="width: 50px; min-width: 50px">OP</th>
						</tr>
						</thead>
						<tbody>
						<tr>
							<td class="text-left" style="min-width: 150px">
								<div class="form-group mb-0">
									<select name="load_tramite_id[0]" id="load_tramite_id[0]"
											aria-label=""
											class="custom-select">
										<option value="">Registro Sanitario</option>
									</select>
								</div>
							</td>
							<td class="text-left">
								<div class="form-group mb-0">
									<input type="text" class="form-control" aria-label=""
										   value="2020-409236" />
								</div>
							</td>
							<td class="text-left">
								<div class="form-group mb-0">
									<input type="text" class="form-control" aria-label=""
										   value="37476-2020-R" />
								</div>
							</td>
							<td class="text-left">
								<div class="form-group mb-0">
									<input type="text" class="form-control" aria-label=""
										   value="Aprobado" />
								</div>
							</td>
							<td class="text-left">
								<div class="form-group mb-0">
									<input type="text" class="form-control" aria-label=""
										   value="2020398405" />
								</div>
							</td>
							<td class="text-center" style="width: 50px; min-width: 50px">
								<button type="button" role="button" class="btn btn-light btn-sm dropdown-toggle"
										data-boundary="viewport"
										data-toggle="dropdown"
										aria-haspopup="true"
										aria-expanded="false">
									<i class="fa fa-bars"></i>
								</button>
								<div class="dropdown-menu dropdown-menu-right">
									<h6 class="dropdown-header">Opciones</h6>
									<button type="button" role="button" class="dropdown-item">
										<i class="fa fa-trash"></i> Eliminar
									</button>
									<button type="button" role="button" class="dropdown-item">
										<i class="fa fa-cloud-upload-alt"></i> Documentos
									</button>
								</div>
							</td>
						</tr>
						</tbody>
						<tfoot>
						<tr>
							<td colspan="10">
								<button type="button" role="button" class="btn btn-link btn-sm">
									<i class="fa fa-plus"></i> Nuevo ítem
								</button>
							</td>
						</tr>
						</tfoot>
					</table>
				</div>
			</fieldset>
		</div>
	</div>
	<div class="row" >
		<div class="col-12">
			<fieldset class="scheduler-border">
				<legend class="scheduler-border text-primary">
					Datos de los Productos
				</legend>
				<div class="box-body">
					<div class="table-responsive">
						<table class="table table-bordered table-valign-middle table-hover">
							<thead>
							<tr>
								<th class="text-center">
									N°
								</th>
								<th class="text-center">
									Descripción del producto
								</th>
								<th class="text-center">
									Fecha estimada
								</th>
								<th class="text-center">
									Comentario
								</th>
								<th class="text-center" style="width: 50px; min-width: 50px" >OP</th>
							</tr>
							</thead>
							<tbody>
							<tr>
								<td class="text-center">
									01
								</td>
								<td class="text-center">
									<input type="text" class="form-control" aria-label=""
										   readonly id="producto_id[0]" name="producto_id[0]"
										   value="CEREAL PARA EL DESAYUNO A BASE DE TRIGO..."/>
								</td>
								<td class="text-center">
									<input type="text" class="form-control datepicker" aria-label=""
										   id="producto_fecha_estimada[0]" name="producto_fecha_estimada[0]"
										   value=""/>
								</td>
								<td class="text-center">
									<input type="text" class="form-control" aria-label=""
										   id="producto_comentario[0]" name="producto_comentario[0]"
										   value=""/>
								</td>
								<td class="text-center" style="width: 50px; min-width: 50px">
									<button type="button" role="button" class="btn btn-light btn-sm dropdown-toggle"
											data-boundary="viewport"
											data-toggle="dropdown"
											aria-haspopup="true"
											aria-expanded="false">
										<i class="fa fa-bars"></i>
									</button>
									<div class="dropdown-menu dropdown-menu-right">
										<h6 class="dropdown-header">Opciones</h6>
										<button type="button" role="button" class="dropdown-item">
											<i class="fa fa-trash"></i> Eliminar
										</button>
									</div>
								</td>
							</tr>
							<tr>
								<td class="text-center">
									02
								</td>
								<td class="text-center">
									<input type="text" class="form-control" aria-label=""
										   readonly id="producto_id[1]" name="producto_id[1]"
										   value="CEREAL PARA EL DESAYUNO A BASE DE TRIGO..."/>
								</td>
								<td class="text-center">
									<input type="text" class="form-control datepicker" aria-label=""
										   id="producto_fecha_estimada[1]" name="producto_fecha_estimada[1]"
										   value=""/>
								</td>
								<td class="text-center">
									<input type="text" class="form-control" aria-label=""
										   id="producto_comentario[1]" name="producto_comentario[1]"
										   value=""/>
								</td>
								<td class="text-center" style="width: 50px; min-width: 50px">
									<button type="button" role="button" class="btn btn-light btn-sm dropdown-toggle"
											data-boundary="viewport"
											data-toggle="dropdown"
											aria-haspopup="true"
											aria-expanded="false">
										<i class="fa fa-bars"></i>
									</button>
									<div class="dropdown-menu dropdown-menu-right">
										<h6 class="dropdown-header">Opciones</h6>
										<button type="button" role="button" class="dropdown-item">
											<i class="fa fa-trash"></i> Eliminar
										</button>
									</div>
								</td>
							</tr>
							</tbody>
							<tfoot>
							<tr>
								<td colspan="6">
									<div class="d-flex justify-content-between">
										<button type="button" role="button" class="btn btn-link btn-sm"
												data-toggle="modal" data-target="#modalSelectProduct">
											<i class="fa fa-plus"></i> Agregar nuevo producto
										</button>
										<button type="button" role="button" class="btn btn-link btn-sm">
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
	<div class="row" >
		<div class="col-12">
			<fieldset class="scheduler-border">
				<legend class="scheduler-border text-primary">
					Evaluación de Solicitud
				</legend>
				<div class="box-body">
					<div class="table-responsive">
						<table class="table table-bordered table-valign-middle table-hover">
							<thead>
							<tr>
								<th class="text-center">
									N°
								</th>
								<th class="text-center">
									Documento
								</th>
								<th class="text-center">
									Estado
								</th>
								<th class="text-center">
									Nota
								</th>
								<th class="text-center" style="width: 50px; min-width: 50px" >OP</th>
							</tr>
							</thead>
							<tbody>
							<tr>
								<td class="text-center">
									01
								</td>
								<td class="text-center">
									<div class="input-group" >
										<input type="text" class="form-control" aria-label=""
											   readonly id="evaluation_id[0]" name="evaluation_id[0]"
											   value="Información tecnica del producto"/>
										<div class="input-group-prepend" >
											<button type="button" role="button" class="btn btn-light btn-sm" >
												...
											</button>
										</div>
									</div>
								</td>
								<td class="text-center">
									<div class="input-group" >
										<select class="custom-select" aria-label=""
												id="evaluation_status[0]"
												name="evaluation_status[0]" >
											<option value="1">Evaluación</option>
										</select>
										<div class="input-group-append" >
											<span class="input-group-text" >OK</span>
										</div>
									</div>
								</td>
								<td class="text-center">
									<input type="text" class="form-control" aria-label=""
										   id="evaluation_note[0]" name="evaluation_note[0]"
										   value=""/>
								</td>
								<td class="text-center" style="width: 50px; min-width: 50px">
									<button type="button" role="button" class="btn btn-light btn-sm dropdown-toggle"
											data-boundary="viewport"
											data-toggle="dropdown"
											aria-haspopup="true"
											aria-expanded="false">
										<i class="fa fa-bars"></i>
									</button>
									<div class="dropdown-menu dropdown-menu-right">
										<h6 class="dropdown-header">Opciones</h6>
										<button type="button" role="button" class="dropdown-item">
											<i class="fa fa-trash"></i> Eliminar
										</button>
									</div>
								</td>
							</tr>
							<tr>
								<td class="text-center">
									02
								</td>
								<td class="text-center">
									<div class="input-group" >
										<input type="text" class="form-control" aria-label=""
											   readonly id="evaluation_id[1]" name="evaluation_id[1]"
											   value="Información tecnica del producto"/>
										<div class="input-group-prepend" >
											<button type="button" role="button" class="btn btn-light btn-sm" >
												...
											</button>
										</div>
									</div>
								</td>
								<td class="text-center">
									<div class="input-group" >
										<select class="custom-select" aria-label=""
												id="evaluation_status[0]"
												name="evaluation_status[0]" >
											<option value="1">Evaluación</option>
										</select>
										<div class="input-group-append" >
											<span class="input-group-text" >OK</span>
										</div>
									</div>
								</td>
								<td class="text-center">
									<input type="text" class="form-control" aria-label=""
										   id="evaluation_note[0]" name="evaluation_note[0]"
										   value=""/>
								</td>
								<td class="text-center" style="width: 50px; min-width: 50px">
									<button type="button" role="button" class="btn btn-light btn-sm dropdown-toggle"
											data-boundary="viewport"
											data-toggle="dropdown"
											aria-haspopup="true"
											aria-expanded="false">
										<i class="fa fa-bars"></i>
									</button>
									<div class="dropdown-menu dropdown-menu-right">
										<h6 class="dropdown-header">Opciones</h6>
										<button type="button" role="button" class="dropdown-item">
											<i class="fa fa-trash"></i> Eliminar
										</button>
									</div>
								</td>
							</tr>
							</tbody>
							<tfoot>
							<tr>
								<td colspan="10">
									<button type="button" role="button" class="btn btn-link btn-sm" >
										<i class="fa fa-plus"></i> Agregar nueva evaluación
									</button>
								</td>
							</tr>
							</tfoot>
						</table>
					</div>
				</div>
			</fieldset>
		</div>
	</div>
	<div class="form-group row justify-content-end">
		<div class="col-sm-6 text-right">
			<button type="button" id="btnGrabar"
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

<!-- Modal buscar productos -->
<div class="modal fade" id="modalSelectProduct" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-xl modal-dialog-scrollable">
		<div class="modal-content">
			<div class="modal-header bg-success">
				<h5 class="modal-title fs w-100 font-weight-bold">
					Buscar todos los productos dentro de la categoría superior
				</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body"
				 style="background-color:#ffffff; border-top: 1px solid #00a65a; border-bottom: 1px solid #00a65a;">
				<div class="row">
					<div class="col-xl-8 col-lg-8 col-md-8 col-md-12 col-12">
						<div class="form-group row">
							<label for="filter_producto_descripcion"
								   class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
								Descripción/Código/Reg. Sanitario
							</label>
							<div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
								<input type="text" class="form-control"
									   id="filter_producto_descripcion" name="filter_producto_descripcion"
									   value=""/>
							</div>
						</div>
					</div>
				</div>
				<div class="d-flex justify-content-end">
					<button type="button" role="button" class="btn btn-light">
						<i class="fa fa-search"></i> Buscar
					</button>
					<button type="button" role="button" class="btn btn-primary ml-2"
							data-toggle="modal"
							data-target="#modalAddProduct">
						<i class="fa fa-plus"></i> Nuevo Producto
					</button>
				</div>
				<div class="row justify-content-between my-2">
					<div class="col-xl-4 col-lg-4 col-md-4 col-sm-6 col-12">
						Nro. de productos elegidos: <b>0</b>
					</div>
					<div class="col-xl-4 col-lg-4 col-md-4 col-sm-6 col-12 text-right">
						Nro. de registros encontrados: <b>10</b>
					</div>
				</div>
				<div class="table-responsive">
					<table class="table table-bordered table-hover table-valign-middle">
						<thead class="bg-secondary">
						<tr>
							<td class="text-center"></td>
							<td class="text-center">N°</td>
							<td class="text-left">Código</td>
							<td class="text-left">Descripción SAP</td>
							<td class="text-left">Nombre del Producto</td>
							<td class="text-left">Marca</td>
							<td class="text-left">Fabricante</td>
							<td class="text-left">País</td>
							<td class="text-left">Categoría</td>
							<td class="text-left">Registro Sanitario</td>
							<td class="text-left">Fecha Emisión</td>
							<td class="text-left">Fecha Venc.</td>
						</tr>
						</thead>
						<tbody>
						<tr>
							<td>
								<div class="custom-control custom-checkbox">
									<input type="checkbox" class="custom-control-input" id="customCheckDisabled1">
									<label class="custom-control-label" for="customCheckDisabled1"></label>
								</div>
							</td>
							<td class="text-center">
								02
							</td>
							<td class="text-left">
								12444227
							</td>
							<td class="text-left">
								CHOCAPIC Cereal 4(6x23g)PE
							</td>
							<td class="text-left">
								CEREAL PARA EL DESAYUNO A BASE DE MAIZ...
							</td>
							<td class="text-left">
								NESTLÉ-CHOCAPIC
							</td>
							<td class="text-left">
								NESTLE PERÚ S.A.
							</td>
							<td class="text-left">
								Perú
							</td>
							<td class="text-left">
								Alimento
							</td>
							<td class="text-left"></td>
							<td class="text-center">
								10/10/2020
							</td>
							<td class="text-center">
								10/10/2021
							</td>
						</tr>
						<tr>
							<td>
								<div class="custom-control custom-checkbox">
									<input type="checkbox" class="custom-control-input" id="customCheckDisabled2">
									<label class="custom-control-label" for="customCheckDisabled2"></label>
								</div>
							</td>
							<td class="text-center">
								03
							</td>
							<td class="text-left">
								12444246
							</td>
							<td class="text-left">
								MILO Cereal 4(6x23g)PE
							</td>
							<td class="text-left">
								CEREAL PARA EL DESAYUNO A BASE DE TRIGO...
							</td>
							<td class="text-left">
								NESTLÉ-MILO
							</td>
							<td class="text-left">
								NESTLE PERÚ S.A.
							</td>
							<td class="text-left">
								Perú
							</td>
							<td class="text-left">
								Alimento
							</td>
							<td class="text-left"></td>
							<td class="text-center">
								10/10/2020
							</td>
							<td class="text-center">
								10/10/2021
							</td>
						</tr>
						</tbody>
					</table>
				</div>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-danger" data-dismiss="modal">
					<i class="fa fa-save"></i> Agregar productos
				</button>
			</div>
		</div>
	</div>
</div>

<!-- Modal crear producto -->
<div class="modal fade" id="modalAddProduct" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-xl modal-dialog-scrollable">
		<div class="modal-content">
			<div class="modal-header bg-success">
				<h5 class="modal-title fs w-100 font-weight-bold">
					Datos del Producto
				</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body"
				 style="background-color:#ffffff; border-top: 1px solid #00a65a; border-bottom: 1px solid #00a65a;">
				<div class="form-group row" >
					<label for="" class="col-xl-2 col-lg-2 col-md-4 col-sm-12 col-12" >
						Cliente
					</label>
					<div class="col-xl-10 col-lg-10 col-md-8 col-sm-12 col-12" >
						<input type="text" class="form-control" aria-label=""
							   value="00001" />
					</div>
				</div>
				<div class="form-group row" >
					<label for="" class="col-xl-2 col-lg-2 col-md-4 col-sm-12 col-12" >
						Línea
					</label>
					<div class="col-xl-10 col-lg-10 col-md-8 col-sm-12 col-12" >
						<select class="custom-select" aria-label="" >
							<option value="1">Linea 1</option>
							<option value="2">Linea 2</option>
							<option value="3">Linea 3</option>
							<option value="4">Linea 4</option>
						</select>
					</div>
				</div>
				<div class="row" >
					<div class="col-xl-6 col-lg-6 col-md-12 col-sm-12 col-12" >
						<div class="form-group row" >
							<label for="" class="col-xl-4 col-lg-4 col-md-4 col-sm-12 col-12" >
								Código de Producto
							</label>
							<div class="col-xl-8 col-lg-8 col-md-8 col-sm-12 col-12" >
								<input type="text" class="form-control" aria-label=""
									   value="" />
							</div>
						</div>
					</div>
					<div class="col-xl-6 col-lg-6 col-md-12 col-sm-12 col-12" >
						<div class="form-group row" >
							<label for="" class="col-xl-4 col-lg-4 col-md-4 col-sm-12 col-12" >
								Categoría
							</label>
							<div class="col-xl-8 col-lg-8 col-md-8 col-sm-12 col-12" >
								<select class="custom-select" aria-label="" >
									<option value="1">Categoria 1</option>
									<option value="2">Categoria 2</option>
									<option value="3">Categoria 3</option>
									<option value="4">Categoria 4</option>
								</select>
							</div>
						</div>
					</div>
				</div>
				<div class="row" >
					<div class="col-xl-6 col-lg-12 col-md-12 col-sm-12 col-12" >
						<div class="form-group row" >
							<label for="" class="col-xl-4 col-lg-2 col-md-4 col-sm-12 col-12" >
								Registro Sanitario
							</label>
							<div class="col-xl-8 col-lg-10 col-md-8 col-sm-12 col-12" >
								<input type="text" class="form-control" aria-label=""
									   value="" />
							</div>
						</div>
					</div>
					<div class="col-xl-3 col-lg-6 col-md-12 col-sm-12 col-12" >
						<div class="form-group row" >
							<label for="" class="col-xl-5 col-lg-4 col-md-4 col-sm-12 col-12" >
								F. Emisión
							</label>
							<div class="col-xl-7 col-lg-8 col-md-8 col-sm-12 col-12" >
								<input type="text" class="form-control" aria-label=""
									   value="" />
							</div>
						</div>
					</div>
					<div class="col-xl-3 col-lg-6 col-md-12 col-sm-12 col-12" >
						<div class="form-group row" >
							<label for="" class="col-xl-6 col-lg-4 col-md-4 col-sm-12 col-12" >
								F. Vencimiento
							</label>
							<div class="col-xl-6 col-lg-8 col-md-8 col-sm-12 col-12" >
								<input type="text" class="form-control" aria-label=""
									   value="" />
							</div>
						</div>
					</div>
				</div>
				<div class="form-group row" >
					<label for="" class="col-xl-2 col-lg-2 col-md-4 col-sm-12 col-12" >
						Descripción SAP
					</label>
					<div class="col-xl-10 col-lg-10 col-md-8 col-sm-12 col-12" >
						<input type="text" class="form-control" aria-label=""
							   value="" />
					</div>
				</div>
				<div class="form-group row" >
					<label for="" class="col-xl-2 col-lg-2 col-md-4 col-sm-12 col-12" >
						Nombre de Producto
					</label>
					<div class="col-xl-10 col-lg-10 col-md-8 col-sm-12 col-12" >
						<input type="text" class="form-control" aria-label=""
							   value="" />
					</div>
				</div>
				<div class="form-group row" >
					<label for="" class="col-xl-2 col-lg-2 col-md-4 col-sm-12 col-12" >
						Marca
					</label>
					<div class="col-xl-10 col-lg-10 col-md-8 col-sm-12 col-12" >
						<div class="input-group" >
							<select class="custom-select" aria-label="" >
								<option value="1">Marca 1</option>
								<option value="2">Marca 2</option>
								<option value="3">Marca 3</option>
								<option value="4">Marca 4</option>
							</select>
							<div class="input-group-prepend" >
								<button type="button" role="button" class="btn btn-light" >
									...
								</button>
							</div>
						</div>
					</div>
				</div>
				<div class="form-group row" >
					<label for="" class="col-xl-2 col-lg-2 col-md-4 col-sm-12 col-12" >
						Presentación
					</label>
					<div class="col-xl-10 col-lg-10 col-md-8 col-sm-12 col-12" >
						<textarea class="form-control" aria-label=""
								  rows="3" ></textarea>
					</div>
				</div>
				<div class="row" >
					<div class="col-xl-8 col-lg-8 col-md-12 col-sm-12 col-12" >
						<div class="form-group row" >
							<label for="" class="col-xl-3 col-lg-3 col-md-4 col-sm-12 col-12" >
								Fabricante
							</label>
							<div class="col-xl-9 col-lg-9 col-md-8 col-sm-12 col-12" >
								<div class="input-group" >
									<select class="custom-select" aria-label="" >
										<option value="1">Fabricante 1</option>
										<option value="2">Fabricante 2</option>
										<option value="3">Fabricante 3</option>
										<option value="4">Fabricante 4</option>
									</select>
									<div class="input-group-prepend" >
										<button type="button" role="button" class="btn btn-light" >
											...
										</button>
									</div>
								</div>
							</div>
						</div>
					</div>
					<div class="col-xl-4 col-lg-4 col-md-12 col-sm-12 col-12" >
						<div class="form-group row" >
							<label for="" class="col-xl-4 col-lg-4 col-md-4 col-sm-12 col-12" >
								País
							</label>
							<div class="col-xl-8 col-lg-8 col-md-8 col-sm-12 col-12" >
								<select class="custom-select" aria-label="" >
									<option value="1">Perú</option>
								</select>
							</div>
						</div>
					</div>
				</div>
				<div class="form-group row" >
					<label for="" class="col-xl-2 col-lg-2 col-md-4 col-sm-12 col-12" >
						Dirección Fabricante
					</label>
					<div class="col-xl-10 col-lg-10 col-md-8 col-sm-12 col-12" >
						<input type="text" class="form-control" aria-label=""
							   value="" />
					</div>
				</div>
				<div class="row" >
					<div class="col-xl-4 col-lg-5 col-md-12 col-sm-12 col-12" >
						<div class="form-group row" >
							<label for="" class="col-xl-6 col-lg-5 col-md-4 col-sm-12 col-12" >
								Estado
							</label>
							<div class="col-xl-6 col-lg-7 col-md-8 col-sm-12 col-12" >
								<select class="custom-select" aria-label="" >
									<option value="1">Activo</option>
									<option value="0">Inactivo</option>
								</select>
							</div>
						</div>
					</div>
					<div class="col-xl-8 col-lg-7 col-md-12 col-sm-12 col-12" >
						<div class="form-group row" >
							<label for="" class="col-xl-4 col-lg-4 col-md-4 col-sm-12 col-12" >
								Código Fórmula
							</label>
							<div class="col-xl-8 col-lg-8 col-md-8 col-sm-12 col-12" >
								<input type="text" class="form-control" aria-label=""
									   value="" />
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="modal-footer">
				<div class="btn-group">
					<button type="button" class="btn btn-danger">
						<i class="fa fa-save"></i> Guardar
					</button>
					<button type="button" class="btn btn-danger dropdown-toggle dropdown-toggle-split d-xl-none d-lg-none d-md-none"
							data-toggle="dropdown"
							aria-haspopup="true"
							aria-expanded="false">
						<span class="sr-only">Toggle Dropdown</span>
					</button>
					<div class="dropdown-menu dropdown-menu-right">
						<button class="dropdown-item">
							<i class="fa fa-refresh"></i> Guardar y crear un nuevo
						</button>
					</div>
				</div>
				<button type="button" class="btn btn-secondary d-xl-block d-lg-block d-md-block d-none">
					<i class="fa fa-refresh"></i> Guardar y crear un nuevo
				</button>
				<button type="button" class="btn btn-link" data-dismiss="modal">
					Salir
				</button>
			</div>
		</div>
	</div>
</div>
