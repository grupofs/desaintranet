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
        <h1 class="m-0 text-dark">MANTENIMIENTO CLIENTES</h1>
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
<section class="content" id="contenedorBusqueda" style="background-color: #E0F4ED;">
    <div class="container-fluid"> 
        <div class="row">
            <div class="col-12">
                <div class="card card-success card-outline card-tabs">
                    <div class="card-header p-0 pt-1 border-bottom-0">            
                        <ul class="nav nav-tabs" id="tabptcliente" style="background-color: #28a745;" role="tablist">                    
                            <li class="nav-item">
                                <a class="nav-link active" style="color: #000000;" id="tabptcliente-list-tab" data-toggle="pill" href="#tabptcliente-list" role="tab" aria-controls="tabptcliente-list" aria-selected="true">LISTADO</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" style="color: #000000;" id="tabptcliente-reg-tab" data-toggle="pill" href="#tabptcliente-reg" role="tab" aria-controls="tabptcliente-reg" aria-selected="false">REGISTRO</a>
                            </li>
                        </ul>
                    </div>
                    <div class="card-body">
                        <div class="tab-content" id="tabptcliente-tabContent">
                            <div class="tab-pane fade show active" id="tabptcliente-list" role="tabpanel" aria-labelledby="tabptcliente-list-tab">                            
                                <div class="card card-success">
                                    <div class="card-header">
                                        <h3 class="card-title">BUSQUEDA</h3>
                                        <div class="card-tools">
                                            <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i></button>
                                        </div>
                                    </div>
                                
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>Cliente - Nro Documento</label>
                                                    <input id="txtCliente" name="txtCliente" type="text" class="form-control" style="width: 100%;">
                                                </div>
                                            </div>
                                        </div>  
                                    </div>                
                                                
                                    <div class="card-footer justify-content-between"> 
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="text-right">
                                                    <button type="submit" class="btn btn-primary" id="btnBuscar"><i class="fas fa-search"></i> Buscar</button>    
                                                    <button type="button" class="btn btn-outline-info" id="btnNuevo"><i class="fas fa-plus"></i> Crear Nuevo</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-12">
                                        <div class="card card-outline card-success">
                                            <div class="card-header">
                                                <h3 class="card-title">LISTADO</h3>
                                            </div>
                                        
                                            <div class="card-body">
                                                <table id="tblListPtcliente" class="table table-striped table-bordered" style="width:100%">
                                                    <thead>
                                                    <tr>
                                                        <th></th>
                                                        <th>N° Documento</th>
                                                        <th>Razon Social</th>
                                                        <th>Direccion</th>
                                                        <th>Telefono</th>
                                                        <th>Representante Legal</th>
                                                        <th>Logo</th>
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
                            <div class="tab-pane fade" id="tabptcliente-reg" role="tabpanel" aria-labelledby="tabptcliente-reg-tab">
                                <form class="form-horizontal" id="frmMantptClie" action="<?= base_url('pt/cptcliente/setptcliente')?>" method="POST" enctype="multipart/form-data" role="form">
                                    <input type="hidden" id="hdnIdptclie" name="hdnIdptclie"> <!-- ID -->
                                    <input type="hidden" id="hdnAccionptclie" name="hdnAccionptclie"> 
                                    <div class="row">
                                        <div class="col-12">
                                        <fieldset class="scheduler-border">
                                            <legend class="scheduler-border text-primary">Datos Cliente</legend>
                                            <div class="card card-success">
                                                <div class="card-body">
                                                    <div class="row">
                                                        <div class="col-md-3">
                                                            <div class="form-group">
                                                                <label>Tipo Doc. </label>
                                                                <select id="cboTipoDoc" name="cboTipoDoc" class="form-control" style="width: 100%;">
                                                                    <option value = "">Elige</option>
                                                                    <option value = "R">RUC</option>
                                                                    <option value = "O">OTROS</option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-3">
                                                            <div class="form-group">
                                                                <label>Nro documento </label>
                                                                <input type="text" class="form-control" name="txtnrodoc" id="txtnrodoc">
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label>Razón Social </label>
                                                                <input type="text" class="form-control" name="txtrazonsocial" id="txtrazonsocial">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-md-3">
                                                            <div class="form-group">
                                                                <label>Pais </label>
                                                                <select id="cboPais" name="cboPais" class="form-control select2bs4" style="width: 100%;">
                                                                    <option value = "">Cargando...</option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-3" id="boxCiudad">
                                                            <div class="form-group">
                                                                <label>Ciudad </label>
                                                                <input type="text" class="form-control" name="txtCiudad" id="txtCiudad">
                                                            </div>
                                                        </div>
                                                        <div class="col-md-3" id="boxEstado">
                                                            <div class="form-group">
                                                                <label>Estado / Region / Provincia </label>
                                                                <input type="text" class="form-control" name="txtEstado" id="txtEstado">
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6" id="boxUbigeo">
                                                            <div class="form-group">
                                                                <label>Departamento / Distrito / Provincia </label> 
                                                                <div class="input-group mb-3">
                                                                    <input type="text" id="mtxtUbigeo" name="mtxtUbigeo" class="form-control">
                                                                    <span class="input-group-append">
                                                                        <button type="button" id="btnBuscarUbigeo" class="btn btn-info btn-flat"><i class="fa fa-search"></i></button>
                                                                    </span>
                                                                </div>
                                                                <input type="hidden" id="hdnidubigeo" name="hdnidubigeo">
                                                            </div>
                                                        </div>
                                                        <div class="col-md-3" id="boxEstado">
                                                            <div class="form-group">
                                                                <label>Codigo Postal / ZIP </label>
                                                                <input type="text" class="form-control" name="txtCodigopostal" id="txtCodigopostal">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-md-12">
                                                            <div class="form-group">
                                                                <label>Dirección Domicilio Fiscal </label>
                                                                <input type="text" class="form-control" name="txtDireccion" id="txtDireccion">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label>Representante Legal </label>
                                                                <input type="text" class="form-control" name="txtRepresentante" id="txtRepresentante">
                                                            </div>
                                                        </div>
                                                        <div class="col-md-3">
                                                            <div class="form-group">
                                                                <label>Cargo Rep. </label>
                                                                <input type="text" class="form-control" name="txtCargorep" id="txtCargorep">
                                                            </div>
                                                        </div>
                                                        <div class="col-md-3">
                                                            <div class="form-group">
                                                                <label>Email Rep. </label>
                                                                <input type="text" class="form-control" name="txtEmailrep" id="txtEmailrep">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-md-3">
                                                            <div class="form-group">
                                                                <label>Telefono </label>
                                                                <input type="text" class="form-control" name="txtTelefono" id="txtTelefono">
                                                            </div>
                                                        </div>
                                                        <div class="col-md-4">
                                                            <div class="form-group">
                                                                <label>Pagina Web </label>
                                                                <input type="text" class="form-control" name="txtWeb" id="txtWeb">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-md-6" style="display: none;" id="divlogo">
                                                            <div class="form-group">
                                                                <label>Imagen previa </label>
                                                                <input type="hidden" class="form-control" name="utxtlogo" id="utxtlogo">
                                                                <img id="image_previa" src="" width="150" height="100" class="img-circle">
                                                            </div>
                                                        </div>
                                                        <div class="col-md-5">
                                                            <div class="form-group">
                                                                <label>Logo </label>
                                                                <div class="kv-avatar">
                                                                    <div class="file-loading">
                                                                    <input id="logo_image" name="logo_image" type="file" onchange="registrar_imagen()">
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="card-footer"> 
                                                    <div class="row">
                                                        <div class="col-sm-12 text-right"> 
                                                            <button type="submit" class="btn btn-success" id="btnGrabar"><i class="fas fa-save"></i> Grabar</button>    
                                                            <button type="button" class="btn btn-secondary" id="btnRetornar"><i class="fas fa-undo-alt"></i> Retornar</button>
                                                        </div>
                                                    </div>
                                                </div> 
                                            </div> 
                                        </fieldset>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- /.Main content -->

<!-- Reg. Checklist -->
<section class="content" id="contenedorRegestable" style="display: none" >
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card card-success">
                    <div class="card-body">
                        <?php $this->load->view('pt/gestion/formulario_regestable'); ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- /.Reg. Checklist -->

<!-- /.modal-ubigeo --> 
<div class="modal fade" id="modalUbigeo" data-backdrop="static" role="dialog" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <form class="form-horizontal" id="frmUbigeo" name="frmUbigeo" action="" method="POST" enctype="multipart/form-data" role="form"> 

        <div class="modal-header text-center bg-success">
            <h4 class="modal-title w-100 font-weight-bold">Seleccionar Ubigeo</h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>

        <div class="modal-body">                                  
            <div class="form-group">
                <div class="row">
                    <div class="col-sm-12">
                        <div class="text-info">Departamento</div>
                        <div>                            
                            <select class="form-control select2bs4" id="cboDepa" name="cboDepa" style="width: 100%;">
                                <option value="">Cargando...</option>
                            </select>
                        </div>
                    </div>  
                </div>                
            </div> 
            <div class="form-group">
                <div class="row">                
                    <div class="col-sm-12">
                        <div class="text-info">Provincia</div>
                        <div>
                            <select class="form-control select2bs4" id="cboProv" name="cboProv">
                                <option value="">Cargando...</option>
                            </select>
                        </div>
                    </div>   
                </div>                
            </div>
            <div class="form-group">
                <div class="row">                
                    <div class="col-sm-12">
                        <div class="text-info">Distrito</div>
                        <div>
                            <select class="form-control select2bs4" id="cboDist" name="cboDist">
                                <option value="">Cargando...</option>
                            </select>
                        </div>
                    </div>   
                </div>                
            </div>             
        </div>

        <div class="modal-footer justify-content-between" style="background-color: #dff0d8;">
            <button id="btnSelUbigeo" type="button" class="btn btn-success"><i class="fa fa-save"></i> Seleccionar</button>
            <button id="btncerrarUbigeo" type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
        </div>
      </form>
    </div>
  </div>
</div> 
<!-- /.modal-->

<!-- Script Generales -->
<script type="text/javascript">
    var baseurl = "<?php echo base_url();?>"; 
</script>