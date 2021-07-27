<?php
/*********************************
Actualiza la matriz de interseccion
*********************************/
include '../is_logged.php';

//echo json_encode($_POST['datos']);
$json = $_POST['datos'];  //json_decode($_POST['datos']);  //
$idreg = $_POST['idreg'];   // Id del Registro Consultado

//rint_r($json);
//echo "<br>***********<br>gettype: ";
//echo gettype($json);

//$json = explode(', ', $json);
//print_r($json[0]);
//echo "<br>*************************<br>";
//echo "cantidad de regs...". count($json) ."<br>";

require_once ("../../config/dbx.php");
$getConnectionCli2 = new Database();
$conn = $getConnectionCli2->getConnectionCli2($_SESSION['Keyp']);


//Valido si la matriz esta presente en algún evento
$query_empresa=sqlsrv_query($conn,"SELECT id FROM GestiondeRiesgoSarlaft WHERE CustomerKey=".$_SESSION['Keyp']." AND GER_IdInterseccion = $idreg");
$reg=sqlsrv_fetch_array($query_empresa);
$gradado="E";

if(  $reg['id'] == 0  ){

	date_default_timezone_set("America/Bogota");
	$CustomerKey=$_SESSION['Keyp'];
	//echo "ck...$CustomerKey<br>";
	$InterseccionKey=time();
	$UserKey=$_SESSION['UserKey'];
	$DateStamp=date("Y-m-d H:i:s");
	//	echo "<br>*************************<br>";
	$gradado="";
	$insertcantidad = "";
	$fils = 0;
	$cols = 0;
	$posicionFilCol = "";
	foreach ($json as $key=>$value) {
		//echo "key. ".$key."<br>"; //." value ".$value."<br>";
		
		foreach($value as $key2=>$value2) {
			//echo "key2.. ". $key2."<br>";
			if( $key2 == 'cantidad' ){

				//echo "value2...".gettype($value2)."<br>";
				//print_r($value2);

				foreach($value2 as $key22=>$value22) {
					//echo "key22.. ".$key22."<br>";
					foreach($value22 as $key23=>$value23) {  // cantidad de filas y columnas
						//echo "key23... ".$key23." value23... ".$value23."<br>";
						if( $key23 == 'fil'){
							$fils = $value23;
						}
						else{
							$cols = $value23;
						}
					}	
				}
			}

		}		
	}

	//Insert hacia Interseccion
	$LastId = 0;
	$ins_interseccion= "N";
	$sql="INSERT INTO INT_Interseccion (INT_Filas, INT_Columnas, INT_CustomerKey, INT_UserKey, DateStamp, INT_InterseccionKey) VALUES (".$fils.",".$cols.",'".$CustomerKey."','".$UserKey."','".$DateStamp."','".$InterseccionKey."');  SELECT SCOPE_IDENTITY() as LastId; ";
	//echo "sql.......$sql";
	$query = sqlsrv_query($conn,$sql);
	$next_result = sqlsrv_next_result($query);
	$row = sqlsrv_fetch_array($query); 
	$LastId = $row['LastId'];
	if( $query ){
		
		
	//}
	//$haceupdate = "U";
	//if( $haceupdate == "U" ){
		//echo "OK Update";
		$gradado="S";
		$ins_interseccion= "S";	
		$sql = "";
		$posicion_color = "";
		$armar = "";
		
		// pra el update usamos $posicion y $color por separado
		$posicion ="";
		$color ="";
		//

		foreach ($json as $key=>$value) {
			//echo "key. ".$key."<br>"; //." value ".$value."<br>";
			
			foreach($value as $key2=>$value2) {
				//echo "key2.. ". $key2."<br>";	
				if( $key2 == 'posicion' ){
					foreach($value2 as $keypos=>$valuepos) {
						//echo "keypos.. ".$keypos."<br>";
						foreach($valuepos as $key2pos=>$valor) {  // posicion y color
							//echo "key2pos... ".$key2pos." value... ".$value2color."<br>";
							if($key2pos == 'pos'){
								//echo $valor.'   ';
								$posicion_color .= "'".$valor."', '";
								////$posicion = "'".$valor."'";
							}
							if($key2pos == 'color'){
								//echo $valor."<br>";
								$posicion_color .= $valor."'";
								////$color .= "'".$valor."'";
								
							}
						}

						$sql.="INSERT INTO INA_InterseccionArmar (INA_IdInterseccion, INA_Fila, INA_Color, INA_Columna) VALUES ($LastId, $posicion_color, '');";
						//$sql.="UPDATE INA_InterseccionArmar SET INA_Color = $color WHERE INA_IdInterseccion = $idreg AND INA_Fila = $posicion ;";
						$posicion_color = "";
						////$posicion ="";
						/////$color ="";
					}
				}
			}
		}
		
		$query = sqlsrv_query($conn,$sql);
		if( $query ){
			$sqldel="DELETE FROM INA_InterseccionArmar WHERE INA_IdInterseccion = $idreg " ;
			$query = sqlsrv_query($conn,$sqldel);
			$sqldel="DELETE FROM INT_Interseccion WHERE INT_IdInterseccion = $idreg AND INT_CustomerKey = $CustomerKey" ;
			$query = sqlsrv_query($conn,$sqldel);
			$gradado="S";
		}
		else{
			$gradado="N";
			$sql="";
		}
	}
	else{
		//echo "No";	
		$ins_interseccion= "N";
		$gradado="N";
	}
}
//$sql.' - '.
echo trim($gradado);
?>