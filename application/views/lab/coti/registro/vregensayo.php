<input type="hidden" id="hdnDataobject" name="hdnDataobject" >


<div class="row justify-content-center">
    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
        <fieldset class="scheduler-border-fsc">
            <legend class="scheduler-border-fsc text-primary">Registro de Ensayos</legend>
            <div class="box-body">    
                <div class="row">
                    <div class="col-sm-8 text-left">                                                 
                        <label>Ensayo / Codigo / Laboratorio / Matriz</label>
                        <text type="text" name="mtxthallazgo"id="mtxthallazgo" class="form-control"></text>
                    </div>
                    <div class="col-sm-4 text-right"> 
                        <button type="button" class="btn btn-secondary" id="btnRetornarCoti"><i class="fas fa-undo-alt"></i> Retornar</button>
                        <button type="submit" class="btn btn-success" id="btnCalificar"><i class="fas fa-save"></i> Calificar</button>    
                    </div>
                </div>
                <br>
                <div class="row"> 
                                            <div class="col-12">
                                                <div class="card card-outline card-primary">
                                                    <div class="card-header">
                                                        <h3 class="card-title">Listado de Ensayos</h3>
                                                    </div>                                        
                                                    <div class="card-body">
                                                        <table id="tblListEnsayos" class="table table-striped table-bordered" style="width:100%">
                                                            <thead>
                                                            <tr>
                                                                <th>N°</th>
                                                                <th>Ensayo</th>
                                                                <th>Codigo</th>
                                                                <th>Año</th>
                                                                <th>SI AC / NO AC</th>
                                                                <th>Norma</th>
                                                                <th>Laboratorio</th>
                                                                <th>Costo</th>
                                                                <th>Tipo Ensayo</th>
                                                                <th>Matriz</th>
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
        </fieldset>
    </div>
</div>
