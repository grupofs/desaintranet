var oTable_listacodigo;

$(document).ready(function () {
    
});

/*CODIGO*/
listarCodigo = function(){
    oTable_listacodigo = $('#tablalistaCodigoconta').DataTable({
        'bJQueryUI'     : true,
        'scrollY'     	: '280px',
        'scrollX'     	: true, 
        'paging'      	: true,
        'processing'  	: true,      
        'bDestroy'    	: true,
        'info'        	: true,
        'filter'      	: true, 
        "ordering"		: false,  
        'stateSave'     : true,  
        'ajax'        : {
            "url"   : baseurl+"adm/conta/cmaestros/getlistarcodigo/",
            "type"  : "POST", 
            "data"  : function (d) {  
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
            {data: 'ID', targets: 1},
            {data: 'CODIGO', targets: 2},
            {data: 'DESCODIGO',targets: 3},                          
            {"orderable": false, 
                render:function(data, type, row){
                    return '<div>' + 
                        '<a title="Editar" style="cursor:pointer; color:#3c763d;" onclick="javascript:seleCodigo(\''+row.ID+'\',\''+row.CODIGO+'\',\''+row.DESCODIGO+'\',\''+row.GRUPO+'\');"><span class="fas fa-edit" aria-hidden="true"> </span> </a>' +
                        '</div>' ; 
                }
            }
        ]
    });
    // Enumeracion 
    oTable_listacodigo.on( 'order.dt search.dt', function () { 
        oTable_listacodigo.column(0, {search:'applied', order:'applied'}).nodes().each( function (cell, i) {
        cell.innerHTML = i+1;
        } );
    }).draw();  
};

$('#collapseCodigo').on('show.bs.collapse', function () {
    listarCodigo();
});

seleCodigo = function(ID,CODIGO,DESCODIGO,GRUPO){   
    $('#mhdnIdcodigo').val(ID);        
    $('#cbogrupocod').val(GRUPO).trigger("change");  
    $('#mtxtcodigo').val(CODIGO);     
    $('#mtxtcodigodesc').val(DESCODIGO);
           

    $('#mhdnAccionCod').val('A');   
};

$('#frmRegCodigoconta').submit(function(event){
    event.preventDefault();

    $.ajax({
        url:$('#frmRegCodigoconta').attr("action"),
        type:$('#frmRegCodigoconta').attr("method"),
        data:$('#frmRegCodigoconta').serialize(),
        success: function (respuesta){            
            oTable_listacodigo.ajax.reload(null,false);
            Vtitle = 'Se Grabo Correctamente';
            Vtype = 'success';
            sweetalert(Vtitle,Vtype);
            $('#btnNuevoCod').click();  
        },
        error: function(){
            Vtitle = 'No se puede Grabar por error';
            Vtype = 'error';
            sweetalert(Vtitle,Vtype); 
        }
    });
});

$('#btnNuevoCod').click(function(){
    $('#frmRegCodigoconta').trigger("reset");
    $('#mhdnIdcodigo').val(''); 
    $('#mhdnAccionCod').val('N');
    $('#cbogrupocod').val('0').trigger("change");
});