
<?php require_once 'components/sql_server_login.php';?>
<?php
          
<!DOCTYPE html>
<html lang="es">

<?php include 'components/header.php';?>

<body>

			<div class="modal-content">
				<form method="post" action="clientes.php">
					<div class="modal-header">						
						<h4 class="modal-title">Editar Color</h4>
						<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
					</div>
					<div class="modal-body">					

						<?php $id=$_GET['id'];
							$sql=sqlsrv_query($con,"SELECT CustomerColor FROM CustomerSarlaft WHERE id='$id'");
							 while($row = sqlsrv_fetch_array($sql))
								if($id!=NULL){ ?>


				<div class="form-group">
					<form method="post" id="perfil">
						<input type="color" name="CustomerColor" id="CustomerColor" value="<?php echo $row['CustomerColor'];?>" class="form-control" required>
						
					</form>
				</div>	

						<?php } ?>				
					</div>
					<div class="modal-footer">
					<form method="post" action="Clientes">
						<input type="submit" class="btn btn-info" value="Actualizar">
					</form>
					</div>
				</form>
			</div>

 </body>
</html>

	<script type="text/javascript" src="js/bootstrap-filestyle.js"> </script>
	<script>
		function upload_image(){
				
				var inputFileImage = document.getElementById("imagefile");
				var file = inputFileImage.files[0];
				if( (typeof file === "object") && (file !== null) )
				{
					$("#load_img").text('Cargando...');	
					var data = new FormData();
					data.append('imagefile',file);
					$.ajax({
						url: "ajax/imagen_ajax_color.php?id=<?php echo $_GET['id'];?>",        // Url to which the request is send
						type: "POST",             // Type of request to be send, called as method
						data: data, 			  // Data sent to server, a set of key/value pairs (i.e. form fields and values)
						contentType: false,       // The content type used when sending data to the server.
						cache: false,             // To unable request pages to be cached
						processData:false,        // To send DOMDocument or non processed data file it is set to false
						success: function(data)   // A function to be called if request succeeds
						{
							$("#load_img").html(data);
							
						}
					});	
				}
				
				
			}
    </script>

