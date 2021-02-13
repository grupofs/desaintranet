
var otblListconsinf

$(document).ready(function() {
    
    $.ajax({
        type: 'ajax',
        method: 'post',
        url: baseurl+"lab/coti/ccotizacion/getcboclieserv",
        dataType: "JSON",
        async: true,
        success:function(result){
            $('#cboclieserv').html(result);
        },
        error: function(){
            alert('Error, No se puede autenticar por error');
        }
    });
});

$("#btnBuscar").click(function (){
    listarBusqueda();
});

listarBusqueda = function(){
    var groupColumn = 1;   
    otblListconsinf = $('#tblListconsinf').DataTable({  
        'responsive'    : false,
        'bJQueryUI'     : true,
        'scrollY'     	: '600px',
        'scrollX'     	: true, 
        'paging'      	: true,
        'processing'  	: true,     
        'bDestroy'    	: true,
        'AutoWidth'     : false,
        'info'        	: true,
        'filter'      	: true, 
        'ordering'		: false,  
        'stateSave'     : true,
        'select'        : true,
        'ajax'	: {
            "url"   : baseurl+"lab/consinf/cconsinf/getbuscar/",
            "type"  : "POST", 
            "data": function ( d ) {
                d.ccliente          = $('#cboclieserv').val(); 
                d.descripcion       = $('#txtbuscar').val();  
                d.tipobuscar        = $('#cbotipobuscar').val(); 
            },     
            dataSrc : ''        
        },
        'columns'	: [
            {
              "class"     :   "index col-xs",
              orderable   :   false,
              data        :   null,
              targets     :   0,
            },
            {"orderable": false, data: 'DCLIENTE', targets: 1},
            {"orderable": false, data: 'NROCOTI', targets: 2},
            {"orderable": false, data: 'FCOTI', "class" : "col-s dt-body-center", targets: 3},
            {"orderable": false, data: 'NROOT', targets: 4},
            {"orderable": false, data: 'FOT', "class" : "col-s dt-body-center", targets: 5},
            {"orderable": false, data: 'INFORMES', "class" : "col-xm", targets: 7},
            {"orderable": false, data: 'ELABORADO', targets: 6},
            {"orderable": false, 
                render:function(data, type, row){      
                    return '<div>' +
                        '</div>';
                }
            }
        ],  
        "columnDefs": [{
            "targets": [2], 
            "data": null, 
            "render": function(data, type, row) {
                return '<div>'+
                '    <p><a title="Cotozacion" style="cursor:pointer;" onclick="pdfCoti(\'' + row.IDCOTIZACION + '\',\'' + row.NVERSION + '\');"  class="pull-left">'+row.NROCOTI+'&nbsp;&nbsp;<i class="fas fa-file-pdf fa-2x" style="color:#FF0000;"></i></a><p>' +
                '</div>';
            }
        }],
        "drawCallback": function ( settings ) {
            var api = this.api();
            var rows = api.rows( {page:'all'} ).nodes();
            var last = null;
			var grupo;
 
            api.column([1], {} ).data().each( function ( ctra, i ) { 
                grupo = api.column(1).data()[i];
                if ( last !== ctra ) {
                    $(rows).eq( i ).before(
                        '<tr class="group"><td colspan="7"><strong>'+ctra.toUpperCase()+'</strong></td></tr>'
                    ); 
                    last = ctra;
                }
            } );
        }
    }); 
    otblListconsinf.column(1).visible( false );      
    // Enumeracion 
    otblListconsinf.on( 'order.dt search.dt', function () { 
        otblListconsinf.column(0, {search:'applied', order:'applied'}).nodes().each( function (cell, i) {
          cell.innerHTML = i+1;
          } );
    }).draw();  
};

pdfCoti = function(idcoti,nversion){
    window.open(baseurl+"lab/coti/ccotizacion/pdfCoti/"+idcoti+"/"+nversion);
};
pdfInforme = function(cinternoordenservicio,cmuestra){
    window.open(baseurl+"lab/consinf/cconsinf/pdfInforme/"+cinternoordenservicio+"/"+cmuestra);
};