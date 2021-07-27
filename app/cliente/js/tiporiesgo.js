let CK = global.key;
let itemtiporiesgo = 0
$("#addtir").on('click', function(){
	let slct = '';
	$.get("../api/tiposriesgo/lista_eve.php", {ck: CK  }, function(result){
		let opc = "<option value=''>Seleccione opción</option>";
		$.each(result.body, function(i, item) {
			opc +="<option value='"+ item.TIR_IdTipoRiesgo +"'>"+ item.TIR_Nombre +"</option>";
		});
		slct = '<select class="form-control tiporie" id="tr" name="tr">';					
		slct += opc;
		slct += '</select>';
		itemtiporiesgo = itemtiporiesgo + 1;
		$("#tabtir").append('<tbody>');
		$("#tabtir").append('<tr id="TIR'+itemtiporiesgo+'"><td style="width:10%"></td><td style="width:80%">'+ slct +'</td><td style="width:10%"><div class="delete"><i class="fas fa-trash" style="color:red; cursor:pointer"></i></div></td></tr>');
		$("#tabtir").append('</tbody>');
		$('.delete').off().click(function(e) {
			$(this).parent('td').parent('tr').remove();
		});
	})
})
$('#addTipoRiesgoModal').on('show.bs.modal', function (event) {
	$('#TipoRiesgoName2').val('')
	setTimeout(function (){
		$('#TipoRiesgoName2').focus()
	}, 1000)
})

$( "#add_tiposriesgo" ).submit(function( event ) {
	var parametros = $(this).serialize();
		$.ajax({
			type: "POST",
			url: "../ajax/tiposriesgo/guardar_tiposriesgo.php",
			data: parametros,
			 beforeSend: function(objeto){
				$("#resultados").html("Enviando...");
			},
			success: function(datos){
				$('#addTipoRiesgoModal').modal('hide');
				let m= datos.trim()
				let msj = m.substr(0,1);
				let type
				let txt
				if(msj == 'O'){
					type = 'success';
					txt = 'Tipo de Riesgo ha sido guardada con éxito.';
				}
				else if(msj == 'E'){
					type= 'warning';
					txt = 'En Tipo de Riesgo Ya existe un Registro grabado con el mismo Nombre.';
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