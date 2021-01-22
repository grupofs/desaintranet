var oTable_listaexpediente;
var varfdesde = '', varfhasta = '';

    $(document).ready(function() {
        $('#txtFDesde,#txtFHasta').datetimepicker({
            format: 'DD/MM/YYYY',
            daysOfWeekDisabled: [0],
            locale:'es'
        });
        
        fechaAyerHoy();

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

    });

    fechaActual = function(){
        var fecha = new Date();		
        var fechatring = ("0" + fecha.getDate()).slice(-2) + "/" + ("0"+(fecha.getMonth()+1)).slice(-2) + "/" +fecha.getFullYear() ;
    
        $('#txtFDesde').datetimepicker('date', moment(fechatring, 'DD/MM/YYYY') );
        $('#txtFHasta').datetimepicker('date', moment(fechatring, 'DD/MM/YYYY') );
    }
    fechaAyerHoy = function(){
        var ayer = new Date();	
        var ahora = new Date();	

        ayer.setDate(ayer.getDate() - 1);	

        var ayerstring = ("0" + ayer.getDate()).slice(-2) + "/" + ("0"+(ayer.getMonth()+1)).slice(-2) + "/" +ayer.getFullYear() ;
        var ahorastring = ("0" + ahora.getDate()).slice(-2) + "/" + ("0"+(ahora.getMonth()+1)).slice(-2) + "/" +ahora.getFullYear() ;
    
        $('#txtFDesde').datetimepicker('date', moment(ayerstring, 'DD/MM/YYYY') );
        $('#txtFHasta').datetimepicker('date', moment(ahorastring, 'DD/MM/YYYY') );
    }
	
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

    $('#cboTipobuscar').click(function(){
        /*$("#FechaRegistroIni").prop("disabled",$("#chkFini").is(":checked"));*/
        cboTipo = $('#cboTipobuscar').val();
        
        if(cboTipo == "1"){
            $("#txtFIni").prop("disabled",true);
            $("#txtFFin").prop("disabled",true);

            varfdesde = '%';
            varfhasta = '%';

            fechaAyerHoy();
        }else if(cboTipo == "2"){
            var fecha = new Date();		
            var fechatring1 = "01/01/" +fecha.getFullYear() ;
            var fechatring2 = ("0" + fecha.getDate()).slice(-2) + "/" + ("0"+(fecha.getMonth()+1)).slice(-2) + "/" +fecha.getFullYear() ;
        
            $("#txtFIni").prop("disabled",false);
            $("#txtFFin").prop("disabled",false);
            
            varfdesde = '';
            varfhasta = '';
    
            $('#txtFDesde').datetimepicker('date', fechatring1);
            $('#txtFHasta').datetimepicker('date', fechatring2);
        }else if(cboTipo == "3"){
            $("#txtFIni").prop("disabled",true);
            $("#txtFFin").prop("disabled",true);
            
            varfdesde = '%';
            varfhasta = '%';

            fechaActual();
        }         
    });

    $('#btnBuscar').click(function(){ 

        if(varfdesde != '%'){ varfdesde = $('#txtFIni').val(); }
        if(varfhasta != '%'){ varfhasta = $('#txtFFin').val(); }  

        var parametros = {            
            "ccliente" : '00005', //$('#idcliente').val();  
            "cproveedor" : $('#cboProveedor').val(), 
            "expediente" : $('#txtExpediente').val(),
            "fdesde" : varfdesde,
            "fhasta" : varfhasta,
        };  
    
        getListaexpedientes(parametros);
    });
    
    getListaexpedientes = function(param){ 
        oTable_listaexpediente = $('#tbllistaexpedientes').DataTable({
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
                              "url"   : baseurl+"ar/evalprod/cclientereportes/getlistarexpedientes/",
                              "type"  : "POST", 
                              "data": param,   
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
                              {data: 'proveedor', orderable   :   false, targets: 2},
                              {data: 'total', orderable   :   false, targets: 3},
                              {data: 'fecha', orderable   :   false, targets: 4},
                              {data: 'flimite', orderable   :   false, targets: 5},
                              {"orderable": false, 
                                render:function(data, type, row){
                                    if(row.ruta_ficha != null) {
                                        return  '<div>'+  
                                                '<a href="'+baseurl+'FTPfileserver/Archivos/' + row.ruta_ficha+'" target="_blank" ><i class="fas fa-file-pdf fa-2x"></i></a>' +
                                                '</div>'
                                    } else {
                                        return  '<div>'+
                                                ''+  
                                                '</div>'
                                    }  
                                }
                              },
                              {"orderable": false, 
                                render:function(data, type, row){
                                    if(row.ruta_expediente != null) {
                                        return  '<div>'+  
                                                '<a href="'+baseurl+'FTPfileserver/Archivos/' + row.ruta_expediente+'" target="_blank" ><i class="fas fa-file-pdf fa-2x"></i></a>' +
                                                '</div>'
                                    } else {
                                        return  '<div>'+
                                                ''+  
                                                '</div>'
                                    }  
                                }
                              },
                              {data: 'destado', orderable   :   false, targets: 8}
                            ]
          });        
          // Enumeracion 
          oTable_listaexpediente.on( 'order.dt search.dt', function () { 
            oTable_listaexpediente.column(0, {search:'applied', order:'applied'}).nodes().each( function (cell, i) {
              cell.innerHTML = i+1;
              } );
          } ).draw();     
          /***************************************************/         
    };