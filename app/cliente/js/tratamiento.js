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
		slct += '</select></div>'; ////+ delet ;
		itemtratamiento = itemtratamiento + 1;
		
		var tabla="";
		tabla+='<tr id="TRA'+itemtratamiento+'">';
		//tabla+='<td style="width:10%"></td>';
		tabla+='<td style="width:100%">'+ slct + '<br>';   // + '</td>';
		//tabla+='<td style="width:10%"></td>';
		//tabla+='</tr>';
		
		var tablainterna=''; //<table id="tratainterna">';
		//tablainterna+= '<thead>';		
		
		//tablainterna+= '</thead>';
		tablainterna+= '<tbody id="tbody">';
		//tablainterna+= tabla;
			tablainterna+= '<tr id="TRA'+itemtratamiento+'">';
				tablainterna+= '<td colspan="3">';
					
					tablainterna+= '<table id="tratainterna" style="width:100%">';
						tablainterna+= '<tr>';
							tablainterna+= '<td  style="width:100%">';
								tablainterna+= slct + '<br>';
								
								tablainterna+= '<div style="clear:both; width:100%"> </div>';
								tablainterna+= '<div style="float:left; width:13%">Estatus</div>';
								tablainterna+= '<div style="float:left; width:13%">Prioridad</div>';
								tablainterna+= '<div style="float:left; width:17%">Fecha Inicial</div>';
								tablainterna+= '<div style="float:left; width:17%">Fecha Final</div>';
								tablainterna+= '<div style="float:left; width:17%">Fecha Seguimiento</div>';
								tablainterna+= '<div style="float:left; width:23%">Plan Acción</div>';
								tablainterna+= '<div style="clear:both; width:100%"> </div>';
								
								tablainterna+= '<div style="float:left; width:13%"><select class="tratastatus" id="tratastatus" name="tratastatus"><option value="">Seleccione</option><option value="1">Registrado</option><option value="2">Diferido</option><option value="3">Corregido</option></select></div>';
								tablainterna+= '<div style="float:left; width:13%"><select class="tratapriori" id="tratapriori" name="tratapriori"><option value="">Seleccione</option><option value="1">Alto</option><option value="2">Medio</option><option value="3">Bajo</option></select></div>';
								tablainterna+= '<div style="float:left; width:17%"><input type="date" class="input-sm tratafinicio" id="tratafinicio" size="10" maxlength="10" style="width: 144px; fontSize:12px"/></div>';
								tablainterna+= '<div style="float:left; width:17%"><input type="date" class="input-sm trataffinal" id="trataffinal" size="10" maxlength="10" style="width:144px; fontSize:12px"/></div>';
								tablainterna+= '<div style="float:left; width:17%"><input type="date" class="input-sm tratafseg" id="tratafseg" size="10" maxlength="10" style="width:144px; fontSize:12px"/></div>';
								tablainterna+= '<div style="float:left; width:23%">Plan Acción</div>';

								
								
									/*tablainterna+= '<table>';
									tablainterna+= '<tr style="text-align:center">';
									tablainterna+= '<td style="width:10%">Estatus</td>';
									tablainterna+= '<td style="width:10%">Prioridad</td>';
									tablainterna+= '<td style="width:15%">Fecha Inicial</td>';
									tablainterna+= '<td style="width:15%">Fecha Final</td>';
									tablainterna+= '<td style="width:15%">Fecha Seguimiento</td>';
									tablainterna+= '<td style="width:35%">Plan Acción</td>';
									tablainterna+= '</tr>';		
									tablainterna+= '<tr>';
									tablainterna+= '<td style="width:10%"><select class="tratastatus" id="tratastatus" name="tratastatus"><option value="">Seleccione</option><option value="1">Registrado</option><option value="2">Diferido</option><option value="3">Corregido</option></select></td>';
									tablainterna+= '<td style="width:10%"><select class="tratapriori" id="tratapriori" name="tratapriori"><option value="">Seleccione</option><option value="1">Alto</option><option value="2">Medio</option><option value="3">Bajo</option></select></td>';
									tablainterna+= '<td style="width:15%"><input type="date" class="input-sm tratafinicio" id="tratafinicio" size="10" maxlength="10" style="width: 144px; fontSize:12px"/></td>';
									tablainterna+= '<td style="width:15%"><input type="date" class="input-sm trataffinal" id="trataffinal" size="10" maxlength="10" style="width:144px; fontSize:12px"/></td>';
									tablainterna+= '<td style="width:15%"><input type="date" class="input-sm tratafseg" id="tratafseg" size="10" maxlength="10" style="width:144px; fontSize:12px"/></td>';
									tablainterna+= '<td style="width:35%"></td>';
									tablainterna+= '</tr>';
									tablainterna+= '</table>';*/
									
						
							tablainterna+= '</td>';
						tablainterna+= '</tr>';
					tablainterna+= '</table>';
					tablainterna+= delet ;
					
					
				tablainterna+= '</td>';			
			tablainterna+= '</tr>';
		tablainterna+= '</tbody>';
		//tablainterna+='</table>';
		
		//$("#tabtra").append('<tr id="TRA'+itemtratamiento+'"><td style="width:10%"></td><td style="width:80%">'+ slct +'</td><td style="width:10%"><div class="delete"><i class="fas fa-trash" style="color:red; cursor:pointer"></i></div></td></tr>');
		
		//var delet='<div class="delete"><i class="fas fa-trash" style="color:red; cursor:pointer"></i></div>'; tratainterna
		
		/* Original
		var tabla="";
		tabla+='<tr id="TRA'+itemtratamiento+'">';
		//tabla+='<td style="width:10%"></td>';
		tabla+='<td colspan="3" style="width:100%">'+ slct + '<br>' + tablainterna + '</td>';
		//tabla+='<td style="width:10%"></td>';
		tabla+='</tr>';
		$("#tabtra").append(tabla);  + slct + '<br>' + tablainterna + */
		
		/*var tabla="";
		tabla+='<tr id="TRA'+itemtratamiento+'">';
		tabla+='<td colspan="3" style="width:100%">';
		tabla+='<table id="tratainterna">';
		tabla+='<tbody><tr>';
		tabla+='<td>'+ slct + '<br>' + tablainterna +'</td>';
		tabla+='</tr></tbody>';
		tabla+='</table>';
		tabla+='</td>';
		tabla+='</tr>';*/
		$("#tabtra").append(tablainterna);
		
		$('.delete').off().click(function(e) {
			$(this).parent('td').parent('tr').remove();			
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