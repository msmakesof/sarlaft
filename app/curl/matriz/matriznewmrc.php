<?php
/************************************************
Created : Mauricio Sánchez Sierra
Date: 2021-08-01
Description: Usada para calcular posicionamiento
             de la bolita para la MRC de acuerdo
			 a lo seleccionado en el MRI, ciando
			 ya existe por lo menos un control
*************************************************/
if( isset($_POST["ck"]) && $_POST["ck"] != "" ){
	$CustomerKey=$_POST["ck"];
}

if( isset($_POST["er"]) && $_POST["er"] != "" ){
	$er=$_POST["er"];
}

if( isset($_POST["ruta"]) && $_POST["ruta"] != "" ){
	$ruta=$_POST["ruta"];
}
else {
	$ruta='';
}
require_once $ruta.'../config/dbx.php';
$getUrl = new Database();
$urlServicios = $getUrl->getUrl();
$getConnectionCli2 = new Database();
$conn = $getConnectionCli2->getConnectionCli2($CustomerKey);

//AND MOV_IdMovimientoMRC =".$MOV_IdMovimientoMRC."
$sqlmov=sqlsrv_query($conn,"SELECT TOP 1 MOV_FilaMRC, MOV_ColumnaMRC, MOV_IdMovimientoMRC FROM MOV_MatrizControl WHERE MOV_CustomerKeyMRC='".$CustomerKey."' AND MOV_IdEventoMRC =".$er." AND MOV_TieneControlMRC ='S' ORDER BY MOV_IdMovimientoMRC DESC ");
$reg = sqlsrv_fetch_array($sqlmov);

$posfil =$reg['MOV_FilaMRC'];
$poscol =$reg['MOV_ColumnaMRC'];

$getUrl = new Database();
$urlServicios = $getUrl->getUrl();
if(function_exists('curl_init')) // Comprobamos si hay soporte para cURL
{	
    $url = $urlServicios."api/interseccion/idmatriz.php?ck=".$CustomerKey;
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
			$fil = "";
			$col = "";
			$tabla="";			
			// Pinta la Matriz de acuerdo a la info en matriz de interseccion y Armar
			for($i=0; $i<1; $i++)
			{
				$fil = $dataintermatriz['body'][$i]["INT_Filas"];
				$col = $dataintermatriz['body'][$i]["INT_Columnas"];
			}			
			
			$tabla="<table class='gen' id='matrizconR' style='text-align:center;width:100%'><tbody>";
			$m = $fil;
			for($f=1; $f<=$fil; $f++){
				$tabla.="<tr>";
				
				for($c=1; $c<=$col; $c++){
					$id="p".$m."c".$c;
					$pid = '"'.$id.'"';

					for($i=0; $i<count($dataintermatriz['body']); $i++)
					{
						$posicion = trim($dataintermatriz['body'][$i]["INA_Fila"]);
						$color = $dataintermatriz['body'][$i]["INA_Color"];
						
						if( $id == $posicion ){

							break;
						}
					}
					$condimg = "";
					if($m == $posfil && $c == $poscol) { 
						////*$condimg = '<img src="../../img/circle.png" width="30px" height="30px" />';
						$condimg = '<img src="../../img/circle.png" width="16px" height="16px" />';
					}
					else { 
						$condimg = "&nbsp;"; 
					}
					$tabla.="<td id='".$id."' style='". $color ."; vertical-align:middle;'>" . $condimg . "</td>";
				}
				$m--;
				$tabla.="</tr>";
			}
			$tabla.="</tbody></table>";
			echo $tabla;
		}
	}	
}
?>