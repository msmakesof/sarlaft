<?php
include '../is_logged.php';
if (empty($_POST['edit_id'])){
	$errors[] = "ID está vacío.";
} 
elseif (!empty($_POST['edit_id']))
{	
	require_once '../../config/dbx.php';
	$getUrl = new Database();
	$urlServicios = $getUrl->getUrl();
	
	// escaping, additionally removing everything that could be (html/javascript-) code
	$nombre = trim($_POST["eActividadEconomica"]);
	//$nombre = str_replace(' ','%20',strtoupper($nombre));
	$ObjetoSocial = $_POST["eObjetoSocial"];
	$DescripcionGeneral = $_POST["eDescripcionGeneral"];
	$ObjetivosEstrategicos = $_POST["eObjetivosEstrategicos"];
	$Mision = $_POST["eMision"];
	$Vision = $_POST["eVision"];
	
	$id=intval($_POST['edit_id']);
	
	$query = "";
	$resultado = "";
	$msjx = "";
	// Se verifica si el nombre existe para evitar duplicados.
	$url = $urlServicios."api/infobasica/revisarnombre.php?nombre=$nombre&Mision=$Mision&Vision=$Vision&id=$id";
	
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
		/*
		// Si todo va bien se hace el Update
		$params = "NombreEstado=$estadonombre&Id=$id";
		$url = $urlServicios."api/estado/update.php?$params";
		//echo "url...$url";
		
		$resultado="";
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
		$query = $mestado; //json_decode($mestado, true);
		
		$json_errors = array(
			JSON_ERROR_NONE => 'No se ha producido ningún error',
			JSON_ERROR_DEPTH => 'Maxima profundidad de pila ha sido excedida',
			JSON_ERROR_CTRL_CHAR => 'Error de carácter de control, posiblemente codificado incorrectamente',
			JSON_ERROR_SYNTAX => 'Error de Sintaxis',
		);
		*/
		$getConnectionCli2 = new Database();
		$conn = $getConnectionCli2->getConnectionCli2($_SESSION['Keyp']);
		
		$sql = "UPDATE CLI_InfoBasica SET CLI_ActividadEconomica= '". htmlspecialchars(strip_tags($nombre)) ."', CLI_ObjetoSocial='". htmlspecialchars(strip_tags($ObjetoSocial)) ."', CLI_DescripcionGeneral= '". htmlspecialchars(strip_tags($DescripcionGeneral)) . "', CLI_Mision='". htmlspecialchars(strip_tags($Mision)) ."', CLI_Vision= '". htmlspecialchars(strip_tags($Vision)) ."', CLI_ObjetivosEstrategicos ='". htmlspecialchars(strip_tags($ObjetivosEstrategicos)) . "' WHERE CLI_IdInfoBasica = $id ";
		$query = sqlsrv_query($conn,$sql);
		
		// if CLI_InfoBasica has been updated successfully
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