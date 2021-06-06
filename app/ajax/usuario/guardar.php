<?php
//Archivo verifica que el usario que intenta acceder a la URL esta logueado
	if (empty($_POST['UserName2'])){
		$errors[] = "Ingresa el nombre del Usuario.";
	} 
	elseif (!empty($_POST['UserName2']))
	{		
		//require_once ("../../components/sql_server_login.php");
		require_once '../../config/dbx.php';
		$getUrl = new Database();
		$urlServicios = $getUrl->getUrl();

		// escaping, additionally removing everything that could be (html/javascript-) code
		$usuariocustomer = trim($_POST["CustomerKey2"]);
		$usuarionombre = trim($_POST["UserName2"]);
		$usuarionombre = str_replace(' ','%20',strtoupper($usuarionombre));
		$usuarioemail = trim(strtolower($_POST["Email"]));
		$usuariopwd = trim($_POST["Password2"]);
		$estado = $_POST["estado"];
		
		$query = "";
		$resultado = "";
		$msjx = "";
		// Verificar si el nombre existe para evitar duplicados.
		$url = $urlServicios."api/usuario/revisarnombre.php?nombre=$usuarionombre&id=0";
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
			// Para cifrar la clave
			$url = $urlServicios."api/control/read.php";
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
			$data = json_decode($mestado, true);
			$json_errors = array(
				JSON_ERROR_NONE => 'No se ha producido ningún error',
				JSON_ERROR_DEPTH => 'Maxima profundidad de pila ha sido excedida',
				JSON_ERROR_CTRL_CHAR => 'Error de carácter de control, posiblemente codificado incorrectamente',
				JSON_ERROR_SYNTAX => 'Error de Sintaxis',
			);
			
			$CON_LlaveAcceso ="";
			if( $data["itemCount"] > 0)
			{
				for($i=0; $i<count($data['body']); $i++)
				{
					$CON_IdControl = $data['body'][$i]['CON_IdControl'];
					$CON_LlaveAcceso = $data['body'][$i]['CON_LlaveAcceso'];
					$CON_LlaveInicial= $data['body'][$i]['CON_LlaveInicial'];
					$CON_LlaveIv = $data['body'][$i]['CON_LlaveIv'];
					$CON_MetodoEncriptacion = $data['body'][$i]['CON_MetodoEncriptacion'];
					$CON_TipoHash = $data['body'][$i]['CON_TipoHash'];
					$CON_Cookie = $data['body'][$i]['CON_Cookie'];
				}				
			}
			
			include_once("gateway.php");
			$key = $CON_LlaveAcceso;
			$encryption_key_256bit = base64_encode(openssl_random_pseudo_bytes(64));
			$password_encrypted = my_encrypt($usuariopwd, $key);			
			$usuariopwd = $password_encrypted;
			
			// Si todo va bien se hace el Insert
			$params = "UsuarioCustomerKey=$usuariocustomer&NombreUsuario=$usuarionombre&Email=$usuarioemail&Password=$usuariopwd&Estado=$estado";
			$url = $urlServicios."api/usuario/crear.php?$params";			

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
		//$messages[] = "O".'-'.$url;		
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
