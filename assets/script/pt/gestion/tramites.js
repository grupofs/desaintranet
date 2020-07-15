
var otblListTramite, otblAdjuntar;
var varfdesde = '%', varfhasta = '%';

$(document).ready(function() {

    $('#txtFDesde,#txtFHasta').datetimepicker({
        format: 'DD/MM/YYYY',
        daysOfWeekDisabled: [0],
        locale:'es'
    });

    fechaActual();

    $.ajax({
        type: 'ajax',
        method: 'post',
        url: baseurl+"pt/ctramites/getclieproptram",
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
        url: baseurl+"pt/ctramites/gettipotramite",
        dataType: "JSON",
        async: true,
        success:function(result)
        {
            $('#cboTram').html(result);
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

    otblListTramite = $('#tblListTramite').DataTable({  
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
            "url"   : baseurl+"pt/ctramites/getbuscartramites/",
            "type"  : "POST", 
            "data": function ( d ) {
                d.ccliente      = $('#cboClie').val();
                d.fdesde        = varfdesde; 
                d.fhasta        = varfhasta;   
                d.idtipotram    = $('#cboTram').val();
                d.dnropropu     = $('#txtnroprop').val(); 
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
            {"orderable": false, data: 'drazonsocial', targets: 1, "class": "col-l"},
            {"orderable": false, data: 'nro_propu', targets: 2, "class": "col-sm"},
            {"orderable": false, data: 'descripcion', targets: 3, "class": "col-m"},
            {"orderable": false, data: 'fecha_tramite', targets: 4, "class": "col-sm"},
            {"orderable": false, data: 'codigo', targets: 5, "class": "col-s"},
            {"orderable": false, "class": "col-s", 
                render:function(data, type, row){
                    var ruta = row.ruta_docum;
                    var arch = row.adj_docum;
                    var docum;
                    if(row.adj_docum != "") {
                        docum = '<a href="'+baseurl+ruta+arch+'" target="_blank" class="pull-left" title="Descargar" style="cursor:pointer; color:#093EE6;"><i class="fas fa-cloud-download-alt"></i></a>';
                    }else{
                        docum = '';
                    }                 
                    var rutacarta = row.ruta_carta;
                    var archcarta = row.adj_carta;
                    var carta;  
                    if(row.adj_carta != "") {
                        carta = ' &nbsp; &nbsp; <a href="'+baseurl+rutacarta+archcarta+'" target="_blank" class="pull-left" title="Carta" style="cursor:pointer; color:#8C2015;"><i class="far fa-file-pdf"></i></a>';
                    }else{
                        carta = '';
                    } 
                    return docum+carta 
                }
            },
            {"orderable": false, "class": "col-l", 
                render:function(data, type, row){
                    if(row.id_tipotramite == 3){
                        return ' <div class="btn-group">'+
                            ' <a data-toggle="modal" title="Adjuntar" style="cursor:pointer; color:#3c763d;" data-target="#modalAdjuntar" onClick="javascript:listarAdjuntar(\''+row.idpttramite+'\',\''+row.adj_docum+'\',\''+row.ruta_docum+'\');"class="btn btn-outline-primary btn-sm hidden-xs hidden-sm"><span class="fas fa-external-link-alt" aria-hidden="true"> </span> ADJUNTAR VARIOS</a>'+
                            ' &nbsp; &nbsp;'+
                            ' <a data-toggle="modal" title="Informe" style="cursor:pointer; color:#3c763d;" data-target="#modalRelaInf" onClick="javascript:SelRelaInf(\''+row.idpttramite+'\');"class="btn btn-outline-primary btn-sm hidden-xs hidden-sm"><span class="fas fa-clone" aria-hidden="true"> </span> RELACIONAR INFORME</a>'+
                        '</div>'
                    }else if(row.id_tipotramite == 4){
                        return ' <div class="btn-group">'+
                            ' <a data-toggle="modal" title="Adjuntar" style="cursor:pointer; color:#3c763d;" data-target="#modalAdjuntar" onClick="javascript:listarAdjuntar(\''+row.idpttramite+'\',\''+row.adj_docum+'\',\''+row.ruta_docum+'\');"class="btn btn-outline-primary btn-sm hidden-xs hidden-sm"><span class="fas fa-external-link-alt" aria-hidden="true"> </span> ADJUNTAR VARIOS</a>'+
                        '</div>'
                    }else{
                        return ''
                    }
                }
            },
            {responsivePriority: 1, "orderable": false, "class": "col-s", 
                render:function(data, type, row){
                    return '<div>'+
                    '<a data-toggle="modal" title="Editar" style="cursor:pointer; color:#3c763d;" data-target="#modalCreaTram" onClick="javascript:selTramite(\''+row.idpttramite+'\',\''+row.codigo+'\',\''+row.nombproducto+'\',\''+row.descripcion+'\',\''+row.idresponsable+'\',\''+row.comentarios+'\',\''+row.idptpropuesta+'\',\''+row.fecha_tramite+'\',\''+row.id_tipotramite+'\',\''+row.adj_docum+'\',\''+row.adj_carta+'\',\''+row.ruta_docum+'\',\''+row.ruta_carta+'\',\''+row.ccliente+'\',\''+row.nomb_docum+'\',\''+row.nomb_carta+'\');"><span class="fas fa-edit" aria-hidden="true"> </span> </a>'+
                    '&nbsp;'+
                    '<a id="aDelTram" href="'+row.idpttramite+'" title="Eliminar" style="cursor:pointer; color:#FF0000;"><span class="fas fa-trash-alt" aria-hidden="true"> </span></a>'+      
                    '</div>'
                }
            }
        ]
    });   
    // Enumeracion 
    otblListTramite.on( 'order.dt search.dt', function () { 
        otblListTramite.column(0, {search:'applied', order:'applied'}).nodes().each( function (cell, i) {
          cell.innerHTML = i+1;
          } );
    }).draw(); 
});

$('#btnNuevo').click(function(){
    $('#frmCreaTram').trigger("reset");
    $('#mhdnAccionTram').val('N');
    iniModalTram("0","%","1",'N');
});

selTramite= function(idpttramite,codigo,nombproducto,descripcion,idresponsable,comentarios,idptpropuesta,fecha_tramite,id_tipotramite,adj_docum,adj_carta,ruta_docum,ruta_carta,ccliente, nomb_docum, nomb_carta){
    
    $('#mhdnAccionTram').val('A');
        
    $('#mhdnIdTram').val(idpttramite);
    $('#mtxtFtram').val(fecha_tramite);
    $('#mcboTipotram').val(id_tipotramite).trigger("change");
    $('#mtxtCodigo').val(codigo);
    $('#mcboRespon').val(idresponsable).trigger("change");
    $('#mtxtNombprod').val(nombproducto);
    $('#mtxtDescrip').val(descripcion);
    $('#mtxtNombarch').val(nomb_docum);
    $('#mtxtarchivo').val(adj_docum);
    $('#mtxtRutaarch').val(ruta_docum);
    $('#mtxtNombcarta').val(nomb_carta);
    $('#mtxtCarta').val(adj_carta);
    $('#mtxtRutacarta').val(ruta_carta);
    $('#mtxtComentario').val(comentarios);

    iniModalTram(ccliente,idptpropuesta,id_tipotramite,'A');

};

iniModalTram = function(ccliente,idptpropuesta,id_tipotramite,accion){
    
    $.ajax({
        type: 'ajax',
        method: 'post',
        url: baseurl+"pt/ctramites/getclieproptram",
        dataType: "JSON",
        async: true,
        success:function(result){
            $('#mcboClienprop').html(result);
            $('#mcboClienprop').val(ccliente).trigger("change"); 
        },
        error: function(){
            alert('Error, No se puede autenticar por error');
        }
    });
    
    var params = { "ccliente":ccliente };
    if (accion == 'N'){
        $.ajax({
            type: 'ajax',
            method: 'post',
            url: baseurl+"pt/ctramites/getproputram",
            dataType: "JSON",
            async: true,
            data: params,
            success:function(result)
            {
                $("#mcboNropropu").html(result);
                $('#mcboNropropu').val(idptpropuesta).trigger("change");
            },
            error: function(){
            alert('Error, no se puede cargar la lista desplegable de Nro de Propuesta');
            }
        });
    }else{
        $.ajax({
            type: 'ajax',
            method: 'post',
            url: baseurl+"pt/ctramites/getpropuclie",
            dataType: "JSON",
            async: true,
            data: params,
            success:function(result)
            {
                $("#mcboNropropu").html(result);
                $('#mcboNropropu').val(idptpropuesta).trigger("change");
            },
            error: function(){
            alert('Error, no se puede cargar la lista desplegable de Nro de Propuesta');
            }
        });
    }

    $.ajax({
        type: 'ajax',
        method: 'post',
        url: baseurl+"pt/ctramites/gettipotramite",
        dataType: "JSON",
        async: true,
        success:function(result)
        {
            $('#mcboTipotram').html(result);
            $('#mcboTipotram').val(id_tipotramite).trigger("change");
        },
        error: function(){
            alert('Error, No se puede autenticar por error == Tipo de Tramite');
        }
    });
    
};

$('#modalCreaTram').on('shown.bs.modal', function (e) {
    $('#divProd').hide();
    $('#divDesc').hide();
    $('#divCarta').hide();
    $('#sArchivo').val('N');
    $('#sCarta').val('N');

    $('#mtxtFregtramite').datetimepicker({
        format: 'DD/MM/YYYY',
        daysOfWeekDisabled: [0],
        locale:'es'
    });	

    fechaActualReg();

    $("#mtxtNombarch").prop({readonly:true}); 
});

fechaActualReg = function(){
    var fecha = new Date();		
    var fechatring = ("0" + fecha.getDate()).slice(-2) + "/" + ("0"+(fecha.getMonth()+1)).slice(-2) + "/" +fecha.getFullYear() ;

    $('#mtxtFregtramite').datetimepicker('date', moment(fechatring, 'DD/MM/YYYY') );

};

$("#mcboTipotram").change(function(){
    var v_Tipotram = $('#mcboTipotram').val();

    if (v_Tipotram == 1){
        $('#divProd').hide();
        $('#divDesc').hide();
        $('#divCarta').hide();
    }else if (v_Tipotram == 2){
        $('#divProd').hide();
        $('#divDesc').hide();
        $('#divCarta').hide();
    }else if (v_Tipotram == 3){
        $('#divProd').show();
        $('#divDesc').show();
        $('#divCarta').hide();
    }else if (v_Tipotram == 4){
        $('#divProd').hide();
        $('#divDesc').hide();
        $('#divCarta').show();
    }else{
        $('#divProd').hide();
        $('#divDesc').hide();
        $('#divCarta').hide();
    }
});

$("#mcboClienprop").change(function(){
    var v_RegClie = $('#mcboClienprop').val();
    var v_accion = $('#mhdnAccionTram').val();
    var params = { 
        "ccliente":v_RegClie 
    };

    if(v_accion == 'N'){
        $.ajax({
            type: 'ajax',
            method: 'post',
            url: baseurl+"pt/ctramites/getproputram",
            dataType: "JSON",
            async: true,
            data: params,
            success:function(result)
            {
                $("#mcboNropropu").html(result);	
            },
            error: function(){
            alert('Error, no se puede cargar la lista desplegable de Nro de Propuesta');
            }
        });
    }
});

$("#mtxtArchivotram").click(function(){    
    var ccliente = $('#mcboClienprop').val();
    if(!ccliente){return false};
});

escogerArchivo = function(){    
    var archivoInput = document.getElementById('mtxtArchivotram');
    var archivoRuta = archivoInput.value;
    var extPermitidas = /(.pdf|.docx|.xlsx|.doc|.xls)$/i;
    
    var filename = $('#mtxtArchivotram').val().replace(/.*(\/|\\)/, '');
    $('#mtxtNombarch').val(filename);

    if(!extPermitidas.exec(archivoRuta)){
        alert('Asegurese de haber seleccionado un PDF, DOCX, XSLX');
        archivoInput.value = '';  
        $('#mtxtNombarch').val('');
        return false;
    }      
    $('#sArchivo').val('S');
};

subirArchivo=function(){
    var parametrotxt = new FormData($("#frmCreaTram")[0]);
    var request = $.ajax({
        data: parametrotxt,
        method: 'post',
        url: baseurl+"pt/ctramites/subirArchivo/",
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
        Vtitle = this.respuesta;
        Vtype = 'success';
        sweetalert(Vtitle,Vtype);
        $('#mbtnCCreaTram').click();
    });
};

$("#mtxtCartatram").click(function(){    
    var ccliente = $('#mcboClienprop').val();
    if(!ccliente){return false};
});

escogerCarta = function(){    
    var cartaInput = document.getElementById('mtxtCartatram');
    var cartaRuta = cartaInput.value;
    var extPermitidas = /(.pdf|.docx|.xlsx|.doc|.xls)$/i;
    
    var filename = $('#mtxtCartatram').val().replace(/.*(\/|\\)/, '');
    $('#mtxtNombcarta').val(filename);

    if(!extPermitidas.exec(cartaRuta)){
        alert('Asegurese de haber seleccionado un PDF, DOCX, XSLX');
        archivoInput.value = '';  
        $('#mtxtNombcarta').val('');
        return false;
    }      
    $('#sCarta').val('S');
};

subirCarta=function(){
    var parametrotxt = new FormData($("#frmCreaTram")[0]);
    var request = $.ajax({
        data: parametrotxt,
        method: 'post',
        url: baseurl+"pt/ctramites/subirCarta/",
        dataType: "JSON",
        async: true,
        contentType: false,
        processData: false,
        error: function(){
            alert('Error, no se cargó la carta');
        }
    });
    request.done(function( respuesta ) {              
        subirArchivo();
    });
};
 
$('#frmCreaTram').submit(function(event){
    event.preventDefault();
    
    var request = $.ajax({
        url:$('#frmCreaTram').attr("action"),
        type:$('#frmCreaTram').attr("method"),
        data:$('#frmCreaTram').serialize(),
        error: function(){
            Vtitle = 'No se puede registrar por error';
            Vtype = 'error';
            sweetalert(Vtitle,Vtype);
        }
    });
    request.done(function( respuesta ) {
        var posts = JSON.parse(respuesta);        
        $.each(posts, function() {
            $('#mhdnIdTram').val(this.id_tramite);
            if($('#sCarta').val() == 'S' && $('#mcboTipotram').val() == '4'){
                subirCarta();  
            }else if($('#sArchivo').val() == 'S'){          
                subirArchivo();
            }else{   
                $('#btnBuscar').click();     
                Vtitle = this.respuesta;
                Vtype = 'success';
                sweetalert(Vtitle,Vtype);        
                $('#mbtnCCreaTram').click();
            }   
            $('#sArchivo').val('N');  
            $('#sCarta').val('N');        
        });
    });
});

$('#modalAdjuntar').on('shown.bs.modal', function (e) {
    
});

listarAdjuntar=function(idpttramite,adj_docum,ruta_docum){
    $('#mtxtidpttramite').val(idpttramite);
    $('#mtxtadjnombtram').val(adj_docum);
    $('#mtxtadjrutatram').val(ruta_docum);

    otblAdjuntar = $('#tblAdjuntar').DataTable({  
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
            "url"   : baseurl+"pt/ctramites/getbuscaradjuntos/",
            "type"  : "POST", 
            "data": function ( d ) { 
                d.idpttramite  = idpttramite; 
            },     
            dataSrc : ''        
        },
        'columns'	: [
            {orderable : false, data : 'POS', targets : 0 },
            {data: 'desc_adj', targets: 1 },
            {"orderable": false, 
              render:function(data, type, row){
                return  '<div>'+  
                            '<a href="'+baseurl+row.ruta_adj+'/'+row.nomb_adj+'" target="_blank" class="btn btn-default btn-xs pull-left"><i class="fas fa-cloud-download-alt fa-2x" data-original-title="Descargar" data-toggle="tooltip"></i></a>'+
                        '</div>'   
              }
            },
            {"orderable": false, 
              render:function(data, type, row){
                return  '<div>'+  
                          '<a id="aDelDetAdj" href="'+row.id_tramiteadj+'" title="Eliminar" style="cursor:pointer; color:#FF0000;"><span class="fas fa-trash-alt fa-2x" aria-hidden="true"> </span></a>'+
                        '</div>'   
              }
            }
        ],
    });   
};
 
subirTramadj=function(){
    var archivoInput = document.getElementById('mtxtTramAdj');
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
        var parametrotxt = new FormData($("#frmAdjuntar")[0]);
        var request = $.ajax({
            data: parametrotxt,
            method: 'post',
            url: baseurl+"pt/ctramites/subirTramadj/",
            dataType: "JSON",
            async: true,
            contentType: false,
            processData: false,
            error: function(){
                alert('Error, no se cargó el archivo');
            }
        });
        request.done(function( respuesta ) {      
            $('#frmAdjuntar').trigger("reset");
            otblAdjuntar.ajax.reload(null,false);
        });
    }
};
   
$("body").on("click","#aDelDetAdj",function(event){
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
            $.post(baseurl+"pt/ctramites/deldetadj/", 
            {
                id_tramiteadj   : item,
            },      
            function(data){     
                otblAdjuntar.ajax.reload(null,false); 
                Vtitle = 'Se Elimino Correctamente';
                Vtype = 'success';
                sweetalert(Vtitle,Vtype);      
            });
        }
    }) 
});