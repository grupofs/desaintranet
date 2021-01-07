<?php
    $idusu = $this -> session -> userdata('s_idusuario');
    $codusu = $this -> session -> userdata('s_cusuario');
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
        <h1 class="m-0 text-dark">INFORMES</h1>
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
<section class="content" style="background-color: #E0F4ED;">
    <div class="container-fluid"> 
        <div class="row">
            <div class="col-12">
                <input type="hidden" id="mtxtuserpropu" name="mtxtuserpropu" value="<?php echo $codusu ?>">
                <div class="card card-success card-outline card-tabs">
                    <div class="card-header p-0 pt-1 border-bottom-0">            
                        <ul class="nav nav-tabs" id="tabinforme" style="background-color: #28a745;" role="tablist">                    
                            <li class="nav-item">
                                <a class="nav-link active" style="color: #000000;" id="tabinforme-list-tab" data-toggle="pill" href="#tabinforme-list" role="tab" aria-controls="tabinforme-list" aria-selected="true">LISTADO</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" style="color: #000000;" id="tabinforme-eval-tab" data-toggle="pill" href="#tabinforme-eval" role="tab" aria-controls="tabinforme-eval" aria-selected="false">EVALUACION</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" style="color: #000000;" id="tabinforme-reg-tab" data-toggle="pill" href="#tabinforme-reg" role="tab" aria-controls="tabinforme-reg" aria-selected="false">REGISTRO</a>
                            </li>
                        </ul>
                    </div>
                    <div class="card-body">
                        <div class="tab-content" id="tabinforme-tabContent">
                            <div class="tab-pane fade show active" id="tabinforme-list" role="tabpanel" aria-labelledby="tabinforme-list-tab"> 
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
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label>Servicios</label>
                                                    <select class="form-control select2bs4" id="cboServ" name="cboServ" style="width: 100%;">
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
                                                    <label>Clientes</label>
                                                    <select class="form-control select2bs4" id="cboClie" name="cboClie" style="width: 100%;">
                                                        <option value="" selected="selected">Cargando...</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label>Nro Propuesta</label>
                                                    <input type="text" class="form-control" id="txtnropropu" name="txtnropropu" placeholder="...">
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label>Nro Informe</label>
                                                    <input type="text" class="form-control" id="txtnroinfor" name="txtnroinfor" placeholder="...">
                                                </div>
                                            </div>
                                        </div>
                                    </div>                    
                        
                                    <div class="card-footer justify-content-between"> 
                                        <div class="row">
                                            <div class="col-md-2"> 
                                                <div id="console-event"></div>                   
                                                <input type="checkbox" name="swVigencia" id="swVigencia" checked data-bootstrap-switch  data-on-text="Activos" data-off-text="Inactivos">
                                            </div>
                                            <div class="col-md-10">
                                                <div class="text-right">
                                                    <button type="submit" class="btn btn-primary" id="btnBuscar"><i class="fas fa-search"></i> Buscar</button>    
                                                    <button type="button" class="btn btn-outline-info" id="btnNuevo"><i class="fas fa-plus"></i> Crear Nuevo</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div> 

                                <div class="row">
                                    <div class="col-12">
                                        <div class="card card-outline card-success">
                                            <div class="card-header">
                                                <h3 class="card-title">Listado de Informes</h3>
                                            </div>
                                        
                                            <div class="card-body">
                                                <table id="tblListInforme" class="table table-striped table-bordered" style="width:100%">
                                                    <thead>
                                                    <tr>
                                                        <th></th>
                                                        <th>N° Informe</th>
                                                        <th>Cliente</th>
                                                        <th>Responsable</th>
                                                        <th>Fecha</th>
                                                        <th>Servicio</th>
                                                        <th>N° Propuesta</th>
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
                            <div class="tab-pane fade" id="tabinforme-eval" role="tabpanel" aria-labelledby="tabinforme-eval-tab">
                                <form class="form-horizontal" id="frmMantEval" action="<?= base_url('pt/cinforme/setevaluacion')?>" method="POST" enctype="multipart/form-data" role="form">
                                    <input type="hidden" id="hdnIdpteval" name="hdnIdpteval"> <!-- ID -->
                                    <input type="hidden" id="hdnAccionpteval" name="hdnAccionpteval" value="G">
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label>Clientes</label>
                                                <input type="text" class="form-control" id="txtRegClie" name="txtRegClie" disabled>
                                                <div id="divRegClie">
                                                <select class="form-control select2bs4" id="cboRegClie" name="cboRegClie" style="width: 100%;">
                                                    <option value="" selected="selected">Cargando...</option>
                                                </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label>Propuesta</label>
                                                <input type="text" class="form-control" id="txtRegPropu" name="txtRegPropu" disabled>
                                                <div id="divRegPropu">
                                                <select class="form-control select2bs4" id="cboRegPropu" name="cboRegPropu" style="width: 100%;" >
                                                    <option value="" selected="selected">Cargando...</option>
                                                </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label>Servicio</label>
                                                <input type="text" class="form-control" id="txtservicio" name="txtservicio" disabled>
                                                <input type="hidden" class="form-control" id="hdnidserv" name="hdnidserv">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-12 text-right"> 
                                            <button type="submit" class="btn btn-success" id="btnEvaluar"><i class="fas fa-save"></i> Evaluar</button>    
                                            <button type="button" class="btn btn-secondary" id="btnRetornarLista"><i class="fas fa-undo-alt"></i> Retornar</button>
                                        </div>
                                    </div>
                                </form>
                                <fieldset class="scheduler-border" id="regInforme">
                                    <legend class="scheduler-border text-primary">REG. INFORMES</legend>
                                    <div class="box-body">    
                                        <div class="row">
                                            <div class="col-12 text-left">                                                                           
                                                <a class="btn btn-default btn-sm" data-toggle="modal" data-target="#modalCreaInfor" id="addinforme" name="addinforme" style="visibility:hidden"><img src='<?php echo base_url() ?>assets/images/details_open.png' border="0" align="absmiddle"> Agregar Informe</a> 
                                            </div>
                                        </div>  
                                        <br>                             
                                        <div class="form-group">
                                            <div class="col-12"> 
                                                <table id="tblListRegInforme" class="table table-striped table-bordered" style="width:100%">
                                                    <thead>
                                                    <tr>
                                                        <th>N° Informe</th>
                                                        <th>Fecha Informe</th>
                                                        <th>Responsable</th>
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
                                </fieldset>
                                <fieldset class="scheduler-border" id="listRegistro">
                                    <legend class="scheduler-border text-primary">LISTADO REGISTROS - <label id="lblInforme"></label></legend>
                                    <div class="box-body">                                   
                                        <div class="form-group">
                                            <div class="col-12"> 
                                                <table id="tblListRegitro" class="table table-striped table-bordered" style="width:100%">
                                                    <thead>
                                                    <tr>
                                                        <th>Estudio | Servicios</th>
                                                        <th>Tipo - Producto | Recinto | Equipo | Conclusion </th>
                                                        <th>Nombre del Producto | Descripcion del Equipo | Descripcion de lo Ocurrido</th>
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
                            <div class="tab-pane fade" id="tabinforme-reg" role="tabpanel" aria-labelledby="tabinforme-reg-tab">
                                <form class="form-horizontal" id="frmMantRegistro" action="<?= base_url('pt/cinforme/setregistro')?>" method="POST" enctype="multipart/form-data" role="form">
                                    <input type="hidden" id="hdnIdptreg" name="hdnIdptreg"> <!-- ID -->
                                    <input type="hidden" id="hdnAccionptreg" name="hdnAccionptreg" value="G">
                                    <input type="hidden" id="hdnIdreginfor" name="hdnIdreginfor">
                                    <input type="hidden" id="hdnnroinforme" name="hdnnroinforme">
                                    <input type="hidden" id="hdnIdregequipo" name="hdnIdregequipo">
                                    <input type="hidden" id="hdnIdregproducto" name="hdnIdregproducto">
                                    <input type="hidden" id="hdnIdregrecinto" name="hdnIdregrecinto">
                                    <input type="hidden" id="hdnIdregprocestudio" name="hdnIdregprocestudio">

                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label>Servicio</label>
                                                <input type="text" class="form-control" id="txtregservi" name="txtregservi" disabled>
                                                <input type="hidden" id="hdnIdregservi" name="hdnIdregservi">
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group" id="divEstudio">
                                                <label>Estudio</label>
                                                <input type="text" class="form-control" id="txtRegEstudio" name="txtRegEstudio" disabled>
                                                <input type="hidden" id="hdnIdRegEstudio" name="hdnIdRegEstudio">
                                                <div id="divRegEstudio">
                                                    <select class="form-control select2bs4" id="cboRegEstudio" name="cboRegEstudio" style="width: 100%;">
                                                        <option value="" selected="selected">Cargando...</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-4 text-right"> 
                                            <button type="button" class="btn btn-info" id="btnNuevoReg"><i class="far fa-file"></i> Nuevo</button>
                                            <button type="submit" class="btn btn-success" id="btnGrabarReg"><i class="fas fa-save"></i> Guardar</button>    
                                            <button type="button" class="btn btn-secondary" id="btnRetornarEval"><i class="fas fa-undo-alt"></i> Retornar</button>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-12"> 
                                        <fieldset class="scheduler-border" id="01Registro">
                                            <legend class="scheduler-border text-primary">REGISTROS</legend>
                                            <div class="row">
                                                <input type="hidden" class="form-control" id="txtDescriequipoReg01" name="txtDescriequipoReg01">

                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label>Tipo de Equipo</label>
                                                        <select class="form-control select2bs4" id="cboTipoequipoReg01" name="cboTipoequipoReg01" style="width: 100%;">
                                                            <option value="" selected="selected">Cargando...</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label>Medio de Calentamiento</label>
                                                        <select class="form-control select2bs4" id="cboMediocalientaReg01" name="cboMediocalientaReg01" style="width: 100%;">
                                                            <option value="" selected="selected">Cargando...</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label>Fabricante</label>
                                                        <select class="form-control select2bs4" id="cboFabricanteReg01" name="cboFabricanteReg01" style="width: 100%;">
                                                            <option value="" selected="selected">Cargando...</option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label>ENVASE</label>
                                                        <select class="form-control select2bs4" id="cboEnvaseReg01" name="cboEnvaseReg01" style="width: 100%;">
                                                            <option value="" selected="selected">Cargando...</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-md-2">
                                                    <div class="form-group">
                                                        <label>Nro de Equipos</label>
                                                        <input type="text" class="form-control" id="txtNroequipoReg01" name="txtNroequipoReg01">
                                                    </div>
                                                </div>
                                                <div class="col-md-2">
                                                    <div class="form-group">
                                                        <label>Nro Canastillas</label>
                                                        <input type="text" class="form-control" id="txtNracanastReg01" name="txtNracanastReg01">
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label># o IDENTIFICACIÓN DEL EQUIPO</label>
                                                        <input type="text" class="form-control" id="txtIdenequipoReg01" name="txtIdenequipoReg01">
                                                    </div>
                                                </div>
                                            </div>
                                        </fieldset>
                                        <fieldset class="scheduler-border" id="03Registro">
                                            <legend class="scheduler-border text-primary">REGISTROS</legend>
                                            <div class="row">
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label>Nombre del Producto</label>
                                                        <input type="text" class="form-control" id="txtNombprodReg03" name="txtNombprodReg03">
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label>Tipo de Producto</label>
                                                        <select class="form-control select2bs4" id="cboTipoprodReg03" name="cboTipoprodReg03" style="width: 100%;">
                                                            <option value="" selected="selected">Cargando...</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-md-2" id="divphmp">
                                                    <div class="form-group">
                                                        <label>pH materia prima</label>
                                                        <input type="text" class="form-control" id="txtPHmatprimaReg03" name="txtPHmatprimaReg03">
                                                    </div>
                                                </div>
                                                <div class="col-md-2" id="divphpf">
                                                    <div class="form-group">
                                                        <label>pH producto final</label>
                                                        <input type="text" class="form-control" id="txtPHprodfinReg03" name="txtPHprodfinReg03">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-2">
                                                    <div class="form-group">
                                                        <label>LLEVA PARTÍCULAS?</label>
                                                        <select class="form-control select2bs4" id="cbollevapartReg03" name="cbollevapartReg03" style="width: 100%;">
                                                            <option value="" selected="selected">::Elegir</option>
                                                            <option value="S">SI</option>
                                                            <option value="N">NO</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-md-4" id="divparticula">
                                                    <div class="form-group">
                                                        <label>PARTÍCULAS</label>
                                                        <select class="form-control select2bs4" id="cboParticulasReg03" name="cboParticulasReg03" style="width: 100%;">
                                                            <option value="" selected="selected">Cargando...</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-md-2" id="divliquido">
                                                    <div class="form-group">
                                                        <label>LÍQUIDO DE GOBIERNO</label>
                                                        <select class="form-control select2bs4" id="txtLiqgobReg03" name="txtLiqgobReg03" style="width: 100%;">
                                                            <option value="" selected="selected">Cargando...</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label>ENVASE</label>
                                                        <select class="form-control select2bs4" id="cboEnvaseReg03" name="cboEnvaseReg03" style="width: 100%;">
                                                            <option value="" selected="selected">Cargando...</option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label># PROCAL</label>
                                                        <input type="text" class="form-control" id="txtProcalReg03" name="txtProcalReg03">
                                                    </div>
                                                </div>
                                                <div class="col-md-2">
                                                    <div class="form-group">
                                                        <label>DIMENSIONES</label>
                                                        <select class="form-control select2bs4" id="cboDimenReg03" name="cboDimenReg03" style="width: 100%;">
                                                            <option value="" selected="selected">::Elegir</option>
                                                            <option value="2">En mm</option>
                                                            <option value="3">En 16vos</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-md-2">
                                                    <div class="form-group">
                                                        <label>DIÁMETRO/ANCHO</label>
                                                        <input type="text" class="form-control" id="txtDiamReg03" name="txtDiamReg03">
                                                    </div>
                                                </div>
                                                <div class="col-md-2">
                                                    <div class="form-group">
                                                        <label>ALTURA/LARGO</label>
                                                        <input type="text" class="form-control" id="txtAltuReg03" name="txtAltuReg03">
                                                    </div>
                                                </div>
                                                <div class="col-md-2">
                                                    <div class="form-group">
                                                        <label>GROSOR</label>
                                                        <input type="text" class="form-control" id="txtGrosReg03" name="txtGrosReg03">
                                                    </div>
                                                </div>
                                            </div>
                                            
                                            <div class="row" >
                                                <div class="col-12">
                                                    <div class="form-group">
                                                        <h4>
                                                            <i class="fas fa-weight"></i> EQUIPO
                                                            <small> -Donde se realizo la prueba</small>
                                                        </h4>
                                                    </div>
                                                </div>  
                                            </div> 
                                            <div class="row">
                                                <!-- /.
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label>Descripcion Equipo</label>
                                                    </div>
                                                </div>
                                                -->
                                                <input type="hidden" class="form-control" id="txtDescriequipoReg02" name="txtDescriequipoReg02">
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label>Tipo de Equipo</label>
                                                        <select class="form-control select2bs4" id="cboTipoequipoReg02" name="cboTipoequipoReg02" style="width: 100%;">
                                                            <option value="" selected="selected">Cargando...</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label>Medio de Calentamiento</label>
                                                        <select class="form-control select2bs4" id="cboMediocalientaReg02" name="cboMediocalientaReg02" style="width: 100%;">
                                                            <option value="" selected="selected">Cargando...</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label>Fabricante</label>
                                                        <select class="form-control select2bs4" id="cboFabricanteReg02" name="cboFabricanteReg02" style="width: 100%;">
                                                            <option value="" selected="selected">Cargando...</option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>              
                                            <div class="row">
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label># o IDENTIFICACIÓN DEL EQUIPO</label>
                                                        <input type="text" class="form-control" id="txtIdenequipoReg02" name="txtIdenequipoReg02">
                                                    </div>
                                                </div>
                                            </div>            
        
                                        </fieldset>
                                        <fieldset class="scheduler-border" id="06Registro">
                                            <legend class="scheduler-border text-primary">REGISTROS</legend>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label>Nombre del Producto</label>
                                                        <input type="text" class="form-control" id="txtNombprodReg06" name="txtNombprodReg06">
                                                    </div>
                                                </div>
                                                <div class="col-md-2">
                                                    <div class="form-group">
                                                        <label>Tipo de Producto</label>
                                                        <select class="form-control select2bs4" id="cboTipoprodReg06" name="cboTipoprodReg06" style="width: 100%;">
                                                            <option value="" selected="selected">Cargando...</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-md-2">
                                                    <div class="form-group" id="divphmp06">
                                                        <label>pH materia prima</label>
                                                        <input type="text" class="form-control" id="txtPHmatprimaReg06" name="txtPHmatprimaReg06">
                                                    </div>
                                                </div>
                                                <div class="col-md-2">
                                                    <div class="form-group" id="divphpf06">
                                                        <label>pH producto final</label>
                                                        <input type="text" class="form-control" id="txtPHprodfinReg06" name="txtPHprodfinReg06">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-2">
                                                    <div class="form-group">
                                                        <label>Lleva Partículas?</label>
                                                        <select class="form-control select2bs4" id="cbollevapartReg06" name="cbollevapartReg06" style="width: 100%;">
                                                            <option value="" selected="selected">::Elegir</option>
                                                            <option value="S">SI</option>
                                                            <option value="N">NO</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="form-group" id="divparticula06">
                                                        <label>Partículas</label>
                                                        <select class="form-control select2bs4" id="cboParticulasReg06" name="cboParticulasReg06" style="width: 100%;">
                                                            <option value="" selected="selected">Cargando...</option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                            
                                            <div id="regEquipos06" style="border-top: 1px solid #ccc; padding-top: 10px;">
                                                <div class="row">
                                                    <div class="col-6">
                                                        <h4>
                                                            <i class="fas fa-weight"></i> BUSCAR
                                                            <small> - Equipos :: </small>
                                                            <a data-toggle="modal" data-target="#modalBuscaequipo06" id="Buscaequipo06" name="Buscaequipo06"  class="btn btn-default" style="color:#088A08; cursor:pointer;"><i class="fas fa-search"></i></a>
                                                        </h4>
                                                    </div> 
                                                    <div class="col-6">                          
                                                        <div class="form-group text-right">                                                                          
                                                            <a class="btn btn-default btn-sm" id="addequipo06" name="addequipo06" style="visibility:visible"><img src='<?php echo base_url() ?>assets/images/details_open.png' border="0" align="absmiddle"> Tratamiento Térmico</a> 
                                                            <a class="btn btn-default btn-sm" id="addllenadora06" name="addllenadora06" style="visibility:visible"><img src='<?php echo base_url() ?>assets/images/details_open.png' border="0" align="absmiddle"> Envasado - Llenadora</a> 
                                                        </div>                        
                                                    </div>
                                                </div> 
                                                <div class="row"> 
                                                    <div class="col-12">             
                                                        <div id="CreaReg04"> 
                                                            <fieldset class="scheduler-border">
                                                                <legend class="scheduler-border text-primary">Nuevo Equipo de Tratamiento Térmico</legend>
                                                            <form class="form-horizontal" id="frmCreaReg04" name="frmCreaReg04" action="" method="POST" enctype="multipart/form-data" role="form"> 
                                                                
                                                                <input type="hidden" id="mhdnIdptreg04" name="mhdnIdptreg04"> 
                                                                <input type="hidden" id="mhdnIdptregprod04" name="mhdnIdptregprod04">       
                                                                <input type="hidden" id="mhdnIdptregequipo04" name="mhdnIdptregequipo04"> <!-- ID -->
                                                                <input type="hidden" id="mhdnAccionReg04" name="mhdnAccionReg04">
                                                                <input type="hidden" id="mhdnRegAdjunto" name="mhdnRegAdjunto" value="4"> 
                                                                            
                                                                <div class="form-group">
                                                                    <div class="row">
                                                                        <div class="col-md-4">
                                                                            <div class="form-group">
                                                                                <label>Línea de Proceso</label>
                                                                                <input type="text" class="form-control" id="txtDescriequipoReg04" name="txtDescriequipoReg04">
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-md-4">
                                                                            <div class="form-group">
                                                                                <label>Tipo de Equipo</label>
                                                                                <select class="form-control select2bs4" id="cboTipoequipoReg04" name="cboTipoequipoReg04" style="width: 100%;">
                                                                                    <option value="" selected="selected">Cargando...</option>
                                                                                </select>
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-md-4">
                                                                            <div class="form-group">
                                                                                <label>Fabricante</label>
                                                                                <select class="form-control select2bs4" id="cboFabricanteReg04" name="cboFabricanteReg04" style="width: 100%;">
                                                                                    <option value="" selected="selected">Cargando...</option>
                                                                                </select>
                                                                            </div>
                                                                        </div>
                                                                    </div>               
                                                                </div>
                                                                <div class="form-group">
                                                                    <div class="row">
                                                                        <div class="col-sm-12 text-right"> 
                                                                            <button type="button" class="btn btn-success" id="btnGrabarReg04"><i class="fas fa-save"></i> Guardar</button>
                                                                            <button type="button" class="btn btn-primary" id="btnCancelarReg04"><i class="far fa-window-close"></i> Cancelar</button>
                                                                        </div>
                                                                    </div>              
                                                                </div>
                                                            </form>
                                                            </fieldset>
                                                        </div> 
                                                        <div id="CreaReg05"> 
                                                            <fieldset class="scheduler-border">
                                                                <legend class="scheduler-border text-primary">Nuevo Equipo para el Envasado - Llenadora</legend>
                                                            <form class="form-horizontal" id="frmCreaReg05" name="frmCreaReg05" action="" method="POST" enctype="multipart/form-data" role="form"> 
                                                                
                                                                <input type="hidden" id="mhdnIdptreg05" name="mhdnIdptreg05"> 
                                                                <input type="hidden" id="mhdnIdptregprod05" name="mhdnIdptregprod05">       
                                                                <input type="hidden" id="mhdnIdptregequipo05" name="mhdnIdptregequipo05"> <!-- ID -->
                                                                <input type="hidden" id="mhdnAccionReg05" name="mhdnAccionReg05">
                                                                <input type="hidden" id="mhdnRegAdjunto" name="mhdnRegAdjunto" value="5"> 
                                                                            
                                                                <div class="form-group">
                                                                    <div class="row">
                                                                        <div class="col-md-4">
                                                                            <div class="form-group">
                                                                                <label>Tipo de Equipo</label>
                                                                                <select class="form-control select2bs4" id="cboTipoequipoReg05" name="cboTipoequipoReg05" style="width: 100%;">
                                                                                    <option value="" selected="selected">Cargando...</option>
                                                                                </select>
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-md-4">
                                                                            <div class="form-group">
                                                                                <label>Fabricante</label>
                                                                                <select class="form-control select2bs4" id="cboFabricanteReg05" name="cboFabricanteReg05" style="width: 100%;">
                                                                                    <option value="" selected="selected">Cargando...</option>
                                                                                </select>
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-md-4">
                                                                            <div class="form-group">
                                                                                <label>Modelo Llenadora</label>
                                                                                <input type="text" class="form-control" id="txtModellenaReg05" name="txtModellenaReg05">
                                                                            </div>
                                                                        </div>
                                                                    </div>               
                                                                </div>  
                                                                <div class="form-group">
                                                                    <div class="row"> 
                                                                        <div class="col-md-4">
                                                                            <div class="form-group">
                                                                                <label>Identificación de la llenadora</label>
                                                                                <input type="text" class="form-control" id="txtIdllenaReg05" name="txtIdllenaReg05">
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-md-4">
                                                                            <div class="form-group">
                                                                                <label>Nro Llenadoras</label>
                                                                                <input type="text" class="form-control" id="txtNrollenaReg05" name="txtNrollenaReg05">
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-md-4">
                                                                            <div class="form-group">
                                                                                <label>Volumen Llenado (L)</label>
                                                                                <input type="text" class="form-control" id="txtVolullenaReg05" name="txtVolullenaReg05">
                                                                            </div>
                                                                        </div>
                                                                    </div>              
                                                                </div>
                                                                <div class="form-group">
                                                                    <div class="row">
                                                                        <div class="col-md-3">
                                                                            <div class="form-group">
                                                                                <label>Dimensiones</label>
                                                                                <select class="form-control select2bs4" id="cboDimenReg05" name="cboDimenReg05" style="width: 100%;">
                                                                                    <option value="" selected="selected">::Elegir</option>
                                                                                    <option value="2">En mm</option>
                                                                                    <option value="3">En 16vos</option>
                                                                                </select>
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-md-3">
                                                                            <div class="form-group">
                                                                                <label>Diámetro/Ancho</label>
                                                                                <input type="text" class="form-control" id="txtDiamReg05" name="txtDiamReg05">
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-md-3">
                                                                            <div class="form-group">
                                                                                <label>Altura/Largo</label>
                                                                                <input type="text" class="form-control" id="txtAltuReg05" name="txtAltuReg05">
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-md-3">
                                                                            <div class="form-group">
                                                                                <label>Grosor</label>
                                                                                <input type="text" class="form-control" id="txtGrosReg05" name="txtGrosReg05">
                                                                            </div>
                                                                        </div>
                                                                    </div>              
                                                                </div>
                                                                <div class="form-group">
                                                                    <div class="row">
                                                                        <div class="col-sm-12 text-right"> 
                                                                            <button type="button" class="btn btn-success" id="btnGrabarReg05"><i class="fas fa-save"></i> Guardar</button>
                                                                            <button type="button" class="btn btn-primary" id="btnCancelarReg05"><i class="far fa-window-close"></i> Cancelar</button>
                                                                        </div>
                                                                    </div>              
                                                                </div>
                                                            </form>
                                                            </fieldset>
                                                        </div>                          
                                                    </div>
                                                </div> 
                                                <div class="row"> 
                                                    <div class="col-12">                                                 
                                                        <div class="form-group" style="padding-top: 10x;">
                                                            <table id="tblListReg06equipo" class="table table-striped table-bordered" style="width:100%">
                                                                <thead>
                                                                <tr>
                                                                    <th>Equipo</th>
                                                                    <th>Descripcion Equipo</th>
                                                                    <th>Tipo Equipo</th>
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
                                        <fieldset class="scheduler-border" id="08Registro">
                                            <legend class="scheduler-border text-primary">REGISTROS</legend>
                                            <div class="row">
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label>Nombre del Producto</label>
                                                        <input type="text" class="form-control" id="txtNombprodReg08" name="txtNombprodReg08">
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label>Tipo de Producto</label>
                                                        <select class="form-control select2bs4" id="cboTipoprodReg08" name="cboTipoprodReg08" style="width: 100%;">
                                                            <option value="" selected="selected">Cargando...</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-md-2">
                                                    <div class="form-group" id="divphmp08">
                                                        <label>pH materia prima</label>
                                                        <input type="text" class="form-control" id="txtPHmatprimaReg08" name="txtPHmatprimaReg08">
                                                    </div>
                                                </div>
                                                <div class="col-md-2">
                                                    <div class="form-group" id="divphpf08">
                                                        <label>pH producto final</label>
                                                        <input type="text" class="form-control" id="txtPHprodfinReg08" name="txtPHprodfinReg08">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label>Envase</label>
                                                        <select class="form-control select2bs4" id="cboEnvaseReg08" name="cboEnvaseReg08" style="width: 100%;">
                                                            <option value="" selected="selected">Cargando...</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-md-2">
                                                    <div class="form-group">
                                                        <label>Dimensiones</label>
                                                        <select class="form-control select2bs4" id="cboDimenReg08" name="cboDimenReg08" style="width: 100%;">
                                                            <option value="" selected="selected">::Elegir</option>
                                                            <option value="2">En mm</option>
                                                            <option value="3">En 16vos</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-md-2">
                                                    <div class="form-group">
                                                        <label>Diámetro/Ancho</label>
                                                        <input type="text" class="form-control" id="txtDiamReg08" name="txtDiamReg08">
                                                    </div>
                                                </div>
                                                <div class="col-md-2">
                                                    <div class="form-group">
                                                        <label>Altura/Largo</label>
                                                        <input type="text" class="form-control" id="txtAltuReg08" name="txtAltuReg08">
                                                    </div>
                                                </div>
                                                <div class="col-md-2">
                                                    <div class="form-group">
                                                        <label>Grosor</label>
                                                        <input type="text" class="form-control" id="txtGrosReg08" name="txtGrosReg08">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-2">
                                                    <div class="form-group">
                                                        <label>Lleva Partículas?</label>
                                                        <select class="form-control select2bs4" id="cbollevapartReg08" name="cbollevapartReg08" style="width: 100%;">
                                                            <option value="" selected="selected">::Elegir</option>
                                                            <option value="S">SI</option>
                                                            <option value="N">NO</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-md-4" id="divparticula08">
                                                    <div class="form-group">
                                                        <label>Partículas</label>
                                                        <select class="form-control select2bs4" id="cboParticulasReg08" name="cboParticulasReg08" style="width: 100%;">
                                                            <option value="" selected="selected">Cargando...</option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                            
                                            <div id="regEquipos08" style="border-top: 1px solid #ccc; padding-top: 10px;">
                                                <div class="row">
                                                    <div class="col-6">
                                                        <h4>
                                                            <i class="fas fa-weight"></i> BUSCAR
                                                            <small> - Equipos :: </small>
                                                            <a data-toggle="modal" data-target="#modalBuscaequipo08" id="Buscaequipo08" name="Buscaequipo08"  class="btn btn-default" style="color:#088A08; cursor:pointer;"><i class="fas fa-search"></i></a>
                                                        </h4>
                                                    </div> 
                                                    <div class="col-6">                          
                                                        <div class="form-group text-right">                                                                          
                                                            <a class="btn btn-default btn-sm" id="addequipo08" name="addequipo08" style="visibility:visible"><img src='<?php echo base_url() ?>assets/images/details_open.png' border="0" align="absmiddle"> Tratamiento Térmico</a> 
                                                        </div>                        
                                                    </div>
                                                </div> 
                                                <div class="row"> 
                                                    <div class="col-12">             
                                                        <div id="CreaReg07"> 
                                                            <fieldset class="scheduler-border">
                                                                <legend class="scheduler-border text-primary">Nuevo Equipo de Tratamiento Térmico</legend>
                                                            <form class="form-horizontal" id="frmCreaReg07" name="frmCreaReg07" action="" method="POST" enctype="multipart/form-data" role="form"> 
                                                                
                                                                <input type="hidden" id="mhdnIdptreg07" name="mhdnIdptreg07"> 
                                                                <input type="hidden" id="mhdnIdptregprod07" name="mhdnIdptregprod07">       
                                                                <input type="hidden" id="mhdnIdptregequipo07" name="mhdnIdptregequipo07"> <!-- ID -->
                                                                <input type="hidden" id="mhdnAccionReg07" name="mhdnAccionReg07">
                                                                <input type="hidden" id="mhdnRegAdjunto" name="mhdnRegAdjunto" value="7"> 
                                                                            
                                                                <div class="form-group">
                                                                    <div class="row">
                                                                        <!--  
                                                                        <div class="col-md-4">
                                                                            <div class="form-group">
                                                                                <label>Descripcion Equipo</label>
                                                                            </div>
                                                                        </div>
                                                                        -->
                                                                        <input type="hidden" class="form-control" id="txtDescriequipoReg07" name="txtDescriequipoReg07">
                                                                        <div class="col-md-4">
                                                                            <div class="form-group">
                                                                                <label>Tipo de Equipo</label>
                                                                                <select class="form-control select2bs4" id="cboTipoequipoReg07" name="cboTipoequipoReg07" style="width: 100%;">
                                                                                    <option value="" selected="selected">Cargando...</option>
                                                                                </select>
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-md-4">
                                                                            <div class="form-group">
                                                                                <label>Fabricante</label>
                                                                                <select class="form-control select2bs4" id="cboFabricanteReg07" name="cboFabricanteReg07" style="width: 100%;">
                                                                                    <option value="" selected="selected">Cargando...</option>
                                                                                </select>
                                                                            </div>
                                                                        </div>
                                                                    </div>               
                                                                </div>
                                                                <div class="form-group">
                                                                    <div class="row">
                                                                        <div class="col-sm-12 text-right"> 
                                                                            <button type="button" class="btn btn-success" id="btnGrabarReg07"><i class="fas fa-save"></i> Guardar</button>
                                                                            <button type="button" class="btn btn-primary" id="btnCancelarReg07"><i class="far fa-window-close"></i> Cancelar</button>
                                                                        </div>
                                                                    </div>              
                                                                </div>
                                                            </form>
                                                            </fieldset>
                                                        </div>                          
                                                    </div>
                                                </div> 
                                                <div class="row"> 
                                                    <div class="col-12">                                                 
                                                        <div class="form-group" style="padding-top: 10x;">
                                                            <table id="tblListReg08equipo" class="table table-striped table-bordered" style="width:100%">
                                                                <thead>
                                                                <tr>
                                                                    <th>Equipo</th>
                                                                    <th>Descripcion Equipo</th>
                                                                    <th>Tipo Equipo</th>
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
                                        <fieldset class="scheduler-border" id="09Registro">
                                            <legend class="scheduler-border text-primary">REGISTROS</legend>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label>Tipo de Recinto</label>
                                                        <select class="form-control" id="cboTiporecintoReg09" name="cboTiporecintoReg09" style="width: 100%;">
                                                            <option value="" selected="selected">Cargando...</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group" id="divEvalrec">
                                                        <label>Evaluación</label>
                                                        <select class="form-control" id="cboevaluacionReg09" name="cboevaluacionReg09" style="width: 100%;">
                                                            <option value="Temperatura y Humedad" selected="selected">Temperatura y Humedad</option>
                                                            <option value="Temperatura" >Temperatura</option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-3">
                                                    <div class="form-group">
                                                        <label>Nro. de Recintos/Equipos</label>
                                                        <input type="text" class="form-control" id="txtnrorecintosReg09" name="txtnrorecintosReg09">
                                                    </div>
                                                </div>
                                                <div class="col-md-3">
                                                    <div class="form-group">
                                                        <label>Área Evaluada m2</label>
                                                        <input type="text" class="form-control" id="txtareaevalReg09" name="txtareaevalReg09">
                                                    </div>
                                                </div>
                                                <div class="col-md-3">
                                                    <div class="form-group">
                                                        <label>Nro Posiciones</label>
                                                        <input type="text" class="form-control" id="txtNroposReg09" name="txtNroposReg09">
                                                    </div>
                                                </div>
                                                <div class="col-md-3">
                                                    <div class="form-group">
                                                        <label>Vol. Alma./Enfria m3</label>
                                                        <input type="text" class="form-control" id="txtNrovolalmaReg09" name="txtNrovolalmaReg09">
                                                    </div>
                                                </div>
                                            </div>
                                        </fieldset>
                                        <fieldset class="scheduler-border" id="10Registro">
                                            <legend class="scheduler-border text-primary">REGISTROS</legend>
                                            <div class="row">
                                                <div class="col-md-3">
                                                    <div class="form-group">
                                                        <label>Nro. de Equipos</label>
                                                        <input type="text" class="form-control" id="txtnrorecintosReg10" name="txtnrorecintosReg10">
                                                    </div>
                                                </div>
                                                <div class="col-md-3">
                                                    <div class="form-group">
                                                        <label>Área Evaluada m2</label>
                                                        <input type="text" class="form-control" id="txtareaevalReg10" name="txtareaevalReg10">
                                                    </div>
                                                </div>
                                                <div class="col-md-3">
                                                    <div class="form-group">
                                                        <label>Nro Posiciones</label>
                                                        <input type="text" class="form-control" id="txtNroposReg10" name="txtNroposReg10">
                                                    </div>
                                                </div>
                                                <div class="col-md-3">
                                                    <div class="form-group">
                                                        <label>Vol. Enfriamiento m3</label>
                                                        <input type="text" class="form-control" id="txtNrovolalmaReg10" name="txtNrovolalmaReg10">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label>Nombre del Producto</label>
                                                        <input type="text" class="form-control" id="txtNombprodReg10" name="txtNombprodReg10">
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label>Forma de Producto</label>
                                                        <select class="form-control select2bs4" id="cboFormaprodReg10" name="cboFormaprodReg10" style="width: 100%;">
                                                            <option value="" selected="selected">Cargando...</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="form-group">                                                        
                                                        <label>Envase</label>
                                                        <select class="form-control select2bs4" id="cboEnvaseReg10" name="cboEnvaseReg10" style="width: 100%;">
                                                            <option value="" selected="selected">Cargando...</option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                        </fieldset>
                                        <fieldset class="scheduler-border" id="11Registro">
                                            <legend class="scheduler-border text-primary">REGISTROS</legend>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group">                                                        
                                                        <label>Recinto o Equipo</label>
                                                        <select class="form-control select2bs4" id="cboRecintoReg11" name="cboRecintoReg11" style="width: 100%;">
                                                            <option value="CÁMARAS DE REFRIGERACIÓN" selected="selected">CÁMARAS DE REFRIGERACIÓN</option>
                                                            <option value="CÁMARAS DE CONGELACIÓN">CÁMARAS DE CONGELACIÓN</option>
                                                            <option value="TÚNELES DE CONGELACIÓN">TÚNELES DE CONGELACIÓN</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label># o IDENTIFICACIÓN DEL EQUIPO</label>
                                                        <input type="text" class="form-control" id="txtIdenequipoReg11" name="txtIdenequipoReg11">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label>Nombre del Producto</label>
                                                        <input type="text" class="form-control" id="txtNombprodReg11" name="txtNombprodReg11">
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label>Forma de Producto</label>
                                                        <select class="form-control select2bs4" id="cboFormaprodReg11" name="cboFormaprodReg11" style="width: 100%;">
                                                            <option value="" selected="selected">Cargando...</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="form-group">                                                        
                                                        <label>Envase</label>
                                                        <select class="form-control select2bs4" id="cboEnvaseReg11" name="cboEnvaseReg11" style="width: 100%;">
                                                            <option value="" selected="selected">Cargando...</option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>                                            
                                        </fieldset>
                                        <fieldset class="scheduler-border" id="12Registro">
                                            <legend class="scheduler-border text-primary">REGISTROS</legend>
                                            <div class="row">
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label>Recinto</label>
                                                        <select class="form-control select2bs4" id="cboRecintoReg12" name="cboRecintoReg12" style="width: 100%;">
                                                            <option value="" selected="selected">Cargando...</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label>Área Evaluada m2</label>
                                                        <input type="text" class="form-control" id="txtareaevalReg12" name="txtareaevalReg12">
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="form-group">                                                        
                                                        <label>Medio de Calentamiento</label>
                                                        <select class="form-control select2bs4" id="cboMediocalReg12" name="cboMediocalReg12" style="width: 100%;">
                                                            <option value="" selected="selected">Cargando...</option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-3">
                                                    <div class="form-group">
                                                        <label>Nro. de Recintos</label>
                                                        <input type="text" class="form-control" id="txtnrorecintosReg12" name="txtnrorecintosReg12">
                                                    </div>
                                                </div>
                                                <div class="col-md-3">
                                                    <div class="form-group">
                                                        <label>Nro. de Coches/Parrillas por</label>
                                                        <input type="text" class="form-control" id="txtnrocochesReg12" name="txtnrocochesReg12">
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label># o Identificación del Equipo</label>
                                                        <input type="text" class="form-control" id="txtIdenrecintoReg12" name="txtIdenrecintoReg12">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-8">
                                                    <div class="form-group">
                                                        <label>Nombre del Producto</label>
                                                        <input type="text" class="form-control" id="txtnombproductoReg12" name="txtnombproductoReg12">
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label>Presentación</label>
                                                        <select class="form-control select2bs4" id="cboPresentaReg12" name="cboPresentaReg12" style="width: 100%;">
                                                            <option value="" selected="selected">Cargando...</option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                        </fieldset>
                                        <fieldset class="scheduler-border" id="13Registro">
                                            <legend class="scheduler-border text-primary">REGISTROS</legend>
                                            <div class="row">
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label>Tipo de Equipo</label>
                                                        <select class="form-control select2bs4" id="cboTipoequipoReg13" name="cboTipoequipoReg13" style="width: 100%;">
                                                            <option value="" selected="selected">Cargando...</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label>Fabricante</label>
                                                        <select class="form-control select2bs4" id="cboFabricanteReg13" name="cboFabricanteReg13" style="width: 100%;">
                                                            <option value="" selected="selected">Cargando...</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label>Capacidad</label>
                                                        <input type="text" class="form-control" id="txtCapacidadReg13" name="txtCapacidadReg13">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-3">
                                                    <div class="form-group">                                                        
                                                        <label>Medio de Calentamiento</label>
                                                        <select class="form-control select2bs4" id="cboMediocalReg13" name="cboMediocalReg13" style="width: 100%;">
                                                            <option value="" selected="selected">Cargando...</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-md-3">
                                                    <div class="form-group">
                                                        <label>Nro. de Equipos</label>
                                                        <input type="text" class="form-control" id="txtnrorecintosReg13" name="txtnrorecintosReg13">
                                                    </div>
                                                </div>
                                                <div class="col-md-3">
                                                    <div class="form-group">
                                                        <label>Nro. de Coches/Parrillas por</label>
                                                        <input type="text" class="form-control" id="txtnrocochesReg13" name="txtnrocochesReg13">
                                                    </div>
                                                </div>
                                                <div class="col-md-3">
                                                    <div class="form-group">
                                                        <label># o Identificación del Equipo</label>
                                                        <input type="text" class="form-control" id="txtIdenequipoReg13" name="txtIdenequipoReg13">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-8">
                                                    <div class="form-group">
                                                        <label>Nombre del Producto</label>
                                                        <input type="text" class="form-control" id="txtnombproductReg13" name="txtnombproductReg13">
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label>Presentación</label>
                                                        <select class="form-control select2bs4" id="cboPresentaReg13" name="cboPresentaReg13" style="width: 100%;">
                                                            <option value="" selected="selected">Cargando...</option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                        </fieldset>
                                        <fieldset class="scheduler-border" id="14Registro">
                                            <legend class="scheduler-border text-primary">REGISTROS</legend>
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <label>Descripcion de lo Ocurrido</label>
                                                        <input type="text" class="form-control" id="txtDescriocurridoReg14" name="txtDescriocurridoReg14">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label>Tipo de Conclusión</label>
                                                        <select class="form-control select2bs4" id="cboTipoconcluReg14" name="cboTipoconcluReg14" style="width: 100%;">
                                                            <option value="ALCANZO ESTERILIDAD COMERCIAL" selected="selected">ALCANZO ESTERILIDAD COMERCIAL</option>
                                                            <option value="MINIMO POR SALUD PUBLICA" >MINIMO POR SALUD PUBLICA</option>
                                                            <option value="NO DEBE SER COMERCIALIZADO" >NO DEBE SER COMERCIALIZADO</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-md-8">
                                                    <div class="form-group">
                                                        <label>Observaciones y Comentarios</label>
                                                        <input type="text" class="form-control" id="txtComentocurridoReg14" name="txtComentocurridoReg14">
                                                    </div>
                                                </div>
                                            </div>
                                            
                                            <div class="row">
                                                <div class="col-md-8">
                                                    <div class="form-group">
                                                        <label>Nombre del Producto</label>
                                                        <input type="text" class="form-control" id="txtNombprodReg14" name="txtNombprodReg14">
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label>Lotes Involucrados</label>
                                                        <input type="text" class="form-control" id="txtLotesReg14" name="txtLotesReg14">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label>Tipo de Producto</label>
                                                        <select class="form-control select2bs4" id="cboTipoprodReg14" name="cboTipoprodReg14" style="width: 100%;">
                                                            <option value="" selected="selected">Cargando...</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-md-3" id="divphmp14">
                                                    <div class="form-group">
                                                        <label>pH materia prima</label>
                                                        <input type="text" class="form-control" id="txtPHmatprimaReg14" name="txtPHmatprimaReg14">
                                                    </div>
                                                </div>
                                                <div class="col-md-3" id="divphpf14">
                                                    <div class="form-group">
                                                        <label>pH producto final</label>
                                                        <input type="text" class="form-control" id="txtPHprodfinReg14" name="txtPHprodfinReg14">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-2">
                                                    <div class="form-group">
                                                        <label>LLEVA PARTÍCULAS?</label>
                                                        <select class="form-control select2bs4" id="cbollevapartReg14" name="cbollevapartReg14" style="width: 100%;">
                                                            <option value="" selected="selected">::Elegir</option>
                                                            <option value="S">SI</option>
                                                            <option value="N">NO</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-md-4" id="divparticula14">
                                                    <div class="form-group">
                                                        <label>PARTÍCULAS</label>
                                                        <select class="form-control select2bs4" id="cboParticulasReg14" name="cboParticulasReg14" style="width: 100%;">
                                                            <option value="" selected="selected">Cargando...</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-md-2" id="divliquido14">
                                                    <div class="form-group">
                                                        <label>LÍQUIDO DE GOBIERNO</label>
                                                        <select class="form-control select2bs4" id="txtLiqgobReg14" name="txtLiqgobReg14" style="width: 100%;">
                                                            <option value="" selected="selected">Cargando...</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label>ENVASE</label>
                                                        <select class="form-control select2bs4" id="cboEnvaseReg14" name="cboEnvaseReg14" style="width: 100%;">
                                                            <option value="" selected="selected">Cargando...</option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-2">
                                                    <div class="form-group">
                                                        <label>DIMENSIONES</label>
                                                        <select class="form-control select2bs4" id="cboDimenReg14" name="cboDimenReg14" style="width: 100%;">
                                                            <option value="" selected="selected">::Elegir</option>
                                                            <option value="2">En mm</option>
                                                            <option value="3">En 16vos</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-md-2">
                                                    <div class="form-group">
                                                        <label>DIÁMETRO/ANCHO</label>
                                                        <input type="text" class="form-control" id="txtDiamReg14" name="txtDiamReg14">
                                                    </div>
                                                </div>
                                                <div class="col-md-2">
                                                    <div class="form-group">
                                                        <label>ALTURA/LARGO</label>
                                                        <input type="text" class="form-control" id="txtAltuReg14" name="txtAltuReg14">
                                                    </div>
                                                </div>
                                                <div class="col-md-2">
                                                    <div class="form-group">
                                                        <label>GROSOR</label>
                                                        <input type="text" class="form-control" id="txtGrosReg14" name="txtGrosReg14">
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label># DEVCAL</label>
                                                        <input type="text" class="form-control" id="txtDevcalReg14" name="txtDevcalReg14">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label>Descripcion Equipo</label>
                                                        <input type="text" class="form-control" id="txtDescriequipoReg14" name="txtDescriequipoReg14">
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label>Tipo de Equipo</label>
                                                        <select class="form-control select2bs4" id="cboTipoequipoReg14" name="cboTipoequipoReg14" style="width: 100%;">
                                                            <option value="" selected="selected">Cargando...</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label>Medio de Calentamiento</label>
                                                        <select class="form-control select2bs4" id="cboMediocalientaReg14" name="cboMediocalientaReg14" style="width: 100%;">
                                                            <option value="" selected="selected">Cargando...</option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label>Fabricante</label>
                                                        <select class="form-control select2bs4" id="cboFabricanteReg14" name="cboFabricanteReg14" style="width: 100%;">
                                                            <option value="" selected="selected">Cargando...</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-md-8">
                                                    <div class="form-group">
                                                        <label># o IDENTIFICACIÓN DEL EQUIPO</label>
                                                        <input type="text" class="form-control" id="txtIdenequipoReg14" name="txtIdenequipoReg14">
                                                    </div>
                                                </div>
                                            </div>
                                        </fieldset>
                                        <fieldset class="scheduler-border" id="15Registro">
                                            <legend class="scheduler-border text-primary">REGISTROS</legend>
                                            <div class="row">
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label>Servicio a Evaluar</label>
                                                        <select class="form-control select2bs4" id="cboserviciosReg15" name="cboserviciosReg15" style="width: 100%;">
                                                            <option value="" selected="selected">Cargando...</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-md-8">
                                                    <div class="form-group">
                                                        <label>Equipo(s)</label>
                                                        <input type="text" class="form-control" id="txtEquiposReg15" name="txtEquiposReg15">
                                                    </div>
                                                </div>
                                            </div> 
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <label>Productos - Líneas</label>
                                                        <input type="text" class="form-control" id="txtProdLineaReg15" name="txtProdLineaReg15">
                                                    </div>
                                                </div>
                                            </div>                                            
                                        </fieldset>
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
</section>
<!-- /.Main content -->

<!-- /.modal-crear-informe --> 
<div class="modal fade" id="modalCreaInfor" data-backdrop="static" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <form class="form-horizontal" id="frmCreaInfor" name="frmCreaInfor" action="<?= base_url('pt/cinforme/setinforme')?>" method="POST" enctype="multipart/form-data" role="form"> 

        <div class="modal-header text-center bg-success">
            <h4 class="modal-title w-100 font-weight-bold">Registro de Informe</h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>

        <div class="modal-body">  
            <p class="statusMsg"></p>           
            <input type="hidden" id="mhdnIdInfor" name="mhdnIdInfor"> <!-- ID -->
            <input type="hidden" id="mhdnAccionInfor" name="mhdnAccionInfor">

            <input type="hidden" id="mhdnIdpteval" name="mhdnIdpteval">
            <input type="hidden" id="mhdnIdresponsable" name="mhdnIdresponsable">
                        
            <div class="form-group">
                <div class="row">                    
                    <div class="col-sm-4">
                        <div class="text-info">Fecha Informe</div>
                        <div class="input-group date" id="mtxtFreginforme" data-target-input="nearest">
                            <input type="text" id="mtxtFinfor" name="mtxtFinfor" class="form-control datetimepicker-input" data-target="#mtxtFreginforme"/>
                            <div class="input-group-append" data-target="#mtxtFreginforme" data-toggle="datetimepicker">
                                <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                            </div>
                        </div>                        
                    </div>   
                    <div class="col-sm-4">                              
                        <div class="checkbox" id="lbchkinf">
                            <div class="text-info">Nro Informe  &nbsp;&nbsp;
                                <b><input type="checkbox" id="chkNroAntiguo" name="chkNroAntiguo" > Antiguo</b>
                            </div>
                        </div>  
                        <div>                            
                            <input type="text" name="mtxtNroinfor" class="form-control" id="mtxtNroinfor">
                            <span style="color: #b94a48">Ej. 0100-2018/PT/FS</span>
                            <br>
                            <span style="color: #b94a48">Ej. 0100B-2018/PT/FS</span>
                        </div>
                    </div>           
                    <div class="col-sm-4"> 
                        <div class="text-info">Responsable<span style="color: #FD0202">*</span></div> 
                        <div>                            
                            <select class="form-control" id="mcboContacInfor" name="mcboContacInfor" >
                                <option value=1>SU-TZE LIU</option>
                                <option value=42>CARLOS VILLACORTA</option>
                                <option value=64>JOSE OLIDEN</option>
                            </select>
                        </div>
                    </div> 
                </div>                
            </div> 
            <div class="form-group">
                <div class="row">                
                    <div class="col-sm-12">
                        <div class="text-info">Archivo</div>                        
                        <div class="input-group">
                            <input class="form-control" type="text" name="mtxtNomarchinfor" id="mtxtNomarchinfor">                            
                            <span class="input-group-append">                                
                                <div class="fileUpload btn btn-secondary">
                                    <span>Subir Archivo</span>
                                    <input type="file" class="upload" id="mtxtArchivoinfor" name="mtxtArchivoinfor" onchange="escogerArchivo()"/>                      
                                </div> 
                            </span>  
                        </div>
                        <span style="color: red; font-size: 13px;">+ Los archivos deben estar en formato pdf, docx o xlsx y no deben pesar mas de 60 MB</span>                        
                        <input type="hidden" name="mtxtRutainfor" id="mtxtRutainfor">
                        <input type="hidden" name="mtxtArchinfor" id="mtxtArchinfor">
                        <input type="hidden" name="sArchivo" id="sArchivo" value="N"> 
                    </div> 
                </div>
            </div>
            <div class="form-group">
                <div class="row">                
                    <div class="col-sm-12">
                        <div class="text-info">Comentario <span style="color: #FD0202">*</span></div>
                        <div>   
                            <textarea class="form-control" cols="20" data-val="true" data-val-length="No debe superar los 500 caracteres." data-val-length-max="500" id="mtxtDetaInfor" name="mtxtDetaInfor" rows="2" data-val-maxlength-max="500" data-validation="required"></textarea>
                            <span class="help-inline" style="padding-left:0px; color:#999; font-size:0.9em;">Caracteres: 0 / 500</span>    
                        </div> 
                    </div> 
                </div>                
            </div>               
        </div>

        <div class="modal-footer justify-content-between" style="background-color: #dff0d8;">
            <button type="reset" class="btn btn-default" id="mbtnCCreaInfor" data-dismiss="modal">Cancelar</button>
            <button type="submit" class="btn btn-info" id="mbtnGCreaInfor">Grabar</button>
        </div>
      </form>
    </div>
  </div>
</div>  
<!-- /.modal-->

<!-- /.modal-editar-informe --> 
<div class="modal fade" id="modalEditInfor" data-backdrop="static" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <form class="form-horizontal" id="frmEditInfor" name="frmEditInfor" action="<?= base_url('pt/cinforme/setinformeedit')?>" method="POST" enctype="multipart/form-data" role="form"> 

        <div class="modal-header text-center bg-success">
            <h4 class="modal-title w-100 font-weight-bold">Registro de Informe</h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>

        <div class="modal-body">  
            <p class="statusMsg"></p>           
            <input type="hidden" id="mhdnIdInforedit" name="mhdnIdInforedit"> <!-- ID -->
            <input type="hidden" id="mhdnAccionInforedit" name="mhdnAccionInforedit">

            <input type="hidden" id="mhdnIdptevaledit" name="mhdnIdptevaledit">
            <input type="hidden" id="mhdnIdresponsableedit" name="mhdnIdresponsableedit">
                        
            <div class="form-group">
                <div class="row">                    
                    <div class="col-sm-4">
                        <div class="text-info">Fecha Informe</div>
                        <div class="input-group date" id="mtxtFreginformeedit" data-target-input="nearest">
                            <input type="text" id="mtxtFinforedit" name="mtxtFinforedit" class="form-control datetimepicker-input" data-target="#mtxtFreginformeedit"/>
                            <div class="input-group-append" data-target="#mtxtFreginformeedit" data-toggle="datetimepicker">
                                <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                            </div>
                        </div>                        
                    </div>   
                    <div class="col-sm-4">  
                        <div class="checkbox" id="lbchkinfedit">
                            <div class="text-info">Nro Informe  &nbsp;&nbsp;
                                <b><input type="checkbox" id="chkNroAntiguoedit" name="chkNroAntiguoedit" > Antiguo</b>
                            </div>
                        </div>  
                        <div>                            
                            <input type="text" name="mtxtNroinforedit" class="form-control" id="mtxtNroinforedit">
                            <span style="color: #b94a48">Ej. 0100-2018/PT/FS</span>
                            <br>
                            <span style="color: #b94a48">Ej. 0100B-2018/PT/FS</span>
                        </div>
                    </div>           
                    <div class="col-sm-4"> 
                        <div class="text-info">Responsable<span style="color: #FD0202">*</span></div> 
                        <div>                            
                            <select class="form-control" id="mcboContacInforedit" name="mcboContacInforedit" >
                                <option value=1>SU-TZE LIU</option>
                                <option value=42>CARLOS VILLACORTA</option>
                                <option value=64>JOSE OLIDEN</option>
                            </select>
                        </div>
                    </div> 
                </div>                
            </div> 
            <div class="form-group">
                <div class="row">                
                    <div class="col-sm-12">
                        <div class="text-info">Archivo</div>                        
                        <div class="input-group">
                            <input class="form-control" type="text" name="mtxtNomarchinforedit" id="mtxtNomarchinforedit">                            
                            <span class="input-group-append">                                
                                <div class="fileUpload btn btn-secondary">
                                    <span>Subir Archivo</span>
                                    <input type="file" class="upload" id="mtxtArchivoinforedit" name="mtxtArchivoinforedit" onchange="escogerArchivoedit()"/>                      
                                </div> 
                            </span>  
                        </div>
                        <span style="color: red; font-size: 13px;">+ Los archivos deben estar en formato pdf, docx o xlsx y no deben pesar mas de 60 MB</span>                        
                        <input type="hidden" name="mtxtRutainforedit" id="mtxtRutainforedit">
                        <input type="hidden" name="mtxtArchinforedit" id="mtxtArchinforedit">
                        <input type="hidden" name="sArchivoedit" id="sArchivoedit" value="N"> 
                    </div> 
                </div>
            </div>
            <div class="form-group">
                <div class="row">                
                    <div class="col-sm-12">
                        <div class="text-info">Comentario <span style="color: #FD0202">*</span></div>
                        <div>   
                            <textarea class="form-control" cols="20" data-val="true" data-val-length="No debe superar los 500 caracteres." data-val-length-max="500" id="mtxtDetaInforedit" name="mtxtDetaInforedit" rows="2" data-val-maxlength-max="500" data-validation="required"></textarea>
                            <span class="help-inline" style="padding-left:0px; color:#999; font-size:0.9em;">Caracteres: 0 / 500</span>    
                        </div> 
                    </div> 
                </div>                
            </div>       
        </div>

        <div class="modal-footer justify-content-between" style="background-color: #dff0d8;">
            <button type="reset" class="btn btn-default" id="mbtnCEditInfor" data-dismiss="modal">Cancelar</button>
            <button type="submit" class="btn btn-info" id="mbtnGEditInfor">Grabar</button>
        </div>
      </form>
    </div>
  </div>
</div>  
<!-- /.modal-->

<!-- /.modal-buscar-equipo reg06 --> 
<div class="modal fade" id="modalBuscaequipoReg06" data-backdrop="static" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">      
      <form class="form-horizontal" id="frmBuscaequipoReg06" name="frmBuscaequipoReg06" action="" method="POST" enctype="multipart/form-data" role="form"> 
        <div class="modal-header text-center bg-success">
            <h4 class="modal-title w-100 font-weight-bold">Buscar Equipo</h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>

        <div class="modal-body">
            <div class="form-group">            
                <div class="row">
                    <div class="col-sm-4"> 
                        <div class="text-info">Clase Equipo</div> 
                        <div>                            
                        <select class="form-control" id="mcboClaseequipo" name="mcboClaseequipo" >
                            <option value='T'>EQUIPO PARA EL TRATAMIENTO TÉRMICO</option>
                            <option value='L'>EQUIPO PARA EL ENVASADO - LLENADORA</option>
                        </select>
                        </div>
                    </div> 
                </div>                
                <div class="row"> 
                    <div class="col-12">                                                 
                        <div class="form-group" style="padding-top: 10x;">
                            <table id="tblListBuscaequipoReg06" class="table table-striped table-bordered" style="width:100%">
                                <thead>
                                <tr>
                                    <th>Descripcion Equipo</th>
                                    <th>Tipo Equipo</th>
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

        <div class="modal-footer justify-content-between" style="background-color: #dff0d8;">
            <button type="reset" class="btn btn-default" id="mbtnCBuscaequipoReg06" data-dismiss="modal">Cancelar</button>
        </div>
      </form>
    </div>
  </div>
</div>  
<!-- /.modal-->

<!-- /.modal-buscar-equipo reg08 --> 
<div class="modal fade" id="modalBuscaequipoReg08" data-backdrop="static" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">      
      <form class="form-horizontal" id="frmBuscaequipoReg08" name="frmBuscaequipoReg08" action="" method="POST" enctype="multipart/form-data" role="form"> 
        <div class="modal-header text-center bg-success">
            <h4 class="modal-title w-100 font-weight-bold">Buscar Equipo</h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>

        <div class="modal-body">
            <div class="form-group">                 
                <div class="row"> 
                    <div class="col-12">                                                 
                        <div class="form-group" style="padding-top: 10x;">
                            <table id="tblListBuscaequipoReg08" class="table table-striped table-bordered" style="width:100%">
                                <thead>
                                <tr>
                                    <th>Descripcion Equipo</th>
                                    <th>Tipo Equipo</th>
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

        <div class="modal-footer justify-content-between" style="background-color: #dff0d8;">
            <button type="reset" class="btn btn-default" id="mbtnCBuscaequipoReg08" data-dismiss="modal">Cancelar</button>
        </div>
      </form>
    </div>
  </div>
</div>  
<!-- /.modal-->

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

<!-- Script Generales -->
<script type="text/javascript">
    var baseurl = "<?php echo base_url();?>"; 
</script>