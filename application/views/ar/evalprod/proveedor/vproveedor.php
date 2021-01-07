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
                    CONSULTA DE PROVEEDORES
                </h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="<?php echo public_base_url(); ?>cprincipal/principal">Home</a>
                    </li>
                    <li class="breadcrumb-item active">Evaluación Productos</li>
                </ol>
            </div>
        </div>
    </div>
</div>

<section class="content">
    <div class="container-fluid">
        <div class="card card-success">
                                    <div class="card-header">
                                        <h3 class="card-title">Buscar Proveedores</h3>

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
                                                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                                    <label for="txtRuc" >RUC :</label>
                                                    <input type="text" name="txtRuc" id="txtRuc"
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
                                            <button type="button" class="btn btn-primary" id="btnNuevoProveedor">
                                                <i class="fa fa-fw fa-plus"></i> Nuevo Proveedor
                                            </button>
                                        </div>
                                    </div>
        </div>
                                <!--FIN Contenedor de consulta-->
                                <!--Contenedor del DataTable-->
        <div class="row">
            <div class="col-12">
                <div class="card card-outline card-success">
                                    <div class="card-header">
                                        <h3 class="card-title">Listado</h3>
                                    </div>
                                    <div class="card-body">
                                        <div>
                                            <table id="tblLista"  class="table table-striped table-bordered" style="width:100%">
                                                <thead>
                                                <tr>
                                                    <th>#</th>
                                                    <th>Proveedor</th>
                                                    <th>RUC</th>
                                                    <th>Contacto 1</th>
                                                    <th>Email 1</th>
                                                    <th>Contacto 2</th>
                                                    <th>Email 2</th>
                                                    <th>Télefono</th>
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
            </div>
        </div>
    </div>
</section>

<?php $this->load->view('ar/evalprod/proveedor/vproveedor_formulario'); ?>