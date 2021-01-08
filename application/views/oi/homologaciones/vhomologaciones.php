<?php
    $idusuario  = $this-> session-> userdata('s_idusuario');
    $cia        = $this-> session-> userdata('s_cia');
    $usuario = $this->session->userdata('s_usuario');
?>
<style>
.custom-file-label.archivoGuia:after{
    display:none;
}
</style>

<!-- content-header -->
<div class="content-header">   
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-6">
        <h1 class="m-0 text-dark">HOMOLOGACIONES DE PRODUCTOS</h1>
      </div>
      <div class="col-6">
        <ol class="breadcrumb float-right">
          <li class="breadcrumb-item"><a href="<?php echo public_base_url(); ?>cprincipal/principal">Inicio</a></li>
          <li class="breadcrumb-item">Homologaciones</li>
          <li class="breadcrumb-item active">Registro de Homologación</li>
        </ol>
      </div>
    </div>
  </div>
</div>
<!-- /.content-header -->

<!-- Main content -->
<section class="content">
    <div class="container-fluid">  
        
        <div class="card card-lightblue card-outline card-tabs">

            <div class="card-header p-0 pt-1 border-bottom-0">            
                <ul class="nav nav-tabs bg-lightblue" id="tabExped" role="tabExped">                    
                    <li class="nav-item">
                        <a class="nav-link active" style="color: #000000;" id="tabExped-list-tab" data-toggle="pill" href="#tabExped-list" role="tab" aria-controls="tabExped-list" aria-selected="true">Listado</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" style="color: #000000;" id="tabExped-new-tab" data-toggle="pill" href="#tabExped-new" role="tab" aria-controls="tabExped-new" aria-selected="false">Registro de Evaluacion de Proveedor</a>
                    </li>

                     <li class="nav-item">
                        <a class="nav-link" style="color: #000000;" id="tabExped-eval-tab" data-toggle="pill" href="#tabExped-eval" role="tab" aria-controls="tabExped-new" aria-selected="false">Evaluación de Solicitudes</a>
                    </li>

                </ul>
            </div>
            
        
        
            <div class="card-body">
            
                <div class="tab-content" id="tabExped-tabContent">

                    <div class="tab-pane fade show active" id="tabExped-list" role="tabpanel" aria-labelledby="tabExped-list-tab"> 
                        <div class="card card-lightblue">
                            <div class="card-header">
                                <h3 class="card-title">BUSQUEDA</h3>
                                <div class="card-tools">
                                    <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i></button>
                                </div>
                            </div>
                            <form method="post" id="frmBuscarExp" action="<?= base_url('oi/homologaciones/chomologaciones/getbuscarexpediente')?>" enctype="multipart/form-data" role="form">
                                <div class="card-body"> 
                                    <!-- INICIO -->
                                    <div class="row">

                                        <div class="col-md-3 col-12">
                                            <!-- text input -->
                                            <div class="form-group">
                                                <label>CLIENTE PRINCIPAL</label>
                                                <select id="cboCliente" class="form-control select2bs4" name="cboCliente">
                                                    
                                                    <option value="" selected="selected">::Elegir</option>
                                                </select>
                                            </div>
                                        </div>


                                        <div class="col-md-5 col-12">
                                            
                                            <div class="row">

                                                <label class="col-md-12 col-12">Fec. Publicación</label>
                                                <div class="col-md-6 col-12">
                                                    <div class="input-group date" id="txtFDesde" data-target-input="nearest">
                                                        <input type="text" id="FechaInicial" name="FechaInicial" class="form-control datetimepicker-input"
                                                            data-target="#txtFDesde" />
                                                        <div class="input-group-append" data-target="#txtFDesde" data-toggle="datetimepicker">
                                                            <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="col-md-6 col-12">
                                                    <div class="input-group date" id="txtFFinal" data-target-input="nearest">
                                                        <input type="text" id="FechaTermino" name="FechaTermino" class="form-control datetimepicker-input" data-target="#txtFFinal"  />
                                                        <div class="input-group-append" data-target="#txtFFinal" data-toggle="datetimepicker">
                                                            <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                                        </div>
                                                    </div>
                                                </div>

                                            </div>
                                        
                                        </div>


                                        <div class="col-md-4 col-12">
                                            <div class="form-group">
                                                <label>ESTADO</label>

                                                <div class="row">

                                                    <div class="form-check form-check-inline mr-1">
                                                        <input class="form-check-input" type="checkbox" id="checkTodos" checked>
                                                        <label class="form-check-label" for="checkTodos">TODOS</label>
                                                    </div>

                                                    <select id="cboEstado" class="form-control select2bs4 col-md-9" name="cmbEstado" disabled>
                                                        <option value="%" selected="selected">::Elegir</option>
                                                    
                                                    </select>
                                                    
                                                </div>
                                                
                                            </div>
                                        </div>


                                        

                                    </div>



                                    <div class="form-group">
                                        <div class="col-md-12 text-right">
                                            <button id="btnBuscarExp" type="button" class="btn bg-lightblue"><i class="fa fa-search"></i>Buscar</button>
                                            
                                        </div>
                                    </div>

                                </div>  
                            </form>
                        </div> 

                        <div class="row">
                            <div class="col-12">
                                <div class="card card-lightblue">
                                    <div class="card-header">
                                        Listado de Expedientes: <span class="font-weight-bold" id="clienteExp"></span>
                                    </div>
                                
                                    <div class="card-body">
                                        <table id="tblListado" class="table table-bordered table-striped " style="width:100%">
                                            <thead>
                                            <tr>
                                               
                                                <th>EXPEDIENTE</th>
                                                <th>FEC. REGISTRO</th>
                                                <th>PROVEEDOR</th>
                                                <th>RUC</th> 
                                                <th>ACCIONES</th>           
                                            </tr>
                                            </thead>   
                                            <tbody>
                                            </tbody> 
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>  

                        <!-- TABLA EXPEDIENTES DETALLE-->
                        <div class="row">
                            <div class="col-12">
                                <div class="card card-outline card-lightblue d-none" id="tblDetalleExp">
                                    <div class="card-header">
                                        Listado de Detalles de Expediente
                                    </div>
                                
                                    <div class="card-body">
                                        <table id="tblListadoDetalle" class="table table-bordered table-striped " style="width:100%">
                                            <thead>
                                            <tr>
                                                <th></th>
                                                <th>PRODUCTO</th>
                                                <th>MARCA</th>
                                                <th>REG. SAN.</th>
                                                <th>FEC. EMI</th>
                                                <th>FEC. VENC.</th>    
                                                <th>ESTADO</th>    
                                                <th>FEC. INICIO</th>
                                                <th>FEC. FIN</th>       
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


                    <div class="tab-pane fade" id="tabExped-new" role="tabpanel" aria-labelledby="tabExped-new-tab">
                        
                            <div class="card card-lightblue">

                                    <div class="card-header">
                                        <h3 class="card-title"><i class="fa fa-edit"></i> Registro de Solicitud</h3>
                                        <div class="card-tools">
                                            <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i></button>
                                        </div>
                                    </div>
                                <form method="post" id="fmrNewExpediente" name="fmrNewExpediente" enctype="multipart/form-data">
                                    <div class="card-body">

                                        <fieldset id="regInforme" style="border: solid 1px #3c8dbc;">
                                            <div class="box-body p-3">    
                                                <!-- row1 -->
                                                <div class="row">

                                                   
                                                    <div class="col-md-3 col-12">
                                                        <div class="form-group">

                                                            <label>CLIENTE</label>
                                                                <select class="form-control select2bs4" id="cboCliente01" name="cboCliente01">
                                                                    <option value="" selected="selected">Cargando...</option>
                                                                </select>

                                                        </div>
                                                    </div>


                                                    <div class="col-md-3 col-12">
                                                        <div class="form-group">
                                                            <label class="control-label col-12" for="Codigo">AREA</label>
                                                            
                                                                <select class="form-control select2bs4" id="cboArea" name="cboArea">
                                                                </select>
                                                            
                                                        </div>
                                                    </div>

                                                    <div class="col-md-3 col-12">
                                                        <div class="form-group">
                                                            <label class="control-label col-12" for="Codigo">CONTACTO</label>
                                                        
                                                            <select class="form-control select2bs4" id="cboTipoequipoReg05" name="#">
                                                                <option value="" selected="selected">Cargando...</option>
                                                            </select>
                                                        
                                                        </div>
                                                    </div>

                                                    <div class="col-md-3">
                                                        <label>ESTADO</label>  
                                                        <select class="form-control select2bs4" id="cboEstadoProveedor" name="cboEstadoProveedor">
                                                            <option value="">::Elegir</option>
                                                            <option value="A"> ACTIVO</option>
                                                            <option value="I"> INACTIVO</option>
                                                        </select>
                                                    </div>

                                               
                                            </div>
                                        </fieldset>

                                        <fieldset id="regInforme" class="mt-4 mb-3" style="border: solid 1px #3c8dbc;">
                                            <div class="box-body p-3">    
                                                        
                                                <!-- row 2 -->
                                                <div class="row">

                                                    <div class="col-md-4 col-12">
                                                        <!-- text input -->
                                                        <div class="form-group">
                                                            <label>PROVEEDOR</label>
                                                                <select class="form-control select2bs4" id="cboProveedor" name="cboProveedor">
                                                                    <option value="" selected="selected">Cargando...</option>
                                                                </select>
                                                        </div>
                                                    </div>

                                                    <div class="col-md-4 col-12">
                                                        <div class="form-group">
                                                            <label for="">CONTACTO 1</label>
                                                            <select class="form-control select2bs4" id="cboContacto1" name="cboContacto1">
                                                                <option email="" value="" selected="selected">Cargando...</option>
                                                            </select>
                                                        </div>
                                                    </div>

                                                    <div class="col-md-4 col-12">
                                                        <!-- text input -->
                                                        <div class="form-group">
                                                            <label>EMAIL 1</label>
                                                            <input type="text" class="form-control" name="txtEmail1" id="txtEmail1"
                                                                placeholder="Ingresa Email 1" disabled>
                                                        </div>
                                                    </div>


                                                </div>


                                                <!-- row 3 -->
                                                <div class="row">

                                                    <div class="col-md-4 col-12">
                                                        <!-- Checkbox input -->
                                                        
                                                    </div>

                                                    <div class="col-md-4 col-12">   
                                                        <!-- text input -->
                                                        <div class="form-group">
                                                            <label>CONTACTO 2</label>
                                                            <select class="form-control select2bs4" id="cboContacto2" name="cboContacto2">
                                                                <option value="" selected="selected">Cargando...</option>
                                                            </select>
                                                        </div>
                                                    </div>


                                                    <div class="col-md-4 col-12">
                                                        <!-- text input -->
                                                        <div class="form-group">
                                                            <label>EMAIL 2</label>
                                                            <input type="text" class="form-control" name="txtEmail2" id="txtEmail2"
                                                                placeholder="Ingrese Email 2" disabled >
                                                        </div>
                                                    </div>

                                                </div>
                                            </div>
                                        </fieldset>
                                       
                                    </div>

                                    <div class="card-footer">
                                        <div class="form-group">
                                            <div class="col-md-12 text-right">
                                                    <button id="btnGuardarNorma" type="button" class="btn btn-primary d-none">
                                                        <i class="fa fa-save"></i> Crear Nuevo
                                                    </button>
                                                    <button type="button" class="btn btn-default d-none" id="btnCancelar">
                                                        <i class="fa fa-edit"></i> Modificar
                                                    </button>
                                            </div>
                                        </div>
                                    </div>

                                </form>

                            </div>

                            <div class="row">
                                <div class="col-12">
                                    <div class="card card-outline card-lightblue">
                                        <div class="card-header">
                                            <h3 class="card-title"> <i class="fa fa-list-alt"></i>  Detalles de Productos</h3>
                                            <button class="btn btn-info float-right" data-toggle="modal" data-target="#ModalEditarProducto" id="ModalProductoDos">
                                                <i class="fa fa-plus-circle"></i> Añadir Producto
                                            </button>
                                        </div>
                                    
                                        <div class="card-body">
                                            <table id="tblDetProducto" class="table table-striped table-bordered" style="width:100%">
                                                <thead>
                                                    <tr>
                                                        <th></th>
                                                        <th>Tipo Requisito</th>
                                                        <th>Producto</th>
                                                        <th>Marca</th>
                                                        <th>Envase Primario</th>
                                                        <th>Envase Secundario</th>
                                                        <th>Estado de Evaluacion</th>
                                                        <th>Acciones</th>
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

                    <div class="tab-pane fade" id="tabExped-eval" role="tabpanel" aria-labelledby="tabExped-eval-tab" exp="">
                        
                            <div class="card card-lightblue">

                                    <div class="card-header">
                                        <h3 class="card-title"><i class="fa fa-edit"></i> Productos del Proveedor</h3>
                                        <div class="card-tools">
                                            <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i></button>
                                        </div>
                                    </div>
                                    <div class="card-body">
   
                                        <table id="tblProdProveedor" class="table table-striped table-bordered" style="width:100%">
                                            <thead>
                                                <tr>
                                                    <th>#</th>
                                                    <th>Estado de Evaluacion</th>
                                                    <th>Producto</th>
                                                    <th>Monto</th>
                                                    <th>Pago Cliente</th>
                                                    <th>Fec. Cobro</th>
                                                    <th class="col-md-1">Acciones</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                            </tbody>
                                        </table>

                                    </div>

                            </div>

                            <div class="row">
                                <div class="col-12">
                                    <div class="card card-outline card-lightblue">
                                        <div class="card-header">
                                            <h3 class="card-title"> <i class="fa fa-list-alt"></i>  Requisitos del Producto Proveedor <span class="font-weight-bold" id="ProductoNombre"></span></h3>
                                            <button id="btnAddRequisito" class="btn btn-info float-right d-none" data-toggle="modal" data-target="#ModalAgregarRequisitoProducto">
                                                <i class="fa fa-plus-circle"></i> Insertar Registro
                                            </button>
                                        </div>
                                    
                                        <div class="card-body">
                                            <table id="tblDetProductoProveedor" class="table table-striped table-bordered" style="width:100%">
                                                <thead>
                                                    <tr>
                                                        <th>Requisito</th>
                                                        <th>Nota</th>
                                                        <th>Fecha</th>
                                                        <th>Descripcion</th>
                                                        <th>Conformidad</th>
                                                        <th>Ubicar Archivo</th>
                                                        <th>Tipo</th>
                                                        <th>Acciones</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                 
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>  

                            <div class="row">
                                <div class="col-12">
                                    <div class="card card-outline card-lightblue hidden invisible" id="cardObservaciones">

                                        <form id="frmRequisitoProdObs" method="post">
                                            <div class="card-header">
                                                <span class="font-weight-bold" id="ProductoNombre1"></span>
                                            </div>
                                        
                                            <div class="card-body">
                                                <input type="hidden" id="txtIdProdObservacion" name="txtIdProdObservacion" value=""> 
                                                <input type="hidden" id="txtExpedienteObservacion" name="txtExpedienteObservacion" value="">
                                                <div class="row">
                                                    <div class="col-md-8">
                                                        <div class="form-group col-md-12">
                                                            <label for="">OBSERVACIONES DE PRODUCTO DEL PROVEEDOR: </label>
                                                            <textarea class="form-control " id="mtxtObservacion" rows="4" name="mtxtObservacion"></textarea>
                                                        </div>

                                                        <div class="form-group col-md-12">
                                                            <label for="">ACUERDOS CON EL PROVEEDOR Y/O LEVANTAMIENTO DE OBSERVACIONES: </label>
                                                            <textarea class="form-control " id="mtxtAcuerdo" rows="2" name="mtxtAcuerdo"></textarea>
                                                        </div>
                                                    </div>
                                                    
                                                    
                                                    <div class="col-md-4">
                                                        <fieldset class="border p-2">
                                                                <div class="row">
                                                                    <div class="form-group col-md-7">
                                                                        <label>Fec. Recep. Doc.</label>
                                                                        <div class="input-group date" id="txtFecRecDoc" data-target-input="nearest">
                                                                            <input type="text" id="FechaRecepDoc" name="FechaRecepDoc" class="form-control datetimepicker-input" data-target="#txtFecRecDoc"  />
                                                                            <div class="input-group-append" data-target="#txtFecRecDoc" data-toggle="datetimepicker">
                                                                                <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                                                            </div>
                                                                        </div>
                                                                    </div>

                                                                    <div class="form-group col-md-5">
                                                                        <label>Tiempo Resp. Prov</label>
                                                                        <input type="text" class="form-control" name="tmpRespProv" id="tmpRespProv" >
                                                                    
                                                                    </div>
                                                                </div>

                                                                <div class="row">
                                                                    <div class="form-group col-md-7">
                                                                        <label>Fec. Inicio 1ra Eval.</label>
                                                                        <div class="input-group date" id="txtFecPrimEval" data-target-input="nearest">
                                                                            <input type="text" id="FecPrimEval" name="FecPrimEval" class="form-control datetimepicker-input" data-target="#txtFecPrimEval"  />
                                                                            <div class="input-group-append" data-target="#txtFecPrimEval" data-toggle="datetimepicker">
                                                                                <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                                                            </div>
                                                                        </div>
                                                                    </div>

                                                                    <div class="form-group col-md-5">
                                                                        <label>Tiempo Resp. FSC</label>
                                                                        <input type="text" class="form-control" name="tmpRespFsc" id="tmpRespFsc" >
                                                                    
                                                                    </div>
                                                                </div>

                                                                <div class="row">
                                                                    <div class="form-group col-md-7">
                                                                        <label>Fec. Lev. Obs.</label>
                                                                        <div class="input-group date" id="txtFechaLevObs" data-target-input="nearest">
                                                                            <input type="text" id="FechaLevObs" name="FechaLevObs" class="form-control datetimepicker-input" data-target="#txtFechaLevObs"  />
                                                                            <div class="input-group-append" data-target="#txtFechaLevObs" data-toggle="datetimepicker">
                                                                                <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                                                            </div>
                                                                        </div>
                                                                    </div>

                                                                    <div class="form-group col-md-5">
                                                                        <label>Tiempo 1er Lev.</label>
                                                                        <input type="text" class="form-control" name="txtmpPrimEval" id="txtmpPrimEval" >
                                                                    
                                                                    </div>
                                                                </div>

                                                                <div class="row">
                                                                    <div class="form-group col-md-7">
                                                                        <label>Fecha Termino</label>
                                                                        <div class="input-group date" id="txtFechaTerminos" data-target-input="nearest">
                                                                            <input type="text" id="FechaTerminos" name="FechaTerminos" class="form-control datetimepicker-input" data-target="#txtFechaTerminos"  />
                                                                            <div class="input-group-append" data-target="#txtFechaTerminos" data-toggle="datetimepicker">
                                                                                <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                                                            </div>
                                                                        </div>
                                                                    </div>

                                                                    <div class="form-group col-md-5">
                                                                        <label>Tiempo Duracion proc.</label>
                                                                        <input type="text" class="form-control" name="tmpDuracion" id="tmpDuracion" >
                                                                    
                                                                    </div>
                                                                </div>

                                                            
                                                        </fieldset>
                                                    </div>
                                            
                                                </div>
                                            </div>

                                            <div class="card-footer">
                                                <div class="float-right">
                                                    <button type="button" class="btn btn-primary" id="btnSaveObservacionReq"><i class="fa fa-save"></i> Guardar</button>
                                                    <button type="button" class="btn btn-secondary"> Cancelar</button>
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
    </div>


    
</section>
<!-- /.Main content -->

<!-- MODAL AGREGAR Y/O EDITAR PRODUCTO -->

    <div class="modal fade" id="ModalEditarProducto" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <form method="post" id="frmProductosDos">
                <div class="modal-content">
                
                    <div class="modal-header bg-lightblue">
                        <h5 class="modal-title" id="exampleModalLabel">Datos del Producto </h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button> 
                    </div>

                    <div class="modal-body">
                        <div class="row">

                            <div class="col-md-10 col-12">
                                <input type="hidden" name="txtUserCreated" id="txtUserCreated" value="<?php echo $usuario; ?>">
                                <input type="hidden" name="txtIdExpediente" id="txtIdExpediente">
                                <input type="hidden" name="idProductoEdit" id="idProductoEdit">

                                <div class="form-group">
                                    <label>PRODUCTO *</label>
                                    <input type="text" class="form-control" name="txtProducto" id="txtProducto" placeholder="Ingrese Nombre del Producto" required>
                                </div>
                            </div>


                            <div class="col-md-5 col-12">
                                <div class="form-group">
                                    <label>TIPO REQUISITO *</label>
                                    <select class="form-control select2bs4" id="cboTipRequisito" name="cboTipRequisito">
                                            <option value="" selected="selected">::Elegir...</option>
                                    </select>
                                </div>
                            </div>


                            <div class="col-md-3 col-12">
                                <div class="form-group">
                                    <label class="control-label col-12" for="Codigo">TIPO MARCA</label>
                                    
                                    <select class="form-control select2bs4" id="cboTipoMarca" name="cboTipoMarca" required>
                                        <option value="" selected="selected">::Elegir</option>
                                        <option value="MP">Marcas Propias</option>
                                        <option value="OM">Otras Marcas</option>
                                    </select>
                                    
                                </div>
                            </div>

                            <div class="col-md-4 col-12">
                                <div class="form-group">
                                    <label class="control-label col-12" for="Codigo">ORIGEN DEL PRODUCTO</label>
                                
                                        <select class="form-control select2bs4" id="cboOrigenProd" name="cboOrigenProd" required>
                                            <option value="" selected="selected">::Elegir</option>
                                            <option value="0">Nacional</option>
                                            <option value="1">Importado</option>
                                        </select>
                                </div>
                            </div>

                        </div>

                        <div class="row">
                            <div class="col-md-6 col-12">
                                <!-- text input -->
                                <div class="form-group">
                                    <label>CONDICION ALMACENAJE </label>
                                    <!-- <select class="form-control select2bs4" id="cboTipoequipoReg125" name="#">
                                            <option value="" selected="selected">::Elegir</option>
                                            <option value="0">Ambiente</option>
                                            <option value="1">Congelado</option>
                                            <option value="2">Refrigerado</option>
                                    </select> -->
                                    <input type="text" class="form-control" id="txtCondicionAlmacen" name="txtCondicionAlmacen">
                                </div>
                            </div>

                            <div class="col-md-3 col-12">
                                <!-- text input -->
                                <div class="form-group">
                                    <label>MARCA *</label>
                                    <input type="text" class="form-control" name="txtMarca" id="txtMarca" placeholder="Ingrese Marca" required>
                                </div>
                            </div>

                            <div class="col-md-3 col-12">
                                <!-- text input -->
                                <div class="form-group">
                                    <label>VIDA UTIL</label>
                                    <input type="text" class="form-control" name="txtVidautil" id="txtVidautil" placeholder="Ingrese Vida Util" required>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6 col-12">
                                <!-- text input -->
                                <div class="form-group">
                                    <label>ENVASE PRIMARIO *</label>
                                    <input type="text" class="form-control" name="txtEnvPrimario" id="txtEnvPrimario" placeholder="Ingrese Condicion de Almacenaje" required>
                                </div>
                            </div>

                            <div class="col-md-6 col-12">
                                <!-- text input -->
                                <div class="form-group">
                                    <label>ENVASE SECUNDARIO *</label>
                                    <input type="text" class="form-control" name="txtEnvSecundario" id="txtEnvSecundario" placeholder="Ingrese Marca" required>
                                </div>
                            </div>
                        </div>

                        <!-- row 2 -->
                        <div class="row">

                            <div class="col-md-6 col-12">
                                <!-- text input -->
                                <div class="form-group">
                                    <label>FABRICANTE</label>
                                    <input type="text" class="form-control" name="txtFabricante" id="txtFabricante"
                                        placeholder="Ingresa Fabricante">
                                </div>
                            </div>

                            <div class="col-md-6 col-12">
                                <div class="form-group">
                                    <label>DIRECCIÓN DE FABRICA</label>
                                    <input type="text" class="form-control" name="txtDirFabricante" id="txtDirFabricante"
                                        placeholder="Ingresa Direecion de Fabrica">
                                </div>
                            </div>
                        </div>


                        <div class="row">
                            <div class="col-md-6 col-12">
                                <!-- text input -->
                                <div class="form-group">
                                    <label>ALMACÉN</label>
                                    <input type="text" class="form-control" name="txtAlmacen" id="txtAlmacen"
                                        placeholder="Ingresa Almacén" >
                                </div>
                            </div>

                            <div class="col-md-6 col-12">
                                <!-- text input -->
                                <div class="form-group">
                                    <label>DIRECIÓN DE ALMACÉN</label>
                                    <input type="text" class="form-control" name="txtDirecAlmacen" id="txtDirecAlmacen"
                                        placeholder="Ingrese Direccion de Almacén" >
                                </div>
                            </div>
                        </div>

                    </div>
                    <div class="modal-footer">
                        <button type="button"  class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                        <button type="button" id="btnGuardarProductos" class="btn btn-primary">Guardar Cambios</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    
    <!-- MODAL AGREGAR Y/O EDITAR PRODUCTO DEL PROVEEDOR-->

    <div class="modal fade" id="ModalEditarProductoProveedor" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <form method="post" id="frmProductoProveeddor">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                <div class="modal-header bg-lightblue">
                    <h5 class="modal-title" id="exampleModalLabel">Datos del Producto</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <input type="hidden" name="txtExp" id="txtExp">
                    <input type="hidden" name="txtidProduc" id="txtidProduc">
                    <div class="row">
                        <div class="col-md-5 col-12">
                            <div class="form-group">

                                <label>ESTADO EVALUACIÓN</label>
                                <select class="form-control select2bs4" id="cboEstadoProducto" name="cboEstadoProducto">
                                        
                                </select>
                            </div>
                        </div>

                        <div class="col-md-7 col-12">
                            <!-- text input -->
                            <div class="form-group">
                                <label>PRODUCTO *</label>
                                <input type="text" class="form-control" name="txtProductoTab3" id="txtProductoTab3" placeholder="Ingrese Nombre del Producto" readonly>
                            </div>
                        </div>


                        <div class="col-md-4 col-12">
                            <div class="form-group">
                                <label>MONTO </label>
                                <input type="text" class="form-control" name="txtMonto" id="txtMonto" placeholder="Ingrese Monto del Producto">
                            </div>
                        </div>

                        <div class="col-md-4 col-12">
                            <div class="form-group">
                                <label>PAGO CLIENTE *</label>
                                <select class="form-control select2bs4" id="cboPagoCliente" name="cboPagoCliente" required>
                                        <option value="">::Elegir</option>
                                        <option value="N" >NO</option>
                                        <option value="S"> SI</option>
                                </select>

                            </div>
                        </div>

                        <div class="col-md-4 col-12">
                            <!-- text input -->
                            <div class="form-group">
                                <label>FEC. COBRO</label>
                                <div class="input-group date" id="txtFCobro" data-target-input="nearest">
                                    <input type="text" id="FechaCobro" name="FechaCobro" class="form-control datetimepicker-input" data-target="#txtFCobro"  />
                                    <div class="input-group-append" data-target="#txtFCobro" data-toggle="datetimepicker">
                                        <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>

                

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                    <button type="button" class="btn btn-primary" id="btnSaveProductoTabTres">Guardar Cambios</button>
                </div>
                </div>
            </div>
        </form>
    </div>


    <!-- MODAL AÑADIR/EDITAR REQUISITO POR PRODUCTO -->

    <div class="modal fade" id="ModalAgregarRequisitoProducto" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header bg-lightblue">
                    <h5 class="modal-title" id="exampleModalLabel">Requisitos del Producto</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form id="frmSaveRequisitoProducto">
                    <div class="modal-body">
                        <input type="hidden" id="txtIdRequisito">
                        <input type="hidden" name="txtAccion" id="txtAccion">
                        <input type="hidden" name="txtExpRequisito" id="txtExpRequisito">
                        <input type="hidden" name="txtIdProducto" id="txtIdProducto" >
                        <div class="row">

                            <div class="col-md-6 col-12">
                                <div class="form-group">
                                    <label>Requisito *</label>
                                    <select class="form-control select2bs4" id="cboRequisito" name="cboRequisito">
                                            <option value="" selected="selected">::Elegir</option>
                                    </select>
                                </div>
                            </div>

                            <div class="col-md-6 col-12">
                                <div class="form-group">

                                    <label>Nota</label>
                                    <input type="text" class="form-control" name="txtNotaReq" id="txtNotaReq" placeholder="Ingrese una Nota" required>

                                </div>
                            </div>
                        </div>


                        <div class="row">

                            <div class="col-md-6 col-12">
                                    <!-- text input -->
                                    <div class="form-group">
                                        <label>Fec. Registro </label>
                                        <div class="input-group date" id="txtFecRegRequ" data-target-input="nearest">
                                        <input type="text" id="FecRegistroRequ" name="FecRegistroRequ" class="form-control datetimepicker-input" data-target="#txtFecRegRequ"  />
                                        <div class="input-group-append" data-target="#txtFecRegRequ" data-toggle="datetimepicker">
                                            <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-6 col-12">
                                <div class="form-group">
                                    <label>Conformidad *</label>
                                    <select class="form-control select2bs4" id="cboConformidad" name="cboConformidad">
                                            <option value="" selected="selected">::Elegir</option>
                                            <option value="C">Cumple</option>
                                            <option value="P">Pendiente</option>
                                            <option value="A">No Aplica</option>
                                            <option value="N">No Cumple</option>
                                    </select>

                                </div>
                            </div>

                        </div>


                        <div class="row">

                            <div class="col-md-5 col-12">
                                <!-- text input -->
                                <div class="form-group">
                                    <label>Descripcion</label>
                                    <input type="text" class="form-control" name="txtDescripcionRequisito" id="txtDescripcionRequisito" placeholder="Ingrese Descripcion del Requisito" >
                                </div>
                            </div>

                            <div class="col-md-3 col-12">
                                <div class="form-group">
                                    <label>Tipo *</label>
                                    <select class="form-control select2bs4" id="cboTipo" name="cboTipo" required>
                                            <option value="">::Elegir</option>
                                            <option value="A">Fec. con Alarma</option>
                                            <option value="F">Fec. sin Alarma</option>
                                            <option value="D">Descripcion</option>
                                    </select>

                                </div>
                            </div>

                            <div class="col-md-4 col-12">
                                <label for="">Adjuntar Archivo</label>
                                <div class="custom-file">
                                    <input type="file"  id="fileRequisito" name="fileRequisito" onchange="registrar_archivo()" >
                                    
                                    <input type="hidden" name="txtFileRequisito" id="txtFileRequisito">
                                </div>
                            </div>

                        </div>
                            
                    </div>
                    <div class="modal-footer">
                        <button type="reset" id="btnCerrarRequisitos" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                        <button type="button" id="btnSaveReqiusitoProd" class="btn btn-primary">Guardar Datos</button>
                    </div>
                </form>
            </div>
        </div>
    </div>


<!-- Script Generales -->
<script type="text/javascript">
    var baseurl = "<?php echo base_url();?>"; 
</script>