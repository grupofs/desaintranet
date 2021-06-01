<div class="modal fade" id="modalAccionCorrectiva" data-backdrop="static" data-keyboard="false" tabindex="-1"
	 aria-labelledby="staticBackdropLabel" aria-hidden="true">
	<div class="modal-dialog modal-xl">
		<div class="modal-content">
			<div class="modal-header bg-success">
				<h5 class="modal-title fs w-100 font-weight-bold">Acción Correctiva</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body"
				 style="background-color:#ffffff; border-top: 1px solid #00a65a; border-bottom: 1px solid #00a65a;">
				<div class="row">
					<div class="col-12" style="overflow-x: scroll">
						<table class="table table-striped table-bordered" id="tblAcciónCorrectiva"
							   style="width: 100%">
							<thead>
							<tr>
								<th>ID</th>
								<th>Requisito</th>
								<th>Excluyente</th>
								<th>Tipo de Hallazgo</th>
								<th>Hallazgo</th>
								<th>Acción Correctiva</th>
								<th>Responsable por Cliente</th>
								<th>Fecha Corrección</th>
								<th>Aceptar Acción</th>
								<th>Comentarios</th>
							</tr>
							</thead>
							<tbody>
							</tbody>
						</table>
					</div>
				</div>
			</div>
			<div class="modal-footer" id="download-excel" style="display: none">
				<a class="btn btn-sm btn-success" href="#" target="_blank" id="btnDownloadAccionCorrectiva">
					<i class="fa fa-file-excel"></i> Descargar Acción Correctiva
				</a>
			</div>
		</div>
	</div>
</div>
