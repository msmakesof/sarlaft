let CKCon = global.key;
let itemconsecuencia = 0
$("#addcon").on('click', function(){
	let slct = '';
	$.get("../api/consecuencia/lista_eve.php", {ck: CKCon  }, function(result){
		let opc = "<option value=''>Seleccione opción</option>";
		$.each(result.body, function(i, item) {
			opc +="<option value='"+ item.CSC_IdConsecuencia +"'>"+ item.CSC_Nombre +"</option>";
		});
		slct = '<select class="form-control consec" id="consec" name="consec">';					
		slct += opc;
		slct += '</select>';
		itemconsecuencia = itemconsecuencia + 1;
		$("#tabcon").append('<tbody>');
		$("#tabcon").append('<tr id="CON'+itemconsecuencia+'"><td style="width:10%"></td><td style="width:80%">'+ slct +'</td><td style="width:10%"><div class="delete"><i class="fas fa-trash" style="color:red; cursor:pointer"></i></div></td></tr>');
		$("#tabcon").append('</tbody>');
		$('.delete').off().click(function(e) {
			$(this).parent('td').parent('tr').remove();
		});
	})
})
$('#addConsecuenciaModal').on('show.bs.modal', function (event) {
	$('#ConsecuenciasName2').val('')
	setTimeout(function (){
		$('#ConsecuenciasName2').focus()
	}, 1000)
})

$( "#add_consecuencia" ).submit(function( event ) {
	var parametros = $(this).serialize();
		$.ajax({
			type: "POST",
			url: "../ajax/consecuencia/guardar_consecuencia.php",
			data: parametros,
			 beforeSend: function(objeto){
				$("#resultados").html("Enviando...");
			},
			success: function(datos){
				$('#addConsecuenciaModal').modal('hide');
				let m= datos.trim()
				let msj = m.substr(0,1);
				let type
				let txt
				if(msj == 'O'){
					type = 'success';
					txt = 'Consecuencia ha sido guardada con éxito.';
				}
				else if(msj == 'E'){
					type= 'warning';
					txt = 'En Consecuencia Ya existe un Registro grabado con el mismo Nombre.';
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