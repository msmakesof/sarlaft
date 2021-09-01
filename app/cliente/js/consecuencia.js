let CKCon = global.key;
let itemconsecuencia = 9000
$("#addcon").on('click', function(){
	let slct = '';
	$.get("../api/consecuencias/lista_eve.php", {ck: CKCon  }, function(result){
		itemconsecuencia ++;		
		let opc = "<option value=''>Seleccione opción</option>";
		$.each(result.body, function(i, item) {
			opc +="<option value='"+ item.id +"'>"+ item.ConsecuenciasName +"</option>";
		});
		slct = '<select class="form-control consec" id="consec'+itemconsecuencia+'" name="consec'+itemconsecuencia+'" onChange="fxCO(this.options[this.selectedIndex].value, itemconsecuencia)" autofocus>';					
		slct += opc;
		slct += '</select>';		
		//$("#tabcon").append('<tbody>');
		$("#tabconbody").append('<tr id="CON'+itemconsecuencia+'"><td style="width:10%"></td><td style="width:80%">'+ slct +'</td><td style="width:10%"><div class="delete"><i class="fas fa-trash" style="color:red; cursor:pointer"></i></div></td></tr>');
		//$("#tabcon").append('</tbody>');
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
			url: "../ajax/consecuencias/guardar_consecuencias.php",
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
function deletecoUpd(num, eventoriesgo) {
	//alert('numtiporiesgo....'+numtiporiesgo+'     er...'+eventoriesgo );
	let nt = num
	let er = eventoriesgo
	$.ajax({
		async: true,
		type: "POST",
		url: "../api/consecuencias/deleteUpd.php",
		data:  { 'ck': CKTra, 'id': nt, 'er': er },
		success: function(datos){
			msj = $.trim(datos)
			let type
			let txt
			if(msj == 'S'){
				type = 'success';
				txt = 'Consecuencia ha sido borrado con éxito.';
			}
			else {
				type= 'warning';
				txt = 'No se pudo eliminar el Registro.  Intente nuevamente';
			}	
			swal({
				position: 'top-end',
				type: ''+type,
				title: ''+txt,
				showConfirmButton: true,
				timer: 2000
			});
			 $("#CON" + nt).remove();
		}
	})
}