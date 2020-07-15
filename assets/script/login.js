/***            LOGIN                ***/
/****************************************************/

var myCoolJavascriptVariable;
var pos = 0;

myCoolJavascriptVariable = window.location.href.split("/");
 
 
login = function() {
	$(document).ready(function () {
		
	});

	$('#frmlogin').submit(function(event){
		event.preventDefault();
		
		var request = $.ajax({
			url:$('#frmlogin').attr("action"),
			type:$('#frmlogin').attr("method"),
			data:$('#frmlogin').serialize(),
			error: function(){
				Vtitle = 'No se puede Acceder por Error';
				Vtype = 'error';
				sweetalert(Vtitle,Vtype); 
			}
		});	
		request.done(function( respuesta ) {
			var posts = JSON.parse(respuesta);
			if(posts.valor == -3){
				Swal.fire({
					type: 'warning',
					title: 'Usuario Bloqueado!',
					text: posts.respuesta,
					showCancelButton: true,
					confirmButtonColor: '#3085d6',
					cancelButtonColor: '#d33',
					confirmButtonText: 'Si, desbloquear!'
				}).then((result) => {
					if (result.value) {
						window.location="unlock_pass/"+myCoolJavascriptVariable[5];
					}
				})
			}else if(posts.valor == 0){
				window.location="change_pass/"+myCoolJavascriptVariable[5];
			}else if(posts.valor == 1){
				window.location="principal";
			}else if(posts.valor == 99){
				window.location="principalClie";
			}else{
				Swal.fire({
					title:'Error de Acceso!',
					text:posts.respuesta,
					type: 'error'
				})
			}
		});
	});
};

unlock_pass = function() {
	$(document).ready(function () {
		if($('#tipo').val()=='1'){
			$('#email').val('');
			$("#email").prop({readonly:false});
		}else if($('#tipo').val()=='2'){
			$("#email").prop({readonly:true});
		} 
	});

	$('#frmrecoverpwd').submit(function(event){
		event.preventDefault();
		
		var request = $.ajax({
			url:$('#frmrecoverpwd').attr("action"),
			type:$('#frmrecoverpwd').attr("method"),
			data:$('#frmrecoverpwd').serialize(),
			error: function(){
				Vtitle = 'No se puede Acceder por Error';
				Vtype = 'error';
				sweetalert(Vtitle,Vtype); 
			}
		});	
		request.done(function( respuesta ) {
			var posts = JSON.parse(respuesta);
			if(posts.valor == -6){		
				Swal.fire({
					title: 'Error en Validar Email!',
					text: posts.respuesta,
					type: 'error',
				})
			}else if(posts.valor == 3){		
				Swal.fire({
					title: 'Envio de Email!',
					text: posts.respuesta,
					position: 'center',
					type: 'success',
					showConfirmButton: false,
					timer: 6000
				}).then((result) => {
					if (result.dismiss === Swal.DismissReason.timer) {
						var retornar = document.getElementById('btnreturn');
						retornar.click();
					}
				})
			}
			
		});
	});
}

change_pass = function() {
	$(document).ready(function () {

		$("#email").prop({readonly:true});
		$('#txtpassword').val(''); 

		var folderimage;
		var tipogenero;
		var nombresprf;
		var userlogin;
		
		var tipopsw = $('#TipoPassword').val();//$('[name=TipoPassword]');
		var pass1 = $('[name=new_password]');
		var pass2 = $('[name=conf_password]');
		var compania = $('#cia').val();//$('[name=cia]');

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

	$('#frmchangepwd').submit(function(event){
		event.preventDefault();
		
		var request = $.ajax({
			url:$('#frmchangepwd').attr("action"),
			type:$('#frmchangepwd').attr("method"),
			data:$('#frmchangepwd').serialize(),
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
}


switch(myCoolJavascriptVariable[5]) {
    case "unlock_pass":
		unlock_pass();
		break;
    case "recover_pass":
		unlock_pass();
		break;
    case "change_pass":
		change_pass();
		break;
    case "recovery_password":
		change_pass();
		break;
	default:
		login();
}


const Toast = Swal.mixin({
	toast: true,
	position: 'top-end',
	showConfirmButton: false,
	timer: 6000
});

sweetalert = function(Vtitle,Vtype){
	Toast.fire({
	  type: Vtype,
	  title: Vtitle
	})
};

