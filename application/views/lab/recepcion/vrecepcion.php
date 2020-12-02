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
        <h1 class="m-0 text-dark">RECEPCION DE MUESTRAS</h1>
      </div>
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="<?php echo public_base_url(); ?>cprincipal/principal">Home</a></li>
          <li class="breadcrumb-item active">Laboratorio</li>
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
                        <ul class="nav nav-tabs" id="tablab" style="background-color: #2875A7;" role="tablist">                    
                            <li class="nav-item">
                                <a class="nav-link active" style="color: #000000;" id="tablab-list-tab" data-toggle="pill" href="#tablab-list" role="tab" aria-controls="tablab-list" aria-selected="true">LISTADO</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" style="color: #000000;" id="tablab-reg-tab" data-toggle="pill" href="#tablab-reg" role="tab" aria-controls="tablab-reg" aria-selected="false">REGISTRO</a>
                            </li>
                        </ul>
                    </div>
                    <div class="card-body">
                        <div class="tab-content" id="tablab-tabContent">
                            <div class="tab-pane fade show active" id="tablab-list" role="tabpanel" aria-labelledby="tablab-list-tab">                                
                                <div class="card card-primary">
                                    <div class="card-header">
                                        <h3 class="card-title">BUSQUEDA</h3>
                                        <div class="card-tools">
                                            <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i></button>
                                        </div>
                                    </div>                                
                                    <div class="card-body">
                                        <input type="hidden" name="mtxtidcotizacion" class="form-control" id="mtxtidcotizacion" >
                                        <input type="hidden" name="mtxtnroversion" class="form-control" id="mtxtnroversion" >
                                        <div class="row">
                                            <div class="col-md-6"> 
                                                <label>Nro. Cotizacion/ Producto</label> 
                                                <div>
                                                    <input type="text" id="txtdescri" name="txtdescri" class="form-control" />
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
                                                <h3 class="card-title">Listado de Cotizaciones</h3>
                                            </div>                                        
                                            <div class="card-body">
                                                <table id="tblListRecepcion" class="table table-striped table-bordered" style="width:100%">
                                                    <thead>
                                                    <tr>
                                                        <th></th>
                                                        <th>Cliente</th>
                                                        <th>Cotizacion</th>
                                                        <th>Elaborado por</th>
                                                        <th>Fecha</th>
                                                        <th>Entrega</th>
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
                                    <legend class="scheduler-border-fsc text-primary">RECEPCION DE MUESTRA</legend>
                                    <div id="regProductos" style="border-top: 1px solid #ccc; padding-top: 10px;">
                                        <div class="row">
                                            <div class="col-6">
                                                <h4>
                                                    <i class="fas fa-weight"></i> <label id="lblclie"></label>
                                                    <small id="lblcoti"> </small>
                                                </h4>
                                            </div> 
                                            <div class="col-6">
                                                <button type="button" class="btn btn-secondary" id="btnRetornarLista"><i class="fas fa-undo-alt"></i> Retornar</button>
                                            </div> 
                                        </div> 
                                        <div class="row"> 
                                            <div class="col-12">
                                                <div class="card card-outline card-primary">
                                                    <div class="card-header">
                                                        <h3 class="card-title">Listado de Recepcion</h3>
                                                    </div>                                        
                                                    <div class="card-body">
                                                        <table id="tblListProductos" class="table table-striped table-bordered" style="width:100%">
                                                            <thead>
                                                            <tr>
                                                                <th>N°</th>
                                                                <th>F. Recepcion</th>
                                                                <th>Tottus</th>
                                                                <th>Codigo</th>
                                                                <th>Monitoreo</th>
                                                                <th>Motivo</th>
                                                                <th>Area</th>
                                                                <th>Ubicacion</th>
                                                                <th>Item</th>
                                                                <th>Producto Real</th>
                                                                <th>Presentacion</th>
                                                                <th>Temp. Recep.</th>
                                                                <th>Cant. Muestra</th>
                                                                <th>Proveedor</th>
                                                                <th>N° Lote</th>
                                                                <th>F. Envase</th>
                                                                <th>F. Produccion</th>
                                                                <th>F. Vencimiento</th>
                                                                <th>F. Ingreso</th>
                                                                <th>Temp. Prod.</th>
                                                                <th>Temp. Alma.</th>
                                                                <th>F. Muestreo</th>
                                                                <th>Hora Muestreo</th>
                                                                <th>Estado</th>
                                                                <th>Observacion</th>
                                                                <th>Observacion Otros</th>
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
<div class="modal fade" id="modalRecepcion" data-backdrop="static" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <form class="form-horizontal" id="frmRecepcion" name="frmRecepcion" action="<?= base_url('lab/cpti/ccotizacion/setproducto')?>" method="POST" enctype="multipart/form-data" role="form"> 

        <div class="modal-header text-center bg-success">
            <h4 class="modal-title w-100 font-weight-bold">Registro de Recepcion</h4>
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
                    <div class="col-sm-2">
                        <div class="text-info">Codigo <span class="text-requerido">*</span></div>
                        <div>  
                            <input type="text" name="mtxtregProducto" class="form-control" id="mtxtregProducto" disabled/>  
                        </div>
                    </div>                 
                    <div class="col-sm-2">
                        <div class="form-group">
                            <div class="text-info">F. Recepcion</div>
                            <div class="input-group date" id="mtxtFCoti" data-target-input="nearest">
                                <input type="text" id="mtxtFcotizacion" name="mtxtFcotizacion" class="form-control datetimepicker-input" data-target="#mtxtFCoti"/>
                                <div class="input-group-append" data-target="#mtxtFCoti" data-toggle="datetimepicker">
                                    <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                </div>
                            </div>                        
                        </div> 
                    </div>                
                    <div class="col-sm-2">
                        <div class="text-info">Tottus</div>
                        <div>
                            <select class="form-control select2bs4" id="mcboregcondicion" name="mcboregcondicion">
                            <option value="">Cargando...</option>
                            </select>
                        </div>
                    </div>               
                    <div class="col-sm-2">
                        <div class="text-info">Monitoreo</div>
                        <div>
                            <select class="form-control select2bs4" id="mcboregcondicion" name="mcboregcondicion">
                            <option value="">Cargando...</option>
                            </select>
                        </div>
                    </div>               
                    <div class="col-sm-2">
                        <div class="text-info">Motivo</div>
                        <div>
                            <select class="form-control select2bs4" id="mcboregcondicion" name="mcboregcondicion">
                            <option value="">Cargando...</option>
                            </select>
                        </div>
                    </div>               
                    <div class="col-sm-2">
                        <div class="text-info">Area</div>
                        <div>
                            <select class="form-control select2bs4" id="mcboregcondicion" name="mcboregcondicion">
                            <option value="">Cargando...</option>
                            </select>
                        </div>
                    </div> 
                </div>                
            </div>          
            <div class="form-group">
                <div class="row">             
                    <div class="col-sm-2">
                        <div class="text-info">Area</div>
                        <div>
                            <select class="form-control select2bs4" id="mcboregcondicion" name="mcboregcondicion">
                            <option value="">Cargando...</option>
                            </select>
                        </div>
                    </div> 
                    <div class="col-sm-10">
                        <div class="text-info">Ubicacion <span class="text-requerido">*</span></div>
                        <div>  
                            <input type="text" name="mtxtregProducto" class="form-control" id="mtxtregProducto"/>  
                        </div>
                    </div>  
                </div>                
            </div> 
            <div class="form-group">
                <div class="row">                
                    <div class="col-sm-6">
                        <div class="text-info">Producto Real</div>
                        <div>
                            <select class="form-control select2bs4" id="mcboregcondicion" name="mcboregcondicion">
                            <option value="">Cargando...</option>
                            </select>
                        </div>
                    </div>                
                    <div class="col-sm-6">
                        <div class="text-info">Presentacion</div>
                        <div>  
                            <input type="text" name="mtxtregmuestra" class="form-control" id="mtxtregmuestra"/>  
                        </div>
                    </div> 
                </div>                
            </div> 
            <div class="form-group">
                <div class="row">    
                    <div class="col-sm-3">
                        <div class="text-info">Temp. Recepcion</div>
                        <div>  
                            <input type="text" name="mtxtregmuestra" class="form-control" id="mtxtregmuestra"/>  
                        </div>
                    </div>    
                    <div class="col-sm-3">
                        <div class="text-info">Cantidad Muestra</div>
                        <div>  
                            <input type="text" name="mtxtregmuestra" class="form-control" id="mtxtregmuestra"/>  
                        </div>
                    </div>    
                    <div class="col-sm-3">
                        <div class="text-info">Proveedor</div>
                        <div>  
                            <input type="text" name="mtxtregmuestra" class="form-control" id="mtxtregmuestra"/>  
                        </div>
                    </div>   
                    <div class="col-sm-3">
                        <div class="text-info">N° Lote</div>
                        <div>  
                            <input type="text" name="mtxtregmuestra" class="form-control" id="mtxtregmuestra"/>  
                        </div>
                    </div>  
                </div>                
            </div> 
            <div class="form-group">
                <div class="row">  
                    <div class="col-sm-3">
                        <div class="form-group">
                            <div class="text-info">F. Envase</div>
                            <div class="input-group date" id="mtxtFCoti" data-target-input="nearest">
                                <input type="text" id="mtxtFcotizacion" name="mtxtFcotizacion" class="form-control datetimepicker-input" data-target="#mtxtFCoti"/>
                                <div class="input-group-append" data-target="#mtxtFCoti" data-toggle="datetimepicker">
                                    <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                </div>
                            </div>                        
                        </div>                       
                    </div>   
                    <div class="col-sm-3">
                        <div class="form-group">
                            <div class="text-info">F. Produccion</div>
                            <div class="input-group date" id="mtxtFCoti" data-target-input="nearest">
                                <input type="text" id="mtxtFcotizacion" name="mtxtFcotizacion" class="form-control datetimepicker-input" data-target="#mtxtFCoti"/>
                                <div class="input-group-append" data-target="#mtxtFCoti" data-toggle="datetimepicker">
                                    <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                </div>
                            </div>                        
                        </div>                       
                    </div>     
                    <div class="col-sm-3">
                        <div class="form-group">
                            <div class="text-info">F. Vencimiento</div>
                            <div class="input-group date" id="mtxtFCoti" data-target-input="nearest">
                                <input type="text" id="mtxtFcotizacion" name="mtxtFcotizacion" class="form-control datetimepicker-input" data-target="#mtxtFCoti"/>
                                <div class="input-group-append" data-target="#mtxtFCoti" data-toggle="datetimepicker">
                                    <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                </div>
                            </div>                        
                        </div>                       
                    </div>   
                    <div class="col-sm-3">
                        <div class="form-group">
                            <div class="text-info">F. Ingreso</div>
                            <div class="input-group date" id="mtxtFCoti" data-target-input="nearest">
                                <input type="text" id="mtxtFcotizacion" name="mtxtFcotizacion" class="form-control datetimepicker-input" data-target="#mtxtFCoti"/>
                                <div class="input-group-append" data-target="#mtxtFCoti" data-toggle="datetimepicker">
                                    <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                </div>
                            </div>                        
                        </div>                       
                    </div> 
                </div>                
            </div>   
            <div class="form-group">
                <div class="row">    
                    <div class="col-sm-3">
                        <div class="text-info">Temp. Prod</div>
                        <div>  
                            <input type="text" name="mtxtregmuestra" class="form-control" id="mtxtregmuestra"/>  
                        </div>
                    </div>    
                    <div class="col-sm-3">
                        <div class="text-info">Temp. Alma</div>
                        <div>  
                            <input type="text" name="mtxtregmuestra" class="form-control" id="mtxtregmuestra"/>  
                        </div>
                    </div>  
                    <div class="col-sm-2">
                        <div class="form-group">
                            <div class="text-info">F. Muestra</div>
                            <div class="input-group date" id="mtxtFCoti" data-target-input="nearest">
                                <input type="text" id="mtxtFcotizacion" name="mtxtFcotizacion" class="form-control datetimepicker-input" data-target="#mtxtFCoti"/>
                                <div class="input-group-append" data-target="#mtxtFCoti" data-toggle="datetimepicker">
                                    <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                </div>
                            </div>                        
                        </div>                       
                    </div>    
                    <div class="col-sm-2">
                        <div class="text-info">Hora Muestra</div>
                        <div>  
                            <input type="text" name="mtxtregmuestra" class="form-control" id="mtxtregmuestra"/>  
                        </div>
                    </div>      
                    <div class="col-sm-2">
                        <div class="text-info">Estado</div>
                        <div>  
                            <input type="text" name="mtxtregmuestra" class="form-control" id="mtxtregmuestra"/>  
                        </div>
                    </div>  
                </div>                
            </div>
            <div class="form-group">
                <div class="row">                
                    <div class="col-sm-12">
                        <div class="text-info">Observación</div>
                        <div>   
                            <textarea class="form-control" cols="20" data-val="true" data-val-length="No debe superar los 500 caracteres." data-val-length-max="500" id="mtxtObspropu" name="mtxtObspropu" rows="2" data-val-maxlength-max="500" data-validation="required"></textarea>
                            <span class="help-inline" style="padding-left:0px; color:#999; font-size:0.9em;">Caracteres: 0 / 500</span>     
                        </div> 
                    </div> 
                </div>                
            </div> 
            <div class="form-group">
                <div class="row">                
                    <div class="col-sm-12">
                        <div class="text-info">Observación Otros</div>
                        <div>   
                            <textarea class="form-control" cols="20" data-val="true" data-val-length="No debe superar los 500 caracteres." data-val-length-max="500" id="mtxtObspropu" name="mtxtObspropu" rows="2" data-val-maxlength-max="500" data-validation="required"></textarea>
                            <span class="help-inline" style="padding-left:0px; color:#999; font-size:0.9em;">Caracteres: 0 / 500</span>     
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
