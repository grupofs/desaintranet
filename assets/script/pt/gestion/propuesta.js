
var otblListPropuesta, otblDetapropu;
var varfdesde = '%', varfhasta = '%';
var iduser = $('#mtxtidusupropu').val();

var dt = new Date();
var year = dt.getFullYear();


$(document).ready(function() {
    $('#txtFDesde,#txtFHasta').datetimepicker({
        format: 'DD/MM/YYYY',
        daysOfWeekDisabled: [0],
        locale:'es'
    });

    $('#mtxtFregpropuesta').datetimepicker({
        format: 'DD/MM/YYYY',
        daysOfWeekDisabled: [0],
        locale:'es'
    });

    fechaActual();

    /*LLENADO DE COMBOS*/         
    $.ajax({
        type: 'ajax',
        method: 'post',
        url: baseurl+"pt/cpropuesta/getclientepropu",
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
        url: baseurl+"pt/cpropuesta/getServicio",
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

$('#swVigencia').on('switchChange.bootstrapSwitch',function (event, state) {
    $('#btnBuscar').click();
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

    $("#btnexcel").removeAttr("disabled");

    otblListPropuesta = $('#tblListPropuesta').DataTable({  
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
            "url"   : baseurl+"pt/cpropuesta/getbuscarpropuesta/",
            "type"  : "POST", 
            "data": function ( d ) {
                d.ccliente      = $('#cboClie').val();
                d.fdesde        = varfdesde; 
                d.fhasta        = varfhasta;   
                d.cservicio     = $('#cboServ').val();
                d.cestado       = $('#cboEst').val(); 
                d.dnrodet       = $('#txtnrodet').val(); 
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
            {"orderable": false, data: 'NROPROPU', targets: 1, "class": "col-m"},
            {"orderable": false, data: 'RAZONSOCIAL', targets: 2, "class": "col-xm"},
            {"orderable": false, data: 'DETAPROPU', targets: 3, "class": "col-l"},
            {"orderable": false, data: 'COSTOPROPU', targets: 4, "class": "col-c"},
            {"orderable": false, data: 'FECHPROPU', targets: 5, "class": "col-c"},
            {"orderable": false, data: 'DESCRIPESTABLE', targets: 6, "class": "col-l"},
            {responsivePriority: 1, "orderable": false, "class": "col-xc", 
                render:function(data, type, row){
                    return '<div>'+
                    '<a data-toggle="modal" title="Editar" style="cursor:pointer; color:#3c763d;" data-target="#modalCreaPropu" onClick="javascript:selPropuesta(\''+row.IDPROPU+'\',\''+row.CODCLIENTE+'\',\''+row.NROPROPU+'\',\''+row.FECHPROPU+'\',\''+row.IDSERV+'\',\''+row.DETAPROPU+'\',\''+row.COSTOTOTAL+'\',\''+row.ESTPROPU+'\',\''+row.CONTACTO+'\',\''+row.OBSPROPU+'\',\''+row.SERVNEW+'\',\''+row.CLIPOTEN+'\',\''+row.IDUSUARIO+'\',\''+row.TIPOCOSTO+'\',\''+row.ARCHIVO+'\',\''+row.CODESTABLE+'\',\''+row.RUTA+'\',\''+row.NOMBARCH+'\');"><span class="fas fa-edit" aria-hidden="true"> </span> </a>'+
                    '&nbsp;'+
                    '<a id="aDelPropu" href="'+row.IDPROPU+'" title="Eliminar" style="cursor:pointer; color:#FF0000;"><span class="fas fa-trash-alt" aria-hidden="true"> </span></a>'+      
                    '</div>'
                }
            },            
            {"orderable": false, 
              render:function(data, type, row){
                bfind = true;   
                  return ' <div class="btn-group">'+
                    ' <button type="button" class="btn btn-default">Cambiar Estado</button>'+
                    ' <button type="button" class="btn btn-default dropdown-toggle dropdown-icon" data-toggle="dropdown">'+
                    ' <span class="sr-only">Toggle Dropdown</span>'+
                    ' <div class="dropdown-menu" role="menu">'+
                    ' <a class="dropdown-item" onClick="cambiaEstPropu(\''+row.IDPROPU+'\',\''+1+'\');"><i style="color:green;" class="fas fa-check"></i>&nbsp;&nbsp;Aceptado</a>'+
                    ' <a class="dropdown-item" onClick="cambiaEstPropu(\''+row.IDPROPU+'\',\''+2+'\');"><i style="color:yellow;" class="fas fa-exclamation-triangle"></i>&nbsp;&nbsp;Pendiente</a>'+
                    ' <a class="dropdown-item" onClick="cambiaEstPropu(\''+row.IDPROPU+'\',\''+3+'\');"><i style="color:red;" class="fas fa-exclamation-triangle"></i>&nbsp;&nbsp;Rechazado</a>'+
                    ' <a class="dropdown-item" onClick="cambiaEstPropu(\''+row.IDPROPU+'\',\''+4+'\');"><i style="color:orange;" class="fas fa-exclamation-triangle"></i>&nbsp;&nbsp;Reemplazada</a>'+
                    ' <a class="dropdown-item" onClick="cambiaEstPropu(\''+row.IDPROPU+'\',\''+5+'\');"><i style="color:blue;" class="fas fa-exclamation-triangle"></i>&nbsp;&nbsp;Referencial</a>'+
                    ' </div>'+
                    ' </button>'+ 
                    ' &nbsp; &nbsp;'+
                    ' <a data-toggle="modal" title="Adjuntar" style="cursor:pointer; color:#3c763d;" data-target="#modalDetaPropu" onClick="javascript:listarDetPropuesta(\''+row.IDPROPU+'\',\''+row.FECHPROPU+'\',\''+row.NROPROPU+'\',\''+row.CANTDET+'\');"class="btn btn-outline-primary btn-sm hidden-xs hidden-sm"><span class="fas fa-folder-open" aria-hidden="true"> </span> DOCUMENTOS ADJUNTOS</a>'+
                    ' &nbsp; &nbsp;'+
                    ' <a data-toggle="modal" title="Extender" style="cursor:pointer; color:#3c763d;" data-target="#modalCreaPropu" onClick="javascript:SelExtenderpropu(\''+row.IDPROPU+'\',\''+row.CODCLIENTE+'\',\''+row.NROPROPU+'\',\''+row.FECHPROPU+'\',\''+row.IDSERV+'\',\''+row.DETAPROPU+'\',\''+row.COSTOTOTAL+'\',\''+row.ESTPROPU+'\',\''+row.CONTACTO+'\',\''+row.OBSPROPU+'\',\''+row.SERVNEW+'\',\''+row.CLIPOTEN+'\',\''+row.IDUSUARIO+'\',\''+row.TIPOCOSTO+'\',\''+row.ARCHIVO+'\',\''+row.CODESTABLE+'\',\''+row.RUTA+'\');"class="btn btn-outline-primary btn-sm hidden-xs hidden-sm"><span class="fas fa-external-link-alt" aria-hidden="true"> </span> EXTENDER PROPUESTA</a>'+
                    ' &nbsp; &nbsp;'+
                    ' <a data-toggle="modal" title="Duplicar" style="cursor:pointer; color:#3c763d;" data-target="#modalCreaPropu" onClick="javascript:SelDuplicarpropu(\''+row.IDPROPU+'\',\''+row.CODCLIENTE+'\',\''+row.NROPROPU+'\',\''+row.FECHPROPU+'\',\''+row.IDSERV+'\',\''+row.DETAPROPU+'\',\''+row.COSTOTOTAL+'\',\''+row.ESTPROPU+'\',\''+row.CONTACTO+'\',\''+row.OBSPROPU+'\',\''+row.SERVNEW+'\',\''+row.CLIPOTEN+'\',\''+row.IDUSUARIO+'\',\''+row.TIPOCOSTO+'\',\''+row.ARCHIVO+'\',\''+row.CODESTABLE+'\',\''+row.RUTA+'\');"class="btn btn-outline-primary btn-sm hidden-xs hidden-sm"><span class="fas fa-clone" aria-hidden="true"> </span> DUPLICAR PROPUESTA</a>'+
                  '</div>'  
                
              }
            }
        ],
        "columnDefs": [{
            "targets": [1], 
            "data": null, 
            "render": function(data, type, row) { 
                if (row.ESTPROPU ==  "1") {
                    $estado = "<span class='badge badge-success'>Aceptado</span>";
                }else if (row.ESTPROPU == "2") {
                    $estado = "<span class='badge badge-info'>Pendiente</span>";
                }else if (row.ESTPROPU == "3") {
                    $estado = "<span class='badge badge-danger'>Rechazado</span>";
                }else if (row.ESTPROPU == "4") {
                    $estado = "<span class='badge badge-warning'>Reemplazada</span>";
                }else if (row.ESTPROPU == "5") {
                    $estado = "<span class='badge badge-warning'>Referencial</span>";
                } 
                
                var yearprop = row.FECHPROPU.substr(-4);
                if(row.ARCHIVO != "") {
                    return '<p><a href="'+baseurl+row.RUTA+row.ARCHIVO+'" target="_blank" class="pull-left">'+row.NROPROPU+'&nbsp;&nbsp;<i class="fas fa-cloud-download-alt" data-original-title="Descargar" data-toggle="tooltip"></i></a>&nbsp;&nbsp;'+$estado+'<p>';
                }else{
                    return '<p>'+row.NROPROPU+'&nbsp;&nbsp;'+$estado+'</p>';
                }                      
            }
        },{
            "targets": [3], 
            "data": null, 
            "render": function(data, type, row) {
                return '<h6>'+row.DESCRIPSERV+'</h6>'+
                '<small>'+row.DETAPROPU+'</small>';
            }
        }]
    });   
    // Enumeracion 
    otblListPropuesta.on( 'order.dt search.dt', function () { 
        otblListPropuesta.column(0, {search:'applied', order:'applied'}).nodes().each( function (cell, i) {
          cell.innerHTML = i+1;
          } );
    }).draw();  
});

$("#btnexcel1").click(function (){    
    event.preventDefault();

    var vlvigencia, vlccliente, vlcservicio, vlcestado, vldnrodet;
    
    vlccliente     = $('#cboClie').val();   
    vlcservicio     = $('#cboServ').val();
    vlcestado       = $('#cboEst').val(); 
    vldnrodet       = $('#txtnrodet').val(); 

    if($('#swVigencia').prop('checked')){
        vlvigencia = 'A';
    }else{
        vlvigencia = 'I';
    }
    
    if(varfdesde != '%'){ varfdesde = $('#txtFIni').val(); }
    if(varfhasta != '%'){ varfhasta = $('#txtFFin').val(); } 
    
    var params = { 
        "ccliente"   : vlccliente,
        "fdesde"   : varfdesde,
        "fhasta"   : varfhasta,
        "cservicio"   : vlcservicio,
        "cestado"   : vlcestado,
        "dnrodet"   : vldnrodet,
        "vigente"   : vlvigencia,
    }; 
    $.ajax({
        type: 'ajax',
        method: 'post',
        url: baseurl+"pt/cpropuesta/excelpropujs",
        dataType: "JSON",
        async: true,
        data: params,
        success:function(result)
        {
        },
        error: function(){
          alert('Error, No se puede autenticar por error');
        }
    });
    /*
    $.post(baseurl+"pt/cpropuesta/excelpropujs", 
    {
    });
    */
    //<?= base_url('')?>
});

$('#modalCreaPropu').on('shown.bs.modal', function (e) { 
    $("#mtxtContacPropu").prop({readonly:true}); 
    $("#mtxtNropropuesta").prop({readonly:true}); 
    
    $('#contactxt').show();
    $('#contacsel').hide();

    $('#lbchkpro').show();
    $('#lbchkcontact').show();
    
    var params = { 
        "ccia" : '0',
        "carea" : '0'
    }; 
    $.ajax({
        type: 'ajax',
        method: 'post',
        url: baseurl+"adm/rrhh/cctrlpermisos/getempleados",
        dataType: "JSON",
        async: true,
        data: params,
        success:function(result)
        {
            $('#mcboContact').html(result);
        },
        error: function(){
          alert('Error, No se puede autenticar por error');
        }
    });
});

fechaActualpropu= function(){
    var fecha = new Date();	
    var fechatring = ("0" + fecha.getDate()).slice(-2) + "/" + ("0"+(fecha.getMonth()+1)).slice(-2) + "/" +fecha.getFullYear() ;
    
    $('#mtxtFregpropuesta').datetimepicker('date', moment(fechatring, 'DD/MM/YYYY') );	
};

iniModalPropu = function(Ccliente,idServ,idestab){
    $.ajax({
        type: 'ajax',
        method: 'post',
        url: baseurl+"pt/cpropuesta/getclienteinternopt",
        dataType: "JSON",
        async: true,
        success:function(result)
        {
            $('#mcboClie').html(result);
            $('#mcboClie').val(Ccliente).trigger("change"); 
        },
        error: function(){
            alert('Error, No se puede autenticar por error');
        }
    });     

    $.ajax({
        type: 'ajax',
        method: 'post',
        url: baseurl+"pt/cpropuesta/getServicio",
        dataType: "JSON",
        async: true,
        success:function(result)
        {
            $('#mcboServPropu').html(result);
            $('#mcboServPropu').val(idServ).trigger("change");
        },
        error: function(){
            alert('Error, No se puede autenticar por error');
        }
    });

    var params = { "ccliente":Ccliente };
    $.ajax({
        type: 'ajax',
        method: 'post',
        url: baseurl+"pt/cpropuesta/buscar_establexcliente",
        dataType: "JSON",
        async: true,
        data: params,
        success:function(result)
        {
          $("#mcboEstable").html(result);           
          $('#mcboEstable').val(idestab).trigger("change");
        },
        error: function(){
          alert('Error, no se puede cargar la lista desplegable de establecimiento');
        }
    });
}

$("#btnNuevo").click(function (){
    $('#frmCreaPropu').trigger("reset");

    iniModalPropu("0","%","%"); 

    $('#mhdnAccionPropu').val('N');
    $('#mhdnIdPropu').val();
    $('#mtxtContacPropu').val($('#mtxtinfousuario').val());

    tcDolar();
    fechaActualpropu();	
    nro_propuesta();
});

selPropuesta= function(IDPROPU,CODCLIENTE,NROPROPU,FECHPROPU,IDSERV,DETAPROPU,COSTOTOTAL,ESTPROPU,CONTACTO,OBSPROPU,SERVNEW,CLIPOTEN,IDUSUARIO,TIPOCOSTO,ARCHIVO,CODESTABLE,RUTA,NOMBARCH){
    $('#mhdnAccionPropu').val('A');
        
    $('#mhdnIdPropu').val(IDPROPU);
    $('#mtxtidusupropu').val(IDUSUARIO);
    $('#mhdnEstadoPropu').val(ESTPROPU);
    $('#mtxtFpropu').val(FECHPROPU);
    $('#mcboEstable').val(CODESTABLE);
    $('#mcboClie').val(CODCLIENTE);
    $('#mcboServPropu').val(IDSERV);
    $('#mtxtNropropuesta').val(NROPROPU);
    $('#mtxtservnew').val(SERVNEW).trigger("change");
    $('#mtxtClientePote').val(CLIPOTEN).trigger("change");
    $('#mtxtCostoPropu').val(COSTOTOTAL);
    $('#txtTipomoneda').val(TIPOCOSTO);
    $('#mtxtContacPropu').val(CONTACTO);
    $('#mtxtarchivo').val(ARCHIVO);
    $('#mtxtRutapropu').val(RUTA);
    $('#mtxtDetaPropu').val(DETAPROPU);
    $('#mtxtObspropu').val(OBSPROPU);
    $('#mtxtNomarchpropu').val(NOMBARCH);

    iniModalPropu(CODCLIENTE,IDSERV,CODESTABLE);

    if(TIPOCOSTO == '$'){       
        tcDolar(); 
    }else{
        tcSol();
    }

    $('#lbnropro').show();
    $('#lbchkpro').hide();
    $('#lbcontact').show();
    $('#lbchkcontact').hide();
    
};

$("#mcboClie").change(function(){
    var v_mcboClie = $('#mcboClie').val();
    var v_accion = $('#mhdnAccionPropu').val();

    var params = { "ccliente":v_mcboClie };

    if(v_accion == 'N'){
        $.ajax({
            type: 'ajax',
            method: 'post',
            url: baseurl+"pt/cpropuesta/buscar_establexcliente",
            dataType: "JSON",
            async: true,
            data: params,
            success:function(result)
            {
                $("#mcboEstable").html(result);           
            },
            error: function(){
                alert('Error, no se puede cargar la lista desplegable de establecimiento');
            }
        });
    }
    
});

$("#chkNroAntiguo").on("change", function () {
    if($("#chkNroAntiguo").is(":checked") == true){ 
        $("#mtxtNropropuesta").prop({readonly:false}); 
    }else if($("#chkNroAntiguo").is(":checked") == false){ 
        $("#mtxtNropropuesta").prop({readonly:true}); 
    }; 
    if ($('#mhdnAccionPropu').val()=='N'){
        nro_propuesta();
    }
}); 

function nro_propuesta(){
    var vyearPropu = $('#mtxtFpropu').val().substr(6);
    var params = { 
        "yearPropu" : vyearPropu
    }; 

    $.ajax({
      type: 'ajax',
      method: 'post',
      url: baseurl+"pt/cpropuesta/getnropropuesta",
      dataType: "JSON",
      async: true,
      data: params,
      success: function (result){
        var c = (result);
        $.each(c,function(i,item){
          $('#mtxtNropropuesta').val(item.NRO_PROPU);
        })
      },
      error: function(){
        alert('Error, no se genero Nro. Propuesta');
      }
    })
};

tcDolar=function(){
    $('#btntipomoneda').html("$");
    $('#txtTipomoneda').val('$');
};
tcSol=function(){
    $('#btntipomoneda').html("S/.");
    $('#txtTipomoneda').val('S');
};

$("#chkContacto").on("change", function () {
    if($("#chkContacto").is(":checked") == true){ 
        $("#mtxtContacPropu").prop({readonly:false}); 
    }else if($("#chkContacto").is(":checked") == false){ 
        $("#mtxtContacPropu").prop({readonly:true}); 
        $('#mtxtContacPropu').val($('#mtxtinfousuario').val());
    }; 
}); 

$('#btncontacto').click(function() {   
    $('#contactxt').hide();
    $('#contacsel').show(); 	
});

$("#mcboContact").change(function(){
    var selected = document.getElementById("mcboContact");
    var v_contacto = selected.options[selected.selectedIndex].text;
    $('#mtxtContacPropu').val(v_contacto);
    $('#contactxt').show();
    $('#contacsel').hide(); 
});

$('#btCercontact').click(function() {
    $('#contactxt').show();
    $('#contacsel').hide(); 
});

escogerArchivo = function(){    
    var archivoInput = document.getElementById('mtxtArchivopropu');
    var archivoRuta = archivoInput.value;
    var extPermitidas = /(.pdf|.docx|.xlsx|.doc|.xls)$/i;
    
    var filename = $('#mtxtArchivopropu').val().replace(/.*(\/|\\)/, '');
    $('#mtxtNomarchpropu').val(filename);

    if(!extPermitidas.exec(archivoRuta)){
        alert('Asegurese de haber seleccionado un PDF, DOCX, XSLX');
        archivoInput.value = '';  
        $('#mtxtNomarchpropu').val('');
        return false;
    }      
    $('#sArchivo').val('S');
};

$('#frmCreaPropu').submit(function(event){
    event.preventDefault();
    
    var request = $.ajax({
        url:$('#frmCreaPropu').attr("action"),
        type:$('#frmCreaPropu').attr("method"),
        data:$('#frmCreaPropu').serialize(),
        error: function(){
            Vtitle = 'No se puede registrar por error';
            Vtype = 'error';
            sweetalert(Vtitle,Vtype);
        }
    });
    request.done(function( respuesta ) {
        var posts = JSON.parse(respuesta);        
        $.each(posts, function() {   
            $('#mhdnIdPropu').val(this.id_propuesta);
            if($('#sArchivo').val() == 'S'){          
                subirArchivo();
            }else{   
                $('#btnBuscar').click();     
                Vtitle = this.respuesta;
                Vtype = 'success';
                sweetalert(Vtitle,Vtype);        
                $('#mbtnCCreaPropu').click();
            } 
            $('#sArchivo').val('N');  
        });
    });
});

subirArchivo=function(){
    var parametrotxt = new FormData($("#frmCreaPropu")[0]);
    var request = $.ajax({
        data: parametrotxt,
        method: 'post',
        url: baseurl+"pt/cpropuesta/subirArchivo/",
        dataType: "JSON",
        async: true,
        contentType: false,
        processData: false,
        error: function(){
            alert('Error, no se cargó el archivo');
        }
    });
    request.done(function( respuesta ) {
        $('#btnBuscar').click(); 
        Vtitle = 'Guardo Correctamente';
        Vtype = 'success';
        sweetalert(Vtitle,Vtype);
        $('#mbtnCCreaPropu').click();
    });
};
   
$("body").on("click","#aDelPropu",function(event){
    event.preventDefault();
    idptpropuesta = $(this).attr("href");

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
            $.post(baseurl+"pt/cpropuesta/delpropuesta/", 
            {
                idptpropuesta   : idptpropuesta,
            },      
            function(data){     
                otblListPropuesta.ajax.reload(null,false); 
                Vtitle = 'Se Elimino Correctamente';
                Vtype = 'success';
                sweetalert(Vtitle,Vtype);      
            });
        }
    }) 
});

cambiaEstPropu = function(idpropu, estado){
    var params = { "idpropu":idpropu,"est":estado };
    $.ajax({
      type: 'ajax',
      method: 'post',
      url: baseurl+"pt/cpropuesta/updestadopropuesta",
      async: true,
      data: params,
      success:function(result)
      {
        otblListPropuesta.ajax.reload(null,false); 
        Vtitle = 'Se Actualizo correctamente el Estado';
        Vtype = 'success';
        sweetalert(Vtitle,Vtype);  
      },
      error: function(){          
        otblListPropuesta.ajax.reload(null,false); 
        Vtitle = 'No se puede actualizar el estado';
        Vtype = 'error';
        sweetalert(Vtitle,Vtype); 
      }
    });
  
};

$('#modalDetaPropu').on('shown.bs.modal', function (e) {
    //
});

listarDetPropuesta=function(idpropu,fechapropu,nropropu,cantdet){
    $('#mtxtiddetapropu').val(idpropu);
    $('#mtxtfechadetapropu').val(fechapropu);
    $('#mtxtnrodetapropu').val(nropropu);
    $('#mtxtcantdetapropu').val(cantdet);

    otblDetapropu = $('#tblDetapropu').DataTable({  
        'responsive'    : true,
        'bJQueryUI'     : true,
        'scrollY'     	: '250px',
        'scrollX'     	: true, 
        'paging'      	: false,
        'processing'  	: true,      
        'bDestroy'    	: true,
        "AutoWidth"     : false,
        'info'        	: true,
        'filter'      	: false, 
        "ordering"		: false,  
        'stateSave'     : true,
        'ajax'	: {
            "url"   : baseurl+"pt/cpropuesta/getbuscardetapropu/",
            "type"  : "POST", 
            "data": function ( d ) { 
                d.idptpropuesta  = idpropu; 
            },     
            dataSrc : ''        
        },
        'columns'	: [
            {orderable : false, data : 'POS', targets : 0 },
            {data: 'NOMARCH', targets: 1 },
            {"orderable": false, 
              render:function(data, type, row){
                return  '<div>'+  
                            '<a href="'+baseurl+row.RUTAFILE+row.ARCHIVO+'" target="_blank" class="btn btn-default btn-xs pull-left"><i class="fas fa-cloud-download-alt fa-2x" data-original-title="Descargar" data-toggle="tooltip"></i></a>'+
                        '</div>'   
              }
            },
            {"orderable": false, 
              render:function(data, type, row){
                return  '<div>'+  
                          '<a id="aDelDetPropu" href="'+row.ITEM+'" title="Eliminar" style="cursor:pointer; color:#FF0000;"><span class="fas fa-trash-alt fa-2x" aria-hidden="true"> </span></a>'+
                        '</div>'   
              }
            }
        ],
    });   
};
 
subirDetPropuesta=function(){
    var archivoInput = document.getElementById('mtxtDetArchivopropu');
    var archivoRuta = archivoInput.files;
    var i;
    var result = [];

    for(i = 0; i < archivoRuta.length; i++){
        result[i] = archivoRuta[i].name;  
    }

    var extPermitidas = /(.pdf|.docx|.xlsx|.doc|.xls)$/i;

    if(!extPermitidas.exec(result)){
        alert('Asegurese de haber seleccionado un PDF, DOCX, XSLX, MDB');
        archivoInput.value = '';
        return false;
    }
    else
    {
        var parametrotxt = new FormData($("#frmDetaPropu")[0]);
        var request = $.ajax({
            data: parametrotxt,
            method: 'post',
            url: baseurl+"pt/cpropuesta/archivo_detpropuesta/",
            dataType: "JSON",
            async: true,
            contentType: false,
            processData: false,
            error: function(){
                alert('Error, no se cargó el archivo');
            }
        });
        request.done(function( respuesta ) {      
            $('#frmDetaPropu').trigger("reset");
            otblDetapropu.ajax.reload(null,false);
        });
    }
};
   
$("body").on("click","#aDelDetPropu",function(event){
    event.preventDefault();
    item = $(this).attr("href");

    Swal.fire({
        title: 'Confirmar Eliminación',
        text: "¿Está seguro de eliminar el Archivo Adjunto?",
        icon: 'error',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Si, bórralo!'
    }).then((result) => {
        if (result.value) {
            $.post(baseurl+"pt/cpropuesta/deldetpropuesta/", 
            {
                item   : item,
            },      
            function(data){     
                otblDetapropu.ajax.reload(null,false); 
                Vtitle = 'Se Elimino Correctamente';
                Vtype = 'success';
                sweetalert(Vtitle,Vtype);      
            });
        }
    }) 
});

SelExtenderpropu= function(IDPROPU,CODCLIENTE,NROPROPU,FECHPROPU,IDSERV,DETAPROPU,COSTOTOTAL,ESTPROPU,CONTACTO,OBSPROPU,SERVNEW,CLIPOTEN,IDUSUARIO,TIPOCOSTO,ARCHIVO,CODESTABLE,RUTA){
    $('#frmCreaPropu').trigger("reset");
    
    $('#mhdnAccionPropu').val('N');
        
    $('#mhdnIdPropu').val('');
    $('#mtxtidusupropu').val(IDUSUARIO);
    $('#mhdnEstadoPropu').val('2');
    $('#mtxtFpropu').val('');
    $('#mcboEstable').val(CODESTABLE);
    $('#mcboClie').val(CODCLIENTE);
    $('#mcboServPropu').val(IDSERV);
    $('#mtxtNropropuesta').val('');
    $('#mtxtservnew').val(SERVNEW).trigger("change");
    $('#mtxtClientePote').val(CLIPOTEN).trigger("change");
    $('#mtxtCostoPropu').val(COSTOTOTAL);
    $('#txtTipomoneda').val(TIPOCOSTO);
    $('#mtxtContacPropu').val($('#mtxtinfousuario').val());
    $('#mtxtNomarchpropu').val('');
    $('#mtxtRutapropu').val('');
    $('#mtxtDetaPropu').val(DETAPROPU);
    $('#mtxtObspropu').val(OBSPROPU);

    iniModalPropu(CODCLIENTE,IDSERV,CODESTABLE);

    if(TIPOCOSTO == '$'){       
        tcDolar(); 
    }else{
        tcSol();
    }

    $('#lbnropro').hide();
    $('#lbchkpro').show();
    $('#lbcontact').hide();
    $('#lbchkcontact').show();

    fechaActualpropu();	
    ext_nropropuesta(NROPROPU);
    
};

function ext_nropropuesta(NROPROPU){
    
    var params = { 
        "nropropuesta" : NROPROPU
    }; 
    $.ajax({
      type: 'ajax',
      method: 'post',
      url: baseurl+"pt/cpropuesta/getextnropropuesta",
      dataType: "JSON",
      async: true,
      data: params,
      success: function (result){
        var c = (result);
        $.each(c,function(i,item){
          $('#mtxtNropropuesta').val(item.NRO_PROPU);
        })
      },
      error: function(){
        alert('Error, no se exxtendio Nro. Propuesta');
      }
    })
}; 

SelDuplicarpropu= function(IDPROPU,CODCLIENTE,NROPROPU,FECHPROPU,IDSERV,DETAPROPU,COSTOTOTAL,ESTPROPU,CONTACTO,OBSPROPU,SERVNEW,CLIPOTEN,IDUSUARIO,TIPOCOSTO,ARCHIVO,CODESTABLE,RUTA){
    $('#frmCreaPropu').trigger("reset");
    
    $('#mhdnAccionPropu').val('N');
        
    $('#mhdnIdPropu').val('');
    $('#mtxtidusupropu').val(IDUSUARIO);
    $('#mhdnEstadoPropu').val('2');
    $('#mtxtFpropu').val('');
    $('#mcboEstable').val(CODESTABLE);
    $('#mcboClie').val(CODCLIENTE);
    $('#mcboServPropu').val(IDSERV);
    $('#mtxtNropropuesta').val('');
    $('#mtxtservnew').val(SERVNEW).trigger("change");
    $('#mtxtClientePote').val(CLIPOTEN).trigger("change");
    $('#mtxtCostoPropu').val(COSTOTOTAL);
    $('#txtTipomoneda').val(TIPOCOSTO);
    $('#mtxtContacPropu').val($('#mtxtinfousuario').val());
    $('#mtxtNomarchpropu').val('');
    $('#mtxtRutapropu').val('');
    $('#mtxtDetaPropu').val(DETAPROPU);
    $('#mtxtObspropu').val(OBSPROPU);

    iniModalPropu(CODCLIENTE,IDSERV,CODESTABLE);

    if(TIPOCOSTO == '$'){       
        tcDolar(); 
    }else{
        tcSol();
    }

    $('#lbnropro').hide();
    $('#lbchkpro').show();
    $('#lbcontact').hide();
    $('#lbchkcontact').show();

    fechaActualpropu();	
    nro_propuesta();
    
};


/*
$('.addcliente')
.on('select2:open', () => {
    $(".select2-results:not(:has(a))").append('<a href="#" style="padding: 6px;height: 20px;display: inline-table;">Agregar Nuevo</a>');
})
*/

