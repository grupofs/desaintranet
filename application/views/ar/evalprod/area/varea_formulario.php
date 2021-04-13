<form class="form-horizontal well test-form toggle-disabled" id="frmRegArea" name="frmRegArea"
      action="<?= base_url('ar/evalprod/carea/guardar') ?>" method="POST"
      enctype="multipart/form-data"
      role="form">
    <input type="hidden" id="area_id" name="area_id" value="0">

    <div class="box-body">
        <div class="row" >
			<div class="col-xl-8 col-lg-8 col-md-8 col-sm-12 col-12" >
				<div class="form-group" >
					<label for="area_nombre">
						Área
						<span class="fs-requerido text-danger">*</span>
					</label>
					<input type="text" maxlength="150" class="form-control"
						   id="area_nombre" name="area_nombre" readonly
						   value="" >
				</div>
			</div>
			<div class="col-xl-4 col-lg-4 col-md-4 col-sm-12 col-12" >
				<div class="form-group" >
					<label for="area_estado">
						Estado
					</label>
					<select name="area_estado" id="area_estado" class="custom-select d-block" style="width: 100% !important;" >
						<option value="1">Activo</option>
						<option value="2">Inactivo</option>
					</select>
				</div>
			</div>
		</div>
        <div class="table-responsible" >
            <table class="table table-bordered table-hover" id="tblContacto" >
                <thead class="bg-light" >
                <tr>
                    <th>
                        Contacto TOTTUS
                        <span class="fs-requerido text-danger">*</span>
                    </th>
                    <th>Email</th>
                    <th>Estado</th>
                    <th style="width: 35px; min-width: 35px" ></th>
                </tr>
                </thead>
                <tbody>

                </tbody>
                <tfoot>
                <tr>
                    <th colspan="5" class="text-left" >
                        <button type="button" role="button" class="btn btn-link" id="btnAgregarContacto" >
                            <i class="fa fa-plus" ></i> Agregar nuevo contacto
                        </button>
                    </th>
                </tr>
                </tfoot>
            </table>
        </div>
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
</form>
