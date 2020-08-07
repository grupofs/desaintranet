


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