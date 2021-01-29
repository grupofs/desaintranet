<?php
    $idusu = $this -> session -> userdata('s_idusuario');
    $codusu = $this -> session -> userdata('s_cusuario');
    $infousuario = $this->session->userdata('s_infodato');
?>

<style>

</style>

<!-- content-header -->
<div class="content-header">   
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1 class="m-0 text-dark">CONSULTA GENERAL</h1>
      </div>
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="<?php echo public_base_url(); ?>main">Home</a></li>
          <li class="breadcrumb-item active">Capacitaciones</li>
        </ol>
      </div>
    </div>
  </div>
</div>
<!-- /.content-header -->

<!-- Main content -->
<section class="content">
    <div class="container-fluid">  
        <form class="form-horizontal" id="frmexceltramar" name="frmexceltramar" action="<?= base_url('ar/tramites/cexcelExport/exceltramardigesa')?>" method="POST" enctype="multipart/form-data" role="form">  
        <div class="card card-success">        
            <div class="card-header">
                <h3 class="card-title">BUSQUEDA</h3>
                <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i></button>
                </div>
            </div>
            
            <div class="card-body">
                <input type="hidden" name="hdnidusu" class="form-control" id="hdnidusu" value="<?php echo $idusu ?>">
                <div class="row"> 
                    <div class="col-md-4">
                        <div class="form-group">
                            <label>Clientes</label>
                            <select class="form-control select2bs4" id="cboClie" name="cboClie" style="width: 100%;">
                                <option value="" selected="selected">Cargando...</option>
                            </select>
                        </div>
                    </div>   
                    <div class="col-md-3">
                        <div class="form-group">
                            <label>Tipo Consulta</label>
                            <select class="form-control select2bs4" id="cboesttramite" name="cboesttramite" style="width: 100%;">
                                <option value="C" selected="selected">Por Capacitación</option>
                                <option value="T">Por Tiendas</option>
                                <option value="P">Por Participante</option>
                            </select>
                        </div>
                    </div> 
                    <div class="col-sm-5">
                        <div class="form-group">
                            <label>&nbsp;&nbsp;</label> 
                            <input type="text" class="form-control" id="txtbuscar" name="txtbuscar" placeholder="...">
                        </div>
                    </div>      
                </div>
            </div>                
                        
            <div class="card-footer justify-content-between"> 
                <div class="row">
                    <div class="col-md-12">
                        <div class="text-right">
                            <button type="button" class="btn btn-primary" id="btnBuscar"><i class="fas fa-search"></i>&nbsp;&nbsp;Buscar</button>        
                        </div>
                    </div>
                </div>
            </div>
        </div>
        </form>
        <div class="row">
            <div class="col-12">
                <div class="card card-outline card-success">
                    <div class="card-header">
                        <h3 class="card-title">Listado  - por <label id="lblTipobuscar"></label></h3>
                    </div>                
                    <div class="card-body" id="divtblcapa" style="overflow-x: scroll;">
                        <table id="tblListporcapa" class="table table-striped table-bordered" style="width:100%">
                            <thead>
                            <tr>
                                <th>Curso</th>
                                <th></th>
                                <th>Establecimiento</th>
                                <th>Participante</th>
                                <th>DNI</th>
                                <th>Nota</th>
                                <th></th>
                            </tr>
                            </thead>
                            <tbody>
                            </tbody>
                        </table>
                    </div>                
                    <div class="card-body" id="divtbltienda" style="overflow-x: scroll;">
                        <table id="tblListportienda" class="table table-striped table-bordered" style="width:100%">
                            <thead>
                            <tr>
                                <th>Establecimiento</th>
                                <th></th>
                                <th>Curso</th>
                                <th>Participante</th>
                                <th>DNI</th>
                                <th>Nota</th>
                                <th></th>
                            </tr>
                            </thead>
                            <tbody>
                            </tbody>
                        </table>
                    </div>               
                    <div class="card-body" id="divtblparti" style="overflow-x: scroll;">
                        <table id="tblListporparti" class="table table-striped table-bordered" style="width:100%">
                            <thead>
                            <tr>
                                <th>Participante</th>
                                <th></th>
                                <th>Curso</th>
                                <th>Establecimiento</th>
                                <th>Nota</th>
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