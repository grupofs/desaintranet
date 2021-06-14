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
					  accept-charset="UTF-8" id="frmProducto">
					<input type="hidden" class="d-none" id="producto_cliente_id" name="producto_cliente_id" value="">
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
								<label for="producto_codigo_producto"
									   class="col-xl-4 col-lg-4 col-md-4 col-sm-12 col-12">
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
											id="producto_categoria_id" name="producto_categoria_id">
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
									<input type="text" class="form-control" aria-label=""
										   id="producto_fecha_inicio" name="producto_fecha_inicio"
										   value=""/>
								</div>
							</div>
						</div>
						<div class="col-xl-3 col-lg-6 col-md-12 col-sm-12 col-12">
							<div class="form-group row">
								<label for="producto_fecha_vencimiento"
									   class="col-xl-6 col-lg-4 col-md-4 col-sm-12 col-12">
									F. Vencimiento
									<span class="fs-requerido text-danger">*</span>
								</label>
								<div class="col-xl-6 col-lg-8 col-md-8 col-sm-12 col-12">
									<input type="text" class="form-control" aria-label=""
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
							<div class="row">
								<div class="col-xl-10 col-lg-10 col-md-12 col-sm-12 col-12">
									<select class="custom-select" aria-label=""
											id="producto_marca_id" name="producto_marca_id">
									</select>
								</div>
								<div class="col-xl-2 col-lg-2 col-md-12 col-sm-12 col-12">
									<button type="button" role="button" class="btn btn-light btn-block"
											data-toggle="modal" data-target="#modalFormularioMarca">
										<i class="fa fa-plus"></i> Nuevo
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
								<label for="producto_fabricante_id"
									   class="col-xl-3 col-lg-3 col-md-12 col-sm-12 col-12">
									Fabricante
								</label>
								<div class="col-xl-9 col-lg-9 col-md-12 col-sm-12 col-12">
									<div class="row">
										<div class="col-xl-8 col-lg-8 col-md-12 col-sm-12 col-12">
											<select class="custom-select" aria-label=""
													id="producto_fabricante_id" name="producto_fabricante_id">
											</select>
										</div>
										<div class="col-xl-4 col-lg-4 col-md-12 col-sm-12 col-12">
											<button type="button" role="button" class="btn btn-light btn-block"
													data-toggle="modal" data-target="#modalFormularioFabricante">
												<i class="fa fa-plus"></i> Nuevo
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
											id="producto_pais" name="producto_pais">
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
					<div class="form-group row">
						<label for="producto_vida_util" class="col-xl-2 col-lg-2 col-md-4 col-sm-12 col-12">
							Vida Util
						</label>
						<div class="col-xl-10 col-lg-10 col-md-8 col-sm-12 col-12">
							<input type="text" class="form-control" aria-label="" maxlength="250"
								   id="producto_vida_util" name="producto_vida_util"
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
											id="producto_estado" name="producto_estado">
										<option value="A" selected>Activo</option>
										<option value="I">Inactivo</option>
									</select>
								</div>
							</div>
						</div>
						<div class="col-xl-8 col-lg-7 col-md-12 col-sm-12 col-12 contenido-digemid" style="display: none" >
							<div class="form-group row">
								<label for="producto_formula" class="col-xl-3 col-lg-3 col-md-4 col-sm-12 col-12">
									Código de Formula
								</label>
								<div class="col-xl-9 col-lg-9 col-md-8 col-sm-12 col-12">
									<input type="text" class="form-control" aria-label="" maxlength="250"
										   id="producto_formula" name="producto_formula"
										   value=""/>
								</div>
							</div>
						</div>
					</div>
					<div class="card card-success contenido-digemid" style="display: none">
						<div class="card-header">
							<h3 class="card-title">Exlusivo para DIGEMID</h3>
						</div>
						<div class="card-body">
							<div class="row" >
								<div class="col-xl-8 col-lg-8 col-md-12 col-sm-12 col-12">
									<div class="form-group row">
										<label for="producto_digemid_modelo"
											   class="col-xl-3 col-lg-3 col-md-12 col-sm-12 col-12">
											Modelo (Tono, variedades, Sub-marca):
										</label>
										<div class="col-xl-9 col-lg-9 col-md-12 col-sm-12 col-12">
										<textarea name="producto_digemid_modelo" id="producto_digemid_modelo"
												  class="form-control" rows="5"></textarea>
										</div>
									</div>
								</div>
								<div class="col-xl-4 col-lg-4 col-md-12 col-sm-12 col-12 text-right">
									<div class="custom-control custom-checkbox">
										<input type="checkbox"
											   class="custom-control-input custom-control-input-checked"
											   id="producto_digemid_tramitable" value="1"
											   name="producto_digemid_tramitable"><label
												class="custom-control-label" for="producto_digemid_tramitable">
											Tramitable
										</label>
									</div>
									<div class="custom-control custom-checkbox">
										<input type="checkbox"
											   class="custom-control-input custom-control-input-checked"
											   id="producto_digemid_inflamable" value="1"
											   name="producto_digemid_inflamable"><label
												class="custom-control-label" for="producto_digemid_inflamable">
											Inflamable
										</label>
									</div>
								</div>
							</div>
							<div class="row" >
								<div class="col-xl-8 col-lg-8 col-md-12 col-sm-12 col-12">
									<div class="form-group row">
										<label for="producto_digemid_forma_cosmetica" class="col-xl-3 col-lg-3 col-md-12 col-sm-12 col-12">
											Forma Cosmetica
										</label>
										<div class="col-xl-9 col-lg-9 col-md-12 col-sm-12 col-12">
											<select class="custom-select"
													name="producto_digemid_forma_cosmetica"
													id="producto_digemid_forma_cosmetica">
												<option value="Aceite">Aceite</option>
												<option value="Aerosol">Aerosol</option>
												<option value="Bálsamo labial">Bálsamo labial</option>
												<option value="Barra">Barra</option>
												<option value="Cera">Cera</option>
												<option value="Crema Gel">Crema Gel</option>
												<option value="Crema">Crema</option>
												<option value="Emulsión">Emulsión</option>
												<option value="Esmalte">Esmalte</option>
												<option value="Gel">Gel</option>
												<option value="Granulado">Granulado</option>
												<option value="Lápiz">Lápiz</option>
												<option value="Líquido">Líquido</option>
												<option value="Loción">Loción</option>
												<option value="Pasta">Pasta</option>
												<option value="Perfume">Perfume</option>
												<option value="Polvo">Polvo</option>
												<option value="Solido">Solido</option>
												<option value="Solido compacto">Solido compacto</option>
												<option value="Solución">Solución</option>
												<option value="Soporte impregnado">Soporte impregnado</option>
												<option value="Suero">Suero</option>
												<option value="Suspensión">Suspensión</option>
											</select>
										</div>
									</div>
								</div>
							</div>
							<div class="row">
								<div class="col-xl-8 col-lg-8 col-md-12 col-sm-12 col-12">
									<div class="form-group row">
										<label for="producto_digemid_fabricante_id"
											   class="col-xl-3 col-lg-3 col-md-12 col-sm-12 col-12">
											Fabricante 2
										</label>
										<div class="col-xl-9 col-lg-9 col-md-12 col-sm-12 col-12">
											<div class="row">
												<div class="col-xl-8 col-lg-8 col-md-12 col-sm-12 col-12">
													<select class="custom-select" aria-label=""
															id="producto_digemid_fabricante_id" name="producto_digemid_fabricante_id">
													</select>
												</div>
												<div class="col-xl-4 col-lg-4 col-md-12 col-sm-12 col-12">
													<button type="button" role="button" class="btn btn-light btn-block"
															data-toggle="modal" data-target="#modalFormularioFabricante">
														<i class="fa fa-plus"></i> Nuevo
													</button>
												</div>
											</div>
										</div>
									</div>
								</div>
								<div class="col-xl-4 col-lg-4 col-md-12 col-sm-12 col-12">
									<div class="form-group row">
										<label for="producto_digemid_pais" class="col-xl-4 col-lg-4 col-md-4 col-sm-12 col-12">
											País 2
										</label>
										<div class="col-xl-8 col-lg-8 col-md-8 col-sm-12 col-12">
											<select class="custom-select" aria-label=""
													id="producto_digemid_pais" name="producto_digemid_pais">
											</select>
										</div>
									</div>
								</div>
							</div>
							<div class="row" style="display: none" >
								<div class="col-xl-8 col-lg-8 col-md-12 col-sm-12 col-12">
									<div class="form-group row">
										<label for="producto_digemid_fabricante3_id"
											   class="col-xl-3 col-lg-3 col-md-12 col-sm-12 col-12">
											Fabricante 3
										</label>
										<div class="col-xl-9 col-lg-9 col-md-12 col-sm-12 col-12">
											<div class="row">
												<div class="col-xl-8 col-lg-8 col-md-12 col-sm-12 col-12">
													<select class="custom-select" aria-label=""
															id="producto_digemid_fabricante3_id" name="producto_digemid_fabricante3_id">
													</select>
												</div>
												<div class="col-xl-4 col-lg-4 col-md-12 col-sm-12 col-12">
													<button type="button" role="button" class="btn btn-light btn-block"
															data-toggle="modal" data-target="#modalFormularioFabricante">
														<i class="fa fa-plus"></i> Nuevo
													</button>
												</div>
											</div>
										</div>
									</div>
								</div>
								<div class="col-xl-4 col-lg-4 col-md-12 col-sm-12 col-12">
									<div class="form-group row">
										<label for="producto_digemid_pais3" class="col-xl-4 col-lg-4 col-md-4 col-sm-12 col-12">
											País 3
										</label>
										<div class="col-xl-8 col-lg-8 col-md-8 col-sm-12 col-12">
											<select class="custom-select" aria-label=""
													id="producto_digemid_pais3" name="producto_digemid_pais3">
											</select>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</form>
			</div>
			<div class="modal-footer w-100 d-flex flex-row">
				<div class="custom-control custom-checkbox">
					<input type="checkbox" class="custom-control-input" id="producto-copia-pega" value="1">
					<label class="custom-control-label" for="producto-copia-pega">Copiar y Guardar</label>
				</div>
				<button type="button" class="btn btn-danger btn-producto-guardar">
					<i class="fa fa-save"></i> Guardar
				</button>
				<button type="button" class="btn btn-link" data-dismiss="modal">
					Salir
				</button>
			</div>
		</div>
	</div>
</div>
