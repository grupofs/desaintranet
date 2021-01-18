
<style>
    #tblListPersonas_filter{
        float: left !important;
        text-align: left !important;
        width: 100% !important;
    }

    #tblListPersonas_filter .form-control-sm{
        width: 135% !important;
    }

    select.custom-select{
        width: 50% !important;
    }
</style>



<div class="row justify-content-center">
    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
        <fieldset class="scheduler-border">
            <legend class="scheduler-border text-primary">Creación de Usuario</legend>
            <div class="box-body">   
                <input type="hidden" id="fhdnidusuario" name="fhdnidusuario" >                                                                  
                <div class="form-group">
                    <div class="row">          
                        <div class="col-sm-3">
                            <div class="text-info">Tipo Usuario</div>
                            <div>                            
                                <select class="form-control" id="mcbotipousu" name="mcbotipousu">
                                    <option value="" selected="selected">::Elija</option>
                                    <option value="I" >INTERNO</option>
                                    <option value="C" >CLIENTE</option>
                                    <option value="F" >FREELANCE</option>
                                    <option value="P" >PROVEEDOR</option>
                                </select>
                            </div>
                        </div>         
                        <div class="col-sm-5">
                            <div class="text-info">Datos del Usuario</div>                            
                            <div class="input-group mb-3">
                                <input type="text" id="mtxtnrodoc" name="mtxtnrodoc" class="form-control rounded-0" disabled>
                                <span class="input-group-append">
                                    <button type="button" id="mbtnbuscnrodoc" name="mbtnbuscnrodoc" class="btn btn-primary btn-flat" data-toggle="modal" data-target="#modalAdmPN"><i class="fas fa-search"></i> </button>
                                    <!--<button type="button" id="mbtnnuevoadm" name="mbtnnuevoadm" class="btn btn-info btn-flat"><i class="fas fa-user-plus"></i> </button>--> 
                                </span>
                            </div>
                        </div> 
                        <div class="col-sm-4">
                            <div class="text-info">Usuario</div>
                            <div>                            
                                <input type="text" class="form-control" id="mtxtusuario" name="mtxtusuario">
                            </div>
                        </div>     
                    </div>                
                </div>  
            </div>
            <div class="box-footer" style="background-color: #dff0d8;">
                <button type="reset" class="btn btn-default" id="mbtnCPago" data-dismiss="modal"><i class="fas fa-window-close"></i> Cancelar</button>
                <button type="submit" class="btn btn-success" id="mbtnGPago"><i class="fas fa-save"></i> Grabar</button> 
            </div>

        </fieldset>
    </div>
</div>


<!-- /.modal-Persona Natural --> 
<div class="modal fade" id="modalAdmPN" data-backdrop="static" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      

        <div class="modal-header text-center bg-success">
            <h4 class="modal-title w-100 font-weight-bold">Persona Natural</h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>

        <div class="modal-body">
        <form class="form-horizontal" id="frmAdmPN" name="frmAdmPN" action="<?= base_url('at/auditoria/cconsultauditor/setregchecklist')?>" method="POST" enctype="multipart/form-data" role="form"> 
            <input type="hidden" id="mhdnccliente" name="mhdnccliente"> 
            <input type="hidden" id="mhdnfservicio" name="mhdnfservicio">
                             
            <div class="form-group" id="frmBuscarPN"> 
                <div class="row">
                    <div class="col-md-12" style="overflow-x: scroll;"> 
                        <table id="tblListPersonas" class="table table-striped table-bordered" style="width:100%">
                            <thead>
                            <tr>
                                <th></th>
                                <th>Nro Doc</th>
                                <th>Datos de la Persona</th>
                                <th></th>
                            </tr>
                            </thead>
                            <tbody>
                            </tbody>
                        </table>
                    </div>
                </div> 
            </div> 

            <div class="form-group" id="frmRegistrarPN">  
                <div class="row">
                    <div class="col-md-12"> 
                        <div class="text-info">Requisito</div>
                        <div>    
                            <textarea type="text" name="mtxtrequisito"id="mtxtrequisito" class="form-control" rows="4"></textarea>
                        </div>
                    </div>
                </div>  
                <div class="row">
                    <div class="col-md-12"> 
                        <div class="text-info">Hallazgo</div>                        
                        <div>    
                            <textarea type="text" name="mtxthallazgo"id="mtxthallazgo" class="form-control" rows="4" placeholder="Ingresar ..."></textarea>
                        </div>
                    </div>
                </div>
            </div>            
        </form>
        </div>

        <div class="modal-footer justify-content-between" style="background-color: #dff0d8;">
            <button type="reset" class="btn btn-default" id="mbtnCHallazgo" data-dismiss="modal">Cancelar</button>
            <button type="submit" class="btn btn-info" id="mbtnGHallazgo">Registrar</button>
        </div>
    </div>
  </div>
</div> 
<!-- /.modal-->