<?php
//include 'ajax/is_logged.php';
// mks 20210516  verificar cUrl
require_once '../config/dbx.php';
$getUrl = new Database();
$urlServicios = $getUrl->getUrl();
if(function_exists('curl_init')) // Comprobamos si hay soporte para cURL
{
	$url = $urlServicios."api/segcanales/lista_eve.php?ck=$CustomerKey";
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
	$datadeb = json_decode($mestado, true);	
	
	$json_errors = array(
		JSON_ERROR_NONE => 'No se ha producido ningún error',
		JSON_ERROR_DEPTH => 'Maxima profundidad de pila ha sido excedida',
		JSON_ERROR_CTRL_CHAR => 'Error de carácter de control, posiblemente codificado incorrectamente',
		JSON_ERROR_SYNTAX => 'Error de Sintaxis',
	);
	foreach($datadeb as $key => $row) {}
	
	if( $key == "message")
	{
		echo $datadeb["message"];
	}
	else
	{
		$IdItemcsc="";
		$sel_deb="<select class='form-control' id='segcanales' name='segcanales' required>";
		$sel_deb.="<option value=''>Seleccione opción</option>";
		for($i=0; $i<count($datadeb['body']); $i++)
		{				
			$condideb = "";
			$idcsc = $datadeb['body'][$i]["id"];
			$nombrecsc = trim($datadeb['body'][$i]["SegCanalesName"]);
			$ck = trim($datadeb['body'][$i]["CustomerKey"]);
			$cuasak = trim($datadeb['body'][$i]["UserKey"]);
			if( isset($IdItemcsc) && $IdItemcsc != "" && $idcsc == $IdItemcsc ){
				$condideb = ' selected="selected" ';
			}
			$sel_deb.= '<option value="'. $idcsc .'"'. $condideb .'>'. $nombrecsc .'</option>';
		}
		$sel_deb.= "</select>";
	}
}
$vcausas = 0;
?>
<table class="table table-bordered" style="width:100% !important" id="tabsca">
	<thead>
	<tr>
		<td style="width:10%">
			<div id="addsca" style="float:left">
				<i class="fas fa-plus-circle fa-1x" data-toggle="tooltip" title="Adicionar Segmento Canales" style="color:green; cursor:pointer"></i>
			</div>

			<a href="#" id="mcreasca" style="float:right" data-target="#addSegCanalesModal" data-toggle="modal" data-ck="<?php echo $CustomerKey;?>">
				<i class="fas fa-file-alt fa-1x" data-toggle="tooltip" title="Crear Segmento Canales" style="color:orange; cursor:pointer"></i>
			</a>
		</td>
		<td style="width:80%"><label>Segmento Canales</label></td>
		<td style="width:10%"></td>
	</tr>
	</thead>
	<tbody id="tabscabody"></tbody>
</table>