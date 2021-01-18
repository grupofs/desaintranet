
var oTable_consolidado;
var cboEstado

$(document).ready(function() {

    $('#divAnio').show();
    $('#divMes').show();
    $('#divDesde').hide();
    $('#divHasta').hide();

        $("#BuscarPorP").focus();

        $('#FechaIni, #FechaFin').datepicker({
            format: "dd/mm/yyyy",
            autoclose: true,
        }).next().on("click", function () {
            $(this).prev().focus(); 
        });
        $('#FechaIni, #FechaFin').datepicker('setDate', new Date());
        
        $("#chkFreg").on("change", function () {
            if($("#chkFreg").is(":checked") == true){ 
                $("#FechaIni").prop("disabled",false);
                $("#FechaFin").prop("disabled",false);
                $("#cboAnio").prop("disabled",true);
                $("#cboMes").prop("disabled",true);
            }else if($("#chkFreg").is(":checked") == false){ 
                $("#FechaIni").prop("disabled",true);
                $("#FechaFin").prop("disabled",true);
                $("#cboAnio").prop("disabled",false);
                $("#cboMes").prop("disabled",false);
            }; 
        });

        /*LLENADO DE COMBOS*/         
        $.ajax({
            type: 'ajax',
            method: 'post',
            url: baseurl+"cmaestros/getanios",
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
            url: baseurl+"cmaestros/getmeses",
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

        var paramsclientecbo = {"ccliente" : '00654'};
        $.ajax({
            type: 'ajax',
            method: 'post',
            url: baseurl+"cmaestros/getproveedorxcclie",
            dataType: "JSON",
            async: true,
            data: paramsclientecbo,
            success:function(result)
            {
                $('#cboProveedor').html(result);
            },
            error: function(){
              alert('Error, No se puede autenticar por error');
            }
        });

        $.ajax({
            type: 'ajax',
            method: 'post',
            url: baseurl+"cmaestros/getmaquiladorxcclie",
            dataType: "JSON",
            async: true,
            data: paramsclientecbo,
            success:function(result)
            {
                $('#cboMaquilador').html(result);
            },
            error: function(){
              alert('Error, No se puede autenticar por error');
            }
        });

        var paramsareaclie = { 
            "ccia"          : '2',
            "ccliente"      : v_ccliente,
        };
        $.ajax({
            type: 'ajax',
            method: 'post',
            url: baseurl+"cmaestros/getareacliente",
            dataType: "JSON",
            async: true,
            data: paramsareaclie,
            success:function(result)
            {
                $('#cboAreaclie').html(result);
            },
            error: function(){
              alert('Error, No se puede autenticar por error');
            }
        });    
   
});

$('input[type=radio][name=rFbuscar]').change(function() {
    if($('#rdPeriodo').prop('checked')){        
        $('#divAnio').show();
        $('#divMes').show();
        $('#divDesde').hide();
        $('#divHasta').hide();
    }else if ($('#rdFechas').prop('checked')){     
        $('#divAnio').hide();
        $('#divMes').hide();
        $('#divDesde').show();
        $('#divHasta').show();
    } 
});



    $('#cboCliente').change(function(){ 
        var v_ccliente = $( "#cboCliente option:selected").attr("value");

        

    })

    $('#btnBuscarListado').click(function(){
        var vfini, vffin, vanio, vmes, conce

        if($("#chkFreg").is(":checked") == true){ 
            vfini = $('#FechaIni').val();
            vffin = $('#FechaFin').val();
            vanio = '0';
            vmes  = '0';
        }
        else if($("#chkFreg").is(":checked") == false){ 
            vfini = '%';
            vffin = '%';
            vanio = $('#cboAnio').val();
            vmes  = $('#cboMes').val();
        };
        
        if ($("#BuscarPorP").is(":checked")) {
            conce = 'N';
        }else{
            conce = 'S';
        }
        
        if(document.getElementById("cboEstado").value == ""){
            cboEstado = ["%"];
        }else{
            cboEstado = $('#cboEstado').val();
        }
          
        oTable_consolidado = $('#tblconsolidado').DataTable({
            'bJQueryUI'     : true,
            'scrollY'       : '400px',
            'scrollX'       : true,
            'processing'    : true,     
            'bDestroy'      : true,
            'paging'        : false,
            'info'          : true,
            'filter'        : true, 
            'ajax'          : {
                "url"   : baseurl+"oi/cctrlproveedores/getconsolidadocencosud/",
                "type"  : "POST", 
                "data"  : function ( d ) {
                    d.ccia = '2';
                    d.carea = '01';
                    d.cservicio = '01';
                    d.anio = vanio; 
                    d.mes = vmes;  
                    d.fini = vfini; 
                    d.ffin = vffin;  
                    d.ccliente = $('#cboCliente').val();
                    d.proveedor = $('#cboProveedor').val();
                    d.maquilador = $('#cboMaquilador').val();  
                    d.ciudad = $('#txtCiudad').val(); 
                    d.marca = $('#txtMarca').val(); 
                    d.estado = cboEstado; 
                    d.areaclie = $('#cboAreaclie').val();
                    d.esconcesionario = conce;  
                },     
                dataSrc : ''        
            },
            'columns'   : [
                {
                    "class"     :   "index",
                    orderable   :   false,
                    data        :   null,
                    targets     :   0
                },
                {data: 'VENTASMARCAS',targets: 1 },
                {data: 'ANIO', targets: 2},
                {data: 'DIVISION', targets: 3},
                {data: 'CATEGORIASECCION', targets: 4, "class": "col-medio"},
                {data: 'RUC', targets: 5},
                {data: 'PROVEEDOR', targets: 6, "class": "col-largo"},
                {data: 'LINEADEPRODUCCION', targets: 7, "class": "col-largo"},
                {data: 'MARCA', targets: 8, "class": "col-medio"},
                {data: 'DIRECCION', targets: 9, "class": "col-largo"},
                {data: 'TIPO', targets: 10},
                {data: 'PROG', targets: 11},
                {data: 'MESPROG', targets: 12},
                {data: 'MESEJE', targets: 13},
                {data: 'FECHAEJE', targets: 14},
                {data: 'LABORATORIO', targets: 15},
                {data: 'ESTADO', targets: 16, "class": "col-medio"},
                {data: 'OBSERVACIONES', targets: 17, "class": "col-largo"},
                {data: 'CALIFICACION', targets: 18},
                {data: 'CLASIFICACION', targets: 19, "class": "col-medio"},
                {data: 'COSTOSIGV', targets: 20},
                {data: 'GASTOSPORVIATICOS', targets: 21},
                {data: 'EMAIL', targets: 22},
            ], 
            "columnDefs" : [
                {
                    "defaultContent": " ",
                    "targets": "_all"
                },
            ],
            'order'       : [[ 14, "asc" ]] 
        });
        // Enumeracion 
        oTable_consolidado.on( 'order.dt search.dt', function () { 
            oTable_consolidado.column(0, {search:'applied', order:'applied'}).nodes().each( function (cell, i) {
            cell.innerHTML = i+1;
            });
        } ).draw(); 
         
    });