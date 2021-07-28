<?php
if (empty($_POST['eid'])){
	$errors[] = "ID está vacío.";
} 
elseif (!empty($_POST['eid']))
{	
	require_once '../../config/dbx.php';
	$getUrl = new Database();
	$urlServicios = $getUrl->getUrl();
	
	// escaping, additionally removing everything that could be (html/javascript-) code
	$nombre = trim($_POST["eMetodologiaName2"]);
	$nombre = str_replace(' ','%20',strtoupper($nombre));
	$factorriesgo = trim($_POST["efactorriesgo"]);
	$factorriesgo = str_replace(' ','%20',strtoupper($factorriesgo));
	$descripcion = trim($_POST["edescripcion"]);
	$descripcion = str_replace(' ','%20',strtoupper($descripcion));
	$observaciones = trim($_POST["eobservaciones"]);
	$observaciones = str_replace(' ','%20',strtoupper($observaciones));	
	$id=intval($_POST['eid']);
	
	$query = "";
	$resultado = "";
	$msjx = "";
	// Se verifica si el nombre existe para evitar duplicados.
	$url = $urlServicios."api/metodologia/revisarnombre.php?nombre=$nombre&id=$id";
	
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
		//$messages[] = "E"; //'Ya existe un Registro grabado con el mismo Nombre.' ;
		$msjx = "E";
	}
	else
	{		
		$query="";		
		// Si todo va bien se hace el Update
		$params = "Nombre=$nombre&FactorRiesgo=$factorriesgo&Descripcion=$descripcion&Observaciones=$observaciones&Id=$id";
		$url = $urlServicios."api/metodologia/update.php?$params";
		//echo "upd...$url";
		
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
		
		// if rol has been updated successfully
		if ($query) {
			//$messages[] = "U"; //Update.";
			$msjx = "U";
		} else {
			//$errors[] = "R"; //Error falla en la conexión.";
			$msjx = "F";
		}
	}
} 
else 
{
	//$errors[] = "D"; //desconocido.";
	$msjx = "D";
}
/*			
if (isset($errors)){
	foreach ($errors as $error) {
		$msjx = $error; 
	}
}
if (isset($messages)){	
	foreach ($messages as $message) {
		$msjx =$message; 
	}
} */	
echo $msjx;
?>			