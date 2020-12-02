<?php
    $idusu = $this -> session -> userdata('s_idusuario');
    $codusu = $this -> session -> userdata('s_cusuario');
    $infousuario = $this->session->userdata('s_infodato');
?>

<style>
    .fileUpload {
        position: relative;
        overflow: hidden;
        margin: 0px;
    }
    .fileUpload input.upload {
        position: absolute;
        top: 0;
        right: 0;
        margin: 0;
        padding: 0;
        cursor: pointer;
        opacity: 0;
        filter: alpha(opacity=0);
    }
</style>

<!-- content-header -->
<div class="content-header">   
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1 class="m-0 text-dark">PROPUESTAS</h1>
      </div>
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="<?php echo public_base_url(); ?>cprincipal/principal">Home</a></li>
          <li class="breadcrumb-item active">Gestion Procesos Termicos</li>
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
        <form class="form-horizontal" id="frmbuscahomo" name="frmbuscahomo" action="<?= base_url('pt/cpropuesta/excelpropu')?>" method="POST" enctype="multipart/form-data" role="form"> 
            <div class="card-header">
                <h3 class="card-title">BUSQUEDA</h3>
                <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i></button>
                </div>
            </div>
          
            <div class="card-body">
                <input type="hidden" name="mtxtidusupropu" class="form-control" id="mtxtidusupropu" value="<?php echo $idusu ?>">
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label>Clientes</label>
                            <select class="form-control select2bs4" id="cboClie" name="cboClie" style="width: 100%;">
                                <option value="" selected="selected">Cargando...</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-4">    
                        <div class="checkbox"><label>
                            <input type="checkbox" id="chkFreg" /> <b>Fecha Registro :: Del</b>
                        </label></div>                        
                        <div class="input-group date" id="txtFDesde" data-target-input="nearest" >
                            <input type="text" id="txtFIni" name="txtFIni" class="form-control datetimepicker-input" data-target="#txtFDesde" disabled/>
                            <div class="input-group-append" data-target="#txtFDesde" data-toggle="datetimepicker">
                                <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">      
                        <label>Hasta</label>                      
                        <div class="input-group date" id="txtFHasta" data-target-input="nearest">
                            <input type="text" id="txtFFin" name="txtFFin" class="form-control datetimepicker-input" data-target="#txtFHasta" disabled/>
                            <div class="input-group-append" data-target="#txtFHasta" data-toggle="datetimepicker">
                                <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label>Servicios</label>
                            <select class="select2bs4" id="cboServ" name="cboServ" multiple="multiple" data-placeholder="Seleccionar" style="width: 100%;">
                                <option value="" selected="selected">Cargando...</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label>Nro / Detalle Propuesta</label>
                            <input type="text" class="form-control" id="txtnrodet" name="txtnrodet" placeholder="...">
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label>Estado</label>
                            <select class="select2bs4" id="cboEst" name="cboEst[]" multiple="multiple" data-placeholder="Seleccionar" style="width: 100%;">
                                
                                <option value="1">Aceptado</option>  
                                <option value="2">Pendiente</option>  
                                <option value="3">Rechazado</option>  
                                <option value="4">Reemplazada</option>  
                                <option value="5">Referencial</option>  
                            </select>
                        </div>
                    </div>
                </div>
            </div>                
                        
            <div class="card-footer justify-content-between"> 
                <div class="row">
                    <div class="col-md-2"> 
                        <div id="console-event"></div>                   
                        <input type="checkbox" name="swVigencia" id="swVigencia" data-toggle="toggle" checked data-bootstrap-switch  data-on-text="Activos" data-off-text="Inactivos">
                    </div>
                    <div class="col-md-10">
                        <div class="text-right">
                            <button type="button" class="btn btn-primary" id="btnBuscar"><i class="fas fa-search"></i> Buscar</button>    
                            <button type="button" class="btn btn-outline-info" id="btnNuevo" data-toggle="modal" data-target="#modalCreaPropu"><i class="fas fa-plus"></i> Crear Nuevo</button>
                            <button type="submit" class="btn btn-info" id="btnexcel" disabled="true"><i class="fa fw fa-file-excel-o"></i> Exportar Excel</button>  
                        </div>
                    </div>
                </div>
            </div>
        </form>
        </div>
        <div class="row">
            <div class="col-12">
                <div class="card card-outline card-success">
                    <div class="card-header">
                        <h3 class="card-title">Listado de Propuestas</h3>
                    </div>
                
                    <div class="card-body">
                        <table id="tblListPropuesta" class="table table-striped table-bordered" style="width:100%">
                            <thead>
                            <tr>
                                <th></th>
                                <th>N° Propuesta</th>
                                <th>Cliente</th>
                                <th>Detalle Propuesta</th>
                                <th>Costo</th>
                                <th>Fecha</th>
                                <th>Establecimiento</th>
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

<!-- /.modal-crear-propuesta --> 
<div class="modal fade" id="modalCreaPropu" data-backdrop="static" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <form class="form-horizontal" id="frmCreaPropu" name="frmCreaPropu" action="<?= base_url('pt/cpropuesta/setpropuesta')?>" method="POST" enctype="multipart/form-data" role="form"> 

        <div class="modal-header text-center bg-success">
            <h4 class="modal-title w-100 font-weight-bold">Registro de Propuesta</h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>

        <div class="modal-body">          
            <input type="hidden" id="mhdnIdPropu" name="mhdnIdPropu"> <!-- ID -->
            <input type="hidden" id="mhdnAccionPropu" name="mhdnAccionPropu" value="">

            <input type="hidden" id="mtxtidusupropu" name="mtxtidusupropu"  value="<?php echo $idusu ?>">
            <input type="hidden" id="mtxtuserpropu" name="mtxtuserpropu" value="<?php echo $codusu ?>">
            <input type="hidden" id="mtxtinfousuario" name="mtxtinfousuario"  value="<?php echo $infousuario ?>">
            <input type="hidden" id="mhdnEstadoPropu" name="mhdnEstadoPropu" value="2"> 
                        
            <div class="form-group">
                <div class="row">
                    <div class="col-sm-8">
                        <div class="text-info">Cliente <span class="text-requerido">*</span></div>
                        <div>                            
                            <select class="form-control select2bs4 addcliente" id="mcboClie" name="mcboClie" style="width: 100%;">
                                <option value="" selected="selected">Cargando...</option>
                            </select>
                        </div>
                    </div>                      
                    <div class="col-sm-4">
                        <div class="text-info">Fecha Propuesta</div>
                        <div class="input-group date" id="mtxtFregpropuesta" data-target-input="nearest">
                            <input type="text" id="mtxtFpropu" name="mtxtFpropu" class="form-control datetimepicker-input" data-target="#mtxtFregpropuesta"/>
                            <div class="input-group-append" data-target="#mtxtFregpropuesta" data-toggle="datetimepicker">
                                <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                            </div>
                        </div>                        
                    </div>
                </div>                
            </div> 
            <div class="form-group">
                <div class="row">                
                    <div class="col-sm-6">
                        <div class="text-info">Establecimiento</div>
                        <div>
                            <select class="form-control select2bs4" id="mcboEstable" name="mcboEstable">
                            <option value="">Cargando...</option>
                            </select>
                        </div>
                    </div>                
                    <div class="col-sm-6">
                        <div class="text-info">Servicio <span style="color: #FD0202">*</span></div>
                        <div>
                            <select class="form-control" id="mcboServPropu" name="mcboServPropu" data-validation="required">
                            <option value="">Cargando...</option>
                            </select>
                        </div>
                    </div> 
                </div>                
            </div> 
            <div class="form-group">
                <div class="row">                
                    <div class="col-sm-6">                             
                        <div class="checkbox" id="lbchkpro">
                            <div class="text-info">Nro Propuesta  &nbsp;&nbsp;
                                <b><input type="checkbox" id="chkNroAntiguo" name="chkNroAntiguo" > Antiguo</b>
                            </div>
                        </div>                           
                        <div>                            
                            <input type="text" name="mtxtNropropuesta" class="form-control" id="mtxtNropropuesta"/> 
                            <span style="color: #b94a48">Ej. 0100-2018/PT/FS</span>
                            <br>
                            <span style="color: #b94a48">Ej. 0100B-2018/PT/FS</span>
                        </div>
                    </div>          
                    <div class="col-sm-3">
                        <div class="text-info">Servicio Nuevo <span style="color: #FD0202">*</span></div>
                        <div>                            
                            <select class="form-control" id="mtxtservnew" name="mtxtservnew" data-validation="required">
                                <option value="">:: Elija</option>
                                <option value="S">SI</option>
                                <option value="N">NO</option>
                            </select>
                        </div>
                    </div>               
                    <div class="col-sm-3">
                        <div class="text-info">Cliente Nuevo <span style="color: #FD0202">*</span></div>
                        <div>                            
                            <select class="form-control" id="mtxtClientePote" name="mtxtClientePote" data-validation="required">
                                <option value="">:: Elija</option>
                                <option value="S">SI</option>
                                <option value="N">NO</option>
                            </select>
                        </div>
                    </div> 
                </div>                
            </div> 
            <div class="form-group">
                <div class="row">                
                    <div class="col-sm-4">
                        <div class="text-info">Costo <span style="color: #FD0202">*</span></div>
                        <div>   
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown">
                                    <span id="btntipomoneda">$</span>
                                    </button>
                                    <div class="dropdown-menu">
                                        <a class="dropdown-item" onClick="javascript:tcDolar()">$</a>
                                        <a class="dropdown-item" onClick="javascript:tcSol()">S/.</a>
                                    </div>
                                </div>
                                <!-- /btn-group -->
                                <input type="number" name="mtxtCostoPropu" class="form-control" id="mtxtCostoPropu" data-validation="required"/>
                            </div> 
                                                           
                            <input type="hidden" name="txtTipomoneda" id="txtTipomoneda">  
                        </div> 
                    </div>                 
                    <div class="col-sm-8">                           
                        <div class="checkbox" id="lbchkcontact">
                            <div class="text-info">Contacto  &nbsp;&nbsp;
                                <b><input type="checkbox" id="chkContacto" name="chkContacto" > Externo</b>
                            </div>
                        </div>  
                        <div> 
                            <div class="input-group mb-3" id="contactxt">
                                <input type="text" name="mtxtContacPropu" class="form-control" id="mtxtContacPropu" /> 
                                <span class="input-group-append">
                                    <button type="button" id="btncontacto" class="btn btn-info btn-flat"><i class="fas fa-external-link-square-alt"></i></button>
                                </span> 
                            </div>                            
                            <div class="input-group mb-3" id="contacsel">
                                <select class="form-control select2bs4" id="mcboContact" name="mcboContact" style="width: 80%;">
                                    <option value="" selected="selected">Cargando...</option>
                                </select>
                                <span class="input-group-append">
                                    <button type="button" id="btCercontact" class="btn btn-danger btn-flat" ><i class="fas fa-window-close"></i></button>
                                </span>
                            </div>
                        </div> 
                    </div> 
                </div>                
            </div>
            <div class="form-group">
                <div class="row">                
                    <div class="col-sm-12">
                        <div class="text-info">Archivo</div>                        
                        <div class="input-group">
                            <input class="form-control" type="text" name="mtxtNomarchpropu" id="mtxtNomarchpropu">                            
                            <span class="input-group-append">                                
                                <div class="fileUpload btn btn-secondary">
                                    <span>Subir Archivo</span>
                                    <input type="file" class="upload" id="mtxtArchivopropu" name="mtxtArchivopropu" onchange="escogerArchivo()"/>                      
                                </div> 
                            </span>  
                        </div>
                        <span style="color: red; font-size: 13px;">+ Los archivos deben estar en formato pdf, docx o xlsx y no deben pesar mas de 60 MB</span>                        
                        <input type="hidden" name="mtxtRutapropu" id="mtxtRutapropu">
                        <input type="hidden" name="mtxtarchivo" id="mtxtarchivo">
                        <input type="hidden" name="sArchivo" id="sArchivo" value="N"> 
                    </div> 
                </div>
            </div>
            <div class="form-group">
                <div class="row">                
                    <div class="col-sm-12">
                        <div class="text-info">Detalle <span style="color: #FD0202">*</span></div>
                        <div>   
                            <textarea class="form-control" cols="20" data-val="true" data-val-length="No debe superar los 500 caracteres." data-val-length-max="500" id="mtxtDetaPropu" name="mtxtDetaPropu" rows="2" data-val-maxlength-max="500" data-validation="required"></textarea>
                            <span class="help-inline" style="padding-left:0px; color:#999; font-size:0.9em;">Caracteres: 0 / 500</span>    
                        </div> 
                    </div> 
                </div>                
            </div> 
            <div class="form-group">
                <div class="row">                
                    <div class="col-sm-12">
                        <div class="text-info">Observación Propuesta</div>
                        <div>   
                            <textarea class="form-control" cols="20" data-val="true" data-val-length="No debe superar los 500 caracteres." data-val-length-max="500" id="mtxtObspropu" name="mtxtObspropu" rows="2" data-val-maxlength-max="500" data-validation="required"></textarea>
                            <span class="help-inline" style="padding-left:0px; color:#999; font-size:0.9em;">Caracteres: 0 / 500</span>     
                        </div> 
                    </div> 
                </div>                
            </div>             
        </div>

        <div class="modal-footer justify-content-between" style="background-color: #dff0d8;">
            <button type="reset" class="btn btn-default" id="mbtnCCreaPropu" data-dismiss="modal">Cancelar</button>
            <button type="submit" class="btn btn-info" id="mbtnGCreaPropu">Grabar</button>
        </div>
      </form>
    </div>
  </div>
</div> 
<!-- /.modal-->

<!-- /.modal-det-documentos --> 
<div class="modal fade" id="modalDetaPropu" data-backdrop="static" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <form class="form-horizontal" id="frmDetaPropu" name="frmDetaPropu" action="<?= base_url('pt/cpropuesta/setdetpropuesta')?>" method="POST" enctype="multipart/form-data" role="form"> 

        <div class="modal-header text-center bg-success">
            <h4 class="modal-title w-100 font-weight-bold">Documentos de Propuesta</h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
            
        <div class="modal-body">
            <div class="form-group">
                <div class="row">                
                    <div class="col-sm-12">
                        <input type="hidden" name="mtxtiddetapropu" id="mtxtiddetapropu" class="form-control">
                        <input type="hidden" name="mtxtfechadetapropu" id="mtxtfechadetapropu" class="form-control">
                        <input type="hidden" name="mtxtnrodetapropu" id="mtxtnrodetapropu" class="form-control">
                        <input type="hidden" name="mtxtcantdetapropu" id="mtxtcantdetapropu" class="form-control">
                        <div class="text-info">Archivos</div>
                        <div class="custom-file">
                            <input type="file" class="custom-file-input" id="mtxtDetArchivopropu" name="mtxtDetArchivopropu[]" multiple size="20" onchange="subirDetPropuesta()">
                            <span style="color: red">+ Los documentos deben estar en formato pdf, docx o xlsx</span> 
                            <br>
                            <span style="color: red">+ Los archivos no deben pesar mas de 60 MB</span> 
                            <label class="custom-file-label" for="mtxtArchivopropu">Escoger Archivo</label>
                        </div>
                    </div>
                </div>
            </div>
            <table id="tblDetapropu" class="table table-striped table-bordered" style="width:100%">
                <thead>
                <tr>
                    <th style="min-width: 5px; max-width:10px;">Nro.</th>       
                    <th>Nombre</th> 
                    <th style="min-width: 50px; max-width: 50px;">Archivo</th>
                    <th style="min-width: 50px; max-width: 50px;"></th>
                </tr>
                </thead> 
            </table>  
        </div>

        <div class="modal-footer">
            <button type="button" class="btn btn-outline-info" id="btnnewguia" name="btnnewguia" data-toggle="modal" data-target="#modalNewDetaPropu"><i class="fa fa-newspaper-o"></i> Crear Nuevo</button> 
            <button type="button" class="btn btn-default" data-dismiss="modal"><i class="fa fa-fw fa-close"></i> Cerrar</button>
        </div>
       </form>
    </div>
   </div>
</div>
<!-- /.modal-->

<script type="text/javascript">
    var baseurl = "<?php echo base_url();?>"; 
</script>