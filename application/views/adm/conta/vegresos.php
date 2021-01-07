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
        <h1 class="m-0 text-dark">EGRESOS</h1>
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
<section class="content">
    <div class="container-fluid">  
        <div class="card card-success">
            <div class="card-header">
                <h3 class="card-title">BUSQUEDA</h3>
                <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i></button>
                </div>
            </div>
          
            <div class="card-body">
                <div class="row">
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
                    <div class="col-md-3">
                        <div class="form-group">
                            <label>Compañia</label>
                            <select class="form-control select2bs4" id="cbocia" name="cbocia" style="width: 100%;">
                                <option value="1" selected="selected">FS</option>
                                <option value="2">FSC</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label>Area</label>
                            <select class="form-control select2bs4" id="cboarea" name="cboarea" style="width: 100%;">
                                <option value="" selected="selected">Cargando...</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Empresa</label>
                            <select class="form-control select2bs4" id="cboempresa" name="cboempresa" style="width: 100%;">
                                <option value="" selected="selected">Cargando...</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label>Nro Documento</label>
                            <input type="text" class="form-control" id="txtnrodoc" name="txtnrodoc">
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label>Codigo</label>
                            <select class="select2bs4" id="cbocod" name="cbocod" multiple="multiple" data-placeholder="Seleccionar" style="width: 100%;">
                            </select>
                        </div>
                    </div>
                </div>
            </div>                
                        
            <div class="card-footer justify-content-between"> 
                <div class="row">
                    <div class="col-md-12">
                        <div class="text-right">
                            <button type="submit" class="btn btn-primary" id="btnBuscar"><i class="fas fa-search"></i> Buscar</button>    
                            <button type="button" class="btn btn-outline-info" id="btnNuevo" data-toggle="modal" data-target="#modalCreaEgreso"><i class="fas fa-plus"></i> Crear Nuevo</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <div class="card card-outline card-success">
                    <div class="card-header">
                        <h3 class="card-title">Listado de Egresos</h3>
                    </div>                
                    <div class="card-body">
                        <table id="tblListEgreso" class="table table-striped table-bordered" style="width:100%">
                            <thead>
                            <tr>
                                <th></th>
                                <th>Documento</th>
                                <th>Fecha Emision</th>
                                <th>Empresa</th>
                                <th>Area</th>
                                <th>Concepto</th>
                                <th>Fecha Pago</th>
                                <th>S/. Importe</th>
                                <th>$ Importe</th>
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
</section>
<!-- /.Main content -->

<!-- /.modal-crear-Egreso --> 
<div class="modal fade" id="modalCreaEgreso" data-backdrop="static" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <form class="form-horizontal" id="frmCreaEgreso" name="frmCreaEgreso" action="<?= base_url('adm/conta/cegresos/setegreso')?>" method="POST" enctype="multipart/form-data" role="form"> 

        <div class="modal-header text-center bg-success">
            <h4 class="modal-title w-100 font-weight-bold">Registro de Egreso</h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>

        <div class="modal-body">          
            <input type="hidden" id="mhdnIdegreso" name="mhdnIdingreso"> <!-- ID -->
            <input type="hidden" id="mhdnAccionegreso" name="mhdnAccionegreso" value="">
            
            <div class="form-group">
                <div class="row">                 
                    <div class="col-sm-4">
                        <div class="text-info">Compañia</div>
                        <div>                            
                            <select class="form-control" id="mcbocia" name="mcbocia">
                                <option value="" selected="selected">:: Elija</option>
                                <option value="1">FS</option>
                                <option value="2">FSC</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <div class="text-info">Area</div>
                        <div>                            
                            <select class="form-control select2bs4" id="mcboarea" name="mcboarea" style="width: 100%;">
                                <option value="" selected="selected">Cargando...</option>
                            </select>
                        </div>
                    </div>    
                    <div class="col-sm-4">
                        <div class="text-info">Codigo</div>
                        <div>                            
                            <select class="form-control" id="mcbocodigo" name="mcbocodigo">
                                <option value="" selected="selected">:: Elija</option>
                            </select>
                        </div>
                    </div>   
                </div>                
            </div>
            <div class="form-group">
                <div class="row">          
                    <div class="col-sm-4">
                        <div class="text-info">Tipo Doc.</div>
                        <div>                            
                            <select class="form-control" id="mcbotipodoc" name="mcbotipodoc">
                                <option value="FAC" selected="selected">Factura</option>
                            </select>
                        </div>
                    </div>           
                    <div class="col-sm-4">
                        <div class="text-info">Nro. Documento</div>
                        <div>                            
                            <input type="text" class="form-control" id="txtnrodoc" name="txtnrodoc">
                        </div>
                    </div> 
                    <div class="col-sm-4">
                        <div class="text-info">Fecha Emision</div>
                        <div class="input-group date" id="mtxtFemidocumento" data-target-input="nearest">
                            <input type="text" id="mtxtFemidoc" name="mtxtFemidoc" class="form-control datetimepicker-input" data-target="#mtxtFemidocumento"/>
                            <div class="input-group-append" data-target="#mtxtFemidocumento" data-toggle="datetimepicker">
                                <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                            </div>
                        </div>                        
                    </div>  
                </div>                
            </div>  
            <div class="form-group">
                <div class="row">
                    <div class="col-sm-12">
                        <div class="text-info">Empresa</div>
                        <div>                            
                            <select class="form-control select2bs4" id="mcboempresa" name="mcboempresa" style="width: 100%;">
                                <option value="" selected="selected">Cargando...</option>
                            </select>
                        </div>
                    </div> 
                </div>                
            </div> 
            <div class="form-group">
                <div class="row">
                    <div class="col-sm-12">
                        <div class="text-info">Concepto</div>
                        <div>                            
                            <input type="text" class="form-control" id="txtnrodoc" name="txtnrodoc">
                        </div>
                    </div> 
                </div>                
            </div> 
            <div class="form-group">
                <div class="row">       
                    <div class="col-sm-4">
                        <div class="text-info">Forma de Pago</div>
                        <div>                            
                            <select class="form-control" id="mcbotipomoneda" name="mcbotipomoneda">
                                <option value="" selected="selected">:: Elija</option>
                            </select>
                        </div>
                    </div>                     
                    <div class="col-sm-4">
                        <div class="text-info">Fecha Pago</div>
                        <div class="input-group date" id="mtxtFechapago" data-target-input="nearest">
                            <input type="text" id="mtxtFpago" name="mtxtFpago" class="form-control datetimepicker-input" data-target="#mtxtFechapago"/>
                            <div class="input-group-append" data-target="#mtxtFechapago" data-toggle="datetimepicker">
                                <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                            </div>
                        </div>                        
                    </div>        
                    <div class="col-sm-4">
                        <div class="text-info">Tipo de Moneda</div>
                        <div>                            
                            <select class="form-control" id="mcbotipomoneda" name="mcbotipomoneda">
                                <option value="" selected="selected">:: Elija</option>
                                <option value="S">SOLES</option>
                                <option value="D">DOLARES</option>
                            </select>
                        </div>
                    </div> 
                </div>                
            </div> 
            
            <fieldset class="scheduler-border" id="montoEgresoSoles">
                <legend class="scheduler-border text-primary">Soles</legend>            
                <div class="form-group">
                    <div class="row">
                        <div class="col-sm-4">
                            <div class="text-info">Base</div>
                            <div>                            
                                <input type="text" class="form-control" id="txtnrodoc" name="txtnrodoc">
                            </div>
                        </div> 
                        <div class="col-sm-4">
                            <div class="text-info">IGV</div>
                            <div>                            
                                <input type="text" class="form-control" id="txtnrodoc" name="txtnrodoc">
                            </div>
                        </div> 
                        <div class="col-sm-4">
                            <div class="text-info">Total</div>
                            <div>                            
                                <input type="text" class="form-control" id="txtnrodoc" name="txtnrodoc">
                            </div>
                        </div> 
                    </div>                
                </div> 
            </fieldset>
            <fieldset class="scheduler-border" id="montoEgresoDolares">
                <legend class="scheduler-border text-primary">Dolares</legend>            
                <div class="form-group">
                    <div class="row">
                        <div class="col-sm-4">
                            <div class="text-info">Base</div>
                            <div>                            
                                <input type="text" class="form-control" id="txtnrodoc" name="txtnrodoc">
                            </div>
                        </div> 
                        <div class="col-sm-4">
                            <div class="text-info">IGV</div>
                            <div>                            
                                <input type="text" class="form-control" id="txtnrodoc" name="txtnrodoc">
                            </div>
                        </div> 
                        <div class="col-sm-4">
                            <div class="text-info">Total</div>
                            <div>                            
                                <input type="text" class="form-control" id="txtnrodoc" name="txtnrodoc">
                            </div>
                        </div> 
                    </div>                
                </div> 
            </fieldset>

            <div class="form-group">
                <div class="row">                
                    <div class="col-sm-12">
                        <div class="text-info">Observación</div>
                        <div>   
                            <textarea class="form-control" cols="20" data-val="true" data-val-length="No debe superar los 500 caracteres." data-val-length-max="500" id="mtxtObserva" name="mtxtObserva" rows="2" data-val-maxlength-max="500" data-validation="required"></textarea>
                            <span class="help-inline" style="padding-left:0px; color:#999; font-size:0.9em;">Caracteres: 0 / 500</span>     
                        </div> 
                    </div> 
                </div>                
            </div>             
        </div>

        <div class="modal-footer justify-content-between" style="background-color: #dff0d8;">
            <button type="reset" class="btn btn-default" id="mbtnCCreaingre" data-dismiss="modal">Cancelar</button>
            <button type="submit" class="btn btn-info" id="mbtnGCreaingre">Grabar</button>
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