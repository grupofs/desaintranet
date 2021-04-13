/*!
 *
 * @version 1.0.0
 * @author Anthony
 */

const objGenerar = {};

$(function() {

    /**
     * Regresa la lista de areas
     */
    objGenerar.regresarLista = function() {
        objGenerar.abrir(0, '', []);
        $('#tabReg1-tab').click();
    };

    /**
     * Habre el menu para crear o editar el área
     * @param id
     * @param nombreArea
     * @param estadoArea
     * @param contactos
     */
    objGenerar.abrir = function(id, nombreArea, estadoArea, contactos) {
        $('#area_id').val(id);
        $('#area_nombre').val(nombreArea);
        $('#area_estado').val(estadoArea).change();
        var filas = '';
        if (contactos && contactos.length) {
            contactos.forEach(function(item, i) {
                filas += objGenerar.contacto(
                    i, // posicion
                    item.id_contacto,
                    item.contacto,
                    item.email,
                    item.estado,
                    1 // será editado
                );
            });
        }
        $('table#tblContacto tbody').html(filas);
    };

    /**
     * Agregar nuevo contacto
     */
    objGenerar.nuevoContacto = function() {
        const tabla = $('table#tblContacto tbody');
        const pos = tabla.find('tr').length;
        tabla.append(objGenerar.contacto(pos, 0, '', '', 'A', 0));
        $(document.getElementById('contacto_nombre[' + pos + ']')).focus();
    };

    /**
     * Formulario para el contacto
     *
     * @param pos
     * @param id
     * @param contacto
     * @param email
     * @param estado
     * @param operacion
     * @returns {string}
     */
    objGenerar.contacto = function(pos, id, contacto, email, estado, operacion) {
        var elegirActivo = (estado == "A") ? 'selected' : '';
        var elegirInactivo = (estado == "I") ? 'selected' : '';
        return '<tr data-position="' + pos + '" >' +
        '<td class="text-left" >' +
        '<input type="text" class="form-control" id="contacto_nombre[' + pos + ']" name="contacto_nombre[' + pos + ']" maxlength="200" value="' + contacto + '" />' +
        '</td>' +
        '<td class="text-left" >' +
        '<input type="text" class="form-control" id="contacto_email[' + pos + ']" name="contacto_email[' + pos + ']" maxlength="100" value="' + email + '" />' +
        '</td>' +
        '<td class="text-left" >' +
        '<select class="custom-select" id="contacto_estado[' + pos + ']" name="contacto_estado[' + pos + ']" >' +
        '<option value="A" ' + elegirActivo + ' >Activo</option>' +
        '<option value="I" ' + elegirInactivo + ' >Inactivo</option>' +
        '</select>' +
        '</td>' +
        '<td class="text-center" >' +
        '<button type="button" role="button" class="btn btn-danger eliminar-contacto" >' +
        '<i class="fa fa-trash" ></i>' +
        '</button>' +
        '<input type="hidden" class="d-none" id="contacto_id[' + pos + ']" name="contacto_id[' + pos + ']" maxlength="0" value="' + id + '" />' +
        '<input type="hidden" class="d-none" id="contacto_operacion[' + pos + ']" name="contacto_operacion[' + pos + ']" maxlength="0" value="' + operacion + '" />' +
        '</td>' +
        '</tr>';
    };

    /**
     * Crear nueva área
     */
    objGenerar.guardar = function() {
        const boton = $(this);
        const formulario = $('form#frmRegArea');
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
                objGenerar.regresarLista();
            }
        }).fail(function (jqxhr) {
            sweetalert('Error en el proceso de ejecución', 'error');
        }).always(function () {
            objPrincipal.liberarBoton(boton);
        });
    };

    /**
     * Elimina un contacto
     */
    objGenerar.eliminarContacto = function() {
        const boton = $(this);
        const fila = boton.parents('tr');
        const pos = fila.data('position');
        const id = parseInt(document.getElementById('contacto_id[' + pos + ']').value);
        document.getElementById('contacto_operacion[' + pos + ']').value = (id > 0) ? 2 : 3;
        fila.hide();
    };

});

$(document).ready(function() {

    $('#btnAgregarContacto').click(objGenerar.nuevoContacto);

    $('#btnRetornarLista').click(objGenerar.regresarLista);

    $('#btnGrabar').click(objGenerar.guardar);

    $(document).on('click', '.eliminar-contacto', objGenerar.eliminarContacto);

});
