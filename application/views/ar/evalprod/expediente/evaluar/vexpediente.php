<?php
$codcliente = $this->session->userdata('s_ccliente');
$idusuario = $this->session->userdata('s_idusuario');
$idrol = $this->session->userdata('s_idrol');
$cia = $this->session->userdata('s_cia');
?>

    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">
                        EVALUACIÓN DE EXPEDIENTE
                        <small>Módulo de Evaluación de Productos</small>
                    </h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a
                                href="<?php echo public_base_url(); ?>cprincipal/principal">Home</a>
                        </li>
                        <li class="breadcrumb-item">Eval. Prod.</li>
                        <li class="breadcrumb-item active">Evaluacion de Expedientes</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>

    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card card-success">
                        <div class="card-header">
                            <h3 class="card-title">Buscar expedientes</h3>

                            <div class="card-tools" style="display: none" >
                                <button type="button" class="btn btn-tool" id="btnAccionContenedorLista" data-card-widget="collapse"><i
                                        class="fas fa-minus"></i></button>
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
                                        <label for="cboTipobuscar">Buscar por :</label>
                                        <select id="cboTipobuscar" class="form-control select2bs4"
                                                style="width: 100%;">
                                            <option value="1" selected="selected">Hoy y Ayer</option>
                                            <option value="2">Por Intervalo</option>
                                            <option value="0">Todo</option>
                                        </select>
                                    </div>
                                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                        <label for="FechaDesde">Desde</label>

                                        <div class="input-group">
                                            <input type="text" class="form-control datepicker"
                                                   id="FechaDesde" name="FechaDesde"
                                                   value=""/>

                                            <div class="input-group-append" data-target="#FechaDesde">
                                                <div class="input-group-text"><i class="fa fa-calendar"></i>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                        <label for="FechaHasta">Hasta</label>

                                        <div class="input-group">
                                            <input type="text" class="form-control datepicker"
                                                   id="FechaHasta" name="FechaHasta"
                                                   value=""/>

                                            <div class="input-group-append" data-target="#FechaHasta">
                                                <div class="input-group-text"><i class="fa fa-calendar"></i>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                        <label for="cboProveedor">Proveedor :</label>
                                        <select id="cboProveedor" class="form-control"
                                                style="width: 100%;"></select>
                                    </div>
                                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                        <label for="txtExpediente"># Expediente :</label>
                                        <input type="text" name="txtExpediente" id="txtExpediente"
                                               class="form-control" value="">
                                    </div>
                                </div>
                                <br>
                            </form>
                        </div>
                        <!--Contenedor de botones-->
                        <div class="card-footer">
                            <div class="col-md-12 text-right">
                                <button type="button" class="btn btn-default" id="btnBuscarListado">
                                    <i class="fa fa-fw fa-search"></i> Buscar
                                </button>
                            </div>
                        </div>
                    </div>
                    <!--FIN Contenedor de consulta-->
                    <!--Contenedor del DataTable-->
                    <div class="card card-success" id="contenidoLista" >
                        <div class="card-header with-border">
                            <h3 class="card-title">Listado</h3>
                        </div>
                        <div class="card-body">
                            <div>
                                <table id="tbllistaexpedientes" class="display nowrap" style="width:100%">
                                    <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Expediente</th>
                                        <th>Proveedor</th>
                                        <th>Total</th>
                                        <th>Fecha Ingreso</th>
                                        <th>Fecha Limite</th>
                                        <th>Evaluar Exp.</th>
                                        <th>Envío @</th>
                                        <th>Estado</th>
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
            </div>
    </section>
    <section class="content" id="contenedorFormulario" style="display: none" >
        <div class="container-fluid">
            <div class="card card-success">
                <div class="card-body">
                    <?php $this->load->view('ar/evalprod/expediente/evaluar/vexpediente_formulario'); ?>
                </div>
            </div>
        </div>
    </section>

<?php $this->load->view('ar/evalprod/proveedor/vproveedor_formulario'); ?>
<?php $this->load->view('ar/evalprod/expediente/evaluar/vexpediente_estados'); ?>