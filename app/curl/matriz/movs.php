<?php
if( isset($_POST["ck"]) && $_POST["ck"] != "" ){
	$CustomerKey=$_POST["ck"];
}

if( isset($_POST["er"]) && $_POST["er"] != "" ){
	$EventoRiesgo=$_POST["er"];
}

if( isset($_POST["ruta"]) && $_POST["ruta"] != "" ){
	$ruta=$_POST["ruta"];
}
else {
	$ruta='';
}
require_once $ruta.'../config/dbx.php';
$getUrl = new Database();
$urlServicios = $getUrl->getUrl();
if(function_exists('curl_init')) // Comprobamos si hay soporte para cURL
{	
    $url = $urlServicios."api/matriz/movmatriz.php?ck=".trim($CustomerKey)."&er=".trim($EventoRiesgo);
	//echo "url movs...$url<br>";
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
	$datamat = json_decode($mestado, true);	
	
	$json_errors = array(
		JSON_ERROR_NONE => 'No se ha producido ningún error',
		JSON_ERROR_DEPTH => 'Maxima profundidad de pila ha sido excedida',
		JSON_ERROR_CTRL_CHAR => 'Error de carácter de control, posiblemente codificado incorrectamente',
		JSON_ERROR_SYNTAX => 'Error de Sintaxis',
	);
	
	foreach($datamat as $key => $row) {}
	
	if( $key == "message")
	{
		echo 'nd';
	}
	else{
		if( $datamat["itemCount"] > 0)
		{
			echo json_encode($datamat,true);
		}
	}
}
?>