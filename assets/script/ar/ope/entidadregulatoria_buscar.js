/*!
 *
 * @version 1.0.0
 * @author Anthony
 */

const s2EntidadRegulatoria = {

	/**
	 * Parametros a enviar en caso sea necesario
	 * @var object
	 */
	params: {
		grupo_empresarial: '',
	},
	/**
	 * Almacena la instancia del object select2
	 * @var Object
	 */
	select2: null,
	/**
	 * Almacena la última opción elegida
	 * @var Object
	 */
	selected: { id: 0, text: '' },
	/**
	 * Valida que solo se mande 1 sola vez los datos elegidos
	 * @var Number
	 */
	validate: 0,
	/**
	 * Elemento por defecto para cargar el select2
	 * @var string
	 */
	elDefault: 'select#grupo_empresarial_id[role=menuitem]'
};

$(function() {

	/**
	 * Inicializa la carga del select2
	 * @param el
	 * @returns {Object}
	 */
	s2EntidadRegulatoria.init = function (el) {
		// En caso no se envie el elemento, se toma uno por defecto
		el = (typeof el === 'undefined') ? $(s2EntidadRegulatoria.elDefault) : el;

		this.select2 = el.select2({
			ajax: {
				url: BASE_URL + 'ar/ope/centidadregulatoria/autocompletado',
				method: 'POST',
				dataType: 'json',
				delay: 250,
				data: function (params) {
					return {
						busqueda: params.term,
						params: s2EntidadRegulatoria.params
					};
				},
				processResults: function (data) {
					return {results: data.items};
				},
				cache: true
			},
			escapeMarkup: function (markup) {
				return markup;
			}, // let our custom formatter work
			minimumInputLength: 0,
			// Aqi se muestran todos los resultados de la busqueda
			templateResult: function (res) {
				// Se inicializa en 0 para poder usar la funcion __seleccionar_socioNegocio
				s2EntidadRegulatoria.selected.id = 0;
				s2EntidadRegulatoria.validate = 0;
				return res.text;
			},
			templateSelection: function (res) {
				if (res.id !== "") {
					// Solo se ejecuta cuando se realiza una busqueda
					if (s2EntidadRegulatoria.selected.id == 0) {
						// Solo cuando aun no es selccionado se marca.
						if (s2EntidadRegulatoria.validate == 0) {
							if (typeof __elegirEntidadRegulatoria == "function") {
								__elegirEntidadRegulatoria(res);
							}
						}
					}
					// Se cambia el estado para no voler a seleccionar
					s2EntidadRegulatoria.validate = 1;
					return res.text;
				} else {
					return 'Elegir';
				}
			},
			theme: 'bootstrap4',
			placeholder: "Search",
			allowClear: true,
			width: '100%'
		});

		return this.select2;
	};

});
