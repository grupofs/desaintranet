<?php
    $idusu = $this -> session -> userdata('s_idusuario');
    $idemp = $this -> session -> userdata('s_idempleado');
    $idadm = $this -> session -> userdata('s_idadministrado');
    $usu = $this -> session -> userdata('s_usuario');
    $cusuario = $this -> session -> userdata('s_cusuario');
    $imgperfil = $this->session->userdata('s_druta'); 
    $cia = $this-> session-> userdata('s_cia');
  
   
?>


<!-- content-header -->
<div class="content-header">   
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-6">
        <h1 class="m-0 text-dark">MÓDULO DE GESTION DOCUMENTARIA 1 </h1>
      </div>
      <div class="col-6">
        <ol class="breadcrumb float-right">
          <li class="breadcrumb-item"><a href="<?php echo public_base_url(); ?>cprincipal/principal">Inicio</a></li>
          <li class="breadcrumb-item">Gestión Documentaria</li>
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
        
      <div class="card card-success">
        <div class="card-header">
          <h3 class="card-title"><i class="fa fa-search"></i> Buscar</h3>
          <div class="card-tools">
            <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i></button>
          </div>
        </div>
        
        <div class="card-body">
        <input type="hidden" name="mtxtidusunormas" class="form-control" id="mtxtidusunormas" value="<?php echo $idusu ?>">
          <div class="row">

            <div class="col-md-3 col-12">
              <!-- text input -->
              <div class="form-group">
                <label>TIPO DOCUMENTO / PUBLICACIÓN</label>
                <select id="cboDoc" class="form-control select2" name="TIPODOC"  multiple="multiple" data-placeholder="Seleccione tipo documento">
                  <option value="">TODOS</option>  
                </select>
              </div>
            </div>


            <div class="col-md-3 col-12">
              <div class="form-group">

                <label>ÁREA RESPONSABLE</label>
                <select id="cboResp" name="RESP" class="form-control select2" style="width: 100%; height: 30px;" multiple="multiple" data-placeholder="Seleccione area responsable">
                  <option value="%">TODOS</option>
                  <option value="AT" >AREA TÉCNICA</option>
                  <option value="AARR" >AA. RR.</option>
                  <option value="LAB" >LABORATORIO</option>
                  <option value="OI" >O. I.</option>
                  <option value="PT" >PROCESOS TÉRMICOS</option>
              </select>

              </div>
            </div>


            <div class="col-md-3 col-12">
              <div class="form-group">
                <label>Titulo de Norma</label>
                <input type="text" class="form-control" name="DESCRI" id="txtDescri" placeholder="Ingresa Titulo de Norma">
              </div>
            </div>


            <div class="col-md-3 col-12">
              <label>Estado de Norma</label>

              <div class="form-group">
                <input type="radio" name="rbtEst" value="1" />
                Vigentes
                <input type="radio" name="rbtEst" value="3" />
                Obsoletos
                <input type="radio" name="rbtEst" value="%" checked/>
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
                  <div class="input-group date" id="txtFDesde" data-target-input="nearest" >
                    <input type="text" id="FechaInicial" name="fi" class="form-control datetimepicker-input" data-target="#txtFDesde" disabled/>
                    <div class="input-group-append" data-target="#txtFDesde" data-toggle="datetimepicker">
                        <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                    </diV>
                   </div>
              </div>

              <div class="col-md-3 col-12">
                  <div class="input-group date" id="txtFFinal" data-target-input="nearest" >
                    <input type="text" id="FechaTermino" name="ff" class="form-control datetimepicker-input" data-target="#txtFFinal" disabled/>
                    <div class="input-group-append" data-target="#txtFFinal" data-toggle="datetimepicker">
                        <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                    </diV>
                  </div>
              </div>  


              <div class="form-group">   
                  <div class="checkbox">
                      <label>
                          <input data-val="true" data-val-required="El campo Todos es obligatorio." id="Todos" name="Todos" type="checkbox" value="true" /><input name="Todos" type="hidden" value="false" /> Todos
                      </label>
                  </div>
              </div>
            </div>

            <div class="row">
              <div class="col-md-6">
                <div class="form-group">
                  <label class="control-label col-12" for="Codigo">Idioma</label>
                  <div class="col-8">
                    <select class="form-control select2" id="idiomacboavz" name="IDIOMA" multiple="multiple" data-placeholder="Seleccione idioma" style="width: 100%;">
                      <option value="%">TODOS</option>
                    </select>
                  </div>
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group">
                  <label class="control-label col-12" for="Codigo">Pais</label>
                  <div class="col-8">
                    <select class="form-control select2" id="paiscboavz" name="PAIS" multiple="multiple" data-placeholder="Seleccione pais" style="width: 100%;">
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
                    <select class="form-control select2" id="institucioncboavz" name="INSTITUTO" multiple="multiple" data-placeholder="Seleccione institución" style="width: 100%;">
                      <option value="%">TODOS</option>
                    </select>
                  </div>
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group">
                  <label class="control-label col-12" for="Codigo">Palabras Claves</label>
                  <div class="col-8">
                    <input type="text" class="form-control " id="placlavecboavz" name="PALCLAVE" placeholder="Ingrese palabra clave">
                  </div>
                </div>
              </div>
            </div>

          </div>


          <div class="form-group">
            <div class="col-md-12 text-right">   
              <button id="btnBuscar" type="button" class="btn btn-success"><i class="fa fa-search"></i>Buscar</button>
              <button type="button" class="btn btn-default disabled" id="btnNuevo" name="btnNuevo" data-toggle="modal" data-target="#modalNuevaNorma"><i class="fa fa-fw fa-plus"></i>Crear Nuevo</button> 
              <button type="button" class="btn btn-info" id="btnexcelNormas" disabled="true"><i class="fa fw fa-file-excel-o"></i> Exportar Excel</button>      
            </div>
          </div>


        
          <div class="row">
              <div class="col-12">
                  <div class="card card-outline card-success">
                      <div class="card-header">
                          <h3 class="card-title">Listado de Normas</h3>
                      </div>
                  
                      <div class="card-body">
                          <table id="tblListado" class="table table-bordered table-responsive display" style="width:100%">
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

  
      </div>

    </div>
</section>
<!-- /.Main content -->

<!-- Script Generales -->
<script type="text/javascript">
    var baseurl = "<?php echo base_url();?>"; 
</script>