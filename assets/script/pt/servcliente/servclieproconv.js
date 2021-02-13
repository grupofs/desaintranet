
var otblListEquipos, otblListProductos;
var collapsedGroupsEq = {};
var vccliente = $('#hdnccliente').val(); 

$(document).ready(function() { 
    listEquipo();  
    listProducto();     
});

listEquipo= function(){    

    otblListEquipos = $('#tblListEquipos').DataTable({ 
        "processing"  	: true,
        "bDestroy"    	: true,
        "stateSave"     : true,
        "bJQueryUI"     : true,
        "scrollResize"  : true,
        "scrollY"     	: "400px",
        "scrollX"     	: true, 
        'AutoWidth'     : false,
        "paging"      	: false,
        "info"        	: true,
        "filter"      	: true, 
        "ordering"		: false,
        "responsive"    : false,
        "select"        : true,
        'ajax'	: {
            "url"   : baseurl+"pt/cservcliente/getproconvequipo/",
            "type"  : "POST", 
            "data": function ( d ) {
                d.ccliente      = vccliente;
            },     
            dataSrc : ''        
        },
        'columns'	: [
            {"orderable": false, data: 'TIPO'},
            {
              "class"     :   "col-xxs",
              orderable   :   false,
              data        :   'ESPACE',
              targets     :   1
            },
            {"class":"col-xm", "orderable": false, data: 'NROINFOR'},
            {"class":"col-xm", "orderable": false, data: 'MEDIOCAL'},
            {"class":"col-xm", "orderable": false, data: 'FABRI'},
            {"class":"col-sm", "orderable": false, data: 'ENVASE'},
            {"class":"col-m", "orderable": false, data: 'DIMENSION'},
            {"class":"col-xs", "orderable": false, data: 'IDENTIF'}, 
        ],
        rowGroup: {
            startRender : function ( rows, group ) {
                var collapsed = !!collapsedGroupsEq[group];
    
                rows.nodes().each(function (r) {
                    r.style.display = collapsed ? 'none' : '';
                }); 
                return $('<tr/>')
                .append('<td colspan="14" style="cursor: pointer;">' + group + ' (' + rows.count() + ')</td>')
                .attr('data-name', group)
                .toggleClass('collapsed', collapsed);
            },
            dataSrc: "TIPO"
        },
        "columnDefs": [{
            "targets": [2], 
            "data": null, 
            "render": function(data, type, row) { 
                if(row.ARCHIVO != "") {
                    return '<p><a title="Descargar" style="cursor:pointer; color:#294ACF;" href="'+baseurl+row.ruta_informe+row.ARCHIVO+'" target="_blank" class="pull-left">'+row.NROINFOR+'&nbsp;<i class="fas fa-cloud-download-alt""></i></a><p>';
                }else{
                    return '<p>'+row.NROINFOR+'</p>';
                }                      
            }
        }/*,{
            "targets": [1], 
            "data": 'ESPACE',
            "render": function(data, type, row) {
                if(row.idptregestudio == 1){
                    $(row).find('tr').removeClass( 'details-control' );
                    alert(row.idptregestudio);
                };
                return row.ESPACE;
            }
        }*/]
    });   
    // Enumeracion 
    otblListEquipos.on( 'order.dt search.dt', function () { 
        otblListEquipos.column(1, {search:'applied', order:'applied'}).nodes().each( function (cell, i) {
          cell.innerHTML = i+1;
          } );
    }).draw();  
    otblListEquipos.column(0).visible( false ); 
};
/* DETALLE TRAMITES 
$('#tblListEquipos tbody').on( 'click', 'td.details-control', function () {
            
   // var tr = $(this).closest('tr');
    var tr = $(this).parents('tr');
    var row = otblListEquipos.row(tr);
    var rowData = row.data();
    
    if ( row.child.isShown() ) {                    
        row.child.hide();
        tr.removeClass( 'details' );
    }
    else {
        otblListEquipos.rows().every(function(){
            // If row has details expanded
            if(this.child.isShown()){
                // Collapse row details
                this.child.hide();
                $(this.node()).removeClass('details');
            }
        })
        row.child( 
           '<table id="tblListProductos" class="display compact" style="width:100%; padding-left:75px; background-color:#D3DADF; padding-top: -10px; border-bottom: 2px solid black;">'+
           '<thead style="background-color:#FFFFFF;"><tr><th>NOMBRE</th><th>ENVASE</th><th>TIPO</th><th>DIMENSIONES</th><th>PROCAL</th></tr></thead><tbody>' +
            '</tbody></table>').show();

            otblListProductos = $('#tblListProductos').DataTable({
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
                    "url"   : baseurl+"pt/cservcliente/getproconvproducto/",
                    "type"  : "POST", 
                    "data": function ( d ) {
                        d.ccliente = rowData.ccliente;
                        d.idinforme = rowData.idptinforme;
                        d.idregistro = rowData.idptregistro;
                        d.idregestudio = rowData.idptregestudio;
                    },     
                    dataSrc : ''        
                },
                'columns'     : [
                    {"orderable": false, data: 'PRODUCTO'},
                    {"orderable": false, data: 'ENVASE'},
                    {"orderable": false, data: 'TIPO'},
                    {"orderable": false, data: 'DIMENSION'},
                    {"orderable": false, data: 'NROPROCAL'},
                              
                ], 
            });

        tr.addClass('details');
    }
});*/
/* COMPRIMIR GRUPO */
$('#tblListEquipos tbody').on('click', 'tr.dtrg-group', function () {
    var name = $(this).data('name');
    collapsedGroupsEq[name] = !collapsedGroupsEq[name];
    otblListEquipos.draw(true);
}); 


listProducto= function(){    

    otblListProductos = $('#tblListProductos').DataTable({  
        "processing"  	: true,
        "bDestroy"    	: true,
        "stateSave"     : true,
        "bJQueryUI"     : true,
        "scrollResize"  : true,
        "scrollY"     	: "400px",
        "scrollX"     	: true, 
        'AutoWidth'     : true,
        "paging"      	: false,
        "info"        	: true,
        "filter"      	: true, 
        "ordering"		: false,
        "responsive"    : true,
        "select"        : true,
        'ajax'	: {
            "url"   : baseurl+"pt/cservcliente/getproconvproducto/",
            "type"  : "POST", 
            "data": function ( d ) {
                d.ccliente      = vccliente;
            },     
            dataSrc : ''        
        },
        'columns'	: [
            {"orderable": false, data: 'TIPO'},
            {
              "class"     :   "col-xxs",
              orderable   :   false,
              data        :   null,
              targets     :   1
            },
            {"class":"col-xm", "orderable": false, data: 'NROINFOR'},
            {"class":"col-lm", "orderable": false, data: 'PRODUCTO'},
            {"class":"col-sm", "orderable": false, data: 'ENVASE'},
            {"class":"col-s", "orderable": false, data: 'NROPROCAL'},
            {"class":"col-sm", "orderable": false, data: 'DIMENSION'},
            {"class":"col-sm", "orderable": false, data: 'TIPOEQUIPO'},
            {"class":"col-sm", "orderable": false, data: 'IDENEQUIPO'},
            {"class":"col-sm", "orderable": false, data: 'FABRIEQUIPO'},
        ],
        rowGroup: {
            startRender : function ( rows, group ) {
                var collapsed = !!collapsedGroupsEq[group];
    
                rows.nodes().each(function (r) {
                    r.style.display = collapsed ? 'none' : '';
                }); 
                return $('<tr/>')
                .append('<td colspan="14" style="cursor: pointer;">' + group + ' (' + rows.count() + ')</td>')
                .attr('data-name', group)
                .toggleClass('collapsed', collapsed);
            },
            dataSrc: "TIPO"
        },
        "columnDefs": [{
            "targets": [2], 
            "data": null, 
            "render": function(data, type, row) { 
                if(row.ARCHIVO != "") {
                    return '<p><a title="Descargar" style="cursor:pointer; color:#294ACF;" href="'+baseurl+row.ruta_informe+row.ARCHIVO+'" target="_blank" class="pull-left">'+row.NROINFOR+'&nbsp;<i class="fas fa-cloud-download-alt""></i></a><p>';
                }else{
                    return '<p>'+row.NROINFOR+'</p>';
                }                      
            }
        }]
    });   
    // Enumeracion 
    otblListProductos.on( 'order.dt search.dt', function () { 
        otblListProductos.column(1, {search:'applied', order:'applied'}).nodes().each( function (cell, i) {
          cell.innerHTML = i+1;
          } );
    }).draw();  
    otblListProductos.column(0).visible( false ); 
};
// COMPRIMIR GRUPO 
$('#tblListProductos tbody').on('click', 'tr.dtrg-group', function () {
    var name = $(this).data('name');
    collapsedGroupsEq[name] = !collapsedGroupsEq[name];
    otblListProductos.draw(true);
}); 

