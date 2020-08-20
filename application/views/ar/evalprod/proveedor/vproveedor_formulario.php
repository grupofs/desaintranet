<div class="modal fade" id="modalNuevoProveedor" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog modal-dialog-scrollable" role="document">
        <div class="modal-content">
            <div class="modal-header bg-success">
                <h5 class="modal-title fs w-100 font-weight-bold">
                    Registrar Proveedor
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                        aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body"
                 style="background-color:#ffffff; border-top: 1px solid #00a65a; border-bottom: 1px solid #00a65a;">
                <form class="form-horizontal well test-form toggle-disabled" id="frmRegProveedor" name="frmRegProveedor"
                      action="<?= base_url('ar/evalprod/cproveedor/guardar') ?>" method="POST"
                      enctype="multipart/form-data"
                      role="form">
                    <input type="hidden" id="mhdnIdproveedor" name="mhdnIdproveedor" value="0">
                    <input type="hidden" id="mhdnAccionprov" name="mhdnAccionprov" value="G">

                    <div class="box-body">
                        <div class="form-group row">
                            <div class="col-sm-12">
                                <label for="mtxtProveedor" class="text-light-black">
                                    Proveedor <span class="fs-requerido text-danger">*</span>
                                </label>
                                <input class="form-control" id="mtxtProveedor" name="mtxtProveedor">
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-sm-3">
                                <label for="mtxtRUC" class="text-light-black">
                                    Nro. RUC
                                    <span class="fs-requerido text-danger">*</span>
                                </label>
                            </div>
                            <div class="col-sm-9">
                                <input class="form-control" id="mtxtRUC" name="mtxtRUC">
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-sm-3">
                                <label for="mtxtContactop" class="text-light-black">
                                    Contacto 1
                                    <span class="fs-requerido text-info">*</span>
                                </label>
                            </div>
                            <div class="col-sm-9">
                                <input class="form-control" id="mtxtContactop" name="mtxtContactop">
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-sm-3">
                                <label for="mtxtEmailp" class="text-light-black">
                                    Email 1
                                </label>
                            </div>
                            <div class="col-sm-9">
                                <input class="form-control" id="mtxtEmailp" name="mtxtEmailp">
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-sm-3">
                                <label for="mtxtContactoq" class="text-light-black">
                                    Contacto 2
                                    <span class="fs-requerido text-info">*</span>
                                </label>
                            </div>
                            <div class="col-sm-9">
                                <input class="form-control" id="mtxtContactoq" name="mtxtContactoq">
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-sm-3">
                                <label for="mtxtEmailq" class="text-light-black">Email 2</label>
                            </div>
                            <div class="col-sm-9">
                                <input class="form-control" id="mtxtEmailq" name="mtxtEmailq">
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-sm-3">
                                <label for="mtxtTelefono" class="text-light-black">Teléfono</label>
                            </div>
                            <div class="col-sm-9">
                                <input class="form-control" id="mtxtTelefono" name="mtxtTelefono">
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer bg-success">
                <button type="reset" class="btn btn-light" id="mbtnCerrarModalProv" data-dismiss="modal">
                    Cancelar
                </button>
                <button type="submit" class="btn btn-info" id="mbtnGuardarModalProv">
                    <i class="fa fa-save"></i>
                    Grabar
                </button>
            </div>
        </div>
    </div>
</div>