<?php
    $idusu = $this -> session -> userdata('s_idusuario');
    $codusu = $this -> session -> userdata('s_cusuario');
    $infousuario = $this->session->userdata('s_infodato');
?>

<style>
</style>

<!-- content-header -->
<div class="content-header">   
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1 class="m-0 text-dark">SISTEMAS</h1>
      </div>
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="<?php echo public_base_url(); ?>cprincipal/principal">Home</a></li>
          <li class="breadcrumb-item active">Maestro General Sistemas</li>
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
        <!-- Modulos -->          
          <div class="card card-primary">
            <div class="card-header">
              <h4 class="card-title">
                <a data-toggle="collapse"  href="#collapseModulo">
                  :: Registro de Modulos del Sistema
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
                                <th>CIA</th> 
                                <th>ID</th> 
                                <th>DESCRIPCION</th>
                                <th>TIPO</th> 
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
                    <form class="form-horizontal" id="frmRegModulo" action="<?= base_url('adm/ti/csistemas/setmodulo')?>" method="POST" enctype="multipart/form-data" role="form">              
                      <div class="card-body">                    
                          <input type="hidden" id="mhdnIdmodulo" name="mhdnIdmodulo" > <!-- ID -->   
                          <input type="hidden" id="mhdnAccionMod" name="mhdnAccionMod" value="N"> <!-- ACCION -->                                  
                              <div class="form-group">
                                <div class="col-sm-12">
                                    <div class="text-light-blue">Compañia</div>                
                                    <select id="cboCia" name="cboCia" class="form-control" style="width: 100%;">
                                        <option value="0" selected="selected">:: Elegir</option>
                                        <option value="1">GRUPOFS</option>
                                        <option value="2">FS CERTIFICACIONES</option> 
                                    </select>
                                </div>
                              </div>                          
                              <div class="form-group">
                                <div class="col-sm-12">
                                    <div class="text-light-blue">Area</div> 
                                    <select id="mcboArea" name="mcboArea" class="form-control" style="width: 100%;">
                                    </select>
                                </div>
                              </div>
                              <div class="form-group">
                                <div class="col-sm-12"> 
                                    <div class="text-light-blue">Descripcion</div> 
                                    <input class="form-control" id="mtxtDescrMod" name="mtxtDescrMod" type="text" value="" />                                
                                </div>
                              </div>                         
                              <div class="form-group">
                                <div class="col-sm-12">
                                    <div class="text-light-blue">Tipo Modulo</div>                  
                                    <select id="cbotipo" name="cbotipo" class="form-control" style="width: 100%;">
                                        <option value="M" selected="selected">MODULAR</option>
                                        <option value="D">DASHBOARD</option> 
                                    </select>
                                </div>
                              </div> 
                              <div class="form-group">
                                <div class="col-sm-12"> 
                                    <div class="text-light-blue">Icono</div> 
                                    <input class="form-control" id="mtxticono" name="mtxticono" type="text" value="" />                                
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
        
        <!-- Opciones --> 
          <div class="card card-danger">
            <div class="card-header">
              <h4 class="card-title">
                <a data-toggle="collapse"  href="#collapseOpcion">
                  :: Registro de las Opciones del Menu
                </a>
              </h4>
            </div>
            <div id="collapseOpcion" class="panel-collapse collapse" data-parent="#accordion">
              <div class="card-body">
                <div class="row">
                  <div class="col-md-8">
                    <h3 >Listado</h3> 
                    <div class="card">
                      <div class="card-body">
                          <table id="tablalistaOpcion" class="table table-striped table-bordered" style="width:100%"> 
                              <thead>
                              <tr>     
                                <th>#</th> 
                                <th>CIA</th>
                                <th>MODULO</th> 
                                <th>ID</th> 
                                <th>DESCRIPCION</th> 
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
                    <form class="form-horizontal" id="frmRegOpcion" action="<?= base_url('adm/ti/csistemas/setopcion')?>" method="POST" enctype="multipart/form-data" role="form">              
                      <div class="card-body">                    
                        <input type="hidden" id="mhdnIdopcion" name="mhdnIdopcion" > <!-- ID -->   
                        <input type="hidden" id="mhdnAccionOpc" name="mhdnAccionOpc" value="N"> <!-- ACCION -->                                  
                        <div class="box-body"> <div class="form-group">
                            <div class="col-sm-12">
                                  <div class="text-light-blue">Compañia</div>                
                                  <select id="cboCiaopc" name="cboCiaopc" class="form-control" style="width: 100%;">
                                      <option value="0" selected="selected">:: Elegir</option>
                                      <option value="1">GRUPOFS</option>
                                      <option value="2">FS CERTIFICACIONES</option> 
                                  </select>
                              </div>
                            </div>   
                            <div class="form-group">
                              <div class="col-sm-12">
                                  <div class="text-light-blue">Modulo</div>                
                                  <select id="cboModulo" name="cboModulo" class="form-control select2bs4" style="width: 100%;"></select>
                              </div>
                            </div> 
                            <div class="form-group">
                              <div class="col-sm-12"> 
                                  <div class="text-light-blue">Descripcion</div> 
                                  <input class="form-control" id="mtxtDescOpc" name="mtxtDescOpc" type="text" value="" />
                              </div>
                            </div>
                            <div class="form-group">
                              <div class="col-sm-12"> 
                                  <div class="text-light-blue">Vista Opcion</div> 
                                  <textarea type="text" name="mtxtVentana" class="form-control" id="mtxtVentana"  rows="2" cols="40" required=""></textarea>
                              </div>
                            </div>
                            <div class="form-group">
                              <div class="col-sm-12"> 
                                  <div class="text-light-blue">Script Opcion</div> 
                                  <textarea type="text" name="mtxtJavascript" class="form-control" id="mtxtJavascript"  rows="2" cols="40" required=""></textarea>
                              </div>
                            </div>       
                        </div>   
                      </div>                    
                      <div class="card-footer">
                        <div class="text-right">
                          <button type="button" id="btnNuevoOpc" class="btn btn-primary">Nuevo</button>
                          <button type="submit" id="btnGrabarOpc" class="btn btn-success">Guardar</button>
                          </div>
                      </div>
                    </form>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        <!-- /Opciones --> 

        <!-- Roles -->
          <div class="card card-success">
            <div class="card-header">
              <h4 class="card-title">
                <a data-toggle="collapse"  href="#collapseRol">
                  :: Registro de los Roles de Seguridad
                </a>
              </h4>
            </div>
            <div id="collapseRol" class="panel-collapse collapse" data-parent="#accordion">
              <div class="card-body">
                <div class="row">
                  <div class="col-md-8">
                    <h3 >Listado</h3> 
                    <div class="card">
                      <div class="card-body">
                          <table id="tablalistaRol" class="table table-striped table-bordered" style="width:100%"> 
                              <thead>
                              <tr>     
                                <th>#</th> 
                                <th>CIA</th>
                                <th>DESCRIPCION</th> 
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
                    <form class="form-horizontal" id="frmRegRol" action="<?= base_url('adm/ti/csistemas/setrol')?>" method="POST" enctype="multipart/form-data" role="form">              
                      <div class="card-body">                    
                        <input type="hidden" id="mhdnIdrol" name="mhdnIdrol" > <!-- ID -->   
                        <input type="hidden" id="mhdnAccionRol" name="mhdnAccionRol" value="N"> <!-- ACCION -->                                  
                        <div class="box-body"> <div class="form-group">
                            <div class="col-sm-12">                                                                                                                                                                                                                                                                                                                                                                                                                                                     
                                  <div class="text-light-blue">Compañia</div>                
                                  <select id="cboCiarol" name="cboCiarol" class="form-control" style="width: 100%;">
                                      <option value="0" selected="selected">:: Elegir</option>
                                      <option value="1">GRUPOFS</option>
                                      <option value="2">FS CERTIFICACIONES</option> 
                                  </select>
                              </div>
                            </div>   
                            <div class="form-group">
                              <div class="col-sm-12"> 
                                  <div class="text-light-blue">Descripcion</div> 
                                  <input class="form-control" id="mtxtDescRol" name="mtxtDescRol" type="text" value="" />
                              </div>
                            </div>
                            <div class="form-group">
                              <div class="col-sm-12"> 
                                  <div class="text-light-blue">Comentario</div> 
                                  <textarea type="text" name="mtxtComentario" class="form-control" id="mtxtComentario"  rows="2" cols="40" required=""></textarea>
                              </div>
                            </div>       
                        </div>   
                      </div>                    
                      <div class="card-footer">
                        <div class="text-right">
                          <button type="button" id="btnNuevoRol" class="btn btn-primary">Nuevo</button>
                          <button type="submit" id="btnGrabarRol" class="btn btn-success">Guardar</button>
                          </div>
                      </div>
                    </form>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        <!-- /Roles -->
        
        <!-- Permisos -->
          <div class="card card-secondary">
            <div class="card-header">
              <h4 class="card-title">
                <a data-toggle="collapse" href="#collapsePermiso">
                  :: Registro de Permisos para Usuarios
                </a>
              </h4>
            </div>
            <div id="collapsePermiso" class="panel-collapse collapse" data-parent="#accordion">
              <div class="card-body">
                
                <div class="row">
                  <div class="col-md-6">
                    <h3 >Listado</h3> 
                    <div class="card">
                      <div class="card-body">
                          <div class="row">  
                            <div class="col-md-12">
                              <div class="form-group">
                                  <div class="text-light-blue"><label>ROLES</label></div>                
                                  <select id="cboRolList" name="cboRolList" class="form-control select2bs4" style="width: 100%;"></select>
                              </div>
                            </div>
                          </div>
                          <div class="row">                           
                          <div class="col-md-12">
                            <table id="tablalistaPerm" class="table table-striped table-bordered" style="width:100%"> 
                                <thead>
                                <tr>     
                                  <th>#</th> 
                                  <th>MODULO</th> 
                                  <th>OPCION</th> 
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
                  <div class="col-md-6">
                    <h3>Mantenimiento</h3>
                    <div class="card">                      
                    <form class="form-horizontal" id="frmRegPerm" action="" method="POST" enctype="multipart/form-data" role="form">              
                      <div class="card-body">                    
                        <input type="hidden" id="mhdnIdperm" name="mhdnIperm" > <!-- ID -->   
                        <input type="hidden" id="mhdnAccionPerm" name="mhdnAccionPerm" value="N"> <!-- ACCION -->                                  
                        <div class="box-body">
                          <div class="row"> 
                            <div class="col-sm-6">
                              <div class="form-group">                                                                                                                                                                                                                                                                                                                                                                                                                                                     
                                  <div class="text-light-blue">Compañia</div>                
                                  <select id="cboCiaperm" name="cboCiaperm" class="form-control" style="width: 100%;">
                                      <option value="0" selected="selected">:: Elegir</option>
                                      <option value="1">GRUPOFS</option>
                                      <option value="2">FS CERTIFICACIONES</option> 
                                  </select>
                              </div> 
                            </div>
                            <div class="col-sm-6">
                              <div class="form-group">
                                  <div class="text-light-blue">Rol</div>                
                                  <select id="cboRolperm" name="cboRolperm" class="form-control select2bs4" style="width: 100%;"></select>
                              </div>
                            </div>  
                          </div> 
                          <div class="row">
                            <div class="col-sm-6">
                              <div class="form-group">
                                  <div class="text-light-blue">Modulo</div>                
                                  <select id="cboModulopem" name="cboModulopem" class="form-control select2bs4" style="width: 100%;"></select>
                              </div>
                            </div> 
                            <div class="col-sm-6">
                              <div class="form-group"> 
                                <div class="text-light-blue">&nbsp;</div>     
                                <div class="text-right">
                                  <button type="button" id="btnRecuperaRol" class="btn btn-primary">Recuperar</button>
                                </div>
                              </div>
                            </div> 
                          </div> 
                          <div class="row"> 
                            <div class="col-12">
                              <div class="form-group">
                                <label>Asignar Permisos</label>
                                <div class="row">
                                  <div class="col-6">
                                    <table id="tablalistaOpcmod" class="table table-striped table-bordered" style="width:100%"> 
                                        <thead>
                                        <tr>     
                                          <th>Opcion de Modulo</th> 
                                          <th></th>  
                                        </tr>
                                        </thead>
                                        <tbody>
                                        </tbody>                  
                                    </table>
                                  </div>
                                  <div class="col-6">
                                    <table id="tablalistaOpcrol" class="table table-striped table-bordered" style="width:100%"> 
                                        <thead>
                                        <tr>     
                                          <th></th> 
                                          <th>Opcion de Rol</th>   
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
                        </div>   
                      </div>  
                    </form>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        <!-- /Permisos -->
        </div>
      </div>
    </div>
</section>
<!-- /.Main content -->


<!-- Script Generales -->
<script type="text/javascript">
    var baseurl = "<?php echo base_url();?>"; 
</script>