$('#addCargoModal').on('show.bs.modal', function (event) {
	$('#CargosName2').val('')
	setTimeout(function (){
		$('#CargosName2').focus()
	}, 1000)
})

$( "#add_cargo" ).submit(function( event ) {
	var parametros = $(this).serialize();
	//alert(parametros);
	$.ajax({
		type: "POST",
		url: "../ajax/cargos/guardar_cargo.php",
		data: parametros,
		 beforeSend: function(objeto){
			$("#resultados").html("Enviando...");
		},
		success: function(datos){
			//alert(datos);
			$('#addCargoModal').modal('hide');
			let m= datos.trim();
			let msj = m.substr(0,1);
			let type;
			let txt;
			//alert(msj);
			if(msj == 'O'){
				type = 'success';
				txt = 'Cargo ha sido guardado con éxito.';
				$.post("../curl/cargos/listar2.php", function(datos){
					$("#cargo").html(datos)
				})
			}
			else if(msj == 'E'){
				type= 'warning';
				txt = 'En Cargo Ya existe un Registro grabado con el mismo Nombre.';
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
	})
	event.preventDefault();
})