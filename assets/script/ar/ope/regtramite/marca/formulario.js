/*!
 *
 * @version 1.0.0
 */

const objMarca = {};

$(function() {

	objMarca.openModal = function() {
		// Se limpia el campo del formulario
		objFormularioAR.clearForm('frmMarca', '#marca_cliente_text');

		// Cliente elegido
		const customer = objFormularioAR.data.cliente;
		const customerID = customer.CCLIENTE;
		$('#marca_cliente_text').val(customer.DRAZONSOCIAL);

		if (!customerID) {
			objPrincipal.alert('warning', 'Debes elegir el Cliente para continuar.');
			$('#modalFormularioMarca').modal('hide');
		}
	};

	/**
	 * Guarda un producto
	 */
	objMarca.guardar = function() {
		const button = $(this);
		const form = $('#frmMarca');
		$.ajax({
			url: form.attr('action'),
			method: 'POST',
			data: form.serialize()
				+ '&codigo_cliente_id=' + objFormularioAR.data.cliente.CCLIENTE,
			dataType: 'json',
			beforeSend: function() {
				objPrincipal.botonCargando(button);
				objFormularioAR.disabledForm('frmMarca', 'disabled', false);
			},
		}).done(function(res) {
			objPrincipal.notify('success', res.message);
			$('#modalFormularioMarca').modal('hide');
		}).fail(function(jqxhr) {
			const message = (jqxhr && jqxhr.responseJSON && jqxhr.responseJSON.message) ? jqxhr.responseJSON.message : 'Error en la solicitud del servidor.';
			objPrincipal.notify('error', message);
		}).always(function() {
			objPrincipal.liberarBoton(button);
			objFormularioAR.enableForm('frmMarca', 'disabled', false);
		});
	};

});

$(document).ready(function() {

	$('#modalFormularioMarca').on('shown.bs.modal', function() {
		objMarca.openModal();
	});

	$('#btnGuardarMarca').click(objMarca.guardar);

});
