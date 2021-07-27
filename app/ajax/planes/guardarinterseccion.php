<?php
include '../is_logged.php';

//echo json_encode($_POST['datos']);

$json = $_POST['datos'];
print_r($json);
//print_r($json[0]);
//echo "<br>*************************<br>";
//echo "cantidad de regs...". count($json) ."<br>";

require_once ("../../config/dbx.php");
$getConnectionCli2 = new Database();
$conn = $getConnectionCli2->getConnectionCli2($_SESSION['Keyp']);

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

		/* if( $key2 == 'posicion' ){
			foreach($value2 as $keypos=>$valuepos) {
				//echo "keypos.. ".$keypos."<br>";
				foreach($valuepos as $key2pos=>$valor) {  // posicion y color
					//echo "key2pos... ".$key2pos." value... ".$value2color."<br>";
					if($key2pos == 'pos'){
						echo $valor.'   '; 
					}
					if($key2pos == 'color'){
						echo $valor."<br>"; 
					}
					$posicionFilCol = "";
				}	
			}
		} */
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
	//echo "OK";
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
	//echo "No";	
	$ins_interseccion= "N";
	$gradado="S";
}
echo trim($gradado);
//
/*
if ( $ins_interseccion == "S" ){
	$sql = "INSERT INTO  (INA_IdInterseccion, INA_Fila, INA_Columna, INA_Color) VALUES (".$LastId.")";
	$query = sqlsrv_query($conn,$sql);
	if($query){

	}
	else{

	}
}*/
///////////////////7






/*
foreach ($_POST['datos'] as $value) {
	if( $value['fil'] || $value['col'] ){
		$cadena = "Filas: '". $value['fil'] ."', y Cols: ". $value['col'] ."},";
		print ($cadena);
	}
	else {

		$cadena = "Posicion es: '". $value['pos'] ."', y color es: ". $value['color'] ."},";
		print ($cadena);
	}
}
*/





/*
//Archivo verifica que el usario que intenta acceder a la URL esta logueado
	if (empty($_POST['Name2'])){
		$errors[] = "Ingresa el nombre del Plan.";
	} 
	elseif (!empty($_POST['Name2']))
	{		
		
		
		//require_once ("../../components/sql_server_login.php");
		require_once '../../config/dbx.php';
		$getUrl = new Database();
		$urlServicios = $getUrl->getUrl();

		// escaping, additionally removing everything that could be (html/javascript-) code
		$nombre = trim($_POST["Name2"]);
		$nombre = str_replace(' ','%20',strtoupper($nombre));
		$responsable = trim($_POST["responsable"]);
		$plazo = trim($_POST["plazo"]);
		$aprueba = trim($_POST["aprueba"]);
		$respseguimiento = trim($_POST["respseguimiento"]);
		$nivelprioridad = trim($_POST["nivelprioridad"]);
		$respaprobacion = trim($_POST["respaprobacion"]);
		$fechainicio = trim($_POST["fechainicio"]);
		$fechaseguimiento = trim($_POST["fechaseguimiento"]);
		$fechaterminacion = trim($_POST["fechaterminacion"]);
		$avance = trim($_POST["avance"]);
		$CustomerKey = $_SESSION['Keyp'];
		$UserKey = $_SESSION['UserKey'];

		$query = "";
		$resultado = "";
		$msjx = "";
		// Se verifica si el nombre existe para evitar duplicados.
		$url = $urlServicios."api/planes/revisarnombre.php?nombre=$nombre&id=0";
		
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
		$query = json_decode($mestado, true);
		$json_errors = array(
			JSON_ERROR_NONE => 'No se ha producido ningún error',
			JSON_ERROR_DEPTH => 'Maxima profundidad de pila ha sido excedida',
			JSON_ERROR_CTRL_CHAR => 'Error de carácter de control, posiblemente codificado incorrectamente',
			JSON_ERROR_SYNTAX => 'Error de Sintaxis',
		);
		$contar = $query["encontrados"];
		if($contar == ''){ $contar = 0;}
		
		if( $contar > 0)
		{			
			$messages[] = 'E';
		}
		else
		{		
			// Si todo va bien se hace el Insert
			$params = "Nombre=$nombre&responsable=$responsable&plazo=$plazo&aprueba=$aprueba&respseguimiento=$respseguimiento&nivelprioridad=$nivelprioridad&respaprobacion=$respaprobacion&fechainicio=$fechainicio&fechaseguimiento=$fechaseguimiento&fechaterminacion=$fechaterminacion&avance=$avance&ck=$CustomerKey&uk=$UserKey";
			$url = $urlServicios."api/planes/crear.php?$params";
			//echo $url;
			$query = "";
			$resultado = "";
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
			$query = $mestado;
			
			$json_errors = array(
				JSON_ERROR_NONE => 'No se ha producido ningún error',
				JSON_ERROR_DEPTH => 'Maxima profundidad de pila ha sido excedida',
				JSON_ERROR_CTRL_CHAR => 'Error de carácter de control, posiblemente codificado incorrectamente',
				JSON_ERROR_SYNTAX => 'Error de Sintaxis',
			);
			
			// if product has been added successfully
			if ($query) {
				$messages[] = "O";
			} else {
				$errors[] = 'R';
			}
		}		
	} 
	else 
	{
		$errors[] = "D";
	}
	
	if (isset($errors)){
		foreach ($errors as $error) {
			$msjx = $error; 
		}
	}
	if (isset($messages)){	
		foreach ($messages as $message) {
			$msjx =$message; 
		}
	}	
	echo $msjx;

*/	
?>