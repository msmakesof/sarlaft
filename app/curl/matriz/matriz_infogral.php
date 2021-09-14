<?php
/*************************************************************************
Created : Mauricio Sánchez Sierra
Date: 2021-07-13
Description: Genera cálculo para la Matriz de Riesgo Inherente
			 Genera el primer cálculo para la Matriz de Riesgo de Control
			 dependiendo los valores de la MRI.
**************************************************************************/
?>
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
	min-width: 20px;
	height: 40px;	
}

table.gen td{
	width:15px;
	word-wrap: break-word;
	border-width: 1px;
	border-color: #000000;
	border-style: solid;
	padding: 2px;
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
	//else { $er = $er ;}
	
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
    // Para traer la primera columna
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
		for($prob=0; $prob<count($dataprob['body']); $prob++)
		{
			$idprob = $dataprob['body'][$prob]["PRO_IdProbabilidad"];
			$nombreprob = trim($dataprob['body'][$prob]["PRO_Nombre"]);
		}
	}
	
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
			$cantidadPosicionesFila = 0;
			$cantidadPosicionesCols = 0;
			$nuevaUbicacion="N";
			
			// Pinta la Matriz de acuerdo a la info en matriz de interseccion y Armar
			for($i=0; $i<1; $i++)
			{
				$fil = $dataintermatriz['body'][$i]["INT_Filas"];
				$col = $dataintermatriz['body'][$i]["INT_Columnas"];
			}

			$tabla="<table class='gen' id='matrizcon' style='text-align:center;width:100%'><tbody>";
			$tabla.="<tr>";
			$tabla.="<td></td>";
			for($td=1; $td<=$col; $td++){
				$tabla.="<td style='text-align:center; color:white; background-color:gray;'>$td</td>";
			} 
			$tabla.="</tr>";
			$m = $fil;
			for($f=1; $f<=$fil; $f++){
				$tabla.="<tr>";
				
				$getConnectionCli2 = new Database();
				$conn = $getConnectionCli2->getConnectionCli2($CustomerKey);

				$query_prob=sqlsrv_query($conn,"SELECT PRO_Nombre FROM PRO_Probabilidad WHERE PRO_CustomerKey=".$CustomerKey." AND PRO_Escala = $m");
				$regtit=sqlsrv_fetch_array($query_prob);
				$nombreprob = trim($regtit['PRO_Nombre']);
				$tabla.="<td style='text-align:center; color:white; background-color:gray; font-size:10px'>$nombreprob</td>";
				
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
						
						//// Tomo el último valor actual de la posicion de la fila y columna en MRI
						$sqlmov=sqlsrv_query($conn,"SELECT TOP 1 MOV_FilaMRI, MOV_ColumnaMRI FROM MOV_MatrizInherente WHERE MOV_IdEventoMRI = ".$er." AND MOV_CustomerKeyMRI ='".$CustomerKey."' ORDER BY MOV_IdMovimientoMRI DESC ");
						$reg = sqlsrv_fetch_array($sqlmov);
						$MOV_FilaMRI = $reg['MOV_FilaMRI'];
						$MOV_ColumnaMRI = $reg['MOV_ColumnaMRI'];
						
						// Inserto registro en Movimiento Matriz Riesgo Inherente
						date_default_timezone_set("America/Bogota");
						$DateStamp=date("Y-m-d H:i:s");						
						$sqlmov="INSERT INTO MOV_MatrizInherente (MOV_IdEventoMRI, MOV_FilaMRI, MOV_ColumnaMRI, MOV_CustomerKeyMRI, MOV_DateStampMRI, MOV_UserKeyMRI) VALUES (".$er.",".$posfil.",".$poscol.",'".$CustomerKey."','".$DateStamp."','".$UserKey."')";
						$query = sqlsrv_query($conn,$sqlmov);						
						
						$mov_filrc = 0;
						$mov_colrc = 0;
						$TieneControl="";
						
						$sqlmov=sqlsrv_query($conn,"SELECT TOP 1 MOV_TieneControlMRC FROM MOV_MatrizControl WHERE MOV_CustomerKeyMRC='".$CustomerKey."' AND MOV_IdEventoMRC =".$er." ORDER BY MOV_IdMovimientoMRC DESC ");
						$reg = sqlsrv_fetch_array($sqlmov);
						
						$TieneControl=$reg['MOV_TieneControlMRC'];
					
						if( $TieneControl != "S" ){
							$sqlmov="INSERT INTO MOV_MatrizControl (MOV_IdEventoMRC, MOV_FilaMRC, MOV_ColumnaMRC, MOV_CustomerKeyMRC, MOV_DateStampMRC, MOV_UserKeyMRC, MOV_MoverFilas, MOV_MoverCols) VALUES (".$er.",".$posfil.",".$poscol.",'".$CustomerKey."','".$DateStamp."','".$UserKey."',0,0)";
							$query = sqlsrv_query($conn,$sqlmov);
							
							//Grabo el control
							//$sqlmov="INSERT INTO ECTR_Controles (ECTR_IdPropietario, ECTR_IdEjecutor, ECTR_IdEfectividad, ECTR_IdFrecuencia, ECTR_IdCategoria, ECTR_IdRealizado, ECTR_IdDocumentado, ECTR_IdAplicado, ECTR_IdEfectivo, ECTR_IdEvaluado, ECTR_IdControl, ECTR_IdEventoMRC) VALUES (".$er.",".$posfil.",".$poscol.",'".$CustomerKey."','".$DateStamp."','".$UserKey."',0,0)";
							//$query = sqlsrv_query($conn,$sqlmov);
						}
						else{
							//Calculo para determinar cantidad de posiciones a subir o bajar (filas)
							$cantidadPosicionesFila = $MOV_FilaMRI - $posfil ;
							//Calculo para determinar cantidad de posiciones a izquierda o derecha (columnas)
							$cantidadPosicionesCols = $MOV_ColumnaMRI - $poscol ;
							
							//Para saber la útima posición en la Fila y Columna de la MRC
							$sqlmov=sqlsrv_query($conn,"SELECT TOP 1 MOV_FilaMRC, MOV_ColumnaMRC, MOV_IdMovimientoMRC FROM MOV_MatrizControl WHERE MOV_CustomerKeyMRC='".$CustomerKey."' AND MOV_IdEventoMRC =".$er." ORDER BY MOV_IdMovimientoMRC DESC ");
							$reg = sqlsrv_fetch_array($sqlmov);
							
							$MOV_FilaMRC = $reg['MOV_FilaMRC']; // Ubicacion en la Fila
							$MOV_ColumnaMRC = $reg['MOV_ColumnaMRC']; // Ubicacion en la Columna
							$MOV_IdMovimientoMRC = $reg['MOV_IdMovimientoMRC']; // Ubicacion en la 
							
							$nuevaPosicionFila = $MOV_FilaMRC - $cantidadPosicionesFila;
							$nuevaPosicionCols = $MOV_ColumnaMRC - $cantidadPosicionesCols;
							
							// Para evitar que la bolita desaparezca de la matriz para los valores mínimos y máximos			
							if ( $nuevaPosicionFila <= 0){
								$nuevaPosicionFila = 1;
							}
							if ( $nuevaPosicionFila > 5){
								$nuevaPosicionFila = 5;
							}

							if ( $nuevaPosicionCols <= 0){
								$nuevaPosicionCols = 1;
							}
							if ( $nuevaPosicionCols > 5 ){
								$nuevaPosicionCols = 5;
							}
							
							// Actualizo la posicion de la fila en la MRC
							$sqlmov="UPDATE MOV_MatrizControl SET MOV_FilaMRC =$nuevaPosicionFila, MOV_ColumnaMRC = $nuevaPosicionCols WHERE MOV_CustomerKeyMRC='$CustomerKey' AND MOV_IdEventoMRC = $er AND MOV_TieneControlMRC ='S' AND MOV_IdMovimientoMRC = $MOV_IdMovimientoMRC";
							$query = sqlsrv_query($conn,$sqlmov);
							////echo "mov upd....".$sqlmov."<br>";
						}						
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