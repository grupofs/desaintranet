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
                    CONSULTA DE ÁREA
                    <small>Módulo de Evaluación de Productos</small>
                </h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="<?php echo public_base_url(); ?>cprincipal/principal">Home</a>
                    </li>
                    <li class="breadcrumb-item">Eval. Prod.</li>
                    <li class="breadcrumb-item active">Listar areas</li>
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
                                        <h3 class="card-title">Buscar Área</h3>

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
                                            <div class="row">
                                                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                                    <label for="txtNombre" >Nombre :</label>
                                                    <input type="text" name="txtNombre" id="txtNombre"
                                                           class="form-control" value="">
                                                </div>
                                            </div>
                                            <br>
                                        </form>
                                    </div>
                                    <!--Contenedor de botones-->
                                    <div class="card-footer">
                                        <div class="col-12 text-right">
                                            <button type="button" class="btn btn-default" id="btnBuscar">
                                                <i class="fa fa-fw fa-search"></i> Buscar
                                            </button>
                                            <button type="button" class="btn btn-primary" id="btnNuevoArea">
                                                <i class="fa fa-fw fa-plus"></i> Nueva Área
                                            </button>
                                        </div>
                                    </div>
                                </div>
                                <!--FIN Contenedor de consulta-->
                                <!--Contenedor del DataTable-->
                                <div class="card card-outline card-success">
                                    <div class="card-header">
                                        <h3 class="card-title">Listado</h3>
                                    </div>
                                    <div class="card-body">
                                        <div>
                                            <table id="tblLista" class="table table-striped table-bordered" style="width:100%">
                                                <thead>
                                                <tr>
                                                    <th style="width: 25px" >#</th>
                                                    <th>Área</th>
                                                    <th style="width: 120px" >Estado</th>
                                                    <th style="width: 50px;" ></th>
                                                    <th style="width: 50px;" ></th>
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
                            </div>
                            <div class="tab-pane fade" id="tabReg2" role="tabpanel" >
                                <?php $this->load->view('ar/evalprod/area/varea_formulario'); ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>