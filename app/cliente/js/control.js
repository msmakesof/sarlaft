let CKCtr = global.key;
let itemcontrol = 0
$("#addctr").on('click', function(){
	let slct = '';
	$.get("../api/controles/lista_eve.php", {ck: CKCtr  }, function(result){
		let opc = "<option value=''>Seleccione opción</option>";
		$.each(result.body, function(i, item) {
			opc +="<option value='"+ item.id +"'>"+ item.ControlesName +"</option>";
		});
		//var delet='<div class="delete" style="width:10%; float:right; text-align:center"><i class="fas fa-trash" style="color:red; cursor:pointer"></i></div>';
		slct = '<div style="width:100%; float:left"><select class="form-control control" id="control" name="control">';					
		slct += opc;
		slct += '</select></div>';
	
	
		var delet='<div class="delete" style="width:10%; float:right; text-align:center"><i class="fas fa-trash" style="color:red; cursor:pointer"></i></div>';
		itemcontrol = itemcontrol + 1;
			var slctresp = '';
			$.get("../api/responsables/lista_eve.php", {ck: CKCtr }, function(resp){			
				var opcresp = "<option value=''>Seleccione opción</option>";
				$.each(resp.body, function(i, item) {
					opcresp +="<option value='"+ item.ResponsablesId +"'>"+ item.ResponsablesName +"</option>";
				});
				//slctresp = '<select class="ctrpropietario" id="ctrpropietario" name="ctrpropietario">';
				slctresp += opcresp;
				//slctresp += '</select>';
				//alert(slctresp);
			
				var tablainterna='';
				tablainterna+= '<tbody id="tbody">';
					tablainterna+= '<tr id="CTR'+itemcontrol+'">';
						tablainterna+= '<td colspan="3">';
							
							tablainterna+= '<table id="controlinterna" style="width:100%">';
								tablainterna+= '<tr>';
									tablainterna+= '<td  style="width:100%">';
										tablainterna+= slct + '<br>';
										
										tablainterna+= '<div style="clear:both; width:100%; text-align:center"> </div>';
										tablainterna+= '<div style="float:left; width:17%; text-align:center">Propietario</div>';
										tablainterna+= '<div style="float:left; width:17%; text-align:center">Ejecutor</div>';
										tablainterna+= '<div style="float:left; width:17%; text-align:center">Efectividad</div>';
										tablainterna+= '<div style="float:left; width:17%; text-align:center">Frecuencia</div>';
										tablainterna+= '<div style="float:left; width:17%; text-align:center">Categoría</div>';
										tablainterna+= '<div style="float:left; width:15%; text-align:center">Realizado</div>';
										tablainterna+= '<div style="clear:both; width:100%"> </div>';
										
										tablainterna+= '<div style="float:left; width:17%; text-align:center">';
										tablainterna+= '<select class="ctrpropietario" id="ctrpropietario" name="ctrpropietario">'+ slctresp ;
										tablainterna+= '</select></div>';
										
										tablainterna+= '<div style="float:left; width:17%; text-align:center">';
										tablainterna+= '<select class="ctrejecutor" id="ctrejecutor" name="ctrejecutor">'+ slctresp;
										tablainterna+= '</select></div>';
										tablainterna+= '<div style="float:left; width:17%; text-align:center"><select class="ctrefectividad" id="ctrefectividad" name="ctrefectividad"><option value="">Seleccione</option></select></div>';
										tablainterna+= '<div style="float:left; width:17%; text-align:center"><select class="ctrfrecuencia" id="ctrfrecuencia" name="ctrfrecuencia"><option value="">Seleccione</option></select></div>';
										tablainterna+= '<div style="float:left; width:17%; text-align:center"><select class="ctrcategoria" id="ctrcategoria" name="ctrcategoria"><option value="">Seleccione</option><option value="A">Ambas</option></select></div>';
										tablainterna+= '<div style="float:left; width:15%; text-align:center"><select class="ctrrealizado" id="ctrrealizado" name="ctrrealizado"><option value="">Seleccione</option><option value="S">Si</option><option value="N">No</option></select></div>';
										
										tablainterna+= '<div style="clear:both; width:100%">&nbsp;</div>';
										tablainterna+= '<div style="clear:both; width:100%; text-align:center; background-color: #D3D3D3;"> Calificación del Control </div>';
										tablainterna+= '<div style="float:left; width:13%; text-align:center">Documentado</div>';
										tablainterna+= '<div style="float:left; width:13%; text-align:center">Aplicado</div>';
										tablainterna+= '<div style="float:left; width:17%; text-align:center">Efectivo</div>';
										tablainterna+= '<div style="float:left; width:17%; text-align:center">Evaluado</div>';
										tablainterna+= '<div style="float:left; width:17%; background-color: #D3D3D3; text-align:center">Promedio</div>';
										tablainterna+= '<div style="float:left; width:23%; background-color: #D3D3D3; text-align:center">Calificación</div>';
										tablainterna+= '<div style="clear:both; width:100%"> </div>';
							
									tablainterna+= '</td>';
								tablainterna+= '</tr>';
							tablainterna+= '</table>';
							tablainterna+= delet ;
							
							
						tablainterna+= '</td>';			
					tablainterna+= '</tr>';
				tablainterna+= '</tbody>';

			$("#tabctr").append(tablainterna);
			
			$('.delete').off().click(function(e) {
				$(this).parent('td').parent('tr').remove();			
			});
		
		})
		
	})
})

$('#addControlModal').on('show.bs.modal', function (event) {
	$('#ControlesName2').val('')
	setTimeout(function (){
		$('#ControlesName2').focus()
	}, 1000)
})

$( "#add_control" ).submit(function( event ) {
	var parametros = $(this).serialize();
		$.ajax({
			type: "POST",
			url: "../ajax/controles/guardar_control.php",
			data: parametros,
			 beforeSend: function(objeto){
				$("#resultados").html("Enviando...");
			},
			success: function(datos){
				$('#addControlModal').modal('hide');
				let m= datos.trim()
				let msj = m.substr(0,1);
				let type
				let txt
				if(msj == 'O'){
					type = 'success';
					txt = 'Control ha sido guardado con éxito.';
				}
				else if(msj == 'E'){
					type= 'warning';
					txt = 'En Control Ya existe un Registro grabado con el mismo Nombre.';
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