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
var rutaArchivoNorma = baseurl+'FTPfileserver/Archivos/Normas/';

var iduser = $('#mtxtidusunormas').val();

$(document).ready(function () {
	$("#txtruta,#txtrutaEdit").val("FTPfileserver/Archivos/Normas/"); //RUTA PARA EL ARCHIVO AL AGREGAR NORMA
	
	
	$.ajax({ //Obtener Documento
		type: 'ajax',
		method: 'post',
		url: baseurl + "adm/interno/cnormas/getDocumentos",
		dataType: "JSON",
		async: true,
		success: function (result) {
			$('#cboDoc,#cboDocNew,#cboDocEdit').html(result);
		},
		error: function () {
			alert('Error, No se puede autenticar por error');
		}
	});

	$.post(baseurl + "adm/interno/cnormas/getidioma", {},
		function (data) {
			var c = JSON.parse(data);
			$.each(c, function (i, item) {
				$('#idiomacboavz,#idiomacboavzNew,#idiomacboavzEdit').append('<option value="' + item.id_idioma + '">' + item.idioma_descripcion + '</option>');
			})
		}
	);

	$.post(baseurl + "adm/interno/cnormas/getpais", {},
		function (data) {
			var c = JSON.parse(data);
			$.each(c, function (i, item) {
				$('#paiscboavz,#paiscboavzNew,#paiscboavzEdit').append('<option value="' + item.id_pais + '">' + item.pais_descripcion + '</option>');
			})
		}
	);

<<<<<<< HEAD
	$.post(baseurl + "adm/interno/cnormas/getinstitucion", {},
		function (data) {
			var c = JSON.parse(data);
			$.each(c, function (i, item) {
				$('#institucioncboavz,#institucioncboavzNew,#institucioncboavzEdit').append('<option value="' + item.id_institucion + '">' + item.institucion_abrevia + '</option>');
			})
		}
	);

	$.post(baseurl + "adm/interno/cnormas/getpublicacion", {},
		function (data) {
			var c = JSON.parse(data);
			$.each(c, function (i, item) {
				$('#mtxtPublicacion,#mtxtPublicacionEdit').append('<option value="' + item.id_publicacion + '">' + item.publicacion_descripcion + '</option>');
			})
		}
	);

	// OCULTAR/MOSTRAR BUSQUEDA AVANZADA
	$("#chkAvanzado").on("change", function () {
		if ($("#chkAvanzado").is(":checked")) {
			$("#avanzado").show();
		} else {
			$("#avanzado").hide();
		}
	});


	$("#Todos").on("change", function () {
		$("#FechaInicial").prop("disabled", $("#Todos").is(":checked"));
		$("#FechaTermino").prop("disabled", $("#Todos").is(":checked"));
		if (this.checked == true) {
			tipofind = 'S'
		} else if (this.checked == false) {
			tipofind = 'N'
		};
	});

	$("#Todos").click();

=======
    $("#chkFpubl").on("change", function () {
        $("#txtFIni").prop("disabled",$("#chkFpubl").is(":checked"));
        $("#txtFFin").prop("disabled",$("#chkFpubl").is(":checked"));
          if(this.checked == true){ 
            tipofind ='S'
          }
          else if(this.checked == false){ 
            tipofind ='N'
          }; 
    });

    $("#chkFpubl").click();
>>>>>>> 3eb593cfdca45920529bfe8c97248b6c568e1d24


	// Iniciar Tabla
	$("#tblListado").DataTable();


	// BLOQUEO DE TABS
	$('#tabnorma a[href="#tabnorma-list-tab"]').attr('class', 'disabled');
	$('#tabnorma a[href="#tabnorma-new-tab"]').attr('class', 'disabled active');

	$('#tabnorma a[href="#tabnorma-list-tab"]').not('#store-tab.disabled').click(function (event) {
		$('#tabnorma a[href="#tabnorma-list"]').attr('class', 'active');
		$('#tabnorma a[href="#tabnorma-new"]').attr('class', '');
		return true;
	});
	$('#tabnorma a[href="#tabnorma-new-tab"]').not('#bank-tab.disabled').click(function (event) {
		$('#tabnorma a[href="#tabnorma-new"]').attr('class', 'active');
		$('#tabnorma a[href="#tabnorma-list"]').attr('class', '');
		return true;
	})

	$('#tabnorma a[href="#tabnorma-list"]').click(function (event) {
		return false;
	});
	$('#tabnorma a[href="#tabnorma-new"]').click(function (event) {
		return false;
	});


});

// BUSCAR NORMA

consultgestdocum = function () {
	$(document).ready(function () {
		'use strict';
		if (document.getElementById("cboDoc").value == "%" || document.getElementById("cboDoc").value == "") {
			tipodocu = ["%"];
		} else {
			tipodocu = $('#cboDoc').val();
		}

		if (document.getElementById("cboResp").value == "") {
			arearesp = ["%"];
		} else {
			arearesp = $('#cboResp').val();
		}

		if (document.getElementById("idiomacboavz").value == "") {
			cboidioma = ["%"];
		} else {
			cboidioma = $('#idiomacboavz').val();
		}

		if (document.getElementById("paiscboavz").value == "") {
			cbopais = ["%"];
		} else {
			cbopais = $('#paiscboavz').val();
		}

		if (document.getElementById("institucioncboavz").value == "") {
			cboinstitucion = ["%"];
		} else {
			cboinstitucion = $('#institucioncboavz').val();
		}

		//$("#btnexcelNormas").removeAttr("disabled");
		bfind = false;
		// Convertir tabla a datatable
		oTable = $('#tblListado').DataTable({
			'responsive': true,
			'bJQueryUI': true,
			'scrollY': '400px',
			'scrollX': true,
			'paging': true,
			'processing': true,
			'bDestroy': true,
			"AutoWidth": false,
			'info': true,
			'filter': true,
			"ordering": false,
			'stateSave': true,
			'ajax': {
				"url": baseurl + "adm/interno/cnormas/getbuscarnormativa",
				"type": "POST",
				"data": function (d) {
					d.TIPODOC = tipodocu; // Recupera valor de busqueda a variable
					d.DESCRI = $('#txtDescri').val();
					d.RESP = arearesp;
					d.EST = tipoest;
					d.IDIOMA = cboidioma;
					d.PAIS = cbopais;
					d.INSTITUCION = cboinstitucion;
					d.PALCLAVE = $('#placlavecboavz').val();
					d.allf = tipofind;
					d.fi = $('#FechaInicial').val();
					d.ff = $('#FechaTermino').val();

				},
				dataSrc: ''
			},
			'columns': [{
					data: 'POS', // Enumeracion y Formato lateral derecho
					sortable: false,
					"class": "index",
					targets: 0
				},

				{
					data: 'NORMA_CODIGO',
					targets: 1
				},
				{
					data: 'NORMA_TITULO',
					targets: 2
				},
				{
					data: 'TIPODOC_DESCRIPCION',
					targets: 3
				},
				{
					data: 'NORMA_AREARESP',
					targets: 4
				},
				{
					data: 'PAIS_DESCRIPCION',
					targets: 5
				},
				{
					data: 'INSTITUCION_DESCRIPCION',
					targets: 6
				},
				{
					data: 'IDIOMA_DESCRIPCION',
					targets: 7
				},
				{
					data: 'NORMA_FPUBLICACION',
					targets: 8
				},
				{
					data: 'NORMA_ESTADO',
					targets: 9
				},
				{
					"orderable": false,
					render: function (data, type, row) {

						return '<div>' +
							'<a href="' + baseurl + row.NORMA_RUTA + row.NORMA_ARCHIVO + '" target="_blank" class="btn btn-default btn-xs pull-left"><i class="fa fa-download fa-2x" data-original-title="Descargar" data-toggle="tooltip"></i></a>' +

							'</div>'
					}
				},
				{
					"orderable": false,
					render: function (data, type, row) {
						bfind = true;
						if (iduser == row.IDUSUARIO) {
							return '<div>' +
								'<a href="#" data-original-title="Editar" title="Editar Norma" data-toggle="modal" data-target="#modalEditarNorma" onClick="javascript:selNormativa(\'' + row.ID_NORMA + '\',\'' + row.NORMA_CODIGO + '\',\'' + row.ID_TIPODOC + '\',\'' + row.ID_IDIOMA + '\',\'' + row.ID_PAIS + '\',\'' + row.ID_INSTITUCION + '\',\'' + row.NORMA_PUBLICACION + '\',\'' + row.NORMA_TITULO + '\',\'' + row.NORMA_FPUBLICACION + '\',\'' + row.NORMA_FVENCIMIENTO + '\',\'' + row.NORMA_VERSION + '\',\'' + row.NORMA_PALABRACLAVE + '\',\'' + row.NORMA_AREARESP + '\',\'' + row.NORMA_COMENTARIO + '\',\'' + row.NORMA_ESTADO + '\',\'' + row.NORMA_HEREDA + '\',\'' + row.NORMA_ARCHIVO + '\',\'' + row.FVIGENCIA1 + '\',\'' + row.FVIGENCIA2 + '\',\'' + row.FVIGENCIA3 + '\',\'' + row.NOTA1 + '\',\'' + row.NOTA2 + '\',\'' + row.NOTA3 + '\',\'' + row.RUTAFILE + '\',\'' + row.FVIGENCIA4 + '\',\'' + row.NOTA4 + '\',\'' + row.ID_PUBLICACION + '\');"><i class="fa fa-edit fa-2x" data-original-title="Editar" data-toggle="tooltip"></i></a>' +
								'&nbsp; &nbsp;' +
								'<a href="#" data-original-title="Eliminar" data-toggle="modal" data-target="#deleteModal" onClick="javascript:SelDeleteNorma(\'' + row.ID_NORMA + '\');"><i class="fa fa-trash fa-2x" data-original-title="Eliminar" data-toggle="tooltip"></i></a>' +
								'&nbsp; &nbsp;' +
								'<a href="#" data-original-title="Agregar Documentos" data-toggle="modal" data-target="#modalVincularguia" onClick="javascript:SelGuiaNorma(\'' + row.ID_NORMA + '\');"><i class="fa fa-folder-open fa-2x" data-original-title="Agregar Documentos" data-toggle="tooltip"></i></a>' +
								'</div>'
						} else {
							return '<div>' +
								'SIN ACCESO' +
								'</div>'
						}
					}
				}
			],
			"columnDefs": [{
				"targets": [9],
				"data": null,
				"render": function (data, type, row) {

					if (row.NORMA_ESTADO == "Inactivo") {
						return "<button type='button' class='btn btn-light'>Inactivo</button>";
					} else if (row.NORMA_ESTADO == "Vigente") {
						return '<button type="button" class="btn btn-success">Vigente</button>';
					} else if (row.NORMA_ESTADO == "PorCumplir") {
						return '<button type="button" class="btn btn-warning">Pendiente</button>';
					} else if (row.NORMA_ESTADO == "Obsoleto") {
						return '<button type="button" class="btn btn-danger">Obsoleto</button>';
					}

				}
			}],
		});

		/****************************************************/
		// Seleccionar por click
		$('#tblListado tbody').on('click', 'tr', function () {
			if ($(this).hasClass('selected')) {
				$(this).removeClass('selected');
			} else {
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
		//     var id_guia = A.ID_NORMA;
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

$('#btnBuscar').click(function () {
	consultgestdocum();
});

// FORMATO DE FECHA
$('#txtFDesde,#txtFFinal,#txtPublicacionNew,#txtVencimienteoNews,#txtFechVigencia1,#txtFechVigencia2,#txtFechVigencia3,#txtFechVigencia4,#txtPublicacionEdit,#txtVencimienteoEdit,#txtFechVigencia1Edit,#txtFechVigencia2Edit,#txtFechVigencia3Edit,#txtFechVigencia4Edit').datetimepicker({
	format: 'DD/MM/YYYY',
	locale: 'es'
});


$('#txtDescri,#placlavecboavz').keyup(function () {
	consultgestdocum();
});

$('#cboResp,#cboDoc,#idiomacboavz,#paiscboavz,#institucioncboavz').change(function () {
	consultgestdocum();
});


// ESTADOS DE NORMAS
$('input[type=radio][name=rbtEst]').change(function () {
	if (this.value == '1') {
		tipoest = '1';
	} else if (this.value == '3') {
		tipoest = '3';
	} else if (this.value == '%') {
		tipoest = '%';
	}
});


/* PERMISOS CREAR NUEVO */
// $("#btnNuevo").hide();

// if(iduser == 112){
//   $("#btnNuevo").show();
// }else if(iduser == 2){
//   $("#btnNuevo").show();
// }else if(iduser == 49){
//   $("#btnNuevo").show();
// }else if(iduser == 92){
//   $("#btnNuevo").show();
// }else if(iduser == 66){
//   $("#btnNuevo").show();
// }else if(iduser == 78){
//   $("#btnNuevo").show();
// }else if(iduser == 63){
//   $("#btnNuevo").show();
// }else if(iduser == 1){
//   $("#btnNuevo").show();
// }else if(iduser == 50){
//   $("#btnNuevo").show();
// }else{
//   $("#btnNuevo").hide();
// }

$('#btnNuevo').click(function () {

	$('#tabnorma a[href="#tabnorma-new"]').tab('show');
});

function retornar() {
	$('#tabnorma a[href="#tabnorma-list"]').tab('show');
}

$('#btnCancelar').click(function () {
	retornar();
});

$("#mtxtArchivoNewnorma,#mtxtArchivoNormaEdit").fileinput({
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
	msgErrorClass: 'alert alert-block alert-danger',
});

function registrar_archivonewnorma() {
	var archivoInput = document.getElementById('mtxtArchivoNewnorma');
	var archivoRuta = archivoInput.value;
	var extPermitidas = /(.pdf|.docx|.xlsx|.doc|.xls)$/i;

	if (!extPermitidas.exec(archivoRuta)) {
		alert('Asegurese de haber seleccionado un PDF, DOCX, XSLX');
		archivoInput.value = '';
		return false;
	} else {
		var parametrotxt = new FormData($("#fmrNormasNew")[0]);

		$.ajax({
			data: parametrotxt,
			method: 'post',
			url: baseurl + "adm/interno/cnormas/subirArchivo",
			dataType: "JSON",
			async: true,
			contentType: false,
			processData: false,
			success: function (response) {

				folder = response[0];
				$("#txtNombreArchivo").val(folder); //ASIGNAMOS EL NOMBRE AL ARCHIVO PARA GUARDAR
				rutaarchivo = response[1];

			},
			error: function () {
				alert('Error, no se cargó el archivo');
			}

		});
	}

}


// CARGAR ARCHIVO EDITAR NORMA

function registrar_archivoEditarNorma() {
	var archivoInput = document.getElementById('mtxtArchivoNormaEdit');
	var archivoRuta = archivoInput.value;
	var extPermitidas = /(.pdf|.docx|.xlsx|.doc|.xls)$/i;

	if (!extPermitidas.exec(archivoRuta)) {
		alert('Asegurese de haber seleccionado un PDF, DOCX, XSLX');
		archivoInput.value = '';
		return false;
	} else {
		var parametrotxt = new FormData($("#frmEditarNorma")[0]);

		$.ajax({
			data: parametrotxt,
			method: 'post',
			url: baseurl + "adm/interno/cnormas/subirArchivoEdit",
			dataType: "JSON",
			async: true,
			contentType: false,
			processData: false,
			success: function (response) {

				folder = response[0];
				$("#txtNombreArchivoEdit").val(folder); //ASIGNAMOS EL NOMBRE AL ARCHIVO PARA GUARDAR
				rutaarchivo = response[1];

			},
			error: function () {
				alert('Error, no se cargó el archivo');
			}

		});
	}

}


$("#fmrNormasNew").submit(function (e) {
	e.preventDefault();
	var parametros = $("#fmrNormasNew").serialize();
	console.log('parametros', parametros)

	$.ajax({
		type: 'ajax',
		method: 'post',
		url: baseurl + "adm/interno/cnormas/guardarnormativa",
		dataType: "JSON",
		async: true,
		data: parametros,
		success: function (result) {
			if (result == 1) {
				$("#fmrNormasNew")[0].reset();
				Vtitle = 'Se agrego correctamente';
				Vtype = 'success';
				sweetalert(Vtitle, Vtype);

			} else {
				Vtitle = 'Problemas al Agregar';
				Vtype = 'error';
				sweetalert(Vtitle, Vtype);
			}

		},
		error: function () {
			alert('Error, no se guardaron los datos');
		}
	})
})


selNormativa = function (id_norma, norma_codigo, idtipodoc, id_idioma, id_pais, id_institucion, norma_publicacion, norma_titulo, fec_publicacion, fec_vencimineto, version, palabra_clave, area_resp, comentario, estado, hereda, archivo, fec_vig1, fec_vig2, fec_vig3, nota1, nota2, nota3, ruta, fec_vig4, nota4, id_publicacion) {
	$("#mtxtidNorma").val(id_norma);
	$("#txtCodigoEdit").val(norma_codigo);
	$("#cboDocEdit").val(idtipodoc).trigger("change");
	$("#idiomacboavzEdit").val(id_idioma).trigger("change");
	$("#paiscboavzEdit").val(id_pais).trigger("change");
	$("#institucioncboavzEdit").val(id_institucion).trigger("change");
	$("#mtxtPublicacionEdit").val(id_publicacion).trigger("change");
	$("#mtxtTituloEdit").val(norma_titulo);
	$("#FechaPublicacionEdit").val(fec_publicacion);
	$("#FechaVencimientoEdit").val(fec_vencimineto);
	$("#txtVersionEdit").val(version);
	$("#txtPalabraClaveEdit").val(palabra_clave);
	$("#txtNombreArchivoEdit").val(archivo);
	$("#cboRespEdit").val(area_resp).trigger("change");
	$("#mtxtComentarioEdit").val(comentario);
	$("#FechaVencimientoEdit1").val(fec_vig1);
	$("#mtxtNota1Edit1").val(nota1);
	$("#FechaVencimientoEdit2").val(fec_vig2);
	$("#mtxtNota2Edit").val(nota2);
	$("#FechaVencimientoEdit3").val(fec_vig3);
	$("#mtxtNota3Edit").val(nota3);
	$("#FechaVencimientoEdit4").val(fec_vig4);
	$("#mtxtNota4Edit").val(nota4);


	//ESTADO Y/O FASE DE NORMA

	var norma_fase;

	if (estado == "Inactivo") {
		norma_fase = 0;
	} else if (estado == "Vigente") {
		norma_fase = 1;
	} else if(estado == "PorCumplir") {
		norma_fase = 2;
	} else if(estado == "Obsoleto"){
		norma_fase = 3;
	}
	$("#cboFaseEdit").val(norma_fase).trigger("change");

}


$("#frmEditarNorma").submit(function(e){
	e.preventDefault();

	var parametros = $("#frmEditarNorma").serialize();

	$.ajax({
		type: 'ajax',
		method: 'post',
		url: baseurl + "adm/interno/cnormas/editarnormativa",
		dataType: "JSON",
		async: true,
		data: parametros,
		success: function (result) {
			if (result == 1) {
				
				Vtitle = 'Se agrego correctamente';
				Vtype = 'success';
				sweetalert(Vtitle, Vtype);
				$("#btnCloseEditarNormaModal").click();
				oTable.ajax.reload(null,false);

			} else {
				Vtitle = 'Problemas al Agregar';
				Vtype = 'error';
				sweetalert(Vtitle, Vtype);
			}

		},
		error: function () {
			alert('Error, no se guardaron los datos');
		}
	})


})


// ELIMINAR NORMA
/***************************************************/
SelDeleteNorma = function(id_norma){
	

	var datos = {
		idnorma : id_norma
	};


	Swal.fire({
        title: 'Confirmar Eliminación',
        text: "¿Está seguro de eliminar el Informe?",
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
				url: baseurl+'adm/interno/cnormas/deleteNormativa',
				dataType:'JSON',
				async: true,
				data: datos,
				success:function(result){
					if (result == 1) {
						Vtitle = 'Se Elimino Correctamente';
						Vtype = 'success';
						sweetalert(Vtitle,Vtype);
						oTable.ajax.reload(null,false);
					} else {
						Vtitle = 'Ups,no se puedo Eliminar!';
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

/***************************************************/


/**************************************************/

	
  /* DATATABLE GUIA NORMA */

SelGuiaNorma = function(id_Norma){
    var idnormas = id_Norma;
    $("#mtxtidnormag").val(idnormas);

    tblguia = $('#tblGuia').DataTable({
		'responsive': true,
		'bJQueryUI': true,
		'scrollY': '400px',
		'scrollX': true,
		'paging': true,
		'processing': true,
		'bDestroy': true,
		"AutoWidth": false,
		'info': true,
		'filter': true,
		"ordering": false,
		'stateSave': true,
      'ajax'        : {
                        "url"   : baseurl+"adm/interno/cnormas/getbuscarguia",
                        "type"  : "POST", 
                        "data": function ( d ) {
                          d.IDNORMA =  id_Norma
                        },  
                        dataSrc : ''        
                      },
      'columns'     : [
                       { data:'POS', // Enumeracion y Formato lateral derecho
                          sortable: false,
                          "class": "index",
                          targets: 0
                        } ,
                        {data: 'DESCRIPCION', targets: 1 },
                        {data: 'OBSERVACION', targets: 2},
                        //{data: 'IDNORMA', targets: 3},
                        //{data: 'ITEM_GUIA', targets: 4},
                        //{data: 'NORMARCHIVO', targets: 5 },
                        //{data: 'URL', targets: 6 },
                        {"orderable": false, 
                          render:function(data, type, row){
                            if(row.URL == null || row.URL == 'null'){
                              return  '<div>'+  
                                '<a href=""></a>'+
                              '</div>'
                            }else if(row.URL == ''){
                              return  '<div>'+  
                                '<a href=""></a>'+
                              '</div>'
                            }else{
                              return  '<div>'+  
                                '<a href="'+row.URL+'" target="_blank">'+row.URL +'</a>'+
                              '</div>'
                            }   
                          }
                        },
                        {"orderable": false, 
                          render:function(data, type, row){
                            if(row.NORMARCHIVO == null || row.NORMARCHIVO == 'null'){
                              return  '<div>'+  
                                '<a href=""></a>'+
                              '</div>'  
                            }else if(row.NORMARCHIVO == '') {
                              return  '<div>'+  
                                '<a href=""></a>'+
                              '</div>' 
                            }else{  
                              return  '<div>'+  
                                      '<a href="'+rutaArchivoNorma +row.NORMARCHIVO+'" target="_blank" class="btn btn-default btn-xs pull-left"><i class="fa fa fa-eye fa-2x" data-original-title="Ver Norma" data-toggle="tooltip"></i></a>'+
                                    '</div>'  
                            } 
                          }
                        },

                        {"orderable": false, 
                          render:function(data, type, row){
                            if(row.ARCHIVO == null || row.ARCHIVO == 'null'){
                              return  '<div>'+  
                                '<a href=""></a>'+
                              '</div>'  
                            }else if(row.ARCHIVO == ''){
                              return  '<div>'+  
                                '<a href=""></a>'+
                              '</div>' 
                            }else{  
                            return  '<div>'+  
                            '<a href="'+rutaArchivoNorma +row.ARCHIVO+'" target="_blank" class="btn btn-default btn-xs pull-left"><i class="fa fa-download fa-2x" data-original-title="Descargar" data-toggle="tooltip"></i></a>'+
                                    '</div>'  
                            } 
                          }
                        },
                        {"orderable": false, 
                          render:function(data, type, row){  
                            return  '<div>'+  
                                      '<a href="#" data-original-title="Editar" data-toggle="modal" data-target="#modalEditGuia" onClick="javascript:SelEditGuia(\''+row.IDGUIA+'\',\''+row.DESCRIPCION+'\',\''+row.OBSERVACION+'\',\''+row.ITEM_GUIA+'\',\''+row.ARCHIVO+'\',\''+row.URL+'\',\''+row.NORMARCHIVO+'\');"><i class="fa fa-edit fa-2x" data-original-title="Editar" data-toggle="tooltip"></i></a>'+
                                      '&nbsp; &nbsp;'+
                                      '<a href="#" data-original-title="Eliminar" onClick="javascript:SelDeleteGuia(\''+row.IDGUIA+'\');"><i class="fa fa-trash fa-2x" data-original-title="Eliminar" data-toggle="tooltip"></i></a>'+
                                    '</div>'   
                          }
                        }

                      ], 
    });
<<<<<<< HEAD
};


/*************************************************/



/**************************************************** */

		 //TABLA VINCULAR NORMA CON GUIA

$('#mbtnVincular').click(function(){
	'use strict';

	tbllistnormas = $('#tblListNormas').DataTable({
		'responsive': true,
		'bJQueryUI': true,
		'scrollY': '400px',
		'scrollX': true,
		'paging': true,
		'processing': true,
		'bDestroy': true,
		"AutoWidth": false,
		'info': true,
		'filter': true,
		"ordering": false,
		'stateSave': true,
		'ajax'        : {
						"url"   : baseurl+"adm/interno/cnormas/getlistnormas",
						"type"  : "POST", 
						"data": function ( d ) {
						},     
						dataSrc : ''        
						},
		'columns'     : [
						{ data:'POS', // Enumeracion y Formato lateral derecho
							sortable: false,
							"class": "index",
							targets: 0
						} ,
						{data: 'CODIGONORMA', targets: 1 },
						{data: 'TITULONORMA', targets: 2 },
						//{data: 'NORARCH', targets: 3},
						{"orderable": false, 
							render:function(data, type, row){
							return  '<div>'+  
										'<button data-original-title="Seleccionar" data-toggle="tooltip" class="btn btn-block btn-outline-info" onClick="SelectNorma(\''+row.IDNORMA+'\',\''+row.NORARCH+'\');" >Seleccionar</button>'+
									'</div>'   
							}
						}
						], 
	});

	/****************************************************/
	// Seleccionar por click
	$('#tblListNormas tbody').on( 'click', 'tr', function () {
			if ( $(this).hasClass('selected') ) {
				$(this).removeClass('selected');
			}
			else {
			tbllistnormas.$('tr.selected').removeClass('selected');
				$(this).addClass('selected');
			}
	});

	/****************************************************/

=======
  }
  
  $('#btnBuscar').click(function(){
    consultgestdocum();
  });

  // FORMATO DE FECHA
  $('#txtFDesde,#txtFHasta').datetimepicker({
    format: 'DD/MM/YYYY',
    daysOfWeekDisabled: [0],
    locale:'es'
>>>>>>> 3eb593cfdca45920529bfe8c97248b6c568e1d24
});


// SELECCIONAR NORMA-ARCHIVO
SelectNorma = function (iNorma,NormArchivo){
	$("#norma_archivo,#normaArchivo").val(NormArchivo);
	$("#mtxtitemguia").val(iNorma);

	$("#btnCerrarListadoNormas").click();
}

$("#frmGuia").submit(function(e){
	e.preventDefault();
	var datos = $("#frmGuia").serialize();


	$.ajax({
		type: 'ajax',
		method: 'post',
		url: baseurl+"adm/interno/cnormas/guardarguia",
		dataType: "JSON",
		async: true,
		data: datos,
		success: function (result){
			if(result == 1){
				Vtitle = 'Se Agrego Correctamente';
				Vtype = 'success';
				sweetalert(Vtitle,Vtype);
				$("#modalCerrarGuiaNorma").click();
			  	tblguia.ajax.reload(null,false);
			  
			}else{
				Vtitle = 'Ups, Intente nuevamente!';
				Vtype = 'error';
				sweetalert(Vtitle,Vtype);
			}
	
		},
		error: function(){
			Vtitle = 'Problemas con el Servidor';
			Vtype = 'error';
			sweetalert(Vtitle,Vtype);
		}
	  })

})

SelDeleteGuia = function (id_guia) {
	
	var datos = {
		id_guia : id_guia
	};


	Swal.fire({
        title: 'Confirmar Eliminación',
        text: "¿Está seguro de eliminar la Guia?",
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
				url: baseurl+'adm/interno/cnormas/delete_guia',
				dataType:'JSON',
				async: true,
				data: datos,
				success:function(result){
					if (result == 1) {
						Vtitle = 'Se Elimino Correctamente';
						Vtype = 'success';
						sweetalert(Vtitle,Vtype);
						tblguia.ajax.reload(null,false);
					} else {
						Vtitle = 'Ups,no se puedo Eliminar!';
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

// CARGAR ARCHIVO GUIA


function registrar_archivoGuia() {
	var archivoInput = document.getElementById('mtxtguianormarch');
	var archivoRuta = archivoInput.value;
	var extPermitidas = /(.pdf|.docx|.xlsx|.doc|.xls)$/i;

	if (!extPermitidas.exec(archivoRuta)) {
		alert('Asegurese de haber seleccionado un PDF, DOCX, XSLX');
		archivoInput.value = '';
		return false;
	} else {
		var parametrotxt = new FormData($("#frmGuia")[0]);

		$.ajax({
			data: parametrotxt,
			method: 'post',
			url: baseurl + "adm/interno/cnormas/subirArchivoguia",
			dataType: "JSON",
			async: true,
			contentType: false,
			processData: false,
			success: function (response) {

				folder = response[0];
				$("#archivoGuia").val(folder); //ASIGNAMOS EL NOMBRE AL ARCHIVO PARA GUARDAR
				rutaarchivo = response[1];

			},
			error: function () {
				alert('Error, no se cargó el archivo');
			}

		});
	}

}