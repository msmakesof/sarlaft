<?php
//include 'ajax/is_logged.php';
// mks 20210516  verificar cUrl
require_once '../config/dbx.php';
$getUrl = new Database();
$urlServicios = $getUrl->getUrl();
if(function_exists('curl_init')) // Comprobamos si hay soporte para cURL
{
	$url = $urlServicios."api/tratamientos/lista_eve.php?ck=$CustomerKey";
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
	$datacsc = json_decode($mestado, true);	
	
	$json_errors = array(
		JSON_ERROR_NONE => 'No se ha producido ningún error',
		JSON_ERROR_DEPTH => 'Maxima profundidad de pila ha sido excedida',
		JSON_ERROR_CTRL_CHAR => 'Error de carácter de control, posiblemente codificado incorrectamente',
		JSON_ERROR_SYNTAX => 'Error de Sintaxis',
	);
	foreach($datacsc as $key => $row) {}
	
	if( $key == "message")
	{
		echo $datacsc["message"];
	}
	else
	{
		$IdItemcsc="";
		$sel_csc="<select class='form-control' id='trata' name='trata' required>";
		$sel_csc.="<option value=''>Seleccione opción</option>";
		for($i=0; $i<count($datacsc['body']); $i++)
		{				
			$condicsc = "";
			$idcsc = $datacsc['body'][$i]["id"];
			$nombrecsc = trim($datacsc['body'][$i]["TratamientosName"]);
			$ck = trim($datacsc['body'][$i]["CustomerKey"]);
			if( isset($IdItemcsc) && $IdItemcsc != "" && $idcsc == $IdItemcsc ){
				$condicsc = ' selected="selected" ';
			}
			$sel_csc.= '<option value="'. $idcsc .'"'. $condicsc .'>'. $nombrecsc .'</option>';
		}
		$sel_csc.= "</select>";
	}
}
$vtrata = 0;
?>
<table class="table table-bordered" style="width:100% !important" id="tabtra">
	<thead>
	<tr>
		<td style="width:10%">
			<div id="addtra" style="float:left">
				<i class="fas fa-plus-circle fa-1x" data-toggle="tooltip" title="Adicionar Tratamientos" style="color:green; cursor:pointer"></i>
			</div>

			<a href="#" id="mcreatra" style="float:right" data-target="#addTratamientoModal" data-toggle="modal" data-ck="<?php echo $CustomerKey;?>">
				<i class="fas fa-file-alt fa-1x" data-toggle="tooltip" title="Crear Tratamientos" style="color:orange; cursor:pointer"></i>
			</a>			
		</td>
		<td style="width:80%"><label>Tratamientos</label></td>
		<td style="width:10%"></td>
	</tr>
	</thead>
	<tbody id="tabtrabody"></tbody>
</table>