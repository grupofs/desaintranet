var oTable_listacurso, oTable_listamodulo, oTable_listaexpositor;

$(document).ready(function() {
    
});


/*CURSOS*/
    listarCursos = function(){
        oTable_listacurso = $('#tablalistaCursos').DataTable({
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
                "url"   : baseurl+"at/capa/cmantcapa/getlistarcurso/",
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
                {data: 'desc_curso', targets: 1},
                {data: 'comentario',targets: 2},                          
                {"orderable": false, 
                    render:function(data, type, row){
                        return '<div>' + 
                            '<a title="Editar" style="cursor:pointer; color:#3c763d;" onclick="javascript:seleCurso(\''+row.id_capacurso+'\',\''+row.desc_curso+'\',\''+row.comentario+'\');"><span class="fas fa-edit" aria-hidden="true"> </span> </a>' +
                            '</div>' ; 
                    }
                }
            ],
        });
        // Enumeracion 
        oTable_listacurso.on( 'order.dt search.dt', function () { 
            oTable_listacurso.column(0, {search:'applied', order:'applied'}).nodes().each( function (cell, i) {
            cell.innerHTML = i+1;
            } );
        }).draw();  
    };

    $('#collapseCurso').on('show.bs.collapse', function () {
        listarCursos();
    });

    seleCurso = function(id_capacurso,desc_curso,comentario){   
        $('#mhdnIdcurso').val(id_capacurso);    
        $('#mtxtDescCur').val(desc_curso);    
        $('#mtxtComenCur').val(comentario);    

        $('#mhdnAccionCur').val('A');
        
    };

    $('#frmRegCurso').submit(function(event){
        event.preventDefault();

        $.ajax({
            url:$('#frmRegCurso').attr("action"),
            type:$('#frmRegCurso').attr("method"),
            data:$('#frmRegCurso').serialize(),
            success: function (respuesta){            
                oTable_listacurso.ajax.reload(null,false);
                Vtitle = 'Se Grabo Correctamente';
                Vtype = 'success';
                sweetalert(Vtitle,Vtype);
                $('#btnNuevoCur').click();  
            },
            error: function(){
                Vtitle = 'No se puede Grabar por error';
                Vtype = 'error';
                sweetalert(Vtitle,Vtype); 
            }
        });
    });

    $('#btnNuevoCur').click(function(){
        $('#frmRegCurso').trigger("reset");
        $('#mhdnIdcurso').val(''); 
        $('#mhdnAccionCur').val('N');
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
                "url"   : baseurl+"at/capa/cmantcapa/getlistarmodulo/",
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
                {data: 'desc_curso', targets: 1},
                {data: 'desc_modulo', targets: 2},                          
                {"orderable": false, 
                    render:function(data, type, row){
                        return '<div>' +
                                '<a title="Editar" style="cursor:pointer; color:#3c763d;" onclick="javascript:seleModulo(\''+row.id_capamodulo+'\',\''+row.id_capacurso+'\',\''+row.desc_modulo+'\',\''+row.comentarios+'\');"><span class="fas fa-edit" aria-hidden="true"> </span> </a>' +
                                '</div>' ; 
                    }
                }
            ],         
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
        
        $.ajax({
            type: 'ajax',
            method: 'post',
            url: baseurl+"at/capa/cmantcapa/getcbocurso",
            dataType: "JSON",
            async: true,
            success:function(result) {
                $('#mcboCurso').html(result);  
            },
            error: function(){
                alert('Error, No se puede autenticar por error');
            }
        }); 
    });

    seleModulo = function(id_capamodulo,id_capacurso,desc_modulo,comentarios){
        $('#mhdnIdmodulo').val(id_capamodulo);
        $('#mhdnAccionMod').val('A');                     
        $('#mcboCurso').val(id_capacurso).trigger("change");                   
        $('#mtxtDescMod').val(desc_modulo);        
        $('#mtxtComenMod').val(comentarios);     
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
        $('#mcboCurso').val('').change();
    });
    

/*EXPOSITOR*/
    listarExpositor = function(){        
        oTable_listaexpositor = $('#tablalistaExpositor').DataTable({
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
                "url"   : baseurl+"at/capa/cmantcapa/getlistarexpositor/",
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
                {data: 'nrodoc', targets: 1},
                {data: 'datosrazonsocial', targets: 2},                          
                {"orderable": false, 
                    render:function(data, type, row){
                        return '<div>' +
                                '<a title="Editar" style="cursor:pointer; color:#3c763d;" onclick="javascript:seleExpositor(\''+row.id_capaexpo+'\',\''+row.id_administrado+'\',\''+row.cole_expositor+'\',\''+row.datosrazonsocial+'\');"><span class="fas fa-edit" aria-hidden="true"> </span> </a>' +
                                '</div>' ; 
                    }
                }
            ],         
        });
        // Enumeracion 
        oTable_listaexpositor.on( 'order.dt search.dt', function () { 
            oTable_listaexpositor.column(0, {search:'applied', order:'applied'}).nodes().each( function (cell, i) {
            cell.innerHTML = i+1;
            } );
        }).draw();  
    };

    $('#collapseExpositor').on('show.bs.collapse', function () {
        listarExpositor();

        $('#mhdnAccionMod').val('N'); 
        
        $("#mtxtExpositor").prop({readonly:true});
    });

    seleExpositor = function(id_capaexpo,id_administrado,cole_expositor,datosrazonsocial){
        $('#mhdnIdexpositor').val(id_capaexpo);
        $('#mhdnAccionExpo').val('A');                                      
        $('#mtxtExpositor').val(datosrazonsocial);        
        $('#mtxtnrocole').val(cole_expositor);          
        $('#hdnidadmi').val(id_administrado);    
    };

    $('#frmRegExpositor').submit(function(event){
        event.preventDefault();

        $.ajax({
            url:$('#frmRegExpositor').attr("action"),
            type:$('#frmRegExpositor').attr("method"),
            data:$('#frmRegExpositor').serialize(),
            success: function (respuesta){
                oTable_listaexpositor.ajax.reload(null,false);
                Vtitle = 'Se Grabo Correctamente';
                Vtype = 'success';
                sweetalert(Vtitle,Vtype);  
                $('#btnNuevoExpo').click(); 
            },
            error: function(){          
                Vtitle = 'No se puede Grabar por error';
                Vtype = 'error';
                sweetalert(Vtitle,Vtype); 
            }
        });
    });

    $('#btnNuevoExpo').click(function(){
        $('#frmRegExpositor').trigger("reset");
        $('#mhdnIdexpositor').val('');
        $('#mhdnAccionExpo').val('N'); 
        $('#hdnidadmi').val('');
    });
    
$('#modaladministrado').on('show.bs.modal', function (e) {
    
    $('#tabadministrado a[href="#tab_listaadministradotab"]').attr('class', 'disabled');
    $('#tabadministrado a[href="#tab_newadministradotab"]').attr('class', 'disabled active');

    $('#tabadministrado a[href="#tab_listaadministradotab"]').not('#store-tab.disabled').click(function(event){
        $('#tabadministrado a[href="#tabinforme-list"]').attr('class', 'active');
        $('#tabadministrado a[href="#tab_newadministrado"]').attr('class', '');
        return true;
    });
    $('#tabadministrado a[href="#tab_newadministradotab"]').not('#bank-tab.disabled').click(function(event){
        $('#tabadministrado a[href="#tab_newadministrado"]').attr('class' ,'active');
        $('#tabadministrado a[href="#tab_listaadministrado"]').attr('class', '');
        return true;
    });
    
    $('#tabadministrado a[href="#tab_listaadministrado"]').click(function(event){return false;});
    $('#tabadministrado a[href="#tab_newadministrado"]').click(function(event){return false;});
	
	$('#tabadministrado a[href="#tab_listaadministrado"]').tab('show');

	$("#btnBuscarAdm").click(function (){
		listarAdministrado();
	});

	listarAdministrado = function(){        
        oTable_listaadministrado = $('#tblAdministrado').DataTable({
            'bJQueryUI'     : true,
            'scrollY'     	: '200px',
            'scrollX'     	: true, 
            'paging'      	: true,
            'processing'  	: true,      
            'bDestroy'    	: true,
            'info'        	: true,
            'filter'      	: true, 
            "ordering"		: false,  
            'stateSave'     : true, 
            'ajax'        : {
                "url"   : baseurl+"cglobales/seladministrado/",
                "type"  : "POST", 
                "data": function ( d ) { 
					d.buscar     = $('#txtbuscar').val(); 
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
                {data: 'TIPODOC', targets: 1},
                {data: 'nrodoc', targets: 2},  
                {data: 'datosrazonsocial', targets: 3},                         
                {"orderable": false, 
                    render:function(data, type, row){
                        return '<div>' +
                                '<a title="Editar" style="cursor:pointer; color:#3c763d;" onclick="javascript:editAdministrado(\''+row.id_administrado+'\',\''+row.id_tipodoc+'\',\''+row.nrodoc+'\',\''+row.nombres+'\',\''+row.ape_paterno+'\',\''+row.ape_materno+'\',\''+row.fono_celular+'\',\''+row.email+'\',\''+row.sexo+'\',\''+row.direccion+'\',\''+row.fono_fijo+'\');"><span class="fas fa-edit fa-2x" aria-hidden="true"> </span> </a>' +
                                '</div>' ; 
                    }
                },                     
                {"orderable": false, 
                    render:function(data, type, row){
						return '<div>' +
						'<a title="Editar" style="cursor:pointer; color:#3c763d;" onclick="javascript:seleAdministrado(\''+row.id_administrado+'\',\''+row.datosrazonsocial+'\');"><span class="fas fa-check-circle fa-2x" aria-hidden="true"> </span> </a>' +
                                '</div>' ; 
                    }
                }
            ],         
        });
        // Enumeracion 
        oTable_listaadministrado.on( 'order.dt search.dt', function () { 
            oTable_listaadministrado.column(0, {search:'applied', order:'applied'}).nodes().each( function (cell, i) {
            cell.innerHTML = i+1;
            } );
        }).draw();  
	};

	editAdministrado = function(id_administrado,id_tipodoc,nrodoc,nombres,ape_paterno,ape_materno,fono_celular,email,sexo,direccion,fono_fijo){
		$('#tabadministrado a[href="#tab_newadministrado"]').tab('show'); 

        $('#mhdnIdAdministrado').val(id_administrado);
		$('#mhdnAccionAdministrado').val('A'); 

		if(id_tipodoc == 1){       
			tdDNI(); 
		}else{
			tdCEXT();
		}     

        $('#mtxtnrodoc').val(nrodoc);         
        $('#txtNombre').val(nombres);        
        $('#txtApepat').val(ape_paterno);        
        $('#txtApemat').val(ape_materno);       
        $('#txtcelular').val(fono_celular);        
        $('#txtemail').val(email); 
        $('#txtdireccion').val(direccion);  
        $('#txttelefono').val(fono_fijo);   
		                    
        $('#cbosexo').val(sexo).trigger("change");  
	};

	tdDNI=function(){
		$('#btntipodoc').html("DNI");
		$('#txttipodoc').val(1);
	};
	tdCEXT=function(){
		$('#btntipodoc').html("C.EXT.");
		$('#txttipodoc').val(4);
	};

	$('#btnNuevoAdm').click(function(){		
		$('#tabadministrado a[href="#tab_newadministrado"]').tab('show');
		$('#frmMantAdministrado').trigger("reset");
		$('#mhdnIdAdministrado').val('');
		$('#mhdnAccionAdministrado').val('N');

	});

	$('#btnRetornarAdm').click(function(){
		$('#tabadministrado a[href="#tab_listaadministrado"]').tab('show');  
	});

    $('#frmMantAdministrado').submit(function(event){
        event.preventDefault();

        $.ajax({
            url:$('#frmMantAdministrado').attr("action"),
            type:$('#frmMantAdministrado').attr("method"),
            data:$('#frmMantAdministrado').serialize(),
            success: function (respuesta){            
                Vtitle = 'Se Grabo Correctamente';
                Vtype = 'success';
                sweetalert(Vtitle,Vtype);                
				$('#btnBuscarAdm').click();
				$('#tabadministrado a[href="#tab_listaadministrado"]').tab('show'); 
            },
            error: function(){
                Vtitle = 'No se puede Grabar por error';
                Vtype = 'error';
                sweetalert(Vtitle,Vtype); 
            }
        });
	});
	
	seleAdministrado = function(id_administrado,datosrazonsocial){
        $('#hdnidadmi').val(id_administrado);
        $('#mtxtExpositor').val(datosrazonsocial);
		$('#mbtnCAdm').click();
	};
});
