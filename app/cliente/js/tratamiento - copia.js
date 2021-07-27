let CKTra = global.key;
let itemtratamiento = 0
$("#addtra").on('click', function(){
	let slct = '';
	$.get("../api/tratamientos/lista_eve.php", {ck: CKTra  }, function(result){
		let opc = "<option value=''>Seleccione opción</option>";
		$.each(result.body, function(i, item) {
			opc +="<option value='"+ item.id +"'>"+ item.TratamientosName +"</option>";
		});
		slct = '<select class="form-control trata" id="trata" name="trata">';					
		slct += opc;
		slct += '</select>';
		itemtratamiento = itemtratamiento + 1;
		$("#tabtra").append('<tbody>');
		$("#tabtra").append('<tr id="TRA'+itemtratamiento+'">');
		$("#tabtra").append('<td style="width:10%"></td>');
		$("#tabtra").append('<td style="width:80%">'+ slct +'<br/>');		
		
		/*
		$("#tabtra").append('<table id="tratamtab">');
			$("#tabtra").append('<tr>');
				$("#tabtra").append('<td style="width:10%">Estatus</td>');
				$("#tabtra").append('<td style="width:10%">Prioridad</td>');
				$("#tabtra").append('<td style="width:15%">F.Inicial</td>');
				$("#tabtra").append('<td style="width:15%">F. Final</td>');
				$("#tabtra").append('<td style="width:15%">F. Sg/to</td>');
				$("#tabtra").append('<td style="width:35%">Plan Acción</td>');
			$("#tabtra").append('</tr>');
			$("#tabtra").append('<tr>');
				$("#tabtra").append('<td style="width:10%"><select id="tratastatus"><option value="">Seleccione</option><option value="1">Registrado</option><option value="2">Diferido</option><option value="3">Corregido</option></select></td>');
				$("#tabtra").append('<td style="width:10%"><select id="tratapriori"><option value="">Seleccione</option><option value="1">Alto</option><option value="2">Medio</option><option value="3">Bajo</option></select></td>');
				$("#tabtra").append('<td style="width:15%"><input type="date" class="form-control input-sm tratafinicio" id="tratafinicio"></td>');
				$("#tabtra").append('<td style="width:15%"><input type="date" class="input-sm" id="trataffinal" size="10" maxlength="10" style="width: 140px; fontSize:12px"/></td>');
				$("#tabtra").append('<td style="width:15%"><input type="date" class="form-control input-sm" id="tratafseg"></td>');
				$("#tabtra").append('<td style="width:35%"></td>');
			$("#tabtra").append('</tr>');		
		$("#tabtra").append('</table>'); */
		
		
		$("#tabtra").append('</td>');
		$("#tabtra").append('<td style="width:10%"><div class="delete"><i class="fas fa-trash" style="color:red; cursor:pointer"></i></div></td>');		
		$("#tabtra").append('</tr>');
		$("#tabtra").append('</tbody>');
		$('.delete').off().click(function(e) {
			$(this).parent('td').parent('tr').remove();  /// Este es el original
			//$(this).parent('tr').remove();
		});
	})
})

//$('#tratafinicio').mask("99/99/9999", {placeholder: 'dd/mm/yyyy' })
//$("#date1").mask("99/99/9999", {placeholder: 'dd/mm/yyyy'});

$('#addTratamientoModal').on('show.bs.modal', function (event) {
	$('#TratamientosName2').val('')
	setTimeout(function (){
		$('#TratamientosName2').focus()
	}, 1000)
})

$( "#add_tratamiento" ).submit(function( event ) {
	var parametros = $(this).serialize();
		$.ajax({
			type: "POST",
			url: "../ajax/tratamientos/guardar_tratamiento.php",
			data: parametros,
			 beforeSend: function(objeto){
				$("#resultados").html("Enviando...");
			},
			success: function(datos){
				$('#addTratamientoModal').modal('hide');
				let m= datos.trim()
				let msj = m.substr(0,1);
				let type
				let txt
				if(msj == 'O'){
					type = 'success';
					txt = 'Tratamiento ha sido guardado con éxito.';
				}
				else if(msj == 'E'){
					type= 'warning';
					txt = 'En Tratamiento Ya existe un Registro grabado con el mismo Nombre.';
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