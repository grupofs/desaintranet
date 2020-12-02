<input type="hidden" id="hdnCcliente" name="hdnCcliente" >
<input type="hidden" id="hdnIdaudi" name="hdnIdaudi" >
<input type="hidden" id="hdnFaudi" name="hdnFaudi" >
<input type="hidden" id="hdnChecklist" name="hdnChecklist" >
<input type="hidden" id="hdnDataobject" name="hdnDataobject" >

<div class="row justify-content-center">
    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
        <fieldset class="scheduler-border">
            <legend class="scheduler-border text-primary">Registro de Checklist</legend>
            <div class="box-body">    
                <div class="row">
                    <div class="col-sm-4 text-left">                                                 
                        <label>Area o Zona</label>
                        <select class="form-control select2bs4" id="cboregAreazona" name="cboregAreazona" style="width: 100%;">
                            <option value="" selected="selected">Cargando...</option>
                        </select>
                    </div>
                    <div class="col-sm-8 text-right"> 
                        <button type="button" class="btn btn-secondary" id="btnRetornarLista"><i class="fas fa-undo-alt"></i> Retornar</button>
                        <button type="submit" class="btn btn-success" id="btnCalificar"><i class="fas fa-save"></i> Calificar</button>    
                    </div>
                </div>  
                <br>                             
                <div class="form-group">
                    <div class="col-12"> 
                        <table id="tblListChecklist" class="table table-striped table-bordered" style="width:100%">
                            <thead>
                            <tr>
                                <th>ITEM</th>
                                <th></th>
                                <th>REQUISITO</th>
                                <th>CUMPLE / NO CUMPLE</th>
                                <th>HALLAZGOS</th>
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
</div>


<!-- /.modal-hallazgo --> 
<div class="modal fade" id="modalHallazgo" data-backdrop="static" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <form class="form-horizontal" id="frmHallazgo" name="frmHallazgo" action="<?= base_url('at/auditoria/cconsultauditor/setregchecklist')?>" method="POST" enctype="multipart/form-data" role="form"> 

        <div class="modal-header text-center bg-success">
            <h4 class="modal-title w-100 font-weight-bold">Hallazgos</h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>

        <div class="modal-body">
            <input type="hidden" id="mhdnccliente" name="mhdnccliente"> 
            <input type="hidden" id="mhdncauditoriainspeccion" name="mhdncauditoriainspeccion"> 
            <input type="hidden" id="mhdnfservicio" name="mhdnfservicio"> 
            <input type="hidden" id="mhdncchecklist" name="mhdncchecklist"> 
            <input type="hidden" id="mhdncrequisitochecklist" name="mhdncrequisitochecklist"> 
            <input type="hidden" id="mhdncdetallevalor" name="mhdncdetallevalor"> 
            <input type="hidden" id="mhdncestablearea" name="mhdncestablearea" >                         
            <div class="form-group">  
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
                <legend class="text-info">
                    <i class="fas fa-camera position-left"></i>
                    Adjuntar Evidencias
                    <button class="btn btn-success btn-circle btn-circle-sm m-1" name="btnAddEviden" id="btnAddEviden"><i class="fas fa-plus"></i></button>
                </legend>
                <div class="row">                
                    <div class="col-sm-12">
                        <div class="text-info">Archivo</div>                        
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text">Imagen</span>
                            </div>
                            <input class="form-control" type="text" name="mtxtNombarcheviden" id="mtxtNombarcheviden">                            
                            <span class="input-group-append">
                                <div class="fileUpload btn btn-info">
                                    <span><i class="fas fa-upload"></i></span>
                                    <input type="file" class="upload" id="mtxtArchivoeviden" name="mtxtArchivoeviden" onchange="escogerArchivoeviden()"/>                
                                </div> 
                                <div class="fileUpload btn btn-danger">
                                    <span><i class="fas fa-trash-alt"></i></span>                
                                </div> 
                            </span>  
                        </div>                       
                        <input type="hidden" name="mtxtRutaeviden" id="mtxtRutaeviden">
                        <input type="hidden" name="sArchivo" id="sArchivo" value="N"> 
                    </div> 
                </div>
                <div class="row">                
                    <div class="col-sm-12">
                        <div class="text-info">Descripcion </div>  
                        <input class="form-control" type="text" name="mtxtDescripcion" id="mtxtDescripcion">   
                    </div> 
                </div>
            </div>
        </div>

        <div class="modal-footer justify-content-between" style="background-color: #dff0d8;">
            <button type="reset" class="btn btn-default" id="mbtnCHallazgo" data-dismiss="modal">Cancelar</button>
            <button type="submit" class="btn btn-info" id="mbtnGHallazgo">Registrar</button>
        </div>
      </form>
    </div>
  </div>
</div> 
<!-- /.modal-->