<?php
    $idusu = $this -> session -> userdata('s_idusuario');
?>

<style>
    tab {
        display: inline-block; 
        margin-left: 30px; 
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

    .btn-circle {
        width: 45px;
        height: 45px;
        line-height: 45px;
        text-align: center;
        padding: 0;
        border-radius: 50%;
    }
    
    .btn-circle i {
        position: relative;
        top: -1px;
    }

    .btn-circle-sm {
        width: 35px;
        height: 35px;
        line-height: 35px;
        font-size: 0.9rem;
    }

    .btn-circle-lg {
        width: 55px;
        height: 55px;
        line-height: 55px;
        font-size: 1.1rem;
    }

    .btn-circle-xl {
        width: 70px;
        height: 70px;
        line-height: 70px;
        font-size: 1.3rem;
    }

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
    
    .dropdown-item:hover{
        border-color: #0067ab;
        background-color: #e83e8c !important;
    }

    td.details-control {
        background: url('<?php echo public_base_url(); ?>assets/images/details_open.png') no-repeat center center;
        cursor: pointer;
    }
    tr.details td.details-control {
        background: url('<?php echo public_base_url(); ?>assets/images/details_close.png') no-repeat center center;
    }
</style>

<!-- content-header -->
<div class="content-header">   
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1 class="m-0 text-dark">MOVILIDAD</h1>
      </div>
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="<?php echo public_base_url(); ?>cprincipal/principal">Home</a></li>
          <li class="breadcrumb-item active">Adm - conta</li>
        </ol>
      </div>
    </div>
  </div>
</div>
<!-- /.content-header -->

<!-- Main content -->
<section class="content" id="contenedorCotizacion" style="background-color: #E0F4ED;">
    <div class="container-fluid">  
        <div class="row">
            <div class="col-12">
                <div class="card card-primary card-outline card-tabs">
                    <div class="card-header p-0 pt-1 border-bottom-0">            
                        <ul class="nav nav-tabs" id="tabconta" style="background-color: #2875A7;" role="tablist">                    
                            <li class="nav-item">
                                <a class="nav-link active" style="color: #000000;" id="tabconta-list-tab" data-toggle="pill" href="#tabconta-list" role="tab" aria-controls="tabconta-list" aria-selected="true">LISTADO</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" style="color: #000000;" id="tabconta-reg-tab" data-toggle="pill" href="#tabconta-reg" role="tab" aria-controls="tabconta-reg" aria-selected="false">REGISTRO</a>
                            </li>
                        </ul>
                    </div>
                    <div class="card-body">
                        <div class="tab-content" id="tabconta-tabContent">
                            <div class="tab-pane fade show active" id="tabconta-list" role="tabpanel" aria-labelledby="tabconta-list-tab">                                
                                <div class="card card-primary">
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
                                                    <label>Trabajador</label>
                                                    <select class="form-control select2bs4" id="cboclieserv" name="cboclieserv" style="width: 100%;">
                                                        <option value="" selected="selected">Cargando...</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-md-3">    
                                                <div class="checkbox"><label>
                                                    <input type="checkbox" id="chkFreg" /> <b>Fecha Emision :: Del</b>
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
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label>Compañia</label>
                                                    <select class="form-control select2bs4" id="cboclieserv" name="cboclieserv" style="width: 100%;">
                                                        <option value="" selected="selected">Cargando...</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label>Area</label>
                                                    <select class="form-control select2bs4" id="cboclieserv" name="cboclieserv" style="width: 100%;">
                                                        <option value="" selected="selected">Cargando...</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                    </div>                
                                                
                                    <div class="card-footer justify-content-between"> 
                                        <div class="row">
                                            <div class="col-md-2"> 
                                                <button type="button" class="btn btn-outline-success" id="btnNuevo" ><i class="fas fa-plus"></i> Crear Nuevo</button>                        
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
                                        <div class="card card-outline card-primary">
                                            <div class="card-header">
                                                <h3 class="card-title">Listado de Movilidads</h3>
                                            </div>                                        
                                            <div class="card-body">
                                                <table id="tblListMovilidad" class="table table-striped table-bordered" style="width:100%">
                                                    <thead>
                                                    <tr>
                                                        <th></th>
                                                        <th>Cia</th>
                                                        <th>Area</th>
                                                        <th>Empleado</th>
                                                        <th>Nro. Movilidad</th>
                                                        <th>Fecha</th>
                                                        <th>Monto</th>
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
                            <div class="tab-pane fade" id="tabconta-reg" role="tabpanel" aria-labelledby="tabconta-reg-tab">
                                <fieldset class="scheduler-border-fsc" id="regConta">
                                    <legend class="scheduler-border-fsc text-primary">REG. Movilidad</legend>
                                    <form class="form-horizontal" id="frmRegConta" action="<?= base_url('adm/conta/cmovilidad/setmovilidad')?>" method="POST" enctype="multipart/form-data" role="form">
                                        <input type="hidden" name="mtxtidmovilidad" id="mtxtidmovilidad" class="form-control">
                                        <input type="hidden" name="hdnAccionregmovi" id="hdnAccionregmovi" class="form-control">
                                        <div class="row">                 
                                            <div class="col-sm-3">
                                                <div class="form-group">
                                                    <label>Fecha Movilidad</label>
                                                    <div class="input-group date" id="mtxtFCoti" data-target-input="nearest">
                                                        <input type="text" id="mtxtFcotizacion" name="mtxtFcotizacion" class="form-control datetimepicker-input" data-target="#mtxtFCoti"/>
                                                        <div class="input-group-append" data-target="#mtxtFCoti" data-toggle="datetimepicker">
                                                            <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                                        </div>
                                                    </div>                        
                                                </div> 
                                            </div>
                                            <div class="col-md-3">
                                                <div class="form-group">    
                                                    <label>Nro Cotizacion</label>
                                                    <input type="text" name="mtxtregnumcoti"id="mtxtregnumcoti" class="form-control" >
                                                </div>
                                            </div>
                                            <div class="col-md-2">
                                                <div class="form-group">    
                                                    <label>Estado</label>
                                                    <input type="text" name="mtxtregestado"id="mtxtregestado" class="form-control" >
                                                </div>
                                            </div>
                                            <div class="col-md-2">
                                                <div class="form-group">
                                                    <label>Vigencia Cotización</label>
                                                    <input type="text" name="mtxtregvigen"id="mtxtregvigen" class="form-control" >
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <label>Servicio</label>
                                                    <select class="form-control select2bs4" id="cboregserv" name="cboregserv" style="width: 100%;">
                                                        <option value="" selected="selected">Cargando...</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label>Cliente</label>
                                                    <select class="form-control select2bs4" id="cboregclie" name="cboregclie" style="width: 100%;">
                                                        <option value="" selected="selected">Cargando...</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label>Proveedor</label>
                                                    <select class="form-control select2bs4" id="cboregprov" name="cboregprov" style="width: 100%;">
                                                        <option value="" selected="selected">Cargando...</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label>Contacto</label>
                                                    <select class="form-control select2bs4" id="cboregcontacto" name="cboregcontacto" style="width: 100%;">
                                                        <option value="" selected="selected">Cargando...</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <label>Forma de Pago</label>
                                                    <div class="input-group mb-3">
                                                        <div class="input-group-prepend">
                                                            <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown">
                                                            <span id="btntipopagos">Contado</span>
                                                            </button>
                                                            <div class="dropdown-menu">
                                                                <a class="dropdown-item" onClick="javascript:conta()">Contado</a>
                                                                <a class="dropdown-item" onClick="javascript:credi()">Crédito</a>
                                                                <a class="dropdown-item" onClick="javascript:otro()">Otros</a>
                                                            </div>
                                                        </div>
                                                        <input type="text" name="mtxtregpagotro"id="mtxtregpagotro" class="form-control" >
                                                    </div>
                                                    <input type="hidden" name="txtregtipopagos" id="txtregtipopagos">
                                                </div>
                                            </div> 
                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <label>Informe Ensayo</label>
                                                    <select class="form-control select2bs4" id="cboreginfor" name="cboreginfor" style="width: 100%;">
                                                        <option value="" selected="selected">Cargando...</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <label>Tiempo Entrega Inf.</label>
                                                    <div class="input-group mb-3">
                                                        <input type="text" name="mtxtregentregainf"id="mtxtregentregainf" class="form-control" >
                                                        <div class="input-group-prepend">
                                                            <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown">
                                                            <span id="btntipodias">Días Calendario</span>
                                                            </button>
                                                            <div class="dropdown-menu">
                                                                <a class="dropdown-item" onClick="javascript:calen()">Días Calendario</a>
                                                                <a class="dropdown-item" onClick="javascript:util()">Días Útiles</a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <input type="hidden" name="txtregtipodias" id="txtregtipodias">
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <label>Tipo Certificado</label>
                                                    <select class="form-control select2bs4" id="cboregtipocerti" name="cboregtipocerti" style="width: 100%;">
                                                        <option value="" selected="selected">Cargando...</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">                                            
                                            <div class="col-md-2">
                                                <div class="form-group">
                                                    <label>Tipo Local</label>
                                                    <select class="form-control select2bs4" id="cboregtipolocal" name="cboregtipolocal" style="width: 100%;">
                                                        <option value="" selected="selected">::Elegir</option>
                                                        <option value="T">Tienda</option>
                                                        <option value="C">Centro de Producción</option>
                                                    </select>
                                                </div>
                                            </div> 
                                            <div class="col-md-2">
                                                <div class="form-group">
                                                    <label>Perman. contra muestra</label>
                                                    <input type="text" name="mtxtregpermane"id="mtxtregpermane" class="form-control" >
                                                </div>
                                            </div>   
                                            <div class="col-md-8">
                                                <div class="form-group">
                                                    <label>Observaciones</label>
                                                    <input type="text" name="mtxtobserv"id="mtxtobserv" class="form-control" >
                                                </div>
                                            </div>  
                                        </div>
                                        <div class="row">
                                            <div class="col-sm-4 text-left"> 
                                                <div class="form-group">
                                                    <div class="col-md-3">
                                                        <div class="custom-control custom-checkbox">
                                                            <input type="checkbox" class="custom-control-input" id="chkregverpago" name="chkregverpago" />
                                                            <label for="chkregverpago" class="custom-control-label">Precios</label>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-sm-8 text-right"> 
                                                <div class="form-group">
                                                    <button type="submit" class="btn btn-success" id="btnRegistrar"><i class="fas fa-save"></i> Registrar</button>   
                                                    <button type="button" class="btn btn-secondary" id="btnRetornarLista"><i class="fas fa-undo-alt"></i> Retornar</button>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                    <div id="regProductos" style="border-top: 1px solid #ccc; padding-top: 10px;">
                                        <div class="row">
                                            <div class="col-6">
                                                <h4>
                                                    <i class="fas fa-weight"></i> PRODUCTOS
                                                    <small> - Ensayos :: </small>
                                                </h4>
                                            </div> 
                                            <div class="col-6">                          
                                                <div class="form-group text-right">                                                                          
                                                    <a data-toggle="modal" data-target="#modalCreaProduc" id="addProducto" name="addProducto" class="btn btn-default btn-sm" style="visibility:visible"><img src='<?php echo base_url() ?>assets/images/details_open.png' border="0" align="absmiddle"> Agregar Producto</a> 
                                                </div>                        
                                            </div>
                                        </div> 
                                        <div class="row"> 
                                            <div class="col-12">
                                                <div class="card card-outline card-primary">
                                                    <div class="card-header">
                                                        <h3 class="card-title">Listado de Productos</h3>
                                                    </div>                                        
                                                    <div class="card-body">
                                                        <table id="tblListProductos" class="table table-striped table-bordered" style="width:100%">
                                                            <thead>
                                                            <tr>
                                                                <th>N°</th>
                                                                <th>Local</th>
                                                                <th>Productos</th>
                                                                <th>Condicion</th>
                                                                <th>N° Muestras</th>
                                                                <th></th>
                                                                <th></th>
                                                                <th></th>
                                                                <th></th>
                                                            </tr>
                                                            </thead>
                                                            <tbody>
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </div>
                                                <div class="card card-outline card-primary">
                                                    <div class="card-header">
                                                        <h3 class="card-title">Listado de Ensayos</h3>
                                                    </div>                                        
                                                    <div class="card-body">
                                                        <table id="tblListEnsayos" class="table table-striped table-bordered" style="width:100%">
                                                            <thead>
                                                            <tr>
                                                                <th>N°</th>
                                                                <th>Codigo</th>
                                                                <th>Ensayo</th>
                                                                <th>Año</th>
                                                                <th>Norma</th>
                                                                <th>Costo Ensayo</th>
                                                                <th>Vias</th>
                                                                <th>Cantidad</th>
                                                                <th>Costo</th>
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

<!-- Reg. Ensayos -->
<section class="content" id="contenedorRegensayo" style="display: none" >
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card card-success">
                    <div class="card-body">
                        <?php $this->load->view('lab/coti/registro/vregensayo'); ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- /.Reg. Ensayos -->


<!-- /.modal-crear-propuesta --> 
<div class="modal fade" id="modalCreaProduc" data-backdrop="static" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <form class="form-horizontal" id="frmCreaProduc" name="frmCreaProduc" action="<?= base_url('lab/cpti/ccotizacion/setproducto')?>" method="POST" enctype="multipart/form-data" role="form"> 

        <div class="modal-header text-center bg-success">
            <h4 class="modal-title w-100 font-weight-bold">Registro de Producto</h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>

        <div class="modal-body">          
            <input type="hidden" id="mhdnIdProduc" name="mhdnIdProduc"> <!-- ID -->
            <input type="hidden" name="mhdnidcotizacion" id="mhdnidcotizacion" class="form-control">
            <input type="hidden" name="mhdnnroversion" id="mhdnnroversion" class="form-control">
            <input type="hidden" id="mhdnAccionProduc" name="mhdnAccionProduc" value="">
                        
            <div class="form-group">
                <div class="row">
                    <div class="col-sm-12">
                        <div class="text-info">Local del Cliente <span class="text-requerido">*</span></div>
                        <div>                            
                            <select class="form-control select2bs4" id="mcboregLocalclie" name="mcboregLocalclie" style="width: 100%;">
                                <option value="" selected="selected">Cargando...</option>
                            </select>
                        </div>
                    </div>  
                </div>                
            </div>          
            <div class="form-group">
                <div class="row">
                    <div class="col-sm-12">
                        <div class="text-info">Producto <span class="text-requerido">*</span></div>
                        <div>  
                            <input type="text" name="mtxtregProducto" class="form-control" id="mtxtregProducto"/>  
                        </div>
                    </div>  
                </div>                
            </div> 
            <div class="form-group">
                <div class="row">                
                    <div class="col-sm-6">
                        <div class="text-info">Condicion</div>
                        <div>
                            <select class="form-control select2bs4" id="mcboregcondicion" name="mcboregcondicion">
                            <option value="">Cargando...</option>
                            </select>
                        </div>
                    </div>                
                    <div class="col-sm-6">
                        <div class="text-info">Muestra</div>
                        <div>  
                            <input type="text" name="mtxtregmuestra" class="form-control" id="mtxtregmuestra"/>  
                        </div>
                    </div> 
                </div>                
            </div> 
            <div class="form-group">
                <div class="row">                
                    <div class="col-sm-6">
                        <div class="text-info">Procedencia de muestra</div>
                        <div>
                            <select class="form-control select2bs4" id="mcboregprocedencia" name="mcboregprocedencia">
                            <option value="">Cargando...</option>
                            </select>
                        </div>
                    </div>                
                    <div class="col-sm-6">
                        <div class="text-info">Cantidad de muestra minima</div>
                        <div>  
                            <input type="text" name="mtxtregcantimin" class="form-control" id="mtxtregcantimin"/>  
                        </div>
                    </div> 
                </div>                
            </div> 
            <div class="form-group">
                <div class="row">                
                    <div class="col-sm-3">
                        <div class="text-info"><b>Octogono</b></div>
                        <div>
                            <select class="form-control" id="mcboregoctogono" name="mcboregoctogono">
                                <option value="1">SI</option>
                                <option value="0" selected="selected">NO</option>
                            </select>
                        </div>
                    </div>                
                    <div class="col-sm-3">
                        <div class="text-info"><b>Etiquetado Nutricional</b></div>
                        <div>
                            <select class="form-control" id="mcboregetiquetado" name="mcboregetiquetado">
                                <option value="1">SI</option>
                                <option value="0" selected="selected">NO</option>
                            </select>
                        </div>
                    </div>                 
                    <div class="col-sm-3">
                        <div class="text-info">Tamaño de Porcion</div>
                        <div>  
                            <input type="text" name="mtxtregtamporci" class="form-control" id="mtxtregtamporci"/>  
                        </div>
                    </div>                
                    <div class="col-sm-3">
                        <div class="text-info">UM</div>
                        <div>
                            <select class="form-control" id="mcboregumeti" name="mcboregumeti">
                                <option value="" selected="selected"></option>
                                <option value="ml">ml</option>
                                <option value="g">g</option>
                            </select>
                        </div>
                    </div> 
                </div>                
            </div>            
        </div>

        <div class="modal-footer justify-content-between" style="background-color: #dff0d8;">
            <button type="reset" class="btn btn-default" id="mbtnCCreaProduc" data-dismiss="modal">Cancelar</button>
            <button type="submit" class="btn btn-info" id="mbtnGCreaProduc">Grabar</button>
        </div>
      </form>
    </div>
  </div>
</div> 
<!-- /.modal-->

<!-- /.modal-EnsayosLab --> 
<div class="modal fade" id="modalEnsayosLab" data-backdrop="static" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <form class="form-horizontal" id="frmEnsayosLab" name="frmEnsayosLab" action="<?= base_url('at/auditoria/cconsultauditor/setregchecklist')?>" method="POST" enctype="multipart/form-data" role="form"> 

        <div class="modal-header text-center bg-success">
            <h4 class="modal-title w-100 font-weight-bold">Buscar Ensayos por Laboratorio</h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>

        <div class="modal-body">
            <input type="hidden" id="mhdnccliente" name="mhdnccliente"> 
            <input type="hidden" id="mhdncauditoriainspeccion" name="mhdncauditoriainspeccion"> 
            <input type="hidden" id="mhdnfservicio" name="mhdnfservicio"> 
            <input type="hidden" id="mhdncchecklist" name="mhdncchecklist"> 
            <input type="hidden" id="mhdncrequisitochecklist" name="mhdncrequisitochecklist"> 
            <input type="hidden" id="mhdncdetallevalor" name="mhdncdetallevalor"> 
            <input type="hidden" id="mhdncestablearea" name="mhdncestablearea" >                         
            <div class="form-group"> 
                <div class="row">                
                    <div class="col-sm-12">
                        <div class="text-info">PRODUCTO </div>  
                        <input class="form-control" type="text" name="mtxtDescripcion" id="mtxtDescripcion">   
                    </div> 
                </div> 
                <div class="row">
                    <div class="col-md-6"> 
                        <div class="text-info">CODIGO</div>
                        <div>    
                            <text type="text" name="mtxtrequisito"id="mtxtrequisito" class="form-control"></text>
                        </div>
                    </div>
                    <div class="col-md-6"> 
                        <div class="text-info">ENSAYO</div>                        
                        <div>    
                            <text type="text" name="mtxthallazgo"id="mtxthallazgo" class="form-control"></text>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6"> 
                        <div class="text-info">Costo</div>
                        <div>    
                            <text type="text" name="mtxtrequisito"id="mtxtrequisito" class="form-control"></text>
                        </div>
                    </div>
                    <div class="col-md-6"> 
                        <div class="text-info">Vias</div>                        
                        <div>    
                            <text type="text" name="mtxthallazgo"id="mtxthallazgo" class="form-control"></text>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="modal-footer justify-content-between" style="background-color: #dff0d8;">
            <button type="reset" class="btn btn-default" id="mbtnCHallazgo" data-dismiss="modal">Cancelar</button>
            <button type="submit" class="btn btn-info" id="mbtnGHallazgo">Grabar</button>
        </div>
      </form>
    </div>
  </div>
</div> 
<!-- /.modal-->
