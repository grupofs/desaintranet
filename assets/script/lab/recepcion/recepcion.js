
var otblListRecepcion, otblListProducto, otblListEnsayos;
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

    $('#txtFDesde,#txtFHasta').datetimepicker({
        format: 'DD/MM/YYYY',
        daysOfWeekDisabled: [0],
        locale:'es'
    });

    fechaActual();
 
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
    otblListRecepcion = $('#tblListRecepcion').DataTable({  
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
            "url"   : baseurl+"lab/recepcion/crecepcion/getbuscarrecepcion/",
            "type"  : "POST", 
            "data": function ( d ) {
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
            {"orderable": false, data: 'ELABORADO', targets: 3},
            {"orderable": false, data: 'DFECHA', targets: 4},
            {"orderable": false, data: 'ENTREGAINFO', targets: 5},
            {"orderable": false, 
                render:function(data, type, row){
                    return '<div class="text-left" >' +
                        '<a title="Recepcion" style="cursor:pointer; color:green;" onClick="selRecep(\'' + row.IDCOTIZACION + '\',\'' + row.NVERSION + '\',\'' + row.DCLIENTE + '\',\'' + row.NROCOTI + '\');"><span class="fas fa-edit fa-2x" aria-hidden="true"> </span> </a>'+
                    '</div>';
                }
            }
        ],  
        "columnDefs": [{
            "targets": [2], 
            "data": null, 
            "render": function(data, type, row) {
                return '<div>'+
                '    <p><a title="Cotozacion" style="cursor:pointer;" onclick="pdfCoti(\'' + row.IDCOTIZACION + '\',\'' + row.NVERSION + '\');"  class="pull-left">'+row.NROCOTI+'&nbsp;&nbsp;<i class="fas fa-file-pdf" style="color:#FF0000;"></i></a><p>' +
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
    otblListRecepcion.column(0).visible( false ); 
    otblListRecepcion.column(1).visible( false );      
    // Enumeracion 
    otblListRecepcion.on( 'order.dt search.dt', function () { 
        otblListRecepcion.column(0, {search:'applied', order:'applied'}).nodes().each( function (cell, i) {
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
    $('#hdnAccionregcoti').val('N'); 
    $('#mtxtidcoti').val(''); 

    fechaActualReg();
    iniRegCoti("%","%","%","%");

    $('#mtxtregpagotro').hide();
    $('#mtxtregtipocambio').hide(); 
    
    $("#txtmontmuestreo").prop({readonly:true});
    $("#txtmontsubtotal").prop({readonly:true}); 
    $("#txtmontigv").prop({readonly:true});
    $("#txtmonttotal").prop({readonly:true});

    $('#regProductos').hide();
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

   
$('#frmRegCoti').submit(function(event){
    event.preventDefault();
    
    var request = $.ajax({
        url:$('#frmRegCoti').attr("action"),
        type:$('#frmRegCoti').attr("method"),
        data:$('#frmRegCoti').serialize(),
        error: function(){
          alert('Error, No se puede autenticar por error');
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
});

selRecep= function(IDCOTIZACION,NVERSION,DCLIENTE,NROCOTI){  
    
    $('#tablab a[href="#tablab-reg"]').tab('show'); 
    $('#frmRegCoti').trigger("reset");
    $('#hdnAccionregcoti').val('A'); 
    $('#mtxtidcotizacion').val(IDCOTIZACION); 
    $('#mtxtnroversion').val(NVERSION);
  
    document.querySelector('#lblclie').innerText = DCLIENTE;
    document.querySelector('#lblcoti').innerText = NROCOTI;
     
    recuperaListproducto();
    /*$('#btnParticiopantes').show();*/
};


$('#btnRetornarLista').click(function(){
    $('#tablab a[href="#tablab-list"]').tab('show');  
    //$('#btnBuscar').click();
});

recuperaListproducto = function(){
    otblListProducto = $('#tblListProductos').DataTable({  
        'responsive'    : true,
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
            "url"   : baseurl+"lab/recepcion/crecepcion/getrecepcionmuestra/",
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
            {"orderable": false, data: 'frecepcionmuestra', targets: 1},
            {"orderable": false, data: 'cmuestra', targets: 2},
            {"orderable": false, data: 'drealproducto', targets: 3},
            {"orderable": false, data: 'dpresentacion', targets: 4},
            {"orderable": false, data: 'dtemperatura', targets: 5},
            {"orderable": false, data: 'dcantidad', targets: 6},
            {"orderable": false, data: 'dproveedorproducto', targets: 7},
            {"orderable": false, data: 'dlote', targets: 8},
            {"orderable": false, data: 'fenvase', targets: 9},
            {"orderable": false, data: 'fmuestra', targets: 10},
            {"orderable": false, data: 'hmuestra', targets: 11},
            {"orderable": false, data: 'ntrimestre', targets: 12},
            {"orderable": false, data: 'zctipomotivo', targets: 13},
            {"orderable": false, data: 'careacliente', targets: 14},
            {"orderable": false, data: 'dubicacion', targets: 15},
            {"orderable": false, data: 'zctipoitem', targets: 16},
            {"orderable": false, data: 'stottus', targets: 17},
            {"orderable": false, data: 'dcondicion', targets: 18},
            {"orderable": false, data: 'dobservacion', targets: 19},
            {"orderable": false, data: 'dotraobservacion', targets: 20},
            {responsivePriority: 1,"orderable": false, 
                render:function(data, type, row){
                    return '<div class="text-left" >' +
                        '<a data-toggle="modal" title="Editar" style="cursor:pointer; color:green;" data-target="#modalRecepcion" onClick="selCotiprodu(\'' + row.IDCOTI + '\',\'' + row.NVERSION + '\',\'' + row.IDPROD + '\',\'' + row.CLOCALCLIE + '\',\'' + row.PRODUCTO + '\',\'' + row.CCONDI + '\',\'' + row.NMUESTRA + '\',\'' + row.CPROCEDE + '\',\'' + row.CANTMIN + '\',\'' + row.ETIQUETA + '\',\'' + row.CTIPOPROD + '\',\'' + row.PORCION + '\',\'' + row.CUM + '\');"><span class="fas fa-edit fa-2x" aria-hidden="true"> </span> </a>'+
                    '</div>';
                }
            }
        ]
    }); 
    // Enumeracion 
    otblListProducto.on( 'order.dt search.dt', function () { 
        otblListProducto.column(0, {search:'applied', order:'applied'}).nodes().each( function (cell, i) {
          cell.innerHTML = i+1;
          } );
    }).draw();
};

$('#modalRecepcion').on('shown.bs.modal', function (e) {
    
});

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