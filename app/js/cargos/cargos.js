		$(function() {
			load(1);
		});
		function load(page){
			var query=$("#q").val();
			var per_page=10;
			var parametros = {"action":"ajax","page":page,'query':query,'per_page':per_page};
			$("#loader").fadeIn('slow');
			$.ajax({
				url:'ajax/listar_cargos.php',
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
		
		$('#addCargoModal').on('show.bs.modal', function (event) {
			setTimeout(function (){
				$('#CargosName2').focus()
			}, 1500)
		})
		
		$('#editCargoModal').on('show.bs.modal', function (event) {
			setTimeout(function (){
				$('#edit_name').focus()
			}, 1500)
		  var button = $(event.relatedTarget) // Button that triggered the modal
		  var name = button.data('name') 
		  $('#edit_name').val(name)
		  var id = button.data('id') 
		  $('#edit_id').val(id)
		})
		
		$('#deleteCargoModal').on('show.bs.modal', function (event) {
		  var button = $(event.relatedTarget) // Button that triggered the modal
		  var id = button.data('id') 
		  $('#delete_id').val(id)
		})		
		
		$('#edit_cargo').submit(function( event ) {
		  var parametros = $(this).serialize();
			$.ajax({
					type: "POST",
					url: "ajax/editar_cargo.php",
					data: parametros,
					 beforeSend: function(objeto){
						$("#resultados").html("Enviando...");
					  },
					success: function(datos){
					$("#resultados").html(datos);
					$('#editCargoModal').modal('hide');
					setTimeout(function (){
						load(1); location.reload();
					}, 3000)					
				  }
			});
		  event.preventDefault();
		});
		
		
		$( "#add_cargo" ).submit(function( event ) {
		  var parametros = $(this).serialize();
			$.ajax({
					type: "POST",
					url: "ajax/guardar_cargo.php",
					data: parametros,
					 beforeSend: function(objeto){
						$("#resultados").html("Enviando...");
					  },
					success: function(datos){
					$("#resultados").html(datos);
					//load(1);location.reload();
					$('#addCargoModal').modal('hide');
					setTimeout(function (){
						load(1); location.reload();
					}, 3000)
				  }
			});
		  event.preventDefault();
		});
		
		$( "#delete_cargo" ).submit(function( event ) {
		  var parametros = $(this).serialize();
			$.ajax({
					type: "POST",
					url: "ajax/delete_cargo.php",
					data: parametros,
					 beforeSend: function(objeto){
						$("#resultados").html("Enviando...");
					  },
					success: function(datos){
					$("#resultados").html(datos);
					//load(1);location.reload();
					$('#deleteCargosModal').modal('hide');
					setTimeout(function (){
						load(1);location.reload();
					}, 3000)
				  }
			});
		  event.preventDefault();
		});