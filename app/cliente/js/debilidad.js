let CKDeb = global.key;
let itemdebilidad = 9000
$("#adddeb").on('click', function(){
	let slct = '';
	$.get("../api/debilidades/lista_eve.php", {ck: CKDeb  }, function(result){
		itemdebilidad ++;
		let opc = "<option value=''>Seleccione opción</option>";
		$.each(result.body, function(i, item) {
			opc +="<option value='"+ item.id +"'>"+ item.DebilidadesName +"</option>";
		});
		slct = '<select class="form-control debil" id="debil'+itemdebilidad+'" name="debil'+itemdebilidad+'" onChange="fxDE(this.options[this.selectedIndex].value, itemdebilidad)" autofocus>';					
		slct += opc;
		slct += '</select>';
		
		let varDel = '<div class="delete" id="delDE'+itemdebilidad+'" onClick="delDE('+itemdebilidad+')"><i class="fas fa-trash" style="color:red; cursor:pointer"></i></div>';
		
		////$("#tabdeb").append('<tbody>');
		$("#tabdebbody").append('<tr id="DEB'+itemdebilidad+'"><td style="width:10%"></td><td style="width:80%">'+ slct +'</td><td style="width:10%">'+varDel+'</td></tr>');
		////$("#tabdeb").append('</tbody>');
		
		/*$('.delete').off().click(function(e) {
			$(this).parent('td').parent('tr').remove();
		});*/
	})
})
$('#addDebilidadesModal').on('show.bs.modal', function (event) {
	$('#DebilidadesName2').val('')
	setTimeout(function (){
		$('#DebilidadesName2').focus()
	}, 1000)
})

$( "#add_debilidades" ).submit(function( event ) {
	var parametros = $(this).serialize();
		$.ajax({
			type: "POST",
			url: "../ajax/debilidades/guardar_debilidades.php",
			data: parametros,
			 beforeSend: function(objeto){
				$("#resultados").html("Enviando...");
			},
			success: function(datos){
				$('#addDebilidadesModal').modal('hide');
				let m= datos.trim()
				let msj = m.substr(0,1);
				let type
				let txt
				if(msj == 'O'){
					type = 'success';
					txt = 'Debilidad ha sido guardada con éxito.';
				}
				else if(msj == 'E'){
					type= 'warning';
					txt = 'En Debilidad Ya existe un Registro grabado con el mismo Nombre.';
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
		url: "../api/debilidades/deleteUpd.php",
		data:  { 'ck': CKTra, 'id': nt, 'er': er },
		success: function(datos){
			msj = $.trim(datos)
			let type
			let txt
			if(msj == 'S'){
				type = 'success';
				txt = 'Debilidad ha sido borrado con éxito.';
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
			for(var i in arrDE){
				if(arrDE[i]==itemborrar){
					arrDE.splice(i,1);
					break;
				}
			}
			$("#DEB" + nt).remove();
		}
	})
}

function delDE(pir){
	let itemborrar = $("#debil"+pir).val()	
	for(var i in arrDE){
        if(arrDE[i]==itemborrar){
            arrDE.splice(i,1);
            break;
        }
    }
	$("#DEB"+pir).remove()
}