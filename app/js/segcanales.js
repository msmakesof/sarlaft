		$(function() {
			load(1);
		});
		
		function load(page){
			var query=$("#q").val();
			var per_page=10;
			var parametros = {"action":"ajax","page":page,'query':query,'per_page':per_page};
			$("#loader").fadeIn('slow');
			$.ajax({
				url:'ajax/listar_segcanales.php',
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
					{ header: 'Nombre', dataKey: 'SegCanalesName' },
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
					doc.text("Reporte de Canales", data.settings.margin.left+190, 40);
					
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
				html: '#dataTable'
			})
			
			doc.deletePage(1) //Elimina primera hoja en blanco
			
			// Total page number plugin only available in jspdf v1.0+
			if (typeof doc.putTotalPages === 'function') {
			  doc.putTotalPages(totalPagesExp);
			}
			
			doc.save('canales.pdf')
		})
		
		$('#addSegCanalesModal').on('show.bs.modal', function (event) {
			setTimeout(function (){
				$('#SegCanalesName2').focus()
			}, 1000)
		})
		
		$('#editSegCanalesModal').on('show.bs.modal', function (event) {
			setTimeout(function (){
				$('#edit_name').focus()
			}, 1500)
		  var button = $(event.relatedTarget) // Button that triggered the modal
		  var name = button.data('name') 
		  $('#edit_name').val(name)
		  var id = button.data('id') 
		  $('#edit_id').val(id)
		})
		
		$('#deleteSegCanalesModal').on('show.bs.modal', function (event) {
		  var button = $(event.relatedTarget) // Button that triggered the modal
		  var id = button.data('id') 
		  $('#delete_id').val(id)
		})
		
		
		$( "#edit_segcanales" ).submit(function( event ) {
		  var parametros = $(this).serialize();
			$.ajax({
					type: "POST",
					url: "ajax/editar_segcanales.php",
					data: parametros,
					 beforeSend: function(objeto){
						$("#resultados").html("Enviando...");
					  },
					success: function(datos){
					$("#resultados").html(datos);
					//load(1);location.reload();
					$('#editSegCanalesModal').modal('hide');
					setTimeout(function (){
						load(1);location.reload();
					}, 3000)
				  }
			});
		  event.preventDefault();
		});
		
		
		$( "#add_segcanales" ).submit(function( event ) {
		  var parametros = $(this).serialize();
			$.ajax({
					type: "POST",
					url: "ajax/guardar_segcanales.php",
					data: parametros,
					 beforeSend: function(objeto){
						$("#resultados").html("Enviando...");
					  },
					success: function(datos){
					$("#resultados").html(datos);
					//load(1);location.reload();
					$('#addSegCanalesModal').modal('hide');
					setTimeout(function (){
						load(1);location.reload();
					}, 3000)
				  }
			});
		  event.preventDefault();
		});
		
		$( "#delete_segcanales" ).submit(function( event ) {
		  var parametros = $(this).serialize();
			$.ajax({
					type: "POST",
					url: "ajax/delete_segcanales.php",
					data: parametros,
					 beforeSend: function(objeto){
						$("#resultados").html("Enviando...");
					  },
					success: function(datos){
					$("#resultados").html(datos);
					//load(1);location.reload();
					$('#deleteSegCanalesModal').modal('hide');
					setTimeout(function (){
						load(1);location.reload();
					}, 3000)
				  }
			});
		  event.preventDefault();
		});