<?php
include '../is_logged.php';
//Archivo verifica que el usario que intenta acceder a la URL esta logueado
	if (empty($_POST['Name2'])){
		$errors[] = "Ingresa Descripción de la Tarea.";
	} 
	elseif (!empty($_POST['Name2']))
	{
		require_once '../../config/dbx.php';
		$getUrl = new Database();
		$urlServicios = $getUrl->getUrl();

		// escaping, additionally removing everything that could be (html/javascript-) code
		$nombre = trim($_POST["Name2"]);
		////$nombre = str_replace(' ','%20',strtoupper($nombre));
		$ck = trim($_POST["CustomerKey"]);
		$idplan = trim($_POST["IdPlan"]);
		
		$query = "";
		$resultado = "";
		$msjx = "";
		// Se verifica si el nombre existe para evitar duplicados.
		$url = $urlServicios."api/tareas/revisarnombre.php?nombre=$nombre&ck=".$_SESSION['Keyp']."&idplan=".$idplan."&id=0";
		
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
			$CustomerKey = $_SESSION['Keyp'];
			$UserKey = $_SESSION['UserKey'];
			////$params = "Nombre=$nombre&CK=$CustomerKey&UK=$UserKey&IdPlan=$idplan";
			////$url = $urlServicios."api/tareas/crear.php?$params";			
			//echo $url;
			
			/*
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
			);  */
			
			date_default_timezone_set("America/Bogota");
			$TareasKey = time();
			$DateStamp = date("Y-m-d H:i:s");

			$getConnectionCli2 = new Database();
			$conn = $getConnectionCli2->getConnectionCli2($_SESSION['Keyp']);

			$sqlQuery = "INSERT INTO TareasPlan (TPP_IdPlan, TPP_NombreTarea, TPP_CustomerKey, TPP_UserKey, TPP_TareasKey, DateStamp ) VALUES ( ".htmlspecialchars(strip_tags($idplan)).", '".htmlspecialchars(strip_tags($nombre))."','".htmlspecialchars(strip_tags($CustomerKey))."','".htmlspecialchars(strip_tags($UserKey))."','".htmlspecialchars(strip_tags($TareasKey))."','".htmlspecialchars(strip_tags($DateStamp))."')";
			$query = sqlsrv_query($conn,$sqlQuery);			
			
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
?>