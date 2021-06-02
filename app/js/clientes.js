		$(function() {
			load(1);
		});
		function load(page){
			var query=$("#q").val();
			var per_page=10;
			var parametros = {"action":"ajax","page":page,'query':query,'per_page':per_page};
			$("#loader").fadeIn('slow');
			$.ajax({
				url:'ajax/listar_clientes.php',
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
		$('#editClienteModal').on('show.bs.modal', function (event) {
		  var button = $(event.relatedTarget) // Button that triggered the modal
		  var code = button.data('code') 
		  $('#edit_code').val(code)
		  var name = button.data('name') 
		  $('#edit_name').val(name)
		  var city = button.data('city') 
		  $('#edit_city').val(city)
		  var nit = button.data('nit') 
		  $('#edit_nit').val(nit)
		  var color = button.data('color') 
		  $('#edit_color').val(color)		  
		  var id = button.data('id') 
		  $('#edit_id').val(id)
		})
		
		$('#deleteClienteModal').on('show.bs.modal', function (event) {
		  var button = $(event.relatedTarget) // Button that triggered the modal
		  var key = button.data('key') 
		  $('#delete_key').val(key)
		  var id = button.data('id') 
		  $('#delete_id').val(id)		  
		})
		
		
		$( "#edit_cliente" ).submit(function( event ) {
		  var parametros = $(this).serialize();
			$.ajax({
					type: "POST",
					url: "ajax/editar_cliente.php",
					data: parametros,
					 beforeSend: function(objeto){
						$("#resultados").html("Enviando...");
					  },
					success: function(datos){
					$("#resultados").html(datos);
					load(1);location.reload();
					$('#editClienteModal').modal('hide');
				  }
			});
		  event.preventDefault();
		});
		
		
		$( "#add_cliente" ).submit(function( event ) {
		  var parametros = $(this).serialize();
			$.ajax({
					type: "POST",
					url: "ajax/guardar_cliente.php",
					data: parametros,
					 beforeSend: function(objeto){
						$("#resultados").html("Enviando...");
					  },
					success: function(datos){
					$("#resultados").html(datos);
					load(1);location.href = "./Clientes?Keyps=2";
					$('#addClienteModal').modal('hide');
				  }
			});
		  event.preventDefault();
		});
		
		$( "#delete_cliente" ).submit(function( event ) {
		  var parametros = $(this).serialize();
			$.ajax({
					type: "POST",
					url: "ajax/delete_cliente.php",
					data: parametros,
					 beforeSend: function(objeto){
						$("#resultados").html("Enviando...");
					  },
					success: function(datos){
					$("#resultados").html(datos);
					load(1);location.reload();
					$('#deleteClienteModal').modal('hide');
				  }
			});
		  event.preventDefault();
		});