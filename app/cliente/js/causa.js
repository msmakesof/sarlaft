let CKCau = global.key;
var itemcausa = 9000
$("#addcau").on('click', function(){
	let slct = '';
	$.get("../api/causas/lista_eve.php", {ck: CKCau }, function(result){
		itemcausa ++;
		let opc = "<option value=''>Seleccione opción</option>";
		$.each(result.body, function(i, item) {
			opc +="<option value='"+ item.id +"'>"+ item.CausasName +"</option>";
		});
		slct = '<select class="form-control causa" id="causa'+itemcausa+'" name="causa'+itemcausa+'" onChange="fxCA(this.options[this.selectedIndex].value, itemcausa)" autofocus>';					
		slct += opc;
		slct += '</select>';
		
		let varDel = '<div class="delete" id="delCA'+itemcausa+'" onClick="delCA('+itemcausa+')"><i class="fas fa-trash" style="color:red; cursor:pointer"></i></div>';
		
		//$("#tabcau").append('<tbody>');
		$("#tabcaubody").append('<tr id="CAU'+itemcausa+'"><td style="width:10%"></td><td style="width:80%">'+ slct +'</td><td style="width:10%">'+varDel+'</td></tr>');
		//$("#tabcau").append('</tbody>');
		
		/*$('.delete').off().click(function(e) {
			$(this).parent('td').parent('tr').remove();
		});*/
	})
})
$('#addCausaModal').on('show.bs.modal', function (event) {
	setTimeout(function (){
		$('#CausasName2').focus()
	}, 1000)
})

$( "#add_causa" ).submit(function( event ) {
	var parametros = $(this).serialize();
		$.ajax({
			type: "POST",
			url: "../ajax/guardar_causa.php",
			data: parametros,
			 beforeSend: function(objeto){
				$("#resultados").html("Enviando...");
			},
			success: function(datos){
				$('#addCausaModal').modal('hide');
				let m= datos.trim()
				let msj = m.substr(0,1);
				let type
				let txt
				if(msj == 'O'){
					type = 'success';
					txt = 'Causa ha sido guardada con éxito.';
				}
				else if(msj == 'E'){
					type= 'warning';
					txt = 'En Causa Ya existe un Registro grabado con el mismo Nombre.';
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

function deletecaUpd(num, eventoriesgo) {
	//alert('numtiporiesgo....'+numtiporiesgo+'     er...'+eventoriesgo );
	let nt = num
	let er = eventoriesgo
	$.ajax({
		async: true,
		type: "POST",
		url: "../api/causas/deleteUpd.php",
		data:  { 'ck': CKTra, 'id': nt, 'er': er },
		success: function(datos){
			msj = $.trim(datos)
			let type
			let txt
			if(msj == 'S'){
				type = 'success';
				txt = 'Causa ha sido borrado con éxito.';
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
			for(var i in arrCA){
				if(arrCA[i]==itemborrar){
					arrCA.splice(i,1);
					break;
				}
			}
			 $("#CAU" + nt).remove();
		}
	})
}
function delCA(pir){
	let itemborrar = $("#causa"+pir).val()	
	for(var i in arrCA){
        if(arrCA[i]==itemborrar){
            arrCA.splice(i,1);
            break;
        }
    }
	$("#CAU"+pir).remove()
}