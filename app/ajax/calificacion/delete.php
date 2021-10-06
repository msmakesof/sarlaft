<?php
if (empty($_POST['delete_id'])){
	$errors[] = "Id vacío.";
} 
elseif (!empty($_POST['delete_id']))
{
	require_once '../../config/dbx.php';
	$getUrl = new Database();
	$urlServicios = $getUrl->getUrl();
	
	$id=intval($_POST['delete_id']);
	$query="";
	$msjx = "";
	$url = $urlServicios."api/calificacion/delete.php?id=$id";
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

	// if product has been added successfully
	if ($query) {
		$messages[] = "B"; //"Borrar";
	} else {
		$errors[] = "R"; //Error de conexión.";
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