
var oTableCliente;
var folderimage;

$(document).ready(function() {
    $('#tabptcliente a[href="#tabptcliente-list-tab"]').attr('class', 'disabled');
    $('#tabptcliente a[href="#tabptcliente-reg-tab"]').attr('class', 'disabled active');

    $('#tabptcliente a[href="#tabptcliente-list-tab"]').not('#store-tab.disabled').click(function(event){
        $('#tabptcliente a[href="#tabptcliente-list"]').attr('class', 'active');
        $('#tabptcliente a[href="#tabptcliente-reg"]').attr('class', '');
        return true;
    });
    $('#tabptcliente a[href="#tabptcliente-reg-tab"]').not('#bank-tab.disabled').click(function(event){
        $('#tabptcliente a[href="#tabptcliente-reg"]').attr('class' ,'active');
        $('#tabptcliente a[href="#tabptcliente-eval"]').attr('class', '');
        return true;
    });
    
    $('#tabptcliente a[href="#tabptcliente-list"]').click(function(event){return false;});
    $('#tabptcliente a[href="#tabptcliente-reg"]').click(function(event){return false;});
    
    $("#boxUbigeo").hide();

    $.ajax({
        type: 'ajax',
        method: 'post',
        url: baseurl+"cglobales/getpaises",
        dataType: "JSON",
        async: true,
        success:function(result)
        {
            $('#cboPais,#cboPaisEstable').html(result);
        },
        error: function(){
            alert('Error, No se puede autenticar por error');
        }
    });
    $.ajax({
      type: 'ajax',
      method: 'post',
      url: baseurl+"cglobales/getdepartamentos",
      dataType: "JSON",
      async: true,
      success:function(result)
      {
          $('#cboDepa').html(result);
      },
      error: function(){
        alert('Error, No se puede autenticar por error');
      }
    });

    var btnCust = '';
  
    $("#logo_image").fileinput({
      overwriteInitial: true,
      maxFileSize: 1500,
      showClose: false,
      showCaption: false,
      browseLabel: '',
      removeLabel: '',
      browseIcon: '<i class="far fa-file-image"></i>',
      removeIcon: '<i class="fas fa-times-circle"></i>',
      removeTitle: 'Cancel or reset changes',
      elErrorContainer: '#kv-avatar-errors-1',
      msgErrorClass: 'alert alert-block alert-danger',
      layoutTemplates: {main2: '{preview} ' +  btnCust + ' {remove} {browse}'},
      allowedFileExtensions: ["jpg", "png", "gif"]
    });
});

listarcliente = function(){
    oTableCliente = $('#tblListPtcliente').DataTable({
      "bJQueryUI": true,
      'bStateSave': true,
      'scrollY':        400,
      'scrollX':        true,
      'scrollCollapse': true,
      "ordering": false,
      'bDestroy'    : true,
      'lengthMenu'  : [[10, 20, 30, -1], [10, 20, 30, "Todo"]],
      'paging'      : true,
      'info'        : true,
      'filter'      : true,   
      'stateSave'   : true,
      'processing'  : true, 
      'ajax'        : {
        "url"   : baseurl+"pt/cptcliente/getbuscarclientes",
        "type"  : "POST", 
        "data": function ( d ) {
          d.cliente = $('#txtCliente').val();   
        },     
        dataSrc : ''        
      },
      'columns'     : [
          {data: 'POS',targets: 0},
          {data: 'NRUC',targets: 1 },
          {data: 'DRAZONSOCIAL', targets: 2},
          {data: 'DDIRECCIONCLIENTE', targets: 3},
          {data: 'DTELEFONO', targets: 4},
          {data: 'DREPRESENTANTE', targets: 5},  
          {"orderable": false, 
            render:function(data, type, row){
              if(row.DRUTA == ''){
                return '<div>' +
                '<img src="'+baseurl+'FTPfileserver/Imagenes/clientes/unknown.png"  width="120" height="60" class="img-circle">'+
                '</div>' ; 
              }else{
                return '<div>' +
                '<img src="'+baseurl+'FTPfileserver/Imagenes/clientes/'+row.DRUTA+'"  width="120" height="60" class="img-circle">'+
                '</div>' ; 
              }
            }
          },
          {"orderable": false, 
            render:function(data, type, row){
              return '<div>' +
              '<a onclick="editarCliente(\''+row.CCLIENTE+'\',\''+row.NRUC+'\',\''+row.DRAZONSOCIAL+'\',\''+row.cpais+'\',\''+row.dciudad+'\',\''+row.destado+'\',\''+row.dzip+'\',\''+row.CUBIGEO+'\',\''+row.DDIRECCIONCLIENTE+
              '\',\''+row.DTELEFONO+'\',\''+row.DFAX+'\',\''+row.dweb+'\',\''+row.ZCTIPOTAMANOEMPRESA+'\',\''+row.NTRABAJADOR+'\',\''+row.DREPRESENTANTE+'\',\''+row.DCARGOREPRESENTANTE+'\',\''+row.DEMAILREPRESENTANTE+
              '\',\''+row.DRUTA+'\',\''+row.TIPODOC+'\',\''+row.DUBIGEO+'\');"><i style="color:#088A08;" class="fa fa-edit fa-2x" data-original-title="EDITAR" data-toggle="tooltip"></i></a>' +
              '</div>' ; 
            }
          },
          {"orderable": false, 
            render:function(data, type, row){
              return  '<div>'+  
              '<a data-toggle="modal" data-target="#modalestablecimiento"  onClick="javascript:Agregarestable(\''+row.CCLIENTE+'\',\''+row.DRAZONSOCIAL+'\',\''+row.DDIRECCIONCLIENTE+'\',\''+row.dzip+'\',\''+row.cpais+'\',\''+row.dciudad+'\',\''+row.destado+'\',\''+row.CUBIGEO+'\',\''+row.DUBIGEO+'\');"><i style="color:#E8831F;" class="fa fa-plus-square fa-2x" data-original-title="Agregar Establecimiento" data-toggle="tooltip"></i></a>'+
              '</div>'   
            }
          }
      ], 
    });     
};

$('#btnBuscar').click(function(){
  listarcliente();
});

$('#btnNuevo').click(function(){    
    $('#tabptcliente a[href="#tabptcliente-reg"]').tab('show'); 
    limpiarForm(); 
    $('#divlogo').hide();
    $('#btnGrabar').show(); 
    $('#hdnAccionptclie').val('N'); 
});

$('#btnRetornar').click(function(){
    $('#tabptcliente a[href="#tabptcliente-list"]').tab('show');  
});

$('#cboPais').change(function(){
  var v_cpais = $( "#cboPais option:selected").attr("value");
  $('#mtxtUbigeo').val('');
  $('#hdnidubigeo').val('');
  if(v_cpais == '290'){
    $("#boxCiudad").hide();
    $("#boxEstado").hide();
    $("#boxUbigeo").show();      
  } else {
    $("#boxCiudad").show();
    $("#boxEstado").show();
    $("#boxUbigeo").hide(); 
  }
});

$('#btnBuscarUbigeo').click(function() {
  $("#modalUbigeo").modal();	
});

$('#cboDepa').change(function(){
  var v_cdepa = $( "#cboDepa option:selected").attr("value");
  var params = { "cdepa" : v_cdepa};  
  $.ajax({
    type: 'ajax',
    method: 'post',
    url: baseurl+"cglobales/getprovincias",
    dataType: "JSON",
    async: true,
    data: params,
    success:function(result){
        $('#cboProv').html(result);
    },
    error: function(){
      alert('Error, No se puede autenticar por error');
    }
  });
});

$('#cboProv').change(function(){
  var v_cdepa = $( "#cboDepa option:selected").attr("value");
  var v_cprov = $( "#cboProv option:selected").attr("value");
  var params = { 
    "cdepa" : v_cdepa,
    "cprov" : v_cprov
  };  
  $.ajax({
    type: 'ajax',
    method: 'post',
    url: baseurl+"cglobales/getdistritos",
    dataType: "JSON",
    async: true,
    data: params,
    success:function(result){
        $('#cboDist').html(result);
    },
    error: function(){
      alert('Error, No se puede autenticar por error');
    }
  });
});

$('#btnSelUbigeo').click(function(){
  var v_cubigeo = $( "#cboDist option:selected").attr("value");
  var v_depa = $("#cboDepa").find('option:selected').text();
  var v_prov = $("#cboProv").find('option:selected').text();
  var v_dist = $("#cboDist").find('option:selected').text();
  $('#mtxtUbigeo').val(v_depa+' - '+v_prov+' - '+v_dist);
  $('#hdnidubigeo').val(v_cubigeo);
  $("#btncerrarUbigeo").click(); 

});

registrar_imagen = function(){
  var archivoInput = document.getElementById('logo_image').files[0].name;
  var archivoRuta = archivoInput;
  var extPermitidas = /(.gif|.jpg|.png)$/i;

  if(!extPermitidas.exec(archivoRuta)){
    alert('Asegurese de haber seleccionado un gif, jpg, png');
    archivoInput.value = '';
    return false;
  }
  else
  {
    var parametrotxt = new FormData($("#frmMantptClie")[0]);
      $.ajax({
        data: parametrotxt,
        method: 'post',
        url: baseurl+"pt/cptcliente/upload_image",
        dataType: "JSON",
        async: true,
        contentType: false,
        processData: false,
        success: function(response){
          folderimage = response[0];
          $('#utxtlogo').val(folderimage);          
        },
        error: function(){
          alert('Error, no se cargó el archivo');
        }

      });
  }
}

editarCliente = function(ccliente,nruc,drazonsocial,cpais,dciudad,destado,dzip,cubigeo,ddireccioncliente,dtelefono,
                        dfax,dweb,zctipotamanoempresa,ntrabajador,drepresentante,dcargorepresentante,demailrepresentante,
                        druta,tipodoc,dubigeo){
  var ruta_imagen;
  ruta_imagen = baseurl+'FTPfileserver/Imagenes/clientes/'+druta;

  $('#hdnIdptclie').val(ccliente);    
  $('#txtnrodoc').val(nruc);    
  $('#txtrazonsocial').val(drazonsocial);    
  $('#cboPais').val(cpais).trigger("change"); 
  $('#txtCiudad').val(dciudad);    
  $('#txtEstado').val(destado);    
  $('#hdnidubigeo').val(cubigeo); 
  $('#mtxtUbigeo').val(dubigeo);     
  $('#txtCodigopostal').val(dzip);    
  $('#txtDireccion').val(ddireccioncliente);    
  $('#txtTelefono').val(dtelefono);    
  $('#txtFax').val(dfax);      
  $('#txtWeb').val(dweb);    
  $('#txtTipoempresa').val(zctipotamanoempresa);  
  $('#txtNroTrab').val(ntrabajador); 
  $('#txtRepresentante').val(drepresentante); 
  $('#txtCargorep').val(dcargorepresentante); 
  $('#txtEmailrep').val(demailrepresentante);   
  $('#hdnAccionptclie').val('E'); 
  $('#utxtlogo').val(druta);  
  $('#cboTipoDoc').val(tipodoc);  
  document.getElementById("image_previa").src = ruta_imagen; 
  $('#tabptcliente a[href="#tabptcliente-reg"]').tab('show'); 
  $('#divlogo').show();
  $("#mbtnsavecliente").prop('disabled',false);
};

limpiarForm = function(){    
  $('#frmMantptClie').trigger("reset");
  $('#hdnIdptclie').val('');
  $('#cboPais').val('').trigger("change"); 
  $('#cboUbigeo').val('').trigger("change");
}

$('#frmMantptClie').submit(function(event){
    event.preventDefault();
    
    var request = $.ajax({
        url:$('#frmMantptClie').attr("action"),
        type:$('#frmMantptClie').attr("method"),
        data:$('#frmMantptClie').serialize(),
        error: function(){
          alert('Error, No se puede autenticar por error');
        }
    });
    request.done(function( respuesta ) {
        
            Vtitle = 'Datos Guardados correctamente';
            Vtype = 'success';
            sweetalert(Vtitle,Vtype);
            limpiarForm();    
            listarcliente();
            $('#tabptcliente a[href="#tabptcliente-list"]').tab('show'); 
    });
});

Agregarestable = function(ccliente,razonsocial,direccioncliente,dzip, cpais,dciudad,destado,cubigeo,dubigeo){
  $('#mhdnIdClie').val(ccliente);
  $('#txtestableCI').val(razonsocial);
  $('#txtestabledireccion').val(direccioncliente);
  $('#txtestablezip').val(dzip);

  $('#cboPaisEstable').val(cpais).trigger("change");
  $('#txtCiudadEstable').val(dciudad);
  $('#txtEstadoEstable').val(destado);

  $('#hdnidubigeoEstable').val(cubigeo);
  $('#mtxtUbigeoEstable').val(dubigeo); 
  $('#mhdnAccionEstable').val('N');   
  

  
  tblEstablecimiento = $('#tblEstablecimiento').DataTable({
    "bJQueryUI": true,
    'bStateSave': true,
    'scrollY':        400,
    'scrollX':        true,
    'scrollCollapse': true,
    "ordering": false,
    'fixedColumns':{
      'leftColumns': false,// Fijo primera columna
      'rightColumns':1
    },

    'bDestroy'    : true,
    'lengthMenu'  : [[10, 20, 30, -1], [10, 20, 30, "Todo"]],
    'paging'      : true,
    'info'        : true,
    'filter'      : true,   
    'stateSave'   : true,
    'ajax'        : {
                      "url"   : baseurl+"pt/cptcliente/getbuscarestablecimiento",
                      "type"  : "POST", 
                      "data": function ( d ) {
                          d.IDCLIENTE = ccliente

                      },     
                      dataSrc : ''        
                    },
    'columns'     : [
        
                      {data: 'POS', targets: 0 },
                      {data: 'DESCRIPESTABLE', targets: 1 },
                      {data: 'DIRECCION', targets: 2 },
                      {data: 'RESPONCALIDAD', targets: 3 },
                      {data: 'TELEFONOCALIDAD', targets: 4 },
                      {data: 'ESTADO', targets: 5},
                      {"orderable": false, 
                        render:function(data, type, row){
                          return  '<div>'+  
                                    '<a data-original-title="Editar" onClick="javascript:EditarEstablecimiento(\''+row.COD_ESTABLE+'\',\''+row.DESCRIPESTABLE+'\',\''+row.DIRECCION+'\',\''+row.DZIP+'\',\''+row.FCE+'\','+
                                    '\''+row.ECP+'\',\''+row.FFRN+'\',\''+row.RESPONCALIDAD+'\',\''+row.CARGOCALIDAD+'\',\''+row.EMAILCALIDAD+'\',\''+row.ESTADO+'\',\''+row.TELEFONOCALIDAD+'\',\''+row.PAIS+'\',\''+row.CIUDAD+'\',\''+row.ESTESTABLE+'\',\''+row.UBIGEO+'\');"><i class="fa fa-edit fa-2x" data-original-title="Editar" data-toggle="tooltip"></i></a>'+
                                    '&nbsp; &nbsp;'+
                                    '<a data-original-title="Eliminar" data-toggle="modal" data-target="#modaldelestablecimiento" onClick="javascript:SelDeleteEstable(\''+row.COD_ESTABLE+'\');"><i class="fa fa-trash-o fa-2x" data-original-title="Eliminar" data-toggle="tooltip"></i></a>'+
                                    '&nbsp; &nbsp;'+
                                      '<a data-original-title="Agregar Contacto" data-toggle="modal" data-target="#modalestablecontacto" onClick="javascript:Selcontactoestable(\''+row.COD_ESTABLE+'\',\''+row.COD_CLIENTE+'\');"><i class="fa fa-users fa-2x" data-original-title="Agregar Contacto" data-toggle="tooltip"></i></a>'+
                                  '</div>'   
                        }
                      }
                    ], 
    "columnDefs": [
        {
          "targets": [5], 
          "data": "ESTADO", 
          "render": function(data, type, row) {            
            if (data ==  "A") {
              return "<span class='label label-success'>Activo</span>";
            }else if (data == "I") {
              return "<span class='label label-danger'>Inactivo</span>";
            }              
          }
        }
    ],
  });
}

$('#cboPaisEstable').change(function(){
    var v_cpais = $( "#cboPaisEstable option:selected").attr("value");
    
  $('#mtxtUbigeoEstable').val('');
  $('#hdnidubigeoEstable').val('');

    if(v_cpais == '290'){
      $("#boxCiudadEstable").hide();
      $("#boxEstadoEstable").hide();
      $("#boxUbigeoEstable").show();      
    } else {
      $("#boxCiudadEstable").show();
      $("#boxEstadoEstable").show();
      $("#boxUbigeoEstable").hide(); 
    }
});

$('#btnBuscarUbigeoEstable').click(function() {
  $("#modalUbigeo").modal();	
});

$('#frmMantEstablecimiento').submit(function(event){

  event.preventDefault();
  
  var request = $.ajax({
      url:$('#frmMantEstablecimiento').attr("action"),
      type:$('#frmMantEstablecimiento').attr("method"),
      data:$('#frmMantEstablecimiento').serialize(),
      error: function(){
        alert('Error, No se puede autenticar por error');
      }
  });
  request.done(function( respuesta ) {
      
          Vtitle = 'Datos Guardados correctamente';
          Vtype = 'success';
          sweetalert(Vtitle,Vtype);
          limpiarForm();    
          $('#tabptestable a[href="#tab_listaestable"]').tab('show'); 
  });
});

/**/
  (function($, window) {
    'use strict';

    var MultiModal = function(element) {
        this.$element = $(element);
        this.modalCount = 0;
    };

    MultiModal.BASE_ZINDEX = 1040;

    MultiModal.prototype.show = function(target) {
        var that = this;
        var $target = $(target);
        var modalIndex = that.modalCount++;

        $target.css('z-index', MultiModal.BASE_ZINDEX + (modalIndex * 20) + 10);

        window.setTimeout(function() {
            if(modalIndex > 0)
                $('.modal-backdrop').not(':first').addClass('hidden');

            that.adjustBackdrop();
        });
    };

    MultiModal.prototype.hidden = function(target) {
        this.modalCount--;

        if(this.modalCount) {
          this.adjustBackdrop();
            $('body').addClass('modal-open');
        }
    };

    MultiModal.prototype.adjustBackdrop = function() {
        var modalIndex = this.modalCount - 1;
        $('.modal-backdrop:first').css('z-index', MultiModal.BASE_ZINDEX + (modalIndex * 20));
    };

    function Plugin(method, target) {
        return this.each(function() {
            var $this = $(this);
            var data = $this.data('multi-modal-plugin');

            if(!data)
                $this.data('multi-modal-plugin', (data = new MultiModal(this)));

            if(method)
                data[method](target);
        });
    }

    $.fn.multiModal = Plugin;
    $.fn.multiModal.Constructor = MultiModal;

    $(document).on('show.bs.modal', function(e) {
        $(document).multiModal('show', e.target);
    });

    $(document).on('hidden.bs.modal', function(e) {
        $(document).multiModal('hidden', e.target);
    });
  }(jQuery, window));
