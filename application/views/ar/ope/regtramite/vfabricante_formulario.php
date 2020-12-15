<div class="modal fade" id="modalFormularioFabricante"
	 data-backdrop="static"
	 data-keyboard="false"
	 tabindex="-1"
	 aria-labelledby="exampleModalLabel"
	 aria-hidden="true">
	<div class="modal-dialog modal-xl modal-dialog-scrollable">
		<div class="modal-content">
			<div class="modal-header bg-success">
				<h5 class="modal-title fs w-100 font-weight-bold">
					Datos del Fabricante
				</h5>
			</div>
			<div class="modal-body"
				 style="background-color:#ffffff; border-top: 1px solid #00a65a; border-bottom: 1px solid #00a65a;">
				<form action="<?php echo base_url('ar/ope/cfabricantexcliente/guardar') ?>" method="POST"
					  accept-charset="UTF-8" id="frmFabricante" >
					<div class="form-group row">
						<label for="fabricante_cliente_text" class="col-xl-2 col-lg-2 col-md-4 col-sm-12 col-12">
							Cliente
						</label>
						<div class="col-xl-10 col-lg-10 col-md-8 col-sm-12 col-12">
							<input type="text" class="form-control" aria-label="" readonly maxlength="0"
								   id="fabricante_cliente_text"
								   value=""/>
						</div>
					</div>
					<div class="form-group row">
						<label for="marca_nombre" class="col-xl-2 col-lg-2 col-md-4 col-sm-12 col-12">
							Nombre del Fabricante
							<span class="fs-requerido text-danger">*</span>
						</label>
						<div class="col-xl-10 col-lg-10 col-md-8 col-sm-12 col-12">
							<input type="text" class="form-control" aria-label=""
								   id="fabricante_nombre" name="fabricante_nombre"
								   value=""/>
						</div>
					</div>
					<div class="row">
						<div class="col-xl-4 col-lg-5 col-md-12 col-sm-12 col-12">
							<div class="form-group row">
								<label for="fabricante_estado" class="col-xl-6 col-lg-5 col-md-4 col-sm-12 col-12">
									Estado
									<span class="fs-requerido text-danger">*</span>
								</label>
								<div class="col-xl-6 col-lg-7 col-md-8 col-sm-12 col-12">
									<select class="custom-select" aria-label=""
											id="fabricante_estado" name="fabricante_estado" >
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
				<button type="button" class="btn btn-danger" id="btnGuardarFabricante" >
					<i class="fa fa-save"></i> Guardar
				</button>
				<button type="button" class="btn btn-link" data-dismiss="modal">
					Salir
				</button>
			</div>
		</div>
	</div>
</div>
