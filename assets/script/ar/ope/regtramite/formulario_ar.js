/*!
 *
 * @version 1.0.0
 */

const objFormularioAR = {};

$(function () {

	/**
	 * Data del formulario completo
	 * @type Object
	 */
	objFormularioAR.data = {};

	/**
	 * Deshabilita el formulario de datos
	 * @param {string} form
	 * @param {string} name
	 * @param {boolean} clearData
	 */
	objFormularioAR.disabledForm = function (form, name, clearData) {
		form = (typeof form === 'undefined') ? 'formTramite' : form;
		name = (typeof name === 'undefined') ? 'disabled' : name;
		clearData = (typeof clearData === 'undefined') ? true : clearData;
		const formData = $('form#' + form);
		formData.find('fieldset').css({opacity: '0.2'});
		// Inputs
		formData.find('select.select2-hidden-accessible').prop('disabled', true);
		formData.find('button, a').prop(name, true);
		formData.find('checkbox, radio').prop(name, true);
		const elValue = formData.find('input, select, textarea');
		elValue.prop(name, true);
		if (clearData) {
			objFormularioAR.clearForm(form);
		}
	};

	/**
	 * Habilita el formulario de datos
	 * @param {string} form
	 * @param {string} name
	 * @param {boolean} clearData
	 */
	objFormularioAR.enableForm = function (form, name, clearData) {
		form = (typeof form === 'undefined') ? 'formTramite' : form;
		name = (typeof name === 'undefined') ? 'disabled' : name;
		clearData = (typeof clearData === 'undefined') ? true : clearData;
		const formData = $('form#' + form);
		const elValue = formData.find('input, select, textarea');
		formData.find('fieldset').removeAttr('style');
		// Inputs
		const elButtons = formData.find('button, a');
		const elCheckbox = formData.find('checkbox, radio');
		formData.find('select.select2-hidden-accessible').prop('disabled', false);
		if (name === 'all') {
			elButtons.prop('disabled', false);
			elCheckbox.prop('disabled', false);
			elValue.prop('disabled', false);
			elButtons.prop('readonly', false);
			elCheckbox.prop('readonly', false);
			elValue.prop('readonly', false);
		} else {
			elButtons.prop(name, false);
			elCheckbox.prop(name, false);
			elValue.prop(name, false);
		}
		if (clearData) {
			objFormularioAR.clearForm(form);
		}
	};

	/**
	 * Limpia los datos del formulario
	 * @param {string} form
	 * @param {string} notClear Sirve para no limpiar algunos campos que sean necesarios
	 */
	objFormularioAR.clearForm = function (form, notClear) {
		form = (typeof form === 'undefined') ? 'formTramite' : form;
		notClear = (typeof notClear === 'undefined') ? '' : notClear;
		const formData = $('form#' + form);
		const elInput = (notClear) ? 'input:not(' + notClear + ')' : 'input';
		const elSelect = (notClear) ? 'select:not(' + notClear + ')' : 'select';
		const elTextArea = (notClear) ? 'textarea:not(' + notClear + ')' : 'textarea';
		formData.find([elInput, elSelect, elTextArea].join(',')).val(null);
		formData.find('select.select2-hidden-accessible').each(function () {
			$(this).refreshSelect2([]);
		});
	};

	/**
	 * Habilita el formulario para poder crear un nuevo AR
	 * @see objFormularioAR.printData
	 * @see objFormularioAR.disabledForm
	 */
	objFormularioAR.newForm = function () {
		const currentDate = moment().format('DD/MM/YYYY');
		objFormularioAR.disabledForm('formTramite');
		objFormularioAR.disabledForm('formAR', 'readonly', false);
		objFormularioAR.printData('', currentDate, '', 'A');
		$('#ar_grupo_empresarial').prop('disabled', false).refreshSelect2([]);
		$('#ar_cliente_id').prop('disabled', false).refreshSelect2([]);
		$('#btnSaveAR').show();
		// Se cierra los dos
		$('#btnTramiteAbrir').hide();
		$('#btnTramiteCerrar').hide();
		// Documentos eliminados
		objDocumento.eliminarArchivos();
		// Muestra formulario
		$('#tab-registro-ar').click();
	};

	/***
	 * Boton para editar el formulario
	 * @param id
	 * @param button
	 */
	objFormularioAR.editForm = function (id, button) {
		objPrincipal.botonCargando(button);
		// Documentos eliminados
		objDocumento.eliminarArchivos();
		objFormularioAR.search(id)
			.done(function (res) {
				const data = res.data;
				objFormularioAR.data = data;
				objFormularioAR.printData(data.ar.CASUNTOREGULATORIO, data.ar.FAPERTURA, data.ar.FCIERRE, data.ar.SCIERRE);
				$('#ar_grupo_empresarial').prop('disabled', false).refreshSelect2([{
					id: data.grupoEmpresarial.cgrupoempresarial,
					text: data.grupoEmpresarial.dgrupoempresarial
				}]);
				$('#ar_cliente_id').prop('disabled', false).refreshSelect2([{
					id: data.cliente.CCLIENTE,
					text: data.cliente.DRAZONSOCIAL
				}]);
				objFormularioAR.disabledForm('formAR', 'readonly', false);
				objFormularioAR.enableForm('formTramite', 'all', false);
				$('#btnSaveAR').hide();
				// Tramite
				const entidad = (data.entidad) ? [{
					id: data.entidad.CENTIDADREGULA,
					text: data.entidad.DENTIDADREGULA
				}] : [];
				const tipoProducto = (data.tipoProducto) ? [{
					id: data.tipoProducto.id,
					text: data.tipoProducto.text
				}] : []
				const nroSeguimiento = (data.tramite && data.tramite.DTRACKIDTRAMITE) ? data.tramite.DTRACKIDTRAMITE : '';
				const nroDR = (data.tramite && data.tramite.DNUMERODR) ? data.tramite.DNUMERODR : '';
				const nroExpediente = (data.tramite && data.tramite.DNUMEROEXPEDIENTE) ? data.tramite.DNUMEROEXPEDIENTE : '';
				const estado = (data.tramite && data.tramite.STRAMITE) ? data.tramite.STRAMITE : '';
				const registroSanitario = (data.tramite && data.tramite.DNUMEROREGISTRO) ? data.tramite.DNUMEROREGISTRO : '';
				const fechaEmision = (data.tramite && data.tramite.FEMISIONREGISTRO) ? data.tramite.FEMISIONREGISTRO : '';
				const fechaVencimiento = (data.tramite && data.tramite.FVENCIMIENTOREGISTRO) ? data.tramite.FVENCIMIENTOREGISTRO : '';
				objTramite.printData(
					entidad,
					tipoProducto,
					nroSeguimiento,
					nroDR,
					nroExpediente,
					estado,
					registroSanitario,
					fechaEmision,
					fechaVencimiento,
				);
				if (data.tramites && Array.isArray(data.tramites)) {
					data.tramites.forEach(function (item) {
						objTramite.agregarItem({
							id: item.CTRAMITE,
							text: item.DTRAMITE,
						}, false);
					});
				}
				// Productos
				if (data.productos && Array.isArray(data.productos)) {
					objProductoLista.productosElegidos = data.productos;
					objProductoLista.imprimirProductos(false);
				}
				// Documentos
				if (data.documentos && Array.isArray(data.documentos)) {
					objDocumento.imprimirResultado(data.documentos);
				}
				objPrincipal.liberarBoton(button);
				// verifica los tramites
				objTramite.bloqueoPorTramite();
				// Muestra formulario
				$('#tab-registro-ar').click();
				// Si se encuentra abiero, se habilita el boton para cerrar
				if (data.ar.SCIERRE === 'A') {
					objFormularioAR.habilitarCierre();
				}
				if (data.ar.SCIERRE === 'C') {
					objFormularioAR.habilitarAbrir();
				}
			});
	};

	/**
	 * Habilita el cierre del AR
	 */
	objFormularioAR.habilitarCierre = function() {
		$('#btnTramiteAbrir').hide();
		$('#btnTramiteCerrar').show();
		$('#btnTramiteGuardar').show();
		// accion de botones
		$('#btnAgregarTramite').show();
		$('#btnAgregarProducto').show();
		$('#btnEliminarProductosElegidos').show();
		$('#btnDocumentoAgregar').show();
		$('.option-tramite').show();
		$('.option-producto').show();
		$('.option-documento').show();
	};

	/**
	 * Habilita el abrir del AR
	 */
	objFormularioAR.habilitarAbrir = function() {
		$('#btnTramiteCerrar').hide();
		$('#btnTramiteAbrir').show();
		$('#btnTramiteGuardar').hide();
		// accion de botones
		$('#btnAgregarTramite').hide();
		$('#btnAgregarProducto').hide();
		$('#btnEliminarProductosElegidos').hide();
		$('#btnDocumentoAgregar').hide();
		$('.option-tramite').hide();
		$('.option-producto').hide();
		$('.option-documento').hide();
	};

	/**
	 * Busqueda del asunto regulatorio
	 * @param id
	 * @returns {*}
	 */
	objFormularioAR.search = function (id) {
		return $.ajax({
			url: BASE_URL + 'ar/ope/ctramite/buscar/' + id,
			method: 'POST',
			data: {},
			dataType: 'json',
			beforeSend: function () {
				// code
			}
		}).fail(function (jqxhr) {
			const message = (jqxhr && jqxhr.responseJSON && jqxhr.responseJSON.message) ? jqxhr.responseJSON.message : 'Error en la solicitud del servidor.';
			objPrincipal.notify('error', message);
		});
	};

	/**
	 * Impresión de los datos del formulario
	 * @param id
	 * @param currentDate
	 * @param endDate
	 * @param status
	 */
	objFormularioAR.printData = function (id, currentDate, endDate, status) {
		$('#ar_codigo').val(id);
		$('#ar_fecha_inicio').val(currentDate);
		$('#ar_fecha_cierre').val(endDate);
		$('#ar_estado').val(status);
		const textStatus = (status === 'A') ? 'Abierto' : 'Cerrado';
		$('#ar_estado_text').val(textStatus);
	};

	/**
	 * Realiza el guardar el AR
	 */
	objFormularioAR.save = function () {
		const button = $(this);
		const form = $('form#formAR');
		$.ajax({
			url: form.attr('action'),
			method: 'POST',
			data: form.serialize(),
			dataType: 'json',
			beforeSend: function () {
				objPrincipal.botonCargando(button);
			},
		}).done(function (res) {
			objFormularioAR.data = res.data;
			const ar = objFormularioAR.data.ar;
			button.hide();
			objFormularioAR.enableForm('formTramite', 'all');
			objFormularioAR.disabledForm('formAR', 'readonly', false);
			objFormularioAR.printSave(ar);
		}).fail(function (jqxhr) {
			const message = (jqxhr && jqxhr.responseJSON && jqxhr.responseJSON.message) ? jqxhr.responseJSON.message : 'Error en la solicitud del servidor.';
			objPrincipal.notify('error', message);
		}).always(function () {
			objPrincipal.liberarBoton(button);
		});
	};

	/**
	 * Imprime el resultado del AR
	 * @param ar
	 */
	objFormularioAR.printSave = function(ar) {
		const currentDate = moment(ar.FAPERTURA, 'YYYY-MM-DD HH:mm:ss').format('DD/MM/YYYY');
		let endDate = '';
		if (ar.FCIERRE) {
			endDate = moment(ar.FCIERRE, 'YYYY-MM-DD HH:mm:ss').format('DD/MM/YYYY');
		}
		objFormularioAR.printData(ar.CASUNTOREGULATORIO, currentDate, endDate, ar.SREGISTRO);
	};

	/**
	 * Guarda el tramite completo
	 */
	objFormularioAR.saveTramite = function () {
		const form = $('#formTramite');
		const button = $('#btnTramiteGuardar');
		const data = new FormData(form[0]);
		data.append('asuntoregulatorio_id', objFormularioAR.data.ar.CASUNTOREGULATORIO);
		$.ajax({
			url: form.attr('action'),
			method: 'POST',
			data: data,
			dataType: 'json',
			cache: false,
			contentType: false,
			processData: false,
			beforeSend: function () {
				objPrincipal.botonCargando(button);
				objFormularioAR.disabledForm('formTramite', 'readonly', false);
			},
		}).done(function (res) {
			objPrincipal.notify('success', res.message);
			objFormularioAR.habilitarCierre();
		}).fail(function (jqxhr) {
			const message = (jqxhr && jqxhr.responseJSON && jqxhr.responseJSON.message) ? jqxhr.responseJSON.message : 'Error en la solicitud del servidor.';
			objPrincipal.alert('error', message);
		}).always(function () {
			objFormularioAR.enableForm('formTramite', 'readonly', false);
			objPrincipal.liberarBoton(button);
		});
	};

	/**
	 * Cierre del AR
	 */
	objFormularioAR.cerrarTramite = function () {
		const button = $(this);
		Swal.fire({
			type: 'warning',
			title: '¿Estas seguro(a) de cerrar el AR?',
			text: 'No podrás modificar ningún dato del AR hasta volver abrirlo.',
			showCancelButton: true,
			confirmButtonColor: '#3085d6',
			cancelButtonColor: '#d33',
			confirmButtonText: 'Si, acepto!',
			cancelButtonText: 'No',
		}).then((res) => {
			if (true === res.value) {
				objFormularioAR.disabledForm('formTramite', 'readonly', false);
				objFormularioAR.confirmarCierreTramite(objFormularioAR.data.ar.CASUNTOREGULATORIO, button)
					.done(function (res) {
						objPrincipal.notify('success', res.message);
						$('#btnRetornarLista').click();
					})
					.fail(function () {
						objFormularioAR.enableForm('formTramite', 'readonly', false);
					});
			}
		});
	};

	/**
	 * Se confirma el cierre del AR
	 */
	objFormularioAR.confirmarCierreTramite = function (id, button) {
		objPrincipal.botonCargando(button);
		return $.ajax({
			url: BASE_URL + 'ar/ope/ctramite/cerrar',
			method: 'POST',
			data: {
				id: id,
			},
			dataType: 'json',
		}).fail(function (jqxhr) {
			const message = (jqxhr && jqxhr.responseJSON && jqxhr.responseJSON.message) ? jqxhr.responseJSON.message : 'Error en la solicitud del servidor.';
			objPrincipal.alert('error', message);
			objFormularioAR.enableForm('formTramite', 'readonly', false);
		}).always(function () {
			objPrincipal.liberarBoton(button);
		});
	};

	/**
	 * Cierre del AR
	 */
	objFormularioAR.abrirTramite = function () {
		const button = $(this);
		Swal.fire({
			type: 'warning',
			title: '¿Estas seguro(a) de abrir el AR?',
			text: 'Podrás modificar los dato del AR.',
			showCancelButton: true,
			confirmButtonColor: '#3085d6',
			cancelButtonColor: '#d33',
			confirmButtonText: 'Si, acepto!',
			cancelButtonText: 'No',
		}).then((res) => {
			if (true === res.value) {
				objFormularioAR.disabledForm('formTramite', 'readonly', false);
				objFormularioAR.confirmarAbrirTramite(objFormularioAR.data.ar.CASUNTOREGULATORIO, button)
					.done(function (res) {
						// verifica los tramites
						objTramite.bloqueoPorTramite();
						objPrincipal.notify('success', res.message);
					})
					.always(function () {
						objFormularioAR.enableForm('formTramite', 'readonly', false);
					});
			}
		});
	};

	/**
	 * Se confirma el cierre del AR
	 */
	objFormularioAR.confirmarAbrirTramite = function (id, button) {
		objPrincipal.botonCargando(button);
		return $.ajax({
			url: BASE_URL + 'ar/ope/ctramite/abrir',
			method: 'POST',
			data: {
				id: id,
			},
			dataType: 'json',
		}).done(function(res) {
			objFormularioAR.enableForm('formTramite', 'readonly', false);
			objFormularioAR.printSave(res.data);
			objFormularioAR.habilitarCierre();
		}).fail(function (jqxhr) {
			const message = (jqxhr && jqxhr.responseJSON && jqxhr.responseJSON.message) ? jqxhr.responseJSON.message : 'Error en la solicitud del servidor.';
			objPrincipal.alert('error', message);
			objFormularioAR.enableForm('formTramite', 'readonly', false);
		}).always(function () {
			objPrincipal.liberarBoton(button);
		});
	};

});

$(document).ready(function () {

	$('#btnSaveAR').click(objFormularioAR.save);

	s2GrupoEmpresarial.init($('#ar_grupo_empresarial'));
	s2Cliente.init($('#ar_cliente_id'));

	$('#ar_grupo_empresarial').change(function () {
		s2Cliente.params.grupo_empresarial = $(this).val();
		$('#ar_cliente_id').refreshSelect2([]);
	});

	$('#btnTramiteGuardar').click(objFormularioAR.saveTramite);

	$('#btnRetornarLista').click(function () {
		objFiltro.search();
		$('#tab-list-ar').click();
	});

	$('#btnTramiteCerrar').click(objFormularioAR.cerrarTramite);

	$('#btnTramiteAbrir').click(objFormularioAR.abrirTramite);

});
