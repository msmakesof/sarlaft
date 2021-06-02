<?php
include 'ajax/is_logged.php';
// mks 20210516  verificar cUrl
require_once './config/dbx.php';
$getUrl = new Database();
//$getConnection = new Database();
$urlServicios = $getUrl->getUrl();
$conex = $getUrl->getConnection();
$urlServicios = "http://localhost:8090/app/";
if(function_exists('curl_init')) // Comprobamos si hay soporte para cURL
{
	$url = $urlServicios."api/usuario/queryUserKey.php?userkey=".$_SESSION['UserKey'];
	echo "url...$url<br>"; 
	//echo "conn.....$conex";
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
	$data = json_decode($mestado, true);	
	
	$json_errors = array(
		JSON_ERROR_NONE => 'No se ha producido ningún error',
		JSON_ERROR_DEPTH => 'Maxima profundidad de pila ha sido excedida',
		JSON_ERROR_CTRL_CHAR => 'Error de carácter de control, posiblemente codificado incorrectamente',
		JSON_ERROR_SYNTAX => 'Error de Sintaxis',
	);

    foreach($data as $key => $row) {}
    if( $key == "message")
	{
    }
    else
	{
		if( $data["itemCount"] > 0)
		{
            // cargamos la info
            $info = "";
            for($i=0; $i<count($data['body']); $i++)
			{
                $id = $data['body'][$i]['id'];
                $CustomerKey = $data['body'][$i]['CustomerKey'];
                $info .= $CustomerKey."<br>";
            }
            return $info;
        }
    }




}
?>