
var otblListInforme, otblListRegInforme, otblListRegitro, otblListReg03equipo, otblListReg06equipo, otblListReg08equipo;
var varfdesde = '%', varfhasta = '%';
var iduser = $('#mtxtidusuinfor').val();

$(document).ready(function() { 
    
    $('#tabinforme a[href="#tabinforme-list-tab"]').attr('class', 'disabled');
    $('#tabinforme a[href="#tabinforme-eval-tab"]').attr('class', 'disabled active');
    $('#tabinforme a[href="#tabinforme-reg-tab"]').attr('class', 'disabled active');

    $('#tabinforme a[href="#tabinforme-list-tab"]').not('#store-tab.disabled').click(function(event){
        $('#tabinforme a[href="#tabinforme-list"]').attr('class', 'active');
        $('#tabinforme a[href="#tabinforme-eval"]').attr('class', '');
        $('#tabinforme a[href="#tabinforme-reg"]').attr('class', '');
        return true;
    });
    $('#tabinforme a[href="#tabinforme-eval-tab"]').not('#bank-tab.disabled').click(function(event){
        $('#tabinforme a[href="#tabinforme-eval"]').attr('class' ,'active');
        $('#tabinforme a[href="#tabinforme-list"]').attr('class', '');
        $('#tabinforme a[href="#tabinforme-reg"]').attr('class', '');
        return true;
    });
    $('#tabinforme a[href="#tabinforme-reg-tab"]').not('#bank-tab.disabled').click(function(event){
        $('#tabinforme a[href="#tabinforme-reg"]').attr('class' ,'active');
        $('#tabinforme a[href="#tabinforme-list"]').attr('class', '');
        $('#tabinforme a[href="#tabinforme-eval"]').attr('class', '');
        return true;
    });
    
    $('#tabinforme a[href="#tabinforme-list"]').click(function(event){return false;});
    $('#tabinforme a[href="#tabinforme-eval"]').click(function(event){return false;});
    $('#tabinforme a[href="#tabinforme-reg"]').click(function(event){return false;});
    
    $('#txtFDesde,#txtFHasta').datetimepicker({
        format: 'DD/MM/YYYY',
        daysOfWeekDisabled: [0],
        locale:'es'
    });

    $('#mtxtFreginforme').datetimepicker({
        format: 'DD/MM/YYYY',
        daysOfWeekDisabled: [0],
        locale:'es'
    });	

    $('#mtxtFreginformeedit').datetimepicker({
        format: 'DD/MM/YYYY',
        daysOfWeekDisabled: [0],
        locale:'es'
    });	

    fechaActual();
    
    $.ajax({
        type: 'ajax',
        method: 'post',
        url: baseurl+"pt/cinforme/getServicio",
        dataType: "JSON",
        async: true,
        success:function(result)
        {
            $('#cboServ').html(result);
        },
        error: function(){
            alert('Error, No se puede autenticar por error');
        }
    });
    
    $.ajax({
        type: 'ajax',
        method: 'post',
        url: baseurl+"pt/cinforme/getclienteinfor",
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
    var vlvigencia;
    if($('#swVigencia').prop('checked')){
        vlvigencia = 'A';
    }else{
        vlvigencia = 'I';
    }

    if(varfdesde != '%'){ varfdesde = $('#txtFIni').val(); }
    if(varfhasta != '%'){ varfhasta = $('#txtFFin').val(); }  

    otblListInforme = $('#tblListInforme').DataTable({  
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
        'ajax'	: {
            "url"   : baseurl+"pt/cinforme/getbuscarinforme/",
            "type"  : "POST", 
            "data": function ( d ) {
                d.cservicio     = $('#cboServ').val();
                d.fdesde        = varfdesde; 
                d.fhasta        = varfhasta;   
                d.ccliente      = $('#cboClie').val();
                d.dnropropu     = $('#txtnropropu').val(); 
                d.dnroinfor     = $('#txtnroinfor').val();
                d.vigente       = vlvigencia; 
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
            {"orderable": false, data: 'NROINFOR', targets: 1, "class": "col-sm"},
            {"orderable": false, data: 'RAZONSOCIAL', targets: 2, "class": "col-l"},
            {"orderable": false, data: 'RESPONSABLE', targets: 3, "class": "col-m"},
            {"orderable": false, data: 'FECHINFOR', targets: 4, "class": "col-sm"},
            {"orderable": false, data: 'DESCRIPSERV', targets: 5},
            {"orderable": false, data: 'NROPROPU', targets: 6},
            {responsivePriority: 1, "orderable": false, "class": "col-s", 
              render:function(data, type, row){                
                  return  '<div>'+ 
                    '<a data-toggle="modal" title="Editar" style="cursor:pointer; color:#3c763d;" data-target="#modalEditInfor" onClick="javascript:selInformeedit(\''+row.IDINFOR+'\',\''+row.idptevaluacion+'\',\''+row.NROINFOR+'\',\''+row.FECHINFOR+'\',\''+row.idresponsable+'\',\''+row.ARCHIVO+'\',\''+row.ruta_informe+'\',\''+row.descripcion+'\',\''+row.descripcion_archivo+'\');"><span class="fas fa-edit" aria-hidden="true"> </span> </a>'+
                    '&nbsp;'+
                    '<a id="aDelInfor" href="'+row.IDINFOR+'" title="Eliminar" style="cursor:pointer; color:#FF0000;"><span class="fas fa-trash-alt" aria-hidden="true"> </span></a>'+      
                    '&nbsp;'+
                    ' <a data-toggle="modal" title="Evaluación" style="cursor:pointer; color:#3c763d;" onClick="javascript:selEval(\''+row.idptevaluacion+'\',\''+row.idptpropuesta+'\',\''+row.ccliente+'\',\''+row.idptservicio+'\',\''+row.DESCRIPSERV+'\',\''+row.NROPROPU+'\',\''+row.RAZONSOCIAL+'\');"><span class="fas fa-external-link-alt" aria-hidden="true"> </span></a>'+
                    '</div>'
              }
            },            
            {"orderable": false, 
              render:function(data, type, row){ 
                  return ' <div>'+
                    ' <a data-toggle="modal" title="Adjuntar" style="cursor:pointer; color:#3c763d;" data-target="#modalDetaPropu" onClick="javascript:listarDetPropuesta(\''+row.IDPROPU+'\');"class="btn btn-outline-primary btn-sm hidden-xs hidden-sm"><span class="fas fa-folder-open" aria-hidden="true"> </span> DOCUMENTOS ADJUNTOS</a>'+
                    ' &nbsp; &nbsp;'+
                    ' <a data-toggle="modal" title="Extender" style="cursor:pointer; color:#3c763d;" data-target="#modalCreaInfor" onClick="javascript:SelExtenderpropu(\''+row.IDPROPU+'\',\''+row.CODCLIENTE+'\',\''+row.NROPROPU+'\',\''+row.FECHPROPU+'\',\''+row.IDSERV+'\',\''+row.DETAPROPU+'\',\''+row.COSTOTOTAL+'\',\''+row.ESTPROPU+'\',\''+row.CONTACTO+'\',\''+row.OBSPROPU+'\',\''+row.SERVNEW+'\',\''+row.CLIPOTEN+'\',\''+row.IDUSUARIO+'\',\''+row.TIPOCOSTO+'\',\''+row.ARCHIVO+'\',\''+row.CODESTABLE+'\',\''+row.RUTA+'\');"class="btn btn-outline-primary btn-sm hidden-xs hidden-sm"><span class="fas fa-external-link-alt" aria-hidden="true"> </span> EXTENDER INFORME</a>'+
                    ' &nbsp; &nbsp;'+
                    ' <a data-toggle="modal" title="Duplicar" style="cursor:pointer; color:#3c763d;" data-target="#modalCreaInfor" onClick="javascript:SelDuplicarpropu(\''+row.IDPROPU+'\',\''+row.CODCLIENTE+'\',\''+row.NROPROPU+'\',\''+row.FECHPROPU+'\',\''+row.IDSERV+'\',\''+row.DETAPROPU+'\',\''+row.COSTOTOTAL+'\',\''+row.ESTPROPU+'\',\''+row.CONTACTO+'\',\''+row.OBSPROPU+'\',\''+row.SERVNEW+'\',\''+row.CLIPOTEN+'\',\''+row.IDUSUARIO+'\',\''+row.TIPOCOSTO+'\',\''+row.ARCHIVO+'\',\''+row.CODESTABLE+'\',\''+row.RUTA+'\');"class="btn btn-outline-primary btn-sm hidden-xs hidden-sm"><span class="fas fa-clone" aria-hidden="true"> </span> DUPLICAR INFORME</a>'+
                  '</div>' 
              }
            }
        ],
        "columnDefs": [{
            "targets": [1], 
            "data": null, 
            "render": function(data, type, row) { 
                if(row.ARCHIVO != "") {
                    return '<p><a href="'+baseurl+row.ruta_informe+row.ARCHIVO+'" target="_blank" class="pull-left">'+row.NROINFOR+'&nbsp;<i class="fas fa-cloud-download-alt" data-original-title="Descargar" data-toggle="tooltip"></i></a><p>';
                }else{
                    return '<p>'+row.NROINFOR+'</p>';
                }                      
            }
        }]
    });   
    // Enumeracion 
    otblListInforme.on( 'order.dt search.dt', function () { 
        otblListInforme.column(0, {search:'applied', order:'applied'}).nodes().each( function (cell, i) {
          cell.innerHTML = i+1;
          } );
    }).draw();  
});

$('#modalEditInfor').on('shown.bs.modal', function (e) {    
    $("#mtxtNroinforedit").prop({readonly:true}); 
});

selInformeedit= function(idptinforme,idptevaluacion,nro_informe,fecha_informe,idresponsable,archivo_informe,ruta_informe,descripcion,descripcion_archivo){
    $('#mhdnAccionInforedit').val('A');
        
    $('#mhdnIdInforedit').val(idptinforme);
    $('#mhdnIdptevaledit').val(idptevaluacion);
    $('#mtxtNroinforedit').val(nro_informe);
    $('#mtxtFinforedit').val(fecha_informe);
    $('#mcboContacInforedit').val(idresponsable).trigger("change");
    $('#mtxtNomarchinforedit').val(descripcion_archivo);
    $('#mtxtRutainforedit').val(ruta_informe);
    $('#mtxtDetaInforedit').val(descripcion);
    $('#mtxtArchinforedit').val(archivo_informe);
    
    $('#lbchkinfedit').show();
}; 

$("#chkNroAntiguoedit").on("change", function () {
    if($("#chkNroAntiguoedit").is(":checked") == true){ 
        $("#mtxtNroinforedit").prop({readonly:false}); 
    }else if($("#chkNroAntiguoedit").is(":checked") == false){ 
        $("#mtxtNroinforedit").prop({readonly:true}); 
    }; 
});

escogerArchivoedit = function(){    
    var archivoInput = document.getElementById('mtxtArchivoinforedit');
    var archivoRuta = archivoInput.value;
    var extPermitidas = /(.pdf|.docx|.xlsx|.doc|.xls)$/i;
    
    var filename = $('#mtxtArchivoinforedit').val().replace(/.*(\/|\\)/, '');
    $('#mtxtNomarchinforedit').val(filename);

    if(!extPermitidas.exec(archivoRuta)){
        alert('Asegurese de haber seleccionado un PDF, DOCX, XSLX');
        archivoInput.value = '';  
        $('#mtxtNomarchinforedit').val('');
        return false;
    }      
    $('#sArchivoedit').val('S');
};
    
$('#frmEditInfor').submit(function(event){
    event.preventDefault();
    
    var request = $.ajax({
        url:$('#frmEditInfor').attr("action"),
        type:$('#frmEditInfor').attr("method"),
        data:$('#frmEditInfor').serialize(),
        error: function(){
            Vtitle = 'No se puede registrar por error';
            Vtype = 'error';
            sweetalert(Vtitle,Vtype);
        }
    });
    request.done(function( respuesta ) {
        var posts = JSON.parse(respuesta);        
        $.each(posts, function() {   
            $('#mhdnIdInforedit').val(this.id_informe);
            if($('#sArchivoedit').val() == 'S'){          
                subirArchivoEdit();
            }else{                   
                $('#mbtnCEditInfor').click();     
                Vtitle = this.respuesta;
                Vtype = 'success';
                sweetalert(Vtitle,Vtype);        
                otblListInforme.ajax.reload(null,false);
            } 
            $('#sArchivoedit').val('N');  
        });

    });
});

subirArchivoEdit=function(){
    var parametrotxt = new FormData($("#frmEditInfor")[0]);
    var request = $.ajax({
        data: parametrotxt,
        method: 'post',
        url: baseurl+"pt/cinforme/subirArchivoEdit/",
        dataType: "JSON",
        async: true,
        contentType: false,
        processData: false,
        error: function(){
            alert('Error, no se cargó el archivo');
        }
    });
    request.done(function( respuesta ) {         
        Vtitle = 'Guardo Correctamente';
        Vtype = 'success';
        sweetalert(Vtitle,Vtype);
        otblListInforme.ajax.reload(null,false);
        $('#mbtnCEditInfor').click();
    });
};
   
$("body").on("click","#aDelInforEdit",function(event){
    event.preventDefault();
    idptinforme = $(this).attr("href");

    Swal.fire({
        title: 'Confirmar Eliminación',
        text: "¿Está seguro de eliminar el Informe?",
        icon: 'error',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Si, bórralo!'
    }).then((result) => {
        if (result.value) {
            $.post(baseurl+"pt/cinforme/delinforme/", 
            {
                idptinforme   : idptinforme,
            },      
            function(data){     
                otblListInforme.ajax.reload(null,false); 
                Vtitle = 'Se Elimino Correctamente';
                Vtype = 'success';
                sweetalert(Vtitle,Vtype);      
            });
        }
    }) 
});

$('#btnNuevo').click(function(){
    
    $('#tabinforme a[href="#tabinforme-eval"]').tab('show'); 
    $('#frmMantEval').trigger("reset");
    $('#hdnAccionpteval').val('G');
    $('#cboRegClie').val('').trigger("change");  
    $('#hdnIdpteval').val(null);
    $('#txtRegClie').hide();
    $('#divRegClie').show(); 
    $('#txtRegPropu').hide();
    $('#divRegPropu').show();  
    $('#btnEvaluar').show(); 
    $('#btnRetornarLista').show();    
    
    document.getElementById('addinforme').style.visibility = 'hidden';
    
    $('#tblListRegInforme').DataTable().clear();
    $('#tblListRegInforme').DataTable().destroy();
    $('#tblListRegitro').DataTable().clear();
    $('#tblListRegitro').DataTable().destroy();
      
    $.ajax({
        type: 'ajax',
        method: 'post',
        url: baseurl+"pt/cpropuesta/getclientepropu",
        dataType: "JSON",
        async: true,
        success:function(result)
        {
            $('#cboRegClie').html(result);
        },
        error: function(){
            alert('Error, No se puede autenticar por error');
        }
    }); 
});

$("#cboRegClie").change(function(){
    var v_RegClie = $('#cboRegClie').val();
    var params = { 
        "ccliente":v_RegClie 
    };
    $.ajax({
        type: 'ajax',
        method: 'post',
        url: baseurl+"pt/cinforme/getpropuevaluar",
        dataType: "JSON",
        async: true,
        data: params,
        success:function(result)
        {
          $("#cboRegPropu").html(result);  
          $('#txtservicio').val('');
          $('#hdnidserv').val('');	
        },
        error: function(){
          alert('Error, no se puede cargar la lista desplegable de establecimiento');
        }
    });
}); 

$("#cboRegPropu").change(function(){
    var v_RegPropu = $('#cboRegPropu').val();
    var v_accion = $('#hdnAccionpteval').val(); 
    var params = { 
        "idptpropu":v_RegPropu 
    };

    if (v_accion == 'G') {
        var request = $.ajax({
            type: 'ajax',
            method: 'post',
            url: baseurl+"pt/cinforme/getservicioevaluar",
            dataType: "JSON",
            async: true,
            data: params,
            error: function(){
            alert('Error, no se puede cargar la lista desplegable de establecimiento');
            }
        });
        request.done(function( respuesta ) {
            $.each(respuesta, function() {    
                $('#txtservicio').val(this.DESCSERV);
                $('#hdnidserv').val(this.IDPTSERV);	
                if(this.IDEVALUACION != 0){
                    $('#hdnIdpteval').val(this.IDEVALUACION);
                    $('#btnEvaluar').hide(); 
                    document.getElementById('addinforme').style.visibility = 'visible';
                }
            });
        });
    }
}); 

selEval= function(idptevaluacion,idptpropuesta,ccliente,idptservicio,DESCRIPSERV,NROPROPU,RAZONSOCIAL){
    $('#tabinforme a[href="#tabinforme-eval"]').tab('show'); 
    $('#hdnAccionpteval').val('A');    
    document.getElementById('addinforme').style.visibility = 'visible';
    
    $('#hdnIdpteval').val(idptevaluacion);
    $('#txtRegClie').val(RAZONSOCIAL);
    $('#hdnidserv').val(idptservicio);
    $('#txtservicio').val(DESCRIPSERV);
    $('#cboRegPropu').val(idptpropuesta);
    $('#txtRegPropu').val(NROPROPU);
    
    $('#txtRegClie').show();
    $('#divRegClie').hide(); 
    $('#txtRegPropu').show();
    $('#divRegPropu').hide();

    $('#btnEvaluar').hide(); 
    $('#btnRetornarLista').show();

    recuperaListinforme()
    
    $('#tblListRegitro').DataTable().clear();
    $('#tblListRegitro').DataTable().destroy();
};
   
$('#frmMantEval').submit(function(event){
    event.preventDefault();
    
    var request = $.ajax({
        url:$('#frmMantEval').attr("action"),
        type:$('#frmMantEval').attr("method"),
        data:$('#frmMantEval').serialize(),
        error: function(){
          alert('Error, No se puede autenticar por error');
        }
    });
    request.done(function( respuesta ) {
        var posts = JSON.parse(respuesta);
        
        $.each(posts, function() {
            $('#btnEvaluar').hide(); 
            $('#btnRetornarLista').hide(); 
            $('#hdnIdpteval').val(this.id_evaluacion);
            document.getElementById('addinforme').style.visibility = 'visible';
            Vtitle = 'Siga evaluando';
            Vtype = 'success';
            sweetalert(Vtitle,Vtype);     
        });
    });
});

$('#addinforme').click(function(){
    $('#frmCreaInfor').trigger("reset");
    var hdnIdpteval = $('#hdnIdpteval').val();

    $('#mhdnIdpteval').val(hdnIdpteval);
    $('#mhdnAccionInfor').val('N');
    fechaActualinfor();
    nro_informe(); 
    
    $('#lbchkinf').show();
});

$('#modalCreaInfor').on('shown.bs.modal', function (e) {    
    $("#mtxtNroinfor").prop({readonly:true}); 
});

fechaActualinfor= function(){
    var fecha = new Date();	
    var fechatring = ("0" + fecha.getDate()).slice(-2) + "/" + ("0"+(fecha.getMonth()+1)).slice(-2) + "/" +fecha.getFullYear() ;
    
    $('#mtxtFreginforme').datetimepicker('date', moment(fechatring, 'DD/MM/YYYY') );	
};

$("#chkNroAntiguo").on("change", function () {
    if($("#chkNroAntiguo").is(":checked") == true){ 
        $("#mtxtNroinfor").prop({readonly:false}); 
    }else if($("#chkNroAntiguo").is(":checked") == false){ 
        $("#mtxtNroinfor").prop({readonly:true}); 
    }; 
    
    if ($('#mhdnAccionInfor').val()=='N'){
        nro_informe();
    }
}); 

function nro_informe(){
    var vyearPropu = $('#mtxtFinfor').val().substr(6);
    var params = { 
        "yearPropu" : vyearPropu
    }; 

    $.ajax({
      type: 'ajax',
      method: 'post',
      url: baseurl+"pt/cinforme/getnroinforme",
      dataType: "JSON",
      async: true,
      data: params,
      success: function (result){
        var c = (result);
        $.each(c,function(i,item){
          $('#mtxtNroinfor').val(item.NRO_INFO);
        })
      },
      error: function(){
        alert('Error, no se genero Nro. Propuesta');
      }
    })
};

escogerArchivo = function(){    
    var archivoInput = document.getElementById('mtxtArchivoinfor');
    var archivoRuta = archivoInput.value;
    var extPermitidas = /(.pdf|.docx|.xlsx|.doc|.xls)$/i;
    
    var filename = $('#mtxtArchivoinfor').val().replace(/.*(\/|\\)/, '');
    $('#mtxtNomarchinfor').val(filename);

    if(!extPermitidas.exec(archivoRuta)){
        alert('Asegurese de haber seleccionado un PDF, DOCX, XSLX');
        archivoInput.value = '';  
        $('#mtxtNomarchinfor').val('');
        return false;
    }      
    $('#sArchivo').val('S');
};

$('#frmCreaInfor').submit(function(event){
    event.preventDefault();
    
    var request = $.ajax({
        url:$('#frmCreaInfor').attr("action"),
        type:$('#frmCreaInfor').attr("method"),
        data:$('#frmCreaInfor').serialize(),
        error: function(){
            Vtitle = 'No se puede registrar por error';
            Vtype = 'error';
            sweetalert(Vtitle,Vtype);
        }
    });
    request.done(function( respuesta ) {
        var posts = JSON.parse(respuesta);        
        $.each(posts, function() {   
            $('#mhdnIdInfor').val(this.id_informe);
            if($('#sArchivo').val() == 'S'){          
                subirArchivo();
            }else{                   
                $('#btnRetornarLista').show();
                $('#mbtnCCreaInfor').click();     
                Vtitle = this.respuesta;
                Vtype = 'success';
                sweetalert(Vtitle,Vtype);        
                otblListRegInforme.ajax.reload(null,false);
            } 
            $('#sArchivo').val('N');  
        });
    });
});

subirArchivo=function(){
    var parametrotxt = new FormData($("#frmCreaInfor")[0]);
    var request = $.ajax({
        data: parametrotxt,
        method: 'post',
        url: baseurl+"pt/cinforme/subirArchivo/",
        dataType: "JSON",
        async: true,
        contentType: false,
        processData: false,
        error: function(){
            alert('Error, no se cargó el archivo');
        }
    });
    request.done(function( respuesta ) {         
        Vtitle = 'Guardo Correctamente';
        Vtype = 'success';
        sweetalert(Vtitle,Vtype);
        otblListRegInforme.ajax.reload(null,false);
        $('#mbtnCCreaInfor').click();
    });
};
   
$("body").on("click","#aDelInfor",function(event){
    event.preventDefault();
    idptinforme = $(this).attr("href");

    Swal.fire({
        title: 'Confirmar Eliminación',
        text: "¿Está seguro de eliminar el Informe?",
        icon: 'error',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Si, bórralo!'
    }).then((result) => {
        if (result.value) {
            $.post(baseurl+"pt/cinforme/delinforme/", 
            {
                idptinforme   : idptinforme,
            },      
            function(data){     
                otblListRegInforme.ajax.reload(null,false); 
                Vtitle = 'Se Elimino Correctamente';
                Vtype = 'success';
                sweetalert(Vtitle,Vtype);      
            });
        }
    }) 
});

recuperaListinforme = function(){
    document.querySelector('#lblInforme').innerText = '';

    otblListRegInforme = $('#tblListRegInforme').DataTable({ 
        'bJQueryUI'     : true, 
        'scrollY'     	: '200px',
        'scrollX'     	: true, 
        'paging'      	: false,
        'processing'  	: true,      
        'bDestroy'    	: true,
        'info'        	: true,
        'filter'      	: false,
        'stateSave'     : true, 
        "ordering"		: false, 
        'ajax'	: {
            "url"   : baseurl+"pt/cinforme/getlistinforme/",
            "type"  : "POST", 
            "data": function ( d ) {
                d.idptevaluacion  = $('#hdnIdpteval').val(); 
            },     
            dataSrc : ''        
        },
        'columns'	: [
            {"orderable": false, data: 'nro_informe', targets: 0, "class": "col-m"},
            {"orderable": false, data: 'fecha_informe', targets: 1, "class": "col-sm"},
            {"orderable": false, data: 'RESPONSABLE', targets: 2, "class": "col-lm"},
            {"orderable": false, "class": "col-s", 
              render:function(data, type, row){                
                  return  '<div>'+
                  '<a data-toggle="modal" title="Editar" style="cursor:pointer; color:#3c763d;" data-target="#modalCreaInfor" onClick="javascript:selInforme(\''+row.idptinforme+'\',\''+row.idptevaluacion+'\',\''+row.nro_informe+'\',\''+row.fecha_informe+'\',\''+row.idresponsable+'\',\''+row.archivo_informe+'\',\''+row.ruta_informe+'\',\''+row.descripcion+'\',\''+row.descripcion_archivo+'\');"><span class="fas fa-edit" aria-hidden="true"> </span> </a>'+
                  '&nbsp;'+
                  '<a id="aDelInforEdit" href="'+row.idptinforme+'" title="Eliminar" style="cursor:pointer; color:#FF0000;"><span class="fas fa-trash-alt" aria-hidden="true"> </span></a>'+      
                  '</div>'
              }
            },
            {"orderable": false, "class": "col-xl", 
              render:function(data, type, row){                
                  return  '<div>'+    
                    ' <a onClick="javascript:insertRegistro(\''+row.idptinforme+'\',\''+row.idptevaluacion+'\',\''+row.idptservicio+'\',\''+row.descripcion_serv+'\',\''+row.nro_informe+'\');"class="btn btn-outline-success btn-sm hidden-xs hidden-sm"><i class="fas fa-plus-circle" style="cursor:pointer;"> Agregar Registro </i>  </a>'+
                    ' <a onClick="javascript:recuperaListregistro(\''+row.idptinforme+'\',\''+row.nro_informe+'\');"class="btn btn-outline-success btn-sm hidden-xs hidden-sm"><i class="fas fa-eye" style="cursor:pointer;"> Ver Registro </i>  </a>'+
                  '</div>'
              }
            }
        ],
        "columnDefs": [{
            "targets": [0], 
            "data": null, 
            "render": function(data, type, row) { 
                if(row.archivo_informe != "") {
                    return '<p><a href="'+baseurl+row.ruta_informe+row.archivo_informe+'" target="_blank" class="pull-left">'+row.nro_informe+'&nbsp;<i class="fas fa-cloud-download-alt" data-original-title="Descargar" data-toggle="tooltip"></i></a><p>';
                }else{
                    return '<p>'+row.nro_informe+'</p>';
                }                      
            }
        }]
    });
};

selInforme= function(idptinforme,idptevaluacion,nro_informe,fecha_informe,idresponsable,archivo_informe,ruta_informe,descripcion,descripcion_archivo){
    $('#mhdnAccionInfor').val('A');
        
    $('#mhdnIdInfor').val(idptinforme);
    $('#mhdnIdpteval').val(idptevaluacion);
    $('#mtxtNroinfor').val(nro_informe);
    $('#mtxtFinfor').val(fecha_informe);
    $('#mcboContacInfor').val(idresponsable).trigger("change");
    $('#mtxtNomarchinfor').val(descripcion_archivo);
    $('#mtxtRutainfor').val(ruta_informe);
    $('#mtxtDetaInfor').val(descripcion);
    $('#mtxtArchinfor').val(archivo_informe);
    
    $('#lbchkinf').show();
};

recuperaListregistro = function(Idinforme,nro_informe){
    document.querySelector('#lblInforme').innerText = nro_informe;
    
    otblListRegitro = $('#tblListRegitro').DataTable({
        'bJQueryUI'     : true, 
        'scrollY'     	: '200px',
        'scrollX'     	: true, 
        'paging'      	: false,
        'processing'  	: true,      
        'bDestroy'    	: true,
        'info'        	: true,
        'filter'      	: false, 
        'stateSave'     : true,
        "ordering"		: false, 
        'ajax'	: {
            "url"   : baseurl+"pt/cinforme/getlistregistro/",
            "type"  : "POST", 
            "data": function ( d ) {
                d.idinforme  = Idinforme; 
                d.idptservicio  = $('#hdnidserv').val();
            },     
            dataSrc : ''        
        },
        'columns'	: [
            {"orderable": false, data: 'ESTUDIO', targets: 0},
            {"orderable": false, data: 'TIPO', targets: 1},
            {"orderable": false, data: 'DESC', targets: 2},
            {"orderable": false, 
              render:function(data, type, row){                
                  return  '<div>'+    
                    ' <a onClick="javascript:selRegistro(\''+row.idptregistro+'\',\''+row.idptinforme+'\',\''+row.idptregequipo+'\',\''+row.idptregproducto+'\',\''+row.idptservicio+'\',\''+row.descripcion_serv+'\',\''+row.idptregestudio+'\',\''+row.ESTUDIO+'\',\''+row.idptregrecinto+'\',\''+row.idptregprocestudio+'\');"><i class="fas fa-edit" style="color:#088A08; cursor:pointer;"> </i> </a>'+
                  '</div>'
              }
            }
        ]
    }); 
};

$('#btnRetornarLista').click(function(){
    $('#btnBuscar').click();
    $('#tabinforme a[href="#tabinforme-list"]').tab('show');  
});

// REGISTROS POR EVALUACION
insertRegistro= function(idptinforme,idptevaluacion,idptservicio,descripcion_serv,nro_informe){

    $('#tabinforme a[href="#tabinforme-reg"]').tab('show'); 

    $('#frmMantRegistro').trigger("reset");
    
    $('#txtRegEstudio').hide();
    $('#divRegEstudio').show();

    $('#01Registro').hide();
    $('#03Registro').hide();
    $('#06Registro').hide();
    $('#regEquipos06').hide();
    $('#08Registro').hide();
    $('#regEquipos08').hide();
    $('#09Registro').hide();
    $('#10Registro').hide();
    $('#11Registro').hide();
    $('#12Registro').hide();
    $('#13Registro').hide();
    $('#14Registro').hide();

    $('#hdnAccionptreg').val('N');  
    $('#hdnIdreginfor').val(idptinforme);
    $('#hdnnroinforme').val(nro_informe);
    
    $('#hdnIdregservi').val(idptservicio);
    $('#txtregservi').val(descripcion_serv);
    
    $('#hdnIdregequipo').val();
    $('#hdnIdregproducto').val(); 
    $('#hdnIdregrecinto').val(); 
    $('#hdnIdregprocestudio').val(); 
        
    $('#btnNuevoReg').hide();
    $('#btnGrabarReg').show();
    
    var v_RegServi = $('#hdnIdregservi').val();
    var params = { 
        "cservicio":v_RegServi 
    };
    if(v_RegServi == 4){
        $('#hdnIdRegEstudio').val('6');
        $('#06Registro').show();
        $('#divEstudio').hide();        
        mostrarRegistro(6);
    }else if(v_RegServi == 3){
        $('#hdnIdRegEstudio').val('8');
        $('#08Registro').show();
        $('#divEstudio').hide();        
        mostrarRegistro(8);
    }else if(v_RegServi == 12){
        $('#hdnIdRegEstudio').val('14');
        $('#14Registro').show();
        $('#divEstudio').hide();        
        mostrarRegistro(14);
    }else if(v_RegServi == 6){
        $('#hdnIdRegEstudio').val('15');
        $('#15Registro').show();
        $('#divEstudio').hide();        
        mostrarRegistro(15);
    }else{
        $('#06Registro').hide();
        $('#08Registro').hide();
        $('#14Registro').hide();
        $('#divEstudio').show(); 
        $('#hdnIdRegEstudio').val('');

        $.ajax({
            type: 'ajax',
            method: 'post',
            url: baseurl+"pt/cinforme/getEstudio",
            dataType: "JSON",
            async: true,
            data: params,
            success:function(result){
              $("#cboRegEstudio").html(result);  
            },
            error: function(){
              alert('Error, no se puede cargar la lista desplegable de establecimiento');
            }
        });
    }
};

$("#cboRegEstudio").change(function(){
    var v_RegEstu = $('#cboRegEstudio').val();

    $('#btnGrabarReg').show();
    $('#hdnIdRegEstudio').val(v_RegEstu);

    mostrarRegistro(v_RegEstu);
}); 

mostrarRegistro = function(v_RegEstu){

    if(v_RegEstu == 1){

        $('#01Registro').show();
        $('#02Registro').hide();
        $('#03Registro').hide();
        $('#04Registro').hide();
        $('#05Registro').hide();
        $('#06Registro').hide();
        $('#07Registro').hide();
        $('#08Registro').hide();
        $('#09Registro').hide();
        $('#10Registro').hide();
        $('#11Registro').hide();
        $('#12Registro').hide();
        $('#13Registro').hide();
        $('#14Registro').hide();

        var params = { 
            "idptregestudio":v_RegEstu 
        };

        $.ajax({
            type: 'ajax',
            method: 'post',
            url: baseurl+"pt/cinforme/getTipoequipo",
            dataType: "JSON",
            async: true,
            data: params,
            success:function(result){
                $("#cboTipoequipoReg01").html(result);  
            },
            error: function(){
                alert('Error, no se puede cargar la lista desplegable de establecimiento');
            }
        });
        $.ajax({
            type: 'ajax',
            method: 'post',
            url: baseurl+"pt/cinforme/getMediocalen",
            dataType: "JSON",
            async: true,
            data: params,
            success:function(result){
                $("#cboMediocalientaReg01").html(result);  
            },
            error: function(){
                alert('Error, no se puede cargar la lista desplegable de establecimiento');
            }
        });
        $.ajax({
            type: 'ajax',
            method: 'post',
            url: baseurl+"pt/cinforme/getFabricante",
            dataType: "JSON",
            async: true,
            data: params,
            success:function(result){
                $("#cboFabricanteReg01").html(result);  
            },
            error: function(){
                alert('Error, no se puede cargar la lista desplegable de establecimiento');
            }
        });
    }else if(v_RegEstu == 3){
        $('#01Registro').hide();
        $('#02Registro').hide();
        $('#03Registro').show();
        $('#04Registro').hide();
        $('#05Registro').hide();
        $('#06Registro').hide();
        $('#07Registro').hide();
        $('#08Registro').hide();
        $('#09Registro').hide();
        $('#10Registro').hide();
        $('#11Registro').hide();
        $('#12Registro').hide();
        $('#13Registro').hide();
        $('#14Registro').hide();

        $('#divphmp').hide();
        $('#divphpf').hide();
        $('#divparticula').hide();
        $('#divliquido').hide();

        $('#cboDimenReg03').val('').trigger("change");
        $('#cbollevapartReg03').val('').trigger("change");

        var params = { 
            "idptregestudio":v_RegEstu 
        };

        $.ajax({
            type: 'ajax',
            method: 'post',
            url: baseurl+"pt/cinforme/getTipoproducto",
            dataType: "JSON",
            async: true,
            data: params,
            success:function(result)
            {
                $("#cboTipoprodReg03").html(result);  
            },
            error: function(){
                alert('Error, no se puede cargar la lista desplegable de establecimiento');
            }
        });
        $.ajax({
            type: 'ajax',
            method: 'post',
            url: baseurl+"pt/cinforme/getParticulas",
            dataType: "JSON",
            async: true,
            data: params,
            success:function(result)
            {
                $("#cboParticulasReg03").html(result);  
            },
            error: function(){
                alert('Error, no se puede cargar la lista desplegable de establecimiento');
            }
        });
        $.ajax({
            type: 'ajax',
            method: 'post',
            url: baseurl+"pt/cinforme/getLiquidogob",
            dataType: "JSON",
            async: true,
            data: params,
            success:function(result)
            {
                $("#txtLiqgobReg03").html(result);  
            },
            error: function(){
                alert('Error, no se puede cargar la lista desplegable de establecimiento');
            }
        });
        $.ajax({
            type: 'ajax',
            method: 'post',
            url: baseurl+"pt/cinforme/getEnvases",
            dataType: "JSON",
            async: true,
            data: params,
            success:function(result)
            {
                $("#cboEnvaseReg03").html(result);  
            },
            error: function(){
                alert('Error, no se puede cargar la lista desplegable de establecimiento');
            }
        });
        var v_RegEstuEquipo = 2;
        var paramsEquipo = { 
            "idptregestudio":v_RegEstuEquipo 
        };
        $.ajax({
            type: 'ajax',
            method: 'post',
            url: baseurl+"pt/cinforme/getTipoequipo",
            dataType: "JSON",
            async: true,
            data: paramsEquipo,
            success:function(result)
            {
                $("#cboTipoequipoReg02").html(result);  
            },
            error: function(){
                alert('Error, no se puede cargar la lista desplegable de establecimiento');
            }
        });
        $.ajax({
            type: 'ajax',
            method: 'post',
            url: baseurl+"pt/cinforme/getMediocalen",
            dataType: "JSON",
            async: true,
            data: paramsEquipo,
            success:function(result)
            {
                $("#cboMediocalientaReg02").html(result);  
            },
            error: function(){
                alert('Error, no se puede cargar la lista desplegable de establecimiento');
            }
        });
        $.ajax({
            type: 'ajax',
            method: 'post',
            url: baseurl+"pt/cinforme/getFabricante",
            dataType: "JSON",
            async: true,
            data: paramsEquipo,
            success:function(result)
            {
                $("#cboFabricanteReg02").html(result);  
            },
            error: function(){
                alert('Error, no se puede cargar la lista desplegable de establecimiento');
            }
        });
    }else if(v_RegEstu == 6){
        $('#01Registro').hide();
        $('#02Registro').hide();
        $('#03Registro').hide();
        $('#04Registro').hide();
        $('#05Registro').hide();
        $('#06Registro').show();
        $('#07Registro').hide();
        $('#08Registro').hide();
        $('#09Registro').hide();
        $('#10Registro').hide();
        $('#11Registro').hide();
        $('#12Registro').hide();
        $('#13Registro').hide();
        $('#14Registro').hide();

        $('#divphmp06').hide();
        $('#divphpf06').hide();
        $('#divparticula06').hide();

        $('#CreaReg04').hide();
        $('#CreaReg05').hide();
        
        var params = { 
            "idptregestudio":v_RegEstu 
        };

        $.ajax({
            type: 'ajax',
            method: 'post',
            url: baseurl+"pt/cinforme/getTipoproducto",
            dataType: "JSON",
            async: true,
            data: params,
            success:function(result)
            {
            $("#cboTipoprodReg06").html(result);  
            },
            error: function(){
            alert('Error, no se puede cargar la lista desplegable de establecimiento');
            }
        });
        $.ajax({
            type: 'ajax',
            method: 'post',
            url: baseurl+"pt/cinforme/getParticulas",
            dataType: "JSON",
            async: true,
            data: params,
            success:function(result)
            {
            $("#cboParticulasReg06").html(result);  
            },
            error: function(){
            alert('Error, no se puede cargar la lista desplegable de establecimiento');
            }
        });
    }else if(v_RegEstu == 8){
        $('#01Registro').hide();
        $('#02Registro').hide();
        $('#03Registro').hide();
        $('#04Registro').hide();
        $('#05Registro').hide();
        $('#06Registro').hide();
        $('#07Registro').hide();
        $('#08Registro').show();
        $('#09Registro').hide();
        $('#10Registro').hide();
        $('#11Registro').hide();
        $('#12Registro').hide();
        $('#13Registro').hide();
        $('#14Registro').hide();

        $('#divphmp08').hide();
        $('#divphpf08').hide();
        $('#divparticula08').hide();

        $('#CreaReg07').hide();

        var params = { 
            "idptregestudio":v_RegEstu 
        };

        $.ajax({
            type: 'ajax',
            method: 'post',
            url: baseurl+"pt/cinforme/getTipoproducto",
            dataType: "JSON",
            async: true,
            data: params,
            success:function(result){
                $("#cboTipoprodReg08").html(result);  
            },
            error: function(){
                alert('Error, no se puede cargar la lista desplegable de establecimiento');
            }
        });
        $.ajax({
            type: 'ajax',
            method: 'post',
            url: baseurl+"pt/cinforme/getParticulas",
            dataType: "JSON",
            async: true,
            data: params,
            success:function(result){
                $("#cboParticulasReg08").html(result);  
            },
            error: function(){
                alert('Error, no se puede cargar la lista desplegable de establecimiento');
            }
        });
        $.ajax({
            type: 'ajax',
            method: 'post',
            url: baseurl+"pt/cinforme/getEnvases",
            dataType: "JSON",
            async: true,
            data: params,
            success:function(result){
                $("#cboEnvaseReg08").html(result);  
            },
            error: function(){
                alert('Error, no se puede cargar la lista desplegable de establecimiento');
            }
        });
    }else if(v_RegEstu == 9){
        $('#01Registro').hide();
        $('#02Registro').hide();
        $('#03Registro').hide();
        $('#04Registro').hide();
        $('#05Registro').hide();
        $('#06Registro').hide();
        $('#07Registro').hide();
        $('#08Registro').hide();
        $('#09Registro').show();
        $('#10Registro').hide();
        $('#11Registro').hide();
        $('#12Registro').hide();
        $('#13Registro').hide();
        $('#14Registro').hide();

        $('#divEvalrec').hide();

        var params = { 
            "idptregestudio":v_RegEstu 
        };

        $.ajax({
            type: 'ajax',
            method: 'post',
            url: baseurl+"pt/cinforme/getTiporecinto",
            dataType: "JSON",
            async: true,
            data: params,
            success:function(result)
            {
                $("#cboTiporecintoReg09").html(result);  
            },
            error: function(){
                alert('Error, no se puede cargar la lista desplegable de tipo recinto');
            }
        });
    }else if(v_RegEstu == 10){
        $('#01Registro').hide();
        $('#02Registro').hide();
        $('#03Registro').hide();
        $('#04Registro').hide();
        $('#05Registro').hide();
        $('#06Registro').hide();
        $('#07Registro').hide();
        $('#08Registro').hide();
        $('#09Registro').hide();
        $('#10Registro').show();
        $('#11Registro').hide();
        $('#12Registro').hide();
        $('#13Registro').hide();
        $('#14Registro').hide();


        var params = { 
            "idptregestudio":v_RegEstu 
        };
        
        $.ajax({
            type: 'ajax',
            method: 'post',
            url: baseurl+"pt/cinforme/getParticulas",
            dataType: "JSON",
            async: true,
            data: params,
            success:function(result)
            {
                $("#cboFormaprodReg10").html(result);  
            },
            error: function(){
                alert('Error, no se puede cargar la lista desplegable de forma de producto');
            }
        });
        $.ajax({
            type: 'ajax',
            method: 'post',
            url: baseurl+"pt/cinforme/getEnvases",
            dataType: "JSON",
            async: true,
            data: params,
            success:function(result)
            {
                $("#cboEnvaseReg10").html(result);  
            },
            error: function(){
                alert('Error, no se puede cargar la lista desplegable de establecimiento');
            }
        });
    }else if(v_RegEstu == 11){
        $('#01Registro').hide();
        $('#02Registro').hide();
        $('#03Registro').hide();
        $('#04Registro').hide();
        $('#05Registro').hide();
        $('#06Registro').hide();
        $('#07Registro').hide();
        $('#08Registro').hide();
        $('#09Registro').hide();
        $('#10Registro').hide();
        $('#11Registro').show();
        $('#12Registro').hide();
        $('#13Registro').hide();
        $('#14Registro').hide();


        var params = { 
            "idptregestudio":v_RegEstu 
        };
        
        $.ajax({
            type: 'ajax',
            method: 'post',
            url: baseurl+"pt/cinforme/getParticulas",
            dataType: "JSON",
            async: true,
            data: params,
            success:function(result)
            {
                $("#cboFormaprodReg11").html(result);  
            },
            error: function(){
                alert('Error, no se puede cargar la lista desplegable de forma de producto');
            }
        });
        $.ajax({
            type: 'ajax',
            method: 'post',
            url: baseurl+"pt/cinforme/getEnvases",
            dataType: "JSON",
            async: true,
            data: params,
            success:function(result)
            {
                $("#cboEnvaseReg11").html(result);  
            },
            error: function(){
                alert('Error, no se puede cargar la lista desplegable de establecimiento');
            }
        });
    }else if(v_RegEstu == 12){
        $('#01Registro').hide();
        $('#02Registro').hide();
        $('#03Registro').hide();
        $('#04Registro').hide();
        $('#05Registro').hide();
        $('#06Registro').hide();
        $('#07Registro').hide();
        $('#08Registro').hide();
        $('#09Registro').hide();
        $('#10Registro').hide();
        $('#11Registro').hide();
        $('#12Registro').show();
        $('#13Registro').hide();
        $('#14Registro').hide();

        
        var params = { 
            "idptregestudio":v_RegEstu 
        };


        $.ajax({
            type: 'ajax',
            method: 'post',
            url: baseurl+"pt/cinforme/getTiporecinto",
            dataType: "JSON",
            async: true,
            data: params,
            success:function(result)
            {
                $("#cboRecintoReg12").html(result);  
            },
            error: function(){
                alert('Error, no se puede cargar la lista desplegable de tipo recinto');
            }
        });
        $.ajax({
            type: 'ajax',
            method: 'post',
            url: baseurl+"pt/cinforme/getMediocalen",
            dataType: "JSON",
            async: true,
            data: params,
            success:function(result){
                $("#cboMediocalReg12").html(result);  
            },
            error: function(){
                alert('Error, no se puede cargar la lista desplegable de establecimiento');
            }
        });        
        $.ajax({
            type: 'ajax',
            method: 'post',
            url: baseurl+"pt/cinforme/getParticulas",
            dataType: "JSON",
            async: true,
            data: params,
            success:function(result)
            {
                $("#cboPresentaReg12").html(result);  
            },
            error: function(){
                alert('Error, no se puede cargar la lista desplegable de forma de producto');
            }
        });
    }else if(v_RegEstu == 13){
        $('#01Registro').hide();
        $('#02Registro').hide();
        $('#03Registro').hide();
        $('#04Registro').hide();
        $('#05Registro').hide();
        $('#06Registro').hide();
        $('#07Registro').hide();
        $('#08Registro').hide();
        $('#09Registro').hide();
        $('#10Registro').hide();
        $('#11Registro').hide();
        $('#12Registro').hide();
        $('#13Registro').show();
        $('#14Registro').hide();

                
        var params = { 
            "idptregestudio":v_RegEstu 
        };

        $.ajax({
            type: 'ajax',
            method: 'post',
            url: baseurl+"pt/cinforme/getTipoequipo",
            dataType: "JSON",
            async: true,
            data: params,
            success:function(result)
            {
                $("#cboTipoequipoReg13").html(result);  
            },
            error: function(){
                alert('Error, no se puede cargar la lista desplegable de establecimiento');
            }
        });
        $.ajax({
            type: 'ajax',
            method: 'post',
            url: baseurl+"pt/cinforme/getFabricante",
            dataType: "JSON",
            async: true,
            data: params,
            success:function(result)
            {
                $("#cboFabricanteReg13").html(result);  
            },
            error: function(){
                alert('Error, no se puede cargar la lista desplegable de establecimiento');
            }
        });
        $.ajax({
            type: 'ajax',
            method: 'post',
            url: baseurl+"pt/cinforme/getMediocalen",
            dataType: "JSON",
            async: true,
            data: params,
            success:function(result){
                $("#cboMediocalReg13").html(result);  
            },
            error: function(){
                alert('Error, no se puede cargar la lista desplegable de establecimiento');
            }
        });         
        $.ajax({
            type: 'ajax',
            method: 'post',
            url: baseurl+"pt/cinforme/getParticulas",
            dataType: "JSON",
            async: true,
            data: params,
            success:function(result)
            {
                $("#cboPresentaReg13").html(result);  
            },
            error: function(){
                alert('Error, no se puede cargar la lista desplegable de forma de producto');
            }
        });
    }else if(v_RegEstu == 14){
        $('#01Registro').hide();
        $('#02Registro').hide();
        $('#03Registro').hide();
        $('#04Registro').hide();
        $('#05Registro').hide();
        $('#06Registro').hide();
        $('#07Registro').hide();
        $('#08Registro').hide();
        $('#09Registro').hide();
        $('#10Registro').hide();
        $('#11Registro').hide();
        $('#12Registro').hide();
        $('#13Registro').hide();
        $('#14Registro').show();


        $('#divphmp14').hide();
        $('#divphpf14').hide();
        $('#divparticula14').hide();
        $('#divliquido14').hide();

        $('#cboDimenReg14').val('').trigger("change");
        $('#cbollevapartReg14').val('').trigger("change");

        var params = { 
            "idptregestudio":v_RegEstu 
        };

        $.ajax({
            type: 'ajax',
            method: 'post',
            url: baseurl+"pt/cinforme/getTipoproducto",
            dataType: "JSON",
            async: true,
            data: params,
            success:function(result)
            {
                $("#cboTipoprodReg14").html(result);  
            },
            error: function(){
                alert('Error, no se puede cargar la lista desplegable de establecimiento');
            }
        });
        $.ajax({
            type: 'ajax',
            method: 'post',
            url: baseurl+"pt/cinforme/getParticulas",
            dataType: "JSON",
            async: true,
            data: params,
            success:function(result)
            {
                $("#cboParticulasReg14").html(result);  
            },
            error: function(){
                alert('Error, no se puede cargar la lista desplegable de establecimiento');
            }
        });
        $.ajax({
            type: 'ajax',
            method: 'post',
            url: baseurl+"pt/cinforme/getLiquidogob",
            dataType: "JSON",
            async: true,
            data: params,
            success:function(result)
            {
                $("#txtLiqgobReg14").html(result);  
            },
            error: function(){
                alert('Error, no se puede cargar la lista desplegable de establecimiento');
            }
        });
        $.ajax({
            type: 'ajax',
            method: 'post',
            url: baseurl+"pt/cinforme/getEnvases",
            dataType: "JSON",
            async: true,
            data: params,
            success:function(result)
            {
                $("#cboEnvaseReg14").html(result);  
            },
            error: function(){
                alert('Error, no se puede cargar la lista desplegable de establecimiento');
            }
        });
        $.ajax({
            type: 'ajax',
            method: 'post',
            url: baseurl+"pt/cinforme/getTipoequipo",
            dataType: "JSON",
            async: true,
            data: params,
            success:function(result){
                $("#cboTipoequipoReg14").html(result);  
            },
            error: function(){
                alert('Error, no se puede cargar la lista desplegable de establecimiento');
            }
        });
        $.ajax({
            type: 'ajax',
            method: 'post',
            url: baseurl+"pt/cinforme/getMediocalen",
            dataType: "JSON",
            async: true,
            data: params,
            success:function(result){
                $("#cboMediocalientaReg14").html(result);  
            },
            error: function(){
                alert('Error, no se puede cargar la lista desplegable de establecimiento');
            }
        });
        $.ajax({
            type: 'ajax',
            method: 'post',
            url: baseurl+"pt/cinforme/getFabricante",
            dataType: "JSON",
            async: true,
            data: params,
            success:function(result){
                $("#cboFabricanteReg14").html(result);  
            },
            error: function(){
                alert('Error, no se puede cargar la lista desplegable de establecimiento');
            }
        });
    }else if(v_RegEstu == ''){
        $('#01Registro').hide();
        $('#02Registro').hide();
        $('#03Registro').hide();
        $('#04Registro').hide();
        $('#05Registro').hide();
        $('#06Registro').hide();
        $('#07Registro').hide();
        $('#08Registro').hide();        
        $('#09Registro').hide();
        $('#10Registro').hide();
        $('#11Registro').hide();
        $('#12Registro').hide();
        $('#13Registro').hide();
        $('#14Registro').hide();
    }
}

// EVENTO POR ESTUDIOS
/* Reg03 */
    $("#cboTipoprodReg03").change(function(){
        var v_Tipoprod = $('#cboTipoprodReg03').val();
        verDetTipoproducto03(v_Tipoprod);
    });
    verDetTipoproducto03=function(v_Tipoprod){
        
        if(v_Tipoprod != '2' && v_Tipoprod != ''){
            $('#divphmp').show();
            $('#divphpf').show();
        }else{
            $('#divphmp').hide();
            $('#divphpf').hide();
        }
    };

    $("#cbollevapartReg03").change(function(){
        var v_Llevapart = $('#cbollevapartReg03').val();
        verDetLlevaparticulas03(v_Llevapart);
    });
    verDetLlevaparticulas03=function(v_Llevapart){
        
        if(v_Llevapart == 'S'){
            $('#divparticula').show();
            $('#divliquido').show();
        }else{
            $('#divparticula').hide();
            $('#divliquido').hide();
        }
    };
/* fin Reg03 */

/* Reg06 */
    $("#cboTipoprodReg06").change(function(){
        var v_Tipoprod = $('#cboTipoprodReg06').val();
        verDetTipoproducto06(v_Tipoprod);
    });
    verDetTipoproducto06=function(v_Tipoprod){
        if(v_Tipoprod != '7' && v_Tipoprod != ''){
            $('#divphmp06').show();
            $('#divphpf06').show();
        }else{
            $('#divphmp06').hide();
            $('#divphpf06').hide();
        }
    };

    $("#cbollevapartReg06").change(function(){
        var v_Llevapart = $('#cbollevapartReg06').val();
        verDetLlevaparticulas06(v_Llevapart);
    });
    verDetLlevaparticulas06=function(v_Llevapart){
        
        if(v_Llevapart == 'S'){
            $('#divparticula06').show();
        }else{
            $('#divparticula06').hide();
        }
    };

    recuperaListReg06equipo = function(Idregprod){
        otblListReg06equipo = $('#tblListReg06equipo').DataTable({
            'bJQueryUI'     : true, 
            'scrollY'     	: '200px',
            'scrollX'     	: true, 
            'paging'      	: false,
            'processing'  	: true,      
            'bDestroy'    	: true,
            'info'        	: true,
            'filter'      	: false, 
            'stateSave'     : true,
            "ordering"		: false, 
            'ajax'	: {
                "url"   : baseurl+"pt/cinforme/getlistequipoxprod/",
                "type"  : "POST", 
                "data": function ( d ) {
                    d.Idregprod  = Idregprod; 
                },     
                dataSrc : ''        
            },
            'columns'	: [
                {"orderable": false, data: 'claseequipo', targets: 0},
                {"orderable": false, data: 'descripcion_equipo', targets: 1},
                {"orderable": false, data: 'tipoequipo', targets: 2},
                {"orderable": false, 
                render:function(data, type, row){                
                    return  '<div>'+    
                        ' <a onClick="javascript:selEquipoadj06(\''+row.idptregequipo+'\',\''+row.idptregistro+'\',\''+row.idptregproducto+'\',\''+row.tipo_estudio+'\',\''+row.descripcion_equipo+'\',\''+row.id_tipoequipo+'\',\''+row.id_equipofabricante+'\',\''+row.dimension+'\',\''+row.diametro+'\',\''+row.altura+'\',\''+row.grosor+'\',\''+row.volumen_llenado+'\',\''+row.modelo_equipo+'\',\''+row.identificacion+'\',\''+row.nro_equipos+'\');"><i class="fas fa-edit" style="color:#088A08; cursor:pointer;"> </i> </a>'+
                    '</div>'
                }
                }
            ]
        }); 
        // Enumeracion 
        otblListRegitro.on( 'order.dt search.dt', function () { 
            otblListRegitro.column(0, {search:'applied', order:'applied'}).nodes().each( function (cell, i) {
            cell.innerHTML = i+1;
            } );
        }).draw(); 
    };

    selEquipoadj06= function(idptregequipo,idptregistro,idptregproducto,tipo_estudio,descripcion_equipo,id_tipoequipo,id_equipofabricante,dimension,diametro,altura,grosor,volumen_llenado,modelo_equipo,identificacion,nro_equipos){
        
        if(tipo_estudio == 'T'){
            $('#CreaReg04').show();
            $('#CreaReg05').hide();  
            
            $('#mhdnIdptreg04').val(idptregistro);
            $('#mhdnIdptregprod04').val(idptregproducto);
            $('#mhdnIdptregequipo04').val(idptregequipo);
            $('#txtDescriequipoReg04').val(descripcion_equipo);
            
            var v_RegEstu = 4;
            var params = { 
                "idptregestudio":v_RegEstu 
            };
            $.ajax({
                type: 'ajax',
                method: 'post',
                url: baseurl+"pt/cinforme/getTipoequipo",
                dataType: "JSON",
                async: true,
                data: params,
                success:function(result)
                {
                    $("#cboTipoequipoReg04").html(result); 
                    $('#cboTipoequipoReg04').val(id_tipoequipo).trigger("change"); 
                },
                error: function(){
                    alert('Error, no se puede cargar la lista desplegable de establecimiento');
                }
            });
            $.ajax({
                type: 'ajax',
                method: 'post',
                url: baseurl+"pt/cinforme/getFabricante",
                dataType: "JSON",
                async: true,
                data: params,
                success:function(result)
                {
                    $("#cboFabricanteReg04").html(result);
                    $('#cboFabricanteReg04').val(id_equipofabricante).trigger("change");   
                },
                error: function(){
                    alert('Error, no se puede cargar la lista desplegable de establecimiento');
                }
            });
            
            $('#mhdnRegAdjunto').val('4');
            $('#mhdnAccionReg04').val('A');

        }else if(tipo_estudio == 'L'){
            $('#CreaReg04').hide();
            $('#CreaReg05').show(); 
            
            $('#mhdnIdptreg05').val(idptregistro);
            $('#mhdnIdptregprod05').val(idptregproducto);
            $('#mhdnIdptregequipo05').val(idptregequipo);
            $('#txtDescriequipoReg05').val(descripcion_equipo);
            
            var v_RegEstu = 5;
            var params = { 
                "idptregestudio":v_RegEstu 
            };
            $.ajax({
                type: 'ajax',
                method: 'post',
                url: baseurl+"pt/cinforme/getTipoequipo",
                dataType: "JSON",
                async: true,
                data: params,
                success:function(result)
                {
                    $("#cboTipoequipoReg05").html(result); 
                    $('#cboTipoequipoReg05').val(id_tipoequipo).trigger("change"); 
                },
                error: function(){
                    alert('Error, no se puede cargar la lista desplegable de establecimiento');
                }
            });
            $.ajax({
                type: 'ajax',
                method: 'post',
                url: baseurl+"pt/cinforme/getFabricante",
                dataType: "JSON",
                async: true,
                data: params,
                success:function(result)
                {
                    $("#cboFabricanteReg05").html(result);
                    $('#cboFabricanteReg05').val(id_equipofabricante).trigger("change");   
                },
                error: function(){
                    alert('Error, no se puede cargar la lista desplegable de establecimiento');
                }
            });

            $('#txtModellenaReg05').val(modelo_equipo);
            $('#txtIdllenaReg05').val(identificacion);
            $('#txtNrollenaReg05').val(nro_equipos);
            $('#txtVolullenaReg05').val(volumen_llenado);
            $('#cboDimenReg05').val(dimension).trigger("change");  
            $('#txtDiamReg05').val(diametro);
            $('#txtAltuReg05').val(altura);
            $('#txtGrosReg05').val(grosor);
            
            $('#mhdnRegAdjunto').val('5');
            $('#mhdnAccionReg05').val('A');

        }
    };

    $('#Buscaequipo06').click(function(){
        $('#modalBuscaequipoReg06').modal('show');
    });

    $('#addequipo06').click(function(){  
        $('#CreaReg04').show();
        $('#CreaReg05').hide();  

        $('#frmCreaReg04').trigger("reset");

        $('#mhdnIdptreg04').val($('#hdnIdptreg').val());
        $('#mhdnIdptregprod04').val($('#hdnIdregproducto').val());
        $('#mhdnIdptregequipo04').val();
        $('#txtDescriequipoReg04').val('');
        $('#mhdnRegAdjunto').val('4');
        
        $('#mhdnAccionReg04').val('N');
        var v_RegEstu = 4;
        var params = { 
            "idptregestudio":v_RegEstu 
        };
        $.ajax({
            type: 'ajax',
            method: 'post',
            url: baseurl+"pt/cinforme/getTipoequipo",
            dataType: "JSON",
            async: true,
            data: params,
            success:function(result)
            {
                $("#cboTipoequipoReg04").html(result);  
            },
            error: function(){
                alert('Error, no se puede cargar la lista desplegable de establecimiento');
            }
        });
        $.ajax({
            type: 'ajax',
            method: 'post',
            url: baseurl+"pt/cinforme/getFabricante",
            dataType: "JSON",
            async: true,
            data: params,
            success:function(result)
            {
                $("#cboFabricanteReg04").html(result);  
            },
            error: function(){
                alert('Error, no se puede cargar la lista desplegable de establecimiento');
            }
        });
    });

    $('#addllenadora06').click(function(){ 
        $('#CreaReg04').hide();
        $('#CreaReg05').show(); 

        $('#frmCreaReg05').trigger("reset");  

        $('#mhdnIdptreg05').val($('#hdnIdptreg').val());
        $('#mhdnIdptregprod05').val($('#hdnIdregproducto').val());
        $('#mhdnIdptregequipo05').val();
        $('#mhdnRegAdjunto').val('5');
        
        $('#mhdnAccionReg05').val('N');

        var v_RegEstu = 5;
        var params = { 
            "idptregestudio":v_RegEstu 
        };
        $.ajax({
            type: 'ajax',
            method: 'post',
            url: baseurl+"pt/cinforme/getTipoequipo",
            dataType: "JSON",
            async: true,
            data: params,
            success:function(result)
            {
                $("#cboTipoequipoReg05").html(result);  
            },
            error: function(){
                alert('Error, no se puede cargar la lista desplegable de establecimiento');
            }
        });
        $.ajax({
            type: 'ajax',
            method: 'post',
            url: baseurl+"pt/cinforme/getFabricante",
            dataType: "JSON",
            async: true,
            data: params,
            success:function(result)
            {
                $("#cboFabricanteReg05").html(result);  
            },
            error: function(){
                alert('Error, no se puede cargar la lista desplegable de establecimiento');
            }
        });
    });

    $('#btnCancelarReg04').click(function(){
        $('#CreaReg04').hide();
    });

    $('#btnCancelarReg05').click(function(){
        $('#CreaReg05').hide();
    });

    $('#btnGrabarReg04').click(function(){

        var params = { 
            "mhdnRegAdjunto"        : $('#mhdnRegAdjunto').val(),
            "idptregequipo"         : $('#mhdnIdptregequipo04').val(), 
            "idptregistro"          : $('#mhdnIdptreg04').val(), 
            "idptregproducto"       : $('#mhdnIdptregprod04').val(), 
            "clase_registro"        : 'T', 
            "descripcion_equipo"    : $('#txtDescriequipoReg04').val(), 
            "id_tipoequipo"         : $('#cboTipoequipoReg04').val(), 
            "id_equipofabricante"   : $('#cboFabricanteReg04').val(), 
            "cserviaccionio"        : $('#mhdnAccionReg04').val(),
        };

        $.ajax({
            type: 'ajax',
            method: 'post',
            url: baseurl+"pt/cinforme/setregistroAdjunto",
            dataType: "JSON",
            async: true,
            data: params,
            success:function(result)
            {
                otblListReg06equipo.ajax.reload(null,false);
                Vtitle = 'Se guardo Correctamente';
                Vtype = 'success';
                sweetalert(Vtitle,Vtype);
            },
            error: function(){
                alert('Error, no se puede cargar la lista desplegable de establecimiento');
            }
        });
    });

    $('#btnGrabarReg05').click(function(){

        var params = { 
            "mhdnRegAdjunto"        : $('#mhdnRegAdjunto').val(),
            "idptregequipo"         : $('#mhdnIdptregequipo05').val(), 
            "idptregistro"          : $('#mhdnIdptreg05').val(), 
            "idptregproducto"       : $('#mhdnIdptregprod05').val(), 
            "clase_registro"        : 'L', 
            "descripcion_equipo"    : $('#txtDescriequipoReg05').val(), 
            "id_tipoequipo"         : $('#cboTipoequipoReg05').val(),  
            "id_equipofabricante"   : $('#cboFabricanteReg05').val(), 
            "modelo_equipo"         : $('#txtModellenaReg05').val(),  
            "identificacion"        : $('#txtIdllenaReg05').val(), 
            "nro_equipos"           : $('#txtNrollenaReg05').val(), 
            "volumen_llenado"       : $('#txtVolullenaReg05').val(), 
            "dimension"             : $('#cboDimenReg05').val(), 
            "diametro"              : $('#txtDiamReg05').val(), 
            "altura"                : $('#txtAltuReg05').val(), 
            "grosor"                : $('#txtGrosReg05').val(), 
            "cserviaccionio"        : $('#mhdnAccionReg05').val(),
        };

        $.ajax({
            type: 'ajax',
            method: 'post',
            url: baseurl+"pt/cinforme/setregistroAdjunto",
            dataType: "JSON",
            async: true,
            data: params,
            success:function(result)
            {            
                otblListReg06equipo.ajax.reload(null,false);
                Vtitle = 'Se guardo Correctamente';
                Vtype = 'success';
                sweetalert(Vtitle,Vtype);
            },
            error: function(){
            alert('Error, no se puede cargar la lista desplegable de establecimiento');
            }
        });
    });
/* fin Reg06 */

/* Reg08 */
    $("#cboTipoprodReg08").change(function(){
        var v_Tipoprod = $('#cboTipoprodReg08').val();
        verDetTipoproducto08(v_Tipoprod);
    });
    verDetTipoproducto08=function(v_Tipoprod){
        
        if(v_Tipoprod != '2' && v_Tipoprod != ''){
            $('#divphmp08').show();
            $('#divphpf08').show();
        }else{
            $('#divphmp08').hide();
            $('#divphpf08').hide();
        }
    };

    $("#cbollevapartReg08").change(function(){
        var v_Llevapart = $('#cbollevapartReg08').val();
        verDetLlevaparticulas08(v_Llevapart);
    });
    verDetLlevaparticulas08=function(v_Llevapart){
        
        if(v_Llevapart == 'S'){
            $('#divparticula08').show();
        }else{
            $('#divparticula08').hide();
        }
    };

    recuperaListReg08equipo = function(Idregprod){
        otblListReg08equipo = $('#tblListReg08equipo').DataTable({
            'bJQueryUI'     : true, 
            'scrollY'     	: '200px',
            'scrollX'     	: true, 
            'paging'      	: false,
            'processing'  	: true,      
            'bDestroy'    	: true,
            'info'        	: true,
            'filter'      	: false, 
            'stateSave'     : true,
            "ordering"		: false, 
            'ajax'	: {
                "url"   : baseurl+"pt/cinforme/getlistequipoxprod/",
                "type"  : "POST", 
                "data": function ( d ) {
                    d.Idregprod  = Idregprod; 
                },     
                dataSrc : ''        
            },
            'columns'	: [
                {"orderable": false, data: 'claseequipo', targets: 0},
                {"orderable": false, data: 'descripcion_equipo', targets: 1},
                {"orderable": false, data: 'tipoequipo', targets: 2},
                {"orderable": false, 
                render:function(data, type, row){                
                    return  '<div>'+    
                    ' <a onClick="javascript:selEquipoadj08(\''+row.idptregequipo+'\',\''+row.idptregistro+'\',\''+row.idptregproducto+'\',\''+row.tipo_estudio+'\',\''+row.descripcion_equipo+'\',\''+row.id_tipoequipo+'\',\''+row.id_equipofabricante+'\');"><i class="fas fa-edit" style="color:#088A08; cursor:pointer;"> </i> </a>'+
                    '</div>'
                }
                }
            ]
        }); 
        // Enumeracion 
        otblListRegitro.on( 'order.dt search.dt', function () { 
            otblListRegitro.column(0, {search:'applied', order:'applied'}).nodes().each( function (cell, i) {
            cell.innerHTML = i+1;
            } );
        }).draw(); 
    };

    selEquipoadj08= function(idptregequipo,idptregistro,idptregproducto,tipo_estudio,descripcion_equipo,id_tipoequipo,id_equipofabricante){

        $('#CreaReg07').show();
        
        $('#mhdnIdptreg07').val(idptregistro);
        $('#mhdnIdptregprod07').val(idptregproducto);
        $('#mhdnIdptregequipo07').val(idptregequipo);
        $('#txtDescriequipoReg07').val(descripcion_equipo);
        
        var v_RegEstu = 7;
        var params = { 
            "idptregestudio":v_RegEstu 
        };
        $.ajax({
            type: 'ajax',
            method: 'post',
            url: baseurl+"pt/cinforme/getTipoequipo",
            dataType: "JSON",
            async: true,
            data: params,
            success:function(result)
            {
                $("#cboTipoequipoReg07").html(result); 
                $('#cboTipoequipoReg07').val(id_tipoequipo).trigger("change"); 
            },
            error: function(){
                alert('Error, no se puede cargar la lista desplegable de establecimiento');
            }
        });
        $.ajax({
            type: 'ajax',
            method: 'post',
            url: baseurl+"pt/cinforme/getFabricante",
            dataType: "JSON",
            async: true,
            data: params,
            success:function(result)
            {
                $("#cboFabricanteReg07").html(result);
                $('#cboFabricanteReg07').val(id_equipofabricante).trigger("change");   
            },
            error: function(){
                alert('Error, no se puede cargar la lista desplegable de establecimiento');
            }
        });
        
        $('#mhdnRegAdjunto').val('7');
        $('#mhdnAccionReg07').val('A');
    }

    $('#Buscaequipo08').click(function(){
        $('#modalBuscaequipoReg08').modal('show');
    });

    $('#addequipo08').click(function(){  
        $('#CreaReg07').show();  

        $('#frmCreaReg07').trigger("reset");

        $('#mhdnIdptreg07').val($('#hdnIdptreg').val());
        $('#mhdnIdptregprod07').val($('#hdnIdregproducto').val());
        $('#mhdnIdptregequipo07').val();
        $('#txtDescriequipoReg07').val('');
        $('#mhdnRegAdjunto').val('7');
        
        $('#mhdnAccionReg07').val('N');
        var v_RegEstu = 7;
        var params = { 
            "idptregestudio":v_RegEstu 
        };
        $.ajax({
            type: 'ajax',
            method: 'post',
            url: baseurl+"pt/cinforme/getTipoequipo",
            dataType: "JSON",
            async: true,
            data: params,
            success:function(result)
            {
                $("#cboTipoequipoReg07").html(result);  
            },
            error: function(){
                alert('Error, no se puede cargar la lista desplegable de establecimiento');
            }
        });
        $.ajax({
            type: 'ajax',
            method: 'post',
            url: baseurl+"pt/cinforme/getFabricante",
            dataType: "JSON",
            async: true,
            data: params,
            success:function(result)
            {
                $("#cboFabricanteReg07").html(result);  
            },
            error: function(){
                alert('Error, no se puede cargar la lista desplegable de establecimiento');
            }
        });
    });

    $('#btnCancelarReg07').click(function(){
        $('#CreaReg07').hide();
    });

    $('#btnGrabarReg07').click(function(){

        var params = { 
            "mhdnRegAdjunto"        : $('#mhdnRegAdjunto').val(),
            "idptregequipo"         : $('#mhdnIdptregequipo07').val(), 
            "idptregistro"          : $('#mhdnIdptreg07').val(), 
            "idptregproducto"       : $('#mhdnIdptregprod07').val(), 
            "clase_registro"        : 'T', 
            "descripcion_equipo"    : $('#txtDescriequipoReg07').val(), 
            "id_tipoequipo"         : $('#cboTipoequipoReg07').val(), 
            "id_equipofabricante"   : $('#cboFabricanteReg07').val(), 
            "cserviaccionio"        : $('#mhdnAccionReg07').val(),
        };

        $.ajax({
            type: 'ajax',
            method: 'post',
            url: baseurl+"pt/cinforme/setregistroAdjunto",
            dataType: "JSON",
            async: true,
            data: params,
            success:function(result)
            {
                otblListReg08equipo.ajax.reload(null,false);
                Vtitle = 'Se guardo Correctamente';
                Vtype = 'success';
                sweetalert(Vtitle,Vtype);
            },
            error: function(){
                alert('Error, no se puede cargar la lista desplegable de establecimiento');
            }
        });
    });
/* fin Reg08 */

/* Reg09 */
    $("#cboTiporecintoReg09").change(function(){
        var v_Tiporeci = $('#cboTiporecintoReg09').val();
        verDetTiporecinto09(v_Tiporeci);
    });
    verDetTiporecinto09=function(v_Tiporeci){
        if(v_Tiporeci != '1' && v_Tiporeci != ''){
            $('#divEvalrec').hide();
        }else{
            $('#divEvalrec').show();
        }
    };
/* fin Reg09 */

/* Reg14 */
    $("#cboTipoprodReg14").change(function(){
        var v_Tipoprod = $('#cboTipoprodReg14').val();
        verDetTipoproducto14(v_Tipoprod);
    });
    verDetTipoproducto14=function(v_Tipoprod){
        if(v_Tipoprod != '12' && v_Tipoprod != ''){
            $('#divphmp14').show();
            $('#divphpf14').show();
        }else{
            $('#divphmp14').hide();
            $('#divphpf14').hide();
        }
    };

    $("#cbollevapartReg14").change(function(){
        var v_Llevapart = $('#cbollevapartReg14').val();
        verDetLlevaparticulas(v_Llevapart);
    });
    verDetLlevaparticulas=function(v_Llevapart){
        
        if(v_Llevapart == 'S'){
            $('#divparticula14').show();
            $('#divliquido14').show();
        }else{
            $('#divparticula14').hide();
            $('#divliquido14').hide();
        }
    };
/* fin Reg14 */

$('#frmMantRegistro').submit(function(event){
    event.preventDefault();
    
    var request = $.ajax({
        url:$('#frmMantRegistro').attr("action"),
        type:$('#frmMantRegistro').attr("method"),
        data:$('#frmMantRegistro').serialize(),
        error: function(){
          alert('Error, No se puede autenticar por error');
        }
    });
    request.done(function( respuesta ) { 
        var posts = JSON.parse(respuesta);           
        $.each(posts, function() { 
            var $idregistro = this.id_registro;
            $('#hdnIdptreg').val($idregistro); 
            
            $('#btnNuevoReg').show();
            $('#btnGrabarReg').hide();   

            Vtitle = 'Se Grabo Correctamente';
            Vtype = 'success';
            sweetalert(Vtitle,Vtype);

            var v_tipoestu = $('#hdnIdRegEstudio').val();
            if (v_tipoestu == 6){
                $('#regEquipos06').show();

                var $idregistroproducto = this.id_regproducto;
                $('#hdnIdregproducto').val($idregistroproducto);
                recuperaListReg06equipo($idregistroproducto);
            }else if (v_tipoestu == 8){
                $('#regEquipos08').show();

                var $idregistroproducto = this.id_regproducto;
                $('#hdnIdregproducto').val($idregistroproducto);
                recuperaListReg08equipo($idregistroproducto);
            }
            
            $('#hdnIdregequipo').val();
            $('#hdnIdregproducto').val(); 
            $('#hdnIdregrecinto').val();
            $('#hdnIdregprocestudio').val();
            otblListRegitro.ajax.reload(null,false);  
        });
    });
});

selRegistro= function(idptregistro,idptinforme,idptregequipo,idptregproducto,idptservicio,descripcion_serv,idptregestudio,descripcion_estudio,idptregrecinto,idptregprocestudio){
    
    $('#tabinforme a[href="#tabinforme-reg"]').tab('show'); 
    $('#hdnIdptreg').val(idptregistro);  
    $('#hdnAccionptreg').val('A');  
    $('#hdnIdreginfor').val(idptinforme);
    $('#hdnIdregequipo').val(idptregequipo);
    $('#hdnIdregproducto').val(idptregproducto); 
    $('#hdnIdregrecinto').val(idptregrecinto); 
    $('#hdnIdregprocestudio').val(idptregprocestudio);  
    
    $('#hdnIdregservi').val(idptservicio);
    $('#txtregservi').val(descripcion_serv);

    $('#txtRegEstudio').show();
    $('#divRegEstudio').hide();
    $('#btnGrabarReg').show();
  
    $('#txtRegEstudio').val(descripcion_estudio);
    $('#hdnIdRegEstudio').val(idptregestudio);

    if(idptregestudio == 6){
        $('#regEquipos06').show();
    }
    if(idptregestudio == 8){
        $('#regEquipos08').show();
    }
    
    
    recuperaRegistro(idptregestudio,idptregequipo,idptregproducto,idptregrecinto,idptregprocestudio);
};

recuperaRegistro = function(v_RegEstu,idptregequipo,idptregproducto,idptregrecinto,idptregprocestudio){
    
    if(v_RegEstu == 1){
        
        $('#01Registro').show();
        $('#02Registro').hide();
        $('#03Registro').hide();
        $('#04Registro').hide();
        $('#05Registro').hide();
        $('#06Registro').hide();
        $('#07Registro').hide();
        $('#08Registro').hide();
        $('#09Registro').hide();
        $('#10Registro').hide();
        $('#11Registro').hide();
        $('#12Registro').hide();
        $('#13Registro').hide();
        $('#14Registro').hide();

        var parametros = { 
            "idptregequipo":idptregequipo 
        };
        var request = $.ajax({
            type: 'ajax',
            method: 'post',
            url: baseurl+"pt/cinforme/getrecuperaregequi",
            dataType: "JSON",
            async: true,
            data: parametros,
            error: function(){
                alert('Error, no se puede cargar la lista desplegable de establecimiento');
            }
        });      
        request.done(function( respuesta ) {   
            $.each(respuesta, function() {
                var $idtipoequipo = this.id_tipoequipo;
                var $idmediocalienta = this.id_mediocalienta;
                var $idequipofabricante = this.id_equipofabricante;
                
                $('#txtDescriequipoReg01').val(this.descripcion_equipo);
                $('#txtNroequipoReg01').val(this.nro_equipos);
                $('#txtNracanastReg01').val(this.nro_canastillas);
                $('#txtIdenequipoReg01').val(this.identificacion);
                
                var params = { 
                    "idptregestudio":v_RegEstu 
                };
                $.ajax({
                    type: 'ajax',
                    method: 'post',
                    url: baseurl+"pt/cinforme/getTipoequipo",
                    dataType: "JSON",
                    async: true,
                    data: params,
                    success:function(result){
                        console.log($idtipoequipo);
                        $("#cboTipoequipoReg01").html(result);  
                        $('#cboTipoequipoReg01').val($idtipoequipo).trigger("change");
                    },
                    error: function(){
                        alert('Error, no se puede cargar la lista desplegable de establecimiento');
                    }
                });
                $.ajax({
                    type: 'ajax',
                    method: 'post',
                    url: baseurl+"pt/cinforme/getMediocalen",
                    dataType: "JSON",
                    async: true,
                    data: params,
                    success:function(result){
                        $("#cboMediocalientaReg01").html(result);  
                        $('#cboMediocalientaReg01').val($idmediocalienta).trigger("change");
                    },
                    error: function(){
                        alert('Error, no se puede cargar la lista desplegable de establecimiento');
                    }
                });
                $.ajax({
                    type: 'ajax',
                    method: 'post',
                    url: baseurl+"pt/cinforme/getFabricante",
                    dataType: "JSON",
                    async: true,
                    data: params,
                    success:function(result){
                        $("#cboFabricanteReg01").html(result);  
                        $('#cboFabricanteReg01').val($idequipofabricante).trigger("change");
                    },
                    error: function(){
                        alert('Error, no se puede cargar la lista desplegable de establecimiento');
                    }
                });
            });
        });

    }else if(v_RegEstu == 3){   
        $('#01Registro').hide();
        $('#02Registro').hide();
        $('#03Registro').show();
        $('#04Registro').hide();
        $('#05Registro').hide();
        $('#06Registro').hide();
        $('#07Registro').hide();
        $('#08Registro').hide();
        $('#09Registro').hide();
        $('#10Registro').hide();
        $('#11Registro').hide();
        $('#12Registro').hide();
        $('#13Registro').hide();
        $('#14Registro').hide();

        $('#divphmp').hide();
        $('#divphpf').hide();
        $('#divparticula').hide();
        $('#divliquido').hide();    
        
        var parametros = { 
            "idptregproducto":idptregproducto 
        };
        var request = $.ajax({
            type: 'ajax',
            method: 'post',
            url: baseurl+"pt/cinforme/getrecuperaregproducequi",
            dataType: "JSON",
            async: true,
            data: parametros,
            error: function(){
                alert('Error, no se puede cargar la lista desplegable de establecimiento');
            }
        });      
        request.done(function( respuesta ) {            
            $.each(respuesta, function() {  
                var $idtipoproducto = this.id_tipoproducto;
                var $idsiparticula = this.id_siparticula;
                var $idsiparticulaliquido = this.id_siparticula_liquido;
                var $idenvase = this.id_envase;
                var $idtipoequipo = this.id_tipoequipo;
                var $idmediocalienta = this.id_mediocalienta;
                var $idequipofabricante = this.id_equipofabricante;

                $('#txtNombprodReg03').val(this.nombre_producto);                
                $('#txtPHmatprimaReg03').val(this.ph_materia_prima);
                $('#txtPHprodfinReg03').val(this.ph_producto_final);
                $('#txtProcalReg03').val(this.nroprocal);
                $('#txtDiamReg03').val(this.diametro);
                $('#txtAltuReg03').val(this.altura);
                $('#txtGrosReg03').val(this.grosor);
                $('#txtDescriequipoReg02').val(this.descripcion_equipo);
                $('#txtIdenequipoReg02').val(this.identificacion);                

                $('#cbollevapartReg03').val(this.particulas).trigger("change");  
                $('#cboDimenReg03').val(this.dimension).trigger("change");

                var params = { 
                    "idptregestudio":v_RegEstu 
                };

                $.ajax({
                    type: 'ajax',
                    method: 'post',
                    url: baseurl+"pt/cinforme/getTipoproducto",
                    dataType: "JSON",
                    async: true,
                    data: params,
                    success:function(result){
                        $("#cboTipoprodReg03").html(result);  
                        $('#cboTipoprodReg03').val($idtipoproducto).trigger("change");
                    },
                    error: function(){
                        alert('Error, no se puede cargar la lista desplegable de establecimiento');
                    }
                });
                $.ajax({
                    type: 'ajax',
                    method: 'post',
                    url: baseurl+"pt/cinforme/getParticulas",
                    dataType: "JSON",
                    async: true,
                    data: params,
                    success:function(result){
                        $("#cboParticulasReg03").html(result);
                        $('#cboParticulasReg03').val($idsiparticula).trigger("change");  
                    },
                    error: function(){
                        alert('Error, no se puede cargar la lista desplegable de establecimiento');
                    }
                });
                $.ajax({
                    type: 'ajax',
                    method: 'post',
                    url: baseurl+"pt/cinforme/getLiquidogob",
                    dataType: "JSON",
                    async: true,
                    data: params,
                    success:function(result){
                        $("#txtLiqgobReg03").html(result);  
                        $('#txtLiqgobReg03').val($idsiparticulaliquido).trigger("change");
                    },
                    error: function(){
                        alert('Error, no se puede cargar la lista desplegable de establecimiento');
                    }
                });
                $.ajax({
                    type: 'ajax',
                    method: 'post',
                    url: baseurl+"pt/cinforme/getEnvases",
                    dataType: "JSON",
                    async: true,
                    data: params,
                    success:function(result){
                        $("#cboEnvaseReg03").html(result);  
                        $('#cboEnvaseReg03').val($idenvase).trigger("change");
                    },
                    error: function(){
                        alert('Error, no se puede cargar la lista desplegable de establecimiento');
                    }
                });

                var v_RegEstuEquipo = 2;
                var paramsEquipo = { 
                    "idptregestudio":v_RegEstuEquipo 
                };
                $.ajax({
                    type: 'ajax',
                    method: 'post',
                    url: baseurl+"pt/cinforme/getTipoequipo",
                    dataType: "JSON",
                    async: true,
                    data: paramsEquipo,
                    success:function(result){
                        $("#cboTipoequipoReg02").html(result);  
                        $('#cboTipoequipoReg02').val($idtipoequipo);
                    },
                    error: function(){
                        alert('Error, no se puede cargar la lista desplegable de establecimiento');
                    }
                });
                $.ajax({
                    type: 'ajax',
                    method: 'post',
                    url: baseurl+"pt/cinforme/getMediocalen",
                    dataType: "JSON",
                    async: true,
                    data: paramsEquipo,
                    success:function(result){
                        $("#cboMediocalientaReg02").html(result);
                        $('#cboMediocalientaReg02').val($idmediocalienta);  
                    },
                    error: function(){
                        alert('Error, no se puede cargar la lista desplegable de establecimiento');
                    }
                });
                $.ajax({
                    type: 'ajax',
                    method: 'post',
                    url: baseurl+"pt/cinforme/getFabricante",
                    dataType: "JSON",
                    async: true,
                    data: paramsEquipo,
                    success:function(result){
                        $("#cboFabricanteReg02").html(result);
                        $('#cboFabricanteReg02').val($idequipofabricante);  
                    },
                    error: function(){
                        alert('Error, no se puede cargar la lista desplegable de establecimiento');
                    }
                });
            });
        });
        //recuperaListReg03equipo(idptregproducto);
    }else if(v_RegEstu == 6){

        $('#01Registro').hide();
        $('#02Registro').hide();
        $('#03Registro').hide();
        $('#04Registro').hide();
        $('#05Registro').hide();
        $('#06Registro').show();
        $('#07Registro').hide();
        $('#08Registro').hide();
        $('#09Registro').hide();
        $('#10Registro').hide();
        $('#11Registro').hide();
        $('#12Registro').hide();
        $('#13Registro').hide();
        $('#14Registro').hide();

        $('#divphmp06').hide();
        $('#divphpf06').hide();
        $('#divparticula06').hide();

        $('#CreaReg04').hide();
        $('#CreaReg05').hide();

        var parametros = { 
            "idptregproducto":idptregproducto 
        };
        var request = $.ajax({
            type: 'ajax',
            method: 'post',
            url: baseurl+"pt/cinforme/getrecuperaregproduc",
            dataType: "JSON",
            async: true,
            data: parametros,
            error: function(){
                alert('Error, no se puede cargar la lista desplegable de establecimiento');
            }
        });      
        request.done(function( respuesta ) {            
            $.each(respuesta, function() {
                var $idtipoproducto = this.id_tipoproducto;  
                var $idsiparticula = this.id_siparticula;  

                $('#txtNombprodReg06').val(this.nombre_producto);
                $('#txtPHmatprimaReg06').val(this.ph_materia_prima);
                $('#txtPHprodfinReg06').val(this.ph_producto_final);

                $('#cbollevapartReg06').val(this.particulas).trigger("change");
                
                var params = { 
                    "idptregestudio":v_RegEstu 
                };
        
                $.ajax({
                    type: 'ajax',
                    method: 'post',
                    url: baseurl+"pt/cinforme/getTipoproducto",
                    dataType: "JSON",
                    async: true,
                    data: params,
                    success:function(result){
                        $("#cboTipoprodReg06").html(result);
                        $('#cboTipoprodReg06').val($idtipoproducto).trigger("change");  
                    },
                    error: function(){
                        alert('Error, no se puede cargar la lista desplegable de establecimiento');
                    }
                });
                $.ajax({
                    type: 'ajax',
                    method: 'post',
                    url: baseurl+"pt/cinforme/getParticulas",
                    dataType: "JSON",
                    async: true,
                    data: params,
                    success:function(result){
                        $("#cboParticulasReg06").html(result); 
                        $('#cboParticulasReg06').val($idsiparticula).trigger("change"); 
                    },
                    error: function(){
                        alert('Error, no se puede cargar la lista desplegable de establecimiento');
                    }
                })
            });
        });
        recuperaListReg06equipo(idptregproducto);
    }else if(v_RegEstu == 8){
        $('#01Registro').hide();
        $('#02Registro').hide();
        $('#03Registro').hide();
        $('#04Registro').hide();
        $('#05Registro').hide();
        $('#06Registro').hide();
        $('#07Registro').hide();
        $('#08Registro').show();
        $('#09Registro').hide();
        $('#10Registro').hide();
        $('#11Registro').hide();
        $('#12Registro').hide();
        $('#13Registro').hide();
        $('#14Registro').hide();

        $('#divphmp08').hide();
        $('#divphpf08').hide();
        $('#divparticula08').hide();
        
        $('#CreaReg07').hide();

        var parametros = { 
            "idptregproducto":idptregproducto 
        };
        var request = $.ajax({
            type: 'ajax',
            method: 'post',
            url: baseurl+"pt/cinforme/getrecuperaregproduc",
            dataType: "JSON",
            async: true,
            data: parametros,
            error: function(){
                alert('Error, no se puede cargar la lista desplegable de establecimiento');
            }
        });      
        request.done(function( respuesta ) {            
            $.each(respuesta, function() {
                var $idtipoproducto = this.id_tipoproducto;  
                var $idsiparticula = this.id_siparticula; 
                var $idenvase = this.id_envase; 

                $('#txtNombprodReg08').val(this.nombre_producto);
                $('#txtPHmatprimaReg08').val(this.ph_materia_prima);
                $('#txtPHprodfinReg08').val(this.ph_producto_final);
                $('#txtDiamReg08').val(this.diametro);
                $('#txtAltuReg08').val(this.altura);
                $('#txtGrosReg08').val(this.grosor);

                $('#cbollevapartReg08').val(this.particulas).trigger("change");
                $('#cboDimenReg08').val(this.dimension).trigger("change");
                
                var params = { 
                    "idptregestudio":v_RegEstu 
                };
                $.ajax({
                    type: 'ajax',
                    method: 'post',
                    url: baseurl+"pt/cinforme/getTipoproducto",
                    dataType: "JSON",
                    async: true,
                    data: params,
                    success:function(result){
                        $("#cboTipoprodReg08").html(result); 
                        $('#cboTipoprodReg08').val($idtipoproducto).trigger("change"); 
                    },
                    error: function(){
                        alert('Error, no se puede cargar la lista desplegable de establecimiento');
                    }
                });
                $.ajax({
                    type: 'ajax',
                    method: 'post',
                    url: baseurl+"pt/cinforme/getParticulas",
                    dataType: "JSON",
                    async: true,
                    data: params,
                    success:function(result){
                        $("#cboParticulasReg08").html(result);
                        $('#cboParticulasReg08').val($idsiparticula).trigger("change");   
                    },
                    error: function(){
                        alert('Error, no se puede cargar la lista desplegable de establecimiento');
                    }
                });
                $.ajax({
                    type: 'ajax',
                    method: 'post',
                    url: baseurl+"pt/cinforme/getEnvases",
                    dataType: "JSON",
                    async: true,
                    data: params,
                    success:function(result){
                        $("#cboEnvaseReg08").html(result);  
                        $('#cboEnvaseReg08').val($idenvase).trigger("change");   
                    },
                    error: function(){
                        alert('Error, no se puede cargar la lista desplegable de establecimiento');
                    }
                });
            });
        });
        recuperaListReg08equipo(idptregproducto);
    }else if(v_RegEstu == 9){
        $('#01Registro').hide();
        $('#02Registro').hide();
        $('#03Registro').hide();
        $('#04Registro').hide();
        $('#05Registro').hide();
        $('#06Registro').hide();
        $('#07Registro').hide();
        $('#08Registro').hide();
        $('#09Registro').show();
        $('#10Registro').hide();
        $('#11Registro').hide();
        $('#12Registro').hide();
        $('#13Registro').hide();
        $('#14Registro').hide();
        var parametros = { 
            "idptregrecinto":idptregrecinto 
        };
        var request = $.ajax({
            type: 'ajax',
            method: 'post',
            url: baseurl+"pt/cinforme/getrecuperaregrecinto",
            dataType: "JSON",
            async: true,
            data: parametros,
            error: function(){
                alert('Error, no se puede cargar la lista desplegable de establecimiento');
            }
        });      
        request.done(function( respuesta ) {            
            $.each(respuesta, function() {
                var $idtiporecinto = this.id_tiporecinto;

                $('#txtnrorecintosReg09').val(this.nro_recintos);
                $('#txtareaevalReg09').val(this.area_evaluada);
                $('#txtNroposReg09').val(this.nro_posiciones);
                $('#txtNrovolalmaReg09').val(this.vol_almacen);
                
                $('#cboevaluacionReg09').val(this.eval_recinto).trigger("change");
                
                var params = { 
                    "idptregestudio":v_RegEstu 
                };
                $.ajax({
                    type: 'ajax',
                    method: 'post',
                    url: baseurl+"pt/cinforme/getTiporecinto",
                    dataType: "JSON",
                    async: true,
                    data: params,
                    success:function(result){
                        $("#cboTiporecintoReg09").html(result);
                        $('#cboTiporecintoReg09').val($idtiporecinto).trigger("change");   
                    },
                    error: function(){
                        alert('Error, no se puede cargar la lista desplegable de establecimiento');
                    }
                });                
            });
        });
    }else if(v_RegEstu == 10){
        $('#01Registro').hide();
        $('#02Registro').hide();
        $('#03Registro').hide();
        $('#04Registro').hide();
        $('#05Registro').hide();
        $('#06Registro').hide();
        $('#07Registro').hide();
        $('#08Registro').hide();
        $('#09Registro').hide();
        $('#10Registro').show();
        $('#11Registro').hide();
        $('#12Registro').hide();
        $('#13Registro').hide();
        $('#14Registro').hide();

        var parametros = { 
            "idptregequipo":idptregequipo 
        };
        var request = $.ajax({
            type: 'ajax',
            method: 'post',
            url: baseurl+"pt/cinforme/getrecuperaregequiproduc",
            dataType: "JSON",
            async: true,
            data: parametros,
            error: function(){
                alert('Error, no se puede cargar la lista desplegable de establecimiento');
            }
        });      
        request.done(function( respuesta ) {            
            $.each(respuesta, function() {
                var $idsiparticula = this.id_siparticula; 
                var $idenvase = this.id_envase; 

                $('#txtnrorecintosReg10').val(this.nro_equipos);
                $('#txtareaevalReg10').val(this.area_evaluada);
                $('#txtNroposReg10').val(this.nro_posiciones);
                $('#txtNrovolalmaReg10').val(this.vol_almacen);
                $('#txtNombprodReg10').val(this.nombre_producto);                
                
                var params = { 
                    "idptregestudio":v_RegEstu 
                };
                
                $.ajax({
                    type: 'ajax',
                    method: 'post',
                    url: baseurl+"pt/cinforme/getParticulas",
                    dataType: "JSON",
                    async: true,
                    data: params,
                    success:function(result)
                    {
                        $("#cboFormaprodReg10").html(result);  
                        $('#cboFormaprodReg10').val($idsiparticula).trigger("change");
                    },
                    error: function(){
                        alert('Error, no se puede cargar la lista desplegable de forma de producto');
                    }
                });
                $.ajax({
                    type: 'ajax',
                    method: 'post',
                    url: baseurl+"pt/cinforme/getEnvases",
                    dataType: "JSON",
                    async: true,
                    data: params,
                    success:function(result)
                    {
                        $("#cboEnvaseReg10").html(result);  
                        $('#cboEnvaseReg10').val($idenvase).trigger("change");
                    },
                    error: function(){
                        alert('Error, no se puede cargar la lista desplegable de envases');
                    }
                });
            });
        });
    }else if(v_RegEstu == 11){
        $('#01Registro').hide();
        $('#02Registro').hide();
        $('#03Registro').hide();
        $('#04Registro').hide();
        $('#05Registro').hide();
        $('#06Registro').hide();
        $('#07Registro').hide();
        $('#08Registro').hide();
        $('#09Registro').hide();
        $('#10Registro').hide();
        $('#11Registro').show();
        $('#12Registro').hide();
        $('#13Registro').hide();
        $('#14Registro').hide();
        

        var parametros = { 
            "idptregprocestudio":idptregprocestudio 
        };
        var request = $.ajax({
            type: 'ajax',
            method: 'post',
            url: baseurl+"pt/cinforme/getrecuperaregestuproduc",
            dataType: "JSON",
            async: true,
            data: parametros,
            error: function(){
                alert('Error, no se puede cargar la lista desplegable de establecimiento');
            }
        });      
        request.done(function( respuesta ) {            
            $.each(respuesta, function() {
                var $tipo_equirecinto = this.tipo_equirecinto;
                var $idsiparticula = this.id_siparticula; 
                var $idenvase = this.id_envase; 

                $('#txtIdenequipoReg11').val(this.identificacion);
                $('#txtNombprodReg11').val(this.nombre_producto);

                $('#cboRecintoReg11').val($tipo_equirecinto).trigger("change");                
                
                var params = { 
                    "idptregestudio":v_RegEstu 
                };
                
                $.ajax({
                    type: 'ajax',
                    method: 'post',
                    url: baseurl+"pt/cinforme/getParticulas",
                    dataType: "JSON",
                    async: true,
                    data: params,
                    success:function(result)
                    {
                        $("#cboFormaprodReg11").html(result);  
                        $('#cboFormaprodReg11').val($idsiparticula).trigger("change");
                    },
                    error: function(){
                        alert('Error, no se puede cargar la lista desplegable de forma de producto');
                    }
                });
                $.ajax({
                    type: 'ajax',
                    method: 'post',
                    url: baseurl+"pt/cinforme/getEnvases",
                    dataType: "JSON",
                    async: true,
                    data: params,
                    success:function(result)
                    {
                        $("#cboEnvaseReg11").html(result);  
                        $('#cboEnvaseReg11').val($idenvase).trigger("change");
                    },
                    error: function(){
                        alert('Error, no se puede cargar la lista desplegable de envases');
                    }
                });
            });
        });
    }else if(v_RegEstu == 12){
        $('#01Registro').hide();
        $('#02Registro').hide();
        $('#03Registro').hide();
        $('#04Registro').hide();
        $('#05Registro').hide();
        $('#06Registro').hide();
        $('#07Registro').hide();
        $('#08Registro').hide();
        $('#09Registro').hide();
        $('#10Registro').hide();
        $('#11Registro').hide();
        $('#12Registro').show();
        $('#13Registro').hide();
        $('#14Registro').hide();
    }else if(v_RegEstu == 13){
        $('#01Registro').hide();
        $('#02Registro').hide();
        $('#03Registro').hide();
        $('#04Registro').hide();
        $('#05Registro').hide();
        $('#06Registro').hide();
        $('#07Registro').hide();
        $('#08Registro').hide();
        $('#09Registro').hide();
        $('#10Registro').hide();
        $('#11Registro').hide();
        $('#12Registro').hide();
        $('#13Registro').show();
        $('#14Registro').hide();
    }else if(v_RegEstu == 14){
        $('#01Registro').hide();
        $('#02Registro').hide();
        $('#03Registro').hide();
        $('#04Registro').hide();
        $('#05Registro').hide();
        $('#06Registro').hide();
        $('#07Registro').hide();
        $('#08Registro').hide();
        $('#09Registro').hide();
        $('#10Registro').hide();
        $('#11Registro').hide();
        $('#12Registro').hide();
        $('#13Registro').hide();
        $('#14Registro').show();}
}

$('#btnNuevoReg').click(function(){   
    var v_idptservicio = $('#hdnIdregservi').val(); 
    var v_idptinforme = $('#hdnIdreginfor').val();    
    var v_descripcion_serv = $('#txtregservi').val();

    $('#frmMantRegistro').trigger("reset");

    var params = { 
        "cservicio":v_idptservicio 
    };

    $.ajax({
        type: 'ajax',
        method: 'post',
        url: baseurl+"pt/cinforme/getEstudio",
        dataType: "JSON",
        async: true,
        data: params,
        success:function(result)
        {
          $("#cboRegEstudio").html(result);  
          $('#cboRegEstudio').val('').trigger("change");
        },
        error: function(){
          alert('Error, no se puede cargar la lista desplegable de establecimiento');
        }
    });

    $('#hdnAccionptreg').val('N'); 
    $('#hdnIdregservi').val(v_idptservicio); 
    $('#hdnIdreginfor').val(v_idptinforme); 
    $('#txtregservi').val(v_descripcion_serv);    

    $('#btnNuevoReg').hide();
    $('#txtRegEstudio').hide();
    $('#divRegEstudio').show();
});

$('#btnRetornarEval').click(function(){
    $('#frmMantRegistro').trigger("reset");
    $('#tabinforme a[href="#tabinforme-eval"]').tab('show');
    var $idptinforme = $('#hdnIdreginfor').val();
    var $nro_informe = $('#hdnnroinforme').val();
    recuperaListregistro($idptinforme,$nro_informe);
});





