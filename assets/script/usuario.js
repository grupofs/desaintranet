
var otblListUsuarios;

$('#swVigencia').on('switchChange.bootstrapSwitch',function (event, state) {
    $('#btnBuscar').click();
});

$("#btnBuscar").click(function (){
    var vlvigencia;

    if($('#swVigencia').prop('checked')){
        vlvigencia = 'A';
    }else{
        vlvigencia = 'I';
    }

    otblListUsuarios = $('#tblListUsuarios').DataTable({  
        'responsive'    : true,
        'bJQueryUI'     : true,
        'scrollY'     	: '400px',
        'scrollX'     	: true, 
        'paging'      	: true,
        'processing'  	: true,     
        'bDestroy'    	: true,
        'AutoWidth'     : false,
        'info'        	: true,
        'filter'      	: true, 
        'ordering'		: true,  
        'stateSave'     : true,
        'ajax'	: {
            "url"   : baseurl+"cusuario/getbuscarusuarios/",
            "type"  : "POST", 
            "data": function ( d ) {
                d.usuario       = $('#txtusuario').val(); 
                d.tusuario      = $('#cboTusuario').val(); 
                d.vigencia      = vlvigencia; 
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
            {"orderable": false, data: 'CUSUARIO', targets: 1},
            {"orderable": false, data: 'USUARIO', targets: 2},
            {"orderable": false, data: 'DDATOS', targets: 3},
            {"orderable": false, data: 'DMAIL', targets: 4},
            {"orderable": false, data: 'NRODOC', targets: 5},
            {responsivePriority: 1, "orderable": false, "class": "col-xc", 
                render:function(data, type, row){
                    return '<div>'+
                    '<a data-toggle="modal" title="Editar" style="cursor:pointer; color:#3c763d;" data-target="#modalCreaPropu" onClick="objFormulario.mostrarModificacion(\''+row.IDUSUARIO+'\',\''+row.DDATOS+'\');"><span class="fas fa-edit" aria-hidden="true"> </span> </a>'+
                    '</div>'
                }
            }
        ]
    });   
    // Enumeracion 
    otblListUsuarios.on( 'order.dt search.dt', function () { 
        otblListUsuarios.column(0, {search:'applied', order:'applied'}).nodes().each( function (cell, i) {
          cell.innerHTML = i+1;
          } );
    }).draw();  
});


const objFormulario = {
};
$(function() {    
    /**
     * Muestra la lista ocultando el formulario
     */
    objFormulario.mostrarBusqueda = function () {
        const boton = $('#btnAccionContenedorLista');
        const icon = boton.find('i');
        if (icon.hasClass('fa-minus')) icon.removeClass('fa-minus');
        icon.addClass('fa-plus');
        boton.click();
        $('#contenedorCreausuario').hide();
        $('#contenedorEditausuario').hide();
        $('#contenedorBususuario').show();
    };

    /**
     * Muestra el formulario ocultando la lista
     */
    objFormulario.mostrarCreacion = function () {
        const boton = $('#btnAccionContenedorLista');
        const icon = boton.find('i');
        if (icon.hasClass('fa-plus')) icon.removeClass('fa-plus');
        icon.addClass('fa-minus');
        boton.click();
/*
        $('#fhdnidusuario').val(IDUSUARIO);
        document.querySelector('#lblusuario').innerText = DDATOS;
        
        var params = { "cestablecimiento":cestablecimiento};
        $.ajax({
            type: 'ajax',
            method: 'post',
            url: baseurl+"at/auditoria/cconsultauditor/getcboregAreazona",
            dataType: "JSON",
            async: true,
            data: params,
            success:function(result){
                $('#cboregAreazona').html(result);
            },
            error: function(){
                alert('Error, No se puede autenticar por error');
            }
        });*/

        $('#contenedorCreausuario').show();
        $('#contenedorEditausuario').hide();
        $('#contenedorBususuario').hide();
    };
    objFormulario.mostrarModificacion = function (IDUSUARIO,DDATOS) {
        const boton = $('#btnAccionContenedorLista');
        const icon = boton.find('i');
        if (icon.hasClass('fa-plus')) icon.removeClass('fa-plus');
        icon.addClass('fa-minus');
        boton.click();

        $('#fhdnidusuario').val(IDUSUARIO);
        document.querySelector('#lblusuario').innerText = DDATOS;
        /*
        var params = { "cestablecimiento":cestablecimiento};
        $.ajax({
            type: 'ajax',
            method: 'post',
            url: baseurl+"at/auditoria/cconsultauditor/getcboregAreazona",
            dataType: "JSON",
            async: true,
            data: params,
            success:function(result){
                $('#cboregAreazona').html(result);
            },
            error: function(){
                alert('Error, No se puede autenticar por error');
            }
        });*/

        $('#contenedorEditausuario').show();
        $('#contenedorCreausuario').hide();
        $('#contenedorBususuario').hide();
    };
});

$('#btnRetornarLista').click(function(){
    objFormulario.mostrarBusqueda();
});