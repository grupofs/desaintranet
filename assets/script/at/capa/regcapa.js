

var otblListCapacita, otblListRegcapadet, otblListRegprogr, otblListParticipantes;
var varfdesde = '%', varfhasta = '%';

$(document).ready(function() {
    $('#mtxtFCapaini,#mtxtFCapafin').datetimepicker({
        format: 'DD/MM/YYYY',
        daysOfWeekDisabled: [0],
        locale:'es'
    });
    
    $('#tabcapa a[href="#tabcapa-list-tab"]').attr('class', 'disabled');
    $('#tabcapa a[href="#tabcapa-reg-tab"]').attr('class', 'disabled active');
    $('#tabcapa a[href="#tabcapa-parti-tab"]').attr('class', 'disabled active');

    $('#tabcapa a[href="#tabcapa-list-tab"]').not('#store-tab.disabled').click(function(event){
        $('#tabcapa a[href="#tabcapa-list"]').attr('class', 'active');
        $('#tabcapa a[href="#tabcapa-reg"]').attr('class', '');
        $('#tabcapa a[href="#tabcapa-parti"]').attr('class', '');
        return true;
    });
    $('#tabcapa a[href="#tabcapa-reg-tab"]').not('#bank-tab.disabled').click(function(event){
        $('#tabcapa a[href="#tabcapa-reg"]').attr('class' ,'active');
        $('#tabcapa a[href="#tabcapa-list"]').attr('class', '');
        $('#tabcapa a[href="#tabcapa-parti"]').attr('class', '');
        return true;
    });
    $('#tabcapa a[href="#tabcapa-parti-tab"]').not('#bank-tab.disabled').click(function(event){
        $('#tabcapa a[href="#tabcapa-parti"]').attr('class' ,'active');
        $('#tabcapa a[href="#tabcapa-list"]').attr('class', '');
        $('#tabcapa a[href="#tabcapa-reg"]').attr('class', '');
        return true;
    });
    
    $('#tabcapa a[href="#tabcapa-list"]').click(function(event){return false;});
    $('#tabcapa a[href="#tabcapa-reg"]').click(function(event){return false;});
    $('#tabcapa a[href="#tabcapa-parti"]').click(function(event){return false;});
    
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
        url: baseurl+"at/capa/cregcapa/getclientecapa",
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
        url: baseurl+"at/capa/cregcapa/getcursocapa",
        dataType: "JSON",
        async: true,
        success:function(result)
        {
            $('#cboCursos').html(result);
        },
        error: function(){
            alert('Error, No se puede autenticar por error');
        }
    });
    $.ajax({
        type: 'ajax',
        method: 'post',
        url: baseurl+"at/capa/cregcapa/getexpositorcapa",
        dataType: "JSON",
        async: true,
        success:function(result)
        {
            $('#cboExpo').html(result);
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
    }else if($("#chkFreg").is(":checked") == false){ 
        $("#txtFIni").prop("disabled",true);
        $("#txtFFin").prop("disabled",true);
        
        varfdesde = '%';
        varfhasta = '%';
    }; 
});

$("#btnBuscar").click(function (){
    
    if(varfdesde != '%'){ varfdesde = $('#txtFIni').val(); }
    if(varfhasta != '%'){ varfhasta = $('#txtFFin').val(); } 
     
    var groupColumn = 1;   
    otblListCapacita = $('#tblListCapacita').DataTable({  
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
            "url"   : baseurl+"at/capa/cregcapa/getbuscarcapa/",
            "type"  : "POST", 
            "data": function ( d ) {
                d.ccliente      = $('#cboClie').val();
                d.fdesde        = varfdesde; 
                d.fhasta        = varfhasta;   
                d.idcurso       = $('#cboCursos').val();
                d.idexpositor   = $('#cboExpo').val();  
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
            {"orderable": false, data: 'DATOSCAPA', targets: 1},
            {"orderable": false, data: 'FCAPACITACION', targets: 2, "class": "col-sm"},
            {"orderable": false, data: 'DCURSO', targets: 3, "class": "col-lm"},
            {"orderable": false, data: 'DTEMA', targets: 4, "class": "col-xl"},
            {"orderable": false, data: 'DEXPOSITOR', targets: 5, "class": "col-m"},
            {"orderable": false, 
              render:function(data, type, row){
                  var rpresent, rtaller, rexamen, rlist, rcerti;
                  if(row.ruta_presentacion != null) {
                    rpresent = ' <a title="Presentacion" style="cursor:pointer; color:#1646ec;" href="'+baseurl+row.ruta_presentacion+'" target="_blank" class="btn btn-outline-secondary btn-sm hidden-xs hidden-sm"><span class="fas fa-cloud-download-alt" aria-hidden="true"> </span> Presentacion</a>'+
                    ' &nbsp; &nbsp;'
                  } else {
                    rpresent = ' <a data-toggle="modal" title="Presentacion" style="cursor:pointer; color:#3c763d;" data-target="#modalPresent" onClick="javascript:uploadPresent(\''+row.id_capa+'\',\''+row.id_capadet+'\',\''+row.ccliente+'\',\''+row.fini+'\');"class="btn btn-outline-secondary btn-sm hidden-xs hidden-sm"><span class="fas fa-cloud-upload-alt" aria-hidden="true"> </span> Presentacion</a>'+
                    ' &nbsp; &nbsp;'
                  } 
                  if(row.ruta_taller != null) {
                    rtaller = ' <a title="Taller" style="cursor:pointer; color:#1646ec;" href="'+baseurl+row.ruta_taller+'" target="_blank" class="btn btn-outline-secondary btn-sm hidden-xs hidden-sm"><span class="fas fa-cloud-download-alt" aria-hidden="true"> </span> Taller</a>'+
                    ' &nbsp; &nbsp;'
                  } else {
                    rtaller = ' <a data-toggle="modal" title="Taller" style="cursor:pointer; color:#3c763d;" data-target="#modalTaller" onClick="javascript:uploadTaller(\''+row.id_capa+'\',\''+row.id_capadet+'\',\''+row.ccliente+'\',\''+row.fini+'\');"class="btn btn-outline-secondary btn-sm hidden-xs hidden-sm"><span class="fas fa-cloud-upload-alt" aria-hidden="true"> </span> Taller</a>'+
                    ' &nbsp; &nbsp;'
                  } 
                  if(row.ruta_examen != null) {
                    rexamen = ' <a title="Examen" style="cursor:pointer; color:#1646ec;" href="'+baseurl+row.ruta_examen+'" target="_blank" class="btn btn-outline-secondary btn-sm hidden-xs hidden-sm"><span class="fas fa-cloud-download-alt" aria-hidden="true"> </span> Examen</a>'+
                    ' &nbsp; &nbsp;'
                  } else {
                    rexamen = ' <a data-toggle="modal" title="Examen" style="cursor:pointer; color:#3c763d;" data-target="#modalExamen" onClick="javascript:uploadExamen(\''+row.id_capa+'\',\''+row.id_capadet+'\',\''+row.ccliente+'\',\''+row.fini+'\');"class="btn btn-outline-secondary btn-sm hidden-xs hidden-sm"><span class="fas fa-cloud-upload-alt" aria-hidden="true"> </span> Examen</a>'+
                    ' &nbsp; &nbsp;'
                  } 
                  if(row.ruta_listparti != null) {
                    rlist = ' <a title="Lista" style="cursor:pointer; color:#1646ec;" href="'+baseurl+row.ruta_listparti+'" target="_blank" class="btn btn-outline-secondary btn-sm hidden-xs hidden-sm"><span class="fas fa-cloud-download-alt" aria-hidden="true"> </span> Lista</a>'+
                    ' &nbsp; &nbsp;'
                  } else {
                    rlist = ' <a data-toggle="modal" title="Lista" style="cursor:pointer; color:#3c763d;" data-target="#modalLista" onClick="javascript:uploadLista(\''+row.id_capa+'\',\''+row.id_capadet+'\',\''+row.ccliente+'\',\''+row.fini+'\');"class="btn btn-outline-secondary btn-sm hidden-xs hidden-sm"><span class="fas fa-cloud-upload-alt" aria-hidden="true"> </span> Lista</a>'+
                    ' &nbsp; &nbsp;'
                  } 
                  if(row.ruta_certi != null) {
                    rcerti = ' <a title="Certificado" style="cursor:pointer; color:#1646ec;" href="'+baseurl+row.ruta_certi+'" target="_blank" class="btn btn-outline-secondary btn-sm hidden-xs hidden-sm"><span class="fas fa-cloud-download-alt" aria-hidden="true"> </span> Certificado</a>'+
                    ' &nbsp; &nbsp;'
                  } else {
                    rcerti = ' <a data-toggle="modal" title="Certificado" style="cursor:pointer; color:#3c763d;" data-target="#modalCerti" onClick="javascript:uploadCerti(\''+row.id_capa+'\',\''+row.id_capadet+'\',\''+row.ccliente+'\',\''+row.fini+'\');"class="btn btn-outline-secondary btn-sm hidden-xs hidden-sm"><span class="fas fa-cloud-upload-alt" aria-hidden="true"> </span> Certificado</a>'+
                    ' &nbsp; &nbsp;'
                  } 
                  return  '<div>'+rpresent+rtaller+rexamen+rlist+rcerti+
                  '</div>' 
              }
            },
            {responsivePriority: 1, "orderable": false, "class": "col-s", 
                render:function(data, type, row){
                    return '<div>'+
                    '<a title="Registro" style="cursor:pointer; color:#3c763d;" onClick="javascript:selCapa(\''+row.id_capa+'\',\''+row.ccliente+'\',\''+row.cestablecimiento+'\',\''+row.comentarios+'\',\''+row.fini+'\',\''+row.ffin+'\');"><span class="fas fa-external-link-alt fa-2x" aria-hidden="true"> </span> </a>'+
                    '&nbsp;'+
                    '<a id="aDelCapa" href="'+row.id_capadet+'" title="Eliminar" style="cursor:pointer; color:#FF0000;"><span class="fas fa-trash-alt fa-2x" aria-hidden="true"> </span></a>'+      
                    '</div>'
                }
            }
        ],  
        "columnDefs": [
            { "visible": false, "targets": groupColumn }
        ],
        "drawCallback": function ( settings ) {
            var api = this.api();
            var rows = api.rows( {page:'current'} ).nodes();
            var last=null;
 
            api.column(groupColumn, {page:'current'} ).data().each( function ( group, i ) {
                if ( last !== group ) {
                    $(rows).eq( i ).before(
                        '<tr class="group"><td colspan="7">'+group+'</td></tr>'
                    );
 
                    last = group;
                }
            } );
        } 
    });   
    // Enumeracion 
    otblListCapacita.on( 'order.dt search.dt', function () { 
        otblListCapacita.column(0, {search:'applied', order:'applied'}).nodes().each( function (cell, i) {
          cell.innerHTML = i+1;
          } );
    }).draw();  
});

uploadPresent = function(id_capa,id_capadet,ccliente,fini){
    $('#mhdnIdCapapresent').val(id_capa); 
    $('#mhdnIdCapaDetpresent').val(id_capadet); 
    $('#mhdncclientepresent').val(ccliente);
    $('#mhdnfinipresent').val(fini);
}
uploadTaller = function(id_capa,id_capadet,ccliente,fini){
    $('#mhdnIdCapataller').val(id_capa); 
    $('#mhdnIdCapaDettaller').val(id_capadet); 
    $('#mhdncclientetaller').val(ccliente);
    $('#mhdnfinitaller').val(fini);
}
uploadExamen = function(id_capa,id_capadet,ccliente,fini){
    $('#mhdnIdCapaexamen').val(id_capa); 
    $('#mhdnIdCapaDetexamen').val(id_capadet); 
    $('#mhdncclienteexamen').val(ccliente);
    $('#mhdnfiniexamen').val(fini);
}
uploadLista = function(id_capa,id_capadet,ccliente,fini){
    $('#mhdnIdCapalista').val(id_capa); 
    $('#mhdnIdCapaDetlista').val(id_capadet); 
    $('#mhdncclientelista').val(ccliente);
    $('#mhdnfinilista').val(fini);
}
uploadCerti = function(id_capa,id_capadet,ccliente,fini){
    $('#mhdnIdCapacerti').val(id_capa); 
    $('#mhdnIdCapaDetcerti').val(id_capadet); 
    $('#mhdncclientecerti').val(ccliente);
    $('#mhdnfinicerti').val(fini);
}

adjPresent=function(){
    var archivoInput = document.getElementById('stxtArchivopresent');
    var archivoRuta = archivoInput.value;
    var extPermitidas = /(.pdf|.docx|.xlsx|.doc|.xls)$/i;
    
    var filename = $('#stxtArchivopresent').val().replace(/.*(\/|\\)/, '');
    $('#stxtNomarchpresent').val(filename);

    if(!extPermitidas.exec(archivoRuta)){
        alert('Asegurese de haber seleccionado un PDF, DOCX, XSLX');
        archivoInput.value = '';  
        $('#stxtNomarchpresent').val('');
        return false;
    }      

    var parametrotxt = new FormData($("#frmSubpresent")[0]);
    var request = $.ajax({
        data: parametrotxt,
        method: 'post',
        url: baseurl+"at/capa/cregcapa/adjPresent/",
        dataType: "JSON",
        async: true,
        contentType: false,
        processData: false,
        error: function(){
            alert('Error, no se cargó Presentacion');
        }
    });
    request.done(function( respuesta ) {
        otblListCapacita.ajax.reload(null,false);
        $('#mbtnCSubpresenta').click();
    });
};
adjTaller=function(){
    var archivoInput = document.getElementById('stxtArchivotaller');
    var archivoRuta = archivoInput.value;
    var extPermitidas = /(.pdf|.docx|.xlsx|.doc|.xls)$/i;
    
    var filename = $('#stxtArchivotaller').val().replace(/.*(\/|\\)/, '');
    $('#stxtNomarchtaller').val(filename);

    if(!extPermitidas.exec(archivoRuta)){
        alert('Asegurese de haber seleccionado un PDF, DOCX, XSLX');
        archivoInput.value = '';  
        $('#stxtNomarchtaller').val('');
        return false;
    }      

    var parametrotxt = new FormData($("#frmSubtaller")[0]);
    var request = $.ajax({
        data: parametrotxt,
        method: 'post',
        url: baseurl+"at/capa/cregcapa/adjTaller/",
        dataType: "JSON",
        async: true,
        contentType: false,
        processData: false,
        error: function(){
            alert('Error, no se cargó Taller');
        }
    });
    request.done(function( respuesta ) {
        otblListCapacita.ajax.reload(null,false);
        $('#mbtnCSubtaller').click();
    });
};
adjExamen=function(){
    var archivoInput = document.getElementById('stxtArchivoexamen');
    var archivoRuta = archivoInput.value;
    var extPermitidas = /(.pdf|.docx|.xlsx|.doc|.xls)$/i;
    
    var filename = $('#stxtArchivoexamen').val().replace(/.*(\/|\\)/, '');
    $('#stxtNomarchexamen').val(filename);

    if(!extPermitidas.exec(archivoRuta)){
        alert('Asegurese de haber seleccionado un PDF, DOCX, XSLX');
        archivoInput.value = '';  
        $('#stxtNomarchexamen').val('');
        return false;
    }      

    var parametrotxt = new FormData($("#frmSubexamen")[0]);
    var request = $.ajax({
        data: parametrotxt,
        method: 'post',
        url: baseurl+"at/capa/cregcapa/adjExamen/",
        dataType: "JSON",
        async: true,
        contentType: false,
        processData: false,
        error: function(){
            alert('Error, no se cargó Examen');
        }
    });
    request.done(function( respuesta ) {
        otblListCapacita.ajax.reload(null,false);
        $('#mbtnCSubexamen').click();
    });
};
adjLista=function(){
    var archivoInput = document.getElementById('stxtArchivolista');
    var archivoRuta = archivoInput.value;
    var extPermitidas = /(.pdf|.docx|.xlsx|.doc|.xls)$/i;
    
    var filename = $('#stxtArchivolista').val().replace(/.*(\/|\\)/, '');
    $('#stxtNomarchlista').val(filename);

    if(!extPermitidas.exec(archivoRuta)){
        alert('Asegurese de haber seleccionado un PDF, DOCX, XSLX');
        archivoInput.value = '';  
        $('#stxtNomarchlista').val('');
        return false;
    }      

    var parametrotxt = new FormData($("#frmSublista")[0]);
    var request = $.ajax({
        data: parametrotxt,
        method: 'post',
        url: baseurl+"at/capa/cregcapa/adjLista/",
        dataType: "JSON",
        async: true,
        contentType: false,
        processData: false,
        error: function(){
            alert('Error, no se cargó Lista');
        }
    });
    request.done(function( respuesta ) {
        otblListCapacita.ajax.reload(null,false);
        $('#mbtnCSublista').click();
    });
};
adjCerti=function(){
    var archivoInput = document.getElementById('stxtArchivocerti');
    var archivoRuta = archivoInput.value;
    var extPermitidas = /(.pdf|.docx|.xlsx|.doc|.xls)$/i;
    
    var filename = $('#stxtArchivocerti').val().replace(/.*(\/|\\)/, '');
    $('#stxtNomarchcerti').val(filename);

    if(!extPermitidas.exec(archivoRuta)){
        alert('Asegurese de haber seleccionado un PDF, DOCX, XSLX');
        archivoInput.value = '';  
        $('#stxtNomarchcerti').val('');
        return false;
    }      

    var parametrotxt = new FormData($("#frmSubcerti")[0]);
    var request = $.ajax({
        data: parametrotxt,
        method: 'post',
        url: baseurl+"at/capa/cregcapa/adjCerti/",
        dataType: "JSON",
        async: true,
        contentType: false,
        processData: false,
        error: function(){
            alert('Error, no se cargó Certificado');
        }
    });
    request.done(function( respuesta ) {
        otblListCapacita.ajax.reload(null,false);
        $('#mbtnCSubcerti').click();
    });
};
   
$("body").on("click","#aDelCapa",function(event){
    event.preventDefault();
    id_capadet = $(this).attr("href");

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
            $.post(baseurl+"at/capa/cregcapa/delcapadet/", 
            {
                id_capadet   : id_capadet,
            },      
            function(data){     
                otblListCapacita.ajax.reload(null,false); 
                Vtitle = 'Se Elimino Correctamente';
                Vtype = 'success';
                sweetalert(Vtitle,Vtype);      
            });
        }
    }) 
});

//
fechaActualCapa = function(){
    var fecha = new Date();		
    var fechatring = ("0" + fecha.getDate()).slice(-2) + "/" + ("0"+(fecha.getMonth()+1)).slice(-2) + "/" +fecha.getFullYear() ;

    $('#mtxtFCapaini').datetimepicker('date', moment(fechatring, 'DD/MM/YYYY') );
    $('#mtxtFCapafin').datetimepicker('date', moment(fechatring, 'DD/MM/YYYY') );

};

$('#btnNuevo').click(function(){
    
    $('#tabcapa a[href="#tabcapa-reg"]').tab('show'); 
    $('#frmRegCapa').trigger("reset");
    $('#hdnAccionregcapa').val('N'); 
    $('#mtxtidcapa').val(0);    

    document.getElementById('addcurso').style.visibility = 'hidden';
    
    iniRegCapa("0","%"); 

    recuperaListcapadet();
    recuperaListprograma(0);
    fechaActualCapa(); 
    $('#btnParticiopantes').hide();
});

selCapa= function(id_capa,ccliente,cestablecimiento,comentarios,fini,ffin){  
    $('#tabcapa a[href="#tabcapa-reg"]').tab('show'); 
    $('#frmRegCapa').trigger("reset");
    $('#hdnAccionregcapa').val('A'); 
    $('#mtxtidcapa').val(id_capa); 
    $('#mtxtFinicio').val(fini); 
    $('#mtxtFfin').val(ffin);  
    $('#mtxtComentarios').val(comentarios);    

    document.getElementById('addcurso').style.visibility = 'visible';
    
    iniRegCapa(ccliente,cestablecimiento);

    recuperaListcapadet();
    recuperaListprograma(0); 
    $('#btnParticiopantes').show();
};

iniRegCapa = function(Ccliente,idestab){
    $.ajax({
        type: 'ajax',
        method: 'post',
        url: baseurl+"at/capa/cregcapa/getclienteinternoat",
        dataType: "JSON",
        async: true,
        success:function(result)
        {
            $('#cboregClie').html(result);
            $('#cboregClie').val(Ccliente).trigger("change"); 
        },
        error: function(){
            alert('Error, No se puede autenticar por error');
        }
    });   

    var v_accion = $('#hdnAccionregcapa').val();
    if(v_accion == 'A'){
        var params = { "ccliente":Ccliente };
        $.ajax({
            type: 'ajax',
            method: 'post',
            url: baseurl+"at/capa/cregcapa/buscar_establexcliente",
            dataType: "JSON",
            async: true,
            data: params,
            success:function(result)
            {
            $("#cboregEstab").html(result);           
            $('#cboregEstab').val(idestab).trigger("change");
            },
            error: function(){
            alert('Error, no se puede cargar la lista desplegable de establecimiento');
            }
        });
    }
};

$("#cboregClie").change(function(){
    var v_mcboClie = $('#cboregClie').val();
    var v_accion = $('#hdnAccionregcapa').val();

    var params = { "ccliente":v_mcboClie };

    if(v_accion == 'N'){
        $.ajax({
            type: 'ajax',
            method: 'post',
            url: baseurl+"at/capa/cregcapa/buscar_establexcliente",
            dataType: "JSON",
            async: true,
            data: params,
            success:function(result)
            {
                $("#cboregEstab").html(result);           
            },
            error: function(){
                alert('Error, no se puede cargar la lista desplegable de establecimiento');
            }
        });
    }    
});
	
$('#mtxtFCapaini').on('change.datetimepicker',function(e){	
    
    $('#mtxtFCapafin').datetimepicker({
        format: 'DD/MM/YYYY',
        daysOfWeekDisabled: [0],
        locale:'es'
    });	

    var fecha = moment(e.date).format('DD/MM/YYYY');		
    
    $('#mtxtFCapafin').datetimepicker('minDate', fecha);
    $('#mtxtFCapafin').datetimepicker('date', fecha);

});

$('#frmRegCapa').submit(function(event){
    event.preventDefault();
    
    var request = $.ajax({
        url:$('#frmRegCapa').attr("action"),
        type:$('#frmRegCapa').attr("method"),
        data:$('#frmRegCapa').serialize(),
        error: function(){
            Vtitle = 'No se puede registrar por error';
            Vtype = 'error';
            sweetalert(Vtitle,Vtype);
        }
    });
    request.done(function( respuesta ) {
        var posts = JSON.parse(respuesta);        
        $.each(posts, function() { 
            $('#mtxtidcapa').val(this.id_capa);
            Vtitle = this.respuesta;
            Vtype = 'success';
            sweetalert(Vtitle,Vtype);
            document.getElementById('addcurso').style.visibility = 'visible';
            $('#btnParticiopantes').show();     
        });
    });
});

//
$('#btnParticiopantes').click(function(){
    $('#tabcapa a[href="#tabcapa-parti"]').tab('show');
    var vidcapa = $('#mtxtidcapa').val();
    recuperaListparti(vidcapa);
    $("#mtxtPerparti").prop({readonly:true});
    $("#mtxtDniparti").prop({readonly:true});
    $("#mtxtEmailparti").prop({readonly:true});
    $("#mtxtTelparti").prop({readonly:true}); 
});

recuperaListcapadet = function(){
    //document.querySelector('#lblInforme').innerText = '';

    otblListRegcapadet = $('#tblListRegcapadet').DataTable({ 
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
            "url"   : baseurl+"at/capa/cregcapa/getlistcapadet/",
            "type"  : "POST", 
            "data": function ( d ) {
                d.id_capa  = $('#mtxtidcapa').val(); 
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
            {"orderable": false, data: 'desc_curso', targets: 1},
            {"orderable": false, data: 'desc_modulo', targets: 2},
            {"orderable": false, 
              render:function(data, type, row){                
                  return  '<div>'+
                  '<a data-toggle="modal" title="Editar" style="cursor:pointer; color:#3c763d;" data-target="#modalCreacurso" onClick="javascript:selCapadet(\''+row.id_capacitacion+'\',\''+row.id_capadet+'\',\''+row.id_capacurso+'\',\''+row.id_capamodulo+'\',\''+row.ruta_presentacion+'\',\''+row.ruta_taller+'\',\''+row.ruta_examen+'\',\''+row.nomb_presentacion+'\',\''+row.nomb_taller+'\',\''+row.nomb_examen+'\');"><span class="fas fa-edit" aria-hidden="true"> </span> </a>'+
                  '&nbsp;'+
                  '<a id="aDelCapadet" href="'+row.id_capadet+'" title="Eliminar" style="cursor:pointer; color:#FF0000;"><span class="fas fa-trash-alt" aria-hidden="true"> </span></a>'+      
                  '</div>'
              }
            },
            {"orderable": false, 
              render:function(data, type, row){                
                  return  '<div>'+    
                    ' <a data-toggle="modal" title="Registrar" style="cursor:pointer;" data-target="#modalPrograma" onClick="javascript:insertProgram(\''+row.id_capacitacion+'\',\''+row.id_capadet+'\');"class="btn btn-outline-success btn-sm hidden-xs hidden-sm"><i class="fas fa-plus-circle" style="cursor:pointer;"> Agregar Programacion </i>  </a>'+
                    ' <a onClick="javascript:recuperaListprograma(\''+row.id_capadet+'\');"class="btn btn-outline-success btn-sm hidden-xs hidden-sm"><i class="fas fa-eye" style="cursor:pointer;"> Ver Programacion </i>  </a>'+
                  '</div>'
              }
            }
        ]
    });  
    // Enumeracion 
    otblListRegcapadet.on( 'order.dt search.dt', function () { 
        otblListRegcapadet.column(0, {search:'applied', order:'applied'}).nodes().each( function (cell, i) {
          cell.innerHTML = i+1;
          } );
    }).draw();
};

$("#addcurso").click(function (){
    var v_mIdcapa = $('#mtxtidcapa').val();
    $('#mhdnAccionCapa').val('N'); 
    $('#mhdnIdCapa').val(v_mIdcapa);
    iniRegCapadet(0,0);      	
});

selCapadet = function(id_capa,id_capadet,id_capacurso,id_capamodulo,ruta_presentacion,ruta_taller,ruta_examen,nomb_presentacion,nomb_taller,nomb_examen){
    $('#mhdnAccionCapa').val('A'); 

    $('#mhdnIdCapa').val(id_capa);
    $('#mhdnIdCapaDet').val(id_capadet);
    $('#mtxtRutapresent').val(ruta_presentacion);
    $('#mtxtRutataller').val(ruta_taller);
    $('#mtxtRutaexamen').val(ruta_examen);
    $('#mtxtNomarchpresent').val(nomb_presentacion);
    $('#mtxtNomarchtaller').val(nomb_taller);
    $('#mtxtNomarchexamen').val(nomb_examen);

    iniRegCapadet(id_capacurso,id_capamodulo);
}
   
$("body").on("click","#aDelCapadet",function(event){
    event.preventDefault();
    id_capadet = $(this).attr("href");

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
            $.post(baseurl+"at/capa/cregcapa/delcapadet/", 
            {
                id_capadet   : id_capadet,
            },      
            function(data){     
                otblListRegcapadet.ajax.reload(null,false); 
                Vtitle = 'Se Elimino Correctamente';
                Vtype = 'success';
                sweetalert(Vtitle,Vtype);      
            });
        }
    }) 
});

$('#modalCreacurso').on('shown.bs.modal', function (e) { 
    var v_mClie = $('#cboregClie').val();
    $('#mhdnIdCliente').val(v_mClie);
    
});

iniRegCapadet = function(id_capacurso,id_capamodulo){   

    $.ajax({
        type: 'ajax',
        method: 'post',
        url: baseurl+"at/capa/cregcapa/getcursocapa",
        dataType: "JSON",
        async: true,
        success:function(result)
        {
            $('#mcboCurso').html(result);
            $('#mcboCurso').val(id_capacurso).trigger("change");
        },
        error: function(){
            alert('Error, No se puede autenticar por error');
        }
    }); 
    
    var params = { "idcurso":id_capacurso};
    $.ajax({
        type: 'ajax',
        method: 'post',
        url: baseurl+"at/capa/cregcapa/gettemaxcurso",
        dataType: "JSON",
        async: true,
        data: params,
        success:function(result)
        {
            $('#mcboTema').html(result);
            $('#mcboTema').val(id_capamodulo).trigger("change");
        },
        error: function(){
            alert('Error, No se puede autenticar por error');
        }
    });
};

$("#mcboCurso").change(function(){ 
    var v_idcapacurso = $('#mcboCurso').val();
    var v_accion = $('#mhdnAccionCapa').val();

    if(v_accion == 'N'){
        var params = { "idcurso":v_idcapacurso};
        $.ajax({
            type: 'ajax',
            method: 'post',
            url: baseurl+"at/capa/cregcapa/gettemaxcurso",
            dataType: "JSON",
            async: true,
            data: params,
            success:function(result)
            {
                $('#mcboTema').html(result);
            },
            error: function(){
                alert('Error, No se puede autenticar por error');
            }
        });
    }
});

escogerPresent = function(){    
    var archivoInput = document.getElementById('mtxtArchivopresent');
    var archivoRuta = archivoInput.value;
    var extPermitidas = /(.pdf|.docx|.xlsx|.doc|.xls)$/i;
    
    var filename = $('#mtxtArchivopresent').val().replace(/.*(\/|\\)/, '');
    $('#mtxtNomarchpresent').val(filename);

    if(!extPermitidas.exec(archivoRuta)){
        alert('Asegurese de haber seleccionado un PDF, DOCX, XSLX');
        archivoInput.value = '';  
        $('#mtxtNomarchpresent').val('');
        return false;
    }      
    $('#sPresent').val('S');
};

escogerTaller = function(){    
    var archivoInput = document.getElementById('mtxtArchivotaller');
    var archivoRuta = archivoInput.value;
    var extPermitidas = /(.pdf|.docx|.xlsx|.doc|.xls)$/i;
    
    var filename = $('#mtxtArchivotaller').val().replace(/.*(\/|\\)/, '');
    $('#mtxtNomarchtaller').val(filename);

    if(!extPermitidas.exec(archivoRuta)){
        alert('Asegurese de haber seleccionado un PDF, DOCX, XSLX');
        archivoInput.value = '';  
        $('#mtxtNomarchtaller').val('');
        return false;
    }      
    $('#sTaller').val('S');
};

escogerExamen = function(){    
    var archivoInput = document.getElementById('mtxtArchivoexamen');
    var archivoRuta = archivoInput.value;
    var extPermitidas = /(.pdf|.docx|.xlsx|.doc|.xls)$/i;
    
    var filename = $('#mtxtArchivoexamen').val().replace(/.*(\/|\\)/, '');
    $('#mtxtNomarchexamen').val(filename);

    if(!extPermitidas.exec(archivoRuta)){
        alert('Asegurese de haber seleccionado un PDF, DOCX, XSLX');
        archivoInput.value = '';  
        $('#mtxtNomarchexamen').val('');
        return false;
    }      
    $('#sExamen').val('S');
};

$('#frmCreacurso').submit(function(event){
    event.preventDefault();
    
    var request = $.ajax({
        url:$('#frmCreacurso').attr("action"),
        type:$('#frmCreacurso').attr("method"),
        data:$('#frmCreacurso').serialize(),
        error: function(){
            Vtitle = 'No se puede registrar por error';
            Vtype = 'error';
            sweetalert(Vtitle,Vtype);
        }
    });
    request.done(function( respuesta ) {
        var posts = JSON.parse(respuesta);        
        $.each(posts, function() {   
            $('#mhdnIdCapaDet').val(this.id_capadet);

            if($('#sPresent').val() == 'S'){          
                subirPresent();
            }
            if($('#sTaller').val() == 'S'){ 
                subirTaller();
            }
            if($('#sExamen').val() == 'S'){ 
                subirExamen();
            }  
                 
            Vtitle = this.respuesta;
            Vtype = 'success';
            sweetalert(Vtitle,Vtype); 
            recuperaListcapadet();       
            $('#mbtnCCreacapa').click();
        });
    });
});

subirPresent=function(){
    var parametrotxt = new FormData($("#frmCreacurso")[0]);
    var request = $.ajax({
        data: parametrotxt,
        method: 'post',
        url: baseurl+"at/capa/cregcapa/subirPresent/",
        dataType: "JSON",
        async: true,
        contentType: false,
        processData: false,
        error: function(){
            alert('Error, no se cargó Presentacion');
        }
    });
    request.done(function( respuesta ) {
        $('#sPresent').val('N');
    });
};

subirTaller=function(){
    var parametrotxt = new FormData($("#frmCreacurso")[0]);
    var request = $.ajax({
        data: parametrotxt,
        method: 'post',
        url: baseurl+"at/capa/cregcapa/subirTaller/",
        dataType: "JSON",
        async: true,
        contentType: false,
        processData: false,
        error: function(){
            alert('Error, no se cargó Taller');
        }
    });
    request.done(function( respuesta ) {
        $('#sTaller').val('N');
    });
};

subirExamen=function(){
    var parametrotxt = new FormData($("#frmCreacurso")[0]);
    var request = $.ajax({
        data: parametrotxt,
        method: 'post',
        url: baseurl+"at/capa/cregcapa/subirExamen/",
        dataType: "JSON",
        async: true,
        contentType: false,
        processData: false,
        error: function(){
            alert('Error, no se cargó Examen');
        }
    });
    request.done(function( respuesta ) {
        $('#sExamen').val('N');
    });
};

//
recuperaListprograma = function(idcapadet){
    //document.querySelector('#lblInforme').innerText = '';

    otblListRegprogr = $('#tblListRegprogr').DataTable({ 
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
            "url"   : baseurl+"at/capa/cregcapa/getlistprograma/",
            "type"  : "POST", 
            "data": function ( d ) {
                d.id_capadet  = idcapadet; 
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
            {"orderable": false, data: 'datosrazonsocial', targets: 1},
            {"orderable": false, data: 'fecha_capa', targets: 2},
            {"orderable": false, data: 'hora_inicapa', targets: 3},
            {"orderable": false, data: 'hora_fincapa', targets: 3},
            {"orderable": false, 
              render:function(data, type, row){                
                  return  '<div>'+
                  '<a data-toggle="modal" title="Editar" style="cursor:pointer; color:#3c763d;" data-target="#modalPrograma" onClick="javascript:selprogram(\''+row.id_capacitacion+'\',\''+row.id_capadet+'\',\''+row.id_capaprogra+'\',\''+row.id_capaexpo+'\',\''+row.fecha_capa+'\',\''+row.hora_inicapa+'\',\''+row.hora_fincapa+'\');"><span class="fas fa-edit" aria-hidden="true"> </span> </a>'+
                  '&nbsp;'+
                  '<a id="aDelProgram" href="'+row.id_capaprogra+'" title="Eliminar" style="cursor:pointer; color:#FF0000;"><span class="fas fa-trash-alt" aria-hidden="true"> </span></a>'+      
                  '</div>'
              }
            }
        ]
    });  
    // Enumeracion 
    otblListRegprogr.on( 'order.dt search.dt', function () { 
        otblListRegprogr.column(0, {search:'applied', order:'applied'}).nodes().each( function (cell, i) {
          cell.innerHTML = i+1;
          } );
    }).draw();
};

insertProgram = function(id_capa,id_capadet){
    $('#frmPrograma').trigger("reset"); 
    $('#mhdnAccionprogr').val('N');
    $('#mhdnIdCapap').val(id_capa);
    $('#mhdnIdCapaDetp').val(id_capadet);
    $('#mhdnIdcapaprogra').val('');

}

selprogram = function(id_capa,id_capadet,id_capaprogra,id_capaexpo,fecha_capa,hora_inicapa,hora_fincapa){
    $('#mhdnAccionprogr').val('A'); 

    $('#mhdnIdCapap').val(id_capa);
    $('#mhdnIdCapaDetp').val(id_capadet);
    $('#mhdnIdcapaprogra').val(id_capaprogra);
    $('#mtxtFprogra').val(fecha_capa);
    $('#mtxtHoraini').val(hora_inicapa);
    $('#mtxtHorafin').val(hora_fincapa);

    iniRegProgra(id_capaexpo);
}

$('#modalPrograma').on('shown.bs.modal', function (e) {
    var v_accion = $('#mhdnAccionprogr').val();

    $('#mtxtFCapaProgra').datetimepicker({
        format: 'DD/MM/YYYY',
        daysOfWeekDisabled: [0],
        locale:'es',
        pickerPosition: "top-left"
    });

    $('#mtxtHini, #mtxtHfin').datetimepicker({
        format: 'hh:mm A',
        locale:'es',
        stepping: 15
    });	
    
    $('#mtxtHini').datetimepicker('minDate', moment('08:00 AM', 'hh:mm A') );
    $('#mtxtHini').datetimepicker('maxDate', moment('05:45 PM', 'hh:mm A') );
    $('#mtxtHini').datetimepicker('date', moment('08:00 AM', 'hh:mm A') );

    $('#mtxtHfin').datetimepicker('date', moment('08:15 AM', 'hh:mm A') );


    if (v_accion == 'N'){
        fechaActualProgra();
        iniRegProgra(0);
    }
    
});

iniRegProgra = function(id_capamodulo){

    $.ajax({
        type: 'ajax',
        method: 'post',
        url: baseurl+"at/capa/cregcapa/getexpositorcapa",
        dataType: "JSON",
        async: true,
        success:function(result)
        {
            $('#mcboCapaexpo').html(result);
            $('#mcboCapaexpo').val(id_capamodulo).trigger("change");
        },
        error: function(){
            alert('Error, No se puede autenticar por error');
        }
    });
};

fechaActualProgra = function(){
    var fecha = new Date();		
    var fechatring = ("0" + fecha.getDate()).slice(-2) + "/" + ("0"+(fecha.getMonth()+1)).slice(-2) + "/" +fecha.getFullYear() ;

    $('#mtxtFCapaProgra').datetimepicker('date', moment(fechatring, 'DD/MM/YYYY') );
    
}

$('#mtxtHini').on('change.datetimepicker',function(e){
    $('#mtxtHfin').datetimepicker({
        format: 'hh:mm A',
        locale:'es',
        stepping: 15
    });	 
    $('#mtxtHfin').datetimepicker('minDate', e.date.add(15, "minute"));
    $('#mtxtHfin').datetimepicker('maxDate', moment('06:00 PM', 'hh:mm A') );
    $('#mtxtHfin').datetimepicker('date', moment(e.date, 'hh:mm A'));    
});

$('#frmPrograma').submit(function(event){
    event.preventDefault();
    
    var request = $.ajax({
        url:$('#frmPrograma').attr("action"),
        type:$('#frmPrograma').attr("method"),
        data:$('#frmPrograma').serialize(),
        error: function(){
            Vtitle = 'No se puede registrar por error';
            Vtype = 'error';
            sweetalert(Vtitle,Vtype);
        }
    });
    request.done(function( respuesta ) {
        var posts = JSON.parse(respuesta);        
        $.each(posts, function() { 
            $('#mhdnIdCapaDetp').val(this.id_capadet);       
            Vtitle = this.respuesta;
            Vtype = 'success';
            sweetalert(Vtitle,Vtype);
            recuperaListprograma(this.id_capadet);        
            $('#mbtnCProgra').click();
        });
    });
});
   
$("body").on("click","#aDelProgram",function(event){
    event.preventDefault();
    id_capaprogra = $(this).attr("href");

    Swal.fire({
        title: 'Confirmar Eliminación',
        text: "¿Está seguro de eliminar al expositor?",
        icon: 'error',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Si, bórralo!'
    }).then((result) => {
        if (result.value) {
            $.post(baseurl+"at/capa/cregcapa/delprogram/", 
            {
                id_capaprogra   : id_capaprogra,
            },      
            function(data){     
                otblListRegprogr.ajax.reload(null,false); 
                Vtitle = 'Se Elimino Correctamente';
                Vtype = 'success';
                sweetalert(Vtitle,Vtype);      
            });
        }
    }) 
});

//
recuperaListparti = function(idcapa){
    $('#mhdnIdcapacitaparti').val(idcapa);
    otblListParticipantes = $('#tblListParticipantes').DataTable({ 
        'responsive'    : true,
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
            "url"   : baseurl+"at/capa/cregcapa/getlistparticipante/",
            "type"  : "POST", 
            "data": function ( d ) {
                d.id_capa  = idcapa; 
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
            {"orderable": false, data: 'NRODNI', targets: 1},
            {"orderable": false, data: 'NOMBREPARTI', targets: 2},
            {"orderable": false, data: 'NOTA', targets: 3},
            {"orderable": false, 
              render:function(data, type, row){                
                  return  '<div>'+
                  '<a title="Editar" style="cursor:pointer; color:#3c763d;" onClick="javascript:selParti(\''+row.id_capa+'\',\''+row.id_capaparti+'\',\''+row.id_administrado+'\',\''+row.NOMBREPARTI+'\',\''+row.NRODNI+'\',\''+row.fono_celular+'\',\''+row.email+'\',\''+row.NOTA+'\');"><span class="fas fa-edit" aria-hidden="true"> </span> </a>'+
                  '&nbsp;'+
                  '<a id="aDelParti" href="'+row.id_capaparti+'" title="Eliminar" style="cursor:pointer; color:#FF0000;"><span class="fas fa-trash-alt" aria-hidden="true"> </span></a>'+      
                  '</div>'
              }
            }
        ]
    });  
    // Enumeracion 
    otblListParticipantes.on( 'order.dt search.dt', function () { 
        otblListParticipantes.column(0, {search:'applied', order:'applied'}).nodes().each( function (cell, i) {
          cell.innerHTML = i+1;
          } );
    }).draw();
};

selParti = function(id_capa,id_capaparti,id_administrado,NOMBREPARTI,NRODNI,fono_celular,email, NOTA){
    $('#mhdnAccionParti').val('A'); 

    $('#mhdnIdparti').val(id_capaparti);
    $('#mhdnIdcapaParti').val(id_capa);
    $('#mhdnIdadmParti').val(id_administrado);
    $('#mtxtPerparti').val(NOMBREPARTI);
    $('#mtxtDniparti').val(NRODNI);
    $('#mtxtNotaparti').val(NOTA);
    $('#mtxtEmailparti').val(email);
    $('#mtxtTelparti').val(fono_celular);

}

$('#modalImportparti').on('shown.bs.modal', function (e) {
    var IdcapaParti = $('#mhdnIdcapacitaparti').val();
    $('#mhdnIdCapamigra').val(IdcapaParti);
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
    var parametrotxt = new FormData($("#frmImport")[0]);
    var request = $.ajax({
        data: parametrotxt,
        method: 'post',
        url: baseurl+"at/capa/cregcapa/import_parti",
        dataType: "JSON",
        async: true,
        contentType: false,
        processData: false,
        error: function(){
            alert('Error, no se cargó el archivo');
        }
    });
    request.done(function( respuesta ) {
        otblListParticipantes.ajax.reload(null,false);      
        Vtitle = this.respuesta;
        Vtype = 'success';
        sweetalert(Vtitle,Vtype);    
        $('#frmImport').trigger("reset");                 
        $('#mbtnCImportparti').click();
    });
});

$('#modalImportnota').on('shown.bs.modal', function (e) {
    var IdcapaParti = $('#mhdnIdcapacitaparti').val();
    $('#mhdnIdCapamigranota').val(IdcapaParti);
});

adjFilenota=function(){
    var archivoInput = document.getElementById('fileMigranota');
    var archivoRuta = archivoInput.value;
    var extPermitidas = /(.xls)$/i;
    
    var filename = $('#fileMigranota').val().replace(/.*(\/|\\)/, '');
    $('#txtFilenota').val(filename);

    if(!extPermitidas.exec(archivoRuta)){
        alert('Asegurese de haber seleccionado un XLS');
        archivoInput.value = '';  
        $('#txtFilenota').val('');
        return false;
    }    
};

$('#mbtnGUploadnota').click(function(){    
    var parametrotxt = new FormData($("#frmImportnota")[0]);
    var request = $.ajax({
        data: parametrotxt,
        method: 'post',
        url: baseurl+"at/capa/cregcapa/import_nota",
        dataType: "JSON",
        async: true,
        contentType: false,
        processData: false,
        error: function(){
            alert('Error, no se cargó el archivo');
        }
    });
    request.done(function( respuesta ) {
        otblListParticipantes.ajax.reload(null,false);      
        Vtitle = this.respuesta;
        Vtype = 'success';
        sweetalert(Vtitle,Vtype);    
        $('#frmImportnota').trigger("reset");                 
        $('#mbtnCImportnota').click();
    });
});

$('#frmRegParti').submit(function(event){
    event.preventDefault();
    
    var request = $.ajax({
        url:$('#frmRegParti').attr("action"),
        type:$('#frmRegParti').attr("method"),
        data:$('#frmRegParti').serialize(),
        error: function(){
            Vtitle = 'No se puede registrar por error';
            Vtype = 'error';
            sweetalert(Vtitle,Vtype);
        }
    });
    request.done(function( respuesta ) {
        var posts = JSON.parse(respuesta);        
        $.each(posts, function() { 
            otblListParticipantes.ajax.reload(null,false);      
            Vtitle = this.respuesta;
            Vtype = 'success';
            sweetalert(Vtitle,Vtype);       
        });
    });
});

//
$('#btnRetornarLista').click(function(){
    $('#tabcapa a[href="#tabcapa-list"]').tab('show');  
    $('#btnBuscar').click();
});

$('#btnRetornarReg').click(function(){
    $('#tabcapa a[href="#tabcapa-reg"]').tab('show');  
});