<?php
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
</style>

<!-- content-header -->
<div class="content-header">   
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1 class="m-0 text-dark">TRAMITES PT</h1>
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
                    <div class="col-md-4">
                        <div class="form-group">
                            <label>Clientes</label>
                            <select class="form-control select2bs4" id="cboClie" name="cboClie" style="width: 100%;">
                                <option value="" selected="selected">Cargando...</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-4">    
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
                    <div class="col-md-4">      
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
                            <label>Tramite</label>
                            <select class="select2bs4" id="cboTram" name="cboTram" multiple="multiple" data-placeholder="Seleccionar" style="width: 100%;">
                                <option value="" selected="selected">Cargando...</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label>Nro. Propuesta</label>
                            <input type="text" class="form-control" id="txtnroprop" name="txtnroprop" placeholder="...">
                        </div>
                    </div>
                </div>
            </div>                        
            <div class="card-footer justify-content-between"> 
                <div class="row">
                <div class="col-md-12">
                    <div class="text-right">
                        <button type="submit" class="btn btn-primary" id="btnBuscar"><i class="fas fa-search"></i> Buscar</button>    
                        <button type="button" class="btn btn-outline-info" id="btnNuevo" data-toggle="modal" data-target="#modalCreaTram"><i class="fas fa-plus"></i> Crear Nuevo</button>
                    </div>
                </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-12">
                <div class="card card-outline card-success">
                    <div class="card-header">
                        <h3 class="card-title">Listado de Tramites</h3>
                    </div>                
                    <div class="card-body">
                        <table id="tblListTramite" class="table table-striped table-bordered" style="width:100%">
                            <thead>
                            <tr>
                                <th></th>
                                <th>Cliente</th>
                                <th>N° Propuesta</th>
                                <th>Tipo Tramite</th>
                                <th>Fecha Tramite</th>
                                <th>Código</th>
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
            </div>
        </div>
    
    </div>
</section>
<!-- /.Main content -->

<!-- /.modal-crear-tramite --> 
<div class="modal fade" id="modalCreaTram" data-backdrop="static" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <form class="form-horizontal" id="frmCreaTram" name="frmCreaTram" action="<?= base_url('pt/ctramites/settramite')?>" method="POST" enctype="multipart/form-data" role="form"> 

        <div class="modal-header text-center bg-success">
            <h4 class="modal-title w-100 font-weight-bold">Registro de Tramite</h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>

        <div class="modal-body">          
            <input type="hidden" id="mhdnIdTram" name="mhdnIdTram"> <!-- ID -->
            <input type="hidden" id="mhdnAccionTram" name="mhdnAccionTram">
                        
            <div class="form-group">
                <div class="row">
                    <div class="col-sm-12">
                        <div class="text-info">Cliente <span class="text-requerido">*</span></div>
                        <div>                            
                            <select class="form-control select2bs4" id="mcboClienprop" name="mcboClienprop" style="width: 100%;">
                                <option value="" selected="selected">Cargando...</option>
                            </select>
                        </div>
                    </div>  
                </div>                
            </div> 
            <div class="form-group">
                <div class="row">
                    <div class="col-sm-8">
                        <div class="text-info">Nro Propuesta <span class="text-requerido">*</span></div>
                        <div>                            
                            <select class="form-control select2bs4" id="mcboNropropu" name="mcboNropropu" style="width: 100%;">
                                <option value="" selected="selected">Cargando...</option>
                            </select>
                        </div>
                    </div>                      
                    <div class="col-sm-4">
                        <div class="text-info">Fecha Tramite</div>
                        <div class="input-group date" id="mtxtFregtramite" data-target-input="nearest">
                            <input type="text" id="mtxtFtram" name="mtxtFtram" class="form-control datetimepicker-input" data-target="#mtxtFregtramite"/>
                            <div class="input-group-append" data-target="#mtxtFregtramite" data-toggle="datetimepicker">
                                <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                            </div>
                        </div>                        
                    </div>
                </div>                
            </div> 
            <div class="form-group">
                <div class="row">                
                    <div class="col-sm-4">
                        <div class="text-info">Tipo de Tramite</div>
                        <div>
                            <select class="form-control select2bs4" id="mcboTipotram" name="mcboTipotram">
                            <option value="">Cargando...</option>
                            </select>
                        </div>
                    </div>                
                    <div class="col-sm-4">
                        <div class="text-info">Código <span style="color: #FD0202">*</span></div>
                        <div>
                            <input type="text" id="mtxtCodigo" name="mtxtCodigo" class="form-control"/>
                        </div>
                    </div>   
                    <div class="col-sm-4"> 
                        <div class="text-info">Responsable</div> 
                        <div>                            
                            <select class="form-control" id="mcboRespon" name="mcboRespon" >
                                <option value=1>SU-TZE LIU</option>
                                <option value=42>CARLOS VILLACORTA</option>
                                <option value=64>JOSE OLIDEN</option>
                            </select>
                        </div> 
                    </div> 
                </div>                
            </div> 
            <div class="form-group" id="divProd">
                <div class="row">                
                    <div class="col-sm-12"> 
                        <div class="text-info">Nombre del Producto</div>
                        <div>
                            <input type="text" id="mtxtNombprod" name="mtxtNombprod" class="form-control"/>
                        </div>
                    </div> 
                </div>                
            </div>  
            <div class="form-group" id="divDesc">
                <div class="row">                
                    <div class="col-sm-12"> 
                        <div class="text-info">Tipo de Envase y Dimensiones</div>
                        <div>
                            <input type="text" id="mtxtDescrip" name="mtxtDescrip" class="form-control"/>
                        </div>
                    </div> 
                </div>                
            </div>  
            <div class="form-group">
                <div class="row">                
                    <div class="col-sm-12">
                        <div class="text-info">Archivo</div>                        
                        <div class="input-group">
                            <input class="form-control" type="text" name="mtxtNombarch" id="mtxtNombarch">                            
                            <span class="input-group-append">                                
                                <div class="fileUpload btn btn-secondary">
                                    <span>Subir Archivo</span>
                                    <input type="file" class="upload" id="mtxtArchivotram" name="mtxtArchivotram" onchange="escogerArchivo()"/>                      
                                </div> 
                            </span>  
                        </div>
                        <span style="color: red; font-size: 13px;">+ Los archivos deben estar en formato pdf, docx o xlsx y no deben pesar mas de 60 MB</span>                        
                        <input type="hidden" name="mtxtRutaarch" id="mtxtRutaarch">
                        <input type="hidden" name="mtxtarchivo" id="mtxtarchivo">
                        <input type="hidden" name="sArchivo" id="sArchivo" value="N"> 
                    </div> 
                </div>
            </div>
            <div class="form-group" id="divCarta">
                <div class="row">                
                    <div class="col-sm-12">
                        <div class="text-info">Carta</div>                        
                        <div class="input-group">
                            <input class="form-control" type="text" name="mtxtNombcarta" id="mtxtNombcarta">                            
                            <span class="input-group-append">                                
                                <div class="fileUpload btn btn-secondary">
                                    <span>Subir Carta</span>
                                    <input type="file" class="upload" id="mtxtCartatram" name="mtxtCartatram" onchange="escogerCarta()"/>                      
                                </div> 
                            </span>  
                        </div>
                        <span style="color: red; font-size: 13px;">+ Los archivos deben estar en formato pdf, docx o xlsx y no deben pesar mas de 60 MB</span>                        
                        <input type="hidden" name="mtxtRutacarta" id="mtxtRutacarta">
                        <input type="hidden" name="mtxtCarta" id="mtxtCarta">
                        <input type="hidden" name="sCarta" id="sCarta" value="N"> 
                    </div> 
                </div>
            </div>   
            <div class="form-group">
                <div class="row">                
                    <div class="col-sm-12">
                        <div class="text-info">Comentarios</div>
                        <div>   
                            <textarea id="mtxtComentario" name="mtxtComentario" class="form-control" cols="20" data-val="true" data-val-length="No debe superar los 500 caracteres." data-val-length-max="500" rows="2" data-val-maxlength-max="500"></textarea>
                            <span class="help-inline" style="padding-left:0px; color:#999; font-size:0.9em;">Caracteres: 0 / 500</span>     
                        </div> 
                    </div> 
                </div>                
            </div>          
        </div>

        <div class="modal-footer justify-content-between" style="background-color: #dff0d8;">
            <button type="reset" class="btn btn-default" id="mbtnCCreaTram" data-dismiss="modal">Cancelar</button>
            <button type="submit" class="btn btn-info" id="mbtnGCreaTram">Grabar</button>
        </div>
      </form>
    </div>
  </div>
</div> 
<!-- /.modal-->

<!-- /.modal-adjuntos --> 
<div class="modal fade" id="modalAdjuntar" data-backdrop="static" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <form class="form-horizontal" id="frmAdjuntar" name="frmAdjuntar" action="<?= base_url('pt/ctramites/setadjuntar')?>" method="POST" enctype="multipart/form-data" role="form"> 

        <div class="modal-header text-center bg-success">
            <h4 class="modal-title w-100 font-weight-bold">Otros Documentos Varios</h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
            
        <div class="modal-body">
            <div class="form-group">
                <div class="row">                
                    <div class="col-sm-12">                        
                        <input type="hidden" name="mtxtidpttramite" class="form-control" id="mtxtidpttramite">
                        <input type="hidden" name="mtxtfechaadjtram" id="mtxtfechaadjtram" class="form-control">
                        <input type="hidden" name="mtxtadjnombtram" class="form-control" id="mtxtadjnombtram">
                        <input type="hidden" name="mtxtadjrutatram" class="form-control" id="mtxtadjrutatram">
                        <div class="text-info">Archivos</div>
                        <div class="custom-file">
                            <input type="file" class="custom-file-input" id="mtxtTramAdj" name="mtxtTramAdj[]" multiple size="20" onchange="subirTramadj()">
                            <span style="color: red">+ Los documentos deben estar en formato pdf, docx o xlsx</span> 
                            <br>
                            <span style="color: red">+ Los archivos no deben pesar mas de 60 MB</span> 
                            <label class="custom-file-label" for="mtxtTramAdj">Escoger Archivo</label>
                            <input type="hidden" name="mtxtNomadj" id="mtxtNomadj"> 
                            <input type="hidden" name="mtxtRutaadj" id="mtxtRutaadj"> 
                        </div>
                    </div>
                </div>
            </div>
            <table id="tblAdjuntar" class="table table-striped table-bordered" style="width:100%">
                <thead>
                <tr>                    
                    <th style="min-width: 5px; max-width:10px;">Nro.</th>
                    <th style="min-width: 50px; max-width: 50px;">Archivo</th>
                    <th style="min-width: 50px; max-width: 50px;"></th>
                    <th style="min-width: 50px; max-width: 50px;"></th>
                </tr>
                </thead> 
            </table>  
        </div>

        <div class="modal-footer">
            <button type="button" class="btn btn-outline-info" id="btnnewguia" name="btnnewguia" data-toggle="modal" data-target="#modalNewDetaPropu"><i class="fa fa-newspaper-o"></i> Crear Nuevo</button> 
            <button type="button" class="btn btn-default" data-dismiss="modal"><i class="fa fa-fw fa-close"></i> Cerrar</button>
        </div>
       </form>
    </div>
   </div>
</div>
<!-- /.modal-->


<script type="text/javascript">
    var baseurl = "<?php echo base_url();?>"; 
</script>