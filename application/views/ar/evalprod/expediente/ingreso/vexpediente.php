<?php
$codcliente = $this-> session-> userdata('s_ccliente');
$idusuario = $this-> session-> userdata('s_idusuario');
$idrol = $this-> session-> userdata('s_idrol');
$cia = $this-> session-> userdata('s_cia');
?>

<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0 text-dark">
                    INGRESO DE EXPEDIENTES
                </h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="<?php echo public_base_url(); ?>cprincipal/principal">Home</a>
                    </li>
                    <li class="breadcrumb-item active">Evaluacion Productos</li>
                </ol>
            </div>
        </div>
    </div>
</div>

<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card card-success card-outline card-tabs">
                    <div class="card-header p-0 pt-1 border-bottom-0">
                        <ul class="nav nav-tabs" id="tabptcliente" style="background-color: #28a745;" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link active" style="color: #000000;" id="tabReg1-tab"
                                   data-toggle="pill" href="#tabReg1" role="tab"
                                   aria-controls="tabReg1" aria-selected="true">LISTADO</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" style="color: #000000;" id="tabReg2-tab" data-toggle="pill"
                                   href="#tabReg2" role="tab" aria-controls="tabReg2"
                                   aria-selected="false">REGISTRO</a>
                            </li>
                        </ul>
                    </div>
                    <div class="card-body">
                        <div class="tab-content" >
                            <div class="tab-pane fade show active" id="tabReg1" role="tabpanel" >
                                <!--Contenedor de consulta-->
                                <div class="card card-success">
                                    <div class="card-header">
                                        <h3 class="card-title">Buscar expedientes</h3>

                                        <div class="card-tools">
                                            <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i></button>
                                        </div>
                                    </div>
                                    <div class="card-body">
                                        <form class="form-horizontal" id="frmBuscarTramite">
                                            <input name="idcliente" type="hidden" id="idcliente"
                                                   value="<?php echo $codcliente ?>">
                                            <input name="idusuario" type="hidden" id="idusuario"
                                                   value="<?php echo $idusuario; ?>">
                                            <input name="idrol" type="hidden" id="idrol"
                                                   value="<?php echo $idrol; ?>">
                                            <input name="idcia" type="hidden" id="idcia"
                                                   value="<?php echo $cia ?>">

                                            <div class="row"> <!--fila01-->
                                                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                                    <label for="cboTipobuscar" >Buscar por :</label>
                                                    <select id="cboTipobuscar" class="form-control select2bs4"
                                                            style="width: 100%;">
                                                        <option value="1" selected="selected">Hoy y Ayer</option>
                                                        <option value="2">Por Intervalo</option>
                                                        <option value="0">Todo</option>
                                                    </select>
                                                </div>
                                                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                                    <label for="FechaDesde" >Desde</label>

                                                    <div class="input-group">
                                                        <input type="text" class="form-control datepicker"
                                                               id="FechaDesde" name="FechaDesde"
                                                               value="" />
                                                        <div class="input-group-append" data-target="#FechaDesde" >
                                                            <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                                    <label for="FechaHasta" >Hasta</label>

                                                    <div class="input-group">
                                                        <input type="text" class="form-control datepicker"
                                                               id="FechaHasta" name="FechaHasta"
                                                               value="" />
                                                        <div class="input-group-append" data-target="#FechaHasta">
                                                            <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <br>

                                            <div class="row">
                                                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                                    <label for="cboProveedor" >Proveedor :</label>
                                                    <select id="cboProveedor" class="form-control"
                                                            style="width: 100%;"></select>
                                                </div>
                                                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                                    <label for="txtExpediente" ># Expediente :</label>
                                                    <input type="text" name="txtExpediente" id="txtExpediente"
                                                           class="form-control" value="">
                                                </div>
                                            </div>
                                            <br>
                                        </form>
                                    </div>
                                    <!--Contenedor de botones-->
                                    <div class="card-footer">
										<div class="d-flex flex-row justify-content-between" >
											<div class="col-sm-6 col-12 text-left">
												<button type="button" class="btn btn-success" id="btnExportar" >
													<i class="fa fa-fw fa-download"></i> Exportar registros
												</button>
											</div>
											<div class="col-sm-6 col-12 text-right">
												<button type="button" class="btn btn-default" id="btnBuscarListado">
													<i class="fa fa-fw fa-search"></i> Buscar
												</button>
												<button type="button" class="btn btn-primary" id="btnNuevoRegistro"><i
															class="fa fa-fw fa-file"></i> Nuevo expediente
												</button>
											</div>
										</div>
                                    </div>
                                </div>
                                <!--FIN Contenedor de consulta-->
                                <!--Contenedor del DataTable-->
                                <div class="card card-success">
                                    <div class="card-header with-border">
                                        <h3 class="card-title">Listado</h3>
                                    </div>
                                    <div class="card-body">
                                        <div>
                                            <table id="tbllistaexpedientes"  class="table table-striped table-bordered" style="width:100%">
                                                <thead>
                                                <tr>
                                                    <th>#</th>
                                                    <th>Expediente</th>
                                                    <th>Proveedor</th>
                                                    <th>Total</th>
                                                    <th>Fecha Ingreso</th>
                                                    <th>Fecha Limite</th>
                                                    <th>Rótulos</th>
                                                    <th>Ficha</th>
                                                    <th>Pdf</th>
                                                    <th>Estado</th>
                                                    <th></th>
                                                    <th></th>
                                                    <th></th>
                                                </tr>
                                                </thead>
                                                <tbody></tbody>
                                                <tfoot>
                                                <tr>
                                                    <th></th>
                                                </tr>
                                                </tfoot>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                                <!--FIN Contenedor del DataTable-->
                            </div>
                            <div class="tab-pane fade" id="tabReg2">
                                <?php $this->load->view('ar/evalprod/expediente/ingreso/vexpediente_formulario'); ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<?php $this->load->view('ar/evalprod/proveedor/vproveedor_formulario'); ?>
<?php $this->load->view('ar/evalprod/expediente/ingreso/vexpediente_ficha_modal'); ?>
<?php $this->load->view('ar/evalprod/expediente/ingreso/vexpediente_pdf_modal'); ?>
<?php $this->load->view('ar/evalprod/expediente/ingreso/vexpediente_rotulo_modal'); ?>
