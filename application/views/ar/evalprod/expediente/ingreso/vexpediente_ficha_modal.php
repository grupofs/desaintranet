<div class="modal fade" id="modalSubirFicha" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog modal-dialog-scrollable" role="document">
        <div class="modal-content">
            <div class="modal-header bg-success">
                <h5 class="modal-title fs w-100 font-weight-bold">
                    Subir ficha
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                        aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body"
                 style="background-color:#ffffff; border-top: 1px solid #00a65a; border-bottom: 1px solid #00a65a;">
                <form class="form-horizontal well test-form toggle-disabled" id="frmFicha" name="frmFicha"
                      action="<?= base_url('ar/evalprod/cexpediente/guardar_ficha') ?>" method="POST"
                      enctype="multipart/form-data" accept-charset="UTF-8"
                      role="form">
                    <input type="hidden" id="ficha_id_expediente" name="ficha_id_expediente" value="0">

                    <div class="box-body">
                        <div class="form-group" >
                            <div class="custom-file">
                                <input type="file" class="custom-file-input"
                                       id="ficha_arhivo" name="ficha_arhivo"
                                       accept="application/pdf"
                                       value="" />
                                <label class="custom-file-label" data-browse="Examinar..."
                                       for="ficha_arhivo">Elegir ficha</label>
                                <small class="text-muted" >Asegurese de elegir un PDF</small>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer bg-success">
                <button type="reset" class="btn btn-light" data-dismiss="modal" id="btnCancelarFicha" >
                    Cancelar
                </button>
                <button type="submit" class="btn btn-info" id="btnGuardarFicha">
                    <i class="fa fa-cloud-upload-alt"></i>
                    Subir Ficha
                </button>
            </div>
        </div>
    </div>
</div>