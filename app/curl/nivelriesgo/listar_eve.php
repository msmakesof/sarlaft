<?php
//include 'ajax/is_logged.php';
// mks 20210516  verificar cUrl
require_once '../config/dbx.php';
$getUrl = new Database();
$urlServicios = $getUrl->getUrl();
if(function_exists('curl_init')) // Comprobamos si hay soporte para cURL
{
	$url = $urlServicios."api/nivelriesgo/lista_eve.php?ck=$CustomerKey";
	//echo "url...$url<br>";
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
	$datanr = json_decode($mestado, true);	
	
	$json_errors = array(
		JSON_ERROR_NONE => 'No se ha producido ningún error',
		JSON_ERROR_DEPTH => 'Maxima profundidad de pila ha sido excedida',
		JSON_ERROR_CTRL_CHAR => 'Error de carácter de control, posiblemente codificado incorrectamente',
		JSON_ERROR_SYNTAX => 'Error de Sintaxis',
	);
	foreach($datanr as $key => $row) {}
	
	if( $key == "message")
	{
		echo $datanr["message"];
	}
	else
	{		
		/// Para pintar Tipo Riesgo   <i class='fas fa-plus-circle' id='itr' style='cursor: pointer'></i>
		if( $datanr["itemCount"] > 0)
		{			
			$IdItem = "";
			$sel_nr="<select id='s".$id."' class='color' onchange='selx($pid)'>";
			$sel_nr.="<option value=''>Seleccione opción</option>";			
			for($i=0; $i<count($datanr['body']); $i++)
			{				
				$condi = "";
				$id = $datanr['body'][$i]["NIR_IdNivelRiesgo"];
				$nombre = trim($datanr['body'][$i]["NIR_Nombre"]);
				$color = trim($datanr['body'][$i]["NIR_Color"]);
				if( isset($IdItem) && $IdItem != "" && $id == $IdItem ){
					$condi = ' selected="selected" ';
				}
				$sel_nr.= '<option value="'. $id .'"'. $condi .' style="color:$color">'. $color .'</option>';
			}
			$sel_nr.= '</select>';				
		}
	}
}
?>