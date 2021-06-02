<?php
include('is_logged.php');//Archivo verifica que el usario que intenta acceder a la URL esta logueado
	if (empty($_POST['new_key'])){
		$errors[] = "Codigo está vacío.";
	} elseif (!empty($_POST['new_key'])){
	require_once ("../components/sql_server.php");
	// escaping, additionally removing everything that could be (html/javascript-) code
							$id=$_POST['new_id'];						
							$PlanesName=$_POST['new_name'];
							$PlanesResponsable=$_POST['new_responsable'];
							$PlanesTarea=$_POST['PlanesTarea2'];
							$PlanesAprueba=$_POST['new_aprueba'];
							$PlanesPlazo=$_POST['new_plazo'];
							$PlanesNivelPrioridad=$_POST['new_nivelp'];	
							$PlanesRespSeguimiento=$_POST['new_resps'];
							$PlanesRespAprobacion=$_POST['new_respa'];
							$PlanesFInicio=$_POST['new_inicio'];
							$PlanesFSeguimiento=$_POST['new_fseg'];
							$PlanesFTerminacion=$_POST['new_termina'];
							$PlanesAvance=$_POST['new_avance'];
							$PlanesKey=$_POST['new_id'];
							$PlanesStatus='1';
							date_default_timezone_set("America/Bogota");
							$UserKey=$_SESSION['UserKey'];
							$DateStamp=date("Y-m-d H:i:s");							

		$sql="INSERT INTO PlanesSarlaft (PlanesKey, PlanesName ,PlanesResponsable , PlanesTarea , PlanesPlazo , PlanesAprueba , PlanesNivelPrioridad,PlanesRespSeguimiento , PlanesRespAprobacion , PlanesFInicio , PlanesFSeguimiento , PlanesFTerminacion , PlanesAvance , PlanesStatus, UserKey, DateStamp) VALUES ('".$PlanesKey."','".$PlanesName."','".$PlanesResponsable."','".$PlanesTarea."','".$PlanesPlazo."','".$PlanesAprueba."','".$PlanesNivelPrioridad."','".$PlanesRespSeguimiento."','".$PlanesRespAprobacion."','".$PlanesFInicio."','".$PlanesFSeguimiento."','".$PlanesFTerminacion."','".$PlanesAvance."','".$PlanesStatus."','".$UserKey."','".$DateStamp."')";
    $query = sqlsrv_query($conn,$sql);
    // if product has been added successfully
    if ($query) {
        $messages[] = "La tarea ha sido adicionada correctamente";
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