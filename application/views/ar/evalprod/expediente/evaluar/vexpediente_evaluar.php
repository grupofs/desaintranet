<form class="form-horizontal" id="frmMantEvaluar"
      action="<?= base_url('ar/evalprod/cevaluar/guardar') ?>" method="POST"
      enctype="multipart/form-data" role="form">
    <input type="hidden" class="d-none" name="id_evaluador" id="id_evaluador"
		   value="<?php echo (isset($evaluacion->id_evaluador)) ? $evaluacion->id_evaluador : '' ?>" >
    <div class="row">
        <div class="col-xl-2 col-lg-2 col-md-4 col-sm-4 col-12">
            <div class="form-group">
                <label for="cboc_f">
                    Lic. funcionamiento
                </label>
                <select name="cboc_f" id="cboc_f" class="custom-select" style="width: 100% !important;" >
                    <option value=""
							<?php echo (isset($evaluacion->c_f) && $evaluacion->c_f == '') ? 'selected' : '' ?>></option>
                    <option value="1"
							<?php echo (isset($evaluacion->c_f) && $evaluacion->c_f == '1') ? 'selected' : '' ?>>C</option>
                    <option value="2"
							<?php echo (isset($evaluacion->c_f) && $evaluacion->c_f == '2') ? 'selected' : '' ?>>NC</option>
                    <option value="3"
							<?php echo (isset($evaluacion->c_f) && $evaluacion->c_f == '3') ? 'selected' : '' ?>>NA</option>
                </select>
            </div>
        </div>
        <div class="col-xl-2 col-lg-2 col-md-4 col-sm-4 col-12" >
            <div class="form-group">
                <label for="cbon_r">
                    Nro RUC
                </label>
                <select name="cbon_r" id="cbon_r" class="custom-select" style="width: 100% !important;" >
                    <option value=""
							<?php echo (isset($evaluacion->n_r) && $evaluacion->n_r == '') ? 'selected' : '' ?>></option>
                    <option value="1"
							<?php echo (isset($evaluacion->n_r) && $evaluacion->n_r == '1') ? 'selected' : '' ?>>C</option>
                    <option value="2"
							<?php echo (isset($evaluacion->n_r) && $evaluacion->n_r == '2') ? 'selected' : '' ?>>NC</option>
                </select>
            </div>
        </div>
        <div class="col-xl-2 col-lg-2 col-md-4 col-sm-4 col-12" >
            <div class="form-group">
                <label for="cbof_v">
                    Fec. Vence
                </label>
                <select name="cbof_v" id="cbof_v" class="custom-select" style="width: 100% !important;" >
                    <option value=""
							<?php echo (isset($evaluacion->f_v) && $evaluacion->f_v == '') ? 'selected' : '' ?>></option>
                    <option value="1"
							<?php echo (isset($evaluacion->f_v) && $evaluacion->f_v == '1') ? 'selected' : '' ?>>C</option>
                    <option value="2"
							<?php echo (isset($evaluacion->f_v) && $evaluacion->f_v == '2') ? 'selected' : '' ?>>NC</option>
                    <option value="3"
							<?php echo (isset($evaluacion->f_v) && $evaluacion->f_v == '3') ? 'selected' : '' ?>>NA</option>
                </select>
            </div>
        </div>
        <div class="col-xl-2 col-lg-2 col-md-4 col-sm-4 col-12" >
            <div class="form-group">
                <label for="cboc_l_p">
                    Cod. Lote Prod.
                </label>
                <select name="cboc_l_p" id="cboc_l_p" class="custom-select" style="width: 100% !important;" >
                    <option value=""
							<?php echo (isset($evaluacion->c_l_p) && $evaluacion->c_l_p == '') ? 'selected' : '' ?>></option>
                    <option value="1"
							<?php echo (isset($evaluacion->c_l_p) && $evaluacion->c_l_p == '1') ? 'selected' : '' ?>>C</option>
                    <option value="2"
							<?php echo (isset($evaluacion->c_l_p) && $evaluacion->c_l_p == '2') ? 'selected' : '' ?>>NC</option>
                    <option value="3"
							<?php echo (isset($evaluacion->c_l_p) && $evaluacion->c_l_p == '3') ? 'selected' : '' ?>>NA</option>
                </select>
            </div>
        </div>
        <div class="col-xl-2 col-lg-2 col-md-4 col-sm-4 col-12" >
            <div class="form-group">
                <label for="cbol_i">
                    Lista Ingred.
                </label>
                <select name="cbol_i" id="cbol_i" class="custom-select" style="width: 100% !important;" >
                    <option value=""
							<?php echo (isset($evaluacion->l_i) && $evaluacion->l_i == '') ? 'selected' : '' ?>></option>
                    <option value="1"
							<?php echo (isset($evaluacion->l_i) && $evaluacion->l_i == '1') ? 'selected' : '' ?>>C</option>
                    <option value="2"
							<?php echo (isset($evaluacion->l_i) && $evaluacion->l_i == '2') ? 'selected' : '' ?>>NC</option>
                    <option value="3"
							<?php echo (isset($evaluacion->l_i) && $evaluacion->l_i == '3') ? 'selected' : '' ?>>NA</option>
                </select>
            </div>
        </div>
        <div class="col-xl-2 col-lg-2 col-md-4 col-sm-4 col-12" >
            <div class="form-group">
                <label for="cboc_c_p">
                    Cond. Cons. Produc.
                </label>
                <select name="cboc_c_p" id="cboc_c_p" class="custom-select" style="width: 100% !important;" >
                    <option value=""
							<?php echo (isset($evaluacion->c_c_p) && $evaluacion->c_c_p == '') ? 'selected' : '' ?>></option>
                    <option value="1"
							<?php echo (isset($evaluacion->c_c_p) && $evaluacion->c_c_p == '1') ? 'selected' : '' ?>>C</option>
                    <option value="2"
							<?php echo (isset($evaluacion->c_c_p) && $evaluacion->c_c_p == '2') ? 'selected' : '' ?>>NC</option>
                    <option value="3"
							<?php echo (isset($evaluacion->c_c_p) && $evaluacion->c_c_p == '3') ? 'selected' : '' ?>>NA</option>
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
                <textarea name="mtxtc_c" id="mtxtc_c" class="form-control" rows="5"
				><?php echo (isset($evaluacion->c_c)) ? $evaluacion->c_c : '' ?></textarea>
            </div>
        </div>
        <div class="col-xl-4 col-lg-4 col-md-4 col-sm-6 col-12" >
            <div class="form-group">
                <label for="mtxtc_c_r">
                    Condiciones de conservación del producto
                </label>
                <textarea name="mtxtc_c_r" id="mtxtc_c_r" class="form-control" rows="5"
				><?php echo (isset($evaluacion->c_c_r)) ? $evaluacion->c_c_r : '' ?></textarea>
            </div>
        </div>
        <div class="col-xl-4 col-lg-4 col-md-4 col-sm-12 col-12" >
            <div class="form-group">
                <label for="cboPais">
                    Pais
                    <span class="fs-requerido text-danger">*</span>
                </label>
                <select name="cboPais" id="cboPais" class="custom-select" style="width: 100% !important;" >
					<?php if (isset($evaluacion->textPais) && !empty($evaluacion->textPais)) { ?>
						<option value="<?php echo $evaluacion->pais ?>">
							<?php echo $evaluacion->textPais ?>
						</option>
					<?php } ?>
				</select>
            </div>
        </div>
    </div>
    <div class="row" >
        <div class="col-xl-2 col-lg-2 col-md-4 col-sm-4 col-12" >
            <div class="form-group">
                <label for="cboc_n">
                    Cont. Neto
                </label>
                <select name="cboc_n" id="cboc_n" class="custom-select" style="width: 100% !important;" >
                    <option value=""
							<?php echo (isset($evaluacion->c_n) && $evaluacion->c_n == '') ? 'selected' : '' ?>></option>
                    <option value="1"
							<?php echo (isset($evaluacion->c_n) && $evaluacion->c_n == '1') ? 'selected' : '' ?>>C</option>
                    <option value="2"
							<?php echo (isset($evaluacion->c_n) && $evaluacion->c_n == '2') ? 'selected' : '' ?>>NC</option>
                </select>
            </div>
        </div>
        <div class="col-xl-2 col-lg-2 col-md-4 col-sm-4 col-12" >
            <div class="form-group">
                <label for="cbod_i">
                    Dir. Import.
                </label>
                <select name="cbod_i" id="cbod_i" class="custom-select" style="width: 100% !important;" >
                    <option value=""
							<?php echo (isset($evaluacion->d_i) && $evaluacion->d_i == '') ? 'selected' : '' ?>></option>
                    <option value="1"
							<?php echo (isset($evaluacion->d_i) && $evaluacion->d_i == '1') ? 'selected' : '' ?>>C</option>
                    <option value="2"
							<?php echo (isset($evaluacion->d_i) && $evaluacion->d_i == '2') ? 'selected' : '' ?>>NC</option>
                    <option value="3"
							<?php echo (isset($evaluacion->d_i) && $evaluacion->d_i == '3') ? 'selected' : '' ?>>NA</option>
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
                           value="<?php echo (isset($evaluacion->t_v_u)) ? $evaluacion->t_v_u : '' ?>" >
                    <div class="input-group-prepend" >
                        <select name="cbotiempo_m" id="cbotiempo_m" class="custom-select"
                                style="width: 100px !important;"
                                title="" >
                            <option value="1"
									<?php echo (isset($evaluacion->tiempo_m) && $evaluacion->tiempo_m == '1') ? 'selected' : '' ?>>
								Dias
							</option>
                            <option value="2"
									<?php echo (isset($evaluacion->tiempo_m) && $evaluacion->tiempo_m == '2') ? 'selected' : '' ?>>
								Meses
							</option>
                            <option value="3"
									<?php echo (isset($evaluacion->tiempo_m) && $evaluacion->tiempo_m == '3') ? 'selected' : '' ?>>
								Años
							</option>
                            <option value="4"
									<?php echo (isset($evaluacion->tiempo_m) && $evaluacion->tiempo_m == '4') ? 'selected' : '' ?>>
								NA
							</option>
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
					   value="<?php echo (isset($evaluacion->f_i_h)) ? $evaluacion->f_i_h : '' ?>" >
            </div>
        </div>
        <div class="col-xl-2 col-lg-2 col-md-4 col-sm-4 col-12" >
            <div class="form-group">
                <label for="mtxtentidad">
                    Entidad
                </label>
                <input type="text" class="form-control"
                       id="mtxtentidad" name="mtxtentidad"
                       value="<?php echo (isset($evaluacion->entidad)) ? $evaluacion->entidad : '' ?>" >
            </div>
        </div>
        <div class="col-xl-2 col-lg-2 col-md-4 col-sm-4 col-12" >
            <div class="form-group">
                <label for="mtxtresponsable">
                    Responsable
                </label>
                <input type="text" class="form-control"
                       id="mtxtresponsable" name="mtxtresponsable"
                       value="<?php echo (isset($evaluacion->responsable)) ? $evaluacion->responsable : '' ?>" >
            </div>
        </div>
    </div>
    <div class="row" >
        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12" >
            <div class="form-group" >
                <label for="mtxtobservacion">
                    Observaciones
                </label>
                <textarea name="mtxtobservacion" id="mtxtobservacion" class="form-control" rows="5"
				><?php echo (isset($evaluacion->observacion)) ? $evaluacion->observacion : '' ?></textarea>
            </div>
        </div>
        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12" >
            <div class="form-group" >
                <label for="mtxtacuerdos">
                    Acuerdos con el proveedor y/o levantamientos de observaciones
                </label>
                <textarea name="mtxtacuerdos" id="mtxtacuerdos" class="form-control" rows="5"
				><?php echo (isset($evaluacion->acuerdo)) ? $evaluacion->acuerdo : '' ?></textarea>
            </div>
        </div>
    </div>
    <div class="row" >
        <div class="col-xl-2 col-lg-2 col-md-4 col-sm-4 col-12" >
            <div class="form-group">
                <label for="Fechafecha">
                    Fecha
                </label>
				<?php
				$fecha = date('d/m/Y');
				if (isset($evaluacion->fecha) && !empty($evaluacion->fecha)) {
					$fecha = date('d/m/Y', strtotime($evaluacion->fecha));
				}
				?>
                <div class="input-group">
                    <input type="text" class="form-control datepicker"
                           id="Fechafecha" name="Fechafecha"
                           value="<?php echo $fecha ?>">

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
                <select id="cbostatus" name="cbostatus" class="custom-select" style="width: 100% !important;" >
                    <option value="0"
							<?php echo (isset($evaluacion->status) && $evaluacion->status == '0') ? 'selected' : '' ?>>EN PROCESO</option>
                    <option value="1"
							<?php echo (isset($evaluacion->status) && $evaluacion->status == '1') ? 'selected' : '' ?>>APROBADO</option>
                    <option value="2"
							<?php echo (isset($evaluacion->status) && $evaluacion->status == '2') ? 'selected' : '' ?>>RECHAZADO</option>
                    <option value="3"
							<?php echo (isset($evaluacion->status) && $evaluacion->status == '3') ? 'selected' : '' ?>>OBSERVADO</option>
                    <option value="4"
							<?php echo (isset($evaluacion->status) && $evaluacion->status == '4') ? 'selected' : '' ?>>Pendiente Vida Util</option>
                </select>
            </div>
        </div>
        <div class="col-xl-2 col-lg-2 col-md-4 col-sm-4 col-12" >
            <div class="form-group">
                <label for="cboa_s">
                    Agota. Stock
                </label>
                <select id="cboa_s" name="cboa_s" class="custom-select" style="width: 100% !important;" >
                    <option value="0"
							<?php echo (isset($evaluacion->a_s) && $evaluacion->a_s == '0') ? 'selected' : '' ?>></option>
                    <option value="1"
							<?php echo (isset($evaluacion->a_s) && $evaluacion->a_s == '1') ? 'selected' : '' ?>>SI</option>
                    <option value="2"
							<?php echo (isset($evaluacion->a_s) && $evaluacion->a_s == '2') ? 'selected' : '' ?>>NA</option>
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
                       value="<?php echo (isset($evaluacion->f_e_a_s)) ? $evaluacion->f_e_a_s : '' ?>" >
            </div>
        </div>
        <div class="col-xl-2 col-lg-2 col-md-4 col-sm-4 col-12" >
            <div class="form-group">
                <label for="mtxtf_a_v_s">
                    F. Venci. Agota Stock
                </label>
                <input type="text" class="form-control"
                       id="mtxtf_a_v_s" name="mtxtf_a_v_s"
                       value="<?php echo (isset($evaluacion->f_a_v_s)) ? $evaluacion->f_a_v_s : '' ?>" >
            </div>
        </div>
        <div class="col-xl-2 col-lg-2 col-md-4 col-sm-4 col-12" >
            <div class="form-group">
                <label for="cbod_p">
                    Docum. Pendiente
                </label>
                <select id="cbod_p" name="cbod_p" class="custom-select" style="width: 100% !important;" >
                    <option value="0"
							<?php echo (isset($evaluacion->d_p) && $evaluacion->d_p == '0') ? 'selected' : '' ?>></option>
                    <option value="1"
							<?php echo (isset($evaluacion->d_p) && $evaluacion->d_p == '1') ? 'selected' : '' ?>>SI</option>
                    <option value="2"
							<?php echo (isset($evaluacion->d_p) && $evaluacion->d_p == '2') ? 'selected' : '' ?>>NO</option>
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
                <select id="cboo_l" name="cboo_l" class="custom-select" style="width: 100% !important;" >
                    <option value="0"
							<?php echo (isset($evaluacion->o_l) && $evaluacion->o_l == '0') ? 'selected' : '' ?>></option>
                    <option value="1"
							<?php echo (isset($evaluacion->o_l) && $evaluacion->o_l == '1') ? 'selected' : '' ?>>SI</option>
                    <option value="2"
							<?php echo (isset($evaluacion->o_l) && $evaluacion->o_l == '2') ? 'selected' : '' ?>>NO</option>
                    <option value="3"
							<?php echo (isset($evaluacion->o_l) && $evaluacion->o_l == '3') ? 'selected' : '' ?>>NA</option>
                </select>
            </div>
        </div>
        <div class="col-xl-2 col-lg-2 col-md-4 col-sm-4 col-12" >
            <div class="form-group">
                <label for="cboo_n">
                    Obser. x T.Nutr.
                </label>
                <select id="cboo_n" name="cboo_n" class="custom-select" style="width: 100% !important;" >
                    <option value="0"
							<?php echo (isset($evaluacion->o_n) && $evaluacion->o_n == '0') ? 'selected' : '' ?>></option>
                    <option value="1"
							<?php echo (isset($evaluacion->o_n) && $evaluacion->o_n == '1') ? 'selected' : '' ?>>SI</option>
                    <option value="2"
							<?php echo (isset($evaluacion->o_n) && $evaluacion->o_n == '2') ? 'selected' : '' ?>>NO</option>
                    <option value="3"
							<?php echo (isset($evaluacion->o_n) && $evaluacion->o_n == '3') ? 'selected' : '' ?>>NA</option>
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
