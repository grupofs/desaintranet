/*!
 *
 * @version 1.0.0
 * @author Anthony
 */

const objDocumento = {};

$(function () {

	/**
	 * Ruta de los documentos cargados
	 * @type {*[]}
	 */
	objDocumento.rutaDocumentos = [];

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
				let tipo = (item.TIPO) ? parseInt(item.TIPO) : 1;
				let archivoAnt = (item.CDOCUMENTOREGULAARCHIVO) ? 0 : 1;
				row += objDocumento.imprimir(position, tipo, item.CDOCUMENTO, item.DDOCUMENTO, item.archivos, item.CTRAMITE, item.DTRAMITE, archivoAnt);
				++position;
			});
		}
		$('table#tblDocumentos > tbody').append(row);
		objDocumento.cargarTramites();
	};

	/**
	 * Agrega nuevo item
	 */
	objDocumento.agregarItem = function (data) {
		const table = $('table#tblDocumentos > tbody');
		let position = $('table#tblDocumentos > tbody > tr').length;
		const type = (data && data.TIPO) ? parseInt(data.TIPO) : 1;
		const codigo = (data && data.CDOCUMENTO) ? data.CDOCUMENTO : '';
		const documento = (data && data.DDOCUMENTO) ? data.DDOCUMENTO : '';
		const row = objDocumento.imprimir(position, type, codigo, documento, [], null, '', 0);
		table.append(row);
		objDocumento.cargarTramites();
	};

	/**
	 * Carga los tramites en los documentos
	 */
	objDocumento.cargarTramites = function () {
		// Se busca los tramites
		const tramites = [];
		$('#tblTramite tbody tr').each(function () {
			const row = $(this);
			const position = row.data('position');
			const elTramite = $(document.getElementById('tramite_id[' + position + ']'));
			const tramite = elTramite.val();
			const txtTramite = elTramite.children("option").filter(":selected").text();
			const operation = parseInt(document.getElementById('tramite_operation[' + position + ']').value);
			if (operation === 0 || operation === 1) {
				tramites.push({id: tramite, text: txtTramite});
			}
		});

		// Se imprime los tramites dentro del documento
		$('table#tblDocumentos > tbody > tr').each(function () {
			const position = $(this).data('position');
			const operation = parseInt(document.getElementById('documento_operation[' + position + ']').value);
			const elDocumentoTramite = $(document.getElementById('documento_tramite_id[' + position + ']'));
			const tramiteId = parseInt(elDocumentoTramite.val());
			if (operation === 1) {
				let opciones = '';
				tramites.forEach(function (tramite) {
					let selected = (parseInt(tramite.id) === tramiteId) ? 'selected' : '';
					opciones += '<option value="' + tramite.id + '" ' + selected + ' >' + tramite.text + '</option>';
				});
				elDocumentoTramite.html(opciones);
			}
		});

	};

	/**
	 *
	 * @param position
	 * @param tipo
	 * @param codigo
	 * @param documento
	 * @param archivos
	 * @param tramiteId
	 * @param tramiteText
	 * @param archivoAnt
	 * @returns {string}
	 */
	objDocumento.imprimir = function (position, tipo, codigo, documento, archivos, tramiteId, tramiteText, archivoAnt) {
		const type1Selected = (parseInt(tipo) === 1) ? 'selected' : '';
		const type2Selected = (parseInt(tipo) === 2) ? 'selected' : '';
		const modal = 'document-modal-' + position;
		const totalArchivos = (archivos && Array.isArray(archivos)) ? archivos.length : 0;
		let row = '<tr data-position="' + position + '" >';
		row += '<td class="text-center" >';
		row += '<span class="font-weight-bold" >' + (position + 1) + '</span>';
		row += '</td>';
		row += '<td class="text-center" >';
		row += '<select class="custom-select documento-tramite" id="documento_tramite_id[' + position + ']" name="documento_tramite_id[' + position + ']" >';
		if (tramiteId) {
			row += '<option value="' + tramiteId + '" selected >' + tramiteText + '</option>';
		}
		row += '</select>';
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
			let refCodigo = parseInt(codigo);
			let block = (refCodigo >= 900) ? '' : 'readonly';
			row += '<input type="text" class="form-control" id="documento_nombre[' + position + ']" name="documento_nombre[' + position + ']" ' + block + ' value="' + documento + '" >';
		} else {
			row += '<input type="text" class="form-control" id="documento_nombre[' + position + ']" name="documento_nombre[' + position + ']" value="" >';
		}
		row += '<div class="input-group-prepend" >';
		row += '<button type="button" role="button" class="btn btn-light btn-cargar-documento-' + position + '" data-toggle="modal" data-target="#' + modal + '" ><i class="fa fa-plus" ></i> Cargar Archivo</button>';
		row += '<button type="button" role="button" id="btn-download-files-' + position + '" class="btn btn-light documento-descargar-archivos" style="display: none" ><i class="fa fa-download" ></i> Descargar Archivos</button>';
		row += '</div>';
		row += '</div>';
		row += '</td>';
		row += '<td class="text-center" >';
		row += '<span class="font-weight-bold text-success" id="documento_archivos_total[' + position + ']" >' + totalArchivos + '</span>';
		// row += '</td>';
		// row += '<td>';
		// row += '<div class="text-center" >';
		// row += '<button type="button" role="button" class="btn btn-light btn-sm dropdown-toggle option-documento" data-boundary="viewport" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" >';
		// row += '<i class="fa fa-bars"></i>';
		// row += '</button>';
		// row += '<div class="dropdown-menu dropdown-menu-right">';
		// row += '<h6 class="dropdown-header">Opciones</h6>';
		// row += '<button type="button" role="button" class="dropdown-item option-documento-remove" >';
		// row += '<i class="fa fa-trash"></i> Eliminar';
		// row += '</button>';
		// row += '</div>';
		// 0: Nuevo, 1: Editable, 2: Eliminar, otros: no se toma encuenta
		row += '<input type="hidden" class="d-none" id="documento_id[' + position + ']" name="documento_id[' + position + ']" value="' + codigo + '" />';
		row += '<input type="hidden" class="d-none" id="documento_operation[' + position + ']" name="documento_operation[' + position + ']" value="1" />';

		row += '<div class="modal fade" id="' + modal + '" style="display: none" tabindex="-1" data-backdrop="static" data-keyboard="false" aria-hidden="true">';
		row += '<div class="modal-dialog modal-lg modal-dialog-scrollable">';
		row += '<div class="modal-content">';
		row += '<div class="modal-header bg-success text-left">';
		row += '<h5 class="modal-title fs w-100 font-weight-bold">Cargar archivo(s)</h5>';
		row += '</div>';
		row += '<div class="modal-body" style="background-color:#ffffff; border-top: 1px solid #00a65a; border-bottom: 1px solid #00a65a;">';
		row += '<div class="table-responsive" >';
		row += '<table class="table table-bordered table-striped tbl-documento-archivos-carga" id="tbl-documento-archivos-' + position + '" >';
		row += '<thead>';
		row += '<tr>';
		row += '<th class="text-left" style="min-width: 220px;" >Archivo</th>';
		row += '<th class="text-center" style="width: 130px; min-width: 130px;" >OP</th>';
		row += '</tr>';
		row += '</thead>';
		row += '<tbody>';
		if (archivos && Array.isArray(archivos)) {
			archivos.forEach(function (item, key) {
				const name = item.DUBICACIONFILESERVER;
				let realName = '';
				if (name) {
					realName = String(item.DUBICACIONFILESERVER).split('/').reverse()[0];
				}
				row += '<tr data-key="' + key + '" data-position="' + position + '" >';
				row += '<td class="text-left" >';
				row += '<div class="input-group" >';
				row += '<div class="form-control bg-light" >';
				row += '<a href="' + BASE_URL + 'FTPfileserver/Archivos/' + item.DUBICACIONFILESERVER + '" target="_blank" class="text-primary" ><i class="fa fa-download" ></i> ' + realName + '</a>';
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
		row += '<div class="modal-footer w-100 d-flex flex-row">';
		row += '<button type="button" class="btn btn-link" id="cerrarVentanArchivo-' + position + '" data-dismiss="modal" data-position="' + position + '" >';
		row += 'Cerrar Ventana';
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
	 * Devuelve el total de archivos agregados
	 * @param position
	 * @returns {number}
	 */
	objDocumento.totalArchivos = function (position) {
		let total = 0;
		$("#tbl-documento-archivos-" + position + " > tbody > tr").each(function () {
			const row = $(this);
			const key = row.data('key');
			const operation = parseInt(document.getElementById('archivo_documento_operation[' + position + '][' + key + ']').value);
			if (operation === 1) {
				++total;
			}
		});
		return total;
	};

	/**
	 * Agrega un nuevo item para elegir un archivo
	 */
	objDocumento.agregarArchivo = function () {
		const button = $(this);
		const position = button.data('position');
		if (objDocumento.totalArchivos(position) >= 10) {
			objPrincipal.notify('error', 'No puede agregar más documentos por el momento.');
			return false;
		}
		const tabla = $("#tbl-documento-archivos-" + position + " > tbody");
		const key = $("#tbl-documento-archivos-" + position + " > tbody > tr").length;
		tabla.append('<tr data-key="' + key + '" data-position="' + position + '" >' +
			'<td class="text-left" >' +
			'<input type="file" class="form-control upload-document" id="archivo_documento[' + position + '][' + key + ']" name="archivo_documento[' + position + '][' + key + ']" value="" />' +
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
	objDocumento.eliminarArchivo = function () {
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
	objDocumento.confirmarEliminarArchivo = function (row, position, key) {
		if (document.getElementById('archivo_documento_operation[' + position + '][' + key + ']')) {
			document.getElementById('archivo_documento_operation[' + position + '][' + key + ']').value = 0;
		}
		row.hide();
	};

	/**
	 * Elimina todos los documentos
	 */
	objDocumento.eliminarArchivos = function () {
		$('table#tblDocumentos tbody').html('');
	};

	/**
	 * Guarda el total de archivos del documento
	 */
	objDocumento.guardarTotalArchivo = function () {
		const position = $(this).data('position');
		const table = $('table#tbl-documento-archivos-' + position)
		let total = 0;
		if (table.length) {
			table.find('tbody > tr').each(function () {
				const row = $(this);
				const key = row.data('key');
				if (document.getElementById('archivo_documento_operation[' + position + '][' + key + ']')) {
					const opoeration = parseInt(document.getElementById('archivo_documento_operation[' + position + '][' + key + ']').value);
					const archivo = $(document.getElementById('archivo_documento[' + position + '][' + key + ']')).val();
					if (archivo && (opoeration === 1 || opoeration === 2)) {
						++total;
					}
				}
			});
		}
		if (document.getElementById('documento_archivos_total[' + position + ']')) {
			document.getElementById('documento_archivos_total[' + position + ']').innerText = total.toString();
		}
		objDocumento.verificarDocumentos();
		$('#document-modal-' + position).modal('hide');
	};

	/**
	 * Realiza el contador de documentos
	 */
	objDocumento.verificarDocumentos = function () {
		objDocumento.rutaDocumentos = [];
		$('table.tbl-documento-archivos-carga > tbody > tr').each(function () {
			const row = $(this);
			const position = row.data('position');
			const key = row.data('key');
			const opoeration = parseInt(document.getElementById('archivo_documento_operation[' + position + '][' + key + ']').value);
			const RutaDocumento = $(document.getElementById('archivo_documento[' + position + '][' + key + ']')).val();
			const archivo = $(document.getElementById('archivo_documento[' + position + '][' + key + ']')).val();
			if (archivo && (opoeration === 1 || opoeration === 2)) {
				objDocumento.agregarRutaDocumento(RutaDocumento);
			}
		});
		1
		objDocumento.imprimirRutaDocumentos();
	};

	/**
	 * Agregar ruta de documento
	 * @param archivo
	 */
	objDocumento.agregarRutaDocumento = function (archivo) {
		objDocumento.rutaDocumentos.push(archivo);
	};

	/**
	 * Imprimir Documentos
	 */
	objDocumento.imprimirRutaDocumentos = function () {
		let filas = '';
		objDocumento.rutaDocumentos.forEach(function (ruta, index) {
			filas += '<tr>';
			filas += '<td class="text-center" style="width: 60px; min-width: 60px"  >' + (index + 1) + '</td>';
			filas += '<td class="text-left" style="min-width: 250px" >' + ruta + '</td>';
			filas += '</tr>';
		});
		$('#btnRutaDocumentos tbody').html(filas);
		$('#totalRutaDocumentos').html(objDocumento.rutaDocumentos.length);
	};

	/**
	 * Eliminar un archivo cargado
	 */
	objDocumento.eliminarRealArchivo = function () {
		const button = $(this);
		const position = button.data('position');
		const id = button.data('id');
		const cdocumento = document.getElementById('documento_id[' + position + ']').value;
		objDocumento.eliminarRealArchivoDet(button, id, cdocumento)
			.done(function (response) {
				objPrincipal.notify('success', response.message);
				$('#cerrarVentanArchivo-' + position).click();
				setTimeout(function() {
					objFormularioAR.editForm(objFormularioAR.data.ar.CASUNTOREGULATORIO, $('#btnTramiteGuardar'));
				}, 1000);
			})
			.fail(function (jqxhr) {
				const message = (jqxhr && jqxhr.responseJSON && jqxhr.responseJSON.message) ? jqxhr.responseJSON.message : 'Error en la solicitud del servidor.';
				objPrincipal.notify('error', message);
			})
			.always(function () {
				objPrincipal.liberarBoton(button);
			});
	};

	/**
	 *
	 * @param button
	 * @param id
	 * @param cdocumento
	 * @returns {*|jQuery}
	 */
	objDocumento.eliminarRealArchivoDet = function (button, id, cdocumento) {
		if (id) {
			// Si no es null se elimina el archivo en el detalle
			return $.ajax({
				url: BASE_URL + 'ar/ope/ctramite/eliminar_archivo',
				method: 'POST',
				data: {
					id: id,
				},
				dataType: 'json',
				beforeSend: function () {
					objPrincipal.botonCargando(button);
				}
			});
		} else {
			// Si no es null se elimina el archivo en el detalle
			return $.ajax({
				url: BASE_URL + 'ar/ope/ctramite/eliminar_archivo_cab',
				method: 'POST',
				data: {
					casuntoregula: objFormularioAR.data.ar.CASUNTOREGULATORIO,
					centidadregula: objFormularioAR.data.tramite.CENTIDADREGULA,
					ctramite: objFormularioAR.data.tramite.CTRAMITE,
					cdocumento: cdocumento,
				},
				dataType: 'json',
				beforeSend: function () {
					objPrincipal.botonCargando(button);
				}
			});
		}
	};

	/**
	 * Elimina el documento
	 */
	objDocumento.eliminarDocumento = function () {
		const button = $(this);
		const row = button.parents('tr');
		const position = row.data('position');
		const id = (document.getElementById('documento_id[' + position + ']')) ? document.getElementById('documento_id[' + position + ']').value : '';
		if (document.getElementById('documento_operation[' + position + ']')) {
			document.getElementById('documento_operation[' + position + ']').value = (id > 0) ? 2 : 3;
		}
		row.hide();
	};

	/**
	 * Guarda el archivo elegido
	 */
	objDocumento.guardarArchivo = function() {
		// Solo cuando se elige el archivo
		if ($(this).val()) {
			const row = $(this).parent('td').parent('tr');
			const position = row.data('position');
			const button = $('.btn-cargar-documento-' + position);
			var formData = new FormData();
			var files = $(this)[0].files[0];
			formData.append('archivo_documento', files);
			formData.append('asuntoregulatorio_id', objFormularioAR.data.ar.CASUNTOREGULATORIO);
			formData.append('tramite_entidad_id', $('#tramite_entidad_id').val());
			formData.append('tramite_tipo_producto_id', $('#tramite_tipo_producto_id').val());
			formData.append('documento_tramite_id', document.getElementById('documento_tramite_id[' + position + ']').value);
			formData.append('documento_tipo', document.getElementById('documento_tipo[' + position + ']').value);
			formData.append('documento_nombre', document.getElementById('documento_nombre[' + position + ']').value);
			formData.append('documento_id', document.getElementById('documento_id[' + position + ']').value);
			$('#cerrarVentanArchivo-' + position).click();
			$.ajax({
				url: BASE_URL + 'ar/ope/ctramite/guardar_archivo',
				type: 'POST',
				data: formData,
				contentType: false,
				processData: false,
				beforeSend: function () {
					objPrincipal.botonCargando(button);
				}
			}).done(function (res) {
				objPrincipal.notify('success', 'Archivo cargado correctamente.')
			}).fail(function () {
				objPrincipal.notify('error', 'Error al cargar el archivo.');
			}).always(function () {
				objPrincipal.liberarBoton(button);
				setTimeout(function() {
					objFormularioAR.editForm(objFormularioAR.data.ar.CASUNTOREGULATORIO, $('#btnTramiteGuardar'));
				}, 1000);
			});
		}
	};

});

$(document).ready(function () {

	$(document).on('click', '.option-archivo-remove', objDocumento.eliminarArchivo);

	$(document).on('click', '.btn-add-document-file', objDocumento.agregarArchivo);

	// $(document).on('click', '.btn-save-upload-file', objDocumento.guardarTotalArchivo);

	$(document).on('click', '.option-remove-real-file', objDocumento.eliminarRealArchivo);

	$(document).on('click', '.option-documento-remove', objDocumento.eliminarDocumento);

	$(document).on('change', '.upload-document', objDocumento.guardarArchivo);

	$('#btnDocumentoAgregar').click(function () {
		objDocumento.agregarItem();
	});

});
