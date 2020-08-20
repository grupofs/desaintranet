<?php
    $idusu = $this -> session -> userdata('s_idusuario');
?>

<style>
    tab {
        display: inline-block; 
        margin-left: 100px; 
    }
    tr.subgroup,
    tr.subgroup:hover {
        background-color: #F2F2F2 !important;
        /* color: blue; */
        font-weight: bold;
    }
    .group{
            background-color:#D5D8DC !important;
            font-size:15px;
            color:#000000!important;
            opacity:0.7;
    }
    .subgroup{
        cursor: pointer;
    }
    .modal-lg{
        max-width: 1000px !important;
    }
</style>

<!-- content-header -->
<div class="content-header">   
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1 class="m-0 text-dark">CTRL. PROVEEDORES</h1>
      </div>
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="<?php echo public_base_url(); ?>cprincipal/principal">Home</a></li>
          <li class="breadcrumb-item active">Ctrl. Prov.</li>
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
                        <ul class="nav nav-tabs" id="tabctrlprov" style="background-color: #28a745;" role="tablist">                    
                            <li class="nav-item">
                                <a class="nav-link active" style="color: #000000;" id="tabctrlprov-list-tab" data-toggle="pill" href="#tabctrlprov-list" role="tab" aria-controls="tabctrlprov-list" aria-selected="true">LISTADO</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" style="color: #000000;" id="tabctrlprov-reg-tab" data-toggle="pill" href="#tabctrlprov-reg" role="tab" aria-controls="tabctrlprov-reg" aria-selected="false">INSPECCION</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" style="color: #000000;" id="tabctrlprov-det-tab" data-toggle="pill" href="#tabctrlprov-det" role="tab" aria-controls="tabctrlprov-det" aria-selected="false">PROGRAMACION</a>
                            </li>
                        </ul>
                    </div>
                    <div class="card-body">
                        <div class="tab-content" id="tabctrlprov-tabContent">
                            <div class="tab-pane fade show active" id="tabctrlprov-list" role="tabpanel" aria-labelledby="tabctrlprov-list-tab">
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
                                                    <label>Clientes</label>
                                                    <select class="form-control select2bs4" id="cboclieserv" name="cboclieserv" style="width: 100%;">
                                                        <option value="" selected="selected">Cargando...</option>
                                                    </select>
                                                </div>
                                            </div>
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
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>Proveedor</label>
                                                    <select class="form-control select2bs4" id="cboprovxclie" name="cboprovxclie" style="width: 100%;">
                                                        <option value="" selected="selected">Cargando...</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>Maquilador</label>
                                                    <select class="form-control select2bs4" id="cbomaqxprov" name="cbomaqxprov" style="width: 100%;">
                                                        <option value="" selected="selected">Cargando...</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>Inspector</label>
                                                    <select class="form-control select2bs4" id="cboinspector" name="cboinspector"style="width: 100%;">
                                                        <option value="" selected="selected">Cargando...</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <label>Estado</label>
                                                    <select class="form-control select2bs4" id="cboestado" name="cboestado" multiple="multiple" data-placeholder="Seleccionar" style="width: 100%;">
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
                                                <h3 class="card-title">Listado de Inspecciones - <label id="lblCliente"></label></h3>
                                            </div>                                       
                                            <div class="card-body">
                                                <table id="tblListctrlprov" class="table table-striped table-bordered" style="width:100%">
                                                    <thead>
                                                    <tr>
                                                        <th colspan="12">[Codigo] :: Proveedor - (Maquilador) - Establecimiento</th>
                                                    </tr>
                                                    <tr>
                                                        <th>desc_gral</th>
                                                        <th>Area Cliente</th>
                                                        <th>Linea Proceso</th>
                                                        <th>Periodo</th>
                                                        <th>Estado</th>
                                                        <th>Fecha</th>
                                                        <th>Inspector</th>
                                                        <th>Informe</th>
                                                        <th>Resultado</th>
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
                            <div class="tab-pane fade" id="tabctrlprov-reg" role="tabpanel" aria-labelledby="tabctrlprov-reg-tab">
                                <fieldset class="scheduler-border" id="regInsp">
                                    <legend class="scheduler-border text-primary">REG. INSPECCION</legend>
                                    <form class="form-horizontal" id="frmRegInsp" action="<?= base_url('at/capacitaciones/cregcapa/setcapa')?>" method="POST" enctype="multipart/form-data" role="form">
                                        <input type="hidden" name="mtxtidinsp" id="mtxtidinsp" class="form-control">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">    
                                                    <label>Clientes</label>
                                                    <select class="form-control select2bs4" id="cboregClie" name="cboregClie" style="width: 100%;">
                                                        <option value="" selected="selected">Cargando...</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <label>Nro PTE</label>
                                                    <input type="text" name="mtxtComentarios"id="mtxtComentarios" class="form-control" >
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <label>Fecha PTE</label>
                                                    <input type="text" name="mtxtComentarios"id="mtxtComentarios" class="form-control" >
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>Proveedor</label>
                                                    <select class="form-control select2bs4" id="cboregClie" name="cboregClie" style="width: 100%;">
                                                        <option value="" selected="selected">Cargando...</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>Maquilador</label>
                                                    <select class="form-control select2bs4" id="cboregClie" name="cboregClie" style="width: 100%;">
                                                        <option value="" selected="selected">Cargando...</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>Establecimiento</label>
                                                    <select class="form-control select2bs4" id="cboregClie" name="cboregClie" style="width: 100%;">
                                                        <option value="" selected="selected">Cargando...</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>Dir. Inspeccion</label>                                                    
                                                    <input type="text" name="mtxtComentarios"id="mtxtComentarios" class="form-control" >
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label>Area del Cliente</label>
                                                    <select class="form-control select2bs4" id="cboregClie" name="cboregClie" style="width: 100%;">
                                                        <option value="" selected="selected">Cargando...</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-md-8">
                                                <div class="form-group">
                                                    <label>Linea de Proceso</label>                                                    
                                                    <select class="form-control select2bs4" id="cboregClie" name="cboregClie" style="width: 100%;">
                                                        <option value="" selected="selected">Cargando...</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label>Producto Marca</label>
                                                    <input type="text" name="mtxtComentarios"id="mtxtComentarios" class="form-control" >
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
                                <fieldset class="scheduler-border" id="regDetInsp">
                                    <legend class="scheduler-border text-primary">PROGRAMACION</legend>
                                    <div class="row">
                                        <div class="col-md-12 text-left">
                                            <div class="form-group">                                                                          
                                                <a class="btn btn-default btn-sm" data-toggle="modal" data-target="#modalCreaInfor" id="addcurso" name="addcurso"><img src='<?php echo base_url() ?>assets/images/details_open.png' border="0" align="absmiddle"> Agregar Cursos</a> 
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">   
                                                <table id="tblListRegcapa" class="table table-striped table-bordered" style="width:100%">
                                                    <thead>
                                                    <tr>
                                                        <th></th>
                                                        <th>Periodo</th>
                                                        <th>Fecha</th>
                                                        <th>Estado</th>
                                                        <th>Inspector</th>
                                                        <th>Resultado</th>
                                                        <th>Informe</th>
                                                        <th>Quejas</th>
                                                        <th>AACC</th>
                                                        <th></th>
                                                    </tr>
                                                    </thead>
                                                    <tbody>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </fieldset>
                            </div>
                            <div class="tab-pane fade" id="tabctrlprov-det" role="tabpanel" aria-labelledby="tabctrlprov-det-tab">
                                <fieldset class="scheduler-border" id="regCapa">
                                    <legend class="scheduler-border text-primary">Reg. Programacion</legend>
                                    <form class="form-horizontal" id="frmRegInsp" action="<?= base_url('at/capacitaciones/cregcapa/setcapa')?>" method="POST" enctype="multipart/form-data" role="form">
                                        <input type="hidden" name="mtxtidinsp" id="mtxtidinsp" class="form-control">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="form-group">    
                                                    <label>DATOS</label>
                                                    <input type="text" name="mtxtComentarios"id="mtxtComentarios" class="form-control" disabled = true>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>Inspector</label>
                                                    <select class="form-control select2bs4" id="cboregClie" name="cboregClie" style="width: 100%;">
                                                        <option value="" selected="selected">Cargando...</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <label>Periodo Inspeccion</label>
                                                    <select class="form-control select2bs4" id="cboregClie" name="cboregClie" style="width: 100%;">
                                                        <option value="" selected="selected">Cargando...</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-md-3">      
                                                <label>Fecha Inspeccion</label>                      
                                                <div class="input-group date" id="txtFHasta" data-target-input="nearest">
                                                    <input type="text" id="txtFFin" name="txtFFin" class="form-control datetimepicker-input" data-target="#txtFHasta" disabled/>
                                                    <div class="input-group-append" data-target="#txtFHasta" data-toggle="datetimepicker">
                                                        <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>Sistema</label>
                                                    <select class="form-control select2bs4" id="cboregClie" name="cboregClie" style="width: 100%;">
                                                        <option value="" selected="selected">Cargando...</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>Rubro</label>                                                    
                                                    <input type="text" name="mtxtComentarios"id="mtxtComentarios" class="form-control" >
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-8">
                                                <div class="form-group">
                                                    <label>Check List</label>
                                                    <select class="form-control select2bs4" id="cboregClie" name="cboregClie" style="width: 100%;">
                                                        <option value="" selected="selected">Cargando...</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label>Modelo Informe</label>                                                    
                                                    <select class="form-control select2bs4" id="cboregClie" name="cboregClie" style="width: 100%;">
                                                        <option value="" selected="selected">Cargando...</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label>Valor No Conformidad</label>                                                    
                                                    <select class="form-control select2bs4" id="cboregClie" name="cboregClie" style="width: 100%;">
                                                        <option value="" selected="selected">Cargando...</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label>Formula Evaluacion</label>                                                    
                                                    <select class="form-control select2bs4" id="cboregClie" name="cboregClie" style="width: 100%;">
                                                        <option value="" selected="selected">Cargando...</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label>Criterio Resultado</label>                                                    
                                                    <select class="form-control select2bs4" id="cboregClie" name="cboregClie" style="width: 100%;">
                                                        <option value="" selected="selected">Cargando...</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label>Comentario</label>
                                                    <textarea class="form-control" cols="20" id="mtxtDetaInfor" name="mtxtDetaInfor" rows="2" ></textarea>
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
                            </div>
                        </div>
                    </div>                
                </div>
            </div>
        </div>     
    </div>
</section>
<!-- /.Main content -->


<!-- /.modal-crear-inspeccion --> 
<div class="modal fade" id="modalCreainsp" data-backdrop="static" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <form class="form-horizontal" id="frmCreainsp" name="frmCreainsp" action="<?= base_url('at/capa/cregcapa/setinspeccion')?>" method="POST" enctype="multipart/form-data" role="form"> 

        <div class="modal-header text-center bg-success">
            <h4 class="modal-title w-100 font-weight-bold">Registro de Inspeccion</h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>

        <div class="modal-body">          
            <input type="hidden" id="mhdnAccionInsp" name="mhdnAccionInsp" value="A">                          
            <div class="form-group">  
                <div class="row">
                    <div class="col-md-2"> 
                        <div class="text-info">Codigo</div>
                        <div>    
                            <input type="text" name="mhdnIdinsp"id="mhdnIdinsp" class="form-control" disabled = true><!-- ID -->
                        </div>
                    </div>
                    <div class="col-md-10"> 
                        <div class="text-info">Clientes</div>
                        <div>    
                            <input type="text" name="mtxtDatos"id="mtxtDatos" class="form-control" disabled = true>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">                        
                        <div class="text-info">Proveedor</div>
                        <div>
                            <select class="form-control select2bs4" id="cboregClie" name="cboregClie" style="width: 100%;">
                                <option value="" selected="selected">Cargando...</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-6">    
                        <div class="text-info">Maquilador</div>
                        <div>
                            <select class="form-control select2bs4" id="cboregClie" name="cboregClie" style="width: 100%;">
                                <option value="" selected="selected">Cargando...</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-4">
                        <div class="text-info">Establecimiento</div>
                        <div>
                            <select class="form-control select2bs4" id="cboregClie" name="cboregClie" style="width: 100%;">
                                <option value="" selected="selected">Cargando...</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-8">
                        <div class="text-info">Dir. Inspeccion</div>
                        <div>
                            <input type="text" name="mtxtComentarios"id="mtxtComentarios" class="form-control" >
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-4">
                        <div class="text-info">Area del Cliente</div>
                        <div>
                            <select class="form-control select2bs4" id="cboregClie" name="cboregClie" style="width: 100%;">
                                <option value="" selected="selected">Cargando...</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-8">
                        <div class="text-info">Linea de Proceso</div>
                        <div>
                            <select class="form-control select2bs4" id="cboregClie" name="cboregClie" style="width: 100%;">
                                <option value="" selected="selected">Cargando...</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="text-info">Producto Marca</div>
                        <div>
                            <input type="text" name="mtxtComentarios"id="mtxtComentarios" class="form-control" >
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

<!-- Script Generales -->
<script type="text/javascript">
    var baseurl = "<?php echo base_url();?>"; 
</script>