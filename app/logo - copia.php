<?php include 'ajax/is_logged.php';?>
<?php require_once 'components/sql_server_login.php';?>
        
<!DOCTYPE html>
<html lang="es">

<?php 
echo "Hola Logo";
include 'components/header.php';
?>

<body>

			<div class="modal-content">
				<form method="post" action="clientes.php">
					<div class="modal-header">						
						<h4 class="modal-title">Editar Logo</h4>
						<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
					</div>
					<div class="modal-body">					

						<div id="load_img" >
						<?php $id=$_POST['id'];
							$sql=sqlsrv_query($con,"SELECT CustomerLogo FROM CustomerSarlaft WHERE id='$id'");
							 while($row = sqlsrv_fetch_array($sql))
								if($id!=NULL){ ?>
									<img class="img-responsive" src="./img/<?php echo $row['CustomerLogo'];?>" alt="Logo">
						<?php } ?>
						</div>
				<div class="form-group">
					<form method="post" id="perfil">
						<input class='form-control' data-buttonText="Logo" type="file" name="imagefile" id="imagefile" onChange="upload_image();">
					</form>
				</div>	
					</div>
					<div class="modal-footer">
					<form method="post" action="clientes.php">
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
						url: "ajax/imagen_ajax.php?id=<?php echo $_POST['id'];?>",        // Url to which the request is send
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

