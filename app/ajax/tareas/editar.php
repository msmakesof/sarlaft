<?php
include '../is_logged.php';
if (empty($_POST['eid'])){
	$errors[] = "ID está vacío.";
} 
elseif (!empty($_POST['eid']))
{
	require_once '../../config/dbx.php';
	$getUrl = new Database();
	$urlServicios = $getUrl->getUrl();
	
	// escaping, additionally removing everything that could be (html/javascript-) code
	$nombre = trim($_POST["eName2"]);
	////$nombre = str_replace(' ','%20',strtoupper($nombre));
	$ck = trim($_POST["eCustomerKey"]);
	$idplan = intval($_POST["eIdPlan"]);
	$id=intval($_POST['eid']);
	
	$query = "";
	$resultado = "";
	$msjx = "";
	// Se verifica si el nombre existe para evitar duplicados.	
	$url = $urlServicios."api/tareas/revisarnombre.php?nombre=$nombre&ck=$ck&idplan=$idplan&id=$id";
	//echo $url;
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
		$messages[] = "E"; //'Ya existe un Registro grabado con el mismo Nombre.' ;
	}
	else
	{		
		$query="";		
		// Si todo va bien se hace el Update
		////$params = "Nombre=$nombre&Id=$id&CK=$ck&IdPlan=$idplan";
		////$url = $urlServicios."api/tareas/update.php?$params";
		//echo "url...$url";
		
		/* $resultado="";
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
		);   */
		$getConnectionCli2 = new Database();
		$conn = $getConnectionCli2->getConnectionCli2($_SESSION['Keyp']);
			
		$sqlQuery = "UPDATE TareasPlan SET TPP_NombreTarea = '".htmlspecialchars(strip_tags($nombre))."'
                    WHERE TPP_IdTareaxPlan = $id AND TPP_IdPlan = $idplan AND TPP_CustomerKey = $ck ";
		$query = sqlsrv_query($conn,$sqlQuery);			
		
		// if rol has been updated successfully
		if ($query) {
			$messages[] = "U"; //Update.";
		} else {
			$errors[] = "R"; //Error falla en la conexión.";
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