
  
 /***            BUSCAR NORMATIVAS                 ***/
/****************************************************/

var oTable;
var tipoest = '%';
var bfind = false;
var folder;
var folderguia;
var folderguiaedit;
var tipodocu;
var arearesp;
var cboidioma;
var cbopais;
var cboinstitucion;
var tblguia;
var tipofind;
var cboeditins;
var rutaarchivo;
var rutaarchivoguia;
var tbllistnormas;

var iduser = $('#mtxtidusunormas').val();

$(document).ready(function(){


    $.ajax({ //Obtener Documento
        type: 'ajax',
        method: 'post',
        url: baseurl+"adm/interno/cnormas/getDocumentos",
        dataType: "JSON",
        async: true,
        success:function(result)
        {
            $('#cboDoc').html(result);
        },
        error: function(){
            alert('Error, No se puede autenticar por error');
        }
    });

    $.post(baseurl+"adm/interno/cnormas/getidioma",
      {
      },
      function(data){   
        var c = JSON.parse(data);
        $.each(c,function(i,item){
          $('#idiomacboavz').append('<option value="'+item.id_idioma+'">'+item.idioma_descripcion+'</option>');
        })
      }
    );

    $.post(baseurl+"adm/interno/cnormas/getpais",
      {
      },
      function(data){   
        var c = JSON.parse(data);
        $.each(c,function(i,item){
          $('#paiscboavz').append('<option value="'+item.id_pais+'">'+item.pais_descripcion+'</option>');
        })
      }
    );

    $.post(baseurl+"adm/interno/cnormas/getinstitucion",
      {
      },
      function(data){   
        var c = JSON.parse(data);
        $.each(c,function(i,item){
          $('#institucioncboavz').append('<option value="'+item.id_institucion+'">'+item.institucion_abrevia+'</option>');
        })
      }
    );

    // OCULTAR/MOSTRAR BUSQUEDA AVANZADA
    $("#chkAvanzado").on("change", function () {
        if ($("#chkAvanzado").is(":checked")) {
           $("#avanzado").show();
          } else{
            $("#avanzado").hide(); } 
    });


    $("#Todos").on("change", function () {
        $("#FechaInicial").prop("disabled",$("#Todos").is(":checked"));
        $("#FechaTermino").prop("disabled",$("#Todos").is(":checked"));
          if(this.checked == true){ 
            tipofind ='S'
          }
          else if(this.checked == false){ 
            tipofind ='N'
          }; 
    });

    $("#Todos").click();



    // Iniciar Tabla
    $("#tblListado").DataTable();


});

  // BUSCAR NORMA

  consultgestdocum = function(){
    $(document).ready(function() {
      'use strict';
      if(document.getElementById("cboDoc").value == "%"||document.getElementById("cboDoc").value == ""){
        tipodocu = ["%"];
      }else{
        tipodocu = $('#cboDoc').val();
      }
  
      if(document.getElementById("cboResp").value == ""){
        arearesp = ["%"];
      }else{
        arearesp = $('#cboResp').val();
      }
  
      if(document.getElementById("idiomacboavz").value == ""){
        cboidioma = ["%"];
      }else{
        cboidioma = $('#idiomacboavz').val();
      }
  
      if(document.getElementById("paiscboavz").value == ""){
        cbopais = ["%"];
      }else{
        cbopais = $('#paiscboavz').val();
      }
  
      if(document.getElementById("institucioncboavz").value == ""){
        cboinstitucion = ["%"];
      }else{
        cboinstitucion = $('#institucioncboavz').val();
      }
  
      //$("#btnexcelNormas").removeAttr("disabled");
      bfind = false;
      // Convertir tabla a datatable
      oTable = $('#tblListado').DataTable({
        "bJQueryUI": false,
        'bStateSave': true,
        'scrollY':        400,
        'scrollX':        true,
        'scrollCollapse': true,
        "ordering": false,
        
        //'dom': "Bfrtip",
        /*'fixedColumns':{
          'leftColumns': 1,// Fijo primera columna
          //'rightColumns':1
  
        },*/
  
        'bDestroy'    : true,
        'lengthMenu'  : [[10, 25, 50, -1], [10, 25, 50, "TOdo"]],
        'paging'      : true,
        'info'        : true,
        'filter'      : true,   
        'stateSave'   : true,
        'processing'  : true,     
        'ajax'        : {
                          "url"   : baseurl+"adm/interno/cnormas/getbuscarnormativa",
                          "type"  : "POST", 
                          "data": function ( d ) {
                              d.TIPODOC =  tipodocu;// Recupera valor de busqueda a variable
                              d.DESCRI = $('#txtDescri').val();
                              d.RESP = arearesp;
                              d.EST = tipoest;
                              d.IDIOMA = cboidioma;
                              d.PAIS = cbopais;
                              d.INSTITUCION = cboinstitucion;
                              d.PALCLAVE = $('#placlavecboavz').val();
                              d.allf     = tipofind;
                              d.fi = $('#FechaInicial').val();
                              d.ff = $('#FechaTermino').val();
  
                          },     
                          dataSrc : ''        
                        },
        'columns'     : [
                          {data:'POS', // Enumeracion y Formato lateral derecho
                          sortable: false,
                          "class": "index",
                          targets: 0
                          } ,
                         
                          {data: 'NORMA_CODIGO', targets: 1 },
                          {data: 'NORMA_TITULO', targets: 2 },
                          {data: 'TIPODOC_DESCRIPCION', targets: 3},
                          {data: 'NORMA_AREARESP', targets: 4},
                          {data: 'PAIS_DESCRIPCION', targets: 5},
                          {data: 'INSTITUCION_DESCRIPCION', targets: 6},
                          {data: 'IDIOMA_DESCRIPCION', targets: 7},
                          {data: 'NORMA_FPUBLICACION', targets: 8},
                          {data: 'NORMA_ESTADO', targets: 9},
                          {"orderable": false, 
                            render:function(data, type, row){
                              bfind = true;   
                              return  '<div>'+  
                                        '<a href="'+baseurl+'/Uploads/Archivos/BIBLIOTECA-NORMATIVAS/'+row.NORMA_ARCHIVO+'" target="_blank" class="btn btn-default btn-xs pull-left"><i class="fa fa-cloud-download fa-2x" data-original-title="Descargar" data-toggle="tooltip"></i></a>' +
      
                                      '</div>'   
                            }
                          },
                          {"orderable": false, 
                          render:function(data, type, row){
                            bfind = true;   
                            if(iduser == row.IDUSUARIO){
                              return  '<div>'+  
                                        '<a href="#" data-original-title="Editar" data-toggle="modal" data-target="#modalEditarNorma" onClick="javascript:selNormativa(\''+row.ID_NORMA+'\',\''+row.NORMA_CODIGO+'\',\''+row.ID_TIPODOC+'\',\''+row.ID_IDIOMA+'\',\''+row.ID_PAIS+'\',\''+row.ID_INSTITUCION+'\',\''+row.NORMA_PUBLICACION+'\',\''+row.NORMA_TITULO+'\',\''+row.NORMA_FPUBLICACION+'\',\''+row.NORMA_FVENCIMIENTO+'\',\''+row.NORMA_VERSION+'\',\''+row.NORMA_PALABRACLAVE+'\',\''+row.NORMA_AREARESP+'\',\''+row.NORMA_COMENTARIO+'\',\''+row.NORMA_ESTADO+'\',\''+row.NORMA_HEREDA+'\',\''+row.NORMA_ARCHIVO+'\',\''+row.FVIGENCIA1+'\',\''+row.FVIGENCIA2+'\',\''+row.FVIGENCIA3+'\',\''+row.NOTA1+'\',\''+row.NOTA2+'\',\''+row.NOTA3+'\',\''+row.RUTAFILE+'\',\''+row.FVIGENCIA4+'\',\''+row.NOTA4+'\',\''+row.ID_PUBLICACION+'\');"><i class="fa fa-edit fa-2x" data-original-title="Editar" data-toggle="tooltip"></i></a>'+
                                        '&nbsp; &nbsp;'+
                                        '<a href="#" data-original-title="Eliminar" data-toggle="modal" data-target="#deleteModal" onClick="javascript:SelDeleteNorma(\''+row.ID_NORMA+'\');"><i class="fa fa-trash-o fa-2x" data-original-title="Eliminar" data-toggle="tooltip"></i></a>'+
                                        '&nbsp; &nbsp;'+
                                        '<a href="#" data-original-title="Agregar Documentos" data-toggle="modal" data-target="#modalVincularguia" onClick="javascript:SelGuiaNorma(\''+row.ID_NORMA+'\');"><i class="fa fa-folder-open fa-2x" data-original-title="Agregar Documentos" data-toggle="tooltip"></i></a>'+
                                      '</div>'   
                              }else{
                                return  '<div>'+    
                                  '&nbsp; &nbsp;'+
                                '</div>'
                              }
                            }
                          }
                        ], 
          "columnDefs": [
            {
              "targets": [10], 
              "data": "NORMA_ESTADO", 
              "render": function(data, type, row) {
                
                if (data ==  "Inactivo") {
                  return "<span class='label label-default'>Inactivo</span>";
                }else if (data == "Vigente") {
                  return "<span class='label label-success'>Vigente</span>";
                }else if (data == "PorCumplir") {
                  return "<span class='label label-warning'>Por Cumplir</span>";
                }else if (data == "Obsoleto") {
                  return "<span class='label label-danger'>Obsoleto</span>";
                }
                  
              }
            }
          ],
      });
  
      /****************************************************/
      // Seleccionar por click
      $('#tblListado tbody').on( 'click', 'tr', function () {
            if ( $(this).hasClass('selected') ) {
                $(this).removeClass('selected');
            }
            else {
                oTable.$('tr.selected').removeClass('selected');
                $(this).addClass('selected');
            }
      });
  
      /****************************************************/
      // Enumeracion 
      /*oTable.on( 'order.dt search.dt', function () { 
        oTable.column(0, {search:'applied', order:'applied'}).nodes().each( function (cell, i) {
          cell.innerHTML = i+1;
        } );
      }).draw();
      */
  
      /* DETALLE GESTDOCUM */
      // $('#tblListado tbody').on('click','td.details-control', function () {
          
      //   var tr = $(this).closest('tr');
      //   var row = oTable.row(tr);
              
      //   if (row.child.isShown()) {
      //     row.child.hide(); 
      //     tr.removeClass('shown');                          
      //   }else{
      //     var A = row.data()
      //     var IDNORMA = A.ID_NORMA;
      //     $.post(baseurl+"adm/interno/cnormas/getbuscarguia",
      //     {
      //         IDNORMA:IDNORMA
      //     },
      //       function(data){ 
      //         var c = JSON.parse(data);
      //         row.child(format(c, row.data())).show();  
      //         tr.addClass('shown'); 
                        
      //       }
      //     );   
      //   }
  
      // });
    });
  }
  
  $('#btnBuscar').click(function(){
    consultgestdocum();
  });

  // FORMATO DE FECHA
  $('#txtFDesde,#txtFFinal').datetimepicker({
    format: 'DD/MM/YYYY',
    daysOfWeekDisabled: [0],
    locale:'es'
});

  
  $('#txtDescri,#placlavecboavz').keyup(function(){
  consultgestdocum();
  });
  $('#cboResp,#cboDoc,#idiomacboavz,#paiscboavz,#institucioncboavz').change(function(){
    consultgestdocum();
  });   


  // ESTADOS DE NORMAS
  $('input[type=radio][name=rbtEst]').change(function() {
    if (this.value == '1') {
      tipoest = '1';
    }
    else if (this.value == '3') {
      tipoest = '3';
    }else if (this.value == '%') {
      tipoest = '%';
    }
  });