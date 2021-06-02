		$(function() {
			load(1);
		});
		function load(page){
			var query=$("#q").val();
			var per_page=10;
			var parametros = {"action":"ajax","page":page,'query':query,'per_page':per_page};
			$("#loader").fadeIn('slow');
			$.ajax({
				url:'ajax/listar_planes.php',
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
		$('#editPlanModal').on('show.bs.modal', function (event) {
		  var button = $(event.relatedTarget) // Button that triggered the modal
		  
		  var name = button.data('name') 
		  $('#edit_name').val(name)
		  var responsable = button.data('responsable') 
		  $('#edit_responsable').val(responsable)
		  var tarea = button.data('tarea') 
		  $('#edit_tarea').val(tarea)
		  var plazo = button.data('plazo') 
		  $('#edit_plazo').val(plazo)		  
		  var aprueba = button.data('aprueba') 
		  $('#edit_aprueba').val(aprueba)
		  var nivelp = button.data('nivelp') 
		  $('#edit_nivelp').val(nivelp)
		  var resps = button.data('resps') 
		  $('#edit_resps').val(resps)
		  var respa = button.data('respa') 
		  $('#edit_respa').val(respa)		  
		  var inicio = button.data('inicio') 
		  $('#edit_inicio').val(inicio)
		  var fseg = button.data('fseg') 
		  $('#edit_fseg').val(fseg)
		  var termina = button.data('termina') 
		  $('#edit_termina').val(termina)
		  var avance = button.data('avance') 
		  $('#edit_avance').val(avance)
		  var id = button.data('id') 
		  $('#edit_id').val(id)
		})

		$('#newTareaPlanModal').on('show.bs.modal', function (event) {
		  var button = $(event.relatedTarget) // Button that triggered the modal
		  
		  var name = button.data('name') 
		  $('#new_name').val(name)
		  var key = button.data('key') 
		  $('#new_key').val(key)		  
		  var responsable = button.data('responsable') 
		  $('#new_responsable').val(responsable)
		  var tarea = button.data('tarea') 
		  $('#new_tarea').val(tarea)
		  var plazo = button.data('plazo') 
		  $('#new_plazo').val(plazo)		  
		  var aprueba = button.data('aprueba') 
		  $('#new_aprueba').val(aprueba)
		  var nivelp = button.data('nivelp') 
		  $('#new_nivelp').val(nivelp)
		  var resps = button.data('resps') 
		  $('#new_resps').val(resps)
		  var respa = button.data('respa') 
		  $('#new_respa').val(respa)		  
		  var inicio = button.data('inicio') 
		  $('#new_inicio').val(inicio)
		  var fseg = button.data('fseg') 
		  $('#new_fseg').val(fseg)
		  var termina = button.data('termina') 
		  $('#new_termina').val(termina)
		  var avance = button.data('avance') 
		  $('#new_avance').val(avance)
		  var id = button.data('id') 
		  $('#new_id').val(id)
		})		
		
		$('#deletePlanModal').on('show.bs.modal', function (event) {
		  var button = $(event.relatedTarget) // Button that triggered the modal
		  var id = button.data('id') 
		  $('#delete_id').val(id)
		})
		
		
		$( "#edit_plan" ).submit(function( event ) {
		  var parametros = $(this).serialize();
			$.ajax({
					type: "POST",
					url: "ajax/editar_plan.php",
					data: parametros,
					 beforeSend: function(objeto){
						$("#resultados").html("Enviando...");
					  },
					success: function(datos){
					$("#resultados").html(datos);
					load(1);location.reload();
					$('#editPlanModal').modal('hide');
				  }
			});
		  event.preventDefault();
		});
	
			$( "#new_plan" ).submit(function( event ) {
		  var parametros = $(this).serialize();
			$.ajax({
					type: "POST",
					url: "ajax/newtarea_plan.php",
					data: parametros,
					 beforeSend: function(objeto){
						$("#resultados").html("Enviando...");
					  },
					success: function(datos){
					$("#resultados").html(datos);
					load(1);location.reload();
					$('#newTareaPlanModal').modal('hide');
				  }
			});
		  event.preventDefault();
		});	
		
		$( "#add_plan" ).submit(function( event ) {
		  var parametros = $(this).serialize();
			$.ajax({
					type: "POST",
					url: "ajax/guardar_plan.php",
					data: parametros,
					 beforeSend: function(objeto){
						$("#resultados").html("Enviando...");
					  },
					success: function(datos){
					$("#resultados").html(datos);
					load(1);location.reload();
					$('#addPlanModal').modal('hide');
				  }
			});
		  event.preventDefault();
		});
		
		$( "#delete_plan" ).submit(function( event ) {
		  var parametros = $(this).serialize();
			$.ajax({
					type: "POST",
					url: "ajax/delete_plan.php",
					data: parametros,
					 beforeSend: function(objeto){
						$("#resultados").html("Enviando...");
					  },
					success: function(datos){
					$("#resultados").html(datos);
					load(1);location.reload();
					$('#deletePlanModal').modal('hide');
				  }
			});
		  event.preventDefault();
		});