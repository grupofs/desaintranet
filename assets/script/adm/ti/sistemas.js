
var oTable_listamodulo, oTable_listaopcion, oTable_listarol, oTable_listaperm;

$(document).ready(function () {
    
});


/*MODULOS*/
    listarModulos = function(){
        oTable_listamodulo = $('#tablalistaModulos').DataTable({
            'bJQueryUI'     : true,
            'scrollY'     	: '280px',
            'scrollX'     	: true, 
            'paging'      	: true,
            'processing'  	: true,      
            'bDestroy'    	: true,
            'info'        	: true,
            'filter'      	: true, 
            "ordering"		: false,  
            'stateSave'     : true,  
            'ajax'        : {
                "url"   : baseurl+"adm/ti/csistemas/getlistarmodulos/",
                "type"  : "POST", 
                "data"  : function (d) {  
                },     
                dataSrc : ''        
            },
            'columns'     : [
                {
                "class"     :   "index",
                orderable   :   false,
                data        :   null,
                targets     :   0
                },
                {data: 'CIA', targets: 1},
                {data: 'id_modulo',targets: 2},
                {data: 'desc_modulo', targets: 3},
                {data: 'TIPO', targets: 4},                           
                {"orderable": false, 
                    render:function(data, type, row){
                        return '<div>' + 
                            '<a title="Editar" style="cursor:pointer; color:#3c763d;" onclick="javascript:seleModulo(\''+row.id_modulo+'\',\''+row.ccompania+'\',\''+row.carea+'\',\''+row.desc_modulo+'\',\''+row.tipo_modulo+'\',\''+row.class_icono+'\');"><span class="fas fa-edit" aria-hidden="true"> </span> </a>' +
                            '</div>' ; 
                    }
                }
            ],
            "columnDefs": [{
                "targets": [3], 
                "data": null, 
                "render": function(data, type, row) { 
                    return '<p><i class="'+row.class_icono+'">&nbsp;</i>&nbsp;'+row.desc_modulo+'<p>';
                }
            }]
        });
        // Enumeracion 
        oTable_listamodulo.on( 'order.dt search.dt', function () { 
            oTable_listamodulo.column(0, {search:'applied', order:'applied'}).nodes().each( function (cell, i) {
            cell.innerHTML = i+1;
            } );
        }).draw();  
    };

    $('#collapseModulo').on('show.bs.collapse', function () {
        listarModulos();
    });

    $('#cboCia').change(function(){ 
        var v_idcia = $( "#cboCia option:selected").attr("value");
        var v_idarea = "0";        
        
        cambiarCboAreaCia(v_idcia,v_idarea);
    });

    cambiarCboAreaCia = function(v_idcia,v_idarea){
        var params = { "ccia" : v_idcia};
        
        $.ajax({
            type: 'ajax',
            method: 'post',
            url: baseurl+"cglobales/getareacia",
            dataType: "JSON",
            async: true,
            data: params,
            success:function(result)
            {
                $('#mcboArea').html(result);
                $("#mcboArea").val(v_idarea).trigger("change");   
            },
            error: function(){
            alert('Error, No se puede autenticar por error');
            }
        }); 
    };

    seleModulo = function(id_modulo,ccompania,carea,desc_modulo,tipo_modulo,class_icono){   
        $('#mhdnIdmodulo').val(id_modulo);   
        $('#cboCia').val(ccompania);     
        $('#mtxtDescrMod').val(desc_modulo);    
        $('#cbotipo').val(tipo_modulo);
        $('#mtxticono').val(class_icono);     

        $('#mhdnAccionMod').val('A');
        
        cambiarCboAreaCia(ccompania,carea);    
    };

    $('#frmRegModulo').submit(function(event){
        event.preventDefault();

        $.ajax({
            url:$('#frmRegModulo').attr("action"),
            type:$('#frmRegModulo').attr("method"),
            data:$('#frmRegModulo').serialize(),
            success: function (respuesta){            
                oTable_listamodulo.ajax.reload(null,false);
                Vtitle = 'Se Grabo Correctamente';
                Vtype = 'success';
                sweetalert(Vtitle,Vtype);
                $('#btnNuevoMod').click();  
            },
            error: function(){
                Vtitle = 'No se puede Grabar por error';
                Vtype = 'error';
                sweetalert(Vtitle,Vtype); 
            }
        });
    });

    $('#btnNuevoMod').click(function(){
        $('#frmRegModulo').trigger("reset");
        $('#mhdnIdmodulo').val(''); 
        $('#mhdnAccionMod').val('N');
        $('#cboCia').val('0').change();
    });

/*OPCIONES*/
    listarOpciones = function(){        
        oTable_listaopcion = $('#tablalistaOpcion').DataTable({
            'bJQueryUI'     : true,
            'scrollY'     	: '280px',
            'scrollX'     	: true, 
            'paging'      	: true,
            'processing'  	: true,      
            'bDestroy'    	: true,
            'info'        	: true,
            'filter'      	: true, 
            "ordering"		: false,  
            'stateSave'     : true, 
            'ajax'        : {
                "url"   : baseurl+"adm/ti/csistemas/getlistaropciones/",
                "type"  : "POST", 
                "data": function ( d ) {  
                },     
                dataSrc : ''        
            },
            'columns'     : [
                {
                "class"     :   "index",
                orderable   :   false,
                data        :   null,
                targets     :   0
                },
                {data: 'CIA', targets: 1},
                {data: 'desc_modulo', targets: 2},
                {data: 'id_opcion',targets: 3 },
                {data: 'desc_opcion', targets: 4},                          
                {"orderable": false, 
                    render:function(data, type, row){
                        return '<div>' +
                                '<a title="Editar" style="cursor:pointer; color:#3c763d;" onclick="javascript:seleOpcion(\''+row.id_opcion+'\',\''+row.id_modulo+'\',\''+row.desc_opcion+'\',\''+row.ccompania+'\',\''+row.vista_opcion+'\',\''+row.script_opcion+'\');"><span class="fas fa-edit" aria-hidden="true"> </span> </a>' +
                                '</div>' ; 
                    }
                }
            ],         
        });
        // Enumeracion 
        oTable_listaopcion.on( 'order.dt search.dt', function () { 
            oTable_listaopcion.column(0, {search:'applied', order:'applied'}).nodes().each( function (cell, i) {
            cell.innerHTML = i+1;
            } );
        }).draw();  
    };

    $('#collapseOpcion').on('show.bs.collapse', function () {
        listarOpciones();
    });

    $('#cboCiaopc').change(function(){ 
        var v_idcia = $( "#cboCiaopc option:selected").attr("value");
        var v_idmodulo = "";        
        
        cambiarCboModuloCia(v_idcia,v_idmodulo);
    });

    cambiarCboModuloCia = function(v_idcia,v_idmodulo){
        var params = { "ccia" : v_idcia};
        
        $.ajax({
            type: 'ajax',
            method: 'post',
            url: baseurl+"adm/ti/csistemas/getmoduloxcia",
            dataType: "JSON",
            async: true,
            data: params,
            success:function(result)
            {
                $('#cboModulo').html(result);
                $("#cboModulo").val(v_idmodulo).trigger("change");   
            },
            error: function(){
            alert('Error, No se puede autenticar por error');
            }
        }); 
    };

    seleOpcion = function(id_opcion,id_modulo,desc_opcion,ccompania,vista_opcion,script_opcion){
        $('#mhdnIdopcion').val(id_opcion);
        $('#mhdnAccionOpc').val('A');                     
        $('#cboModulo').val(id_modulo).trigger("change");                   
        $('#mtxtDescOpc').val(desc_opcion);        
        $('#mtxtVentana').val(vista_opcion);     
        $('#mtxtJavascript').val(script_opcion);
        $('#cboCiaopc').val(ccompania).trigger("change");
        
        
        cambiarCboModuloCia(ccompania,id_modulo);
    };

    $('#frmRegOpcion').submit(function(event){
        event.preventDefault();

        $.ajax({
            url:$('#frmRegOpcion').attr("action"),
            type:$('#frmRegOpcion').attr("method"),
            data:$('#frmRegOpcion').serialize(),
            success: function (respuesta){
                oTable_listaopcion.ajax.reload(null,false);
                Vtitle = 'Se Grabo Correctamente';
                Vtype = 'success';
                sweetalert(Vtitle,Vtype);  
                $('#btnNuevoOpc').click(); 
            },
            error: function(){          
                Vtitle = 'No se puede Grabar por error';
                Vtype = 'error';
                sweetalert(Vtitle,Vtype); 
            }
        });
    });

    $('#btnNuevoOpc').click(function(){
        $('#frmRegOpcion').trigger("reset");
        $('#mhdnIdopcion').val('');
        $('#mhdnAccionOpc').val('N'); 
        $('#cboCiaopc').val('0').change();
        $('#cboModulo').val('').change();
    });

/*ROLES*/
    listarRol = function(){        
        oTable_listarol = $('#tablalistaRol').DataTable({
            'bJQueryUI'     : true,
            'scrollY'     	: '280px',
            'scrollX'     	: true, 
            'paging'      	: true,
            'processing'  	: true,      
            'bDestroy'    	: true,
            'info'        	: true,
            'filter'      	: true, 
            "ordering"		: false,  
            'stateSave'     : true, 
            'ajax'        : {
                "url"   : baseurl+"adm/ti/csistemas/getlistarroles/",
                "type"  : "POST", 
                "data": function ( d ) {  
                },     
                dataSrc : ''        
            },
            'columns'     : [
                {
                "class"     :   "index",
                orderable   :   false,
                data        :   null,
                targets     :   0
                },
                {data: 'CIA', targets: 1},
                {data: 'desc_rol', targets: 2},                         
                {"orderable": false, 
                    render:function(data, type, row){
                        return '<div>' +
                                '<a title="Editar" style="cursor:pointer; color:#3c763d;" onclick="javascript:seleRol(\''+row.id_rol+'\',\''+row.desc_rol+'\',\''+row.ccompania+'\',\''+row.comentarios+'\');"><span class="fas fa-edit" aria-hidden="true"> </span> </a>' +
                                '</div>' ; 
                    }
                }
            ],         
        });
        // Enumeracion 
        oTable_listarol.on( 'order.dt search.dt', function () { 
            oTable_listarol.column(0, {search:'applied', order:'applied'}).nodes().each( function (cell, i) {
            cell.innerHTML = i+1;
            } );
        }).draw();  
    };

    $('#collapseRol').on('show.bs.collapse', function () {
        listarRol();
    });

    seleRol = function(id_rol,desc_rol,ccompania,comentarios){
        $('#mhdnIdrol').val(id_rol);
        $('#mhdnAccionRol').val('A');                                     
        $('#mtxtDescRol').val(desc_rol);        
        $('#mtxtComentario').val(comentarios);    
        $('#cboCiarol').val(ccompania).trigger("change");
        
    };

    $('#frmRegRol').submit(function(event){
        event.preventDefault();

        $.ajax({
            url:$('#frmRegRol').attr("action"),
            type:$('#frmRegRol').attr("method"),
            data:$('#frmRegRol').serialize(),
            success: function (respuesta){
                oTable_listarol.ajax.reload(null,false);
                Vtitle = 'Se Grabo Correctamente';
                Vtype = 'success';
                sweetalert(Vtitle,Vtype);  
                $('#btnNuevoRol').click(); 
            },
            error: function(){          
                Vtitle = 'No se puede Grabar por error';
                Vtype = 'error';
                sweetalert(Vtitle,Vtype); 
            }
        });
    });

    $('#btnNuevoRol').click(function(){
        $('#frmRegRol').trigger("reset");
        $('#mhdnIdrol').val('');
        $('#mhdnAccionRol').val('N'); 
        $('#cboCiarol').val('0').change();
    });

/*PERMISOS*/
    $('#collapsePermiso').on('show.bs.collapse', function () {        
        $.ajax({
            type: 'ajax',
            method: 'post',
            url: baseurl+"adm/ti/csistemas/getcborol",
            dataType: "JSON",
            async: true,
            success:function(result)
            {
                $('#cboRolList').html(result); 
            },
            error: function(){
            alert('Error, No se puede autenticar por error');
            }
        });
    });

    $('#cboRolList').change(function(){ 
        var v_idrol = $( "#cboRolList option:selected").attr("value");   
        
        listarPerm(v_idrol);
    });

    listarPerm = function(v_idrol){
        var groupColumn = 1;        
        oTable_listaperm = $('#tablalistaPerm').DataTable({
            'bJQueryUI'     : true,
            'scrollY'     	: '350px',
            'scrollX'     	: true, 
            'paging'      	: true,
            'processing'  	: true,      
            'bDestroy'    	: true,
            'info'        	: true,
            'filter'      	: true, 
            "ordering"		: false,  
            'stateSave'     : true, 
            'ajax'        : {
                "url"   : baseurl+"adm/ti/csistemas/getlistarperm/",
                "type"  : "POST", 
                "data": function ( d ) {  
                    d.idrol = v_idrol; 
                },     
                dataSrc : ''        
            },
            'columns'     : [
                {
                "class"     :   "index",
                orderable   :   false,
                data        :   null,
                targets     :   0
                },
                {data: 'desc_modulo', targets: 1},
                {data: 'desc_opcion', targets: 2},   
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
                            '<tr class="group"><td colspan="3">'+group+'</td></tr>'
                        );
     
                        last = group;
                    }
                } );
            }      
        });
        // Enumeracion 
        oTable_listaperm.on( 'order.dt search.dt', function () { 
            oTable_listaperm.column(0, {search:'applied', order:'applied'}).nodes().each( function (cell, i) {
            cell.innerHTML = i+1;
            } );
        }).draw();  

    };
        
    $('#tablalistaPerm tbody').on( 'click', 'tr.group', function () {
        var currentOrder = oTable_listaperm.order()[0];
        alert(currentOrder[0]);
    } );

    $('#cboCiaperm').change(function(){ 
        var v_idcia = $( "#cboCiaperm option:selected").attr("value");
        var v_idmodulo = "";   
        var v_idrol = "";      
        
        cambiarCboRolCia(v_idcia,v_idmodulo,v_idrol);
    });

    cambiarCboRolCia = function(v_idcia,v_idmodulo,v_idrol){
        var params = { "ccia" : v_idcia};
        
        $.ajax({
            type: 'ajax',
            method: 'post',
            url: baseurl+"adm/ti/csistemas/getmoduloxcia",
            dataType: "JSON",
            async: true,
            data: params,
            success:function(result)
            {
                $('#cboModulopem').html(result);
                $("#cboModulopem").val(v_idmodulo).trigger("change");   
            },
            error: function(){
            alert('Error, No se puede autenticar por error');
            }
        }); 
        $.ajax({
            type: 'ajax',
            method: 'post',
            url: baseurl+"adm/ti/csistemas/getrolxcia",
            dataType: "JSON",
            async: true,
            data: params,
            success:function(result)
            {
                $('#cboRolperm').html(result);
                $("#cboRolperm").val(v_idrol).trigger("change");   
            },
            error: function(){
            alert('Error, No se puede autenticar por error');
            }
        }); 
    };

    $('#btnRecuperaRol').click(function(){
        v_idrol = $('#cboRolperm').val();
        v_idmodulo = $('#cboModulopem').val();

        var params = { 
            "id_rol"    : v_idrol,
            "id_modulo" : v_idmodulo
        };

        $.ajax({
            type: 'ajax',
            method: 'post',
            url: baseurl+"adm/ti/csistemas/getrolpermisos",
            dataType: "JSON",
            async: true,
            data: params,
            success:function(result)
            {
                $('#dualOpciones[]').html(result);   
            },
            error: function(){
            alert('Error, No se puede autenticar por error');
            }
        });
    });

