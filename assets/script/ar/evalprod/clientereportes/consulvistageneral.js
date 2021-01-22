var oTable_vistageneral;
var varfdesde='%', varfhasta='%';

    $(document).ready(function() {

        $('#txtFDesde,#txtFHasta').datetimepicker({
            format: 'DD/MM/YYYY',
            daysOfWeekDisabled: [0],
            locale:'es'
        });
            
        fechaActual();

        /*LLENADO DE COMBOS*/    
        var vccliente = '00005';//$('#idcliente').val();
        var params = { 
            "ccliente" : vccliente
        };  
        $.ajax({
            type: 'ajax',
            method: 'post',
            url: baseurl+"ar/evalprod/cclientereportes/getproveedoreseval",
            dataType: "JSON",
            async: true,
            data: params,
            success:function(result)
            {
                $('#cboProveedor').html(result);
            },
            error: function(){
              alert('Error, No se puede autenticar por error');
            }
        });

        $.ajax({
            type: 'ajax',
            method: 'post',
            url: baseurl+"ar/evalprod/cclientereportes/getareaeval",
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

    })

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
        var fecha = new Date();		
        var fechatring1 = "01/01/" +fecha.getFullYear() ;
        var fechatring2 = ("0" + fecha.getDate()).slice(-2) + "/" + ("0"+(fecha.getMonth()+1)).slice(-2) + "/" +fecha.getFullYear() ;
        
        if($("#chkFreg").is(":checked") == true){ 
            $("#txtFIni").prop("disabled",false);
            $("#txtFFin").prop("disabled",false);
            
            varfdesde = '';
            varfhasta = '';
    
            $('#txtFDesde').datetimepicker('date', fechatring1);
            $('#txtFHasta').datetimepicker('date', fechatring2);
        
        }else if($("#chkFreg").is(":checked") == false){ 
            $("#txtFIni").prop("disabled",true);
            $("#txtFFin").prop("disabled",true);
            
            varfdesde = '%';
            varfhasta = '%';
    
            $('#txtFDesde').datetimepicker('date', moment(fechatring2, 'DD/MM/YYYY') );
            $('#txtFHasta').datetimepicker('date', moment(fechatring2, 'DD/MM/YYYY') );
    
        }; 
    });

    $('#btnBuscar').click(function(){ 

        if(varfdesde != '%'){ varfdesde = $('#txtFIni').val(); }
        if(varfhasta != '%'){ varfhasta = $('#txtFFin').val(); }  

        var parametros = {
            "ccliente"      : '00005', 
            "fini"        : varfdesde, 
            "ffin"        : varfhasta,
            "id_area"       : $('#cboArea').val(),
            "status"        : $('#cbostatus').val(),
            "proveedor_nuevo" : $('#cboProvnuevo').val(),
            "id_proveedor"  : $('#cboProveedor').val(),
            "expediente"    : $('#txtExpediente').val(),
            "rs"            : $('#txtRs').val(),
            "codigo"        : $('#txtEan').val(),
            "marca"         : $('#txtMarca').val(),
            "descripcion"   : $('#txtProducto').val(),
            "fabricante"    : $('#txtFabricante').val(),
            "eanmultiple"   : $('#mtxtEANmultiple').val(),
            "skumultiple"   : $('#mtxtSKUmultiple').val(),
        };  
    
        getListvistageneral(parametros);
    });
    
    getListvistageneral = function(param){
        oTable_vistageneral = $('#tblvistageneral').DataTable({
            "processing"  	: true,
            "bDestroy"    	: true,
            "stateSave"     : true,
            "bJQueryUI"     : true,
            "scrollY"     	: "500px",
            "scrollX"     	: true, 
            'AutoWidth'     : true,
            "paging"      	: false,
            "info"        	: true,
            "filter"      	: true, 
            "ordering"		: false,
            "responsive"    : false,
            "select"        : true,
            'ajax'        : {
                              "url"   : baseurl+"ar/evalprod/cclientereportes/getvistageneral/",
                              "type"  : "POST", 
                              "data"  : param, 
                              dataSrc : ''        
            },
            'columns'     : [
                              {
                                "class"     :   "index",
                                orderable   :   false,
                                data        :   null,
                                targets     :   0
                              },
                              {data: 'expediente', targets: 1 },
                              {data: 'fecha', orderable   :   false, targets: 2},
                              {data: 'f_evaluado', orderable   :   false, targets: 3},
                              {data: 'f_levantamiento', orderable   :   false, targets: 4},
                              {data: 'area', orderable   :   false, targets: 5},
                              {data: 'codigo', orderable   :   false, targets: 6},
                              {"orderable": false, 
                                render:function(data, type, row){
                                    if(row.codsku == '-') {
                                        return  '<div>'+ 
                                                '<a data-original-title="SKU" data-toggle="modal" data-target="#modalSKU" onClick="editSKU(\''+row.id_producto+'\',\''+row.codsku+'\');"><i class="fa fa-edit fa-2x" data-original-title="SKU" data-toggle="tooltip"></i></a>'+  
                                                '</div>'
                                    } else {
                                        return  '<div>'+row.codsku+
                                                '<a data-original-title="SKU" data-toggle="modal" data-target="#modalSKU" onClick="editSKU(\''+row.id_producto+'\',\''+row.codsku+'\');"><i class="fa fa-edit fa-1x" data-original-title="SKU" data-toggle="tooltip"></i></a>'+  
                                                '</div>'
                                    }  
                                }
                              },
                              {data: 'producto', orderable   :   false, targets: 8},
                              {data: 'fabricante', orderable   :   false, targets: 9},
                              {data: 'proveedor', orderable   :   false, targets: 10},
                              {data: 'rs', orderable   :   false, targets: 11},
                              {data: 'fecha_emision', orderable   :   false, targets: 12},
                              {data: 'fecha_vcto', orderable   :   false, targets: 13},
                              {data: 'c_f', orderable   :   false, targets: 14},
                              {data: 'pais', orderable   :   false, targets: 15},
                              {data: 'f_v', orderable   :   false, targets: 16},
                              {data: 'c_l_p', orderable   :   false, targets: 17},
                              {data: 'l_i', orderable   :   false, targets: 18},
                              {data: 'c_c_p', orderable   :   false, targets: 19},
                              {data: 'c_c', orderable   :   false, targets: 20},
                              {data: 'c_c_r', orderable   :   false, targets: 21},
                              {data: 'c_n', orderable   :   false, targets: 22},
                              {data: 'n_r', orderable   :   false, targets: 23},
                              {data: 'd_i', orderable   :   false, targets: 24},
                              {data: 't_v_u', orderable   :   false, targets: 25},
                              {data: 'f_i_h', orderable   :   false, targets: 26},
                              {data: 'entidad', orderable   :   false, targets: 27},
                              {data: 'responsable', orderable   :   false, targets: 28},
                              {data: 'fecha', orderable   :   false, targets: 29},
                              {data: 'status', orderable   :   false, targets: 30},
                              {data: 'a_s', orderable   :   false, targets: 31},
                              {data: 'f_a_v_s', orderable   :   false, targets: 32},
                              {data: 'd_p', orderable   :   false, targets: 33},
                              {data: 'o_l', orderable   :   false, targets: 34},
                              {data: 'o_n', orderable   :   false, targets: 35},
                              {data: 'grasas_saturadas', orderable   :   false, targets: 36},
                              {data: 'azucar', orderable   :   false, targets: 37},
                              {data: 'sodio', orderable   :   false, targets: 38},
                              {data: 'grasas_trans', orderable   :   false, targets: 39}
                            ]
          });        
          /***************************************************/
          // Enumeracion 
          oTable_vistageneral.on( 'order.dt search.dt', function () { 
            oTable_vistageneral.column(0, {search:'applied', order:'applied'}).nodes().each( function (cell, i) {
              cell.innerHTML = i+1;
              } );
          } ).draw();     
          /***************************************************/         
    };
   
    editSKU = function(id_producto,codsku){        
		$('#mhdnIdproducto').val(id_producto);
		$('#mtxtSKU').val(codsku);
    };

    $('#frmRegSKU').submit(function(event){
        event.preventDefault();
  
        $.ajax({
            url:$('#frmRegSKU').attr("action"),
            type:$('#frmRegSKU').attr("method"),
            data:$('#frmRegSKU').serialize(),
            success: function (respuesta){
                oTable_vistageneral.ajax.reload(null,false);
                alert(respuesta);
                $('#mbtnCerrarModalSKU').click();
            },
            error: function(){
              alert('Error, No se puede autenticar por error');
            }
        });
    })


    
    