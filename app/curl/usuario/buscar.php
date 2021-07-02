<?php
//include 'ajax/is_logged.php';
// mks 20210516  verificar cUrl
require_once 'app/config/dbx.php';
$getUrl = new Database();
$urlServicios = $getUrl->getUrl();
if(function_exists('curl_init')) // Comprobamos si hay soporte para cURL
{
	$email = trim($email); 
	$passw = trim($password);
	$cantidad = 0;
	$Password = "";

	//require_once 'app/ajax/usuario/gateway.php';
	require_once 'app/gateway.php';
	$clave = encryptor('encrypt', $passw);

	$url = $urlServicios."api/usuario/buscar.php?email=$email&passw=$clave";
	//echo  $url;
	$resultado = "";
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
	$dataUsuarioEmail = json_decode($mestado, true);
	$json_errors = array(
		JSON_ERROR_NONE => 'No se ha producido ningún error',
		JSON_ERROR_DEPTH => 'Maxima profundidad de pila ha sido excedida',
		JSON_ERROR_CTRL_CHAR => 'Error de carácter de control, posiblemente codificado incorrectamente',
		JSON_ERROR_SYNTAX => 'Error de Sintaxis',
	);
	foreach($dataUsuarioEmail as $key => $row) {}
	if( $key == "message"){	// Email No existe
		$cantidad = 0;
	}
	else
	{
		// Existe email
		if( $dataUsuarioEmail["itemCount"] > 0)
		{			
			for($i=0; $i<count($dataUsuarioEmail['body']); $i++)
			{
			  $_SESSION["UserKey"] =     trim($dataUsuarioEmail['body'][$i]['UserKey']);
			  $_SESSION["CustomerKey"] = trim($dataUsuarioEmail['body'][$i]["CustomerKey"]);
			  $_SESSION["UserEmail"] =   trim($dataUsuarioEmail['body'][$i]["UserEmail"]);
			  $_SESSION["UserName"] =    trim($dataUsuarioEmail['body'][$i]["UserName"]);
			  $_SESSION["UserTipo"] =    trim($dataUsuarioEmail['body'][$i]["UserTipo"]);
			  $_SESSION["UserStatus"] =  trim($dataUsuarioEmail['body'][$i]["UserStatus"]);
			}
			$cantidad = 1;			
		}
	}	
}
?>