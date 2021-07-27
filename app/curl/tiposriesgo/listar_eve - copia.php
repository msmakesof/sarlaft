<?php
//include 'ajax/is_logged.php';
// mks 20210516  verificar cUrl
require_once '../config/dbx.php';
$getUrl = new Database();
$urlServicios = $getUrl->getUrl();
if(function_exists('curl_init')) // Comprobamos si hay soporte para cURL
{
	$url = $urlServicios."api/tiposriesgo/lista_eve.php?ck=$CustomerKey";
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
	$datatr = json_decode($mestado, true);	
	
	$json_errors = array(
		JSON_ERROR_NONE => 'No se ha producido ningún error',
		JSON_ERROR_DEPTH => 'Maxima profundidad de pila ha sido excedida',
		JSON_ERROR_CTRL_CHAR => 'Error de carácter de control, posiblemente codificado incorrectamente',
		JSON_ERROR_SYNTAX => 'Error de Sintaxis',
	);
	
	foreach($datatr as $key => $row) {}
	
	if( $key == "message")
	{
		echo $datatr["message"];
	}
	else
	{
		$trow="";
		$tdraw="";
		/// Para pintar Tipo Riesgo   <i class='fas fa-plus-circle' id='itr' style='cursor: pointer'></i>
		if( $datatr["itemCount"] > 0)
		{			
			for($m=0; $m<$datatr["itemCount"]; $m++)	
			{	
				$trow.="<tr>";
				$tdraw.="<td>";
				$IdItem = "";
				$tdraw.="<select class='form-control' id='tr' name='tr' required>";
				$tdraw.="<option value=''>Seleccione opción</option>";
				for($i=0; $i<count($datatr['body']); $i++)
				{				
					$condi = "";
					$id = $datatr['body'][$i]["TIR_IdTipoRiesgo"];
					$nombre = trim($datatr['body'][$i]["TIR_Nombre"]);
					if( isset($IdItem) && $IdItem != "" && $id == $IdItem ){
						$condi = ' selected="selected" ';
					}
					$tdraw.= '<option value="'. $id .'"'. $condi .'>'. $nombre .'</option>';
				}
				$tdraw.= '</select>';
				$tdraw.="</td>";
			
			
				/**/
				/// Para pintar dinamicamente TD de acuerdo a FAR_FactorRiesgo
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
					if( $datafr["itemCount"] > 0)
					{			
						$IdItemfr = "";
						$sel_fr=""; //<select class='form-control' id='tr' name='tr' required>";
						$td_fr="";
						for($i=0; $i<count($datafr['body']); $i++)
						{				
							$condifr = "";
							$idfr = $datafr['body'][$i]["FAR_IdFactorRiesgo"];
							$nombrefr = trim($datafr['body'][$i]["FAR_Nombre"]);
							if( isset($IdItemfr) && $IdItemfr != "" && $idfr == $IdItemfr ){
								$condifr = ' selected="selected" ';
							}
							$sel_fr .= '<td id="'. $idfr .'">'. $nombrefr .'</td>';
							
							$tdraw.='<td style="text-align:center"><select id="'. $idfr .'"><option value="S">SI</option><option value="N">NO</option></select></td>';
						}
						$trow.= $tdraw."</tr>";				
					}
					$tdraw="";
				}
			}	
		}
		
?>
<table class="table">
	<tr>
		<td rowspan="2" style="text-align:center">TIPO DE RIESGO</td>
		<td style="text-align:center" colspan="<?php echo $datafr["itemCount"]; ?>"> FACTORES / FUENTES DE RIESGO</td>		
	</tr>	
	<tr>		
		<?php echo $sel_fr; ?>
	</tr>
	<?php echo $trow; ?>	
</table>
<?php		
	}
}
?>