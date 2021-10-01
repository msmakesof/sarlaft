let CKSJu = global.key;
let itemsegjurisdiccion = 9000
$("#addsju").on('click', function(){
	let slct = '';
	$.get("../api/segjurisdiccion/lista_eve.php", {ck: CKSJu  }, function(result){
		itemsegjurisdiccion ++;
		let opc = "<option value=''>Seleccione opción</option>";
		$.each(result.body, function(i, item) {
			opc +="<option value='"+ item.id +"'>"+ item.SegJurisdiccionName +"</option>";
		});
		slct = '<select class="form-control segjurisdiccion" id="segjurisdiccion'+itemsegjurisdiccion+'" name="segjurisdiccion'+itemsegjurisdiccion+'" onChange="fxSJ(this.options[this.selectedIndex].value, itemsegjurisdiccion)" autofocus>';					
		slct += opc;
		slct += '</select>';
		
		let varDel = '<div class="delete" id="delSJ'+itemsegjurisdiccion+'" onClick="delSJ('+itemsegjurisdiccion+')"><i class="fas fa-trash" style="color:red; cursor:pointer"></i></div>';
		
		$("#tabsjubody").append('<tr id="SJU'+itemsegjurisdiccion+'"><td style="width:10%"></td><td style="width:80%">'+ slct +'</td><td style="width:10%">'+varDel+'</td></tr>');
	
	})
})
$('#addSegJurisdiccionModal').on('show.bs.modal', function (event) {
	$('#SegJurisdiccionName2').val('')
	setTimeout(function (){
		$('#SegJurisdiccionName2').focus()
	}, 1000)
})

$( "#add_segjurisdiccion" ).submit(function( event ) {
	var parametros = $(this).serialize();
		$.ajax({
			type: "POST",
			url: "../ajax/guardar_segjurisdiccion.php",
			data: parametros,
			 beforeSend: function(objeto){
				$("#resultados").html("Enviando...");
			},
			success: function(datos){
				$('#addSegJurisdiccionModal').modal('hide');
				let m= datos.trim()
				let msj = m.substr(0,1);
				let type
				let txt
				if(msj == 'O'){
					type = 'success';
					txt = 'Segmento Jurisdicción ha sido guardada con éxito.';
				}
				else if(msj == 'E'){
					type= 'warning';
					txt = 'En Segmento Jurisdicción Ya existe un Registro grabado con el mismo Nombre.';
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

function deletedeUpd(num, eventoriesgo) {
	//alert('numtiporiesgo....'+numtiporiesgo+'     er...'+eventoriesgo );
	let nt = num
	let er = eventoriesgo
	$.ajax({
		async: true,
		type: "POST",
		url: "../api/segjurisdiccion/deleteUpd.php",
		data:  { 'ck': CKTra, 'id': nt, 'er': er },
		success: function(datos){
			msj = $.trim(datos)
			let type
			let txt
			if(msj == 'S'){
				type = 'success';
				txt = 'Segmento Jurisdicción ha sido borrado con éxito.';
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
			for(var i in arrSP){
				if(arrSP[i]==itemborrar){
					arrSP.splice(i,1);
					break;
				}
			}
			$("#SPR" + nt).remove();
		}
	})
}

function delSJ(pir){
	let itemborrar = $("#segjurisdiccion"+pir).val()	
	for(var i in arrSJ){
        if(arrSJ[i]==itemborrar){
            arrSJ.splice(i,1);
            break;
        }
    }
	$("#SJU"+pir).remove()
}