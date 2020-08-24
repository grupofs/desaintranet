/*
 *
 * @version 1.0.0
 * @author Anthony
 */

const objLista = {};

$(function () {

    /**
     * Obtiene las columnas de la lista
     * @returns {Array}
     */
    objFiltro.obtenerColumnas = function () {
        const columnas = [];
        columnas.push({
            "class": "index",
            orderable: false,
            data: null,
            targets: 0
        });
        columnas.push({data: 'expediente', targets: 1});
        columnas.push({data: 'proveedor', orderable: false, targets: 2});
        columnas.push({data: 'total', orderable: false, targets: 3});
        columnas.push({data: 'fecha', orderable: false, targets: 4});
        columnas.push({data: 'flimite', orderable: false, targets: 5});
        columnas.push({
            "orderable": false,
            render: function (data, type, row) {
                if (row.ruta_ficha != null) {
                    return '<div class="text-left position-relative" >' +
                        '<a href="' + BASE_URL + 'FTPfileserver/Archivos/' + row.ruta_ficha + '" target="_blank" title="Descargar Ficha" class="btn btn-transparent text-danger" id="descarga-ficha-' + row.id_expediente + '" ><i class="fa fa-file-pdf fa-2x" data-original-title="Descargar" data-toggle="tooltip"></i></a>' +
                        '<button class="btn btn-transparent position-absolute" onclick="objLista.eliminarFicha(\'' + row.id_expediente + '\', this)" style="top: -10px; right: 0;" ><i class="fa fa-times" ></i></button>' +
                        '</div>';
                } else {
                    return '<div class="text-left position-relative" >' +
                        '<button class="btn btn-transparent btn-sm" onClick="objLista.cargarFicha(\'' + row.id_expediente + '\',\'' + row.expediente + '\');">' +
                        '<i class="fa fa-cloud-upload-alt fa-2x" ></i>' +
                        '</button>' +
                        '</div>';
                }
            }
        });
        columnas.push({
            "orderable": false,
            render: function (data, type, row) {
                if (row.ruta_expediente != null) {
                    return '<div class="text-left position-relative" >' +
                        '<a href="' + BASE_URL + 'FTPfileserver/Archivos/' + row.ruta_expediente + '" target="_blank" title="Descargar PDF" class="btn btn-transparent text-danger" id="descarga-pdf-' + row.id_expediente + '" ><i class="fa fa-file-pdf fa-2x" data-original-title="Descargar" data-toggle="tooltip"></i></a>' +
                        '<button class="btn btn-transparent position-absolute" onclick="objLista.eliminarPDF(\'' + row.id_expediente + '\', this)" style="top: -10px; right: 0;" ><i class="fa fa-times" ></i></button>' +
                        '</div>'
                } else {
                    return '<div class="text-left" >' +
                        '<button class="btn btn-transparent btn-sm" onClick="objLista.cargarPDF(\'' + row.id_expediente + '\',\'' + row.expediente + '\');">' +
                        '<i class="fa fa-cloud-upload-alt fa-2x" ></i>' +
                        '</button>' +
                        '</div>';
                }
            }
        });
        columnas.push({data: 'destado', orderable: false, targets: 8});
        columnas.push({
            "orderable": false,
            render: function (data, type, row) {
                return '<div class="text-left" >' +
                    '<button class="btn btn-transparent text-success btn-sm" onClick="objLista.editar(\'' + row.id_expediente + '\', this);">' +
                    '<i class="fa fa-edit fa-2x" ></i>' +
                    '</button>' +
                    '</div>';
            }
        });
        columnas.push({
            "orderable": false,
            render: function (data, type, row, settings) {
                if (settings.row === 0) {
                    return '<div class="text-left" >' +
                        '<button class="btn btn-transparent text-dark btn-sm" onClick="objLista.eliminar(\'' + row.id_expediente + '\', this);">' +
                        '<i class="fa fa-trash fa-2x" ></i>' +
                        '</button>' +
                        '</div>';
                }
            }
        });
        columnas.push({
            "orderable": false,
            render: function (data, type, row) {
                const link = BASE_URL + "formatos/ar/evalprod/pdfCargoRecepcion.php/?id_expediente=" + row.id_expediente;
                return '<div>' +
                    '  <a href="' + link + '" title="Exportar" class="btn btn-transparent btn-sm text-secondary" target="_blank" data-original-title="Exportar"> <i style="cursor:pointer;" class="fa fa-print fa-2x"></i></a>' +
                    '</div>';
            }
        });
        return columnas;
    };

    /**
     * Metodo para cargar la ficha del expediente
     * @param idExpediente
     * @param expediente
     */
    objLista.cargarFicha = function (idExpediente, expediente) {
        $('#ficha_id_expediente').val(idExpediente);
        const modalFormulario = $('#modalSubirFicha');
        modalFormulario.find('h5').html('Expediente ' + expediente);
        modalFormulario.modal('show');
    };

    /**
     * Elimina la ficha del expediente
     * @param idExpediente
     * @param boton
     */
    objLista.eliminarFicha = function (idExpediente, boton) {
        if (objFiltro.cargando) {
            sweetalert('Por favor espere existe un proceso pendiente.', 'error');
        } else {
            boton = $(boton);
            const botonFicha = $('#descarga-ficha-' + idExpediente);
            $.ajax({
                url: BASE_URL + 'ar/evalprod/cexpediente/eliminar_ficha',
                method: 'POST',
                data: {
                    id: idExpediente
                },
                dataType: 'json',
                beforeSend: function () {
                    botonFicha.removeAttr('target');
                    botonFicha.attr('href', 'javascript:void(0)');
                    objPrincipal.botonCargando(boton);
                }
            }).done(function (response) {
                if (response.error) {
                    sweetalert(response.error, 'error');
                } else {
                    sweetalert('Ficha eliminada correctamente', 'success');
                    objFiltro.buscar();
                }
            }).fail(function (jqxhr) {
                sweetalert('Error en el proceso de ejecución', 'error');
            }).always(function () {
                objPrincipal.liberarBoton(boton);
            });
        }
    };

    /**
     * Metodo para cargar el PDF del expediente
     * @param idExpediente
     * @param expediente
     */
    objLista.cargarPDF = function (idExpediente, expediente) {
        $('#pdf_id_expediente').val(idExpediente);
        const modalFormulario = $('#modalSubirPDF');
        modalFormulario.find('h5').html('Expediente ' + expediente);
        modalFormulario.modal('show');
    };

    /**
     * Elimina el PDF del expediente
     * @param idExpediente
     * @param boton
     */
    objLista.eliminarPDF = function(idExpediente, boton) {
        if (objFiltro.cargando) {
            sweetalert('Por favor espere existe un proceso pendiente.', 'error');
        } else {
            boton = $(boton);
            const botonPDF = $('#descarga-pdf-' + idExpediente);
            $.ajax({
                url: BASE_URL + 'ar/evalprod/cexpediente/eliminar_pdf',
                method: 'POST',
                data: {
                    id: idExpediente
                },
                dataType: 'json',
                beforeSend: function () {
                    botonPDF.removeAttr('target');
                    botonPDF.attr('href', 'javascript:void(0)');
                    objPrincipal.botonCargando(boton);
                }
            }).done(function (response) {
                if (response.error) {
                    sweetalert(response.error, 'error');
                } else {
                    sweetalert('PDF eliminada correctamente', 'success');
                    objFiltro.buscar();
                }
            }).fail(function (jqxhr) {
                sweetalert('Error en el proceso de ejecución', 'error');
            }).always(function () {
                objPrincipal.liberarBoton(boton);
            });
        }
    };

    /**
     * Carga la ficha del expediente
     * @see objLista.buscar
     */
    objLista.guardarFicha = function () {
        const form = $('form#frmFicha');
        const datos = new FormData(form[0]);
        const botonGuardar = $(this);
        const botonCancelar = $('#btnCancelarFicha');
        $.ajax({
            url: form.attr('action'),
            method: 'POST',
            data: datos,
            dataType: 'json',
            cache: false,
            contentType: false,
            processData: false,
            beforeSend: function () {
                botonCancelar.prop('disabled', true);
                objPrincipal.botonCargando(botonGuardar);
            }
        }).done(function (response) {
            if (response.error) {
                sweetalert(response.error, 'error');
            } else {
                sweetalert('Ficha cargada correctamente.', 'success');
                $('#modalSubirFicha').modal('hide');
                objFiltro.buscar();
            }
        }).fail(function (jqxhr) {
            sweetalert('Error en el proceso de ejecución', 'error');
        }).always(function () {
            botonCancelar.prop('disabled', false);
            objPrincipal.liberarBoton(botonGuardar);
        });
    };

    /**
     * Metodo para realizar la carga del pdf
     * @see objLista.buscar
     */
    objLista.guardarPDF = function () {
        const form = $('form#frmPDF');
        const datos = new FormData(form[0]);
        const botonGuardar = $(this);
        const botonCancelar = $('#btnCancelarPDF');
        $.ajax({
            url: form.attr('action'),
            method: 'POST',
            data: datos,
            dataType: 'json',
            cache: false,
            contentType: false,
            processData: false,
            beforeSend: function () {
                botonCancelar.prop('disabled', true);
                objPrincipal.botonCargando(botonGuardar);
            }
        }).done(function (response) {
            if (response.error) {
                sweetalert(response.error, 'error');
            } else {
                sweetalert('PDF cargada correctamente.', 'success');
                $('#modalSubirPDF').modal('hide');
                objFiltro.buscar();
            }
        }).fail(function (jqxhr) {
            sweetalert('Error en el proceso de ejecución', 'error');
        }).always(function () {
            botonCancelar.prop('disabled', false);
            objPrincipal.liberarBoton(botonGuardar);
        });
    };

    /**
     * Busca el expediente
     * @param idExpediente
     * @param boton
     */
    objLista.editar = function (idExpediente, boton) {
        if (objFiltro.cargando) {
            sweetalert('Aún existe una carga pediente, porfavor espere!', 'error');
        } else {
            objFiltro.cargando = true;
            boton = $(boton);
            objPrincipal.botonCargando(boton);
            objFiltro.recursoBuscar(idExpediente)
                .done(function (response) {
                    if (response.error) {
                        sweetalert(response.error, 'error');
                    } else {
                        // Imprime los datos a editar del expediente
                        const expediente = response.datos.expediente;
                        // Se busca los datos del proveedor
                        var proveedor = [];
                        var provContact1 = '';
                        var provEmail1 = '';
                        var provContact2 = '';
                        var provEmail2 = '';
                        if (response.datos.proveedor) {
                            proveedor = [{
                                id: response.datos.proveedor.id_proveedor,
                                'text': response.datos.proveedor.nombre
                            }];
                            provContact1 = response.datos.proveedor.contacto_p;
                            provEmail1 = response.datos.proveedor.email_p;
                            provContact2 = response.datos.proveedor.contacto_q;
                            provEmail2 = response.datos.proveedor.email_q;
                        }
                        // Datos del area
                        const area = (response.datos.area) ? [{
                            id: response.datos.area.id_area,
                            text: response.datos.area.nombre
                        }] : [];
                        objIngreso.imprimirDatos(
                            expediente.id_expediente,
                            'A',
                            moment(expediente.fecha, 'YYYY-MM-DD').format('DD/MM/YYYY'),
                            expediente.expediente,
                            proveedor,
                            provContact1,
                            provEmail1,
                            provContact2,
                            provEmail2,
                            area,
                            [{id: expediente.area_contacto, text: expediente.area_contacto}],
                            expediente.documentos
                        );
                        $('.contenedorItems').show();
                        objProducto.listaProductos();
                        $('#btnNuevoRegistro').click();
                    }
                })
                .fail(function (jqxhr) {
                    sweetalert('Error en el proceso de ejecución', 'error');
                })
                .always(function () {
                    objPrincipal.liberarBoton(boton);
                    objFiltro.cargando = false;
                });
        }
    };

    /**
     * Poder eliminar un expediente
     * @param idExpediente
     * @param boton
     */
    objLista.eliminar = function(idExpediente, boton) {
        if (objFiltro.cargando) {
            sweetalert('Aún existe una carga pediente, porfavor espere!', 'error');
        } else {
            objFiltro.cargando = true;
            boton = $(boton);
            objPrincipal.botonCargando(boton);
            Swal.fire({
                type: 'warning',
                title: 'Expediente',
                text: '¿Estas seguro(a) de eliminar el expediente?',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Si',
                cancelButtonText: 'No, deseo eliminar!'
            }).then(function(result) {
                const accept = (result && result.value);
                if (!accept) {
                    objPrincipal.liberarBoton(boton);
                    objFiltro.cargando = false;
                } else {
                    $.ajax({
                        url: BASE_URL + 'ar/evalprod/cexpediente/eliminar',
                        method: 'POST',
                        data: {
                            id: idExpediente
                        },
                        dataType: 'json'
                    }).done(function (response) {
                        if (response.error) {
                            sweetalert(response.error, 'error');
                        } else {
                            const message = (response && response.mensaje) ? response.mensaje : 'Eliminar correctamente.';
                            sweetalert(message, 'success');
                        }
                    }).fail(function () {
                        sweetalert('Error en el proceso de ejecución.', 'error');
                    }).always(function () {
                        objPrincipal.liberarBoton(boton);
                        objFiltro.cargando = false;
                        objFiltro.buscar();
                    });
                }
            })
        }
    };

});

$(document).ready(function () {

    objFiltro.buscar();

    $('#tabReg1-tab').click(objFiltro.refrescarLista);

    $('#btnGuardarFicha').click(objLista.guardarFicha);

    $('#btnGuardarPDF').click(objLista.guardarPDF);

    $('#modalSubirFicha').on('hidden.bs.modal', function () {
        $('#frmFicha').trigger("reset");
        $('#ficha_id_expediente').val(0);
    });

    $('#modalSubirPDF').on('hidden.bs.modal', function () {
        $('#frmPDF').trigger("reset");
        $('#pdf_id_expediente').val(0);
    });

});