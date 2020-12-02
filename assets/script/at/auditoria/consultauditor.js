
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
    objFormulario.mostrarRegistro = function (ccliente,cauditoriainspeccion,fservicio,cchecklist,cestablecimiento,ddataobject) {
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
        url: baseurl+"at/auditoria/cconsultauditor/getcboclieserv",
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
    var v_ccliente = $('#cboClie').val();
    var select = document.getElementById("cboClie"), 
    value = select.value, 
    text = select.options[select.selectedIndex].innerText;
    document.querySelector('#lblCliente').innerText = text;

    var params = { "ccliente":v_ccliente};
    $.ajax({
        type: 'ajax',
        method: 'post',
        url: baseurl+"at/auditoria/cconsultauditor/getestableaudi",
        dataType: "JSON",
        async: true,
        data: params,
        success:function(result)
        {
            $('#cboEstable').html(result);
        },
        error: function(){
            alert('Error, No se puede autenticar por error');
        }
    });
    
    $.ajax({
        type: 'ajax',
        method: 'post',
        url: baseurl+"at/auditoria/cconsultauditor/getcbosubserv",
        dataType: "JSON",
        async: true,
        data: params,
        success:function(result)
        {
            $('#cboSubserv').html(result);
        },
        error: function(){
            alert('Error, No se puede autenticar por error');
        }
    });
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
            url: baseurl+"at/auditoria/cconsultauditor/getestableaudi",
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
        
        $.ajax({
            type: 'ajax',
            method: 'post',
            url: baseurl+"at/auditoria/cconsultauditor/getcbosubserv",
            dataType: "JSON",
            async: true,
            data: params,
            success:function(result)
            {
                $('#cboregSubserv').html(result);
            },
            error: function(){
                alert('Error, No se puede autenticar por error');
            }
        });
});

$("#chkProveedor").on("change", function () {
    if($("#chkProveedor").is(":checked") == true){ 
        $("#cboregProvedor").prop({disabled:false}); 
    }else if($("#chkProveedor").is(":checked") == false){ 
        $("#cboregProvedor").prop({disabled:true}); 
    }; 
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
            "url"   : baseurl+"at/auditoria/cconsultauditor/getbuscarauditoria/",
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
            {"orderable": false, targets: 4, 
                render:function(data, type, row){
                    if(row.DNROINFORME == ''){
                        return '<div></div>'
                    }else{
                        return '<div>' +
                        '    <p><a title="Descargar" style="cursor:pointer;" onclick="pdfInforme(\''+row.cauditoriainspeccion+'\',\''+row.fservicio+'\',\''+row.cchecklist+'\');"  class="pull-left">'+row.dinformefinal+'&nbsp;&nbsp;<i class="fas fa-file-pdf" style="color:#FF0000;"></i></a><p>' +
                        '</div>' ;
                    }                     
                }
            },
            {"orderable": false, data: 'DRESULTADO', targets: 5},
            {responsivePriority: 1, "orderable": false, 
                render:function(data, type, row){
                    return '<div class="text-left" >' +
                        '<a title="Checklist" style="cursor:pointer; color:blue;" onClick="objFormulario.mostrarRegistro(\'' + row.ccliente + '\',\'' + row.cauditoriainspeccion + '\',\'' + row.fservicio + '\', \'' + row.cchecklist + '\', \'' + row.cestablecimiento + '\', \'' + row.ddataobject + '\');"><span class="fa fa-pencil-alt fa-2x" aria-hidden="true"> </span> </a>'+
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

pdfInforme = function(cauditoriainspeccion,fservicio,cchecklist){
    window.open(baseurl+"at/auditoria/cexcelauditoria/pdfinformes/"+cauditoriainspeccion+"/"+fservicio+"/"+cchecklist);
};

excelInforme = function(cauditoriainspeccion,fservicio,cchecklist,cestablearea){
    window.open(baseurl+"at/auditoria/cexcelauditoria/excelinformes/"+cauditoriainspeccion+"/"+fservicio+"/"+cchecklist+"/"+cestablearea);
};

$('#btnRetornarLista').click(function(){
    objFormulario.mostrarBusqueda();
});

$("#cboregAreazona").change(function(){ 
    listarChecklist();
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
            "url"   : baseurl+"at/auditoria/cconsultauditor/getlistarchecklist/",
            "type"  : "POST", 
            "data": function ( d ) {
                d.idaudi = $('#hdnIdaudi').val();
                d.fechaaudi = $('#hdnFaudi').val();
                d.cchecklist = $('#hdnChecklist').val(); 
                d.cestablearea = $('#cboregAreazona').val(); 
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
                        '<a title="Editar" style="cursor:pointer; color:#3c763d;" onClick="javascript:selHallazgo(\''+row.cauditoriainspeccion+'\',\''+row.fservicio+'\',\''+row.cchecklist+'\',\''+row.crequisitochecklist+'\',\''+row.cestablearea+'\');"><span class="fas fa-edit fa-2x" aria-hidden="true"> </span> </a>'+
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
                    ' <a class="dropdown-item" onClick="cambiarValor(\''+row.cauditoriainspeccion+'\',\''+row.fservicio+'\',\''+row.cchecklist+'\',\''+row.crequisitochecklist+'\',\''+row.drequisito+'\',\''+"001"+'\',\''+row.cestablearea+'\');"><i style="color:green;" class="fas fa-check"></i>&nbsp;&nbsp;CUMPLE</a>'+
                    ' <a class="dropdown-item" onClick="cambiarValor(\''+row.cauditoriainspeccion+'\',\''+row.fservicio+'\',\''+row.cchecklist+'\',\''+row.crequisitochecklist+'\',\''+row.drequisito+'\',\''+"002"+'\',\''+row.cestablearea+'\');"><i style="color:red;" class="fas fa-exclamation-triangle"></i>&nbsp;&nbsp;NO CUMPLE</a>'+
                    ' </div>'+
                    ' </button>'+ 
                    '</div>' 
                }                      
            }
          },
        ], 
    });   
};

cambiarValor = function(cauditoriainspeccion,fservicio,cchecklist,crequisitochecklist,drequisito,cdetallevalor,cestablearea){
         
    if(cdetallevalor == '001'){
        
        var params = { 
            "mhdncauditoriainspeccion":cauditoriainspeccion, 
            "mhdnfservicio":fservicio, 
            "mhdncchecklist":cchecklist, 
            "mhdncrequisitochecklist":crequisitochecklist, 
            "mhdncdetallevalor":cdetallevalor,  
            "mtxthallazgo":'',
            "mhdncestablearea": cestablearea,
        };
        var request = $.ajax({
            type: 'ajax',
            method: 'post',
            url: baseurl+"at/auditoria/cconsultauditor/setregchecklist",
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
        $("#mtxtNombarcheviden").prop({readonly:true});
        $('#mtxtrequisito').val(drequisito);
        $('#mhdncestablearea').val(cestablearea);
        $('#mhdnccliente').val($('#hdnCcliente').val());
       
        $("#modalHallazgo").modal('show');
    }
}

escogerArchivoeviden = function(){    
    var archivoInput = document.getElementById('mtxtArchivoeviden');
    var archivoRuta = archivoInput.value;
    var extPermitidas = /(.jpg|.png|.jpeg|.bmp)$/i;
    
    var filename = $('#mtxtArchivoeviden').val().replace(/.*(\/|\\)/, '');
    $('#mtxtNombarcheviden').val(filename);

    if(!extPermitidas.exec(archivoRuta)){
        alert('Asegurese de haber seleccionado un JPG, PNG, JPEG, BMP');
        archivoInput.value = '';  
        $('#mtxtNombarcheviden').val('');
        return false;
    }      
    $('#sArchivo').val('S');
};

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
            if($('#sArchivo').val() == 'S'){          
                subirArchivoeviden();
            }else{     
                Vtitle = this.respuesta;
                Vtype = 'success';
                sweetalert(Vtitle,Vtype);
                otblListChecklist.ajax.reload(null,false);        
                $('#mbtnCHallazgo').click();
            } 
            $('#sArchivo').val('N');  
        });
    });
});

subirArchivoeviden=function(){
    var parametrotxt = new FormData($("#frmHallazgo")[0]);
    var request = $.ajax({
        data: parametrotxt,
        method: 'post',
        url: baseurl+"at/auditoria/cconsultauditor/subirArchivoeviden/",
        dataType: "JSON",
        async: true,
        contentType: false,
        processData: false,
        error: function(){
            alert('Error, no se cargó el archivo');
        }
    });
    request.done(function( respuesta ) {
        Vtitle = this.respuesta;
        Vtype = 'success';
        sweetalert(Vtitle,Vtype);
        otblListChecklist.ajax.reload(null,false);        
        $('#mbtnCHallazgo').click();
    });
};

$("#btnCalificar").click(function (){
    var cauditoriainspeccion = $('#hdnIdaudi').val();
    var fservicio = $('#hdnFaudi').val();
    var cchecklist = $('#hdnChecklist').val();
    var dataobject = $('#hdnDataobject').val();

    var params = { 
        "idaudi":cauditoriainspeccion, 
        "fechaaudi":fservicio, 
        "cchecklist":cchecklist , 
        "dataobject":dataobject
    };
    var request = $.ajax({
        type: 'ajax',
        method: 'post',
        url: baseurl+"at/auditoria/cconsultauditor/setcalcularchecklist",
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

