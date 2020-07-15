
var otblListCtrlpermiso, oTable_listavacaciones;

$(document).ready(function() {
    
    cargarEmpleados('0','0');
});
  
$('#cboCia').change(function(){ 
    var v_ccia = $( "#cboCia option:selected").attr("value");
    var params = { 
        "ccia" : v_ccia
    }; 
    $.ajax({
        type: 'ajax',
        method: 'post',
        url: baseurl+"cglobales/getareacia",
        dataType: "JSON",
        async: true,
        data: params,
        success:function(result)
        {
            $('#cboArea').html(result);
        },
        error: function(){
          alert('Error, No se puede autenticar por error');
        }
    });
    cargarEmpleados(v_ccia,'0');
});

$('#cboArea').change(function(){ 
    var v_ccia = $( "#cboCia option:selected").attr("value");
    var v_carea = $( "#cboArea option:selected").attr("value");
    cargarEmpleados(v_ccia,v_carea);
    cargarListaEmpleadosPerm(-1,v_ccia,v_carea);
});

$('#cboEmpleado').change(function(){ 
    var v_idempleado = $( "#cboEmpleado option:selected").attr("value");
    var v_ccia = $( "#cboCia option:selected").attr("value");
    var v_carea = $( "#cboArea option:selected").attr("value");
    cargarListaEmpleadosPerm(v_idempleado,v_ccia,v_carea);
});

cargarEmpleados = function(v_ccia,v_carea){
    
    var params = { 
        "ccia" : v_ccia,
        "carea" : v_carea
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
            $('#cboEmpleado').html(result);
        },
        error: function(){
          alert('Error, No se puede autenticar por error');
        }
    });
}

cargarListaEmpleadosPerm = function(v_idempleado,v_ccia,v_carea){
    otblListCtrlpermiso = $('#tblListCtrlPermisos').DataTable({
        'bJQueryUI'   : true,
        'scrollY'     : '280px',
        'scrollX'     : true,
        'processing'  : true,      
        'bDestroy'    : true,
        'paging'      : false,
        'info'        : true,
        'filter'      : true, 
        'stateSave'   : true,
        'ajax'        : {
            "url"   : baseurl+"adm/rrhh/cctrlpermisos/getlistempleadosperm/",
            "type"  : "POST", 
            "data": function ( d ) { 
                d.id_empleado = v_idempleado;  
                d.ccia = v_ccia;
                d.carea = v_carea;
            },     
            dataSrc : ''        
        },
        dom: 'Bfrtip',
        buttons: [
            'excel'
        ],
        'columns'     : [
            {orderable: false, data: null, targets: 0},
            {"class": "col-xm", data: 'empleado', targets: 1},
            {"class": "col-m", data: 'area', targets: 2},  
            {data: 'fingreso', targets: 3},
            {data: 'fcumplevaca', targets: 4}, 
            {data: 'periodovaca', targets: 5}, 
            {data: 'diasvaca', targets: 6}, 
            {data: 'nro_permcuentavaca', targets: 7}, 
            {data: 'nro_vacaciones', targets: 8}, 
            {data: 'diaspendientes', targets: 9}, 
            {data: 'nro_horasextras', targets: 10}, 
            {data: 'nro_permisos', targets: 11},  
            {data: 'horaspendientes', targets: 12},
            {data: 'nro_descansomedico', targets: 13},                        
            {"orderable": false, 
                render:function(data, type, row){
                    return '<div>' +
                            '    <a onclick="excelResumen(\''+row.id_empleado+'\');" class="btn btn-outline-primary btn-sm hidden-sm"><span class="fas fa-file-excel fa-2x" aria-hidden="true"> </span> REPORTE</a>' +
                            '</div>' ; 
                }
            },                        
            {"orderable": false, 
                render:function(data, type, row){
                    return '<div>' +
                            '    <a  data-original-title="Listar" data-toggle="modal" data-target="#modalvacaciones" onclick="javascript:regVacaciones(\''+row.id_empleado+'\');" class="btn btn-outline-primary btn-sm hidden-sm"><span class="fa fa-briefcase fa-2x" aria-hidden="true"> </span> VACACIONES</a>' +
                            '</div>' ; 
                }
            },                        
            {"orderable": false, 
                render:function(data, type, row){
                    return '<div>' +
                            '    <a data-original-title="Listar" data-toggle="modal" data-target="#modalpermisos" onclick="javascript:regPermisos(\''+row.id_empleado+'\');" class="btn btn-outline-primary btn-sm hidden-sm"><span class="fas fa-ticket-alt fa-2x" aria-hidden="true"> </span> PERMISOS</a>' +
                            '</div>' ; 
                }
            },                        
            {"orderable": false, 
                render:function(data, type, row){
                    return '<div>' +
                            '    <a data-original-title="Listar" data-toggle="modal" data-target="#modalHorasextras" onclick="javascript:regHorasextras(\''+row.id_empleado+'\');" class="btn btn-outline-primary btn-sm hidden-sm"><span class="fab fa-safari fa-2x" aria-hidden="true"> </span> HORAS-EXT</a>' +
                            '</div>' ; 
                }
            },                        
            {"orderable": false, 
                render:function(data, type, row){
                    return '<div>' +
                            '    <a data-original-title="Listar" data-toggle="modal" data-target="#modalDescansomedico" onclick="javascript:regDescansomedico(\''+row.id_empleado+'\');" class="btn btn-outline-primary btn-sm hidden-sm"><span class="fa fa-ambulance fa-2x" aria-hidden="true"> </span> DES-MEDIC</a>' +
                            '</div>' ; 
                }
            }
        ], 
        "columnDefs": [
            {
                "defaultContent": " ",
                "targets": "_all"
            }
        ],
        'order' : [[2, "asc"],[1, "asc"]] 
    });
    // Enumeracion 
    otblListCtrlpermiso.on( 'order.dt search.dt', function () { 
        otblListCtrlpermiso.column(0, {search:'applied', order:'applied'}).nodes().each( function (cell, i) {
          cell.innerHTML = i+1;
        } );
    }).draw();
}
    
excelResumen = function(id_empleado){
    window.open(baseurl+"adm/rrhh/cctrlpermisos/excelresumenperm/"+id_empleado);
};

regVacaciones = function(id_empleado){    
	$('#mhdnIdEmpleado').val(id_empleado);
};

$('#modalvacaciones').on('show.bs.modal', function (e) {

    $('#tabvacaciones a[href="#tab_listavacacionestab"]').attr('class', 'disabled');
    $('#tabvacaciones a[href="#tab_newvacacionestab"]').attr('class', 'disabled active');

    $('#tabvacaciones a[href="#tab_listavacacionestab"]').not('#store-tab.disabled').click(function(event){
        $('#tabvacaciones a[href="#tabinforme-list"]').attr('class', 'active');
        $('#tabvacaciones a[href="#tab_newvacaciones"]').attr('class', '');
        return true;
    });
    $('#tabvacaciones a[href="#tab_newvacacionestab"]').not('#bank-tab.disabled').click(function(event){
        $('#tabvacaciones a[href="#tab_newvacaciones"]').attr('class' ,'active');
        $('#tabvacaciones a[href="#tab_listavacaciones"]').attr('class', '');
        return true;
    });
    
    $('#tabvacaciones a[href="#tab_listavacaciones"]').click(function(event){return false;});
    $('#tabvacaciones a[href="#tab_newvacaciones"]').click(function(event){return false;});
	
    $('#tabvacaciones a[href="#tab_listavacaciones"]').tab('show');
    
    listarVacaciones();

    $('#mtxtFsalidavaca').datetimepicker({
        format: 'DD/MM/YYYY',
        daysOfWeekDisabled: [0],
        locale:'es'
    });	

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

	$('#btnNuevoVaca').click(function(){		
		$('#tabvacaciones a[href="#tab_newvacaciones"]').tab('show');
		$('#frmMantVacaciones').trigger("reset");
		$('#mhdnIdVaca').val('');
		$('#mhdnAccionVaca').val('N');
		$('#mhdnIdEmpvaca').val($('#mhdnIdEmpleado').val());
        fechaActualvaca();

	});

	$('#btnRetornarVaca').click(function(){
		$('#tabvacaciones a[href="#tab_listavacaciones"]').tab('show');  
	});

    $('#frmMantVacaciones').submit(function(event){
        event.preventDefault();

        $.ajax({
            url:$('#frmMantVacaciones').attr("action"),
            type:$('#frmMantVacaciones').attr("method"),
            data:$('#frmMantVacaciones').serialize(),
            success: function (respuesta){            
                Vtitle = 'Se Grabo Correctamente';
                Vtype = 'success';
                sweetalert(Vtitle,Vtype);                
				listarVacaciones();
				$('#tabvacaciones a[href="#tab_listavacaciones"]').tab('show'); 
            },
            error: function(){
                Vtitle = 'No se puede Grabar por error';
                Vtype = 'error';
                sweetalert(Vtitle,Vtype); 
            }
        });
    });
	
});

fechaActualvaca= function(){
    var fecha = new Date();		
    var fechatring = ("0" + fecha.getDate()).slice(-2) + "/" + ("0"+(fecha.getMonth()+1)).slice(-2) + "/" +fecha.getFullYear() ;
    
    $('#mtxtFregistrovaca').val(fechatring);
    $('#mtxtFsalidavaca').datetimepicker('date', moment(fechatring, 'DD/MM/YYYY') );		
    $("#mtxtFsalidavaca").trigger("change.datetimepicker");
};

listarVacaciones = function(){        
    oTable_listavacaciones = $('#tblVacaciones').DataTable({
        'bJQueryUI'     : true,
        'scrollY'     	: '200px',
        'scrollX'     	: true, 
        'paging'      	: false,
        'processing'  	: true,      
        'bDestroy'    	: true,
        'info'        	: true,
        'filter'      	: false, 
        "ordering"		: false,  
        'stateSave'     : true, 
        'ajax'        : {
            "url"   : baseurl+"adm/rrhh/cctrlpermisos/getlistvacaciones/",
            "type"  : "POST", 
            "data": function ( d ) { 
                d.id_empleado     = $('#mhdnIdEmpleado').val(); 
            },     
            dataSrc : ''        
        },
        'columns'     : [
            {"orderable": false, data: 'fsalida', targets: 0},
            {"orderable": false, data: 'fecha_retorno', targets: 1},
            {"orderable": false, data: 'diastomados', targets: 2},
            {"orderable": false, data: 'fundamentacion', targets: 3},                        
            {"orderable": false, 
                render:function(data, type, row){
                    return '<div>' +
                            '<a title="Editar" style="cursor:pointer; color:#3c763d;" onclick="javascript:seleVacaciones(\''+row.id_permisosvacaciones+'\',\''+row.id_empleado+'\',\''+row.fecha_registro+'\',\''+row.fecha_salida+'\',\''+row.fecha_retorno+'\',\''+row.fundamentacion+'\');"><span class="fas fa-edit fa-2x" aria-hidden="true"> </span> </a>' +
                            '</div>' ; 
                }
            },                        
            {"orderable": false, 
                render:function(data, type, row){
                    return '<div>' +
                            '<a id="aDelVaca" href="'+row.id_permisosvacaciones+'" title="Eliminar" style="cursor:pointer; color:#FF0000;"><span class="fas fa-trash-alt fa-2x" aria-hidden="true"> </span></a>'+
                            '</div>' ; 
                }
            }            
        ],
        columnDefs: [ {
            targets: 0,
            render: $.fn.dataTable.render.moment( 'YYYY-MM-DD', 'DD/MM/YYYY' )
          } ]        
    });
};

seleVacaciones = function(id_permisosvacaciones,id_empleado,fecha_registro,fecha_salida,fecha_retorno,fundamentacion){
    $('#tabvacaciones a[href="#tab_newvacaciones"]').tab('show'); 

    $('#mhdnIdVaca').val(id_permisosvacaciones);
    $('#mhdnAccionVaca').val('A'); 
    $('#mhdnEmpVaca').val(id_empleado);

    $('#mtxtFregistrovaca').val(fecha_registro);         
    $('#mtxtFsalvaca').val(fecha_salida);        
    $('#mtxtFretovaca').val(fecha_retorno);        
    $('#mtxtFundamentovaca').val(fundamentacion);    
};

regPermisos = function(id_empleado){    
	$('#mhdnIdEmpleado').val(id_empleado);
};

$('#modalpermisos').on('show.bs.modal', function (e) {

    $('#tabpermisos a[href="#tab_listapermisostab"]').attr('class', 'disabled');
    $('#tabpermisos a[href="#tab_newpermisostab"]').attr('class', 'disabled active');

    $('#tabpermisos a[href="#tab_listapermisostab"]').not('#store-tab.disabled').click(function(event){
        $('#tabpermisos a[href="#tabinforme-list"]').attr('class', 'active');
        $('#tabpermisos a[href="#tab_newpermisos"]').attr('class', '');
        return true;
    });
    $('#tabpermisos a[href="#tab_newpermisostab"]').not('#bank-tab.disabled').click(function(event){
        $('#tabpermisos a[href="#tab_newpermisos"]').attr('class' ,'active');
        $('#tabpermisos a[href="#tab_listapermisos"]').attr('class', '');
        return true;
    });
    
    $('#tabpermisos a[href="#tab_listapermisos"]').click(function(event){return false;});
    $('#tabpermisos a[href="#tab_newpermisos"]').click(function(event){return false;});
	
    $('#tabpermisos a[href="#tab_listapermisos"]').tab('show');
    
    listarPermisos();

    $('#mtxtFsalidavaca').datetimepicker({
        format: 'DD/MM/YYYY',
        daysOfWeekDisabled: [0],
        locale:'es'
    });	

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

	$('#btnNuevoVaca').click(function(){		
		$('#tabpermisos a[href="#tab_newpermisos"]').tab('show');
		$('#frmMantPermisos').trigger("reset");
		$('#mhdnIdVaca').val('');
		$('#mhdnAccionVaca').val('N');
		$('#mhdnIdEmpvaca').val($('#mhdnIdEmpleado').val());
        fechaActualvaca();

	});

	$('#btnRetornarVaca').click(function(){
		$('#tabpermisos a[href="#tab_listapermisos"]').tab('show');  
	});

    $('#frmMantPermisos').submit(function(event){
        event.preventDefault();

        $.ajax({
            url:$('#frmMantPermisos').attr("action"),
            type:$('#frmMantPermisos').attr("method"),
            data:$('#frmMantPermisos').serialize(),
            success: function (respuesta){            
                Vtitle = 'Se Grabo Correctamente';
                Vtype = 'success';
                sweetalert(Vtitle,Vtype);                
				listarPermisos();
				$('#tabpermisos a[href="#tab_listapermisos"]').tab('show'); 
            },
            error: function(){
                Vtitle = 'No se puede Grabar por error';
                Vtype = 'error';
                sweetalert(Vtitle,Vtype); 
            }
        });
    });
	
});

fechaActualvaca= function(){
    var fecha = new Date();		
    var fechatring = ("0" + fecha.getDate()).slice(-2) + "/" + ("0"+(fecha.getMonth()+1)).slice(-2) + "/" +fecha.getFullYear() ;
    
    $('#mtxtFregistrovaca').val(fechatring);
    $('#mtxtFsalidavaca').datetimepicker('date', moment(fechatring, 'DD/MM/YYYY') );		
    $("#mtxtFsalidavaca").trigger("change.datetimepicker");
};

listarPermisos = function(){        
    oTable_listapermisos = $('#tblPermisos').DataTable({
        'bJQueryUI'     : true,
        'scrollY'     	: '200px',
        'scrollX'     	: true, 
        'paging'      	: false,
        'processing'  	: true,      
        'bDestroy'    	: true,
        'info'        	: true,
        'filter'      	: false, 
        "ordering"		: false,  
        'stateSave'     : true, 
        'ajax'        : {
            "url"   : baseurl+"adm/rrhh/cctrlpermisos/getlistpermisos/",
            "type"  : "POST", 
            "data": function ( d ) { 
                d.id_empleado     = $('#mhdnIdEmpleado').val(); 
            },     
            dataSrc : ''        
        },
        'columns'     : [
            {"orderable": false, data: 'fsalida', targets: 0},
            {"orderable": false, data: 'horapermisos', targets: 1},
            {"orderable": false, data: 'horasuso', targets: 2},                        
            {"orderable": false, 
                render:function(data, type, row){
                    return '<div>' +
                            '<a title="Editar" style="cursor:pointer; color:#3c763d;" onclick="javascript:selePermisos(\''+row.id_permisospermisos+'\',\''+row.id_empleado+'\',\''+row.fecha_registro+'\',\''+row.fechasalida+'\',\''+row.fecha_retorno+'\',\''+row.fundamentacion+'\');"><span class="fas fa-edit fa-2x" aria-hidden="true"> </span> </a>' +
                            '</div>' ; 
                }
            },                        
            {"orderable": false, 
                render:function(data, type, row){
                    return '<div>' +
                            '<a id="aDelVaca" href="'+row.id_permisospermisos+'" title="Eliminar" style="cursor:pointer; color:#FF0000;"><span class="fas fa-trash-alt fa-2x" aria-hidden="true"> </span></a>'+
                            '</div>' ; 
                }
            }            
        ],
        columnDefs: [ {
            targets: 0,
            render: $.fn.dataTable.render.moment( 'YYYY-MM-DD', 'DD/MM/YYYY' )
          } ]        
    });
};

selePermisos = function(id_permisosvacaciones,id_empleado,fecha_registro,fecha_salida,fecha_retorno,fundamentacion){
    $('#tabpermisos a[href="#tab_newpermisos"]').tab('show'); 

    $('#mhdnIdVaca').val(id_permisosvacaciones);
    $('#mhdnAccionVaca').val('A'); 
    $('#mhdnEmpVaca').val(id_empleado);

    $('#mtxtFregistrovaca').val(fecha_registro);         
    $('#mtxtFsalvaca').val(fecha_salida);        
    $('#mtxtFretovaca').val(fecha_retorno);        
    $('#mtxtFundamentovaca').val(fundamentacion);    
};
