let CKCau = global.key;
let itemcausa = 0
$("#addcau").on('click', function(){
	let slct = '';
	$.get("../api/causas/lista_eve.php", {ck: CKCau }, function(result){
		let opc = "<option value=''>Seleccione opción</option>";
		$.each(result.body, function(i, item) {
			opc +="<option value='"+ item.id +"'>"+ item.CausasName +"</option>";
		});
		slct = '<select class="form-control causa" id="causa" name="causa">';					
		slct += opc;
		slct += '</select>';
		itemcausa = itemcausa + 1;
		//$("#tabcau").append('<tbody>');
		$("#tabcaubody").append('<tr id="CAU'+itemcausa+'"><td style="width:10%"></td><td style="width:80%">'+ slct +'</td><td style="width:10%"><div class="delete"><i class="fas fa-trash" style="color:red; cursor:pointer"></i></div></td></tr>');
		//$("#tabcau").append('</tbody>');
		$('.delete').off().click(function(e) {
			$(this).parent('td').parent('tr').remove();
		});
	})
})
$('#addCausaModal').on('show.bs.modal', function (event) {
	setTimeout(function (){
		$('#CausasName2').focus()
	}, 1000)
})

$( "#add_causa" ).submit(function( event ) {
	var parametros = $(this).serialize();
		$.ajax({
			type: "POST",
			url: "../ajax/guardar_causa.php",
			data: parametros,
			 beforeSend: function(objeto){
				$("#resultados").html("Enviando...");
			},
			success: function(datos){
				$('#addCausaModal').modal('hide');
				let m= datos.trim()
				let msj = m.substr(0,1);
				let type
				let txt
				if(msj == 'O'){
					type = 'success';
					txt = 'Causa ha sido guardada con éxito.';
				}
				else if(msj == 'E'){
					type= 'warning';
					txt = 'En Causa Ya existe un Registro grabado con el mismo Nombre.';
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