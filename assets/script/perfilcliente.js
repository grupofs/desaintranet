

$(document).ready(function() {
    getdatospersonales();

		var tipopsw = 'S';//$('#TipoPassword').val();
		var pass1 = $('[name=new_password]');
		var pass2 = $('[name=conf_password]');

		var confirmacion = "Las contraseñas si coinciden";
		var longitud6 = "La contraseña debe ser mayor a 6 carácteres";
		var longitud11 = "La contraseña debe ser mayor a 11 carácteres";
		var negacion = "No coinciden las contraseñas";
		var vacio = "La contraseña no puede estar vacía";
		var sintexto = "";
		

		//oculto por defecto el elemento span
		var span1 = $('<span></span>').insertAfter(pass1);
		
		span1.hide();
		
		//función que comprueba la longitud y vacion en la clave
		function valorPassword(){
			var valor1 = pass1.val();
			var valor2 = pass2.val();
			//muestro el span
			span1.show().removeClass();
			
			//condiciones dentro de la función
			if(valor1.length==0 || valor1==""){
				span1.text(vacio).addClass('negacion');
				$("#idbtnsave").prop('disabled','disabled');	
			}else if(valor1.length<6 && tipopsw=='S'){
				span1.text(longitud6).addClass('negacion');
				$("#idbtnsave").prop('disabled','disabled');
			}else if(valor1.length<11 && tipopsw=='D'){
				span1.text(longitud11).addClass('negacion');
				$("#idbtnsave").prop('disabled','disabled');
			}else{
				span1.hide();
			}
		}
		
		//ejecuto la función al soltar la tecla	del campo de password
		pass1.keyup(function(){
			valorPassword();
		});
		
		//oculto por defecto el elemento span
		var span2 = $('<span></span>').insertAfter(pass2);
		
		span2.hide();
		
		//función que comprueba las dos contraseñas si coinciden
		function coincidePassword(){
			var valor1 = pass1.val();
			var valor2 = pass2.val();
			//muestro el span
			span2.show().removeClass();
			//condiciones dentro de la función
			if(valor1 != valor2){
				span2.text(negacion).addClass('negacion');
				$("#idbtnsave").prop('disabled','disabled');
			}
	
			if(valor1.length!=0 && valor1==valor2){
				span2.text(confirmacion).removeClass("negacion").addClass('confirmacion');
				$("#idbtnsave").prop('disabled',false);
			}
		}
		
		//ejecuto la función al soltar la tecla	del campo de confirmar clave
		pass2.keyup(function(){
			coincidePassword();
		});
});

$('#frmCambiarpws').submit(function(event){
  event.preventDefault();
  
  var request = $.ajax({
    url:$('#frmCambiarpws').attr("action"),
    type:$('#frmCambiarpws').attr("method"),
    data:$('#frmCambiarpws').serialize(),
    error: function(){
      Vtitle = 'No se puede Acceder por Error';
      Vtype = 'error';
      sweetalert(Vtitle,Vtype); 
    }
  });				
  request.done(function( respuesta ) {
    var posts = JSON.parse(respuesta);
    if(posts.valor == 2){		
      Swal.fire({
        title: 'Conforme!!',
        text: posts.respuesta,
        position: 'center',
        type: 'success',
        showConfirmButton: false,
        timer: 2200
      }).then((result) => {
        if (result.dismiss === Swal.DismissReason.timer) {
          var retornar = document.getElementById('btnreturn');
          retornar.click();
        }
      })				
    }else{	
      Swal.fire({
        title: 'Error en Cambiar Contraseña!',
        text: posts.respuesta,
        type: 'error',
      })	
    }
    
  });
});	

getdatospersonales = function(){
    var params = { 
        "idadministrado" : $('#hdnIdadm').val()
    }; 
    $.ajax({
      type: 'ajax',
      method: 'post',
      url: baseurl+"cperfilusuario/getdatospersonales",
      dataType: "JSON",
      async: true,
      data: params,
      success: function (result){
        var c = (result);
        $.each(c,function(i,item){
          $('#txtnombperfil').val(item.nombres);
          $('#txtapepatperfil').val(item.ape_paterno);
          $('#txtapematperfil').val(item.ape_materno);
          $('#txtTipodoc').val(item.id_tipodoc);
          $('#txtNrodoc').val(item.nrodoc);
          $('#txtdirperfil').val(item.direccion);
          $('#txtemailperfil').val(item.email);
          $('#txtfonoperfil').val(item.fono_fijo);
          $('#txtcelperfil').val(item.fono_celular);
          if(item.id_tipodoc == '1'){       
            tddni(); 
          }else{
            tdcex();
          }
        })
      },
      error: function(){
        alert('Error, no se exxtendio Nro. Propuesta');
      }
    })
}; 

tddni=function(){
    $('#btntipodoc').html("DNI");
    $('#txtTipodoc').val('1');
};
tdcex=function(){
    $('#btntipodoc').html("C.EXT");
    $('#txtTipodoc').val('4');
};

changeFilesClie = function(){
    var archivoInput = document.getElementById('file-input');
    var archivoRuta = archivoInput.value;
    var extPermitidas = /(.gif|.jpg|.png|.jpeg)$/i;

    if(!extPermitidas.exec(archivoRuta)){
        alert('Asegurese de haber seleccionado un GIF, JPG, PNG, JPEG');
        archivoInput.value = '';
        return false;
    }
    else
    {
        var parametrotxt = new FormData($("#frmFileinput")[0]);
        var request = $.ajax({
            data: parametrotxt,
            method: 'post',
            url: baseurl+"cperfilcliente/imagen_cliente/",
            dataType: "JSON",
            async: true,
            contentType: false,
            processData: false,
            error: function(){
                alert('Error, no se cargó el archivo');
            }
        });
        request.done(function( respuesta ) {            
          window.location="perfilclie";
          Vtitle = 'Imagen se actualizo!!';
          Vtype = 'success';
          sweetalert(Vtitle,Vtype);
        });
    }
};

$('#frmDatosPersonales').submit(function(event){
    event.preventDefault();
    
    var request = $.ajax({
        url:$('#frmDatosPersonales').attr("action"),
        type:$('#frmDatosPersonales').attr("method"),
        data:$('#frmDatosPersonales').serialize(),
        error: function(){
            Vtitle = 'No se puede registrar por error';
            Vtype = 'error';
            sweetalert(Vtitle,Vtype);
        }
    });
    request.done(function( respuesta ) { 
            CerrarSesion(); 
            Vtitle = "Se Actualizo Correctamente";
            Vtype = 'success';
            sweetalert(Vtitle,Vtype);
    });
});

