/*!
 *
 * @version 1.0.0
 */

const objTramite = {};

$(function() {

	/**
	 * Impresion de datos del tramite
	 * @param entidad
	 * @param tipoProducto
	 * @param nroSeguimiento
	 * @param nroDR
	 * @param nroExpediente
	 * @param estado
	 * @param registroSanitario
	 * @param fechaEmision
	 * @param fechaVencimiento
	 */
	objTramite.printData = function(entidad, tipoProducto, nroSeguimiento, nroDR, nroExpediente, estado, registroSanitario, fechaEmision, fechaVencimiento) {
		// Tramite
		$('#tramite_entidad_id').prop('disabled', false).refreshSelect2(entidad);
		$('#tramite_tipo_producto_id').prop('disabled', false).refreshSelect2(tipoProducto);
		$('#carga_registro_nro_seguimiento').val(nroSeguimiento);
		$('#carga_registro_nro_dr').val(nroDR);
		$('#carga_registro_nro_expediente').val(nroExpediente);
		if (estado) {
			$('#carga_registro_estado option[value=' + estado + ']').prop('selected', true);
		}
		$('#carga_registro_nro_rs').val(registroSanitario);
		$('#carga_registro_fecha_inicio').val(fechaEmision);
		$('#carga_registro_fecha_final').val(fechaVencimiento);
	};

	/**
	 * Agregar nuevo item
	 * @see objTramite.formItem
	 */
	objTramite.agregarItem = function(data) {
		const table = $('table#tblTramite tbody');
		const position = table.find('tr').length;
		const tramiteId = (data && data.id) ? data.id : null;
		const tramiteText = (data && data.text) ? data.text : '';
		table.append(objTramite.formItem(position, tramiteId, tramiteText));
		// Se agrega el plugin para elegir el tramite
		const s2TramiteReguladoraEntidad = Object.assign({}, s2TramiteReguladora);
		s2TramiteReguladoraEntidad.params.entidad = $('#tramite_entidad_id').val();
		s2TramiteReguladoraEntidad.params.tipo_producto = $('#tramite_tipo_producto_id').val();
		s2TramiteReguladoraEntidad.init($(document.getElementById('tramite_id[' + position + ']')));
	};

	/**
	 * Refresca toda la tabla
	 * @see objTramite.eliminarItem
	 */
	objTramite.refreshTable = function() {
		$('table#tblTramite tbody tr').each(function() {
			const row = $(this);
			objTramite.eliminarItem(row);
		});
		objProductoLista.eliminarProductoElegidos();
	};

	/**
	 * Confirma la eliminacion del item
	 * @param row
	 */
	objTramite.eliminarItem = function(row) {
		const position = row.data('position');
		let id = parseInt(document.getElementById('tramite_id[' + position + ']').value);
		id = (isNaN(id)) ? 0 : id;
		document.getElementById('tramite_operation[' + position + ']').value = (id > 0) ? 2 : 3;
		row.hide();
	};

	/**
	 * HTML del ítem
	 * @param position
	 * @param tramiteId
	 * @param tramiteText
	 * @returns {string}
	 */
	objTramite.formItem = function(position, tramiteId, tramiteText) {
		let row = '<tr data-position="' + position + '" >';
			row += '<td class="text-left" >';
		row += '<div class="form-group mb-0" >';
		row += '<select name="tramite_id[' + position + ']" id="tramite_id[' + position + ']" aria-label="" class="custom-select tramite-elegir">';
		if (tramiteId) {
			row += '<option value="' + tramiteId +'" >' + tramiteText + '</option>';
		}
		row += '</select>';
		row += '</div>';
		row += '</td>';
		row += '<td class="text-center" >';
		row += '<button type="button" role="button" class="btn btn-light btn-sm dropdown-toggle" data-boundary="viewport" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" >';
		row += '<i class="fa fa-bars"></i>';
		row += '</button>';
		row += '<div class="dropdown-menu dropdown-menu-right">';
		row += '<h6 class="dropdown-header">Opciones</h6>';
		row += '<button type="button" role="button" class="dropdown-item option-tramite-remove" >';
		row += '<i class="fa fa-trash"></i> Eliminar';
		row += '</button>';
		row += '</div>';
			// 0: Nuevo, 1: Editable, 2: Eliminar, otros: no se toma encuenta
		row += '<input type="hidden" class="d-none" id="tramite_operation[' + position + ']" name="tramite_operation[' + position + ']" value="0" />';
		row += '</td>';
		row += '</tr>';
		return row;
	};

	/**
	 * Elimina un item
	 * @see objTramite.eliminarItem
	 */
	objTramite.handleRemoveItem = function() {
		const button = $(this);
		const row = button.parents('tr');
		objTramite.eliminarItem(row);
	};

	/**
	 * Se ejecuta cuando se realiza un cambio en el tramite
	 */
	objTramite.changeTramite = function() {
		const value = $(this).val();
		if (value) {
			objDocumento.obtener(value);
		}
	};

});

$(document).ready(function() {

	s2EntidadRegulatoria.init($('#tramite_entidad_id'));

	const s2TipoProductoTramite = Object.assign({}, s2TipoProducto);
	s2TipoProductoTramite.init($('#tramite_tipo_producto_id'));
	s2TipoProductoTramite.params.entidad = 0;

	$('#tramite_entidad_id').change(function() {
		s2TipoProductoTramite.params.entidad = $(this).val();
		$('#tramite_tipo_producto_id').refreshSelect2([]);
	});

	$(document).on('click', '.option-tramite-remove', objTramite.handleRemoveItem);

	$('#btnAgregarTramite').click(function() {
		objTramite.agregarItem();
	});

	$('#tramite_entidad_id, #tramite_tipo_producto_id').change(function() {
		objTramite.refreshTable();
	});

	$(document).on('change', '.tramite-elegir', objTramite.changeTramite);

});
