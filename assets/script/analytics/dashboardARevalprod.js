

	var oTable_tendenciaanualrendi, oTable_distproductolinea, oTable_tblunicaproprodline, oTable_tblporcaproprodline;

	// INICIALIZACION DE CONTROLES
	$(document).ready(function () {
        /*LLENADO DE COMBOS*/         
        $.ajax({
            type: 'ajax',
            method: 'post',
            url: baseurl+"cglobales/getanios",
            dataType: "JSON",
            async: true,
            success:function(result)
            {
                $('#cboAnio').html(result);
				datagrafbar_tendenciaanualrendi(baseurl);
				dtTeneciaAnual();
            },
            error: function(){
              alert('Error, No se puede autenticar por error');
            }
        });  

        $.ajax({
            type: 'ajax',
            method: 'post',
            url: baseurl+"cglobales/getmeses",
            dataType: "JSON",
            async: true,
            success:function(result)
            {
				$('#cboMes').html(result);
            },
            error: function(){
              alert('Error, No se puede autenticar por error');
            }
		}); 
		
		
	});

	dtTeneciaAnual = function(){		
		// tabla tendencia anual rendimiento
        oTable_tendenciaanualrendi = $('#tbltendenciaanualrendi').DataTable({
            'bJQueryUI'   : true,
            'scrollX'     : true,
            'processing'  : true,      
            'bDestroy'    : true,
            'paging'      : false,
            'info'        : false,
            'filter'      : false, 
            'ajax'        : {
                "url"   : baseurl+"analytics/cdashboardAR/gettendenciaanualrendi/",
                "type"  : "POST", 
                "data": function ( d ) {
                    d.ccliente = '00005'; //$('#idcliente').val();  
                    d.anio = $('#cboAnio').val();   
                },     
                dataSrc : ''        
            },
            'columns'	: [
				{data: 'nmes', orderable : false, targets: 0 },
                {data: 'dmes', orderable : false, targets: 1 },
                {data: 'indicador', orderable : false, targets: 2, render: $.fn.dataTable.render.number( ',', '.', 1)},
                {data: 'muestras', orderable : false, targets: 3},
            ], 
            "columnDefs"	: [
            	{
                    "defaultContent": " ",
                    "targets": "_all"
            	}
            ],
            'order'	: [[ 0, "asc" ]] 
		}); 
	}
	
	$('#btnBuscarAnual').click(function(){ 
		dtTeneciaAnual();

		// tabla tendencia anual rendimiento
        oTable_distproductolinea = $('#tbldistproductolinea').DataTable({
            'bJQueryUI'   : true,
            'scrollX'     : true,
            'processing'  : true,      
            'bDestroy'    : true,
            'paging'      : false,
            'info'        : false,
            'filter'      : false, 
            'ajax'        : {
                "url"   : baseurl+"analytics/cdashboardAR/getdistproductolinea/",
                "type"  : "POST", 
                "data": function ( d ) {
                    d.ccliente = '00005'; //$('#idcliente').val();  
                    d.anio = $('#cboAnio').val();   
                    d.mes = $('#cboMes').val(); 
                },     
                dataSrc : ''        
            },
            'columns'	: [
				{
					"class"     :   "index",
					orderable   :   false,
					data        :   null,
					targets     :   0
				},
				{data: 'darea', orderable : false, targets: 1 },
                {data: 'cantidad', orderable : false, targets: 2 },
                {data: 'porcentaje', orderable : false, targets: 3, render: $.fn.dataTable.render.number( ',', '.', 1)},
            ], 
            "columnDefs"	: [
            	{
                    "defaultContent": " ",
                    "targets": "_all"
            	}
            ],
            'order'	: [[ 0, "asc" ]] 
		}); 		
        // Enumeracion 
        oTable_distproductolinea.on( 'order.dt search.dt', function () { 
            oTable_distproductolinea.column(0, {search:'applied', order:'applied'}).nodes().each( function (cell, i) {
            cell.innerHTML = i+1;
            });
		} ).draw(); 
		
		// tabla Unidades de Aprobación de productos por Linea
        oTable_tblunicaproprodline = $('#tblunicaproprodline').DataTable({
            'bJQueryUI'   : true,
            'scrollX'     : true,
            'processing'  : true,      
            'bDestroy'    : true,
            'paging'      : false,
            'info'        : false,
            'filter'      : false, 
            'ajax'        : {
                "url"   : baseurl+"analytics/cdashboardAR/getporcaproprodlinea/",
                "type"  : "POST", 
                "data": function ( d ) {
                    d.ccliente = '00005'; //$('#idcliente').val();  
                    d.anio = $('#cboAnio').val();   
                    d.mes = $('#cboMes').val(); 
                },     
                dataSrc : ''        
            },
            'columns'	: [
				{
					"class"     :   "index",
					orderable   :   false,
					data        :   null,
					targets     :   0
				},
				{data: 'darea', orderable : false, targets: 1 },
                {data: 'aprobados', orderable : false, targets: 2 },
                {data: 'observado', orderable : false, targets: 3},
                {data: 'rechazado', orderable : false, targets: 4},
                {data: 'vidautil', orderable : false, targets: 5},
                {data: 'no_aprobados', orderable : false, targets: 6},
            ],
            'rowCallback': function( row, data, index ) {
              if (data.pos == 1) {
                $('td', row).css('background-color', 'SILVER');
                $('td', row).css('font-weight', 'bold');
              }
            },
            "columnDefs"	: [
            	{
                    "defaultContent": " ",
                    "targets": "_all"
            	}
            ],
            'order'	: [[ 0, "asc" ]] 
		}); 		
        // Enumeracion 
        oTable_tblunicaproprodline.on( 'order.dt search.dt', function () { 
            oTable_tblunicaproprodline.column(0, {search:'applied', order:'applied'}).nodes().each( function (cell, i) {
            cell.innerHTML = i+1;
            });
        } ).draw(); 
		
		// tabla Porcentaje de Aprobación de productos por Linea
        oTable_tblporcaproprodline = $('#tblporcaproprodline').DataTable({
            'bJQueryUI'   : true,
            'scrollX'     : true,
            'processing'  : true,      
            'bDestroy'    : true,
            'paging'      : false,
            'info'        : false,
            'filter'      : false, 
            'ajax'        : {
                "url"   : baseurl+"analytics/cdashboardAR/getporcaproprodlinea/",
                "type"  : "POST", 
                "data": function ( d ) {
                    d.ccliente = '00005'; //$('#idcliente').val();  
                    d.anio = $('#cboAnio').val();   
                    d.mes = $('#cboMes').val(); 
                },     
                dataSrc : ''        
            },
            'columns'	: [
				{
					"class"     :   "index",
					orderable   :   false,
					data        :   null,
					targets     :   0
				},
				{data: 'darea', orderable : false, targets: 1 },
                {data: 'poraprobados', orderable : false, targets: 2, render: $.fn.dataTable.render.number( ',', '.', 1)},
                {data: 'porobservado', orderable : false, targets: 3, render: $.fn.dataTable.render.number( ',', '.', 1)},
                {data: 'porrechazado', orderable : false, targets: 4, render: $.fn.dataTable.render.number( ',', '.', 1)},
                {data: 'porvidautil', orderable : false, targets: 5, render: $.fn.dataTable.render.number( ',', '.', 1)},
                {data: 'porno_aprobados', orderable : false, targets: 6, render: $.fn.dataTable.render.number( ',', '.', 1)},
            ],
            'rowCallback': function( row, data, index ) {
              if (data.pos == 1) {
                $('td', row).css('background-color', 'SILVER');
                $('td', row).css('font-weight', 'bold');
              }
            },
            'order'	: [[ 0, "asc" ]] 
		}); 		
        // Enumeracion 
        oTable_tblporcaproprodline.on( 'order.dt search.dt', function () { 
            oTable_tblporcaproprodline.column(0, {search:'applied', order:'applied'}).nodes().each( function (cell, i) {
            cell.innerHTML = i+1;
            });
        } ).draw();  
		
		// grafico tendencia anual rendimiento
		datagrafbar_tendenciaanualrendi(baseurl);
		datagrafbar_distproductolinea(baseurl);
		datagrafbar_unicaproprodline(baseurl);
		datagrafbar_porcaproprodline(baseurl);
	  
	});
	
	function datagrafbar_tendenciaanualrendi(base_url){
		namesMonth=["Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Setiembre","Octubre","Noviembre","Diciembre"];
		var parametros = {
			"anio" : $('#cboAnio').val(),
			"ccliente" : '00005',
		};

		$.ajax({
			type: 'ajax',
			url:  baseurl+"analytics/cdashboardAR/gettendenciaanualrendi",
			type:  'post',
			dataType: "JSON",
			data: parametros,
			success: function(result){
				var meses = new Array();
				var indicador = new Array();
				$.each(result,function(key, value){
					meses.push(namesMonth[value.mes - 1]);
					valor = Number(value.indicador);
					indicador.push(valor);
				});
				grafbar_tendenciaanualrendi(meses,indicador);
			}
		});
	}	
	function datagrafbar_distproductolinea(base_url){
		var parametros = {
			"anio" : $('#cboAnio').val(),
			"mes" : $('#cboMes').val(),
			"ccliente" : '00005',
		};

		$.ajax({
			type: 'ajax',
			url:  baseurl+"analytics/cdashboardAR/getdistproductolinea",
			type:  'post',
			dataType: "JSON",
			data: parametros,
			success: function(result){		
				/*$.each(result,function(key, value){
					datos = {name: value.darea,
						y: Number(value.porcentaje)}					
				});*/
				grafbar_distproductolinea(result);
			}
		});
	}
	function datagrafbar_unicaproprodline(base_url){
		var parametros = {
			"anio" : $('#cboAnio').val(),
			"mes" : $('#cboMes').val(),
			"ccliente" : '00005',
		};

		$.ajax({
			type: 'ajax',
			url:  baseurl+"analytics/cdashboardAR/getgrafcaproprodlinea",
			type:  'post',
			dataType: "JSON",
			data: parametros,
			success: function(result){		
				/*$.each(result,function(key, value){
					datos = {name: value.darea,
						y: Number(value.porcentaje)}					
				});*/
				grafbar_unicaproprodline(result);
			}
		});
	}
	function datagrafbar_porcaproprodline(base_url){
		var parametros = {
			"anio" : $('#cboAnio').val(),
			"mes" : $('#cboMes').val(),
			"ccliente" : '00005',
		};

		$.ajax({
			type: 'ajax',
			url:  baseurl+"analytics/cdashboardAR/getgrafcaproprodlinea",
			type:  'post',
			dataType: "JSON",
			data: parametros,
			success: function(result){		
				/*$.each(result,function(key, value){
					datos = {name: value.darea,
						y: Number(value.porcentaje)}					
				});*/
				grafbar_porcaproprodline(result);
			}
		});
	}

	function grafbar_tendenciaanualrendi(meses,indicador){
		
		Highcharts.chart('graftendenciaanualrendi', {
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
	}
	function grafbar_distproductolinea(datos){
		
		data = datos.map(function(obj) {
			return {
				name: obj.darea,
				y: Number(obj.porcentaje)
			}
		});
		Highcharts.chart('grafdistproductolinea', {
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
				data: data
			}]
		});
	}
	function grafbar_unicaproprodline(datos){
		
		data = datos.map(function(obj) {
			return {
				name: obj.estado,
				y: Number(obj.unidad)
			}
		});
		Highcharts.chart('grafunicaproprodline', {
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
				data: data
			}]
		});
	}
	function grafbar_porcaproprodline(datos){
		
		data = datos.map(function(obj) {
			return {
				name: obj.estado,
				y: Number(obj.porcentaje)
			}
		});
		Highcharts.chart('grafporcaproprodline', {
			chart: {
				plotBackgroundColor: null,
				plotBorderWidth: null,
				plotShadow: false,
				type: 'pie'
			},
			title: {
				text: 'Porcentaje de Aprobación de productos por Linea'
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
				data: data
			}]
		});
	}
