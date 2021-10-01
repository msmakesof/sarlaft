let CKSCa = global.key;
let itemsegcanales = 9000
$("#addsca").on('click', function(){
	let slct = '';
	$.get("../api/segcanales/lista_eve.php", {ck: CKSCa  }, function(result){
		itemsegcanales ++;
		let opc = "<option value=''>Seleccione opción</option>";
		$.each(result.body, function(i, item) {
			opc +="<option value='"+ item.id +"'>"+ item.SegCanalesName +"</option>";
		});
		slct = '<select class="form-control segcanales" id="segcanales'+itemsegcanales+'" name="segcanales'+itemsegcanales+'" onChange="fxCN(this.options[this.selectedIndex].value, itemsegcanales)" autofocus>';					
		slct += opc;
		slct += '</select>';
		
		let varDel = '<div class="delete" id="delSC'+itemsegcanales+'" onClick="delCA('+itemsegcanales+')"><i class="fas fa-trash" style="color:red; cursor:pointer"></i></div>';
		
		$("#tabscabody").append('<tr id="SCA'+itemsegcanales+'"><td style="width:10%"></td><td style="width:80%">'+ slct +'</td><td style="width:10%">'+varDel+'</td></tr>');
	
	})
})
$('#addSegCanalesModal').on('show.bs.modal', function (event) {
	$('#SegCanalesName2').val('')
	setTimeout(function (){
		$('#SegCanalesName2').focus()
	}, 1000)
})

$( "#add_segcanales" ).submit(function( event ) {
	var parametros = $(this).serialize();
		$.ajax({
			type: "POST",
			url: "../ajax/guardar_segcanales.php",
			data: parametros,
			 beforeSend: function(objeto){
				$("#resultados").html("Enviando...");
			},
			success: function(datos){
				$('#addSegCanalesModal').modal('hide');
				let m= datos.trim()
				let msj = m.substr(0,1);
				let type
				let txt
				if(msj == 'O'){
					type = 'success';
					txt = 'Segmento Canales ha sido guardada con éxito.';
				}
				else if(msj == 'E'){
					type= 'warning';
					txt = 'En Segmento Canales Ya existe un Registro grabado con el mismo Nombre.';
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
		url: "../api/segcanales/deleteUpd.php",
		data:  { 'ck': CKTra, 'id': nt, 'er': er },
		success: function(datos){
			msj = $.trim(datos)
			let type
			let txt
			if(msj == 'S'){
				type = 'success';
				txt = 'Segmento Canales ha sido borrado con éxito.';
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

function delCA(pir){
	let itemborrar = $("#segcanales"+pir).val()	
	for(var i in arrSC){
        if(arrSC[i]==itemborrar){
            arrSC.splice(i,1);
            break;
        }
    }
	$("#SCA"+pir).remove()
}