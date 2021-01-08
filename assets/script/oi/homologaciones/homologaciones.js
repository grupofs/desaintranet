$(document).ready(function(){

    /* TRAER CLIENTES AL COMBOBOX*/
        $.ajax({
            type: 'ajax',
            method: 'post',
            url: baseurl+"oi/homologaciones/chomologaciones/getClientes",
            dataType: "JSON",
            async: true,
            success:function(result)
            {
                $('#cboCliente,#cboCliente01').html(result);
            },
            error: function(){
                alert('Error, No se puede autenticar por error');
            }
        });

    /* TRAER LOS ESTADOS AL COMBOBOX*/

        $.ajax({
            type: 'ajax',
            method: 'post',
            url: baseurl+"oi/homologaciones/chomologaciones/getEstadoExp",
            dataType: "JSON",
            async: true,
            success:function(result)
            {
                $('#cboEstado,#cboEstadoProducto').html(result);
            },
            error: function(){
                alert('Error, No se puede autenticar por error');
            }
        });


    /* TRAER TIPO REQUISITO*/
       
        $.ajax({
            type: 'ajax',
            method: 'post',
            url: baseurl+"oi/homologaciones/chomologaciones/getArea",
            dataType: "JSON",
            async: true,
            success:function(result)
            {
                $('#cboTipRequisito').html(result);
            },
            error: function(){
                alert('Error, No se puede autenticar por error');
            }
        })

    /* FORMATO DE FECHAS */
        $('#txtFDesde,#txtFFinal,#txtFCobro,#txtFecRegRequ,#txtFecRecDoc,#txtFecPrimEval,#txtFechaLevObs,#txtFechaTerminos').datetimepicker({
            format: 'YYYY-MM-DD',
            daysOfWeekDisabled: [0]
        });	

        $('#FechaInicial').val('2018-01-01');

    /* TRAER INFO SEGUN EL COMBOBOX CLIENTE */

        $("#btnBuscarExp").click(function(){
            var clienteprincipal =  $("#cboCliente").val();
            var fi = $("#FechaInicial").val();
            var ff = $("#FechaTermino").val();
            var estado = $("#cboEstado").val();

            $("#tblDetalleExp").addClass("d-none");//OCUALTAR TABLA DETALLE EXP

            var cliente = $("#select2-cboCliente-container").attr("title"); //OBTENER NOMBRE DE EMPRESA
            $("#clienteExp").text(cliente); //ASIGNAR EL NOMBRE DE LA EMPRESA A MOSTRAR

            $("#tblListado").DataTable({  
                'responsive'    : true,
                'bJQueryUI'     : true,
                'scrollY'     	: '300px',
                'scrollX'     	: true, 
                'paging'      	: true,
                'processing'  	: true,      
                'bDestroy'    	: true,
                "AutoWidth"     : false,
                'info'        	: true,
                'filter'      	: true, 
                "ordering"		: false,  
                'stateSave'     : true,
                "ajax"          : {
                    "url" :  baseurl+"oi/homologaciones/chomologaciones/getbuscarexpediente",
                    "type" : "POST",
                    "data" :function(d){
                        d.cliente = clienteprincipal,
                        d.fecinicio = fi,
                        d.fecfin = ff,
                        d.estado = estado
                    },
                    dataSrc: ''
                
                },
                'columns'	: [
                    
                    {"orderable": false, data: 'EXPEDIENTE', targets: 0},
                    {"orderable": false, data: 'FECREGISTRO', targets:1},
                    {"orderable": false, data: 'PROVEEDOR', targets: 2},
                    {"orderable": false, data: 'RUC', targets: 3},
                    {"orderable": false, 
                    render:function(data, type, row){                
                        return '<button class="btn btn-secundary" onClick="javascript:ListarDetalleExp(\''+row.EXPEDIENTE+'\')";><i class="fas fa-eye" data-original-title="listar"></i></button>';

                    }
                }
                    
                ]

            });

           
    
        })

   
        ListarDetalleExp = function(expediente){
                $("#tblDetalleExp").removeClass("d-none");

                var oTblDetExp = $("#tblListadoDetalle").DataTable({
                    'responsive'    : true,
                        'bJQueryUI'     : true,
                        'scrollY'     	: '300px',
                        'scrollX'     	: true, 
                        'paging'      	: true,
                        'processing'  	: true,      
                        'bDestroy'    	: true,
                        "AutoWidth"     : false,
                        'info'        	: true,
                        'filter'      	: true, 
                        "ordering"		: false,  
                        'stateSave'     : true,
                        "ajax"          : {
                            "url" :  baseurl+"oi/homologaciones/chomologaciones/getbuscarproductoxespediente",
                            "type" : "POST",
                            "data" :function(d){
                                d.expediente = expediente
                            },
                            dataSrc: ''
                        
                        },
                        'columns'	: [
                            {"orderable": false, 
                                render:function(data, type, row){                
                                    return  '<div>'+    
                                    ' <a onClick="javascript:detallExpediente(\''+expediente+'\');"><i class="fas fa-eye" style="color:#088A08; cursor:pointer;"> </i> </a>'+
                                    '</div>'
                                }
                            
                           },
                            {"orderable": false, data: 'PRODUCTO', targets: 1},
                            {"orderable": false, data: 'MARCA', targets:2},
                            {"orderable": false, data: 'SANITARIO', targets: 3},
                            {"orderable": false, data: 'EMISION', targets: 4},
                            {"orderable": false, data: 'VENCE', targets: 5},
                            {"orderable": false, data: 'ESTADO', targets: 6},
                            {"orderable": false, data: 'FINICIO', targets: 7},
                            {"orderable": false, data: 'FFIN', targets: 8}
                            
                            
                        ]
                        
                })

                $('#tblListadoDetalle tbody').on( 'click', 'tr', function () {
                    if ( $(this).hasClass('selected') ) {
                        $(this).removeClass('selected');
                    }
                    else {
                        oTblDetExp.$('tr.selected').removeClass('selected');
                        $(this).addClass('selected');
                    }
                } );
        
                
        }
        
        // PASAR AL SEGUNTO TAB CON DATOS
        detallExpediente = function (expediente) {
            var exp = expediente;

            var cli = $("#cboCliente").val();
            $("#cboCliente01").val(cli).trigger("change");

            var parametros = {
                'expediente' : exp
            } 

            $.ajax({
                type: 'ajax',
                method: 'post',
                url: baseurl+"oi/homologaciones/chomologaciones/getProveedorxCliente",
                dataType: "JSON",
                async: true,
                data:parametros,
                success:function(result)
                {
                    $('#cboProveedor').html(result).trigger("change");
                },

                error: function(){
                    alert('Error, No hay datos.');
                }
            })
            

            $.ajax({
                type: 'ajax',
                method: 'post',
                url: baseurl + "oi/homologaciones/chomologaciones/getClienteDetallado",
                dataType: "JSON",
                async: true,
                data: parametros,
                success: function (result) {
                    var c = (result);
                    $.each(c, function (i, item) {
                        
                        $("#cboArea").val(item.AREA).trigger("change");
                        $("#cboEstadoProveedor").val(item.ESTADO).trigger("change");
                        $("#cboProveedor").val(item.PROVEEDOR).trigger("change");
                        $("#cboContacto1").val(item.IDCONTACTO1);
                        $("#cboContacto2").val(item.IDCONTACTO2);
                    })

                    
                },
                error: function () {
                    alert('Error, no se guardaron los datos');
                }
            })
            
            $('#tabExped a[href="#tabExped-new"]').tab('show'); 
            ListDetProducto(exp);
          //  $("#tblDetProducto").DataTable();

          // LLENAMOS EL INPUT HIDDEN CON EL QUE SE AGREGARA EL PRODUCTO EN EL 2DO TAB 
          $("#txtIdExpediente").val(expediente);
        } 
        /* TABLA DETALLES DE PRODUCTO 2DO TAB */

        ListDetProducto = function(exp){
            $("#tblDetProducto").DataTable({
                'responsive'    : true,
                'bJQueryUI'     : true,
                'scrollY'     	: '300px',
                'scrollX'     	: true, 
                'paging'      	: true,
                'processing'  	: true,      
                'bDestroy'    	: true,
                "AutoWidth"     : false,
                'info'        	: true,
                'filter'      	: true, 
                "ordering"		: false,  
                'stateSave'     : true,
                'ajax'        : {
                    "url"   : baseurl+"oi/homologaciones/chomologaciones/getbuscarproductoxespediente",
                    "type"  : "POST", 
                    "data": function ( d ) {
                        d.expediente = exp
                    },     
                    dataSrc : ''        
                    },
                "columnDefs": [{
                    "targets": [7], 
                    "data": null, 
                    "render": function(data, type, row) { 
                       
                        return '<button class="btn btn-secundary"><i class="fas fa-trash" data-original-title="Eliminar Producto"></i></button> <button class="btn btn-secundary" data-toggle="modal" data-target="#ModalEditarProducto"><i class="fas fa-edit" data-original-title="Editar Producto"></i></button>';
                                      
                    }
                }],

                'columns'	: [
                    {"orderable": false, 
                        render:function(data, type, row){                
                            return  '<div> </div>'
                        }
                    
                   },
                    {"orderable": false, data: 'TIPOREQUISITO', targets: 1},
                    {"orderable": false, data: 'PRODUCTO', targets:2},
                    {"orderable": false, data: 'MARCA', targets: 3},
                    {"orderable": false, data: 'ENVASEPRIM', targets: 4},
                    {"orderable": false, data: 'ENVASESECU', targets: 5},
                    {"orderable": false, data: 'ESTADO', targets: 6},
                    {"orderable": false, "class": "col-s", 
                        render:function(data, type, row){                
                            return  '<div>'+
                            '<a data-toggle="modal" title="Editar" style="cursor:pointer; color:#3c763d;" data-target="#ModalEditarProducto" onClick="javascript:selProducto(\''+exp+'\',\''+row.IDPROD+'\',\''+row.PRODUCTO+'\',\''+row.IDTIPREQUI+'\',\''+row.TIPOMARCA+'\',\''+row.ORIGEN+'\',\''+row.CONDICIONALM+'\',\''+row.MARCA+'\',\''+row.VIDA_UTIL+'\',\''+row.ENVASEPRIM+'\',\''+row.ENVASESECU+'\',\''+row.FABRICANTE+'\',\''+row.FABRICADIREC+'\',\''+row.ALMACEN+'\',\''+row.DIRECCIONALM+'\');"><span class="fas fa-edit" aria-hidden="true"> </span> </a>'+
                            '&nbsp;'+
                            '<a  onClick="javascript:SelDeleteProd(\''+exp+'\',\''+row.IDPROD+'\');" title="Eliminar" style="cursor:pointer; color:#FF0000;"><span class="fas fa-trash-alt" aria-hidden="true"> </span></a>'+      
                            '</div>'
                        }
                    },
                    
                ]
            })
            
            $("#tabExped-eval").attr('exp',exp);
        }

        /* tabla lista de productos del proveedor */
        $("#tabExped-eval-tab").click(function(){

            var expediente = $("#tabExped-eval").attr('exp');
            var params = {
                'expediente' : expediente
            } 
            
            $("#tblProdProveedor").DataTable({
                'responsive'    : true,
                'bJQueryUI'     : true,
                'scrollY'     	: '300px',
                'scrollX'     	: true, 
                'paging'      	: true,
                'processing'  	: true,      
                'bDestroy'    	: true,
                "AutoWidth"     : false,
                'info'        	: true,
                'filter'      	: true, 
                "ordering"		: false,  
                'stateSave'     : true,
                "ajax"          : {
                    "url" :  baseurl+"oi/homologaciones/chomologaciones/getbuscarproductoxespediente",
                    "type" : "POST",
                    "data" : params,
                    dataSrc: ''
                
                },
                'columns'	: [
                    {"orderable": false, data: 'NUM',targets :0},
                    {"orderable": false, data: 'ESTADO', targets: 1},
                    {"orderable": false, data: 'PRODUCTO', targets:2},
                    {"orderable": false, data: 'MONTO', targets: 3},
                    {"orderable": false, data: 'PAGAR', targets: 4},
                    {"orderable": false, data: 'FCOBRO', targets: 5}
                    
                    
                ],
                "columnDefs": [{
                    "targets": [6], 
                    "data": null, 
                    "class":'text-center',
                    "render": function(data, type, row) { 
                       
                        return '<div><a onClick="javascript:verRequisitos(\''+row.IDPROD+'\',\''+expediente+'\',\''+row.PRODUCTO+'\',\''+row.IDTIPOREQU+'\'); "><i class="fas fa-eye" data-original-title="Ver Requisitos"></i></a>'+
                        '&nbsp;'+
                        '<a data-toggle="modal" title="Editar" style="cursor:pointer; color:#3c763d;" data-target="#ModalEditarProductoProveedor" onClick="javascript:selProductoProveedor(\''+expediente+'\',\''+row.IDPROD+'\',\''+row.IDESTADO+'\',\''+row.PRODUCTO+'\',\''+row.MONTO+'\',\''+row.PAGAR+'\',\''+row.FCOBRO+'\');"><span class="fas fa-edit" aria-hidden="true"> </span> </a>'+
                       '</div>';
                                      
                    }
                },{
                    "targets": [4], 
                    "data": null, 
                    "class":'text-center',
                    "render": function(data, type, row) { 
                       if(row.PAGAR == 'S'){
                            return '<div class="custom-control custom-checkbox">'+
                            '<input  checked  type="checkbox" disabled>'+
                            '</div>';
                       }else{
                            return '-';
                       }
                       
                                      
                    }
                },{
                    "targets": [3], 
                    "data": null, 
                    "class":'text-center',
                    "render": function(data, type, row) { 
                       if(row.MONTO == null){
                            return '<p class="text-muted">S./ 0.00</p>';
                       }else{
                            return 'S./ '+row.MONTO;
                       }
                       
                                      
                    }
                },{
                    "targets": [6], 
                    "data": null, 
                    "class":'text-center',
                    "render": function(data, type, row) { 
                       if(row.FCOBRO == 'null'){
                            return '-';
                       }else{
                           return row.FCOBRO;
                       }
                       
                                      
                    }
                }


                ]
            });

           
        })
})

    verRequisitos = function(idprod,exp,producto,IDTIPOREQU){
        $("#cardObservaciones").removeClass("invisible");
        $("#cardObservaciones").addClass("visible");

        $("#btnAddRequisito").removeClass("d-none");
        
        $("#txtIdRequisito").val(IDTIPOREQU);

        $("#ProductoNombre").text(producto);
        $("#ProductoNombre1").text(producto);

        /* COLOCAR ID Y EXP DEL PRODUCTO PARA GRTABAR Y EDITAR LOS REQUISITOS DE CADA PRODUCTO */
        
        $("#txtExpRequisito").val(exp);
        $("#txtIdProducto").val(idprod);


        var params = {
            'expediente' : exp,
            'idprod'     : idprod
        }

        $("#tblDetProductoProveedor").DataTable({
            'responsive'    : true,
            'bJQueryUI'     : true,
            'scrollY'     	: '300px',
            'scrollX'     	: true, 
            'paging'      	: true,
            'processing'  	: true,      
            'bDestroy'    	: true,
            "AutoWidth"     : false,
            'info'        	: true,
            'filter'      	: true, 
            "ordering"		: false,  
            'stateSave'     : true,
            "ajax"          : {
                "url" :  baseurl+"oi/homologaciones/chomologaciones/getbuscarequisitoxproducto",
                "type" : "POST",
                "data" : params,
                
                dataSrc: ''
            
            },
            'columns'	: [
                {"orderable": false, data: 'REQUISITO',targets :0},
                {"orderable": false, 
                    render:function(data,type,row){
                        if(row.NOTA == null){
                            return '<p class="text-muted">N/A</p>';
                        }else{
                            return row.NOTA;
                        }
                    }
                },
                {"orderable": false,
                    render : function(data,type,row){
                        if (row.FECHA == null) {
                            return '<p class="text-muted">Sin Fec.</p>';
                        }else{
                            return row.FECHA;
                        }
                    }    
                },
                {"orderable": false, 
                    render:function(data,type,row){
                        if(row.DESCRIPCION == null){
                            return '<p class="text-muted">N/A</p>';
                        }else{
                            return row.DESCRIPCION;
                        }
                    }
                },
                {"orderable": false,
                    render:function(data,type,row){
                        switch (row.CONFORMIDAD){
                            case 'C':
                                return 'Cumple';
                                break;
                            case 'P':
                                return 'Pendiente';
                                break;
                            case 'A':
                                return 'No Aplica';
                                break;
                            case 'N':
                                return 'No Cumple';
                                break;
                            default:
                                return '-';

                        }
                    }
                },
                {"orderable": false, 
                    render:function(data,type,row){
                        if (row.RUTA == null || row.RUTA == '') {
                            return '<p class="text-muted">NO HAY ARCHIVO</p>';
                        } else {
                            return '<a href="'+baseurl+'FTPfileserver/Archivos/Homologaciones/'+row.RUTA+'" target="_blank"><img src="'+baseurl+'assets/images/pdf.png" class="img-fluid"/></a>'
                        }
                    }
                },
                {"orderable": false, 
                    render:function(data,type,row){
                        if (row.TIPO == 'D') {
                            return 'Descripcion';
                        } else if(row.TIPO == 'F') {
                            return 'Fecha sin Alarma';
                        }else if(row.TIPO == 'A'){
                            return 'Fecha con Alarma';
                        }
                    }
                }

                
                
            ],
            "columnDefs": [{
                "targets": [7], 
                "data": null, 
                "render": function(data, type, row) { 
                   
                    return '<div>'+
                    '<a data-toggle="modal" title="Editar" style="cursor:pointer; color:#3c763d;" data-target="#ModalAgregarRequisitoProducto" onClick="javascript:selRequisitoProducto(\''+row.REQUISITO+'\',\''+row.NOTA+'\',\''+row.FECHA+'\',\''+row.DESCRIPCION+'\',\''+row.CONFORMIDAD+'\',\''+row.RUTA+'\',\''+row.TIPO+'\',\''+row.IDREQUISITO+'\',\''+row.IDREQU+'\');"><span class="fas fa-edit" aria-hidden="true"> </span> </a>'+
                   '</div>'+'&nbsp;'+
                   '<a  onClick="javascript:SelDeleteReqProd(\''+exp+'\',\''+idprod+'\',\''+row.IDREQU+'\');" title="Eliminar" style="cursor:pointer; color:#FF0000;"><span class="fas fa-trash-alt" aria-hidden="true"> </span></a>'+      
                   '</div>';
                                  
                }
            }
        ]
        });
    
        
        $.ajax({
            type : 'ajax',
            method : 'post',
            url : baseurl+"oi/homologaciones/chomologaciones/getbuscarobservacionxproducto",
            dataType : 'JSON',
            async : true,
            data : params,
            success : function(response){

             
                    $.each(response, function(){

                        if (this.OBSERVACION == null) {
                            $("#mtxtObservacion").text('');
                            $("#mtxtObservacion").val('');
                        } else {
                             $("#mtxtObservacion").text(this.OBSERVACION);
                             $("#mtxtObservacion").val(this.OBSERVACION);
                        }

                        if (this.ACUERDOS == null) {
                            $("#mtxtAcuerdo").text('');
                            $("#mtxtAcuerdo").val('');
                        } else {
                            $("#mtxtAcuerdo").text(this.ACUERDOS);
                            $("#mtxtAcuerdo").val(this.ACUERDOS);
                        }
                       
                        (this.RECEPDOC == null)     ? $("#FechaRecepDoc").val('1900-01-01') : $("#FechaRecepDoc").val(this.RECEPDOC);
                        (this.TIEMRESPROV == null)  ? $("#tmpRespProv").val('')             : $("#tmpRespProv").val(this.TIEMRESPROV);
                        (this.PRIMEVAL == null)     ? $("#FecPrimEval").val('1900-01-01')   : $("#FecPrimEval").val(this.PRIMEVAL);
                        (this.TIEMRESPFSC == null)  ? $("#tmpRespFsc").val('')              : $("#tmpRespFsc").val(this.TIEMRESPFSC);
                        (this.LEVAOBSERV == null)   ? $("#FechaLevObs").val('1900-01-01')   : $("#FechaLevObs").val(this.LEVAOBSERV);
                        (this.FINPROCESO == null)   ? $("#FechaTerminos").val('1900-01-01') : $("#FechaTerminos").val(this.FINPROCESO);
                        (this.TIMEDURACION == null) ? $("#tmpDuracion").val('')             : $("#tmpDuracion").val(this.TIMEDURACION);
                        
                        
                        //$("#txtmpPrimEval").val(this.RECEPDOC);
                        
                    });

                    /* ASIGNAR ID Y EXPEDIENTE PARA EDITAR LAS OBSERVACIONES */

                    if (idprod != null && exp != null) {
                        $("#txtIdProdObservacion").val(idprod);
                        $("#txtExpedienteObservacion").val(exp);
                    } else {
                        
                        $("#txtIdProdObservacion").val('');
                        $("#txtExpedienteObservacion").val('');
                    }
                    
                
            }
        });
    
        
        
        
    }

    // BUSCAR AREA SEGUN CLIENTE

    $("#cboCliente01").change(function(){

        var cliente = $("#cboCliente01").val();
        var params = {
            "cliente" : cliente
        }

        $.ajax({
            type: 'ajax',
            method: 'post',
            url: baseurl+"oi/homologaciones/chomologaciones/getArea",
            dataType: "JSON",
            async: true,
            data:params,
            success:function(result)
            {
                $('#cboArea').html(result);
            },
            error: function(){
                alert('Error, No se puede autenticar por error');
            }
        })

    })

    $("#cboCliente").change(function(){

        var cliente = $("#cboCliente").val();
        var params = {
            "cliente" : cliente
        }

        $.ajax({
            type: 'ajax',
            method: 'post',
            url: baseurl+"oi/homologaciones/chomologaciones/getProveedorxCliente",
            dataType: "JSON",
            async: true,
            data:params,
            success:function(result)
            {
                $('#cboProveedor').html(result);
            },
            error: function(){
                alert('Error, No se puede autenticar por error');
            }
        })

        $.ajax({
            type: 'ajax',
            method: 'post',
            url: baseurl+"oi/homologaciones/chomologaciones/getArea",
            dataType: "JSON",
            async: true,
            data:params,
            success:function(result)
            {
                $('#cboArea').html(result);
            },
            error: function(){
                alert('Error, No se puede autenticar por error');
            }
        })

    })


// obtener contactos segun proveedor
    $("#cboProveedor").change(function(){
        var idproveedor = $("#cboProveedor").val();
        console.log('idproveedor', idproveedor)

        var parametros = {
            'idproveedor' : idproveedor
        }
        $.ajax({
            type: 'ajax',
            method: 'post',
            url: baseurl + "oi/homologaciones/chomologaciones/getContactoProveedor",
            dataType: "JSON",
            async: true,
            data: parametros,
            success: function (result) {
                $('#cboContacto1,#cboContacto2').html(result).trigger("change");
            },
            error: function () {
                alert('Error, no se encontraron los datos');
            }
        })

    })

    //obtener email por contacto
    $("#cboContacto1").change(function(){
        var emailContacto = $("#cboContacto1>option:selected").attr("email");
            $("#txtEmail1").val(emailContacto);
    })

    $("#cboContacto2").change(function(){
        var emailContacto2 = $("#cboContacto2>option:selected").attr("email");
        $("#txtEmail2").val(emailContacto2);
    })
/* ACTIVAR/DESACTIVAR ESTADO DEL EXPEDIENTE CON UN CHECKBOX */

    $("#checkTodos").change(function(){
        if($("#checkTodos").is(":checked") == true){ 
            $("#cboEstado").prop("disabled",true);
            
        }else if($("#checkTodos").is(":checked") == false){ 
            $("#cboEstado").prop("disabled",false);
            
        }; 
    })



    // GUARDAR PRODUCTO DEL TAB 2

    $("#btnGuardarProductos").click(function(){
        var datos = $("#frmProductosDos").serialize();

        $.ajax({
            type : 'ajax',
            method : 'post',
            url : baseurl+'oi/homologaciones/chomologaciones/insertarProducto',
            dataType : 'json',
            async : true,
            data: datos,
            success: function(result){
                if (result == 1) {
                    $("#frmProductosDos")[0].reset();
                    $('#ModalEditarProducto').modal('hide');
                    $("#tblDetProducto").DataTable().ajax.reload();
                    Vtitle = 'Se agrego correctamente';
                    Vtype = 'success';
                    sweetalert(Vtitle, Vtype);
    
                }else if(result == 2){
                    Vtitle = 'Llene los campos requeridos.';
                    Vtype = 'warning';
                    sweetalert(Vtitle, Vtype);
                }
                else {
                    Vtitle = 'Problemas al Agregar';
                    Vtype = 'error';
                    sweetalert(Vtitle, Vtype);
                }
            },
            error : function(){

                
                Vtitle = 'Problemas con el Servidor, solicita ayuda!';
                Vtype = 'error';
                sweetalert(Vtitle, Vtype);
                
            }
        })
    })

 /* TRAER DATOS PARA EDITAR PRODUCTOS EN EL TEB 2 */

 selProducto = function (EXP,IDPROD,PRODUCTO,IDTIPREQUI,TIPOMARCA,ORIGEN,CONDICIONALM,MARCA,VIDAUTIL,ENVASEPRIM,ENVASESECU,FABRICANTE,FABRICADIREC,ALMACEN,DIRECCIONALM){
     
        $("#txtIdExpediente").val(EXP);
        $("#idProductoEdit").val(IDPROD);
        $("#txtProducto").val(PRODUCTO);
        $("#cboTipRequisito").val(IDTIPREQUI).trigger("change");
        $("#cboTipoMarca").val(TIPOMARCA).trigger("change");
        $("#cboOrigenProd").val(ORIGEN).trigger("change");
        $("#txtCondicionAlmacen").val(CONDICIONALM);
        $("#txtMarca").val(MARCA);
        $("#txtVidautil").val(VIDAUTIL);
        $("#txtEnvPrimario").val(ENVASEPRIM);
        $("#txtEnvSecundario").val(ENVASESECU);
        $("#txtFabricante").val(FABRICANTE);
        $("#txtDirFabricante").val(FABRICADIREC);
        $("#txtAlmacen").val(ALMACEN);
        $("#txtDirecAlmacen").val(DIRECCIONALM);
        
 }

 $("#ModalProductoDos").click(function(){
    $("#frmProductosDos")[0].reset();
    $("#idProductoEdit").val('');
    $("#cboTipRequisito").val('').trigger('change');
    $("#cboTipoMarca").val('').trigger('change');
    $("#cboOrigenProd").val('').trigger('change');

 })


//  ELIMINAR/DESACTIVAR PRODUCTO

SelDeleteProd = function(exp,idprod){
	

	var datos = {
        expediente  : exp,
        idprod      : idprod
	};


	Swal.fire({
        title: 'Confirmar Eliminación',
        text: "¿Está seguro de eliminar el Producto?",
        icon: 'error',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Si, bórralo!'
    }).then((result) => {
        if (result.value) {
           
			$.ajax({
				type:'ajax',
				method: 'post',
				url: baseurl+'oi/homologaciones/chomologaciones/deleteProducto',
				dataType:'JSON',
				async: true,
				data: datos,
				success:function(result){
					if (result == 1) {
                        $("#tblDetProducto").DataTable().ajax.reload();
						Vtitle = 'Se Elimino Correctamente';
						Vtype = 'success';
						sweetalert(Vtitle,Vtype);
						
					} else {
						Vtitle = 'Ups,no se puede Eliminar!';
						Vtype = 'error';
						sweetalert(Vtitle,Vtype);
					}
					
				},
				error:function(){
					Vtitle = 'Problemas con el Servidor!';
					Vtype = 'error';
					sweetalert(Vtitle, Vtype);
				}
			})
        }
    }) 

}

//EDITAR PRODUCTOS PROVEEDOR

selProductoProveedor = function(exp,idprod,estado,producto,monto,pago,fcobro){
    $("#txtExp").val(exp);
    $("#txtidProduc").val(idprod);
    $("#cboEstadoProducto").val(estado).trigger("change");
    $("#txtProductoTab3").val(producto);

    if(monto == 'null'){
        $("#txtMonto").val('0.00');
    }else{
        $("#txtMonto").val(monto);
    }

    if(pago == 'null'){
        $("#cboPagoCliente").val('').trigger("change");
    }else{
        $("#cboPagoCliente").val(pago).trigger("change");
    }

    if(fcobro == 'null'){
        $("#FechaCobro").val('1900-01-01');
    }else{
        $("#FechaCobro").val(fcobro);
    }
    
    //TRAER PRODUCTOS CON SEGUN EL TIPO PRODUCTO PROCEDURE CREADO....
    
}


/* GUARDAR DATOS Y OBSERVACIONES EN REUISITOS DE PRODUCTOS */
$("#btnSaveObservacionReq").click(function(){
    var datos = $("#frmRequisitoProdObs").serialize();

    $.ajax({
        type : 'ajax',
        method : 'post',
        url : baseurl+'oi/homologaciones/chomologaciones/insertarObsRequisito',
        dataType : 'json',
        async : true,
        data: datos,
        success: function(result){
            if (result == 1) {
                $("#tblProdProveedor").DataTable().ajax.reload();
                Vtitle = 'Se actualizó correctamente';
                Vtype = 'success';
                sweetalert(Vtitle, Vtype);

            }else if(result == 2) {
                Vtitle = 'Ingrese los campos requeridos';
                Vtype = 'warning';
                sweetalert(Vtitle, Vtype);
            }
        },
        error : function(){

           
            Vtitle = 'Problemas con el Servidor, solicita ayuda!';
            Vtype = 'error';
            sweetalert(Vtitle, Vtype);
            
        }
    })
});

$("#btnSaveProductoTabTres").click(function(){
    var datos = $("#frmProductoProveeddor").serialize();

    $.ajax({
        type : 'ajax',
        method : 'post',
        url : baseurl+'oi/homologaciones/chomologaciones/insertarProductoProveedor',
        dataType : 'json',
        async : true,
        data: datos,
        success: function(result){
            if (result == 1) {
                $("#tblProdProveedor").DataTable().ajax.reload();
                Vtitle = 'Se agrego correctamente';
                Vtype = 'success';
                sweetalert(Vtitle, Vtype);

            }else if(result == 2) {
                Vtitle = 'Ingrese los campos requeridos';
                Vtype = 'warning';
                sweetalert(Vtitle, Vtype);
            }
        },
        error : function(){

           
            Vtitle = 'Problemas con el Servidor, solicita ayuda!';
            Vtype = 'error';
            sweetalert(Vtitle, Vtype);
            
        }
    })
})


$("#cboPagoCliente").change(function(){
    var pagar = $("#cboPagoCliente").val();
    console.log('cboPagar', pagar)

    if (pagar == 'S') {
        $("#txtMonto").attr("readonly");
    }
})

function selRequisitoProducto(REQUISITO,NOTA,FECHA,DESCRIPCION,CONFORMIDAD,RUTA,TIPO,IDREQUISITO,IDREQU){
   
    var params = {
        'tipoProd' : IDREQUISITO
    }

    $.ajax({
        type : 'ajax',
        method : 'post',
        url : baseurl+"oi/homologaciones/chomologaciones/getTipoRequisito",
        dataType : 'JSON',
        async : true,
        data : params,
        success : function(result){
            $('#cboRequisito').html(result);
            $("#cboRequisito").val(IDREQU).trigger("change");
        },
        error: function(){
            alert('Error, No se puede autenticar por error');
        }
    });

    $("#txtAccion").val('U');
    $("#txtNotaReq").val(NOTA);
    $("#FecRegistroRequ").val(FECHA);
    $("#cboConformidad").val(CONFORMIDAD).trigger("change");
    $("#txtDescripcionRequisito").val(DESCRIPCION);
    $("#cboTipo").val(TIPO).trigger("change");
    $("#txtFileRequisito").val(RUTA);
    
    
}

$("#btnCerrarRequisitos").click(function(){
    $("#txtNotaReq").val('');
    $("#FecRegistroRequ").val('');
    $("#cboConformidad").val('').trigger("change");
    $("#txtDescripcionRequisito").val('');
    $("#cboTipo").val('').trigger("change");
    $("#txtFileRequisito").val('');
    $("#cboRequisito").val('').trigger("change");
    $("#txtAccion").val('');
})

$("#btnSaveReqiusitoProd").click(function(){
    var datos = $("#frmSaveRequisitoProducto").serialize();

    $.ajax({
        type : 'ajax',
        method : 'post',
        url : baseurl+'oi/homologaciones/chomologaciones/insertarRequisitoProducto',
        dataType : 'json',
        async : true,
        data: datos,
        success: function(result){
            if (result == 1) {
                $("#tblDetProductoProveedor").DataTable().ajax.reload();
                $("#btnCerrarRequisitos").click();
                Vtitle = 'Se agrego correctamente';
                Vtype = 'success';
                sweetalert(Vtitle, Vtype);

            }else if(result == 2) {
                Vtitle = 'Ingrese los campos requeridos';
                Vtype = 'warning';
                sweetalert(Vtitle, Vtype);
            }
        },
        error : function(){

           
            Vtitle = 'Problemas con el Servidor, solicita ayuda!';
            Vtype = 'error';
            sweetalert(Vtitle, Vtype);
            
        }
    })
})

function SelDeleteReqProd (exp,idprod,idreq){
    var datos = {
        expediente  : exp,
        idprod      : idprod,
        requisito   : idreq
	};


	Swal.fire({
        title: 'Confirmar Eliminación',
        text: "¿Está seguro de eliminar el Requisito?",
        icon: 'error',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Si, bórralo!'
    }).then((result) => {
        if (result.value) {
           
			$.ajax({
				type:'ajax',
				method: 'post',
				url: baseurl+'oi/homologaciones/chomologaciones/deleteRequisitoProd',
				dataType:'JSON',
				async: true,
				data: datos,
				success:function(result){
					if (result == 1) {
                        $("#tblDetProductoProveedor").DataTable().ajax.reload();
						Vtitle = 'Se Elimino Correctamente';
						Vtype = 'success';
						sweetalert(Vtitle,Vtype);
						
					} else {
						Vtitle = 'Ups,no se puede Eliminar!';
						Vtype = 'error';
						sweetalert(Vtitle,Vtype);
					}
					
				},
				error:function(){
					Vtitle = 'Problemas con el Servidor!';
					Vtype = 'error';
					sweetalert(Vtitle, Vtype);
				}
			})
        }
    }) 
}

$("#btnAddRequisito").click(function(){
    var params = {
        'tipoProd' : $("#txtIdRequisito").val()
        
    }
    $.ajax({
        type : 'ajax',
        method : 'post',
        url : baseurl+"oi/homologaciones/chomologaciones/getTipoRequisito",
        dataType : 'JSON',
        async : true,
        data : params,
        success : function(result){
            $('#cboRequisito').html(result);
            
        },
        error: function(){
            alert('Error, No se puede autenticar por error');
        }
    });

    $("#txtAccion").val('I'); // "I" = insertar
})

$("#fileRequisito").fileinput({
	uploadAsync: false,
	minFileCount: 1,
	maxFileCount: 60000,
	showUpload: false,
	showRemove: true,
	overwriteInitial: true,
	maxFileSize: 60000,
	showClose: false,
	showCaption: false,
	removeIcon: '<i class="glyphicon glyphicon-remove"></i>',
	removeTitle: 'Eliminar Archivo',
	elErrorContainer: '#kv-avatar-errors-1',
    msgErrorClass: 'alert alert-block alert-danger'
});

function registrar_archivo() {
	var archivoInput = document.getElementById('fileRequisito');
	var archivoRuta = archivoInput.value;
	var extPermitidas = /(.pdf|.docx|.xlsx|.doc|.xls|.rar|.zip)$/i;

	if (!extPermitidas.exec(archivoRuta)) {
		alert('Asegurese de haber seleccionado un PDF, DOCX, XSLX, RAR, ZIP');
		archivoInput.value = '';
		return false;
	} else {
		var parametrotxt = new FormData($("#frmSaveRequisitoProducto")[0]);

		$.ajax({
			data: parametrotxt,
			method: 'post',
			url: baseurl + "oi/homologaciones/chomologaciones/subirArchivo",
			dataType: "JSON",
			async: true,
			contentType: false,
			processData: false,
			success: function (response) {

				folder = response[0];
				$("#txtFileRequisito").val(folder); //ASIGNAMOS EL NOMBRE AL ARCHIVO PARA GUARDAR
				rutaarchivo = response[1];

			},
			error: function () {
				alert('Error, no se cargó el archivo');
			}

		});
	}

}