let CKRia = global.key;
let itemria = 0		
$("#addiria").on('click', function(){
	let slct = '';
	$.get("../api/riesgoasociado/lista_eve.php", {ck: CKRia }, function(result){
		let opc = "<option value=''>Seleccione opción</option>";
		$.each(result.body, function(i, item) {
			opc +="<option value='"+ item.RIA_IdRiesgoAsociado +"'>"+ item.RIA_Nombre +"</option>";
		});
		slct = '<select class="form-control ria" id="ra" name="ra">';					
		slct += opc;
		slct += '</select>';
		itemria = itemria + 1
		$("#tabriabody").append('<tr id="RIA'+itemria+'"><td style="width:10%"></td><td style="width:80%">'+ slct +'</td><td style="width:10%"><div class="delete"><i class="fas fa-trash" style="color:red; cursor:pointer"></i></div></td></tr>');
		$('.delete').off().click(function(e) {
			$(this).parent('td').parent('tr').remove();
		});
	})
})

$('#addRIAModal').on('show.bs.modal', function (event) {
	$('#Name2').val('')
	setTimeout(function (){
		$('#Name2').focus()
	}, 1000)
})

$( "#add_ria" ).submit(function( event ) {				
	var parametros = $(this).serialize();
	$.ajax({
		type: "POST",
		url: "../ajax/riesgoasociado/guardar.php",
		data: parametros,
		beforeSend: function(objeto){
			//$("#resultados").html("Enviando...");
		},
		success: function(datos){
			let m= datos.trim();
			//$("#resultados").html(datos);
			$('#addRIAModal').modal('hide');
			let msj = m.substr(0,1);
			let type;
			let txt;
			if(msj == 'O'){
				type = 'success';
				txt = 'Riesgo Asociado ha sido guardado con éxito.';
			}
			else if(msj == 'E'){
				type= 'warning';
				txt = 'En Riesgo Asociado Ya existe un Registro grabado con el mismo Nombre.';
			}
			else if(msj == 'I'){
				type= 'warning';
				txt = 'Ya existe un Registro grabado con el mismo Nit.';
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
			//setTimeout(function (){
			//	load(1);location.reload();	
			//}, 3000)
		}
	});
  event.preventDefault()
});