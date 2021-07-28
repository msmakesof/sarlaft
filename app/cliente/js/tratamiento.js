let CKTra = global.key;
let itemtratamiento = 0
$("#addtra").on('click', function(){
	let slct = '';
	$.get("../api/tratamientos/lista_eve.php", {ck: CKTra  }, function(result){
		let opc = "<option value=''>Seleccione opción</option>";
		$.each(result.body, function(i, item) {
			opc +="<option value='"+ item.id +"'>"+ item.TratamientosName +"</option>";
		});
		var delet='<div class="delete" style="width:10%; float:right; text-align:center"><i class="fas fa-trash" style="color:red; cursor:pointer"></i></div>';
		slct = '<div style="width:100%; float:left"><select class="form-control trata" id="trata" name="trata">';					
		slct += opc;
		slct += '</select></div>';
		itemtratamiento = itemtratamiento + 1;
		var nro =itemtratamiento;
		
		var tabla="";
		tabla+='<tr id="TRA'+itemtratamiento+'">';		
		tabla+='<td style="width:100%">'+ slct + '<br>'; 
		
		var tablainterna=''; 
		tablainterna+= '<tbody id="tbody">';		
			tablainterna+= '<tr id="TRA'+itemtratamiento+'">';
				tablainterna+= '<td colspan="3">';
					
					tablainterna+= '<table id="tratainterna" style="width:100%">';
						tablainterna+= '<tr>';
							tablainterna+= '<td  style="width:100%">';
								tablainterna+= slct + '<br>';
								
								tablainterna+= '<div style="clear:both; width:100%"> </div>';
								tablainterna+= '<div style="float:left; width:13%; text-align:center">Estatus</div>';
								tablainterna+= '<div style="float:left; width:13%; text-align:center">Prioridad</div>';
								tablainterna+= '<div style="float:left; width:17%; text-align:center">Fecha Inicial</div>';
								tablainterna+= '<div style="float:left; width:17%; text-align:center">Fecha Final</div>';
								tablainterna+= '<div style="float:left; width:17%; text-align:center">Fecha Seguimiento</div>';
								tablainterna+= '<div style="float:left; width:23%; text-align:center">Plan Acción</div>';
								tablainterna+= '<div style="clear:both; width:100%"> </div>';
								
								tablainterna+= '<div style="float:left; width:13%; text-align:center"><select class="tratastatus" id="tratastatus'+nro+'" name="tratastatus"><option value="">Seleccione</option><option value="1">Registrado</option><option value="2">Diferido</option><option value="3">Corregido</option></select></div>';
								tablainterna+= '<div style="float:left; width:13%; text-align:center"><select class="tratapriori" id="tratapriori'+nro+'" name="tratapriori"><option value="">Seleccione</option><option value="1">Alto</option><option value="2">Medio</option><option value="3">Bajo</option></select></div>';
								tablainterna+= '<div style="float:left; width:17%; text-align:center"><input type="date" class="input-sm tratafinicio" id="tratafinicio'+nro+'" size="10" maxlength="10" style="width: 144px; fontSize:12px"/></div>';
								tablainterna+= '<div style="float:left; width:17%; text-align:center"><input type="date" class="input-sm trataffinal" id="trataffinal'+nro+'" size="10" maxlength="10" style="width:144px; fontSize:12px"/></div>';
								tablainterna+= '<div style="float:left; width:17%; text-align:center"><input type="date" class="input-sm tratafseg" id="tratafseg'+nro+'" size="10" maxlength="10" style="width:144px; fontSize:12px"/></div>';
								tablainterna+= '<div style="float:left; width:23%; text-align:center">Plan Acción</div>';
													
							tablainterna+= '</td>';
						tablainterna+= '</tr>';
					tablainterna+= '</table>';
					tablainterna+= delet ;					
					
				tablainterna+= '</td>';			
			tablainterna+= '</tr>';
		tablainterna+= '</tbody>';

		$("#tabtra").append(tablainterna);
		
		$('.delete').off().click(function(e) {
			$(this).parent('td').parent('tr').remove();			
		});
	})
})

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