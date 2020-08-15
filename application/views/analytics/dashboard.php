<?php
  $idusuario = $this -> session -> userdata('s_idusuario');
  $idempleado = $this -> session -> userdata('s_idempleado');
  $datosuser = $this -> session -> userdata('s_name');
  
  foreach($datos_resumenpermisos as $mresumenpermisos){ 
    $nro_horasextras = $mresumenpermisos->nro_horasextras;
    $nro_permisos = $mresumenpermisos->nro_permisos;
    $horaspendientes = $mresumenpermisos->horaspendientes;

    $diasvaca = $mresumenpermisos->diasvaca;
    $nro_permcuentavaca = $mresumenpermisos->nro_permcuentavaca;
    $nro_vacaciones = $mresumenpermisos->nro_vacaciones;
    $diaspendientes = $mresumenpermisos->diaspendientes;

    $permestado = $mresumenpermisos->permOpcion;
    $vacaestado = $mresumenpermisos->vacaOpcion;
  }   
?>
<style>
  #cboRecuperahora[readonly]{
    background: #eee;
    cursor:no-drop;
    -webkit-appearance: none;
  }

  #cboRecuperahora[readonly] option{
      display:none;
  }
</style>

<!-- content-header -->
<div class="content-header">   
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1 class="m-0 text-dark">DASHBOARD</h1>
      </div>
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="">Home</a></li>
          <!--<li class="breadcrumb-item active">Dashboard Interno</li>-->
        </ol>
      </div>
    </div>
  </div>
</div>
<!-- /.content-header -->

<!-- Main content -->
<section class="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-lg-4 col-6">
        <div class="small-box bg-success">
          <div class="inner">
            <h3>PERMISOS</h3>
            <p style="font: icon;"><?php echo $horaspendientes;?> Horas a <?php echo $permestado;?> &nbsp;<a data-toggle="modal" href="#modalCuadroPermisos" class="small-box-footer"><i class="fas fa-angle-double-down fa-2x"></i></a></p>
          </div>
          <div class="icon">
            <i class="ion ion-log-out"></i>
          </div>
          <a id="a-modallistperm" data-toggle="modal" href="#modalRegPermisos" class="small-box-footer">Registrar <i class="fas fa-arrow-circle-right"></i></a>
        </div>
      </div>

      <div class="col-lg-4 col-6">
        <div class="small-box bg-warning">
          <div class="inner">
            <h3>VACACIONES</h3>
            <p style="font: icon;"><?php echo $diaspendientes;?> Dias <?php echo $vacaestado;?> &nbsp;<a data-toggle="modal" href="#modalCuadroVacaciones" class="small-box-footer"><i class="fas fa-angle-double-down fa-2x"></i></a></p>
          </div>
          <div class="icon">
            <i class="ion ion-briefcase"></i>
          </div>
          <a id="a-modallistvaca" data-toggle="modal" href="#modalRegVacaciones" class="small-box-footer">Registrar <i class="fas fa-arrow-circle-right"></i></a>
        </div>
      </div>

      <div class="col-lg-4 col-12">
        <div class="small-box bg-danger">
          <div class="inner">
            <h3>HORAS ACUMULADAS</h3>

            <p style="font: icon;">Horas adicionales o a recuperar &nbsp;<a data-toggle="modal" href="#modalCuadroAcumulados" class="small-box-footer"><i class="fas fa-angle-double-down fa-2x"></i></a></p>
          </div>
          <div class="icon">
            <i class="ion ion-clock"></i>
          </div>
          <a id="a-modallistextra" data-toggle="modal" href="#modalRegExtras" class="small-box-footer">Registrar <i class="fas fa-arrow-circle-right"></i></a>
        </div>
      </div>
    </div>
  </div>
</section>
<!-- /.Main content -->

<!-- /.modal-permiso -->  
<div class="modal" id="modalCuadroPermisos" data-backdrop="static" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-lg" id="popupListVacaciones">
    <div class="modal-content">
      <div class="modal-header text-center bg-success">
        <h4 class="modal-title w-100 font-weight-bold">Control de Permisos</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">  
        <div class="row">
          <div class="col-12 col-md-12 col-lg-12 order-2 order-md-1">
            <div class="row">
              <div class="col-12 col-sm-4">
                <div class="info-box bg-light">
                  <div class="info-box-content">
                    <span class="info-box-text text-center text-muted">TOTAL HORAS</span>
                    <span class="info-box-text text-center text-muted">EXTRAS ACUMULADAS</span>
                    <span class="info-box-number text-center text-muted mb-0"><?php echo $nro_horasextras;?></span>
                  </div>
                </div>
              </div>
              <div class="col-12 col-sm-4">
                <div class="info-box bg-light">
                  <div class="info-box-content">
                    <span class="info-box-text text-center text-muted">TOTAL HORAS</span>
                    <span class="info-box-text text-center text-muted">PERMISOS ACUMULADOS</span>
                    <span class="info-box-number text-center text-muted mb-0"><?php echo $nro_permisos;?></span>
                  </div>
                </div>
              </div>
              <div class="col-12 col-sm-4">
                <div class="info-box bg-light">
                  <div class="info-box-content">
                    <span class="info-box-text text-center text-muted">HORAS A</span>
                    <span class="info-box-text text-center text-muted"><?php echo strtoupper($permestado);?></span>
                    <span class="info-box-number text-center text-muted mb-0"><?php echo $horaspendientes;?><span>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-md-6">     
            <table id="tblListaextras"  class="table table-bordered table-striped dataTable">
              <thead>
                <tr>
                  <th>FECHA H. EXTRA</th>
                  <th>HORAS EXTRAS</th>
                  <th>TOTAL HORAS</th>
                </tr>
              </thead>
              <tbody></tbody>
            </table>
          </div>
          <div class="col-md-6">        
            <table id="tblListapermisos"  class="table table-bordered table-striped dataTable">
              <thead>
                <tr>
                  <th>FECHA H. PERMISOS</th>
                  <th>HORAS PERMISOS</th>
                  <th>HORAS UTILIZADAS</th>
                </tr>
              </thead>
              <tbody></tbody>
            </table>
          </div>
        </div>
      </div>
      <div class="modal-footer justify-content-between" style="background-color: #dff0d8;">
        <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
      </div>
    </div>
  </div>
</div>
<div class="modal fade" id="modalRegPermisos" data-backdrop="static" role="dialog" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <form class="form-horizontal" id="frmRegPermiso" name="frmRegPermiso" action="<?= base_url('adm/crecursoshumanos/guardarpermiso')?>" method="POST" enctype="multipart/form-data" role="form"> 

        <div class="modal-header text-center bg-success">
          <h4 class="modal-title w-100 font-weight-bold">Registro de Permisos</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>

        <div class="modal-body">  
          <p class="statusMsg"></p>           
          <input type="hidden" id="mhdnIdpermiso" name="mhdnIdpermiso"> <!-- ID -->
          <input type="hidden" id="mhdnAccionperm" name="mhdnAccionperm">
          <input type="hidden" id="hdregIdempleadoperm" name="hdregIdempleadoperm" value= <?php echo $idempleado; ?> > 
                         
          <div class="form-group">
            <div class="row">
              <div class="col-sm-4">
                <div class="text-light-black">Fecha Registro</div>
                <div>
                  <input class="form-control" id="mtxtFregistroperm" name="mtxtFregistroperm" data-inputmask="'alias': 'dd/mm/yyyy'" data-mask type="text" readonly>
                </div>
              </div>
              <div class="col-sm-8">
                <div class="text-light-blue">Motivo</div> 
                  <select id="mcboMotivo" name="mcboMotivo" class="form-control select" style="width: 100%; background-position: right 15px center;"  data-validation="required">
                    <option value = "" selected="selected">::Elija</option>
                    <option value="P">PERSONALES</option>
                    <option value="S">SALUD</option>
                    <option value="O">OTROS</option>
                  </select>
              </div>  
            </div>                
          </div>
          <div class="form-group">
            <div class="row">
              <div class="col-sm-4">
                <div class="text-light-blue">Fecha Salida</div>
                <div class="input-group date" id="mtxtFsalidaperm" data-target-input="nearest">
                  <input type="text" id="mtxtFsalperm" name="mtxtFsalperm" class="form-control datetimepicker-input" data-target="#mtxtFsalidaperm"/>
                  <div class="input-group-append" data-target="#mtxtFsalidaperm" data-toggle="datetimepicker">
                    <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                  </div>
                </div>
              </div>  
              <div class="col-sm-4">
                <div class="text-light-blue">Hora Salida</div>
                <div class="input-group date" id="mtxtHsalidaperm" data-target-input="nearest">
                  <input type="text" id="mtxtHsalperm" name="mtxtHsalperm" class="form-control datetimepicker-input" data-target="#mtxtHsalidaperm"/>
                  <div class="input-group-append" data-target="#mtxtHsalidaperm" data-toggle="datetimepicker">
                    <div class="input-group-text"><i class="far fa-clock"></i></div>
                  </div>
                </div>
              </div>  
              <div class="col-sm-4">
                <div class="text-light-blue">Hora Retorno</div>
                <div class="input-group date" id="mtxtHretornoperm"  data-target-input="nearest">
                  <input type="text" id="mtxtHretorperm" name="mtxtHretorperm" class="form-control datetimepicker-input" data-target="#mtxtHretornoperm"/>
                  <div class="input-group-append" data-target="#mtxtHretornoperm" data-toggle="datetimepicker">
                    <div class="input-group-text"><i class="far fa-clock"></i></div>
                  </div>
                </div>
              </div> 
            </div>
          </div>
          <div class="form-group">
            <div class="row">
              <div class="col-sm-12"> 
                <div class="text-light-blue">Fundamentación</div> 
                <textarea type="text" class="form-control" id="mtxtFundamentoperm" name="mtxtFundamentoperm" rows="3" cols="40" data-validation="required"></textarea>
              </div>
            </div> 
          </div>
          <div class="form-group">
            <div class="row">
              <div class="col-sm-8"> 
                <div class="text-light-blue">Recupera Horas</div>                   
                <select id="cboRecuperahora" name="cboRecuperahora" class="form-control" style="width: 100%;" style="width: 100%;" readonly>
                  <option value="S" selected="selected">CON OPCIÓN A RECUPERAR</option>
                  <option value="V">A CUENTA DE VACACIONES</option> 
                </select>
              </div>
              <div class="col-sm-4" id="recuHora">
                <div class="text-light-blue">Fecha Recuperación</div>
                <div class="input-group date" id="mtxtFrecupera" data-target-input="nearest">
                  <input type="text"  id="mtxtFrecuperm" name="mtxtFrecuperm" class="form-control datetimepicker-input" data-target="#mtxtFrecupera"/>
                  <div class="input-group-append" data-target="#mtxtFrecupera" data-toggle="datetimepicker">
                    <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                  </div>
                </div>
              </div>
            </div>                
          </div>
        </div>

        <div class="modal-footer justify-content-between" style="background-color: #dff0d8;">
          <button type="reset" class="btn btn-default" id="mbtnCPermiso" data-dismiss="modal">Cancelar</button>
          <button type="submit" class="btn btn-info" id="mbtnGPermiso">Grabar</button>
        </div>
      </form>
    </div>
  </div>
</div>
<!-- /.modal-->

<!-- /.modal-vacaciones -->  
<div class="modal" id="modalCuadroVacaciones" data-backdrop="static" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-lg" id="popupListVacaciones">
    <div class="modal-content">
      <div class="modal-header text-center bg-success">
        <h4 class="modal-title w-100 font-weight-bold">Control de Vacaciones</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">  
        <div class="row">
          <div class="col-12 col-md-12 col-lg-12 order-2 order-md-1">
            <div class="row">
              <div class="col-12 col-sm-4">
                <div class="info-box bg-light">
                  <div class="info-box-content">
                    <span class="info-box-text text-center text-muted">DIAS DE </span>
                    <span class="info-box-text text-center text-muted">VACACIONES</span>
                    <span class="info-box-number text-center text-muted mb-0"><?php echo $diasvaca;?></span>
                  </div>
                </div>
              </div>
              <div class="col-12 col-sm-4">
                <div class="info-box bg-light">
                  <div class="info-box-content">
                    <span class="info-box-text text-center text-muted">DIAS TOMADOS POR</span>
                    <span class="info-box-text text-center text-muted">VACACIONES</span>
                    <span class="info-box-number text-center text-muted mb-0"><?php echo $nro_permcuentavaca + $nro_vacaciones;?></span>
                  </div>
                </div>
              </div>
              <div class="col-12 col-sm-4">
                <div class="info-box bg-light">
                  <div class="info-box-content">
                    <span class="info-box-text text-center text-muted">DIAS</span>
                    <span class="info-box-text text-center text-muted"><?php echo strtoupper($vacaestado);?></span>
                    <span class="info-box-number text-center text-muted mb-0"><?php echo $diaspendientes;?><span>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-md-12">     
            <table id="tblListacaciones"  class="table table-bordered table-striped dataTable">
              <thead>
                <tr>
                  <th>F. SALIDA VACACIONES</th>
                  <th>F. RETORNO VACACIONES</th>
                  <th>DIAS TOMADOS</th>
                  <th>DETALLE</th>
                </tr>
              </thead>
              <tbody></tbody>
            </table>
          </div>
        </div>
      </div>
      <div class="modal-footer justify-content-between" style="background-color: #dff0d8;">
        <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
      </div>
    </div>
  </div>
</div>
<div class="modal fade" id="modalRegVacaciones" data-backdrop="static" role="dialog" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <form class="form-horizontal" id="frmRegVacaciones" name="frmRegVacaciones" action="<?= base_url('adm/crecursoshumanos/guardarvacaciones')?>" method="POST" enctype="multipart/form-data" role="form"> 

        <div class="modal-header text-center bg-success">
          <h4 class="modal-title w-100 font-weight-bold">Registro de Vacaciones</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>

        <div class="modal-body">  
          <p class="statusMsg"></p>           
          <input type="hidden" id="mhdnIdvacaciones" name="mhdnIdvacaciones"> <!-- ID -->
          <input type="hidden" id="mhdnAccionvaca" name="mhdnAccionvaca">
          <input type="hidden" id="hdregIdempleadovaca" name="hdregIdempleadovaca" value= <?php echo $idempleado; ?> > 
          
          <div class="form-group">
            <div class="row">
              <div class="col-sm-4">
                <div class="text-light-black">Fecha Registro</div>
                <div>
                  <input class="form-control" id="mtxtFregistrovaca" name="mtxtFregistrovaca" data-inputmask="'alias': 'dd/mm/yyyy'" data-mask type="text" readonly>
                </div>
              </div> 
            </div>                
          </div>        
          <div class="form-group">
            <div class="row">
              <div class="col-sm-6">
                <div class="text-light-blue">Fecha Salida</div>
                <div class="input-group date" id="mtxtFsalidavaca" data-target-input="nearest">
                  <input type="text" id="mtxtFsalvaca" name="mtxtFsalvaca" class="form-control datetimepicker-input" data-target="#mtxtFsalidavaca"/>
                  <div class="input-group-append" data-target="#mtxtFsalidavaca" data-toggle="datetimepicker">
                    <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                  </div>
                </div>
              </div>  
              <div class="col-sm-6">
                <div class="text-light-blue">Fecha Retorno</div>
                <div class="input-group date" id="mtxtFretornovaca" data-target-input="nearest">
                  <input type="text" id="mtxtFretovaca" name="mtxtFretovaca" class="form-control datetimepicker-input" data-target="#mtxtFretornovaca"/>
                  <div class="input-group-append" data-target="#mtxtFretornovaca" data-toggle="datetimepicker">
                    <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                  </div>
                </div>
              </div>   
            </div>
          </div>
          <div class="form-group">
            <div class="row">
              <div class="col-sm-12"> 
                <div class="text-light-blue">Comentarios</div> 
                <textarea type="text" class="form-control" id="mtxtFundamentovaca" name="mtxtFundamentovaca" rows="3" cols="40" data-validation="required"></textarea>
              </div>
            </div> 
          </div>
        </div>

        <div class="modal-footer justify-content-between" style="background-color: #dff0d8;">
          <button type="reset" class="btn btn-default" id="mbtnCVacaciones" data-dismiss="modal">Cancelar</button>
          <button type="submit" class="btn btn-info" id="mbtnGVacaciones">Grabar</button>
        </div>
      </form>
    </div>
  </div>
</div>
<!-- /.modal-->

<!-- /.modal-extras --> 
<div class="modal fade" id="modalRegExtras" data-backdrop="static" role="dialog" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <form class="form-horizontal" id="frmRegExtras" name="frmRegExtras" action="<?= base_url('adm/crecursoshumanos/guardarhorasextras')?>" method="POST" enctype="multipart/form-data" role="form"> 

        <div class="modal-header text-center bg-success">
          <h4 class="modal-title w-100 font-weight-bold">Registro de Horas Extras</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>

        <div class="modal-body">  
          <p class="statusMsg"></p>           
          <input type="hidden" id="mhdnIdextras" name="mhdnIdextras"> <!-- ID -->
          <input type="hidden" id="mhdnAccionextra" name="mhdnAccionextra">
          <input type="hidden" id="hdregIdempleadoextra" name="hdregIdempleadoextra" value= <?php echo $idempleado; ?> > 
          
          <div class="form-group">
            <div class="row">
              <div class="col-sm-4">
                <div class="text-light-black">Fecha Registro</div>
                <div>
                  <input class="form-control" id="mtxtFregistroextra" name="mtxtFregistroextra" data-inputmask="'alias': 'dd/mm/yyyy'" data-mask type="text" readonly>
                </div>
              </div> 
            </div>                
          </div>        
          <div class="form-group">
            <div class="row">
              <div class="col-sm-4">
                <div class="text-light-blue">Hora Entrada</div>                
                <input class="form-control" id="mtxtHentextra" name="mtxtHentextra" data-inputmask="'alias': 'hh:mm'" data-mask type="text" readonly>
                <!--<div class="input-group date" id="mtxtHentradaextra" data-target-input="nearest">
                  <input type="text" id="mtxtHentextra" name="mtxtHentextra" class="form-control datetimepicker-input" data-target="#mtxtHentradaextra"/>
                  <div class="input-group-append" data-target="#mtxtHentradaextra" data-toggle="datetimepicker">
                    <div class="input-group-text"><i class="far fa-clock"></i></div>
                  </div>
                </div>-->
              </div>  
            </div>
          </div>
          <div class="form-group">
            <div class="row">
              <div class="col-sm-12"> 
                <div class="text-light-blue">Motivo</div> 
                <textarea type="text" class="form-control" id="mtxtMotivoextra" name="mtxtMotivoextra" rows="3" cols="40" data-validation="required"></textarea>
              </div>
            </div> 
          </div>
        </div>

        <div class="modal-footer justify-content-between" style="background-color: #dff0d8;">
          <button type="reset" class="btn btn-default" id="mbtnCExtras" data-dismiss="modal">Cancelar</button>
          <button type="submit" class="btn btn-info" id="mbtnGExtras">Grabar</button>
        </div>
      </form>
    </div>
  </div>
</div> 
<!-- /.modal-->


