<?php
    $idusu = $this -> session -> userdata('s_idusuario');
    $codusu = $this -> session -> userdata('s_cusuario');
?>

<style>
</style>

<!-- content-header -->
<div class="content-header">   
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1 class="m-0 text-dark">USUARIOS</h1>
      </div>
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="<?php echo public_base_url(); ?>cpanel">Home</a></li>
          <li class="breadcrumb-item active">Seguridad del Sistema</li>
        </ol>
      </div>
    </div>
  </div>
</div>
<!-- /.content-header -->

<!-- Main content -->
<section class="content">
    <div class="container-fluid">  
        <div class="card card-secondary">
            <div class="card-header">
                <h3 class="card-title">BUSQUEDA</h3>
                <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i></button>
                </div>
            </div>
          
            <div class="card-body">
                <input type="hidden" class="form-control" name="hdnidusu" id="hdnidusu" value="<?php echo $idusu ?>">
                <input type="hidden" class="form-control" name="hdncusuario" id="hdncusuario" value="<?php echo $codusu ?>">

                <div class="row">
                    
                    <div class="col-md-8">
                        <div class="form-group">
                            <label>Usuario / CUsuario / Email / Nombres o Apellidos</label>
                            <input type="text" class="form-control" id="txtusuario" name="txtusuario" placeholder="...">
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label>Tipo de Usuario</label>
                            <select class="custom-select" id="cboTusuario" name="cboTusuario" style="width: 100%;">
                                <option value="0" selected="selected">::Todos</option> 
                                <option value="I">Internos</option> 
                                <option value="C">Clientes</option>  
                                <option value="F">FreeLance</option>  
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
                            <button type="button" class="btn btn-outline-info" id="btnNuevo" data-toggle="modal" data-target="#modalCreaUsu"><i class="fas fa-plus"></i> Crear Nuevo</button> 
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-12">
                <div class="card card-outline card-secondary">
                    <div class="card-header">
                        <h3 class="card-title">Listado de Usuarios</h3>
                    </div>
                
                    <div class="card-body" style="overflow-x: scroll;">
                        <table id="tblListUsuarios" class="table table-striped table-bordered" style="width:100%">
                            <thead>
                            <tr>
                                <th></th>
                                <th>CUsuario</th>
                                <th>Usuario</th>
                                <th>Apellidos y Nombres</th>
                                <th>Email</th>
                                <th>Nro Doc.</th>
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

<!-- Reg. Registro Usuario -->
<section class="content" id="contenedorRegusuario" style="display: none" >
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card card-success">
                    <div class="card-body">
                        <?php $this->load->view('seguridad/frm_regusuario'); ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- /.Reg. Registro Usuari -->


<script type="text/javascript">
    var baseurl = "<?php echo base_url();?>"; 
</script>