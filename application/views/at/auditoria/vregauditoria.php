<?php
    $idusu = $this -> session -> userdata('s_idusuario');
?>

<style>
</style>

<!-- content-header -->
<div class="content-header">   
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1 class="m-0 text-dark">AUDITORIA</h1>
      </div>
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="<?php echo public_base_url(); ?>cprincipal/principal">Home</a></li>
          <li class="breadcrumb-item active">Reg. Auditoria</li>
        </ol>
      </div>
    </div>
  </div>
</div>
<!-- /.content-header -->

<!-- Main content -->
<section class="content" style="background-color: #E0F4ED;">
    <div class="container-fluid">  
        <div class="card card-success">
            <div class="card-header">
                <h3 class="card-title">BUSQUEDA</h3>
                <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i></button>
                </div>
            </div>
          
            <div class="card-body">
                <input type="hidden" name="mtxtidusupropu" class="form-control" id="mtxtidusupropu" value="<?php echo $idusu ?>">
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Clientes</label>
                            <select class="form-control select2bs4" id="cboClie" name="cboClie" style="width: 100%;">
                                <option value="" selected="selected">Cargando...</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Establecimiento</label> (Sede, Tienda, Local, etc)
                            <select class="form-control select2bs4" id="cboEstable" name="cboEstable" style="width: 100%;">
                                <option value="" selected="selected">Cargando...</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-3">    
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
                    <div class="col-md-3">      
                        <label>Hasta</label>                      
                        <div class="input-group date" id="txtFHasta" data-target-input="nearest">
                            <input type="text" id="txtFFin" name="txtFFin" class="form-control datetimepicker-input" data-target="#txtFHasta" disabled/>
                            <div class="input-group-append" data-target="#txtFHasta" data-toggle="datetimepicker">
                                <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">  
                        <div class="form-group">
                            <label>Auditor</label> 
                            <select class="form-control select2bs4" id="cboAuditor" name="cboAuditor" style="width: 100%;">
                                <option value="" selected="selected">Cargando...</option>
                            </select>
                        </div>
                    </div>
                </div>
            </div>                
                        
            <div class="card-footer justify-content-between"> 
                <div class="row">
                    <div class="col-md-2"> 
                        <button type="button" class="btn btn-outline-success" id="btnNuevo" data-toggle="modal" data-target="#modalCreaPropu"><i class="fas fa-plus"></i> Crear Nuevo</button>                        
                    </div>
                    <div class="col-md-10">
                        <div class="text-right">
                            <button type="submit" class="btn btn-primary" id="btnBuscar"><i class="fas fa-search"></i> Buscar</button>    
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <div class="card card-outline card-success">
                    <div class="card-header">
                        <h3 class="card-title">Listado de Auditorias - <label id="lblCliente"></label></h3>
                    </div>
                
                    <div class="card-body">
                        <table id="tblListAuditoria" class="table table-striped table-bordered" style="width:100%">
                            <thead>
                            <tr>
                                <th></th>
                                <th>Establecimiento</th>
                                <th>Fecha Auditoria</th>
                                <th>Auditor</th>
                                <th>Nro Informe - Reporte</th>
                                <th>Calificacion</th>
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


<!-- /.modal-crear-auditoria --> 
<div class="modal fade" id="modalCreaaudi" data-backdrop="static" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <form class="form-horizontal" id="frmCreaaudi" name="frmCreaaudi" action="<?= base_url('at/auditoria/cregauditoria/setauditoria')?>" method="POST" enctype="multipart/form-data" role="form"> 

        <div class="modal-header text-center bg-success">
            <h4 class="modal-title w-100 font-weight-bold">Auditoria</h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>

        <div class="modal-body">          
            <input type="hidden" id="mhdnAccionAudi" name="mhdnAccionAudi" value="N">                          
            <div class="form-group">  
                <div class="row">
                    <div class="col-md-4"> 
                        <div class="text-info">Codigo</div>
                        <div>    
                            <input type="text" name="mhdnIdaudi"id="mhdnIdaudi" class="form-control" disabled = true><!-- ID -->
                        </div>
                    </div>
                    <div class="col-md-8"> 
                        <div class="text-info">Clientes</div>
                        <div>
                            <select class="form-control select2bs4" id="cboregClie" name="cboregClie" style="width: 100%;">
                                <option value="" selected="selected">Cargando...</option>
                            </select>
                        </div>
                    </div>
                </div>
            </div>
            <div class="form-group">
                <div class="row">
                    <div class="col-md-12">                        
                        <div class="text-info">Establecimiento (Sede, Tienda, Local, etc)</div>
                        <div>
                            <select class="form-control select2bs4" id="cboregEstable" name="cboregEstable" style="width: 100%;">
                                <option value="" selected="selected">Cargando...</option>
                            </select>
                        </div>
                    </div>                    
                </div> 
            </div>
            <div class="form-group">                
                <div class="row" >
                    <div class="col-12">
                            <h4>
                            <i class="fas fa-weight"></i> REGISTRO
                            <small> - Primera Programacion</small>
                            </h4>
                    </div>  
                </div>
            </div>
            <div class="form-group">
                <div class="row">
                    <div class="col-md-4">       
                        <div class="text-info">Fecha de Auditoria</div>
                        <div class="input-group date" id="txtFechaaudi" data-target-input="nearest">
                            <input type="text" id="txtFAudi" name="txtFAudi" class="form-control datetimepicker-input" data-target="#txtFechaaudi"/>
                            <div class="input-group-append" data-target="#txtFechaaudi" data-toggle="datetimepicker">
                                <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                            </div>
                        </div> 
                    </div>  
                    <div class="col-md-8">                        
                        <div class="text-info">Auditor</div>
                        <div>
                            <select class="form-control select2bs4" id="cboregAuditor" name="cboregAuditor" style="width: 100%;">
                                <option value="" selected="selected">Cargando...</option>
                            </select>
                        </div>
                    </div>                    
                </div>  
            </div>
            <div class="form-group">
                <div class="row">
                    <div class="col-md-4">       
                        <div class="text-info">Sistema</div>
                        <div>
                            <select class="form-control select2bs4" id="cboregSistema" name="cboregSistema" style="width: 100%;">
                                <option value="" selected="selected">Cargando...</option>
                            </select>
                        </div>
                    </div>  
                    <div class="col-md-8">                        
                        <div class="text-info">Rubro</div>
                        <div>
                            <select class="form-control select2bs4" id="cboregRubro" name="cboregRubro" style="width: 100%;">
                                <option value="" selected="selected">Cargando...</option>
                            </select>
                        </div>
                    </div>                    
                </div>  
            </div>
            <div class="form-group">
                <div class="row">
                    <div class="col-md-12">                        
                        <div class="text-info">Checklist</div>
                        <div>
                            <select class="form-control select2bs4" id="cboregChecklist" name="cboregChecklist" style="width: 100%;">
                                <option value="" selected="selected">Cargando...</option>
                            </select>
                        </div>
                    </div>                    
                </div> 
            </div>
            <div class="form-group">
                <div class="row">
                    <div class="col-md-6">                        
                        <div class="text-info">Formula</div>
                        <div>
                            <select class="form-control select2bs4" id="cboregFormula" name="cboregFormula" style="width: 100%;">
                                <option value="" selected="selected">Cargando...</option>
                            </select>
                        </div>
                    </div>                    
                </div> 
            </div>
        </div>

        <div class="modal-footer justify-content-between" style="background-color: #dff0d8;">
            <button type="reset" class="btn btn-default" id="mbtnCCreainsp" data-dismiss="modal">Cancelar</button>
            <button type="submit" class="btn btn-info" id="mbtnGCreainsp">Grabar</button>
        </div>
      </form>
    </div>
  </div>
</div> 
<!-- /.modal-->