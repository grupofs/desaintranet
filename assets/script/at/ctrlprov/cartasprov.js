
var oTableListcartas;

$(document).ready(function() {
    
    $.ajax({
        type: 'ajax',
        method: 'post',
        url: baseurl+"at/ctrlprov/ccartasprov/getclientes",
        dataType: "JSON",
        async: true,
        success:function(result)
        {
            $('#cboClie').html(result);
        },
        error: function(){
            alert('Error, No se puede autenticar por error');
        }
    });

    $.ajax({
        type: 'ajax',
        method: 'post',
        url: baseurl+"cglobales/getanios",
        dataType: "JSON",
        async: true,
        success:function(result)
        {
            $('#cboAnio').html(result);
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


listarCartas = function(){
    oTableListcartas = $('#tblListcartas').DataTable({      
        'responsive'    : true,
        'bJQueryUI'     : true,
        'scrollY'     	: '400px',
        'scrollX'     	: true, 
        'paging'      	: true,
        'processing'  	: true,      
        'bDestroy'    	: true,
        "AutoWidth"     : false,
        'info'        	: true,
        'filter'      	: true, 
        "ordering"		: false,  
        'stateSave'     : true,
        'ajax'  : {
            "url"   : baseurl+"at/ctrlprov/ccartasprov/getbuscarcartas",
            "type"  : "POST", 
            "data": function ( d ) {
                d.anio      = $('#cboAnio').val();
                d.mes       = $('#cboMes').val();  
                d.ccliente  = $('#cboClie').val();  
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
            {data: 'cauditoriainspeccion',targets: 1 },
            {data: 'fservicio', targets: 2},
            {data: 'fcreacion', targets: 3},
            {data: 'proveedor', targets: 4},
            {data: 'ESTMAQ', targets: 5},
            {data: 'dlinea', targets: 6},
            {data: 'cchecklist', targets: 7},                        
            {"orderable": false, 
                render:function(data, type, row){
                    return '' ; 
                }
            },                        
            {"orderable": false, 
                render:function(data, type, row){
                    return '' ; 
                }
            }
        ], 
    });   
    // Enumeracion 
    oTableListcartas.on( 'order.dt search.dt', function () { 
        oTableListcartas.column(0, {search:'applied', order:'applied'}).nodes().each( function (cell, i) {
          cell.innerHTML = i+1;
          } );
    }).draw();     
};

$('#btnBuscar').click(function(){
    listarCartas();
});

$('#btnPrint').click(function(){
    var v_anio = $( "#cboAnio option:selected").attr("value");
    var v_mes = $( "#cboMes option:selected").attr("value");
    var v_clie = $( "#cboClie option:selected").attr("value");
    window.open(baseurl+"at/ctrlprov/ccartasprov/genpdfcartasprov/"+v_anio+"/"+v_mes+"/"+v_clie);
   /* var params = { 
        "anio"  : v_anio,
        "mes"   : v_mes,  
        "clie"  : v_clie 
    };  
    $.ajax({
      type: 'ajax',
      method: 'post',
      url: baseurl+"at/ctrlprov/ccartasprov/genpdfcartasprov",
      dataType: "JSON",
      async: true,
      data: params,
      success:function(result)
      {
          $('#cboDist').html(result);
      },
      error: function(){
        alert('Error, No se puede autenticar por error');
      }
    })*/
});