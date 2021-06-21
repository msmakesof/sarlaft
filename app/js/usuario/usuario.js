		$(function() {
			load(1);
		});
		$('.select2').select2();
		let tabla = "usuario";
		let estado = "";
		
		function load(page){
			var query=$("#q").val();
			var per_page=10;
			var parametros = {"action":"ajax","page":page,'query':query,'per_page':per_page};
			$("#loader").fadeIn('slow');
			$.ajax({
				url:'ajax/'+ tabla +'/listar.php',
				data: parametros,
				beforeSend: function(objeto){
					$("#loader").html("Cargando...");
			  	},
				success:function(data){
					$(".outer_div").html(data).fadeIn('slow');
					$("#loader").html("");
				}
			})
		}
		
		var headRows = function() {
			return [{
			  id: "ID",
			  name: "Name",
			}];
		};

		var bodyRows = function(rowCount) {
			rowCount = rowCount || 10;
			let body = [];

			for (var i = 1; i <= rowCount; i++) {
			  body.push({
				id: i,
				name: "Name " + i
			  });
			}
			return body;
		}
		
		$("#xpdf").on('click', function(event){			
			//var login = ;
			//alert(param);			
			let base64Img	
			base64Img = "img/edit.png"	
				
			const { jsPDF } = window.jspdf            
			const doc = new jsPDF('p', 'pt', 'letter')
			var totalPagesExp = "{total_pages_count_string}"			
			
			doc.autoTable({ 
				useCORS: true,
				columns: [
					{ header: ' ', dataKey: 'no' },
					{ header: 'Nombre', dataKey: 'UserName' },
					{ header: 'Email', dataKey: 'UserEmail' },
					{ header: 'Estado', dataKey: 'UserStatus' },
					{ header: 'Compañía', dataKey: 'CustomerName' },
					{ header: 'Rol', dataKey: 'RolNombre' },
				],
				  
				startY: doc.autoTable() + 70,
				tableWidth: 'auto',
				margin: {top: 80,
				bottom: 60,
				left: 40,
				width: 522} ,
				body: bodyRows(40),
				beforePageContent: function(data) {
					doc.text("Header", 170, 50);
				},
				styles: { overflow: "linebreak" },
				bodyStyles: { valign: "top" },
				theme: "striped",
				showHead: "everyPage",
				pageBreak: 'always',
				didDrawPage: function (data) {					
					// Header
					doc.setFontSize(20);
					doc.setTextColor(40);
					doc.text("Reporte de Usuarios", data.settings.margin.left+190, 40);
					
					 if (base64Img) {
						doc.addImage(base64Img, 'PNG', data.settings.margin.left, 15, 140, 30);
					}

					// Footer
					let nro = doc.internal.getNumberOfPages() -1
					var str = "Página " + nro;
					// Total page number plugin only available in jspdf v1.0+
					if (typeof doc.putTotalPages === 'function') {
						
					  str = str + " de " + totalPagesExp;
					}

					doc.setFontSize(10);

					// jsPDF 1.4+ uses getWidth, <1.4 uses .width
					var pageSize = doc.internal.pageSize;
					var pageHeight = pageSize.height
					  ? pageSize.height
					  : pageSize.getHeight();
					doc.text(str, data.settings.margin.left, pageHeight - 10);
					
					doc.text("Usuario: ", data.settings.margin.left+400, pageHeight-10, 0);
				},				
				html: '#example'
			})
			
			doc.deletePage(1) //Elimina primera hoja en blanco
			
			// Total page number plugin only available in jspdf v1.0+
			if (typeof doc.putTotalPages === 'function') {
			  doc.putTotalPages(totalPagesExp);
			}
			
			doc.save('usuarios.pdf')
		})
		
		$('#Email').on('blur', function(){
			//alert(77);
			// para verificar si el email ya se encuentra registrado			
			let id = 0
			let email = $("#Email").val()
			$.post( "ajax/"+ tabla +"/buscaemail.php", { 'id': id, 'email': email })
			  .done(function( datos ) {
				if(datos == 1 ){
					swal({
						position: 'top-end',
						type: 'warning',
						title: 'El Email digitado Ya fue registrado',
						showConfirmButton: true,
						timer: 5000
					});
					$("#Email").val('')
					$("#Email").focus()
				}					
			})
		})
		
		$('#edit_email').on('blur', function(){
			// para verificar si el email ya se encuentra registrado			
			var id = $("#edit_id").val()
			var email = $("#edit_email").val()
			$.post( "ajax/"+ tabla +"/buscaemail.php", { 'id': id, 'email': email })
			  .done(function( datos ) {
				if(datos == 1 ){
					swal({
						position: 'top-end',
						type: 'warning',
						title: 'El Email digitado Ya fue registrado',
						showConfirmButton: true,
						timer: 5000
					});
					$("#edit_email").val('')
					$("#edit_email").focus()
				}					
			})
		})
		
		$('#editUserModal').on('show.bs.modal', function (event) {
			setTimeout(function (){
				$('#edit_name').focus();
			}, 1000)
			var button = $(event.relatedTarget) // Button that triggered the modal			
			var name = button.data('name') 
			$('#edit_name').val(name)
			var email = button.data('email') 
			$('#edit_email').val(email)
			var password2 = button.data('password2') 
			$('#edit_password2').val(password2)
			var customerkey2 = button.data('customerkey2')
			$('#edit_customerkey2').val(customerkey2)
			//alert(customerkey2);			
			if(customerkey2 == undefined){
				customerkey2 = ""
			}
			var parametros = "idcustomer="+customerkey2
			setTimeout(function (){  // Se debe poner tiempo de espera para que cargue todos los select 
				$.post( "ajax/"+ tabla +"/editarcustomer.php", { 'idcustomer': customerkey2 })
				  .done(function( datos ) {
					//alert('datos.....'+datos);
					let slct = '<select class="form-control" name="edit_customerkey2" id="edit_customerkey2" style="width: 100%;" required>';
						slct += datos;
						slct += '</select>';
						$("#edit_customerkey2").html(slct)
				});
			}, 500)
			
			var idrol = button.data('idrol')
			$('#edit_rol').val(idrol)
			//alert(idrol);
			if(idrol == undefined){
				idrol = ""
			}
			 var parametros2 = "idrol="+idrol			
			$.ajax({
				type: "POST",
				url: "ajax/"+ tabla +"/editarrol.php",
				data: parametros2,
				success: function(datos){
					let slct = '<select class="form-control" name="edit_rol" id="edit_rol" style="width: 100%;" required>';
						slct += datos;
						slct += '</select>';
					$("#edit_rol").html(slct)
				}	
			})
			
			var estado = button.data('estado')
			$('#edit_estado').val(estado)
			//alert(estado);
			if(estado == undefined){
				estado = ""
			}
			var parametros3 = "idestado="+estado
			$.ajax({
				type: "POST",
				url: "ajax/"+ tabla +"/editarestado.php",
				data: parametros3,
				success: function(datos){
					let slct = '<select class="form-control" name="edit_estado" id="edit_estado" style="width: 100%;" required>';
						slct += datos;
						slct += '</select>';
					$("#edit_estado").html(slct)
				}	
			})
			var id = button.data('id') 
			$('#edit_id').val(id)			
		})
		
		$('#deleteUserModal').on('show.bs.modal', function (event) {
			var button = $(event.relatedTarget) // Button that triggered the modal
			var id = button.data('id') 
			$('#delete_id').val(id)
		})		
		
		$( "#edit_user" ).submit(function( event ) {
			var parametros = $(this).serialize();
			$.ajax({
				type: "POST",
				url: "ajax/"+ tabla +"/editar.php",
				data: parametros,
				beforeSend: function(objeto){
					$("#resultados").html("Enviando...");
				},
				success: function(datos){
					$("#resultados").html(datos);
					$('#editUserModal').modal('hide');
					let msj = datos.substr(1,1);					
					let type;
					let txt;
					if(msj == 'U'){
						type = 'success';
						txt = 'El '+ tabla +' ha sido actualizado con éxito.';
					}
					else if(msj == 'E'){
						type= 'warning';
						txt = 'Ya existe un '+ tabla +' grabado con el mismo Nombre.';
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
						type: ''+ type,
						title: ''+ txt,
						showConfirmButton: true,
						timer: 5000
					});
					setTimeout(function() {
						load(1);
						location.reload();
					}, 3000);
				}
			});
		  event.preventDefault();
		});	
		
		$( "#addUserModal" ).on('show.bs.modal', function () {			
			setTimeout(function (){
				$('#UserName2').focus();
			}, 500)		
			
		});
		
		$( "#add_user" ).submit(function( event ) {
			var parametros = $(this).serialize();
			$.ajax({
				type: "POST",
				url: "ajax/"+ tabla +"/guardar.php",
				data: parametros,
				beforeSend: function(objeto){
					$("#resultados").html("Enviando...");
				},
				success: function(datos){					
					$("#resultados").html(datos);
					$('#addUserModal').modal('hide');
					let msj = datos.substr(1,1);
					let type;
					let txt;
					if(msj == 'O'){
						type = 'success';
						txt = 'El '+ tabla +' ha sido guardado con éxito.';
					}
					else if(msj == 'E'){
						type= 'warning';
						txt = 'Ya existe un Registro grabado con el mismo Nombre.';
					}
					else if(msj == 'D'){
						type= 'error';
						txt ='Error Desconocido.';
					}
					else{
						type= 'error';
						txt = 'Lo sentimos, el registro falló. Por favor, regrese y vuelva a intentarlo.'+ datos;
					}
					swal({
						position: 'top-end',
						type: ''+ type,
						title: ''+ txt,
						showConfirmButton: true,
						timer: 5000
					});
					setTimeout(function() {
						load(1);
						location.reload();
					}, 3000);
				}
			});
			event.preventDefault();
		});
		
		$( "#delete_user" ).submit(function( event ) {
			var parametros = $(this).serialize();
			$.ajax({
				type: "POST",
				url: "ajax/"+ tabla +"/delete.php",
				data: parametros,
				beforeSend: function(objeto){
					$("#resultados").html("Enviando...");
				},
				success: function(datos){
					$("#resultados").html(datos);
					//load(1);location.reload();
					$('#deleteUserModal').modal('hide');
					let msj = datos.substr(0,1);
					let type;
					let txt;
					if(msj == 'B'){
						type = 'success';
						txt = 'El '+ tabla +' ha sido eliminado con éxito';
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
						type: ''+ type,
						title: ''+ txt,
						showConfirmButton: true,
						timer: 5000
					});
					setTimeout(function() {
						load(1);
						location.reload();
					}, 3000);
				}
			});
			event.preventDefault();
		});