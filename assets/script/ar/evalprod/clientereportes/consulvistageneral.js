var oTable_vistageneral;
var varfdesde='%', varfhasta='%';

    $(document).ready(function() {
        $('#FechaDesde, #FechaHasta').datepicker({
            format: "dd/mm/yyyy",
            autoclose: true
          }).next().on("click", function () {
            $(this).prev().focus(); 
        });
        
        
        $('#cboTipobuscar').change(function(){
            cboTipo = $('#cboTipobuscar').val();
            
            if(cboTipo == "1"){
                $("#FechaDesde").prop("disabled",true);
                $("#FechaHasta").prop("disabled",true);
                varfdesde = '%';
                varfhasta = '%';
                fechaAyerHoy();
            }else if(cboTipo == "2"){
                $("#FechaDesde").prop("disabled",false);
                $("#FechaHasta").prop("disabled",false);
                varfdesde = '';
                varfhasta = '';
                fechaActual();
            }else if(cboTipo == "0"){
                $("#FechaDesde").prop("disabled",true);
                $("#FechaHasta").prop("disabled",true);
                varfdesde = '%';
                varfhasta = '%';
                fechaActual();
            }         
        });
    
        fechaAyerHoy = function(){
            var ahora = new Date();
            ahora.setDate(ahora.getDate() - 1);
            $('#FechaDesde').datepicker('setDate', ahora);
            $('#FechaHasta').datepicker('setDate', new Date());
        }

        fechaActual = function(){
            $('#FechaDesde').datepicker('setDate', new Date());
            $('#FechaHasta').datepicker('setDate', new Date());
        }

        fechaAyerHoy();

        /*LLENADO DE COMBOS*/    
        var vccliente = '00005';//$('#idcliente').val();
        var params = { 
            "ccliente" : vccliente
        };  
        $.ajax({
            type: 'ajax',
            method: 'post',
            url: baseurl+"ar/cevalproductos/getproveedoreseval",
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

        var vccliente = '00005';//$('#idcliente').val();
        var params = { 
            "ccliente" : vccliente
        };  
        $.ajax({
            type: 'ajax',
            method: 'post',
            url: baseurl+"ar/cevalproductos/getareaeval",
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


    $('#btnBuscarListado').click(function(){

        if(varfdesde != '%'){ varfdesde = $('#FechaDesde').val(); }
        if(varfhasta != '%'){ varfhasta = $('#FechaHasta').val(); }   


        oTable_vistageneral = $('#tblvistageneral').DataTable({
            'bJQueryUI'   : true,
            'scrollY'     : '400px',
            'scrollX'     : true,
            'processing'  : true,      
            'bDestroy'    : true,
            'lengthMenu'  : [[10, 20, 30, -1], [10, 20, 30, "Todo"]],
            'paging'      : false,
            'info'        : true,
            'filter'      : true, 
            'ajax'        : {
                              "url"   : baseurl+"ar/cevalproductos/getvistageneral/",
                              "type"  : "POST", 
                              "data": function ( d ) {
                                  d.ccliente = '00005'; 
                                  d.fdesde = varfdesde; 
                                  d.fhasta = varfhasta; 
                                  d.id_area = $('#cboArea').val();
                                  d.status = $('#cbostatus').val();
                                  d.proveedor_nuevo = $('#cboProvnuevo').val();
                                  d.id_proveedor = $('#cboProveedor').val();
                                  d.expediente = $('#txtExpediente').val();
                                  d.rs = $('#txtRs').val();
                                  d.codigo = $('#txtEan').val();
                                  d.marca = $('#txtMarca').val();
                                  d.descripcion = $('#txtProducto').val();
                                  d.fabricante = $('#txtFabricante').val();
                                  d.eanmultiple = $('#mtxtEANmultiple').val();
                                  d.skumultiple = $('#mtxtSKUmultiple').val();
                              },     
                              dataSrc : ''        
            },
            dom: 'Bfrtip',
            buttons: [{
                extend: 'excelHtml5',
                text: 'Excel <i class="fa fa-file-excel-o"></i>',
                className: 'btn btn-success',
                title: 'LISTADO',
                extension: '.xlsx',
                exportOptions: {
                    modifier: {
                        page: 'current'
                    }
                }
            }],
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
                            ], 
              "columnDefs": [
                {
                    "defaultContent": " ",
                    "targets": "_all"
                }
               ],
               'order'       : [[ 1, "desc" ]] 
          });        
          /***************************************************/
          // Enumeracion 
          oTable_vistageneral.on( 'order.dt search.dt', function () { 
            oTable_vistageneral.column(0, {search:'applied', order:'applied'}).nodes().each( function (cell, i) {
              cell.innerHTML = i+1;
              } );
          } ).draw();     
          /***************************************************/         
    });
   
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


    
    