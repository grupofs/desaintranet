<?php
?>

<style>
</style>

<!-- content-header -->
<div class="content-header">   
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1 class="m-0 text-dark">CONTROL PERMISOS</h1>
      </div>
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="<?php echo public_base_url(); ?>cprincipal/principal">Home</a></li>
          <li class="breadcrumb-item active">Gestion Recursos Humanos</li>
        </ol>
      </div>
    </div>
  </div>
</div>
<!-- /.content-header -->

<!-- Main content -->
<section class="content">
    <div class="container-fluid">  
        <div class="card card-success">
            <div class="card-header">
                <h3 class="card-title">BUSQUEDA</h3>
                <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i></button>
                </div>
            </div>

            <form method="post" id="frmExcelListPerm" name="frmExcelListPerm"action="<?php echo base_url(); ?>adm/rrhh/cctrlpermisos/excellistempleadosperm">
            <div class="card-body">
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label>CIA </label>
                            <select class="form-control select2bs4" id="cboCia" name="cboCia" style="width: 100%;">
                                <option value="0">::Todos</option>
                                <option value="1">GRUPO FS</option>
                                <option value="2">FS CERTIFICACIONES</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label>Areas </label>
                            <select class="form-control select2bs4" id="cboArea" name="cboArea" style="width: 100%;">
                                <option value="" selected="selected">Cargando...</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label>Empleados </label>
                            <select class="form-control select2bs4" id="cboEmpleado" name="cboEmpleado" style="width: 100%;">
                                <option value="" selected="selected">Cargando...</option>
                            </select>
                        </div>
                    </div>
                </div>
            </div>
          
            <div class="card-footer">
                <div class="text-right">
                    <button type="submit" class="btn btn-outline-success" id="btnXlsPermArea" name="btnXlsPermArea"><i class="fas fa-file-excel fa-2x">&nbsp;</i>Excel Permisos - Area</button>                    
                 </div>
            </div>
            </form>
        </div>
        <div class="row">
            <div class="col-12">
                <div class="card card-outline card-success">
                    <div class="card-header">
                        <h3 class="card-title">Listado de Permisos</h3>
                    </div>
                
                    <div class="card-body" style="overflow-x: scroll;">
                        <table id="tblListCtrlPermisos" class="table table-striped table-bordered" style="width:100%">
                            <thead>
                            <tr>
                                <th></th>
                                <th>EMPLEADO</th>
                                <th>AREA</th>
                                <th>FECHA INGRESO</th>
                                <th>FECHA TERMINO</th> 
                                <th>PERIODO VACACIONES</th>
                                <th>DIAS VACACIONES</th>
                                <th>DIAS A CUENTA VACACIONES</th>
                                <th>DIAS TOMADOS VACACIONES</th>
                                <th>DIAS PENDIENTES</th>
                                <th>HORAS EXTRAS</th>
                                <th>HORAS PERMISOS</th>
                                <th>HORAS A USAR</th>
                                <th>DESCANSOS MEDICOS</th>
                                <th></th> 
                                <th></th>       
                                <th></th>       
                                <th></th>       
                                <th></th> 
                            </tr>
                            </thead>
                            <tbody>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    
    </div>
</section>
<!-- /.Main content -->

<!-- /.modal-vacaciones --> 
<div class="modal fade" id="modalvacaciones" data-backdrop="static" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-xl">
    <div class="modal-content">
        <div class="modal-header text-center bg-success">
            <h4 class="modal-title w-100 font-weight-bold">Vacaciones</h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body">        
            <div class="card card-success card-outline card-tabs">
                <div class="card-header p-0 pt-1 border-bottom-0">            
                    <ul class="nav nav-tabs" id="tabvacaciones" style="background-color: #28a745;" role="tablist">                    
                        <li class="nav-item">
                            <a class="nav-link active" style="color: #000000;" id="tab_listavacacionestab" data-toggle="pill" href="#tab_listavacaciones" role="tab" aria-controls="tab_listavacaciones" aria-selected="true">LISTADO</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" style="color: #000000;" id="tab_newvacacionestab" data-toggle="pill" href="#tab_newvacaciones" role="tab" aria-controls="tab_newvacaciones" aria-selected="false">REGISTRO</a>
                        </li>
                    </ul>
                </div>
                <div class="card-body">
                    <div class="tab-content" id="tabvacaciones-tabContent">
                        <div class="tab-pane fade show active" id="tab_listavacaciones" role="tabpanel" aria-labelledby="tab_listavacacionestab"> 
                            <div class="box box-success">
                                <div class="box-header with-border">
                                    <div class="input-group mb-3">
                                        <button type="button" class="btn btn-outline-primary" id="btnNuevoVaca" ><i class="fas fa-plus"></i>Nuevo</button>
                                    </div>
                                </div>                                                
                                <div class="panel-body"> 
                                    <input type="hidden" id="mhdnIdEmpleado" name="mhdnIdEmpleado">                               
                                    <div> 
                                    <table id="tblVacaciones" class="table" style="width:100%">
                                        <thead>
                                        <tr>
                                            <th>F. SALIDA VACACIONES</th>
                                            <th>F. RETORNO VACACIONES</th>
                                            <th>DIAS TOMADOS</th>
                                            <th>DETALLE</th>
                                            <th></th>
                                            <th></th>
                                        </tr>
                                        </thead>
                                        <tbody></tbody>               
                                    </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="tab_newvacaciones" role="tabpanel" aria-labelledby="tab_newvacacionestab"> 
                            <form class="form-horizontal" id="frmMantVacaciones" name="frmMantVacaciones" action="<?= base_url('adm/rrhh/cctrlpermisos/setvacaciones')?>" method="POST" enctype="multipart/form-data" role="form"> 
                                <input type="hidden" id="mhdnIdVaca" name="mhdnIdVaca"> <!-- ID -->
                                <input type="hidden" id="mhdnAccionVaca" name="mhdnAccionVaca">
                                <input type="hidden" id="mhdnEmpVaca" name="mhdnEmpVaca">
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
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-sm-12 text-right"> 
                                            <button type="button" class="btn btn-default" id="btnRetornarVaca">Retornar</button>
                                            <button type="submit" class="btn btn-info" id="mbtnGVaca">Grabar</button>
                                        </div> 
                                    </div>                
                                </div>                       
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal-footer">
            <button type="reset" class="btn btn-default" id="mbtnCVaca" data-dismiss="modal">Cerrar</button>
        </div>
    </div>
  </div>
</div> 
<!-- /.modal-->

<!-- /.modal-permisos --> 
<div class="modal fade" id="modalpermisos" data-backdrop="static" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-xl">
    <div class="modal-content">
        <div class="modal-header text-center bg-success">
            <h4 class="modal-title w-100 font-weight-bold">Permisos</h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body">        
            <div class="card card-success card-outline card-tabs">
                <div class="card-header p-0 pt-1 border-bottom-0">            
                    <ul class="nav nav-tabs" id="tabpermisos" style="background-color: #28a745;" role="tablist">                    
                        <li class="nav-item">
                            <a class="nav-link active" style="color: #000000;" id="tab_listapermisostab" data-toggle="pill" href="#tab_listapermisos" role="tab" aria-controls="tab_listapermisos" aria-selected="true">LISTADO</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" style="color: #000000;" id="tab_newpermisostab" data-toggle="pill" href="#tab_newpermisos" role="tab" aria-controls="tab_newpermisos" aria-selected="false">REGISTRO</a>
                        </li>
                    </ul>
                </div>
                <div class="card-body">
                    <div class="tab-content" id="tabpermisos-tabContent">
                        <div class="tab-pane fade show active" id="tab_listapermisos" role="tabpanel" aria-labelledby="tab_listapermisostab"> 
                            <div class="box box-success">
                                <div class="box-header with-border">
                                    <div class="input-group mb-3">
                                        <button type="button" class="btn btn-outline-primary" id="btnNuevoVaca" ><i class="fas fa-plus"></i>Nuevo</button>
                                    </div>
                                </div>                                                
                                <div class="panel-body"> 
                                    <input type="hidden" id="mhdnIdEmpleado" name="mhdnIdEmpleado">                               
                                    <div> 
                                    <table id="tblPermisos" class="table" style="width:100%">
                                        <thead>
                                        <tr>
                                            <th>FECHA H. PERMISOS</th>
                                            <th>HORAS PERMISOS</th>
                                            <th>HORAS UTILIZADAS</th>
                                            <th></th>
                                            <th></th>
                                        </tr>
                                        </thead>
                                        <tbody></tbody>               
                                    </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="tab_newpermisos" role="tabpanel" aria-labelledby="tab_newpermisostab"> 
                            <form class="form-horizontal" id="frmMantPermisos" name="frmMantPermisos" action="<?= base_url('adm/rrhh/cctrlpermisos/setpermisos')?>" method="POST" enctype="multipart/form-data" role="form"> 
                                <input type="hidden" id="mhdnIdPerm" name="mhdnIdPerm"> <!-- ID -->
                                <input type="hidden" id="mhdnAccionPerm" name="mhdnAccionPerm">
                                <input type="hidden" id="mhdnEmpPerm" name="mhdnEmpPerm">
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
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-sm-12 text-right"> 
                                            <button type="button" class="btn btn-default" id="btnRetornarPerm">Retornar</button>
                                            <button type="submit" class="btn btn-info" id="mbtnGPerm">Grabar</button>
                                        </div> 
                                    </div>                
                                </div>                       
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal-footer">
            <button type="reset" class="btn btn-default" id="mbtnCPerm" data-dismiss="modal">Cerrar</button>
        </div>
    </div>
  </div>
</div> 
<!-- /.modal-->


<!-- Script Generales -->
<script type="text/javascript">
    var baseurl = "<?php echo base_url();?>"; 
</script>