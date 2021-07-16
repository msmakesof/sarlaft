<?php
//include 'ajax/is_logged.php';
// mks 20210516  verificar cUrl
require_once '../config/dbx.php';
$getUrl = new Database();
$urlServicios = $getUrl->getUrl();
if(function_exists('curl_init')) // Comprobamos si hay soporte para cURL
{
	$url = $urlServicios."api/cargos/lista.php?ck=$CustomerKey";
	////echo "url...$url<br>";
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
		echo '<option value="">'. $data["message"] .'</option>';
	}
	else
	{
		if( $data["itemCount"] > 0)
		{			
			for($i=0; $i<count($data['body']); $i++)
			{				
				$condi = "";
				$id = $data['body'][$i]["CargosId"];
				$nombre = trim($data['body'][$i]["CargosName"]);
				if( isset($ResponsableAprueba) && $ResponsableAprueba != "" && $id == $ResponsableAprueba ){
					$condi = ' selected="selected" ';
				}
				echo '<option value="'. $id .'"'. $condi .'>'. $nombre .'</option>';
			}
		}		
	}
}
?>