

$(document).ready(function() {

    /*LLENADO DE COMBOS*/
    $.ajax({
        type: 'ajax',
        method: 'post',
        url: baseurl+"at/capa/cconscapa/getclientecapa",
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

    $('#divtblcapa').show(); 
    $('#divtbltienda').hide();
    $('#divtblparti').hide();
});

$("#cboesttramite").change(function(){
    var v_tipobus = $('#cboesttramite').val();

    if(v_tipobus == 'C'){
        $('#divtblcapa').show(); 
        $('#divtbltienda').hide();
        $('#divtblparti').hide();
    }else if(v_tipobus == 'T'){
        $('#divtblcapa').hide(); 
        $('#divtbltienda').show();
        $('#divtblparti').hide();
    }else if(v_tipobus == 'P'){
        $('#divtblcapa').hide(); 
        $('#divtbltienda').hide();
        $('#divtblparti').show();
    }
});


$("#btnBuscar").click(function (){  
    
    var parametros = {
    };  
});