<?php
    $idusu = $this -> session -> userdata('s_idusuario');
?>

<style>
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

    .dt-body-right {text-align: right;}
</style>

<!-- content-header -->
<div class="content-header">   
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1 class="m-0 text-dark">INGRESOS</h1>
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
                            <select class="form-control" id="cbocia" name="cbocia" style="width: 100%;">
                                <option value="0" selected="selected"></option>
                                <option value="1">FS</option>
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
                            <button type="submit" class="btn btn-primary" id="btnBuscar"><i class="fas fa-search"></i>&nbsp;&nbsp;Buscar</button>    
                            <button type="button" class="btn btn-outline-info" id="btnNuevo" data-toggle="modal" data-target="#modalCreaIngreso"><i class="fas fa-plus"></i>&nbsp;&nbsp;Crear Nuevo</button>
                            <button type="button" class="btn btn-outline-success" id="btnImportar" data-toggle="modal" data-target="#modalImportdoc"><i class="fas fa-upload"></i>&nbsp;&nbsp;Importar Nubefact</button> 
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <div class="card card-outline card-success">
                    <div class="card-header">
                        <h3 class="card-title">Listado de Ingresos</h3>
                    </div>                
                    <div class="card-body">
                        <table id="tblListIngreso" class="table table-striped table-bordered" style="width:100%">
                            <thead>
                            <tr>
                                <th></th>
                                <th>Documento</th>
                                <th>NRO Documento</th>
                                <th>Fecha Emision</th>
                                <th>Empresa</th>
                                <th>Area</th>
                                <th>Monto Base</th>
                                <th>Monto IGV</th>
                                <th>Monto TOTAL</th>
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

<!-- /.modal-crear-Ingreso --> 
<div class="modal fade" id="modalCreaIngreso" data-backdrop="static" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <form class="form-horizontal" id="frmCreaIngreso" name="frmCreaIngreso" action="<?= base_url('adm/conta/cingresos/setingreso')?>" method="POST" enctype="multipart/form-data" role="form"> 

        <div class="modal-header text-center bg-success">
            <h4 class="modal-title w-100 font-weight-bold">Registro de Ingreso</h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>

        <div class="modal-body">          
            <input type="hidden" id="mhdnIdingreso" name="mhdnIdingreso"> <!-- ID -->
            <input type="hidden" id="mhdnIddocingreso" name="mhdnIddocingreso">
            <input type="hidden" id="mhdnAccionIngreso" name="mhdnAccionIngreso" value="">
                        
            <fieldset class="scheduler-border">
                <legend class="scheduler-border text-primary">DOCUMENTO</legend> 
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
                        <div class="col-sm-3">
                            <div class="text-info">Tipo Doc.</div>
                            <div>                            
                                <select class="form-control" id="mcbotipodoc" name="mcbotipodoc">
                                    <option value="01" selected="selected">Factura</option>
                                    <option value="02">RECIBO HONORARIO</option>
                                    <option value="03">BOLETA DE VENTA</option>
                                    <option value="07">NOTA DE CREDITO</option>
                                </select>
                            </div>
                        </div>         
                        <div class="col-sm-3">
                            <div class="text-info">Correlativo Doc.</div>
                            <div>                            
                                <input type="text" class="form-control" id="mtxtcorredoc" name="mtxtcorredoc">
                            </div>
                        </div>         
                        <div class="col-sm-3">
                            <div class="text-info">Nro. Documento</div>
                            <div>                            
                                <input type="text" class="form-control" id="mtxtnrodoc" name="mtxtnrodoc">
                            </div>
                        </div>                    
                        <div class="col-sm-3">
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
                        <div class="col-sm-3">
                            <div class="text-info">Base</div>
                            <div>                            
                                <input type="text" class="form-control" id="mtxtmontobase" name="mtxtmontobase">
                            </div>
                        </div> 
                        <div class="col-sm-3">
                            <div class="text-info">IGV</div>
                            <div>                            
                                <input type="text" class="form-control" id="mtxtmontoigv" name="mtxtmontoigv">
                            </div>
                        </div> 
                        <div class="col-sm-3">
                            <div class="text-info">Total</div>
                            <div>                            
                                <input type="text" class="form-control" id="mtxtmontototal" name="mtxtmontototal">
                            </div>
                        </div>       
                        <div class="col-sm-3">
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
            </fieldset>
            <div id="panelPagar"> 
            <fieldset class="scheduler-border" >
                <legend class="scheduler-border text-primary">PAGAR</legend>                   
                <div class="form-group">
                    <div class="row">          
                        <div class="col-sm-2">
                            <div class="text-info">Año</div>
                            <div>                            
                                <select class="form-control" id="mcboanio" name="mcboanio">
                                    <option value="" selected="selected">:: Elija</option>
                                </select>
                            </div>
                        </div>         
                        <div class="col-sm-3">
                            <div class="text-info">Mes</div>
                            <div>                            
                                <select class="form-control" id="mcbomes" name="mcbomes">
                                    <option value="" selected="selected">:: Elija</option>
                                </select>
                            </div>
                        </div>         
                        <div class="col-sm-3">
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
                    </div>                
                </div>  
                <div class="form-group">
                    <div class="row">         
                        <div class="col-sm-4">
                            <div class="text-info">Codigo</div>
                            <div>                            
                                <select class="form-control" id="mcbocodigo" name="mcbocodigo">
                                    <option value="" selected="selected">:: Elija</option>
                                </select>
                            </div>
                        </div>      
                        <div class="col-sm-3">
                            <div class="text-info">Tipo Pago</div>
                            <div>                            
                                <select class="form-control" id="mcbotipopago" name="mcbotipopago">
                                    <option value="" selected="selected">:: Elija</option>
                                    <option value="1">FS</option>
                                    <option value="2">FSC</option>
                                </select>
                            </div>
                        </div>    
                        <div class="col-sm-5">
                            <div class="text-info">CTA - Bancos</div>
                            <div>                            
                                <select class="form-control" id="mcbobanco" name="mcbobanco">
                                    <option value="" selected="selected">:: Elija</option>
                                    <option value="1">FS</option>
                                    <option value="2">FSC</option>
                                </select>
                            </div>
                        </div>                  
                    </div>                
                </div>          
                <div class="form-group">
                    <div class="row"> 
                        <div class="col-sm-3">
                            <div class="text-info">Fecha Pago</div>
                            <div class="input-group date" id="mtxtFechapago" data-target-input="nearest">
                                <input type="text" id="mtxtFpago" name="mtxtFpago" class="form-control datetimepicker-input" data-target="#mtxtFechapago"/>
                                <div class="input-group-append" data-target="#mtxtFechapago" data-toggle="datetimepicker">
                                    <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                </div>
                            </div>                        
                        </div> 
                        <div class="col-sm-3">
                            <div class="text-info">Monto</div>
                            <div>                            
                                <input type="text" class="form-control" id="mtxtmontopagar" name="mtxtmontopagar">
                            </div>
                        </div>               
                        <div class="col-sm-6">
                            <div class="text-info">Observación</div>
                            <div>   
                                <textarea class="form-control" cols="20" data-val="true" data-val-length="No debe superar los 500 caracteres." data-val-length-max="500" id="mtxtObserva" name="mtxtObserva" rows="2" data-val-maxlength-max="500" data-validation="required"></textarea>
                                <span class="help-inline" style="padding-left:0px; color:#999; font-size:0.9em;">Caracteres: 0 / 500</span>     
                            </div> 
                        </div> 
                    </div>                
                </div> 
            </fieldset>   
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

<!-- /.modal-importar-nubefact -->
<div class="modal fade" id="modalImportdoc" data-backdrop="static" role="dialog" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content"> 
                <div class="modal-header text-center bg-success">
                    <h4 class="modal-title w-100 font-weight-bold">Importar Nubefact</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body"> 
                    <div class="form-group">     
                    <div class="row">                
                        <div class="col-sm-12">           
                        <!----> 
                        <form class="form-horizontal" id="frmImportdoc" name="frmImportdoc" action="" method="POST" enctype="multipart/form-data" role="form">
                            <div class="text-info">Archivo</div>                                                   
                            <div class="input-group">
                                <input class="form-control" type="text" name="txtFile" id="txtFile">                                                     
                                <span class="input-group-append">                                
                                    <div class="fileUpload btn btn-secondary">
                                        <span>Archivo</span>
                                        <input type="file" class="upload" id="fileMigra" name="fileMigra" onchange="adjFile()"/>                      
                                    </div> 
                                </span>  
                            </div> 
                            <span style="color: red; font-size: 13px;">+ Los archivos deben estar en formato xls y no deben pesar mas de 60 MB</span>                        
                            <input type="hidden" name="txtFileRuta" id="txtFileRuta">
                            <input type="hidden" name="mtxtFilearchivo" id="mtxtFilearchivo"> 

                            <div class="modal-footer" style="background-color: #dff0d8;">
                                <button type="button" class="btn btn-info" id="mbtnGUpload">Migrar</button>
                                <button type="reset" class="btn btn-default" id="mbtnCImport" data-dismiss="modal">Cancelar</button>
                            </div>
                        </form>
                        <!-- 
                        <?php   
                            echo form_open_multipart('adm/conta/cingresos/import_nubefact');
                        ?>
                            
                        <?php
                            $upload_data = array(
                                'type'  => 'file',
                                'name'  => 'fileMigra',
                                'id'    => 'fileMigra',
                                'class' => 'upload'
                            );
                            echo form_upload($upload_data);
                            echo '<br/>';
                            $data = [
                                'id'      => 'mbtnGUpload',
                                'type'    => 'submit',
                                'class'   => 'btn btn-info',
                                'content' => 'Migrar'
                            ];                
                            echo form_button($data);
                        ?>
                            <button type="reset" class="btn btn-default" id="mbtnCImportparti" data-dismiss="modal">Cancelar</button>
                            <input type="hidden" id="mhdnIdCapamigra" name="mhdnIdCapamigra">
                        <?php
                            echo form_close();
                        ?>   -->
                        </div> 
                    </div>
                    </div>
                </div>
        </div>
    </div>
</div>    
<!-- /.modal-->


<!-- Script Generales -->
<script type="text/javascript">
    var baseurl = "<?php echo base_url();?>"; 
</script>