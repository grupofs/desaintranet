
var otblListEquipos, otblListProductos;
var vccliente = $('#hdnccliente').val(); 

$(document).ready(function() { 
    listProducto()   
});

listProducto= function(){    

    otblListProductos = $('#tblListProductos').DataTable({  
        'responsive'    : false,
        'bJQueryUI'     : true,
        'scrollY'     	: '200px',
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
            "url"   : baseurl+"pt/cservcliente/getcalfrioproducto/",
            "type"  : "POST", 
            "data": function ( d ) {
                d.ccliente      = vccliente;
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
            {"class":"col-m", "orderable": false, data: 'NROINFOR'},
            {"orderable": false, data: 'PRODUCTO'},
            {"orderable": false, data: 'TIPO'},
            {"orderable": false, data: 'ENVASE'},
            {"orderable": false, data: 'DIMENSION'},
            {"orderable": false, 
                render:function(data, type, row){
                    return '<div>'+
                    '</div>'
                }
            },            
            /*{"orderable": false, 
                render:function(data, type, row){
                    return '<div>'+
                    '<a data-toggle="modal" title="Ver" style="cursor:pointer; color:#3c763d;" data-target="#modalVerequi" onClick="javascript:selEquipo(\''+row.IDPROPU+'\',\''+row.CODCLIENTE+'\',\''+row.NROPROPU+'\',\''+row.FECHPROPU+'\',\''+row.IDSERV+'\',\''+row.DETAPROPU+'\',\''+row.COSTOTOTAL+'\',\''+row.ESTPROPU+'\',\''+row.CONTACTO+'\',\''+row.OBSPROPU+'\',\''+row.SERVNEW+'\',\''+row.CLIPOTEN+'\',\''+row.IDUSUARIO+'\',\''+row.TIPOCOSTO+'\',\''+row.ARCHIVO+'\',\''+row.CODESTABLE+'\',\''+row.RUTA+'\',\''+row.NOMBARCH+'\');"><span class="fas fa-edit" aria-hidden="true"> </span> </a>'+
                    '</div>'
                }
            },             
            {"orderable": false, 
                render:function(data, type, row){
                    return '<div>'+
                    '<a data-toggle="modal" title="Ver" style="cursor:pointer; color:#3c763d;" data-target="#modalVerequi" onClick="javascript:selEquipo(\''+row.IDPROPU+'\',\''+row.CODCLIENTE+'\',\''+row.NROPROPU+'\',\''+row.FECHPROPU+'\',\''+row.IDSERV+'\',\''+row.DETAPROPU+'\',\''+row.COSTOTOTAL+'\',\''+row.ESTPROPU+'\',\''+row.CONTACTO+'\',\''+row.OBSPROPU+'\',\''+row.SERVNEW+'\',\''+row.CLIPOTEN+'\',\''+row.IDUSUARIO+'\',\''+row.TIPOCOSTO+'\',\''+row.ARCHIVO+'\',\''+row.CODESTABLE+'\',\''+row.RUTA+'\',\''+row.NOMBARCH+'\');"><span class="fas fa-edit" aria-hidden="true"> </span> </a>'+
                    '</div>'
                }
            },*/
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