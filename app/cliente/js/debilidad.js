let CKDeb = global.key;
let itemdebilidad = 0
$("#adddeb").on('click', function(){
	let slct = '';
	$.get("../api/debilidades/lista_eve.php", {ck: CKDeb  }, function(result){
		let opc = "<option value=''>Seleccione opción</option>";
		$.each(result.body, function(i, item) {
			opc +="<option value='"+ item.id +"'>"+ item.DebilidadesName +"</option>";
		});
		slct = '<select class="form-control debil" id="debil" name="debil">';					
		slct += opc;
		slct += '</select>';
		itemdebilidad = itemdebilidad + 1;
		$("#tabdeb").append('<tbody>');
		$("#tabdeb").append('<tr id="DEB'+itemdebilidad+'"><td style="width:10%"></td><td style="width:80%">'+ slct +'</td><td style="width:10%"><div class="delete"><i class="fas fa-trash" style="color:red; cursor:pointer"></i></div></td></tr>');
		$("#tabdeb").append('</tbody>');
		$('.delete').off().click(function(e) {
			$(this).parent('td').parent('tr').remove();
		});
	})
})
$('#addDebilidadesModal').on('show.bs.modal', function (event) {
	$('#DebilidadesName2').val('')
	setTimeout(function (){
		$('#DebilidadesName2').focus()
	}, 1000)
})

$( "#add_debilidades" ).submit(function( event ) {
	var parametros = $(this).serialize();
		$.ajax({
			type: "POST",
			url: "../ajax/debilidades/guardar_debilidades.php",
			data: parametros,
			 beforeSend: function(objeto){
				$("#resultados").html("Enviando...");
			},
			success: function(datos){
				$('#addDebilidadesModal').modal('hide');
				let m= datos.trim()
				let msj = m.substr(0,1);
				let type
				let txt
				if(msj == 'O'){
					type = 'success';
					txt = 'Debilidad ha sido guardada con éxito.';
				}
				else if(msj == 'E'){
					type= 'warning';
					txt = 'En Debilidad Ya existe un Registro grabado con el mismo Nombre.';
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