<form class="form-horizontal" id="frmMantProducto"
      action="<?= base_url('ar/evalprod/cevaluar/guardar_producto') ?>" method="POST"
      enctype="multipart/form-data" role="form">
    <div class="row">
        <div class="col-xl-2 col-lg-2 col-md-4 col-sm-4 col-12">
            <div class="form-group">
                <label for="mtxtCodigoean">
                    Código EAN
                </label>
                <input type="text" class="form-control" disabled
                       id="mtxtCodigoean" name="mtxtCodigoean"
                       value="">
            </div>
        </div>
        <div class="col-xl-4 col-lg-4 col-md-8 col-sm-8 col-12">
            <div class="form-group">
                <label for="mtxtDescrip">
                    Descripción Producto
                </label>
                <input type="text" class="form-control" disabled
                       id="mtxtDescrip" name="mtxtDescrip"
                       value="">
            </div>
        </div>
        <div class="col-xl-2 col-lg-2 col-md-4 col-sm-4 col-12">
            <div class="form-group">
                <label for="mtxtMarca">
                    Marca
                </label>
                <input type="text" class="form-control" disabled
                       id="mtxtMarca" name="mtxtMarca"
                       value="">
            </div>
        </div>
        <div class="col-xl-4 col-lg-4 col-md-8 col-sm-8 col-12">
            <div class="form-group">
                <label for="mtxtPresent">
                    Presentación
                </label>
                <input type="text" class="form-control" disabled
                       id="mtxtPresent" name="mtxtPresent"
                       value="">
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-xl-3 col-lg-3 col-md-6 col-sm-6 col-12">
            <div class="form-group">
                <label for="mtxtFabri">
                    Fabricante
                </label>
                <input type="text" class="form-control" disabled
                       id="mtxtFabri" name="mtxtFabri"
                       value="">
            </div>
        </div>
        <div class="col-xl-3 col-lg-3 col-md-6 col-sm-6 col-12">
            <div class="form-group">
                <label for="mtxtNrodoc">
                    RS/NSO/RD
                </label>
                <div class="input-group" >
                    <div class="input-group-append" style="width: 5rem; min-width: 5rem;" >
                        <select name="cboTipodoc" id="cboTipodoc" aria-label="" title=""
                                class="custom-select" >
                            <option value="0" selected="selected">-- Elija --</option>
                            <option value="1">RS</option>
                            <option value="2">NSO</option>
                            <option value="3">AS</option>
                            <option value="4">RD</option>
                            <option value="5">NA</option>
                        </select>
                    </div>
                    <input type="text" class="form-control" disabled
                           id="mtxtNrodoc" name="mtxtNrodoc"
                           value="">
                </div>
            </div>
        </div>
        <div class="col-xl-2 col-lg-2 col-md-4 col-sm-4 col-12">
            <div class="form-group">
                <label for="FechaEmi">
                    Fecha Emisión
                </label>
                <input type="text" class="form-control" disabled
                       id="FechaEmi" name="FechaEmi"
                       value="">
            </div>
        </div>
        <div class="col-xl-2 col-lg-2 col-md-4 col-sm-4 col-12">
            <div class="form-group">
                <label for="FechaVence">
                    Fecha Venc.
                </label>
                <input type="text" class="form-control" disabled
                       id="FechaVence" name="FechaVence"
                       value="">
            </div>
        </div>
        <div class="col-xl-2 col-lg-2 col-md-4 col-sm-4 col-12">
            <div class="form-group">
                <label for="FechaEval">
                    Fecha Evaluado
                    <span class="fs-requerido text-danger">*</span>
                </label>

                <div class="input-group">
                    <input type="text" class="form-control datepicker" disabled
                           id="FechaEval" name="FechaEval"
                           value="">

                    <div class="input-group-append">
                        <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-xl-3 col-lg-3 col-md-6 col-sm-6 col-12">
            <div class="form-group">
                <label for="cboGrasaSatu">
                    Grasas Saturadas
                </label>
                <select class="custom-select" disabled
                        id="cboGrasaSatu" name="cboGrasaSatu">
                    <option value="" selected="selected"></option>
                    <option value="NA">NA</option>
                    <option value="SI">SI</option>
                    <option value="NO">NO</option>
                </select>
            </div>
        </div>
        <div class="col-xl-3 col-lg-3 col-md-6 col-sm-6 col-12">
            <div class="form-group">
                <label for="cboAzucar">
                    Azúcar
                </label>
                <select class="custom-select" disabled
                        id="cboAzucar" name="cboAzucar">
                    <option value="" selected="selected"></option>
                    <option value="NA">NA</option>
                    <option value="SI">SI</option>
                    <option value="NO">NO</option>
                </select>
            </div>
        </div>
        <div class="col-xl-3 col-lg-3 col-md-6 col-sm-6 col-12">
            <div class="form-group">
                <label for="cboSodio">
                    Sodio
                </label>
                <select class="custom-select" disabled
                        id="cboSodio" name="cboSodio">
                    <option value="" selected="selected"></option>
                    <option value="NA">NA</option>
                    <option value="SI">SI</option>
                    <option value="NO">NO</option>
                </select>
            </div>
        </div>
        <div class="col-xl-3 col-lg-3 col-md-6 col-sm-6 col-12">
            <div class="form-group">
                <label for="cboGrasaTrans">
                    Grasas Trans
                </label>
                <select class="custom-select" disabled
                        id="cboGrasaTrans" name="cboGrasaTrans">
                    <option value="" selected="selected"></option>
                    <option value="NA">NA</option>
                    <option value="SI">SI</option>
                    <option value="NO">NO</option>
                </select>
            </div>
        </div>
    </div>
    <div class="row">
		<div class="col-xl-6 col-lg-6 col-md-12 col-sm-12 col-12" >
			<div class="row" >
				<div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
					<div class="form-group">
						<label for="FechaLevanta">
							Fecha de levantamiento
							<span class="fs-requerido text-danger">*</span>
						</label>

						<div class="input-group">
							<input type="text" class="form-control datepicker" disabled
								   id="FechaLevanta" name="FechaLevanta"
								   value="">

							<div class="input-group-append">
								<div class="input-group-text"><i class="fa fa-calendar"></i></div>
							</div>
						</div>
					</div>
				</div>
				<div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
					<div class="form-group">
						<label for="mtxtTiempoEval">
							Tiempo de evaluación
							<span class="fs-requerido text-danger">*</span>
						</label>
						<input type="text" class="form-control" disabled
							   id="mtxtTiempoEval" name="mtxtTiempoEval"
							   value="">
					</div>
				</div>
				<div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12" >
					<div class="form-group">
						<label for="mtxtObservaCli">
							Observación para Tottus
						</label>
						<textarea name="mtxtObservaCli" id="mtxtObservaCli" disabled
								  class="form-control"
								  rows="2"></textarea>
					</div>
				</div>
			</div>
		</div>
		<div class="col-xl-6 col-lg-6 col-md-12 col-sm-12 col-12" >
			<div class="form-group">
				<label for="mtxtObserva">
					Observaciones
				</label>
				<textarea name="mtxtObserva" id="mtxtObserva" disabled
						  class="form-control"
						  rows="5"></textarea>
			</div>
        </div>
    </div>
    <div class="row">
        <div class="col-xl-8 col-lg-7 col-md-7 col-sm-12 col-12">
            <nav aria-label="Lista de Productos">
                <ul class="pagination" id="todosProductos"></ul>
            </nav>
        </div>
        <div class="col-xl-4 col-lg-5 col-md-5 col-sm-12 col-12 text-right">
            <button type="button" role="button" class="btn btn-info" id="btnActualizarProducto">
                <i class="fa fa-edit"></i> Actualizar Producto
            </button>
            <button type="button" class="btn btn-primary"
                    id="btnRetornarLista"><i
                    class="fa fa-fw fa-undo-alt"></i> Retornar
            </button>
        </div>
    </div>
</form>
