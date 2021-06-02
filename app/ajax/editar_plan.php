<?php
include ('is_logged.php');
	if (empty($_POST['edit_id'])){
		$errors[] = "ID está vacío.";
	} elseif (!empty($_POST['edit_id'])){
	require_once ("../components/sql_server.php");
	// escaping, additionally removing everything that could be (html/javascript-) code
							$id=intval($_POST['edit_id']);						
							$PlanesName=$_POST['edit_name'];
							$PlanesResponsable=$_POST['edit_responsable'];
							$PlanesTarea=$_POST['edit_tarea'];
							$PlanesAprueba=$_POST['edit_aprueba'];
							$PlanesPlazo=$_POST['edit_plazo'];
							$PlanesNivelPrioridad=$_POST['edit_nivelp'];	
							$PlanesRespSeguimiento=$_POST['edit_resps'];
							$PlanesRespAprobacion=$_POST['edit_respa'];
							$PlanesFInicio=$_POST['edit_inicio'];
							$PlanesFSeguimiento=$_POST['edit_fseg'];
							$PlanesFTerminacion=$_POST['edit_termina'];
							$PlanesAvance=$_POST['edit_avance'];




	// UPDATE data into database
    $sql = "UPDATE PlanesSarlaft SET PlanesName='".$PlanesName."' ,PlanesResponsable='".$PlanesResponsable."' , PlanesTarea='".$PlanesTarea."' , PlanesPlazo='".$PlanesPlazo."' , PlanesAprueba='".$PlanesAprueba."' , PlanesNivelPrioridad='".$PlanesNivelPrioridad."', 
PlanesRespSeguimiento ='".$PlanesRespSeguimiento."', PlanesRespAprobacion ='".$PlanesRespAprobacion."', PlanesFInicio='".$PlanesFInicio."' , PlanesFSeguimiento ='".$PlanesFSeguimiento."', PlanesFTerminacion='".$PlanesFTerminacion."' , PlanesAvance='".$PlanesAvance."'  WHERE id='".$id."' ";
    $query = sqlsrv_query($conn,$sql);
    // if product has been added successfully
    if ($query) {
        $messages[] = "El Plan ha sido actualizado con éxito.";
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