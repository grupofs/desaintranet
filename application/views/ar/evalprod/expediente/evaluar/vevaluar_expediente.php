<div class="content-header">
	<div class="container-fluid">
		<div class="row mb-2">
			<div class="col-sm-6">
				<h1 class="m-0 text-dark">
					EVALUACIÓN DE EXPEDIENTE
					<small>Módulo de Evaluación de Productos</small>
				</h1>
			</div>
			<div class="col-sm-6">
				<ol class="breadcrumb float-sm-right">
					<li class="breadcrumb-item"><a
								href="<?php echo public_base_url(); ?>cprincipal/principal">Home</a>
					</li>
					<li class="breadcrumb-item">Eval. Prod.</li>
					<li class="breadcrumb-item active">Evaluacion de Expedientes</li>
				</ol>
			</div>
		</div>
	</div>
</div>

<section class="content" id="contenedorFormulario">
	<div class="container-fluid">
		<div class="card card-success">
			<div class="card-body">
				<?php
				var_dump($datos_ventana['total_rows']);
				$this->load->view('ar/evalprod/expediente/evaluar/vexpediente_formulario', $datos_ventana);
				?>
			</div>
		</div>
	</div>
</section>

<?php $this->load->view('ar/evalprod/proveedor/vproveedor_formulario'); ?>
