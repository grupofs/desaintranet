const objLista = {
	/**
	 * Verifica si se encuentra cargando la lista
	 * @var {Boolean}
	 */
	cargando: false,
	/**
	 * Objeto de la tabla
	 * @var {Object}
	 */
	oTableLista: null
};

$(function () {

	/**
	 * Busqueda de area
	 */
	objLista.buscar = function () {
		if (objLista.cargando) {
			sweetalert('Aún existe una carga pediente, porfavor espere!', 'error');
		} else {
			const boton = $('#btnBuscar');
			objLista.cargando = true;
			this.oTableLista = $('#tblLista').DataTable({
				'bJQueryUI': true,
				'scrollY': '400px',
				'scrollX': true,
				'processing': true,
				'bDestroy': true,
				'paging': true,
				'info': true,
				'filter': true,
				'ajax': {
					"url": BASE_URL + "ar/evalprod/carea/lista",
					"type": "GET",
					"data": function (d) {
						d.nombre = $('#txtNombre').val();
					},
					beforeSend: function () {
						objPrincipal.botonCargando(boton);
					},
					dataSrc: function (data) {
						objPrincipal.liberarBoton(boton);
						objLista.cargando = false;
						return data;
					}
				},
				'columns': [
					{
						"class": "index",
						orderable: false,
						data: null,
						targets: 0
					},
					{data: 'nombre', orderable: false, targets: 1},
					{data: 'estado', orderable: false, targets: 2},
					{
						"orderable": false,
						render: function (data, type, row) {
							return '<div class="text-left" >' +
								'<button class="btn btn-transparent text-success btn-sm" onClick="objLista.editar(\'' + row.id_area + '\',this);">' +
								'<i class="fa fa-edit fa-2x" ></i>' +
								'</button>' +
								'</div>';
						}
					},
					// {
					//     "orderable": false,
					//     render: function (data, type, row) {
					//         return '<div class="text-left" >' +
					//             '<button class="btn btn-transparent text-danger btn-sm" onClick="objLista.eliminar(\'' + row.id_area + '\',this);">' +
					//             '<i class="fa fa-trash fa-2x" ></i>' +
					//             '</button>' +
					//             '</div>';
					//     }
					// }
				],
				"columnDefs": [
					{
						"defaultContent": " ",
						"targets": "_all"
					},
					{
						"targets": [2],
						"data": null,
						"render": function (data, type, row) {
							if (row.estado == 1) {
								$estado = "<span class='badge badge-success'>Activo</span>";
							} else if (row.estado == 2) {
								$estado = "<span class='badge badge-danger'>Inactivo</span>";
							}
							return $estado;
						}
					}
				]
			});
			objLista.oTableLista.on('order.dt search.dt', function () {
				objLista.oTableLista.column(0, {
					search: 'applied',
					order: 'applied'
				}).nodes().each(function (cell, i) {
					cell.innerHTML = i + 1;
				});
			}).draw();
		}
	};

	/**
	 * Crea un nueva area
	 */
	objLista.crearArea = function () {
		objGenerar.crear();
	};

	/**
	 * Poder editar el proveedor
	 * @param id
	 * @param boton
	 */
	objLista.editar = function (id, boton) {
		if (objLista.cargando) {
			sweetalert('Aún existe una carga pediente, porfavor espere!', 'error');
		} else {
			boton = $(boton);
			objLista.cargando = true;
			$.ajax({
				url: BASE_URL + 'ar/evalprod/carea/buscar',
				method: 'POST',
				data: {
					id: id
				},
				dataType: 'json',
				beforeSend: function () {
					objPrincipal.botonCargando(boton);
				}
			}).done(function (response) {
				if (response && response.area && response.area.id_area) {
					objGenerar.abrir(
						response.area.id_area,
						response.area.nombre,
						response.area.estado,
						response.contactos
					);
					$('#tabReg2-tab').click();
				} else {
					sweetalert('El área no pudo ser encontrado.', 'error');
				}
			}).fail(function () {
				sweetalert('Error en el proceso de ejecución HTTP', 'error');
			}).always(function () {
				objPrincipal.liberarBoton(boton);
				objLista.cargando = false;
			});
		}
	};

	objLista.eliminar = function (id, boton) {
		sweetalert('Lo siento, el eliminar esta en mantenimiento!', 'info');
	}

});

$(document).ready(function () {

	objLista.buscar();

	$('#tabReg1-tab').click(function () {
		objGenerar.abrir(0, '', []);
		objLista.buscar();
	});

	$('#btnBuscar').click(objLista.buscar);

	$('#btnNuevoArea').click(function () {
		$('#tabReg2-tab').click();
	});

});
