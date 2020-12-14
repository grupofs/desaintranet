<input type="hidden" id="hdnIdcoti" name="hdnIdcoti" >
<input type="hidden" id="hdnNvers" name="hdnNvers" >
<input type="hidden" id="hdnIdprod" name="hdnIdprod" >
<input type="hidden" id="hdnprod" name="hdnprod" >


<div class="row justify-content-center">
    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
        <fieldset class="scheduler-border-fsc">
            <legend class="scheduler-border-fsc text-primary">Registro de Ensayos</legend>
            <div class="box-body">    
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
                        <button type="button" class="btn btn-secondary" id="btnRetornarCoti"><i class="fas fa-undo-alt"></i> Retornar</button>  
                    </div>
                </div>
                <br>
                <div class="row"> 
                    <div class="col-12">
                        <div class="card card-outline card-primary">
                            <div class="card-header">
                                <h3 class="card-title">Busqueda de Ensayos</h3>
                            </div>                                        
                            <div class="card-body">
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
        </fieldset>
    </div>
</div>


<!-- /.modal-EnsayosLab --> 
<div class="modal fade" id="modalselensayo" data-backdrop="static" role="dialog" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <form class="form-horizontal" id="frmEnsayosLab" name="frmEnsayosLab" action="<?= base_url('lab/coti/ccotizacion/setregensayoxprod')?>" method="POST" enctype="multipart/form-data" role="form"> 

        <div class="modal-header text-center bg-success">
            <h4 class="modal-title w-100 font-weight-bold">Ingresar Ensayos x Laboratorio</h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>

        <div class="modal-body">
            <input type="hidden" id="mhdnmcensayo" name="mhdnmcensayo"> 
            <input type="hidden" id="hdnmIdcoti" name="hdnmIdcoti" >
            <input type="hidden" id="hdnmNvers" name="hdnmNvers" >
            <input type="hidden" id="hdnmIdprod" name="hdnmIdprod" >
            
            <input type="hidden" id="mtxtmCLab" name="mtxtmCLab" >
            <input type="hidden" id="hdnmAccion" name="hdnmAccion" >
            <div class="form-group">
                <div class="row"> 
                    <div class="col-12">
                        <h4>
                            <i class="fas fa-archive"></i> <label id="lblmProducto"></label>
                        </h4>
                    </div>
                </div>                
            </div> 
            <div class="form-group">
                <div class="row"> 
                    <div class="col-2">
                        <label>Codigo :</label>
                    </div>
                    <div class="col-3">
                        <h5>                            
                            <small id="lblmCodigo"></small>
                        </h5>
                    </div>
                    <div class="col-2">
                        <label>Ensayo :</label>
                    </div>
                    <div class="col-5">
                        <h5>                            
                            <small id="lblmEnsayo"></small>
                        </h5>
                    </div>
                </div>                
            </div>                        
            <div class="form-group"> 
                <div class="row">
                    <div class="col-md-6"> 
                        <div class="text-info">Costo</div>
                        <div>    
                            <input type="text" name="mtxtmCosto" class="form-control" id="mtxtmCosto"/> 
                        </div>
                    </div>
                    <div class="col-md-6"> 
                        <div class="text-info">Vias</div>                        
                        <div>    
                            <input type="number" name="mtxtmvias" class="form-control" id="mtxtmvias"/>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="modal-footer justify-content-between" style="background-color: #dff0d8;">
            <button type="reset" class="btn btn-default" id="mbtnCerrarEnsayo" data-dismiss="modal">Cancelar</button>
            <button type="submit" class="btn btn-info" id="mbtnGabarEnsayo">Grabar</button>
        </div>
      </form>
    </div>
  </div>
</div> 
<!-- /.modal-->