/*!
 *
 * @version 1.0.0
 * @author Anthony
 */

const objIngreso = {};

$(function () {

    /**
     * Muestra la ventana de crear y editar
     */
    objIngreso.mostrarVenta = function () {
        $('#tabReg2-tab').click();
    };

    /**
     * Meotod para retornar a la lista
     */
    objIngreso.retornarLista = function () {
        objIngreso.limpiarDatos();
        $('#tabReg1-tab').click();
    };

    /**
     * Limpia los datos del ingreso de expediente
     */
    objIngreso.limpiarDatos = function() {
        objIngreso.imprimirDatos(
            0,
            'G',
            moment().format('DD/MM/YYYY'),
            '',
            [],
            '',
            '',
            '',
            '',
            [],
            [],
            '1'
        );
        $('.contenedorItems').hide();
        objProducto.items = [];
        $('#tbllistproductos').DataTable({
            'bJQueryUI': true,
            'scrollY': '400px',
            'scrollX': true,
            'processing': true,
            'bDestroy': true,
            'paging': false,
            'info': true,
            'filter': true
        }).clear().draw();
    };

    /**
     * Imprime los datos del expediente
     * @param id
     * @param accion
     * @param fecha
     * @param expediente
     * @param proveedor
     * @param provContacto1
     * @param provEmail1
     * @param provContacto2
     * @param provEmail2
     * @param area
     * @param contactoTottus
     * @param documentos
     */
    objIngreso.imprimirDatos = function (id, accion, fecha, expediente, proveedor, provContacto1, provEmail1, provContacto2, provEmail2, area, contactoTottus, documentos) {
        $('#hdnIdexpe').val(id);
        $('#hdnAccion').val(accion);
        $('#FechaReg').val(fecha);
        $('#txtexpe').val(expediente);
        $('#cboProveedorreg').refreshSelect2(proveedor);
        if (Array.isArray(proveedor) && proveedor.length) {
            $('#btnNuevoProveedor').html('<i class="fa fa-edit"></i> Editar');
            $('#mhdnIdproveedor').val(proveedor[0].id);
            $('#mhdnAccionprov').val('A');
        } else {
            $('#btnNuevoProveedor').html('<i class="fa fa-plus"></i> Crear');
        }
        $('input#txtcontac1').val(provContacto1);
        $('input#txtemail1').val(provEmail1);
        $('input#txtcontac2').val(provContacto2);
        $('input#txtemail2').val(provEmail2);
        $('#cboAreareg').refreshSelect2(area);
        $('#cboContacto').refreshSelect2(contactoTottus);
        documentos = (!documentos) ? [] : documentos.split('-');
        for(var pos = 0; pos <= 6; pos++) {
            const currentPos = pos;
            const buscarDocumento = documentos.find(function(documento) { return parseInt(documento) === parseInt((currentPos + 1)) }, 0);
            $(document.getElementById('documentos[' + pos + ']')).prop('checked', typeof buscarDocumento !== 'undefined');
        }
    };

    /**
     * Imprime los datos de un proveedor elegido
     * @param datos
     */
    objIngreso.imprimirDatosProveedor = function (datos) {
        $('input#txtcontac1').val(datos.contacto_p);
        $('input#txtemail1').val(datos.email_p);
        $('input#txtcontac2').val(datos.contacto_q);
        $('input#txtemail2').val(datos.email_q);
        $('#btnNuevoProveedor').html('<i class="fa fa-edit"></i> Editar');
    };

    /**
     * Cambio de proveedor
     */
    objIngreso.cambioProveedor = function () {
        const value = $(this).val();
        if (!value) {
            $('input#txtcontac1').val('');
            $('input#txtemail1').val('');
            $('input#txtcontac2').val('');
            $('input#txtemail2').val('');
            $('#btnNuevoProveedor').html('<i class="fa fa-plus"></i> Crear');
        }
    };

    /**
     * Crea o Edita el registro de expedientes
     */
    objIngreso.guardar = function () {
        const botonRetornar = $('#btnRetornarLista');
        const botonGuardar = $('#btnGrabar');
        const formulario = $('form#frmMantRegistro');
        $.ajax({
            url: formulario.attr('action'),
            method: 'POST',
            data: formulario.serialize(),
            dataType: 'json',
            beforeSend: function () {
                botonRetornar.prop('disabled', true);
                objPrincipal.botonCargando(botonGuardar);
            }
        }).done(function (response) {
            if (response.error) {
                sweetalert(response.error, 'error');
            } else {
                const datos = response.datos;
                $('input#hdnAccion').val('A');
                $('input#txtexpe').val(datos.expediente);
                $('input#hdnIdexpe').val(datos.id_expediente);
                sweetalert(datos.respuesta, 'success');
                $('.contenedorItems').show();
            }
        }).fail(function (jqxhr) {
            sweetalert('Error en el proceso de ejecución', 'error');
        }).always(function () {
            botonRetornar.prop('disabled', false);
            objPrincipal.liberarBoton(botonGuardar);
        });
    };

});

$(document).ready(function () {

    $('#btnNuevoRegistro').click(objIngreso.mostrarVenta);

    s2Proveedor.init($('select#cboProveedorreg'));
    s2Area.init($('#cboAreareg'));
    s2ContacTottus.init($('#cboContacto'));

    $('#btnRetornarLista').click(objIngreso.retornarLista);

    $('#cboProveedorreg').change(objIngreso.cambioProveedor);

    $('#btnNuevoProveedor').click(function () {
        objGenerarProveedor.abrir($(this), $('#cboProveedorreg').val());
    });

    $('button#btnGrabar').click(objIngreso.guardar);

});

function __elegirArea(data) {
    $('#cboContacto').refreshSelect2([]);
    s2ContacTottus.params.idarea = data.id;
}

function __elegirProveedor(datos) {
    const el = $(datos.element);
    const nombreID = el.parent('select').attr('id');
    if (nombreID == 'cboProveedorreg') {
        objIngreso.imprimirDatosProveedor(datos);
    }
}

function __guardarDatosProveedor(datos) {
    $('select#cboProveedorreg').refreshSelect2([{id: datos.id_proveedor, text: datos.nombre}]);
    objIngreso.imprimirDatosProveedor(datos);
}
