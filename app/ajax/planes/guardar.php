<?php
include '../is_logged.php';
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
?>
