<!--Contenedor de Registro-->
<form class="form-horizontal" id="frmMantRegistro"
      action="<?= base_url('ar/evalprod/cexpediente/guardar') ?>" method="POST"
      enctype="multipart/form-data" role="form">
    <fieldset class="scheduler-border">
        <legend class="scheduler-border text-primary">Datos</legend>
        <div class="box-body">
            <input type="hidden" id="hdnIdexpe" name="hdnIdexpe" value="0">
            <input type="hidden" id="hdnAccion" name="hdnAccion" value="G">
            <!-- ACCION -->
            <div class="form-group row">
                <div class="col-sm-2 labelcol">
                    <label for="FechaReg" class="text-light-blue">Fecha:</label>
                </div>
                <div class="col-sm-4">
                    <div class="input-group">
                        <input type="text" class="form-control datepicker"
                               id="FechaReg" name="FechaReg"
                               value="<?php echo date('d/m/Y'); ?>">

                        <div class="input-group-append">
                            <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-2 labelcol">
                    <label for="txtexpe" class="text-light-blue">Expediente:</label>
                </div>
                <div class="col-sm-4">
                    <input type="text" class="form-control" name="txtexpe"
                           id="txtexpe" readonly>
                </div>
            </div>
            <div class="form-group row">
                <div class="col-sm-2 labelcol">
                    <label for="cboProveedorreg" class="text-light-blue">
                        Proveedor <span class="fs-requerido text-danger">*</span>:
                    </label>
                </div>
                <div class="col-sm-10">
                    <div class="row">
                        <div class="col-sm-10 col-12">
                            <select id="cboProveedorreg" name="cboProveedorreg"
                                    class="form-control"
                                    style="width: 98%;">
                            </select>
                        </div>
                        <div class="col-sm-2 col-12">
                            <button type="button" class="btn btn-info btn-block"
                                    id="btnNuevoProveedor">
                                <i class="fa fa-plus"></i> Crear
                            </button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="form-group row">
                <div class="col-sm-2 labelcol">
                    <label for="txtcontac1" class="text-light-blue">Contacto1:</label>
                </div>
                <div class="col-sm-4">
                    <input type="text" class="form-control"
                           name="txtcontac1" id="txtcontac1" readonly>
                </div>
                <div class="col-sm-2 labelcol">
                    <label for="txtemail1" class="text-light-blue">Email1:</label>
                </div>
                <div class="col-sm-4">
                    <input type="text" class="form-control" name="txtemail1"
                           id="txtemail1" readonly>
                </div>
            </div>
            <div class="form-group row">
                <div class="col-sm-2 labelcol">
                    <label for="txtcontac2" class="text-light-blue">Contacto2:</label>
                </div>
                <div class="col-sm-4">
                    <input type="text" class="form-control"
                           name="txtcontac2" id="txtcontac2" readonly>
                </div>
                <div class="col-sm-2 labelcol">
                    <label for="txtemail2" class="text-light-blue">Email2:</label>
                </div>
                <div class="col-sm-4">
                    <input type="text" class="form-control" name="txtemail2"
                           id="txtemail2" readonly>
                </div>
            </div>
            <div class="form-group row">
                <div class="col-sm-2 labelcol">
                    <label for="cboAreareg" class="text-light-blue">
                        Área <span class="fs-requerido text-danger">*</span>:
                    </label>
                </div>
                <div class="col-sm-4">
                    <select id="cboAreareg" name="cboAreareg"
                            class="form-control select2"
                            style="width: 100%;">
                    </select>
                </div>
                <div class="col-sm-2 labelcol">
                    <label for="cboContacto" class="text-light-blue">
                        Contac. TOTTUS:
                    </label>
                </div>
                <div class="col-sm-4">
                    <input type="hidden" class="d-none" id="hdnContactotottus"
                           name="hdnContactotottus">
                    <select id="cboContacto" name="cboContacto"
                            class="form-control select"
                            style="width: 100%;">
                    </select>
                </div>
            </div>
            <fieldset class="scheduler-border">
                <legend class="scheduler-border text-primary">Documentos <span class="fs-requerido text-danger">*</span>
                </legend>
                <div class="box-body">
                    <div class="row">
                        <div class="col-xl-4 col-lg-4 col-md-4 col-sm-4 col-12">
                            <div class="custom-control custom-checkbox">
                                <input type="checkbox" class="custom-control-input"
                                       id="documentos[0]" name="documentos[0]"
                                       value="1" checked/>
                                <label for="documentos[0]" class="custom-control-label">Muestra</label>
                            </div>
                        </div>
                        <div class="col-xl-4 col-lg-4 col-md-4 col-sm-4 col-12">
                            <div class="custom-control custom-checkbox">
                                <input type="checkbox" class="custom-control-input"
                                       id="documentos[1]" name="documentos[1]"
                                       value="2"/>
                                <label for="documentos[1]" class="custom-control-label">Tecnica</label>
                            </div>
                        </div>
                        <div class="col-xl-4 col-lg-4 col-md-4 col-sm-4 col-12">
                            <div class="custom-control custom-checkbox">
                                <input type="checkbox" class="custom-control-input"
                                       id="documentos[2]" name="documentos[2]"
                                       value="3"/>
                                <label for="documentos[2]" class="custom-control-label">RS/NSO/RD</label>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xl-4 col-lg-4 col-md-4 col-sm-4 col-12">
                            <div class="custom-control custom-checkbox">
                                <input type="checkbox" class="custom-control-input"
                                       id="documentos[3]" name="documentos[3]"
                                       value="4"/>
                                <label for="documentos[3]" class="custom-control-label">Hoja de
                                    Seguridad</label>
                            </div>
                        </div>
                        <div class="col-xl-4 col-lg-4 col-md-4 col-sm-4 col-12">
                            <div class="custom-control custom-checkbox">
                                <input type="checkbox" class="custom-control-input"
                                       id="documentos[4]" name="documentos[4]"
                                       value="5"/>
                                <label for="documentos[4]" class="custom-control-label">Licencia de
                                    Funcionamiento</label>
                            </div>
                        </div>
                        <div class="col-xl-4 col-lg-4 col-md-4 col-sm-4 col-12">
                            <div class="custom-control custom-checkbox">
                                <input type="checkbox" class="custom-control-input"
                                       id="documentos[5]" name="documentos[5]"
                                       value="6"/>
                                <label for="documentos[5]" class="custom-control-label">Inspeccion Higienico
                                    Sanitario</label>
                            </div>
                        </div>
                        <div class="col-xl-4 col-lg-4 col-md-4 col-sm-4 col-12">
                            <div class="custom-control custom-checkbox">
                                <input type="checkbox" class="custom-control-input"
                                       id="documentos[6]" name="documentos[6]"
                                       value="7"/>
                                <label for="documentos[6]" class="custom-control-label">Otros</label>
                            </div>
                        </div>
                    </div>
                </div>
            </fieldset>
            <div class="form-group row justify-content-end">
                <div class="col-sm-6 text-right">
                    <button type="button" id="btnGrabar"
                            class="btn btn-success">
                        <i class="fa fa-save"></i>
                        <span>Guardar registro</span>
                    </button>
                    <button type="button" class="btn btn-primary"
                            id="btnRetornarLista"><i
                            class="fa fa-fw fa-undo-alt"></i> Retornar
                    </button>
                </div>
            </div>
        </div>
    </fieldset>
</form>
<!--Contenedor de botones-->
<?php $this->load->view('ar/evalprod/expediente/ingreso/vexpediente_productos'); ?>
