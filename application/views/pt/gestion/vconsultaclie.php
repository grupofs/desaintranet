<?php
    $idusu = $this -> session -> userdata('s_idusuario');
    $codusu = $this -> session -> userdata('s_cusuario');
    $infousuario = $this->session->userdata('s_infodato');
?>

<style>

    .btn-outline-primary {
        background: transparent;
        box-shadow: none;
        border-radius: 2px;
        margin: 2px 5px 2px 5px;
        border: 1px solid #428bca;
        color: #428bca;
    }
    .btn-outline-primary:hover{
        border:1px solid #2a6496;
        color:#fff;
        background-color:#2a6496;
        box-shadow:none;
    }

    .col-largo{
        min-width: 300px !important;
    }
    .col-mediano {
        min-width: 150px !important;
    }
    .col-corto {
        min-width: 100px !important;
    }

    table.dataTable tbody tr:hover {
        background-color:#C1DDE7 !important;
    }
</style>

<!-- content-header -->
<div class="content-header">   
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1 class="m-0 text-dark">CONSULTA CLIENTE</h1>
      </div>
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="<?php echo public_base_url(); ?>cprincipal/principal">Home</a></li>
          <li class="breadcrumb-item active">Gestion Procesos Termicos</li>
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
                <h3 class="card-title">BUSQUEDA</h3>
            </div>
          
          <div class="card-body">
              <input type="hidden" name="mtxtidusupropu" class="form-control" id="mtxtidusupropu" value="<?php echo $idusu ?>">
              <div class="row">
                  <div class="col-md-4">
                      <div class="form-group">
                          <label>Clientes</label>
                          <select class="form-control select2bs4" id="cboClie" name="cboClie" style="width: 100%;">
                              <option value="" selected="selected">Cargando...</option>
                          </select>
                      </div>
                  </div>
                  <div class="col-md-4">
                      <div class="form-group">
                          <label>Servicios</label>
                          <select class="form-control select2bs4" id="cboServ" name="cboServ" style="width: 100%;">
                              <option value="" selected="selected">Cargando...</option>
                          </select>
                      </div>
                  </div>
              </div>
          </div>
        
          <div class="card-footer">
              <div class="text-right">
              </div>
          </div>
      </div>
      <div class="row">
          <div class="col-12">
              <div class="card card-outline card-success">
                  <div class="card-header">
                      <h3 class="card-title">EQUIPOS</h3>
                        <div class="card-tools">
                            <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i></button>
                        </div>
                  </div>              
                  <div class="card-body" id="listEquiServ02">
                      <table id="tblListEquipos02" class="table table-striped table-bordered" style="width:100%">
                          <thead>
                          <tr>
                              <th>Cantidad</th>
                              <th>Descripcion Equipo</th>
                              <th>Tipo Equipo</th>
                              <th>Fabricante</th>
                              <th>Medio Calentamiento</th>
                              <th>Canastillas</th>
                              <th># Identificacion</th>
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
      <div class="row">
          <div class="col-12">
              <div class="card card-outline card-success">
                  <div class="card-header">
                      <h3 class="card-title">PRODUCTOS</h3>
                        <div class="card-tools">
                            <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i></button>
                        </div>
                  </div>
              
                  <div class="card-body" id="listProdServ02">
                      <table id="tblListProducto02" class="table table-striped table-bordered" style="width:100%">
                          <thead>
                          <tr>
                              <th></th>
                              <th>Nombre Producto</th>
                              <th>Tipo Producto</th>
                              <th>Medio de Calentamiento</th>
                              <th>Tipo de Envase</th>
                              <th>Medida</th>
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