let CKFor = global.key;
let itemfortaleza = 9000
$("#addfor").on('click', function(){
	let slct = '';
	$.get("../api/fortalezas/lista_eve.php", {ck: CKFor  }, function(result){
		itemfortaleza ++;
		let opc = "<option value=''>Seleccione opción</option>";
		$.each(result.body, function(i, item) {
			opc +="<option value='"+ item.id +"'>"+ item.FortalezasName +"</option>";
		});
		slct = '<select class="form-control fortal" id="fortal'+itemfortaleza+'" name="fortal'+itemfortaleza+'" onChange="fxFO(this.options[this.selectedIndex].value, itemfortaleza)" autofocus>';					
		slct += opc;
		slct += '</select>';

		let varDel = '<div class="delete" id="delFO'+itemfortaleza+'" onClick="delFO('+itemfortaleza+')"><i class="fas fa-trash" style="color:red; cursor:pointer"></i></div>';
		
		//$("#tabfor").append('<tbody>');
		$("#tabforbody").append('<tr id="FOR'+itemfortaleza+'"><td style="width:10%"></td><td style="width:80%">'+ slct +'</td><td style="width:10%">'+varDel+'</td></tr>');
		//$("#tabfor").append('</tbody>');
		/*$('.delete').off().click(function(e) {
			$(this).parent('td').parent('tr').remove();
		});*/
	})
})
$('#addFortalezasModal').on('show.bs.modal', function (event) {
	$('#FortalezasName2').val('')
	setTimeout(function (){
		$('#FortalezasName2').focus()
	}, 1000)
})

$( "#add_fortalezas" ).submit(function( event ) {
	var parametros = $(this).serialize();
		$.ajax({
			type: "POST",
			url: "../ajax/fortalezas/guardar_fortalezas.php",
			data: parametros,
			 beforeSend: function(objeto){
				$("#resultados").html("Enviando...");
			},
			success: function(datos){
				$('#addFortalezasModal').modal('hide');
				let m= datos.trim()
				let msj = m.substr(0,1);
				let type
				let txt
				if(msj == 'O'){
					type = 'success';
					txt = 'Fortaleza ha sido guardada con éxito.';
				}
				else if(msj == 'E'){
					type= 'warning';
					txt = 'En Fortaleza Ya existe un Registro grabado con el mismo Nombre.';
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
function deletefoUpd(num, eventoriesgo) {
	//alert('numtiporiesgo....'+numtiporiesgo+'     er...'+eventoriesgo );
	let nt = num
	let er = eventoriesgo
	$.ajax({
		async: true,
		type: "POST",
		url: "../api/fortalezas/deleteUpd.php",
		data:  { 'ck': CKTra, 'id': nt, 'er': er },
		success: function(datos){
			msj = $.trim(datos)
			let type
			let txt
			if(msj == 'S'){
				type = 'success';
				txt = 'Fortaleza ha sido borrado con éxito.';
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
			for(var i in arrFO){
				if(arrFO[i]==itemborrar){
					arrFO.splice(i,1);
					break;
				}
			}
			$("#FOR" + nt).remove();
		}
	})
}

function delFO(pir){
	let itemborrar = $("#fortal"+pir).val()	
	for(var i in arrFO){
        if(arrFO[i]==itemborrar){
            arrFO.splice(i,1);
            break;
        }
    }
	$("#FOR"+pir).remove()
}