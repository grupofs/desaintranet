/*!
 * Filtro para los Asuntos Regulatorios para GRUPOFS
 *
 * @version 1.0.0
 * @author GrupoFS
 */

const objProductoFiltro = {
	/**
	 * Almacena el resultado de la busqueda
	 * @var array
	 */
	result: [],
	/**
	 * Verifica si la busqueda esta en carga o no
	 * @type {boolean}
	 */
	valueLoading: false,
};

$(function () {

	/**
	 * Activa o desactiva la carga del filtro
	 * @see objProductoFiltro.paginateButtons
	 * @see objPrincipal.botonCargando
	 * @param estado
	 */
	objProductoFiltro.loading = function (estado) {
		$('#filter_producto_descripcion').prop('disabled', estado);
		const boton = $('#btnProductoBuscar');
		const buttons = $('#modalSelectProduct').find('button');
		if (estado) {
			buttons.prop('disabled', true);
			objPrincipal.botonCargando(boton);
			objProductoFiltro.valueLoading = true;
		} else {
			buttons.prop('disabled', false);
			objPrincipal.liberarBoton(boton);
			objProductoFiltro.valueLoading = false;
		}
		objProductoFiltro.paginateButtons();
	};

	/**
	 * Realiza la busqueda del filtro
	 * @see objProductoFiltro.loading
	 *
	 * @void
	 */
	objProductoFiltro.search = function () {
		const form = $('form#frmFiltroProducto');
		$.ajax({
			url: form.attr('action'),
			method: 'POST',
			data: form.serialize()
				+ '&codigo_cliente_id=' + objFormularioAR.data.cliente.CCLIENTE
				+ '&tipo_producto_id=' + $('#tramite_tipo_producto_id option:selected').val(),
			dataType: 'json',
			beforeSend: function () {
				objProductoFiltro.loading(true);
				$('.productofs--paginate-search').val('');
			}
		}).done(function (res) {
			objProductoFiltro.paginate(res.data.pagination);
			if (objProductoLista) {
				// Se reinicia el resultado
				objProductoFiltro.saveResult(res.data.result);
				objProductoFiltro.printResult();
			}
		}).fail(function (jqxhr) {
			var message = (jqxhr && jqxhr.responseJSON && jqxhr.responseJSON.message) ? jqxhr.responseJSON.message : 'Error en el proceso de ejecución.';
			objPrincipal.alert('error', message);
		}).always(function () {
			objProductoFiltro.loading(false);
		});
	};

	/**
	 * Imprime el resultado guardado
	 */
	objProductoFiltro.printResult = function() {
		const rows = objProductoLista.printResult(objProductoFiltro.result);
		$('table#tblProductos tbody').html(rows);
	};

	/**
	 * Guarda el limite y el número de página a mostrar
	 * @see objProductoFiltro.changePaginateLimit
	 * @see objProductoFiltro.paginateSaveOffset
	 * @param paginate
	 */
	objProductoFiltro.paginate = function (paginate) {
		const table = $('#tblProductos');
		const currentLimit = parseInt(paginate.current_limit);
		const currentOffset = parseInt(paginate.current_offset);
		// Se elimina para no volvera repetir la paginación
		$('.productofs--paginate').remove();
		const buttonPaginate = `
			<div class="w-100 d-flex align-items-center justify-content-end" >
				<button type="button" role="button" class="btn btn-light btn-sm productofs--paginate-start"
				data-value="${paginate.start_offset}" >
					<i class="fa fa-angle-double-left" ></i>
				</button>
				<button type="button" role="button" class="btn btn-light btn-sm productofs--paginate-previous" 
				data-value="${paginate.previous_offset}" >
					<i class="fa fa-angle-left" ></i>
				</button>
				<div class="mx-2 d-flex" >
					<span class="font-weight-bold productofs--paginate-offset" >${currentOffset}</span>
					<span class="mx-1" >-</span>
					<div class="font-weight-bold dropdown" >
						<button type="button" role="button"
							data-boundary="viewport"
							data-toggle="dropdown"
							aria-haspopup="true"
							aria-expanded="false"
							class="btn btn-outline-light text-dark font-weight-bold p-0 productofs--paginate-limit-value" >
							${currentLimit}
						</button>
						<div class="dropdown-menu dropdown-menu-right" >
							<h3 class="dropdown-header" >Por página</h3>
							<button class="dropdown-item productofs--paginate-limit" type="button" role="option" >80</button>
							<button class="dropdown-item productofs--paginate-limit" type="button" role="option" >200</button>
							<button class="dropdown-item productofs--paginate-limit" type="button" role="option" >500</button>
							<button class="dropdown-item productofs--paginate-limit" type="button" role="option" >1000</button>
							<button class="dropdown-item productofs--paginate-limit" type="button" role="option" >5000</button>
							<button class="dropdown-item productofs--paginate-limit" type="button" role="option" >10000</button>
						</div>
					</div>
					<span class="font-italic mx-1" >de</span>
					<span class="font-weight-bold" >${paginate.total}</span>
				</div>
				<button type="button" role="button" class="btn btn-light btn-sm productofs--paginate-next"
				data-value="${paginate.next_offset}" >
					<i class="fa fa-angle-right" ></i>
				</button>
				<button type="button" role="button" class="btn btn-light btn-sm productofs--paginate-end"
				data-value="${paginate.end_offset}" >
					<i class="fa fa-angle-double-right" ></i>
				</button>
			</div>
		`;
		const contentHeader = `
			<div class="row productofs--paginate" >
				<div class="col-xl-4 col-lg-4 col-md-6 col-sm-12 col-12" >
					<div class="form-group" >
						<input type="text" class="form-control form-control-sm productofs--paginate-search"
						placeholder="Buscar" aria-label=""
						 value="" >
					</div>
				</div>
				<div class="col-xl-4 col-lg-4 col-md-6 col-sm-12 col-12" >
					
				</div>
				<div class="col-xl-4 col-lg-4 col-md-12 col-sm-12 col-12" >
					${buttonPaginate}
				</div>
			</div>
		`;
		const contentFooter = `
			<div class="productofs--paginate" >
				${buttonPaginate}
			</div>
		`;
		table.parent().after(contentFooter);
		table.parent().before(contentHeader);
		objProductoFiltro.changePaginateLimit(currentLimit);
		objProductoFiltro.paginateSaveOffset(currentOffset);
	};

	/**
	 * Guarda el limite de pagina por filtro
	 * @param value
	 */
	objProductoFiltro.paginateSaveLimit = function (value) {
		$('#filtro_producto_limit').val(value);
	};

	/**
	 * Guarda el nro de pagina del filtro
	 * @param value
	 */
	objProductoFiltro.paginateSaveOffset = function (value) {
		$('.productofs--paginate-offset').text(value);
		$('#filtro_producto_offset').val(value);
	};

	/**
	 * Active o Desactive buttons
	 */
	objProductoFiltro.paginateButtons = function () {
		$('.productofs--paginate button').prop('disabled', objProductoFiltro.valueLoading);
		$('.productofs--paginate input').prop('disabled', objProductoFiltro.valueLoading);
	};

	/**
	 * Marca el limite por página
	 * Y guarda el limit en el formulario
	 * @see objProductoFiltro.paginateSaveLimit
	 * @param {Number} limit
	 */
	objProductoFiltro.changePaginateLimit = function (limit) {
		$('.productofs--paginate-limit').each(function () {
			const el = $(this);
			const value = parseInt(el.text());
			el.removeClass('active');
			el.html(value);
			if (value === limit) {
				el.addClass('active');
				el.html(`<span class="fa fa-check fa-sm" ></span> ${value}`);
			}
		});
		$('.productofs--paginate-limit-value').text(limit);
		objProductoFiltro.paginateSaveLimit(limit);
	};

	/**
	 * Guarda el limite por página en caso se cambie
	 * @see objProductoFiltro.changePaginateLimit
	 * @see objProductoFiltro.search
	 */
	objProductoFiltro.handlePaginateLimit = function () {
		const limit = parseInt($(this).text());
		if (limit && !isNaN(limit)) {
			objProductoFiltro.changePaginateLimit(limit);
			objProductoFiltro.paginateSaveOffset(1);
			objProductoFiltro.search();
		}
	};

	/**
	 * gua
	 */
	objProductoFiltro.handlePaginate = function () {
		const value = parseInt($(this).data('value'));
		if (value && !isNaN(value)) {
			objProductoFiltro.paginateSaveOffset(value);
			objProductoFiltro.search();
		}
	};

	/**
	 * Guarda el resultado completo
	 * @param data
	 */
	objProductoFiltro.saveResult = function (data) {
		this.result = data;
	};

	/**
	 * Agrega un nuevo ítem para el resultado
	 * @param {Array} item
	 */
	objProductoFiltro.addResult = function (item) {
		this.result.push(item);
	};

	/**
	 * Cambia el estado del resultado del filtro
	 */
	objProductoFiltro.handleTypeFilter = function() {
		const button = $(this);
		objProductoFiltro.setTypeFilter(button.data('type'));
		objProductoFiltro.search();
	};

	/**
	 *
	 */
	objProductoFiltro.searchResult = function() {
		const value = $(this).val().trim();
		$('#tblProductos tbody tr').each(function() {
			$(this).filter(function() {
				$(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
			});
		});
	};

});

$(document).ready(function () {

	$(document).on('click', '.productofs--paginate-limit', objProductoFiltro.handlePaginateLimit);

	$(document).on('click', '.productofs--paginate-start', objProductoFiltro.handlePaginate);
	$(document).on('click', '.productofs--paginate-previous', objProductoFiltro.handlePaginate);
	$(document).on('click', '.productofs--paginate-next', objProductoFiltro.handlePaginate);
	$(document).on('click', '.productofs--paginate-end', objProductoFiltro.handlePaginate);

	$(document).on('click', '.productofs--paginate-type-filter', objProductoFiltro.handleTypeFilter);

	$(document).on('keyup', '.productofs--paginate-search', objProductoFiltro.searchResult);

	$('#btnProductoBuscar').click(objProductoFiltro.search);

});
