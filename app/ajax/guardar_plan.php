<?php
include('is_logged.php');//Archivo verifica que el usario que intenta acceder a la URL esta logueado
	if (empty($_POST['PlanesName2'])){
		$errors[] = "Ingresa el nombre del plan.";
	} elseif (!empty($_POST['PlanesName2'])){
	require_once ("../components/sql_server.php");
	// escaping, additionally removing everything that could be (html/javascript-) code
							
							$PlanesName=$_POST['PlanesName2'];
							$PlanesResponsable=$_POST['PlanesResponsable2'];
							$PlanesTarea=$_POST['PlanesTarea2'];
							$PlanesAprueba=$_POST['PlanesAprueba2'];
							$PlanesPlazo=$_POST['PlanesPlazo2'];
							$PlanesNivelPrioridad=$_POST['PlanesNivelPrioridad2'];	
							$PlanesRespSeguimiento=$_POST['PlanesRespSeguimiento2'];
							$PlanesRespAprobacion=$_POST['PlanesRespAprobacion2'];
							$PlanesFInicio=$_POST['PlanesFInicio2'];
							$PlanesFSeguimiento=$_POST['PlanesFSeguimiento2'];
							$PlanesFTerminacion=$_POST['PlanesFTerminacion2'];
							$PlanesAvance=$_POST['PlanesAvance2'];
							$PlanesStatus='1';
							date_default_timezone_set("America/Bogota");
							$PlanesKey=time();
							$CustomerKey=$_POST['CustomerKey']; //$_SESSION['Keyp'];
							$UserKey=$_SESSION['UserKey'];
							$DateStamp=date("Y-m-d H:i:s");

		$sql="INSERT INTO PlanesSarlaft (PlanesKey, PlanesName ,PlanesResponsable , PlanesTarea , PlanesPlazo , PlanesAprueba , PlanesNivelPrioridad, PlanesRespSeguimiento , PlanesRespAprobacion , PlanesFInicio , PlanesFSeguimiento , PlanesFTerminacion , PlanesAvance , PlanesStatus, UserKey, DateStamp, CustomerKey) VALUES ('".$PlanesKey."','".$PlanesName."','".$PlanesResponsable."','".$PlanesTarea."','".$PlanesPlazo."','".$PlanesAprueba."','".$PlanesNivelPrioridad."','".$PlanesRespSeguimiento."','".$PlanesRespAprobacion."','".$PlanesFInicio."','".$PlanesFSeguimiento."','".$PlanesFTerminacion."','".$PlanesAvance."','".$PlanesStatus."','".$UserKey."','".$DateStamp."','".$CustomerKey."')";
    $query = sqlsrv_query($conn,$sql);
    // if product has been added successfully
    if ($query) {
        $messages[] = "El Plan ha sido guardado con éxito.";
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