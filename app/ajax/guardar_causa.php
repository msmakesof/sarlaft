<?php
include('is_logged.php');//Archivo verifica que el usario que intenta acceder a la URL esta logueado
	if (empty($_POST['CausasName2'])){
		$errors[] = "Ingresa el nombre del Causa.";
	} elseif (!empty($_POST['CausasName2'])){
	require_once ("../components/sql_server.php");
	// escaping, additionally removing everything that could be (html/javascript-) code
		$CausasName=$_POST["CausasName2"];
		date_default_timezone_set("America/Bogota");
		$CustomerKey=$_SESSION['Keyp'];
		$CausasKey=time();
		$UserKey=$_SESSION['UserKey'];
		$DateStamp=date("Y-m-d H:i:s");
		$sql="INSERT INTO CausasSarlaft (CustomerKey, UserKey, DateStamp, CausasName, CausasKey) VALUES ('".$CustomerKey."','".$UserKey."','".$DateStamp."','".$CausasName."','".$CausasKey."')";
    $query = sqlsrv_query($conn,$sql);
    // if product has been added successfully
    if ($query) {
        $messages[] = "El Causa ha sido guardado con éxito.";
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