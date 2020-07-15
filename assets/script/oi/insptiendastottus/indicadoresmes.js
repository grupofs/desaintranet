


$(document).ready(function() {

    $.ajax({
        type: 'ajax',
        method: 'post',
        url: baseurl+"cglobales/getanios",
        dataType: "JSON",
        async: true,
        success:function(result)
        {
            $('#cboAnio').html(result);
        },
        error: function(){
            alert('Error, No se puede autenticar por error');
        }
    });

    $.ajax({
        type: 'ajax',
        method: 'post',
        url: baseurl+"cglobales/getmeses",
        dataType: "JSON",
        async: true,
        success:function(result)
        {
            $('#cboMes').html(result);
        },
        error: function(){
            alert('Error, No se puede autenticar por error');
        }
    });

});
