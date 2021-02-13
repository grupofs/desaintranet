
<div class="row justify-content-center">
    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
    
        <fieldset class="scheduler-border">
            <legend class="scheduler-border text-primary">Registro de Producto</legend> 
            <div class="card card-lightblue">
            <form class="form-horizontal" id="frmCreaProduc" name="frmCreaProduc" action="<?= base_url('lab/coti/ccotizacion/setproductoxcotizacion')?>" method="POST" enctype="multipart/form-data" role="form"> 
                <div class="card-header">
                    <h3 class="card-title">Producto</h3>
                    <div class="card-tools">
                        <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i></button>
                    </div>
                </div>                                
                <div class="card-body">
                    <input type="hidden" id="mhdnIdProduc" name="mhdnIdProduc" class="form-control"> <!-- ID -->
                    <input type="hidden" id="mhdnidcotizacion" name="mhdnidcotizacion" class="form-control">
                    <input type="hidden" id="mhdnnroversion" name="mhdnnroversion" class="form-control">
                    <input type="hidden" id="mhdnAccionProduc" name="mhdnAccionProduc" class="form-control">
                    <input type="hidden" id="mhdncusuario" name="mhdncusuario" class="form-control">
 
                                
                    <div class="form-group">
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="text-info">Local del Cliente <span class="text-requerido">*</span></div>
                                <div>                            
                                    <select class="form-control select2bs4" id="mcboregLocalclie" name="mcboregLocalclie" style="width: 100%;">
                                        <option value="" selected="selected">Cargando...</option>
                                    </select>
                                </div>
                            </div>  
                            <div class="col-sm-6">
                                <div class="text-info">Nombre del Producto <span class="text-requerido">*</span></div>
                                <div>  
                                    <input type="text" name="mtxtregProducto" class="form-control" id="mtxtregProducto"/>  
                                </div>
                            </div>  
                        </div>                
                    </div> 
                    <div class="form-group">
                        <div class="row">                
                            <div class="col-sm-3">
                                <div class="text-info">Condicion</div>
                                <div>
                                    <select class="form-control select2bs4" id="mcboregcondicion" name="mcboregcondicion">
                                    <option value="">Cargando...</option>
                                    </select>
                                </div>
                            </div>                
                            <div class="col-sm-2">
                                <div class="text-info">Muestras <span class="text-requerido">*</span></div>
                                <div>   
                                    <input type="number" name="mtxtregmuestra"id="mtxtregmuestra" class="form-control" value="0" min="0" pattern="^[0-9]+">
                                </div>
                            </div>               
                            <div class="col-sm-4">
                                <div class="text-info">Procedencia de muestra</div>
                                <div>
                                    <select class="form-control select2bs4" id="mcboregprocedencia" name="mcboregprocedencia">
                                    <option value="">Cargando...</option>
                                    </select>
                                </div>
                            </div>                
                            <div class="col-sm-3">
                                <div class="text-info">Cantidad de muestra minima</div>
                                <div>  
                                    <input type="text" name="mtxtregcantimin" class="form-control" id="mtxtregcantimin"/>  
                                </div>
                            </div> 
                        </div>                
                    </div> 
                    <div class="form-group">
                        <div class="row">                
                            <div class="col-sm-2">
                                <div class="text-info"><b>Octogono</b></div>
                                <div>
                                    <select class="form-control" id="mcboregoctogono" name="mcboregoctogono">
                                        <option value="1">SI</option>
                                        <option value="0" selected="selected">NO</option>
                                    </select>
                                </div>
                            </div>                
                            <div class="col-sm-2">
                                <div class="text-info"><b>Etiquetado Nutricional</b></div>
                                <div>
                                    <select class="form-control" id="mcboregetiquetado" name="mcboregetiquetado">
                                        <option value="1">SI</option>
                                        <option value="0" selected="selected">NO</option>
                                    </select>
                                </div>
                            </div>                 
                            <div class="col-sm-2">
                                <div class="text-info">Tamaño de Porcion</div>
                                <div>  
                                    <input type="text" name="mtxtregtamporci" class="form-control" id="mtxtregtamporci"/>  
                                </div>
                            </div>                
                            <div class="col-sm-2">
                                <div class="text-info">UM</div>
                                <div>
                                    <select class="form-control" id="mcboregumeti" name="mcboregumeti">
                                        <option value="" selected="selected"></option>
                                        <option value="ml">ml</option>
                                        <option value="g">g</option>
                                    </select>
                                </div>
                            </div> 
                        </div>                
                    </div>
                </div>                
                                                    
                <div class="card-footer justify-content-between">                     
                    <div class="form-group">                
                        <div class="row">
                            <div class="col-md-6 text-left">  
                                <button type="reset" class="btn btn-secondary" id="mbtnCCreaProduc" data-dismiss="modal"><i class="fas fa-door-open"></i>Regresar</button> 
                            </div>
                            <div class="col-md-6 text-right">
                                <button type="submit" class="btn btn-success" id="mbtnGCreaProduc"><i class="fas fa-save"></i>Grabar</button>              
                            </div> 
                        </div>  
                    </div>  
                </div>
            </from>  
            </div>          
        </fieldset>  

        <fieldset class="scheduler-border-fsc">
            <legend class="scheduler-border-fsc text-primary">Registro de Ensayos</legend>
            <div class="box-body">                
                <div class="row"> 
                    <div class="col-12">
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
                        <div class="card card-lightblue" id="divBuscarEnsayo">
                            <div class="card-header">
                                <h3 class="card-title">Busqueda de Ensayos</h3>
                            </div>                                        
                            <div class="card-body">
                                <input type="hidden" id="hdnIdcoti" name="hdnIdcoti" >
                                <input type="hidden" id="hdnNvers" name="hdnNvers" >
                                <input type="hidden" id="hdnIdprod" name="hdnIdprod" >
                                <input type="hidden" id="hdnprod" name="hdnprod" >    
                                <div class="row">
                                    <div class="col-sm-6 text-left">                                                 
                                        <label>Ensayo / Codigo / Laboratorio / Matriz</label>
                                        <text type="text" name="mtxtdescrensayo"id="mtxtdescrensayo" class="form-control"></text>
                                    </div>
                                    <div class="col-sm-3">                                                 
                                        <label>Estado Acreditado</label>                        
                                        <select class="form-control" id="mcboacredensayo" name="mcboacredensayo">
                                            <option value="" selected="selected"></option>
                                            <option value="A">SI AC</option>
                                            <option value="N">NO AC</option>
                                        </select>
                                    </div>
                                    <div class="col-sm-3 text-right"> 
                                        <button type="button" class="btn btn-primary" id="btnBuscarEnsayo"><i class="fas fa-search"></i> Buscar</button>  
                                        <button type="button" class="btn btn-secondary" id="btnRetornarCoti"><i class="fas fa-door-open"></i> Retornar</button>  
                                    </div>
                                </div>
                                <br>
                                <div class="row"> 
                                    <div class="col-12">
                                        <table id="tblbuscarEnsayos" class="display compact" style="width:100%">
                                            <thead>
                                                <tr>
                                                    <th>N°</th>
                                                    <th>Ensayo</th>
                                                    <th>Codigo</th>
                                                    <th>Año</th>
                                                    <th>Acred.</th>
                                                    <th>Norma</th>
                                                    <th>Laboratorio</th>
                                                    <th>Costo</th>
                                                    <th>Tipo Ensayo</th>
                                                    <th>Matriz</th>
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
                </div>  
            </div>
        </fieldset>
    </div>
</div>

