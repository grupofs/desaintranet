/*!
 *
 * @version 1.0.0
 */

const objDasborad = {};

$(function() {

	objDasborad.getData = function() {
		return {
			anio: $('#anio').val(),
			mes: $('#mes').val(),
		}
	};

	/**
	 * Busqueda resultado
	 */
	objDasborad.tendenciaAnualRendi = function() {
		$.ajax({
			url: baseurl + 'ar/evalprod/cdashboard/get_tendencia_anual_rendi',
			data: objDasborad.getData(),
			method: 'POST',
			dataType: 'json',
			beforeSend: function() {},
		}).done(function(resp) {
			const result = objDasborad.tendenciaAnualRendiTabla(resp.data);
			objDasborad.tendenciaAnualRendiGrafico(result.meses, result.indicador);
		}).fail(function() {
			console.log('error');
		});
	};

	/**
	 * Impresion en la tabla
	 * @param datos
	 */
	objDasborad.tendenciaAnualRendiTabla = function(datos) {
		let rows = '';
		let meses = [];
		let indicador = [];
		if (Array.isArray(datos)) {
			datos.forEach(function (item) {
				rows += '<tr>';
				rows += '<td class="text-center" >' + item.nmes + '</td>';
				rows += '<td class="text-left" >' + item.dmes + '</td>';
				rows += '<td class="text-right" >' + parseFloat(item.indicador).toFixed(2) + '</td>';
				rows += '<td class="text-right" >' + item.muestras + '</td>';
				rows += '</tr>';
				meses.push(item.dmes);
				indicador.push(parseFloat(item.indicador));
			});
		}
		$('#tblTendenciaAnualRendi tbody').html(rows);
		return {
			meses: meses,
			indicador: indicador,
		};
	};

	/**
	 * Impresion del grafico
	 * @param meses
	 * @param indicador
	 */
	objDasborad.tendenciaAnualRendiGrafico = function(meses, indicador) {
		Highcharts.chart('grafTendenciaAnualRendi', {
			chart: {
				type: 'column'
			},
			title: {
				text: 'Tendencia anual de rendimiento (%)'
			},
			subtitle: {
				text: ''
			},
			xAxis: {
				categories: meses,
				crosshair: true
			},
			yAxis: {
				min: 0,
				title: {
					text: 'Indicador %'
				}
			},
			tooltip: {
				headerFormat: '<span style="font-size:10px">{point.key}</span><table>',
				pointFormat: '<tr>' + //<td style="color:{series.color};padding:0">{series.name}: </td>'
					'<td style="padding:0"><b>{point.y:.3f} %</b></td></tr>',
				footerFormat: '</table>',
				shared: true,
				useHTML: true
			},
			plotOptions: {
				column: {
					pointPadding: 0.2,
					borderWidth: 0
				}
			},
			series: [{
				name: 'Meses',
				data:indicador,

			}]
		});
	};

	/**
	 * Busqueda resultado
	 */
	objDasborad.distProductoLinea = function() {
		$.ajax({
			url: baseurl + 'ar/evalprod/cdashboard/get_dist_producto_linea',
			data: objDasborad.getData(),
			method: 'POST',
			dataType: 'json',
			beforeSend: function() {},
		}).done(function(resp) {
			const result = objDasborad.distProductoLineaTabla(resp.data);
			objDasborad.distProductoLineaGrafico(result);
		}).fail(function() {
			console.log('error');
		});
	};

	/**
	 * @param datos
	 */
	objDasborad.distProductoLineaTabla = function(datos) {
		let rows = '';
		let nuevoDatos = [];
		if (Array.isArray(datos)) {
			datos.forEach(function (item, key) {
				rows += '<tr>';
				rows += '<td class="text-center" >' + (key + 1) + '</td>';
				rows += '<td class="text-left" >' + item.darea + '</td>';
				rows += '<td class="text-right" >' + parseFloat(item.cantidad) + '</td>';
				rows += '<td class="text-right" >' + parseFloat(item.porcentaje).toFixed(2) + '</td>';
				rows += '</tr>';
				nuevoDatos.push({
					name: item.darea,
					y: parseFloat(item.porcentaje),
				});
			});
		}
		$('#tblDistProductoLinea tbody').html(rows);
		return nuevoDatos;
	};

	/**
	 * @param datos
	 */
	objDasborad.distProductoLineaGrafico = function(datos) {
		Highcharts.chart('grafDistProductoLinea', {
			chart: {
				plotBackgroundColor: null,
				plotBorderWidth: null,
				plotShadow: false,
				type: 'pie'
			},
			title: {
				text: 'Distribución de Productos por línea'
			},
			tooltip: {
				pointFormat: '<b>{point.percentage:.1f}%</b>'
			},
			plotOptions: {
				pie: {
					allowPointSelect: true,
					cursor: 'pointer',
					dataLabels: {
						enabled: false
					},
					showInLegend: true
				}
			},
			series: [{
				name: 'Brands',
				colorByPoint: true,
				data: datos
			}]
		});
	};

	/**
	 * Busqueda resultado
	 */
	objDasborad.unicaproProdlinea = function() {
		$.ajax({
			url: baseurl + 'ar/evalprod/cdashboard/get_unicapro_prodlinea',
			data: objDasborad.getData(),
			method: 'POST',
			dataType: 'json',
			beforeSend: function() {},
		}).done(function(resp) {
			// Unidad
			objDasborad.tblUniCaproProdlineaTabla(resp.data.items);
			objDasborad.tblUniCaproProdlineaGrafico(resp.data.grafico);
			// Porcentaje
			objDasborad.tblPorCaproProdlineaTabla(resp.data.items);
			objDasborad.tblPorCaproProdlineaGrafico(resp.data.grafico);
		}).fail(function() {
			console.log('error');
		});
	}

	/**
	 *
	 * @param datos
	 */
	objDasborad.tblUniCaproProdlineaTabla = function(datos) {
		let rows = '';
		if (Array.isArray(datos)) {
			datos.forEach(function (item, key) {
				rows += '<tr>';
				rows += '<td class="text-center" >' + (key + 1) + '</td>';
				rows += '<td class="text-left" >' + item.darea + '</td>';
				rows += '<td class="text-center" >' + item.aprobados + '</td>';
				rows += '<td class="text-right" >' + item.observado + '</td>';
				rows += '<td class="text-right" >' + item.rechazado + '</td>';
				rows += '<td class="text-right" >' + parseFloat(item.vidautil).toFixed(2) + '</td>';
				rows += '<td class="text-right" >' + item.no_aprobados + '</td>';
				rows += '</tr>';
			});
		}
		$('#tblUnicaproProdlinea tbody').html(rows);
	};

	/**
	 * @param datos
	 */
	objDasborad.tblUniCaproProdlineaGrafico = function(datos) {
		const nuevoDatos = datos.map(function(obj) {
			return {
				name: obj.estado,
				y: Number(obj.unidad)
			}
		});
		Highcharts.chart('grafUniCaproProdlinea', {
			chart: {
				plotBackgroundColor: null,
				plotBorderWidth: null,
				plotShadow: false,
				type: 'pie'
			},
			title: {
				text: 'Unidades de Aprobación de productos por Linea'
			},
			tooltip: {
				pointFormat: '<b>{point.y}</b>'
			},
			plotOptions: {
				pie: {
					allowPointSelect: true,
					cursor: 'pointer',
					dataLabels: {
						enabled: false
					},
					showInLegend: true
				}
			},
			series: [{
				name: 'Brands',
				colorByPoint: true,
				data: nuevoDatos
			}]
		});
	};

	/**
	 *
	 * @param datos
	 */
	objDasborad.tblPorCaproProdlineaTabla = function(datos) {
		let rows = '';
		if (Array.isArray(datos)) {
			datos.forEach(function (item, key) {
				rows += '<tr>';
				rows += '<td class="text-center" >' + (key + 1) + '</td>';
				rows += '<td class="text-left" >' + item.darea + '</td>';
				rows += '<td class="text-center" >' + parseFloat(item.poraprobados).toFixed(2) + '</td>';
				rows += '<td class="text-right" >' + parseFloat(item.porobservado).toFixed(2) + '</td>';
				rows += '<td class="text-right" >' + parseFloat(item.porrechazado).toFixed(2) + '</td>';
				rows += '<td class="text-right" >' + parseFloat(item.porvidautil).toFixed(2) + '</td>';
				rows += '<td class="text-right" >' + parseFloat(item.porno_aprobados).toFixed(2) + '</td>';
				rows += '</tr>';
			});
		}
		$('#tblPorCaproProdlinea tbody').html(rows);
	};

	/**
	 * @param datos
	 */
	objDasborad.tblPorCaproProdlineaGrafico = function(datos) {
		const nuevoDatos = datos.map(function(obj) {
			return {
				name: obj.estado,
				y: Number(obj.porcentaje)
			}
		});
		Highcharts.chart('grafPorCaproProdlinea', {
			chart: {
				plotBackgroundColor: null,
				plotBorderWidth: null,
				plotShadow: false,
				type: 'pie'
			},
			title: {
				text: 'Unidades de Aprobación de productos por Linea'
			},
			tooltip: {
				pointFormat: '<b>{point.y}</b>'
			},
			plotOptions: {
				pie: {
					allowPointSelect: true,
					cursor: 'pointer',
					dataLabels: {
						enabled: false
					},
					showInLegend: true
				}
			},
			series: [{
				name: 'Brands',
				colorByPoint: true,
				data: nuevoDatos
			}]
		});
	};

});

$(document).ready(function() {

	$('#btnBuscarResultado').click(function() {
		const button = $(this);
		objPrincipal.botonCargando(button);
		$.when(
			$.ajax({
				url: baseurl + 'ar/evalprod/cdashboard/get_tendencia_anual_rendi',
				data: objDasborad.getData(),
				method: 'POST',
				dataType: 'json',
				beforeSend: function() {},
			}),
			$.ajax({
				url: baseurl + 'ar/evalprod/cdashboard/get_dist_producto_linea',
				data: objDasborad.getData(),
				method: 'POST',
				dataType: 'json',
				beforeSend: function() {},
			}),
			$.ajax({
				url: baseurl + 'ar/evalprod/cdashboard/get_unicapro_prodlinea',
				data: objDasborad.getData(),
				method: 'POST',
				dataType: 'json',
				beforeSend: function() {},
			})
		).done(function(resp1, resp2, resp3) {
			objPrincipal.liberarBoton(button);
			console.log(resp1);
			console.log(resp2);
			console.log(resp3);
			// Respuesta 1
			const result1 = objDasborad.tendenciaAnualRendiTabla(resp1[0].data);
			objDasborad.tendenciaAnualRendiGrafico(result1.meses, result1.indicador);
			// Respuesta 2
			const result2 = objDasborad.distProductoLineaTabla(resp2[0].data);
			objDasborad.distProductoLineaGrafico(result2);
			// Respuesta 3
			// Unidad
			objDasborad.tblUniCaproProdlineaTabla(resp3[0].data.items);
			objDasborad.tblUniCaproProdlineaGrafico(resp3[0].data.grafico);
			// Porcentaje
			objDasborad.tblPorCaproProdlineaTabla(resp3[0].data.items);
			objDasborad.tblPorCaproProdlineaGrafico(resp3[0].data.grafico);
		});

		// objDasborad.tendenciaAnualRendi();
		//
		// objDasborad.distProductoLinea();
		//
		// objDasborad.unicaproProdlinea();

	});

});
