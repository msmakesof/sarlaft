		$(function() {
			load(1);
		});
		$('.select2').select2();
		let tabla = "usuario";
		let estado = "";
		function load(page){
			var query=$("#q").val();
			var per_page=10;
			var parametros = {"action":"ajax","page":page,'query':query,'per_page':per_page};
			$("#loader").fadeIn('slow');
			$.ajax({
				url:'ajax/'+ tabla +'/listar.php',
				data: parametros,
				beforeSend: function(objeto){
					$("#loader").html("Cargando...");
			  	},
				success:function(data){
					$(".outer_div").html(data).fadeIn('slow');
					$("#loader").html("");
				}
			})
		}
		$('#editUserModal').on('show.bs.modal', function (event) {
			setTimeout(function (){
				$('#edit_customerkey2').focus();
				$('#edit_customerkey2').select2('open');
			}, 1000)
			var button = $(event.relatedTarget) // Button that triggered the modal
			var customerkey2 = button.data('customerkey2')
			$('#edit_customerkey2').val(customerkey2)
			var name = button.data('name') 
			$('#edit_name').val(name)
			var email = button.data('email') 
			$('#edit_email').val(email)
			var password2 = button.data('password2') 
			$('#edit_password2').val(password2)
			estado = button.data('estado')
			$('#edit_estado').val(estado)			
			var parametros = "idcustomer="+customerkey2
			var dir = "ajax/"+ tabla +"/editarcustomer.php?"+parametros
			$.ajax({
				type: "POST",
				url: "ajax/"+ tabla +"/editarcustomer.php",
				data: parametros,
				success: function(datos){
					let slct = '<select class="form-control" name="edit_customerkey2" id="edit_customerkey2" style="width: 100%;" required>';
						slct += datos;
						slct += '</select>';
					$("#edit_customerkey2").html(slct)
				}	
			})
			
			parametros = "idestado="+estado
			$.ajax({
				type: "POST",
				url: "ajax/"+ tabla +"/editarestado.php",
				data: parametros,
				success: function(datos){
					let slct = '<select class="form-control" name="edit_estado" id="edit_estado" style="width: 100%;" required>';
						slct += datos;
						slct += '</select>';
					$("#edit_estado").html(slct)
				}	
			})
			var id = button.data('id') 
			$('#edit_id').val(id)			
		})
		
		$('#deleteUserModal').on('show.bs.modal', function (event) {
			var button = $(event.relatedTarget) // Button that triggered the modal
			var id = button.data('id') 
			$('#delete_id').val(id)
		})		
		
		$( "#edit_user" ).submit(function( event ) {
			var parametros = $(this).serialize();
			$.ajax({
				type: "POST",
				url: "ajax/"+ tabla +"/editar.php",
				data: parametros,
				beforeSend: function(objeto){
					$("#resultados").html("Enviando...");
				},
				success: function(datos){
					$("#resultados").html(datos);
					$('#editUserModal').modal('hide');
					let msj = datos.substr(0,1);
					let type;
					let txt;
					if(msj == 'U'){
						type = 'success';
						txt = 'El '+ tabla +' ha sido actualizado con éxito.';
					}
					else if(msj == 'E'){
						type= 'warning';
						txt = 'Ya existe un '+ tabla +' grabado con el mismo Nombre.';
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
						type: ''+ type,
						title: ''+ txt,
						showConfirmButton: true,
						timer: 5000
					});
					setTimeout(function() {
						load(1);
						location.reload();
					}, 3000);
				}
			});
		  event.preventDefault();
		});	
		
		$( "#addUserModal" ).on('show.bs.modal', function () {			
			setTimeout(function (){
				$('#edit_customerkey2').focus();
				$('#edit_customerkey2').select2('open');
			}, 1000)
		});
		
		$( "#add_user" ).submit(function( event ) {
			var parametros = $(this).serialize();
			$.ajax({
				type: "POST",
				url: "ajax/"+ tabla +"/guardar.php",
				data: parametros,
				beforeSend: function(objeto){
					$("#resultados").html("Enviando...");
				},
				success: function(datos){					
					$("#resultados").html(datos);
					$('#addUserModal').modal('hide');
					let msj = datos.substr(0,1);
					let type;
					let txt;
					if(msj == 'O'){
						type = 'success';
						txt = 'El '+ tabla +' ha sido guardado con éxito.';
					}
					else if(msj == 'E'){
						type= 'warning';
						txt = 'Ya existe un Registro grabado con el mismo Nombre.';
					}
					else if(msj == 'D'){
						type= 'error';
						txt ='Error Desconocido.';
					}
					else{
						type= 'error';
						txt = 'Lo sentimos, el registro falló. Por favor, regrese y vuelva a intentarlo.'+ datos;
					}
					swal({
						position: 'top-end',
						type: ''+ type,
						title: ''+ txt,
						showConfirmButton: true,
						timer: 5000
					});
					setTimeout(function() {
						load(1);
						location.reload();
					}, 3000);
				}
			});
			event.preventDefault();
		});
		
		$( "#delete_user" ).submit(function( event ) {
			var parametros = $(this).serialize();
			$.ajax({
				type: "POST",
				url: "ajax/"+ tabla +"/delete.php",
				data: parametros,
				beforeSend: function(objeto){
					$("#resultados").html("Enviando...");
				},
				success: function(datos){
					$("#resultados").html(datos);
					//load(1);location.reload();
					$('#deleteUserModal').modal('hide');
					let msj = datos.substr(0,1);
					let type;
					let txt;
					if(msj == 'B'){
						type = 'success';
						txt = 'El '+ tabla +' ha sido eliminado con éxito';
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
						type: ''+ type,
						title: ''+ txt,
						showConfirmButton: true,
						timer: 5000
					});
					setTimeout(function() {
						load(1);
						location.reload();
					}, 3000);
				}
			});
			event.preventDefault();
		});