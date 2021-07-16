<?php
$Cargos = $_POST['idcargos'];
//echo "state   ".$Estado;
require_once '../../config/dbx.php';
$getUrl = new Database();
$urlServicios = $getUrl->getUrl();		
$resultado = "";
$ck= $_POST['ck'];
$url = $urlServicios."api/cargos/lista.php?ck=$ck";
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
$xdata = json_decode($mestado, true);	

$json_errors = array(
	JSON_ERROR_NONE => 'No se ha producido ningún error',
	JSON_ERROR_DEPTH => 'Maxima profundidad de pila ha sido excedida',
	JSON_ERROR_CTRL_CHAR => 'Error de carácter de control, posiblemente codificado incorrectamente',
	JSON_ERROR_SYNTAX => 'Error de Sintaxis',
);
foreach($xdata as $key => $row) {}
	$xselect = '';
	$xselect .= '<option value="">Seleccione Opción</option>';
	if( $key == "message")
	{
		$select .= '<option value="">'. $xdata["message"] .'</option>';
	}
	else
	{
		//if( $xdata["itemCount"] > 0)
		//{			
			for($i=0; $i<count($xdata['body']); $i++)
			{				
				$condi = "";
				$id = $xdata['body'][$i]["CargosId"];
				$ck = $xdata['body'][$i]["CustomerKey"];
				$cark = $xdata['body'][$i]["CargosKey"];				
				$nombre = trim($xdata['body'][$i]["CargosName"]);
				$uk = $xdata['body'][$i]["UserKey"];
				if( isset($Cargos) && $Cargos != "" && $id == $Cargos ){
					$condi = ' selected="selected" ';
				}
				$xselect .= '<option value="'. $id .'"'. $condi .'>'. $nombre .'</option>';
			}
		//}		
	}
echo $xselect;
?>