
<style>
    fieldset.scheduler-border{
        border: 2px groove #2DC87B !important;
        padding: 0 0.8em 1.4em 0.8em !important;
        margin: 0 0.8em 1.5em 0.8em !important;
        box-shadow: 0px 0px 0px 0px #000 !important;
    }
    legend.scheduler-border{
        font-size: 1.2em !important;
        font-weight: bold !important;
        text-align: left !important;
        width: auto;
        padding: 0 10px;
        border-bottom: none;
        font-family: Verdana;

    }
</style>

<!-- content-header -->
<div class="content-header">   
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1 class="m-0 text-dark">DASHBOARD</h1>
      </div>
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="">Home</a></li>
          <li class="breadcrumb-item active">Dashboard</li>
        </ol>
      </div>
    </div>
  </div>
</div>
<!-- /.content-header -->
<!-- Main content -->
<section class="content">
    <div class="container-fluid">
        <div class="card card-gray">
            <div class="card-header">
                <h3 class="card-title"> <i class="fas fa-tag"></i> ASUNTOS REGULATORIOS</h3>                
                <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i></button>
                </div>
            </div>
            <div class="card-body"> 
            <!-- GRAFICO PROMEDIO GENERAL -->
                <div class="row">
                    <div class="col-lg-2 col-md-2 col-sm-2 col-xs-12">      
                        <label>AÑO :</label>
                        <select class="form-control" id="cboAnio" name="cboAnio" style="width: 100%;">
                            <option value="" selected="selected">::Elejir</option>
                        </select>
                    </div>
                    <div class="col-lg-2 col-md-2 col-sm-2 col-xs-12">      
                        <label>MES :</label>
                        <select class="form-control" id="cboMes" name="cboMes" style="width: 100%;">
                            <option value="0" selected="selected">::Elejir</option>
                        </select>
                    </div>    
                    <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
                        <br>
                        <button type="submit" id="btnBuscarAnual" class="btn btn-block btn-primary" style="width: 50%;"><i class="fa fa-search"></i></button>
                    </div>
                </div>
                <!-- Tendencia anual de rendimiento (%) -->
                <div class="row">
                    <div class="col-12"> 
                        <br>
                        <fieldset class="scheduler-border">
                            <legend class="scheduler-border text-primary">Tendencia anual de rendimiento (%)</legend>
                            <div class="row">
                                <div class="col-sm-5">
                                    <br>
                                    <table id="tbltendenciaanualrendi" class="display" style="width:100%">
                                        <thead>
                                            <tr>
                                            <th>N° Mes</th>
                                            <th>Mes</th>
                                            <th>% Indicador</th>
                                            <th>N° de muestras</th>             
                                            </tr>
                                        </thead> 
                                        <tbody></tbody><tfoot><tr><th></th></tr></tfoot> 
                                    </table>
                                </div>
                                <div class="col-sm-7">
                                    <div id="graftendenciaanualrendi" style="width: 100%; height: 400px;" ></div>
                                </div>
                            </div>
                        </fieldset>
                    </div>
                </div>
                <!-- Distribución de Productos por línea -->
                <div class="row">
                    <div class="col-12"> 
                        <br>
                        <fieldset class="scheduler-border">
                            <legend class="scheduler-border text-primary">Distribución de Productos por línea</legend>
                            <div class="row">
                                <div class="col-sm-6">
                                    <br>
                                    <table id="tbldistproductolinea" class="display" style="width:100%">
                                        <thead>
                                            <tr>
                                            <th>N°</th>
                                            <th>Área</th>
                                            <th>Cantidad</th>
                                            <th>Total %</th>             
                                            </tr>
                                        </thead> 
                                        <tbody></tbody><tfoot><tr><th></th></tr></tfoot> 
                                    </table>
                                </div>
                                <div class="col-sm-6">
                                    <div id="grafdistproductolinea" style="width: 100%; height: 400px;" ></div>
                                </div>
                            </div>
                        </fieldset>
                    </div>
                </div>
                <!-- Unidades de Aprobación de productos por Linea -->
                <div class="row">
                    <div class="col-12"> 
                        <br>
                        <fieldset class="scheduler-border">
                            <legend class="scheduler-border text-primary">Unidades de Aprobación de productos por Linea</legend>
                            <div class="row">
                                <div class="col-sm-6">
                                    <br>
                                    <table id="tblunicaproprodline" class="display" style="width:100%">
                                        <thead>
                                            <tr>
                                            <th rowspan="2">N°</th>
                                            <th rowspan="2">Área</th>
                                            <th rowspan="2">Aprobados</th>
                                            <th colspan="4">No Aprobados</th>
                                            </tr>
                                            <tr>
                                            <th>Obs.</th>  
                                            <th>Rechaz.</th> 
                                            <th>Pendiente Vida Util</th> 
                                            <th>Total No aprobados</th>            
                                            </tr>
                                        </thead> 
                                        <tbody></tbody><tfoot><tr><th></th></tr></tfoot> 
                                    </table>
                                </div>
                                <div class="col-sm-6">
                                    <div id="grafunicaproprodline" style="width: 100%; height: 400px;" ></div>
                                </div>
                            </div>
                        </fieldset>
                    </div>
                </div>
                <!-- Porcentaje de Aprobación de productos por Linea -->
                <div class="row">
                    <div class="col-12"> 
                        <br>
                        <fieldset class="scheduler-border">
                            <legend class="scheduler-border text-primary">Porcentaje de Aprobación de productos por Linea</legend>
                            <div class="row">
                                <div class="col-sm-6">
                                    <br>
                                    <table id="tblporcaproprodline" class="display" style="width:100%">
                                        <thead>
                                            <tr>
                                            <th rowspan="2">N°</th>
                                            <th rowspan="2">Área</th>
                                            <th rowspan="2">Aprobados</th>
                                            <th colspan="4">No Aprobados</th>
                                            </tr>
                                            <tr>
                                            <th>Obs.</th>  
                                            <th>Rechaz.</th> 
                                            <th>Pendiente Vida Util </th> 
                                            <th>Total No aprobados</th>              
                                            </tr>
                                        </thead> 
                                        <tbody></tbody><tfoot><tr><th></th></tr></tfoot> 
                                    </table>
                                </div>
                                <div class="col-sm-6">
                                    <div id="grafporcaproprodline" style="width: 100%; height: 400px;" ></div>
                                </div>
                            </div>
                        </fieldset>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- /.content -->


<!-- Script Generales -->
<script type="text/javascript">
    var baseurl = "<?php echo base_url();?>"; 
</script>