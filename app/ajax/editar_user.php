<?php

	if (empty($_POST['edit_id'])){
		$errors[] = "ID está vacío.";
	} elseif (!empty($_POST['edit_id'])){
	require_once ("../components/sql_server_login.php");
	// escaping, additionally removing everything that could be (html/javascript-) code
    $UserName = $_POST["edit_name"];
    $UserEmail = $_POST["edit_email"];
    $Password = $_POST["edit_pass"];
    $id=intval($_POST['edit_id']);
	// UPDATE data into database
    $sql = "UPDATE UsersAuth SET UserName='".$UserName."', UserEmail='".$UserEmail."', Password='".$Password."' WHERE id='".$id."' ";
    $query = sqlsrv_query($con,$sql);
    // if product has been added successfully
    if ($query) {
        $messages[] = "El Usuario ha sido actualizado con éxito.";
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