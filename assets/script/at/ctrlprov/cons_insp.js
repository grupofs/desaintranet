/*!
 *
 * @version 1.0.0
 */

const objInsp = {};

$(function () {

	/**
	 * Verifica si la carga esta activa o no
	 * @type {boolean}
	 */
	objInsp.loading = false;

	/**
	 * ID de la inspección abierta para realizar su descarga
	 * @type {integer|null}
	 */
	objInsp.pdf = {
		codigo: '',
		fecha: ''
	};

	/**
	 * Activa la carga de la busqueda
	 */
	objInsp.activeLoading = function () {
		objInsp.loading = true;
		objPrincipal.botonCargando($('#btnBuscar'));
	};

	/**
	 * Desactiva la carga de la busqueda
	 */
	objInsp.inactiveLoading = function () {
		objInsp.loading = false;
		objPrincipal.liberarBoton($('#btnBuscar'));
	};

	/**
	 * Realiza el filtro de las inspecciones
	 */
	objInsp.search = function () {
		if (objInsp.loading) {
			objPrincipal.alert('warning', 'Aún se encuentra activa la busqueda. Por favor espere!');
		} else {
			objInsp.activeLoading();
			let filtroPeligro = '';
			if ($('#filtro_peligro_1').is(':checked')) {
				filtroPeligro = 'S';
			}
			if ($('#filtro_peligro_2').is(':checked')) {
				filtroPeligro = 'N';
			}
			const oTableLista = $('#tblInspecciones').DataTable({
				'bJQueryUI': true,
				'scrollY': '650px',
				'scrollX': true,
				'processing': true,
				'bDestroy': true,
				'paging': true,
				'info': true,
				'filter': true,
				'ajax': {
					"url": BASE_URL + 'at/ctrlprov/ccons_insp/search',
					"type": "POST",
					"data": function (d) {
						d.afecha = ($('#activar_fecha').is(':checked')) ? 1 : 0;
						d.fini = $('#fini').val();
						d.ffin = $('#ffin').val();
						d.ccia = $('#idcia').val();
						d.filtro_cliente = $('#filtro_cliente').val();
						d.filtro_peligro = filtroPeligro;
					},
					dataSrc: function (data) {
						objInsp.inactiveLoading();
						return data.items;
					},
					error: function () {
						objPrincipal.alert('warning', 'Error en el proceso de ejecución.', 'Vuelva a intentarlo más tarde.');
						objInsp.inactiveLoading();
					}
				},
				'columns': [
					{
						"orderable": false,
						render: function (data, type, row) {
							if (row.DUBICACIONFILESERVERPDF) {
								return '<button type="button" class="btn btn-success btn-block download-pdf" data-link="' + row.DUBICACIONFILESERVERPDF + '">' +
									'<i class="fa fa-download" ></i> Descargar Insp' +
									'</button>';
							} else {
								return '<button type="button" class="btn btn-light btn-block open-pdf" data-codigo="' + row.CODIGO + '" data-fecha="' + row.FECHAINSPECCION + '" data-toggle="modal" data-target="#staticBackdrop">' +
									'<i class="fa fa-file-pdf" ></i> Ver Insp.' +
									'</button>';
							}
						}
					},
					// {
					// 	"class": "index",
					// 	orderable: false,
					// 	data: null,
					// 	targets: 1
					// },
					{data: 'CODIGO', orderable: false, targets: 1},
					{
						"orderable": false,
						render: function (data, type, row) {
							return moment(row.FECHAINSPECCION, 'YYYY-MM-DD').format('DD/MM/YYYY');
						}
					},
					// {data: 'FECHAINSPECCION', orderable: false, targets: 2},
					{
						"orderable": false,
						render: function (data, type, row) {
							return moment(row.FCREACION, 'YYYY-MM-DD').format('DD/MM/YYYY');
						}
					},
					// {data: 'FCREACION', orderable: false, targets: 3},
					{data: 'CLIENTE', orderable: false, targets: 4},
					{data: 'PROVEEDOR', orderable: false, targets: 5},
					{data: 'RUC', orderable: false, targets: 6},
					{data: 'DIRECCIONPROV', orderable: false, targets: 7},
					{data: 'UBIGEOPROV', orderable: false, targets: 8},
					{data: 'MAQUILADOR', orderable: false, targets: 9},
					{data: 'DIRECCIONMAQUILA', orderable: false, targets: 10},
					{data: 'UBIGEOMAQUILA', orderable: false, targets: 11},
					{data: 'AREACLIENTE', orderable: false, targets: 12},
					{data: 'LINEA', orderable: false, targets: 13},
					{data: 'RESULTADOCHECKLIST', orderable: false, targets: 14},
					{data: 'RESULTADOTEXTO', orderable: false, targets: 15},
					{data: 'TAMANOEMPRESAPROV', orderable: false, targets: 16},
					{data: 'TIPOESTADOSERVICIO', orderable: false, targets: 17},
					{data: 'COMENTARIO', orderable: false, targets: 18},
					{data: 'CERTIFICADORA', orderable: false, targets: 19},
					{data: 'CERTIFICACION', orderable: false, targets: 20},
					{data: 'SCERTIFICACION', orderable: false, targets: 21},
					{data: 'LICENCIADEFUNCIONAMIENTO', orderable: false, targets: 22},
					{data: 'ESTADOLICENCIADEFUNCIONAMIENTO', orderable: false, targets: 23},
					{data: 'CONSULTOR', orderable: false, targets: 24},
					{data: 'EMPRESAINSPECTORA', orderable: false, targets: 25},
					{data: 'CONVALIDADO', orderable: false, targets: 26},
					{data: 'ACCIONCORRECTIVA', orderable: false, targets: 27},
					{data: 'dinformefinal', orderable: false, targets: 28},
					{data: 'SEVALPROD', orderable: false, targets: 29},
					{data: 'espeligro', orderable: false, targets: 30},
					{data: 'CCHECKLIST', orderable: false, targets: 31},
					{data: 'CHECKLIST', orderable: false, targets: 32},
					{data: 'CERTIFICADORA', orderable: false, targets: 33},
					{data: 'DSISTEMA', orderable: false, targets: 34},
					{data: 'DSUBNORMA', orderable: false, targets: 35},
				],
				"columnDefs": [
					{
						"defaultContent": " ",
						"targets": "_all"
					}
				]
			});
			// oTableLista.on('order.dt search.dt', function () {
			// 	oTableLista.column(1, {
			// 		search: 'applied',
			// 		order: 'applied'
			// 	}).nodes().each(function (cell, i) {
			// 		cell.innerHTML = i + 1;
			// 	});
			// }).draw();
		}
	};

	/**
	 * Habre el modal para visualizar el informe tecnico
	 */
	objInsp.openPDF = function () {
		const button = $(this);
		// save ID
		objInsp.pdf.codigo = button.data('codigo');
		objInsp.pdf.fecha = button.data('fecha');
		const modalPDF = $('#modalPDF');
		modalPDF.modal('show');
		$('#framePDF').attr('src', objInsp.getLink());
	};

	/**
	 * Link del PDF
	 * @returns {string}
	 */
	objInsp.getLink = function () {
		return BASE_URL + 'at/ctrlprov/ccons_insp/pdf?codigo=' + objInsp.pdf.codigo + '&fecha=' + objInsp.pdf.fecha;
	};

	/**
	 * Cierra el PF
	 */
	objInsp.closePDF = function () {
		const btn = $('#closePDF');
		$.ajax({
			url: BASE_URL + 'at/ctrlprov/ccons_insp/close_download',
			method: 'POST',
			data: objInsp.pdf,
			dataType: 'json',
			beforeSend: function () {
				objPrincipal.botonCargando(btn);
			}
		}).done(function (res) {
			objInsp.download(res.data.DUBICACIONFILESERVERPDF);
			$('#modalPDF').modal('hide');
			objInsp.search();
		}).fail(function () {
			objPrincipal.alert('error', 'Error en la descarga del archivo.', 'Vuelva a inentarlo más tarde.');
		}).always(function () {
			objPrincipal.liberarBoton(btn);
		});
	};

	/**
	 * Descarga del link del PDF
	 */
	objInsp.downloadPDF = function () {
		const button = $(this);
		const link = button.data('link');
		objInsp.download(link);
	};

	/**
	 * Realiza la descarga del archivo
	 * @param linkPdf
	 */
	objInsp.download = function (linkPdf) {
		const url = BASE_URL + 'at/ctrlprov/ccons_insp/download?filename=' + linkPdf;
		const download = window.open(url, '_blank');
		if (!download) {
			objPrincipal.alert('warning', 'Habilite la ventana emergente de su navegador.');
		}
		download.focus();
	};

	/**
	 * Activa o desactiva las fechas
	 */
	objInsp.activeDate = function () {
		const chech = !$(this).is(':checked');
		$('#fini').prop('disabled', chech);
		$('#ffin').prop('disabled', chech);
	};

	/**
	 * Carga de clientes
	 */
	objInsp.cargaClientes = function () {
		/*LLENADO DE COMBOS*/
		$.ajax({
			type: 'ajax',
			method: 'post',
			url: baseurl + "at/ctrlprov/cregctrolprov/getcboclieserv",
			dataType: "JSON",
		}).done(function(res) {
			$('#filtro_cliente').html(res);
		}).fail(function() {
			objPrincipal.notify('warning', 'Hubo un error al carga los clientes.');
		});
	};

});

$(document).ready(function () {

	objInsp.cargaClientes();

	$('#btnBuscar').click(objInsp.search);

	$(document).on('click', '.open-pdf', objInsp.openPDF);

	$(document).on('click', '.download-pdf', objInsp.downloadPDF);

	$('#closePDF').click(objInsp.closePDF);

	$('#activar_fecha').change(objInsp.activeDate);

	$('#modalPDF').on('hidden.bs.modal', function () {
		$('#framePDF').attr('src','about:blank');
	})

});
