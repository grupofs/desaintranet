
var otblListEquipos, otblListProductos;
var vccliente = $('#hdnccliente').val(); 

$(document).ready(function() { 
    listProducto()   
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
        "responsive"    : false,
        "select"        : true,
        'ajax'	: {
            "url"   : baseurl+"pt/cservcliente/getcalfrioproducto/",
            "type"  : "POST", 
            "data": function ( d ) {
                d.ccliente      = vccliente;
            },     
            dataSrc : ''        
        },
        'columns'	: [
            {
              "class"     :   "details-control col-xs",
              orderable   :   false,
              data        :   null,
              targets     :   0
            },
            {"class":"col-sm", "orderable": false, data: 'NROINFOR'},
            {"class":"col-lm", "orderable": false, data: 'PRODUCTO'},
            {"class":"col-sm", "orderable": false, data: 'TIPO'},
            {"class":"col-m", "orderable": false, data: 'ENVASE'},
            {"class":"col-xm", "orderable": false, data: 'DIMENSION'},
        ],
        "columnDefs": [{
            "targets": [1], 
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
        otblListProductos.column(0, {search:'applied', order:'applied'}).nodes().each( function (cell, i) {
          cell.innerHTML = i+1;
          } );
    }).draw() 
};
/* DETALLE TRAMITES */
$('#tblListProductos tbody').on( 'click', 'td.details-control', function () {
            
   // var tr = $(this).closest('tr');
    var tr = $(this).parents('tr');
    var row = otblListProductos.row(tr);
    var rowData = row.data();
    
    if ( row.child.isShown() ) {                    
        row.child.hide();
        tr.removeClass( 'details' );
    }
    else {
        otblListProductos.rows().every(function(){
            // If row has details expanded
            if(this.child.isShown()){
                // Collapse row details
                this.child.hide();
                $(this.node()).removeClass('details');
            }
        })
        row.child( 
           '<table id="tblListEquipo" class="display compact" style="width:100%; padding-left:75px; background-color:#D3DADF; padding-top: -10px; border-bottom: 2px solid black;">'+
           '<thead style="background-color:#FFFFFF;"><tr><th>TIPO DE EQUIPO</th><th>FABRICANTE EQUIPO</th></thead><tbody>' +
            '</tbody></table>').show();
            /*
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
            });*/

        tr.addClass('details');
    }
});