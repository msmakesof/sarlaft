<?php
include '../is_logged.php';
if (empty($_POST['eid'])){
	$errors[] = "ID está vacío.";
} 
elseif (!empty($_POST['eid']))
{	
	$ck = trim($_SESSION['Keyp']);
	require_once '../../config/dbx.php';
	$getUrl = new Database();
	$urlServicios = $getUrl->getUrl();
	
	// escaping, additionally removing everything that could be (html/javascript-) code
	$nombre = ($_POST["eName2"]);
	//$nombre = str_replace(' ','%20',strtoupper($nombre));
	$responsable = trim($_POST["eresponsable"]);
	$plazo = trim($_POST["eplazo"]);
	$aprueba = trim($_POST["eaprueba"]);	
	$nivelprioridad = trim($_POST["enivelprioridad"]);
	$respseguimiento = trim($_POST["erespseguimiento"]);
	$respaprobacion = trim($_POST["erespaprobacion"]);
	$fechainicio = trim($_POST["efechainicio"]);
	$fechaseguimiento = trim($_POST["efechaseguimiento"]);
	$fechaterminacion = trim($_POST["efechaterminacion"]);
	$avance = trim($_POST["eavance"]);	
	$id=intval($_POST['eid']);
	
	$query = "";
	$resultado = "";
	$msjx = "";
	// Se verifica si el nombre existe para evitar duplicados.
	$url = $urlServicios."api/planes/revisarnombre.php?nombre=$nombre&ck=$ck&id=$id";
	
	$ch = curl_init();
	curl_setopt($ch, CURLOPT_VERBOSE, true);
	curl_setopt($ch, CURLOPT_URL, $url);
	curl_setopt($ch, CURLOPT_TIMEOUT, 30);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
	curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
	curl_setopt($ch, CURLOPT_POST, 0);
	$resultado = curl_exec ($ch);
	curl_close($ch);
	
	$mestado =  preg_replace('/[\x00-\x1F\x80-\xFF]/', '', $resultado);    
	$query = json_decode($mestado, true);
	$json_errors = array(
		JSON_ERROR_NONE => 'No se ha producido ningún error',
		JSON_ERROR_DEPTH => 'Maxima profundidad de pila ha sido excedida',
		JSON_ERROR_CTRL_CHAR => 'Error de carácter de control, posiblemente codificado incorrectamente',
		JSON_ERROR_SYNTAX => 'Error de Sintaxis',
	);
	
	$contar = $query["encontrados"];
	if($contar == ''){ $contar = 0;}
	
	if( $contar > 0)
	{			
		$messages[] = "E"; //'Ya existe un Registro grabado con el mismo Nombre.' ;
	}
	else
	{		
		$query="";		
		// Si todo va bien se hace el Update
		//$params = "Nombre=$nombre&responsable=$responsable&plazo=$plazo&aprueba=$aprueba&respseguimiento=$respseguimiento&nivelprioridad=$nivelprioridad&respaprobacion=$respaprobacion&fechainicio=$fechainicio&fechaseguimiento=$fechaseguimiento&fechaterminacion=$fechaterminacion&avance=$avance&Id=$id";
		//$url = $urlServicios."api/planes/update.php?$params";

		$getConnectionCli2 = new Database();
		$conn = $getConnectionCli2->getConnectionCli2($ck);
		
		$sqlQuery = "UPDATE PlanesSarlaft SET 
					PlanesName = '". htmlspecialchars(strip_tags($nombre)) ."',
					PlanesResponsable = '". htmlspecialchars(strip_tags($responsable)) ."',
					PlanesPlazo = '". htmlspecialchars(strip_tags($plazo)) ."',
					PlanesAprueba = '". htmlspecialchars(strip_tags($aprueba)) ."',
					PlanesNivelPrioridad = '". htmlspecialchars(strip_tags($nivelprioridad)) ."',
					PlanesRespSeguimiento = '". htmlspecialchars(strip_tags($respseguimiento)) ."',
					PlanesRespAprobacion = '". htmlspecialchars(strip_tags($respaprobacion)) ."',
					PlanesFInicio = '". htmlspecialchars(strip_tags($fechainicio)) ."',
					PlanesFSeguimiento = '". htmlspecialchars(strip_tags($fechaseguimiento)) ."',
					PlanesFTerminacion = '". htmlspecialchars(strip_tags($fechaterminacion)) ."',
					PlanesAvance = '". htmlspecialchars(strip_tags($avance)) ."'
                    WHERE id = $id ";
		$query = sqlsrv_query($conn,$sqlQuery);		
		
		// if plan has been updated successfully
		if ($query) {
			$messages[] = "U"; //Update.";
		} else {
			$errors[] = "R"; //Error falla en la conexión.";
		}
	}
} 
else 
{
	$errors[] = "D"; //desconocido.";
}
			
if (isset($errors)){
	foreach ($errors as $error) {
		$msjx = $error; 
	}
}
if (isset($messages)){	
	foreach ($messages as $message) {
		$msjx =$message; 
	}
}	
echo $msjx;
?>			