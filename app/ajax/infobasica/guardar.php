<?php
include '../is_logged.php';
//Archivo verifica que el usario que intenta acceder a la URL esta logueado
	if (empty($_POST['ActividadEconomicaName2'])){
		$errors[] = "Ingresa el nombre del Información Básica.";
	} 
	elseif (!empty($_POST['ActividadEconomicaName2']))
	{		

		function saltoLinea($str) {
			//return str_replace(array("\r\n", "\r", "\n"), "<br />", $str);
			return $str;
		} 

		//require_once ("../../components/sql_server_login.php");
		require_once '../../config/dbx.php';
		$getUrl = new Database();
		$urlServicios = $getUrl->getUrl();

		// escaping, additionally removing everything that could be (html/javascript-) code
		$nombre = saltoLinea($_POST["ActividadEconomicaName2"]);
		//echo "nombre...".$nombre."<br>";
		//$nombre = nl2br(htmlentities($nombre, ENT_QUOTES, 'UTF-8'));
		//$nombre = str_replace(' ','%20',strtoupper($nombre));
		//$nombre = str_replace('\r\n','</br>',strtoupper($nombre));
		//$nombre = nl2br($nombre);

		$ObjetoSocial = saltoLinea($_POST["ObjetoSocial"]);
		//$ObjetoSocial = nl2br(htmlentities($ObjetoSocial, ENT_QUOTES, 'UTF-8'));
		//$ObjetoSocial = str_replace(' ','%20',strtoupper($ObjetoSocial));
		//$ObjetoSocial = str_replace('\r\n','</br>',strtoupper($ObjetoSocial));
		//$ObjetoSocial = nl2br($ObjetoSocial);

		$DescripcionGeneral = saltoLinea($_POST["DescripcionGeneral"]);
		//$DescripcionGeneral = nl2br(htmlentities($DescripcionGeneral, ENT_QUOTES, 'UTF-8'));
		//$DescripcionGeneral = str_replace(' ','%20',strtoupper($DescripcionGeneral));
		//$DescripcionGeneral = str_replace('\r\n','</br>',strtoupper($DescripcionGeneral));
		//$DescripcionGeneral = nl2br($DescripcionGeneral);

		$ObjetivosEstrategicos = saltoLinea($_POST["ObjetivosEstrategicos"]);
		//$ObjetivosEstrategicos = nl2br(htmlentities($ObjetivosEstrategicos, ENT_QUOTES, 'UTF-8'));
		//$ObjetivosEstrategicos = str_replace(' ','%20',strtoupper($ObjetivosEstrategicos));
		//$ObjetivosEstrategicos = str_replace('\r\n','</br>',strtoupper($ObjetivosEstrategicos));
		//$ObjetivosEstrategicos = nl2br($ObjetivosEstrategicos);

		$Mision = saltoLinea($_POST["Mision"]);
		//$Mision = nl2br(htmlentities($Mision, ENT_QUOTES, 'UTF-8'));
		//$Mision = str_replace(' ','%20',strtoupper($Mision));
		//$Mision = str_replace('\r\n','</br>',strtoupper($Mision));
		//$Mision = nl2br($Mision);


		$Vision = saltoLinea($_POST["Vision"]);
		//$Vision = nl2br(htmlentities($Vision, ENT_QUOTES, 'UTF-8'));
		//$Vision = str_replace(' ','%20',strtoupper($Vision));
		//$Vision = str_replace('\r\n','</br>',strtoupper($Vision));
		//$Vision = nl2br($Vision);

		$query = "";
		$resultado = "";
		$msjx = "";
		// Se verifica si el nombre existe para evitar duplicados.
		$url = $urlServicios."api/infobasica/revisarnombre.php?nombre=$nombre&Mision=$Mision&Vision=$Vision&id=0";
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
			$InfoBasicaKey = time();
			$DateStamp = date("Y-m-d H:i:s");
			$params = "Nombre=$nombre&ObjetoSocial=$ObjetoSocial&DescripcionGeneral=$DescripcionGeneral&ObjetivosEstrategicos=$ObjetivosEstrategicos&Mision=$Mision&Vision=$Vision&CK=$CustomerKey&WK=$UserKey&IK=$InfoBasicaKey&DS=$DateStamp";
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

			$sql="INSERT INTO CLI_InfoBasica (CLI_ActividadEconomica, CLI_ObjetoSocial, CLI_DescripcionGeneral, CLI_Mision, CLI_Vision, CLI_ObjetivosEstrategicos, CLI_CustomerKey, CLI_InfoBasicaKey, CLI_USerKey, CLI_DateStamp) VALUES ('".htmlspecialchars(strip_tags($nombre))."','".htmlspecialchars(strip_tags($ObjetoSocial))."','".htmlspecialchars(strip_tags($DescripcionGeneral))."','".htmlspecialchars(strip_tags($Mision))."','".htmlspecialchars(strip_tags($Vision))."','".htmlspecialchars(strip_tags($ObjetivosEstrategicos))."','".htmlspecialchars(strip_tags($CustomerKey))."','".htmlspecialchars(strip_tags($UserKey))."','".htmlspecialchars(strip_tags($InfoBasicaKey))."','".htmlspecialchars(strip_tags($DateStamp))."')";
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
