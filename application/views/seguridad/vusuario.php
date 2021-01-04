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
          <li class="breadcrumb-item"><a href="<?php echo public_base_url(); ?>main">Home</a></li>
          <li class="breadcrumb-item active">Seguridad del Sistema</li>
        </ol>
      </div>
    </div>
  </div>
</div>
<!-- /.content-header -->

<!-- Main content -->
<section class="content" id="contenedorBususuario">
    <div class="container-fluid">  
        <div class="card card-success">
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
                            <button type="button" class="btn btn-outline-info" id="btnNuevo" onClick="objFormulario.mostrarCreacion();"><i class="fas fa-plus"></i> Crear Nuevo</button> 
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-12">
                <div class="card card-outline card-success">
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

<!-- Reg. Crea Usuario -->
<section class="content" id="contenedorCreausuario" style="display: none" >
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card card-outline card-success">
                    <div class="card-header">
                    </div>
                    <div class="card-body">
                        <?php $this->load->view('seguridad/frm_creausuario'); ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- /.Reg. Crea Usuario -->

<!-- Reg. Edita Usuario -->
<section class="content" id="contenedorEditausuario" style="display: none" >
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card card-success">
                    <div class="card-body">
                        <?php $this->load->view('seguridad/frm_editausuario'); ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- /.Reg. Edita Usuario -->

<!-- /.modal-CreaUsu --> 
<div class="modal fade" id="modalCreaUsu" data-backdrop="static" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">      
        <div class="modal-header text-center bg-success">
            <h4 class="modal-title w-100 font-weight-bold">Registro de Usuario</h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <form class="form-horizontal" id="frmCreaUsu" name="frmCreaUsu" action="<?= base_url('cusuario/setusuario')?>" method="POST" enctype="multipart/form-data" role="form"> 
        <div class="modal-body">          
            <input type="hidden" id="mhdnpIdusuario" name="mhdnpIdusuario"> <!-- ID -->
            <input type="hidden" id="mhdnpAccionIngreso" name="mhdnpAccionIngreso">
                                                  
            <div class="form-group">
                <div class="row">          
                    <div class="col-sm-3">
                        <div class="text-info">Tipo Usuario</div>
                        <div>                            
                            <select class="form-control" id="mcbotipousu" name="mcbotipousu">
                                <option value="" selected="selected">::Elija</option>
                                <option value="I" >INTERNO</option>
                                <option value="C" >CLIENTE</option>
                                <option value="F" >FREELANCE</option>
                                <option value="P" >PROVEEDOR</option>
                            </select>
                        </div>
                    </div>         
                    <div class="col-sm-5">
                        <div class="text-info">Nro. Documento ó Apellido</div>                            
                        <div class="input-group mb-3">
                            <input type="text" id="mtxtnrodoc" name="mtxtnrodoc" class="form-control rounded-0">
                            <span class="input-group-append">
                                <button type="button" id="mbtnbuscnrodoc" name="mbtnbuscnrodoc" class="btn btn-primary btn-flat"><i class="fas fa-search"></i> </button>
                                <button type="button" id="mbtnnuevoadm" name="mbtnnuevoadm" class="btn btn-info btn-flat"><i class="fas fa-user-plus"></i> </button>
                            </span>
                        </div>
                    </div> 
                    <div class="col-sm-4">
                        <div class="text-info">Usuario</div>
                        <div>                            
                            <input type="text" class="form-control" id="mtxtusuario" name="mtxtusuario">
                        </div>
                    </div>     
                </div>                
            </div>         
        </div>

        <div class="modal-footer justify-content-between" style="background-color: #dff0d8;">
            <button type="reset" class="btn btn-default" id="mbtnCPago" data-dismiss="modal"><i class="fas fa-window-close"></i>Cancelar</button>
            <button type="submit" class="btn btn-success" id="mbtnGPago"><i class="fas fa-save"></i> Grabar</button> 
        </div>
        </form>
    </div>
  </div>
</div> 
<!-- /.modal-->


<script type="text/javascript">
    var baseurl = "<?php echo base_url();?>"; 
</script>