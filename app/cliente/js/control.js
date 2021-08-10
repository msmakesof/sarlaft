let CKCtr = global.key;
let itemcontrol = 0
let slctresp = '';
let selDocmun = '';
let selAplica = '';
let selEfec = '';
let selEval = '';
let opcesca = ''; 
let valpromedio = 0;
let valdocum = 0;
let valaplica = 0;
let valefec = 0;
let valeval = 0;
let selEfectividad;
let selFrecuencia;
let selCategoria = '';
var posicionesmover = 0; 
$("#addctr").on('click', function(){
	var er =  $("#hder").val();
	////alert("Evento Riesgo.."+er);
	let slct = '';	
	itemcontrol = itemcontrol + 1;
	var prmts = "ck="+CKCtr+"&er="+er+"&nc="+itemcontrol;
	$.ajax({
		async: true,
		type: "POST",
		url: "../api/matriz/updateMatrizControl.php",
		data: prmts,
		success: function(datos){
	
		}
	})
	
	$.get("../api/controles/lista_eve.php", {ck: CKCtr  }, function(result){
		let opc = "<option value=''>Seleccione opción</option>";
		$.each(result.body, function(i, item) {
			opc +="<option value='"+ item.id +"'>"+ item.ControlesName +"</option>";
		});
		//var delet='<div class="delete" style="width:10%; float:right; text-align:center"><i class="fas fa-trash" style="color:red; cursor:pointer"></i></div>';
		slct = '<div style="width:100%; float:left"><select class="form-control control" id="control" name="control">';					
		slct += opc;
		slct += '</select></div>';	

		// Select Efectividad		
		$.get("../api/efectividad/lista_eve.php", {ck: CKCtr }, function(efectividad){
			selEfectividad ="";
			let opcefectividad = "<option value=''>Seleccione</option>";
			$.each(efectividad.body, function(i, item) {
				opcefectividad +="<option value='"+ item.EFE_IdEfectividad +"'>"+ item.EFE_Nombre +"</option>";
			});
			selEfectividad += opcefectividad;
		})

		// Select Frecuencia
		$.get("../api/frecuencia/lista_eve.php", {ck: CKCtr }, function(frecuencia){
			selFrecuencia = "";
			let opcfrecuencia = "<option value=''>Seleccione</option>";
			$.each(frecuencia.body, function(i, item) {
				opcfrecuencia +="<option value='"+ item.FRE_IdFrecuencia +"'>"+ item.FRE_Nombre +"</option>";
			});
			selFrecuencia += opcfrecuencia;
		})

		// Select Categoria
		/*
		$.get("../api/categoria/lista_eve.php", {ck: CKCtr }, function(categoria){
			selCategoria = "";
			let opccategoria = "<option value=''>Seleccione</option>";
			$.each(categoria.body, function(i, item) {
				opccategoria +="<option value='"+ item.CAT_IdCategoria +"'>"+ item.CAT_Nombre +"</option>";
			});
			selCategoria += opccategoria;
		})*/
		//var params = "ck="+CKCtr;
			$.ajax({
				async: false,
				type: "POST",
				url: "../api/categoria/lista_eve.php?ck="+CKCtr,
				//data:  {'ck': CKCtr },
				success: function(datos){
					//alert(datos);
					selCategoria = "";
					let opccategoria = "<option value=''>Seleccione</option>";
					//if(datos != "nd"){
						//x = JSON.parse(datos);
						$.each(datos.body, function(i, item) {
							//posinifils = item.MOV_Fila;
							//posinicols = item.MOV_Columna;
							opccategoria +="<option value='"+ item.CAT_IdCategoria +"'>"+ item.CAT_Nombre +"</option>";
						});
					//}
					selCategoria += opccategoria;
				}
			})


		
		$.get("../api/escalacalificacion/lista_eve.php", {ck: CKCtr }, function(escala){			
			opcesca = "<option value=''>Seleccione</option>";
			$.each(escala.body, function(i, item) {
				opcesca +="<option value='"+ item.ESC_IdEscalaCalificacion +"'>"+ item.ESC_Valor +"</option>";
			})
			selDocmun ='';
			selDocmun += '<select class="seldocum" id="seldocum'+itemcontrol+'" name="seldocum'+itemcontrol+'" onChange="fxselDocum(seldocum'+itemcontrol+')">';
			selDocmun += opcesca;
			selDocmun += '</select>';
			
			selAplica = '';
			selAplica += '<select class="selaplica" id="selaplica'+itemcontrol+'" name="selaplica'+itemcontrol+'" onChange="fxselAplica(selaplica'+itemcontrol+')">';
			selAplica += opcesca;
			selAplica += '</select>';
			
			selEfec = '';
			selEfec += '<select class="selefec" id="selefec'+itemcontrol+'" name="selefec'+itemcontrol+'" onChange="fxselEfec(selefec'+itemcontrol+')">';
			selEfec += opcesca;
			selEfec += '</select>';
			
			selEval = '';
			selEval += '<select class="seleval" id="seleval'+itemcontrol+'" name="seleval'+itemcontrol+'" onChange="fxselEval(seleval'+itemcontrol+')">';
			selEval += opcesca;
			selEval += '</select>';
			
		//})		
	
			var delet='<div class="delete" style="width:10%; float:right; text-align:center"><i class="fas fa-trash" style="color:red; cursor:pointer"></i></div>';
		
			slctresp = '';
			$.get("../api/responsables/lista_eve.php", {ck: CKCtr }, function(resp){
				var opcresp = "<option value=''>Seleccione</option>";
				$.each(resp.body, function(i, item) {
					opcresp +="<option value='"+ item.ResponsablesId +"'>"+ item.ResponsablesName +"</option>";
				});
				//slctresp = '<select class="ctrpropietario" id="ctrpropietario" name="ctrpropietario">';
				slctresp += opcresp;
				//slctresp += '</select>';
				//alert(slctresp);
		    //})
			
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
										tablainterna+= '<select class="ctrpropietario" id="ctrpropietario'+ itemcontrol +'" name="ctrpropietario">'+ slctresp ;
										tablainterna+= '</select></div>';
										
										tablainterna+= '<div style="float:left; width:17%; text-align:center">';
										tablainterna+= '<select class="ctrejecutor" id="ctrejecutor'+ itemcontrol +'" name="ctrejecutor">'+ slctresp;
										tablainterna+= '</select></div>';
										tablainterna+= '<div style="float:left; width:17%; text-align:center">';
										tablainterna+= '<select class="ctrefectividad" id="ctrefectividad'+ itemcontrol +'" name="ctrefectividad">'+selEfectividad;
										tablainterna+= '</select></div>';
										tablainterna+= '<div style="float:left; width:17%; text-align:center">';
										tablainterna+= '<select class="ctrfrecuencia" id="ctrfrecuencia'+ itemcontrol +'" name="ctrfrecuencia">'+selFrecuencia;
										tablainterna+= '</select></div>';

										tablainterna+= '<div style="float:left; width:17%; text-align:center">';
										tablainterna+= '<select class="ctrcategoria" id="ctrcategoria'+ itemcontrol +'" name="ctrcategoria" onChange="fnCategoria(this,itemcontrol)">'+selCategoria;
										tablainterna+= '</select></div>';
										tablainterna+= '<div style="float:left; width:15%; text-align:center">';
										tablainterna+= '<select class="ctrrealizado" id="ctrrealizado'+ itemcontrol +'" name="ctrrealizado" onChange="fnRealizado(this,itemcontrol)"><option value="">Seleccione</option><option value="S">Si</option><option value="N">No</option>';
										tablainterna+= '</select></div>';
										
										tablainterna+= '<div style="clear:both; width:100%">&nbsp;</div>';
										tablainterna+= '<div style="clear:both; width:100%; text-align:center; background-color: #D3D3D3;"> Calificación del Control </div>';
										tablainterna+= '<div style="float:left; width:15%; text-align:center">Documentado</div>';
										tablainterna+= '<div style="float:left; width:15%; text-align:center">Aplicado</div>';
										tablainterna+= '<div style="float:left; width:15%; text-align:center">Efectivo</div>';
										tablainterna+= '<div style="float:left; width:15%; text-align:center">Evaluado</div>';
										tablainterna+= '<div style="float:left; width:17%; background-color: #D3D3D3; text-align:center">Promedio</div>';
										tablainterna+= '<div style="float:left; width:23%; background-color: #D3D3D3; text-align:center">Calificación</div>';
										tablainterna+= '<div style="clear:both; width:100%"> </div>';
										
										tablainterna+= '<div style="float:left; width:15%; text-align:center">';
										tablainterna+= selDocmun ;
										tablainterna+= '</div>';
										tablainterna+= '<div style="float:left; width:15%; text-align:center">';
										tablainterna+= selAplica ;
										tablainterna+= '</div>';
										tablainterna+= '<div style="float:left; width:15%; text-align:center">';
										tablainterna+= selEfec ;
										tablainterna+= '</div>';
										tablainterna+= '<div style="float:left; width:15%; text-align:center">';
										tablainterna+= selEval ;
										tablainterna+= '</div>';
										tablainterna+= '<div style="float:left; width:17%; text-align:center !important">';
										tablainterna+= '<input type="text" id="promedio'+itemcontrol+'" maxlength="10" style="background-color: #D3D3D3; text-align:center" readonly/>' ;
										tablainterna+= '</div>';
										tablainterna+= '<div style="float:left; width:23%; text-align:center">';
										tablainterna+= '<input type="text" id="calificacion'+itemcontrol+'" maxlength="10" style="width:100%; text-align:center;" readonly/>' ;
										tablainterna+= '</div>';
							
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
				
				// funciones para promedio y calificacion
			
			})   // select responsables
		
		})  //seldocum, selAplica ...
		
	})	// select Controles
	
})


var infodocumtxt = 0;
var infoaplicatxt = 0;
var infoefectxt = 0;
var infoevaltxt = 0;
var totsumatoria = 0;

//$("#seldocum"+itemcontrol).on('change', function(){
function fxselDocum(ParId){
	var itemcontrol = ParId.name;
	itemcontrol = itemcontrol.charAt(itemcontrol.length-1)
	//alert(itemcontrol);
	var infodocum = $("#seldocum"+itemcontrol).children("option:selected").val();
	infodocumtxt = $("#seldocum"+itemcontrol).children("option:selected").text();
	
	var infoaplica = $("#selaplica"+itemcontrol).children("option:selected").val();
	infoaplicatxt = $("#selaplica"+itemcontrol).children("option:selected").text();
	
	var infoefec = $("#selefec"+itemcontrol).children("option:selected").val();
	infoefectxt = $("#selefec"+itemcontrol).children("option:selected").text();
	
	var infoeval = $("#seleval"+itemcontrol).children("option:selected").val();
	infoevaltxt = $("#seleval"+itemcontrol).children("option:selected").text();
	
	infodocumtxt = parseInt(infodocumtxt);
	infoaplicatxt =parseInt(infoaplicatxt);
	infoefectxt = parseInt(infoefectxt);
	infoevaltxt = parseInt(infoevaltxt);
	//alert(infodocum+'  '+infoaplica);
	var contar = 0;
	var sumatoria = 0;
	var totpromedio = 0;
	if(infodocumtxt > 0){ contar++;  sumatoria += infodocumtxt; }
	if(infoaplicatxt > 0){ contar++; sumatoria += infoaplicatxt;}
	if(infoefectxt > 0){ contar++;   sumatoria += infoefectxt;}
	if(infoevaltxt > 0){ contar++;   sumatoria += infoevaltxt;}
	//alert('doc...'+infodocumtxt+'  apli..'+infoaplicatxt+'   efe...'+infoefectxt+'   eva...'+infoevaltxt);
	//alert("sum..."+sumatoria+"  / contar..."+contar);
	totpromedio = sumatoria/contar ;
	totpromedio = Math.round(totpromedio);
	$("#promedio"+itemcontrol).val( totpromedio )
	var totsumatoria = sumatoria;
	fxSumar(totsumatoria, itemcontrol)
	fnRegla_3_4(infodocumtxt,infoaplicatxt,infoefectxt,infoevaltxt)
}

//$("#selaplica"+itemcontrol).on('change', function(){
function fxselAplica(ParId){
	var itemcontrol = ParId.name;
	itemcontrol = itemcontrol.charAt(itemcontrol.length-1)
	var infoaplica = $("#selaplica"+itemcontrol).children("option:selected").val();
	infoaplicatxt = $("#selaplica"+itemcontrol).children("option:selected").text();
	
	var infodocum = $("#seldocum"+itemcontrol).children("option:selected").val();
	infodocumtxt = $("#seldocum"+itemcontrol).children("option:selected").text();
	
	var infoefec = $("#selefec"+itemcontrol).children("option:selected").val();
	infoefectxt = $("#selefec"+itemcontrol).children("option:selected").text();
	
	var infoeval = $("#seleval"+itemcontrol).children("option:selected").val();
	infoevaltxt = $("#seleval"+itemcontrol).children("option:selected").text();
	
	infodocumtxt = parseInt(infodocumtxt); 
	infoaplicatxt =parseInt(infoaplicatxt);
	infoefectxt = parseInt(infoefectxt);  
	infoevaltxt = parseInt(infoevaltxt);  
	//alert(infodocum+'  '+infoaplica);
	var contar = 0;
	var sumatoria = 0;
	var totpromedio = 0;
	if(infodocumtxt > 0){ contar++;  sumatoria += infodocumtxt;  }
	if(infoaplicatxt > 0){ contar++; sumatoria += infoaplicatxt; }
	if(infoefectxt > 0){ contar++;   sumatoria += infoefectxt;   }
	if(infoevaltxt > 0){ contar++;   sumatoria += infoevaltxt;   }
	//alert('doc...'+infodocumtxt+'  apli..'+infoaplicatxt+'   efe...'+infoefectxt+'   eva...'+infoevaltxt);
	//alert("sum..."+sumatoria+"  / contar..."+contar);
	var totsumatoria = sumatoria;
	totpromedio = sumatoria/contar ;
	totpromedio = Math.round(totpromedio);
	$("#promedio"+itemcontrol).val( totpromedio )
	fxSumar(totsumatoria, itemcontrol)
	//var SumaAplicadoEfectivo = infoaplicatxt + infoefectxt;
	//fnAplicadoEfectivo(SumaAplicadoEfectivo)
	fnRegla_3_4(infodocumtxt,infoaplicatxt,infoefectxt,infoevaltxt)
}

//$("#selefec"+itemcontrol).on('change', function(){
function fxselEfec(ParId){
	var itemcontrol = ParId.name;
	itemcontrol = itemcontrol.charAt(itemcontrol.length-1)
	var infoefec = $("#selefec"+itemcontrol).children("option:selected").val();
	infoefectxt = $("#selefec"+itemcontrol).children("option:selected").text();
	
	var infodocum = $("#seldocum"+itemcontrol).children("option:selected").val();
	infodocumtxt = $("#seldocum"+itemcontrol).children("option:selected").text();
	
	var infoaplica = $("#selaplica"+itemcontrol).children("option:selected").val();
	infoaplicatxt = $("#selaplica"+itemcontrol).children("option:selected").text();
	
	var infoeval = $("#seleval"+itemcontrol).children("option:selected").val();
	infoevaltxt = $("#seleval"+itemcontrol).children("option:selected").text();
	
	infodocumtxt = parseInt(infodocumtxt); 
	infoaplicatxt =parseInt(infoaplicatxt);
	infoefectxt = parseInt(infoefectxt);  
	infoevaltxt = parseInt(infoevaltxt);  
	//alert(infodocum+'  '+infoaplica);
	var contar = 0;
	var sumatoria = 0;
	var totpromedio = 0;
	if(infodocumtxt > 0){ contar++;  sumatoria += infodocumtxt;  }
	if(infoaplicatxt > 0){ contar++; sumatoria += infoaplicatxt; }
	if(infoefectxt > 0){ contar++;   sumatoria += infoefectxt;   }
	if(infoevaltxt > 0){ contar++;   sumatoria += infoevaltxt;   }
	//alert('doc...'+infodocumtxt+'  apli..'+infoaplicatxt+'   efe...'+infoefectxt+'   eva...'+infoevaltxt);
	//alert("sum..."+sumatoria+"  / contar..."+contar);
	var totsumatoria = sumatoria;
	totpromedio = sumatoria/contar ;
	totpromedio = Math.round(totpromedio);
	$("#promedio"+itemcontrol).val( totpromedio )
	fxSumar(totsumatoria, itemcontrol)
	//var SumaAplicadoEfectivo = infoaplicatxt + infoefectxt;
	//fnAplicadoEfectivo(SumaAplicadoEfectivo)
	fnRegla_3_4(infodocumtxt,infoaplicatxt,infoefectxt,infoevaltxt)
}

//$("#seleval"+itemcontrol).on('change', function(){
function fxselEval(ParId){
	var itemcontrol = ParId.name;
	itemcontrol = itemcontrol.charAt(itemcontrol.length-1)
	var infoeval = $("#seleval"+itemcontrol).children("option:selected").val();
	infoevaltxt = $("#seleval"+itemcontrol).children("option:selected").text();
	
	var infodocum = $("#seldocum"+itemcontrol).children("option:selected").val();
	infodocumtxt = $("#seldocum"+itemcontrol).children("option:selected").text();
	
	var infoaplica = $("#selaplica"+itemcontrol).children("option:selected").val();
	infoaplicatxt = $("#selaplica"+itemcontrol).children("option:selected").text();
	
	var infoefec = $("#selefec"+itemcontrol).children("option:selected").val();
	infoefectxt = $("#selefec"+itemcontrol).children("option:selected").text();
	
	infodocumtxt = parseInt(infodocumtxt); 
	infoaplicatxt =parseInt(infoaplicatxt);
	infoefectxt = parseInt(infoefectxt);  
	infoevaltxt = parseInt(infoevaltxt);  
	//alert(infodocum+'  '+infoaplica);
	var contar = 0;
	var sumatoria = 0;
	var totpromedio = 0;
	if(infodocumtxt > 0){ contar++;  sumatoria += infodocumtxt;  }
	if(infoaplicatxt > 0){ contar++; sumatoria += infoaplicatxt; }
	if(infoefectxt > 0){ contar++;   sumatoria += infoefectxt;   }
	if(infoevaltxt > 0){ contar++;   sumatoria += infoevaltxt;   }
	//alert('doc...'+infodocumtxt+'  apli..'+infoaplicatxt+'   efe...'+infoefectxt+'   eva...'+infoevaltxt);
	//alert("sum..."+sumatoria+"  / contar..."+contar);
	var totsumatoria = sumatoria;
	totpromedio = sumatoria/contar ;
	totpromedio = Math.round(totpromedio);
	$("#promedio"+itemcontrol).val( totpromedio )
	fxSumar(totsumatoria, itemcontrol)
	fnRegla_3_4(infodocumtxt,infoaplicatxt,infoefectxt,infoevaltxt)
}

function fxSumar(parSumar, parIdControl){
//	alert(parSumar);
let id = "";
let nombre = "";
let color = "";
$.get("../api/calificacion/lista_select.php", {ck: CKCtr, vr: parSumar }, function(data){
	id = data.body[0]["CAL_IdCalificacion"];
	nombre = data.body[0]["CAL_Nombre"];
	color = data.body[0]["CAL_Color"];
	$("#calificacion"+parIdControl).css("background-color", color);
	$("#calificacion"+parIdControl).attr("value", nombre);
	console.log(color);
})


}
/**/

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