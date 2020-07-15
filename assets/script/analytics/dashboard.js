

var otblListaextras, otblListapermisos, otblListavacaciones; 

$(document).ready(function() {
    
    vccia = $('#hdnccia').val();

    $('#modalCuadroPermisos > .modal-body').css({width:'auto',height:'auto', 'max-height':'100%'});
    $('#modalCuadroVacaciones > .modal-body').css({width:'auto',height:'auto', 'max-height':'100%'});        
});

$(document).on('shown.bs.modal', function (e) {
    $.fn.dataTable.tables( {visible: true, api: true} ).columns.adjust();
});

// PERMISOS
$('#modalCuadroPermisos').on('shown.bs.modal', function (e) {	

    otblListaextras = $('#tblListaextras').DataTable({
        'scrollY'     	: '250px',
        'scrollX'     	: true, 
        'paging'      	: false,
        'processing'  	: true,      
        'bDestroy'    	: true,
        'info'        	: true,
        'filter'      	: false, 
        "ordering"		: false, 
        'ajax'	: {
            "url"   : baseurl+"adm/crecursoshumanos/getlisthorasextras/",
            "type"  : "POST", 
            "data": function ( d ) {
                d.id_empleado = $('#hdidempleado').val();    
            },     
            dataSrc : ''        
        },
        'columns'	: [
            {"orderable": false, data: 'fecha_salida', targets: 0},
            {"orderable": false, data: 'horaextra', targets: 1},
            {"orderable": false, data: 'totalhoras', targets: 2}
        ]
    });
    
    otblListapermisos = $('#tblListapermisos').DataTable({
        'scrollY'     	: '250px',
        'scrollX'     	: true, 
        'paging'      	: false,
        'processing'  	: true,      
        'bDestroy'    	: true,
        'info'        	: true,
        'filter'      	: false, 
        "ordering"		: false, 
        'ajax'	: {
            "url"   : baseurl+"adm/crecursoshumanos/getlistpermisos/",
            "type"  : "POST", 
            "data": function ( d ) {
                d.id_empleado = $('#hdidempleado').val();    
            },     
            dataSrc : ''        
        },
        'columns'	: [
            {"orderable": false, data: 'fecha_salida', targets: 0},
            {"orderable": false, data: 'horapermisos', targets: 1},
            {"orderable": false, data: 'horasuso', targets: 2}
        ]
    });
});

$('#modalRegPermisos').on('shown.bs.modal', function (e) {
    $('#mtxtFsalidaperm').datetimepicker({
        format: 'DD/MM/YYYY',
        daysOfWeekDisabled: [0],
        locale:'es'
    });

    $('#mtxtHsalidaperm, #mtxtHretornoperm').datetimepicker({
        format: 'hh:mm A',
        locale:'es',
        stepping: 15
    });		

    $('#frmRegPermiso').trigger("reset");
    $('#mhdnAccionperm').val('N');
    $("#mcboMotivo").val("").trigger("change");
    $("#cboRecuperahora").val("S").trigger("change");

    fechaActualperm();	

});

fechaActualperm = function(){
    var fecha = new Date();		
    var fechatring = ("0" + fecha.getDate()).slice(-2) + "/" + ("0"+(fecha.getMonth()+1)).slice(-2) + "/" +fecha.getFullYear() ;

    $('#mtxtFregistroperm').val(fechatring);
    $('#mtxtFsalidaperm').datetimepicker('date', moment(fechatring, 'DD/MM/YYYY') );

    $('#mtxtHsalidaperm').datetimepicker('minDate', moment('08:00 AM', 'hh:mm A') );
    $('#mtxtHsalidaperm').datetimepicker('maxDate', moment('05:45 PM', 'hh:mm A') );
    $('#mtxtHsalidaperm').datetimepicker('date', moment('08:00 AM', 'hh:mm A') );
    
    $('#mtxtHretornoperm').datetimepicker('date', moment('08:15 AM', 'hh:mm A') );
    
    $("#mtxtFsalidaperm").trigger("change.datetimepicker");
};

$('#mtxtFsalidaperm').on('change.datetimepicker',function(e){	
    
    $('#mtxtFrecupera').datetimepicker({
        format: 'DD/MM/YYYY',
        daysOfWeekDisabled: [0],
        locale:'es'
    });	

    var fecha = moment(e.date).format('DD/MM/YYYY');		
    
    $('#mtxtFrecupera').datetimepicker('minDate', fecha);
    $('#mtxtFrecupera').datetimepicker('date', fecha);
});

$('#mtxtHsalidaperm').on('change.datetimepicker',function(e){
    
    $('#mtxtHretornoperm').datetimepicker('minDate', e.date.add(15, "minute"));
    $('#mtxtHretornoperm').datetimepicker('maxDate', moment('06:00 PM', 'hh:mm A') );
    $('#mtxtHretornoperm').datetimepicker('date', moment(e.date, 'hh:mm A'));	
    
});

$.validator.setDefaults( {
    submitHandler: function () {
                
        var request = $.ajax({
            url:$('#frmRegPermiso').attr("action"),
            type:$('#frmRegPermiso').attr("method"),
            data:$('#frmRegPermiso').serialize(),
            error: function(){
                Vtitle = 'Error, No se puede autenticar por error :: frmRegPermiso';
                Vtype = 'error';
                sweetalert(Vtitle,Vtype);
            }
        });
        request.done(function( respuesta ) {
            var posts = JSON.parse(respuesta);
            
            $.each(posts, function() {					
                emailValidar(this.emailrespomsable,'P',this.token,this.idusuario,this.idempleado,this.idpermisosvacaciones,this.ccia); 
                $('#mbtnCPermiso').click();	
                Vtitle = 'Conforme, Se registro correctamente!!!';
                Vtype = 'success';
                sweetalert(Vtitle,Vtype);
                //location.reload();
            });
        });
    }
} );

$('#frmRegPermiso').submit(function(event){
    event.preventDefault();	
}).validate({	
    rules: {
        mcboMotivo: "required",
        mtxtFundamentoperm: "required"
    },
    messages: {
        mcboMotivo: "Seleccione un motivo.",
        mtxtFundamentoperm: "Fundamente su permiso."
    },
    errorElement: 'span',
    errorPlacement: function ( error, element ) {
        event.preventDefault();
        error.addClass('invalid-feedback');
        element.closest('.form-group').append(error);
    },
    highlight: function ( element, errorClass, validClass ) {
        $(element).addClass('is-invalid');
    },
    unhighlight: function (element, errorClass, validClass) {
        $(element).removeClass('is-invalid');
    }		
});
// 


// VACACIONES	
$('#modalCuadroVacaciones').on('shown.bs.modal', function (e) {		
    
    otblListavacaciones = $('#tblListacaciones').DataTable({  
        'scrollY'     	: '250px',
        'scrollX'     	: true, 
        'paging'      	: false,
        'processing'  	: true,      
        'bDestroy'    	: true,
        'info'        	: true,
        'filter'      	: false, 
        "ordering"		: false, 
        'ajax'	: {
            "url"   : baseurl+"adm/crecursoshumanos/getlistvacaciones/",
            "type"  : "POST", 
            "data": function ( d ) {
                d.id_empleado = $('#hdidempleado').val();    
            },     
            dataSrc : ''        
        },
        'columns'	: [
            {"orderable": false, data: 'fecha_salida', targets: 0},
            {"orderable": false, data: 'fecha_retorno', targets: 1},
            {"orderable": false, data: 'diastomados', targets: 2},
            {"orderable": false, data: 'fundamentacion', targets: 3}
        ]
    });
});

$('#modalRegVacaciones').on('shown.bs.modal', function (e) {
    $('#mtxtFsalidavaca').datetimepicker({
        format: 'DD/MM/YYYY',
        daysOfWeekDisabled: [0],
        locale:'es'
    });	

    $('#frmRegVacaciones').trigger("reset");
    $('#mhdnAccionvaca').val('N');

    fechaActualvaca();	

});

fechaActualvaca= function(){
    var fecha = new Date();		
    var fechatring = ("0" + fecha.getDate()).slice(-2) + "/" + ("0"+(fecha.getMonth()+1)).slice(-2) + "/" +fecha.getFullYear() ;
    
    $('#mtxtFregistrovaca').val(fechatring);
    $('#mtxtFsalidavaca').datetimepicker('date', moment(fechatring, 'DD/MM/YYYY') );		
    $("#mtxtFsalidavaca").trigger("change.datetimepicker");
};

$('#mtxtFsalidavaca').on('change.datetimepicker',function(e){	
    
    $('#mtxtFretornovaca').datetimepicker({
        format: 'DD/MM/YYYY',
        daysOfWeekDisabled: [0],
        locale:'es'
    });	

    var fecha = moment(e.date).format('DD/MM/YYYY');

    var newDate = moment(e.date);
    newDate.add(1, 'days');
    
    $('#mtxtFretornovaca').datetimepicker('minDate', newDate);
    $('#mtxtFretornovaca').datetimepicker('date', fecha);
});

$.validator.setDefaults( {
    submitHandler: function () {
                
        var request = $.ajax({
            url:$('#frmRegVacaciones').attr("action"),
            type:$('#frmRegVacaciones').attr("method"),
            data:$('#frmRegVacaciones').serialize(),
            error: function(){
                Vtitle = 'Error, No se puede autenticar por error :: frmRegVacaciones';
                Vtype = 'error';
                sweetalert(Vtitle,Vtype);
            }
        });
        request.done(function( respuesta ) {
            var posts = JSON.parse(respuesta);
            
            $.each(posts, function() {
                Vtitle = 'Conforme, Se registro correctamente!!!';
                Vtype = 'success';
                sweetalert(Vtitle,Vtype);
                $('#mbtnCVacaciones').click();	 
            });
        });
    }
} );

$('#frmRegVacaciones').submit(function(event){
    event.preventDefault();	
}).validate({	
    rules: {
        mtxtFundamentovaca: "required"
    },
    messages: {
        mtxtFundamentovaca: "Agregue un comentario."
    },
    errorElement: 'span',
    errorPlacement: function ( error, element ) {
        event.preventDefault();
        error.addClass('invalid-feedback');
        element.closest('.form-group').append(error);
    },
    highlight: function ( element, errorClass, validClass ) {
        $(element).addClass('is-invalid');
    },
    unhighlight: function (element, errorClass, validClass) {
        $(element).removeClass('is-invalid');
    }		
}); 
// 


// EXTRAS	
$('#modalRegExtras').on('shown.bs.modal', function (e) {
    $('#mtxtFregistroextra').trigger("reset");
    $('#mhdnAccionextra').val('N');

    fechaActualextra();	

});

fechaActualextra= function(){
    var fecha = new Date();		
    var fechatring = ("0" + fecha.getDate()).slice(-2) + "/" + ("0"+(fecha.getMonth()+1)).slice(-2) + "/" +fecha.getFullYear() ;
    var hora = moment().format('hh:mm A');
    alert(hora);
    $('#mtxtFregistroextra').val(fechatring);
};
// 
   
emailValidar = function(emailrespomsable,tipo,token,idusuario,idempleado,idpermisosvacaciones,ccia){
    $.post(baseurl+"adm/crecursoshumanos/sendEmailValidarPerm",
    {
        emailrespomsable		:	emailrespomsable,
        tipo					:   tipo,
        token					:   token,
        idusuario				:   idusuario,
        idempleado 				:   idempleado,
        idpermisosvacaciones 	:   idpermisosvacaciones,
        ccia					:	ccia
    },
    function(data){   
        var c = JSON.parse(data);
        $.each(c,function(i,item){
            Vtitle = 'Conforme, Se envio el Email correctamente!!!';
            Vtype = 'success';
            sweetalert(Vtitle,Vtype);  
        })
    });
};


