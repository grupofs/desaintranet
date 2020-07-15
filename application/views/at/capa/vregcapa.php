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
</style>

<!-- content-header -->
<div class="content-header">   
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1 class="m-0 text-dark">CAPACITACIONES</h1>
      </div>
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="<?php echo public_base_url(); ?>cprincipal/principal">Home</a></li>
          <li class="breadcrumb-item active">Aprendizaje</li>
        </ol>
      </div>
    </div>
  </div>
</div>
<!-- /.content-header -->

<!-- Main content -->
<section class="content">
    <div class="container-fluid"> 
        <div class="row">
            <div class="col-12">
                <div class="card card-success card-outline card-tabs">
                    <div class="card-header p-0 pt-1 border-bottom-0">            
                        <ul class="nav nav-tabs" id="tabcapa" style="background-color: #28a745;" role="tablist">                    
                            <li class="nav-item">
                                <a class="nav-link active" style="color: #000000;" id="tabcapa-list-tab" data-toggle="pill" href="#tabcapa-list" role="tab" aria-controls="tabcapa-list" aria-selected="true">LISTADO</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" style="color: #000000;" id="tabcapa-reg-tab" data-toggle="pill" href="#tabcapa-reg" role="tab" aria-controls="tabcapa-reg" aria-selected="false">REGISTRO</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" style="color: #000000;" id="tabcapa-parti-tab" data-toggle="pill" href="#tabcapa-parti" role="tab" aria-controls="tabcapa-parti" aria-selected="false">PARTICIPANTES</a>
                            </li>
                        </ul>
                    </div>
                    <div class="card-body">
                        <div class="tab-content" id="tabcapa-tabContent">
                            <div class="tab-pane fade show active" id="tabcapa-list" role="tabpanel" aria-labelledby="tabcapa-list-tab">
                                <div class="card card-success">
                                    <div class="card-header">
                                        <h3 class="card-title">BUSQUEDA</h3>
                                        <div class="card-tools">
                                            <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i></button>
                                        </div>
                                    </div>                        
                                    <div class="card-body">
                                        <input type="hidden" name="mtxtidusuinfor" class="form-control" id="mtxtidusuinfor" value="<?php echo $idusu ?>">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>Clientes</label>
                                                    <select class="form-control select2bs4" id="cboClie" name="cboClie" style="width: 100%;">
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
                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <label>Cursos</label>
                                                    <select class="form-control select2bs4" id="cboCursos" name="cboCursos" style="width: 100%;">
                                                        <option value="" selected="selected">Cargando...</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <label>Expositores</label>
                                                    <select class="form-control select2bs4" id="cboExpo" name="cboExpo" style="width: 100%;">
                                                        <option value="" selected="selected">Cargando...</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                    </div>                        
                                    <div class="card-footer justify-content-between" style="background-color: #E0F4ED;"> 
                                        <div class="row">
                                            <div class="col-md-12">
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
                                                <h3 class="card-title">Listado de Capacitaciones</h3>
                                            </div>  
                                            <div class="card-footer justify-content-between" style="background-color: #E0F4ED;"> 
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <div class="text-left"> 
                                                            <button type="button" class="btn btn-outline-info" id="btnNuevo"><i class="fas fa-plus"></i> Crear Nuevo</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>                                       
                                            <div class="card-body">
                                                <table id="tblListCapacita" class="table table-striped table-bordered" style="width:100%">
                                                    <thead>
                                                    <tr>
                                                        <th colspan="8">Cliente :: Establecimiento</th>
                                                    </tr>
                                                    <tr>
                                                        <th></th>
                                                        <th>Cliente</th>
                                                        <th>Fecha</th>
                                                        <th>Curso</th>
                                                        <th>Tema</th>
                                                        <th>Expositor</th>
                                                        <th>Adjuntos</th>
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
                            <div class="tab-pane fade" id="tabcapa-reg" role="tabpanel" aria-labelledby="tabcapa-reg-tab">
                                <fieldset class="scheduler-border" id="regCapa">
                                    <legend class="scheduler-border text-primary">REG. CAPACITACION</legend>
                                    <form class="form-horizontal" id="frmRegCapa" action="<?= base_url('at/capa/cregcapa/setcapa')?>" method="POST" enctype="multipart/form-data" role="form">
                                        <input type="hidden" name="mtxtidcapa" id="mtxtidcapa" class="form-control">
                                        <input type="hidden" name="hdnAccionregcapa" id="hdnAccionregcapa" class="form-control">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">    
                                                    <label>Clientes</label>
                                                    <select class="form-control select2bs4" id="cboregClie" name="cboregClie" style="width: 100%;">
                                                        <option value="" selected="selected">Cargando...</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>Establecimiento</label>
                                                    <select class="form-control select2bs4" id="cboregEstab" name="cboregEstab" style="width: 100%;">
                                                        <option value="" selected="selected">Cargando...</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">                 
                                            <div class="col-sm-6">
                                            <div class="form-group">
                                                <div class="text-info">Fecha Inicio</div>
                                                <div class="input-group date" id="mtxtFCapaini" data-target-input="nearest">
                                                    <input type="text" id="mtxtFinicio" name="mtxtFinicio" class="form-control datetimepicker-input" data-target="#mtxtFCapaini"/>
                                                    <div class="input-group-append" data-target="#mtxtFCapaini" data-toggle="datetimepicker">
                                                        <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                                    </div>
                                                </div>                        
                                            </div> 
                                            </div>             
                                            <div class="col-sm-6">
                                            <div class="form-group">
                                                <div class="text-info">Fecha Fin</div>
                                                <div class="input-group date" id="mtxtFCapafin" data-target-input="nearest">
                                                    <input type="text" id="mtxtFfin" name="mtxtFfin" class="form-control datetimepicker-input" data-target="#mtxtFCapafin"/>
                                                    <div class="input-group-append" data-target="#mtxtFCapafin" data-toggle="datetimepicker">
                                                        <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                                    </div>
                                                </div>                        
                                            </div>
                                            </div> 
                                        </div>
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label>Comentarios</label>
                                                    <input type="text" name="mtxtComentarios"id="mtxtComentarios" class="form-control" >
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-sm-6 text-left">
                                                <button type="button" class="btn btn-primary" id="btnParticiopantes"><i class="fas fa-user-friends"></i> Participantes</button>  
                                            </div> 
                                            <div class="col-sm-6 text-right"> 
                                                <button type="submit" class="btn btn-success" id="btnRegistrar"><i class="fas fa-save"></i> Registrar</button>   
                                                <button type="button" class="btn btn-secondary" id="btnRetornarLista"><i class="fas fa-undo-alt"></i> Retornar</button>
                                            </div>
                                        </div>
                                    </form>
                                </fieldset>
                                <fieldset class="scheduler-border" id="regDetcapa">
                                    <legend class="scheduler-border text-primary">PROGRAMACION</legend>
                                    <div class="row">
                                        <div class="col-md-6 text-left">
                                            <div class="form-group">                                                                          
                                                <a class="btn btn-default btn-sm" style="cursor:pointer;" data-toggle="modal" data-target="#modalCreacurso" id="addcurso" name="addcurso"><img src='<?php echo base_url() ?>assets/images/details_open.png' border="0" align="absmiddle"> Agregar Cursos</a> 
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="card card-outline card-success">
                                                <div class="card-body">   
                                                <table id="tblListRegcapadet" class="table table-striped table-bordered" style="width:100%">
                                                    <thead>
                                                    <tr>
                                                        <th></th>
                                                        <th>Curso</th>
                                                        <th>Tema</th>
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
                                    <div class="row">
                                        <div class="col-md-12">
                                        <div class="card card-outline card-success">
                                            <div class="card-body">  
                                                <table id="tblListRegprogr" class="table table-striped table-bordered" style="width:100%">
                                                    <thead>
                                                    <tr>
                                                        <th></th>
                                                        <th>Expositor</th>
                                                        <th>Fecha</th>
                                                        <th>Hora Inicio</th>
                                                        <th>Hora Inicio</th>
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
                                </fieldset>
                            </div>
                            <div class="tab-pane fade" id="tabcapa-parti" role="tabpanel" aria-labelledby="tabcapa-parti-tab">
                                <fieldset class="scheduler-border" id="regCapa">
                                    <legend class="scheduler-border text-primary">LISTADO PARTICIPANTES</legend>
                                    <div class="row">
                                        <div class="col-sm-12 text-left">                                    
                                            <div class="input-group mb-3">
                                                Nombres o Apellidos / Nro DNI :&nbsp;&nbsp;
                                                <input type="text" class="form-control" name="txtbuscar" id="txtbuscar">
                                                <span class="input-group-append">
                                                    <button type="button" id="btnBuscarAdm" class="btn btn-info btn-flat"><i class="fa fa-search"></i></button>
                                                </span>
                                                &nbsp;&nbsp;
                                                <button type="button" class="btn btn-outline-success" id="btnImportar" data-toggle="modal" data-target="#modalImportparti"><i class="fas fa-upload"></i>&nbsp;&nbsp;Importar</button>
                                                &nbsp;&nbsp;
                                                <button type="button" class="btn btn-outline-primary" id="btnNuevoParti" ><i class="fas fa-plus"></i> Nuevo</button>
                                                &nbsp;&nbsp;
                                                <button type="button" class="btn btn-secondary" id="btnRetornarReg"><i class="fas fa-undo-alt"></i> Retornar</button>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-8">
                                            <div class="card card-outline card-success">
                                                <div class="card-body">  
                                                <table id="tblListParticipantes" class="table table-striped table-bordered" style="width:100%">
                                                    <thead>
                                                    <tr>
                                                        <th>#</th>
                                                        <th>DNI</th>
                                                        <th>Participantes</th>
                                                        <th></th>
                                                    </tr>
                                                    </thead>
                                                <tbody>
                                                </tbody>
                                                </table>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="card card-outline card-success">
                                                <div class="card-header">
                                                    <h3 class="card-title">Registro Participante</h3>
                                                </div>                                        
                                                <form class="form-horizontal" id="frmRegParti" action="<?= base_url('at/capa/cregcapa/setparticipante')?>" method="POST" enctype="multipart/form-data" role="form">              
                                                <div class="card-body">
                                                    <input type="hidden" id="mhdnIdparti" name="mhdnIdparti" > <!-- ID -->
                                                    <input type="hidden" id="mhdnIdcapaParti" name="mhdnIdcapaParti" >
                                                    <input type="hidden" id="mhdnIdadmParti" name="mhdnIdadmParti" >   
                                                    <input type="hidden" id="mhdnAccionParti" name="mhdnAccionParti" value="N"> <!-- ACCION -->                              
                                                        <div class="form-group">
                                                            <div class="col-sm-12"> 
                                                                <div class="text-light-blue">Persona</div> 
                                                                <div class="input-group mb-3" id="partitxt">
                                                                    <input type="text" name="mtxtPerparti" class="form-control" id="mtxtPerparti" /> 
                                                                    <span class="input-group-append">
                                                                        <button type="button" id="btnEditarAdmi" class="btn btn-info btn-flat"><i class="fas fa-external-link-square-alt"></i></button>
                                                                    </span> 
                                                                </div>                                  
                                                            </div>
                                                        </div>
                                                        <div class="form-group">
                                                            <div class="col-sm-12"> 
                                                                <div class="text-light-blue">DNI</div> 
                                                                <input type="text" class="form-control"  name="mtxtDniparti"id="mtxtDniparti" value="" />
                                                            </div>
                                                        </div>
                                                        <div class="form-group">
                                                            <div class="col-sm-12"> 
                                                                <div class="text-light-blue">Email</div> 
                                                                <input type="text" class="form-control"  name="mtxtEmailparti"id="mtxtEmailparti" value="" />
                                                            </div>
                                                        </div>
                                                        <div class="form-group">
                                                            <div class="col-sm-12"> 
                                                                <div class="text-light-blue">Telefono</div> 
                                                                <input type="text" class="form-control"  name="mtxtTelparti"id="mtxtTelparti" value="" />
                                                            </div>
                                                        </div>  
                                                </div>                    
                                                <div class="card-footer">
                                                    <div class="text-right">
                                                        <button type="submit" id="btnGrabarCur" class="btn btn-success">Guardar</button>
                                                    </div>
                                                </div>
                                                </form>
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

<!-- /.modal-crear-cursos --> 
<div class="modal fade" id="modalCreacurso" data-backdrop="static" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <form class="form-horizontal" id="frmCreacurso" name="frmCreacurso" action="<?= base_url('at/capa/cregcapa/setcapadet')?>" method="POST" enctype="multipart/form-data" role="form"> 

        <div class="modal-header text-center bg-success">
            <h4 class="modal-title w-100 font-weight-bold">Registro de Cursos de Capacitacion</h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>

        <div class="modal-body">          
            <input type="hidden" id="mhdnIdCapa" name="mhdnIdCapa"> <!-- ID -->
            <input type="hidden" id="mhdnIdCapaDet" name="mhdnIdCapaDet"> 
            <input type="hidden" id="mhdnIdCliente" name="mhdnIdCliente"> 
            <input type="hidden" id="mhdnAccionCapa" name="mhdnAccionCapa" value="">
                        
            <div class="form-group">
                <div class="row">
                    <div class="col-sm-6">
                        <div class="text-info">Curso</div>
                        <div>                            
                            <select class="form-control select2bs4" id="mcboCurso" name="mcboCurso" style="width: 100%;">
                                <option value="" selected="selected">Cargando...</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="text-info">Tema</div>
                        <div>                            
                            <select class="form-control select2bs4" id="mcboTema" name="mcboTema" style="width: 100%;">
                                <option value="" selected="selected">Cargando...</option>
                            </select>
                        </div>
                    </div>   
                </div>                
            </div>    
            <div class="form-group">
                <div class="row">                
                    <div class="col-sm-12">
                        <div class="text-info">Presentacion</div>                        
                        <div class="input-group">
                            <input class="form-control" type="text" name="mtxtNomarchpresent" id="mtxtNomarchpresent">                            
                            <span class="input-group-append">                                
                                <div class="fileUpload btn btn-secondary">
                                    <span>Subir Presentacion</span>
                                    <input type="file" class="upload" id="mtxtArchivopresent" name="mtxtArchivopresent" onchange="escogerPresent()"/>                      
                                </div> 
                            </span>  
                        </div>
                        <span style="color: red; font-size: 13px;">+ Los archivos deben estar en formato pdf, docx o xlsx y no deben pesar mas de 60 MB</span>                        
                        <input type="hidden" name="mtxtRutapresent" id="mtxtRutapresent">
                        <input type="hidden" name="mtxtpresent" id="mtxtpresent">
                        <input type="hidden" name="sPresent" id="sPresent" value="N"> 
                    </div> 
                </div>
            </div>
            <div class="form-group">
                <div class="row">                
                    <div class="col-sm-12">
                        <div class="text-info">Taller</div>                        
                        <div class="input-group">
                            <input class="form-control" type="text" name="mtxtNomarchtaller" id="mtxtNomarchtaller">                            
                            <span class="input-group-append">                                
                                <div class="fileUpload btn btn-secondary">
                                    <span>Subir Taller</span>
                                    <input type="file" class="upload" id="mtxtArchivotaller" name="mtxtArchivotaller" onchange="escogerTaller()"/>                      
                                </div> 
                            </span>  
                        </div>
                        <span style="color: red; font-size: 13px;">+ Los archivos deben estar en formato pdf, docx o xlsx y no deben pesar mas de 60 MB</span>                        
                        <input type="hidden" name="mtxtRutataller" id="mtxtRutataller">
                        <input type="hidden" name="mtxttaller" id="mtxttaller">
                        <input type="hidden" name="sTaller" id="sTaller" value="N"> 
                    </div> 
                </div>
            </div>
            <div class="form-group">
                <div class="row">                
                    <div class="col-sm-12">
                        <div class="text-info">Examen</div>                        
                        <div class="input-group">
                            <input class="form-control" type="text" name="mtxtNomarchexamen" id="mtxtNomarchexamen">                            
                            <span class="input-group-append">                                
                                <div class="fileUpload btn btn-secondary">
                                    <span>Subir Examen</span>
                                    <input type="file" class="upload" id="mtxtArchivoexamen" name="mtxtArchivoexamen" onchange="escogerExamen()"/>                      
                                </div> 
                            </span>  
                        </div>
                        <span style="color: red; font-size: 13px;">+ Los archivos deben estar en formato pdf, docx o xlsx y no deben pesar mas de 60 MB</span>                        
                        <input type="hidden" name="mtxtRutaexamen" id="mtxtRutaexamen">
                        <input type="hidden" name="mtxtexamen" id="mtxtexamen">
                        <input type="hidden" name="sExamen" id="sExamen" value="N"> 
                    </div> 
                </div>
            </div> 
            <div class="form-group">
                <div class="row">                
                    <div class="col-sm-12">
                        <div class="text-info">Lista Participantes</div>                        
                        <div class="input-group">
                            <input class="form-control" type="text" name="mtxtNomarchlista" id="mtxtNomarchlista">                            
                            <span class="input-group-append">                                
                                <div class="fileUpload btn btn-secondary">
                                    <span>Subir Lista</span>
                                    <input type="file" class="upload" id="mtxtArchivolista" name="mtxtArchivolista" onchange="escogerLista()"/>                      
                                </div> 
                            </span>  
                        </div>
                        <span style="color: red; font-size: 13px;">+ Los archivos deben estar en formato pdf, docx o xlsx y no deben pesar mas de 60 MB</span>                        
                        <input type="hidden" name="mtxtRutalista" id="mtxtRutalista">
                        <input type="hidden" name="mtxtlista" id="mtxtlista">
                        <input type="hidden" name="sLista" id="sLista" value="N"> 
                    </div> 
                </div>
            </div>  
            <div class="form-group">
                <div class="row">                
                    <div class="col-sm-12">
                        <div class="text-info">Certificado</div>                        
                        <div class="input-group">
                            <input class="form-control" type="text" name="mtxtNomarchcerti" id="mtxtNomarchcerti">                            
                            <span class="input-group-append">                                
                                <div class="fileUpload btn btn-secondary">
                                    <span>Subir Certificado</span>
                                    <input type="file" class="upload" id="mtxtArchivocerti" name="mtxtArchivocerti" onchange="escogerCerti()"/>                      
                                </div> 
                            </span>  
                        </div>
                        <span style="color: red; font-size: 13px;">+ Los archivos deben estar en formato pdf, docx o xlsx y no deben pesar mas de 60 MB</span>                        
                        <input type="hidden" name="mtxtRutacerti" id="mtxtRutacerti">
                        <input type="hidden" name="mtxtcerti" id="mtxtcerti">
                        <input type="hidden" name="sCerti" id="sCerti" value="N"> 
                    </div> 
                </div>
            </div>
        </div>

        <div class="modal-footer justify-content-between" style="background-color: #dff0d8;">
            <button type="reset" class="btn btn-default" id="mbtnCCreacapa" data-dismiss="modal">Cancelar</button>
            <button type="submit" class="btn btn-info" id="mbtnGCreacapa">Grabar</button>
        </div>
      </form>
    </div>
  </div>
</div> 
<!-- /.modal-->

<!-- /.modal-crear-programa --> 
<div class="modal fade" id="modalPrograma" data-backdrop="static" role="dialog" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <form class="form-horizontal" id="frmPrograma" name="frmPrograma" action="<?= base_url('at/capa/cregcapa/setprograma')?>" method="POST" enctype="multipart/form-data" role="form"> 

        <div class="modal-header text-center bg-success">
            <h4 class="modal-title w-100 font-weight-bold">Programacion del Curso</h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>

        <div class="modal-body">          
            <input type="hidden" id="mhdnIdCapap" name="mhdnIdCapap">
            <input type="hidden" id="mhdnIdCapaDetp" name="mhdnIdCapaDetp"> 
            <input type="hidden" id="mhdnIdcapaprogra" name="mhdnIdcapaprogra"> <!-- ID --> 
            <input type="hidden" id="mhdnAccionprogr" name="mhdnAccionprogr" value="">
                        
            <div class="form-group">
                <div class="row">
                    <div class="col-sm-12">
                        <div class="text-info">Expositor</div>
                        <div>                            
                            <select class="form-control select2bs4" id="mcboCapaexpo" name="mcboCapaexpo" style="width: 100%;">
                                <option value="" selected="selected">Cargando...</option>
                            </select>
                        </div>
                    </div> 
                </div>                
            </div>    
            <div class="form-group">
                <div class="row">                 
                    <div class="col-sm-4">
                        <div class="text-info">Fecha Expositor</div>
                        <div class="input-group date" id="mtxtFCapaProgra" data-target-input="nearest">
                            <input type="text" id="mtxtFprogra" name="mtxtFprogra" class="form-control datetimepicker-input" data-target="#mtxtFCapaProgra"/>
                            <div class="input-group-append" data-target="#mtxtFCapaProgra" data-toggle="datetimepicker">
                                <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                            </div>
                        </div>                        
                    </div>
                    <div class="col-sm-4">
                        <div class="text-info">Hora Inicio</div>
                        <div class="input-group date" id="mtxtHini" data-target-input="nearest">
                            <input type="text" id="mtxtHoraini" name="mtxtHoraini" class="form-control datetimepicker-input" data-target="#mtxtHini"/>
                            <div class="input-group-append" data-target="#mtxtHini" data-toggle="datetimepicker">
                                <div class="input-group-text"><i class="far fa-clock"></i></div>
                            </div>
                        </div>                
                    </div>
                    <div class="col-sm-4">
                        <div class="text-info">Hora Fin</div>
                        <div class="input-group date" id="mtxtHfin" data-target-input="nearest">
                            <input type="text" id="mtxtHorafin" name="mtxtHorafin" class="form-control datetimepicker-input" data-target="#mtxtHfin"/>
                            <div class="input-group-append" data-target="#mtxtHfin" data-toggle="datetimepicker">
                                <div class="input-group-text"><i class="far fa-clock"></i></div>
                            </div>
                        </div>              
                    </div>  
                </div>                
            </div>  
        </div>

        <div class="modal-footer justify-content-between" style="background-color: #dff0d8;">
            <button type="reset" class="btn btn-default" id="mbtnCProgra" data-dismiss="modal">Cancelar</button>
            <button type="submit" class="btn btn-info" id="mbtnGProgra">Grabar</button>
        </div>
      </form>
    </div>
  </div>
</div> 
<!-- /.modal-->

<!-- /.modal-subir-presentacion --> 
<div class="modal fade" id="modalPresent" data-backdrop="static" role="dialog" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <form class="form-horizontal" id="frmSubpresent" name="frmSubpresent" action="" method="POST" enctype="multipart/form-data" role="form"> 
        <div class="modal-header text-center bg-success">
            <h4 class="modal-title w-100 font-weight-bold">Subir Presentacion</h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body">          
            <input type="hidden" id="mhdnIdCapapresent" name="mhdnIdCapapresent"> <!-- ID -->
            <input type="hidden" id="mhdnIdCapaDetpresent" name="mhdnIdCapaDetpresent">  
            <input type="hidden" id="mhdncclientepresent" name="mhdncclientepresent"> 
            <input type="hidden" id="mhdnfinipresent" name="mhdnfinipresent">             
            <div class="form-group">
                <div class="row">                
                    <div class="col-sm-12">
                        <div class="text-info">Presentacion</div>                        
                        <div class="input-group">
                            <input class="form-control" type="text" name="stxtNomarchpresent" id="stxtNomarchpresent">                            
                            <span class="input-group-append">                                
                                <div class="fileUpload btn btn-secondary">
                                    <span>Subir Presentacion</span>
                                    <input type="file" class="upload" id="stxtArchivopresent" name="stxtArchivopresent" onchange="adjPresent()"/>                      
                                </div> 
                            </span>  
                        </div>
                        <span style="color: red; font-size: 13px;">+ Los archivos deben estar en formato pdf, docx o xlsx y no deben pesar mas de 60 MB</span>                        
                        <input type="hidden" name="stxtRutapresent" id="stxtRutapresent">
                        <input type="hidden" name="stxtpresent" id="stxtpresent"> 
                    </div> 
                </div>
            </div>
        </div>
        <div class="modal-footer justify-content-between" style="background-color: #dff0d8;">
            <button type="reset" class="btn btn-default" id="mbtnCSubpresenta" data-dismiss="modal">Cancelar</button>
        </div>
      </form>
    </div>
  </div>
</div> 
<!-- /.modal-->

<!-- /.modal-subir-taller --> 
<div class="modal fade" id="modalTaller" data-backdrop="static" role="dialog" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <form class="form-horizontal" id="frmSubtaller" name="frmSubtaller" action="" method="POST" enctype="multipart/form-data" role="form"> 
        <div class="modal-header text-center bg-success">
            <h4 class="modal-title w-100 font-weight-bold">Subir Taller</h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body">          
            <input type="hidden" id="mhdnIdCapataller" name="mhdnIdCapataller"> <!-- ID -->
            <input type="hidden" id="mhdnIdCapaDettaller" name="mhdnIdCapaDettaller">  
            <input type="hidden" id="mhdncclientetaller" name="mhdncclientetaller"> 
            <input type="hidden" id="mhdnfinitaller" name="mhdnfinitaller">             
            <div class="form-group">
                <div class="row">                
                    <div class="col-sm-12">
                        <div class="text-info">Taller</div>                        
                        <div class="input-group">
                            <input class="form-control" type="text" name="stxtNomarchtaller" id="stxtNomarchtaller">                            
                            <span class="input-group-append">                                
                                <div class="fileUpload btn btn-secondary">
                                    <span>Subir Taller</span>
                                    <input type="file" class="upload" id="stxtArchivotaller" name="stxtArchivotaller" onchange="adjTaller()"/>                      
                                </div> 
                            </span>  
                        </div>
                        <span style="color: red; font-size: 13px;">+ Los archivos deben estar en formato pdf, docx o xlsx y no deben pesar mas de 60 MB</span>                        
                        <input type="hidden" name="stxtRutataller" id="stxtRutataller">
                        <input type="hidden" name="stxttaller" id="stxttaller"> 
                    </div> 
                </div>
            </div>
        </div>
        <div class="modal-footer justify-content-between" style="background-color: #dff0d8;">
            <button type="reset" class="btn btn-default" id="mbtnCSubtaller" data-dismiss="modal">Cancelar</button>
        </div>
      </form>
    </div>
  </div>
</div> 
<!-- /.modal-->

<!-- /.modal-subir-examen --> 
<div class="modal fade" id="modalExamen" data-backdrop="static" role="dialog" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <form class="form-horizontal" id="frmSubexamen" name="frmSubexamen" action="" method="POST" enctype="multipart/form-data" role="form"> 
        <div class="modal-header text-center bg-success">
            <h4 class="modal-title w-100 font-weight-bold">Subir Examen</h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body">          
            <input type="hidden" id="mhdnIdCapaexamen" name="mhdnIdCapaexamen"> <!-- ID -->
            <input type="hidden" id="mhdnIdCapaDetexamen" name="mhdnIdCapaDetexamen">  
            <input type="hidden" id="mhdncclienteexamen" name="mhdncclienteexamen"> 
            <input type="hidden" id="mhdnfiniexamen" name="mhdnfiniexamen">             
            <div class="form-group">
                <div class="row">                
                    <div class="col-sm-12">
                        <div class="text-info">Examen</div>                        
                        <div class="input-group">
                            <input class="form-control" type="text" name="stxtNomarchtexamen" id="stxtNomarchtexamen">                            
                            <span class="input-group-append">                                
                                <div class="fileUpload btn btn-secondary">
                                    <span>Subir Examen</span>
                                    <input type="file" class="upload" id="stxtArchivoexamen" name="stxtArchivoexamen" onchange="adjExamen()"/>                      
                                </div> 
                            </span>  
                        </div>
                        <span style="color: red; font-size: 13px;">+ Los archivos deben estar en formato pdf, docx o xlsx y no deben pesar mas de 60 MB</span>                        
                        <input type="hidden" name="stxtRutaexamen" id="stxtRutaexamen">
                        <input type="hidden" name="stxtexamen" id="stxtexamen"> 
                    </div> 
                </div>
            </div>
        </div>
        <div class="modal-footer justify-content-between" style="background-color: #dff0d8;">
            <button type="reset" class="btn btn-default" id="mbtnCSubexamen" data-dismiss="modal">Cancelar</button>
        </div>
      </form>
    </div>
  </div>
</div> 
<!-- /.modal-->

<!-- /.modal-subir-lista --> 
<div class="modal fade" id="modalLista" data-backdrop="static" role="dialog" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <form class="form-horizontal" id="frmSublista" name="frmSublista" action="" method="POST" enctype="multipart/form-data" role="form"> 
        <div class="modal-header text-center bg-success">
            <h4 class="modal-title w-100 font-weight-bold">Subir Lista Participantes</h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body">          
            <input type="hidden" id="mhdnIdCapalista" name="mhdnIdCapalista"> <!-- ID -->
            <input type="hidden" id="mhdnIdCapaDetlista" name="mhdnIdCapaDetlista">  
            <input type="hidden" id="mhdncclientelista" name="mhdncclientelista"> 
            <input type="hidden" id="mhdnfinilista" name="mhdnfinilista">             
            <div class="form-group">
                <div class="row">                
                    <div class="col-sm-12">
                        <div class="text-info">Lista</div>                        
                        <div class="input-group">
                            <input class="form-control" type="text" name="stxtNomarchtlista" id="stxtNomarchtlista">                            
                            <span class="input-group-append">                                
                                <div class="fileUpload btn btn-secondary">
                                    <span>Subir Lista</span>
                                    <input type="file" class="upload" id="stxtArchivolista" name="stxtArchivolista" onchange="adjLista()"/>                      
                                </div> 
                            </span>  
                        </div>
                        <span style="color: red; font-size: 13px;">+ Los archivos deben estar en formato pdf, docx o xlsx y no deben pesar mas de 60 MB</span>                        
                        <input type="hidden" name="stxtRutalista" id="stxtRutalista">
                        <input type="hidden" name="stxtlista" id="stxtlista"> 
                    </div> 
                </div>
            </div>
        </div>
        <div class="modal-footer justify-content-between" style="background-color: #dff0d8;">
            <button type="reset" class="btn btn-default" id="mbtnCSublista" data-dismiss="modal">Cancelar</button>
        </div>
      </form>
    </div>
  </div>
</div> 
<!-- /.modal-->

<!-- /.modal-subir-certi --> 
<div class="modal fade" id="modalCerti" data-backdrop="static" role="dialog" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <form class="form-horizontal" id="frmSubcerti" name="frmSubcerti" action="" method="POST" enctype="multipart/form-data" role="form"> 
        <div class="modal-header text-center bg-success">
            <h4 class="modal-title w-100 font-weight-bold">Subir Certificado</h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body">          
            <input type="hidden" id="mhdnIdCapacerti" name="mhdnIdCapacerti"> <!-- ID -->
            <input type="hidden" id="mhdnIdCapaDetcerti" name="mhdnIdCapaDetcerti">  
            <input type="hidden" id="mhdncclientecerti" name="mhdncclientecerti"> 
            <input type="hidden" id="mhdnfinicerti" name="mhdnfinicerti">             
            <div class="form-group">
                <div class="row">                
                    <div class="col-sm-12">
                        <div class="text-info">Certificado</div>                        
                        <div class="input-group">
                            <input class="form-control" type="text" name="stxtNomarchtcerti" id="stxtNomarchtcerti">                            
                            <span class="input-group-append">                                
                                <div class="fileUpload btn btn-secondary">
                                    <span>Subir Certificado</span>
                                    <input type="file" class="upload" id="stxtArchivocerti" name="stxtArchivocerti" onchange="adjCerti()"/>                      
                                </div> 
                            </span>  
                        </div>
                        <span style="color: red; font-size: 13px;">+ Los archivos deben estar en formato pdf, docx o xlsx y no deben pesar mas de 60 MB</span>                        
                        <input type="hidden" name="stxtRutacerti" id="stxtRutacerti">
                        <input type="hidden" name="stxtcerti" id="stxtcerti"> 
                    </div> 
                </div>
            </div>
        </div>
        <div class="modal-footer justify-content-between" style="background-color: #dff0d8;">
            <button type="reset" class="btn btn-default" id="mbtnCSubcerti" data-dismiss="modal">Cancelar</button>
        </div>
      </form>
    </div>
  </div>
</div> 
<!-- /.modal-->

<!-- /.modal-importar-parti -->
<div class="modal fade" id="modalImportparti" data-backdrop="static" role="dialog" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header text-center bg-success">
                <h4 class="modal-title w-100 font-weight-bold">Importar Participantes</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <?php
                echo form_open_multipart('at/capa/cregcapa/import_parti');
                echo form_upload('file');
                echo '<br/>';
                echo form_submit(null, 'Upload');
                echo form_close();
                ?>
            </div>
            <div class="modal-footer" style="background-color: #dff0d8;">
                <button type="reset" class="btn btn-default" id="mbtnCImportparti" data-dismiss="modal">Cancelar</button>
            </div>
        </div>
    </div>
</div>    
<!-- /.modal-->

<!-- Script Generales -->
<script type="text/javascript">
    var baseurl = "<?php echo base_url();?>"; 
</script>