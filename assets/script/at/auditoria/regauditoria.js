
var otblListAudi, otblListChecklist;
var varfdesde = '%', varfhasta = '%';

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
        $('#contenedorRegchecklist').hide();
        $('#contenedorBusqueda').show();
        //objFiltro.buscar()
    };

    /**
     * Muestra el formulario ocultando la lista
     */
    objFormulario.mostrarRegistro = function (cauditoriainspeccion,fservicio,cchecklist) {
        const boton = $('#btnAccionContenedorLista');
        const icon = boton.find('i');
        if (icon.hasClass('fa-plus')) icon.removeClass('fa-plus');
        icon.addClass('fa-minus');
        boton.click();

        $('#hdnIdaudi').val(cauditoriainspeccion);
        $('#hdnFaudi').val(fservicio);
        $('#hdnChecklist').val(cchecklist);
        listarChecklist();
        $('#contenedorRegchecklist').show();
        $('#contenedorBusqueda').hide();
    };
});

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

    /*LLENADO DE COMBOS*/
    $.ajax({
        type: 'ajax',
        method: 'post',
        url: baseurl+"at/auditoria/cregauditoria/getcboclieserv",
        dataType: "JSON",
        async: true,
        success:function(result){
            $('#cboClie').html(result);
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

$("#cboClie").change(function(){ 
    var select = document.getElementById("cboClie"), 
    value = select.value, 
    text = select.options[select.selectedIndex].innerText;
    document.querySelector('#lblCliente').innerText = text;
});
	
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
    }else if($("#chkFreg").is(":checked") == false){ 
        $("#txtFIni").prop("disabled",true);
        $("#txtFFin").prop("disabled",true);
        
        varfdesde = '%';
        varfhasta = '%';
    }; 
});

$("#cboregClie").change(function(){ 
    var v_ccliente = $('#cboregClie').val();

    var params = { "ccliente":v_ccliente};
        $.ajax({
            type: 'ajax',
            method: 'post',
            url: baseurl+"at/auditoria/cregauditoria/getestableaudi",
            dataType: "JSON",
            async: true,
            data: params,
            success:function(result)
            {
                $('#cboregEstable').html(result);
            },
            error: function(){
                alert('Error, No se puede autenticar por error');
            }
        });
});

$('#btnNuevo').click(function(){
    $('#frmCreaaudi').trigger("reset");
    $("#modalCreaaudi").modal('show');

    fechaActualreg();

    $.ajax({
        type: 'ajax',
        method: 'post',
        url: baseurl+"at/auditoria/cregauditoria/getcboclieserv",
        dataType: "JSON",
        async: true,
        success:function(result){
            $('#cboregClie').html(result);
        },
        error: function(){
            alert('Error, No se puede autenticar por error');
        }
    });
    $.ajax({
        type: 'ajax',
        method: 'post',
        url: baseurl+"at/auditoria/cregauditoria/getcboauditor",
        dataType: "JSON",
        async: true,
        success:function(result)
        {
            $('#cboregAuditor').html(result);
        },
        error: function(){
            alert('Error, No se puede autenticar por error = cboregAuditor');
        }
    });
    $.ajax({
        type: 'ajax',
        method: 'post',
        url: baseurl+"at/auditoria/cregauditoria/getsistemaaudi",
        dataType: "JSON",
        async: true,
        success:function(result)
        {
            $('#cboregSistema').html(result);
        },
        error: function(){
            alert('Error, No se puede autenticar por error = cboregSistema');
        }
    });
});

$("#cboregSistema").change(function(){ 
    var v_idnorma = $('#cboregSistema').val();

    var params = { "idnorma":v_idnorma};
        $.ajax({
            type: 'ajax',
            method: 'post',
            url: baseurl+"at/auditoria/cregauditoria/getcborubro",
            dataType: "JSON",
            async: true,
            data: params,
            success:function(result)
            {
                $('#cboregRubro').html(result);
            },
            error: function(){
                alert('Error, No se puede autenticar por error = cboregRubro');
            }
        });
});

$("#cboregRubro").change(function(){ 
    var v_idnorma = $('#cboregSistema').val();
    var v_idsubnorma = $('#cboregRubro').val();
    var v_ccliente = $('#cboregClie').val();

    var params = { 
        "idnorma":v_idnorma,
        "idsubnorma":v_idsubnorma,
        "ccliente":v_ccliente
    };

        $.ajax({
            type: 'ajax',
            method: 'post',
            url: baseurl+"at/auditoria/cregauditoria/getcbochecklist",
            dataType: "JSON",
            async: true,
            data: params,
            success:function(result)
            {
                $('#cboregChecklist').html(result);
            },
            error: function(){
                alert('Error, No se puede autenticar por error = cboregChecklist');
            }
        });
});

$("#cboregChecklist").change(function(){ 
    var v_idchceklist = $('#cboregChecklist').val();

    var params = { 
        "idchceklist":v_idchceklist
    };

        $.ajax({
            type: 'ajax',
            method: 'post',
            url: baseurl+"at/auditoria/cregauditoria/getcboformula",
            dataType: "JSON",
            async: true,
            data: params,
            success:function(result)
            {
                $('#cboregFormula').html(result);
            },
            error: function(){
                alert('Error, No se puede autenticar por error = cboregFormula');
            }
        });
});

fechaActualreg= function(){
    var fecha = new Date();	
    var fechatring = ("0" + fecha.getDate()).slice(-2) + "/" + ("0"+(fecha.getMonth()+1)).slice(-2) + "/" +fecha.getFullYear() ;
    
    $('#txtFechaaudi').datetimepicker('date', moment(fechatring, 'DD/MM/YYYY') );	
};

$('#frmCreaaudi').submit(function(event){
    event.preventDefault();
    
    var request = $.ajax({
        url:$('#frmCreaaudi').attr("action"),
        type:$('#frmCreaaudi').attr("method"),
        data:$('#frmCreaaudi').serialize(),
        error: function(){
            Vtitle = 'No se puede registrar por error';
            Vtype = 'error';
            sweetalert(Vtitle,Vtype);
        }
    });
    request.done(function( respuesta ) {
        var posts = JSON.parse(respuesta);        
        $.each(posts, function() { 
            $('#mhdnIdaudi').val(this.id_audi);
            Vtitle = this.respuesta;
            Vtype = 'success';
            sweetalert(Vtitle,Vtype);    
        });
    });
});

$("#btnBuscar").click(function (){
    
    if(varfdesde != '%'){ varfdesde = $('#txtFIni').val(); }
    if(varfhasta != '%'){ varfhasta = $('#txtFFin').val(); } 
     
    var groupColumn = 1;   
    otblListAudi = $('#tblListAuditoria').DataTable({  
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
        'ordering'		: false,  
        'stateSave'     : true,
        'ajax'	: {
            "url"   : baseurl+"at/auditoria/cregauditoria/getbuscarauditoria/",
            "type"  : "POST", 
            "data": function ( d ) {
                d.ccliente          = $('#cboClie').val();
                d.cestablecimiento  = $('#cboEstable').val();
                d.fini              = varfdesde; 
                d.ffin              = varfhasta;   
                d.idauditor         = $('#cboAuditor').val();  
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
            {"orderable": false, data: 'DESTABLE', targets: 1},
            {"orderable": false, data: 'DSUBSERV', targets: 2},
            {"orderable": false, data: 'FAUDITORIA', targets: 3},
            {"orderable": false, data: 'DAUDITOR', targets: 4},
            {"orderable": false, targets: 5, 
                render:function(data, type, row){
                    if(row.DNROINFORME == ''){
                        return '<div></div>'
                    }else{
                        return '<div>' +
                        '    <p><a title="Descargar" style="cursor:pointer;" onclick="excelInforme(\''+row.cauditoriainspeccion+'\',\''+row.fservicio+'\',\''+row.cchecklist+'\');"  class="pull-left">'+row.dinformefinal+'&nbsp;&nbsp;<i class="fas fa-file-excel" style="color:#3c763d;"></i></a><p>' +
                        '</div>' ;
                    }                     
                }
            },
            {"orderable": false, data: 'DRESULTADO', targets: 6},
            {responsivePriority: 1, "orderable": false, "class": "col-s", 
                render:function(data, type, row){
                    return '<div>'+
                        '<a title="Editar" style="cursor:pointer; color:#3c763d;" onClick="javascript:selAudi(\''+row.cauditoriainspeccion+'\',\''+row.fservicio+'\',\''+row.ccliente+'\',\''+row.cestablecimiento+'\');"><span class="fas fa-edit fa-2x" aria-hidden="true"> </span> </a>'+
                    '</div>'
                }
            },
            {responsivePriority: 1, "orderable": false, "class": "col-s", 
                render:function(data, type, row){
                    return '<div class="text-left" >' +
                        '<a title="Checklist" style="cursor:pointer; color:blue;" onClick="objFormulario.mostrarRegistro(\'' + row.cauditoriainspeccion + '\',\'' + row.fservicio + '\', \'' + row.cchecklist + '\');"><span class="fa fa-pencil-alt fa-2x" aria-hidden="true"> </span> </a>'+
                    '</div>';
                }
            }
        ],  
        "columnDefs": [{
                "targets": [3], 
                "data": null, 
                "render": function(data, type, row) {
                    if(row.zctipoestadoservicio == '018'){
                        return '<div>'+
                            '<p>'+row.FAUDITORIA+'</p>'+
                        '</div>';
                    }else{                        
                        return '<div>'+
                            '<p>'+row.FAUDITORIA+'<br>'+row.DESTADO+'</p>'
                        '</div>';
                    }
                }
            },
            { "targets": [1], "visible": false }
        ],
        "drawCallback": function ( settings ) {
            var api = this.api();
            var rows = api.rows( {page:'all'} ).nodes();
            var last = null;
			var grupo;
 
            api.column([1], {} ).data().each( function ( ctra, i ) { 
                grupo = api.column(2).data()[i];
                if ( last !== ctra ) {
                    $(rows).eq( i ).before(
                        '<tr class="group"><td colspan="7" class="subgroup"><strong>'+ctra.toUpperCase()+'</strong></td></tr>'+
                        '<tr class="group"><td colspan="7"><tab>Sub-Servicio : '+grupo+'</td></tr>'
                    ); 
                    last = ctra;
                }
            } );
        } 
    });   
    otblListAudi.column(2).visible( false );    
    // Enumeracion 
    otblListAudi.on( 'order.dt search.dt', function () { 
        otblListAudi.column(0, {search:'applied', order:'applied'}).nodes().each( function (cell, i) {
          cell.innerHTML = i+1;
          } );
    }).draw();  
});

excelInforme = function(cauditoriainspeccion,fservicio,cchecklist){
    window.open(baseurl+"at/auditoria/cexcelauditoria/excelinformes/"+cauditoriainspeccion+"/"+fservicio+"/"+cchecklist);
};

$('#btnRetornarLista').click(function(){
    objFormulario.mostrarBusqueda();
});

listarChecklist = function(){
      
    otblListChecklist = $('#tblListChecklist').DataTable({  
        'responsive'    : false,
        'bJQueryUI'     : true,
        'scrollY'     	: '400px',
        'scrollX'     	: true, 
        'paging'      	: false,
        'processing'  	: true,     
        'bDestroy'    	: true,
        'AutoWidth'     : false,
        'info'        	: true,
        'filter'      	: true, 
        'ordering'		: false,  
        'stateSave'     : true,
        'ajax'	: {
            "url"   : baseurl+"at/auditoria/cregauditoria/getlistarchecklist/",
            "type"  : "POST", 
            "data": function ( d ) {
                d.idaudi = $('#hdnIdaudi').val();
                d.fechaaudi = $('#hdnFaudi').val();
                d.cchecklist = $('#hdnChecklist').val(); 
            },     
            dataSrc : ''        
        },
        'columns'	: [
            {"orderable": false, data: 'NUMCAB', targets: 0},
            {"orderable": false, data: 'NUMDET', targets: 1},
            {"orderable": false, data: 'REQUISITO', targets: 2},
            {"orderable": false, data: 'CDETALLEVALOR', targets: 3},
            {"orderable": false, data: 'HALLAZGO', targets: 4},
            {"orderable": false, 
                render:function(data, type, row){
                    if(row.NUMDET == '' || row.HALLAZGO == '' ){
                        return ''
                    }else{
                        return '<div>'+
                        '<a title="Editar" style="cursor:pointer; color:#3c763d;" onClick="javascript:selHallazgo(\''+row.cauditoriainspeccion+'\',\''+row.fservicio+'\',\''+row.cchecklist+'\',\''+row.crequisitochecklist+'\');"><span class="fas fa-edit fa-2x" aria-hidden="true"> </span> </a>'+
                        '</div>'
                    }
                }
            }
        ],
        "columnDefs": [
          {
            "targets": [3], 
            "data": "CDETALLEVALOR", 
            "render": function(data, type, row) {                 
                if(row.NUMDET == '' ){
                    return ''
                }else{             
                    return ' <div class="btn-group">'+
                    ' <button type="button" class="btn btn-default">'+row.ddetallevalor+'</button>'+
                    ' <button type="button" class="btn btn-default dropdown-toggle dropdown-icon" data-toggle="dropdown">'+
                    ' <span class="sr-only">Toggle Dropdown</span>'+
                    ' <div class="dropdown-menu" role="menu">'+
                    ' <a class="dropdown-item" onClick="cambiarValor(\''+row.cauditoriainspeccion+'\',\''+row.fservicio+'\',\''+row.cchecklist+'\',\''+row.crequisitochecklist+'\',\''+row.drequisito+'\',\''+"001"+'\');"><i style="color:green;" class="fas fa-check"></i>&nbsp;&nbsp;CUMPLE</a>'+
                    ' <a class="dropdown-item" onClick="cambiarValor(\''+row.cauditoriainspeccion+'\',\''+row.fservicio+'\',\''+row.cchecklist+'\',\''+row.crequisitochecklist+'\',\''+row.drequisito+'\',\''+"002"+'\');"><i style="color:red;" class="fas fa-exclamation-triangle"></i>&nbsp;&nbsp;NO CUMPLE</a>'+
                    ' </div>'+
                    ' </button>'+ 
                    '</div>' 
                }                      
            }
          },
        ], 
    });   
};

cambiarValor = function(cauditoriainspeccion,fservicio,cchecklist,crequisitochecklist,drequisito,cdetallevalor){
         
    if(cdetallevalor == '001'){
        
        var params = { 
            "mhdncauditoriainspeccion":cauditoriainspeccion, 
            "mhdnfservicio":fservicio, 
            "mhdncchecklist":cchecklist, 
            "mhdncrequisitochecklist":crequisitochecklist, 
            "mhdncdetallevalor":cdetallevalor,  
            "mtxthallazgo":'', 
        };
        var request = $.ajax({
            type: 'ajax',
            method: 'post',
            url: baseurl+"at/auditoria/cregauditoria/setregchecklist",
            dataType: "JSON",
            async: true,
            data: params,
            error: function(){
                Vtitle = 'No se puede registrar por error';
                Vtype = 'error';
                sweetalert(Vtitle,Vtype);
            }
        });
        request.done(function( respuesta ) {
            $.each(respuesta, function() {     
                Vtitle = this.respuesta;
                Vtype = 'success';
                sweetalert(Vtitle,Vtype); 
                otblListChecklist.ajax.reload(null,false);  
            });  
        });
    }else if(cdetallevalor == '002'){
        
        $('#frmHallazgo').trigger("reset");
        $('#mhdncdetallevalor').val(cdetallevalor);

        $('#mhdncauditoriainspeccion').val(cauditoriainspeccion);    
        $('#mhdnfservicio').val(fservicio);    
        $('#mhdncchecklist').val(cchecklist);    
        $('#mhdncrequisitochecklist').val(crequisitochecklist); 
        $("#mtxtrequisito").prop({readonly:true});
        $('#mtxtrequisito').val(drequisito);

        $("#modalHallazgo").modal('show');
    }
}

$('#frmHallazgo').submit(function(event){
    event.preventDefault();
    
    var request = $.ajax({
        url:$('#frmHallazgo').attr("action"),
        type:$('#frmHallazgo').attr("method"),
        data:$('#frmHallazgo').serialize(),
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
            otblListChecklist.ajax.reload(null,false);        
            $('#mbtnCHallazgo').click();
        });
    });
});

$("#btnCalificar").click(function (){
    var cauditoriainspeccion = $('#hdnIdaudi').val();
    var fservicio = $('#hdnFaudi').val();
    var cchecklist = $('#hdnChecklist').val();

    var params = { 
        "idaudi":cauditoriainspeccion, 
        "fechaaudi":fservicio, 
        "cchecklist":cchecklist 
    };
    var request = $.ajax({
        type: 'ajax',
        method: 'post',
        url: baseurl+"at/auditoria/cregauditoria/setcalcularchecklist",
        dataType: "JSON",
        async: true,
        data: params,
        error: function(){
            Vtitle = 'No se puede registrar por error';
            Vtype = 'error';
            sweetalert(Vtitle,Vtype);
        }
    });
    request.done(function( respuesta ) {
        $.each(respuesta, function() {     
            Vtitle = this.respuesta;
            Vtype = 'success';
            sweetalert(Vtitle,Vtype);             
            otblListAudi.ajax.reload(null,false);
            objFormulario.mostrarBusqueda();  
        });  
    });
});

