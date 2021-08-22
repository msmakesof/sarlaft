var CKTra = global.key;
var itemtratamiento = 0
let selPlan = "";
$("#addtra").on('click', function(){
	itemtratamiento = itemtratamiento + 1;
	var nro = itemtratamiento;
	var er =  $("#hder").val();
	// Crear registro inicial para tratamientos
	var prmts = "ck="+CKTra+"&er="+er+"&nc="+nro;
	$.ajax({
		async: false,
		type: "POST",
		url: "../api/tratamientos/insert.php",
		data: prmts,
		success: function(datos){
			//*alert('datos.....'+datos);
			RegistroActual = datos;
			//*alert('reg Actual......'+RegistroActual);
		}
	})
	nro = RegistroActual;
	
	let slct = '';
	$.get("../api/tratamientos/lista_eve.php", {ck: CKTra  }, function(result){
		let opc = "<option value=''>Seleccione opción</option>";
		$.each(result.body, function(i, item) {
			opc +="<option value='"+ item.id +"'>"+ item.TratamientosName +"</option>";
		});
		var delet='<div class="delete" style="width:10%; float:right; text-align:center"><i class="fas fa-trash" style="color:red; cursor:pointer"></i></div>';
		slct = '<div style="width:100%; float:left"><select class="form-control trata" id="tratamiento'+nro+'" name="tratamiento'+nro+'" onChange="fnTrata(tratamiento'+nro+',this.options[this.selectedIndex].value)">';					
		slct += opc;
		slct += '</select></div>';		
		
	// Select Plan
	$.get("../api/planes/lista_eve.php", {ck: CKTra }, function(planes){
		var opcplan = "<option value=''>Seleccione</option>";
		$.each(planes.body, function(i, item) {
			opcplan +="<option value='"+ item.id +"'>"+ item.PlanesName +"</option>";
		});
		selPlan += opcplan;
	
		
		var tabla="";
		tabla+='<tr id="TRA'+nro+'">';		
		tabla+='<td style="width:100%">'+ slct + '<br>'; 
		
		var tablainterna=''; 
		/////tablainterna+= '<tbody id="tbody">';		
			tablainterna+= '<tr id="TRA-'+nro+'">';
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
								
								tablainterna+= '<div style="float:left; width:13%; text-align:center">';
								tablainterna+= '<select class="tratastatus" id="tratastatus'+nro+'" name="tratastatus'+nro+'" onChange="fnTrata(tratastatus'+nro+',this.options[this.selectedIndex].value)"><option value="">Seleccione</option><option value="1">Registrado</option><option value="2">Diferido</option><option value="3">Corregido</option></select>';
								tablainterna+= '</div>';
								tablainterna+= '<div style="float:left; width:13%; text-align:center">';
								tablainterna+= '<select class="tratapriori" id="tratapriori'+nro+'" name="tratapriori'+nro+'" onChange="fnTrata(tratapriori'+nro+',this.options[this.selectedIndex].value)"><option value="">Seleccione</option><option value="1">Alto</option><option value="2">Medio</option><option value="3">Bajo</option></select>';
								tablainterna+= '</div>';
								tablainterna+= '<div style="float:left; width:17%; text-align:center">';
								tablainterna+= '<input type="date" class="input-sm tratafecini" id="tratafecini'+nro+'" name="tratafecini'+nro+'" onblur="fnTrata(tratafecini'+nro+',this.value)" size="10" maxlength="10" style="width: 144px; fontSize:12px"/>';
								tablainterna+= '</div>';
								tablainterna+= '<div style="float:left; width:17%; text-align:center">';
								tablainterna+= '<input type="date" class="input-sm tratafecfin" id="tratafecfin'+nro+'" name="tratafecfin'+nro+'" onblur="fnTrata(tratafecfin'+nro+',this.value)" size="10" maxlength="10" style="width:144px; fontSize:12px"/>';
								tablainterna+= '</div>';
								tablainterna+= '<div style="float:left; width:17%; text-align:center">';
								tablainterna+= '<input type="date" class="input-sm tratafecseg" id="tratafecseg'+nro+'" name id="tratafecseg'+nro+'" onblur="fnTrata(tratafecseg'+nro+',this.value)" size="10" maxlength="10" style="width:144px; fontSize:12px"/>';
								tablainterna+= '</div>';
								tablainterna+= '<div style="float:left; width:23%; text-align:center">';
								tablainterna+= '<select class="trataplan" id="trataplanes'+nro+'" name="trataplanes'+nro+'" onChange="fnTrata(trataplanes'+nro+',this.options[this.selectedIndex].value)" style="width:180px">'+selPlan;
								tablainterna+= '</select></div>';
													
							tablainterna+= '</td>';
						tablainterna+= '</tr>';
					tablainterna+= '</table>';
					tablainterna+= delet ;					
					
				tablainterna+= '</td>';			
			tablainterna+= '</tr>';
		/////tablainterna+= '</tbody>';

		$("#tabtrabody").append(tablainterna);
		
		$('.delete').off().click(function(e) {
			let regdel = $(this).parent('td').parent('tr').attr('id');
			alert('reg del....'+regdel);
			let posicion = regdel.indexOf('-');
			if (posicion !== -1){
				var registroborrar = regdel.substr(posicion+1) ;
			}
			alert('registroborrar....'+registroborrar);
			$(this).parent('td').parent('tr').remove();
			$.ajax({
				async: true,
				type: "POST",
				url: "../api/tratamientos/delete.php",
				data:  {'ck': CKTra, 'id': registroborrar},
				success: function(datos){
					if( $.trim(datos) == "S" ){
						//$("#prob1").trigger('change');
					}
				}
			})
			
		});
		
	}) // Select Planes
		
		
	})  // Select Tratamiento
})

function fnTrata(ParId, ParReg){
	var itemcontrol = ParId.name;
	//alert('it trata0....'+itemcontrol);
	itemcontrol = itemcontrol.substr(11);
	//alert('it trata1....'+itemcontrol);
	
	let inftratam =  $("#tratamiento"+itemcontrol).children("option:selected").val();
	let infstatus =  $("#tratastatus"+itemcontrol).children("option:selected").val();
	let infpriori =  $("#tratapriori"+itemcontrol).children("option:selected").val();
	let inffecini =  $("#tratafecini"+itemcontrol).val();
	let inffecfin =  $("#tratafecfin"+itemcontrol).val();
	let inffecseg =  $("#tratafecseg"+itemcontrol).val();
	let infplanes =  $("#trataplanes"+itemcontrol).children("option:selected").val();
	//alert('fec Ini....'+inffecini);
	
	let posicion = ParReg.indexOf('-');
	if (posicion !== -1){
		itemcontrol = ParReg.substr(posicion+1) ;
	}
	let er = $("#hder").val();
	
	let paramet = "ck="+CKTra+"&trata="+inftratam+"&status="+infstatus+"&priori="+infpriori+"&fecini="+inffecini+"&fecfin="+inffecfin+"&fecseg="+inffecseg+"&planes="+infplanes+"&er="+er+"&nrocontrol="+itemcontrol;
	$.ajax({
		async: false,
		type: "POST",
		url: "../api/tratamientos/guardatratamiento.php",
		data: paramet,
		success: function(datos){

		}
	})
	
	//fntnControl(infstatus,infpriori,inffecini,inffecfin,inffecseg,infplanes,ParReg)
}

	function fntnControl(pinfstatus,pinfpriori,pinffecini,pinffecfin,pinffecseg,pinfplanes,pParReg){
		let valinfstatus = pinfstatus;
		if ( isNaN(valinfstatus) ){valinfstatus = 0;}

		let valinfpriori = pinfpriori;
		if ( isNaN(valinfpriori) ){valinfpriori = 0;}

		let valinffecini = pinffecini;
		if ( isNaN(valinffecini) ){valinffecini = 0;}

		let valinffecfin = pinffecfin;
		alert('fec Ini recibe....'+valinffecfin);
		if ( isNaN(valinffecfin) ){valinffecfin = 0;}
		
		let valinffecseg = pinffecseg;
		if ( isNaN(valinffecseg) ){valinffecseg = 0;}
		
		let valinfplanes = pinfplanes;
		if ( isNaN(valinfplanes) ){valinfplanes = 0;}
		
		let posicion = pParReg.indexOf('-');
		if (posicion !== -1){
			itemcontrol = pParReg.substr(posicion+1) ;
		}

		let er = $("#hder").val();			

		let paramet = "ck="+CKTra+"&status="+valinfstatus+"&priori="+valinfpriori+"&fecini="+valinffecini+"&fecfin="+valinffecfin+"&fecseg="+valinffecseg+"&planes="+valinfplanes+"&er="+er+"&nrocontrol="+itemcontrol;
		$.ajax({
			async: false,
			type: "POST",
			url: "../api/tratamientos/guardatratamiento.php",
			data: paramet,
			success: function(datos){

			}
		})
	}

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