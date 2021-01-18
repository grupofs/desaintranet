/*!
 *
 * @version 1.0.0
 * @author Anthony
 */

const objProducto = {
    items: []
};

$(function () {

    /**
     * Guarda la cantidad de productos
     */
    objProducto.guardarCantidadProductos = function () {
        const boton = $('#guardarCantidadProductos');
        $.ajax({
            url: BASE_URL + 'ar/evalprod/cexpediente/guardar_cantidad_productos',
            method: 'POST',
            data: {
                id_expediente: $('input#hdnIdexpe').val(),
                agregar: $('select#cboVarios').val()
            },
            dataType: 'json',
            beforeSend: function () {
                objPrincipal.botonCargando(boton);
            }
        }).done(function (response) {
            if (response.error) {
                sweetalert(response.error, 'error');
            } else {
                sweetalert('Número de Productos guardados correctamente.', 'success');
                objProducto.listaProductos();
            }
        }).fail(function (jqxhr) {
            sweetalert('Error en el proceso de ejecución', 'error');
        }).always(function () {
            objPrincipal.liberarBoton(boton);
        });
    };

    /**
     * Lista de productos
     */
    objProducto.listaProductos = function () {
        // Se limpia los items para volver a cargarlos
        objProducto.items = [];
        const oTable_listproductoseval = $('#tbllistproductos').DataTable({
            'bJQueryUI': true,
            'scrollY': '400px',
            'scrollX': true,
            'processing': true,
            'bDestroy': true,
            'paging': false,
            'info': true,
            'ajax': {
                "url": BASE_URL + "ar/evalprod/cexpediente/lista_productos",
                "type": "POST",
                "data": function (d) {
                    d.id_expediente = $('#hdnIdexpe').val();
                },
                dataSrc: ''
            },
            "initComplete": function (settings, data) {
                // Se guardan los datos
                objProducto.items = data;
            },
            'columns': [
                {
                    "class": "index",
                    orderable: false,
                    data: null,
                    targets: 0
                },
                {data: 'codigo', targets: 1},
                {data: 'descripcion', targets: 2, "class": "col-largo"},
                {data: 'marca', targets: 3},
                {data: 'presentacion', targets: 4},
                {data: 'fabricante', targets: 5},
                {data: 'rs', targets: 6},
                {
                    "orderable": false,
                    render: function (data, type, row) {
                        return '<div>' +
                            '<button onclick="objProducto.abrir(' + row.id_producto + ')" class="btn btn-transparent btn-sm text-success" >' +
                            '<i style="cursor:pointer;" class="fa fa-edit fa-2x"></i>' +
                            '</button>' +
                            '</div>'
                    }
                },
                {
                    "orderable": false,
                    render: function (data, type, row) {
                        return '<div>' +
                            '<button onclick="objProducto.eliminar(this, ' + row.id_producto + ')" class="btn btn-transparent btn-sm text-primary" >' +
                            '<i style="cursor:pointer;" class="fa fa-trash fa-2x"></i>' +
                            '</button>' +
                            '</div>'
                    }
                }
            ]
        });
        // Enumeracion
        oTable_listproductoseval.on('order.dt search.dt', function () {
            oTable_listproductoseval.column(0, {search: 'applied', order: 'applied'}).nodes().each(function (cell, i) {
                cell.innerHTML = i + 1;
            });
        }).draw();
    };

    /**
     * Muestra los datos del producto
     * @param idProducto
     */
    objProducto.abrir = function (idProducto) {
        const producto = objProducto.items.find(function (item) {
            return (parseInt(item.id_producto) === parseInt(idProducto))
        });
        if (!producto) {
            sweetalert('Lo siento pero el producto a editar no pudo ser encontrado, vuelva a intentarlo.', 'info');
        } else {
            objProducto.guardarDatos(
                producto.id_producto,
                producto.codigo,
                producto.descripcion,
                producto.marca,
                producto.presentacion,
                producto.fabricante,
                producto.tipo_codigo,
                producto.rs,
                producto.fecha_emision,
                producto.fecha_vcto,
                producto.grasas_saturadas,
                producto.azucar,
                producto.sodio,
                producto.grasas_trans,
                producto.observacion
            );
            $('#modalRegProductos').modal('show');
        }
    };

    /**
     * Elimina un producto
     * @param boton
     * @param idProducto
     */
    objProducto.eliminar = function (boton, idProducto) {
		Swal.fire({
			type: 'warning',
			title: 'Eliminar producto',
			text: '¿Estas seguro(a) de eliminar?',
			showCancelButton: true,
			confirmButtonColor: '#3085d6',
			cancelButtonColor: '#d33',
			confirmButtonText: 'Si',
			cancelButtonText: 'Cancelar',
		}).then((result) => {
			if (result.value) {
				boton = $(boton);
				$.ajax({
					url: BASE_URL + 'ar/evalprod/cexpediente/eliminar_producto',
					method: 'POST',
					data: {
						id_producto: idProducto,
						id_expediente: $('#hdnIdexpe').val()
					},
					dataType: 'json',
					beforeSend: function () {
						objPrincipal.botonCargando(boton);
					}
				}).done(function (response) {
					if (response.error) {
						sweetalert(response.error, 'error');
					} else {
						objProducto.listaProductos();
					}
				}).fail(function (jqxhr) {
					sweetalert('Error en el proceso de ejecución al guardar el producto', 'error');
				}).always(function () {
					objPrincipal.liberarBoton(boton);
				});
			}
		})
    };

    /**
     * Imprime los datos del formulario del producto
     * @param idProducto
     * @param codigoEan
     * @param descripcion
     * @param marca
     * @param presentacion
     * @param fabricante
     * @param tipoDoc
     * @param nroDoc
     * @param fechaEmi
     * @param fechaVence
     * @param grasaSatu
     * @param azucar
     * @param sodio
     * @param grasaTrans
     * @param observacion
     */
    objProducto.guardarDatos = function (idProducto, codigoEan, descripcion, marca, presentacion, fabricante, tipoDoc, nroDoc, fechaEmi, fechaVence, grasaSatu, azucar, sodio, grasaTrans, observacion) {
        $('#mhdnIdproductos').val(idProducto);
        $('#mtxtCodigoean').val(codigoEan);
        $('#mtxtDescrip').val(descripcion);
        $('#mtxtMarca').val(marca);
        $('#mtxtPresent').val(presentacion);
        $('#mtxtFabri').val(fabricante);
        $('#cboTipodoc').val(tipoDoc).change();
        $('#mtxtNrodoc').val(nroDoc);
        $('#FechaEmi').val(fechaEmi);
        $('#FechaVence').val(fechaVence);
        $('#cboGrasaSatu').val(grasaSatu).change();
        $('#cboAzucar').val(azucar).change();
        $('#cboSodio').val(sodio).change();
        $('#cboGrasaTrans').val(grasaTrans).change();
        $('#mtxtObserva').val(observacion);
    };

    /**
     * Guardar los cambios del producto
     */
    objProducto.guardar = function () {
        const boton = $(this);
        const form = $('form#frmRegProducto');
        $.ajax({
            url: form.attr('action'),
            method: 'POST',
            data: form.serialize() + '&hdnIdexpe=' + $('#hdnIdexpe').val(),
            dataType: 'json',
            beforeSend: function () {
                objPrincipal.botonCargando(boton);
            }
        }).done(function (response) {
            if (response.error) {
                sweetalert(response.error, 'error');
            } else {
                $('#modalRegProductos').modal('hide');
                objProducto.listaProductos();
            }
        }).fail(function (jqxhr) {
            sweetalert('Error en el proceso de ejecución al guardar el producto', 'error');
        }).always(function () {
            objPrincipal.liberarBoton(boton);
        });
    };

});

$(document).ready(function () {

    $('#guardarCantidadProductos').click(objProducto.guardarCantidadProductos);

    $('#mbtnGuardarProductos').click(objProducto.guardar);

});
