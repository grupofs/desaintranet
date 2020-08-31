
var otblListAudi;
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
            {"orderable": false, data: 'FAUDITORIA', targets: 2, "class": "col-sm"},
            {"orderable": false, data: 'DAUDITOR', targets: 3, "class": "col-lm"},
            {"orderable": false, data: 'DNROINFORME', targets: 4, "class": "col-xl"},
            {"orderable": false, data: 'DRESULTADO', targets: 5, "class": "col-m"},
            {responsivePriority: 1, "orderable": false, "class": "col-s", 
                render:function(data, type, row){
                    return '<div>'+
                    '<a title="Editar" style="cursor:pointer; color:#3c763d;" onClick="javascript:selAudi(\''+row.cauditoriainspeccion+'\',\''+row.fservicio+'\',\''+row.ccliente+'\',\''+row.cestablecimiento+'\');"><span class="fas fa-edit fa-2x" aria-hidden="true"> </span> </a>'+
                    '</div>'
                }
            },
            {responsivePriority: 1, "orderable": false, "class": "col-s", 
                render:function(data, type, row){
                    return '<div>'+
                    '<a title="Registro" style="cursor:pointer; color:#3c763d;" onClick="javascript:regChecklist(\''+row.cauditoriainspeccion+'\',\''+row.fservicio+'\',\''+row.cchecklist+'\',\''+row.cusuarioconsultor+'\');"><span class="fas fa-external-link-alt fa-2x" aria-hidden="true"> </span> </a>'+
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
    otblListAudi.on( 'order.dt search.dt', function () { 
        otblListAudi.column(0, {search:'applied', order:'applied'}).nodes().each( function (cell, i) {
          cell.innerHTML = i+1;
          } );
    }).draw();  
});