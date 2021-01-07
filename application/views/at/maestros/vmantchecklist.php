<?php
?>

<style>
</style>

<!-- content-header -->
<div class="content-header">   
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1 class="m-0 text-dark">MANTENIMIENTO - CHECKLIST</h1>
      </div>
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="<?php echo public_base_url(); ?>cprincipal/principal">Home</a></li>
          <li class="breadcrumb-item active">Maestros - AT</li>
        </ol>
      </div>
    </div>
  </div>
</div>
<!-- /.content-header -->

<!-- Main content -->
<section class="content" style="background-color: #E0F4ED;">
    <div class="container-fluid"> 
        <div class="row">
            <div class="col-12">
                <div class="card card-success card-outline card-tabs">
                    <div class="card-header p-0 pt-1 border-bottom-0">            
                        <ul class="nav nav-tabs" id="tabchecklist" style="background-color: #28a745;" role="tablist">                    
                            <li class="nav-item">
                                <a class="nav-link active" style="color: #000000;" id="tabchecklist-list-tab" data-toggle="pill" href="#tabchecklist-list" role="tab" aria-controls="tabchecklist-list" aria-selected="true">LISTADO</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" style="color: #000000;" id="tabchecklist-reg-tab" data-toggle="pill" href="#tabchecklist-reg" role="tab" aria-controls="tabchecklist-reg" aria-selected="false">CHECKLIST</a>
                            </li>
                        </ul>
                    </div>
                    <div class="card-body">
                        <div class="tab-content" id="tabchecklist-tabContent">
                            <div class="tab-pane fade show active" id="tabchecklist-list" role="tabpanel" aria-labelledby="tabchecklist-list-tab">
                                <div class="card card-success">
                                    <div class="card-header">
                                        <h3 class="card-title">BUSQUEDA</h3>
                                        <div class="card-tools">
                                            <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i></button>
                                        </div>
                                    </div>                        
                                    <div class="card-body">
                                        <div class="row">                                            
                                            <div class="col-md-8">
                                                <div class="form-group">
                                                    <label>Descripción</label>
                                                    <input type="text" class="form-control" id="txtdescripcion" name="txtdescripcion" placeholder="...">
                                                </div>
                                            </div>
                                            
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label>Servicio</label>
                                                    <select class="form-control select2bs4" id="cboservicio" name="cboservicio" style="width: 100%;">
                                                        <option value="" selected="selected">Cargando...</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card-footer justify-content-between" style="background-color: #E0F4ED;"> 
                                        <div class="row">
                                            <div class="col-md-8">
                                                <div class="text-left"> 
                                                    <button type="button" class="btn btn-outline-info" id="btnNuevo"><i class="fas fa-plus"></i> Crear Nuevo</button>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
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
                                                <h3 class="card-title">Listado de Checklist</h3>
                                            </div>                                       
                                            <div class="card-body">
                                                <table id="tblListchecklist" class="table table-striped table-bordered" style="width:100%">
                                                    <thead>
                                                    <tr>
                                                        <th>CODIGO</th>
                                                        <th>DESCRIPCIÓN</th>
                                                        <th>SERVICIO</th>
                                                        <th>SISTEMA</th>
                                                        <th>ORGANISMO</th>
                                                        <th>RUBRO</th>
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
                            <div class="tab-pane fade" id="tabchecklist-reg" role="tabpanel" aria-labelledby="tabchecklist-reg-tab">
                                <fieldset class="scheduler-border">
                                    <legend class="scheduler-border text-primary">REG. CHECKLIST</legend>
                                    <form class="form-horizontal" id="frmRegChecklist" action="<?= base_url('at/maestros/cmantchecklist/setchecklist')?>" method="POST" enctype="multipart/form-data" role="form">
                                        <input type="hidden" id="hdnIdchecklist" name="hdnIdchecklist" class="form-control">
                                        <input type="hidden" id="hdnAccionchecklist" name="hdnAccionchecklist" value="N"> <!-- ACCION -->  
                                        <div class="row">
                                            <div class="col-md-5">
                                                <div class="form-group">
                                                    <label>Descripción</label>
                                                    <input type="text" name="txtregDescripcion"id="txtregDescripcion" class="form-control" >
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <label>Servicio</label>
                                                    <select class="form-control select2bs4" id="cboregServicio" name="cboregServicio" style="width: 100%;">
                                                        <option value="" selected="selected">Cargando...</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-md-2">
                                                <div class="form-group">
                                                    <label>En uso</label>                                                    
                                                    <select class="form-control select2bs4" id="cboregEnuso" name="cboregEnuso" style="width: 100%;">
                                                        <option value="N" selected="selected">NO</option>
                                                        <option value="S">SI</option>
                                                     </select>
                                                </div>
                                            </div>
                                            <div class="col-md-2">
                                                <div class="form-group">
                                                    <label>Estado</label>                                                    
                                                    <select class="form-control select2bs4" id="cboregEstado" name="cboregEstado" style="width: 100%;">
                                                        <option value="A" selected="selected">ACTIVO</option>
                                                        <option value="I">INACTIVO</option>
                                                     </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">                                            
                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <label>Sistema</label>
                                                    <select class="form-control select2bs4" id="cboregSistema" name="cboregSistema" style="width: 100%;">
                                                        <option value="" selected="selected">Cargando...</option>
                                                    </select>
                                                </div>
                                            </div>                                           
                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <label>Organismo</label>
                                                    <select class="form-control select2bs4" id="cboregOrganismo" name="cboregOrganismo" style="width: 100%;">
                                                        <option value="" selected="selected">Cargando...</option>
                                                    </select>
                                                </div>
                                            </div>                                           
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>Rubro</label>
                                                    <select class="form-control select2bs4" id="cboregRubro" name="cboregRubro" style="width: 100%;">
                                                        <option value="" selected="selected">Cargando...</option>
                                                    </select>
                                                </div>
                                            </div>    
                                        </div>
                                        <div class="row">
                                            <div class="col-sm-12 text-right"> 
                                                <button type="submit" class="btn btn-success" id="btnRegistrar"><i class="fas fa-save"></i> Registrar</button>    
                                                <button type="button" class="btn btn-secondary" id="btnRetornarLista"><i class="fas fa-undo-alt"></i> Retornar</button>
                                            </div>
                                        </div>
                                    </form>
                                </fieldset>
                                <fieldset class="scheduler-border">
                                    <legend class="scheduler-border text-primary">REQUISITOS</legend>                                    
                                    <div class="row">
                                        <div class="col-md-6">
                                            <h3 >Listado</h3> 
                                            <div class="card">
                                                <div class="card-body">
                                                    <table id="tablalistaRequisito" class="table table-striped table-bordered" style="width:100%"> 
                                                        <thead>
                                                        <tr>     
                                                            <th>NRO</th> 
                                                            <th>REQUISITO</th>
                                                        </tr>
                                                        </thead>
                                                        <tbody>
                                                        </tbody>                  
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <h3>Registro</h3>
                                            <div class="card">                      
                                            <form class="form-horizontal" id="frmRegRequisito" action="<?= base_url('at/maestros/cmantchecklist/setrequisito')?>" method="POST" enctype="multipart/form-data" role="form">              
                                                <div class="card-body">                    
                                                    <input type="hidden" id="hdnIdrequisito" name="hdnIdrequisito" > <!-- ID -->   
                                                    <input type="hidden" id="hdnAccionrequisito" name="hdnAccionrequisito" value="N"> <!-- ACCION -->                              
                                                    <div class="form-group row">                                                            
                                                        <div class="col-md-8">
                                                            <div class="text-light-blue">Padre Requisito</div>
                                                            <select class="form-control select2bs4" id="cboregPadre" name="cboregPadre" style="width: 100%;">
                                                                <option value="" selected="selected">Cargando...</option>
                                                            </select>
                                                        </div>
                                                        <div class="col-md-4">
                                                            <div class="text-light-blue">Numerador</div>
                                                            <input type="text" name="txtregNumerador"id="txtregNumerador" class="form-control" >
                                                        </div>
                                                    </div> 
                                                    <div class="form-group row">
                                                        <div class="col-sm-12"> 
                                                            <div class="text-light-blue">Descripción</div> 
                                                            <textarea type="text" class="form-control"  name="txtregDescripcion"id="txtregDescripcion"  rows="3" cols="60"></textarea>
                                                        </div>
                                                    </div> 
                                                    <div class="form-group row">
                                                        <div class="col-sm-12"> 
                                                            <div class="text-light-blue">Normativa</div> 
                                                            <textarea type="text" class="form-control"  name="txtregNormativa"id="txtregNormativa"  rows="2" cols="60"></textarea>
                                                        </div>
                                                    </div>                                                      
                                                    <div class="form-group row">
                                                        <div class="col-sm-4 labelcol">   
                                                            <div class="checkbox"><div for="cboregValor" class="text-light-blue">
                                                                <input type="checkbox" id="chkregValor" /> Valor de Evaluación
                                                            </div></div> 
                                                        </div>
                                                        <div class="col-sm-8">
                                                            <div class="row">
                                                                <div class="col-sm-8 col-12">
                                                                    <select id="cboregValor" name="cboregValor" class="form-control" style="width: 98%;">
                                                                        <option value="" selected="selected">Cargando...</option>
                                                                    </select>
                                                                </div>
                                                                <div class="col-sm-4 col-12">
                                                                    <button type="button" class="btn btn-info btn-block" id="btnNuevoregValor">
                                                                        <i class="fa fa-plus"></i> Crear
                                                                    </button>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div> 
                                                    <div class="form-group row">
                                                        <div class="col-md-4">
                                                            <div class="text-light-blue">Excluyente</div>                                                    
                                                            <select class="form-control select2bs4" id="cboregExcluyente" name="cboregExcluyente" style="width: 100%;">
                                                                <option value="N" selected="selected">NO</option>
                                                                <option value="S">SI</option>
                                                            </select>
                                                        </div>
                                                        <div class="col-md-4">
                                                            <div class="text-light-blue">Orden en lista</div>
                                                            <select class="form-control select2bs4" id="cboregOrden" name="cboregOrden" style="width: 100%;">
                                                                <option value="" selected="selected">Cargando...</option>
                                                            </select>
                                                        </div>
                                                        <div class="col-md-4">
                                                            <div class="text-light-blue">Nivel</div>
                                                            <input type="text" name="txtregNivel"id="txtregNivel" class="form-control" >
                                                        </div>
                                                    </div>    
                                                </div>                    
                                                <div class="card-footer">
                                                    <div class="text-right">
                                                    <button type="button" id="btnNuevoCur" class="btn btn-primary">Nuevo</button>
                                                    <button type="submit" id="btnGrabarCur" class="btn btn-success">Guardar</button>
                                                    </div>
                                                </div>
                                            </form>
                                            </div>
                                        </div>
                                    </div>
                                </fieldset>
                            </div>
                        </div>
                    </div>                
                </div>
            </div>
        </div>     
    </div>
</section>
<!-- /.Main content -->