var otblListIngreso
var varfdesde = '%', varfhasta = '%';


$(document).ready(function() {
    $('#txtFDesde,#txtFHasta').datetimepicker({
        format: 'DD/MM/YYYY',
        daysOfWeekDisabled: [0],
        locale:'es'
    });

    $('#txtFechaaudi').datetimepicker({
        format: 'DD/MM/YYYY',
        daysOfWeekDisabled: [0],
        locale:'es'
    });

    fechaActual();

    $('#cbocia').val('0').trigger("change");

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
});

$("#btnBuscar").click(function (){    
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
            dataSrc : ''        
        },
        'columns'	: [
            {
              "class"     :   "index",
              orderable   :   false,
              data        :   null,
              targets     :   0
            },
            {"orderable": false, data: 'DOCUMENTO', targets: 1},
            {"orderable": false, data: 'NRODOCUMENTO', targets: 2},
            {"orderable": false, data: 'FECHAEMISION', targets: 3},
            {"orderable": false, data: 'EMPRESA', targets: 4},
            {"orderable": false, data: 'AREA', targets: 5},
            {"className": "dt-body-right", "orderable": false, data: 'BASE', targets: 6},
            {"className": "dt-body-right", "orderable": false, data: 'IGV', targets: 7},
            {"className": "dt-body-right", "orderable": false, data: 'TOTAL', targets: 8},
            {"orderable": false, 
                render:function(data, type, row){
                    return '<div>'+
                    '<a data-toggle="modal" title="Editar" style="cursor:pointer; color:#3c763d;" data-target="#modalCreaIngreso" onClick="javascript:selEditar(\''+row.id_docingresos+'\',\''+row.id_ingresos+'\',\''+row.ccliente+'\',\''+row.tipo_doc+'\',\''+row.serie_doc+'\',\''+row.nro_doc+'\',\''+row.FECHAEMISION+'\',\''+row.BASE+'\',\''+row.IGV+'\',\''+row.TOTAL+'\',\''+row.MONEDA+'\');"><span class="fas fa-edit" aria-hidden="true"> </span> </a>'+
                    '</div>'
                }
            },
            {"orderable": false, 
                render:function(data, type, row){
                    return '<div>'+
                    '<a data-toggle="modal" title="Pagar" style="cursor:pointer; color:#303879;" data-target="#modalCreaIngreso" onClick="javascript:selPagar(\''+row.id_docingresos+'\',\''+row.id_ingresos+'\',\''+row.ccliente+'\',\''+row.tipo_doc+'\',\''+row.serie_doc+'\',\''+row.nro_doc+'\',\''+row.FECHAEMISION+'\',\''+row.BASE+'\',\''+row.IGV+'\',\''+row.TOTAL+'\',\''+row.MONEDA+'\');"><span class="fas fa-cash-register" aria-hidden="true"> </span> </a>'+
                    '</div>'
                }
            }
        ],
        "columnDefs": [{
            "targets": [6], 
            "data": null, 
            "render": function(data, type, row) {
                if(row.MONEDA == 'S' ){
                    return '<i style="color:#2248F2;">S/'+row.BASE+'</i>';
                }else{
                    return '<i style="color:#4E7457;">$'+row.BASE+'</i>';
                }
            }
        },{
            "targets": [7], 
            "data": null, 
            "render": function(data, type, row) {
                if(row.MONEDA == 'S' ){
                    return '<i style="color:#2248F2;">S/'+row.IGV+'</i>';
                }else{
                    return '<i style="color:#4E7457;">$'+row.IGV+'</i>';
                }
            }
        },
        {
            "targets": [8], 
            "data": null, 
            "render": function(data, type, row) {
                if(row.MONEDA == 'S'){
                    return '<i style="color:#2248F2;">S/'+row.TOTAL+'</i>';
                }else{
                    return '<i style="color:#4E7457;">$'+row.TOTAL+'</i>';
                }
            }
        }]
    });   
    // Enumeracion 
    otblListIngreso.on( 'order.dt search.dt', function () { 
        otblListIngreso.column(0, {search:'applied', order:'applied'}).nodes().each( function (cell, i) {
          cell.innerHTML = i+1;
          } );
    }).draw();  
});

$('#btnNuevo').click(function(){
    $('#frmCreaIngreso').trigger("reset");
    $('#mhdnAccionIngreso').val('N');
    $('#panelPagar').hide();

    iniCbo('0');
  
    $("#mcboempresa").prop({disabled:false});
    $("#mcbotipodoc").prop({disabled:false});
    $("#mtxtcorredoc").prop({readonly:false});
    $("#mtxtnrodoc").prop({readonly:false});    
    $("#mtxtFemidoc").prop("disabled",false);
    $("#mtxtmontobase").prop({readonly:false});
    $("#mtxtmontoigv").prop({readonly:false});
    $("#mtxtmontototal").prop({readonly:false});
    $("#mcbotipomoneda").prop({disabled:false});

});

iniCbo = function(CCLIENTE){
    $.ajax({
        type: 'ajax',
        method: 'post',
        url: baseurl+"adm/conta/cingresos/getcboempresa",
        dataType: "JSON",
        async: true,
        success:function(result){
            $('#mcboempresa').html(result);            
            $('#mcboempresa').val(CCLIENTE).trigger("change");
        },
        error: function(){
            alert('Error, No se puede autenticar por error');
        }
    }); 
};

selEditar = function(IDDOCINGRESOS, IDINGRESOS,CCLIENTE,TIPODOC,SERIEDOC,NRODOC,FECHAEMISION,BASE,IGV,TOTAL,MONEDA){
    $('#frmCreaIngreso').trigger("reset");

    iniCbo(CCLIENTE);
  
    $("#mcboempresa").prop({disabled:true});
    $("#mcbotipodoc").prop({disabled:false});
    $("#mtxtcorredoc").prop({readonly:false});
    $("#mtxtnrodoc").prop({readonly:false});    
    $("#mtxtFemidoc").prop("disabled",false);
    $("#mtxtmontobase").prop({readonly:false});
    $("#mtxtmontoigv").prop({readonly:false});
    $("#mtxtmontototal").prop({readonly:false});
    $("#mcbotipomoneda").prop({disabled:true});
    $('#mhdnAccionIngreso').val('A');
    $('#panelPagar').hide();
    
    $('#mhdnIdingreso').val(IDINGRESOS);
    $('#mhdnIddocingreso').val(IDDOCINGRESOS);
    $('#mcbotipodoc').val(TIPODOC).trigger("change");
    $('#mtxtcorredoc').val(SERIEDOC);
    $('#mtxtnrodoc').val(NRODOC);
    $('#mtxtFemidoc').val(FECHAEMISION);
    $('#mcbotipomoneda').val(MONEDA);
    $('#mtxtmontobase').val(BASE);
    $('#mtxtmontoigv').val(IGV);
    $('#mtxtmontototal').val(TOTAL);
    
};

selPagar = function(IDDOCINGRESOS, IDINGRESOS,CCLIENTE,TIPODOC,SERIEDOC,NRODOC,FECHAEMISION,BASE,IGV,TOTAL,MONEDA){
    $('#frmCreaIngreso').trigger("reset");

    iniCbo(CCLIENTE);

    $("#mcboempresa").prop({disabled:true});
    $("#mcbotipodoc").prop({disabled:true});
    $("#mtxtcorredoc").prop({readonly:true});
    $("#mtxtnrodoc").prop({readonly:true});    
    $("#mtxtFemidoc").prop("disabled",true);
    $("#mtxtmontobase").prop({readonly:true});
    $("#mtxtmontoigv").prop({readonly:true});
    $("#mtxtmontototal").prop({readonly:true});
    $("#mcbotipomoneda").prop({disabled:true});
    $('#mhdnAccionIngreso').val('P');
    $('#panelPagar').show();
    
    $('#mhdnIdingreso').val(IDINGRESOS);
    $('#mhdnIddocingreso').val(IDDOCINGRESOS);
    $('#mcbotipodoc').val(TIPODOC).trigger("change");
    $('#mtxtcorredoc').val(SERIEDOC);
    $('#mtxtnrodoc').val(NRODOC);
    $('#mtxtFemidoc').val(FECHAEMISION);
    $('#mcbotipomoneda').val(MONEDA);
    $('#mtxtmontobase').val(BASE);
    $('#mtxtmontoigv').val(IGV);
    $('#mtxtmontototal').val(TOTAL);
    
};

$('#modalCreaIngreso').on('shown.bs.modal', function (e) { 
    
});

$('#frmCreaIngreso').submit(function(event){
    event.preventDefault();
    
    var request = $.ajax({
        url:$('#frmCreaIngreso').attr("action"),
        type:$('#frmCreaIngreso').attr("method"),
        data:$('#frmCreaIngreso').serialize(),
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
            $('#mbtnCCreaingre').click();
        });
    });
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
        tblListIngreso.ajax.reload(null,false);      
        Vtitle = this.respuesta;
        Vtype = 'success';
        sweetalert(Vtitle,Vtype);    
        $('#frmImportdoc').trigger("reset");                 
        $('#mbtnCImportparti').click();
    });
});