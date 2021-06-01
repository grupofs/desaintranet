/*!
 *
 * @version 1.0.0
 */

const objInspCli = {};

$(function () {

	/**
	 * Verifica si la carga esta activa o no
	 * @type {boolean}
	 */
	objInspCli.loading = false;

	/**
	 * ID de la inspección abierta para realizar su descarga
	 * @type {integer|null}
	 */
	objInspCli.pdf = {
		codigo: '',
		fecha: ''
	};

	/**
	 * Activa la carga de la busqueda
	 */
	objInspCli.activeLoading = function () {
		objInspCli.loading = true;
		objPrincipal.botonCargando($('#btnBuscar'));
	};

	/**
	 * Desactiva la carga de la busqueda
	 */
	objInspCli.inactiveLoading = function () {
		objInspCli.loading = false;
		objPrincipal.liberarBoton($('#btnBuscar'));
	};

	/**
	 * Realiza el filtro de las inspecciones
	 */
	objInspCli.search = function () {
		if (objInspCli.loading) {
			objPrincipal.alert('warning', 'Aún se encuentra activa la busqueda. Por favor espere!');
		} else {
			objInspCli.activeLoading();
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
					"url": baseurl + 'at/ctrlprovclie/ccons_inspcli/search',
					"type": "POST",
					"data": function (d) {
						d.afecha = ($('#activar_fecha').is(':checked')) ? 1 : 0;
						d.fini = $('#fini').val();
						d.ffin = $('#ffin').val();
						d.ccia = $('#idcia').val();
						d.filtro_proveedor = $('#filtro_proveedor').val();
						d.filtro_maquilador = $('#filtro_maquilador').val();
						d.filtro_tipo_estado = $('#filtro_tipo_estado').val();
						d.filtro_cliente_area = $('#filtro_cliente_area').val();
						d.filtro_linea_proveedor = $('#filtro_linea_proveedor').val();
						d.filtro_calificacion = $('#filtro_calificacion').val();
						d.filtro_establecimiento_maqui = $('#filtro_establecimiento_maqui').val();
						d.filtro_dir_establecimiento_maqui = $('#filtro_dir_establecimiento_maqui').val();
						d.filtro_nro_informe = $('#filtro_nro_informe').val();
						d.filtro_peligro = filtroPeligro;
					},
					dataSrc: function (data) {
						objInspCli.inactiveLoading();
						return data.items;
					},
					error: function () {
						objPrincipal.alert('warning', 'Error en el proceso de ejecución.', 'Vuelva a intentarlo más tarde.');
						objInspCli.inactiveLoading();
					}
				},
				'columns': [
					{
						"orderable": false,
						render: function (data, type, row) {
							const rowId = 'dropdown-' + row.CODIGO + row.FECHAINSPECCION;
							let htmlRow = '<div class="dropdown">';
							htmlRow += '<button type="button" class="btn btn-sm btn-secondary dropdown-toggle" role="button" id="' + rowId + '" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">';
							htmlRow += '<i class="fa fa-bars" ></i> Opciones';
							htmlRow += '</button>';
							htmlRow += '<div class="dropdown-menu" aria-labelledby="' + rowId + '">';
							let DIRECCIONPROV = (row.DIRECCIONPROV) ? row.DIRECCIONPROV : '';
							let ESTABLECIMIENTOPROV = (row.ESTABLECIMIENTOPROV) ? row.ESTABLECIMIENTOPROV : '';
							let MAQUILADOR = (row.MAQUILADOR) ? row.MAQUILADOR : '';
							let dirProvMaqui = (DIRECCIONPROV) ? ESTABLECIMIENTOPROV : ESTABLECIMIENTOPROV + ' - ' + MAQUILADOR;
							if (row.DUBICACIONFILESERVERAC) {
								htmlRow += '<a class="btn btn-sm dropdown-item" href="' + baseurl + 'FTPfileserver/Archivos/' + row.DUBICACIONFILESERVERAC + '" target="_blank" ><i class="fa fa-download" ></i> Descargar Acciones Correctivas</a>';
							} else {
								htmlRow += '<button type="button" class="btn btn-sm dropdown-item ver-accion-correctiva" data-excel="' + row.DUBICACIONFILESERVERAC + '" data-codigo="' + row.CODIGO + '" data-fecha="' + row.FECHAINSPECCION + '" data-proveedor="' + row.PROVEEDOR + '" data-direccion="' + dirProvMaqui + '" ><i class="fa fa-th-list" ></i> Ver Acciones Correctivas</button>';
							}
							htmlRow += '<button type="button" class="btn btn-sm dropdown-item ver-proveedor" data-codigo="' + row.CODIGO + '" data-proveedor="' + row.CPROVEEDOR + '" ><i class="fa fa-eye" ></i> Datos del Proveedor</button>';
							htmlRow += '</div>';
							htmlRow += '</div>';
							return htmlRow;
						}
					},
					{
						"orderable": false,
						render: function (data, type, row) {
							if (row.DUBICACIONFILESERVER) {
								return '<a href="' + baseurl + 'FTPfileserver/Archivos/' + row.DUBICACIONFILESERVER + '" target="_blank" class="btn btn-sm btn-success btn-block" ><i class="fa fa-folder" ></i> Ver Informe Convalidado</a>';
							} else {
								if (row.DUBICACIONFILESERVERPDF) {
									return '<a href="' + baseurl + 'FTPfileserver/Archivos/' + row.DUBICACIONFILESERVERPDF + '" target="_blank" class="btn btn-sm btn-success btn-block" ><i class="fa fa-file-pdf" ></i> Ver Informe Técnico</a>';
								}
							}
						}
					},
					{
						"orderable": false,
						render: function (data, type, row) {
							return moment(row.FECHAINSPECCION, 'YYYY-MM-DD').format('DD/MM/YYYY');
						}
					},
					{data: 'nruc', orderable: false, targets: 2},
					{data: 'PROVEEDOR', orderable: false, targets: 3},
					{
						"orderable": false,
						render: function (data, type, row) {
							let DIRECCIONPROV = (row.DIRECCIONPROV) ? row.DIRECCIONPROV : '';
							let ESTABLECIMIENTOPROV = (row.ESTABLECIMIENTOPROV) ? row.ESTABLECIMIENTOPROV : '';
							// let UBIGEOPROV = (row.UBIGEOPROV) ? row.UBIGEOPROV : '';
							let MAQUILADOR = (row.MAQUILADOR) ? row.MAQUILADOR : '';
							if (DIRECCIONPROV) {
								return ESTABLECIMIENTOPROV;
							} else {
								return ESTABLECIMIENTOPROV + ' - ' + MAQUILADOR;
							}
						}
					},
					{
						"orderable": false,
						render: function (data, type, row) {
							let DIRECCIONMAQUILA = (row.DIRECCIONMAQUILA) ? row.DIRECCIONMAQUILA : '';
							let UBIGEOMAQUILA = (row.UBIGEOMAQUILA) ? row.UBIGEOMAQUILA : '';
							let DIRECCIONPROV = (row.DIRECCIONPROV) ? row.DIRECCIONPROV : '';
							let UBIGEOPROV = (row.UBIGEOPROV) ? row.UBIGEOPROV : '';
							if (DIRECCIONPROV) {
								return DIRECCIONPROV + ' ' + UBIGEOPROV;
							} else {
								return DIRECCIONMAQUILA + ' ' + UBIGEOMAQUILA;
							}
						}
					},
					{data: 'AREACLIENTE', orderable: false, targets: 6},
					{
						"orderable": false,
						render: function (data, type, row) {
							if (String(row.espeligro).toUpperCase() === 'S') {
								return '<span class="text-danger" >' + row.LINEA + '</span>';
							}
							return row.LINEA;
						}
					},
					{data: 'TIPOESTADOSERVICIO', orderable: false, targets: 8},
					{data: 'COMENTARIO', orderable: false, targets: 9},
					{data: 'dinformefinal', orderable: false, targets: 10},
					{
						"orderable": false,
						render: function (data, type, row) {
							let RESULTADOCHECKLIST = (row.RESULTADOCHECKLIST) ? row.RESULTADOCHECKLIST + '%' : '';
							let RESULTADOTEXTO = (row.RESULTADOTEXTO) ? row.RESULTADOTEXTO : '';
							return RESULTADOCHECKLIST + '<br>' + RESULTADOTEXTO;
						}
					},
					{data: 'ACCIONCORRECTIVA', orderable: false, targets: 12},
					{data: 'CONSULTOR', orderable: false, targets: 13},
					{
						"orderable": false,
						render: function (data, type, row) {
							let tipoEstado = String(row.TIPOESTADOSERVICIO).toLowerCase().trim();
							let EMPRESAINSPECTORA = String(row.EMPRESAINSPECTORA).toLowerCase().trim();
							if (tipoEstado === 'convalidado' && (
								EMPRESAINSPECTORA === 'senasa' ||
								EMPRESAINSPECTORA === 'digemid' ||
								EMPRESAINSPECTORA === 'digesa' ||
								EMPRESAINSPECTORA === 'sanipes'
							)) {
								return row.EMPRESAINSPECTORA;
							} else {
								let CERTIFICADORA = (row.CERTIFICADORA) ? row.CERTIFICADORA : '';
								let CERTIFICACION = (row.CERTIFICACION) ? row.CERTIFICACION : '';
								return CERTIFICADORA + '<br>' + CERTIFICACION;
							}
						}
					},
					// {data: 'SCERTIFICACION', orderable: false, targets: 15},
					{
						"orderable": false,
						render: function (data, type, row) {
							let SCERTIFICACION = (row.SCERTIFICACION) ? row.SCERTIFICACION : '';
							let EMPRESAINSPECTORA = String(row.EMPRESAINSPECTORA).toLowerCase().trim();
							let tipoEstado = String(row.TIPOESTADOSERVICIO).toLowerCase().trim();
							if (tipoEstado === 'convalidado' && (
								EMPRESAINSPECTORA === 'senasa' ||
								EMPRESAINSPECTORA === 'digemid' ||
								EMPRESAINSPECTORA === 'digesa' ||
								EMPRESAINSPECTORA === 'sanipes'
							)) {
								return 'SI TIENE';
							} else {
								return SCERTIFICACION;
							}
						}
					},
					{
						"orderable": false,
						render: function (data, type, row) {
							let LICENCIADEFUNCIONAMIENTO = (row.LICENCIADEFUNCIONAMIENTO) ? row.LICENCIADEFUNCIONAMIENTO : '';
							let ESTADOLICENCIADEFUNCIONAMIENTO = (row.ESTADOLICENCIADEFUNCIONAMIENTO) ? row.ESTADOLICENCIADEFUNCIONAMIENTO : '';
							return ESTADOLICENCIADEFUNCIONAMIENTO + '<br>' + LICENCIADEFUNCIONAMIENTO;
						}
					},
					{data: 'EMPRESAINSPECTORA', orderable: false, targets: 17},
					{data: 'SEVALPROD', orderable: false, targets: 18},
					{data: 'espeligro', orderable: false, targets: 19},
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
	objInspCli.openPDF = function () {
		const button = $(this);
		// save ID
		objInspCli.pdf.codigo = button.data('codigo');
		objInspCli.pdf.fecha = button.data('fecha');
		const modalPDF = $('#modalPDF');
		modalPDF.modal('show');
		$('#framePDF').attr('src', objInspCli.getLink());
	};

	/**
	 * Link del PDF
	 * @returns {string}
	 */
	objInspCli.getLink = function () {
		return BASE_URL + 'at/ctrlprov/ccons_insp/pdf?codigo=' + objInspCli.pdf.codigo + '&fecha=' + objInspCli.pdf.fecha;
	};

	/**
	 * Cierra el PF
	 */
	objInspCli.closePDF = function () {
		const btn = $('#closePDF');
		$.ajax({
			url: BASE_URL + 'at/ctrlprov/ccons_insp/close_download',
			method: 'POST',
			data: objInspCli.pdf,
			dataType: 'json',
			beforeSend: function () {
				objPrincipal.botonCargando(btn);
			}
		}).done(function (res) {
			objInspCli.download(res.data.DUBICACIONFILESERVERPDF);
			$('#modalPDF').modal('hide');
			objInspCli.search();
		}).fail(function () {
			objPrincipal.alert('error', 'Error en la descarga del archivo.', 'Vuelva a inentarlo más tarde.');
		}).always(function () {
			objPrincipal.liberarBoton(btn);
		});
	};

	/**
	 * Descarga del link del PDF
	 */
	objInspCli.downloadPDF = function () {
		const button = $(this);
		const link = button.data('link');
		objInspCli.download(link);
	};

	/**
	 * Realiza la descarga del archivo
	 * @param linkPdf
	 */
	objInspCli.download = function (linkPdf) {
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
	objInspCli.activeDate = function () {
		const chech = !$(this).is(':checked');
		$('#fini').prop('disabled', chech);
		$('#ffin').prop('disabled', chech);
	};

	/**
	 * @param idCliente
	 */
	objInspCli.cargaArea = function(idCliente) {
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
			let options = '';
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
	objInspCli.cargaProveedor = function (idCliente) {
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
	objInspCli.cargaEstados = function () {
		$.ajax({
			type: 'ajax',
			method: 'post',
			url: baseurl + "at/ctrlprov/cregctrolprov/getcboestado",
			data: {},
			dataType: "JSON",
		}).done(function(res) {
			$('#filtro_tipo_estado').html(res);
			$('#filtro_tipo_estado').val(0).trigger('change');
		}).fail(function() {
			objPrincipal.notify('warning', 'Hubo un error al carga los proveedor.');
		});
	};

	/**
	 * Carga de proveedores
	 */
	objInspCli.cargaMaquilador = function (idProveedor) {
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
	objInspCli.verAccionCorrectiva = function() {
		const button = $(this);
		const codigo = button.data('codigo');
		const fecha = button.data('fecha');
		const proveedor = button.data('proveedor');
		const dirProvMaqui = button.data('direccion');
		const excel = button.data('excel');
		objPrincipal.botonCargando(button);
		const oTableLista = $('#tblAcciónCorrectiva').DataTable({
			"processing"  	: true,
			"bDestroy"    	: true,
			"stateSave"     : true,
			"bJQueryUI"     : true,
			"scrollY"     	: "540px",
			"scrollX"     	: true,
			'AutoWidth'     : true,
			"paging"      	: false,
			"info"        	: true,
			"filter"      	: true,
			"ordering"		: false,
			"responsive"    : false,
			"select"        : true,
			'ajax': {
				"url": baseurl + 'at/ctrlprov/ccons_insp/get_accion_correctiva',
				"type": "POST",
				"data": function (d) {
					d.codigo = codigo;
					d.fecha = fecha;
				},
				dataSrc: function (data) {
					objPrincipal.liberarBoton(button);
					return data.items;
				},
				error: function () {
					objPrincipal.alert('warning', 'Error en el proceso de ejecución.', 'Vuelva a intentarlo más tarde.');
					objPrincipal.liberarBoton(button);
				}
			},
			'columns': [
				{data: 'dnumerador', orderable: false, targets: 0, "class": "col-s"},
				{data: 'drequisito', orderable: false, targets: 1, "class": "col-1m"},
				{data: 'sexcluyente', orderable: false, targets: 2, "class": "col-xs"},
				{data: 'tipohallazgo', orderable: false, targets: 3, "class": "col-sm"},
				{data: 'dhallazgo', orderable: false, targets: 4, "class": "col-1m"},
				{data: 'daccioncorrectiva', orderable: false, targets: 5, "class": "col-1m"},
				{data: 'dresponsablecliente', orderable: false, targets: 6, "class": "col-sm"},
				{
					"orderable": false,
					render: function (data, type, row) {
						return moment(row.tcreacion).format('DD/MM/YYYY');
					}
				},
				{data: 'svalor', orderable: false, targets: 8, "class": "col-xs"},
				{data: 'dobservacion', orderable: false, targets: 9, "class": "col-xm"},
			],
			"columnDefs": [
				{
					"defaultContent": " ",
					"targets": "_all"
				}
			]
		});
		// Enumeracion
		oTableLista.on( 'order.dt search.dt', function () {
			oTableLista.column(0, {search:'applied', order:'applied'}).nodes().each( function (cell, i) {
				cell.innerHTML = i+1;
			});
		} ).draw();

		const elModal = $('#modalAccionCorrectiva');
		elModal.find('h5').html('Acción Correctiva (' + proveedor + ' - ' + dirProvMaqui + ' - ' + moment(fecha, 'YYYY-MM-DD').format('DD/MM/YYYY') + ')');
		if (excel) {
			$('#btnDownloadAccionCorrectiva').attr('href', baseurl + 'FTPfileserver/Archivos/' + excel);
			$('#download-excel').show();
		} else {
			$('#btnDownloadAccionCorrectiva').attr('href', '#');
			$('#download-excel').hide();
		}
		elModal.modal('show');
	};

	/**
	 * DAtos del proveedor
	 */
	objInspCli.verProveedor = function() {
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
			objInspCli.imprimirProveedor(res.proveedor);
			objInspCli.imprimirProveedorEstablecimiento(res.establecimiento);
			objInspCli.imprimirProveedorLinea(res.linea);
			objInspCli.imprimirProveedorContactos(res.contactos);
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
	objInspCli.imprimirProveedor = function(data) {
		$('#proveedor_ruc').html(data.NRUC);
		$('#proveedor_razon_social').html(data.DRAZONSOCIAL);
		$('#proveedor_direccion').html(data.DDIRECCIONCLIENTE);
		$('#proveedor_ubigeo').html(data.UBIGEO);
		$('#proveedor_telefono').html(data.DTELEFONO);
		$('#proveedor_representante').html(data.DREPRESENTANTE);
		$('#proveedor_tipo_empresa').html(data.tipoempresa);
	};

	/**
	 * @param establecimiento
	 */
	objInspCli.imprimirProveedorEstablecimiento = function(establecimiento) {
		$('#proveedor_inspeccionado').html(establecimiento);
	};

	/**
	 * @param linea
	 */
	objInspCli.imprimirProveedorLinea = function(linea) {
		$('#proveedor_linea').html(linea);
	};

	/**
	 * @param datos
	 */
	objInspCli.imprimirProveedorContactos = function(datos) {
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

	/**
	 * Exporta los registros
	 */
	objInspCli.descargarResultado = function() {
		const button = $(this);
		let filtroPeligro = '';
		if ($('#filtro_peligro_1').is(':checked')) {
			filtroPeligro = 'S';
		}
		if ($('#filtro_peligro_2').is(':checked')) {
			filtroPeligro = 'N';
		}
		$.ajax({
			url: baseurl + 'at/ctrlprovclie/ccons_inspcli/exportar_registros',
			method: 'POST',
			data: {
				afecha: ($('#activar_fecha').is(':checked')) ? 1 : 0,
				fini: $('#fini').val(),
				ffin: $('#ffin').val(),
				ccia: $('#idcia').val(),
				filtro_proveedor: $('#filtro_proveedor').val(),
				filtro_maquilador: $('#filtro_maquilador').val(),
				filtro_tipo_estado: $('#filtro_tipo_estado').val(),
				filtro_cliente_area: $('#filtro_cliente_area').val(),
				filtro_linea_proveedor: $('#filtro_linea_proveedor').val(),
				filtro_calificacion: $('#filtro_calificacion').val(),
				filtro_establecimiento_maqui: $('#filtro_establecimiento_maqui').val(),
				filtro_dir_establecimiento_maqui: $('#filtro_dir_establecimiento_maqui').val(),
				filtro_nro_informe: $('#filtro_nro_informe').val(),
				filtro_peligro: filtroPeligro,
			},
			dataType: 'json',
			beforeSend: function() {
				objPrincipal.botonCargando(button);
			}
		}).done(function(res) {
			objPrincipal.notify('success', 'Descarga del reporte correctamente.');
			const url = baseurl + 'at/ctrlprov/ccons_insp/download?filename=../../temp/' + res.data;
			const download = window.open(url, '_blank');
			if (!download) {
				objPrincipal.alert('warning', 'Habilite la ventana emergente de su navegador.');
			}
			download.focus();
		}).fail(function() {
			objPrincipal.notify('error', 'Error en la descarga del reporte');
		}).always(function() {
			objPrincipal.liberarBoton(button);
		});
	};

});

$(document).ready(function () {

	objInspCli.cargaProveedor($('#idcliente').val());

	objInspCli.cargaArea($('#idcliente').val());

	objInspCli.cargaEstados();

	$('#btnBuscar').click(objInspCli.search);

	$('#chkBusavanzada').click(function() {
		$('#modalFiltro').modal('show');
	});

	$('#modalFiltro').on('hidden.bs.modal', function () {
		$('#chkBusavanzada').prop('checked', false);
	});

	$(document).on('click', '.open-pdf', objInspCli.openPDF);

	$(document).on('click', '.download-pdf', objInspCli.downloadPDF);

	$('#closePDF').click(objInspCli.closePDF);

	$('#activar_fecha').change(objInspCli.activeDate);

	$('#modalPDF').on('hidden.bs.modal', function () {
		$('#framePDF').attr('src','about:blank');
	});

	$('#btnDescargar').click(objInspCli.descargarResultado);

	$(document).on('click', '.ver-accion-correctiva', objInspCli.verAccionCorrectiva);

	$(document).on('click', '.ver-proveedor', objInspCli.verProveedor);

	$('#filtro_proveedor').change(function() {
		const value = $(this).val();
		objInspCli.cargaMaquilador(value);
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
	$('#filtro_proveedor').select2(initSelect2);
	$('#filtro_maquilador').select2(initSelect2);
	// $('#filtro_tipo_estado').select2(initSelect2);
	// $('#filtro_cliente_area').select2(initSelect2);

});
