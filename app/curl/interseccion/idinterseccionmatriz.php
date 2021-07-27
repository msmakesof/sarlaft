<style>
table.gen{
	table-layout: fixed;
	width:900px;
	/*background-color: #000000;*/
	border-width: 1px;
	border-color: #000000;
	border-style: solid;
}

table.gen td{
	min-width: 35px;
	height: 70px;	
}

table.gen td{
	width:35px;
	word-wrap: break-word;
	border-width: 1px;
	border-color: #000000;
	border-style: solid;
	padding: 3px;
}

/*
table.gen {
    width:90%;
}
table.gen td {
    width:30%;
    position:relative;
}
table.gen td:after{
    content:'';
    display:block;
    margin-top:100%;
}
table.gen td .content {
    position:absolute;
    top:0;
    bottom:0;
    left:0;
    right:0; 
}
*/
</style>
<?php
//include 'ajax/is_logged.php';
// mks 20210516  verificar cUrl
require_once '../config/dbx.php';
$getUrl = new Database();
$urlServicios = $getUrl->getUrl();
if(function_exists('curl_init')) // Comprobamos si hay soporte para cURL
{
	$url = $urlServicios."api/interseccion/idinterseccionmatriz.php?id=".$_POST['id']."&ck=".$_POST['ck'];
	//echo "url idinter...$url<br>";
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
	$dataintermatriz = json_decode($mestado, true);	
	
	$json_errors = array(
		JSON_ERROR_NONE => 'No se ha producido ningún error',
		JSON_ERROR_DEPTH => 'Maxima profundidad de pila ha sido excedida',
		JSON_ERROR_CTRL_CHAR => 'Error de carácter de control, posiblemente codificado incorrectamente',
		JSON_ERROR_SYNTAX => 'Error de Sintaxis',
	);

	foreach($dataintermatriz as $key => $row) {}
	
	if( $key == "message")
	{
		echo $dataintermatriz["message"];
	}
	else
	{
		if( $dataintermatriz["itemCount"] > 0)
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

			
			$fil = "";
			$col = "";
			$tabla="";
			for($i=0; $i<1; $i++)
			{
				$fil = $dataintermatriz['body'][$i]["INT_Filas"];
				$col = $dataintermatriz['body'][$i]["INT_Columnas"];
			}

			$tabla="<table class='gen' id='matrizcon' style='text-align:center'><tbody>";
			$m = $fil;
			for($f=1; $f<=$fil; $f++){
				$tabla.="<tr>";
				
				for($c=1; $c<=$col; $c++){
					$id="p".$m."c".$c;
					$pid = '"'.$id.'"';

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
							$sel_nr.="<option value=''>Seleccione</option>";
							for($i=0; $i<count($datanr['body']); $i++)
							{				
								$condi = "";
								$idnr = $datanr['body'][$i]["NIR_IdNivelRiesgo"];
								$nombre = trim($datanr['body'][$i]["NIR_Nombre"]);
								$color = trim($datanr['body'][$i]["NIR_Color"]);
								if( isset($IdItem) && $IdItem != "" && $idnr == $IdItem ){
									$condi = ' selected="selected" ';
								}
								$sel_nr.= '<option value="'. $idnr .'"'. $condi .' style="color:'.$color.'">'. $color .'</option>';
							}
							$sel_nr.= '</select>';
						}
					}

					for($i=0; $i<count($dataintermatriz['body']); $i++)
					{
						$posicion = trim($dataintermatriz['body'][$i]["INA_Fila"]);
						$color = $dataintermatriz['body'][$i]["INA_Color"];
						
						if( $id == $posicion ){

							break;
						}
					}

					$tabla.="<td id='".$id."' onclick='mks($pid)' class='celda' style='". $color ."'>$sel_nr&nbsp;</td>";
				}
				$m--;
				$tabla.="</tr>";
			}
			$tabla.="</tbody></table>";
			echo $tabla;
		}
	}
	//return $dataintermatriz;
}
?>
<script>
function selx(p1){
	var x = $("#s"+p1).val();
	var txt = $("#s"+p1).find('option:selected').text();
	//alert(txt);
	$("#"+p1).css('background-color', txt);
	if(x ==""){
		$("#"+p1).css('background-color', '');
	}
	$("#s"+p1).hide()
}
</script>