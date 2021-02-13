<?php
    $idusuario = $this -> session -> userdata('s_idusuario');
    $cusuario = $this -> session -> userdata('s_cusuario');
?>

<style>
</style>

<!-- content-header -->
<div class="content-header">   
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1 class="m-0 text-dark">COTIZACIÓN</h1>
      </div>
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="<?php echo public_base_url(); ?>main">Home</a></li>
          <li class="breadcrumb-item active">Laboratorio</li>
        </ol>
      </div>
    </div>
  </div>
</div>
<!-- /.content-header -->

<!-- Main content -->
<section class="content" id="contenedorCotizacion">
    <div class="container-fluid">  
        <div class="row">
            <div class="col-12">
                <div class="card card-lightblue card-outline card-tabs">
                    <div class="card-header p-0 pt-1 border-bottom-0">            
                        <ul class="nav nav-tabs tabfsc" id="tablab" role="tablist">                    
                            <li class="nav-item">
                                <a class="nav-link active" id="tablab-list-tab" data-toggle="pill" href="#tablab-list" role="tab" aria-controls="tablab-list" aria-selected="true">LISTADO</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="tablab-reg-tab" data-toggle="pill" href="#tablab-reg" role="tab" aria-controls="tablab-reg" aria-selected="false">REGISTRO</a>
                            </li>
                        </ul>
                    </div>
                    <div class="card-body">
                        <div class="tab-content" id="tablab-tabContent">
                            <div class="tab-pane fade show active" id="tablab-list" role="tabpanel" aria-labelledby="tablab-list-tab">                                
                                <div class="card card-lightblue">
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
                                                    <input type="checkbox" id="chkFreg" /> <b>Fecha Cotizacion :: Del</b>
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
                                                <label>Nro. Cotizacion/ Producto</label> 
                                                <div>
                                                    <input type="text" id="txtdescri" name="txtdescri" class="form-control" />
                                                </div>
                                            </div>
                                        </div>
                                    </div>                
                                                
                                    <div class="card-footer justify-content-between"> 
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="text-right">
                                                    <button type="submit" class="btn btn-primary" id="btnBuscar"><i class="fas fa-search"></i> Buscar</button> 
                                                    <button type="button" class="btn btn-outline-info" id="btnNuevo" ><i class="fas fa-plus"></i> Nuevo Cotización</button>   
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-12">
                                        <div class="card card-outline card-lightblue">
                                            <div class="card-header">
                                                <h3 class="card-title">Listado de Cotizaciones</h3>
                                            </div>                                        
                                            <div class="card-body">
                                                <table id="tblListCotizacion" class="table table-striped table-bordered" style="width:100%">
                                                    <thead>
                                                    <tr>
                                                        <th></th>
                                                        <th>Cliente</th>
                                                        <th>Cotizacion</th>
                                                        <th>Fecha</th>
                                                        <th>Precio Total</th>
                                                        <th>Elaborado por</th>
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
                            <div class="tab-pane fade" id="tablab-reg" role="tabpanel" aria-labelledby="tablab-reg-tab">
                                <fieldset class="scheduler-border-fsc" id="regCoti">
                                    <legend class="scheduler-border-fsc text-primary">REG. COTIZACION / PROPUESTA</legend>
                                    <form class="form-horizontal" id="frmRegCoti" action="<?= base_url('lab/coti/ccotizacion/setcotizacion')?>" method="POST" enctype="multipart/form-data" role="form">
                                        <input type="hidden" name="mtxtidcotizacion" id="mtxtidcotizacion" class="form-control">
                                        <input type="hidden" name="mtxtnroversion" id="mtxtnroversion" class="form-control" value='0'>
                                        <input type="hidden" name="hdnAccionregcoti" id="hdnAccionregcoti" class="form-control">

                                        <input type="hidden" name="mtxtidusuario" class="form-control" id="mtxtidusuario" value="<?php echo $idusuario ?>">
                                        <input type="hidden" name="mtxtcusuario" class="form-control" id="mtxtcusuario" value="<?php echo $cusuario ?>">
                                        <div class="row">                 
                                            <div class="col-sm-3">
                                                <div class="form-group">
                                                    <div class="text-info">Fecha Cotización/Propuesta </div>
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
                                                    <div class="text-info">Nro Cotización/Propuesta </div>
                                                    <input type="text" name="mtxtregnumcoti"id="mtxtregnumcoti" class="form-control">
                                                </div>
                                            </div>
                                            <div class="col-md-2">
                                                <div class="form-group">    
                                                    <div class="text-info">Estado </div>
                                                    <input type="text" id="mtxtregestado" name="mtxtregestado" class="form-control">
                                                    <input type="hidden" name="hdnregestado" id="hdnregestado" class="form-control">
                                                </div>
                                            </div>
                                            <div class="col-md-1">
                                                <div class="form-group">
                                                    <div class="text-info">Vigencia </div>
                                                    <input type="number" name="mtxtregvigen" id="mtxtregvigen" class="form-control" value="30" min="0" pattern="^[0-9]+">
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <div class="text-info">Servicio <span class="text-requerido">*</span></div>
                                                    <select class="form-control select2bs4" id="cboregserv" name="cboregserv" style="width: 100%;">
                                                        <option value="" selected="selected">Cargando...</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <div class="text-info">Cliente <span class="text-requerido">*</span></div>
                                                    <select class="form-control select2bs4" id="cboregclie" name="cboregclie" style="width: 100%;">
                                                        <option value="" selected="selected">Cargando...</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <div class="text-info">Proveedor del Cliente </div>
                                                    <select class="form-control select2bs4" id="cboregprov" name="cboregprov" style="width: 100%;">
                                                        <option value="" selected="selected">Cargando...</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <div class="text-info">Contacto del Cliente </div>
                                                    <select class="form-control select2bs4" id="cboregcontacto" name="cboregcontacto" style="width: 100%;">
                                                        <option value="" selected="selected">Cargando...</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">   
                                            <div class="col-md-2">
                                                <div class="form-group">                                                    
                                                    <div class="text-info">Contra Muestra </div>
                                                    <div class="input-group mb-3">
                                                        <input type="number" name="mtxtcontramuestra"id="mtxtcontramuestra" class="form-control" value="0" min="0" pattern="^[0-9]+">
                                                        <div class="input-group-prepend">
                                                            <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown">
                                                            <span id="btntipocontramuestra">NA</span>
                                                            </button>
                                                            <div class="dropdown-menu">
                                                                <a class="dropdown-item" onClick="javascript:na()">NA</a>
                                                                <a class="dropdown-item" onClick="javascript:dias()">Días</a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <input type="hidden" name="mtxtregpermane"id="mtxtregpermane">
                                                </div>
                                            </div>  
                                            <div class="col-md-2">
                                                <div class="form-group">
                                                    <div class="text-info">Tiempo Entrega Inf. </div>
                                                    <div class="input-group mb-3">
                                                        <input type="number" name="mtxtregentregainf"id="mtxtregentregainf" class="form-control" min="0" pattern="^[0-9]+">
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
                                            <div class="col-md-8">
                                                <div class="form-group">
                                                    <div class="text-info">Observaciones </div>
                                                    <input type="text" name="mtxtobserv"id="mtxtobserv" class="form-control" >
                                                </div>
                                            </div>  
                                        </div>
                                        <div class="row">
                                            <div class="col-md-2">
                                                <div class="form-group">
                                                    <div class="text-info">Forma de Pago </div>
                                                    <div class="input-group mb-3">
                                                        <div class="input-group-prepend">
                                                            <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown">
                                                            <span id="btnformapagos">Contado</span>
                                                            </button>
                                                            <div class="dropdown-menu">
                                                                <a class="dropdown-item" onClick="javascript:conta()">Contado</a>
                                                                <a class="dropdown-item" onClick="javascript:credi()">Crédito</a>
                                                                <a class="dropdown-item" onClick="javascript:otro()">Otros</a>
                                                            </div>
                                                        </div>
                                                        <input type="text" name="mtxtregpagotro"id="mtxtregpagotro" class="form-control" >
                                                    </div>
                                                    <input type="hidden" name="txtregformapagos" id="txtregformapagos">
                                                </div>
                                            </div> 
                                            <div class="col-md-2">
                                                <div class="form-group">
                                                    <div class="text-info">Moneda </div>
                                                    <div class="input-group mb-3">
                                                        <div class="input-group-prepend">
                                                            <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown">
                                                            <span id="btntipopagos">S/.</span>
                                                            </button>
                                                            <div class="dropdown-menu">
                                                                <a class="dropdown-item" onClick="javascript:soles()">S/.</a>
                                                                <a class="dropdown-item" onClick="javascript:dolares()">$</a>
                                                            </div>
                                                        </div>                                                        
                                                        <input type="number" name="mtxtregtipocambio"id="mtxtregtipocambio" class="form-control" placeholder="0.00" min="0.00">
                                                    </div>
                                                    <input type="hidden" name="mtxtregtipopagos" id="mtxtregtipopagos">
                                                </div>
                                            </div>                                            
                                            <div class="col-md-2">
                                                <div class="form-group">                                                    
                                                    <div class="checkbox"><div class="text-info">
                                                    <input type="checkbox" id="chksmuestreo" name="chksmuestreo" />&nbsp;Muestreo </div> </div>   
                                                    <input type="number" name="txtmontmuestreo"id="txtmontmuestreo" class="form-control" placeholder="0.00" min="0.00">
                                                </div>
                                            </div> 
                                            <div class="col-md-2">
                                                <div class="form-group">
                                                    <div class="text-info">Sub Total </div>
                                                    <input type="number" name="txtmontsubtotal"id="txtmontsubtotal" class="form-control" placeholder="0.00" min="0.00">
                                                </div>
                                            </div>   
                                            <div class="col-md-1">
                                                <div class="form-group">
                                                    <div class="text-info">Dscto. (%) </div>
                                                    <input type="number" name="txtporcdescuento"id="txtporcdescuento" class="form-control" placeholder="0" min="0">
                                                </div>
                                            </div>  
                                            <div class="col-md-1">
                                                <div class="form-group">
                                                    <div class="text-info">IGV. (%) </div>
                                                    <input type="number" name="txtporctigv"id="txtporctigv" class="form-control" placeholder="0" min="0">
                                                </div>
                                            </div>   
                                            <div class="col-md-2">
                                                <div class="form-group">
                                                    <div class="text-info">Total </div>
                                                    <input type="number" name="txtmonttotal"id="txtmonttotal" class="form-control" placeholder="0.00" min="0.00">
                                                </div>
                                            </div>  
                                        </div>
                                        <div class="row">
                                            <div class="col-sm-5 text-left"> 
                                                <div class="form-group">
                                                    <div class="col-md-5">
                                                        <div class="custom-control custom-checkbox">
                                                            <input type="checkbox" class="custom-control-input" id="chkregverpago" name="chkregverpago" />
                                                            <label for="chkregverpago" class="custom-control-label">Ver Precios</label>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-sm-7 text-right"> 
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
                                        </div> 
                                        <div class="row"> 
                                            <div class="col-12">
                                                <div class="card card-outline card-lightblue">
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
                                                <div class="card card-outline card-lightblue">
                                                    <div class="card-header">
                                                        <h3 class="card-title"><i class="fas fa-microscope"></i>&nbsp;<b>Ensayos - <small id="lblProducto"></small> ::</b> <label id="lblNrocoti"></label></h3>
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
                                                                <th>Cant.</th>
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

<!-- Reg. Ensayos-->
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

<!-- /.modal-crear-producto --> 
<div class="modal fade" id="modalCreaProduc" data-backdrop="static" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      

        <div class="modal-header text-center bg-lightblue">
            <h4 class="modal-title w-100 font-weight-bold">Registro de Producto</h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>

        <div class="modal-body">          
                        
        </div>

        <div class="modal-footer">          
        </div>
                
      </form>
    </div>
  </div>
</div> 
<!-- /.modal-->


<!-- /.modal- Insertar EnsayosLab --> 
<div class="modal fade" id="modalselensayo" data-backdrop="static" role="dialog" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <form class="form-horizontal" id="frmEnsayosLab" name="frmEnsayosLab" action="<?= base_url('lab/coti/ccotizacion/setregensayoxprod')?>" method="POST" enctype="multipart/form-data" role="form"> 

        <div class="modal-header text-center bg-success">
            <h4 class="modal-title w-100 font-weight-bold">Ingresar Ensayos x Laboratorio</h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>

        <div class="modal-body">
            <input type="hidden" id="mhdnmcensayo" name="mhdnmcensayo"> 
            <input type="hidden" id="hdnmIdcoti" name="hdnmIdcoti" >
            <input type="hidden" id="hdnmNvers" name="hdnmNvers" >
            <input type="hidden" id="hdnmIdprod" name="hdnmIdprod" >
            
            <input type="hidden" id="mtxtmCLab" name="mtxtmCLab" >
            <input type="hidden" id="hdnmAccion" name="hdnmAccion" >
            <div class="form-group">
                <div class="row"> 
                    <div class="col-12">
                        <h4>
                            <i class="fas fa-archive"></i> <label id="lblmProducto"></label>
                        </h4>
                    </div>
                </div>                
            </div> 
            <div class="form-group">
                <div class="row"> 
                    <div class="col-2">
                        <label>Codigo :</label>
                    </div>
                    <div class="col-3">
                        <h5>                            
                            <small id="lblmCodigo"></small>
                        </h5>
                    </div>
                    <div class="col-2">
                        <label>Ensayo :</label>
                    </div>
                    <div class="col-5">
                        <h5>                            
                            <small id="lblmEnsayo"></small>
                        </h5>
                    </div>
                </div>                
            </div>                        
            <div class="form-group"> 
                <div class="row">
                    <div class="col-md-6"> 
                        <div class="text-info">Costo</div>
                        <div>    
                            <input type="text" name="mtxtmCosto" class="form-control" id="mtxtmCosto"/> 
                        </div>
                    </div>
                    <div class="col-md-6"> 
                        <div class="text-info">Vias</div>                        
                        <div>    
                            <input type="number" name="mtxtmvias" class="form-control" id="mtxtmvias"/>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="modal-footer justify-content-between" style="background-color: #dff0d8;">
            <button type="reset" class="btn btn-default" id="mbtnCerrarEnsayo" data-dismiss="modal">Cancelar</button>
            <button type="submit" class="btn btn-info" id="mbtnGabarEnsayo">Grabar</button>
        </div>
      </form>
    </div>
  </div>
</div> 
<!-- /.modal-->

<!-- /.modal-Editar EnsayosLab --> 
<div class="modal fade" id="modaleditensayo" data-backdrop="static" role="dialog" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <form class="form-horizontal" id="frmEditensayosLab" name="frmEditensayosLab" action="<?= base_url('lab/coti/ccotizacion/seteditensayoxprod')?>" method="POST" enctype="multipart/form-data" role="form"> 

        <div class="modal-header text-center bg-success">
            <h4 class="modal-title w-100 font-weight-bold">Ingresar Ensayos x Laboratorio</h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>

        <div class="modal-body">
            <input type="hidden" id="ehdnmcensayo" name="ehdnmcensayo"> 
            <input type="hidden" id="ehdnmIdcoti" name="ehdnmIdcoti" >
            <input type="hidden" id="ehdnmNvers" name="ehdnmNvers" >
            <input type="hidden" id="ehdnmIdprod" name="ehdnmIdprod" >
            
            <input type="hidden" id="etxtmCLab" name="etxtmCLab" >
            <input type="hidden" id="ehdnmAccion" name="ehdnmAccion" >
            <div class="form-group">
                <div class="row"> 
                    <div class="col-12">
                        <h4>
                            <i class="fas fa-archive"></i> <label id="elblmProducto"></label>
                        </h4>
                    </div>
                </div>                
            </div> 
            <div class="form-group">
                <div class="row"> 
                    <div class="col-2">
                        <label>Codigo :</label>
                    </div>
                    <div class="col-3">
                        <h5>                            
                            <small id="elblmCodigo"></small>
                        </h5>
                    </div>
                    <div class="col-2">
                        <label>Ensayo :</label>
                    </div>
                    <div class="col-5">
                        <h5>                            
                            <small id="elblmEnsayo"></small>
                        </h5>
                    </div>
                </div>                
            </div>                        
            <div class="form-group"> 
                <div class="row">
                    <div class="col-md-6"> 
                        <div class="text-info">Costo</div>
                        <div>    
                            <input type="text" name="etxtmCosto" class="form-control" id="etxtmCosto"/> 
                        </div>
                    </div>
                    <div class="col-md-6"> 
                        <div class="text-info">Vias</div>                        
                        <div>    
                            <input type="number" name="etxtmvias" class="form-control" id="etxtmvias"/>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="modal-footer justify-content-between" style="background-color: #dff0d8;">
            <button type="reset" class="btn btn-default" id="ebtnCerrarEnsayo" data-dismiss="modal">Cancelar</button>
            <button type="submit" class="btn btn-info" id="ebtnGabarEnsayo">Grabar</button>
        </div>
      </form>
    </div>
  </div>
</div> 
<!-- /.modal-->