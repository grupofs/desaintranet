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
        <h1 class="m-0 text-dark">MANTENIMIENTO CAPACITACIONES</h1>
      </div>
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="<?php echo public_base_url(); ?>cprincipal/principal">Home</a></li>
          <li class="breadcrumb-item active">Aprendizaje</li>
        </ol>
      </div>
    </div>
  </div>
</div>
<!-- /.content-header -->

<!-- Main content -->
<section class="content">
    <div class="container-fluid">       
      <div class="card-body">
        <div id="accordion">
        <!-- Cursos -->         
          <div class="card card-warning">
            <div class="card-header">
              <h4 class="card-title">
                <a data-toggle="collapse"  href="#collapseCurso">
                  :: Registro de Cursos
                </a>
              </h4>
            </div>
            <div id="collapseCurso" class="panel-collapse collapse" data-parent="#accordion">
              <div class="card-body">
                <div class="row">
                  <div class="col-md-8">
                    <h3 >Listado</h3> 
                    <div class="card">
                      <div class="card-body">
                          <table id="tablalistaCursos" class="table table-striped table-bordered" style="width:100%"> 
                              <thead>
                              <tr>     
                                <th>#</th> 
                                <th>DESCRIPCION</th>
                                <th>COMENTARIO</th> 
                                <th></th> 
                              </tr>
                              </thead>
                              <tbody>
                              </tbody>                  
                          </table>
                      </div>

                    </div>
                  </div>
                  <div class="col-md-4">
                    <h3>Mantenimiento</h3>
                    <div class="card">                      
                    <form class="form-horizontal" id="frmRegCurso" action="<?= base_url('at/capa/cmantcapa/setcurso')?>" method="POST" enctype="multipart/form-data" role="form">              
                      <div class="card-body">                    
                          <input type="hidden" id="mhdnIdcurso" name="mhdnIdcurso" > <!-- ID -->   
                          <input type="hidden" id="mhdnAccionCur" name="mhdnAccionCur" value="N"> <!-- ACCION -->                              
                            <div class="form-group">
                                <div class="col-sm-12"> 
                                    <div class="text-light-blue">Descripcion</div> 
                                    <input class="form-control" id="mtxtDescCur" name="mtxtDescCur" type="text" value="" />                                
                                </div>
                            </div> 
                            <div class="form-group">
                                <div class="col-sm-12"> 
                                    <div class="text-light-blue">Comentario</div> 
                                    <textarea type="text" class="form-control"  name="mtxtComenCur"id="mtxtComenCur"  rows="2" cols="40"></textarea>
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
              </div>
            </div>
          </div>
        <!-- /Cursos -->
        <!-- Modulos -->         
          <div class="card card-primary">
            <div class="card-header">
              <h4 class="card-title">
                <a data-toggle="collapse"  href="#collapseModulo">
                  :: Registro de Tema
                </a>
              </h4>
            </div>
            <div id="collapseModulo" class="panel-collapse collapse" data-parent="#accordion">
              <div class="card-body">
                <div class="row">
                  <div class="col-md-8">
                    <h3 >Listado</h3> 
                    <div class="card">
                      <div class="card-body">
                          <table id="tablalistaModulos" class="table table-striped table-bordered" style="width:100%"> 
                              <thead>
                              <tr>     
                                <th>#</th> 
                                <th>CURSOS</th> 
                                <th>TEMA</th>
                                <th></th> 
                              </tr>
                              </thead>
                              <tbody>
                              </tbody>                  
                          </table>
                      </div>

                    </div>
                  </div>
                  <div class="col-md-4">
                    <h3>Mantenimiento</h3>
                    <div class="card">                      
                    <form class="form-horizontal" id="frmRegModulo" action="<?= base_url('at/capa/cmantcapa/setmodulo')?>" method="POST" enctype="multipart/form-data" role="form">              
                        <div class="card-body">                    
                          <input type="hidden" id="mhdnIdmodulo" name="mhdnIdmodulo" > <!-- ID -->   
                          <input type="hidden" id="mhdnAccionMod" name="mhdnAccionMod" value="N"> <!-- ACCION -->                          
                            <div class="form-group">
                                <div class="col-sm-12">
                                    <div class="text-light-blue">Curso</div> 
                                    <select id="mcboCurso" name="mcboCurso" class="form-control" style="width: 100%;">
                                        <option value="" selected="selected">Cargando...</option>
                                    </select>
                                </div>
                            </div>                             
                            <div class="form-group">
                                <div class="col-sm-12"> 
                                    <div class="text-light-blue">Tema</div> 
                                    <input class="form-control" id="mtxtDescMod" name="mtxtDescMod" type="text" value="" />                                
                                </div>
                            </div> 
                            <div class="form-group">
                                <div class="col-sm-12"> 
                                    <div class="text-light-blue">Comentario</div> 
                                    <textarea type="text" name="mtxtComenMod" class="form-control" id="mtxtComenMod"  rows="2" cols="40" required=""></textarea>
                                </div>
                            </div>     
                        </div>                     
                        <div class="card-footer">
                            <div class="text-right">
                                <button type="button" id="btnNuevoMod" class="btn btn-primary">Nuevo</button>
                                <button type="submit" id="btnGrabarMod" class="btn btn-success">Guardar</button>
                            </div>
                        </div>
                    </form>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        <!-- /Modulos -->
        <!-- Expositor -->         
          <div class="card card-secondary">
            <div class="card-header">
              <h4 class="card-title">
                <a data-toggle="collapse"  href="#collapseExpositor">
                  :: Registro del Expositor
                </a>
              </h4>
            </div>
            <div id="collapseExpositor" class="panel-collapse collapse" data-parent="#accordion">
              <div class="card-body">
                <div class="row">
                  <div class="col-md-8">
                    <h3 >Listado</h3> 
                    <div class="card">
                      <div class="card-body">
                          <table id="tablalistaExpositor" class="table table-striped table-bordered" style="width:100%"> 
                              <thead>
                              <tr>     
                                <th>#</th> 
                                <th>NRO DNI</th>
                                <th>EXPOSITOR</th>  
                                <th></th> 
                              </tr>
                              </thead>
                              <tbody>
                              </tbody>                  
                          </table>
                      </div>

                    </div>
                  </div>
                  <div class="col-md-4">
                    <h3>Mantenimiento</h3>
                    <div class="card">                      
                    <form class="form-horizontal" id="frmRegExpositor" action="<?= base_url('at/capa/cmantcapa/setexpositor')?>" method="POST" enctype="multipart/form-data" role="form">              
                      <div class="card-body">                    
                          <input type="hidden" id="mhdnIdexpositor" name="mhdnIdexpositor" > <!-- ID -->   
                          <input type="hidden" id="mhdnAccionExpo" name="mhdnAccionExpo" value="N"> <!-- ACCION -->                                  
                            <div class="form-group">
                                <div class="col-sm-12">
                                    <div class="text-light-blue">Buscar Persona</div> 
                                    <div class="input-group mb-3" id="expotxt">
                                        <input type="text" name="mtxtExpositor" class="form-control" id="mtxtExpositor" /> 
                                        <span class="input-group-append">
                                            <button type="button" id="btnBuscarAdmi" class="btn btn-info btn-flat" data-toggle="modal" data-target="#modaladministrado"><i class="fas fa-external-link-square-alt"></i></button>
                                        </span> 
                                    </div>   
                                    <input type="hidden" id="hdnidadmi" name="hdnidadmi">
                                </div>
                            </div>  
                            <div class="form-group">
                                <div class="col-sm-12"> 
                                    <div class="text-light-blue">Nro. Colegiatura</div> 
                                    <input class="form-control" id="mtxtnrocole" name="mtxtnrocole" type="text" />                                
                                </div>
                            </div>  
                      </div>                    
                      <div class="card-footer">
                        <div class="text-right">
                          <button type="button" id="btnNuevoExpo" class="btn btn-primary">Nuevo</button>
                          <button type="submit" id="btnGrabExpo" class="btn btn-success">Guardar</button>
                          </div>
                      </div>
                    </form>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        <!-- /Expositor -->
        </div>
      </div>      
    </div>
</section>
<!-- /.Main content -->

<!-- /.modal-administrado --> 
<div class="modal fade" id="modaladministrado" data-backdrop="static" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
        <div class="modal-header text-center bg-success">
            <h4 class="modal-title w-100 font-weight-bold">Seleccionar Administrado</h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body">        
            <div class="card card-success card-outline card-tabs">
                <div class="card-header p-0 pt-1 border-bottom-0">            
                    <ul class="nav nav-tabs" id="tabadministrado" style="background-color: #28a745;" role="tablist">                    
                        <li class="nav-item">
                            <a class="nav-link active" style="color: #000000;" id="tab_listaadministradotab" data-toggle="pill" href="#tab_listaadministrado" role="tab" aria-controls="tab_listaadministrado" aria-selected="true">LISTADO</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" style="color: #000000;" id="tab_newadministradotab" data-toggle="pill" href="#tab_newadministrado" role="tab" aria-controls="tab_newadministrado" aria-selected="false">REGISTRO</a>
                        </li>
                    </ul>
                </div>
                <div class="card-body">
                    <div class="tab-content" id="tabadministrado-tabContent">
                        <div class="tab-pane fade show active" id="tab_listaadministrado" role="tabpanel" aria-labelledby="tab_listaadministradotab"> 
                            <div class="box box-success">
                                <div class="box-header with-border">
                                    <div class="input-group mb-3">
                                      Nombres / Nro Doc. :&nbsp;&nbsp;<input type="text" class="form-control" name="txtbuscar" id="txtbuscar">
                                        <span class="input-group-append">
                                            <button type="button" id="btnBuscarAdm" class="btn btn-info btn-flat"><i class="fa fa-search"></i></button>
                                        </span>&nbsp;&nbsp;
                                        <button type="button" class="btn btn-outline-primary" id="btnNuevoAdm" ><i class="fas fa-plus"></i>Nuevo</button>
                                    </div>
                                </div>                                                
                                <div class="panel-body">                                
                                    <div> 
                                    <table id="tblAdministrado" class="table" style="width:100%">
                                        <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Tipo Doc.</th>            
                                            <th>Nro. Doc</th>
                                            <th>Nombres y Apellidos</th>
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
                        <div class="tab-pane fade" id="tab_newadministrado" role="tabpanel" aria-labelledby="tab_newadministradotab"> 
                            <form class="form-horizontal" id="frmMantAdministrado" name="frmMantAdministrado" action="<?= base_url('cglobales/setadministrado')?>" method="POST" enctype="multipart/form-data" role="form"> 
                                <input type="hidden" id="mhdnIdAdministrado" name="mhdnIdAdministrado"> <!-- ID -->
                                <input type="hidden" id="mhdnAccionAdministrado" name="mhdnAccionAdministrado">
                                <div class="form-group">
                                    <div class="row"> 
                                        <div class="col-sm-3">
                                          <div class="text-info">Tipo/Nro. Doc.</div>
                                          <div>   
                                              <div class="input-group mb-3">
                                                  <div class="input-group-prepend">
                                                      <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown">
                                                      <span id="btntipodoc">DNI</span>
                                                      </button>
                                                      <div class="dropdown-menu">
                                                          <a class="dropdown-item" onClick="javascript:tdDNI()">DNI</a>
                                                          <a class="dropdown-item" onClick="javascript:tdCEXT()">C.EXT.</a>
                                                      </div>
                                                  </div>
                                                  <!-- /btn-group -->
                                                  <input type="text" name="mtxtnrodoc" id="mtxtnrodoc" class="form-control" data-validation="required"/>
                                              </div> 
                                                                            
                                              <input type="hidden" name="txttipodoc" id="txttipodoc">  
                                          </div>
                                        </div>   
                                        <div class="col-sm-3">
                                            <div class="text-info">Sexo</div>                                        
                                            <div>                            
                                                <select class="form-control" id="cbosexo" name="cbosexo">
                                                    <option value = "M" selected="selected">Masculino</option>
                                                    <option value = "F">Femenino</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="text-info">Nombres</div>
                                            <div>
                                                <input type="text" class="form-control" name="txtNombre" id="txtNombre">
                                            </div>
                                        </div>                              
                                    </div>                
                                </div> 
                                <div class="form-group">
                                    <div class="row"> 
                                        <div class="col-sm-6">
                                            <div class="text-info">Apellido Paterno</div>
                                            <div>
                                                <input type="text" class="form-control" name="txtApepat" id="txtApepat">
                                            </div>
                                        </div> 
                                        <div class="col-sm-6">
                                            <div class="text-info">Apellido Paterno</div>
                                            <div>
                                                <input type="text" class="form-control" name="txtApemat" id="txtApemat">
                                            </div>
                                        </div> 
                                    </div>                
                                </div> 
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-sm-6">
                                            <div class="text-info">Email</div>
                                            <div>
                                                <input type="text" class="form-control" name="txtemail" id="txtemail">
                                            </div>
                                        </div>  
                                        <div class="col-sm-3">
                                            <div class="text-info">Celular</div>
                                            <div>
                                                <input type="text" class="form-control" name="txtcelular" id="txtcelular">
                                            </div>
                                        </div>   
                                        <div class="col-sm-3">
                                            <div class="text-info">Telefono</div>
                                            <div>
                                                <input type="text" class="form-control" name="txttelefono" id="txttelefono">
                                            </div>
                                        </div> 
                                    </div>                
                                </div>
                                <div class="form-group">
                                    <div class="row"> 
                                        <div class="col-sm-12">
                                            <div class="text-info">Dirección</div>
                                            <div>
                                                <input type="text" class="form-control" name="txtdireccion" id="txtdireccion">
                                            </div>
                                        </div>   
                                    </div>                
                                </div>
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-sm-12 text-right"> 
                                          <button type="submit" class="btn btn-success" id="btnGabarAdm"><i class="fas fa-save"></i> Grabar</button> 
                                          <button type="button" class="btn btn-secondary" id="btnRetornarAdm"><i class="fas fa-undo-alt"></i> Retornar</button>
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
        <button type="reset" class="btn btn-default" id="mbtnCAdm" data-dismiss="modal">Cerrar</button>
        </div>
    </div>
  </div>
</div> 
<!-- /.modal-->

<!-- Script Generales -->
<script type="text/javascript">
    var baseurl = "<?php echo base_url();?>"; 
</script>