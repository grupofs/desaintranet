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
        <h1 class="m-0 text-dark">MAESTROS - CONTABILIDAD</h1>
      </div>
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="<?php echo public_base_url(); ?>cprincipal/principal">Home</a></li>
          <li class="breadcrumb-item active">Adm - Conta</li>
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
        <!-- Codigos Conta -->          
          <div class="card card-primary">
            <div class="card-header">
              <h4 class="card-title">
                <a data-toggle="collapse"  href="#collapseCodigo">
                  :: Registro de Codigo Conta
                </a>
              </h4>
            </div>
            <div id="collapseCodigo" class="panel-collapse collapse" data-parent="#accordion">
              <div class="card-body">
                <div class="row">
                  <div class="col-md-8">
                    <h3 >Listado</h3> 
                    <div class="card">
                      <div class="card-body">
                          <table id="tablalistaCodigoconta" class="table table-striped table-bordered" style="width:100%"> 
                              <thead>
                              <tr>     
                                <th>#</th> 
                                <th>ID</th> 
                                <th>CODIGO</th> 
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
                    <form class="form-horizontal" id="frmRegCodigoconta" action="<?= base_url('adm/conta/cmaestros/setcodigo')?>" method="POST" enctype="multipart/form-data" role="form">              
                      <div class="card-body">                    
                          <input type="hidden" id="mhdnIdcodigo" name="mhdnIdcodigo" > <!-- ID -->   
                          <input type="hidden" id="mhdnAccionCod" name="mhdnAccionCod" value="N"> <!-- ACCION -->                                 
                              <div class="form-group">
                                <div class="col-sm-6">                                                                                                                                                                                                                                                                                                                                                                                                                                                    
                                    <div class="text-light-blue">Grupo Codigo</div>                
                                    <select id="cbogrupocod" name="cbogrupocod" class="form-control" style="width: 100%;">
                                        <option value="0" selected="selected">:: Elegir</option>
                                        <option value="IN">INGRESOS</option>
                                        <option value="A">GASTOS ADMINISTRATIVOS FIJOS</option> 
                                        <option value="B">GASTOS AREA AT</option>
                                        <option value="C">GASTOS AREA AR</option>
                                        <option value="D">GASTOS AREA TERMOPROCESOS</option>
                                        <option value="G">IMPUESTOS E INVERSIONES</option>
                                        <option value="H">SALDOS POR AREA</option>
                                    </select>
                                </div>
                                <div class="col-sm-12"> 
                                    <div class="text-light-blue">Codigo</div> 
                                    <input class="form-control" id="mtxtcodigo" name="mtxtcodigo" type="text" value="" />                                
                                </div>
                              </div>   
                              <div class="form-group">
                                <div class="col-sm-12"> 
                                    <div class="text-light-blue">Descripcion</div> 
                                    <input class="form-control" id="mtxtcodigodesc" name="mtxtcodigodesc" type="text" value="" />                                
                                </div>
                              </div>    
                      </div>                    
                      <div class="card-footer">
                        <div class="text-right">
                          <button type="button" id="btnNuevoCod" class="btn btn-primary">Nuevo</button>
                          <button type="submit" id="btnGrabarCod" class="btn btn-success">Guardar</button>
                          </div>
                      </div>
                    </form>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        <!-- /Codigos Conta --> 
        </div>
      </div>
    </div>
</section>
<!-- /.Main content -->


<!-- Script Generales -->
<script type="text/javascript">
    var baseurl = "<?php echo base_url();?>"; 
</script>