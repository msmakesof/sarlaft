<?php

	if (empty($_POST['delete_id'])){
		$errors[] = "Id vacío.";
	} elseif (!empty($_POST['delete_id'])){
		
	require_once ("../components/sql_server_login.php");
	// escaping, additionally removing everything that could be (html/javascript-) code
    $id=intval($_POST['delete_id']);
    $querys=sqlsrv_query($con,"SELECT CustomerDB FROM CustomerSarlaft WHERE id='$id'");
    $reg=sqlsrv_fetch_array($querys);
    $CustomerDB=$reg['CustomerDB'];

		$sqls = "DROP DATABASE E".$CustomerDB."";
		$query = sqlsrv_query($con,$sqls);    
     
	// DELETE FROM  database
    $sql = "DELETE FROM  CustomerSarlaft WHERE id='$id'";
    $query = sqlsrv_query($con,$sql);
    
    // if product has been added successfully
    if ($query) {
        $messages[] = "El cliente ha sido eliminado con éxito.";
    } else {
        $errors[] = "Lo sentimos, la eliminación falló. Por favor, regrese y vuelva a intentarlo.";
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