<?php
include('is_logged.php');//Archivo verifica que el usario que intenta acceder a la URL esta logueado
	if (empty($_POST['OportunidadesName2'])){
		$errors[] = "Ingresa el nombre de la Oportunidad.";
	} elseif (!empty($_POST['OportunidadesName2'])){
	require_once ("../components/sql_server.php");
	// escaping, additionally removing everything that could be (html/javascript-) code
		$OportunidadesName=$_POST["OportunidadesName2"];
		date_default_timezone_set("America/Bogota");
		$CustomerKey=$_SESSION['Keyp'];
		$OportunidadesKey=time();
		$UserKey=$_SESSION['UserKey'];
		$DateStamp=date("Y-m-d H:i:s");
		$sql="INSERT INTO OportunidadesSarlaft (CustomerKey, UserKey, DateStamp, OportunidadesName, OportunidadesKey) VALUES ('".$CustomerKey."','".$UserKey."','".$DateStamp."','".$OportunidadesName."','".$OportunidadesKey."')";
    $query = sqlsrv_query($conn,$sql);
    // if product has been added successfully
    if ($query) {
        $messages[] = "Ha sido guardado con éxito.";
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