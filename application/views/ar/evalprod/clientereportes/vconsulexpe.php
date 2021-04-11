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
        <h1 class="m-0 text-dark">CONSULTA EXPEDIENTES - TOTTUS</h1>
      </div>
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="<?php echo public_base_url(); ?>cpanel">Home</a></li>
          <li class="breadcrumb-item active">Eval. Prod.</li>
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
        <div class="card card-info">        
            <div class="card-header">
                <h3 class="card-title">BUSQUEDA</h3>
                <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i></button>
                </div>
            </div>
            
            <div class="card-body">
                <div class="row"> 
                    <div class="col-md-2">
                        <div class="form-group">                          
                            <label>Buscar por</label>
                            <select class="form-control" id="cboTipobuscar" name="cboTipobuscar" style="width: 100%;">
                                <option value = "1" selected="selected">Hoy y Ayer</option>
                                <option value = "2" >Por Intervalo</option>
                                <option value = "3" >Todo</option>
                            </select>
                        </div>
                    </div>                    
                    <div class="col-md-3">    
                        <label>Hasta</label>                       
                        <div class="input-group date" id="txtFDesde" data-target-input="nearest" >
                            <input type="text" id="txtFIni" name="txtFIni" class="form-control datetimepicker-input" data-target="#txtFDesde" disabled/>
                            <div class="input-group-append" data-target="#txtFDesde" data-toggle="datetimepicker">
                                <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">      
                        <label>Hasta</label>                      
                        <div class="input-group date" id="txtFHasta" data-target-input="nearest">
                            <input type="text" id="txtFFin" name="txtFFin" class="form-control datetimepicker-input" data-target="#txtFHasta" disabled/>
                            <div class="input-group-append" data-target="#txtFHasta" data-toggle="datetimepicker">
                                <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <label># Expediente</label>
                        <input type="text" name="txtExpediente" id="txtExpediente" class="form-control" value=""  >
                    </div>  
                </div>
                <div class="row">     
                    <div class="col-md-5">
                        <div class="form-group">
                            <label>Proveedor</label>
                            <select class="form-control select2bs4" id="cboProveedor" name="cboProveedor" style="width: 100%;">
                                <option value="" selected="selected">Cargando...</option>
                            </select>
                        </div>
                    </div>  
                </div>
            </div>             
                        
            <div class="card-footer justify-content-between" style="background-color: #D4EAFC;">
				<div class="row">
					<div class="col-xl-4 col-lg-4 col-md-4 col-sm-12 col-12" >
						<div class="text-left" >
							<button type="button" role="button" class="btn btn-info" id="btnReporteExel" >
								<i class="fa fa-file-export" ></i> Exportar Resultado
							</button>
						</div>
					</div>
					<div class="col-xl-8 col-lg-8 col-md-8 col-sm-12 col-12">
						<div class="text-right">
							<button type="button" class="btn btn-primary" id="btnBuscar"><i class="fas fa-search"></i>&nbsp;&nbsp;Buscar</button>
<!--                            <button type="submit" class="btn btn-outline-success" id="btnExel"><i class="far fa-file-excel"></i>&nbsp;&nbsp;Exportar</button>     -->
						</div>
					</div>
				</div>
            </div>
        </div>
        </form>
        <div class="row">
            <div class="col-12">
                <div class="card card-outline card-info">
                    <div class="card-header">
                        <h3 class="card-title">Listado</h3>
                    </div>                
                    <div class="card-body" style="overflow-x: scroll;">
                        <table id="tbllistaexpedientes" class="table table-striped table-bordered" style="width:100%">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>Expediente</th>
                                <th>Proveedor</th>
                                <th>Total</th>
                                <th>Fecha Ingreso</th>      
                                <th>Fecha Limite</th> 
                                <th>Ficha</th> 
                                <th>Pdf</th> 
                                <th>Estado</th> 
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
