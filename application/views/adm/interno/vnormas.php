<?php
    $idusuario  = $this-> session-> userdata('s_idusuario');
    $cia        = $this-> session-> userdata('s_cia');
?>
<style>
.custom-file-label.archivoGuia:after{
    display:none;
}
</style>

<!-- content-header -->
<div class="content-header">   
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-6">
        <h1 class="m-0 text-dark">MÓDULO DE NORMAS </h1>
      </div>
      <div class="col-6">
        <ol class="breadcrumb float-right">
          <li class="breadcrumb-item"><a href="<?php echo public_base_url(); ?>cprincipal/principal">Inicio</a></li>
          <li class="breadcrumb-item">Interno</li>
          <li class="breadcrumb-item active">Buscar Normativa</li>
        </ol>
      </div>
    </div>
  </div>
</div>
<!-- /.content-header -->

<!-- Main content -->
<section class="content">
    <div class="container-fluid">  
        
        <div class="card card-success card-outline card-tabs">

            <div class="card-header p-0 pt-1 border-bottom-0">            
                <ul class="nav nav-tabs" id="tabnorma" style="background-color: #28a745;" role="tablist">                    
                    <li class="nav-item">
                        <a class="nav-link active" style="color: #000000;" id="tabnorma-list-tab" data-toggle="pill" href="#tabnorma-list" role="tab" aria-controls="tabnorma-list" aria-selected="true">BUSCAR</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" style="color: #000000;" id="tabnorma-new-tab" data-toggle="pill" href="#tabnorma-new" role="tab" aria-controls="tabnorma-new" aria-selected="false">CREAR</a>
                    </li>
                </ul>
            </div>
        </div>
        
        <div class="card-body">
          <input type="hidden" name="mtxtidusunormas" class="form-control" id="mtxtidusunormas" value="<?php echo $idusuario; ?>">
          
            <div class="tab-content" id="tabnorma-tabContent">

                <div class="tab-pane fade show active" id="tabnorma-list" role="tabpanel" aria-labelledby="tabnorma-list-tab"> 
                    <div class="card card-success">
                        <div class="card-header">
                            <h3 class="card-title">BUSQUEDA</h3>
                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i></button>
                            </div>
                        </div>
            
                        <div class="card-body">
                            <!-- INICIO -->
                            <div class="row">

                                <div class="col-md-3 col-12">
                                    <!-- text input -->
                                    <div class="form-group">
                                        <label>TIPO DOCUMENTO / PUBLICACIÓN</label>
                                        <select id="cboDoc" class="form-control select2" name="TIPODOC" multiple="multiple"
                                            data-placeholder="Seleccione tipo documento">
                                            <option value="">TODOS</option>
                                        </select>
                                    </div>
                                </div>


                                <div class="col-md-3 col-12">
                                    <div class="form-group">

                                        <label>ÁREA RESPONSABLE</label>
                                        <select id="cboResp" name="RESP" class="form-control select2" style="width: 100%; height: 30px;"
                                            multiple="multiple" data-placeholder="Seleccione area responsable">
                                            <option value="%">TODOS</option>
                                            <option value="AT">AREA TÉCNICA</option>
                                            <option value="AARR">AA. RR.</option>
                                            <option value="LAB">LABORATORIO</option>
                                            <option value="OI">O. I.</option>
                                            <option value="PT">PROCESOS TÉRMICOS</option>
                                        </select>

                                    </div>
                                </div>


                                <div class="col-md-3 col-12">
                                    <div class="form-group">
                                        <label>Titulo de Norma</label>
                                        <input type="text" class="form-control" name="DESCRI" id="txtDescri"
                                            placeholder="Ingresa Titulo de Norma">
                                    </div>
                                </div>


                                <div class="col-md-3 col-12">
                                    <label>Estado de Norma</label>

                                    <div class="form-group">
                                        <input type="radio" name="rbtEst" value="1" />
                                        Vigentes
                                        <input type="radio" name="rbtEst" value="3" />
                                        Obsoletos
                                        <input type="radio" name="rbtEst" value="%" checked />
                                        Todos
                                    </div>
                                </div>

                            </div>


                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <div class="checkbox col-6">
                                            <label>
                                                <input type="checkbox" id="chkAvanzado" /> Búsqueda Avanzada
                                            </label>
                                        </div>
                                    </div>
                                </div>
                            </div>


                            <!-- formulario busqueda avanazada -->

                            <div id="avanzado" style="display: none;" class="col-md-11 mx-auto">

                                <div class="row">
                                    <label class="col-md-2 col-12">Fec. Publicación</label>
                                    <div class="col-md-3 col-12">
                                        <div class="input-group date" id="txtFDesde" data-target-input="nearest">
                                            <input type="text" id="FechaInicial" name="fi" class="form-control datetimepicker-input"
                                                data-target="#txtFDesde" disabled />
                                            <div class="input-group-append" data-target="#txtFDesde" data-toggle="datetimepicker">
                                                <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-3 col-12">
                                        <div class="input-group date" id="txtFFinal" data-target-input="nearest">
                                            <input type="text" id="FechaTermino" name="ff" class="form-control datetimepicker-input" data-target="#txtFFinal" disabled />
                                            <div class="input-group-append" data-target="#txtFFinal" data-toggle="datetimepicker">
                                                <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                            </div>
                                        </div>
                                    </div>


                                    <div class="form-group">
                                        <div class="checkbox">
                                            <label>
                                                <input data-val="true" data-val-required="El campo Todos es obligatorio." id="Todos"
                                                    name="Todos" type="checkbox" value="true" /><input name="Todos" type="hidden"
                                                    value="false" /> Todos
                                            </label>
                                        </div>
                                    </div>

                                </div>

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="control-label col-12" for="Codigo">Idioma</label>
                                            <div class="col-8">
                                                <select class="form-control select2" id="idiomacboavz" name="IDIOMA" multiple="multiple"
                                                    data-placeholder="Seleccione idioma" style="width: 100%;">
                                                    <option value="%">TODOS</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="control-label col-12" for="Codigo">Pais</label>
                                            <div class="col-8">
                                                <select class="form-control select2" id="paiscboavz" name="PAIS" multiple="multiple"
                                                    data-placeholder="Seleccione pais" style="width: 100%;">
                                                    <option value="%">TODOS</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="control-label col-12" for="Codigo">Institución</label>
                                            <div class="col-8">
                                                <select class="form-control select2" id="institucioncboavz" name="INSTITUTO" multiple="multiple"
                                                    data-placeholder="Seleccione institución" style="width: 100%;">
                                                    <option value="%">TODOS</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="control-label col-12" for="Codigo">Palabras Claves</label>
                                            <div class="col-8">
                                                <input type="text" class="form-control " id="placlavecboavz" name="PALCLAVE"
                                                    placeholder="Ingrese palabra clave">
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div>


                            <div class="form-group">
                                <div class="col-md-12 text-right">
                                    <button id="btnBuscar" type="button" class="btn btn-success"><i class="fa fa-search"></i>Buscar</button>
                                    <button type="button" class="btn btn-default" id="btnNuevo" ><i
                                            class="fa fa-fw fa-plus"></i>Crear Nuevo</button>
                                    <button type="button" class="btn btn-info" id="btnexcelNormas" disabled="true"><i
                                            class="fa fw fa-file-excel-o"></i> Exportar Excel</button>
                                </div>
                            </div>

                        </div>     
                    </div> 

                    <div class="row">
                        <div class="col-12">
                            <div class="card card-outline card-success">
                                <div class="card-header">
                                    <h3 class="card-title">Listado de Normas</h3>
                                </div>
                            
                                <div class="card-body">
                                    <table id="tblListado" class="table table-bordered table-striped table-responsive" style="width:100%">
                                        <thead>
                                        <tr>
                                            <th>#</th> 
                                            <th>CÓDIGO NORMA</th>
                                            <th>TITULO</th>
                                            <th>TIPO DOCUMENTO</th>
                                            <th>AREA RESPONSABLE</th>
                                            <th>PAIS</th> 
                                            <th>INSTITUCIÓN</th>
                                            <th>IDIOMA</th>
                                            <th>PUBLICACIÓN</th>
                                            <th>ESTADO</th>
                                            <th>ARCHIVO</th>
                                            <th>ACCIONES</th>                        
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


                <div class="tab-pane fade" id="tabnorma-new" role="tabpanel" aria-labelledby="tabnorma-new-tab">
                    
                        <div class="card card-success">

                                <div class="card-header">
                                    <h3 class="card-title">REGISTRAR NORMA</h3>
                                    <div class="card-tools">
                                        <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i></button>
                                    </div>
                                </div>
                            <form method="post" id="fmrNormasNew" name="fmrNormasNew" enctype="multipart/form-data">
                                <div class="card-body">

                                    <!-- row1 -->
                                    <div class="row">

                                        <div class="col-md-3 col-12">
                                            <!-- text input -->
                                            <div class="form-group">
                                                <label>CODIGO</label>
                                                <input type="text" class="form-control" name="txtCodigoNew" id="txtCodigo"
                                                    placeholder="Ingresa Codigo de Norma">
                                            </div>
                                        </div>


                                        <div class="col-md-3 col-12">
                                            <div class="form-group">

                                                <label>TIPO DE DOCUENTO</label>
                                                <select id="cboDocNew" class="form-control select2bs4" name="cboDocumentoNew"
                                                        data-placeholder="Seleccione tipo documento" required>>
                                                        <option value="">::Escoger</option>
                                                </select>

                                            </div>
                                        </div>


                                        <div class="col-md-3 col-12">
                                            <div class="form-group">
                                                <label class="control-label col-12" for="Codigo">IDIOMA</label>
                                                
                                                    <select class="form-control select2bs4" id="idiomacboavzNew" name="cboIdiomaNew"
                                                        data-placeholder="Seleccione idioma" style="width: 100%;" required>
                                                        <option value="">::Escoger</option>
                                                    </select>
                                                
                                            </div>
                                        </div>

                                            <div class="col-md-3 col-12">
                                                <div class="form-group">
                                                    <label class="control-label col-12" for="Codigo">PAIS</label>
                                                
                                                    <select class="form-control select2bs4" id="paiscboavzNew" name="cboPaisNew"
                                                        data-placeholder="Seleccione pais" style="width: 100%;" required>
                                                        <option value="">::Escoger</option>
                                                    </select>
                                                
                                                </div>
                                            </div>

                                    </div>


                                    <!-- row 2 -->
                                    <div class="row">

                                        <div class="col-md-3 col-12">
                                            <!-- text input -->
                                            <div class="form-group">
                                                <label>INSTITUCIÓN 
                                                    <button class="btn btn-primary btn-sm" type="button" title="Agregar Institucion" data-toggle="modal" data-target="#modalAddInstitucion">
                                                        <i class="fa fa-plus"></i>
                                                    </button>
                                                </label>
                                                <select id="institucioncboavzNew" class="form-control select2bs4" name="cboInstitucioNew"
                                                        data-placeholder="Seleccione Insitucion">
                                                        <option value="">::Escoger</option>
                                                </select>
                                            </div>
                                        </div>


                                        <div class="col-md-3 col-12">
                                            <div class="form-group">

                                                <label>TIPO DE PUBLICACIÓN
                                                    <button class="btn btn-primary btn-sm" type="button" title="Agregar Publicacion" data-toggle="modal" data-target="#modalAddPublicacion">
                                                        <i class="fa fa-plus"></i>
                                                    </button>
                                                </label>
                                                <select id="mtxtPublicacion" class="form-control select2bs4" name="mtxtPublicacion"
                                                        data-placeholder="Seleccione tipo de publicacion">
                                                        <option value="">::Escoger</option>
                                                </select>

                                            </div>
                                        </div>


                                        <div class="col-md-6 col-12">
                                            <div class="form-group">
                                                <label for="">TITULO</label>
                                                <textarea class="form-control" id="" rows="1" name="mtxtTitulo"></textarea>
                                            </div>
                                        </div>

                                    
                                    </div>


                                    <!-- row 3 -->
                                    <div class="row">

                                        <div class="col-md-3 col-12">
                                            <!-- text input -->
                                            <div class="form-group">
                                                <label>FEC. PUBLICACION</label>
                                                <div class="input-group date" id="txtPublicacionNew" data-target-input="nearest">
                                                    <input type="text" id="FechaPublicacion" name="txtFechaPublicacion" class="form-control datetimepicker-input" data-target="#txtPublicacionNew"  required/>
                                                    <div class="input-group-append" data-target="#txtPublicacionNew" data-toggle="datetimepicker">
                                                        <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>


                                        <div class="col-md-3 col-12">
                                            <!-- text input -->
                                            <div class="form-group">
                                                <label>FEC. VENCIMIENTO</label>
                                                <div class="input-group date" id="txtVencimienteoNews" data-target-input="nearest">
                                                    <input type="text" id="FechaVencimiento" name="txtFechaVencimiento" class="form-control datetimepicker-input" data-target="#txtVencimienteoNews"  required/>
                                                    <div class="input-group-append" data-target="#txtVencimienteoNews" data-toggle="datetimepicker">
                                                        <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>


                                        <div class="col-md-3 col-12">
                                            <!-- text input -->
                                            <div class="form-group">
                                                <label>VERSION</label>
                                                <input type="text" class="form-control" name="mtxtVersionNew" id="txtVersion"
                                                    placeholder="Ingresa la Version" required>
                                            </div>
                                        </div>


                                        <div class="col-md-3 col-12">
                                            <!-- text input -->
                                            <div class="form-group">
                                                <label>PALABRAS CLAVES</label>
                                                <input type="text" class="form-control" name="mtxtClaveNew" id="txtPalabraClave"
                                                    placeholder="Ingresa Palabra clave" >
                                            </div>
                                        </div>

                                    
                                    </div>

                                    <!-- row 4 -->
                                    <div class="row">

                                        <div class="col-md-3 col-12">
                                            <!-- text input -->
                                            <div class="form-group">
                                            <input type="hidden" name="txtruta" value="" id="txtruta">
                                            <input type="hidden" name="txtNombreArchivo" id="txtNombreArchivo">
                                                <label class="control-label">Archivo</label>
                                                
                                                    <input type="file" id="mtxtArchivoNewnorma" name="mtxtArchivoNewnorma" class="form-control" onchange="registrar_archivonewnorma()" data-validation="required">
                                                    <span style="color: red">*Los documentos deben estar en formato pdf, docx o xlsx</span> 
                                                    <br>
                                                    <span style="color: red">*Los archivos no deben pesar mas de 60 MB</span> 
                                                                
                                                
                                            </div> 
                                        </div>


                                        <div class="col-md-3 col-12">
                                            <div class="form-group">

                                                <label>ÁREA RESPONSABLE</label>
                                                <select id="cboRespNew" name="cboResponsableNew" class="form-control select2bs4"
                                                    data-placeholder="Seleccione area responsable" data-validation="required">>
                                                    <option value="">::Elegir</option>
                                                    <option value="AT">AREA TÉCNICA</option>
                                                    <option value="AARR">AA. RR.</option>
                                                    <option value="LAB">LABORATORIO</option>
                                                    <option value="OI">O. I.</option>
                                                    <option value="PT">PROCESOS TÉRMICOS</option>
                                                </select>

                                            </div>
                                        </div>


                                        <div class="col-md-6 col-12">
                                            <div class="form-group">
                                                <label for="">COMENTARIOS</label>
                                                <textarea class="form-control" id="" name="mtxtComentariosNew" rows="1"></textarea>
                                            </div>
                                        </div>

                                    
                                    </div>
                                    
                                    <div class="row">
                                        <div class="col-12">
                                            <div class="card card-success">
                                                <div class="card-header">
                                                    <h4 class="card-title w-100">
                                                        <a class="d-block w-100" data-toggle="collapse" href="#collapseOne">
                                                        <i class="fa fa-plus"></i> <i class="fa fa-calendar"></i>  Ingreso de fechas en vigencia y notas
                                                        </a>
                                                    </h4>
                                                </div>
                                            
                                                <div class="card-body">
                                                    <div id="accordion">
                                                        <div id="collapseOne" class="collapse hide" data-parent="#accordion">
                                                                        <div class="card-body">

                                                                            <div class="row col-md-10 mx-auto">
                                                                                <div class="col-md-6 col-12">
                                                                                    <div class="form-group">
                                                                                        <label>FEC. VIGENCIA 1</label>
                                                                                        <div class="input-group date" id="txtFechVigencia1" data-target-input="nearest">
                                                                                            <input type="text" id="FechaVencimiento" name="txtFechaVigencia1" class="form-control datetimepicker-input" data-target="#txtFechVigencia1" />
                                                                                            <div class="input-group-append" data-target="#txtFechVigencia1" data-toggle="datetimepicker">
                                                                                                <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>

                                                                                <div class="col-md-6 col-12">
                                                                                    <!-- text input -->
                                                                                    <div class="form-group">
                                                                                        <label>NOTA 1</label>
                                                                                        <textarea class="form-control" id="" rows="1" placeholder="Ingresar Nota 1" name="mtxtNota1"></textarea>
                                                                                    </div>
                                                                                </div>
                                                                            </div>


                                                                            <div class="row col-md-10 mx-auto">
                                                                                <div class="col-md-6 col-12">
                                                                                    <div class="form-group">
                                                                                        <label>FEC. VIGENCIA 2</label>
                                                                                        <div class="input-group date" id="txtFechVigencia2" data-target-input="nearest">
                                                                                            <input type="text" id="FechaVencimiento" name="txtFechaVigencia2" class="form-control datetimepicker-input" data-target="#txtFechVigencia2"  />
                                                                                            <div class="input-group-append" data-target="#txtFechVigencia2" data-toggle="datetimepicker">
                                                                                                <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>

                                                                                <div class="col-md-6 col-12">
                                                                                    <!-- text input -->
                                                                                    <div class="form-group">
                                                                                        <label>NOTA 2</label>
                                                                                        <textarea class="form-control" id="" rows="1" placeholder="Ingresar Nota 2" name="mtxtNota2"></textarea>
                                                                                    </div>
                                                                                </div>
                                                                            </div>


                                                                            <div class="row col-md-10 mx-auto">
                                                                                <div class="col-md-6 col-12">
                                                                                    <div class="form-group">
                                                                                        <label>FEC. VIGENCIA 3</label>
                                                                                        <div class="input-group date" id="txtFechVigencia3" data-target-input="nearest">
                                                                                            <input type="text" id="FechaVencimiento" name="txtFechaVigencia3" class="form-control datetimepicker-input" data-target="#txtFechVigencia3"  />
                                                                                            <div class="input-group-append" data-target="#txtFechVigencia3" data-toggle="datetimepicker">
                                                                                                <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>

                                                                                <div class="col-md-6 col-12">
                                                                                    <!-- text input -->
                                                                                    <div class="form-group">
                                                                                        <label>NOTA 3</label>
                                                                                        <textarea class="form-control" id="" rows="1" placeholder="Ingresar Nota 3" name="mtxtNota3"></textarea>
                                                                                    </div>
                                                                                </div>
                                                                            </div>


                                                                            <div class="row col-md-10 mx-auto">
                                                                                <div class="col-md-6 col-12">
                                                                                    <div class="form-group">
                                                                                        <label>FEC. VIGENCIA 4</label>
                                                                                        <div class="input-group date" id="txtFechVigencia4" data-target-input="nearest">
                                                                                            <input type="text" id="FechaVencimiento" name="txtFechaVigencia4" class="form-control datetimepicker-input" data-target="#txtFechVigencia4"  />
                                                                                            <div class="input-group-append" data-target="#txtFechVigencia4" data-toggle="datetimepicker">
                                                                                                <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>

                                                                                <div class="col-md-6 col-12">
                                                                                    <!-- text input -->
                                                                                    <div class="form-group">
                                                                                        <label>NOTA 4</label>
                                                                                        <textarea class="form-control" id="" rows="1" placeholder="Ingresar Nota 4" name="mtxtNota4"></textarea>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>


                                    <div class="form-group">
                                        <div class="col-md-12 text-right">
                                                <button id="btnGuardarNorma" type="submit" class="btn btn-success">
                                                    <i class="fa fa-save"></i> Guardar
                                                </button>
                                            <button type="button" class="btn btn-default" id="btnCancelar"><i
                                                    class="fa fa-times-circle"></i> Cancelar</button>
                                        </div>
                                    </div>

                                </div>
                            </form>

                        </div>

                </div>
                
            </div>
          
        </div>


    </div>


    <!-- MODAL EDITAR NORMA --> 
    <div class="modal fade" tabindex="-1" id="modalEditarNorma">
        <div class="modal-dialog modal-xl">
            <form  method="post" enctype="multipart/form-data" id="frmEditarNorma">
                <div class="modal-content">


                    <div class="modal-header bg-success">
                        <h5 class="modal-title text-center">Editar Normas</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>

                    <div class="modal-body">

                            <!-- row1 -->
                            <div class="row">
                            <input type="hidden" name="mtxtidNorma" id="mtxtidNorma" value="">
                                <div class="col-md-3 col-12">
                                    <!-- text input -->
                                    <div class="form-group">
                                        <label>CODIGO</label>
                                        <input type="text" class="form-control" name="txtCodigoEdit" id="txtCodigoEdit"
                                            placeholder="Ingresa Codigo de Norma">
                                    </div>
                                </div>


                                <div class="col-md-3 col-12">
                                    <div class="form-group">

                                        <label>TIPO DE DOCUENTO</label>
                                        <select id="cboDocEdit" class="form-control select2bs4" name="cboDocumentoEdit"
                                                data-placeholder="Seleccione tipo documento" required>>
                                                <option value="">::Escoger</option>
                                        </select>

                                    </div>
                                </div>


                                <div class="col-md-3 col-12">
                                    <div class="form-group">
                                        <label class="control-label col-12" for="Codigo">IDIOMA</label>
                                        
                                            <select class="form-control select2bs4" id="idiomacboavzEdit" name="cboIdiomaEdit"
                                                data-placeholder="Seleccione idioma" style="width: 100%;" required>
                                                <option value="">::Escoger</option>
                                            </select>
                                        
                                    </div>
                                </div>

                                    <div class="col-md-3 col-12">
                                        <div class="form-group">
                                            <label class="control-label col-12" for="Codigo">PAIS</label>
                                        
                                            <select class="form-control select2bs4" id="paiscboavzEdit" name="cboPaisEdit"
                                                data-placeholder="Seleccione pais" style="width: 100%;" required>
                                                <option value="">::Escoger</option>
                                            </select>
                                        
                                        </div>
                                    </div>

                            </div>


                            <!-- row 2 -->
                            <div class="row">

                                <div class="col-md-3 col-12">
                                    <!-- text input -->
                                    <div class="form-group">
                                        <label>INSTITUCIÓN</label>
                                        <select id="institucioncboavzEdit" class="form-control select2bs4" name="cboInstitucioEdit"
                                                data-placeholder="Seleccione Insitucion">
                                                <option value="">::Escoger</option>
                                        </select>
                                    </div>
                                </div>


                                <div class="col-md-3 col-12">
                                    <div class="form-group">

                                        <label>TIPO DE PUBLICACIÓN</label>
                                        <select id="mtxtPublicacionEdit" class="form-control select2bs4" name="mtxtPublicacionEdit"
                                                data-placeholder="Seleccione tipo documento">
                                                <option value="">::Escoger</option>
                                        </select>

                                    </div>
                                </div>


                                <div class="col-md-6 col-12">
                                    <div class="form-group">
                                        <label for="">TITULO</label>
                                        <textarea class="form-control"  rows="1" name="mtxtTituloEdit" id="mtxtTituloEdit"></textarea>
                                    </div>
                                </div>


                            </div>


                            <!-- row 3 -->
                            <div class="row">

                                <div class="col-md-3 col-12">
                                    <!-- text input -->
                                    <div class="form-group">
                                        <label>FEC. PUBLICACION</label>
                                        <div class="input-group date" id="txtPublicacionEdit" data-target-input="nearest">
                                            <input type="text" id="FechaPublicacionEdit" name="txtFechaPublicacionEdit" class="form-control datetimepicker-input" data-target="#txtPublicacionEdit"  required/>
                                            <div class="input-group-append" data-target="#txtPublicacionEdit" data-toggle="datetimepicker">
                                                <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>


                                <div class="col-md-3 col-12">
                                    <!-- text input -->
                                    <div class="form-group">
                                        <label>FEC. VENCIMIENTO</label>
                                        <div class="input-group date" id="txtVencimienteoEdit" data-target-input="nearest">
                                            <input type="text" id="FechaVencimientoEdit" name="txtFechaVencimientoEdit" class="form-control datetimepicker-input" data-target="#txtVencimienteoEdit"  required/>
                                            <div class="input-group-append" data-target="#txtVencimienteoEdit" data-toggle="datetimepicker">
                                                <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>


                                <div class="col-md-3 col-12">
                                    <!-- text input -->
                                    <div class="form-group">
                                        <label>VERSION</label>
                                        <input type="text" class="form-control" name="mtxtVersionEdit" id="txtVersionEdit"
                                            placeholder="Ingresa la Version" required>
                                    </div>
                                </div>


                                <div class="col-md-3 col-12">
                                    <!-- text input -->
                                    <div class="form-group">
                                        <label>PALABRAS CLAVES</label>
                                        <input type="text" class="form-control" name="mtxtClaveEdit" id="txtPalabraClaveEdit"
                                            placeholder="Ingresa Palabra clave" >
                                    </div>
                                </div>


                            </div>

                            <!-- row 4 -->
                            <div class="row">

                                <div class="col-md-3 col-12">
                                    <!-- text input -->
                                    <div class="form-group">
                                        <input type="hidden" name="txtrutaEdit" value="" id="txtrutaEdit">
                                        <input type="hidden" name="txtNombreArchivoEdit" id="txtNombreArchivoEdit">
                                        <label class="control-label">Archivo</label>
                                        <input type="file" id="mtxtArchivoNormaEdit" name="mtxtArchivoNormaEdit" class="form-control" onchange="registrar_archivoEditarNorma()" data-validation="required">
                                        <span style="color: red">*Los documentos deben estar en formato pdf, docx o xlsx</span> 
                                        <br>
                                        <span style="color: red">*Los archivos no deben pesar mas de 60 MB</span> 
                                                        
                                        
                                    </div> 
                                </div>


                                <div class="col-md-3 col-12">
                                    <div class="form-group">

                                        <label>ÁREA RESPONSABLE</label>
                                        <select id="cboRespEdit" name="cboResponsableEdit" class="form-control select2bs4"
                                            data-placeholder="Seleccione area responsable" data-validation="required">>
                                            <option value="">::Elegir</option>
                                            <option value="AT">AREA TÉCNICA</option>
                                            <option value="AARR">AA. RR.</option>
                                            <option value="LAB">LABORATORIO</option>
                                            <option value="OI">O. I.</option>
                                            <option value="PT">PROCESOS TÉRMICOS</option>
                                        </select>

                                    </div>
                                </div>


                                <div class="col-md-6 col-12">
                                    <div class="form-group">
                                        <label for="">COMENTARIOS</label>
                                        <textarea class="form-control" id="mtxtComentarioEdit" name="mtxtComentarioEdit" rows="1"></textarea>
                                    </div>
                                </div>


                            </div>

                            <div class="row">
                                <div class="col-md-3 col-12">
                                    <div class="form-group">

                                        <label>ESTADO</label>
                                        <select id="cboFaseEdit" name="cboFaseEdit" class="form-control select2bs4"
                                            data-placeholder="Seleccione Estado de la Norma" >
                                            <option value="">::Elegir</option>
                                            <option value="0">INACTIVO</option>
                                            <option value="1">VIGENTE</option>
                                            <option value="2">PENDIENTE</option>
                                            <option value="3">OBSOLETO</option>
                                        </select>

                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-12">
                                    <div class="card card-success">
                                        <div class="card-header">
                                            <h4 class="card-title w-100">
                                                <a class="d-block w-100" data-toggle="collapse" href="#collapseOne">
                                                <i class="fa fa-plus"></i> <i class="fa fa-calendar"></i>  Ingreso de fechas en vigencia y notas
                                                </a>
                                            </h4>
                                        </div>
                                    
                                        <div class="card-body">
                                            <div id="accordion">
                                                <div id="collapseOne" class="collapse hide" data-parent="#accordion">
                                                    <div class="card-body">

                                                        <div class="row col-md-10 mx-auto">
                                                            <div class="col-md-6 col-12">
                                                                <div class="form-group">
                                                                    <label>FEC. VIGENCIA 1</label>
                                                                    <div class="input-group date" id="txtFechVigencia1Edit" data-target-input="nearest">
                                                                        <input type="text" id="FechaVencimientoEdit1" name="txtFechaVigencia1Edit" class="form-control datetimepicker-input" data-target="#txtFechVigencia1Edit" />
                                                                        <div class="input-group-append" data-target="#txtFechVigencia1Edit" data-toggle="datetimepicker">
                                                                            <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>

                                                            <div class="col-md-6 col-12">
                                                                <!-- text input -->
                                                                <div class="form-group">
                                                                    <label>NOTA 1</label>
                                                                    <textarea class="form-control" id="mtxtNota1Edit1" rows="1" placeholder="Ingresar Nota 1" name="mtxtNota1Edit"></textarea>
                                                                </div>
                                                            </div>
                                                        </div>


                                                        <div class="row col-md-10 mx-auto">
                                                            <div class="col-md-6 col-12">
                                                                <div class="form-group">
                                                                    <label>FEC. VIGENCIA 2</label>
                                                                    <div class="input-group date" id="txtFechVigencia2Edit" data-target-input="nearest">
                                                                        <input type="text" id="FechaVencimientoEdit2" name="txtFechaVigencia2Edit" class="form-control datetimepicker-input" data-target="#txtFechVigencia2Edit"  />
                                                                        <div class="input-group-append" data-target="#txtFechVigencia2Edit" data-toggle="datetimepicker">
                                                                            <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>

                                                            <div class="col-md-6 col-12">
                                                                <!-- text input -->
                                                                <div class="form-group">
                                                                    <label>NOTA 2</label>
                                                                    <textarea class="form-control" id="mtxtNota2Edit" rows="1" placeholder="Ingresar Nota 2" name="mtxtNota2Edit"></textarea>
                                                                </div>
                                                            </div>
                                                        </div>


                                                        <div class="row col-md-10 mx-auto">
                                                            <div class="col-md-6 col-12">
                                                                <div class="form-group">
                                                                    <label>FEC. VIGENCIA 3</label>
                                                                    <div class="input-group date" id="txtFechVigencia3Edit" data-target-input="nearest">
                                                                        <input type="text" id="FechaVencimientoEdit3" name="txtFechaVigencia3Edit" class="form-control datetimepicker-input" data-target="#txtFechVigencia3Edit"  />
                                                                        <div class="input-group-append" data-target="#txtFechVigencia3Edit" data-toggle="datetimepicker">
                                                                            <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>

                                                            <div class="col-md-6 col-12">
                                                                <!-- text input -->
                                                                <div class="form-group">
                                                                    <label>NOTA 3</label>
                                                                    <textarea class="form-control" id="mtxtNota3Edit" rows="1" placeholder="Ingresar Nota 3" name="mtxtNota3Edit"></textarea>
                                                                </div>
                                                            </div>
                                                        </div>


                                                        <div class="row col-md-10 mx-auto">
                                                            <div class="col-md-6 col-12">
                                                                <div class="form-group">
                                                                    <label>FEC. VIGENCIA 4</label>
                                                                    <div class="input-group date" id="txtFechVigencia4Edit" data-target-input="nearest">
                                                                        <input type="text" id="FechaVencimientoEdit4" name="txtFechaVigencia4Edit" class="form-control datetimepicker-input" data-target="#txtFechVigencia4Edit"  />
                                                                        <div class="input-group-append" data-target="#txtFechVigencia4Edit" data-toggle="datetimepicker">
                                                                            <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>

                                                            <div class="col-md-6 col-12">
                                                                <!-- text input -->
                                                                <div class="form-group">
                                                                    <label>NOTA 4</label>
                                                                    <textarea class="form-control" id="mtxtNota4Edit" rows="1" placeholder="Ingresar Nota 4" name="mtxtNota4Edit"></textarea>
                                                                </div>
                                                            </div>
                                                        </div>

                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        

                    </div>
                    

                    <div class="modal-footer">
                        <button type="reset" class="btn btn-secondary" id="btnCloseEditarNormaModal" data-dismiss="modal"><i class="fa fa-fa-times-circle"></i> Cancelar</button>
                        <button type="submit" class="btn btn-success"><i class="fa fa-save"></i> Guardar Cambios</button>
                    </div>


                </div>
            </form>
        </div>
    </div>
    <!--FIN MODAL EDITAR NORMA -->

    <!-- MODAL AGREGAR DOCUMENTO --> 
    <div class="modal fade" tabindex="-1" id="modalVincularguia">
        <div class="modal-dialog modal-xl">
                <div class="modal-content">


                    <div class="modal-header bg-success">
                        <h5 class="modal-title text-center">Vinculación de Guia</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>

                    <div class="modal-body">

                        <div class="form-group text-right">
                                <button class="btn btn-warning text-white" data-toggle="modal" data-target="#modalAgregarGuia">
                                    <i class="fa fa-plus-square"></i> 
                                    Crear Guia
                                </button>           
                        </div>

                        
                        <table id="tblGuia" class="table table-bordered table-striped " style="width:100%">
                            <thead>
                                <tr>
                                    <th>Nro.</th>       
                                    <th >Descripcción</th> 
                                    <th >Observación</th>
                                    <th >Url</th>
                                    <th ></th>
                                    <th >Archivos</th>
                                    <th >Acciones</th>               
                                </tr>
                            </thead>   

                            <tbody>
                            </tbody> 
                        </table>
                     
                        

                    </div>
                    

                    <div class="modal-footer">
                        <button type="reset" class="btn btn-secondary" data-dismiss="modal"><i class="fa fa-times-circle"></i> Cerrar</button>
                        
                    </div>


                </div>
        </div>
    </div>
    <!--FIN MODAL AGREGAR DOCUMENTO -->

    <!-- MODAL AGREGAR GUIA  --> 
    <div class="modal fade" tabindex="-1" id="modalAgregarGuia">
        <form id="frmGuia" method="post"  enctype="multipart/form-data">
            <div class="modal-dialog modal-lg">
                    <div class="modal-content">


                        <div class="modal-header bg-warning">
                            <h5 class="modal-title text-center text-white">Registro de Guia</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>

                        <div class="modal-body">
                        <input type="hidden" name="mtxtidnormag" class="form-control" id="mtxtidnormag">
                            <div class="row">
                                    <div class="col-md-6 col-12">
                                        <div class="form-group">
                                            <label>Detalle Guia Norma</label>
                                            <input type="text" class="form-control" name="detalle_guia" id="detalle_guia"
                                                placeholder="Ingrese Detalle de la Guia" required>
                                        </div>
                                    </div>

                                    <div class="col-md-6 col-12">
                                        <div class="form-group">
                                            <label>Observación Guia Norma</label>
                                            <input type="text" class="form-control" name="observacion_guia" id="observacion_guia"
                                                placeholder="Ingrese Observación de la Guia">
                                        </div>
                                    </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6 col-12">
                                    <div class="form-group">
                                        <label>Norma Archivo</label>
                                        <input type="hidden" name="mtxtitemguia"  id="mtxtitemguia" value="">
                                        <input type="hidden" name="normaArchivo" id="normaArchivo" value="">
                                        <input type="text" class="form-control" name="norma_archivo" id="norma_archivo" value="" disabled>
                                    </div>
                                </div>

                                <div class="col-md-6 col-12">
                                    <div class="form-group">
                                        <label>URL</label>
                                        <input type="text" class="form-control" name="url_guia" id="url_guia"
                                            placeholder="Ingrese la URL de la Guia">
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-7 col-12 mx-auto">
                            
                                <label>Adjuntar Archivo Guia</label>
                                <div class="input-group ">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" id="inputGroupFileAddon01">Adjuntar</span>
                                    </div>
                                    <div class="custom-file">
                                        <input type="hidden" name="archivoGuia" id="archivoGuia">
                                        <input type="file" class="custom-file-input" id="mtxtguianormarch" name="mtxtguianormarch" onchange="registrar_archivoGuia()">
                                        <label class="custom-file-label archivoGuia" for="inputGroupFile01">Seleccionar Archivo</label>
                                    </div>
                                </div>
                            </div>

                        </div>
                        

                        <div class="modal-footer">
                            <button class="btn btn-info" type="button" id="mbtnVincular" data-toggle="modal" data-target="#modalVincularNorma"><i class="fa fa-link"></i> Vincular Norma</button>
                            <button type="submit" id="btnGuardarGuia" class="btn btn-warning"><i class="fa fa-check"></i> Guardar Cambios</button>
                            <button type="reset" class="btn btn-secondary" data-dismiss="modal" id="modalCerrarGuiaNorma"><i class="fa fa-times-circle"></i> Cerrar</button>
                            
                        </div>


                    </div>
            </div>
        </form>  
    </div>
    <!--FIN MODAL AGREGAR GUIA  -->

    <!-- MODAL VINCULAR NORMA/GUIA  --> 
    <div class="modal fade" tabindex="-1" id="modalVincularNorma">
        <div class="modal-dialog modal-lg">
                <div class="modal-content">


                    <div class="modal-header bg-info">
                        <h5 class="modal-title text-center text-white">Listado de Normas</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>

                    <div class="modal-body">

                        <table id="tblListNormas" class="table table-striped table-bordered table-responsive" style="width:100%">
                            <thead>
                                <tr>
                                    <th>Nro.</th>       
                                    <th>Código Norma</th> 
                                    <th>Titulo</th>
                                    <th></th>
                                </tr>
                            </thead> 
                        </table>  

                    </div>
                    

                    <div class="modal-footer">

                        <button class="btn btn-secondary" id="btnCerrarListadoNormas" data-dismiss="modal"><i class="fa fa-times-circle"></i> Cerrar</button>
                        
                    </div>


                </div>
        </div>
    </div>
    <!--FIN MODAL VINCULAR NORMA/GUIA  -->

    <!-- MODAL EDITAR GUIA  --> 
    <div class="modal fade" tabindex="-1" id="modalEditarGuia">
        <form id="frmEditarGuia" method="post"  enctype="multipart/form-data">
            <div class="modal-dialog modal-lg">
                    <div class="modal-content">


                        <div class="modal-header bg-primary">
                            <h5 class="modal-title text-center text-white">MODIFICAR GUIA</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>

                        <div class="modal-body">
                            <input type="hidden" name="idGuiaEditar" class="form-control" id="idGuiaEditar">
                            <div class="row">
                                    <div class="col-md-6 col-12">
                                        <div class="form-group">
                                            <label>Detalle Guia Norma</label>
                                            <input type="text" class="form-control" name="detalle_guiaEdit" id="detalle_guiaEdit"
                                                placeholder="Ingrese Detalle de la Guia" required>
                                        </div>
                                    </div>

                                    <div class="col-md-6 col-12">
                                        <div class="form-group">
                                            <label>Observación Guia Norma</label>
                                            <input type="text" class="form-control" name="observacion_guiaEdit" id="observacion_guiaEdit"
                                                placeholder="Ingrese Observación de la Guia">
                                        </div>
                                    </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6 col-12">
                                    <div class="form-group">
                                        <label>Norma Archivo</label>
                                        <input type="hidden" name="mtxtitemguiaEdit"  id="mtxtitemguiaEdit" value="">
                                        <input type="hidden" name="normaArchivoEdit" id="normaArchivoEdit" value="">
                                        <input type="text" class="form-control" name="norma_archivoEdit" id="norma_archivoEdit" value="" disabled>
                                    </div>
                                </div>

                                <div class="col-md-6 col-12">
                                    <div class="form-group">
                                        <label>URL</label>
                                        <input type="text" class="form-control" name="url_guiaEdit" id="url_guiaEdit"
                                            placeholder="Ingrese la URL de la Guia">
                                    </div>
                                </div>
                            </div>

                           

                            <div class="col-md-7 col-12 mx-auto">
                                <label>Actualizar Archivo Guia</label>
                                <div class="input-group ">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" id="inputGroupFileAddon01">Adjuntar</span>
                                    </div>
                                    <div class="custom-file">
                                        <input type="hidden" name="archivoGuiaEdit" id="archivoGuiaEdit">
                                        <input type="file" class="custom-file-input" id="mtxtguianormarchEdit" name="mtxtguianormarchEdit" onchange="registrar_archivoEditarGuia()">
                                        <label class="custom-file-label archivoGuia" id="archivoGuiaActual"  for="inputGroupFile01"></label>
                                    </div>
                                </div>
                            </div>


                        </div>

                        <div class="modal-footer">
                            <button type="submit" id="btnEditarGuia" class="btn btn-primary"><i class="fa fa-check"></i> Guardar Cambios</button>
                            <button type="reset" class="btn btn-secondary" id="btnCerrarEditarGuiaModal" data-dismiss="modal"><i class="fa fa-times-circle"></i> Cerrar</button>
                            
                        </div>


                    </div>
            </div>
        </form>
    </div>
    <!--FIN MODAL EDITAR GUIA  -->

    <!-- MODAL VINCULAR modalAddInstitucion  --> 
    <div class="modal fade" tabindex="-1" id="modalAddInstitucion">
        <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <form id="frmAddInstitucionModal" method="post" enctype="multipart/form-data">

                        <div class="modal-header bg-primary">
                            <h5 class="modal-title text-center text-white">AÑADIR INSTITUCIÓN</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>

                        <div class="modal-body">
                            
                                <div class="col-md-8 col-12 mx-auto">
                                    <!-- text input -->
                                    <div class="form-group">
                                        <label>NOMBRE DE INSTITUCIÓN</label>
                                        <input type="text" class="form-control" name="txtAddInstitucion" id="txtAddInstitucion"
                                            placeholder="Ingresa Nombre de la Institución" required >
                                    </div>
                                </div>

                                <div class="col-md-8 col-12 mx-auto">
                                    <!-- text input -->
                                    <div class="form-group">
                                        <label>ABREVIATURA DE INSTITUCIÓN</label>
                                        <input type="text" class="form-control" name="txtAddAbreviInstitu" id="txtAddAbreviInstitu"
                                            placeholder="Ingresa la Abreviatura de la Institución" required >
                                    </div>
                                </div>
                            
                        </div>
                        

                        <div class="modal-footer">

                            <button class="btn btn-primary" type="submit"><i class="fa fa-save"></i> Agregar Institucion</button>
                            <button class="btn btn-secondary" type="button" data-dismiss="modal"><i class="fa fa-times-circle"></i> Cerrar</button>
                            
                        </div>
                    </form>

                </div>
        </div>
    </div>
    <!--FIN MODAL VINCULAR modalAddInstitucion  -->

    <!-- MODAL VINCULAR modalAddPublicacion  --> 
    <div class="modal fade" tabindex="-1" id="modalAddPublicacion">
        <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <form id="frmAddPublicacionModal" method="post" enctype="multipart/form-data">

                        <div class="modal-header bg-primary">
                            <h5 class="modal-title text-center text-white">AÑADIR PUBLICACIÓN</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>

                        <div class="modal-body">
                            
                                <div class="col-md-8 col-12 mx-auto">
                                    <!-- text input -->
                                    <div class="form-group">
                                        <label>NOMBRE DE PUBLICACIÓN</label>
                                        <input type="text" class="form-control" name="txtAddPublicacion" id="txtAddPublicacion"
                                            placeholder="Ingresa Nombre de la Publicacion" required>
                                    </div>
                                </div>

                                <div class="col-md-8 col-12 mx-auto">
                                    <!-- text input -->
                                    <div class="form-group">
                                        <label>ABREVIATURA DE PUBLICACIÓN</label>
                                        <input type="text" class="form-control" name="txtAddAbreviPubli" id="txtAddAbreviPubli"
                                            placeholder="Ingresa la Abreviatura de la Publicacion" required>
                                    </div>
                                </div>
                            
                        </div>
                        

                        <div class="modal-footer">

                            <button class="btn btn-primary" type="submit"><i class="fa fa-save"></i> Agregar Publicacion</button>
                            <button class="btn btn-secondary" type="button" data-dismiss="modal"><i class="fa fa-times-circle"></i> Cerrar</button>
                            
                        </div>
                    </form>

                </div>
        </div>
    </div>
    <!--FIN MODAL VINCULAR modalAddPublicacion  -->
    
</section>
<!-- /.Main content -->

<!-- Script Generales -->
<script type="text/javascript">
    var baseurl = "<?php echo base_url();?>"; 
</script>