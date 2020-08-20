/*
 *
 * @version 1.0.0
 * @author Anthony
 */

const objLista = {};

$(function() {

    /**
     * Obtiene las columnas de la lista
     * @returns {Array}
     */
    objFiltro.obtenerColumnas = function() {
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
        // Solo para evaluar
        columnas.push({
            "orderable": false,
            render: function (data, type, row) {
                return '<div class="text-left" >' +
                    '<button class="btn btn-transparent btn-sm text-primary" onClick="objLista.evaluar(\'' + row.id_expediente + '\', this);">' +
                    '<i class="fa fa-pencil-alt fa-2x" ></i>' +
                    '</button>' +
                    '</div>';
            }
        });
        columnas.push({
            "orderable": false,
            render: function (data, type, row) {
                return '<div class="text-left" >' +
                    '<button class="btn btn-transparent btn-sm text-secondary" onClick="objLista.email(\'' + row.id_expediente + '\', this);">' +
                    '<i class="fa fa-envelope fa-2x" ></i>' +
                    '</button>' +
                    '</div>';
            }
        });
        columnas.push({
            "orderable": false,
            render: function (data, type, row) {
                return '<div class="text-left" >' +
                    '<button class="btn btn-transparent" onClick="objLista.verEstados(\'' + row.id_expediente + '\', \'' + row.expediente + '\', this);">' +
                    '<i class="fa fa-eye fa-1x" ></i> ' + row.destado +
                    '</button>' +
                    '</div>';
            }
        });

        return columnas;
    };

    /**
     * Formulario para evaluar el expedite
     * @param idExpediente
     * @param boton
     */
    objLista.evaluar = function (idExpediente, boton) {
        if (objFiltro.cargando) {
            sweetalert('Aún existe una carga pediente, porfavor espere!', 'error');
        } else {
            objFiltro.cargando = true;
            boton = $(boton);
            objPrincipal.botonCargando(boton);
            $.when(
                $.ajax({
                    url: BASE_URL + 'ar/evalprod/cexpediente/buscar/' + idExpediente,
                    method: 'GET',
                    data: {},
                    dataType: 'json'
                }),
                $.ajax({
                    url: BASE_URL + 'ar/evalprod/cexpediente/lista_productos/',
                    method: 'POST',
                    data: {
                        id_expediente: idExpediente
                    },
                    dataType: 'json'
                })
            ).then(function(res1, res2) {
                const expediente = res1[0].datos.expediente;
                const proveedor = (res1[0].datos.proveedor) ? res1[0].datos.proveedor.nombre : '';
                const idProveedor = (res1[0].datos.proveedor) ? res1[0].datos.proveedor.id_proveedor : '';
                const productos = res2[0];
                objFormulario.imprimir(
                    expediente.id_expediente,
                    expediente.expediente,
                    moment(expediente.fecha, 'YYYY-MM-DD').format('DD/MM/YYYY'),
                    proveedor,
                    idProveedor
                );
                objProducto.imprimirTodosProductos(productos);
                objFormulario.mostrarFormulario();
                objPrincipal.liberarBoton(boton);
                objFiltro.cargando = false;
            });
        }
    };

    /**
     * Muestra la cantidad de cada estado del expediente
     * @param idExpediente
     * @param expediente
     * @param boton
     */
    objLista.verEstados = function (idExpediente, expediente, boton) {
        if (objFiltro.cargando) {
            sweetalert('Aún existe una carga pediente, porfavor espere!', 'error');
        } else {
            objFiltro.cargando = true;
            const container = $('#estadoEvaluacionModal');
            boton = $(boton);
            objPrincipal.botonCargando(boton);
            $.ajax({
                url: BASE_URL + 'ar/evalprod/cevaluar/buscar_estados/' + idExpediente,
                method: 'GET',
                data: {},
                dataType: 'json'
            }).done(function (res) {
                container.find('h5.modal-title').text('Expediente ' + expediente);
                const items = res.items;
                const empty = items.find(function (item) {
                    return (item.flagEstado == null);
                });
                const progreso = items.find(function (item) {
                    return (item.flagEstado == 0);
                });
                const aprobado = items.find(function (item) {
                    return (item.flagEstado == 1);
                });
                const rechazado = items.find(function (item) {
                    return (item.flagEstado == 2);
                });
                const observado = items.find(function (item) {
                    return (item.flagEstado == 3);
                });
                const pendiente = items.find(function (item) {
                    return (item.flagEstado == 4);
                });
                const totalEmpty = (empty) ? empty.total : 0;
                const elEmpty = $('#evaluar-status-vacio');
                elEmpty.hide();
                if (totalEmpty > 0) {
                    elEmpty.find('span').text(totalEmpty);
                    elEmpty.show();
                }
                $('#evaluar-status-progreso').find('.badge').text((progreso) ? progreso.total : 0);
                $('#evaluar-status-aprobado').find('.badge').text((aprobado) ? aprobado.total : 0);
                $('#evaluar-status-rechazado').find('.badge').text((rechazado) ? rechazado.total : 0);
                $('#evaluar-status-observado').find('.badge').text((observado) ? observado.total : 0);
                $('#evaluar-status-pendiente').find('.badge').text((pendiente) ? pendiente.total : 0);
                container.modal('show');
            }).fail(function () {
                sweetalert('Error en el proceso de ejecución', 'error');
            }).always(function () {
                objPrincipal.liberarBoton(boton);
                objFiltro.cargando = false;
            });
        }
    };

    /**
     * Poder enviar un correo del expediente
     * @param idExpediente
     */
    objLista.email = function (idExpediente) {
        console.log(idExpediente);
    };

});

$(document).ready(function() {

    objFiltro.buscar();

});