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
        columnas.push({
            "orderable": false,
            render: function (data, type, row) {
                if (row.ruta_expediente != null) {
                    return '<div>' +
                        '<a href="' + BASE_URL + 'FTPfileserver/Archivos/' + row.ruta_expediente + '" target="_blank" title="Descargar PDF" class="btn btn-transparent text-danger"><i class="fa fa-file-pdf fa-2x" data-original-title="Descargar" data-toggle="tooltip"></i></a>' +
                        '</div>'
                }
            }
        });
        columnas.push({data: 'destado', orderable: false, targets: 8});
        return columnas;
    };

});

$(document).ready(function() {

    objFiltro.buscar();

});