
var otblListctrlprov;
var varfdesde = '%', varfhasta = '%';

$(document).ready(function() {
    
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
        url: baseurl+"at/ctrlprov/cregctrolprov/getcboclieserv",
        dataType: "JSON",
        async: true,
        success:function(result)
        {
            $('#cboclieserv').html(result);
        },
        error: function(){
            alert('Error, No se puede autenticar por error = cboclieserv');
        }
    });
    $.ajax({
        type: 'ajax',
        method: 'post',
        url: baseurl+"at/ctrlprov/cregctrolprov/getcboestado",
        dataType: "JSON",
        async: true,
        success:function(result)
        {
            $('#cboestado').html(result);
        },
        error: function(){
            alert('Error, No se puede autenticar por error = cboestado');
        }
    })
    $.ajax({
        type: 'ajax',
        method: 'post',
        url: baseurl+"at/ctrlprov/cregctrolprov/getcboinspector",
        dataType: "JSON",
        async: true,
        success:function(result)
        {
            $('#cboinspector').html(result);
        },
        error: function(){
            alert('Error, No se puede autenticar por error = cboinspector');
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

$("#cboclieserv").change(function(){

    var select = document.getElementById("cboclieserv"), //El <select>
    value = select.value, //El valor seleccionado
    text = select.options[select.selectedIndex].innerText;
    document.querySelector('#lblCliente').innerText = text;

    var v_cboclieserv = $('#cboclieserv').val();
    var params = { "ccliente":v_cboclieserv };
    $.ajax({
        type: 'ajax',
        method: 'post',
        url: baseurl+"at/ctrlprov/cregctrolprov/getcboprovxclie",
        dataType: "JSON",
        async: true,
        data: params,
        success:function(result){
            $("#cboprovxclie").html(result);  
            $('#cboprovxclie').val('').trigger("change");         
        },
        error: function(){
            alert('Error, No se puede autenticar por error = cboprovxclie');
        }
    });    
});

$("#cboprovxclie").change(function(){

    var v_cboprov = $('#cboprovxclie').val();
    var params = { "cproveedor":v_cboprov };
    $.ajax({
        type: 'ajax',
        method: 'post',
        url: baseurl+"at/ctrlprov/cregctrolprov/getcbomaqxprov",
        dataType: "JSON",
        async: true,
        data: params,
        success:function(result){
            $("#cbomaqxprov").html(result);           
        },
        error: function(){
            alert('Error, No se puede autenticar por error = cbomaqxprov');
        }
    });    
});

$("#btnBuscar").click(function (){
    
    if(varfdesde != '%'){ varfdesde = $('#txtFDesde').val(); }
    if(varfhasta != '%'){ varfhasta = $('#txtFHasta').val(); } 
     
    var groupColumn = 0;   
    otblListctrlprov = $('#tblListctrlprov').DataTable({  
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
            "url"   : baseurl+"at/ctrlprov/cregctrolprov/getbuscarctrlprov/",
            "type"  : "POST", 
            "data": function ( d ) {
                d.ccliente      = $('#cboclieserv').val();
                d.fdesde        = varfdesde; 
                d.fhasta        = varfhasta;   
                d.cclienteprov  = $('#cboprovxclie').val();
                d.cclientemaq   = $('#cbomaqxprov').val();
                d.inspector     = $('#cboinspector').val();  
            },     
            dataSrc : ''        
        },
        'columns'	: [
            {"orderable": false, data: 'desc_gral', targets: 0,"visible": false},
            {"orderable": false, data: 'areacli', targets: 1,"visible": false},
            {"orderable": false, data: 'lineaproc', targets: 2,"visible": false},
            {"orderable": false, data: 'periodo', targets: 3},
            {"orderable": false, data: 'destado', targets: 4},
            {"orderable": false, data: 'finspeccion', targets: 5},
            {"orderable": false, data: 'inspector', targets: 6},
            {"orderable": false, data: 'dinformefinal', targets: 7},
            {"orderable": false, data: 'resultado', targets: 8},
            {"orderable": false, 
              render:function(data, type, row){
                return  '<div>'+  
                    ' <a title="Presentacion" style="cursor:pointer; color:#1646ec;" href="" target="_blank" class="btn btn-outline-secondary btn-sm hidden-xs hidden-sm"><span class="fas fa-cloud-download-alt" aria-hidden="true"> </span> Presentacion</a>'+
                    ' &nbsp; &nbsp;'+
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
            { "targets": [0], "visible": false },
		],
        "drawCallback": function ( settings ) {
            var api = this.api();
            var rows = api.rows( {page:'all'} ).nodes();
            var last = null;
			var grupo, grupo01;
 
            api.column([0], {} ).data().each( function ( ctra, i ) {                
                grupo = api.column(1).data()[i];
                grupo01 = api.column(2).data()[i];
                if ( last !== ctra ) {
                    $(rows).eq( i ).before(
                        '<tr class="group"><td colspan="10" class="subgroup"><strong>'+ctra.toUpperCase()+'</strong></td></tr>'+
                        '<tr class="group"><td colspan="10">Area : '+grupo+'<tab><tab>Linea : '+grupo01+'</td></tr>'
                    ); 
                    last = ctra;
                }
            } );
        } 
    }); 
    otblListctrlprov.column( 1 ).visible( false );   
    otblListctrlprov.column( 2 ).visible( false ); 
    $('#tblListctrlprov tbody').on( 'click', 'tr.group', function () {
        var id = $(this).find("td.subgroup:first-child").text().substr(1,8);
        if(id != ''){
            verInspeccion(id);
        }
        
    } ); 
});

verInspeccion = function(id){
    $("#modalCreainsp").modal('show');

    var parametros = { 
        "idinspeccion":id 
    };
    var request = $.ajax({
        type: 'ajax',
        method: 'post',
        url: baseurl+"at/ctrlprov/cregctrolprov/getrecuperainsp",
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
            
            
        });
    });
};

cargarInspeccion = function(id, idclie, idprov, idmaq, idestable, idarea, idlinea){
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
};