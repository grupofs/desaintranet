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
                    <div class="col-12">
                        <div class="card card-outline card-primary">
                            <div class="card-header">
                                <h3 class="card-title">Busqueda de Ensayos</h3>
                            </div>                                        
                            <div class="card-body">    
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
                                        <label>&nbsp;</label> 
                                        <button type="button" class="btn btn-primary" id="btnBuscarEnsayo"><i class="fas fa-search"></i> Buscar</button>  
                                        <button type="button" class="btn btn-secondary" id="btnRetornarCoti"><i class="fas fa-undo-alt"></i> Retornar</button>  
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

