let CKSPr = global.key;
let itemsegproductos = 9000
$("#addspr").on('click', function(){
	let slct = '';
	$.get("../api/segproductos/lista_eve.php", {ck: CKSPr  }, function(result){
		itemsegproductos ++;
		let opc = "<option value=''>Seleccione opción</option>";
		$.each(result.body, function(i, item) {
			opc +="<option value='"+ item.id +"'>"+ item.SegProductosName +"</option>";
		});
		slct = '<select class="form-control segproductos" id="segproductos'+itemsegproductos+'" name="segproductos'+itemsegproductos+'" onChange="fxSP(this.options[this.selectedIndex].value, itemsegproductos)" autofocus>';					
		slct += opc;
		slct += '</select>';
		
		let varDel = '<div class="delete" id="delSP'+itemsegproductos+'" onClick="delSP('+itemsegproductos+')"><i class="fas fa-trash" style="color:red; cursor:pointer"></i></div>';
		
		////$("#tabdeb").append('<tbody>');
		$("#tabsprbody").append('<tr id="SPR'+itemsegproductos+'"><td style="width:10%"></td><td style="width:80%">'+ slct +'</td><td style="width:10%">'+varDel+'</td></tr>');
		////$("#tabdeb").append('</tbody>');
		
		/*$('.delete').off().click(function(e) {
			$(this).parent('td').parent('tr').remove();
		});*/
	})
})
$('#addSegProductosModal').on('show.bs.modal', function (event) {
	$('#SegProductosName2').val('')
	setTimeout(function (){
		$('#SegProductosName2').focus()
	}, 1000)
})

$( "#add_segproductos" ).submit(function( event ) {
	var parametros = $(this).serialize();
		$.ajax({
			type: "POST",
			url: "../ajax/guardar_segproductos.php",
			data: parametros,
			 beforeSend: function(objeto){
				$("#resultados").html("Enviando...");
			},
			success: function(datos){
				$('#addSegProductosModal').modal('hide');
				let m= datos.trim()
				let msj = m.substr(0,1);
				let type
				let txt
				if(msj == 'O'){
					type = 'success';
					txt = 'Segmento Productos ha sido guardada con éxito.';
				}
				else if(msj == 'E'){
					type= 'warning';
					txt = 'En Segmento Productos Ya existe un Registro grabado con el mismo Nombre.';
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

function deletespUpd(num, eventoriesgo) {
	//alert('numtiporiesgo....'+numtiporiesgo+'     er...'+eventoriesgo );
	let nt = num
	let er = eventoriesgo
	$.ajax({
		async: true,
		type: "POST",
		url: "../api/segproductos/deleteUpd.php",
		data:  { 'ck': CKTra, 'id': nt, 'er': er },
		success: function(datos){
			msj = $.trim(datos)
			let type
			let txt
			if(msj == 'S'){
				type = 'success';
				txt = 'Segmento Productos ha sido borrado con éxito.';
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

function delSP(pir){
	let itemborrar = $("#segproductos"+pir).val()	
	for(var i in arrSP){
        if(arrSP[i]==itemborrar){
            arrSP.splice(i,1);
            break;
        }
    }
	$("#SPR"+pir).remove()
}