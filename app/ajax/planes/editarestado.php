<?php
$Responsable = $_POST['idresponsable'];
//echo "state   ".$Estado;
require_once '../../config/dbx.php';
$getUrl = new Database();
$urlServicios = $getUrl->getUrl();		
$resultado = "";
$ck= $_POST['ck'];
$url = $urlServicios."api/responsables/lista.php?ck=$ck";
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
$ddata = json_decode($mestado, true);	

$json_errors = array(
	JSON_ERROR_NONE => 'No se ha producido ningún error',
	JSON_ERROR_DEPTH => 'Maxima profundidad de pila ha sido excedida',
	JSON_ERROR_CTRL_CHAR => 'Error de carácter de control, posiblemente codificado incorrectamente',
	JSON_ERROR_SYNTAX => 'Error de Sintaxis',
);
$dselect = '';
foreach($ddata as $key => $row) {}
	
	$dselect .= '<option value="">Seleccione Opción</option>';
	if( $key == "message")
	{
		$dselect .= '<option value="">'. $ddata["message"] .'</option>';
	}
	else
	{
		if( $ddata["itemCount"] > 0)
		{			
			for($i=0; $i<count($ddata['body']); $i++)
			{				
				$condi = "";
				$id = $ddata['body'][$i]["ResponsablesId"];
				$nombre = trim($ddata['body'][$i]["ResponsablesName"]);
				if( isset($Responsable) && $Responsable != "" && $id == $Responsable ){
					$condi = ' selected="selected" ';
				}
				$dselect .= '<option value="'. $id .'"'. $condi .'>'. $nombre .'</option>';
			}
		}		
	}

echo $dselect;
?>