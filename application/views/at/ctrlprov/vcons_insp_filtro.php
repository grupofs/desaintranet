<div class="modal fade" id="modalFiltro" tabindex="-1"
	 aria-labelledby="staticBackdropLabel" aria-hidden="true">
	<div class="modal-dialog modal-dialog-scrollable modal-xl">
		<div class="modal-content">
			<div class="modal-header bg-success">
				<h5 class="modal-title fs w-100 font-weight-bold">Búsqueda Avanzada</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body"
				 style="background-color:#ffffff; border-top: 1px solid #00a65a; border-bottom: 1px solid #00a65a;">
				<div class="row">
					<div class="col-xl-4 col-lg-4 col-md-4 col-sm-12 col-12">
						<div class="form-group">
							<label for="filtro_cliente_area">Área Cliente</label>
							<select name="filtro_cliente_area" style="width: 100% !important;"
									id="filtro_cliente_area" multiple
									class="custom-select select2"></select>
						</div>
					</div>
					<div class="col-xl-4 col-lg-4 coñ-md-4 col-sm-12 col-12" >
						<div class="form-group">
							<label for="filtro_establecimiento_maqui">Establecimiento / Maquilador</label>
							<input type="text" class="form-control"
								   id="filtro_establecimiento_maqui"
								   value="" >
						</div>
					</div>
					<div class="col-xl-4 col-lg-4 coñ-md-4 col-sm-12 col-12" >
						<div class="form-group">
							<label for="filtro_dir_establecimiento_maqui">Dirección Establecimiento / Maquilador</label>
							<input type="text" class="form-control"
								   id="filtro_dir_establecimiento_maqui"
								   value="" >
						</div>
					</div>
				</div>
				<div class="row" >
					<div class="col-xl-2 col-lg-2 coñ-md-6 col-sm-6 col-12" >
						<div class="form-group">
							<label for="filtro_nro_informe">Nro Informe</label>
							<input type="text" class="form-control"
								   id="filtro_nro_informe"
								   value="" >
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
