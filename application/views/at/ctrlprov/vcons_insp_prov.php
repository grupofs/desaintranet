<div class="modal fade" id="modalProveedor" data-backdrop="static" data-keyboard="false" tabindex="-1"
	 aria-labelledby="staticBackdropLabel" aria-hidden="true">
	<div class="modal-dialog modal-xl modal-dialog-scrollable">
		<div class="modal-content">
			<div class="modal-header bg-success">
				<h5 class="modal-title fs w-100 font-weight-bold">Datos del Proveedor</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body"
				 style="background-color:#ffffff; border-top: 1px solid #00a65a; border-bottom: 1px solid #00a65a;">
				<div class="form-group row">
					<label for="" class="col-xl-2 col-lg-2 col-md-3 col-sm-12 col-12">
						RUC
					</label>
					<div class="col-xl-10 col-lg-10 col-md-9 col-sm-12 col-12">
						: <span id="proveedor_ruc"></span>
					</div>
				</div>
				<div class="form-group row">
					<label for="" class="col-xl-2 col-lg-2 col-md-3 col-sm-12 col-12">
						Razón Social
					</label>
					<div class="col-xl-10 col-lg-10 col-md-9 col-sm-12 col-12">
						: <span id="proveedor_razon_social"></span>
					</div>
				</div>
				<div class="form-group row">
					<label for="" class="col-xl-2 col-lg-2 col-md-3 col-sm-12 col-12">
						Dirección
					</label>
					<div class="col-xl-10 col-lg-10 col-md-9 col-sm-12 col-12">
						: <span id="proveedor_direccion"></span>
					</div>
				</div>
				<div class="form-group row">
					<label for="" class="col-xl-2 col-lg-2 col-md-3 col-sm-12 col-12">
						Ubigeo
					</label>
					<div class="col-xl-10 col-lg-10 col-md-9 col-sm-12 col-12">
						: <span id="proveedor_ubigeo"></span>
					</div>
				</div>
				<div class="form-group row">
					<label for="" class="col-xl-2 col-lg-2 col-md-3 col-sm-12 col-12">
						Teléfono
					</label>
					<div class="col-xl-10 col-lg-10 col-md-9 col-sm-12 col-12">
						: <span id="proveedor_telefono"></span>
					</div>
				</div>
				<div class="form-group row">
					<label for="" class="col-xl-2 col-lg-2 col-md-3 col-sm-12 col-12">
						Representante
					</label>
					<div class="col-xl-10 col-lg-10 col-md-9 col-sm-12 col-12">
						: <span id="proveedor_representante"></span>
					</div>
				</div>
				<div class="form-group row">
					<label for="" class="col-xl-2 col-lg-2 col-md-3 col-sm-12 col-12">
						Tipo Empresa
					</label>
					<div class="col-xl-10 col-lg-10 col-md-9 col-sm-12 col-12">
						: <span id="proveedor_tipo_empresa"></span>
					</div>
				</div>
				<div class="form-group">
					<label for="">
						Establecimiento Inspeccionado:
					</label>
					<div class="d-block">
						<span id="proveedor_inspeccionado"></span>
					</div>
				</div>
				<div class="form-group">
					<label for="">
						Línea:
					</label>
					<div class="d-block">
						<span id="proveedor_linea"></span>
					</div>
				</div>
				<div class="table-responsive mt-2">
					<table class="table table-bordered table-striped" id="tblProveedorContactos">
						<thead class="bg-secondary text-white">
						<tr>
							<th class="text-center">N°</th>
							<th class="text-center">Apellidos y Nombres</th>
							<th class="text-center">Cargo</th>
							<th class="text-center">E-Mail</th>
							<th class="text-center">teléfono</th>
						</tr>
						</thead>
						<tbody>
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>
</div>
