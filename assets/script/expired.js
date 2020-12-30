

	$('#frmCierre').submit(function(event){
		event.preventDefault();
		var request = $.ajax({
			url:$('#frmCierre').attr("action"),
			type:$('#frmCierre').attr("method"),
			data:$('#frmCierre').serialize(),
			error: function(){
				Vtitle = 'No se puede registrar por error';
				Vtype = 'error';
				sweetalert(Vtitle,Vtype);
			}
		});
		request.done(function( respuesta ) {
			var posts = JSON.parse(respuesta);		
			if (posts.valor == 0){                
				Swal.fire({
					title:'Error de Acceso!',
					text:posts.respuesta,
					type: 'error'
				})
			} else {
				window.location=baseurl+"cpanel";
			}
		});
    });
    
   