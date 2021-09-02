let CK = global.key;
var itemtiporiesgo = 9000
$("#addtir").on('click', function(){
	let slct = '';
	$.get("../api/tiposriesgo/lista_eve.php", {ck: CK  }, function(result){
		itemtiporiesgo ++;
		let opc = "<option value=''>Seleccione opción</option>";
		$.each(result.body, function(i, item) {
			opc +="<option value='"+ item.TIR_IdTipoRiesgo +"'>"+ item.TIR_Nombre +"</option>";
		});
		
		slct = '<select class="form-control tiporie" id="tr'+itemtiporiesgo+'" name="tr'+itemtiporiesgo+'"  onChange="fxTR(this.options[this.selectedIndex].value, itemtiporiesgo)" autofocus>';					
		slct += opc;
		slct += '</select>';
		
		let varDel = '<div class="delete" id="delTR'+itemtiporiesgo+'" onClick="delTR('+itemtiporiesgo+')"><i class="fas fa-trash" style="color:red; cursor:pointer"></i></div>';
		
		//$("#tabtir").append('<tbody>');
		$("#tabtirbody").append('<tr id="TIR'+itemtiporiesgo+'"><td style="width:10%"></td><td style="width:80%">'+ slct +'</td><td style="width:10%">'+varDel+'</td></tr>');
		//$("#tabtir").append('</tbody>');
		
		/*
		$('.delete').off().click(function(e) {			
			////alert( $("tr"+itemtiporiesgo).options["tr"+itemtiporiesgo.selectedIndex].value);
			//console.log(e);
			//$(this).parent('td').parent('tr').remove();    $("#tr" + nt).val();
		});*/
		
	})
})
$('#addTipoRiesgoModal').on('show.bs.modal', function (event) {
	$('#TipoRiesgoName2').val('')
	setTimeout(function (){
		$('#TipoRiesgoName2').focus()
	}, 1000)
})

$( "#add_tiposriesgo" ).submit(function( event ) {
	var parametros = $(this).serialize();
		$.ajax({
			type: "POST",
			url: "../ajax/tiposriesgo/guardar_tiposriesgo.php",
			data: parametros,
			 beforeSend: function(objeto){
				$("#resultados").html("Enviando...");
			},
			success: function(datos){
				$('#addTipoRiesgoModal').modal('hide');
				let m= datos.trim()
				let msj = m.substr(0,1);
				let type
				let txt
				if(msj == 'O'){
					type = 'success';
					txt = 'Tipo de Riesgo ha sido guardada con éxito.';
				}
				else if(msj == 'E'){
					type= 'warning';
					txt = 'En Tipo de Riesgo Ya existe un Registro grabado con el mismo Nombre.';
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

function deletetrUpd(numtiporiesgo, eventoriesgo) {
	//alert('numtiporiesgo....'+numtiporiesgo+'     er...'+eventoriesgo );
	let nt = numtiporiesgo
	let er = eventoriesgo
	$.ajax({
		async: true,
		type: "POST",
		url: "../api/tiposriesgo/deleteUpd.php",
		data:  { 'ck': CKTra, 'id': nt, 'er': er },
		success: function(datos){
			msj = $.trim(datos)
			let type
			let txt
			if(msj == 'S'){
				type = 'success';
				txt = 'Tipo Riesgo ha sido borrado con éxito.';
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
			let itemborrar = nt
			for(var i in arrTR){
				if(arrTR[i]==itemborrar){
					arrTR.splice(i,1);
					break;
				}
			}
			$("#TIR" + nt).remove();
		}
	})
}

function delTR(pir){
	//console.log(arrTR)
	//console.log( $("#tr"+pir).val() )
	let itemborrar = $("#tr"+pir).val()
	for(var i in arrTR){
        if(arrTR[i]==itemborrar){
            arrTR.splice(i,1);
            break;
        }
    }
	//console.log(arrTR)
	$("#TIR"+pir).remove() 
}