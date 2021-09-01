<?php
//include 'ajax/is_logged.php';
// mks 20210516  verificar cUrl
require_once '../config/dbx.php';
$getUrl = new Database();
$urlServicios = $getUrl->getUrl();
if(function_exists('curl_init')) // Comprobamos si hay soporte para cURL
{
	$url = $urlServicios."api/factoresriesgo/lista_eve.php?ck=$CustomerKey";
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
	$datafr = json_decode($mestado, true);	
	
	$json_errors = array(
		JSON_ERROR_NONE => 'No se ha producido ningún error',
		JSON_ERROR_DEPTH => 'Maxima profundidad de pila ha sido excedida',
		JSON_ERROR_CTRL_CHAR => 'Error de carácter de control, posiblemente codificado incorrectamente',
		JSON_ERROR_SYNTAX => 'Error de Sintaxis',
	);
	foreach($datafr as $key => $row) {}
	
	if( $key == "message")
	{
		echo $datafr["message"];
	}
	else
	{		
		/// Para pintar Tipo Riesgo   <i class='fas fa-plus-circle' id='itr' style='cursor: pointer'></i>
		if( $datafr["itemCount"] > 0)
		{			
			$IdItem = "";
			$sel_fr="<select class='form-control' id='fr' name='fr' required autofocus>";
			$sel_fr.="<option value=''>Seleccione opción</option>";			
			for($i=0; $i<count($datafr['body']); $i++)
			{				
				$condi = "";
				$id = $datafr['body'][$i]["FAR_IdFactorRiesgo"];
				$nombre = trim($datafr['body'][$i]["FAR_Nombre"]);
				if( isset($IdItem) && $IdItem != "" && $id == $IdItem ){
					$condi = ' selected="selected" ';
				}
				$sel_fr.= '<option value="'. $id .'"'. $condi .'>'. $nombre .'</option>';
			}
			$sel_fr.= '</select>';				
		}
	}
}		
?>
<table class="table table-bordered" style="width:100% !important" id="tabfar">
	<thead>
	<tr>
		<td style="width:10%">
			<div id="addfar" style="float:left">
				<i class="fas fa-plus-circle fa-1x" data-toggle="tooltip" title="Adicionar Factor Riesgo" style="color:green; cursor:pointer"></i>
			</div>

			<a href="#" id="mcreafar" style="float:right" data-target="#addFactorRiesgoModal" data-toggle="modal" data-ck="<?php echo $CustomerKey;?>">
				<i class="fas fa-file-alt fa-1x" data-toggle="tooltip" title="Crear Factor Riesgo" style="color:orange; cursor:pointer"></i>
			</a>					
		</td>
		<td style="width:80%"><label>Factor Riesgo</label></td>
		<td style="width:10%"></td>
	</tr>
	</thead>
	<tbody id="tabfarbody"></tbody>
</table>