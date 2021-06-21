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
		
		var headRows = function() {
			return [{
			  id: "ID",
			  name: "Name",
			}];
		};

		var bodyRows = function(rowCount) {
			rowCount = rowCount || 10;
			let body = [];

			for (var i = 1; i <= rowCount; i++) {
			  body.push({
				id: i,
				name: "Name " + i
			  });
			}
			return body;
		}	
	
		$("#xpdf").on('click', function(event){			
			//var login = ;
			//alert(param);			
			let base64Img	
			base64Img = "img/edit.png"	
				
			const { jsPDF } = window.jspdf            
			const doc = new jsPDF('p', 'pt', 'letter')
			var totalPagesExp = "{total_pages_count_string}"			
			
			doc.autoTable({ 
				useCORS: true,
				columns: [
					{ header: ' ', dataKey: 'no' },
					{ header: 'Nombre', dataKey: 'PlanesName' },
					{ header: 'Responsable', dataKey: 'esPlanesResponsabletado' },
					{ header: 'Tarea', dataKey: 'PlanesTarea' },
					{ header: 'Plazo', dataKey: 'PlanesPlazo' },
					{ header: 'Aprobado Por', dataKey: 'PlanesAprueba' },
					{ header: 'Nivel', dataKey: 'PlanesNivelPrioridad' },
				],
				  
				startY: doc.autoTable() + 70,
				tableWidth: 'auto',
				margin: {top: 80,
				bottom: 60,
				left: 40,
				width: 522} ,
				body: bodyRows(40),
				beforePageContent: function(data) {
					doc.text("Header", 170, 50);
				},
				styles: { overflow: "linebreak" },
				bodyStyles: { valign: "top" },
				theme: "striped",
				showHead: "everyPage",
				pageBreak: 'always',
				didDrawPage: function (data) {					
					// Header
					doc.setFontSize(20);
					doc.setTextColor(40);
					doc.text("Reporte de Planes", data.settings.margin.left+190, 40);
					
					 if (base64Img) {
						doc.addImage(base64Img, 'PNG', data.settings.margin.left, 15, 140, 30);
					}

					// Footer
					let nro = doc.internal.getNumberOfPages() -1
					var str = "Página " + nro;
					// Total page number plugin only available in jspdf v1.0+
					if (typeof doc.putTotalPages === 'function') {
						
					  str = str + " de " + totalPagesExp;
					}

					doc.setFontSize(10);

					// jsPDF 1.4+ uses getWidth, <1.4 uses .width
					var pageSize = doc.internal.pageSize;
					var pageHeight = pageSize.height
					  ? pageSize.height
					  : pageSize.getHeight();
					doc.text(str, data.settings.margin.left, pageHeight - 10);
					
					doc.text("Usuario: ", data.settings.margin.left+400, pageHeight-10, 0);
				},				
				html: '#example'
			})
			
			doc.deletePage(1) //Elimina primera hoja en blanco
			
			// Total page number plugin only available in jspdf v1.0+
			if (typeof doc.putTotalPages === 'function') {
			  doc.putTotalPages(totalPagesExp);
			}
			
			doc.save('planes.pdf')
		})
		
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
					$('#editPlanModal').modal('hide');
					setTimeout(function (){
						load(1);location.reload();
					}, 3000)
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
					$('#newTareaPlanModal').modal('hide');
					setTimeout(function (){
						load(1);location.reload();
					}, 3000)
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
					$('#addPlanModal').modal('hide');
					setTimeout(function (){
						load(1);location.reload();
					}, 3000)
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
					$('#deletePlanModal').modal('hide');
					setTimeout(function (){
						load(1);location.reload();
					}, 3000)
				  }
			});
		  event.preventDefault();
		});