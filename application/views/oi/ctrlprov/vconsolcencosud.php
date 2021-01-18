<?php
    $idusuario = $this-> session-> userdata('s_idusuario');
    $idrol = $this-> session-> userdata('s_idrol');
    $cia = $this-> session-> userdata('s_cia');
?>

<style>
</style>

<!-- content-header -->
<div class="content-header">   
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1 class="m-0 text-dark">CONSOLIDADO CENCOSUD
            <small>Insp. Proveedores</small>
        </h1>
      </div>
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="<?php echo public_base_url(); ?>main"> <i class="fas fa-tachometer-alt"></i>Home</a></li>
          <li class="breadcrumb-item active">A.T.</li>
        </ol>
      </div>
    </div>
  </div>
</div>
<!-- /.content-header -->

<!-- Main content -->
<section class="content">
    <div class="container-fluid">
        <form class="form-horizontal" id="frmBuscar">
        <div class="card card-primary">        
            <div class="card-header">
                <h3 class="card-title">CONSULTAR</h3>
                <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i></button>
                </div>
            </div>        
            <div class="card-body">
                <input type="hidden" name="hdnidusu" class="form-control" id="hdnidusu" value="<?php echo $idusuario ?>">
                <div class="row">     
                    <div class="col-md-5">
                        <div class="form-group">
                            <label>Proveedor</label>
                            <select class="form-control select2bs4" id="cboProveedor" name="cboProveedor" style="width: 100%;">
                                <option value="" selected="selected">Cargando...</option>
                            </select>
                        </div>
                    </div>   
                    <div class="col-md-3">
                        <label>&nbsp;&nbsp;</label> 
                        <div class="form-group clearfix">
                        <div class="icheck-primary d-inline">
                            <input type="radio" id="rdPeriodo" name="rFbuscar" checked>
                            <label for="rdPeriodo">
                                Por Periodo
                            </label>
                        </div>
                        <div class="icheck-primary d-inline">
                            <input type="radio" id="rdFechas" name="rFbuscar" >
                            <label for="rdFechas">
                                Entre Fechas
                            </label>
                        </div>
                        </div>
                    </div>   
                    <div class="col-md-2">
                        <div class="form-group" id="divAnio"> 
                            <label>Año</label>
                            <select class="form-control select2bs4" id="cboAnio" name="cboAnio" style="width: 100%;">
                                <option value="" selected="selected">Cargando...</option>
                            </select>
                        </div>
                        <div class="form-group" id="divDesde">    
                            <label>Desde</label>                      
                            <div class="input-group date" id="txtFDesde" data-target-input="nearest">
                                <input type="text" id="txtFIni" name="txtFIni" class="form-control datetimepicker-input" data-target="#txtFDesde" />
                                <div class="input-group-append" data-target="#txtFDesde" data-toggle="datetimepicker">
                                    <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                </div>
                            </div> 
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="form-group" id="divMes">
                            <label>Mes</label>
                            <select class="form-control select2bs4" id="cboMes" name="cboMes" style="width: 100%;">
                                <option value="" selected="selected">Cargando...</option>
                            </select>
                        </div>
                        <div class="form-group" id="divHasta">       
                            <label>Hasta</label>                      
                            <div class="input-group date" id="txtFHasta" data-target-input="nearest">
                                <input type="text" id="txtFFin" name="txtFFin" class="form-control datetimepicker-input" data-target="#txtFHasta" disabled/>
                                <div class="input-group-append" data-target="#txtFHasta" data-toggle="datetimepicker">
                                    <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                </div>
                            </div>
                        </div>
                    </div>              
                </div> 
                <br>
                <div class="row"> 
                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">      
                        <label>Ciudad :</label>
                        <input type="text" name="txtCiudad" id="txtCiudad" class="form-control" value=""  >
                    </div>
                </div> 
                <br>
                <div class="row"> <!--fila03-->
                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                        <label>Tipo Busqueda</label>                        
                        <div class="form-group">
                            <div class="radio col-sm-4">
                                <label><input id="BuscarPorP" name="BuscarPor" type="radio" value="P" checked="checked" /> Proveedores</label>                         
                            </div>
                            <div class="radio col-sm-4">
                                <label><input id="BuscarPorC" name="BuscarPor" type="radio" value="C" /> Concesionarios</label>                                                       
                            </div>
                        </div> 
                    </div>
                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">      
                        <label>Categoria :</label>
                        <select id="cboAreaclie" name="cboAreaclie" class="form-control select2" style="width: 100%;">
                            <option value = "%" selected="selected">::Todos</option>
                        </select>
                    </div>
                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">      
                        <label>Estado :</label>
                        <select id="cboEstado" name="cboEstado" class="form-control select2" multiple="multiple" data-placeholder="Seleccionar" style="width: 100%;">
                            <option value = "028" >Por Programar</option>
                            <option value = "029" >Programado</option>
                            <option value = "031" >En Proceso</option>
                            <option value = "032" >Concluido OK</option>
                            <option value = "515" >Trunco</option>
                            <option value = "520" >No proveedor</option>
                        </select>
                    </div>
                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">      
                        <label>Marca :</label>
                        <input type="text" name="txtMarca" id="txtMarca" class="form-control" value=""  >
                    </div>
                </div>
            </div> 
            <!--Contenedor de botones-->       
            <div class="box-footer">            
                <div class="col-md-12 text-right">                    
                    <button type="button" class="btn btn-default" id="btnBuscarListado"><i class="fa fa-fw fa-search"></i> Buscar</button>                    
                </div>
            </div>  
            </form>
        </div> 
    </div>
 <!--FIN Contenedor de consulta-->
 <!--Contenedor del DataTable-->
    <div class="box box-primary">
        <div class="box-header with-border">
            <h3 class="box-title">Listado</h3>
        </div>
        <div class="panel-body">
            <div class="table-responsive">
                <table id="tblconsolidado" class="table table-hover table-striped" cellspacing="0"  style="width:100%">
                    <thead>
                        <tr>
                            <th>N°</th>
                            <th>TIPO</th>
                            <th>AÑO</th>
                            <th>DIV</th>
                            <th>CATEGORIA</th>      
                            <th>RUC</th> 
                            <th>RAZON SOCIAL DEL PROVEEDOR</th> 
                            <th>LINEA PRODUCTO</th>  
                            <th>MARCA</th>    
                            <th>DIRECCIÓN</th>   
                            <th>INSPECC./AUDIT.</th>     
                            <th>TIPO PROG.</th>     
                            <th>MES PROGRAM.</th>     
                            <th>MES EJECUT.</th>   
                            <th>FECHA EJECUT.</th>      
                            <th>LABORATORIO</th>    
                            <th>ESTADO</th>     
                            <th>OBSERVAC.</th>  
                            <th>% CALIF.</th>  
                            <th>CLASIFIC.</th>   
                            <th>COSTO INSPEC.</th>   
                            <th>GASTOS POR VIATICOS</th>
                            <th>CORREOS/TELEFONOS</th>
                        </tr>
                    </thead> 
                    <tbody></tbody> 
                    <tfoot><tr><th></th></tr></tfoot>  
                </table>
            </div>
        </div>
    </div>
 <!--FIN Contenedor del DataTable-->
</section>

<!-- Script Generales -->
<script type="text/javascript">
    var  baseurl = "<?php echo base_url();?>";          
</script>
