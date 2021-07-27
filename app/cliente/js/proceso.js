//Proceso
			$('#addProcesoModal').on('show.bs.modal', function (event) {
				$('#ProcesosName2').val('')
				setTimeout(function (){
					$('#ProcesosName2').focus()
				}, 1000)
			})
			
			$( "#add_proceso" ).submit(function( event ) {				
				var x = $('#ProcesosName2').val()
				x = $.trim(x)
				if( x == "" ){
					swal({
						position: 'top-end',
						type: 'warning',
						title: 'Atención: debe digitar el Nombre.',
						showConfirmButton: true,
						timer: 2000
					})
				}
				else {
					var parametros = $(this).serialize();					
					$.ajax({
						type: "POST",
						url: "../ajax/procesos/guardar_proceso.php",
						data: parametros,
						 beforeSend: function(objeto){
							$("#resultados").html("Enviando...");
						},
						success: function(datos){
							$('#addProcesoModal').modal('hide');
							let m= datos.trim();
							let msj = m.substr(0,1);
							let type;
							let txt;
							if(msj == 'O'){
								type = 'success';
								txt = 'Proceso ha sido guardado con éxito.';
							}
							else if(msj == 'E'){
								type= 'warning';
								txt = 'En Proceso Ya existe un Registro grabado con el mismo Nombre.';
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
							})
							$.post("../curl/procesos/listar2.php", function(datos){
								$("#proceso").html(datos);
							})
						}
					})
				}
				event.preventDefault();
			});