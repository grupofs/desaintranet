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
     * Busqueda de proveedores
     */
    objLista.buscar = function () {
        if (objLista.cargando) {
            sweetalert('Aún existe una carga pediente, porfavor espere!', 'error');
        } else {
            if (objLista.oTableLista) {
                objLista.oTableLista.ajax.reload(null, false);
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
                        "url": BASE_URL + "ar/evalprod/cproveedor/lista",
                        "type": "GET",
                        "data": function (d) {
                            d.nombre = $('#txtNombre').val();
                            d.ruc = $('#txtRuc').val();
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
                        {data: 'nombre', orderable: false, targets: 2},
                        {data: 'contacto_p', orderable: false, targets: 3},
                        {data: 'email_p', orderable: false, targets: 4},
                        {data: 'contacto_q', orderable: false, targets: 5},
                        {data: 'email_q', orderable: false, targets: 5},
                        {data: 'telefono', orderable: false, targets: 5},
                        {data: 'ruc', orderable: false, targets: 5},
                        {
                            "orderable": false,
                            render: function (data, type, row) {
                                return '<div class="text-left" >' +
                                    '<button class="btn btn-transparent text-success btn-sm" onClick="objLista.editar(\'' + row.id_proveedor + '\',this);">' +
                                    '<i class="fa fa-edit fa-2x" ></i>' +
                                    '</button>' +
                                    '</div>';
                            }
                        }
                    ],
                    "columnDefs": [
                        {
                            "defaultContent": " ",
                            "targets": "_all"
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
        }
    };

    /**
     * Crea un nuevo proveedor
     */
    objLista.crearProveedor = function () {
        objGenerarProveedor.abrir($(this), 0);
    };

    /**
     * Poder editar el proveedor
     * @param id
     * @param boton
     */
    objLista.editar = function(id, boton) {
        objGenerarProveedor.abrir($(boton), id);
    };

});

$(document).ready(function () {

    objLista.buscar();

    $('#btnBuscar').click(objLista.buscar);

    $('#btnNuevoProveedor').click(objLista.crearProveedor);

});

function __guardarDatosProveedor() {
    objLista.buscar();
}