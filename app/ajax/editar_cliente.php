<?php

	if (empty($_POST['edit_id'])){
		$errors[] = "ID está vacío.";
	} elseif (!empty($_POST['edit_id'])){
	require_once ("../components/sql_server_login.php");
	// escaping, additionally removing everything that could be (html/javascript-) code
    $CustomerCity = $_POST["edit_city"];
    $CustomerName = $_POST["edit_name"];
	$CustomerNit = $_POST["edit_nit"];
	$CustomerColor = $_POST["edit_color"];
	
	$id=intval($_POST['edit_id']);
	// UPDATE data into database
    $sql = "UPDATE CustomerSarlaft SET CustomerCity='".$CustomerCity."', CustomerName='".$CustomerName."', CustomerNit='".$CustomerNit."', CustomerColor='".$CustomerColor."' WHERE id='".$id."' ";
    $query = sqlsrv_query($con,$sql);
    // if product has been added successfully
    if ($query) {
        $messages[] = "El Cliente ha sido actualizado con éxito.";
    } else {
        $errors[] = "Lo sentimos, la actualización falló. Por favor, regrese y vuelva a intentarlo.";
    }
		
	} else 
	{
		$errors[] = "desconocido.";
	}
if (isset($errors)){
			
			?>
			<div class="alert alert-danger" role="alert">
				<button type="button" class="close" data-dismiss="alert">&times;</button>
					<strong>Error!</strong> 
					<?php
						foreach ($errors as $error) {
								echo $error;
							}
						?>
			</div>
			<?php
			}
			if (isset($messages)){
				
				?>
				<div class="alert alert-success" role="alert">
						<button type="button" class="close" data-dismiss="alert">&times;</button>
						<strong>¡Bien hecho!</strong>
						<?php
							foreach ($messages as $message) {
									echo $message;
								}
							?>
				</div>
				<?php
			}
?>			