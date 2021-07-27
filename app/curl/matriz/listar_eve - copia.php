<?php
//include 'ajax/is_logged.php';
// mks 20210516  verificar cUrl
require_once '../config/dbx.php';
$getUrl = new Database();
$urlServicios = $getUrl->getUrl();
if(function_exists('curl_init')) // Comprobamos si hay soporte para cURL
{
	
	/*$url = $urlServicios."api/tiposriesgo/lista_eve.php?ck=$CustomerKey";
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
		if( $datatr["itemCount"] > 0)
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
		}
		*/

	// Lista de Probabilidad
	$url = $urlServicios."api/probabilidad/lista_eve.php?ck=$CustomerKey";
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
	$dataprob = json_decode($mestado, true);	
	
	$json_errors = array(
		JSON_ERROR_NONE => 'No se ha producido ningún error',
		JSON_ERROR_DEPTH => 'Maxima profundidad de pila ha sido excedida',
		JSON_ERROR_CTRL_CHAR => 'Error de carácter de control, posiblemente codificado incorrectamente',
		JSON_ERROR_SYNTAX => 'Error de Sintaxis',
	);
	foreach($dataprob as $key => $row) {}
	
	if( $key == "message")
	{
		echo $dataprob["message"];
	}
	else
	{
		$sel_prob="<select class='form-control' id='prob' name='prob' required style='font-size:12px'>";
		$sel_prob.="<option value=''>Seleccione opción</option>";
		for($i=0; $i<count($dataprob['body']); $i++)
		{				
			$condi = "";
			$id = $dataprob['body'][$i]["PRO_IdProbabilidad"];
			$nombre = trim($dataprob['body'][$i]["PRO_Nombre"]);
			$escala = trim($dataprob['body'][$i]["PRO_Escala"]);
			$color = trim($dataprob['body'][$i]["PRO_Color"]);
			if( isset($IdItem) && $IdItem != "" && $id == $IdItem ){
				$condi = ' selected="selected" ';
			}
			$sel_prob.= '<option value="'. $id .'"'. $condi .'>'. $nombre .'</option>';
		}
		$sel_prob.= "</select>";

		$sel_prob2="<select class='form-control' id='prob2' name='prob2' required style='font-size:12px'>";
		$sel_prob2.="<option value=''>Seleccione opción</option>";
		for($i=0; $i<count($dataprob['body']); $i++)
		{				
			$condi2 = "";
			$id = $dataprob['body'][$i]["PRO_IdProbabilidad"];
			$nombre = trim($dataprob['body'][$i]["PRO_Nombre"]);
			$escala = trim($dataprob['body'][$i]["PRO_Escala"]);
			$color = trim($dataprob['body'][$i]["PRO_Color"]);
			if( isset($IdItem) && $IdItem != "" && $id == $IdItem ){
				$condi2 = ' selected="selected" ';
			}
			$sel_prob2.= '<option value="'. $id .'"'. $condi .'>'. $nombre .'</option>';
		}
		$sel_prob2.= "</select>";
	}

	// Lista de Consecuencia
	$url = $urlServicios."api/consecuencia/lista_eve.php?ck=$CustomerKey";
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
		$sel_csc="<select class='form-control' id='consec' name='consec' required style='font-size:12px'>";
		$sel_csc.="<option value=''>Seleccione opción</option>";
		for($i=0; $i<count($datacsc['body']); $i++)
		{				
			$condicsc = "";
			$idcsc = $datacsc['body'][$i]["CSC_IdConsecuencia"];
			$nombrecsc = trim($datacsc['body'][$i]["CSC_Nombre"]);
			$escalacsc = trim($datacsc['body'][$i]["CSC_Escala"]);
			$color = trim($datacsc['body'][$i]["CSC_Color"]);
			if( isset($IdItemcsc) && $IdItemcsc != "" && $idcsc == $IdItemcsc ){
				$condicsc = ' selected="selected" ';
			}
			$sel_csc.= '<option value="'. $idcsc .'"'. $condicsc .'>'. $nombrecsc .'</option>';
		}
		$sel_csc.= "</select>";

		$IdItemcs2c="";
		$sel_csc2="<select class='form-control' id='consec2' name='consec2' required style='font-size:12px'>";
		$sel_csc2.="<option value=''>Seleccione opción</option>";
		for($i=0; $i<count($datacsc['body']); $i++)
		{				
			$condicsc2 = "";
			$idcsc = $datacsc['body'][$i]["CSC_IdConsecuencia"];
			$nombrecsc = trim($datacsc['body'][$i]["CSC_Nombre"]);
			$escalacsc = trim($datacsc['body'][$i]["CSC_Escala"]);
			$color = trim($datacsc['body'][$i]["CSC_Color"]);
			if( isset($IdItemcsc2) && $IdItemcsc2 != "" && $idcsc == $IdItemcsc2 ){
				$condicsc2 = ' selected="selected" ';
			}
			$sel_csc2.= '<option value="'. $idcsc .'"'. $condicsc2 .'>'. $nombrecsc .'</option>';
		}
		$sel_csc2.= "</select>";
	}
?>
<style>
.vertical {
	writing-mode: vertical-lr;
transform: rotate(180deg);
}
.tituloMat {color: black; text-shadow: black 0.1em 0.1em 0.2em; font-weight:bold; letter-spacing: 2px;}
.tituloMat2 {text-shadow: 1px 1px white, -1px -1px #333;}
.tituloMat3 {
	font-weight: bold;
	color: black; text-shadow: grey 0.1em 0.1em 0.2em;
}
.subtitMat{
	font-weight: bold;
	color: black; text-shadow: grey 0.1em 0.1em 0.2em;
}
</style>
<table style="width:100% !important">
	<tr>
		<td>	
			<table class="table table-bordered">
				<tbody>
					<tr>
						<td colspan="4" class="tituloMat3">MATRIZ RIESGO INHERENTE</td>
					</tr>
					<tr>
						<td class="subtitMat">Probabilidad
						<?php echo $sel_prob;?>
						</td>
						<!-- <td> <div id="lblprob"></div> </td> -->
						<td rowspan="2" class="vertical tituloMat2">PROBABILIDAD</td>
						<td rowspan="2">
							<!-- -->
							<?php 
// Test move
$fi = 4;
$co = 2;


for ($c=0; $c<=4; $c++)
{
    for ($f=0; $f<=4; $f++)
    {
    
    }
}
?>
    <table style="width:100%">
        <tr>            
            <td style="background-color:#FFC600"><?php if($fi == 1 && $co == 1) { ?><img src="../../img/circle.png" width="16px" height="16px"><?php } else { echo "&nbsp;";} ?></td>
            <td style="background-color:#FFC600"><?php if($fi == 1 && $co == 2) { ?><img src="../../img/circle.png" width="16px" height="16px"><?php } else { echo "&nbsp;";} ?></td>
            <td style="background-color:#ff0000"><?php if($fi == 1 && $co == 4) { ?><img src="../../img/circle.png" width="16px" height="16px"><?php } else { echo "&nbsp;";} ?></td>
            <td style="background-color:#ff0000"><?php if($fi == 1 && $co == 3) { ?><img src="../../img/circle.png" width="16px" height="16px"><?php } else { echo "&nbsp;";} ?></td>
            <td style="background-color:#ff0000"><?php if($fi == 1 && $co == 5) { ?><img src="../../img/circle.png" width="16px" height="16px"><?php } else { echo "&nbsp;";} ?></td>
        </tr>
        <tr>
            <td style="background-color:#ffff00"><?php if($fi == 2 && $co == 1) { ?><img src="../../img/circle.png" width="16px" height="16px"><?php } else { echo "&nbsp;";} ?></td>
            <td style="background-color:#FFC600"><?php if($fi == 2 && $co == 2) { ?><img src="../../img/circle.png" width="16px" height="16px"><?php } else { echo "&nbsp;";} ?></td>
            <td style="background-color:#FFC600"><?php if($fi == 2 && $co == 3) { ?><img src="../../img/circle.png" width="16px" height="16px"><?php } else { echo "&nbsp;";} ?></td>            
            <td style="background-color:#ff0000"><?php if($fi == 2 && $co == 4) { ?><img src="../../img/circle.png" width="16px" height="16px"><?php } else { echo "&nbsp;";} ?></td>
            <td style="background-color:#ff0000"><?php if($fi == 2 && $co == 5) { ?><img src="../../img/circle.png" width="16px" height="16px"><?php } else { echo "&nbsp;";} ?></td>
        </tr>

        <tr>
            <td style="background-color:#9b9b9b"><?php if($fi == 3 && $co == 1) { ?><img src="../../img/circle.png" width="16px" height="16px"><?php } else { echo "&nbsp;";} ?></td>
            <td style="background-color:#ffff00"><?php if($fi == 3 && $co == 2) { ?><img src="../../img/circle.png" width="16px" height="16px"><?php } else { echo "&nbsp;";} ?></td>
            <td style="background-color:#FFC600"><?php if($fi == 3 && $co == 3) { ?><img src="../../img/circle.png" width="16px" height="16px"><?php } else { echo "&nbsp;";} ?></td>
            <td style="background-color:#ff0000"><?php if($fi == 3 && $co == 4) { ?><img src="../../img/circle.png" width="16px" height="16px"><?php } else { echo "&nbsp;";} ?></td>
            <td style="background-color:#ff0000"><?php if($fi == 3 && $co == 5) { ?><img src="../../img/circle.png" width="16px" height="16px"><?php } else { echo "&nbsp;";} ?></td>
        </tr>

        <tr>
            <td style="background-color:#9b9b9b"><?php if($fi == 4 && $co == 1) { ?><img src="../../img/circle.png" width="16px" height="16px"><?php } else { echo "&nbsp;";} ?></td>
            <td style="background-color:#9b9b9b"><?php if($fi == 4 && $co == 2) { ?><img src="../../img/circle.png" width="16px" height="16px"><?php } else { echo "&nbsp;";} ?></td>
            <td style="background-color:#ffff00"><?php if($fi == 4 && $co == 3) { ?><img src="../../img/circle.png" width="16px" height="16px"><?php } else { echo "&nbsp;";} ?></td>
            <td style="background-color:#FFC600"><?php if($fi == 4 && $co == 4) { ?><img src="../../img/circle.png" width="16px" height="16px"><?php } else { echo "&nbsp;";} ?></td>
            <td style="background-color:#ff0000"><?php if($fi == 4 && $co == 5) { ?><img src="../../img/circle.png" width="16px" height="16px"><?php } else { echo "&nbsp;";} ?></td>            
        </tr>

        <tr>
            <td style="background-color:#9b9b9b"><?php if($fi == 5 && $co == 1) { ?><img src="../../img/circle.png" width="16px" height="16px"><?php } else { echo "&nbsp;";} ?></td>
            <td style="background-color:#9b9b9b"><?php if($fi == 5 && $co == 2) { ?><img src="../../img/circle.png" width="16px" height="16px"><?php } else { echo "&nbsp;";} ?></td>
            <td style="background-color:#ffff00"><?php if($fi == 5 && $co == 3) { ?><img src="../../img/circle.png" width="16px" height="16px"><?php } else { echo "&nbsp;";} ?></td>
            <td style="background-color:#FFC600"><?php if($fi == 5 && $co == 4) { ?><img src="../../img/circle.png" width="16px" height="16px"><?php } else { echo "&nbsp;";} ?></td>
            <td style="background-color:#FFC600"><?php if($fi == 5 && $co == 5) { ?><img src="../../img/circle.png" width="16px" height="16px"><?php } else { echo "&nbsp;";} ?></td>
        </tr>

    </table>


							<!-- -->
						</td>
					</tr>
					<tr>
						<td class="subtitMat">Consecuencia
						<?php echo $sel_csc;?>
						</td>
						<!-- <td> <div id="lblconsec"></div> </td> -->
					</tr>
				</tbody>
			</table>
		</td>
		<td>
			<table class="table table-bordered">
				<tbody>
					<tr>
						<td colspan="4" class="tituloMat3">MATRIZ DE RIESGO CON CONTROL</td>
					</tr>
					<tr>
						<td class="subtitMat">Probabilidad
						<?php echo $sel_prob2;?>
						</td>
						<!-- <td> <div id="lblprob2"></div></td> -->
						<td rowspan="2" class="vertical tituloMat2">PROBABILIDAD</td>
						<td rowspan="2"><?php //include 'base.php'?><?php include 'matriz.php'?></td>
					</tr>
					<tr>
						<td class="subtitMat">Consecuencia
						<?php echo $sel_csc2;?>
						</td>
						<!-- <td> <div id="lblconsec2"> </td> -->
					</tr>
				</tbody>
			</table>
		</td>
	</tr>
</table>
<?php	
}
?>