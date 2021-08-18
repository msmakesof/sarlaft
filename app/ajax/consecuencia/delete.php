<?php
include('../is_logged.php');
if (empty($_POST['delete_id'])){
	$errors[] = "Id vacío.";
} 
elseif (!empty($_POST['delete_id']))
{
	$CustomerKey = $_SESSION['Keyp'];
	$id=intval($_POST['delete_id']);

	require_once '../../config/dbx.php';

	// Para redimensionar la matriz de intersección
	// Antes de borrar el registro de la Consecuencia, verifico si ya tiene un Evento de Riesgo
	$getConnectionCli2 = new Database();
	$conn = $getConnectionCli2->getConnectionCli2($_SESSION['Keyp']);

	// Obtengo el Id de la Matriz de Intersección teniendo en cuenta que un cliente solo puede tener una sola Matriz creada.
	$sqlmov=sqlsrv_query($conn,"SELECT MAX(INT_IdInterseccion) AS TMAX FROM INT_Interseccion WHERE INT_CustomerKey='".$CustomerKey."'");
	$reg = sqlsrv_fetch_array($sqlmov);	
	$IdInterseccion = $reg['TMAX'];

	// Verificso si ese Id ya fue usando en un Evento de Riesgo
	$sqlmov=sqlsrv_query($conn,"SELECT COUNT(EVRI_IdInterseccion) AS Total FROM EVRI_EventoRiesgo WHERE EVRI_IdInterseccion=".$IdInterseccion." AND EVRI_CustomerKey='".$CustomerKey."'");
	$reg = sqlsrv_fetch_array($sqlmov);
	$Total = $reg['Total'];
	$msjx = "";

	if($Total > 0){
		$messages[] = "X"; //"Existe un Evento de Riesgo utilizando la Intersección y No se Puede Borrar";
	}
	else{

		// Busco la Escala para saber que Columna debo Borrar
		$query=sqlsrv_query($conn,"SELECT CSC_Escala FROM CSC_Consecuencia WHERE CSC_IdConsecuencia=".$id." AND CSC_CustomerKey ='".$CustomerKey."'");
		$reg=sqlsrv_fetch_array($query);
		$Escala = $reg['CSC_Escala'];

		// Borro los registros q corresponden a la posicion de la Columna de acuerdo a la Escala para Redimensionar la Matriz.
		$ColDelete = 'c'.$IdInterseccion;  // posicion de la Columna a Borrar
		$querydel=sqlsrv_query($conn,"DELETE FROM INA_InterseccionArmar WHERE INA_IdInterseccion=".$IdInterseccion." AND substring(INA_Fila,3,2) = '".$ColDelete."'");
		$regtit=sqlsrv_fetch_array($querydel);

		//Redimensiono las columnas en la Matriz de Interseccion
		$queryupd=sqlsrv_query($conn,"UPDATE INT_Interseccion SET INT_Columnas = INT_Columnas - 1 WHERE INT_IdInterseccion=".$IdInterseccion." AND INT_CustomerKey = '".$CustomerKey."'");
		$regtit=sqlsrv_fetch_array($queryupd);

		$getUrl = new Database();
		$urlServicios = $getUrl->getUrl();	
		
		$query="";		
		$url = $urlServicios."api/consecuencia/delete.php?id=$id";
		//echo "url...$url";
		
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
		$query = $mestado; //json_decode($mestado, true);
		
		$json_errors = array(
			JSON_ERROR_NONE => 'No se ha producido ningún error',
			JSON_ERROR_DEPTH => 'Maxima profundidad de pila ha sido excedida',
			JSON_ERROR_CTRL_CHAR => 'Error de carácter de control, posiblemente codificado incorrectamente',
			JSON_ERROR_SYNTAX => 'Error de Sintaxis',
		);

		// if product has been added successfully
		if ($query) {

			$messages[] = "B"; //"Borrar";
		} else {
			$errors[] = "R"; //Error de conexión.";
		}
	}		
} 
else 
{
	$errors[] = "D"; //desconocido.";
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
?>			