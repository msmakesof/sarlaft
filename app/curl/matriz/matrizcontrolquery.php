<?php
/*********************************************
Author: Mauricio Sanchez Sierra
Date: 2021-07-27
Description:  Programa para calcular ubicacion de 
la bolita en la Matriz de Control o Residual
(Algoritmo de calculo para la MRC o MRR)
**********************************************/
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
	// Customer Key
	if( isset($_POST["ck"]) && $_POST["ck"] != "" ){
		$CustomerKey=$_POST["ck"];
	}
	else{
		$CustomerKey=$CustomerKey;
	}
	
	// User Key
	if( isset($_POST["uk"]) && $_POST["uk"] > 0 ){
		$UserKey = $_POST["uk"];
	}
	
	// Número del Evento de Riesgo
	if( isset($_POST["er"]) && $_POST["er"] > 0 ){
		$er = $_POST["er"];
	}
	else {
		$er = $er;
	}

	// Mover Bolita [S/N]
	if( isset($_POST["moverbol"]) && $_POST["moverbol"] !="" ){
		$moverbol = $_POST["moverbol"];
	}
	else {
		$moverbol = 'N';
	}	
	
	//Parametros para mover la bolita
	if( isset($_POST["pfila"]) && $_POST["pfila"] > 0 ){
		$posfil = $_POST["pfila"];
		//$poscol = 1;
	}
	else {
		$posfil = $FilaMRC;
	}
	///echo "$posfil";	

	if( isset($_POST["pcols"]) && $_POST["pcols"] > 0 ){
		$poscol = $_POST["pcols"];
		//$posfil = 1;
	}
	else {
		$poscol = $ColumnaMRC;
	}	
	///echo "$poscol";
	// Mover Abajo 1= S, 0 = N
	if( isset($_POST["pmoverAbajo"]) && $_POST["pmoverAbajo"] != "" ){
		$pmoverfils=$_POST["pmoverAbajo"];
	}
	else{
		$pmoverfils= 0 ;
	}

	// Mover hacia Izquierda 1= S, 0 = N
	if( isset($_POST["pmoverIzquierda"]) && $_POST["pmoverIzquierda"] != "" ){
		$pmovercols=$_POST["pmoverIzquierda"];
	}
	else{
		$pmovercols= 0 ;
	}	
	
	// Cantidad de posiciones a Mover 1 o 2
	if( isset($_POST['pposicionAmover']) && $_POST['pposicionAmover'] > 0){
		$pposicionmover = $_POST['pposicionAmover'];	
	}
	else{
		$pposicionmover = 0;
	}
	
	// Número del control
	if( isset($_POST['nrocontrol']) && $_POST['nrocontrol'] > 0){
		$nrocontrol = $_POST['nrocontrol'];	
	}
	else{
		$nrocontrol = 0;
	}
	/////echo "nrocontrol...$nrocontrol<br>";
	
	// Nro del Registro de Matriz Control que se está trabajando
	$IdMovimientoMRC = $nrocontrol;
	
	// Ruta del archivo de conexion
	if( isset($_POST["ruta"]) && $_POST["ruta"] != "" ){
		$ruta=$_POST["ruta"];
	}
	else{
		$ruta="";
	}

/**************[ NO ]**************
//echo "posfil....$posfil<br>";
//echo "poscol....$poscol<br>";
//echo "ck...".$CustomerKey;
**********************************/

// mks 20210516  verificar cUrl
require_once $ruta.'../config/dbx.php';
$getUrl = new Database();
$urlServicios = $getUrl->getUrl();
if(function_exists('curl_init')) // Comprobamos si hay soporte para cURL
{	
    $url = $urlServicios."api/interseccion/idmatriz.php?ck=".$CustomerKey;   // Esto es para pintar las matriz
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
		$getConnectionCli2 = new Database();
		$conn = $getConnectionCli2->getConnectionCli2($CustomerKey);
		
		// Para saber la posicion (Fils, Cols) original de la Matriz de Riesgo Inherente, No se hace como API porque 
		// esto se va a trabajar internamente y no hacia sistemas externos
		$sqlmov=sqlsrv_query($conn,"SELECT TOP 1 MOV_FilaMRI, MOV_ColumnaMRI FROM MOV_MatrizInherente WHERE MOV_CustomerKeyMRI='".$CustomerKey."' AND MOV_IdEventoMRI =".$er." ORDER BY MOV_IdMovimientoMRI DESC ");
		$reg = sqlsrv_fetch_array($sqlmov);
		
		$PosActualFilsMRI =$reg['MOV_FilaMRI'];      // Posicion Actual para Fila
		$PosActualColsMRI =$reg['MOV_ColumnaMRI'];   // Posicion Actual para Columna 
		
		//*echo "1- Valores MRI  fils...$PosActualFilsMRI    Cols....$PosActualColsMRI<br>";
		
		$MOV_FilsMovidas = 0;
		$MOV_ColsMovidas = 0;
		// Para la cantidad de posiciones q movió para Fils y Cols, esto será usado en la sumatoria para cada control
		// Debo tener en cuenta cuando haya cambio en Posibilidad y Consecuencia en la MRI
		/////echo "multi fils:  $pmoverfils * $pposicionmover<br>";
		/////echo "multi cols:  $pmovercols * $pposicionmover<br>";
		
		if($moverbol == "N"){
			$MOV_FilsMovidas = 0;
			$MOV_ColsMovidas = 0;
			$pposicionmover = 0;
			$pmoverfils = 0;
			$pmovercols = 0;
		} 
		else {
			$MOV_FilsMovidas = $pmoverfils * $pposicionmover ;
			$MOV_ColsMovidas = $pmovercols * $pposicionmover;
		}
		
		//*echo "echo 2- Filas movidas MOV_FilsMovidas.....$MOV_FilsMovidas    Cols Movidas:: MOV_ColsMovidas......$MOV_ColsMovidas<br>";
		
		////  Resto filas y columnas movidas a la posición actual de la MRI
		$posfilx = $PosActualFilsMRI - $MOV_FilsMovidas;
		$poscolx = $PosActualColsMRI - $MOV_ColsMovidas;
			
			$DELMX = $IdMovimientoMRC;
			//*echo "DELMX....$DELMX<br>";			

			$sqlmov="";
			// Verificar si existe un control del evento de riesgo grabado en MOV_MatrizControl
			$sqlmov=sqlsrv_query($conn,"SELECT COUNT(MOV_IdMovimientoMRC) AS TotControl FROM MOV_MatrizControl WHERE MOV_CustomerKeyMRC='".$CustomerKey."' AND MOV_IdEventoMRC =".$er." AND MOV_NumControl=".$nrocontrol." AND MOV_IdMovimientoMRC =".$DELMX." AND MOV_TieneControlMRC = 'S' AND MOV_Estado <> 'D' ");

			$regcta = sqlsrv_fetch_array($sqlmov);
			$CuentaTotal = $regcta['TotControl'];
			/////echo "Antes de ins o upd    CuentaTotal....$CuentaTotal<br>";
			
			date_default_timezone_set("America/Bogota");
			$DateStamp=date("Y-m-d H:i:s");	
			
			if($CuentaTotal == 0){						
				$sqlmov="INSERT INTO MOV_MatrizControl (MOV_IdEventoMRC, MOV_FilaMRC, MOV_ColumnaMRC, MOV_CustomerKeyMRC, MOV_DateStampMRC, MOV_TieneControlMRC, MOV_UserKeyMRC, MOV_MoverFilas, MOV_MoverCols, MOV_PosicionesAMover, MOV_NumControl, MOV_FilsMovidas, MOV_ColsMovidas) VALUES (".$er.",".$posfilx.",".$poscolx.",'".$CustomerKey."','".$DateStamp."','S','".$UserKey."',".$pmoverfils.",".$pmovercols.",".$pposicionmover.",".$nrocontrol.",".$MOV_FilsMovidas.",".$MOV_ColsMovidas.")";	
				////echo "sq insert MC.......$sqlmov<br>";
				/////$query = sqlsrv_query($conn,$sqlmov);	
			}
			else{							
				$sqlmov="UPDATE MOV_MatrizControl SET MOV_FilaMRC =$posfilx, MOV_ColumnaMRC=$poscolx, MOV_MoverFilas=$pmoverfils, MOV_MoverCols= $pmovercols, MOV_FilsMovidas = $MOV_FilsMovidas, MOV_ColsMovidas = $MOV_ColsMovidas, MOV_UserKeyMRC='$UserKey', MOV_DateStampMRC='$DateStamp', MOV_PosicionesAMover=$pposicionmover WHERE MOV_CustomerKeyMRC='$CustomerKey' AND MOV_IdEventoMRC = $er AND MOV_NumControl = $nrocontrol AND MOV_IdMovimientoMRC = $DELMX";
				////echo "upd.........$sqlmov<br>";
				$query = sqlsrv_query($conn,$sqlmov);
			}
			
			$cadena = str_replace("'",'"',$sqlmov);
			$MAC = '';
			ob_start();
			system('ipconfig/all');
			$mycom=ob_get_contents(); 
			ob_clean(); 
			$findme = "Physical";
			$pmac = strpos($mycom, $findme); 
			$MAC=substr($mycom,($pmac+36),17);
			
			// ingresa registro en el log de Auditoria
			$sqllog="INSERT INTO LOG_LogAuditoria (LOG_CustomerKey, LOG_UserKey, LOG_Accion, LOG_Descripcion, LOG_IpAddress, LOG_Module, LOG_DateStamp) VALUES ('$CustomerKey','$UserKey','Grabar', '$cadena','$MAC','Evento de Riesgo','$DateStamp') ";
			$query = sqlsrv_query($conn,$sqllog);
			//echo "sqllog....$sqllog<br>";
		
		// Sumatoria por Filas y Columnas en la Matriz de Riesgo de Control o Residual
		$sqlmov=sqlsrv_query($conn,"SELECT SUM(MOV_FilsMovidas) AS SumFils, SUM(MOV_ColsMovidas) AS SumCols FROM MOV_MatrizControl WHERE MOV_CustomerKeyMRC='".$CustomerKey."' AND MOV_IdEventoMRC =".$er." AND MOV_Estado <> 'D' ") ;
		$regtot = sqlsrv_fetch_array($sqlmov);
		$SumFils = $regtot['SumFils'] ;
		$SumCols = $regtot['SumCols'] ;
		
		if ( is_null($SumFils) ) {
			$SumFils = 0;
		}
		if ( is_null($SumCols) ) {
			$SumCols = 0;
		}
		
		//*echo "2-1  filas Movidas en DB..$SumFils    Cols  Movidas en DB..$SumCols<br>";
		$Sum_FilsMovidas = 0;
		$Sum_ColsMovidas = 0;
		$Sum_FilsMovidas = $SumFils ;
		$Sum_ColsMovidas = $SumCols ;
		
		//echo "2-2  Sumat Movidas:: $SumFils + $MOV_FilsMovidas    Sumat Cols  Movidas:: $SumCols + $MOV_ColsMovidas<br>";
		
		// Ubicar la bolita en su nueva posicion (Fil, Col) en MRC
		$posfil = $PosActualFilsMRI - $SumFils ;
		$poscol = $PosActualColsMRI - $SumCols ;
		
		// Para evitar que la bolita desaparezca de la matriz para los valores mínimos y máximos
		if($nrocontrol > 0){	
			if ( $posfil <= 0){
				$posfil = 1;
			}
			if ( $posfil > 5){
				$posfil = 5;
			}
			
			if ( $poscol <= 0){
				$poscol = 1;
			}
			if ( $poscol > 5 ){
				$poscol = 5;
			}
		}
	
		//*echo "3- Nueva ubicacion MRc  fils...$posfil    Cols....$poscol<br>";
		//Actualizo la nueva ubicación de la bolita en MRC
		$sqlmov="UPDATE MOV_MatrizControl SET MOV_FilaMRC =$posfil, MOV_ColumnaMRC=$poscol WHERE MOV_CustomerKeyMRC='$CustomerKey' AND MOV_IdEventoMRC = $er AND MOV_NumControl = $nrocontrol AND MOV_IdMovimientoMRC = $DELMX";
		$query = sqlsrv_query($conn,$sqlmov);
		
		//Después de ubicar la bolita debo actualizar los textos de los labels de acuerdo a la nueva posición de ella		
		
		if( $dataintermatriz["itemCount"] > 0)
		{
			$fil = "";
			$col = "";
			$tabla="";
			for($i=0; $i<1; $i++)
			{
				$fil = $dataintermatriz['body'][$i]["INT_Filas"];    //Cantidad de Filas
				$col = $dataintermatriz['body'][$i]["INT_Columnas"]; //Cantidad de Columnas
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
						////* $condimg = '<img src="../../img/circle.png" width="10px" height="10px"/>';
						$condimg = '<img src="../../img/circle.png" width="16px" height="16px"/>';
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