$(function() {
	load(1);
});

function load(page){
	var parametros = {"action":"ajax"};
	$("#loader").fadeIn('slow');
	$.ajax({
		url:'ajax/contexto/listar.php',
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
	let base64Img	
	base64Img = "img/edit.png"	
		
	const { jsPDF } = window.jspdf            
	const doc = new jsPDF('p', 'pt', 'letter')
	var totalPagesExp = "{total_pages_count_string}"			
	
	doc.autoTable({ 
		useCORS: true,
		columns: [
			{ header: ' ', dataKey: 'no' },
			{ header: 'Contexto Interno', dataKey: 'CTX_Interno' },
			{ header: 'Contexto Interno', dataKey: 'CTX_Externo' },
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
			doc.text("Reporte de Contextos", data.settings.margin.left+190, 40);
			
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
	
	doc.save('contexto.pdf')
})

$( "#addContextoModal" ).on('show.bs.modal', function () {			
	setTimeout(function (){
		$('#Interno').focus();
	}, 1000)
});

$( "#add_contexto" ).submit(function( event ) {
	var parametros = $(this).serializeArray();
	$.ajax({
		type: "POST",
		url: "ajax/contexto/guardar.php",
		data: parametros,
		beforeSend: function(objeto){
			$("#resultados").html("Enviando...");
		},
		success: function(datos){
			let m= datos.trim();
			$("#resultados").html(datos);
			$('#addContextoModal').modal('hide');
			let msj = m.substr(0,1);
			let type;
			let txt;
			if(msj == 'O'){
				type = 'success';
				txt = 'Contexto ha sido guardado con éxito.';
			}
			else if(msj == 'E'){
				type= 'warning';
				txt = 'Ya existe un Registro grabado con el mismo Nombre.';
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
				timer: 5000
			});
			setTimeout(function (){
				load(1);location.reload();	
			}, 3000)
		}
	});
	event.preventDefault();
});

$('#editContextoModal').on('show.bs.modal', function (event) {
	setTimeout(function (){
		$('#eActividadEconomica').focus();
	}, 1000)
	var button = $(event.relatedTarget) // Button that triggered the modal
	var interno = button.data('interno') 
	$('#eInterno').val(interno)
	var externo = button.data('externo') 
	$('#eExterno').val(externo)
	var id = button.data('id')
	$('#edit_id').val(id)
})

$( "#edit_contexto" ).submit(function( event ) {
	var parametros = $(this).serialize();
	$.ajax({
		type: "POST",
		url: "ajax/contexto/editar.php",
		data: parametros,
		beforeSend: function(objeto){
			$("#resultados").html("Enviando...");
		},
		success: function(datos){
			m = datos.trim();	
			$("#resultados").html(datos);
			$('#editContextoModal').modal('hide');
			let msj = m.substr(0,1);
			let type;
			let txt;
			if(msj == 'U'){
				type = 'success';
				txt = 'Contexto ha sido actualizado con éxito.';
			}
			else if(msj == 'E'){
				type= 'warning';
				txt = 'Ya existe un Registro grabado con el mismo Nombre.';
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
				timer: 5000
			});
			setTimeout(function (){
				load(1);location.reload();
			}, 3000)
		}
	});
	event.preventDefault();
});

$('#deleteContextoModal').on('show.bs.modal', function (event) {
	var button = $(event.relatedTarget) // Button that triggered the modal
	var id = button.data('id') 
	$('#delete_id').val(id)
})

$( "#delete_contexto" ).submit(function( event ) {
	var parametros = $(this).serialize();
	$.ajax({
		type: "POST",
		url: "ajax/contexto/delete.php",
		data: parametros,
		beforeSend: function(objeto){
			$("#resultados").html("Enviando...");
		},
		success: function(datos){
			let m= datos.trim();
			$("#resultados").html(datos);
			$('#deleteContextoModal').modal('hide');
			let msj = m.substr(0,1);
			let type;
			let txt;
			if(msj == 'B'){
				type = 'success';
				txt = 'Contexto ha sido borrado con éxito.';
			}
			else if(msj == 'R'){
				type= 'error';
				txt = 'Lo sentimos, el registro falló por conexión. Por favor, regrese y vuelva a intentarlo.';
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
				timer: 5000
			});
			setTimeout(function (){
				load(1);location.reload();
			}, 3000)
		}
	});
	event.preventDefault();
});