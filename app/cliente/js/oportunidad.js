let CKOpo = global.key;
let itemoportunidad = 0
$("#addopo").on('click', function(){
	let slct = '';
	$.get("../api/oportunidades/lista_eve.php", {ck: CKOpo  }, function(result){
		let opc = "<option value=''>Seleccione opción</option>";
		$.each(result.body, function(i, item) {
			opc +="<option value='"+ item.id +"'>"+ item.OportunidadesName +"</option>";
		});
		slct = '<select class="form-control opor" id="opor" name="opor">';					
		slct += opc;
		slct += '</select>';
		itemoportunidad = itemoportunidad + 1;
		//$("#tabopo").append('<tbody>');
		$("#tabopobody").append('<tr id="OPO'+itemoportunidad+'"><td style="width:10%"></td><td style="width:80%">'+ slct +'</td><td style="width:10%"><div class="delete"><i class="fas fa-trash" style="color:red; cursor:pointer"></i></div></td></tr>');
		//$("#tabopo").append('</tbody>');
		$('.delete').off().click(function(e) {
			$(this).parent('td').parent('tr').remove();
		});
	})
})
$('#addOportunidadesModal').on('show.bs.modal', function (event) {
	$('#OportunidadesName2').val('')
	setTimeout(function (){
		$('#OportunidadesName2').focus()
	}, 1000)
})

$( "#add_oportunidades" ).submit(function( event ) {
	var parametros = $(this).serialize();
		$.ajax({
			type: "POST",
			url: "../ajax/oportunidades/guardar_oportunidades.php",
			data: parametros,
			 beforeSend: function(objeto){
				$("#resultados").html("Enviando...");
			},
			success: function(datos){
				$('#addOportunidadesModal').modal('hide');
				let m= datos.trim()
				let msj = m.substr(0,1);
				let type
				let txt
				if(msj == 'O'){
					type = 'success';
					txt = 'Oportunidad ha sido guardada con éxito.';
				}
				else if(msj == 'E'){
					type= 'warning';
					txt = 'En Oportunidad Ya existe un Registro grabado con el mismo Nombre.';
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