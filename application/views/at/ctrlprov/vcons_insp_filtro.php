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
					<div class="col-xl-4 col-lg-4 col-md-6 col-sm-6 col-12">
						<div class="form-group">
							<label for="filtro_cliente_area">Área Cliente</label>
							<div class="input-group">
								<select name="filtro_cliente_area"
										id="filtro_cliente_area"
										class="custom-select"></select>
							</div>
						</div>
					</div>
					<div class="col-xl-4 col-lg-4 coñ-md-6 col-sm-6 col-12" >
						<div class="form-group">
							<label for="" class="d-block">
								Peligro
							</label>
							<div class="custom-control custom-control-inline custom-radio">
								<input type="radio" id="filtro_peligro_1"
									   name="filtro_peligro"
									   class="custom-control-input" value="S">
								<label class="custom-control-label"
									   for="filtro_peligro_1">
									Si
								</label>
							</div>
							<div class="custom-control custom-control-inline custom-radio">
								<input type="radio" id="filtro_peligro_2"
									   name="filtro_peligro"
									   class="custom-control-input" value="N">
								<label class="custom-control-label"
									   for="filtro_peligro_2">
									No
								</label>
							</div>
							<div class="custom-control custom-control-inline custom-radio">
								<input type="radio" id="filtro_peligro_3"
									   name="filtro_peligro"
									   checked
									   class="custom-control-input" value="">
								<label class="custom-control-label"
									   for="filtro_peligro_3">
									Todos
								</label>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
