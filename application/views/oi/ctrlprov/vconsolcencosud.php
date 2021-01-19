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
                            <select class="form-control" id="cboAnio" name="cboAnio" style="width: 100%;">
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
                            <select class="form-control" id="cboMes" name="cboMes" style="width: 100%;">
                                <option value="" selected="selected">Cargando...</option>
                            </select>
                        </div>
                        <div class="form-group" id="divHasta">       
                            <label>Hasta</label>                      
                            <div class="input-group date" id="txtFHasta" data-target-input="nearest">
                                <input type="text" id="txtFFin" name="txtFFin" class="form-control datetimepicker-input" data-target="#txtFHasta"/>
                                <div class="input-group-append" data-target="#txtFHasta" data-toggle="datetimepicker">
                                    <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                </div>
                            </div>
                        </div>
                    </div>              
                </div> 
                <div class="row">    
                    <div class="col-md-5">
                        <div class="form-group">
                            <label>Maquilador</label>
                            <select class="form-control select2bs4" id="cboMaquilador" name="cboMaquilador" style="width: 100%;">
                                <option value="" selected="selected">Cargando...</option>
                            </select>
                        </div>
                    </div>     
                    <div class="col-md-4">
                        <div class="form-group">
                            <label>Categoria</label>
                            <select class="form-control select2bs4" id="cboAreaclie" name="cboAreaclie" style="width: 100%;">
                                <option value="" selected="selected">Cargando...</option>
                            </select>
                        </div>
                    </div>  
                    <div class="col-md-3">
                        <div class="form-group">                          
                            <label>Estado</label>
                            <select class="form-control" id="cboEstado" name="cboEstado" style="width: 100%;">
                                <option value = "0" selected="selected">::Elegir</option>
                                <option value = "032" >Concluido OK</option>
                                <option value = "515" >Trunco</option>
                                <option value = "520" >No proveedor</option>
                            </select>
                        </div>
                    </div>
                </div> 
                <!--<div class="row"> 
                    <div class="col-md-4">
                        <label>Marca</label>
                        <input type="text" name="txtMarca" id="txtMarca" class="form-control" value=""  >
                    </div> 
                    <div class="col-md-4">
                        <label>Calificacion</label>
                        <input type="text" name="txtCalificacion" id="txtCalificacion" class="form-control" value=""  >
                    </div> 
                </div>-->
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
                <div class="card card-outline card-primary">
                    <div class="card-header">
                        <h3 class="card-title">Listado</h3>
                    </div>                
                    <div class="card-body" id="divtblGrid" style="overflow-x: scroll;">
                        <table id="tblListConsolcencosud" class="table table-striped table-bordered" style="width:100%">
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
                            </thead><tbody></tbody>
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
    var  baseurl = "<?php echo base_url();?>";          
</script>
