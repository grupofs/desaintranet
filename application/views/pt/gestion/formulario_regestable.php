<input type="hidden" id="mhdnIdClie" name="mhdnIdClie" >
<input type="hidden" id="hdnIdaudi" name="hdnIdaudi" >

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
    .modal-lg{
        max-width: 1000px !important;
    }
</style>

<div class="row justify-content-center">
    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
        <fieldset class="scheduler-border">
            <legend class="scheduler-border text-primary">Registro de establecimientos</legend>
            <div class="box-body"> 
                <div class="card card-success card-outline card-tabs">
                    <div class="card-header p-0 pt-1 border-bottom-0">            
                        <ul class="nav nav-tabs" id="tabptestable" style="background-color: #28a745;" role="tablist">                    
                            <li class="nav-item">
                                <a class="nav-link active" style="color: #000000;" id="tab_listaestabletab" data-toggle="pill" href="#tab_listaestable" role="tab" aria-controls="tab_listaestable" aria-selected="true">LISTADO</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" style="color: #000000;" id="tab_newestabletab" data-toggle="pill" href="#tab_newestable" role="tab" aria-controls="tab_newestable" aria-selected="false">REGISTRO</a>
                            </li>
                        </ul>
                    </div>
                    <div class="card-body">
                        <div class="tab-content" id="tabptestable-tabContent">
                            <div class="tab-pane fade show active" id="tab_listaestable" role="tabpanel" aria-labelledby="tab_listaestabletab"> 
                                <div class="box box-success">
                                    <div class="box-header with-border">
                                        <h3 class="panel-title">Lista de establecimiento</h3>
                                    </div>                                                
                                    <div class="panel-body">                                
                                        <div> 
                                        <table id="tblEstablecimiento" class="table" style="width:100%">
                                            <thead>
                                            <tr>
                                                <th style="min-width: 10px; max-width:20px;">N°</th>
                                                <th style="min-width: 280px; max-width:300px;">Establecimiento</th>            
                                                <th style="min-width: 350px; max-width:410px;">Dirección</th>
                                                <th style="min-width: 150px; max-width:200px;">Resp. Calidad</th>
                                                <th style="min-width: 80; max-width:100px;">Telfono Calidad</th>
                                                <th style="min-width: 50px; max-width:60px;">Estado</th>
                                                <th style="min-width: 80px; max-width:90px;"></th>
                                            </tr>
                                            </thead>
                                            <tbody></tbody>               
                                        </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="tab_newestable" role="tabpanel" aria-labelledby="tab_newestabletab"> 
                                <form class="form-horizontal" id="frmMantEstablecimiento" name="frmMantEstablecimiento" action="<?= base_url('pt/cptcliente/mantgral_establecimiento')?>" method="POST" enctype="multipart/form-data" role="form"> 
                                    <input type="hidden" id="mhdnIdEstable" name="mhdnIdEstable"> <!-- ID -->
                                    <input type="hidden" id="mhdnIdClie" name="mhdnIdClie">
                                    <input type="hidden" id="mhdnAccionEstable" name="mhdnAccionEstable" value="">
                                    <div class="form-group">
                                        <div class="row"> 
                                            <div class="col-sm-9">
                                                <div class="text-info">Establecimiento</div>
                                                <div>
                                                    <input type="text" class="form-control" name="txtestableCI" id="txtestableCI">
                                                </div>
                                            </div>   
                                        </div>                
                                    </div> 
                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-sm-3">
                                                <div class="text-info">Pais</div>
                                                <div>
                                                    <select class="form-control" id="cboPaisEstable" name="cboPaisEstable" data-validation="required">
                                                        <option value="">Cargando...</option>
                                                    </select>
                                                </div>
                                            </div> 
                                            <div class="col-sm-3" id="boxCiudadEstable">
                                                <div class="text-info">Ciudad</div>
                                                <div>
                                                    <input type="text" class="form-control" name="txtCiudadEstable" id="txtCiudadEstable">
                                                </div>
                                            </div> 
                                            <div class="col-sm-3" id="boxEstadoEstable">
                                                <div class="text-info">Estado / Region / Provincia</div>
                                                <div>
                                                    <input type="text" class="form-control" name="txtEstadoEstable" id="txtEstadoEstable">
                                                </div>
                                            </div> 
                                            <div class="col-sm-3" id="boxDeparEstable">
                                                        <div class="text-info">Departamento</div>
                                                        <div>                            
                                                            <select class="form-control select2bs4" id="cboDepaEsta" name="cboDepaEsta" style="width: 100%;">
                                                                <option value="">Cargando...</option>
                                                            </select>
                                                        </div>                
                                            </div> 
                                            <div class="col-sm-3" id="boxProvEstable">
                                                        <div class="text-info">Provincia</div>
                                                        <div>
                                                            <select class="form-control select2bs4" id="cboProvEsta" name="cboProvEsta">
                                                                <option value="">Cargando...</option>
                                                            </select>
                                                        </div>               
                                            </div>
                                            <div class="col-sm-3" id="boxDistEstable">
                                                        <div class="text-info">Distrito</div>
                                                        <div>
                                                            <select class="form-control select2bs4" id="cboDistEsta" name="cboDistEsta">
                                                                <option value="">Cargando...</option>
                                                            </select>
                                                        </div>               
                                            </div>
                                            <input type="hidden" id="hdnidubigeoEstable" name="hdnidubigeoEstable">
                                        </div>                
                                    </div> 
                                    <div class="form-group">
                                        <div class="row">  
                                            <div class="col-sm-3">
                                                <div class="text-info">Codigo Postal / ZIP</div>
                                                <div>
                                                    <input type="text" class="form-control" name="txtestablezip" id="txtestablezip">
                                                </div>
                                            </div> 
                                            <div class="col-sm-9">
                                                <div class="text-info">Dirección Planta</div>
                                                <div>
                                                    <input type="text" class="form-control" name="txtestabledireccion" id="txtestabledireccion">
                                                </div>
                                            </div>   
                                        </div>                
                                    </div>
                                    <div class="form-group">
                                        <div class="row"> 
                                            <div class="col-sm-4">
                                                <div class="text-info">FCE(Establecimiento de conservas de alimentos)</div>
                                                <div>
                                                    <input type="text" class="form-control" name="txtestableFce" id="txtestableFce">
                                                </div>
                                            </div>   
                                            <div class="col-sm-4">
                                                <div class="text-info">ECP(Persona de contacto del establecimiento)</div>
                                                <div>
                                                    <input type="text" class="form-control" name="txtestableEcp" id="txtestableEcp">
                                                </div>
                                            </div>  
                                            <div class="col-sm-4">
                                                <div class="text-info">FFRN(Número de registro de instalación de alimentos)</div>
                                                <div>
                                                    <input type="text" class="form-control" name="txtestableFfrn" id="txtestableFfrn">
                                                </div>
                                            </div>  
                                        </div>                
                                    </div>
                                    <div class="form-group">
                                        <div class="row"> 
                                            <div class="col-sm-4">
                                                <div class="text-info">Responsable del proceso/calidad</div>
                                                <div>
                                                    <input type="text" class="form-control" name="txtestableresproceso" id="txtestableresproceso">
                                                </div>
                                            </div>   
                                            <div class="col-sm-4">
                                                <div class="text-info">Cargo Responsable</div>
                                                <div>
                                                    <input type="text" class="form-control" name="txtestablecargo" id="txtestablecargo">
                                                </div>
                                            </div>  
                                            <div class="col-sm-4">
                                                <div class="text-info">Email</div>
                                                <div>
                                                    <input type="text" class="form-control" name="txtestableEmail" id="txtestableEmail">
                                                </div>
                                            </div>  
                                        </div>                
                                    </div>
                                    <div class="form-group">
                                        <div class="row"> 
                                            <div class="col-sm-4">
                                                <div class="text-info">Telefono/Celular  Responsable</div>
                                                <div>
                                                    <input type="text" class="form-control" name="txtestablecelu" id="txtestablecelu">
                                                </div>
                                            </div>   
                                            <div class="col-sm-4">
                                                <div class="text-info">Estado</div>                                        
                                                <div>                            
                                                    <select class="form-control" id="cboestableEstado" name="cboestableEstado" data-validation="required">
                                                        <option value = "A" selected="selected">Activo</option>
                                                        <option value = "I">Inactivo</option>
                                                    </select>
                                                </div>
                                            </div>  
                                        </div>                
                                    </div>
                                    <div class="form-group">
                                        <div class="row">                                     
                                            <div class="col-sm-12 text-right"> 
                                                <button type="submit" class="btn btn-success" id="btnguardarestable"><i class="fa fa-fw fa-check"></i>Grabar</button> 
                                                <button type="button" class="btn btn-navy btn-flat" id="btnNuevoEstable"><i class="fa fa-user-plus"></i> Nuevo</button>
                                            </div> 
                                        </div>                
                                    </div>                        
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="box-footer">
                <button type="button" class="btn btn-secondary" id="btnRetornarLista"><i class="fas fa-undo-alt"></i> Retornar</button>
            </div>
        </fieldset>
    </div>
</div>





<!-- /.modal-establecimiento --> 
<div class="modal fade" id="modalestablecimiento" data-backdrop="static" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-xl">
    <div class="modal-content">
        <div class="modal-header text-center bg-success">
            <h4 class="modal-title w-100 font-weight-bold">Seleccionar Ubigeo</h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body">        
            <div class="card card-success card-outline card-tabs">
                <div class="card-header p-0 pt-1 border-bottom-0">            
                    <ul class="nav nav-tabs" id="tabptestable" style="background-color: #28a745;" role="tablist">                    
                        <li class="nav-item">
                            <a class="nav-link active" style="color: #000000;" id="tab_listaestabletab" data-toggle="pill" href="#tab_listaestable" role="tab" aria-controls="tab_listaestable" aria-selected="true">LISTADO</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" style="color: #000000;" id="tab_newestabletab" data-toggle="pill" href="#tab_newestable" role="tab" aria-controls="tab_newestable" aria-selected="false">REGISTRO</a>
                        </li>
                    </ul>
                </div>
                <div class="card-body">
                    <div class="tab-content" id="tabptestable-tabContent">
                        <div class="tab-pane fade show active" id="tab_listaestable" role="tabpanel" aria-labelledby="tab_listaestabletab"> 
                            <div class="box box-success">
                                <div class="box-header with-border">
                                    <h3 class="panel-title">Lista de establecimiento</h3>
                                </div>                                                
                                <div class="panel-body">                                
                                    <div> 
                                    <table id="tblEstablecimiento" class="table" style="width:100%">
                                        <thead>
                                        <tr>
                                            <th style="min-width: 10px; max-width:20px;">N°</th>
                                            <th style="min-width: 280px; max-width:300px;">Establecimiento</th>            
                                            <th style="min-width: 350px; max-width:410px;">Dirección</th>
                                            <th style="min-width: 150px; max-width:200px;">Resp. Calidad</th>
                                            <th style="min-width: 80; max-width:100px;">Telfono Calidad</th>
                                            <th style="min-width: 50px; max-width:60px;">Estado</th>
                                            <th style="min-width: 80px; max-width:90px;"></th>
                                        </tr>
                                        </thead>
                                        <tbody></tbody>               
                                    </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="tab_newestable" role="tabpanel" aria-labelledby="tab_newestabletab"> 
                            <form class="form-horizontal" id="frmMantEstablecimiento" name="frmMantEstablecimiento" action="<?= base_url('pt/cptcliente/mantgral_establecimiento')?>" method="POST" enctype="multipart/form-data" role="form"> 
                                <input type="hidden" id="mhdnIdEstable" name="mhdnIdEstable"> <!-- ID -->
                                <input type="hidden" id="mhdnIdClie" name="mhdnIdClie">
                                <input type="hidden" id="mhdnAccionEstable" name="mhdnAccionEstable" value="">
                                <div class="form-group">
                                    <div class="row"> 
                                        <div class="col-sm-9">
                                            <div class="text-info">Establecimiento</div>
                                            <div>
                                                <input type="text" class="form-control" name="txtestableCI" id="txtestableCI">
                                            </div>
                                        </div>   
                                    </div>                
                                </div> 
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-sm-3">
                                            <div class="text-info">Pais</div>
                                            <div>
                                                <select class="form-control" id="cboPaisEstable" name="cboPaisEstable" data-validation="required">
                                                    <option value="">Cargando...</option>
                                                </select>
                                            </div>
                                        </div> 
                                        <div class="col-sm-3" id="boxCiudadEstable">
                                            <div class="text-info">Ciudad</div>
                                            <div>
                                                <input type="text" class="form-control" name="txtCiudadEstable" id="txtCiudadEstable">
                                            </div>
                                        </div> 
                                        <div class="col-sm-3" id="boxEstadoEstable">
                                            <div class="text-info">Estado / Region / Provincia</div>
                                            <div>
                                                <input type="text" class="form-control" name="txtEstadoEstable" id="txtEstadoEstable">
                                            </div>
                                        </div> 
                                        <div class="col-sm-3" id="boxDeparEstable">
                                                    <div class="text-info">Departamento</div>
                                                    <div>                            
                                                        <select class="form-control select2bs4" id="cboDepaEsta" name="cboDepaEsta" style="width: 100%;">
                                                            <option value="">Cargando...</option>
                                                        </select>
                                                    </div>                
                                        </div> 
                                        <div class="col-sm-3" id="boxProvEstable">
                                                    <div class="text-info">Provincia</div>
                                                    <div>
                                                        <select class="form-control select2bs4" id="cboProvEsta" name="cboProvEsta">
                                                            <option value="">Cargando...</option>
                                                        </select>
                                                    </div>               
                                        </div>
                                        <div class="col-sm-3" id="boxDistEstable">
                                                    <div class="text-info">Distrito</div>
                                                    <div>
                                                        <select class="form-control select2bs4" id="cboDistEsta" name="cboDistEsta">
                                                            <option value="">Cargando...</option>
                                                        </select>
                                                    </div>               
                                        </div>
                                        <input type="hidden" id="hdnidubigeoEstable" name="hdnidubigeoEstable">
                                    </div>                
                                </div> 
                                <div class="form-group">
                                    <div class="row">  
                                        <div class="col-sm-3">
                                            <div class="text-info">Codigo Postal / ZIP</div>
                                            <div>
                                                <input type="text" class="form-control" name="txtestablezip" id="txtestablezip">
                                            </div>
                                        </div> 
                                        <div class="col-sm-9">
                                            <div class="text-info">Dirección Planta</div>
                                            <div>
                                                <input type="text" class="form-control" name="txtestabledireccion" id="txtestabledireccion">
                                            </div>
                                        </div>   
                                    </div>                
                                </div>
                                <div class="form-group">
                                    <div class="row"> 
                                        <div class="col-sm-4">
                                            <div class="text-info">FCE(Establecimiento de conservas de alimentos)</div>
                                            <div>
                                                <input type="text" class="form-control" name="txtestableFce" id="txtestableFce">
                                            </div>
                                        </div>   
                                        <div class="col-sm-4">
                                            <div class="text-info">ECP(Persona de contacto del establecimiento)</div>
                                            <div>
                                                <input type="text" class="form-control" name="txtestableEcp" id="txtestableEcp">
                                            </div>
                                        </div>  
                                        <div class="col-sm-4">
                                            <div class="text-info">FFRN(Número de registro de instalación de alimentos)</div>
                                            <div>
                                                <input type="text" class="form-control" name="txtestableFfrn" id="txtestableFfrn">
                                            </div>
                                        </div>  
                                    </div>                
                                </div>
                                <div class="form-group">
                                    <div class="row"> 
                                        <div class="col-sm-4">
                                            <div class="text-info">Responsable del proceso/calidad</div>
                                            <div>
                                                <input type="text" class="form-control" name="txtestableresproceso" id="txtestableresproceso">
                                            </div>
                                        </div>   
                                        <div class="col-sm-4">
                                            <div class="text-info">Cargo Responsable</div>
                                            <div>
                                                <input type="text" class="form-control" name="txtestablecargo" id="txtestablecargo">
                                            </div>
                                        </div>  
                                        <div class="col-sm-4">
                                            <div class="text-info">Email</div>
                                            <div>
                                                <input type="text" class="form-control" name="txtestableEmail" id="txtestableEmail">
                                            </div>
                                        </div>  
                                    </div>                
                                </div>
                                <div class="form-group">
                                    <div class="row"> 
                                        <div class="col-sm-4">
                                            <div class="text-info">Telefono/Celular  Responsable</div>
                                            <div>
                                                <input type="text" class="form-control" name="txtestablecelu" id="txtestablecelu">
                                            </div>
                                        </div>   
                                        <div class="col-sm-4">
                                            <div class="text-info">Estado</div>                                        
                                            <div>                            
                                                <select class="form-control" id="cboestableEstado" name="cboestableEstado" data-validation="required">
                                                    <option value = "A" selected="selected">Activo</option>
                                                    <option value = "I">Inactivo</option>
                                                </select>
                                            </div>
                                        </div>  
                                    </div>                
                                </div>
                                <div class="form-group">
                                    <div class="row">                                     
                                        <div class="col-sm-12 text-right"> 
                                            <button type="submit" class="btn btn-success" id="btnguardarestable"><i class="fa fa-fw fa-check"></i>Grabar</button> 
                                            <button type="button" class="btn btn-navy btn-flat" id="btnNuevoEstable"><i class="fa fa-user-plus"></i> Nuevo</button>
                                        </div> 
                                    </div>                
                                </div>                        
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal"><i class="fa fa-fw fa-close"></i> Cerrar</button>
        </div>
    </div>
  </div>
</div> 
<!-- /.modal-->