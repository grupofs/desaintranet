<div class="card-footer contenedorItems" style="display: none">
    <div class="row">
        <div class="col-md-6 text-left">
            <button type="button" class="btn btn-default" id="guardarCantidadProductos">
                <i class="fa fa-plus"></i> Agregar producto
            </button>
        </div>
        <div class="col-md-6 text-right">
            <div class="row">
                <div class="col-sm-10 d-flex align-items-center justify-content-end">
                    <label for="cboVarios" class="text-light-blue">Agregar productos</label>
                </div>
                <div class="col-sm-2">
                    <select id="cboVarios" name="cboVarios" class="form-control select2bs4"
                            style="width: 100%;">
                        <option value=1 selected="selected">1</option>
                        <option value=2>2</option>
                        <option value=3>3</option>
                        <option value=4>4</option>
                        <option value=5>5</option>
                        <option value=6>6</option>
                        <option value=7>7</option>
                        <option value=8>8</option>
                        <option value=9>9</option>
                        <option value=10>10</option>
                        <option value=11>11</option>
                        <option value=12>12</option>
                    </select>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row contenedorItems" style="display: none">
    <div class="col-md-12 col-md-offset-0">
        <div class="card card-success">
            <div class="card-header with-border">
                <h3 class="card-title">Listado</h3>
            </div>
            <div class="card-body">
                <div>
                    <table id="tbllistproductos" class="display nowrap" style="width:100%">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>Codigo EAN</th>
                            <th>Descripcion</th>
                            <th>Marca</th>
                            <th>Presentacion</th>
                            <th>Fabricante</th>
                            <th>RS/NSO/RD</th>
                            <th></th>
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

<div class="modal fade" id="modalRegProductos" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog modal-dialog-scrollable" role="document">
        <div class="modal-content">

            <div class="modal-header bg-success">
                <h5 class="modal-title w-100 font-weight-bold" id="myModalLabel">
                    Registrar Productos
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                        aria-hidden="true">&times;</span></button>
            </div>

            <div class="modal-body">
                <form class="form-horizontal well test-form toggle-disabled" id="frmRegProducto" name="frmRegProducto"
                      action="<?= base_url('ar/evalprod/cexpediente/guardar_producto') ?>" method="POST"
                      enctype="multipart/form-data"
                      role="form">
                    <input type="hidden" id="mhdnIdproductos" name="mhdnIdproductos" value="0">
                    <input type="hidden" id="mhdnAccionprod" name="mhdnAccionprod" value="A">

                    <div class="box-body">
                        <div class="form-group row">
                            <div class="col-sm-4">
                                <label for="mtxtCodigoean" class="text-light-blue">
                                    Código EAN
                                </label>

                                <input class="form-control" id="mtxtCodigoean" name="mtxtCodigoean" type="text">
                            </div>
                            <div class="col-sm-8">
                                <label for="mtxtDescrip" class="text-light-blue">
                                    Descripción
                                </label>

                                <input class="form-control" id="mtxtDescrip" name="mtxtDescrip" type="text">
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-sm-4">
                                <label for="mtxtMarca" class="text-light-blue">Marca</label>

                                <input class="form-control" id="mtxtMarca" name="mtxtMarca" type="text">
                            </div>
                            <div class="col-sm-8">
                                <label for="mtxtPresent" class="text-light-blue">Presentación</label>

                                <input class="form-control" id="mtxtPresent" name="mtxtPresent" type="text">
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-12">
                                <label for="mtxtFabri" class="text-light-blue">Fabricante</label>

                                <input class="form-control" id="mtxtFabri" name="mtxtFabri" type="text">
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-sm-4">
                                <label for="cboTipodoc" class="text-light-blue">Tipo Doc.</label>

                                <select id="cboTipodoc" name="cboTipodoc" class="form-control select2bs4"
                                        style="width: 100%;">
                                    <option value="0" selected="selected">-- Elija --</option>
                                    <option value="1">RS</option>
                                    <option value="2">NSO</option>
                                    <option value="3">AS</option>
                                    <option value="4">RD</option>
                                    <option value="5">NA</option>
                                </select>
                            </div>
                            <div class="col-sm-8">
                                <label for="mtxtNrodoc" class="text-light-blue">RS/NSO/RD</label>

                                <input class="form-control" id="mtxtNrodoc" name="mtxtNrodoc" type="text">
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-sm-6">
                                <label for="FechaEmi" class="text-light-blue">Fecha Emisión</label>
                                <input type="text" class="form-control"
                                       id="FechaEmi" name="FechaEmi"
                                       value="" />
                            </div>
                            <div class="col-sm-6">
                                <label for="FechaVence" class="text-light-blue">Fecha Venc.</label>
                                <input type="text" class="form-control"
                                       id="FechaVence" name="FechaVence"
                                       value="" />
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-sm-6">
                                <label for="cboGrasaSatu" class="text-light-blue">Grasas Saturadas</label>

                                <select id="cboGrasaSatu" name="cboGrasaSatu" class="form-control select2bs4"
                                        style="width: 100%;">
                                    <option value="" selected="selected"></option>
                                    <option value="SI">SI</option>
                                    <option value="NO">NO</option>
                                </select>
                            </div>
                            <div class="col-sm-6">
                                <label for="cboAzucar" class="text-light-blue">Azúcar</label>

                                <div>
                                    <select id="cboAzucar" name="cboAzucar" class="form-control select2bs4"
                                            style="width: 100%;">
                                        <option value="" selected="selected"></option>
                                        <option value="SI">SI</option>
                                        <option value="NO">NO</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-sm-6">
                                <label for="cboSodio" class="text-light-blue">Sodio</label>

                                <select id="cboSodio" name="cboSodio" class="form-control select2bs4"
                                        style="width: 100%;">
                                    <option value="" selected="selected"></option>
                                    <option value="SI">SI</option>
                                    <option value="NO">NO</option>
                                </select>
                            </div>
                            <div class="col-sm-6">
                                <label for="cboGrasaTrans" class="text-light-blue">Grasas Trans</label>

                                <select id="cboGrasaTrans" name="cboGrasaTrans" class="form-control select2bs4"
                                        style="width: 100%;">
                                    <option value="" selected="selected"></option>
                                    <option value="SI">SI</option>
                                    <option value="NO">NO</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-sm-12">
                                <label for="mtxtObserva" class="text-light-blue">Observaciones</label>
                                <textarea type="text" name="mtxtObserva" class="form-control" id="mtxtObserva" rows="3"
                                          cols="40"> </textarea>
                            </div>
                        </div>
                    </div>
                </form>
            </div>

            <div class="modal-footer bg-success">
                <button type="button" class="btn btn-light" id="mbtnCerrarProductos" data-dismiss="modal">
                    Cancelar
                </button>
                <button type="submit" class="btn btn-info" id="mbtnGuardarProductos">
                    <i class="fa fa-save"></i> Grabar
                </button>
            </div>
        </div>
    </div>
</div>