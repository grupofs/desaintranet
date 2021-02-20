/*!
 *
 * @version 1.0.0
 * @author Anthony
 */

const objGenerarProveedor = {};

$(function () {

    /**
     * Contenedor del modal
     * @var Object
     */
    objGenerarProveedor.modal = $('div#modalNuevoProveedor');

    objGenerarProveedor.cambiarTitulo = function (titulo) {
        objGenerarProveedor.modal.find('h5').html(titulo);
    };

    /**
     * Habre la venta emergente para crear un proveedor
     *
     * @see objGenerarProveedor.mostrar
     * @see objPrincipal.botonCargando
     * @see objGenerarProveedor.buscarPorId
     * @see objPrincipal.liberarBoton
     *
     * @param boton
     * @param id
     */
    objGenerarProveedor.abrir = function (boton, id) {
        id = (typeof id === 'undefined' || id == null || id == '') ? 0 : id;
        if (id <= 0) {
            objGenerarProveedor.cambiarTitulo('Registrar Proveedor');
            objGenerarProveedor.mostrar();
        } else {
            if (boton) {
                objPrincipal.botonCargando(boton);
            }
            objGenerarProveedor.buscarPorId(id)
                .done(function (response) {
                    objGenerarProveedor.cambiarTitulo('Editar Proveedor');
                    const proveedor = response.proveedor;
                    objGenerarProveedor.imprimirDatos(proveedor.id_proveedor, 'A', proveedor.nombre, proveedor.contacto_p, proveedor.email_p, proveedor.contacto_q, proveedor.email_q, proveedor.telefono, proveedor.ruc);
                    objGenerarProveedor.mostrar();
                })
                .always(function () {
                    if (boton) {
                        objPrincipal.liberarBoton(boton);
                    }
                });
        }
    };

    /**
     * Sirve para mostrar el modal
     */
    objGenerarProveedor.mostrar = function () {
        objGenerarProveedor.modal.modal('show');
    };

    /**
     * Sirve para cerrar el modal
     */
    objGenerarProveedor.cerrar = function () {
        objGenerarProveedor.modal.modal('hide');
    };

    /**
     * Se ejecuta cuando se oculta el modal
     * @see objGenerarProveedor.imprimirDatos
     */
    objGenerarProveedor.ocultar = function () {
        // Limpia los datos del formulario
        objGenerarProveedor.imprimirDatos(0, 'G', '', '', '', '', '', '', '');
        objGenerarProveedor.boton = null;
    };

    /**
     * Imprime datos de la ventana emergente
     * @param id
     * @param accion
     * @param proveedor
     * @param contactop
     * @param emailp
     * @param contactoq
     * @param emailq
     * @param telefono
     * @param ruc
     *
     * @void
     */
    objGenerarProveedor.imprimirDatos = function (id, accion, proveedor, contactop, emailp, contactoq, emailq, telefono, ruc) {
        $('#mhdnIdproveedor').val(id);
        $('#mhdnAccionprov').val(accion);
        $('#mtxtProveedor').val(proveedor);
        $('#mtxtContactop').val(contactop);
        $('#mtxtEmailp').val(emailp);
        $('#mtxtContactoq').val(contactoq);
        $('#mtxtEmailq').val(emailq);
        $('#mtxtTelefono').val(telefono);
        $('#mtxtRUC').val(ruc);
    };

    /**
     * Realiza la busqueda del proveedor por su ID
     * @param id
     * @returns {*}
     */
    objGenerarProveedor.buscarPorId = function (id) {
        return $.ajax({
            url: baseurl + 'ar/evalprod/cproveedor/buscar',
            method: 'POST',
            data: {
                id: id
            },
            dataType: 'json'
        }).fail(function (jqxhr) {
            sweetalert('Error al buscar el proveedor', 'error');
        });
    };

    /**
     * Crea o Edita un proveedor, depediendo de sus datos del formulario
     *
     * @see objPrincipal.botonCargando
     * @see objPrincipal.liberarBoton
     *
     * @void
     */
    objGenerarProveedor.guardar = function () {
        const boton = $(this);
        const formulario = $('form#frmRegProveedor');
        $.ajax({
            url: formulario.attr('action'),
            method: 'POST',
            data: formulario.serialize(),
            dataType: 'json',
            beforeSend: function () {
                objPrincipal.botonCargando(boton);
            }
        }).done(function (response) {
            if (response.error) {
                sweetalert(response.error, 'error');
            } else {
                sweetalert(response.mensaje, 'success');
                // Manda los datos del proveedor a la funcion "__guardarDatosProveedor"
                if (typeof __guardarDatosProveedor == "function") {
                    __guardarDatosProveedor(response.datos);
                }
                objGenerarProveedor.cerrar();
            }
        }).fail(function (jqxhr) {
            sweetalert('Error en el proceso de ejecución', 'error');
        }).always(function () {
            objPrincipal.liberarBoton(boton);
        });
    };

});

$(document).ready(function () {

    objGenerarProveedor.modal.on('hidden.bs.modal', function () {
        objGenerarProveedor.ocultar();
    });

    $('button#mbtnGuardarModalProv').click(objGenerarProveedor.guardar);

});
