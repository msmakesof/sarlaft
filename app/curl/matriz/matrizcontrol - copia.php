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
	if( isset($_POST["er"]) && $_POST["er"] > 0 ){
		$er = $_POST["er"];
	}
	else {
		$er = 0;
	}
	
	if( isset($_POST["uk"]) && $_POST["uk"] > 0 ){
		$UserKey = $_POST["uk"];
	}
//Prametros para mover la bolita
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

	if( isset($_POST["pmoverfils"]) && $_POST["pmoverfils"] != "" ){
		$pmoverfils=$_POST["pmoverfils"];
	}
	else{
		$pmoverfils= 0 ;
	}	

	if( isset($_POST["pmovercols"]) && $_POST["pmovercols"] != "" ){
		$pmovercols=$_POST["pmovercols"];
	}
	else{
		$pmovercols= 0 ;
	}	
	
	if( isset($_POST['pposicionmover']) && $_POST['pposicionmover'] > 0){
		$pposicionmover = $_POST['pposicionmover'];	
	}
	else{
		$pposicionmover = 0;
	}
	
	if( isset($_POST['nrocontrol']) && $_POST['nrocontrol'] > 0){
		$nrocontrol = $_POST['nrocontrol'];	
	}
	else{
		$nrocontrol = 0;
	}
	
	// Cuantas filas y columnas me muevo 
	
	if( $pmoverfils == -1 && $pmovercols == 0 ){
		$posfil = $posfil - $pposicionmover;
		$poscol = $poscol;
	}
	else if($pmoverfils == 0 && $pmovercols == -1){
		$poscol = $poscol - $pposicionmover;
		$posfil = $posfil;	
	}
	else{
		$posfil = $posfil - $pposicionmover;
		$poscol = $poscol - $pposicionmover;
	}
	
	//Revisar esto
	if($posfil <=0 ){$posfil=0;}
	if($poscol <=0 ){$poscol=0;}
	//
	
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
		$getConnectionCli2 = new Database();
		$conn = $getConnectionCli2->getConnectionCli2($CustomerKey);
		
		//Para saber la posicion original en la Matriz de Riego Inherente
		$sqlmov=sqlsrv_query($conn,"SELECT TOP 1 MOV_FilaMRI, MOV_ColumnaMRI FROM MOV_MatrizInherente WHERE MOV_CustomerKeyMRI='".$CustomerKey."' AND MOV_IdEventoMRI =".$er." ORDER BY MOV_IdMovimientoMRI DESC ");
		$reg = sqlsrv_fetch_array($sqlmov);
		$FilsMRI =$reg['MOV_FilaMRI'];
		$ColsMRI =$reg['MOV_ColumnaMRI'];
		
		echo "1- Valores MRI  fils...$FilsMRI    Cols....$ColsMRI<br>";
		
		// Resto de la ubicacion original la fils y cols $pposicionmover
		////$FilsMRI = $FilsMRI - $pmoverfils;
		////$ColsMRI = $ColsMRI - $pmovercols;
		
		$FilsMover = 0;
		$ColsMover = 0;
		// Sumatoria por Filas y Columnas en la Matriz de Riesgo de Control o Residual
		$sqlmov=sqlsrv_query($conn,"SELECT SUM(MOV_MoverFilas) AS SumFils, SUM(MOV_MoverCols) AS SumCols FROM MOV_MatrizControl WHERE MOV_CustomerKeyMRC='".$CustomerKey."' AND MOV_IdEventoMRC =".$er." AND MOV_NumControl=".$nrocontrol);
		$regtot = sqlsrv_fetch_array($sqlmov);
		$SumFils = $regtot['SumFils'] ;
		$SumCols = $regtot['SumCols'] ;
		
		if($pmoverfils == 1 && $pmovercols == 1){  //Categoria Ambas
			$FilsMover = $pposicionmover;
			$ColsMover = $pposicionmover;
		}
		
		if($pmoverfils == 1 && $pmovercols == 0){ //Categoria Correctivo
			$FilsMover = $pposicionmover;
			$ColsMover = 0;  //$SumCols;
		}
		
		if($pmoverfils == 0 && $pmovercols == 1){  //Categoria Preventivo
			$FilsMover = 0;
			$ColsMover = $pposicionmover; //$SumFils; 
		}
		
		
		/*if ( is_null($SumFils) ) {
			$SumFils = $pmoverfils;
		}
		if ( is_null($SumCols) ) {
			$SumCols = $pmovercols;
		}*/
		
		echo "2- Sumatoria MRc  fils...$SumFils    Cols....$SumCols<br>";
		$SumFils = $SumFils + $FilsMover;
		$SumCols = $SumCols + $ColsMover; 
		
		
		// TEner en cuenta esto para la ubicacion actual
		$posfil = $FilsMRI - $SumFils;
		$poscol = $ColsMRI - $SumCols;
		
		echo "3- Nueva ubicacion MRc  fils...$posfil    Cols....$poscol<br>";
		
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
					
						
						$condimg = '<img src="../../img/circle.png" width="16px" height="16px" />';	
						// guardo la posicion actual de la fila y columna
						////$PosicioActualFils = $posfil;
						////$PosicioActualCols = $poscol;
						////echo "pos Filas....$PosicioActualFils.....pos Cols....$PosicioActualCols";
						
						//echo "pos Filas....$posfil.....pos Cols....$poscol";
						
						//echo "<input type='hidden' id='hfils' value='".$PosicioActualFils."'>"
						//echo "<input type='hidden' id='hcols' value='".$PosicioActualCols."'>"
						
						//guardo posicion
						
						date_default_timezone_set("America/Bogota");
						$DateStamp=date("Y-m-d H:i:s");	
						
						/*$sqlmov=sqlsrv_query($conn,"SELECT COUNT(MOV_IdMovimientoMRC) AS TotControl FROM MOV_MatrizControl WHERE MOV_CustomerKeyMRC='".$CustomerKey."' AND MOV_IdEventoMRC =".$er." AND MOV_NumControl=".$nrocontrol);
						$regcta = sqlsrv_fetch_array($sqlmov);
						$CuentaTotal = $regcta['TotControl'];
						
						if($CuentaTotal == 0){
							$sqlmov="INSERT INTO MOV_MatrizControl (MOV_IdEventoMRC, MOV_FilaMRC, MOV_ColumnaMRC, MOV_CustomerKeyMRC, MOV_DateStampMRC, MOV_TieneControlMRC, MOV_UserKeyMRC, MOV_MoverFilas, MOV_MoverCols, MOV_NumControl) VALUES (".$er.",".$posfil.",".$poscol.",'".$CustomerKey."','".$DateStamp."','S','".$UserKey."',".$pmoverfils.",".$pmovercols.",".$nrocontrol.")";
							echo "sq insert MC.......$sqlmov<br>";
							$query = sqlsrv_query($conn,$sqlmov);	
						}
						else{
							*/
							$sqlmov="UPDATE MOV_MatrizControl SET MOV_FilaMRC =$posfil, MOV_ColumnaMRC=$poscol, MOV_MoverFilas=$pmoverfils, MOV_MoverCols= $pmovercols WHERE MOV_CustomerKeyMRC=$CustomerKey AND MOV_IdEventoMRC = $er AND MOV_NumControl = $nrocontrol";
							echo "upd.........$sqlmov<br>";
							$query = sqlsrv_query($conn,$sqlmov);
						////}
						//
						
						
						
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