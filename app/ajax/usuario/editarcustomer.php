<?php
$CustomerKey = trim($_POST['idcustomer']);
//echo "state   ".$Estado;
require_once '../../config/dbx.php';
$getUrl = new Database();
$urlServicios = $getUrl->getUrl();		
$resultado = "";

$url = $urlServicios."api/cliente/lista.php";
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
$data = json_decode($mestado, true);	

$json_errors = array(
	JSON_ERROR_NONE => 'No se ha producido ningún error',
	JSON_ERROR_DEPTH => 'Maxima profundidad de pila ha sido excedida',
	JSON_ERROR_CTRL_CHAR => 'Error de carácter de control, posiblemente codificado incorrectamente',
	JSON_ERROR_SYNTAX => 'Error de Sintaxis',
);
foreach($data as $key => $row) {}
$select = '';
//$select = '<select class="form-control select2" name="edit_estado" id="edit_estado" style="width: 100%;" required>';
$select .= '<option value="">Seleccione Opción</option>';
if( $key == "message")
{
	$select .= '<option value="">'. $data["message"] .'</option>';
}
else
{
	if( $data["itemCount"] > 0)
	{			
		for($i=0; $i<count($data['body']); $i++)
		{				
			$condi = "";
			$id = $data['body'][$i]["id"];
			$customerkey = trim($data['body'][$i]["CustomerKey"]);
			$nomcustomer = trim($data['body'][$i]["CustomerName"]);
			if( isset($CustomerKey) && $CustomerKey != "" && $customerkey == $CustomerKey ){
				$condi = ' selected="selected" ';
			}
			$select .= '<option value="'. $customerkey .'"'. $condi .'>'. $nomcustomer .'</option>';
		}
	}		
}
//$select .= '</select>';
echo $select;
?>