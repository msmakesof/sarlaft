<?php
$Estado = $_POST['idrespseguir'];
//echo "state   ".$Estado;
require_once '../../config/dbx.php';
$getUrl = new Database();
$urlServicios = $getUrl->getUrl();		
$resultado = "";
$ck= $_POST['ck'];
$url = $urlServicios."api/responsables/listarespseguir.php?ck=$ck";
//echo "url respsegui...$url<br>";
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
$zdata = json_decode($mestado, true);	

$json_errors = array(
	JSON_ERROR_NONE => 'No se ha producido ningún error',
	JSON_ERROR_DEPTH => 'Maxima profundidad de pila ha sido excedida',
	JSON_ERROR_CTRL_CHAR => 'Error de carácter de control, posiblemente codificado incorrectamente',
	JSON_ERROR_SYNTAX => 'Error de Sintaxis',
);
$select = '';
foreach($zdata as $key => $row) {}
	$zselect .= '<option value="">Seleccione Opción</option>';
	if( $key == "message")
	{
		$zselect .= '<option value="">'. $zdata["message"] .'</option>';
	}
	else
	{
		//if( $zdata["itemCount"] > 0)
		//{			
			for($i=0; $i<count($zdata['body']); $i++)
			{				
				$condi = "";
				$idestado = $zdata['body'][$i]["ResponsablesId"];
				$nomestado = trim($zdata['body'][$i]["ResponsablesName"]);
				if( isset($Estado) && $Estado != "" && $idestado == $Estado ){
					$condi = ' selected="selected" ';
				}
				$zselect .= '<option value="'. $idestado .'"'. $condi .'>'. $nomestado .'</option>';
			}
		//}		
	}
echo $zselect;
?>