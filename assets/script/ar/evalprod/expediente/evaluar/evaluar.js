/*!
 *
 * @version 1.0.0
 * @author Anthony
 */

const objEvaluar = {};

$(function() {

    /**
     * Realiza la busqueda del producto y su evaluacion
     * @param idProducto
     * @param boton
     */
    objEvaluar.buscar = function(idProducto, boton) {
        const botonProductos = $('#todosProductos').find('button.btn');
        const botonActualizar = $('#btnActualizarProducto');
        const botonRetornar = $('#btnRetornarLista');
        const botonEvaluar = $('#btnEvaluacion');
        // Realizar la carga de los botones
        objPrincipal.botonCargando(boton);
        botonRetornar.prop('disabled', true);
        botonActualizar.prop('disabled', true);
        botonProductos.prop('disabled', true);
        botonEvaluar.prop('disabled', true);
        $.when(
            $.ajax({
                url: BASE_URL + 'ar/evalprod/cexpediente/buscar_producto/' + idProducto,
                method: 'GET',
                data: {},
                dataType: 'json'
            }).fail(function (jqxhr) {
                sweetalert('Error en el proceso de ejecución', 'error');
            }),
            $.ajax({
                url: BASE_URL + 'ar/evalprod/cevaluar/buscar/',
                method: 'POST',
                data: {
                    id_expediente: $('#hdnIdexpe').val(),
                    id_producto: idProducto
                },
                dataType: 'json'
            }).fail(function (jqxhr) {
                sweetalert('Error en el proceso de ejecución', 'error');
            })
        ).then(function (res1, res2) {
            const producto = res1[0].datos.producto;
            const evaluacion = res2[0].datos.evaluacion;
            objProducto.imprimir(producto);
            objEvaluar.imprimir(evaluacion);
            // Libera los botones
            objPrincipal.liberarBoton(boton);
            botonRetornar.prop('disabled', false);
            botonActualizar.prop('disabled', false);
            botonProductos.prop('disabled', false);
            botonEvaluar.prop('disabled', false);
        });
    };

    /**
     * Imprime los datos de la evaluación
     * @param evaluacion
     */
    objEvaluar.imprimir = function(evaluacion) {
        $('#id_evaluador').val(evaluacion.id_evaluador);
        $('#cboc_f').val(evaluacion.c_f).change();
        $('#cbon_r').val(evaluacion.n_r).change();
        $('#cbof_v').val(evaluacion.f_v).change();
        $('#cboc_l_p').val(evaluacion.c_l_p).change();
        $('#cbol_i').val(evaluacion.l_i).change();
        $('#cboc_c_p').val(evaluacion.c_c_p).change();
        $('#mtxtc_c').val(evaluacion.c_c);
        $('#mtxtc_c_r').val(evaluacion.c_c_r);
		if (evaluacion.textPais) {
			$('#cboPais').refreshSelect2([{ id: evaluacion.pais, text: evaluacion.textPais }]);
		} else {
			$('#cboPais').refreshSelect2();
		}
        $('#cboc_n').val(evaluacion.c_n).change();
        $('#cbod_i').val(evaluacion.d_i).change();
        $('#mtxtt_v_u').val(evaluacion.t_v_u);
        $('#cbotiempo_m').val(evaluacion.tiempo_m).change();
        $('#Fechaf_i_h').val(evaluacion.f_i_h);
        $('#mtxtentidad').val(evaluacion.entidad);
        $('#mtxtresponsable').val(evaluacion.responsable);

        const elObseracion = $('#mtxtobservacion');
        const elAcuerdos = $('#mtxtacuerdos');
        const configuration = {
            lang: 'es-ES',
            height: '220px',
            codemirror: { // codemirror options
                theme: 'cerulean'
            },
            toolbar: [
                ['style', ['fontname', 'bold', 'italic', 'underline', 'clear']],
                ['font', ['strikethrough', 'superscript', 'subscript']],
                ['fontsize', ['fontsize']],
                ['color', ['color']],
                ['para', ['style', 'ul', 'ol', 'paragraph']],
                ['height', ['height']],
                ['insert', ['table', 'hr']],
                ['view', ['fullscreen']]
            ]
        };
        elObseracion.summernote(configuration);
        elObseracion.summernote('code', evaluacion.observacion);
        elAcuerdos.summernote(configuration);
        elAcuerdos.summernote('code', evaluacion.acuerdo);

        const valorFecha = (evaluacion.fecha) ? moment(evaluacion.fecha, 'YYYY-MM-DD') : moment();
		$('#Fechafecha').val(valorFecha.format('DD/MM/YYYY'));

        $('#cbostatus').val(evaluacion.status).change();
        $('#cboa_s').val(evaluacion.a_s).change();
        $('#mtxtf_e_a_s').val(evaluacion.f_e_a_s);
        $('#mtxtf_a_v_s').val(evaluacion.f_a_v_s);
        $('#cbod_p').val(evaluacion.d_p).change();
        $('#cboo_l').val(evaluacion.o_l).change();
        $('#cboo_n').val(evaluacion.o_n).change();
    };

	/**
	 * Activa plugin para libreria summernote
	 */
	objEvaluar.activarSummerNote = function() {
		const configuration = {
			lang: 'es-ES',
			height: '220px',
			codemirror: { // codemirror options
				theme: 'cerulean'
			},
			toolbar: [
				['style', ['fontname', 'bold', 'italic', 'underline', 'clear']],
				['font', ['strikethrough', 'superscript', 'subscript']],
				['fontsize', ['fontsize']],
				['color', ['color']],
				['para', ['style', 'ul', 'ol', 'paragraph']],
				['height', ['height']],
				['insert', ['table', 'hr']],
				['view', ['fullscreen']]
			]
		};
		$('#mtxtobservacion').summernote(configuration);
		$('#mtxtacuerdos').summernote(configuration);
	};

    /**
     * Guardar la evaluacion del expediente por el producto
     */
    objEvaluar.guardar = function() {
        const botonProductos = $('#todosProductos').find('button.btn');
        const botonEvaluar = $('#btnEvaluacion');
        const botonActualizar = $('#btnActualizarProducto');
        const botonRetornar = $('#btnRetornarLista');
        const form = $('form#frmMantEvaluar');
        $.ajax({
            url: form.attr('action'),
            method: 'POST',
            data: form.serialize() + '&hdnIdexpe=' + $('#hdnIdexpe').val() + '&mhdnIdproductos=' + $('#mhdnIdproductos').val(),
            dataType: 'json',
            beforeSend: function() {
                objPrincipal.botonCargando(botonEvaluar);
                botonRetornar.prop('disabled', true);
                botonProductos.prop('disabled', true);
                botonActualizar.prop('disabled', true);
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
            objPrincipal.liberarBoton(botonEvaluar);
            botonProductos.prop('disabled', false);
            botonRetornar.prop('disabled', false);
            botonActualizar.prop('disabled', false);
        });
    };

    objEvaluar.cambiarEstado = function() {
        const el = $(this);
        el.select2({  })
    };

	objEvaluar.valorDefectoCondConsProduc = function() {
		const value = parseInt($(this).val());
		if (value === 1) {
			$('#mtxtc_c').val("Almacenamiento:\rProducto (según rotulado):");
		}
	};

});

$(document).ready(function() {

	objEvaluar.activarSummerNote();

    $('button#btnEvaluacion').click(objEvaluar.guardar);

    //$('#cbostatus').change(objEvaluar.cambiarEstado);

	$('#cboc_c_p').change(objEvaluar.valorDefectoCondConsProduc);

});
