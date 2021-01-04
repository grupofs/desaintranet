

<div class="row justify-content-center">
    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
        <fieldset class="scheduler-border">
            <legend class="scheduler-border text-primary">Modificación de Usuario</legend>
            <div class="box-body">   
                <input type="hidden" id="fhdnidusuario" name="fhdnidusuario" >                                                                  
                <div class="form-group">
                    <div class="row">
                        <div class="col-sm-8 text-left">
                            <h4>
                                <i class="fas fa-user-edit"></i> <label id="lblusuario"></label>
                            </h4>
                            <h4>
                                <small id="lblcusu" class="float-left"><i class="fas fa-portrait"></i></small>
                                <small id="lblemail" class="float-right"><i class="fas fa-at"></i></small>
                            </h4>
                        </div>
                        <div class="col-sm-4 text-right"> 
                            <button type="button" class="btn btn-secondary" id="btnRetornarLista"><i class="fas fa-undo-alt"></i> Retornar</button>
                            <button type="submit" class="btn btn-success" id="btnGrabarReg"><i class="fas fa-save"></i> Grabar</button>    
                        </div>
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