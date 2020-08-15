<?php
    $idusuario  = $this-> session-> userdata('s_idusuario');
    $cia        = $this-> session-> userdata('s_cia');
?>

<!-- content-header -->
<div class="content-header">   
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-6">
        <h1 class="m-0 text-dark">MÓDULO DE NORMAS</h1>
      </div>
      <div class="col-6">
        <ol class="breadcrumb float-right">
          <li class="breadcrumb-item"><a href="<?php echo public_base_url(); ?>cprincipal/principal">Inicio</a></li>
          <li class="breadcrumb-item">Biblioteca</li>
          <li class="breadcrumb-item active">Módulo de Normas</li>
        </ol>
      </div>
    </div>
  </div>
</div>
<!-- /.content-header -->

<!-- Main content -->
<section class="content">
  <div class="container-fluid">  
    <div class="card card-success">
      <div class="card-header">
        <h3 class="card-title"><i class="fas fa-search"></i> BUSQUEDA</h3>
        <div class="card-tools">
          <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i></button>
        </div>
      </div>
        
      <div class="card-body">
        <input type="hidden" class="form-control" id="mtxtidusunormas" name="mtxtidusunormas" value="<?php echo $idusuario ?>">
        <div class="row">
          <div class="col-md-4">
            <div class="form-group">
              <label>Tipo Documento / Publicación</label>
              <select class="select2bs4" id="cboDoc" name="TIPODOC"  multiple="multiple" data-placeholder="Seleccione tipo documento" style="width: 100%;">
                <option value="">Todos</option>  
              </select>
            </div>
          </div>
          <div class="col-md-4">
            <div class="form-group">
              <label>Área Responsable</label>
              <select class="select2bs4" id="cboResp" name="RESP" multiple="multiple" data-placeholder="Seleccione area responsable" style="width: 100%;">
                <option value="%">Todos</option>
                <option value="AT">AREA TÉCNICA</option>
                <option value="AARR">AA. RR.</option>
                <option value="LAB">LABORATORIO</option>
                <option value="OI">O. I.</option>
                <option value="PT">PROCESOS TÉRMICOS</option>
              </select>
            </div>
          </div>
          <div class="col-md-4">
            <label>Estado de la Norma</label>
            <div class="form-group clearfix">
              <div class="icheck-primary d-inline">
                <input type="radio" id="rbtVig" name="rbtEst" value="1">
                <label for="rbtVig">Vigentes</label>
              </div>
              <div class="icheck-primary d-inline">
                <input type="radio" id="rbtObs" name="rbtEst" value="3">
                <label for="rbtObs">Obsoletos</label>
              </div>
              <div class="icheck-primary d-inline">
                <input type="radio" id="rbtTod" name="rbtEst" value="%" checked>
                <label for="rbtTod">Todos</label>
              </div>          
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-md-8">
            <div class="form-group">
              <label>Titulo de la Norma</label>
              <input type="text" class="form-control" name="DESCRI" id="txtDescri" placeholder="Ingresa Titulo de Norma">
            </div>
          </div>
          <div class="col-md-4">
            <label>&nbsp;</label>              
          </div>
        </div>
        <!-- formulario busqueda avanazada -->
        <div class="row">   
          <div class="col-md-12">               
          <div id="avanzado" style="display: none;">
            <fieldset class="scheduler-border" id="regCapa">
              <legend class="scheduler-border text-primary">Avanzados</legend>
              <div class="row">
                <div class="col-md-4">    
                  <div class="checkbox"><label>
                    <input type="checkbox" id="chkFpubl" /> <b>Fec. Publicación :: Del</b>
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
                <div class="col-md-4">
                  <div class="form-group">
                    <label>Idioma</label>
                      <select class="form-control select2" id="idiomacboavz" name="IDIOMA" multiple="multiple" data-placeholder="Seleccione idioma" style="width: 100%;">
                        <option value="%">TODOS</option>
                      </select>
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-md-4">
                  <div class="form-group">
                    <label>Pais</label>
                    <select class="form-control select2" id="paiscboavz" name="PAIS" multiple="multiple" data-placeholder="Seleccione pais" style="width: 100%;">
                      <option value="%">TODOS</option>
                    </select>
                  </div>
                </div>
                <div class="col-md-4">
                  <div class="form-group">
                    <label>Institución</label>
                    <select class="form-control select2" id="institucioncboavz" name="INSTITUTO" multiple="multiple" data-placeholder="Seleccione institución" style="width: 100%;">
                      <option value="%">TODOS</option>
                    </select>
                  </div>
                </div>
                <div class="col-md-4">
                  <div class="form-group">
                    <label>Palabras Claves</label>
                    <input type="text" class="form-control " id="placlavecboavz" name="PALCLAVE" placeholder="Ingrese palabra clave">
                  </div>
                </div>
              </div>
            </fieldset>
          </div>    
          </div>       
        </div>
        <!-- fin -->
      </div>
                        
      <div class="card-footer justify-content-between"> 
        <div class="row">
          <div class="col-md-4">
            <div class="form-group clearfix">
              <div class="icheck-primary d-inline">
                <input type="checkbox" id="chkAvanzado" name="chkAvanzado">
                <label for="chkAvanzado">Búsqueda Avanzada</label>
              </div>     
            </div>
          </div> 
          <div class="col-md-8">
            <div class="text-right">
              <button type="button" class="btn btn-primary" id="btnBuscar"><i class="fas fa-search"></i> Buscar</button> 
            </div>
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
          <div class="card-footer justify-content-between"> 
            <div class="row">
              <div class="col-md-12">
                <div class="text-left"> 
                  <button type="button" class="btn btn-outline-info disabled" id="btnNuevo" name="btnNuevo" data-toggle="modal" data-target="#modalNuevaNorma"><i class="fas fa-plus"></i>Crear Nuevo</button>
                  <button type="button" class="btn btn-outline-info" id="btnexcelNormas" disabled="true"><i class="fa fw fa-file-excel-o"></i> Exportar Excel</button>
                </div>
              </div>
            </div>
          </div> 
          <div class="card-body">
            <table id="tblListado" class="table table-striped table-bordered" style="width:100%">
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
</section>
<!-- /.Main content -->

<!-- Script Generales -->
<script type="text/javascript">
    var baseurl = "<?php echo base_url();?>"; 
</script>