<?php
    $idusu = $this -> session -> userdata('s_idusuario');
?>

<style>
    td.details-control {
        background: url('<?php echo base_url() ?>assets/images/details_open.png') no-repeat center center;
        cursor: pointer;
    }
    tr.details td.details-control {
        background: url('<?php echo base_url() ?>assets/images/details_close.png') no-repeat center center;
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
                            <!--<button type="button" class="btn btn-outline-info" id="btnNuevo" data-toggle="modal" data-target="#modalCreaIngreso"><i class="fas fa-plus"></i>&nbsp;&nbsp;Crear Nuevo</button>-->
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
                        <h3 class="card-title">Listado de Ingresos - <label id="lblCia"></label></h3>
                    </div>                
                    <div class="card-body">
                        <table id="tblListIngreso" class="table table-striped table-bordered" style="width:100%">
                            <thead>
                            <tr>
                                <th></th>
                                <th></th>
                                <th>Documento</th>
                                <th>F. Emision</th>
                                <th>Empresa</th>
                                <th>Area</th>
                                <th>Monto Base</th>
                                <th>IGV</th>
                                <th>Monto Fact.</th>
                                <th>Saldo Pagar</th>
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

<!-- /.modal-DocIngreso --> 
<div class="modal fade" id="modalCreaIngreso" data-backdrop="static" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <form class="form-horizontal" id="frmDocIngreso" name="frmDocIngreso" action="<?= base_url('adm/conta/cingresos/setdocingreso')?>" method="POST" enctype="multipart/form-data" role="form"> 

        <div class="modal-header text-center bg-success">
            <h4 class="modal-title w-100 font-weight-bold">Registro de Ingreso</h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>

        <div class="modal-body">        
            <input type="hidden" id="mhdnIddocingreso" name="mhdnIddocingreso"> <!-- ID -->            
            <input type="hidden" id="mhdnAccionIngreso" name="mhdnAccionIngreso" value="">
                        
            <fieldset class="scheduler-border">
                <legend class="scheduler-border text-primary">DOCUMENTO de <label id="lblmCia"></label></legend> 
                <div class="form-group">
                    <div class="row">                        
                        <div class="col-12">
                        <h4>
                            <small id="lblmFactura"> </small>
                            <small id="lblmFecha" class="float-right"></small>
                        </h4>
                        </div>
                    </div>                
                </div> 
                <div class="form-group">
                    <div class="row"> 
                        <div class="col-12">
                            <h4>
                                <i class="fas fa-globe"></i> <label id="lblmEmpresa"></label>
                            </h4>
                        </div>
                    </div>                
                </div>
                <div class="form-group">
                    <div class="row"> 
                        <div class="col-2">
                            <label>Pertenece a :</label>
                        </div>
                        <div class="col-4">
                            <div>                            
                                <select class="form-control" id="cbomcarea" name="cbomcarea">
                                    <option value="" selected="selected">Cargando...</option>
                                </select>
                            </div>
                        </div>
                    </div>                
                </div>
                <div class="form-group">
                    <div class="row">
                        <div class="col-12 table-responsive">
                            <table class="table table-striped">
                                <thead>
                                <tr>
                                <th>Concepto</th>
                                <th>Base</th>
                                <th>IGV</th>
                                <th>Total</th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr>
                                <td id="lblmConcepto"></td>
                                <td id="lblmBase"></td>
                                <td id="lblmIGV"></td>
                                <td id="lblmTotal"></td>
                                </tr> 
                                </tbody>
                            </table>
                        </div>
                    </div>                
                </div> 
            </fieldset>    
        </div>
        <div class="modal-footer justify-content-between" style="background-color: #dff0d8;">
            <div class="row">
                <div class="col-md-12">
                    <div class="text-right">
                        <button type="reset" class="btn btn-default" id="btnmCerDocingre" data-dismiss="modal">Cancelar</button>
                        <button type="button" class="btn btn-danger" id="btnmAnulDocingre">Anular</button>
                        <button type="submit" class="btn btn-info" id="btnmActDocingre">Grabar</button>
                    </div>
                </div>
            </div>
        </div>
      </form>
    </div>
  </div>
</div> 
<!-- /.modal-->

<!-- /.modal-pago --> 
<div class="modal fade" id="modalPago" data-backdrop="static" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <form class="form-horizontal" id="frmPago" name="frmPago" action="<?= base_url('adm/conta/cingresos/setpago')?>" method="POST" enctype="multipart/form-data" role="form"> 

        <div class="modal-header text-center bg-success">
            <h4 class="modal-title w-100 font-weight-bold">Pago de Documentos</h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>

        <div class="modal-body">          
            <input type="hidden" id="mhdnpIdingreso" name="mhdnpIdingreso"> <!-- ID -->
            <input type="hidden" id="mhdnpIddocingreso" name="mhdnpIddocingreso">
            <input type="hidden" id="mhdnpAccionIngreso" name="mhdnpAccionIngreso" value="">
                        
            <fieldset class="scheduler-border">
                <legend class="scheduler-border text-primary">DOCUMENTO de <label id="lblpCia"></label></legend> 
                <div class="form-group">
                    <div class="row">                        
                        <div class="col-12">
                        <h4>                            
                            <small id="lblFecha" class="float-right"></small>
                        </h4>
                        </div>
                    </div>                
                </div> 
                <div class="form-group">
                    <div class="row"> 
                        <div class="col-12">
                            <h4>
                                <i class="fas fa-globe"></i> <label id="lblEmpresa"></label>
                            </h4>
                        </div>
                    </div>                
                </div>
                <div class="form-group">
                    <div class="row"> 
                        <div class="col-2">
                            <label>Concepto :</label>
                        </div>
                        <div class="col-10">
                            <h5>                            
                                <small id="lblConcepto"></small>
                            </h5>
                        </div>
                    </div>                
                </div>
                <div class="form-group">
                    <div class="row">
                        <div class="col-12 table-responsive">
                            <table class="table table-striped">
                                <thead>
                                <tr>
                                <th>Documento</th>
                                <th>Base</th>
                                <th>IGV</th>
                                <th>Total</th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr>
                                <td id="lblFactura"></td>
                                <td id="lblBase"></td>
                                <td id="lblIGV"></td>
                                <td id="lblTotal"></td>
                                </tr> 
                                </tbody>
                            </table>
                        </div>
                    </div>                
                </div> 
            </fieldset>
            <div id="panelPagar"> 
            <fieldset class="scheduler-border" >
                <legend class="scheduler-border text-primary">PAGO</legend>                   
                <div class="form-group">
                    <div class="row">          
                        <div class="col-sm-2">
                            <div class="text-info">Año</div>
                            <div>                            
                                <select class="form-control" id="mcboanio" name="mcboanio">
                                    <option value="" selected="selected">Cargando...</option>
                                </select>
                            </div>
                        </div>         
                        <div class="col-sm-2">
                            <div class="text-info">Mes</div>
                            <div>                            
                                <select class="form-control" id="mcbomes" name="mcbomes">
                                    <option value="" selected="selected">Cargando...</option>
                                </select>
                            </div>
                        </div>   
                        <div class="col-sm-4">
                            <div class="text-info">Area</div>
                            <div>                            
                                <select class="form-control select2bs4" id="mcboparea" name="mcboparea" style="width: 100%;">
                                    <option value="" selected="selected">Cargando...</option>
                                </select>
                            </div>
                        </div>      
                        <div class="col-sm-4">
                            <div class="text-info">Codigo</div>
                            <div>                            
                                <select class="form-control" id="mcbocodigo" name="mcbocodigo">
                                    <option value="" selected="selected">Cargando...</option>
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
                            <div class="text-info">Por Pagar</div>
                            <div>                            
                                <input type="text" class="form-control" id="mtxtsaldopagar" name="mtxtsaldopagar">
                            </div>
                        </div>         
                        <div class="col-sm-3">
                            <div class="text-info">Tipo Pago</div>
                            <div>                            
                                <select class="form-control" id="mcbotipopago" name="mcbotipopago">
                                    <option value="" selected="selected">:: Elija</option>
                                    <option value="T">TOTAL</option>
                                    <option value="P">PARCIAL</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-sm-3">
                            <div class="text-info">Monto a pagar</div>
                            <div>                            
                                <input type="text" class="form-control" id="mtxtmontopagar" name="mtxtmontopagar">
                            </div>
                        </div>                  
                    </div>                
                </div>          
                <div class="form-group">
                    <div class="row">      
                        <div class="col-sm-5">
                            <div class="text-info">CTA - Bancos</div>
                            <div>                            
                                <select class="form-control" id="mcbobanco" name="mcbobanco">
                                    <option value="" selected="selected">Cargando...</option>
                                </select>
                            </div>
                        </div>             
                        <div class="col-sm-7">
                            <div class="text-info">Observación</div>
                            <div>   
                                <textarea class="form-control" cols="20" data-val="true" data-val-length="No debe superar los 200 caracteres." data-val-length-max="200" id="mtxtObserva" name="mtxtObserva" rows="1" data-val-maxlength-max="200"></textarea>
                                <span class="help-inline" style="padding-left:0px; color:#999; font-size:0.9em;">Caracteres permitido 200</span>     
                            </div> 
                        </div> 
                    </div>                
                </div> 
            </fieldset>   
            </div>         
        </div>

        <div class="modal-footer justify-content-between" style="background-color: #dff0d8;">
            <button type="reset" class="btn btn-default" id="mbtnCPago" data-dismiss="modal">Cancelar</button>
            <button type="submit" class="btn btn-info" id="mbtnGPago">Grabar</button>
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

                            <input type="hidden" name="hdmccia" id="hdmccia">

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