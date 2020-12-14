var otblListIngreso, otblListIngresodet;
var varfdesde = '%', varfhasta = '%';


$(document).ready(function() {

    $("#btnImportar").prop("disabled",true);

    $('#txtFDesde,#txtFHasta').datetimepicker({
        format: 'DD/MM/YYYY',
        daysOfWeekDisabled: [0],
        locale:'es'
    });

    fechaActual();

    /*LLENADO DE COMBOS*/
    $.ajax({
        type: 'ajax',
        method: 'post',
        url: baseurl+"adm/conta/cingresos/getcboempresa",
        dataType: "JSON",
        async: true,
        success:function(result){
            $('#cboempresa').html(result);
        },
        error: function(){
            alert('Error, No se puede autenticar por error');
        }
    });

    
    $('#btnBuscar').click();
    
});

fechaActual = function(){
    var fecha = new Date();		
    var fechatring = ("0" + fecha.getDate()).slice(-2) + "/" + ("0"+(fecha.getMonth()+1)).slice(-2) + "/" +fecha.getFullYear() ;

    $('#txtFDesde').datetimepicker('date', moment(fechatring, 'DD/MM/YYYY') );
    $('#txtFHasta').datetimepicker('date', moment(fechatring, 'DD/MM/YYYY') );    

};

$('#txtFDesde').on('change.datetimepicker',function(e){	
    
    $('#txtFHasta').datetimepicker({
        format: 'DD/MM/YYYY',
        daysOfWeekDisabled: [0],
        locale:'es'
    });	

    var fecha = moment(e.date).format('DD/MM/YYYY');		
    
    $('#txtFHasta').datetimepicker('minDate', fecha);
    $('#txtFHasta').datetimepicker('date', fecha);

});

$("#chkFreg").on("change", function () {    
    if($("#chkFreg").is(":checked") == true){ 
        $("#txtFIni").prop("disabled",false);
        $("#txtFFin").prop("disabled",false);
        
        varfdesde = '';
        varfhasta = '';

        var fecha = new Date();		
        var fechatring1 = "01/01/" +fecha.getFullYear() ;
        var fechatring2 = ("0" + fecha.getDate()).slice(-2) + "/" + ("0"+(fecha.getMonth()+1)).slice(-2) + "/" +fecha.getFullYear() ;
        $('#txtFDesde').datetimepicker('date', fechatring1);
        $('#txtFHasta').datetimepicker('date', fechatring2);

    }else if($("#chkFreg").is(":checked") == false){ 
        $("#txtFIni").prop("disabled",true);
        $("#txtFFin").prop("disabled",true);
        
        varfdesde = '%';
        varfhasta = '%';

        fechaActual();
    }; 
});
  
$('#cbocia').change(function(){ 
    var v_ccia = $( "#cbocia option:selected").attr("value");
    var params = { 
        "ccia" : v_ccia
    }; 
    $.ajax({
        type: 'ajax',
        method: 'post',
        url: baseurl+"cglobales/getareacia",
        dataType: "JSON",
        async: true,
        data: params,
        success:function(result)
        {
            $('#cboarea').html(result);
        },
        error: function(){
          alert('Error, No se puede autenticar por error');
        }
    });

    var vccia = $('#cbocia').val();
    if(vccia != 0){
        $("#btnImportar").prop("disabled",false);
        if(vccia == '1'){
            var_text = 'GRUPO FS';
        }else{
            var_text = 'FS CERTIFICACIONES'
        }
        
    }else{
        $("#btnImportar").prop("disabled",true);
        var_text = ''
    }
    document.querySelector('#lblCia').innerText = var_text;
     
});

$("#btnBuscar").click(function (){    
    const boton = $('#btnBuscar');

    if(varfdesde != '%'){ varfdesde = $('#txtFIni').val(); }
    if(varfhasta != '%'){ varfhasta = $('#txtFFin').val(); }  

    otblListIngreso = $('#tblListIngreso').DataTable({  
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
            "url"   : baseurl+"adm/conta/cingresos/getbuscaringresos/",
            "type"  : "POST", 
            "data": function ( d ) {
                d.ccliente  = $('#cboempresa').val();
                d.fdesde    = varfdesde; 
                d.fhasta    = varfhasta;   
                d.ccia      = $('#cbocia').val();
                d.carea     = $('#cboarea').val(); 
                d.dnrodoc   = $('#txtnrodoc').val(); 
            },    
            beforeSend: function () {
                objPrincipal.botonCargando(boton);
            },   
            dataSrc: function (data) {
                objPrincipal.liberarBoton(boton);
                return data;
            },   
        },
        'columns'	: [
            {
              "class"     :   "index",
              orderable   :   false,
              data        :   null,
              targets     :   0
            },
            {
              "class"     :   "details-control",
              orderable   :   false,
              data        :   'SPACE',
              targets     :   1
            },
            {"orderable": false, data: 'NRODOCUMENTO', targets: 2},
            {"orderable": false, data: 'FECHAEMISION', targets: 3},
            {"orderable": false, data: 'EMPRESA', targets: 4},
            {"orderable": false, data: 'AREA', targets: 5},
            {"className": "dt-body-right", "orderable": false, data: 'BASE', targets: 6},
            {"className": "dt-body-right", "orderable": false, data: 'IGV', targets: 7},
            {"className": "dt-body-right", "orderable": false, data: 'TOTAL', targets: 8},
            {"className": "dt-body-right", "orderable": false, data: 'SALDO', targets: 9},            
            {"orderable": false, 
                render:function(data, type, row){
                    return '<div>'+
                    '<a data-toggle="modal" title="Editar" style="cursor:pointer; color:#3c763d;" data-target="#modalCreaIngreso" onClick="javascript:selEditar(\''+row.id_docingresos+'\',\''+row.CCIA+'\',\''+row.CAREA+'\',\''+row.serie_doc+'\',\''+row.nro_doc+'\',\''+row.FECHAEMISION+'\',\''+row.BASE+'\',\''+row.IGV+'\',\''+row.TOTAL+'\',\''+row.MONEDA+'\',\''+row.EMPRESA+'\',\''+row.DOCUMENTO+'\',\''+row.concepto+'\');"><span class="fas fa-edit" aria-hidden="true"> </span> </a>'+
                    '</div>'
                }
            },
            {"orderable": false, 
                render:function(data, type, row){
                    return '<div>'+
                    '<a data-toggle="modal" title="Pagar" style="cursor:pointer; color:#303879;" data-target="#modalPago" onClick="javascript:selPagar(\''+row.id_docingresos+'\',\''+row.id_ingresos+'\',\''+row.CCIA+'\',\''+row.CAREA+'\',\''+row.EMPRESA+'\',\''+row.DOCUMENTO+'\',\''+row.serie_doc+'\',\''+row.nro_doc+'\',\''+row.FECHAEMISION+'\',\''+row.concepto+'\',\''+row.BASE+'\',\''+row.IGV+'\',\''+row.TOTAL+'\',\''+row.MONEDA+'\',\''+row.SALDO+'\');"><span class="fas fa-cash-register" aria-hidden="true"> </span> </a>'+
                    '</div>'
                }
            }
        ],
        "columnDefs": [
            {
                "targets": [6], 
                "data": null, 
                "render": function(data, type, row) {
                    if(row.MONEDA == 'S' ){
                        return '<i style="color:#2248F2;">S/'+new Intl.NumberFormat("en", { minimumFractionDigits: 2 }).format(row.BASE)+'</i>';
                    }else{
                        return '<i style="color:#4E7457;">$'+new Intl.NumberFormat("en", { minimumFractionDigits: 2 }).format(row.BASE)+'</i>';
                    }
                }
            },{
                "targets": [7], 
                "data": null, 
                "render": function(data, type, row) {
                    if(row.MONEDA == 'S' ){
                        return '<i style="color:#2248F2;">S/'+new Intl.NumberFormat("en", { minimumFractionDigits: 2 }).format(row.IGV)+'</i>';
                    }else{
                        return '<i style="color:#4E7457;">$'+new Intl.NumberFormat("en", { minimumFractionDigits: 2 }).format(row.IGV)+'</i>';
                    }
                }
            },{
                "targets": [8], 
                "data": null, 
                "render": function(data, type, row) {
                    if(row.MONEDA == 'S'){
                        return '<i style="color:#2248F2;">S/'+new Intl.NumberFormat("en", { minimumFractionDigits: 2 }).format(row.TOTAL)+'</i>';
                    }else{
                        return '<i style="color:#4E7457;">$'+new Intl.NumberFormat("en", { minimumFractionDigits: 2 }).format(row.TOTAL)+'</i>';
                    }
                }
            },{
                "targets": [9], 
                "data": null, 
                "render": function(data, type, row) {
                    if(row.MONEDA == 'S'){
                        return '<i style="color:#2248F2;">S/'+new Intl.NumberFormat("en", { minimumFractionDigits: 2 }).format(row.SALDO)+'</i>';
                    }else{
                        return '<i style="color:#4E7457;">$'+new Intl.NumberFormat("en", { minimumFractionDigits: 2 }).format(row.SALDO)+'</i>';
                    }
                }
            }
        ],
        'order' : [[3, "desc"],[2, "asc"]] 
    });   
    // Enumeracion 
    otblListIngreso.on( 'order.dt search.dt', function () { 
        otblListIngreso.column(0, {search:'applied', order:'applied'}).nodes().each( function (cell, i) {
          cell.innerHTML = i+1;
          } );
    }).draw();  
});
/* DETALLE PAGO */
$('#tblListIngreso tbody').on( 'click', 'td.details-control', function () {
            
    var tr = $(this).closest('tr');
    var row = otblListIngreso.row(tr);
    var rowData = row.data();
    
    if ( row.child.isShown() ) {                    
        row.child.hide();
        tr.removeClass( 'details' );
    }
    else {
        
        row.child( 
           '<table id="tblListIngresodet" class="display compact" style="width:100%; padding-left:80px; background-color:#E9EBEC;">'+
           '<thead style="background-color:#C1DBFA;"><tr><th>Periodo</th><th>Fecha</th><th>Monto</th><th></th></tr></thead><tbody>' +
            '</tbody></table>').show();

            otblListIngresodet = $('#tblListIngresodet').DataTable({
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
                    "url"   : baseurl+"adm/conta/cingresos/getlistaringresos",
                    "type"  : "POST", 
                    "data": function ( d ) {
                        d.id_docingresos = rowData.id_docingresos;
                    },     
                    dataSrc : ''        
                },
                'columns'     : [
                    { "orderable": false,"data": "PERIODO", targets: 0 },
                    { "orderable": false,"data": "fecha_pago", targets: 1  },
                    { "orderable": false,"data": "monto_pago", targets: 2  },
                    {"orderable": false, 
                        render:function(data, type, row){
                            return  '<div>'+    
                            '&nbsp; &nbsp;'+
                            '</div>'
                        }
                    },
                              
                ], 
            });

        /*var params = {"id_docingresos" : rowData.id_docingresos}; 
        var otblListIngresodet = $('#tblListIngresodet').DataTable({            
            ajax: function (data, callback, settings) {
                  $.ajax({
                    type: 'ajax',
                    method: 'post',
                    url: BASE_URL+'adm/conta/cingresos/getlistaringresos/',
                    dataType: 'JSON',
                    async: true,
                    data:params ,
                  }).then ( function(json) {
                    var data = JSON.parse(json);
                    callback(data);  
                    
                    var c = (json);                    
                    $.each(c,function(i,item){
                        var display = [];
                        for (d = 0; d < c.length; d++) {
                            display.push(c[d]);
                            alert(c[d].PERIODO);
                        }
                    })                    
                    callback({data: display});
             
                  });
            },
            columns: [
                { "data": "PERIODO" },
                { "data": "fecha_pago" },
                { "data": "monto_pago" },
                {"orderable": false, 
                    render:function(data, type, row){
                        return '<div>'+
                        '<a data-toggle="modal" title="Editar" style="cursor:pointer; color:#3c763d;" data-target="#modalPago" onClick="javascript:selEditarPago(\''+row.id_docingresos+'\',\''+row.id_ingresos+'\',\''+row.ccliente+'\',\''+row.tipo_doc+'\',\''+row.serie_doc+'\',\''+row.nro_doc+'\',\''+row.FECHAEMISION+'\',\''+row.BASE+'\',\''+row.IGV+'\',\''+row.TOTAL+'\',\''+row.MONEDA+'\');"><span class="fas fa-edit" aria-hidden="true"> </span> </a>'+
                        '</div>'
                    }
                },
            ],
            initComplete: function () {
              init = false;
            },
            destroy: true,
            info: false,
            filter: false,
            "paging": false,
            scrollY: '100px',
            createdRow: function ( row, data, index ) {
              if (data.extn === '') {
                var td = $(row).find("td:first");
                td.removeClass( 'details-control' );
              }
             },
            rowCallback: function ( row, data, index ) {
              //console.log('rowCallback');
             }
        });*/
        tr.addClass('details');
    }

        /*var vardocingresos = A.id_docingresos;

        row.child(format()).show();  
        tr.addClass('details');
            
        otblListIngresodet = $('#tblListIngresodet').DataTable({ 
            'responsive'    : false,
            'bJQueryUI'     : true,
            'scrollY'     	: '200px',
            'scrollX'     	: true, 
            'paging'      	: true,
            'processing'  	: true,     
            'bDestroy'    	: true,
            'AutoWidth'     : false,
            'info'        	: false,
            'filter'      	: false, 
            'ordering'		: false,  
            'stateSave'     : true, 
            'ajax'	: {
                "url"   : baseurl+"adm/conta/cingresos/getlistaringresos/",
                "type"  : "POST", 
                "data": function ( d ) {
                    d.id_docingresos    = vardocingresos;   
                }  
            },
            'columns'	: [
                {"orderable": false, data: 'PERIODO', targets: 1},
                {"orderable": false, data: 'fecha_pago', targets: 2},
                {"orderable": false, data: 'monto_pago', targets: 3},
                {"orderable": false, 
                    render:function(data, type, row){
                        return '<div>'+
                        '<a data-toggle="modal" title="Editar" style="cursor:pointer; color:#3c763d;" data-target="#modalPago" onClick="javascript:selEditarPago(\''+row.id_docingresos+'\',\''+row.id_ingresos+'\',\''+row.ccliente+'\',\''+row.tipo_doc+'\',\''+row.serie_doc+'\',\''+row.nro_doc+'\',\''+row.FECHAEMISION+'\',\''+row.BASE+'\',\''+row.IGV+'\',\''+row.TOTAL+'\',\''+row.MONEDA+'\');"><span class="fas fa-edit" aria-hidden="true"> </span> </a>'+
                        '</div>'
                    }
                }
            ],
        });*/

        /*var A = row.data()
        var VCEVAL = A.CEVALUACIONPRODUCTO;
        var VCPRODUCTO = A.CPRODUCTOFSEVALUAR;
        
        $.post(baseurl+"coihomologaciones/getlistarrequisitos",
        {
            ceval:VCEVAL,
            cproducto:VCPRODUCTO
        },
        function(data){ 
            var c = JSON.parse(data);
            row.child( format(c, row.data()) ).show();  
            tr.addClass('details');       
        });  
    } */

});

iniCboarea = function(ccia,carea){    
    var params = { "ccia" : ccia };

    $.ajax({
        type: 'ajax',
        method: 'post',
        url: baseurl+"cglobales/getareacia",
        dataType: "JSON",
        async: true,
        data: params,
        success:function(result)
        {
            $('#cbomcarea').html(result);
            $('#cbomcarea').val(carea).trigger("change"); 
        },
        error: function(){
          alert('Error, No se puede autenticar por error');
        }
    }); 
};

selEditar = function(IDDOCINGRESOS,CCIA,CAREA,SERIEDOC,NRODOC,FECHAEMISION,BASE,IGV,TOTAL,MONEDA,EMPRESA,DOCUMENTO,CONCEPTO){
    $('#frmCreaIngreso').trigger("reset");
    $('#mhdnIddocingreso').val(IDDOCINGRESOS); 
    $('#mhdnAccionIngreso').val('A');

    iniCboarea(CCIA,CAREA);

    var var_text = '';
    if(CCIA == '1'){
        var_text = 'GRUPO FS';
    }else{
        var_text = 'FS CERTIFICACIONES'
    }
    document.querySelector('#lblmCia').innerText = var_text;
    
    varFactura = DOCUMENTO+' :: '+SERIEDOC+' - '+NRODOC;

    if(MONEDA == 'S'){
        varMoneda = 'S/.';
    }else{
        varMoneda = '$'
    }

    document.querySelector('#lblmFactura').innerText = varFactura;
    document.querySelector('#lblmFecha').innerText = FECHAEMISION;
    document.querySelector('#lblmEmpresa').innerText = EMPRESA;
    document.querySelector('#lblmConcepto').innerText = CONCEPTO;
    document.querySelector('#lblmBase').innerText = varMoneda+' '+new Intl.NumberFormat("en", { minimumFractionDigits: 2 }).format(BASE); 
    document.querySelector('#lblmIGV').innerText = varMoneda+' '+new Intl.NumberFormat("en", { minimumFractionDigits: 2 }).format(IGV);
    document.querySelector('#lblmTotal').innerText = varMoneda+' '+new Intl.NumberFormat("en", { minimumFractionDigits: 2 }).format(TOTAL);
          
};

$('#frmDocIngreso').submit(function(event){
    event.preventDefault();
    
    var request = $.ajax({
        url:$('#frmDocIngreso').attr("action"),
        type:$('#frmDocIngreso').attr("method"),
        data:$('#frmDocIngreso').serialize(),
        error: function(){
            Vtitle = 'No se puede registrar por error';
            Vtype = 'error';
            sweetalert(Vtitle,Vtype);
        }
    });
    request.done(function( respuesta ) {
        var posts = JSON.parse(respuesta);        
        $.each(posts, function() {        
            Vtitle = this.respuesta;
            Vtype = 'success';
            sweetalert(Vtitle,Vtype);
            otblListIngreso.ajax.reload(null,false);        
            $('#btnmCerDocingre').click();
        });
    });
});

selPagar = function(IDDOCINGRESOS,IDINGRESOS,CCIA,CAREA,EMPRESA,DOCUMENTO,SERIEDOC,NRODOC,FECHAEMISION,CONCEPTO,BASE,IGV,TOTAL,MONEDA,SALDO){
    $('#frmPago').trigger("reset");

    inipago(CCIA,CAREA,'','0');

    varFactura = DOCUMENTO+' :: '+SERIEDOC+' - '+NRODOC;

    if(MONEDA == 'S'){
        varMoneda = 'S/.';
    }else{
        varMoneda = '$'
    }

    document.querySelector('#lblFactura').innerText = varFactura;
    document.querySelector('#lblFecha').innerText = FECHAEMISION;
    document.querySelector('#lblEmpresa').innerText = EMPRESA;
    document.querySelector('#lblConcepto').innerText = CONCEPTO;
    document.querySelector('#lblBase').innerText = varMoneda+new Intl.NumberFormat("en", { minimumFractionDigits: 2 }).format(BASE); 
    document.querySelector('#lblIGV').innerText = varMoneda+new Intl.NumberFormat("en", { minimumFractionDigits: 2 }).format(IGV);
    document.querySelector('#lblTotal').innerText = varMoneda+new Intl.NumberFormat("en", { minimumFractionDigits: 2 }).format(TOTAL);

    $('#mhdnpAccionIngreso').val('N');
    $('#mtxtsaldopagar').val(new Intl.NumberFormat("en", { minimumFractionDigits: 2 }).format(SALDO));
    $('#panelPagar').show();
    
    $('#mhdnpIdingreso').val();
    $('#mhdnpIddocingreso').val(IDDOCINGRESOS); 

    $("#mtxtsaldopagar").prop({readonly:true}); 

    fechaActualPago();
        
};

inipago = function(ccia,carea,canio,cmes){    
    var params = { "ccia" : ccia };
    var vfecha = new Date();		
    var vanio = vfecha.getFullYear() ;
    if (canio == ''){
        canio = vanio;
    }

    $.ajax({
        type: 'ajax',
        method: 'post',
        url: baseurl+"cglobales/getanios",
        dataType: "JSON",
        async: true,
        success:function(result)
        {
            $('#mcboanio').html(result);
            $('#mcboanio').val(canio).trigger("change"); 
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
            $('#mcbomes').html(result);
            $('#mcbomes').val(cmes).trigger("change"); 
        },
        error: function(){
            alert('Error, No se puede autenticar por error');
        }
    });
    
    $.ajax({
        type: 'ajax',
        method: 'post',
        url: baseurl+"cglobales/getareacia",
        dataType: "JSON",
        async: true,
        data: params,
        success:function(result)
        {
            $('#mcboparea').html(result);
            $('#mcboparea').val(carea).trigger("change"); 
        },
        error: function(){
          alert('Error, No se puede autenticar por error');
        }
    });

    $.ajax({
        type: 'ajax',
        method: 'post',
        url: baseurl+"adm/conta/cingresos/getcodigocontain",
        dataType: "JSON",
        async: true,
        success:function(result)
        {
            $('#mcbocodigo').html(result);
        },
        error: function(){
            alert('Error, No se puede autenticar por error');
        }
    });

    $.ajax({
        type: 'ajax',
        method: 'post',
        url: baseurl+"adm/conta/cingresos/getctabancos",
        dataType: "JSON",
        async: true,
        success:function(result)
        {
            $('#mcbobanco').html(result);
        },
        error: function(){
            alert('Error, No se puede autenticar por error');
        }
    });
    
    $('#mtxtFechapago').datetimepicker({
        format: 'DD/MM/YYYY',
        daysOfWeekDisabled: [0],
        locale:'es'
    }); 
};
  
fechaActualPago = function(){
    var fecha = new Date();		
    var fechatring = ("0" + fecha.getDate()).slice(-2) + "/" + ("0"+(fecha.getMonth()+1)).slice(-2) + "/" +fecha.getFullYear() ;

    $('#mtxtFechapago').datetimepicker('date', moment(fechatring, 'DD/MM/YYYY') );  

}; 

$('#mcbotipopago').change(function(){
    var v_tipopago = $( "#mcbotipopago option:selected").attr("value");

    if(v_tipopago == 'T'){
        var vsaldo = $('#mtxtsaldopagar').val();
        $("#mtxtmontopagar").prop({readonly:true});
        $('#mtxtmontopagar').val(vsaldo); 
    }else{
        $("#mtxtmontopagar").prop({readonly:false}); 
        $('#mtxtmontopagar').val(new Intl.NumberFormat("en", { minimumFractionDigits: 2 }).format(0.00)); 
    }
});

$('#modalPago').on('shown.bs.modal', function (e) {  
});

$('#frmPago').submit(function(event){
    event.preventDefault();
    
    var request = $.ajax({
        url:$('#frmPago').attr("action"),
        type:$('#frmPago').attr("method"),
        data:$('#frmPago').serialize(),
        error: function(){
            Vtitle = 'No se puede registrar por error';
            Vtype = 'error';
            sweetalert(Vtitle,Vtype);
        }
    });
    request.done(function( respuesta ) {
        var posts = JSON.parse(respuesta);        
        $.each(posts, function() {        
            Vtitle = this.respuesta;
            Vtype = 'success';
            sweetalert(Vtitle,Vtype);
            otblListIngreso.ajax.reload(null,false);        
            $('#mbtnCPago').click();
        });
    });
});

$('#modalImportdoc').on('shown.bs.modal', function (e) {  
    $('#hdmccia').val($('#cbocia').val());
});

adjFile=function(){
    var archivoInput = document.getElementById('fileMigra');
    var archivoRuta = archivoInput.value;
    var extPermitidas = /(.xls)$/i;
    
    var filename = $('#fileMigra').val().replace(/.*(\/|\\)/, '');
    $('#txtFile').val(filename);
    

    if(!extPermitidas.exec(archivoRuta)){
        alert('Asegurese de haber seleccionado un XLS');
        archivoInput.value = '';  
        $('#txtFile').val('');
        return false;
    }    
};

$('#mbtnGUpload').click(function(){    
    var parametrotxt = new FormData($("#frmImportdoc")[0]);
    var request = $.ajax({
        data: parametrotxt,
        method: 'post',
        url: baseurl+"adm/conta/cingresos/import_nubefact",
        dataType: "JSON",
        async: true,
        contentType: false,
        processData: false,
        error: function(){
            alert('Error, no se cargó el archivo');
        }
    });
    request.done(function( respuesta ) {
        otblListIngreso.ajax.reload(null,false);      
        Vtitle = this.respuesta;
        Vtype = 'success';
        sweetalert(Vtitle,Vtype);    
        $('#frmImportdoc').trigger("reset");                 
        $('#mbtnCImport').click();
    });
});