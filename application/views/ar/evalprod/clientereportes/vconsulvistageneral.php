<?php
$idusu = $this->session->userdata('s_idusuario');
$codusu = $this->session->userdata('s_cusuario');
$infousuario = $this->session->userdata('s_infodato');
?>

<style>

</style>

<!-- content-header -->
<div class="content-header">
	<div class="container-fluid">
		<div class="row mb-2">
			<div class="col-sm-6">
				<h1 class="m-0 text-dark">VISTA GENERAL - TOTTUS</h1>
			</div>
			<div class="col-sm-6">
				<ol class="breadcrumb float-sm-right">
					<li class="breadcrumb-item"><a href="<?php echo public_base_url(); ?>cpanel">Home</a></li>
					<li class="breadcrumb-item active">Eval. Prod.</li>
				</ol>
			</div>
		</div>
	</div>
</div>
<!-- /.content-header -->

<!-- Main content -->
<section class="content">
	<div class="container-fluid">
		<form class="form-horizontal" id="frmexceltramar" name="frmexceltramar"
			  action="<?= base_url('ar/tramites/cexcelExport/exceltramardigesa') ?>" method="POST"
			  enctype="multipart/form-data" role="form">
			<input type="hidden" id="id_usuario" value="<?php echo $idusu; ?>" >
			<div class="card card-info">
				<div class="card-header">
					<h3 class="card-title">BUSQUEDA</h3>
					<div class="card-tools">
						<button type="button" class="btn btn-tool" data-card-widget="collapse"><i
									class="fas fa-minus"></i></button>
					</div>
				</div>

				<div class="card-body">
					<div class="row">
						<div class="col-md-3">
							<div class="checkbox"><label>
									<input type="checkbox" id="chkFreg" name="chkFreg"/> <b>F. Ingreso :: Del</b>
								</label></div>
							<div class="input-group date" id="txtFDesde" data-target-input="nearest">
								<input type="text" id="txtFIni" name="txtFIni" class="form-control datetimepicker-input"
									   data-target="#txtFDesde" disabled/>
								<div class="input-group-append" data-target="#txtFDesde" data-toggle="datetimepicker">
									<div class="input-group-text"><i class="fa fa-calendar"></i></div>
								</div>
							</div>
						</div>
						<div class="col-md-3">
							<label>Hasta</label>
							<div class="input-group date" id="txtFHasta" data-target-input="nearest">
								<input type="text" id="txtFFin" name="txtFFin" class="form-control datetimepicker-input"
									   data-target="#txtFHasta" disabled/>
								<div class="input-group-append" data-target="#txtFHasta" data-toggle="datetimepicker">
									<div class="input-group-text"><i class="fa fa-calendar"></i></div>
								</div>
							</div>
						</div>
						<div class="col-md-2">
							<div class="form-group">
								<label>Area</label>
								<select class="form-control" id="cboArea" name="cboArea" style="width: 100%;">
									<option value="" selected="selected">Cargando...</option>
								</select>
							</div>
						</div>
						<div class="col-md-2">
							<div class="form-group">
								<label>Status</label>
								<select class="form-control" id="cbostatus" name="cbostatus" style="width: 100%;">
									<option value="" selected="selected">::Todos</option>
									<option value="0">EN PROCESO</option>
									<option value="1">APROBADO</option>
									<option value="2">RECHAZADO</option>
									<option value="3">OBSERVADO</option>
									<option value="4">Pendiente Vida Util</option>
								</select>
							</div>
						</div>
						<div class="col-md-2">
							<div class="form-group">
								<label>Proveedor Nuevo</label>
								<select class="form-control" id="cboProvnuevo" name="cboProvnuevo" style="width: 100%;">
									<option value="0" selected="selected">::Elegir</option>
									<option value="2">No</option>
									<option value="1">Si</option>
								</select>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-md-4">
							<div class="form-group">
								<label>Proveedor</label>
								<select class="form-control select2bs4" id="cboProveedor" name="cboProveedor"
										style="width: 100%;">
									<option value="" selected="selected">Cargando...</option>
								</select>
							</div>
						</div>
						<div class="col-md-3">
							<label># Expediente</label>
							<input type="text" name="txtExpediente" id="txtExpediente" class="form-control" value="">
						</div>
						<div class="col-md-3">
							<label>Código RS/NSO</label>
							<input type="text" name="txtRs" id="txtRs" class="form-control" value="">
						</div>
						<div class="col-md-2">
							<label>Código EAN </label>
							<input type="text" name="txtEan" id="txtEan" class="form-control" value="">
						</div>
					</div>
					<div class="row">
						<div class="col-md-4">
							<label>Producto </label>
							<input type="text" name="txtProducto" id="txtProducto" class="form-control" value="">
						</div>
						<div class="col-md-4">
							<label>Marca </label>
							<input type="text" name="txtMarca" id="txtMarca" class="form-control" value="">
						</div>
						<div class="col-md-4">
							<label>Fabricante </label>
							<input type="text" name="txtFabricante" id="txtFabricante" class="form-control" value="">
						</div>
					</div>
					<div class="row">
						<div class="col-md-6">
							<label>EAN Multiple </label>
							<textarea type="text" name="mtxtEANmultiple" id="mtxtEANmultiple" class="form-control"
									  rows="2" cols="40"></textarea>
						</div>
						<div class="col-md-6">
							<label>SKU Multiple </label>
							<textarea type="text" name="mtxtSKUmultiple" id="mtxtSKUmultiple" class="form-control"
									  rows="2" cols="40"></textarea>
						</div>
					</div>
				</div>

				<div class="card-footer justify-content-between" style="background-color: #D4EAFC;">
					<div class="row">
						<div class="col-xl-4 col-lg-4 col-md-4 col-sm-12 col-12" >
							<div class="text-left" >
								<button type="button" role="button" class="btn btn-info" id="btnReporteExel" >
									<i class="fa fa-file-export" ></i> Exportar Resultado
								</button>
							</div>
						</div>
						<div class="col-xl-8 col-lg-8 col-md-8 col-sm-12 col-12">
							<div class="text-right">
								<button type="button" class="btn btn-primary" id="btnBuscar"><i
											class="fa fa-search"></i>&nbsp;&nbsp;Buscar
								</button>
								<button type="submit" class="btn btn-outline-success" id="btnExel"><i
											class="far fa-file-excel"></i>&nbsp;&nbsp;Exportar
								</button>
							</div>
						</div>
					</div>
				</div>
			</div>
		</form>
		<div class="row">
			<div class="col-12">
				<div class="card card-outline card-info">
					<div class="card-header">
						<h3 class="card-title">Listado</h3>
					</div>
					<div class="card-body" style="overflow-x: scroll;">
						<table id="tblvistageneral" class="table table-striped table-bordered" style="width:100%">
							<thead>
							<tr>
								<th>#</th>
								<th>Nº DE EXPEDIENTE</th>
								<th>FECHA DE INGRESO</th>
								<th>FECHA DE EVALUADO</th>
								<th>FECHA LEV. OBS.</th>
								<th>AREA</th>
								<th>EAN/GTIN</th>
								<th>SKU</th>
								<th>PRODUCTO</th>
								<th>FABRICANTE</th>
								<th>PROVEEDOR</th>
								<th>COD. R.S./ NSO/ R.D.</th>
								<th>FECHA DE EMISION DE R.S./ N.S.O./ A.S.</th>
								<th>FECHA VENC. R.S./ N.S.O./ A.S.</th>
								<th>LIC. DE FUNCION.</th>
								<th>PAIS PROCEDENCIA</th>
								<th>FEC. VENC.</th>
								<th>COD. O LOTE PROD.</th>
								<th>LISTA DE INGRED.</th>
								<th>COND. DE CONS. DEL PRODUCTO</th>
								<th>CONDICIONES DE CONSERVACION COMPLETA (TRANSPORTE, ALMACENAMIENTO, PRODUCTO)</th>
								<th>CONDICIONES DE CONSERVACION DEL PRODUCTO</th>
								<th>CONT. NETO</th>
								<th>NUM. RUC</th>
								<th>DIRECCION IMPORTAD.</th>
								<th>TIEMPO DE VIDA UTIL</th>
								<th>FECHA INSPECCION HIGIENICO SANITARIA</th>
								<th>ENTIDAD</th>
								<th>RESPONSABLE</th>
								<th>FECHA</th>
								<th>STATUS</th>
								<th>AGOTAMIENTO DE STOCK</th>
								<th>FECHA VENCIMIENTO AGOTAMIENTO DE STOCK</th>
								<th>DOCUMENTACION PENDIENTE</th>
								<th>OBSERVADO X LICENCIA</th>
								<th>OBS. X T. NUTR.</th>
								<th>GRASAS SATURADAS</th>
								<th>AZÚCAR</th>
								<th>SODIO</th>
								<th>GRASAS TRANS</th>
								<th>OBSERVACIONES</th>
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
</section>
<!-- /.Main content -->

<!-- /.modal-Listado de Documentos -->
<div class="modal fade" id="modalSKU" data-backdrop="static" role="dialog" aria-hidden="true">
	<div class="modal-dialog modal-sm">
		<div class="modal-content">
			<div class="modal-header text-center bg-info">
				<h4 class="modal-title w-100 font-weight-bold">Registrar SKU</h4>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<div class="form-group">
					<div class="row">
						<div class="col-sm-12">
							<div class="text-light-black">SKU</div>
							<div>
								<input class="form-control" id="mtxtSKU" name="mtxtSKU">
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="modal-footer justify-content-between" style="background-color: #D4EAFC;">
				<div class="row">
					<div class="col-md-12">
						<div class="text-right">
							<button type="reset" class="btn btn-default" id="mbtnCerrarModalSKU" data-dismiss="modal">
								Cancelar
							</button>
							<button type="submit" class="btn btn-info" id="mbtnGuardarModalSKU">Grabar</button>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<!-- /.modal-->


<!-- Script Generales -->
<script type="text/javascript">
	var baseurl = "<?php echo base_url();?>";
</script>
