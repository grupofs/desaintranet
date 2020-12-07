<div class="modal fade" id="modalAddProduct"
	 data-backdrop="static"
	 data-keyboard="false"
	 tabindex="-1"
	 aria-labelledby="exampleModalLabel"
	 aria-hidden="true">
	<div class="modal-dialog modal-xl modal-dialog-scrollable">
		<div class="modal-content">
			<div class="modal-header bg-success">
				<h5 class="modal-title fs w-100 font-weight-bold">
					Datos del Producto
				</h5>
			</div>
			<div class="modal-body"
				 style="background-color:#ffffff; border-top: 1px solid #00a65a; border-bottom: 1px solid #00a65a;">
				<form action="<?php echo base_url('ar/ope/cproductocliente/guardar') ?>" method="POST"
					  accept-charset="UTF-8" id="frmProducto" >
					<div class="form-group row">
						<label for="producto_cliente_text" class="col-xl-2 col-lg-2 col-md-4 col-sm-12 col-12">
							Cliente
						</label>
						<div class="col-xl-10 col-lg-10 col-md-8 col-sm-12 col-12">
							<input type="text" class="form-control" aria-label="" readonly maxlength="0"
								   id="producto_cliente_text"
								   value=""/>
						</div>
					</div>
					<div class="form-group row">
						<label for="producto_tipo_producto_text" class="col-xl-2 col-lg-2 col-md-4 col-sm-12 col-12">
							Tipo de Producto
						</label>
						<div class="col-xl-10 col-lg-10 col-md-8 col-sm-12 col-12">
							<input type="text" class="form-control" aria-label="" readonly maxlength="0"
								   id="producto_tipo_producto_text"
								   value=""/>
						</div>
					</div>
					<div class="row">
						<div class="col-xl-6 col-lg-6 col-md-12 col-sm-12 col-12">
							<div class="form-group row">
								<label for="producto_codigo_producto" class="col-xl-4 col-lg-4 col-md-4 col-sm-12 col-12">
									Código de Producto
								</label>
								<div class="col-xl-8 col-lg-8 col-md-8 col-sm-12 col-12">
									<input type="text" class="form-control" aria-label=""
										   id="producto_codigo_producto" name="producto_codigo_producto"
										   value=""/>
								</div>
							</div>
						</div>
						<div class="col-xl-6 col-lg-6 col-md-12 col-sm-12 col-12">
							<div class="form-group row">
								<label for="producto_categoria_id" class="col-xl-4 col-lg-4 col-md-4 col-sm-12 col-12">
									Categoría
								</label>
								<div class="col-xl-8 col-lg-8 col-md-8 col-sm-12 col-12">
									<select class="custom-select" aria-label=""
											id="producto_categoria_id" name="producto_categoria_id" >
									</select>
								</div>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-xl-6 col-lg-12 col-md-12 col-sm-12 col-12">
							<div class="form-group row">
								<label for="producto_rs" class="col-xl-4 col-lg-2 col-md-4 col-sm-12 col-12">
									Registro Sanitario
									<span class="fs-requerido text-danger">*</span>
								</label>
								<div class="col-xl-8 col-lg-10 col-md-8 col-sm-12 col-12">
									<input type="text" class="form-control" aria-label=""
										   id="producto_rs" name="producto_rs"
										   value=""/>
								</div>
							</div>
						</div>
						<div class="col-xl-3 col-lg-6 col-md-12 col-sm-12 col-12">
							<div class="form-group row">
								<label for="producto_fecha_inicio" class="col-xl-5 col-lg-4 col-md-4 col-sm-12 col-12">
									F. Emisión
									<span class="fs-requerido text-danger">*</span>
								</label>
								<div class="col-xl-7 col-lg-8 col-md-8 col-sm-12 col-12">
									<input type="text" class="form-control datepicker" aria-label=""
										   id="producto_fecha_inicio" name="producto_fecha_inicio"
										   value=""/>
								</div>
							</div>
						</div>
						<div class="col-xl-3 col-lg-6 col-md-12 col-sm-12 col-12">
							<div class="form-group row">
								<label for="producto_fecha_vencimiento" class="col-xl-6 col-lg-4 col-md-4 col-sm-12 col-12">
									F. Vencimiento
									<span class="fs-requerido text-danger">*</span>
								</label>
								<div class="col-xl-6 col-lg-8 col-md-8 col-sm-12 col-12">
									<input type="text" class="form-control datepicker" aria-label=""
										   id="producto_fecha_vencimiento" name="producto_fecha_vencimiento"
										   value=""/>
								</div>
							</div>
						</div>
					</div>
					<div class="form-group row">
						<label for="producto_descripcion_sap" class="col-xl-2 col-lg-2 col-md-4 col-sm-12 col-12">
							Descripción SAP
						</label>
						<div class="col-xl-10 col-lg-10 col-md-8 col-sm-12 col-12">
							<input type="text" class="form-control" aria-label=""
								   id="producto_descripcion_sap" name="producto_descripcion_sap"
								   value=""/>
						</div>
					</div>
					<div class="form-group row">
						<label for="producto_nombre" class="col-xl-2 col-lg-2 col-md-4 col-sm-12 col-12">
							Nombre de Producto
							<span class="fs-requerido text-danger">*</span>
						</label>
						<div class="col-xl-10 col-lg-10 col-md-8 col-sm-12 col-12">
							<input type="text" class="form-control" aria-label=""
								   id="producto_nombre" name="producto_nombre"
								   value=""/>
						</div>
					</div>
					<div class="form-group row">
						<label for="producto_marca_id" class="col-xl-2 col-lg-2 col-md-4 col-sm-12 col-12">
							Marca
						</label>
						<div class="col-xl-10 col-lg-10 col-md-8 col-sm-12 col-12">
							<div class="row" >
								 <div class="col-xl-10 col-lg-10 col-md-12 col-sm-12 col-12" >
									 <select class="custom-select" aria-label=""
											 id="producto_marca_id" name="producto_marca_id">
									 </select>
								 </div>
								<div class="col-xl-2 col-lg-2 col-md-12 col-sm-12 col-12" >
									<button type="button" role="button" class="btn btn-light btn-block"
											data-toggle="modal" data-target="#modalFormularioMarca">
										<i class="fa fa-plus" ></i> Nuevo
									</button>
								</div>
							</div>
						</div>
					</div>
					<div class="form-group row">
						<label for="producto_presentacion" class="col-xl-2 col-lg-2 col-md-4 col-sm-12 col-12">
							Presentación
						</label>
						<div class="col-xl-10 col-lg-10 col-md-8 col-sm-12 col-12">
						<textarea class="form-control" aria-label=""
								  id="producto_presentacion" name="producto_presentacion"
								  rows="3"></textarea>
						</div>
					</div>
					<div class="row">
						<div class="col-xl-8 col-lg-8 col-md-12 col-sm-12 col-12">
							<div class="form-group row">
								<label for="producto_fabricante_id" class="col-xl-3 col-lg-3 col-md-12 col-sm-12 col-12">
									Fabricante
								</label>
								<div class="col-xl-9 col-lg-9 col-md-12 col-sm-12 col-12">
									<div class="row" >
										<div class="col-xl-8 col-lg-8 col-md-12 col-sm-12 col-12" >
											<select class="custom-select" aria-label=""
													id="producto_fabricante_id" name="producto_fabricante_id">
											</select>
										</div>
										<div class="col-xl-4 col-lg-4 col-md-12 col-sm-12 col-12" >
											<button type="button" role="button" class="btn btn-light btn-block"
													data-toggle="modal" data-target="#modalFormularioFabricante">
												<i class="fa fa-plus" ></i> Nuevo
											</button>
										</div>
									</div>
								</div>
							</div>
						</div>
						<div class="col-xl-4 col-lg-4 col-md-12 col-sm-12 col-12">
							<div class="form-group row">
								<label for="producto_pais" class="col-xl-4 col-lg-4 col-md-4 col-sm-12 col-12">
									País
								</label>
								<div class="col-xl-8 col-lg-8 col-md-8 col-sm-12 col-12">
									<select class="custom-select" aria-label=""
											id="producto_pais" name="producto_pais" >
									</select>
								</div>
							</div>
						</div>
					</div>
					<div class="form-group row">
						<label for="producto_direccion_fabricante" class="col-xl-2 col-lg-2 col-md-4 col-sm-12 col-12">
							Dirección Fabricante
						</label>
						<div class="col-xl-10 col-lg-10 col-md-8 col-sm-12 col-12">
							<input type="text" class="form-control" aria-label=""
								   id="producto_direccion_fabricante" name="producto_direccion_fabricante"
								   value=""/>
						</div>
					</div>
					<div class="row">
						<div class="col-xl-4 col-lg-5 col-md-12 col-sm-12 col-12">
							<div class="form-group row">
								<label for="producto_estado" class="col-xl-6 col-lg-5 col-md-4 col-sm-12 col-12">
									Estado
									<span class="fs-requerido text-danger">*</span>
								</label>
								<div class="col-xl-6 col-lg-7 col-md-8 col-sm-12 col-12">
									<select class="custom-select" aria-label=""
											id="producto_estado" name="producto_estado" >
										<option value="A" selected >Activo</option>
										<option value="I">Inactivo</option>
									</select>
								</div>
							</div>
						</div>
					</div>
				</form>
			</div>
			<div class="modal-footer">
				<div class="btn-group">
					<button type="button" class="btn btn-danger btn-producto-guardar" data-type="1" >
						<i class="fa fa-save"></i> Guardar
					</button>
					<button type="button"
							class="btn btn-danger dropdown-toggle dropdown-toggle-split d-xl-none d-lg-none d-md-none"
							data-toggle="dropdown"
							aria-haspopup="true"
							aria-expanded="false">
						<span class="sr-only">...</span>
					</button>
					<div class="dropdown-menu dropdown-menu-right">
						<button class="dropdown-item btn-producto-guardar" data-type="2" >
							<i class="fa fa-refresh"></i> Guardar y crear uno nuevo
						</button>
					</div>
				</div>
				<button type="button"
						class="btn btn-secondary d-xl-block d-lg-block d-md-block d-none btn-producto-guardar"
						data-type="2" >
					<i class="fa fa-refresh"></i> Guardar y crear uno nuevo
				</button>
				<button type="button" class="btn btn-link" data-dismiss="modal">
					Salir
				</button>
			</div>
		</div>
	</div>
</div>
