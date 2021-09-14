let CKCtr = global.key;
var itemcontrol = 0
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
var RegistroActual = 0;
$("#addctr").on('click', function(){

	if( $("#prob1").val() == "" || $("#consec1").val() == "" ){
		swal({
			position: 'top-end',
			type: 'warning',
			title: 'Debe seleccionar Probabilidad Y/O Impacto o Consecuencia',
			showConfirmButton: true,
			timer: 4000
		});
		$("#prob1").focus();
	}
	else {
		var er =  $("#hder").val();
		txtCat="";
		moverbolita = "N";
		moverfils = 0;
		movercols = 0;
		posicionesmover = 0;
		valDoc = 0;
		valApl = 0;
		valEfe = 0;
		valEva = 0;
		let slct = '';	
		itemcontrol = itemcontrol + 1;
		////Crear el primer movimiento en la tabla MOV_MatrizControl y en ECTR_Controles
		var prmts = "ck="+CKCtr+"&er="+er+"&nc="+itemcontrol;
		$.ajax({
			async: false,
			type: "POST",
			url: "../api/matriz/updateMatrizControl.php",
			data: prmts,
			success: function(datos){
				RegistroActual = datos;
			}
		})

		itemcontrol = RegistroActual;
		
		$.get("../api/controles/lista_eve.php", {ck: CKCtr  }, function(result){
			let opc = "<option value=''>Seleccione opción</option>";
			$.each(result.body, function(i, item) {
				opc +="<option value='"+ item.id +"'>"+ item.ControlesName +"</option>";
			});
			slct = '<div style="width:100%; float:left">';
			slct += '<select class="form-control control" id="selcont'+itemcontrol+'" name="selcont'+itemcontrol+'" onChange="fxselCont(selcont'+itemcontrol+',this.options[this.selectedIndex].value)" style="color: black; font-weight: bold" autofocus>';					
			slct += opc;
			slct += '</select>';
			slct += '</div>';	

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
			/*$.get("../api/frecuencia/lista_eve.php", {ck: CKCtr }, function(frecuencia){
				selFrecuencia = "";
				let opcfrecuencia = "<option value=''>Seleccione</option>";
				$.each(frecuencia.body, function(i, item) {
					opcfrecuencia +="<option value='"+ item.FRE_IdFrecuencia +"'>"+ item.FRE_Nombre +"</option>";
				});
				selFrecuencia += opcfrecuencia;
			})*/
			
			$.ajax({
				async: false,
				type: "POST",
				url: "../api/frecuencia/lista_eve.php?ck="+CKCtr,
				//data:  {'ck': CKCtr },
				success: function(datos){
					//alert(datos);
					selFrecuencia = "";
					let opcfrecuencia = "<option value=''>Seleccione</option>";
					//if(datos != "nd"){
						//x = JSON.parse(datos);
						$.each(datos.body, function(i, item) {
							opcfrecuencia +="<option value='"+ item.FRE_IdFrecuencia +"'>"+ item.FRE_Nombre +"</option>";  // +'-'+ itemcontrol 
						});
					//}
					selFrecuencia += opcfrecuencia;
				}
			})

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
							opccategoria +="<option value='"+ item.CAT_IdCategoria +'-'+ itemcontrol +"'>"+ item.CAT_Nombre +"</option>";
						});
					//}
					selCategoria += opccategoria;
				}
			})
			
			$.get("../api/escalacalificacion/lista_eve.php", {ck: CKCtr }, function(escala){			
				opcesca = "<option value=''>Seleccione</option>";
				$.each(escala.body, function(i, item) { //+"-"+ itemcontrol 
					opcesca +="<option value='"+ item.ESC_IdEscalaCalificacion +'-'+ itemcontrol +"'>"+ item.ESC_Valor +"</option>";
				})
				selDocmun ='';
				selDocmun += '<select class="seldocum" id="seldocum'+itemcontrol+'" name="seldocum'+itemcontrol+'" onChange="fxselDocum(seldocum'+itemcontrol+',this.options[this.selectedIndex].value)">';
				selDocmun += opcesca;
				selDocmun += '</select>';
				
				selAplica = '';
				selAplica += '<select class="selaplica" id="selaplica'+itemcontrol+'" name="selaplica'+itemcontrol+'" onChange="fxselAplica(selaplica'+itemcontrol+',this.options[this.selectedIndex].value)">';
				selAplica += opcesca;
				selAplica += '</select>';
				
				selEfec = '';
				selEfec += '<select class="selefec" id="selefec'+itemcontrol+'" name="selefec'+itemcontrol+'" onChange="fxselEfec(selefec'+itemcontrol+',this.options[this.selectedIndex].value)">';
				selEfec += opcesca;
				selEfec += '</select>';
				
				selEval = '';
				selEval += '<select class="seleval" id="seleval'+itemcontrol+'" name="seleval'+itemcontrol+'" onChange="fxselEval(seleval'+itemcontrol+',this.options[this.selectedIndex].value)">';
				selEval += opcesca;
				selEval += '</select>';
		
				var delet='<div class="delete" style="width:10%; float:right; text-align:center"><i class="fas fa-trash" style="color:red; cursor:pointer"></i></div>';
			
				slctresp = '';
				$.get("../api/responsables/lista_eve.php", {ck: CKCtr }, function(resp){
					var opcresp = "<option value=''>Seleccione</option>";
					$.each(resp.body, function(i, item) {
						opcresp +="<option value='"+ item.ResponsablesId +"'>"+ item.ResponsablesName +"</option>";
					});
					slctresp += opcresp;
				
					var tablainterna='';
					tablainterna+= '<tbody id="tbody">';
						tablainterna+= '<tr id="CTR-'+itemcontrol+'">';
							tablainterna+= '<td colspan="3">';
								
								tablainterna+= '<table id="controlinterna" style="width:100%">';
									tablainterna+= '<tr>';
										tablainterna+= '<td  style="width:100%">';
											tablainterna+= slct + '<br>';
											
											tablainterna+= '<div style="clear:both; width:100%; text-align:center"></div>';
											tablainterna+= '<div style="float:left; width:17%; text-align:center">Propietario</div>';
											tablainterna+= '<div style="float:left; width:17%; text-align:center">Ejecutor</div>';
											tablainterna+= '<div style="float:left; width:17%; text-align:center">Efectividad</div>';
											tablainterna+= '<div style="float:left; width:17%; text-align:center">Frecuencia</div>';
											tablainterna+= '<div style="float:left; width:17%; text-align:center">Categoría</div>';
											tablainterna+= '<div style="float:left; width:15%; text-align:center">Realizado</div>';
											tablainterna+= '<div style="clear:both; width:100%"> </div>';
											
											tablainterna+= '<div style="float:left; width:17%; text-align:center">';
											tablainterna+= '<select class="ctrpropietario" id="selprop'+itemcontrol+'" name="selprop'+ itemcontrol +'" onChange="fnselProp(selprop'+itemcontrol+',this.options[this.selectedIndex].value)">'+ slctresp ;
											tablainterna+= '</select></div>';
											
											tablainterna+= '<div style="float:left; width:17%; text-align:center">';
											tablainterna+= '<select class="ctrejecutor" id="selejec'+ itemcontrol +'" name="selejec'+ itemcontrol +'" onChange="fnselEjec(selejec'+itemcontrol+',this.options[this.selectedIndex].value)">'+ slctresp;
											tablainterna+= '</select></div>';
											tablainterna+= '<div style="float:left; width:17%; text-align:center">';
											tablainterna+= '<select class="ctrefectividad" id="selefct'+ itemcontrol +'" name="selefct'+ itemcontrol +'" onChange="fnselEfec(selefct'+itemcontrol+',this.options[this.selectedIndex].value)">'+selEfectividad;
											tablainterna+= '</select></div>';
											tablainterna+= '<div style="float:left; width:17%; text-align:center">';
											tablainterna+= '<select class="ctrfrecuencia" id="selfrec'+ itemcontrol +'" name="selfrec'+ itemcontrol +'" onChange="fnselFrec(selfrec'+itemcontrol+',this.options[this.selectedIndex].value)">'+selFrecuencia;
											tablainterna+= '</select></div>';

											tablainterna+= '<div style="float:left; width:17%; text-align:center">';
											tablainterna+= '<select class="ctrcategoria" id="ctrcategoria'+ itemcontrol +'" name="ctrcategoria" onChange="fnCategoria(this.options[this.selectedIndex].value)">'+selCategoria;
											tablainterna+= '</select></div>';
											tablainterna+= '<div style="float:left; width:15%; text-align:center">';
											tablainterna+= '<select class="ctrrealizado" id="ctrrealizado'+ itemcontrol +'" name="ctrrealizado" onChange="fnRealizado(this.options[this.selectedIndex].value)"><option value="">Seleccione</option><option value="S-'+itemcontrol+'">Si</option><option value="N-'+itemcontrol+'">No</option>';
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
						/////* alert('delete desde la clase');
						let er =  $("#hder").val();
						let regdel = $(this).parent('td').parent('tr').attr('id');
						/////* alert('regdel...'+regdel);
						
						var itemcontrol = regdel;  //ParId.name;
						itemcontrol = itemcontrol.substr(4);
						/////* alert('itemcontrol desde controljs en clase delete...'+itemcontrol);						
						
						//Control
						infcontrol = $("#selcont"+itemcontrol).children("option:selected").val();
						//Propietario
						infprop = $("#selprop"+itemcontrol).children("option:selected").val();
						//Ejecutor
						infejec = $("#selejec"+itemcontrol).children("option:selected").val();
						//Efectividad
						infefec = $("#selefct"+itemcontrol).children("option:selected").val();
						//Frecuencia
						inffrec = $("#selfrec"+itemcontrol).children("option:selected").val();

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
						totpromedio = sumatoria/contar ;
						totpromedio = Math.round(totpromedio);
						if( isNaN(totpromedio) ){ totpromedio = "" }
						$("#promedio"+itemcontrol).val( totpromedio )
						var totsumatoria = sumatoria;
						fxSumar(totsumatoria, itemcontrol)
						
						ParReg = "N-"+itemcontrol
						////$("#ctrrealizado"+itemcontrol).val(ParReg)
						document.getElementById("ctrrealizado"+itemcontrol).value =ParReg;
						
						fnRegla_32_42(infodocumtxt,infoaplicatxt,infoefectxt,infoevaltxt,ParReg,infprop,infejec,infefec,inffrec,infcontrol,itemcontrol)
						
						$(this).parent('td').parent('tr').hide();
						
						/*let posicion = regdel.indexOf('-');
						if (posicion !== -1){
							var registroborrar = regdel.substr(posicion+1) ;
						}
						itemcontrol*/
						
						/*alert('desde la clase itemcontrol...'+itemcontrol);						
						$.ajax({
							async: true,
							type: "POST",
							url: "../api/matriz/delete_control.php",
							data:  { 'ck': CKCtr, 'id': itemcontrol, 'er': er },
							success: function(datos){
								if( $.trim(datos) == "S" ){
									$("#prob1").trigger('change');
								}
							}
						})
						$(this).parent('td').parent('tr').remove();*/
					});
					
					// funciones para promedio y calificacion
				
				})   // select responsables
			
			})  //seldocum, selAplica ...
			
		})	// select Controles
	}	
})
	var infcontrol = 0;
	var infodocumtxt = 0;
	var infoaplicatxt = 0;
	var infoefectxt = 0;
	var infoevaltxt = 0;
	var totsumatoria = 0;
	var infprop = 0;
	var infejec = 0;
	var infefec = 0;
	var inffrec = 0;

	function fxselCont(ParId, ParReg){
		var itemcontrol = ParId.name;
		itemcontrol = itemcontrol.substr(7);
		////alert('itemcontrol desde controljs...'+itemcontrol);
		////alert('ParReg from controljs....'+ParReg);
		//Control
		infcontrol = $("#selcont"+itemcontrol).children("option:selected").val();
		//Propietario
		infprop = $("#selprop"+itemcontrol).children("option:selected").val();
		//Ejecutor
		infejec = $("#selejec"+itemcontrol).children("option:selected").val();
		//Efectividad
		infefec = $("#selefct"+itemcontrol).children("option:selected").val();
		//Frecuencia
		inffrec = $("#selfrec"+itemcontrol).children("option:selected").val();

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
		totpromedio = sumatoria/contar ;
		totpromedio = Math.round(totpromedio);
		if( isNaN(totpromedio) ){ totpromedio = "" }
		$("#promedio"+itemcontrol).val( totpromedio )
		var totsumatoria = sumatoria;
		fxSumar(totsumatoria, itemcontrol)

		fnRegla_3_4(infodocumtxt,infoaplicatxt,infoefectxt,infoevaltxt,ParReg,infprop,infejec,infefec,inffrec,infcontrol,itemcontrol)
	}

	function fnselProp(ParId, ParReg){
		var itemcontrol = ParId.name;
		itemcontrol = itemcontrol.substr(7);
		
		////alert('itemcontrol propietario controljs.....'+itemcontrol);
		////alert('propietario controljs...'+itemcontrol);
		//Control
		infcontrol = $("#selcont"+itemcontrol).children("option:selected").val();
		//Propietario
		infprop = $("#selprop"+itemcontrol).children("option:selected").val();
		//Ejecutor
		infejec = $("#selejec"+itemcontrol).children("option:selected").val();
		//Efectividad
		infefec = $("#selefct"+itemcontrol).children("option:selected").val();
		//Frecuencia
		inffrec = $("#selfrec"+itemcontrol).children("option:selected").val();

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
		totpromedio = sumatoria/contar ;
		totpromedio = Math.round(totpromedio);
		if( isNaN(totpromedio) ){ totpromedio = "" }
		$("#promedio"+itemcontrol).val( totpromedio )
		var totsumatoria = sumatoria;
		fxSumar(totsumatoria, itemcontrol)

		fnRegla_3_4(infodocumtxt,infoaplicatxt,infoefectxt,infoevaltxt,ParReg,infprop,infejec,infefec,inffrec,infcontrol,itemcontrol)
	}

	function fnselEjec(ParId, ParReg){
		var itemcontrol = ParId.name;
		itemcontrol = itemcontrol.substr(7);
		//Control
		infcontrol = $("#selcont"+itemcontrol).children("option:selected").val();
		//Propietario
		infprop = $("#selprop"+itemcontrol).children("option:selected").val();
		//Ejecutor
		infejec = $("#selejec"+itemcontrol).children("option:selected").val();
		//Efectividad
		infefec = $("#selefct"+itemcontrol).children("option:selected").val();
		//Frecuencia
		inffrec = $("#selfrec"+itemcontrol).children("option:selected").val();

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
		totpromedio = sumatoria/contar ;
		totpromedio = Math.round(totpromedio);
		if( isNaN(totpromedio) ){ totpromedio = "" }
		$("#promedio"+itemcontrol).val( totpromedio )
		var totsumatoria = sumatoria;
		fxSumar(totsumatoria, itemcontrol)

		fnRegla_3_4(infodocumtxt,infoaplicatxt,infoefectxt,infoevaltxt,ParReg,infprop,infejec,infefec,inffrec,infcontrol,itemcontrol)
	}

	function fnselEfec(ParId, ParReg){
		var itemcontrol = ParId.name;
		itemcontrol = itemcontrol.substr(7);
		//Control
		infcontrol = $("#selcont"+itemcontrol).children("option:selected").val();
		//Propietario
		infprop = $("#selprop"+itemcontrol).children("option:selected").val();
		//Ejecutor
		infejec = $("#selejec"+itemcontrol).children("option:selected").val();
		//Efectividad
		infefec = $("#selefct"+itemcontrol).children("option:selected").val();
		//Frecuencia
		inffrec = $("#selfrec"+itemcontrol).children("option:selected").val();

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
		totpromedio = sumatoria/contar ;
		totpromedio = Math.round(totpromedio);
		if( isNaN(totpromedio) ){ totpromedio = "" }
		$("#promedio"+itemcontrol).val( totpromedio )
		var totsumatoria = sumatoria;
		fxSumar(totsumatoria, itemcontrol)

		fnRegla_3_4(infodocumtxt,infoaplicatxt,infoefectxt,infoevaltxt,ParReg,infprop,infejec,infefec,inffrec,infcontrol,itemcontrol)
	}

	function fnselFrec(ParId, ParReg){
		var itemcontrol = ParId.name;
		itemcontrol = itemcontrol.substr(7);
		//Control
		infcontrol = $("#selcont"+itemcontrol).children("option:selected").val();
		//Propietario
		infprop = $("#selprop"+itemcontrol).children("option:selected").val();
		//Ejecutor
		infejec = $("#selejec"+itemcontrol).children("option:selected").val();
		//Efectividad
		infefec = $("#selefct"+itemcontrol).children("option:selected").val();
		//Frecuencia
		inffrec = $("#selfrec"+itemcontrol).children("option:selected").val();

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
		totpromedio = sumatoria/contar ;
		totpromedio = Math.round(totpromedio);
		if( isNaN(totpromedio) ){ totpromedio = "" }
		$("#promedio"+itemcontrol).val( totpromedio )
		var totsumatoria = sumatoria;
		fxSumar(totsumatoria, itemcontrol)

		fnRegla_3_4(infodocumtxt,infoaplicatxt,infoefectxt,infoevaltxt,ParReg,infprop,infejec,infefec,inffrec,infcontrol,itemcontrol)
	}
	
	function fxselDocum(ParId, ParReg){
		var itemcontrol = ParId.name;
		itemcontrol = itemcontrol.substr(8);
		//Control
		infcontrol = $("#selcont"+itemcontrol).children("option:selected").val();
		//Propietario
		infprop = $("#selprop"+itemcontrol).children("option:selected").val();
		//Ejecutor
		infejec = $("#selejec"+itemcontrol).children("option:selected").val();
		//Efectividad
		infefec = $("#selefct"+itemcontrol).children("option:selected").val();
		//Frecuencia
		inffrec = $("#selfrec"+itemcontrol).children("option:selected").val();
	
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
		totpromedio = sumatoria/contar ;
		totpromedio = Math.round(totpromedio);
		if( isNaN(totpromedio) ){ totpromedio = "" }
		$("#promedio"+itemcontrol).val( totpromedio )
		var totsumatoria = sumatoria;
		fxSumar(totsumatoria, itemcontrol)
		fnRegla_3_4(infodocumtxt,infoaplicatxt,infoefectxt,infoevaltxt,ParReg,infprop,infejec,infefec,inffrec,infcontrol,itemcontrol)
	}
	function fxselAplica(ParId, ParReg){
		var itemcontrol = ParId.name;
		itemcontrol = itemcontrol.substr(9);
		//Control
		infcontrol = $("#selcont"+itemcontrol).children("option:selected").val();
		//Propietario
		infprop = $("#selprop"+itemcontrol).children("option:selected").val();
		//Ejecutor
		infejec = $("#selejec"+itemcontrol).children("option:selected").val();
		//Efectividad
		infefec = $("#selefct"+itemcontrol).children("option:selected").val();
		//Frecuencia
		inffrec = $("#selfrec"+itemcontrol).children("option:selected").val();

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
		var contar = 0;
		var sumatoria = 0;
		var totpromedio = 0;
		if(infodocumtxt > 0){ contar++;  sumatoria += infodocumtxt;  }
		if(infoaplicatxt > 0){ contar++; sumatoria += infoaplicatxt; }
		if(infoefectxt > 0){ contar++;   sumatoria += infoefectxt;   }
		if(infoevaltxt > 0){ contar++;   sumatoria += infoevaltxt;   }
		var totsumatoria = sumatoria;
		totpromedio = sumatoria/contar ;
		totpromedio = Math.round(totpromedio);
		if( isNaN(totpromedio) ){ totpromedio = "" }
		$("#promedio"+itemcontrol).val( totpromedio )
		fxSumar(totsumatoria, itemcontrol)
		fnRegla_3_4(infodocumtxt,infoaplicatxt,infoefectxt,infoevaltxt,ParReg,infprop,infejec,infefec,inffrec,infcontrol,itemcontrol)
	}

	function fxselEfec(ParId, ParReg){
		var itemcontrol = ParId.name;
		itemcontrol = itemcontrol.substr(7);
		//Control
		infcontrol = $("#selcont"+itemcontrol).children("option:selected").val();
		//Propietario
		infprop = $("#selprop"+itemcontrol).children("option:selected").val();
		//Ejecutor
		infejec = $("#selejec"+itemcontrol).children("option:selected").val();
		//Efectividad
		infefec = $("#selefct"+itemcontrol).children("option:selected").val();
		//Frecuencia
		inffrec = $("#selfrec"+itemcontrol).children("option:selected").val();

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
		var contar = 0;
		var sumatoria = 0;
		var totpromedio = 0;
		if(infodocumtxt > 0){ contar++;  sumatoria += infodocumtxt;  }
		if(infoaplicatxt > 0){ contar++; sumatoria += infoaplicatxt; }
		if(infoefectxt > 0){ contar++;   sumatoria += infoefectxt;   }
		if(infoevaltxt > 0){ contar++;   sumatoria += infoevaltxt;   }
		var totsumatoria = sumatoria;
		totpromedio = sumatoria/contar ;
		totpromedio = Math.round(totpromedio);
		if( isNaN(totpromedio) ){ totpromedio = "" }
		$("#promedio"+itemcontrol).val( totpromedio )
		fxSumar(totsumatoria, itemcontrol)	
		fnRegla_3_4(infodocumtxt,infoaplicatxt,infoefectxt,infoevaltxt,ParReg,infprop,infejec,infefec,inffrec,infcontrol,itemcontrol)
	}
	
	function fxselEval(ParId, ParReg){
		var itemcontrol = ParId.name;
		itemcontrol = itemcontrol.substr(7);
		//Control
		infcontrol = $("#selcont"+itemcontrol).children("option:selected").val();
		//Propietario
		infprop = $("#selprop"+itemcontrol).children("option:selected").val();
		//Ejecutor
		infejec = $("#selejec"+itemcontrol).children("option:selected").val();
		//Efectividad
		infefec = $("#selefct"+itemcontrol).children("option:selected").val();
		//Frecuencia
		inffrec = $("#selfrec"+itemcontrol).children("option:selected").val();

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
		var contar = 0;
		var sumatoria = 0;
		var totpromedio = 0;
		if(infodocumtxt > 0){ contar++;  sumatoria += infodocumtxt;  }
		if(infoaplicatxt > 0){ contar++; sumatoria += infoaplicatxt; }
		if(infoefectxt > 0){ contar++;   sumatoria += infoefectxt;   }
		if(infoevaltxt > 0){ contar++;   sumatoria += infoevaltxt;   }
		var totsumatoria = sumatoria;
		totpromedio = sumatoria/contar ;
		totpromedio = Math.round(totpromedio);
		if( isNaN(totpromedio) ){ totpromedio = "" }
		$("#promedio"+itemcontrol).val( totpromedio )
		fxSumar(totsumatoria, itemcontrol)
		fnRegla_3_4(infodocumtxt,infoaplicatxt,infoefectxt,infoevaltxt,ParReg,infprop,infejec,infefec,inffrec,infcontrol,itemcontrol)
	}

	function fxSumar(parSumar, parIdControl){
		let id = "";
		let nombre = "";
		let color = "";
		if (parSumar > 0) {
			$.get("../api/calificacion/lista_select.php", {ck: CKCtr, vr: parSumar }, function(data){
				id = data.body[0]["CAL_IdCalificacion"];
				nombre = data.body[0]["CAL_Nombre"];
				color = data.body[0]["CAL_Color"];
				$("#calificacion"+parIdControl).css("background-color", color);
				$("#calificacion"+parIdControl).attr("value", nombre);
				//console.log(color);
			})
		}
	}
	
	
/**/

	function xdeleteCtrl(num, eventoriesgo) {
		let nt = num
		let er = eventoriesgo
		/////* alert('delete desde control nt...'+nt);	
		let pidValue = "N-"+nt
		$.ajax({
			async: false,
			type: "POST",
			url: "../api/matriz/delete_control.php",
			data:  { 'ck': CKCtr, 'id': nt, 'er': er },
			success: function(datos){
				if( $.trim(datos) == "S" ){
					$("#prob1").trigger('change');
				}
			}
		})
		itemcontrol = nt
		//alert('pValue desde control....'+pidValue);
		$("#CTR-" + nt).remove();
		//fnRealizado(pidValue)
		$.redirect("consultaer.php", {id: er, ck : CKCtr });
		
		//fnRX(pidValue)
		/*$.ajax({
			async: false,
			type: "POST",
			url: "../curl/matriz/matriznewmrc.php",
			data:  { 'ck': CKCtr, 'er': er },
			success: function(datos){
				//if( $.trim(datos) == "S" ){
					//$("#prob1").trigger('change');
				//}
			}
		})*/
		
	}
	
	
	
$(document).ready(function(){	
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
					timer: 3000
				});
			}
		})
		event.preventDefault()
	})
})