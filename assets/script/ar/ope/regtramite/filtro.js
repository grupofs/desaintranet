/*!
 * Filtro para los Asuntos Regulatorios para GRUPOFS
 *
 * @version 1.0.0
 * @author GrupoFS
 */

const objFiltro = {
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
	 * Imprime el tipo de resultado a mostrar
	 * @param type
	 */
	objFiltro.setTypeFilter = function(type) {
		$('#type_result').val(parseInt(type));
	};

	/**
	 * Devuelve el tipo de reusltado
	 * @return
	 */
	objFiltro.getTypeFilter = function() {
		return parseInt($('#type_result').val());
	};

	/**
	 * Activa o desactiva la carga del filtro
	 * @see objFiltro.paginateButtons
	 * @see objPrincipal.botonCargando
	 * @param estado
	 */
	objFiltro.loading = function (estado) {
		$('#filtro_cliente').prop('disabled', estado);
		$('#filtro_nro_ar').prop('disabled', estado);
		$('#filtro_fecha_inicio').prop('disabled', estado);
		$('#filtro_fecha_fin').prop('disabled', estado);
		$('#filtro_tipo_estado').prop('disabled', estado);
		$('#frmFiltro').find('input, select, button, checkbox, radio').prop('disabled', estado);
		const boton = $('#btnBuscar');
		if (estado) {
			objPrincipal.botonCargando(boton);
			objFiltro.valueLoading = true;
		} else {
			objPrincipal.liberarBoton(boton);
			objFiltro.valueLoading = false;
		}
		objFiltro.paginateButtons();
	};

	/**
	 * Realiza la busqueda del filtro
	 * @see objFiltro.loading
	 *
	 * @void
	 */
	objFiltro.search = function () {
		const form = $('form#frmFiltro');
		$.ajax({
			url: form.attr('action'),
			method: 'POST',
			data: form.serialize(),
			dataType: 'json',
			beforeSend: function () {
				objFiltro.loading(true);
				$('.fs--paginate-search').val('');
			}
		}).done(function (res) {
			objFiltro.paginate(res.data.pagination);
			if (objLista) {
				// Se reinicia el resultado
				objFiltro.saveResult(res.data.result);
				objFiltro.printResult();
			}
		}).fail(function (jqxhr) {
			var message = (jqxhr && jqxhr.responseJSON && jqxhr.responseJSON.message) ? jqxhr.responseJSON.message : 'Error en el proceso de ejecución.';
			objPrincipal.alert('error', message);
		}).always(function () {
			objFiltro.loading(false);
		});
	};

	/**
	 * Imprime el resultado guardado
	 */
	objFiltro.printResult = function() {
		const rows = objLista.printResult(objFiltro.result);
		$('table#tblLista').html(rows);
	};

	/**
	 * Guarda el limite y el número de página a mostrar
	 * @see objFiltro.changePaginateLimit
	 * @see objFiltro.paginateSaveOffset
	 * @param paginate
	 */
	objFiltro.paginate = function (paginate) {
		const table = $('#tblLista');
		const currentLimit = parseInt(paginate.current_limit);
		const currentOffset = parseInt(paginate.current_offset);
		// Se elimina para no volvera repetir la paginación
		$('.fs--paginate').remove();
		const buttonPaginate = `
			<div class="w-100 d-flex align-items-center justify-content-end" >
				<button type="button" role="button" class="btn btn-light btn-sm fs--paginate-start"
				data-value="${paginate.start_offset}" >
					<i class="fa fa-angle-double-left" ></i>
				</button>
				<button type="button" role="button" class="btn btn-light btn-sm fs--paginate-previous" 
				data-value="${paginate.previous_offset}" >
					<i class="fa fa-angle-left" ></i>
				</button>
				<div class="mx-2 d-flex" >
					<span class="font-weight-bold fs--paginate-offset" >${currentOffset}</span>
					<span class="mx-1" >-</span>
					<div class="font-weight-bold dropdown" >
						<button type="button" role="button"
							data-boundary="viewport"
							data-toggle="dropdown"
							aria-haspopup="true"
							aria-expanded="false"
							class="btn btn-outline-light text-dark font-weight-bold p-0 fs--paginate-limit-value" >
							${currentLimit}
						</button>
						<div class="dropdown-menu dropdown-menu-right" >
							<h3 class="dropdown-header" >Por página</h3>
							<button class="dropdown-item fs--paginate-limit" type="button" role="option" >80</button>
							<button class="dropdown-item fs--paginate-limit" type="button" role="option" >200</button>
							<button class="dropdown-item fs--paginate-limit" type="button" role="option" >500</button>
							<button class="dropdown-item fs--paginate-limit" type="button" role="option" >1000</button>
							<button class="dropdown-item fs--paginate-limit" type="button" role="option" >5000</button>
							<button class="dropdown-item fs--paginate-limit" type="button" role="option" >10000</button>
						</div>
					</div>
					<span class="font-italic mx-1" >de</span>
					<span class="font-weight-bold" >${paginate.total}</span>
				</div>
				<button type="button" role="button" class="btn btn-light btn-sm fs--paginate-next"
				data-value="${paginate.next_offset}" >
					<i class="fa fa-angle-right" ></i>
				</button>
				<button type="button" role="button" class="btn btn-light btn-sm fs--paginate-end"
				data-value="${paginate.end_offset}" >
					<i class="fa fa-angle-double-right" ></i>
				</button>
				<div class="ml-2" >
					<button type="button" role="button" class="btn btn-secondary btn-sm fs--paginate-type-filter"
					data-type="1" title="Mostrar resultado por tramite" >
						<i class="fa fa-th-list" ></i>
					</button>
					<button type="button" role="button" class="btn btn-secondary btn-sm fs--paginate-type-filter"
					data-type="2" title="Mostrar resultado por tramite y productos" >
						<i class="fa fa fa-bars" ></i>
					</button>
				</div>
			</div>
		`;
		const contentHeader = `
			<div class="row fs--paginate" >
				<div class="col-xl-4 col-lg-4 col-md-6 col-sm-12 col-12" >
					<div class="form-group" >
						<input type="text" class="form-control form-control-sm fs--paginate-search"
						placeholder="Buscar" aria-label=""
						 value="" >
					</div>
				</div>
				<div class="col-xl-4 col-lg-4 col-md-6 col-sm-12 col-12" >
					<div class="text-center" >
						<button type="button" role="button" class="btn btn-success btn-sm" id="btnExport" >
							<i class="fa fa-cloud-download-alt" ></i> Descagar en Excel
						</button>
					</div>
				</div>
				<div class="col-xl-4 col-lg-4 col-md-12 col-sm-12 col-12" >
					${buttonPaginate}
				</div>
			</div>
		`;
		const contentFooter = `
			<div class="fs--paginate" >
				${buttonPaginate}
			</div>
		`;
		table.parent().after(contentFooter);
		table.parent().before(contentHeader);
		objFiltro.changePaginateLimit(currentLimit);
		objFiltro.paginateSaveOffset(currentOffset);
		objFiltro.activeTypeFilter();
	};

	/**
	 * Activa el tipo de filtro activado actualmente
	 */
	objFiltro.activeTypeFilter = function () {
		const typeResult = objFiltro.getTypeFilter();
		$('.fs--paginate-type-filter').each(function() {
			const button = $(this);
			const type = parseInt(button.data('type'));
			button.removeClass('active');
			if (typeResult === type) {
				button.addClass('active');
			}
		});
	};

	/**
	 * Guarda el limite de pagina por filtro
	 * @param value
	 */
	objFiltro.paginateSaveLimit = function (value) {
		$('#filtro_limit').val(value);
	};

	/**
	 * Guarda el nro de pagina del filtro
	 * @param value
	 */
	objFiltro.paginateSaveOffset = function (value) {
		$('.fs--paginate-offset').text(value);
		$('#filtro_offset').val(value);
	};

	/**
	 * Active o Desactive buttons
	 */
	objFiltro.paginateButtons = function () {
		$('.fs--paginate button').prop('disabled', objFiltro.valueLoading);
		$('.fs--paginate input').prop('disabled', objFiltro.valueLoading);
	};

	/**
	 * Marca el limite por página
	 * Y guarda el limit en el formulario
	 * @see objFiltro.paginateSaveLimit
	 * @param {Number} limit
	 */
	objFiltro.changePaginateLimit = function (limit) {
		$('.fs--paginate-limit').each(function () {
			const el = $(this);
			const value = parseInt(el.text());
			el.removeClass('active');
			el.html(value);
			if (value === limit) {
				el.addClass('active');
				el.html(`<span class="fa fa-check fa-sm" ></span> ${value}`);
			}
		});
		$('.fs--paginate-limit-value').text(limit);
		objFiltro.paginateSaveLimit(limit);
	};

	/**
	 * Guarda el limite por página en caso se cambie
	 * @see objFiltro.changePaginateLimit
	 * @see objFiltro.search
	 */
	objFiltro.handlePaginateLimit = function () {
		const limit = parseInt($(this).text());
		if (limit && !isNaN(limit)) {
			objFiltro.changePaginateLimit(limit);
			objFiltro.paginateSaveOffset(1);
			objFiltro.search();
		}
	};

	/**
	 * gua
	 */
	objFiltro.handlePaginate = function () {
		const value = parseInt($(this).data('value'));
		if (value && !isNaN(value)) {
			objFiltro.paginateSaveOffset(value);
			objFiltro.search();
		}
	};

	/**
	 * Guarda el resultado completo
	 * @param data
	 */
	objFiltro.saveResult = function (data) {
		this.result = data;
	};

	/**
	 * Agrega un nuevo ítem para el resultado
	 * @param {Array} item
	 */
	objFiltro.addResult = function (item) {
		this.result.push(item);
	};

	/**
	 * Cambia el estado del resultado del filtro
	 */
	objFiltro.handleTypeFilter = function() {
		const button = $(this);
		objFiltro.setTypeFilter(button.data('type'));
		objFiltro.activeTypeFilter();
		objFiltro.search();
	};

	/**
	 *
	 */
	objFiltro.searchResult = function() {
		const value = $(this).val().trim();
		$('.tbl-tramites').each(function() {
			const table = $(this);
			table.find('tr').filter(function() {
				$(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
			});
		});
	};

});

$(document).ready(function () {

	$(document).on('click', '.fs--paginate-limit', objFiltro.handlePaginateLimit);

	$(document).on('click', '.fs--paginate-start', objFiltro.handlePaginate);
	$(document).on('click', '.fs--paginate-previous', objFiltro.handlePaginate);
	$(document).on('click', '.fs--paginate-next', objFiltro.handlePaginate);
	$(document).on('click', '.fs--paginate-end', objFiltro.handlePaginate);

	$(document).on('click', '.fs--paginate-type-filter', objFiltro.handleTypeFilter);

	$(document).on('keyup', '.fs--paginate-search', objFiltro.searchResult);

});
