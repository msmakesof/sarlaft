		$(function() {
			load(1);
		});
		function load(page){
			var query=$("#q").val();
			var per_page=10;
			var parametros = {"action":"ajax","page":page,'query':query,'per_page':per_page};
			$("#loader").fadeIn('slow');
			$.ajax({
				url:'ajax/listar_enivelderiesgo.php',
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
		$('#editENivelderiesgoModal').on('show.bs.modal', function (event) {
		  var button = $(event.relatedTarget) // Button that triggered the modal
		  var name = button.data('name') 
		  $('#edit_name').val(name)
		  var id = button.data('id') 
		  $('#edit_id').val(id)
		})
		
		$('#deleteENivelderiesgoModal').on('show.bs.modal', function (event) {
		  var button = $(event.relatedTarget) // Button that triggered the modal
		  var id = button.data('id') 
		  $('#delete_id').val(id)
		})
		
		
		$( "#edit_enivelderiesgo" ).submit(function( event ) {
		  var parametros = $(this).serialize();
			$.ajax({
					type: "POST",
					url: "ajax/editar_enivelderiesgo.php",
					data: parametros,
					 beforeSend: function(objeto){
						$("#resultados").html("Enviando...");
					  },
					success: function(datos){
					$("#resultados").html(datos);
					load(1);location.reload();
					$('#editENivelderiesgoModal').modal('hide');
				  }
			});
		  event.preventDefault();
		});
		
		
		$( "#add_enivelderiesgo" ).submit(function( event ) {
		  var parametros = $(this).serialize();
			$.ajax({
					type: "POST",
					url: "ajax/guardar_enivelderiesgo.php",
					data: parametros,
					 beforeSend: function(objeto){
						$("#resultados").html("Enviando...");
					  },
					success: function(datos){
					$("#resultados").html(datos);
					load(1);location.reload();
					$('#addENivelderiesgoModal').modal('hide');
				  }
			});
		  event.preventDefault();
		});
		
		$( "#delete_enivelderiesgo" ).submit(function( event ) {
		  var parametros = $(this).serialize();
			$.ajax({
					type: "POST",
					url: "ajax/delete_enivelderiesgo.php",
					data: parametros,
					 beforeSend: function(objeto){
						$("#resultados").html("Enviando...");
					  },
					success: function(datos){
					$("#resultados").html(datos);
					load(1);location.reload();
					$('#deleteENivelderiesgoModal').modal('hide');
				  }
			});
		  event.preventDefault();
		});