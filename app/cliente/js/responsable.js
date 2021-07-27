$('#addResponsableModal').on('show.bs.modal', function (event) {
	$('#ResponsablesName2').val('')
	setTimeout(function (){
		$('#ResponsablesName2').focus()
	}, 1000)
})

$( "#add_responsable" ).submit(function( event ) {
	var parametros = $(this).serialize();
	//alert(parametros);
	$.ajax({
		type: "POST",
		url: "../ajax/responsables/guardar_responsable.php",
		data: parametros,
		 beforeSend: function(objeto){
			$("#resultados").html("Enviando...");
		},
		success: function(datos){
			//alert(datos);
			$('#addResponsableModal').modal('hide');
			let m= datos.trim();
			let msj = m.substr(0,1);
			let type;
			let txt;
			//alert(msj);
			if(msj == 'O'){
				type = 'success';
				txt = 'Responsable ha sido guardado con éxito.';
				$.post("../curl/responsables/listar2.php", function(datos){
					$("#responsable").html(datos)
				})
			}
			else if(msj == 'E'){
				type= 'warning';
				txt = 'En Responsable Ya existe un Registro grabado con el mismo Nombre.';
			}							
			else if(msj == 'F'){
				type= 'error';
				txt = 'Lo sentimos, el registro falló. Por favor, regrese y vuelva a intentarlo.';
			}
			else if(msj == 'D'){
				type= 'error';
				txt ='Error Desconocido.';
			}
			else{
				type= 'error';
				txt = 'Lo sentimos, el registro falló. Por favor, regrese y vuelva a intentarlo.';
			}
			swal({
				position: 'top-end',
				type: ''+type,
				title: ''+txt,
				showConfirmButton: true,
				timer: 2000
			});
		}
	});
	event.preventDefault();
});