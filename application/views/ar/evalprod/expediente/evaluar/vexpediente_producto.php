<form class="form-horizontal" id="frmMantProducto"
	  action="<?= base_url('ar/evalprod/cevaluar/guardar_producto') ?>" method="POST"
	  enctype="multipart/form-data" role="form">
	<div class="row">
		<div class="col-xl-2 col-lg-2 col-md-4 col-sm-4 col-12">
			<div class="form-group">
				<label for="mtxtCodigoean">
					Código EAN
				</label>
				<input type="text" class="form-control"
					   id="mtxtCodigoean" name="mtxtCodigoean"
					   value="<?php echo (isset($producto->codigo)) ? $producto->codigo : '' ?>">
			</div>
		</div>
		<div class="col-xl-4 col-lg-4 col-md-8 col-sm-8 col-12">
			<div class="form-group">
				<label for="mtxtDescrip">
					Descripción Producto
				</label>
				<input type="text" class="form-control"
					   id="mtxtDescrip" name="mtxtDescrip"
					   value="<?php echo (isset($producto->descripcion)) ? $producto->descripcion : '' ?>">
			</div>
		</div>
		<div class="col-xl-2 col-lg-2 col-md-4 col-sm-4 col-12">
			<div class="form-group">
				<label for="mtxtMarca">
					Marca
				</label>
				<input type="text" class="form-control"
					   id="mtxtMarca" name="mtxtMarca"
					   value="<?php echo (isset($producto->marca)) ? $producto->marca : '' ?>">
			</div>
		</div>
		<div class="col-xl-4 col-lg-4 col-md-8 col-sm-8 col-12">
			<div class="form-group">
				<label for="mtxtPresent">
					Presentación
				</label>
				<input type="text" class="form-control"
					   id="mtxtPresent" name="mtxtPresent"
					   value="<?php echo (isset($producto->presentacion)) ? $producto->presentacion : '' ?>">
			</div>
		</div>
	</div>
	<div class="row">
		<div class="col-xl-3 col-lg-3 col-md-6 col-sm-6 col-12">
			<div class="form-group">
				<label for="mtxtFabri">
					Fabricante
				</label>
				<input type="text" class="form-control"
					   id="mtxtFabri" name="mtxtFabri"
					   value="<?php echo (isset($producto->fabricante)) ? $producto->fabricante : '' ?>">
			</div>
		</div>
		<div class="col-xl-3 col-lg-3 col-md-6 col-sm-6 col-12">
			<div class="form-group">
				<label for="mtxtNrodoc">
					RS/NSO/RD
				</label>
				<div class="input-group">
					<div class="input-group-append" style="width: 5rem; min-width: 5rem;">
						<select name="cboTipodoc" id="cboTipodoc" aria-label="" title=""
								class="custom-select" style="width: 100% !important;">
							<option value="0"
									<?php echo (isset($producto->tipo_codigo) && $producto->tipo_codigo == '0') ? 'selected' : '' ?>>-- Elija --</option>
							<option value="1"
									<?php echo (isset($producto->tipo_codigo) && $producto->tipo_codigo == '1') ? 'selected' : '' ?> >
								RS
							</option>
							<option value="2"
									<?php echo (isset($producto->tipo_codigo) && $producto->tipo_codigo == '2') ? 'selected' : '' ?>>
								NSO
							</option>
							<option value="3"
									<?php echo (isset($producto->tipo_codigo) && $producto->tipo_codigo == '3') ? 'selected' : '' ?>>
								AS
							</option>
							<option value="4"
									<?php echo (isset($producto->tipo_codigo) && $producto->tipo_codigo == '4') ? 'selected' : '' ?>>
								RD
							</option>
							<option value="5"
									<?php echo (isset($producto->tipo_codigo) && $producto->tipo_codigo == '5') ? 'selected' : '' ?>>
								NA
							</option>
						</select>
					</div>
					<input type="text" class="form-control"
						   id="mtxtNrodoc" name="mtxtNrodoc"
						   value="<?php echo (isset($producto->rs)) ? $producto->rs : '' ?>">
				</div>
			</div>
		</div>
		<div class="col-xl-2 col-lg-2 col-md-4 col-sm-4 col-12">
			<div class="form-group">
				<label for="FechaEmi">
					Fecha Emisión
				</label>
				<input type="text" class="form-control"
					   id="FechaEmi" name="FechaEmi"
					   value="<?php echo (isset($producto->fecha_emision)) ? $producto->fecha_emision : '' ?>">
			</div>
		</div>
		<div class="col-xl-2 col-lg-2 col-md-4 col-sm-4 col-12">
			<div class="form-group">
				<label for="FechaVence">
					Fecha Venc.
				</label>
				<input type="text" class="form-control"
					   id="FechaVence" name="FechaVence"
					   value="<?php echo (isset($producto->fecha_vcto)) ? $producto->fecha_vcto : '' ?>">
			</div>
		</div>
		<div class="col-xl-2 col-lg-2 col-md-4 col-sm-4 col-12">
			<div class="form-group">
				<label for="FechaEval">
					Fecha Evaluado
					<span class="fs-requerido text-danger">*</span>
				</label>

				<div class="input-group">
					<input type="text" class="form-control datepicker"
						   id="FechaEval" name="FechaEval"
						   value="<?php echo (isset($producto->f_evaluado)) ? date('d/m/Y', strtotime($producto->f_evaluado)) : '' ?>">

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
				<select class="custom-select" style="width: 100% !important;"
						id="cboGrasaSatu" name="cboGrasaSatu">
					<option value=""
							<?php echo (isset($producto->grasas_saturadas) && $producto->grasas_saturadas == '') ? 'selected' : '' ?>></option>
					<option value="NA"
							<?php echo (isset($producto->grasas_saturadas) && $producto->grasas_saturadas == 'NA') ? 'selected' : '' ?>>
						NA
					</option>
					<option value="SI"
							<?php echo (isset($producto->grasas_saturadas) && $producto->grasas_saturadas == 'SI') ? 'selected' : '' ?>>
						SI
					</option>
					<option value="NO"
							<?php echo (isset($producto->grasas_saturadas) && $producto->grasas_saturadas == 'NO') ? 'selected' : '' ?>>
						NO
					</option>
				</select>
			</div>
		</div>
		<div class="col-xl-3 col-lg-3 col-md-6 col-sm-6 col-12">
			<div class="form-group">
				<label for="cboAzucar">
					Azúcar
				</label>
				<select class="custom-select" style="width: 100% !important;"
						id="cboAzucar" name="cboAzucar">
					<option value=""
							<?php echo (isset($producto->azucar) && $producto->azucar == '') ? 'selected' : '' ?>></option>
					<option value="NA"
							<?php echo (isset($producto->azucar) && $producto->azucar == 'NA') ? 'selected' : '' ?>>
						NA
					</option>
					<option value="SI"
							<?php echo (isset($producto->azucar) && $producto->azucar == 'SI') ? 'selected' : '' ?>>
						SI
					</option>
					<option value="NO"
							<?php echo (isset($producto->azucar) && $producto->azucar == 'NO') ? 'selected' : '' ?>>
						NO
					</option>
				</select>
			</div>
		</div>
		<div class="col-xl-3 col-lg-3 col-md-6 col-sm-6 col-12">
			<div class="form-group">
				<label for="cboSodio">
					Sodio
				</label>
				<select class="custom-select" style="width: 100% !important;"
						id="cboSodio" name="cboSodio">
					<option value=""
							<?php echo (isset($producto->sodio) && $producto->sodio == '') ? 'selected' : '' ?>></option>
					<option value="NA"
							<?php echo (isset($producto->sodio) && $producto->sodio == 'NA') ? 'selected' : '' ?>>
						NA
					</option>
					<option value="SI"
							<?php echo (isset($producto->sodio) && $producto->sodio == 'SI') ? 'selected' : '' ?>>
						SI
					</option>
					<option value="NO"
							<?php echo (isset($producto->sodio) && $producto->sodio == 'NO') ? 'selected' : '' ?>>
						NO
					</option>
				</select>
			</div>
		</div>
		<div class="col-xl-3 col-lg-3 col-md-6 col-sm-6 col-12">
			<div class="form-group">
				<label for="cboGrasaTrans">
					Grasas Trans
				</label>
				<select class="custom-select" style="width: 100% !important;"
						id="cboGrasaTrans" name="cboGrasaTrans">
					<option value=""
							<?php echo (isset($producto->grasas_trans) && $producto->grasas_trans == '') ? 'selected' : '' ?>></option>
					<option value="NA"
							<?php echo (isset($producto->grasas_trans) && $producto->grasas_trans == 'NA') ? 'selected' : '' ?>>
						NA
					</option>
					<option value="SI"
							<?php echo (isset($producto->grasas_trans) && $producto->grasas_trans == 'SI') ? 'selected' : '' ?>>
						SI
					</option>
					<option value="NO"
							<?php echo (isset($producto->grasas_trans) && $producto->grasas_trans == 'NO') ? 'selected' : '' ?>>
						NO
					</option>
				</select>
			</div>
		</div>
	</div>
	<div class="row">
		<div class="col-xl-6 col-lg-6 col-md-12 col-sm-12 col-12">
			<div class="row">
				<div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
					<div class="form-group">
						<label for="FechaLevanta">
							Fecha de levantamiento
							<span class="fs-requerido text-danger">*</span>
						</label>

						<div class="input-group">
							<input type="text" class="form-control datepicker"
								   id="FechaLevanta" name="FechaLevanta"
								   value="<?php echo (isset($producto->f_levantamiento)) ? date('d/m/Y', strtotime($producto->f_levantamiento)) : '' ?>">

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
						<input type="text" class="form-control"
							   id="mtxtTiempoEval" name="mtxtTiempoEval"
							   value="<?php echo (isset($producto->tiempo_evaluacion)) ? $producto->tiempo_evaluacion : 0 ?>">
					</div>
				</div>
				<div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
					<div class="form-group">
						<label for="mtxtObservaCli">
							Observación para Tottus
						</label>
						<textarea name="mtxtObservaCli" id="mtxtObservaCli"
								  class="form-control"
								  rows="2"><?php echo (isset($producto->observacion_cli)) ? $producto->observacion_cli : '' ?></textarea>
					</div>
				</div>
			</div>
		</div>
		<div class="col-xl-6 col-lg-6 col-md-12 col-sm-12 col-12">
			<div class="form-group">
				<label for="mtxtObserva">
					Observaciones
				</label>
				<textarea name="mtxtObserva" id="mtxtObserva"
						  class="form-control"
						  rows="5"><?php echo (isset($producto->observacion)) ? $producto->observacion : '' ?></textarea>
			</div>
		</div>
	</div>
	<div class="row">
		<div class="col-xl-8 col-lg-7 col-md-7 col-sm-12 col-12">
			<?php echo $pagination; ?>
		</div>
		<div class="col-xl-4 col-lg-5 col-md-5 col-sm-12 col-12 text-right">
			<button type="button" role="button" class="btn btn-info" id="btnActualizarProducto">
				<i class="fa fa-edit"></i> Actualizar Producto
			</button>
		</div>
	</div>
</form>
