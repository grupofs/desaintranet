/*!
 *
 * @version 1.0.0
 */

const objProducto = {};

$(function() {

	/**
	 * Muestra la venta de crear un nuevo producto
	 */
	objProducto.openModal = function() {
		objProducto.imprimirDatos(null);
		$('#modalAddProduct').modal('show');
	};

	/**
	 * Busqueda del producto
	 * @param id
	 * @param boton
	 */
	objProducto.editarModal = function(id, boton) {
		objProducto.buscar(2, id, boton)
			.done(function(res) {
				if (res && res.items) {
					objProducto.imprimirDatos(res.items[0]);
					$('#modalAddProduct').modal('show');
				}
			});
	};

	/**
	 * Imprime los datos del producto en caso exista
	 * @param producto
	 */
	objProducto.imprimirDatos = function(producto) {
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

		// Imprime los datos del producto
		if (producto) {
			$('#producto_cliente_id').val(producto.CPRODUCTOFS);
			$('#producto_codigo_producto').val(producto.CPRODUCTOCLIENTE);
			$('#producto_rs').val(producto.DREGISTROSANITARIO);
			if (producto.CCATEGORIACLIENTE) {
				$('#producto_categoria_id').refreshSelect2([{
					id: producto.CCATEGORIACLIENTE,
					text: producto.DCATEGORIACLIENTE
				}]);
			}
			// const dateInit = $('#producto_fecha_inicio').data('daterangepicker');
			// dateInit.setStartDate(producto.FINICIOREGSANITARIO)
			// dateInit.setEndDate(producto.FINICIOREGSANITARIO);
			// const dateEnd = $('#producto_fecha_vencimiento').data('daterangepicker');
			// dateEnd.setStartDate(producto.FFINREGSANITARIO)
			// dateEnd.setEndDate(producto.FFINREGSANITARIO);
			$('#producto_fecha_inicio').val(producto.FINICIOREGSANITARIO);
			$('#producto_fecha_vencimiento').val(producto.FFINREGSANITARIO);

			$('#producto_descripcion_sap').val(producto.DPRODUCTOCLIENTE);
			$('#producto_nombre').val(producto.DNOMBREPRODUCTO);
			if (producto.CMARCA) {
				$('#producto_marca_id').refreshSelect2([{id: producto.CMARCA, text: producto.DMARCA}]);
			}
			$('#producto_presentacion').val(producto.DPRESENTACION);
			if (producto.CFABRICANTE) {
				$('#producto_fabricante_id').refreshSelect2([{id: producto.CFABRICANTE, text: producto.DFABRICANTE}]);
			}
			if (producto.CTIPO) {
				$('#producto_pais').refreshSelect2([{id: producto.CTIPO, text: producto.DREGISTRO}]);
			}
			$('#producto_direccion_fabricante').val(producto.DDIRECCIONFABRICANTE);
			$('#producto_vida_util').val(producto.VIDAUTIL);
			$('#producto_estado').val(producto.SREGISTRO).change();
		}
	};

	/**
	 * Tipo:
	 *  0 or null = Todo
	 *  1 = Por RS
	 *  2 = Por Codigo
	 * @param boton
	 * @param tipo
	 * @param buscar
	 * @returns {*}
	 */
	objProducto.buscar = function(tipo, buscar, boton) {
		return $.ajax({
			url: BASE_URL + 'ar/ope/cproductocliente/buscar',
			method: 'POST',
			data: {
				ccliente: objFormularioAR.data.cliente.CCLIENTE,
				tipo_producto: $('#tramite_tipo_producto_id option:selected').val(),
				tipo: tipo,
				buscar: buscar,
			},
			dataType: 'json',
			beforeSend: function() {
				if (boton) {
					objPrincipal.botonCargando(boton);
				}
			},
		}).fail(function() {
			objPrincipal.alert('warning', 'Error al buscar el(los) producto(s)');
		}).always(function() {
			if (boton) {
				objPrincipal.liberarBoton(boton);
			}
		});
	};

	/**
	 * Guarda un producto
	 */
	objProducto.guardar = function() {
		const button = $(this);
		const form = $('#frmProducto');
		const buttons = $('.modal-footer').find('button');
		const esRS = objTramite.esRegistroSanitario();
		const elProductoRS = $('#producto_rs');
		const elProductoFechaIni = $('#producto_fecha_inicio');
		const elProductoFechaVenc = $('#producto_fecha_vencimiento');
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
			// Se valida que no exista
			const indexProducto = objProductoLista.buscarProductoElegido(res.data.CPRODUCTOFS);
			if (indexProducto !== -1) {
				objProductoLista.productosElegidos[indexProducto] = res.data;
			} else {
				// Se agrega el producto
				objProductoLista.agregarProducto(res.data);
				objProductoLista.calcularProductos();
			}
			// Confirmación del registro
			objPrincipal.notify('success', res.message);
			const type = $('#producto-copia-pega').is(':checked');
			if (type) {
				$('#producto_codigo_producto').val('').select();
				$('#producto_descripcion_sap').val('');
				// Solo si no es un RS se limpian los datos
				if (!esRS) {
					elProductoRS.val('');
					elProductoFechaIni.val('');
					elProductoFechaVenc.val('');
				}
			} else {
				$('#modalAddProduct').modal('hide');
				objProductoLista.imprimirRS(res.data);
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
		$('#producto-copia-pega').prop('checked', false);
	});

	$('#modalAddProduct').on('hidden.bs.modal', function() {
		objProductoFiltro.search();
	});

	$('.btn-producto-guardar').click(objProducto.guardar);

});
