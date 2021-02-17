/*!
 *
 * @version 1.0.0
 * @author Anthony
 */

const objFormulario = {
    /**
     * Todos los productos del expedientes
     * @var {Array}
     */
    productos: [],
    /**
     * ID del producto
     * @var {Number}
     */
    productoActual: 0
};

$(function() {

    /**
     * Mostrar lista del formulario de evaluación
     */
    objFormulario.cambiarLista = function () {
        const boton = $('#btnAccionContenedorLista');
        const icon = boton.find('i');
        const contenidoLista = $('#contenidoLista');
        if (icon.hasClass('fa-plus')) {
            contenidoLista.show();
        } else {
            contenidoLista.hide();
        }
    };

    /**
     * Muestra la lista ocultando el formulario
     */
    objFormulario.mostrarLista = function () {
        const boton = $('#btnAccionContenedorLista');
        const icon = boton.find('i');
        if (icon.hasClass('fa-minus')) icon.removeClass('fa-minus');
        icon.addClass('fa-plus');
        boton.click();
        $('#contenedorFormulario').hide();
        objFiltro.buscar()
    };

    /**
     * Muestra el formulario ocultando la lista
     */
    objFormulario.mostrarFormulario = function () {
        const boton = $('#btnAccionContenedorLista');
        const icon = boton.find('i');
        if (icon.hasClass('fa-plus')) icon.removeClass('fa-plus');
        icon.addClass('fa-minus');
        boton.click();
        $('#contenedorFormulario').show();
    };

    /**
     * Imprime los datos del expediente
     * @param id
     * @param expediente
     * @param fecha
     * @param proveedor
     * @param idProveedor
     */
    objFormulario.imprimir = function(id, expediente, fecha, proveedor, idProveedor) {
        $('#hdnIdexpe').val(id);
        $('#txtFecha').val(fecha);
        $('#txtCodigoExpediente').val(expediente);
        $('#txtProveedor').val(proveedor);
        $('#id_proveedor').val(idProveedor);
    };

    /**
     * Editar el proveedor de la evaluación
     */
    objFormulario.editarProveedor = function() {
        objGenerarProveedor.abrir($(this), $('#id_proveedor').val());
    };

	/**
	 * Realiza el cambio de proveedor
	 */
	objFormulario.cambiarProveedor = function() {
		const boton = $(this);
		$.ajax({
			url: BASE_URL + 'ar/evalprod/cevaluar/cambiar_proveedor',
			method: 'POST',
			data: {
				id_expediente: $('#hdnIdexpe').val(),
				id_proveedor: $('#cambiar_proveedor_id').val(),
			},
			dataType: 'json',
			beforeSend: function() {
				objPrincipal.botonCargando(boton);
			}
		}).done(function() {
			location.reload();
		}).fail(function() {
			objPrincipal.notify('error', 'Error al actualizar el proveedor');
		}).always(function() {
			objPrincipal.liberarBoton(boton);
		});
	};

});

$(document).ready(function() {

    $('#btnAccionContenedorLista').click(objFormulario.cambiarLista);

    $('button#btnRetornarLista').click(objFormulario.mostrarLista);

    s2Pais.init($('#cboPais'));

    $('button#btnEditarProveedor').click(objFormulario.editarProveedor);

    s2Proveedor.init($('#cambiar_proveedor_id'));

    $('#btnCambiarProveedor').click(objFormulario.cambiarProveedor);

});

function __guardarDatosProveedor(datos)
{
    $('#txtProveedor').val(datos.nombre);
}
