<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">

	<?php
	$grupo = 'GRUPO FS | FSC';
	$cia = 0;
	?>

	<title><?php echo $grupo ?></title>

	<!-- Tell the browser to be responsive to screen width -->
	<meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">

	<!-- Bootstrap 3.3.6 -->
	<link rel="stylesheet" href="<?php echo public_url(); ?>template/GUI/plugins/fontawesome-free/css/all.min.css">
	<link rel="stylesheet" href="<?php echo public_url(); ?>template/Ionicons/css/ionicons.min.css">
	<!-- Theme style -->
	<link rel="stylesheet" href="<?php echo public_url(); ?>template/GUI/dist/css/adminlte.min.css">
	<!--    <link href="--><?php //echo public_url(); ?><!--cssweb/bootst.css" rel="stylesheet"/>-->
	<link href="<?php echo public_url(); ?>cssweb/loginext.css" rel="stylesheet"/>
	<link rel="shortcut icon" href="<?php echo public_url(); ?>images/favicon.png" type="image/x-icon"/>

	<?php
	$this->load->library('session');
	$newdata = array(
			's_compania' => $cia,
			's_intentos' => 0,
	);
	$this->session->set_userdata($newdata);
	?>

	<style>
		.fondo_imagenpar{
			background-image : url(./assets/images/bg_desktop.jpg);
		}
		.fondo_imagenimpar{
			background-image : url(./assets/images/bgblue_desktop.jpg);
		}
		.fondo-login {
			background-color: #cccccc;
			height: 100%;
			background-position: center;
			background-repeat: no-repeat;
			background-size: cover;
			position: relative;
		}

		.top-left-login {
			position: absolute;
			top: 8px;
			left: 16px;
		}

		.top-right-login {
			position: absolute;
			top: 8px;
			right: 190px;
		}

		.centered-login {
			position: absolute;
			top: 50%;
			left: 50%;
			transform: translate(-50%, -50%);
		}

		.full-height {
			height: 100%;
		}

		.info-text-group span {
			font-size: 1.5rem;
			color: white; 
			text-shadow: black 0.1em 0.1em 0.2em;
		}

		.textconsulta{
			color: white; 
			text-shadow: black 0.1em 0.1em 0.2em;
		}

		.titulo-imagen {
			width: 100px;
			height: 95px;
			color: white; 
			box-shadow: black 0.2em 0.2em 0.3em;
		}

		.titulo-imagen:hover {
			box-shadow: 0 .5rem 1rem rgba(0, 0, 0, .15) !important;
		}

		@media (max-width: 991.98px) {
			.info-text-group span {
				font-size: 1.2rem;
			}

			.titulo-imagen {
				width: 70px;
				height: 65px;
			}
		}


		.auth-input-group {
			margin-bottom: 12px !important;
		}
		.input-group-addon:first-child {
			border-right: 0 !important;
		}

	</style>
</head>

<body class="w-100 h-100">
	<div class="container-fluid full-height">
		<div class="row full-height">
			<div class="col-xl-8 col-lg-8 col-md-7 col-sm-12 col-12 d-none d-xl-block d-lg-block d-md-block full-height p-0">
				<div id="fondo" >
					<div class="top-left-login">
						<img id="logo-img" src="<?php echo public_url(); ?>images/logotransp_fs.png">
					</div>
					<div class="top-right-login">
						<img id="logo-img" src="<?php echo public_url(); ?>images/logotransp_fsc.png">
					</div>
					<div class="info-text-group centered-login pb-5">
						<div class="info-text text-center textconsulta" style="font-size: 2rem">Nuestros Servicios</div>
						<br>
						<div class="box-body">
							<div class="row justify-content-center">
								<div class="col-md-12 text-center">
									<ul class="list-group list-group-horizontal list-unstyled justify-content-center">
										<li class="mx-4">
											<a href="#" data-toggle="modal" data-target="#modal1">
												<img src="<?php echo public_url(); ?>images/botonServAR.png"
													class="rounded-circle titulo-imagen"
													alt="User Image">
											</a>
											<span class="titulo">Asuntos</span>
											<span class="titulo">Regulatorios</span>
										</li>
										<li class="mx-4">
											<a href="#" data-toggle="modal" data-target="#modal2">
												<img src="<?php echo public_url(); ?>images/botonServAT.png"
													class="rounded-circle titulo-imagen"
													alt="User Image">
											</a>
											<span class="titulo" style="">Area</span>
											<span class="titulo" style="">Tecnica</span>
										</li>
										<li class="mx-4">
											<a href="#" data-toggle="modal" data-target="#modal3">
												<img src="<?php echo public_url(); ?>images/botonServPT.png"
													class="rounded-circle titulo-imagen"
													alt="User Image">
											</a>
											<span class="titulo" style="">Procesos</span>
											<span class="titulo" style="">Termicos</span>
										</li>
									</ul>
								</div>
							</div>
							<div class="row justify-content-center">
								<div class="col-md-12 mt-2 text-center">
									<ul class="list-group list-group-horizontal list-unstyled justify-content-center">
										<li class="mx-4">
											<a href="#" data-toggle="modal" data-target="#modal4">
												<img src="<?php echo public_url(); ?>images/botonServLAB.png"
													class="rounded-circle titulo-imagen"
													alt="User Image">
											</a>
											<span class="titulo" style="">Laboratorio</span>
										</li>
										<li class="mx-4">
											<a href="#" data-toggle="modal" data-target="#modal5">
												<img src="<?php echo public_url(); ?>images/botonServOI.png"
													class="rounded-circle titulo-imagen"
													alt="User Image">
											</a>
											<span class="titulo" style="">Organismo</span>
											<span class="titulo" style="">Inspeccion</span>
										</li>
									</ul>
								</div>
							</div>
						</div>
					</div>
					<div class="info-contact">
						<span class="textconsulta" style="font-size: 1.2rem">Consultas:</span>
						<span class="textconsulta" style="font-size: 1.2rem">
						| consultas@grupofs.com | fsc@fscertificaciones.com | lab@fscertificaciones.com |
						<i class="fa fa-phone-square"></i>
						(511)480-0561
						</span>
					</div>
				</div>
			</div>
			<div class="col-xl-4 col-lg-4 col-md-5 col-sm-12 col-12 d-block">
				<div class="clsDivLogo"></div>
				<div class="d-flex flex-row align-items-center justify-content-center h-100">
					<div class="col-xl-10 col-lg-10 col-md-10 col-sm-12 col-12" >
						<div class="text-center">
							<span class="titulo_principal_login" style="color: #5a8ae3">¡Bienvenido!</span>
						</div>
						<div class="mt-3 d-block" style="display: block;">
								<input type="hidden" id="showRecoverInput"/>

								<form id="frmlogin" action="<?= base_url('clogin/ingresar') ?>" class="form-horizontal"
									method="post" role="form">
									<hr class="clear"/>
									<input name="cia" type="hidden" id="cia" value="<?php echo $cia; ?>">

									<div>
										<span class="mensaje_error_sesion"> </span>
									</div>

									<div class="input-group  auth-input-group">
										<div class="input-group-prepend">
											<span class="input-group-text"><img src="<?php echo base_url() ?>assets/images/icon_user.png" alt></span>
										</div>
										<input autofocus="autofocus" class="form-control text-box single-line" id="txtemail"
											name="txtemail" placeholder="Email o Usuario" required="required" type="text"
											value>
									</div>


									<div class="input-group auth-input-group">
										<div class="input-group-prepend">
											<span class="input-group-text"><img src="<?php echo base_url() ?>assets/images/icon_lock.png" alt></span>
										</div>
										<input class="form-control text-box single-line" id="txtpassword" maxlength="20"
											name="txtpassword" placeholder="Contraseña" required="required"
											type="password"
											value>
									</div>
									<a href="<?php echo base_url('clogin/recover_pass/0') ?>" class="link-login">
										Olvidé mi contraseña
									</a>
									<input type="submit" value="Iniciar Sesión" class="auth-button"/>
								</form>
							</div>
					</div>
				</div>
			</div>
		</div>
	</div>

	<div class="modal fade" id="modal1" tabindex="-1"
		aria-labelledby="exampleModalLabel" aria-hidden="true">
		<div class="modal-dialog modal-dialog-centered modal-lg">
			<div class="modal-content">
				<div class="modal-header">
					<h4 class="modal-title" id="exampleModalLabel">
						<i class="fas fa-barcode"></i>
						Asuntos Regulatorios 
					</h4>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body">
					<small> <b>Servicios :</b></small>
					<blockquote>                  
						<dl>
						<dt>- Permisos Sanitarios.</dt>
						<dd>Tramitación de certificados ante las autoridades sanitarias; DIGESA, DIGEMID, SENASA Y SANIPES.</dd>
						<dt>- Autorización de Laboratorio.</dt>
						<dd>Buenas Prácticas de Manufactura.</dd>
						<dt>- Autorización de Droguería.</dt>
						<dd>Buenas Prácticas de Almacenamiento.</dd>
						<dt>- Validación de etiquetado de alimentos.</dt>
						<dt>- Elaboración de Tabla Nutricional y Advertencias Publicitarias.</dt>
						<dt>- Servicio de custodia de registros.</dt>
						</dl>                  
					</blockquote>
				</div>
				<div class="modal-footer">
					<h5>Para mayor información </h5><h4><cite title="Pagina Web"><a href="https://grupofs.com/" target="_blank" style="color:blue;">aquí</a></cite></h4>
				</div>
			</div>
		</div>
	</div>
	<div class="modal fade" id="modal2" tabindex="-1"
		aria-labelledby="exampleModalLabel" aria-hidden="true">
		<div class="modal-dialog modal-dialog-centered modal-lg">
			<div class="modal-content">
				<div class="modal-header">
					<h4 class="modal-title" id="exampleModalLabel">
						<i class="far fa-calendar-check"></i>					
						Área Tecnica
					</h4>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body">
					<small> <b>Servicios :</b></small>
					<blockquote>                  
						<dl>
						<dt>- Cusros y/o Webinar´s Dictados Online.</dt>
						<dt>- Aprendizaje.</dt>
						<dd>Acceda a nuestros catálogo de seminarios y cursos.</dd>
						<dt>- Implementación / Actualización (IM) de Sistemas y Normas sujetas a Certificación.</dt>
						<dd>Diagnósticos, documentación e implementación, auditoria interna y aprendizaje.</dd>
						<dt>- Diseño y Desarrollo de Programa de Control de la Cadena de Suministro.</dt>
						<dt>- Elaboración de Estudios de Mermas y/o Desmedros.</dt>
						<dt>- Elaboración del Diseño Sanitario de Planta (lay-out).</dt>
						<dt>- Elaboración del Plan de Defensa Alimentaria.</dt>
						<dt>- Elaboración del Plan de Mitigación de Fraude Alimentario.</dt>
						</dl>                  
					</blockquote>
				</div>
				<div class="modal-footer">
					<h5>Para mayor información </h5><h4><cite title="Pagina Web"><a href="https://grupofs.com/" target="_blank" style="color:blue;">aquí</a></cite></h4>
				</div>
			</div>
		</div>
	</div>
	<div class="modal fade" id="modal3" tabindex="-1"
		aria-labelledby="exampleModalLabel" aria-hidden="true">
		<div class="modal-dialog modal-dialog-centered modal-lg">
			<div class="modal-content">
				<div class="modal-header">
					<h4 class="modal-title" id="exampleModalLabel">
						<i class="fas fa-industry"></i>	
						Procesos Térmicos
					</h4>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body">
					<small> <b>Servicios :</b></small>
					<blockquote>                  
						<dl>
						<dt>- Estudios de Validación Térmica.</dt>
						<dd>Penetración de calor (estudios Fo) y distribución de temperatura en autoclaves, marmitas, secadores, pasteurizadores, entre otros.</dd>
						<dt>- Auditorias en Tratamiento Térmico.</dt>
						<dd>Soporte técnico para visitas y auditorías oficiales de la US FDA (EE.UU.), DIGESA, SANIPES, entre otros; así como auditorías de sus clientes.</dd>
						<dt>- Capacitación.</dt>
						<dd>Cursos oficiales exigidos por la US FDA y Cursos/talleres especializados en procesamiento térmico.</dd>
						<dt>- Trámites, registro y autorizaciones.</dt>
						<dd>Ante la US FDA y otros países que requieran respaldo del tratamiento térmico.</dd>
						<dt>- Capacitación in-house o virtual en el Uso de Equipos de Recolección y Softwares de Análisis.</dt>
						<dd>Como socios de TechniCAL Inc. (EE.UU.) manejamos sus equipos (CALPlex®) y softwares para el análisis y procesamiento de datos (CALSoft5® y CALSoft6®).</dd>
						</dl>                  
					</blockquote>
				</div>
				<div class="modal-footer">
					<h5>Para mayor información </h5><h4><cite title="Pagina Web"><a href="https://grupofs.com/" target="_blank" style="color:blue;">aquí</a></cite></h4>
				</div>
			</div>
		</div>
	</div>
	<div class="modal fade" id="modal4" tabindex="-1"
		aria-labelledby="exampleModalLabel" aria-hidden="true">
		<div class="modal-dialog modal-dialog-centered modal-lg">
			<div class="modal-content">
				<div class="modal-header">
					<h4 class="modal-title" id="exampleModalLabel">
						<i class="fas fa-flask"></i>	
						Laboratorio
					</h4>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body">
					<small> <b>Servicios :</b></small>
					<blockquote>                  
						<dl>
						<dd>✔ Análisis microbiológicos, fisicoquímicos y sensoriales de alimentos, agua y otras muestras relacionadas.</dd>
						<dd>✔ Validación microbiológica de procesos.</dd>
						<dd>✔ Programas de monitoreo ambiental de patógenos en función al riesgo.</dd>
						<dd>✔ Estudios de Enfrentamiento Microbiano.</dd>
						<dd>✔ Pruebas de Desafio Microbiano según regulación FDA.</dd>
						<dd>✔ Vida Útil Acelerada y en Tiempo Real.</dd>
						<dd>✔ Estudio de estabilidad.</dd>
						<dd>✔ Análisis nutricional.</dd>
						<dd>✔ Programas de Monitoreo Microbiológico.</dd>
						<dd>✔ Análisis entomológicos.</dd>
						<dd>✔ Auditoria en 17025.</dd>
						</dl>                  
					</blockquote>
				</div>
				<div class="modal-footer">
					<h5>Para mayor información </h5><h4><cite title="Pagina Web"><a href="https://fscertificaciones.com/" target="_blank" style="color:blue;">aquí</a></cite></h4>
				</div>
			</div>
		</div>
	</div>
	<div class="modal fade" id="modal5" tabindex="-1"
		aria-labelledby="exampleModalLabel" aria-hidden="true">
		<div class="modal-dialog modal-dialog-centered modal-lg">
			<div class="modal-content">
				<div class="modal-header">
					<h4 class="modal-title" id="exampleModalLabel">
						<i class="fas fa-clipboard-list"></i>	
						Organismo Inspección
					</h4>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body">
					<small> <b>Servicios :</b></small>
					<blockquote>                  
						<dl>
						<dd>✔ Programa de Control de Proveedores.</dd>
						<dd>✔ Homologación Técnica de Proveedores (Productos y Servicios).</dd>
						<dd>✔ Validación Técnica de Luminancia.</dd>
						<dd>✔ Muestreo y Certificación de lote.</dd>
						<dd>✔ Auditoria o Inspección Técnica de verificación.</dd>
						<dd>✔ Certificación de Inspección, refrendada por INACAL.</dd>
						<dd>✔ Certificación de Inocuidad de Restaurantes.</dd>
						<dd>✔ Certificación del Sistema de Inocuidad (PGH, BPM, BPA, HACCP).</dd>
						</dl>                  
					</blockquote>
				</div>
				<div class="modal-footer">
					<h5>Para mayor información </h5><h4><cite title="Pagina Web"><a href="https://fscertificaciones.com/" target="_blank" style="color:blue;">aquí</a></cite></h4>
				</div>
			</div>
		</div>
	</div>

</body>

<!-- jQuery 2.2.3 -->
<script src="<?php echo public_url(); ?>template/GUI/plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 3.3.6 -->
<script src="<?php echo public_url(); ?>template/GUI/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="<?php echo public_url(); ?>template/GUI/plugins/sweetalert2/sweetalert2.all.min.js"></script>
<!-- login -->
<script src="<?php echo public_url(); ?>script/login.js"></script>

<script>
function imagenAleatoria()
{
	//var d = new Date();
	//var tiempopar = d.getMinutes()%2
	var fondo = document.getElementById('fondo');
	var aleatorio=Math.floor(Math.random()*2);
	
	if(aleatorio == 0){
		fondo.className = 'fondo-login d-block fondo_imagenpar';
	}else{
		fondo.className = 'fondo-login d-block fondo_imagenimpar';
	}
	setTimeout(imagenAleatoria,3000)
}
imagenAleatoria()
</script>
</html>
