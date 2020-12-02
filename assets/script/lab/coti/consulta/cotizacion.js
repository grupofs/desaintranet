
var otblListCotizacion, otblListProducto, otblListEnsayos;
var varfdesde = '%', varfhasta = '%';


$(document).ready(function() {
    $('#tablab a[href="#tablab-list-tab"]').attr('class', 'disabled');
    $('#tablab a[href="#tablab-reg-tab"]').attr('class', 'disabled active');

    $('#tablab a[href="#tablab-list-tab"]').not('#store-tab.disabled').click(function(event){
        $('#tablab a[href="#tablab-list"]').attr('class', 'active');
        $('#tablab a[href="#tablab-reg"]').attr('class', '');
        return true;
    });
    $('#tablab a[href="#tablab-reg-tab"]').not('#bank-tab.disabled').click(function(event){
        $('#tablab a[href="#tablab-reg"]').attr('class' ,'active');
        $('#tablab a[href="#tablab-list"]').attr('class', '');
        return true;
    });
    
    $('#tablab a[href="#tablab-list"]').click(function(event){return false;});
    $('#tablab a[href="#tablab-reg"]').click(function(event){return false;});

    $('#txtFDesde,#txtFHasta,#mtxtFCoti').datetimepicker({
        format: 'DD/MM/YYYY',
        daysOfWeekDisabled: [0],
        locale:'es'
    });

    $("#mtxtregnumcoti").prop({readonly:true});  
    $("#mtxtregestado").prop({readonly:true});
    
    fechaActual();

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

    $('#frmRegCoti').validate({
        rules: {
          cboregserv: {
            required: true,
          },
          cboregclie: {
            required: true,
          },
        },
        messages: {
          cboregserv: {
            required: "Por Favor escoja un Servicio"
          },
          cboregclie: {
            required: "Por Favor escoja un Cliente"
          },
        },
        errorElement: 'span',
        errorPlacement: function (error, element) {
          error.addClass('invalid-feedback');
          element.closest('.form-group').append(error);
        },
        highlight: function (element, errorClass, validClass) {
          $(element).addClass('is-invalid');
        },
        unhighlight: function (element, errorClass, validClass) {
          $(element).removeClass('is-invalid');
        },        
        submitHandler: function (form) {
            var request = $.ajax({
                url:$('#frmRegCoti').attr("action"),
                type:$('#frmRegCoti').attr("method"),
                data:$('#frmRegCoti').serialize(),
                error: function(){
                Vtitle = 'Error en Guardar!!!';
                Vtype = 'error';
                sweetalert(Vtitle,Vtype); 
                }
            });
            request.done(function( respuesta ) {
                var posts = JSON.parse(respuesta);
                
                $.each(posts, function() {
                    $('#regProductos').show(); 
                    $('#hdnAccionregcoti').val('A'); 
                    $('#mtxtidcotizacion').val(this.cinternocotizacion);
                    $('#mtxtregnumcoti').val(this.dcotizacion);
                    Vtitle = 'Cotizacion Guardada!!!';
                    Vtype = 'success';
                    sweetalert(Vtitle,Vtype);     
                });
            });
            return false;
        }
    });

    $('#frmCreaProduc').validate({
        rules: {
            mcboregLocalclie: {
                required: true,
            },
            mtxtregProducto: {
                required: true,
            },
            mtxtregmuestra: {
                required: true,
            },
        },
        messages: {
            mcboregLocalclie: {
                required: "Por Favor escoja un Local del Cliente"
            },
            mtxtregProducto: {
                required: "Por Favor ingrese Nombre del Producto"
            },
            mtxtregmuestra: {
                required: "Por Favor ingrese un numerod e muestra"
            },
        },
        errorElement: 'span',
        errorPlacement: function (error, element) {
          error.addClass('invalid-feedback');
          element.closest('.form-group').append(error);
        },
        highlight: function (element, errorClass, validClass) {
          $(element).addClass('is-invalid');
        },
        unhighlight: function (element, errorClass, validClass) {
          $(element).removeClass('is-invalid');
        },        
        submitHandler: function (form) {
            var request = $.ajax({
                url:$('#frmCreaProduc').attr("action"),
                type:$('#frmCreaProduc').attr("method"),
                data:$('#frmCreaProduc').serialize(),
                error: function(){
                    Vtitle = 'Error en Guardar!!!';
                    Vtype = 'error';
                    sweetalert(Vtitle,Vtype); 
                }
            });
            request.done(function( respuesta ) {
                var posts = JSON.parse(respuesta);
                
                $.each(posts, function() {
                    otblListProducto.ajax.reload(null,false);
                    Vtitle = 'Producto registrado Guardada!!!';
                    Vtype = 'success';
                    sweetalert(Vtitle,Vtype);     
                });
            });
            return false;
        }
    });
 
});

const objFormulario = {
};
$(function() {    
    /**
     * Muestra la lista ocultando el formulario
     */
    objFormulario.mostrarCotizacion = function () {
        const boton = $('#btnAccionContenedorLista');
        const icon = boton.find('i');
        if (icon.hasClass('fa-minus')) icon.removeClass('fa-minus');
        icon.addClass('fa-plus');
        boton.click();
        $('#contenedorRegensayo').hide();
        $('#contenedorCotizacion').show();
        //objFiltro.buscar()
    };

    /**
     * Muestra el formulario ocultando la lista
     */
    objFormulario.addRegistroEnsayo = function (ccliente,cauditoriainspeccion,fservicio,cchecklist,cestablecimiento,ddataobject) {
        const boton = $('#btnAccionContenedorLista');
        const icon = boton.find('i');
        if (icon.hasClass('fa-plus')) icon.removeClass('fa-plus');
        icon.addClass('fa-minus');
        boton.click();

        $('#hdnCcliente').val(ccliente);
        $('#hdnIdaudi').val(cauditoriainspeccion);
        $('#hdnFaudi').val(fservicio);
        $('#hdnChecklist').val(cchecklist);
        $('#hdnDataobject').val(ddataobject);
        
        //listarChecklist();
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
        });

        $('#contenedorRegensayo').show();
        $('#contenedorCotizacion').hide();
    };
});

fechaActual = function(){
    var fecha = new Date();		
    var fechatring = ("0" + fecha.getDate()).slice(-2) + "/" + ("0"+(fecha.getMonth()+1)).slice(-2) + "/" +fecha.getFullYear() ;

    $('#txtFDesde').datetimepicker('date', moment(fechatring, 'DD/MM/YYYY') );
    $('#txtFHasta').datetimepicker('date', moment(fechatring, 'DD/MM/YYYY') );
    $('#mtxtFCoti').datetimepicker('date', moment(fechatring, 'DD/MM/YYYY') );

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

$("#btnBuscar").click(function (){
    listarBusqueda();
});

listarBusqueda = function(){
    if(varfdesde != '%'){ varfdesde = $('#txtFIni').val(); }
    if(varfhasta != '%'){ varfhasta = $('#txtFFin').val(); } 
    
    var groupColumn = 0;   
    otblListCotizacion = $('#tblListCotizacion').DataTable({  
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
            "url"   : baseurl+"lab/coti/ccotizacion/getbuscarcotizacion/",
            "type"  : "POST", 
            "data": function ( d ) {
                d.ccliente  = $('#cboclieserv').val();
                d.fini      = varfdesde; 
                d.ffin      = varfhasta;   
                d.descr     = $('#txtdescri').val();  
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
            {"orderable": false, data: 'DFECHA', targets: 3},
            {"orderable": false, data: 'PRECIO', targets: 4},
            {"orderable": false, data: 'ELABORADO', targets: 5},
            {"orderable": false, 
                render:function(data, type, row){
                    return '<div class="text-left" >' +
                        '<a title="Editar" style="cursor:pointer; color:green;" onClick="selCoti(\'' + row.IDCOTIZACION + '\',\'' + row.NVERSION + '\',\'' + row.DFECHA + '\',\'' + row.NROCOTI + '\',\'' + row.SCOTIZACION + '\',\'' + row.VIGENCIACOTI + '\',\'' + row.SREGISTRO + '\',\'' + row.CCLIENTE + '\',\'' + row.CPROVEEDOR + '\',\'' + row.TIPOCAMBIO + '\',\'' + row.SUBSERVICIO + '\',\'' + row.MONEDA + '\',\'' + row.SMUESTREO + '\',\'' + row.CONTACTO + '\',\'' + row.PERMANMUESTRA + '\',\'' + row.TIPOPAGO + '\',\'' + row.OTROPAGO + '\',\'' + row.NTIEMPOENTREGAINFO + '\',\'' + row.STIEMPOENTREGAINFO + '\',\'' + row.OBSERVA + '\',\'' + row.VERPRECIO + '\',\'' + row.IMUESTREO + '\',\'' + row.PIGV + '\',\'' + row.PDESCUENTO + '\',\'' + row.ISUBTOTAL + '\',\'' + row.ITOTAL + '\');"><span class="fas fa-edit fa-2x" aria-hidden="true"> </span> </a>'+
                    '</div>';
                }
            }
        ],  
        "columnDefs": [{
            "targets": [2], 
            "data": null, 
            "render": function(data, type, row) {
                return '<div>'+
                '    <p><a title="Cotozacion" style="cursor:pointer;" onclick="pdfCoti(\'' + row.IDCOTIZACION + '\',\'' + row.NVERSION + '\');"  class="pull-left">'+row.NROCOTI+'&nbsp;&nbsp;'+row.DESTADO+'&nbsp;<i class="fas fa-file-pdf" style="color:#FF0000;"></i></a><p>' +
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
    otblListCotizacion.column(0).visible( false ); 
    otblListCotizacion.column(1).visible( false );      
    // Enumeracion 
    otblListCotizacion.on( 'order.dt search.dt', function () { 
        otblListCotizacion.column(0, {search:'applied', order:'applied'}).nodes().each( function (cell, i) {
          cell.innerHTML = i+1;
          } );
    }).draw();   
};

pdfCoti = function(idcoti,nversion){
    window.open(baseurl+"lab/coti/ccotizacion/pdfCoti/"+idcoti+"/"+nversion);
};

$('#btnNuevo').click(function(){
    
    $('#tablab a[href="#tablab-reg"]').tab('show'); 
    $('#frmRegCoti').trigger("reset");
    fechaActualReg();
    iniRegCoti("%","%","%","%");
    $('#hdnAccionregcoti').val('N');
    
    $('#mtxtidcoti').val(''); 
    $('#txtporctigv').val('18');
    $('#hdnregestado').val('N');
    $('#mtxtregestado').val('ABIERTO');    
    $('#txtregtipodias').val('C');  
    $('#txtregformapagos').val('061');  
    $('#mtxtregtipopagos').val('S');  


    $('#mtxtregpagotro').hide();
    $('#mtxtregtipocambio').hide();
    $('#regProductos').hide(); 
        
    $("#txtmontmuestreo").prop({readonly:true});
    $("#txtmontsubtotal").prop({readonly:true}); 
    $("#txtporctigv").prop({readonly:true});
    $("#txtmonttotal").prop({readonly:true});
});

fechaActualReg = function(){
    var fecha = new Date();		
    var fechatring = ("0" + fecha.getDate()).slice(-2) + "/" + ("0"+(fecha.getMonth()+1)).slice(-2) + "/" +fecha.getFullYear() ;
    $('#mtxtFCoti').datetimepicker('date', moment(fechatring, 'DD/MM/YYYY') );

};

iniRegCoti = function(subservicio,ccliente,cproveedor,ccontacto){

    $.ajax({
        type: 'ajax',
        method: 'post',
        url: baseurl+"lab/coti/ccotizacion/getcboregserv",
        dataType: "JSON",
        async: true,
        success:function(result)
        {
            $('#cboregserv').html(result);
            $('#cboregserv').val(subservicio).trigger("change"); 
        },
        error: function(){
            alert('Error, No se puede autenticar por error');
        }
    }); 

    $.ajax({
        type: 'ajax',
        method: 'post',
        url: baseurl+"lab/coti/ccotizacion/getcliente",
        dataType: "JSON",
        async: true,
        success:function(result)
        {
            $('#cboregclie').html(result);
            $('#cboregclie').val(ccliente).trigger("change"); 
        },
        error: function(){
            alert('Error, No se puede autenticar por error');
        }
    }); 
    /* 
    var params = { "ccliente":ccliente};
    $.ajax({
        type: 'ajax',
        method: 'post',
        url: baseurl+"lab/coti/ccotizacion/getprovcliente",
        dataType: "JSON",
        async: true,
        data: params,
        success:function(result)
        {
            $('#cboregprov').html(result);
            $('#cboregprov').val(cproveedor).trigger("change"); 
        },
        error: function(){
            alert('Error, No se puede autenticar por error');
        }
    }); 
    $.ajax({
        type: 'ajax',
        method: 'post',
        url: baseurl+"lab/coti/ccotizacion/getcontaccliente",
        dataType: "JSON",
        async: true,
        data: params,
        success:function(result)
        {
            $('#cboregcontacto').html(result);
            $('#cboregcontacto').val(ccontacto).trigger("change"); 
        },
        error: function(){
            alert('Error, No se puede autenticar por error');
        }
    });
    */  
};

$("#cboregclie").change(function(){ 
    var v_idcliente = $('#cboregclie').val();

    var params = { "ccliente":v_idcliente};
    $.ajax({
        type: 'ajax',
        method: 'post',
        url: baseurl+"lab/coti/ccotizacion/getprovcliente",
        dataType: "JSON",
        async: true,
        data: params,
        success:function(result)
        {
            $('#cboregprov').html(result);
        },
        error: function(){
            alert('Error, No se puede autenticar por error');
        }
    }); 
    $.ajax({
        type: 'ajax',
        method: 'post',
        url: baseurl+"lab/coti/ccotizacion/getcontaccliente",
        dataType: "JSON",
        async: true,
        data: params,
        success:function(result)
        {
            $('#cboregcontacto').html(result); 
        },
        error: function(){
            alert('Error, No se puede autenticar por error');
        }
    }); 
});

calen=function(){
    $('#btntipodias').html("Días Calendario");
    $('#txtregtipodias').val('C');
};
util=function(){
    $('#btntipodias').html("Días Útiles");
    $('#txtregtipodias').val('U');
};

conta=function(){
    $('#btnformapagos').html("Contado");
    $('#txtregformapagos').val('061');
    $('#mtxtregpagotro').hide(); 
};
credi=function(){
    $('#btnformapagos').html("Crédito");
    $('#txtregformapagos').val('062');
    $('#mtxtregpagotro').hide(); 
};
otro=function(){
    $('#btnformapagos').html("Otros");
    $('#txtregformapagos').val('063');
    $('#mtxtregpagotro').show();
};

soles=function(){
    $('#btntipopagos').html("S/.");
    $('#txtregtipopagos').val('S');
    $('#mtxtregtipocambio').hide(); 
};
dolares=function(){
    $('#btntipopagos').html("$");
    $('#txtregtipopagos').val('D');
    $('#mtxtregtipocambio').show(); 
};

$("#chksmuestreo").on("change", function () {
    if($("#chksmuestreo").is(":checked") == true){ 
        $("#txtmontmuestreo").prop({readonly:false}); 
    }else if($("#chksmuestreo").is(":checked") == false){ 
        $("#txtmontmuestreo").prop({readonly:true}); 
        $('#txtmontmuestreo').val(0);
    }; 
}); 

selCoti= function(IDCOTIZACION,NVERSION,DFECHA,NROCOTI,SCOTIZACION,VIGENCIACOTI,SREGISTRO,CCLIENTE,CPROVEEDOR,TIPOCAMBIO,SUBSERVICIO,MONEDA,SMUESTREO,CONTACTO,PERMANMUESTRA,TIPOPAGO,OTROPAGO,NTIEMPOENTREGAINFO,STIEMPOENTREGAINFO,OBSERVA,VERPRECIO,IMUESTREO,PIGV,PDESCUENTO,ISUBTOTAL,ITOTAL){  
    
    $('#tablab a[href="#tablab-reg"]').tab('show'); 
    $('#frmRegCoti').trigger("reset");
    
    $('#regProductos').show(); 

    $('#hdnAccionregcoti').val('A'); 

    $('#mtxtidcotizacion').val(IDCOTIZACION); 
    $('#mtxtnroversion').val(NVERSION);
    $('#mtxtFcotizacion').val(DFECHA);  
    $('#mtxtregnumcoti').val(NROCOTI); 
    $('#hdnregestado').val(SCOTIZACION); 
    if(SCOTIZACION == 'S'){
        $('#mtxtregestado').val('CERRADO');
    }else{    
        $('#mtxtregestado').val('ABIERTO');
    } 
    $('#mtxtregvigen').val(VIGENCIACOTI);  
    $('#cboregserv').val(SUBSERVICIO); 
    $('#cboregclie').val(CCLIENTE); 
    $('#cboregprov').val(CPROVEEDOR); 
    $('#cboregcontacto').val(CONTACTO);  
    $('#mtxtregpermane').val(PERMANMUESTRA);
    $('#mtxtregentregainf').val(NTIEMPOENTREGAINFO); 
    if(STIEMPOENTREGAINFO == 'C'){       
        calen(); 
    }else{
        util();
    }
    $('#mtxtobserv').val(OBSERVA);  
    if(TIPOPAGO == '061'){       
        conta(); 
    }else if(TIPOPAGO == '062'){       
        credi(); 
    }else{
        otro();
    }  
    $('#mtxtregpagotro').val(OTROPAGO);
    if(MONEDA == 'S'){       
        soles(); 
    }else{
        dolares();
    }
    $('#mtxtregtipocambio').val(new Intl.NumberFormat("en-IN").format(TIPOCAMBIO));  
    if(SMUESTREO == 'S'){
        $(document.getElementById('chksmuestreo')).prop('checked', true);
        $("#txtmontmuestreo").prop({readonly:false});
    }else{
        $(document.getElementById('chksmuestreo')).prop('checked', false);
        $("#txtmontmuestreo").prop({readonly:true});
    }   
    $('#txtmontmuestreo').val(new Intl.NumberFormat("en-IN").format(IMUESTREO));
    $('#txtmontsubtotal').val(new Intl.NumberFormat("en-IN").format(ISUBTOTAL));
    $('#txtporcdescuento').val(new Intl.NumberFormat("en-IN").format(PDESCUENTO));
    $('#txtporctigv').val(new Intl.NumberFormat("en-IN").format(PIGV));
    $('#txtmonttotal').val(new Intl.NumberFormat("en-IN").format(ITOTAL)); 
    if(VERPRECIO == 'S'){
        $(document.getElementById('chkregverpago')).prop('checked', true);
    }else{
        $(document.getElementById('chkregverpago')).prop('checked', false);
    }      
    
    $("#txtmontsubtotal").prop({readonly:true}); 
    $("#txtporctigv").prop({readonly:true});
    $("#txtmonttotal").prop({readonly:true});

    document.getElementById('addProducto').style.visibility = 'visible';
    
    iniRegCoti(SUBSERVICIO,CCLIENTE,CPROVEEDOR,CONTACTO);

    recuperaListproducto();
    recuperaListensayo('',0,''); 
    /*$('#btnParticiopantes').show();*/
};

$('#btnRetornarLista').click(function(){
    $('#tablab a[href="#tablab-list"]').tab('show');  
    //$('#btnBuscar').click();
});

recuperaListproducto = function(){
    otblListProducto = $('#tblListProductos').DataTable({  
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
            "url"   : baseurl+"lab/coti/ccotizacion/getlistarproducto/",
            "type"  : "POST", 
            "data": function ( d ) {
                d.idcoti    = $('#mtxtidcotizacion').val(); 
                d.nversion  = $('#mtxtnroversion').val();  
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
            {"orderable": false, data: 'LOCALCLIE', targets: 1},
            {"orderable": false, data: 'PRODUCTO', targets: 2},
            {"orderable": false, data: 'CONDI', targets: 3},
            {"orderable": false, data: 'NMUESTRA', targets: 4},
            {"orderable": false, 
                render:function(data, type, row){
                    return '<div class="text-left" >' +
                        '<a data-toggle="modal" title="Editar" style="cursor:pointer; color:green;" data-target="#modalCreaProduc" onClick="selCotiprodu(\'' + row.IDCOTI + '\',\'' + row.NVERSION + '\',\'' + row.IDPROD + '\',\'' + row.CLOCALCLIE + '\',\'' + row.PRODUCTO + '\',\'' + row.CCONDI + '\',\'' + row.NMUESTRA + '\',\'' + row.CPROCEDE + '\',\'' + row.CANTMIN + '\',\'' + row.ETIQUETA + '\',\'' + row.CTIPOPROD + '\',\'' + row.PORCION + '\',\'' + row.CUM + '\');"><span class="fas fa-edit fa-2x" aria-hidden="true"> </span> </a>'+
                    '</div>';
                }
            },
            {"orderable": false, 
                render:function(data, type, row){
                    return '<div>'+
                        '<a id="aDelProduc" href="'+row.IDCOTI+'" title="Eliminar" style="cursor:pointer; color:#FF0000;"><span class="fas fa-trash-alt fa-2x" aria-hidden="true"> </span></a>'+      
                    '</div>';
                }
            },
            {"orderable": false, 
                render:function(data, type, row){
                    return '<div class="text-left" >' +
                        '<a title="Ver Ensayos" style="cursor:pointer; color:blue;" onClick="verEnsayo(\'' + row.IDCOTI + '\',\'' + row.NVERSION + '\',\'' + row.IDPROD + '\');"><span class="fas fa-eye fa-2x" aria-hidden="true"> </span> </a>'+
                    '</div>';
                }
            },
            {"orderable": false, 
                render:function(data, type, row){
                    return '<div class="text-left" >' +
                        '<a title="Agregar Ensayos" style="cursor:pointer; color:grey;" onClick="objFormulario.addRegistroEnsayo(\'' + row.IDCOTI + '\',\'' + row.NVERSION + '\',\'' + row.IDPROD + '\');"><span class="far fa-plus-square fa-2x" aria-hidden="true"> </span> </a>'+
                    '</div>';
                }
            }
        ],
        "drawCallback": function ( settings ) {
            var api = this.api();
            var rows = api.rows( {page:'all'} ).nodes();
            var last = null;
			var grupo;
 
            api.column([1], {} ).data().each( function ( ctra, i ) { 
                grupo = api.column(1).data()[i];
                if ( last !== ctra ) {
                    $(rows).eq( i ).before(
                        '<tr class="group"><td colspan="8"><strong>'+ctra.toUpperCase()+'</strong></td></tr>'
                    ); 
                    last = ctra;
                }
            } );
        }
    }); 
    otblListProducto.column(1).visible( false );   
    // Enumeracion 
    otblListProducto.on( 'order.dt search.dt', function () { 
        otblListProducto.column(0, {search:'applied', order:'applied'}).nodes().each( function (cell, i) {
          cell.innerHTML = i+1;
          } );
    }).draw();
};

$('#addProducto').click(function(){
    $('#mhdnAccionProduc').val('N');
    var v_idcliente = $('#cboregclie').val();
    iniRegCotiprodu(v_idcliente,0,0,0);
});

$('#modalCreaProduc').on('shown.bs.modal', function (e) {

});

iniRegCotiprodu = function(ccliente,clocalclie,ccondi,cprocede){
    var params = { "ccliente":ccliente};

    $.ajax({
        type: 'ajax',
        method: 'post',
        url: baseurl+"lab/coti/ccotizacion/getcboregLocalclie",
        dataType: "JSON",
        async: true,
        data: params,
        success:function(result)
        {
            $('#mcboregLocalclie').html(result);
            $('#mcboregLocalclie').val(clocalclie).trigger("change"); 
        },
        error: function(){
            alert('Error, No se puede autenticar por error');
        }
    }); 

    $.ajax({
        type: 'ajax',
        method: 'post',
        url: baseurl+"lab/coti/ccotizacion/getcboregcondi",
        dataType: "JSON",
        async: true,
        data: params,
        success:function(result)
        {
            $('#mcboregcondicion').html(result);
            $('#mcboregcondicion').val(ccondi).trigger("change"); 
        },
        error: function(){
            alert('Error, No se puede autenticar por error');
        }
    });  

    $.ajax({
        type: 'ajax',
        method: 'post',
        url: baseurl+"lab/coti/ccotizacion/getcboregprocede",
        dataType: "JSON",
        async: true,
        data: params,
        success:function(result)
        {
            $('#mcboregprocedencia').html(result);
            $('#mcboregprocedencia').val(cprocede).trigger("change"); 
        },
        error: function(){
            alert('Error, No se puede autenticar por error');
        }
    }); 
};

selCotiprodu= function(IDCOTIZACION,NVERSION,IDPROD,CLOCALCLIE,PRODUCTO,CCONDI,NMUESTRA,CPROCEDE,CANTMIN,ETIQUETA,CTIPOPROD,PORCION,CUM){
    $('#frmCreaProduc').trigger("reset");
    $('#mhdnAccionProduc').val('A'); 
    $('#mtxtidcotizacion').val(IDCOTIZACION); 
    $('#mtxtnroversion').val(NVERSION);
    $('#mhdnIdProduc').val(IDPROD);

    $('#mcboregLocalclie').val(CLOCALCLIE);
    $('#mtxtregProducto').val(PRODUCTO);
    $('#mcboregcondicion').val(CCONDI);
    $('#mtxtregmuestra').val(NMUESTRA);
    $('#mcboregprocedencia').val(CPROCEDE);
    $('#mtxtregcantimin').val(CANTMIN);
    $('#mcboregetiquetado').val(ETIQUETA);
    $('#mcboregoctogono').val(CTIPOPROD);
    $('#mtxtregtamporci').val(PORCION);
    $('#mcboregumeti').val(CUM);
};
   
$("body").on("click","#aDelProduc",function(event){
    event.preventDefault();
    idcotiproducto = $(this).attr("href");

    Swal.fire({
        title: 'Confirmar Eliminación',
        text: "¿Está seguro de eliminar la Propuesta?",
        icon: 'error',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Si, bórralo!'
    }).then((result) => {
        if (result.value) {
            $.post(baseurl+"lab/coti/ccotizacion/delproducto/", 
            {
                idcotiproducto   : idcotiproducto,
            },      
            function(data){     
                otblListProducto.ajax.reload(null,false); 
                Vtitle = 'Se Elimino Correctamente';
                Vtype = 'success';
                sweetalert(Vtitle,Vtype);      
            });
        }
    }) 
});

verEnsayo= function(IDCOTIZACION,NVERSION,vIDPROD){
    recuperaListensayo(IDCOTIZACION,NVERSION,vIDPROD);
};

recuperaListensayo = function(vIDCOTIZACION,vNVERSION,vIDPROD){
    otblListEnsayos = $('#tblListEnsayos').DataTable({  
        'responsive'    : false,
        'bJQueryUI'     : true,
        'scrollY'     	: '300px',
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
            "url"   : baseurl+"lab/coti/ccotizacion/getlistarensayo/",
            "type"  : "POST", 
            "data": function ( d ) {
                d.idcoti    = vIDCOTIZACION; 
                d.nversion  = vNVERSION;
                d.idproduc  = vIDPROD;  
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
            {"orderable": false, data: 'CODIGO', targets: 1},
            {"orderable": false, data: 'DENSAYO', targets: 2},
            {"orderable": false, data: 'ANIO', targets: 3},
            {"orderable": false, data: 'NORMA', targets: 4},
            {"orderable": false, data: 'CONSTOENSAYO', targets: 4},
            {"orderable": false, data: 'NVIAS', targets: 4},
            {"orderable": false, data: 'CANTIDAD', targets: 4},
            {"orderable": false, data: 'COSTO', targets: 4},
            {"orderable": false, 
                render:function(data, type, row){
                    return '<div class="text-left" >' +
                        '<a data-toggle="modal" title="Editar" style="cursor:pointer; color:green;" data-target="#modalEnsayosLab" onClick="selCotiensayo(\'' + row.IDCOTIZACION + '\',\'' + row.NVERSION + '\',\'' + row.IDPROD + '\');"><span class="fas fa-edit fa-2x" aria-hidden="true"> </span> </a>'+
                    '</div>';
                }
            },
            {"orderable": false, 
                render:function(data, type, row){
                    return '<div>'+
                        '<a id="aDelProduc" href="'+row.CENSAYO+'" title="Eliminar" style="cursor:pointer; color:#FF0000;"><span class="fas fa-trash-alt fa-2x" aria-hidden="true"> </span></a>'+      
                    '</div>';
                }
            }
        ]
    });  
    // Enumeracion 
    otblListEnsayos.on( 'order.dt search.dt', function () { 
        otblListEnsayos.column(0, {search:'applied', order:'applied'}).nodes().each( function (cell, i) {
          cell.innerHTML = i+1;
          } );
    }).draw();
};

$('#btnRetornarCoti').click(function(){
    objFormulario.mostrarCotizacion();
});

selCotiensayo = function(vIDCOTIZACION,vNVERSION,vIDPROD){

};