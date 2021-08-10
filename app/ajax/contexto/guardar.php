<?php
include '../is_logged.php';
//Archivo verifica que el usario que intenta acceder a la URL esta logueado
	if (empty($_POST['Interno'])){
		$errors[] = "Ingresa el nombre del Contexto Interno.";
	} 
	elseif (!empty($_POST['Interno']))
	{		

		function saltoLinea($str) {
			//return str_replace(array("\r\n", "\r", "\n"), "<br />", $str);
			return $str;
		} 
		
		require_once '../../config/dbx.php';
		$getUrl = new Database();
		$urlServicios = $getUrl->getUrl();

		// escaping, additionally removing everything that could be (html/javascript-) code
		$Interno = saltoLinea($_POST["Interno"]);

		$Externo = saltoLinea($_POST["Externo"]);
		
		$query = "";
		$resultado = "";
		$msjx = "";
		// Se verifica si el nombre existe para evitar duplicados.
		$url = $urlServicios."api/contexto/revisarnombre.php?interno=$Interno&externo=$Externo&id=0";
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
			$messages[] = 'E';
		}
		else
		{		
			// Si todo va bien se hace el Insert
			$CustomerKey = $_SESSION['Keyp'];
			$UserKey = $_SESSION['UserKey'];
			date_default_timezone_set("America/Bogota");
			$ContextoKey = time();
			$DateStamp = date("Y-m-d H:i:s");
			//$params = "Nombre=$nombre&ObjetoSocial=$ObjetoSocial&DescripcionGeneral=$DescripcionGeneral&ObjetivosEstrategicos=$ObjetivosEstrategicos&Mision=$Mision&Vision=$Vision&CK=$CustomerKey&WK=$UserKey&IK=$InfoBasicaKey&DS=$DateStamp";
			/*
			$url = $urlServicios."api/infobasica/crear.php?$params";
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
			*/
			$getConnectionCli2 = new Database();
			$conn = $getConnectionCli2->getConnectionCli2($_SESSION['Keyp']);

			$sql="INSERT INTO CTX_Contexto ( CTX_Interno, CTX_Externo, CTX_CustomerKey, CTX_USerKey, CTX_ContextoKey, CTX_DateStamp) VALUES ('".htmlspecialchars(strip_tags($Interno))."','".htmlspecialchars(strip_tags($Externo))."','".htmlspecialchars(strip_tags($CustomerKey))."','".htmlspecialchars(strip_tags($UserKey))."','".htmlspecialchars(strip_tags($ContextoKey))."','".htmlspecialchars(strip_tags($DateStamp))."')";
    		$query = sqlsrv_query($conn,$sql);
			//echo $sql;
			// if InfoBasica has been added successfully
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
