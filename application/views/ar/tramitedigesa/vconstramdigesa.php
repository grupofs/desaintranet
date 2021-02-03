<?php
	$ccliente = $this->session->userdata('s_ccliente');
	$sgrupo = $this->session->userdata('s_sgrupo');
    $idusu = $this->session->userdata('s_idusuario');
?>

<style>
	.bootstrap-switch .bootstrap-switch-handle-off.bootstrap-switch-default, .bootstrap-switch .bootstrap-switch-handle-on.bootstrap-switch-default {
		background: #28a745 !important;
		color: #1f2d3d !important;
	}

	td.details-control {
		background: url('<?php echo base_url() ?>assets/images/details_open.png') no-repeat center center;
		cursor: pointer;
	}

	tr.details td.details-control {
		background: url('<?php echo base_url() ?>assets/images/details_close.png') no-repeat center center;
	}

	.index {
		vertical-align: inherit !important;
	}
</style>

<!-- content-header -->
<div class="content-header">
	<div class="container-fluid">
		<div class="row mb-2">
			<div class="col-sm-6">
				<h1 class="m-0 text-dark">CONSULTAS TRAMITES
					<small>Digesa</small>
				</h1>
			</div>
			<div class="col-sm-6">
				<ol class="breadcrumb float-sm-right">
					<li class="breadcrumb-item"><a href="<?php echo public_base_url(); ?>cpanel"> <i class="fas fa-tachometer-alt"></i>Home</a></li>
					<li class="breadcrumb-item active">AA. RR.</li>
				</ol>
			</div>
		</div>
	</div>
</div>
<!-- /.content-header -->

<!-- Main content -->
<section class="content">
	<div class="container-fluid">
		<form class="form-horizontal" id="frmexceltramar" name="frmexceltramar" action="<?= base_url('ar/tramites/cexcelExport/exceltramardigesa') ?>" method="POST" enctype="multipart/form-data" role="form">
		<div class="card card-info">
			<div class="card-header">
				<h3 class="card-title">BUSQUEDA</h3>
				<div class="card-tools">
					<button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i></button>
				</div>
			</div>
			<div class="card-body">
				<input type="hidden" name="hdnccliente" class="form-control" id="hdnccliente" value="<?php echo $ccliente ?>">
				<input type="hidden" name="hdnsgrupo" class="form-control" id="hdnsgrupo" value="<?php echo $sgrupo ?>">
				<input type="hidden" name="hdnidusu" class="form-control" id="hdnidusu" value="<?php echo $idusu ?>">
					<div class="row"> 
						<div class="col-md-5">
							<div class="form-group" id="divEmpresas">
								<label>Empresas</label>
								<select class="form-control select2bs4" id="cbocliente" name="cbocliente" style="width: 100%;">
									<option value="" selected="selected">Cargando...</option>
								</select>
							</div>
						</div> 
						<div class="col-sm-3">
							<!-- radio
							<div class="form-group clearfix">
							<div class="icheck-primary d-inline">
								<input type="radio" id="rdPProducto" name="rtipo" checked>
								<label for="rdPProducto">
									Por Producto
								</label>
							</div>
							<div class="icheck-primary d-inline">
								<input type="radio" id="rdPEstuche" name="rtipo" >
								<label for="rdPEstuche">
									Por Estuche
								</label>
							</div>
							</div>-->
						</div>
						<div class="col-sm-4">
                        	<label>&nbsp;&nbsp;</label> 
                        	<!-- radio -->
							<div class="form-group clearfix">
								<div class="icheck-primary d-inline">
									<input type="radio" id="rdETodos" value="%" name="restado">
									<label for="rdETodos">
										Todos
									</label>
								</div>
								<div class="icheck-primary d-inline">
									<input type="radio" id="rdEVigente" value="V" name="restado" checked>
									<label for="rdEVigente">
										Vigentes
									</label>
								</div>
								<div class="icheck-primary d-inline">
									<input type="radio" id="rdECaduco" value="Z" name="restado">
									<label for="rdECaduco">
										Caducos
									</label>
								</div>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-md-3">
							<div class="checkbox"><label>
									<input type="checkbox" id="chkFreg" name="chkFreg"/> <b>Fecha Emision :: Del</b>
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
						<div class="col-md-3">
							<div class="form-group">
								<label>Estado Producto</label>
								<select class="form-control select2bs4" id="cboestproducto" name="cboestproducto"
										style="width: 100%;">
									<option value="">Todos</option>
									<option value="A" selected="selected">Activos</option>
									<option value="I">Inactivos</option>
								</select>
							</div>
						</div>
						<div class="col-md-3">
							<label class="d-none d-xl-block d-lg-block">&nbsp;&nbsp;</label>
							<div class="form-group clearfix">
								<div class="icheck-primary d-inline">
									<input type="checkbox" id="chkBusavanzada">
									<label for="chkBusavanzada">
										Búsqueda Avanzada
									</label>
								</div>
							</div>
						</div>
					</div>

					<div id="busAvanzada" style="border-top: 1px solid #ccc; padding-top: 10px;">
						<div class="row">
							<div class="col-12">
								<h4>
									<small> Búsqueda Avanzada </small>
								</h4>
							</div>
						</div>
						<div class="row">
							<div class="col-sm-3">
								<div class="form-group">
									<label>Código</label>
									<input type="text" class="form-control" id="txtcodprodu" name="txtcodprodu"
										   placeholder="...">
								</div>
							</div>
							<div class="col-sm-3">
								<div class="form-group">
									<label>Nro. RS</label>
									<input type="text" class="form-control" id="txtnrors" name="txtnrors"
										   placeholder="...">
								</div>
							</div>
							<div class="col-sm-6">
								<div class="form-group">
									<label>Nombre del producto /Descripción SAP</label>
									<input type="text" class="form-control" id="txtdescprodu" name="txtdescprodu"
										   placeholder="...">
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-sm-6">
								<div class="form-group">
									<label>Categoría</label>
									<input type="text" class="form-control" id="txtcaractprodu" name="txtcaractprodu"
										   placeholder="...">
								</div>
							</div>
							<div class="col-md-3">
								<div class="form-group">
									<label>Estado de Trámite</label>
									<select class="form-control select2bs4" id="cboesttramite" name="cboesttramite"
											style="width: 100%;">
										<option value="" selected="selected">Cargando...</option>
									</select>
								</div>
							</div>
							<div class="col-sm-3">
								<div class="form-group">
									<label>Nº de Expediente</label>
									<input type="text" class="form-control" id="txtnroexpe" name="txtnroexpe"
										   placeholder="...">
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-md-4">
								<div class="form-group">
									<label>Marca</label>
									<select class="form-control select2bs4" id="cbomarca" name="cbomarca"
											style="width: 100%;">
										<option value="" selected="selected">Cargando...</option>
									</select>
								</div>
							</div>
							<div class="col-md-4">
								<div class="form-group">
									<label>Tipo Producto</label>
									<select class="form-control select2bs4" id="cbotipoprod" name="cbotipoprod"
											style="width: 100%;">
										<option value="" selected="selected">Cargando...</option>
									</select>
								</div>
							</div>
							<div class="col-sm-4">
								<div class="form-group">
									<label>Trámite</label>
									<select class="form-control select2bs4" id="cbotramite" name="cbotramite"
											style="width: 100%;">
										<option value="" selected="selected">Cargando...</option>
									</select>
								</div>
							</div>
						</div>
					</div>
				</div>

				<div class="card-footer justify-content-between" style="background-color: #D4EAFC;">
					<div class="row">
						<div class="col-md-6">
							<input type="checkbox" name="swTipoLista" id="swTipoLista" data-toggle="toggle" checked
								   data-bootstrap-switch data-on-text="Grid" data-off-text="Excel">
						</div>
						<div class="col-md-6">
							<div class="text-right">
								<button type="button" class="btn btn-primary" id="btnBuscar"><i
											class="fas fa-search"></i>&nbsp;&nbsp;Buscar
								</button>
								<button type="submit" class="btn btn-outline-success" id="btnExel"><i
											class="far fa-file-excel"></i>&nbsp;&nbsp;Exportar
								</button>
							</div>
						</div>
					</div>
				</div>
			</form>
			<div class="row">
				<div class="col-12">
					<div class="card card-outline card-success">
						<div class="card-header">
							<h3 class="card-title">Listado  - Tipo <label id="lblCia"></label></h3>
						</div>                
						<div class="card-body" id="divtblGrid" style="overflow-x: scroll;">
							<table id="tblListTramGrid" class="table table-striped table-bordered" style="width:100%">
								<thead>
								<tr>
									<th>grupo</th>
									<th>Nro</th>
                                	<th></th>
									<th>Código</th>
									<th>Descripción SAP</th>
									<th>Nombre del Producto</th>
									<th>Marca</th>
									<th>Categoria</th>
									<th>Presentación</th>
									<th>Modelo</th>
									<th>Fabricante</th>
									<th>Pais</th>
									<th>RS</th>
									<th>Fec. Vence</th>
								</tr>
								</thead>
								<tbody>
								</tbody>
							</table>
						</div>               
						<div class="card-body" id="divtblExcel" style="overflow-x: scroll;">
							<table id="tblListTramExcel" class="table table-striped table-bordered" style="width:100%">
								<thead>
								<tr>
									<th>Nro.</th>
									<th>Código</th>
									<th>Descripción SAP</th>
									<th>Nombre del Producto</th>
									<th>Marca</th>
									<th>Categoria</th>
									<th>Presentación</th>
									<th>Modelo</th>
									<th>Fabricante</th>
									<th>Pais</th>
									<th>F. Ingreso</th>
									<th>Trámite</th>
									<th>Estado</th>
									<th>N° Expediente</th>
									<th>RS</th>
									<th>Nro. DR</th>
									<th>F. Emisión</th>
									<th>F. Vencimiento</th>
									<th>Archivo</th>
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
	<div class="modal fade" id="modalListdocumentos" data-backdrop="static" role="dialog" aria-hidden="true">
	  <div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header text-center bg-info">
				<h4 class="modal-title w-100 font-weight-bold">Listado de Archivos</h4>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">                    
				<div class="form-group">
					<div class="row">
						<div class="col-12 table-responsive">
							<table id="tblListTramDocum" class="table table-striped table-bordered" style="width:100%">
								<thead>
									<tr>
									<th>N°</th>
									<th>Documento</th>
									<th>Archivo</th>
									<th></th>
									</tr>
								</thead>
								<tbody>
								</tbody>
							</table>
						</div>
					</div>                
				</div>   
			</div>
			<div class="modal-footer justify-content-between" style="background-color: #D4EAFC;">
				<div class="row">
					<div class="col-md-12">
						<div class="text-right">
							<button type="reset" class="btn btn-default" id="btnmCerDocingre" data-dismiss="modal">Cerrar</button>
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