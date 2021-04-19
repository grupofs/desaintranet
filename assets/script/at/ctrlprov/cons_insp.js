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
						d.filtro_proveedor = $('#filtro_proveedor').val();
						d.filtro_maquilador = $('#filtro_maquilador').val();
						d.filtro_tipo_estado = $('#filtro_tipo_estado').val();
						d.filtro_cliente_area = $('#filtro_cliente_area').val();
						d.filtro_linea_proveedor = $('#filtro_linea_proveedor').val();
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
							const rowId = 'dropdown-' + row.CODIGO + row.FECHAINSPECCION;
							let htmlRow = '<div class="dropdown">';
							htmlRow += '<button type="button" class="btn btn-secondary dropdown-toggle" role="button" id="' + rowId + '" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">';
							htmlRow += '<i class="fa fa-bars" ></i> Opciones';
							htmlRow += '</button>';
							htmlRow += '<div class="dropdown-menu" aria-labelledby="' + rowId + '">';
							let tipoEstado = String(row.TIPOESTADOSERVICIO).toLowerCase().trim();
							console.log(tipoEstado);
							if (tipoEstado === 'convalidado' || tipoEstado === 'concluido ok') {
								if (row.DUBICACIONFILESERVERPDF) {
									htmlRow += '<button type="button" class="dropdown-item download-pdf" data-link="' + row.DUBICACIONFILESERVERPDF + '" ><i class="fa fa-download" ></i> Descargar Informe Técnico</button>';
								} else {
									htmlRow += '<button type="button" class="dropdown-item open-pdf" data-codigo="' + row.CODIGO + '" data-fecha="' + row.FECHAINSPECCION + '" ><i class="fa fa-file-pdf" ></i> Ver Informe Técnico</button>';
								}
							}
							htmlRow += '<button type="button" class="dropdown-item ver-accion-correctiva" data-codigo="' + row.CODIGO + '" data-fecha="' + row.FECHAINSPECCION + '" ><i class="fa fa-th-list" ></i> Ver Acciones Correctivas</button>';
							htmlRow += '<button type="button" class="dropdown-item ver-proveedor" data-codigo="' + row.CODIGO + '" data-proveedor="' + row.CPROVEEDOR + '" ><i class="fa fa-eye" ></i> Ver Proveedor</button>';
							htmlRow += '</div>';
							htmlRow += '</div>';
							return htmlRow;
						}
					},
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

	/**
	 * @param idCliente
	 */
	objInsp.cargaArea = function(idCliente) {
		$.ajax({
			type: 'ajax',
			method: 'post',
			url: baseurl + "at/ctrlprov/ccons_insp/get_areas",
			data: {
				ccliente: idCliente,
			},
			dataType: "JSON",
		}).done(function(res) {
			const items = res.items;
			let options = '<option value="" ></option>';
			if (items && Array.isArray(items)) {
				items.forEach(function(item) {
					options += '<option value="' + item.AREACLIENTE + '" >' + item.DAREACLIENTE + '</option>';
				});
			}
			$('#filtro_cliente_area').html(options);
		}).fail(function() {
			objPrincipal.notify('warning', 'Hubo un error al carga las areas.');
		});
	};

	/**
	 * Carga de proveedores
	 */
	objInsp.cargaProveedor = function (idCliente) {
		$.ajax({
			type: 'ajax',
			method: 'post',
			url: baseurl + "at/ctrlprov/cregctrolprov/getcboprovxclie",
			data: {
				ccliente: idCliente,
			},
			dataType: "JSON",
		}).done(function(res) {
			$('#filtro_proveedor').html(res);
		}).fail(function() {
			objPrincipal.notify('warning', 'Hubo un error al carga los proveedor.');
		});
	};

	/**
	 * Carga de proveedores
	 */
	objInsp.cargaEstados = function () {
		$.ajax({
			type: 'ajax',
			method: 'post',
			url: baseurl + "at/ctrlprov/cregctrolprov/getcboestado",
			data: {},
			dataType: "JSON",
		}).done(function(res) {
			$('#filtro_tipo_estado').html(res);
		}).fail(function() {
			objPrincipal.notify('warning', 'Hubo un error al carga los proveedor.');
		});
	};

	/**
	 * Carga de proveedores
	 */
	objInsp.cargaMaquilador = function (idProveedor) {
		$.ajax({
			type: 'ajax',
			method: 'post',
			url: baseurl + "at/ctrlprov/cregctrolprov/getcbomaqxprov",
			data: {
				cproveedor: idProveedor,
			},
			dataType: "JSON",
		}).done(function(res) {
			$('#filtro_maquilador').html(res);
		}).fail(function() {
			objPrincipal.notify('warning', 'Hubo un error al carga los maquilador.');
		});
	};

	/**
	 * Ver Acciones correctivas
	 */
	objInsp.verAccionCorrectiva = function() {
		const button = $(this);
		const codigo = button.data('codigo');
		const fecha = button.data('fecha');
		$.ajax({
			url: baseurl + 'at/ctrlprov/ccons_insp/get_accion_correctiva',
			method: 'POST',
			data: {
				codigo: codigo,
				fecha: fecha,
			},
			dataType: 'json',
			beforeSend: function() {
				objPrincipal.botonCargando(button);
			},
		}).done(function(res) {
			const elModal = $('#modalAccionCorrectiva');
			elModal.find('h5').html('Acción Correctiva (Insp. ' + codigo + ' - ' + moment(fecha, 'YYYY-MM-DD').format('DD/MM/YYYY') + ')');
			objInsp.imprimirAccionCorrectiva(res.items);
			elModal.modal('show');
		}).fail(function() {
			objPrincipal.notify('warning', 'Error al intentar cargar las acciones correctivas')
		}).always(function() {
			objPrincipal.liberarBoton(button);
		});
	};

	/**
	 * @param data
	 */
	objInsp.imprimirAccionCorrectiva = function(data) {
		let rows = '';
		if (data && Array.isArray(data)) {
			data.forEach(function(item) {
				let responsable = (item.dresponsablecliente) ? item.dresponsablecliente : '';
				let observacion = (item.dobservacion) ? item.dobservacion : '';
				rows += '<tr>';
				rows += '<td class="text-left" style="" >' + item.dnumerador + '</td>';
				rows += '<td class="text-left" style="min-width: 250px" >' + item.drequisito + '</td>';
				rows += '<td class="text-center" style="" >' + item.sexcluyente + '</td>';
				rows += '<td class="text-left" style="min-width: 180px" >' + item.tipohallazgo + '</td>';
				rows += '<td class="text-left" style="min-width: 250px" >' + item.dhallazgo + '</td>';
				rows += '<td class="text-left" style="min-width: 250px" >' + item.dhallazgotext + '</td>';
				rows += '<td class="text-left" style="min-width: 200px" >' + responsable + '</td>';
				rows += '<td class="text-left" style="min-width: 60px" >' + moment(item.tcreacion).format('DD/MM/YYYY') + '</td>';
				rows += '<td class="text-center" style="min-width: 60px" >' + item.svalor + '</td>';
				rows += '<td class="text-left" style="min-width: 200px" >' + observacion + '</td>';
				rows += '</tr>';
			});
		}
		$('#tblAcciónCorrectiva > tbody').html(rows);
	};

	/**
	 * DAtos del proveedor
	 */
	objInsp.verProveedor = function() {
		const button = $(this);
		const caudi = button.data('codigo');
		const proveedor = button.data('proveedor');
		$.ajax({
			url: baseurl + 'at/ctrlprov/ccons_insp/get_proveedor',
			method: 'POST',
			data: {
				proveedor: proveedor,
				caudi: caudi,
			},
			dataType: 'json',
			beforeSend: function() {
				objPrincipal.botonCargando(button);
			},
		}).done(function(res) {
			console.log(res);
			objInsp.imprimirProveedor(res.proveedor);
			objInsp.imprimirProveedorEstablecimiento(res.establecimiento);
			objInsp.imprimirProveedorLinea(res.linea);
			objInsp.imprimirProveedorContactos(res.contactos);
			$('#modalProveedor').modal('show');
		}).fail(function() {
			objPrincipal.notify('warning', 'Error al cargar los datos del proveedor');
		}).always(function() {
			objPrincipal.liberarBoton(button);
		});
	};

	/**
	 * @param data
	 */
	objInsp.imprimirProveedor = function(data) {
		$('#proveedor_ruc').html(data.NRUC);
		$('#proveedor_razon_social').html(data.DRAZONSOCIAL);
		$('#proveedor_direccion').html(data.DDIRECCIONCLIENTE);
		$('#proveedor_ubigeo').html(data.UBIGEO);
		$('#proveedor_telefono').html(data.DTELEFONO);
		$('#proveedor_representante').html(data.DREPRESENTANTE);
	};

	/**
	 * @param establecimiento
	 */
	objInsp.imprimirProveedorEstablecimiento = function(establecimiento) {
		$('#proveedor_inspeccionado').html(establecimiento);
	};

	/**
	 * @param linea
	 */
	objInsp.imprimirProveedorLinea = function(linea) {
		$('#proveedor_linea').html(linea);
	};

	/**
	 * @param datos
	 */
	objInsp.imprimirProveedorContactos = function(datos) {
		let rows = '';
		if (datos && Array.isArray(datos)) {
			datos.forEach(function(item, key) {
				rows += '<tr>';
				rows += '<td class="text-center" style="min-width: 50px" >' + (key + 1) + '</td>';
				rows += '<td class="text-left" style="min-width: 150px" >' + item.NOMBRES + '</td>';
				rows += '<td class="text-left" style="min-width: 150px" >' + item.DCARGOCONTACTO + '</td>';
				rows += '<td class="text-left" style="min-width: 150px" >' + item.DMAIL + '</td>';
				rows += '<td class="text-left" style="min-width: 150px" >' + item.DTELEFONO + '</td>';
				rows += '</tr>';
			});
		}
		$('#tblProveedorContactos tbody').html(rows);
	};

});

$(document).ready(function () {

	objInsp.cargaClientes();

	objInsp.cargaEstados();

	$('#btnBuscar').click(objInsp.search);

	$('#chkBusavanzada').click(function() {
		const el = $(this);
		const content = $('#filtroAvanzado');
		if (el.is(':checked')) {
			content.show();
		} else {
			content.hide();
		}
	});

	$(document).on('click', '.open-pdf', objInsp.openPDF);

	$(document).on('click', '.download-pdf', objInsp.downloadPDF);

	$('#closePDF').click(objInsp.closePDF);

	$('#activar_fecha').change(objInsp.activeDate);

	$('#modalPDF').on('hidden.bs.modal', function () {
		$('#framePDF').attr('src','about:blank');
	});

	$(document).on('click', '.ver-accion-correctiva', objInsp.verAccionCorrectiva);

	$(document).on('click', '.ver-proveedor', objInsp.verProveedor);

	$('#filtro_cliente').change(function() {
		const value = $(this).val();
		objInsp.cargaArea(value);
		objInsp.cargaProveedor(value);
		$('#contenedorMaquilador').hide();
		$('#filtro_maquilador').html('').change();
		if (value) {
			$('#contenedorProveedor').show();
		} else {
			$('#contenedorProveedor').hide();
		}
	});

	$('#filtro_proveedor').change(function() {
		const value = $(this).val();
		objInsp.cargaMaquilador(value);
		if (value) {
			$('#contenedorMaquilador').show();
		} else {
			$('#contenedorMaquilador').hide();
		}
	});

	const initSelect2 = {
		minimumInputLength: 0,
		theme: 'bootstrap4',
		placeholder: "::Elegir::",
		allowClear: true,
		width: '100%'
	};
	$('#filtro_cliente').select2(initSelect2);
	$('#filtro_proveedor').select2(initSelect2);
	$('#filtro_maquilador').select2(initSelect2);
	$('#filtro_tipo_estado').select2(initSelect2);
	$('#filtro_cliente_area').select2(initSelect2);

});
