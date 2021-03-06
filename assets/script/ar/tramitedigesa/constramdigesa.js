var otblListTramGrid, otblListTramExcel, otblListTramGriddet, otblListTramDocum;
var tiporeporte = 'G', tipotramite = 'V', tipofind = 'S';
var varfdesde, varfhasta;
var collapsedGroups = {};

$(document).ready(function () {
	$('#busAvanzada').hide();

	$('#txtFDesde,#txtFHasta').datetimepicker({
		format: 'DD/MM/YYYY',
		daysOfWeekDisabled: [0],
		locale: 'es'
	});

	fechaActual();

	$('#divtblGrid').show();
	$('#divtblExcel').hide();

    if ($('#hdnsgrupo').val() == '3'){
        $('#divEmpresas').show(); 
    }else{
        $('#divEmpresas').hide();
        var v_cboClie = $('#hdnccliente').val();
        var params = { "ccliente":v_cboClie };

        $.ajax({
            type: 'ajax',
            method: 'post',
            url: baseurl+"ar/tramites/cbusctramdigesa/getcbomarcaxclie",
            dataType: "JSON",
            async: true,
            data: params,
            success:function(result)
            {
                $("#cbomarca").html(result);           
            },
            error: function(){
                alert('Error, no se puede cargar la lista desplegable de establecimiento');
            }
        });
    }
	
    var params = { 
        "idusuario"   : $('#hdnidusu').val(),
    };        
    $.ajax({
        type: 'ajax',
        method: 'post',
        url: baseurl+"ar/tramites/cbusctramdigesa/getclientexusu",
        dataType: "JSON",
        async: true,
        data: params,
        success:function(result)
        {
            $('#cbocliente').html(result);
        },
        error: function(){
            alert('Error, No se puede autenticar por error');
        }
    });
          
    $.ajax({
        type: 'ajax',
        method: 'post',
        url: baseurl+"ar/tramites/cbusctramdigesa/getcbotipoprodxentidad",
        dataType: "JSON",
        async: true,
        success:function(result)
        {
            $('#cbotipoprod').html(result);
        },
        error: function(){
            alert('Error, No se puede autenticar por error');
        }
    });
});

fechaActual = function () {
	var fecha = new Date();
	var fechatring = ("0" + fecha.getDate()).slice(-2) + "/" + ("0" + (fecha.getMonth() + 1)).slice(-2) + "/" + fecha.getFullYear();

	$('#txtFDesde').datetimepicker('date', moment(fechatring, 'DD/MM/YYYY'));
	$('#txtFHasta').datetimepicker('date', moment(fechatring, 'DD/MM/YYYY'));

};

$('#txtFDesde').on('change.datetimepicker', function (e) {

	$('#txtFHasta').datetimepicker({
		format: 'DD/MM/YYYY',
		daysOfWeekDisabled: [0],
		locale: 'es'
	});

	var fecha = moment(e.date).format('DD/MM/YYYY');

	$('#txtFHasta').datetimepicker('minDate', fecha);
	$('#txtFHasta').datetimepicker('date', fecha);

});

$("#chkFreg").on("change", function () {
	var fecha = new Date();
	var fechatring1 = "01/01/" + fecha.getFullYear();
	var fechatring2 = ("0" + fecha.getDate()).slice(-2) + "/" + ("0" + (fecha.getMonth() + 1)).slice(-2) + "/" + fecha.getFullYear();

	if ($("#chkFreg").is(":checked") == true) {
		$("#txtFIni").prop("disabled", false);
		$("#txtFFin").prop("disabled", false);

		varfdesde = '';
		varfhasta = '';

		$('#txtFDesde').datetimepicker('date', fechatring1);
		$('#txtFHasta').datetimepicker('date', fechatring2);

		tipofind = 'N'

	} else if ($("#chkFreg").is(":checked") == false) {
		$("#txtFIni").prop("disabled", true);
		$("#txtFFin").prop("disabled", true);

		varfdesde = '';
		varfhasta = '';

		$('#txtFDesde').datetimepicker('date', moment(fechatring2, 'DD/MM/YYYY'));
		$('#txtFHasta').datetimepicker('date', moment(fechatring2, 'DD/MM/YYYY'));

		tipofind = 'S'
	}
	;
});

$("#chkBusavanzada").on("change", function () {
	if ($("#chkBusavanzada").is(":checked") == true) {
		$('#busAvanzada').show();
	} else if ($("#chkBusavanzada").is(":checked") == false) {
		$('#busAvanzada').hide();
	}
});

$('input[type=radio][name=rtipo]').change(function () {
	if ($('#rdPProducto').prop('checked')) {
		alert("P");
	} else if ($('#rdPEstuche').prop('checked')) {
		alert("E");
	}
});

$('input[type=radio][name=restado]').change(function () {
	if ($('#rdETodos').prop('checked')) {
		tipotramite = '%';
	} else if ($('#rdEVigente').prop('checked')) {
		tipotramite = 'V';
	} else if ($('#rdECaduco').prop('checked')) {
		tipotramite = 'Z';
	}
});

$('#swTipoLista').on('switchChange.bootstrapSwitch', function (event, state) {
	if ($('#swTipoLista').prop('checked')) {
		$('#divtblGrid').show();
		$('#divtblExcel').hide();
	} else {
		$('#divtblGrid').hide();
		$('#divtblExcel').show();
	}
	$('#btnBuscar').click();
});

$("#cbocliente").change(function(){
    var v_cboClie = $('#cbocliente').val();

    var params = { "ccliente":v_cboClie };

    $.ajax({
        type: 'ajax',
        method: 'post',
        url: baseurl+"ar/tramites/cbusctramdigesa/getcbomarcaxclie",
        dataType: "JSON",
        async: true,
        data: params,
        success:function(result)
        {
            $("#cbomarca").html(result);           
        },
        error: function(){
            alert('Error, no se puede cargar la lista desplegable de establecimiento');
        }
    });

    $.ajax({
        type: 'ajax',
        method: 'post',
        url: baseurl+"ar/tramites/cbusctramdigesa/getcaractprodu",
        dataType: "JSON",
        async: true,
        data: params,
        success:function(result)
        {
            $("#txtcaractprodu").html(result);           
        },
        error: function(){
            alert('Error, no se puede cargar la lista desplegable de establecimiento');
        }
    });
    
});

$("#cbotipoprod").change(function(){
    var v_cbotipoprod = $('#cbotipoprod').val();

    var params = { "ctipoProducto":v_cbotipoprod };

    $.ajax({
        type: 'ajax',
        method: 'post',
        url: baseurl+"ar/tramites/cbusctramdigesa/getcbotramitextipoproducto",
        dataType: "JSON",
        async: true,
        data: params,
        success:function(result)
        {
            $("#cbotramite").html(result);           
        },
        error: function(){
            alert('Error, no se puede cargar la lista desplegable de establecimiento');
        }
    });
    
});

$("#btnBuscar").click(function () {
    var vClie;

	varfdesde = $('#txtFIni').val();
	varfhasta = $('#txtFFin').val(); 
    
    if ($('#hdnsgrupo').val() == '3'){
        vClie = $('#cbocliente').val(); 
    }else{
        vClie = $('#hdnccliente').val();
    }    

	var parametros = {
        "codprod"     : $('#txtcodprodu').val(),
        "nomprod"     : $('#txtdescprodu').val(),
        "regsan"      : $('#txtnrors').val(),
        "tono"        : null,
        "estado"      : $('#cboesttramite').val(),
        "marca"       : $('#cbomarca').val(),
        "tramite"     : '001',
        "allf"        : tipofind,
        "fi"          : varfdesde,
        "ff"          : varfhasta,
        "numexpdiente": $('#txtnroexpe').val(),
        "ccategoria"  : $('#txtcaractprodu').val(),
        "est"         : $('#cboestproducto').val(),
        "tipoest"     : tipotramite, 
        "ccliente"    : vClie,
        "tiporeporte" : tiporeporte,    
        "iln"        : null
	};

    if($('#swTipoLista').prop('checked')){
        getListTramGrid(parametros);
    }else{
        getListTramExcel(parametros);
    }
    if($('#chkBusavanzada').prop('checked') == true){
        $('#chkBusavanzada').prop("checked", false);
        $('#busAvanzada').hide();
    }

});

getListTramGrid = function(param){
    var groupColumn = 0; 
    otblListTramGrid = $('#tblListTramGrid').DataTable({ 
        "processing"  	: true,
        "bDestroy"    	: true,
        "stateSave"     : true,
        "bJQueryUI"     : true,
        "scrollY"     	: "560px",
        "scrollX"     	: true, 
        'AutoWidth'     : true,
        "paging"      	: false,
        "info"        	: true,
        "filter"      	: true, 
        "ordering"		: false,
        "responsive"    : false,
        "select"        : true,
        "ajax"	: {
            "url"   : baseurl+"ar/tramites/cbusctramdigesa/getconsulta_grid_tr/",
            "type"  : "POST", 
            "data"  : param,     
            dataSrc : ''      
        },
        "columns"	: [
            {"data": "grupo"},
            {"class":"index details-control col-xs", "data": "SPACE", orderable:false},
            {"class":"col-xxs", "data": "SREGISTROPDTO"},
            {"class":"col-xs", "data": "CODIGOPROD"},
            {"class":"col-xm", "data": "DES_SAP"},
            {"class":"col-lm", "data": "NOMBREPROD"},
            {"class":"col-sm", "data": "MARCAPROD"},
            {"class":"col-s", "data": "DCATEGORIACLIENTE"},
            {"class":"col-xxl", "data": "DPRESENTACION"},
            {"class":"col-sm", "data": "TONOPROD"},
            {"class":"col-sm", "data": "FABRIPROD"},    
            {"class":"col-sm", "data": "PAISPROD"},  
            {"class":"col-sm", "data": "REGSANIPROD"},  
            {"class":"col-s", "data": "FECHAVENCE"}
        ],
        "drawCallback": function ( settings ) {
            var api = this.api();
            var rows = api.rows( {page:'all'} ).nodes();
            var last = null;
			var grupo;
 
            api.column([0], {} ).data().each( function ( ctra, i ) { 
                grupo = api.column(0).data()[i];
                if ( last !== ctra ) {
                    $(rows).eq( i ).before(
                        '<tr class="group"><td colspan="8"><strong>'+ctra.toUpperCase()+'</strong></td></tr>'
                    ); 
                    last = ctra;
                }
            } );
        },
        "createdRow": function( row, data, dataIndex ) {
            if ( data.CADUCO == 1 ) {
                $(row).addClass('text-rojo');    
            }
        },
        "columnDefs": [{
            "targets": [2], 
            "data": null, 
            "render": function(data, type, row) { 
                if(row.SREGISTROPDTO == "A") {
                    return '<div class="circulo-verde"> <h3>A</h3> </div>';
                }else{
                    return '<div class="circulo-rojo"> <h3>I</h3> </div>';
                }                      
            }
        }]
        /*rowGroup: {
            startRender : function ( rows, group ) {
                var collapsed = !!collapsedGroups[group];
    
                rows.nodes().each(function (r) {
                    r.style.display = collapsed ? 'none' : '';
                }); 
                return $('<tr/>')
                .append('<td colspan="14" style="cursor: pointer;">' + group + ' (' + rows.count() + ')</td>')
                .attr('data-name', group)
                .toggleClass('collapsed', collapsed);
            },
            dataSrc: "grupo"
        }*/
    });   
    // Enumeracion 
    otblListTramGrid.on( 'order.dt search.dt', function () { 
        otblListTramGrid.column(1, {search:'applied', order:'applied'}).nodes().each( function (cell, i) {
          cell.innerHTML = i+1;
          } );
    }).draw(); 
    otblListTramGrid.column(0).visible( false );  
}
/* DETALLE TRAMITES */
$('#tblListTramGrid tbody').on( 'click', 'td.details-control', function () {
            
   // var tr = $(this).closest('tr');
    var tr = $(this).parents('tr');
    var row = otblListTramGrid.row(tr);
    var rowData = row.data();
    
    if ( row.child.isShown() ) {                    
        row.child.hide();
        tr.removeClass( 'details' );
    }
    else {
        otblListTramGrid.rows().every(function(){
            // If row has details expanded
            if(this.child.isShown()){
                // Collapse row details
                this.child.hide();
                $(this.node()).removeClass('details');
            }
        })
        row.child( 
           '<table id="tblListTramGriddet" class="display compact" style="width:100%; padding-left:75px; background-color:#D3DADF; padding-top: -10px; border-bottom: 2px solid black;">'+
           '<thead style="background-color:#FFFFFF;"><tr><th></th><th>F. Ingreso</th><th>Trámite</th><th>Estado</th><th>N° Expediente</th><th>RS</th><th>F. Emisión</th><th>F. Vencimiento</th><th>Archivo</th></tr></thead><tbody>' +
            '</tbody></table>').show();

            otblListTramGriddet = $('#tblListTramGriddet').DataTable({
                "bJQueryUI": true,
                'bStateSave': true,
                'scrollY':        false,
                'scrollX':        true,
                'scrollCollapse': false,
                'bDestroy'    : true,
                'paging'      : false,
                'info'        : false,
                'filter'      : false,   
                'stateSave'   : true,
                'ajax'        : {
                    "url"   : baseurl+"ar/tramites/cbusctramdigesa/getbuscartramite",
                    "type"  : "POST", 
                    "data": function ( d ) {
                        d.codaarr = rowData.codigo;
                        d.codrsnso = rowData.REGSANIPROD;
                        d.codprod = rowData.cproductofs;
                    },     
                    dataSrc : ''        
                },
                'columns'     : [
                    {
                      "class"     :   "index",
                      orderable   :   false,
                      data        :   null,
                      targets     :   0
                    },
                    { "orderable": false,"data": "FINGRESO", targets: 1},
                    { "orderable": false,"data": "TRAMITE", targets: 2},
                    { "orderable": false,"data": "ESTADO", targets: 3},
                    { "orderable": false,"data": "NUMEROEXPE", targets: 4},
                    { "orderable": false,"data": "RSNSO", targets: 5},
                    { "orderable": false,"data": "FEMISION", targets: 6},
                    { "orderable": false,"data": "FVENCIMIENTO", targets: 7},
                    {"orderable": false, 
                        render:function(data, type, row){
                            return  '<div>'+  
                                '<a data-original-title="Listar Documentos" data-toggle="modal" style="cursor:pointer; color:#3c763d;" data-target="#modalListdocumentos" onClick="javascript:selTramdocumento(\''+row.CASUNTOREGULATORIO+'\',\''+row.CENTIDADREGULA+'\',\''+row.CTRAMITE+'\',\''+row.CSUMARIO+'\');"><i class="far fa-folder-open fa-2x" data-original-title="Listar Documentos" data-toggle="tooltip"></i></a>'+                                 
                            '</div>' 
                        }
                    },
                              
                ], 
            });
            // Enumeracion 
            otblListTramGriddet.on( 'order.dt search.dt', function () { 
                otblListTramGriddet.column(0, {search:'applied', order:'applied'}).nodes().each( function (cell, i) {
                  cell.innerHTML = i+1;
                  } );
            }).draw(); 

        tr.addClass('details');
    }
});
/* COMPRIMIR GRUPO */
$('#tblListTramGrid tbody').on('click', 'tr.dtrg-group', function () {
    var name = $(this).data('name');
    collapsedGroups[name] = !collapsedGroups[name];
    otblListTramGrid.draw(true);
}); 

getListTramExcel = function(param){
    otblListTramExcel = $('#tblListTramExcel').DataTable({  
        "processing"  	: true,
        "bDestroy"    	: true,
        "stateSave"     : true,
        "bJQueryUI"     : true,
        "scrollY"     	: "560px",
        "scrollX"     	: true, 
        'AutoWidth'     : true,
        "paging"      	: false,
        "info"        	: true,
        "filter"      	: true, 
        "ordering"		: false,
        "responsive"    : false,
        "select"        : true,
        "ajax"	: {
            "url"   : baseurl+"ar/tramites/cbusctramdigesa/getconsulta_excel_tr/",
            "type"  : "POST", 
            "data"  : param,     
            dataSrc : ''       
        },
        "columns"	: [
            {
              "class"     :   "index col-xs",
              orderable   :   false,
              data        :   null,
              targets     :   0
            },
            {"class":"col-xs", "orderable": false, data: 'CODIGOPROD', targets: 1},
            {"class":"col-xm", "orderable": false, data: 'DES_SAP', targets: 2},
            {"class":"col-lm", "orderable": false, data: 'NOMBREPROD', targets: 3},
            {"class":"col-sm", "orderable": false, data: 'MARCAPROD', targets: 4},
            {"class":"col-s", "orderable": false, data: 'DCATEGORIACLIENTE', targets: 5},
            {"class":"col-xxl", "orderable": false, data: 'DPRESENTACION', targets: 6},
            {"class":"col-sm", "orderable": false, data: 'TONOPROD', targets: 7},
            {"class":"col-sm", "orderable": false, data: 'FABRIPROD', targets: 8},    
            {"class":"col-sm", "orderable": false, data: 'PAISPROD', targets: 9},  
            {"class":"col-s", "orderable": false, data: 'tcreacion', targets: 10},  
            {"class":"col-sm", "orderable": false, data: 'TRAMITEPROD', targets: 11},  
            {"class":"col-sm", "orderable": false, data: 'ESTADO', targets: 12},
            {"class":"col-sm", "orderable": false, data: 'NUMEXP', targets: 13},      
            {"class":"col-sm", "orderable": false, data: 'REGSANIPROD', targets: 14},      
            {"class":"col-s", "orderable": false, data: 'DNUMERODR', targets: 15},      
            {"class":"col-s", "orderable": false, data: 'FEMI', targets: 16},      
            {"class":"col-s", "orderable": false, data: 'FECHAVENCE', targets: 17},         
            {"orderable": false, 
                render:function(data, type, row){
                    return '<div>'+  
                        '<a data-original-title="Listar Documentos" data-toggle="modal" style="cursor:pointer; color:#3c763d;" data-target="#modalListdocumentos" onClick="javascript:selTramdocumento(\''+row.casuntoregulatorio+'\',\''+row.centidadregula+'\',\''+row.ctramite+'\',\''+row.csumario+'\');"><i class="far fa-folder-open fa-2x" data-original-title="Listar Documentos" data-toggle="tooltip"></i></a>'+                                 
                    '</div>'
                }
            }
        ],
        "columnDefs": [
        ],
        'order' : [[3, "asc"],[4, "asc"]] 
    });   
    // Enumeracion 
    otblListTramExcel.on( 'order.dt search.dt', function () { 
        otblListTramExcel.column(0, {search:'applied', order:'applied'}).nodes().each( function (cell, i) {
          cell.innerHTML = i+1;
          } );
    }).draw(); 

};

selTramdocumento = function(codar, codent, ctram, csum){
    otblListTramDocum = $('#tblListTramDocum').DataTable({  
        'responsive'    : false,
        'bJQueryUI'     : true,
        'scrollY'     	: '400px',
        'scrollX'     	: true, 
        'paging'      	: true,
        'processing'  	: true,     
        'bDestroy'    	: true,
        'AutoWidth'     : false,
        'info'        	: true,
        'filter'      	: true, 
        'ordering'		: false,  
        'stateSave'     : true,
        'ajax'	: {
            "url"   : baseurl+"ar/tramites/cbusctramdigesa/getdocum_aarr/",
            "type"  : "POST", 
            "data": function ( d ) {
              d.casuntoregula = codar;
              d.centidad = codent;
              d.ctramite = ctram;;
              d.csumario = csum;
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
            {"orderable": false, data: 'ddocumento', targets: 1},
            {"orderable": false, data: 'Archivo_ar', targets: 2},
            {"orderable": false, 
                render:function(data, type, row){   
                  return  '<div>'+   
                          '<a href="'+baseurl+'FTPfileserver/Archivos/'+row.DUBICACIONFILESERVER+'" target="_blank" class="btn btn-default btn-xs pull-left"><i class="fas fa-cloud-download-alt" data-original-title="Descargar Archivo" data-toggle="tooltip"></i></a>' +   
                          '</div>' 
                }
            },
        ],
    });   
    // Enumeracion 
    otblListTramDocum.on( 'order.dt search.dt', function () { 
        otblListTramDocum.column(0, {search:'applied', order:'applied'}).nodes().each( function (cell, i) {
          cell.innerHTML = i+1;
          } );
    }).draw();
};
