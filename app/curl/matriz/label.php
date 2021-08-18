<?php
/*********************************************
Author: Mauricio Sanchez Sierra
Date: 2021-07-30
Description:  Programa para actualizar los labels
              en la Matriz de Control
**********************************************/
// Customer Key
if( isset($_POST["ck"]) && $_POST["ck"] != "" ){
    $CustomerKey= trim($_POST["ck"]);
}
else{
    $CustomerKey=$CustomerKey;
}

// User Key
if( isset($_POST["uk"]) && $_POST["uk"] > 0 ){
    $UserKey = trim($_POST["uk"]);
}

// Número del Evento de Riesgo
if( isset($_POST["er"]) && $_POST["er"] > 0 ){
    $er = trim($_POST["er"]);
}
else {
    $er = 0;
}

// Número del control
if( isset($_POST['nrocontrol']) && $_POST['nrocontrol'] > 0){
    $nrocontrol = trim($_POST['nrocontrol']);
}
else{
    $nrocontrol = 0;
}
//echo "nrocontrol...$nrocontrol<br>";

// Nro del Registro de Matriz Control que se está trabajando
$IdMovimientoMRC = $nrocontrol;

// Ruta del archivo de conexion
if( isset($_POST["ruta"]) && $_POST["ruta"] != "" ){
    $ruta=$_POST["ruta"];
}
else{
    $ruta="";
}

require_once $ruta.'../config/dbx.php';
$getUrl = new Database();
$urlServicios = $getUrl->getUrl();
if(function_exists('curl_init')) // Comprobamos si hay soporte para cURL
{
    $url = $urlServicios."api/matriz/label.php?ck=".$CustomerKey."&er=".$er."&nreg=".$nrocontrol;   // Esto es para pintar las matriz
	//echo "url label...$url<br>";
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
	$datalabel = json_decode($mestado, true);

	$json_errors = array(
		JSON_ERROR_NONE => 'No se ha producido ningún error',
		JSON_ERROR_DEPTH => 'Maxima profundidad de pila ha sido excedida',
		JSON_ERROR_CTRL_CHAR => 'Error de carácter de control, posiblemente codificado incorrectamente',
		JSON_ERROR_SYNTAX => 'Error de Sintaxis',
	);
    foreach($datalabel as $key => $row) {}
	
	if( $key == "message")
	{
		echo $datalabel["message"];
	}
	else
	{
        if( $datalabel["itemCount"] > 0)
		{
			echo json_encode($datalabel,true);
		}
    }
}
?>