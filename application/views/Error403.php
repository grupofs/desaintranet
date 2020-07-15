<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<!DOCTYPE html>
<!DOCTYPE html>
<html>
<head>
	<title>Error 403 | GrupoFS</title>
  	<link rel="stylesheet" href="<?php echo public_url(); ?>template/GUI/dist/css/adminlte.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">
	<style>
		body {  padding: 3em; } 
	</style>
</head>
<body class="hold-transition lockscreen">
<div>
	<section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>403 Error Pagina/Page</h1>
          </div>
        </div>
      </div>
    </section>

	<section class="content">
		<div class="error-page" style="width: 800px;">
			<h2 class="headline text-danger"><i class="fa fa-warning" style="color:red"></i></h2>			
			<div class="error-content">
				<h2 style="color:red"> Error HTTP 403 - Prohibido/Forbidden.</h2>
				<p class="lead">
					<b>Acceso denegado :: </b> No tiene permiso para acceder<br/>
					<b>Access denied :: </b> You do not have permission to access
				</p>
			</div>
			<div>
				<br>
				<strong> Nota:</strong>
				<p class="text-muted">
					Si desea ingresar a Plataforma de Grupo FS click en el siguiente Link <a href="<?php echo base_url() ?>clogin/fs">GrupoFS</a>. <br/>
					Si desea ingresar a Plataforma de FS Certificaciones click en el siguiente Link <a href="<?php echo base_url() ?>clogin/fsc">FSC</a>. 
				</p>
				<br>
				<strong> Note:</strong>
				<p class="text-muted">
					If you wish to join the FS Group Platform click on the following Link <a href="<?php echo base_url() ?>clogin/fs">GrupoFS</a>. <br/>
					If you want to enter FS Certifications Platform click on the following FSC Link <a href="<?php echo base_url() ?>clogin/fsc">FSC</a>. 
				</p>
			</div>
		</div>
	</section>
	<section class="footer">
		<br>		
		<p class="text-red">El acceso al directorio está prohibido. || Directory access is forbidden.</p>
	</section>
</div>
</body>
</html>