<style>
table.gen{
	table-layout: fixed;
	/*width:100%;
	background-color: #000000;*/
	border-width: 1px;
	border-color: #000000;
	border-style: solid;
}

table.gen td{
	min-width: 25px;
	height: 50px;	
}

table.gen td{
	width:25px;
	word-wrap: break-word;
	border-width: 1px;
	border-color: #000000;
	border-style: solid;
	padding: 3px;
}

.celda {
margin:0 auto;
text-align:center;
}
</style>
<?php
//Prametros para mover la bolita
	if( isset($_POST["er"]) && $_POST["er"] > 0 ){
		$er = $_POST["er"];
	}
	
	if( isset($_POST["pfila"]) && $_POST["pfila"] > 0 ){
		$posfil = $_POST["pfila"];
		//$poscol = 1;
	}
	else {
		$posfil = 0;
	}

	if( isset($_POST["pcols"]) && $_POST["pcols"] > 0 ){
		$poscol = $_POST["pcols"];
		//$posfil = 1;
	}
	else {
		$poscol = 0;
	}
	
	if( isset($_POST["ck"]) && $_POST["ck"] != "" ){
		$CustomerKey=$_POST["ck"];
	}
	else{
		$CustomerKey=$CustomerKey;
	}
	
	if( isset($_POST["uk"]) && $_POST["uk"] != "" ){
		$UserKey=$_POST["uk"];
	}
	else{
		$UserKey=$UserKey;
	}
	
	if( isset($_POST["ruta"]) && $_POST["ruta"] != "" ){
		$ruta=$_POST["ruta"];
	}
	else{
		$ruta="";
	}
	
//echo "posfil....$posfil<br>";
//echo "poscol....$poscol<br>";
//echo "ck...".$CustomerKey;

// mks 20210516  verificar cUrl
require_once $ruta.'../config/dbx.php';
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
			for($i=0; $i<1; $i++)
			{
				$fil = $dataintermatriz['body'][$i]["INT_Filas"];
				$col = $dataintermatriz['body'][$i]["INT_Columnas"];
			}

			$tabla="<table class='gen' id='matrizcon' style='text-align:center;width:100%'><tbody>";
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
						$condimg = '<img src="../../img/circle.png" width="16px" height="16px" />';	
						$PosicioActualFils = $posfil;
						$PosicioActualCols = $poscol;
						
						// Aki verifico si la matriz de control tiene movimiento
						$mov_filri=0;
						$mov_colri=0;
						$getConnectionCli2 = new Database();
						$conn = $getConnectionCli2->getConnectionCli2($CustomerKey);
						
						// Inserto registro en Movimiento Matriz Riesgo Inherente
						date_default_timezone_set("America/Bogota");
						$DateStamp=date("Y-m-d H:i:s");						
						$sqlmov="INSERT INTO MOV_MatrizInherente (MOV_IdEventoMRI, MOV_FilaMRI, MOV_ColumnaMRI, MOV_CustomerKeyMRI, MOV_DateStampMRI, MOV_UserKeyMRI) VALUES (".$er.",".$posfil.",".$poscol.",'".$CustomerKey."','".$DateStamp."','".$UserKey."')";
						$query = sqlsrv_query($conn,$sqlmov);
						
						
						$mov_filrc = 0;
						$mov_colrc = 0;
						$TieneControl="";
						//$sqlmov=sqlsrv_query($conn,"SELECT MOV_FilaMRC, MOV_ColumnaMRC FROM MOV_MatrizControl WHERE MOV_CustomerKeyMRC='".$CustomerKey."' AND MOV_IdEventoMRC =".$er);
						$sqlmov=sqlsrv_query($conn,"SELECT TOP 1 MOV_TieneControlMRC FROM MOV_MatrizControl WHERE MOV_CustomerKeyMRC='".$CustomerKey."' AND MOV_IdEventoMRC =".$er." ORDER BY MOV_IdMovimientoMRC DESC ");
						$reg = sqlsrv_fetch_array($sqlmov);
						//echo "sqlmov...$sqlmov<br>";
						//if($sqlmov){							
							
							////$mov_filrc = $reg['MOV_FilaMRC'];
							////$mov_colrc = $reg['MOV_ColumnaMRC'];
							$TieneControl=$reg['MOV_TieneControlMRC'];
						//}
						//echo "mov_mri....$mov_mri   mov_mrc....$mov_mrc<br>";
						////if( ($mov_filrc == 0 && $mov_colrc == 0) || ($mov_filrc == "" && $mov_colrc == "") ){
						//if($TieneControl == "" || $TieneControl == "N"){
						if($TieneControl != "S"){
							$sqlmov="INSERT INTO MOV_MatrizControl (MOV_IdEventoMRC, MOV_FilaMRC, MOV_ColumnaMRC, MOV_CustomerKeyMRC, MOV_DateStampMRC, MOV_UserKeyMRC, MOV_MoverFilas, MOV_MoverCols) VALUES (".$er.",".$posfil.",".$poscol.",'".$CustomerKey."','".$DateStamp."','".$UserKey."',0,0)";
							$query = sqlsrv_query($conn,$sqlmov);
						}
						//if( $mov_mri > 0 ){
						//	$sqlmov="UPDATE MOV_MatrizControl SET MOV_FilaMRI =$posfil, MOV_ColumnaMRI=$poscol WHERE MOV_CustomerKey=$CustomerKey AND MOV_IdEvento = $er";
						//	$query = sqlsrv_query($conn,$sqlmov);
						//}
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
	//return $dataintermatriz;
}

?>