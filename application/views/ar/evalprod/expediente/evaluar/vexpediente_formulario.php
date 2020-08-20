<input type="hidden" id="hdnIdexpe" name="hdnIdexpe" value="0">
<input type="hidden" id="mhdnIdproductos" name="mhdnIdproductos" value="0">
<input type="hidden" id="id_proveedor" value="0">

<div class="row justify-content-center">
    <div class="col-xl-10 col-lg-10 col-md-11 col-sm-12 col-12">
        <fieldset class="scheduler-border">
            <legend class="scheduler-border text-primary">Datos Expediente</legend>
            <div class="box-body">
                <div class="row">
                    <div class="col-xl-2 col-lg-2 col-md-3 col-sm-4 col-4">
                        <div class="form-group">
                            <label for="txtFecha">
                                Fecha:
                            </label>

                            <div class="input-group">
                                <input type="text" class="form-control" readonly
                                       id="txtFecha"
                                       value="">

                                <div class="input-group-append">
                                    <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-3 col-lg-4 col-md-4 col-sm-8 col-8">
                        <div class="form-group">
                            <label for="txtCodigoExpediente">
                                Expediente:
                            </label>
                            <input type="text" class="form-control" readonly
                                   id="txtCodigoExpediente"
                                   value="">
                        </div>
                    </div>
                    <div class="col-xl-7 col-lg-6 col-md-5 col-sm-12 col-12">
                        <div class="form-group">
                            <label for="txtProveedor">
                                Proveedor:
                            </label>
                            <div class="input-group" >
                                <input type="text" class="form-control" readonly
                                       id="txtProveedor"
                                       value="">
                                <div class="input-group-prepend" >
                                    <button type="button" class="btn btn-info" id="btnEditarProveedor">
                                        <i class="fa fa-edit" ></i> Editar
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </fieldset>
    </div>
</div>
<div class="card card-success">
    <div class="card-header with-border">
        <h3 class="card-title">Datos del Producto</h3>
        <div class="card-tools">
            <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i></button>
        </div>
    </div>
    <div class="card-body">
        <?php $this->load->view('ar/evalprod/expediente/evaluar/vexpediente_producto'); ?>
    </div>
</div>
<div class="card card-success" id="contenedorEvaluar" style="display: none" >
    <div class="card-header with-border">
        <h3 class="card-title">Datos a Evaluar</h3>
    </div>
    <div class="card-body">
        <?php $this->load->view('ar/evalprod/expediente/evaluar/vexpediente_evaluar'); ?>
    </div>
</div>