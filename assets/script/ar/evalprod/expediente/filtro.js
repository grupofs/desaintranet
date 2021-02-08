/*!
 * Scripts para los filtros de AR - EVAL. PRODUCTOS / REG. EXPEDIENTES
 *
 * @version 1.0.0
 * @author Anthony
 */

const objFiltro = {
	/**
	 * Sirve para identificar si estar cargando algo de la lista
	 * @var {boolean}
	 */
	cargando: false,
	/**
	 * Objecto de la tabla
	 * @var {Object}
	 */
	oTableLista: null,
	/**
	 * @var int
	 */
	poderCrear: parseInt($('input#poder_crear').val()),
	/**
	 * @var int
	 */
	poderEvaluar: parseInt($('input#poder_evaular').val())
};

$(function () {

	/**
	 * Realiza la validación del filtro para el intervalo de fechas
	 * @see objFiltro._cambiaValorFecha
	 * @void
	 */
	objFiltro.manejarTipoBusqueda = function () {
		const valor = parseInt($('#cboTipobuscar').val());
		const elFechaInicio = $('#FechaDesde');
		const elFechaFinal = $('#FechaHasta');
		const fechaIntervalo = (valor && valor === 2);
		elFechaInicio.prop('disabled', !fechaIntervalo);
		elFechaFinal.prop('disabled', !fechaIntervalo);
		objFiltro._cambiaValorFecha(elFechaInicio, elFechaFinal, valor);
	};

	/**
	 * Cambian el valor de las fechas apartir del tipo de filtro a buscar
	 * @param elFechaInicio
	 * @param elFechaFinal
	 * @param tipoValor
	 * @private
	 */
	objFiltro._cambiaValorFecha = function (elFechaInicio, elFechaFinal, tipoValor) {
		const currentDate = moment().format('DD/MM/YYYY');
		if (tipoValor === 2) {
			elFechaInicio.val(currentDate);
			elFechaFinal.val(currentDate);
		}
		if (tipoValor === 1) {
			elFechaInicio.val(moment().subtract(1, 'days').format('DD/MM/YYYY'));
			elFechaFinal.val(currentDate);
		}
		if (tipoValor === 0) {
			elFechaInicio.val('');
			elFechaFinal.val('');
		}
	};

	/**
	 * Busqueda de listas
	 */
	objFiltro.buscar = function () {
		if (objFiltro.cargando) {
			sweetalert('Aún existe una carga pediente, porfavor espere!', 'error');
		} else {
			const boton = $('#btnBuscarListado');
			const tipo = $('#cboTipobuscar').val();
			const mostrarVencidos = ($('#mostrar_vencidos').length) ? $('#mostrar_vencidos').is(':checked') : false;
			objFiltro.cargando = true;
			this.oTableLista = $('#tbllistaexpedientes').DataTable({
				'bJQueryUI': true,
				'scrollY': '400px',
				'scrollX': true,
				'processing': true,
				'bDestroy': true,
				'paging': true,
				'info': true,
				'filter': true,
				'ajax': {
					"url": BASE_URL + "ar/evalprod/cexpediente/lista",
					"type": "POST",
					"data": function (d) {
						d.ccliente = $('#idcliente').val();
						d.cproveedor = $('#cboProveedor').val();
						d.expediente = $('#txtExpediente').val();
						d.tipo = tipo;
						d.fdesde = (parseInt(tipo) == 0) ? '' : $('#FechaDesde').val();
						d.fhasta = (parseInt(tipo) == 0) ? '' : $('#FechaHasta').val();
						d.mostrar_vencidos = (mostrarVencidos) ? 1 : 0;
					},
					beforeSend: function () {
						objPrincipal.botonCargando(boton);
					},
					dataSrc: function (data) {
						objPrincipal.liberarBoton(boton);
						objFiltro.cargando = false;
						return data;
					}
				},
				'columns': objFiltro.obtenerColumnas(),
				"columnDefs": [
					{
						"defaultContent": " ",
						"targets": "_all"
					}
				]
			});
			this.oTableLista.on('order.dt search.dt', function () {
				objFiltro.oTableLista.column(0, {
					search: 'applied',
					order: 'applied'
				}).nodes().each(function (cell, i) {
					cell.innerHTML = i + 1;
				});
			}).draw();
		}
	};

	/**
	 * Limpia los filtros y realiza la busqueda
	 * @see objFiltro.buscar
	 */
	objFiltro.refrescarLista = function () {
		$('#cboTipobuscar').val(1).trigger('change');
		$('#cboProveedor').val(null).trigger('change');
		$('#txtExpediente').val('').trigger('change');
		$('.contenedorItems').hide();
		objIngreso.limpiarDatos();
		objFiltro.buscar();
	};

	/**
	 * Metodo asincrono para buscar el expediente
	 * @param id
	 * @returns {*}
	 */
	objFiltro.recursoBuscar = function (id) {
		return $.ajax({
			url: BASE_URL + 'ar/evalprod/cexpediente/buscar/' + id,
			method: 'GET',
			data: {},
			dataType: 'json'
		});
	};

});

$(document).ready(function () {

	s2Proveedor.init($('select#cboProveedor'));

	objFiltro.manejarTipoBusqueda();

	$('select#cboTipobuscar').change(objFiltro.manejarTipoBusqueda);

	$('#btnBuscarListado').click(objFiltro.buscar);

});
