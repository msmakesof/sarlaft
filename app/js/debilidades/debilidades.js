		$(function() {
			load(1);
		});
		function load(page){
			var query=$("#q").val();
			var per_page=10;
			var parametros = {"action":"ajax","page":page,'query':query,'per_page':per_page};
			$("#loader").fadeIn('slow');
			$.ajax({
				url:'ajax/listar_debilidades.php',
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
		$('#editDebilidadesModal').on('show.bs.modal', function (event) {
			setTimeout(function (){
				$('#edit_name').focus();
			}, 1000)
		  var button = $(event.relatedTarget) // Button that triggered the modal
		  var name = button.data('name') 
		  $('#edit_name').val(name)
		  var id = button.data('id') 
		  $('#edit_id').val(id)
		})
		
		$('#deleteDebilidadesModal').on('show.bs.modal', function (event) {
		  var button = $(event.relatedTarget) // Button that triggered the modal
		  var id = button.data('id') 
		  $('#delete_id').val(id)
		})
		
		$( "#addDebilidadesModal" ).on('show.bs.modal', function () {			
			setTimeout(function (){
				$('#DebilidadesName2').focus();
			}, 1000)
		});
		
		$( "#edit_debilidades" ).submit(function( event ) {
		  var parametros = $(this).serialize();
			$.ajax({
					type: "POST",
					url: "ajax/editar_debilidades.php",
					data: parametros,
					 beforeSend: function(objeto){
						$("#resultados").html("Enviando...");
					  },
					success: function(datos){
					$("#resultados").html(datos);
					//load(1);location.reload();
					$('#editDebilidadesModal').modal('hide');
					setTimeout(function (){
						load(1);location.reload();
					}, 3000)
				  }
			});
		  event.preventDefault();
		});
		
		
		$( "#add_debilidades" ).submit(function( event ) {
		  var parametros = $(this).serialize();
			$.ajax({
					type: "POST",
					url: "ajax/guardar_debilidades.php",
					data: parametros,
					 beforeSend: function(objeto){
						$("#resultados").html("Enviando...");
					  },
					success: function(datos){
					$("#resultados").html(datos);
					//load(1);location.reload();
					$('#addDebilidadesModal').modal('hide');
					setTimeout(function (){
						load(1);location.reload();
					}, 3000)
				  }
			});
		  event.preventDefault();
		});
		
		$( "#delete_debilidades" ).submit(function( event ) {
		  var parametros = $(this).serialize();
			$.ajax({
					type: "POST",
					url: "ajax/delete_debilidades.php",
					data: parametros,
					 beforeSend: function(objeto){
						$("#resultados").html("Enviando...");
					  },
					success: function(datos){
					$("#resultados").html(datos);
					//load(1);location.reload();
					$('#deleteDebilidadesModal').modal('hide');
					setTimeout(function (){
						load(1);location.reload();
					}, 3000)
				  }
			});
		  event.preventDefault();
		});