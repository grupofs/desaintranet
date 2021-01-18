<form class="form-horizontal" id="frmMantEvaluar"
      action="<?= base_url('ar/evalprod/cevaluar/guardar') ?>" method="POST"
      enctype="multipart/form-data" role="form">
    <input type="hidden" class="d-none" name="id_evaluador" id="id_evaluador" >
    <div class="row">
        <div class="col-xl-2 col-lg-2 col-md-4 col-sm-4 col-12">
            <div class="form-group">
                <label for="cboc_f">
                    Lic. funcionamiento
                </label>
                <select name="cboc_f" id="cboc_f" class="custom-select" >
                    <option value=""></option>
                    <option value="1">C</option>
                    <option value="2">NC</option>
                    <option value="3">NA</option>
                </select>
            </div>
        </div>
        <div class="col-xl-2 col-lg-2 col-md-4 col-sm-4 col-12" >
            <div class="form-group">
                <label for="cbon_r">
                    Nro RUC
                </label>
                <select name="cbon_r" id="cbon_r" class="custom-select" >
                    <option value=""></option>
                    <option value="1">C</option>
                    <option value="2">NC</option>
                </select>
            </div>
        </div>
        <div class="col-xl-2 col-lg-2 col-md-4 col-sm-4 col-12" >
            <div class="form-group">
                <label for="cbof_v">
                    Fec. Vence
                </label>
                <select name="cbof_v" id="cbof_v" class="custom-select" >
                    <option value=""></option>
                    <option value="1">C</option>
                    <option value="2">NC</option>
                    <option value="3">NA</option>
                </select>
            </div>
        </div>
        <div class="col-xl-2 col-lg-2 col-md-4 col-sm-4 col-12" >
            <div class="form-group">
                <label for="cboc_l_p">
                    Cod. Lote Prod.
                </label>
                <select name="cboc_l_p" id="cboc_l_p" class="custom-select" >
                    <option value=""></option>
                    <option value="1">C</option>
                    <option value="2">NC</option>
                    <option value="3">NA</option>
                </select>
            </div>
        </div>
        <div class="col-xl-2 col-lg-2 col-md-4 col-sm-4 col-12" >
            <div class="form-group">
                <label for="cbol_i">
                    Lista Ingred.
                </label>
                <select name="cbol_i" id="cbol_i" class="custom-select" >
                    <option value=""></option>
                    <option value="1">C</option>
                    <option value="2">NC</option>
                    <option value="3">NA</option>
                </select>
            </div>
        </div>
        <div class="col-xl-2 col-lg-2 col-md-4 col-sm-4 col-12" >
            <div class="form-group">
                <label for="cboc_c_p">
                    Cond. Cons. Produc.
                </label>
                <select name="cboc_c_p" id="cboc_c_p" class="custom-select" >
                    <option value=""></option>
                    <option value="1">C</option>
                    <option value="2">NC</option>
                    <option value="3">NA</option>
                </select>
            </div>
        </div>
    </div>
    <div class="row" >
        <div class="col-xl-4 col-lg-4 col-md-4 col-sm-6 col-12" >
            <div class="form-group">
                <label for="mtxtc_c">
                    Condiciones conservación completa(transp., almac., produc.)
                </label>
                <textarea name="mtxtc_c" id="mtxtc_c" class="form-control" rows="5"></textarea>
            </div>
        </div>
        <div class="col-xl-4 col-lg-4 col-md-4 col-sm-6 col-12" >
            <div class="form-group">
                <label for="mtxtc_c_r">
                    Condiciones de conservación del producto
                </label>
                <textarea name="mtxtc_c_r" id="mtxtc_c_r" class="form-control" rows="5"></textarea>
            </div>
        </div>
        <div class="col-xl-4 col-lg-4 col-md-4 col-sm-12 col-12" >
            <div class="form-group">
                <label for="cboPais">
                    Pais
                    <span class="fs-requerido text-danger">*</span>
                </label>
                <select name="cboPais" id="cboPais" class="custom-select" ></select>
            </div>
        </div>
    </div>
    <div class="row" >
        <div class="col-xl-2 col-lg-2 col-md-4 col-sm-4 col-12" >
            <div class="form-group">
                <label for="cboc_n">
                    Cont. Neto
                </label>
                <select name="cboc_n" id="cboc_n" class="custom-select" >
                    <option value=""></option>
                    <option value="1">C</option>
                    <option value="2">NC</option>
                </select>
            </div>
        </div>
        <div class="col-xl-2 col-lg-2 col-md-4 col-sm-4 col-12" >
            <div class="form-group">
                <label for="cbod_i">
                    Dir. Import.
                </label>
                <select name="cbod_i" id="cbod_i" class="custom-select" >
                    <option value=""></option>
                    <option value="1">C</option>
                    <option value="2">NC</option>
                    <option value="3">NA</option>
                </select>
            </div>
        </div>
        <div class="col-xl-2 col-lg-2 col-md-4 col-sm-4 col-12" >
            <div class="form-group">
                <label for="mtxtt_v_u">
                    Tiempo de Vida Util
                </label>
                <div class="input-group" >
                    <input type="text" class="form-control"
                           id="mtxtt_v_u" name="mtxtt_v_u"
                           value="" >
                    <div class="input-group-prepend" >
                        <select name="cbotiempo_m" id="cbotiempo_m" class="custom-select"
                                style="width: 100px"
                                title="" >
                            <option value="1">Dias</option>
                            <option value="2">Meses</option>
                            <option value="3">Años</option>
                            <option value="4">NA</option>
                        </select>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-2 col-lg-2 col-md-4 col-sm-4 col-12" >
            <div class="form-group">
                <label for="Fechaf_i_h">
                    F. Insp. H. S.
                </label>
				<input type="text" class="form-control"
					   id="Fechaf_i_h" name="Fechaf_i_h"
					   value="" >
            </div>
        </div>
        <div class="col-xl-2 col-lg-2 col-md-4 col-sm-4 col-12" >
            <div class="form-group">
                <label for="mtxtentidad">
                    Entidad
                </label>
                <input type="text" class="form-control"
                       id="mtxtentidad" name="mtxtentidad"
                       value="" >
            </div>
        </div>
        <div class="col-xl-2 col-lg-2 col-md-4 col-sm-4 col-12" >
            <div class="form-group">
                <label for="mtxtresponsable">
                    Responsable
                </label>
                <input type="text" class="form-control"
                       id="mtxtresponsable" name="mtxtresponsable"
                       value="" >
            </div>
        </div>
    </div>
    <div class="row" >
        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12" >
            <div class="form-group" >
                <label for="mtxtobservacion">
                    Observaciones
                </label>
                <textarea name="mtxtobservacion" id="mtxtobservacion" class="form-control" rows="5"></textarea>
            </div>
        </div>
        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12" >
            <div class="form-group" >
                <label for="mtxtacuerdos">
                    Acuerdos con el proveedor y/o levantamientos de observaciones
                </label>
                <textarea name="mtxtacuerdos" id="mtxtacuerdos" class="form-control" rows="5"></textarea>
            </div>
        </div>
    </div>
    <div class="row" >
        <div class="col-xl-2 col-lg-2 col-md-4 col-sm-4 col-12" >
            <div class="form-group">
                <label for="Fechafecha">
                    Fecha
                </label>
                <div class="input-group">
                    <input type="text" class="form-control datepicker"
                           id="Fechafecha" name="Fechafecha"
                           value="">

                    <div class="input-group-append">
                        <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-2 col-lg-2 col-md-4 col-sm-4 col-12" >
            <div class="form-group">
                <label for="cbostatus">
                    Status
                    <span class="fs-requerido text-danger">*</span>
                </label>
                <select id="cbostatus" name="cbostatus" class="custom-select" >
                    <option value="0">EN PROCESO</option>
                    <option value="1">APROBADO</option>
                    <option value="2">RECHAZADO</option>
                    <option value="3">OBSERVADO</option>
                    <option value="4">Pendiente Vida Util</option>
                </select>
            </div>
        </div>
        <div class="col-xl-2 col-lg-2 col-md-4 col-sm-4 col-12" >
            <div class="form-group">
                <label for="cboa_s">
                    Agota. Stock
                </label>
                <select id="cboa_s" name="cboa_s" class="custom-select" >
                    <option value="0"></option>
                    <option value="1">SI</option>
                    <option value="2">NA</option>
                </select>
            </div>
        </div>
        <div class="col-xl-2 col-lg-2 col-md-4 col-sm-4 col-12" >
            <div class="form-group">
                <label for="mtxtf_e_a_s">
                    F. Emi. Agota. Stock
                </label>
                <input type="text" class="form-control"
                       id="mtxtf_e_a_s" name="mtxtf_e_a_s"
                       value="" >
            </div>
        </div>
        <div class="col-xl-2 col-lg-2 col-md-4 col-sm-4 col-12" >
            <div class="form-group">
                <label for="mtxtf_a_v_s">
                    F. Venci. Agota Stock
                </label>
                <input type="text" class="form-control"
                       id="mtxtf_a_v_s" name="mtxtf_a_v_s"
                       value="" >
            </div>
        </div>
        <div class="col-xl-2 col-lg-2 col-md-4 col-sm-4 col-12" >
            <div class="form-group">
                <label for="cbod_p">
                    Docum. Pendiente
                </label>
                <select id="cbod_p" name="cbod_p" class="custom-select" >
                    <option value="0"></option>
                    <option value="1">SI</option>
                    <option value="2">NO</option>
                </select>
            </div>
        </div>
    </div>
    <div class="row" >
        <div class="col-xl-2 col-lg-2 col-md-4 col-sm-4 col-12" >
            <div class="form-group">
                <label for="cboo_l">
                    Obser. Licencia
                </label>
                <select id="cboo_l" name="cboo_l" class="custom-select" >
                    <option value="0"></option>
                    <option value="1">SI</option>
                    <option value="2">NO</option>
                    <option value="3">NA</option>
                </select>
            </div>
        </div>
        <div class="col-xl-2 col-lg-2 col-md-4 col-sm-4 col-12" >
            <div class="form-group">
                <label for="cboo_n">
                    Obser. x T.Nutr.
                </label>
                <select id="cboo_n" name="cboo_n" class="custom-select" >
                    <option value="0"></option>
                    <option value="1">SI</option>
                    <option value="2">NO</option>
                    <option value="3">NA</option>
                </select>
            </div>
        </div>
    </div>
    <div class="w-100 text-right mt-2" >
        <button type="button" class="btn btn-info" id="btnEvaluacion" >
            <i class="fa fa-save" ></i> Guardar Evaluación
        </button>
    </div>
</form>
