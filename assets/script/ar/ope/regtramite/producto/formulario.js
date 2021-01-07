/*!
 *
 * @version 1.0.0
 */

const objProducto = {};

$(function() {

	objProducto.openModal = function() {
		// Se limpia el campo del formulario
		const formData = $('#frmProducto');
		formData.find('input, select, textarea').val(null);

		// Cliente elegido
		const customer = objFormularioAR.data.cliente;
		const customerID = customer.CCLIENTE;
		$('#producto_cliente_text').val(customer.DRAZONSOCIAL);

		if (!customerID) {
			objPrincipal.alert('warning', 'Debes elegir el Cliente para continuar.');
			$('#modalAddProduct').modal('hide');
		}

		// Tipo de Producto elegido
		const elProductoType = $('#tramite_tipo_producto_id option:selected');
		const productoTypeId = elProductoType.val();
		$('#producto_tipo_producto_text').val(elProductoType.text());

		if (!productoTypeId) {
			objPrincipal.alert('warning', 'Debes elegir el Tipo de Producto para continuar.');
			$('#modalAddProduct').modal('hide');
		}

		// Cliente
		const s2CategoriaProducto = Object.assign({}, s2Categoria);
		s2CategoriaProducto.init($('#producto_categoria_id'));
		s2CategoriaProducto.params.ccliente = customerID;

		// Marca
		const s2MarcaProducto = Object.assign({}, s2Marca);
		s2MarcaProducto.init($('#producto_marca_id'));
		s2MarcaProducto.params.ccliente = customerID;

		// Fabricante
		const s2FabricanteProducto = Object.assign({}, s2Fabricante);
		s2FabricanteProducto.init($('#producto_fabricante_id'));
		s2FabricanteProducto.params.ccliente = customerID;

		// Pais
		s2Pais.init($('#producto_pais'));
	};

	/**
	 * Guarda un producto
	 */
	objProducto.guardar = function() {
		const button = $(this);
		const form = $('#frmProducto');
		const buttons = $('.modal-footer').find('button');
		$.ajax({
			url: form.attr('action'),
			method: 'POST',
			data: form.serialize()
				+ '&codigo_cliente_id=' + objFormularioAR.data.cliente.CCLIENTE
				+ '&tipo_producto_id=' + $('#tramite_tipo_producto_id option:selected').val()
				+ '&entidad_id=' + $('#tramite_entidad_id option:selected').val(),
			dataType: 'json',
			beforeSend: function() {
				buttons.prop('disabled', true);
				objPrincipal.botonCargando(button);
				objFormularioAR.disabledForm('frmProducto', 'readonly', false);
			},
		}).done(function(res) {
			objPrincipal.notify('success', res.message);
			const type = parseInt(button.data('type'));
			if (type === 2) {
				objFormularioAR.clearForm('frmProducto', '#producto_cliente_text, #producto_tipo_producto_text');
			} else {
				$('#modalAddProduct').modal('hide');
			}
		}).fail(function(jqxhr) {
			const message = (jqxhr && jqxhr.responseJSON && jqxhr.responseJSON.message) ? jqxhr.responseJSON.message : 'Error en la solicitud del servidor.';
			objPrincipal.notify('error', message);
		}).always(function() {
			buttons.prop('disabled', false);
			objPrincipal.liberarBoton(button);
			objFormularioAR.enableForm('frmProducto', 'readonly', false);
		});
	};

});

$(document).ready(function() {

	$('#modalAddProduct').on('shown.bs.modal', function() {
		objProducto.openModal();
	});

	$('.btn-producto-guardar').click(objProducto.guardar);

});
