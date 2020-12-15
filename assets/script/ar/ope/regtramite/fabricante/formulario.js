/*!
 *
 * @version 1.0.0
 */

const objFabricante = {};

$(function() {

	objFabricante.openModal = function() {
		// Se limpia el campo del formulario
		objFormularioAR.clearForm('frmFabricante', '#fabricante_cliente_text');

		// Cliente elegido
		const customer = objFormularioAR.data.cliente;
		const customerID = customer.CCLIENTE;
		$('#fabricante_cliente_text').val(customer.DRAZONSOCIAL);

		if (!customerID) {
			objPrincipal.alert('warning', 'Debes elegir el Cliente para continuar.');
			$('#modalFormularioFabricante').modal('hide');
		}
	};

	/**
	 * Guarda un producto
	 */
	objFabricante.guardar = function() {
		const button = $(this);
		const form = $('#frmFabricante');
		$.ajax({
			url: form.attr('action'),
			method: 'POST',
			data: form.serialize()
				+ '&codigo_cliente_id=' + objFormularioAR.data.cliente.CCLIENTE,
			dataType: 'json',
			beforeSend: function() {
				objPrincipal.botonCargando(button);
				objFormularioAR.disabledForm('frmFabricante', 'disabled', false);
			},
		}).done(function(res) {
			objPrincipal.notify('success', res.message);
			$('#modalFormularioFabricante').modal('hide');
		}).fail(function(jqxhr) {
			const message = (jqxhr && jqxhr.responseJSON && jqxhr.responseJSON.message) ? jqxhr.responseJSON.message : 'Error en la solicitud del servidor.';
			objPrincipal.notify('error', message);
		}).always(function() {
			objPrincipal.liberarBoton(button);
			objFormularioAR.enableForm('frmFabricante', 'disabled', false);
		});
	};

});

$(document).ready(function() {

	$('#modalFormularioFabricante').on('shown.bs.modal', function() {
		objFabricante.openModal();
	});

	$('#btnGuardarFabricante').click(objFabricante.guardar);

});
