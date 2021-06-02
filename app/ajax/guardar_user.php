<?php
//Archivo verifica que el usario que intenta acceder a la URL esta logueado
	if (empty($_POST['UserName2'])){
		$errors[] = "Ingresa el nombre del Usuario.";
	} elseif (!empty($_POST['UserName2'])){
	require_once ("../components/sql_server_login.php");
	// escaping, additionally removing everything that could be (html/javascript-) code
		$UserName=$_POST["UserName2"];
		$UserEmail=$_POST["UserEmail2"];
		$Password=$_POST["Password2"];
		$CustomerKey=$_POST["CustomerKey2"];
		$UserColor='#1f77b4';
		$UserStatus='1';
		$UserTipo='A';
		date_default_timezone_set("America/Bogota");
		$UserKey=time();

		$Salt=date("Y-m-d H:i:s");
		$sql="INSERT INTO UsersAuth (CustomerKey, UserKey, UserEmail, UserName, UserTipo, UserStatus, Password, Salt, UserColor) VALUES ('".$CustomerKey."','".$UserKey."','".$UserEmail."','".$UserName."','".$UserTipo."','".$UserStatus."','".$Password."','".$Salt."','".$UserColor."')";
    $query = sqlsrv_query($con,$sql);
    // if product has been added successfully
    if ($query) {
        $messages[] = "El usuario ha sido guardado con éxito.";
    } else {
        $errors[] = "Lo sentimos, el registro falló. Por favor, regrese y vuelva a intentarlo.";
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