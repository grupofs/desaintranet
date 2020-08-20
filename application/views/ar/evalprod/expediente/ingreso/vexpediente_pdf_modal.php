<div class="modal fade" id="modalSubirPDF" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog modal-dialog-scrollable" role="document">
        <div class="modal-content">
            <div class="modal-header bg-success">
                <h5 class="modal-title fs w-100 font-weight-bold">
                    Subir PDF
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                        aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body"
                 style="background-color:#ffffff; border-top: 1px solid #00a65a; border-bottom: 1px solid #00a65a;">
                <form class="form-horizontal well test-form toggle-disabled" id="frmPDF" name="frmPDF"
                      action="<?= base_url('ar/evalprod/cexpediente/guardar_pdf') ?>" method="POST"
                      enctype="multipart/form-data" accept-charset="UTF-8"
                      role="form">
                    <input type="hidden" id="pdf_id_expediente" name="pdf_id_expediente" value="0">

                    <div class="box-body">
                        <div class="form-group" >
                            <div class="custom-file">
                                <input type="file" class="custom-file-input"
                                       id="pdf_arhivo" name="pdf_arhivo"
                                       accept="application/pdf"
                                       value="" />
                                <label class="custom-file-label" data-browse="Examinar..."
                                       for="pdf_arhivo">Elegir PDF</label>
                                <small class="text-muted" >Asegurese de elegir un PDF</small>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer bg-success">
                <button type="reset" class="btn btn-light" data-dismiss="modal" id="btnCancelarPDF" >
                    Cancelar
                </button>
                <button type="submit" class="btn btn-info" id="btnGuardarPDF">
                    <i class="fa fa-cloud-upload-alt"></i>
                    Subir Ficha
                </button>
            </div>
        </div>
    </div>
</div>