/*!
 *
 * @version 1.0.0
 */

const objProductoLista = {
	/**
	 * @var Array
	 */
	productos: [],
	/**
	 * @var Array
	 */
	productosElegidos: [],

};

$(function () {

	/**
	 * Se ejecuta cuando se habre el modal
	 */
	objProductoLista.openModal = function () {
		// Se limpia el campo del formulario
		$('#filter_producto_descripcion').val('');

		// Cliente elegido
		const customer = objFormularioAR.data.cliente;
		const customerID = customer.CCLIENTE;
		if (!customerID) {
			$('#modalSelectProduct').modal('hide');
			objPrincipal.alert('warning', 'Debes elegir el Cliente para continuar.');
		}

		// Tipo de Producto elegido
		const elProductoType = $('#tramite_tipo_producto_id option:selected');
		const productoTypeId = elProductoType.val();
		if (!productoTypeId) {
			$('#modalSelectProduct').modal('hide');
			objPrincipal.alert('warning', 'Debes elegir el Tipo de Producto para continuar.');
		}

		objProductoLista.calcularProductos();

		// La busqueda de productos se realiza
		objProductoFiltro.search();
	};

	/**
	 * Imprime los datos de la busqueda
	 * @param datos
	 */
	objProductoLista.printResult = function(datos) {
		let row = '';
		let total = 0;
		let result = [];
		if (datos && Array.isArray(datos)) {
			result = datos;
			datos.forEach(function(item, pos) {
				const codigo = (item.CPRODUCTOCLIENTE) ? item.CPRODUCTOCLIENTE : '';
				const descripcion = (item.DPRODUCTOCLIENTE) ? item.DPRODUCTOCLIENTE : '';
				const nombre = (item.DNOMBREPRODUCTO) ? item.DNOMBREPRODUCTO : '';
				const marca = (item.DMARCA) ? item.DMARCA : '';
				const fabricante = (item.DFABRICANTE) ? item.DFABRICANTE : '';
				const pais = (item.DREGISTRO) ? item.DREGISTRO : '';
				const categoria = (item.DCATEGORIACLIENTE) ? item.DCATEGORIACLIENTE : '';
				const registroSanitario = (item.DREGISTROSANITARIO) ? item.DREGISTROSANITARIO : '';
				const fechaInicio = (item.FINICIOREGSANITARIO) ? item.FINICIOREGSANITARIO : '';
				const fechaFinal = (item.FFINREGSANITARIO) ? item.FFINREGSANITARIO : '';

				// Solo si no existe se agrega el elegido
				const indexProducto = objProductoLista.buscarProductoElegido(item.CPRODUCTOFS);
				let selected = '';
				let bgColor = '';
				if (indexProducto !== -1) {
					selected = 'checked';
					bgColor = 'table-active';
				}

				row += '<tr data-id="' + item.CPRODUCTOFS + '" data-position="' + pos + '" class="' + bgColor + '" >';
				row += '<td class="text-left" >';
				row += '<div class="custom-control custom-checkbox">';
				row += '<input type="checkbox" class="custom-control-input producto-elegir" ' + selected + ' id="producto_elegir[' + pos + ']" name="producto_elegir[' + pos + ']" >';
				row += '<label class="custom-control-label" for="producto_elegir[' + pos + ']"></label>';
				row += '</div>';
				row += '</td>';
				row += '<td class="text-left marcar-producto" >' + codigo + '</td>';
				row += '<td class="text-left marcar-producto" >' + descripcion + '</td>';
				row += '<td class="text-left marcar-producto" >' + nombre + '</td>';
				row += '<td class="text-left marcar-producto" >' + marca + '</td>';
				row += '<td class="text-left marcar-producto" >' + fabricante + '</td>';
				row += '<td class="text-left marcar-producto" >' + pais + '</td>';
				row += '<td class="text-left marcar-producto" >' + categoria + '</td>';
				row += '<td class="text-left marcar-producto" >' + registroSanitario + '</td>';
				row += '<td class="text-left marcar-producto" >' + fechaInicio + '</td>';
				row += '<td class="text-left marcar-producto" >' + fechaFinal + '</td>';
				row += '</tr>';
				++total;
			});
		}
		objProductoLista.productos = result;
		$('#tblProductos tbody').html(row);
	};

	/**
	 * Marca el producto mediante las otras filas
	 */
	objProductoLista.marcarProducto = function() {
		const el = $(this);
		const content = el.parents('tr');
		const position = content.data('position');
		if (document.getElementById('producto_elegir[' + position + ']')) {
			const elProducto = $(document.getElementById('producto_elegir[' + position + ']'));
			elProducto.prop('checked', !elProducto.is(':checked'));
			elProducto.change();
		}
	};

	/**
	 * Realiza el guarda o eliminar de los productos elegidos
	 * @returns {boolean}
	 */
	objProductoLista.productoElegido = function() {
		const el = $(this);
		const row = el.parents('tr');
		const id = String(row.data('id'));

		const producto = objProductoLista.productos.find(function(item) {
			return (item.CPRODUCTOFS === id);
		});

		// Solo si no existe se agrega el elegido
		const indexProducto = objProductoLista.buscarProductoElegido(id);

		if (el.is(':checked')) {
			if (!producto) {
				objPrincipal.notify('warning', 'Lo sentimos pero el producto no pudo ser encontrado. Vuelva a intentarlo más tarde.');
				el.prop('checked', false);
				return false;
			}
			if (indexProducto === -1) {
				row.addClass('table-active');
				objProductoLista.agregarProducto(producto);
			}
		} else {
			if (indexProducto !== -1) {
				row.removeClass('table-active');
				objProductoLista.eliminarProducto(indexProducto);
			}
		}
		objProductoLista.calcularProductos();
	};

	/**
	 * MEtodo para agregar el prodcuto
	 * @param producto
	 */
	objProductoLista.agregarProducto = function(producto) {
		if (!producto) {
			objPrincipal.notify('warning', 'No pudo ser guardado correctamente el producto elegido.');
			return;
		}
		objProductoLista.productosElegidos.push(producto);
	};

	/**
	 * MEtodo para agregar el prodcuto
	 * @param index
	 */
	objProductoLista.eliminarProducto = function(index) {
		objProductoLista.productosElegidos.splice(index, 1);
	};

	/**
	 * Calculo de los productos totales
	 */
	objProductoLista.calcularProductos = function() {
		$('#tblProductosElegidos').text(objProductoLista.productosElegidos.length);
	};

	/**
	 * Realiza la busqueda de un producto en los elegidos
	 * @param id
	 * @returns {int}
	 */
	objProductoLista.buscarProductoElegido = function(id) {
		return objProductoLista.productosElegidos.findIndex(function(item) {
			return (item.CPRODUCTOFS === id);
		});
	};

	/**
	 * Guarda los productos elegidos al tramite
	 */
	objProductoLista.imprimirProductos = function(updateRS) {
		updateRS = (typeof updateRS === 'undefined') ? true : updateRS;
		const table = $('#tblTramiteProductos tbody');
		const productos = objProductoLista.productosElegidos;
		// Se imprime los datos del primero producto elegido cuando es Ampliacion o Reinscripcion
		if (updateRS) {
			objProductoLista.imprimirRS(productos[0]);
		}

		let row = '';
		if (productos && Array.isArray(productos)) {
			let item = 1;
			productos.forEach(function(producto, position) {
				const nroPosition = (item <= 10) ? '0' + item : item;
				const sku = (producto.CPRODUCTOCLIENTE) ? producto.CPRODUCTOCLIENTE : '';
				row += '<tr data-position="' + position + '" >';
				row += '<td class="text-center" >' + nroPosition + '</td>';
				row += '<td class="text-left" >';
				row += '<div class="form-control bg-light" >' + sku + '</div>';
				row += '</td>';
				row += '<td class="text-left" >';
				row += '<div class="form-control bg-light" >' + producto.DNOMBREPRODUCTO + '</div>';
				row += '</td>';
				row += '<td class="text-left" >';
				const comment = (producto.DCOMENTARIO) ? producto.DCOMENTARIO : '';
				row += '<input type="text" class="form-control" id="tramite_producto_comentario[' + position + ']" name="tramite_producto_comentario[' + position + ']" value="' + comment + '" />';
				row += '</td>';
				row += '<td class="text-center" style="width: 50px; min-width: 50px">';
				row += '<button type="button" role="button" class="btn btn-light btn-sm dropdown-toggle option-producto" data-boundary="viewport" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">';
				row += '<i class="fa fa-bars"></i>';
				row += '</button>';
				row += '<div class="dropdown-menu dropdown-menu-right">';
				row += '<h6 class="dropdown-header">Opciones</h6>';
				row += '<button type="button" role="button" class="dropdown-item option-tramite-producto-editar" data-id="' + producto.CPRODUCTOFS + '" >';
				row += '<i class="fa fa-edit"></i> Editar';
				row += '</button>';
				row += '<button type="button" role="button" class="dropdown-item option-tramite-producto-eliminar">';
				row += '<i class="fa fa-trash"></i> Eliminar';
				row += '</button>';
				row += '</div>';
				row += '<input type="hidden" class="d-none" readonly id="tramite_producto_id[' + position + ']" name="tramite_producto_id[' + position + ']" value="' + producto.CPRODUCTOFS + '" />';
				row += '</td>';
				row += '</tr>';
				++item;
			});
		}
		table.html(row);
		// Se limpia la tabla
		$('#tblProductos tbody').html('');
	};

	/**
	 * Imprime los datos del producto
	 * @param producto
	 */
	objProductoLista.imprimirRS = function(producto) {
		if (producto && producto.DREGISTROSANITARIO) {
			$('#carga_registro_nro_rs').val(producto.DREGISTROSANITARIO);
			// const dateInit = $('#carga_registro_fecha_inicio').data('daterangepicker');
			// dateInit.setStartDate(producto.FINICIOREGSANITARIO)
			// dateInit.setEndDate(producto.FINICIOREGSANITARIO);
			$('#carga_registro_fecha_inicio').val(producto.FINICIOREGSANITARIO);
			// const dateEnd = $('#carga_registro_fecha_final').data('daterangepicker');
			// dateEnd.setStartDate(producto.FFINREGSANITARIO)
			// dateEnd.setEndDate(producto.FFINREGSANITARIO);
			$('#carga_registro_fecha_final').val(producto.FFINREGSANITARIO);
		}
	};

	/**
	 * Elimina un producto elegido y vuelve a imprimis los productos elegidos
	 */
	objProductoLista.eliminarProductoElegido = function() {
		const el = $(this);
		const row = el.parents('tr');
		const position = row.data('position');
		objProductoLista.productosElegidos.splice(position, 1);
		objProductoLista.imprimirProductos();
	};

	/**
	 * Elimina todos los productos elegidos
	 */
	objProductoLista.eliminarProductoElegidos = function() {
		objProductoLista.productosElegidos = [];
		objProductoLista.imprimirProductos();
	};

});

$(document).ready(function () {

	$('#modalSelectProduct').on('show.bs.modal', function () {
		$('#filter_producto_descripcion').val('');
		$('.productofs--paginate-search').val('');
		objProductoLista.openModal();
	});

	$('#modalSelectProduct').on('hide.bs.modal', function () {
		objProductoLista.imprimirProductos();
	});

	$('#btnProductoBuscar').click(objProductoFiltro.search);

	$(document).on('click', '.marcar-producto', objProductoLista.marcarProducto);

	$(document).on('change', '.producto-elegir', objProductoLista.productoElegido);

	// Eliminación del producto elegido en el tramite
	$(document).on('click', '.option-tramite-producto-eliminar', objProductoLista.eliminarProductoElegido);

	$(document).on('click', '.option-tramite-producto-editar', function() {
		const el = $(this);
		objProducto.editarModal(el.data('id'), el);
	});

	$('#btnEliminarProductosElegidos').click(objProductoLista.eliminarProductoElegidos);

	$('#btnProductoNuevo').click(function() {
		objProducto.openModal();
	});

});
