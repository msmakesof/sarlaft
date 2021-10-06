let CKScl = global.key;
let itemsegclientes = 9000
$("#addscl").on('click', function(){
	let slct = '';
	$.get("../api/segclientes/lista_eve.php", {ck: CKScl  }, function(result){
		itemsegclientes ++;
		let opc = "<option value=''>Seleccione opción</option>";
		$.each(result.body, function(i, item) {
			opc +="<option value='"+ item.id +"'>"+ item.SegClientesName +"</option>";
		});
		slct = '<select class="form-control segclientes" id="segclientes'+itemsegclientes+'" name="segclientes'+itemsegclientes+'" onChange="fxSC(this.options[this.selectedIndex].value, itemsegclientes)" autofocus>';					
		slct += opc;
		slct += '</select>';
		
		let varDel = '<div class="delete" id="delSC'+itemsegclientes+'" onClick="delSC('+itemsegclientes+')"><i class="fas fa-trash" style="color:red; cursor:pointer"></i></div>';
		
		$("#tabsclbody").append('<tr id="SCL'+itemsegclientes+'"><td style="width:10%"></td><td style="width:80%">'+ slct +'</td><td style="width:10%">'+varDel+'</td></tr>');
	})
})

$('#addSegClientesModal').on('show.bs.modal', function (event) {
	$('#SegClientesName2').val('')
	setTimeout(function (){
		$('#SegClientesName2').focus()
	}, 1000)
})

$( "#add_segclientes" ).submit(function( event ) {
	var parametros = $(this).serialize();
		$.ajax({
			type: "POST",
			url: "../ajax/segclientes/guardar.php",
			data: parametros,
			 beforeSend: function(objeto){
				$("#resultados").html("Enviando...");
			},
			success: function(datos){
				$('#addSegClientesModal').modal('hide');
				let m= datos.trim()
				let msj = m.substr(0,1);
				let type
				let txt
				if(msj == 'O'){
					type = 'success';
					txt = 'Segmento de Cliente ha sido guardada con éxito.';
				}
				else if(msj == 'E'){
					type= 'warning';
					txt = 'En Segmento de Cliente Ya existe un Registro grabado con el mismo Nombre.';
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

function deletescUpd(num, eventoriesgo) {
	//alert('numtiporiesgo....'+num+'     er...'+eventoriesgo );
	let nt = num
	let er = eventoriesgo
	$.ajax({
		async: true,
		type: "POST",
		url: "../api/segclientes/deleteUpd.php",
		data:  { 'ck': CKScl, 'id': nt, 'er': er },
		success: function(datos){
			msj = $.trim(datos)
			let type
			let txt
			if(msj == 'S'){
				type = 'success';
				txt = 'Segmento de Cliente ha sido borrado con éxito.';
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
			for(var i in arrSC){
				if(arrSC[i]==itemborrar){
					arrSC.splice(i,1);
					break;
				}
			}
			$("#SCL" + nt).remove();
		}
	})
}

function delSC(pir){
	let itemborrar = $("#segclientes"+pir).val()	
	for(var i in arrSC){
        if(arrSC[i]==itemborrar){
            arrSC.splice(i,1);
            break;
        }
    }
	$("#SCL"+pir).remove()
}