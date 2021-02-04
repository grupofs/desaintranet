<?php
    $idusu = $this -> session -> userdata('s_idusuario');
?>

<style>
</style>

<!-- content-header -->
<div class="content-header">   
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1 class="m-0 text-dark">CONSULTA LABORATORIO</h1>
      </div>
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="<?php echo public_base_url(); ?>main">Home</a></li>
          <li class="breadcrumb-item active">Laboratorio</li>
        </ol>
      </div>
    </div>
  </div>
</div>
<!-- /.content-header -->

<!-- Main content -->
<section class="content">
    <div class="container-fluid">  
        <div class="card card-primary">
            <div class="card-header">
                <h3 class="card-title">BUSQUEDA</h3>
                <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i></button>
                </div>
            </div>
          
            <div class="card-body">
                <input type="hidden" name="mtxtidusupropu" class="form-control" id="mtxtidusupropu" value="<?php echo $idusu ?>">
                <div class="row"> 
                    <div class="col-md-4">
                        <div class="form-group">
                            <label>Clientes</label>
                            <select class="form-control select2bs4" id="cboclieserv" name="cboclieserv" style="width: 100%;">
                                <option value="" selected="selected">Cargando...</option>
                            </select>
                        </div>
                    </div>   
                    <div class="col-md-3">
                        <div class="form-group">
                            <label>Tipo Consulta</label>
                            <select class="form-control select2bs4" id="cbotipobuscar" name="cbotipobuscar" style="width: 100%;">
                                <option value="C" selected="selected">Por Cotizacion</option>
                                <option value="T">Por OT</option>
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
                            <button type="button" class="btn btn-primary" id="btnBuscar"><i class="fas fa-search"></i> Buscar</button>    
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <div class="card card-outline card-primary">
                    <div class="card-header">
                        <h3 class="card-title">Listado </h3>
                    </div>
                
                    <div class="card-body">
                        <table id="tblListconsinf" class="table table-striped table-bordered" style="width:100%">
                            <thead>
                            <tr>
                                <th></th>
                                <th>CLIENTE</th>
                                <th>NRO COTIZACION</th>
                                <th>FECHA COTIZACION</th>
                                <th>NRO OT</th>
                                <th>FECHA OT</th>
                                <th>INFORMES</th>
                                <th>USUARIO CREACION</th>
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