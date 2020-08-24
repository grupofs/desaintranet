/*!
 *
 * @version 1.0.0
 * @author Anthony
 */

const objProducto = {};

$(function() {

    /**
     * Imprime las páginas a partir de los productos
     * @param productos
     */
    objProducto.imprimirTodosProductos = function(productos) {
        this.productos = [];
        var paginas = '';
        if (Array.isArray(productos)) {
            this.productos = productos;
            const total = productos.length;
            const deshabilitar = (total <= 1) ? 'disabled' : '';
            paginas += '<li class="page-item"><button type="button" class="btn page-link producto-anterior" ' + deshabilitar + ' >Anterior</button></li>';
            this.productos.forEach(function(producto, pos) {
                paginas += '<li class="page-item" ><button type="button" class="btn page-link producto-elegir" data-id="' + producto.id_producto + '" >' + (pos + 1) + '</button></li>';
            });
            paginas += '<li class="page-item"><button type="button" class="btn page-link producto-siguiente" ' + deshabilitar + ' >Siguiente</button></li>';
        }
        $('#todosProductos').html(paginas);
        const contenedorEvaluar = $('#contenedorEvaluar');
        if (this.productos.length) {
            contenedorEvaluar.show();
            $('button.producto-elegir[data-id="'+ this.productos[0].id_producto + '"]').click();
        } else {
            contenedorEvaluar.hide();
        }
    };

    /**
     * Realiza la busqueda del producto y desahiblita los botons
     * Imprime los datos del producto buscado
     */
    objProducto.elegir = function() {
        const boton = $(this);
        const id = parseInt(boton.data('id'));
        objEvaluar.buscar(id, boton);
    };

    /**
     * Marca el producto elegido, desmarcando los demas
     *
     * @param idProducto
     */
    objProducto.marcar = function(idProducto) {
        $('#todosProductos').find('li').each(function(pos, lista) {
            lista = $(lista);
            lista.removeClass('active');
            const boton = lista.find('button.btn');
            const id = parseInt(boton.data('id'));
            if (id === parseInt(idProducto)) {
                lista.addClass('active');
            }
        });
    };

    /**
     * Imprime los datos del producto y marca el producto
     * @param producto
     */
    objProducto.imprimir = function(producto) {
        objProducto.marcar(producto.id_producto);
        $('#mhdnIdproductos').val(producto.id_producto).prop('disabled', false);
        $('#mtxtCodigoean').val(producto.codigo).prop('disabled', false);
        $('#mtxtDescrip').val(producto.descripcion).prop('disabled', false);
        $('#mtxtMarca').val(producto.marca).prop('disabled', false);
        $('#mtxtPresent').val(producto.presentacion).prop('disabled', false);
        $('#mtxtFabri').val(producto.fabricante).prop('disabled', false);
        $('#cboTipodoc').val(producto.tipo_codigo).change();
        $('#mtxtNrodoc').val(producto.rs).prop('disabled', false);
        $('#FechaEmi').val(producto.fecha_emision).prop('disabled', false);
        $('#FechaVence').val(producto.fecha_vcto).prop('disabled', false);
        const fechaEval = (producto.f_evaluado) ? moment(producto.f_evaluado, 'YYYY-MM-DD').format('DD/MM/YYYY') : '';
        $('#FechaEval').val(fechaEval).prop('disabled', false);
        const fechaLevanta = (producto.f_levantamiento) ? moment(producto.f_levantamiento, 'YYYY-MM-DD').format('DD/MM/YYYY') : '';
        $('#FechaLevanta').val(fechaLevanta).prop('disabled', false);
        $('#cboGrasaSatu').val(producto.grasas_saturadas).change().prop('disabled', false);
        $('#cboAzucar').val(producto.azucar).change().prop('disabled', false);
        $('#cboSodio').val(producto.sodio).change().prop('disabled', false);
        $('#cboGrasaTrans').val(producto.grasas_trans).change().prop('disabled', false);
        $('#mtxtObserva').val(producto.observacion).prop('disabled', false);
        $('#mtxtObservaCli').val(producto.observacion_cli).prop('disabled', false);
        const tiempoEval = (producto.tiempo_evaluacion) ? parseInt(producto.tiempo_evaluacion) : 0;
        $('#mtxtTiempoEval').val(tiempoEval).prop('disabled', false);
    };

    /**
     * Guarda la evaluación del producto
     */
    objProducto.guardar = function() {
        const botonProductos = $('#todosProductos').find('button.btn');
        const botonActualizar = $('#btnActualizarProducto');
        const botonRetornar = $('#btnRetornarLista');
        const form = $('form#frmMantProducto');
        $.ajax({
            url: form.attr('action'),
            method: 'POST',
            data: form.serialize() + '&hdnIdexpe=' + $('#hdnIdexpe').val() + '&mhdnIdproductos=' + $('#mhdnIdproductos').val(),
            dataType: 'json',
            beforeSend: function() {
                objPrincipal.botonCargando(botonActualizar);
                botonRetornar.prop('disabled', true);
                botonProductos.prop('disabled', true);
            }
        }).done(function (response) {
            if (response.error) {
                sweetalert(response.error, 'error');
            } else {
                sweetalert('Producto actualizado correctamente.', 'success');
            }
        }).fail(function (jqxhr) {
            sweetalert('Error en el proceso de ejecución', 'error');
        }).always(function () {
            objPrincipal.liberarBoton(botonActualizar);
            botonProductos.prop('disabled', false);
            botonRetornar.prop('disabled', false);
        });
    };

    /**
     * Boton para el siguiente
     */
    objProducto.siguiente = function() {
        var siguienteBoton = null;
        $('.producto-elegir').each(function(post, boton) {
            boton = $(boton);
            const lista = $(boton.parent('li'));
            if (lista.hasClass('active')) {
                // Sirve para indicar que la siguiente lista es la adectuada
                const siguienteLista = lista.next('.page-item');
                if (siguienteLista.length) {
                    siguienteBoton = siguienteLista.find('button.producto-elegir');
                    if(siguienteBoton.length <= 0) {
                        siguienteBoton = null;
                    }
                }
                return false;
            }
        });
        if (siguienteBoton) {
            objEvaluar.buscar(siguienteBoton.data('id'), siguienteBoton);
        }
    };

    /**
     * Sirve para volver al boton anterior
     */
    objProducto.anterior = function() {
        var anteriorBoton = null;
        $('.producto-elegir').each(function(post, boton) {
            boton = $(boton);
            const lista = $(boton.parent('li'));
            if (lista.hasClass('active')) {
                // Sirve para indicar que la siguiente lista es la adectuada
                const siguienteLista = lista.prev('.page-item');
                if (siguienteLista.length) {
                    anteriorBoton = siguienteLista.find('button.producto-elegir');
                    if(anteriorBoton.length <= 0) {
                        anteriorBoton = null;
                    }
                }
                return false;
            }
        });
        if (anteriorBoton) {
            objEvaluar.buscar(anteriorBoton.data('id'), anteriorBoton);
        }
    };

});

$(document).ready(function() {

    $('button#btnActualizarProducto').click(objProducto.guardar);

    $(document).on('click', '.producto-elegir', objProducto.elegir);

    $(document).on('click', '.producto-siguiente', objProducto.siguiente);

    $(document).on('click', '.producto-anterior', objProducto.anterior);

});