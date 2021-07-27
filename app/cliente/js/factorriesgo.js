let CKfr = global.key;
let itemfactorriesgo = 0
$("#addfar").on('click', function(){
	let slct = '';
	$.get("../api/factoresriesgo/lista_eve.php", {ck: CKfr  }, function(result){
		let opc = "<option value=''>Seleccione opción</option>";
		$.each(result.body, function(i, item) {
			opc +="<option value='"+ item.FAR_IdFactorRiesgo +"'>"+ item.FAR_Nombre +"</option>";
		});
		slct = '<select class="form-control factorie" id="fr" name="fr">';					
		slct += opc;
		slct += '</select>';
		itemfactorriesgo = itemfactorriesgo + 1;
		$("#tabfar").append('<tbody>');
		$("#tabfar").append('<tr id="FAR'+itemfactorriesgo+'"><td style="width:10%"></td><td style="width:80%">'+ slct +'</td><td style="width:10%"><div class="delete"><i class="fas fa-trash" style="color:red; cursor:pointer"></i></div></td></tr>');
		$("#tabfar").append('</tbody>');
		$('.delete').off().click(function(e) {
			$(this).parent('td').parent('tr').remove();
		});
	})
})
$('#addFactorRiesgoModal').on('show.bs.modal', function (event) {
	$('#FactorRiesgoName2').val('')
	setTimeout(function (){
		$('#FactorRiesgoName2').focus()
	}, 1000)
})

$( "#add_factorriesgo" ).submit(function( event ) {
	var parametros = $(this).serialize();
		$.ajax({
			type: "POST",
			url: "../ajax/factoresriesgo/guardar_fr.php",
			data: parametros,
			 beforeSend: function(objeto){
				$("#resultados").html("Enviando...");
			},
			success: function(datos){
				$('#addFactorRiesgoModal').modal('hide');
				let m= datos.trim()
				let msj = m.substr(0,1);
				let type
				let txt
				if(msj == 'O'){
					type = 'success';
					txt = 'Factor de Riesgo ha sido guardado con éxito.';
				}
				else if(msj == 'E'){
					type= 'warning';
					txt = 'En Factor de Riesgo Ya existe un Registro grabado con el mismo Nombre.';
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