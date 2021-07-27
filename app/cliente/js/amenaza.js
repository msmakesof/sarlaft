let CKAme = global.key;
let itemamenaza = 0
$("#addame").on('click', function(){
	let slct = '';
	$.get("../api/amenazas/lista_eve.php", {ck: CKAme  }, function(result){
		let opc = "<option value=''>Seleccione opción</option>";
		$.each(result.body, function(i, item) {
			opc +="<option value='"+ item.id +"'>"+ item.AmenazasName +"</option>";
		});
		slct = '<select class="form-control ame" id="ame" name="ame">';					
		slct += opc;
		slct += '</select>';
		itemamenaza = itemamenaza + 1;
		$("#tabame").append('<tbody>');
		$("#tabame").append('<tr id="AME'+itemamenaza+'"><td style="width:10%"></td><td style="width:80%">'+ slct +'</td><td style="width:10%"><div class="delete"><i class="fas fa-trash" style="color:red; cursor:pointer"></i></div></td></tr>');
		$("#tabame").append('</tbody>');
		$('.delete').off().click(function(e) {
			$(this).parent('td').parent('tr').remove();
		});
	})
})
$('#addAmenazasModal').on('show.bs.modal', function (event) {
	$('#AmenazasName2').val('')
	setTimeout(function (){
		$('#AmenazasName2').focus()
	}, 1000)
})

$( "#add_amenazas" ).submit(function( event ) {
	var parametros = $(this).serialize();
		$.ajax({
			type: "POST",
			url: "../ajax/amenazas/guardar_amenazas.php",
			data: parametros,
			 beforeSend: function(objeto){
				$("#resultados").html("Enviando...");
			},
			success: function(datos){
				$('#addAmenazasModal').modal('hide');
				let m= datos.trim()
				let msj = m.substr(0,1);
				let type
				let txt
				if(msj == 'O'){
					type = 'success';
					txt = 'Amenaza ha sido guardada con éxito.';
				}
				else if(msj == 'E'){
					type= 'warning';
					txt = 'En Amenaza Ya existe un Registro grabado con el mismo Nombre.';
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
				});
			}
		});
	event.preventDefault()
});