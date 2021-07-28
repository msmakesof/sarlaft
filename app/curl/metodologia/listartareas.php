<?php
//**************************************************
//   Nro de Tareas por cada Plan
//**************************************************
//include 'ajax/is_logged.php';
// mks 20210516  verificar cUrl
require_once '../config/dbx.php';
$getUrl = new Database();
$urlServicios = $getUrl->getUrl();
if(function_exists('curl_init')) // Comprobamos si hay soporte para cURL
{	
	$url = $urlServicios."api/planes/listar_nro_tareas.php?id=$PlanesId&ck=$CustomerKey";  //.$_POST['id'];   //?$params";
	echo "url...$url<br>";
	
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
	$datatar = json_decode($mestado, true);	
	
	$json_errors = array(
		JSON_ERROR_NONE => 'No se ha prducido ningún error',
		JSON_ERROR_DEPTH => 'Maxima profundidad de pila ha sido excedida',
		JSON_ERROR_CTRL_CHAR => 'Error de carácter de control, posiblemente codificado incorrectamente',
		JSON_ERROR_SYNTAX => 'Error de Sintaxis',
	);
	
	$nrotareas = 0;
	foreach($datatar as $key => $row) {}
	if( $key == "message")
	{
		$nrotareas = $datatar["message"];
	}
	else
	{		
		for($i=0; $i<count($datatar['body']); $i++)
		{
			$nrotareas = $datatar['body'][$i]["TotalTareas"];
		}
	}	
	echo $nrotareas;  //return $datatar;
}
?>