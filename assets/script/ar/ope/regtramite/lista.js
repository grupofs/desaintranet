/*!
 *
 * @version 1.0.0
 * @author GrupoFS
 */

const objLista = {};

$(function () {

	/**
	 * Limpia todos los filtros y resuelve los predeterminados
	 */
	objLista.clear = function () {
		// Cliente
		$('#filtro_cliente').val('');
		// Nro. de AR
		$('#filtro_nro_ar').val('');
		// Fechas
		const currentDate = moment();
		const date = '01' + '/' + '01' + '/' + currentDate.format('YYYY');
		$('#filtro_fecha_inicio').val(date)
		$('#filtro_fecha_fin').val(moment().format('DD/MM/YYYY'));
		// Estado
		$('#filtro_tipo_estado').val('').change();
	};

	/**
	 * Imprime el resultado de la busqueda
	 * @param result
	 * @return {String}
	 */
	objLista.printResult = function (result) {
		let rows = '';
		let posRow = 1;
		const displayElements = $('#displayElements').is(':checked');
		let customers = [];
		if (result && Array.isArray(result)) {
			const typeFilter = objFiltro.getTypeFilter();
			result.forEach(function (item, pos) {
				customers.push({id: item.ccliente, text: item.customer});
				const idCollapse = 'tramite-' + pos;
				rows += '<tr class="" data-position="' + pos + '" >';
				rows += '<td class="" >';
				rows += '<button type="button" class="btn btn-light btn-block text-left h3 font-weight-bold" data-toggle="collapse" href="#' + idCollapse + '" role="button" aria-expanded="' + displayElements + '" aria-controls="' + idCollapse + '" >';
				rows += '<i class="fa fa-sort" ></i> ' + item.customer;
				rows += '</button>';
				if (item.data && Array.isArray(item.data)) {
					let showCollapse = (displayElements) ? 'show' : '';
					rows += '<div class="collapse customer-collapse fade ' + showCollapse + '" id="' + idCollapse + '">';
					rows += '<table class="table table-borderless table-valign-middle table-hover tbl-tramites" >';
					rows += '<tbody>';
					item.data.forEach(function (tramite) {
						const responsable = (tramite.responsable && tramite.responsable !== '') ? tramite.responsable : '';
						const tramiteCierre = (tramite.scierre === 'A') ? 'badge-warning' : 'badge-success';
						let colorInactive = '';
						let colorBadge = 'badge-success';
						if (tramite.sregistro !== 'A') {
							colorInactive = 'text-danger';
							colorBadge = 'badge-danger';
						}
						rows += '<tr data-id="' + tramite.casuntoregulatorio + '" data-title="' + tramite.casuntoregulatorio + '" class="ar-content-buttons" >';
						rows += '<td class="text-center" style="width: 50px; min-width: 50px" >';
						rows += '<span class="badge ' + tramiteCierre + ' rounded-circle" >&nbsp;</span>';
						rows += '</td>';
						rows += '<td class="text-left position-relative ' + colorInactive + '" style="width: 150px; min-width: 150px" >';
						rows += '<span class="badge ' + colorBadge + '" >Código A.R.</span> ' + tramite.casuntoregulatorio;
						rows += '<div class="btn-group ar-content-options position-absolute" style="bottom: -15px; left: 10px; display: none" >';
						rows += '<button type="button" role="button" class="btn btn-outline-danger btn-sm rounded-pill btn-edit-ar" >';
						rows += '<i class="fa fa-eye" ></i> Ver AR';
						rows += '</button>';
						rows += '</div>';
						rows += '</td>';
						rows += '<td class="text-left ' + colorInactive + '" style="width: 180px; min-width: 180px" >';
						rows += '<span class="badge ' + colorBadge + '" >Fecha Inicio</span> ' + tramite.fapertura;
						rows += '</td>';
						rows += '<td class="text-left ' + colorInactive + '" style="width: 150px; min-width: 150px" >';
						rows += '<span class="badge ' + colorBadge + '" >Estado A.R.</span> ' + tramite.textoscierre;
						rows += '</td>';
						rows += '<td class="text-left ' + colorInactive + '" style="min-width: 250px" >';
						rows += '<span class="badge ' + colorBadge + '" >Responsable</span> ' + responsable;
						rows += '</td>';
						if (typeFilter === 1) {
							rows += '<td class="text-center" style="width: 200px; min-width: 200px" >';
							rows += '<button type="button" role="button" class="btn btn-primary btn-sm btn-block fs--option-products" >';
							rows += '<i class="fa fa-eye" ></i> Ver productos';
							rows += '</button>';
							rows += '</td>';
						} else {
							const cproductocliente = (tramite.cproductocliente && tramite.cproductocliente !== '') ? tramite.cproductocliente : '';
							const dproductocliente = (tramite.dproductocliente && tramite.dproductocliente !== '') ? tramite.dproductocliente : '';
							const dnombreproducto = (tramite.dnombreproducto && tramite.dnombreproducto !== '') ? tramite.dnombreproducto : '';
							const dmarca = (tramite.dmarca && tramite.dmarca !== '') ? tramite.dmarca : '';
							// const dmodeloproducto = (tramite.dmodeloproducto && tramite.dmodeloproducto !== '') ? tramite.dmodeloproducto : '';
							const dregistrosanitario = (tramite.dregistrosanitario && tramite.dregistrosanitario !== '') ? tramite.dregistrosanitario : '';
							const ffinregsanitario = (tramite.ffinregsanitario && tramite.ffinregsanitario !== '' && tramite.ffinregsanitario !== '00/00/0000') ? tramite.ffinregsanitario : '';
							rows += '<td class="text-left ' + colorInactive + '" style="width: 200px; min-width: 200px" >';
							rows += '<span class="badge ' + colorBadge + '" >Cod. Producto</span> ' + cproductocliente;
							rows += '</td>';
							rows += '<td class="text-left ' + colorInactive + '" style="min-width: 320px" >';
							rows += '<span class="badge ' + colorBadge + '" >Descripción SAP</span><br>' + dproductocliente;
							rows += '</td>';
							rows += '<td class="text-left ' + colorInactive + '" style="width: 320px; min-width: 320px" >';
							rows += '<span class="badge ' + colorBadge + '" >Producto</span><br>' + dnombreproducto;
							rows += '</td>';
							rows += '<td class="text-left ' + colorInactive + '" style="width: 280px; min-width: 280px" >';
							rows += '<span class="badge ' + colorBadge + '" >Marca</span> ' + dmarca;
							rows += '</td>';
							// rows += '<td class="text-left ' + colorInactive + '" style="width: 250px; min-width: 250px" >';
							// rows += '<span class="badge ' + colorBadge + '" >Modelo/Tono<br>Variedades/Sub-marca</span><br> ' + dmodeloproducto;
							// rows += '</td>';
							rows += '<td class="text-left ' + colorInactive + '" style="width: 250px; min-width: 250px" >';
							rows += '<span class="badge ' + colorBadge + '" >Registro Sanitario</span> ' + dregistrosanitario;
							rows += '</td>';
							rows += '<td class="text-left ' + colorInactive + '" style="width: 180px; min-width: 180px" >';
							rows += '<span class="badge ' + colorBadge + '" >Fecha Venc.</span> ' + ffinregsanitario;
							rows += '</td>';
						}
						rows += '</tr>';
						++posRow;
					});
					rows += '</tbody>';
					rows += '</table>';
					rows += '</div>';
				}
				rows += '</td>';
				rows += '</tr>';
			});
		}
		objLista.printCustomer(customers);
		return rows;
	};

	/**
	 * Impresion de los clientes
	 * @param customers
	 */
	objLista.printCustomer = function (customers) {
		const el = $('select#filtro_cliente');
		const value = el.val();
		// print customers
		let htmlCustomer = '<option value="" >::Todos::</option>';
		let selected = '';
		if (value) {
			selected = value;
			htmlCustomer += '<option value="' + value + '" >' + $('select#filtro_cliente option:selected').text() + '</option>';
		}
		if (customers && customers.length) {
			customers.forEach(function (customer) {
				if (customer.id != value) {
					htmlCustomer += '<option value="' + customer.id + '" >' + customer.text + '</option>';
				}
			});
		}
		el.html(htmlCustomer).val(selected).trigger('change');
	};

	/**
	 * Muestra los productos del ítem
	 * Solo para la lista en grupo
	 */
	objLista.showProducts = function () {
		const button = $(this);
		const row = button.parents('tr');
		const customer = row.parents('tr');
		const position = customer.data('position');
		const id = parseInt(row.data('id'));
		const title = row.data('title');
		// Se realiza la busqueda del producto
		objPrincipal.botonCargando(button);
		const tramites = objFiltro.result[position];
		let item = null;
		if (tramites) {
			item = tramites.data.find(function (item) {
				return (parseInt(item.casuntoregulatorio) === id);
			});
		}
		objPrincipal.liberarBoton(button);
		if (!item) {
			objPrincipal.notify('info', 'Lo sentimos pero su A.R. no pudo ser encontrado.');
		} else {
			objLista.setTitleProducts(title);
			objLista.printProducts(item.productos);
			$('#modalProducts').modal('show');
		}
	};

	/**
	 * Imprime los productos del asunto regulatorio
	 * Solo para la lista en grupo
	 * @param data
	 */
	objLista.printProducts = function (data) {
		let rows = '';
		if (data && Array.isArray(data)) {
			data.forEach(function (item, i) {
				const cproductocliente = (item.cproductocliente && item.cproductocliente !== '') ? item.cproductocliente : '';
				const dproductocliente = (item.dproductocliente && item.dproductocliente !== '') ? item.dproductocliente : '';
				const dnombreproducto = (item.dnombreproducto && item.dnombreproducto !== '') ? item.dnombreproducto : '';
				// const dmodeloproducto = (item.dmodeloproducto && item.dmodeloproducto !== '') ? item.dmodeloproducto : '';
				const dregistrosanitario = (item.dregistrosanitario && item.dregistrosanitario !== '') ? item.dregistrosanitario : '';
				const ffinregsanitario = (item.ffinregsanitario && item.ffinregsanitario !== '' && item.ffinregsanitario !== '00/00/0000') ? item.ffinregsanitario : '';
				const dmarca = (item.dmarca && item.dmarca !== '') ? item.dmarca : '';
				rows += '<tr data-position="' + i + '" >';
				rows += '<td class="text-left" >' + cproductocliente + '</td>';
				rows += '<td class="text-left" >' + dproductocliente + '</td>';
				rows += '<td class="text-left" >' + dnombreproducto + '</td>';
				rows += '<td class="text-left" >' + dmarca + '</td>';
				// rows += '<td class="text-left" >' + dmodeloproducto + '</td>';
				rows += '<td class="text-left" >' + dregistrosanitario + '</td>';
				rows += '<td class="text-center" >' + ffinregsanitario + '</td>';
				rows += '</tr>';
			});
		}
		$('table#tblProducts tbody').html(rows);
	};

	/**
	 * Cambia el titulo de la ventana de productos
	 * @param title
	 */
	objLista.setTitleProducts = function (title) {
		$('#titleProducts').html('Productos del A.R. ' + title);
	};

	/**
	 * Realiza la exportación de los asuntos regulatorios
	 */
	objLista.export = function () {
		// const button = $(this);
		const filter = $('#frmFiltro').serialize();
		var content = BASE_URL + 'ar/ope/ctramite/export?' + filter;
		var download = window.open(content, '_blank');
		if (download == null || typeof download == "undefined") {
			objPrincipal.notify("warning", "Habilite la ventana emergente de su navegador. Para continuar la descarga!");
		} else {
			download.focus();
		}
	};

	/**
	 * Muestra o Oculta los tramites de cada cliente
	 */
	objLista.changeDisplayElements = function () {
		const el = $(this);
		const customer = $('.customer-collapse');
		if (el.is(':checked')) {
			customer.collapse('show');
		} else {
			customer.collapse('hide');
		}
	};

	/**
	 * Nuevo registro de asunto regulatorio
	 */
	objLista.newAR = function () {
		objFormularioAR.newForm();
	};

	/**
	 * Editar registro de asunto regulatorio
	 */
	objLista.editAR = function() {
		const button = $(this);
		const row = button.parent('div').parent('td').parent('tr');
		const id = row.data('id');
		objFormularioAR.editForm(id, button);
	};

});

$(document).ready(function () {

	objLista.clear();

	objFiltro.search();

	$('#btnBuscar').click(objFiltro.search);

	$(document).on('click', '.fs--option-products', objLista.showProducts);

	$('#displayElements').change(objLista.changeDisplayElements);

	$(document).on('click', '#btnExport', objLista.export);

	$('#btnNuevoAR').click(objLista.newAR);

	s2EntidadReguladora.init($('#filter_entidad'));
	s2TipoProducto.init($('#filter_tipo_producto'));
	s2TramiteReguladora.init($('#filter_tramite'));
	s2Marca.init($('#filter_marca'));
	s2Categoria.init($('#filter_categoria'));

	$('#filtro_cliente').change(function() {
		$('#filter_marca').refreshSelect2([]);
		$('#filter_categoria').refreshSelect2([]);
		s2Marca.params.ccliente = $(this).val();
		s2Categoria.params.ccliente = $(this).val();
	});

	$(document).on('click', '.btn-edit-ar', objLista.editAR);

});

function __elegirEntidadReguladora(datos) {
	s2TipoProducto.params.entidad = datos.id;
	s2TramiteReguladora.params.entidad = datos.id;
	$('#filter_tipo_producto').refreshSelect2([]);
	$('#filter_tramite').refreshSelect2([]);
}

function __elegirTipoProducto(datos) {
	s2TramiteReguladora.params.tipo_producto = datos.id;
	$('#filter_tramite').refreshSelect2([]);
}
