<div class="modal fade" id="modalSelectProduct" tabindex="-1"
	 aria-labelledby="exampleModalLabel" aria-hidden="true">
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
				<form action="<?php echo base_url('ar/ope/cproductocliente/filtro') ?>" id="frmFiltroProducto"
					  method="POST" accept-charset="UTF-8" onsubmit="return false;" >
					<input type="hidden" class="d-none" id="filtro_producto_limit" name="filtro_producto_limit"
						   value="80">
					<input type="hidden" class="d-none" id="filtro_producto_offset" name="filtro_producto_offset"
						   value="0">
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
				</form>
				<div class="d-flex justify-content-end">
					<button type="button" role="button" class="btn btn-light" id="btnProductoBuscar">
						<i class="fa fa-search"></i> Buscar
					</button>
					<button type="button" role="button" class="btn btn-primary ml-2"
							id="btnProductoNuevo">
						<i class="fa fa-plus"></i> Nuevo Producto
					</button>
				</div>
				<div class="row justify-content-between my-2">
					<div class="col-xl-4 col-lg-4 col-md-4 col-sm-6 col-12">
						Nro. de productos elegidos: <b id="tblProductosElegidos">0</b>
					</div>
				</div>
				<div class="table-responsive">
					<table class="table table-bordered table-hover table-valign-middle" id="tblProductos">
						<thead class="bg-secondary">
						<tr>
							<td class="text-center"></td>
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
						</tbody>
					</table>
				</div>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-danger" data-dismiss="modal" >
					<i class="fa fa-save"></i> Agregar productos
				</button>
			</div>
		</div>
	</div>
</div>
