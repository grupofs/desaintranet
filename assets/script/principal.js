var Vtitle, Vtype, vccia, timeExpira; 
var oTable_listaadministrado;

vccia = $('#hdnccia').val();
vsessionAct = $('#hdsessionAct').val();

ExpiraSession = function() {
	if (vsessionAct == 'N'){
		$('#modalExpired').modal('show');
	}
}

window.setInterval("ExpiraSession()",3600000);


$('#modalExpired').on('show.bs.modal', function (e) {	

	let secondCount = 0;
	let stopWatch;

	const displayPara = document.querySelector('#timerDiv');
	
	stopWatch = setInterval(displayCount, 1000);

	function displayCount() {
		let remainTime = (1200 - secondCount);
		if(remainTime <= 0) {
			clearInterval(stopWatch);
			cerrarModal();
		}else{
			let remainSeconds = ('0' + Math.floor(remainTime % 60)).slice(-2);
			let remainMinutes = ('0' + Math.floor(remainTime / 60 % 60)).slice(-2);
		
			displayPara.textContent = remainMinutes + ':' + remainSeconds;
		
			secondCount++;
		}
	}

	$('#btnContinuar').click(function(){
		clearInterval(stopWatch);
        secondCount = 0;
        displayCount();
	});
});

$('#modalExpired').on('hidden.bs.modal', function (e) {	
	$('#btnContinuar').click();
});

cerrarModal = function() {
	$('#cerrarModal').click();
	window.location=baseurl+"cexpired/session_expired/"+vccia;
};

/* Globales - Principal - Main */
	CerrarSesion = function(){
		Swal.fire({
			type: 'error',
			title: 'Cerrar Sesion',
			text: '¿Deseas Cerrar Sesion?',
			showCancelButton: true,
			confirmButtonColor: '#3085d6',
			cancelButtonColor: '#d33',
			confirmButtonText: 'Si, Cerrar Sesion!'
		}).then((result) => {
			if (result.value) {
				$.ajax({
					url:  baseurl+"cprincipal/cerrar",
					type:"POST", 
					data:{},
					success:function(){
						window.location=baseurl+"clogin/"+ccia;
					}
				});				
			}
		})
	};

	const Toast = Swal.mixin({
		toast: true,
		position: 'top-end',
		showConfirmButton: false,
		timer: 4000
	});

	sweetalert = function(Vtitle,Vtype){
		Toast.fire({
		type: Vtype,
		title: Vtitle,
		})
	};
/* /. Globales - Principal - Main */

/* Script Formularios */
	bsCustomFileInput.init();

	$('.select2').select2();

	$('.select2bs4').select2({
		theme: 'bootstrap4'
	});

	$("input[data-bootstrap-switch]").each(function(){
		$(this).bootstrapSwitch('state', $(this).prop('checked'));
	});
	
	$('[data-mask]').inputmask()

	$('.duallistbox').bootstrapDualListbox();
/* /. Script Formularios */



/*var myCoolJavascriptVariable;

myCoolJavascriptVariable = window.location.href.split("/");
 
switch(myCoolJavascriptVariable[4]) {
    case "cprincipal":
		principal();
        break;
		
}; */

(function($) {

	$.fn.refreshSelect2 = function(data) {
		data = (typeof data === 'undefined') ? [] : data;
		this.select2('data', data);
		const options = data.map(function(item) {
			return '<option value="' + item.id + '" >' + item.text + '</option>';
		});
		$(this[0]).html(options.join('')).change();
	};

})(jQuery);

const objPrincipal = {};

$(function() {

	/**
	 * Muestra una carga a un boton y lo desactiva
	 * @param boton
     */
	objPrincipal.botonCargando = function(boton) {
		const icon = boton.find('i.fa');
		if (icon.length) icon.hide();
		boton.prepend('<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true" ></span>');
		boton.prop('disabled', true);
	};

	/**
	 * Libera el boton de la carga y lo activa
	 * @param boton
     */
	objPrincipal.liberarBoton = function(boton) {
		const carga = boton.find('span.spinner-border');
		const icon = boton.find('i.fa');
		if (carga.length) carga.remove();
		if (icon.length) icon.show();
		boton.prop('disabled', false);
	}

});