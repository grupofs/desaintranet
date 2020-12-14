/*!
 *
 * @version 1.0.0
 * @author Anthony
 */

const objDocumento = {};

$(function () {

	/**
	 * Se obtiene los documentos del tramite y entidad elegidos
	 * @param tramiteId
	 */
	objDocumento.obtener = function (tramiteId) {
		const button = $('#btnDocumentoAgregar');
		$.ajax({
			url: BASE_URL + 'ar/ope/cdocumentoregulatorio/obtener_documentos',
			method: 'POST',
			data: {
				entidad_regula_id: $('#tramite_entidad_id').val(),
				tramite_id: tramiteId,
			},
			dataType: 'json',
			beforeSend: function () {
				objPrincipal.botonCargando(button);
			}
		}).done(function (res) {
			objDocumento.imprimirResultado(res.items);
		}).fail(function (jqxhr) {
			const message = (jqxhr && jqxhr.responseJSON && jqxhr.responseJSON.message) ? jqxhr.responseJSON.message : 'Error en la solicitud del servidor.';
			objPrincipal.notify('error', message);
		}).always(function () {
			objPrincipal.liberarBoton(button);
		});
	};

	/**
	 * Imprime la busqueda de documentos
	 * @param {Array} data
	 */
	objDocumento.imprimirResultado = function (data) {
		let row = '';
		if (data && Array.isArray(data)) {
			let position = $('table#tblDocumentos > tbody > tr').length;
			data.forEach(function (item) {
				row += objDocumento.imprimir(position, 1, item.CDOCUMENTO, item.DDOCUMENTO, item.archivos);
				++position;
			});
		}
		$('table#tblDocumentos > tbody').append(row);
	};

	/**
	 * Agrega nuevo item
	 */
	objDocumento.agregarItem = function(data) {
		const table = $('table#tblDocumentos > tbody');
		let position = $('table#tblDocumentos > tbody > tr').length;
		const type = (data && data.TIPO) ? parseInt(data.TIPO) : 1;
		const codigo = (data && data.CDOCUMENTO) ? data.CDOCUMENTO : '';
		const documento = (data && data.DDOCUMENTO) ? data.DDOCUMENTO : '';
		const row = objDocumento.imprimir(position, type, codigo, documento, []);
		table.append(row);
	};

	/**
	 *
	 * @param position
	 * @param tipo
	 * @param codigo
	 * @param documento
	 * @param archivos
	 * @returns {string}
	 */
	objDocumento.imprimir = function (position, tipo, codigo, documento, archivos) {
		const type1Selected = (parseInt(tipo) === 1) ? 'selected' : '';
		const type2Selected = (parseInt(tipo) === 2) ? 'selected' : '';
		const modal = 'document-modal-' + position;
		const totalArchivos = (archivos && Array.isArray(archivos)) ? archivos.length : 0;
		let row = '<tr data-position="' + position + '" >';
			row += '<td class="text-center" >';
			row += '<span class="font-weight-bold" >' + (position + 1) + '</span>';
			row += '</td>';
			row += '<td class="text-center" >';
			row += '<select class="custom-select" id="documento_tipo[' + position + ']" name="documento_tipo[' + position + ']" >';
			row += '<option value="1" ' + type1Selected + ' >Requisito</option>';
			row += '<option value="2" ' + type2Selected + ' >Resolutivo</option>';
			row += '</select>';
			row += '</td>';
			row += '<td class="text-left" >';
			row += '<div class="input-group" >';
			if (codigo) {
				row += '<div class="form-control bg-light" >' + documento + '</div>';
			} else {
				row += '<input type="text" class="form-control" id="documento_nombre[' + position + ']" name="documento_nombre[' + position + ']" value="" >';
			}
			row += '<div class="input-group-prepend" >';
			row += '<button type="button" role="button" class="btn btn-light" data-toggle="modal" data-target="#' + modal + '" ><i class="fa fa-plus" ></i> Cargar Archivo</button>';
			row += '<button type="button" role="button" id="btn-download-files-' + position + '" class="btn btn-light documento-descargar-archivos" style="display: none" ><i class="fa fa-download" ></i> Descargar Archivos</button>';
			row += '</div>';
			row += '</div>';
			row += '</td>';
			row += '<td class="text-center" >';
			row += '<span class="font-weight-bold text-success" id="documento_archivos_total[' + position + ']" >' + totalArchivos + '</span>';
			row += '</td>';
			row += '<td>';
			row += '<div class="text-center" >';
			row += '<button type="button" role="button" class="btn btn-light btn-sm dropdown-toggle" data-boundary="viewport" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" >';
			row += '<i class="fa fa-bars"></i>';
			row += '</button>';
			row += '<div class="dropdown-menu dropdown-menu-right">';
			row += '<h6 class="dropdown-header">Opciones</h6>';
			row += '<button type="button" role="button" class="dropdown-item option-documento-remove" >';
			row += '<i class="fa fa-trash"></i> Eliminar';
			row += '</button>';
			row += '</div>';
			// 0: Nuevo, 1: Editable, 2: Eliminar, otros: no se toma encuenta
			row += '<input type="hidden" class="d-none" id="documento_id[' + position + ']" name="documento_id[' + position + ']" value="' + codigo + '" />';
			row += '<input type="hidden" class="d-none" id="documento_operation[' + position + ']" name="documento_operation[' + position + ']" value="1" />';

			row += '<div class="modal fade" id="' + modal + '" tabindex="-1" data-backdrop="static" data-keyboard="false" aria-hidden="true">';
			row += '<div class="modal-dialog modal-lg modal-dialog-scrollable">';
			row += '<div class="modal-content">';
			row += '<div class="modal-header bg-success">';
			row += '<h5 class="modal-title fs w-100 font-weight-bold">Cargar archivo(s)</h5>';
			row += '</div>';
			row += '<div class="modal-body" style="background-color:#ffffff; border-top: 1px solid #00a65a; border-bottom: 1px solid #00a65a;">';
			row += '<div class="table-responsive" >';
			row += '<table class="table table-bordered table-striped" id="tbl-documento-archivos-' + position + '" >';
			row += '<thead>';
			row += '<tr>';
			row += '<th class="text-left" style="min-width: 220px;" >Archivo</th>';
			row += '<th class="text-center" style="width: 130px; min-width: 130px;" >OP</th>';
			row += '</tr>';
			row += '</thead>';
			row += '<tbody>';
			if (archivos && Array.isArray(archivos)) {
				archivos.forEach(function(item, key) {
					const name = item.DUBICACIONFILESERVER;
					let realName = '';
					if (name) {
						realName = String(item.DUBICACIONFILESERVER).split('/').reverse()[0];
					}
					row += '<tr data-key="' + key + '" >';
					row += '<td class="text-left" >';
					row += '<div class="input-group" >';
					row += '<div class="form-control bg-light" >';
					row += '<a href="' + BASE_URL + 'FTPfileserver/Archivos/' + item.DUBICACIONFILESERVER + '" download="' + realName + '" class="text-primary" ><i class="fa fa-download" ></i> ' + realName + '</a>';
					row += '</div>';
					row += '</div>';
					row += '</td>';
					row += '<td class="text-center" >';
					row += '<button type="button" role="button" class="btn btn-secondary option-remove-real-file" data-position="' + position + '" data-id="' + item.CDOCUMENTOREGULAARCHIVO + '" >';
					row += '<i class="fa fa-trash" ></i> Eliminar';
					row += '</button>';
					row += '<input type="hidden" class="d-none" id="archivo_documento_operation[' + position + '][' + key + ']" name="archivo_documento_operation[' + position + '][' + key + ']" value="2" />';
					row += '</td>';
					row += '</tr>';
				});
			}
			row += '</tbody>';
			row += '<tfoot>';
			row += '<tr>';
			row += '<th class="text-left" colspan="5" >';
			row += '<button type="button" role="button" class="btn btn-link btn-add-document-file" data-position="' + position + '" >';
			row += '<i class="fa fa-plus" ></i> Agregar nuevo archivo';
			row += '</button>';
			row += '</th>';
			row += '</tr>';
			row += '</tfoot>';
			row += '</table>';
			row += '</div>';
			row += '</div>';
			row += '<div class="modal-footer">';
			row += '<button type="button" class="btn btn-danger btn-save-upload-file" data-position="' + position + '" >';
			row += '<i class="fa fa-save"></i> Guardar';
			row += '</button>';
			row += '</div>';
			row += '</div>';
			row += '</div>';
			row += '</div>';
			row += '</td>';
			row += '</tr>';
		return row;
	};

	/**
	 * Agrega un nuevo item para elegir un archivo
	 */
	objDocumento.agregarArchivo = function() {
		const button = $(this);
		const position = button.data('position');
		const tabla = $("#tbl-documento-archivos-" + position + " > tbody");
		const key = $("#tbl-documento-archivos-" + position + " > tbody > tr").length;
		tabla.append('<tr data-key="' + key + '" >' +
			'<td class="text-left" >' +
			'<input type="file" class="form-control" id="archivo_documento[' + position + '][' + key  + ']" name="archivo_documento[' + position + '][' + key + ']" value="" />' +
			'</td>' +
			'<td class="text-center" >' +
			'<button type="button" role="button" class="btn btn-danger option-archivo-remove" data-position="' + position + '" >' +
			'<i class="fa fa-trash" ></i> Eliminar' +
			'</button>' +
			'<input type="hidden" class="d-none" id="archivo_documento_operation[' + position + '][' + key + ']" name="archivo_documento_operation[' + position + '][' + key + ']" value="1" />' +
			'<input type="hidden" class="d-none" id="archivo_documento_id[' + position + '][' + key + ']" name="archivo_documento_id[' + position + '][' + key + ']" value="0" />' +
			'</td>' +
			'</tr>'
		);
	};

	/**
	 * Elimina una archivo
	 */
	objDocumento.eliminarArchivo = function() {
		const button = $(this);
		const row = button.parent('td').parent('tr');
		const position = button.data('position');
		const key = row.data('key');
		objDocumento.confirmarEliminarArchivo(row, position, key);
	};

	/**
	 * Confirmar eliminar del archivo
	 * @param row
	 * @param position
	 * @param key
	 */
	objDocumento.confirmarEliminarArchivo = function(row, position, key) {
		if (document.getElementById('archivo_documento_operation[' + position + '][' + key + ']')) {
			document.getElementById('archivo_documento_operation[' + position + '][' + key + ']').value = 0;
		}
		row.hide();
	};

	/**
	 * Elimina todos los documentos
	 */
	objDocumento.eliminarArchivos = function() {
		$('table#tblDocumentos tbody').html('');
	};

	/**
	 * Guarda el total de archivos del documento
	 */
	objDocumento.guardarArchivo = function() {
		const position = $(this).data('position');
		const table = $('table#tbl-documento-archivos-' + position)
		let total = 0;
		if (table.length) {
			table.find('tbody tr').each(function() {
				const row = $(this);
				const key = row.data('key');
				if (document.getElementById('archivo_documento_operation[' + position + '][' + key + ']')) {
					const opoeration = parseInt(document.getElementById('archivo_documento_operation[' + position + '][' + key + ']').value);
					if (opoeration === 1 || opoeration === 2) {
						++total;
					}
				}
			});
		}
		if (document.getElementById('documento_archivos_total[' + position + ']')) {
			document.getElementById('documento_archivos_total[' + position + ']').innerText = total;
		}
		$('#document-modal-' + position).modal('hide');
	};

	/**
	 * Eliminar un archivo cargado
	 */
	objDocumento.eliminarRealArchivo = function() {
		const button = $(this);
		const row = button.parent('td').parent('tr');
		const position = button.data('position');
		const key = row.data('key');
		const id = button.data('id');
		$.ajax({
			url: BASE_URL + 'ar/ope/ctramite/eliminar_archivo',
			method: 'POST',
			data: {
				id: id,
			},
			beforeSend: function() {
				objPrincipal.botonCargando(button);
			}
		}).done(function(response) {
			objPrincipal.notify('success', response.message);
			objDocumento.confirmarEliminarArchivo(row, position, key);
		}).fail(function(jqxhr) {
			const message = (jqxhr && jqxhr.responseJSON && jqxhr.responseJSON.message) ? jqxhr.responseJSON.message : 'Error en la solicitud del servidor.';
			objPrincipal.notify('error', message);
		}).always(function() {
			objPrincipal.liberarBoton(button);
		});
	};

	/**
	 * Elimina el documento
	 */
	objDocumento.eliminarDocumento = function() {
		const button = $(this);
		const row = button.parents('tr');
		const position = row.data('position');
		const id = (document.getElementById('documento_id[' + position + ']')) ? document.getElementById('documento_id[' + position + ']').value : '';
		if (document.getElementById('documento_operation[' + position + ']')) {
			document.getElementById('documento_operation[' + position + ']').value = (id > 0) ? 2 : 3;
		}
		row.hide();
	};

});

$(document).ready(function () {

	$(document).on('click', '.option-archivo-remove', objDocumento.eliminarArchivo);

	$(document).on('click', '.btn-add-document-file', objDocumento.agregarArchivo);

	$(document).on('click', '.btn-save-upload-file', objDocumento.guardarArchivo);

	$(document).on('click', '.option-remove-real-file', objDocumento.eliminarRealArchivo);

	$(document).on('click', '.option-documento-remove', objDocumento.eliminarDocumento);

	$('#btnDocumentoAgregar').click(function() {
		objDocumento.agregarItem();
	});

});
