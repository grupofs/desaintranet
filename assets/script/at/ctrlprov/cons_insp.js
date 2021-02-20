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
	objInsp.modalIDInsp = null;

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
			const oTableLista = $('#tblInspecciones').DataTable({
				'bJQueryUI': true,
				'scrollY': '400px',
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
					},
					dataSrc: function (data) {
						objInsp.inactiveLoading();
						return data.items;
					}
				},
				'columns': [
					{
						"class": "index",
						orderable: false,
						data: null,
						targets: 0
					},
					{data: 'CODIGO', orderable: false, targets: 1},
					{data: 'FECHAINSPECCION', orderable: false, targets: 2},
					{data: 'FCREACION', orderable: false, targets: 3},
					{data: 'CLIENTE', orderable: false, targets: 4},
					{data: 'PROVEEDOR', orderable: false, targets: 5},
					{data: 'RUC', orderable: false, targets: 6},
					{data: 'DIRECCIONPROV', orderable: false, targets: 7},
					{data: 'UBIGEOPROV', orderable: false, targets: 8},
					{
						"orderable": false,
						render: function (data, type, row) {
							const item = row.DATA;
							if (item && item.LINKPDF) {
								return '<button type="button" class="btn btn-success btn-block download-pdf" data-link="' + item.LINKPDF + '">' +
									'<i class="fa fa-download" ></i> Descargar Informe' +
									'</button>';
							} else {
								return '<button type="button" class="btn btn-primary btn-block open-pdf" data-id="' + row.ID + '" data-toggle="modal" data-target="#staticBackdrop">' +
									'<i class="fa fa-file-pdf" ></i> Ver Informe' +
									'</button>';
							}
						}
					},
				],
				"columnDefs": [
					{
						"defaultContent": " ",
						"targets": "_all"
					}
				]
			});
			oTableLista.on('order.dt search.dt', function () {
				oTableLista.column(0, {
					search: 'applied',
					order: 'applied'
				}).nodes().each(function (cell, i) {
					cell.innerHTML = i + 1;
				});
			}).draw();
		}
	};

	/**
	 * Habre el modal para visualizar el informe tecnico
	 */
	objInsp.openPDF = function () {
		const button = $(this);
		// save ID
		objInsp.modalIDInsp = button.data('id');
		const modalPDF = $('#modalPDF');
		modalPDF.modal('show');
		$('#framePDF').attr('src', objInsp.getLink());
	};

	/**
	 * Link del PDF
	 * @returns {string}
	 */
	objInsp.getLink = function () {
		return BASE_URL + 'at/ctrlprov/ccons_insp/pdf';
	};

	/**
	 * Cierra el PF
	 */
	objInsp.closePDF = function () {
		const btn = $('#closePDF');
		$.ajax({
			url: BASE_URL + 'at/ctrlprov/ccons_insp/close_download',
			method: 'POST',
			data: {
				id: objInsp.modalIDInsp,
			},
			dataType: 'json',
			beforeSend: function () {
				objPrincipal.botonCargando(btn);
			}
		}).done(function (res) {
			objInsp.download(res.data.LINKPDF);
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
	objInsp.downloadPDF = function() {
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

});

$(document).ready(function () {

	$('#btnBuscar').click(objInsp.search);

	$(document).on('click', '.open-pdf', objInsp.openPDF);

	$(document).on('click', '.download-pdf', objInsp.downloadPDF);

	$('#closePDF').click(objInsp.closePDF);

});
