
var otblListRecepcion, otblListProducto;
var varfdesde = '%', varfhasta = '%';


$(document).ready(function() {
    $('#tablab a[href="#tablab-list-tab"]').attr('class', 'disabled');
    $('#tablab a[href="#tablab-reg-tab"]').attr('class', 'disabled active');

    $('#tablab a[href="#tablab-list-tab"]').not('#store-tab.disabled').click(function(event){
        $('#tablab a[href="#tablab-list"]').attr('class', 'active');
        $('#tablab a[href="#tablab-reg"]').attr('class', '');
        return true;
    });
    $('#tablab a[href="#tablab-reg-tab"]').not('#bank-tab.disabled').click(function(event){
        $('#tablab a[href="#tablab-reg"]').attr('class' ,'active');
        $('#tablab a[href="#tablab-list"]').attr('class', '');
        return true;
    });
    
    $('#tablab a[href="#tablab-list"]').click(function(event){return false;});
    $('#tablab a[href="#tablab-reg"]').click(function(event){return false;});

    $('#txtFDesde,#txtFHasta,#mtxtFRecep').datetimepicker({
        format: 'DD/MM/YYYY',
        daysOfWeekDisabled: [0],
        locale:'es'
    });

    fechaAnioActual();
    $('#chkFreg').prop("checked", true);

    $('#frmRecepcion').validate({
        rules: {
            mtxtmproductoreal: {
                required: true,
            },
        },
        messages: {
            mtxtmproductoreal: {
                required: "Por Favor ingrese Nombre del Producto"
            },
        },
        errorElement: 'span',
        errorPlacement: function (error, element) {
          error.addClass('invalid-feedback');
          element.closest('.form-group').append(error);
        },
        highlight: function (element, errorClass, validClass) {
          $(element).addClass('is-invalid');
        },
        unhighlight: function (element, errorClass, validClass) {
          $(element).removeClass('is-invalid');
        },        
        submitHandler: function (form) {
            var request = $.ajax({
                url:$('#frmRecepcion').attr("action"),
                type:$('#frmRecepcion').attr("method"),
                data:$('#frmRecepcion').serialize(),
                error: function(){
                    Vtitle = 'Error en Guardar!!!';
                    Vtype = 'error';
                    sweetalert(Vtitle,Vtype); 
                }
            });
            request.done(function( respuesta ) {
                var posts = JSON.parse(respuesta);
                
                $.each(posts, function() {
                    alert("ok");
                    otblListProducto.ajax.reload(null,false);
                    Vtitle = 'La Recepcion esta Guardada!!!';
                    Vtype = 'success';
                    sweetalert(Vtitle,Vtype); 
                    $('#mbtnCCreaProduc').click();    
                });
            });
            return false;
        }
    });
});

fechaActual = function(){
    var fecha = new Date();		
    var fechatring = ("0" + fecha.getDate()).slice(-2) + "/" + ("0"+(fecha.getMonth()+1)).slice(-2) + "/" +fecha.getFullYear() ;

    $('#txtFDesde').datetimepicker('date', moment(fechatring, 'DD/MM/YYYY') );
    $('#txtFHasta').datetimepicker('date', moment(fechatring, 'DD/MM/YYYY') );

};

fechaAnioActual = function(){
    $("#txtFIni").prop("disabled",false);
    $("#txtFFin").prop("disabled",false);
        
    varfdesde = '';
    varfhasta = '';
    
    var fecha = new Date();		
    var fechatring1 = "01/01/" +fecha.getFullYear() ;
    var fechatring2 = ("0" + fecha.getDate()).slice(-2) + "/" + ("0"+(fecha.getMonth()+1)).slice(-2) + "/" +fecha.getFullYear() ;

    $('#txtFDesde').datetimepicker('date', moment(fechatring1, 'DD/MM/YYYY') );
    $('#txtFHasta').datetimepicker('date', moment(fechatring2, 'DD/MM/YYYY') );
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

        
        var fecha = new Date();		
        var fechatring1 = "01/01/" +fecha.getFullYear() ;
        var fechatring2 = ("0" + fecha.getDate()).slice(-2) + "/" + ("0"+(fecha.getMonth()+1)).slice(-2) + "/" +fecha.getFullYear() ;
        $('#txtFDesde').datetimepicker('date', fechatring1);
        $('#txtFHasta').datetimepicker('date', fechatring2);

    }else if($("#chkFreg").is(":checked") == false){ 
        $("#txtFIni").prop("disabled",true);
        $("#txtFFin").prop("disabled",true);
        
        varfdesde = '%';
        varfhasta = '%';

        fechaActual();
    }; 
});

$("#btnBuscar").click(function (){
    listarBusqueda();
});

listarBusqueda = function(){
    if(varfdesde != '%'){ varfdesde = $('#txtFIni').val(); }
    if(varfhasta != '%'){ varfhasta = $('#txtFFin').val(); } 
    
    var groupColumn = 0;   
    otblListRecepcion = $('#tblListRecepcion').DataTable({  
        'responsive'    : false,
        'bJQueryUI'     : true,
        'scrollY'     	: '400px',
        'scrollX'     	: true, 
        'paging'      	: true,
        'processing'  	: true,     
        'bDestroy'    	: true,
        'AutoWidth'     : false,
        'info'        	: true,
        'filter'      	: true, 
        'ordering'		: false,  
        'stateSave'     : true,
        'ajax'	: {
            "url"   : baseurl+"lab/recepcion/crecepcion/getbuscarrecepcion/",
            "type"  : "POST", 
            "data": function ( d ) {
                d.fini      = varfdesde; 
                d.ffin      = varfhasta;   
                d.descr     = $('#txtdescri').val();  
            },     
            dataSrc : ''        
        },
        'columns'	: [
            {
              "class"     :   "index col-xs",
              orderable   :   false,
              data        :   null,
              targets     :   0,
            },
            {"orderable": false, data: 'DCLIENTE', targets: 1},
            {"orderable": false, data: 'NROCOTI', targets: 2},
            {"orderable": false, data: 'ELABORADO', targets: 3},
            {"orderable": false, data: 'DFECHA', targets: 4},
            {"orderable": false, data: 'ENTREGAINFO', targets: 5},
            {"orderable": false, 
                render:function(data, type, row){
                    return '<div class="text-left" >' +
                        '<a title="Recepcion" style="cursor:pointer; color:green;" onClick="selRecep(\'' + row.IDCOTIZACION + '\',\'' + row.NVERSION + '\',\'' + row.DCLIENTE + '\',\'' + row.NROCOTI + '\');"><span class="fas fa-edit fa-2x" aria-hidden="true"> </span> </a>'+
                    '</div>';
                }
            }
        ],  
        "columnDefs": [{
            "targets": [2], 
            "data": null, 
            "render": function(data, type, row) {
                return '<div>'+
                '    <p><a title="Cotozacion" style="cursor:pointer;" onclick="pdfCoti(\'' + row.IDCOTIZACION + '\',\'' + row.NVERSION + '\');"  class="pull-left">'+row.NROCOTI+'&nbsp;&nbsp;<i class="fas fa-file-pdf" style="color:#FF0000;"></i></a><p>' +
                '</div>';
            }
        }],
        "drawCallback": function ( settings ) {
            var api = this.api();
            var rows = api.rows( {page:'all'} ).nodes();
            var last = null;
			var grupo;
 
            api.column([1], {} ).data().each( function ( ctra, i ) { 
                grupo = api.column(1).data()[i];
                if ( last !== ctra ) {
                    $(rows).eq( i ).before(
                        '<tr class="group"><td colspan="7"><strong>'+ctra.toUpperCase()+'</strong></td></tr>'
                    ); 
                    last = ctra;
                }
            } );
        }
    }); 
    otblListRecepcion.column(0).visible( false ); 
    otblListRecepcion.column(1).visible( false );      
    // Enumeracion 
    otblListRecepcion.on( 'order.dt search.dt', function () { 
        otblListRecepcion.column(0, {search:'applied', order:'applied'}).nodes().each( function (cell, i) {
          cell.innerHTML = i+1;
          } );
    }).draw();   
};

pdfCoti = function(idcoti,nversion){
    window.open(baseurl+"lab/coti/ccotizacion/pdfCoti/"+idcoti+"/"+nversion);
};


fechaActualRecep = function(){
    var fecha = new Date();		
    var fechatring = ("0" + fecha.getDate()).slice(-2) + "/" + ("0"+(fecha.getMonth()+1)).slice(-2) + "/" +fecha.getFullYear() ;
    $('#mtxtFrecepcion').datetimepicker('date', moment(fechatring, 'DD/MM/YYYY') );
};

selRecep= function(IDCOTIZACION,NVERSION,DCLIENTE,NROCOTI){  
    
    $('#tablab a[href="#tablab-reg"]').tab('show'); 
    $('#frmRegCoti').trigger("reset");
    $('#hdnAccionregcoti').val('A'); 
    $('#mtxtidcotizacion').val(IDCOTIZACION); 
    $('#mtxtnroversion').val(NVERSION);
  
    document.querySelector('#lblclie').innerText = DCLIENTE;
    document.querySelector('#lblcoti').innerText = NROCOTI;
     
    recuperaListproducto();
    /*$('#btnParticiopantes').show();*/
};


$('#btnRetornarLista').click(function(){
    $('#tablab a[href="#tablab-list"]').tab('show');  
    //$('#btnBuscar').click();
});

recuperaListproducto = function(){
    otblListProducto = $('#tblListProductos').DataTable({  
        'responsive'    : true,
        'bJQueryUI'     : true,
        'scrollY'     	: '500px',
        'scrollX'     	: true, 
        'paging'      	: true,
        'processing'  	: true,     
        'bDestroy'    	: true,
        'AutoWidth'     : false,
        'info'        	: true,
        'filter'      	: true, 
        'ordering'		: false,  
        'stateSave'     : true,
        'ajax'	: {
            "url"   : baseurl+"lab/recepcion/crecepcion/getrecepcionmuestra/",
            "type"  : "POST", 
            "data": function ( d ) {
                d.idcoti    = $('#mtxtidcotizacion').val(); 
                d.nversion  = $('#mtxtnroversion').val();  
            },     
            dataSrc : ''        
        },
        'columns'	: [
            {
              "class"     :   "index col-xs",
              orderable   :   false,
              data        :   null,
              targets     :   0,
            },
            {"orderable": false, data: 'frecepcionmuestra', targets: 1},
            {"orderable": false, data: 'cmuestra', targets: 2},
            {"orderable": false, data: 'drealproducto', targets: 3},
            {"orderable": false, data: 'dpresentacion', targets: 4},
            {"orderable": false, data: 'dtemperatura', targets: 5},
            {"orderable": false, data: 'dcantidad', targets: 6},
            {"orderable": false, data: 'dproveedorproducto', targets: 7},
            {"orderable": false, data: 'dlote', targets: 8},
            {"orderable": false, data: 'fenvase', targets: 9},
            {"orderable": false, data: 'fmuestra', targets: 10},
            {"orderable": false, data: 'hmuestra', targets: 11},
            {"orderable": false, data: 'ntrimestre', targets: 12},
            {"orderable": false, data: 'zctipomotivo', targets: 13},
            {"orderable": false, data: 'careacliente', targets: 14},
            {"orderable": false, data: 'dubicacion', targets: 15},
            {"orderable": false, data: 'zctipoitem', targets: 16},
            {"orderable": false, data: 'stottus', targets: 17},
            {"orderable": false, data: 'dcondicion', targets: 18},
            {"orderable": false, data: 'dobservacion', targets: 19},
            {"orderable": false, data: 'dotraobservacion', targets: 20},
            {responsivePriority: 1,"orderable": false, 
                render:function(data, type, row){
                    return '<div class="text-left" >' +
                        '<a href="javascript:;" data-toggle="modal" title="Editar" style="cursor:pointer; color:green;" data-target="#modalRecepcion" onClick="selCotiprodu(\'' + row.cinternocotizacion + '\',\'' + row.nversioncotizacion + '\',\'' + row.nordenproducto + '\',\'' + row.cmuestra + '\',\'' + row.frecepcionmuestra + '\',\'' + row.drealproducto + '\',\'' + row.dpresentacion + '\',\'' + row.dtemperatura + '\',\'' + row.dcantidad + '\',\'' + row.dproveedorproducto + '\',\'' + row.dlote + '\',\'' + row.fenvase + '\',\'' + row.fmuestra + '\',\'' + row.hmuestra + '\',\'' + row.stottus + '\',\'' + row.ntrimestre + '\',\'' + row.zctipomotivo + '\',\'' + row.careacliente + '\',\'' + row.zctipoitem + '\',\'' + row.dubicacion + '\',\'' + row.dcondicion + '\',\'' + row.dobservacion + '\',\'' + row.dotraobservacion + '\');"><span class="fas fa-edit fa-2x" aria-hidden="true"> </span> </a>'+
                    '</div>';
                }
            }
        ]
    }); 

    // Enumeracion 
    otblListProducto.on( 'order.dt search.dt', function () { 
        otblListProducto.column(0, {search:'applied', order:'applied'}).nodes().each( function (cell, i) {
          cell.innerHTML = i+1;
          } );
    }).draw();
};

$('#modalRecepcion').on('shown.bs.modal', function (e) {
    
    $('#mtxtFRecep').datetimepicker({
        format: 'DD/MM/YYYY',
        daysOfWeekDisabled: [0],
        locale:'es'
    });

    $("#mtxtregnumcoti").prop({readonly:true});  
    
    $('#divExtra').hide();
});

selCotiprodu = function(cinternocotizacion,nversioncotizacion,nordenproducto,cmuestra,frecepcionmuestra,drealproducto,dpresentacion,dtemperatura,dcantidad,dproveedorproducto,dlote,fenvase,fmuestra,hmuestra,stottus,ntrimestre,zctipomotivo,careacliente,zctipoitem,dubicacion,dcondicion,dobservacion,dotraobservacion){
    $('#frmRecepcion').trigger("reset");
    $('#mhdnAccionRecepcion').val('A');
    
    $('#mhdnidcotizacion').val(cinternocotizacion); 
    $('#mhdnnroversion').val(nversioncotizacion);
    $('#mhdnnordenproducto').val(nordenproducto);

    $('#mtxtmcodigo').val(cmuestra);
    
    if(frecepcionmuestra == 'null'){
        fechaActualRecep();
    }else{
        $('#mtxtFrecepcion').val(frecepcionmuestra);
    }
    
    $('#mtxtmproductoreal').val(drealproducto);
    $('#mtxtmpresentacion').val(dpresentacion);
    $('#mtxttemprecep').val(dtemperatura);
    $('#mtxtcantmuestra').val(dcantidad);    
    $('#mtxtproveedor').val(dproveedorproducto);
    $('#mtxtnrolote').val(dlote);
    
    if(fenvase == 'null'){
        $('#mtxtFenvase').val('');
    }else{
        $('#mtxtFenvase').val(fenvase);
        $('#mtxtFenvase').datetimepicker({
            format: 'DD/MM/YYYY',
            daysOfWeekDisabled: [0],
            locale:'es'
        });
    }
    
    if(fmuestra == 'null'){
        $('#mtxtFmuestra').val('');
    }else{
        $('#mtxtFmuestra').val(fmuestra);
        $('#mtxtFmuestra').datetimepicker({
            format: 'DD/MM/YYYY',
            daysOfWeekDisabled: [0],
            locale:'es'
        });
    }

    $('#mtxthmuestra').val(hmuestra);
    $('#mcbotottus').val(stottus);
    $('#mcbomonitoreo').val(ntrimestre);
    $('#mcbomotivo').val(zctipomotivo);
    $('#mcboarea').val(careacliente);
    $('#mcboitem').val(zctipoitem);
    $('#mtxtubicacion').val(dubicacion);
    $('#mtxtestado').val(dcondicion);
    $('#mtxtObserva').val(dobservacion);
    $('#mtxtObsotros').val(dotraobservacion);
};
   