<?php
/*  Creado por Mauricio Sanchez Sierra
*   Description: guarda información de la matriz de intersección
*/
include '../is_logged.php';
$json = $_POST['datos'];
require_once ("../../config/dbx.php");
$getConnectionCli2 = new Database();
$conn = $getConnectionCli2->getConnectionCli2($_SESSION['Keyp']);

date_default_timezone_set("America/Bogota");
$CustomerKey=$_SESSION['Keyp'];
$InterseccionKey=time();
$UserKey=$_SESSION['UserKey'];
$DateStamp=date("Y-m-d H:i:s");
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
	$gradado="S";
	$ins_interseccion= "S";	
	$sql = "";
	$posicion_color = "";
	$armar = "";
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
						}
						if($key2pos == 'color'){
							//echo $valor."<br>";
							$posicion_color .= $valor."'";
						}
					}
					$sql.="INSERT INTO INA_InterseccionArmar (INA_IdInterseccion, INA_Fila, INA_Color, INA_Columna) VALUES ($LastId, $posicion_color, '');";
					$posicion_color = "";
				}
			}
		}
	}
	//
	//Insert hacia Interseccion Armar
	//echo "sql2....$sql";
	$query = sqlsrv_query($conn,$sql);
	if( $query ){
		$gradado="S";
	}
	else{
		$gradado="N";
		$sql="";
		$sql="DELETE FROM INA_InterseccionArmar WHERE = INA_IdInterseccion = $LastId;";
		$sql.="DELETE FROM INT_Interseccion WHERE = INT_IdInterseccion = $LastId";
		$query = sqlsrv_query($conn,$sql);
	}
}
else{
	$ins_interseccion= "N";
	$gradado="S";
}
echo trim($gradado);
?>