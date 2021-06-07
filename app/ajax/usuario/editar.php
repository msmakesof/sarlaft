<?php
if (empty($_POST['edit_id'])){
	$errors[] = "ID está vacío.";
} 
elseif (!empty($_POST['edit_id']))
{
	////require_once ("../components/sql_server_login.php");		
	require_once '../../config/dbx.php';
	$getUrl = new Database();
	$urlServicios = $getUrl->getUrl();
	
	// escaping, additionally removing everything that could be (html/javascript-) code
	$customerkey2 = trim($_POST["edit_customerkey2"]);
	$customernombre = trim($_POST["edit_name"]);
	$customernombre = str_replace(' ','%20',strtoupper($customernombre));
	$email = strtolower(trim($_POST["edit_email"]));
	$password2 = trim($_POST["edit_password2"]);
	$estado = $_POST["edit_estado"];
	$id=intval($_POST['edit_id']);
	
	$query = "";
	$resultado = "";
	$msjx = "";
	// Se verifica si el nombre existe para evitar duplicados.
	$url = $urlServicios."api/usuario/revisarnombre.php?nombre=$customernombre&id=$id";
	
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
		//$txtalert = "alert-warning";
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
		$password_encrypted = my_encrypt($password2, $key);			
		$Password2 = $password_encrypted;
		
		$query="";		
		// Si todo va bien se hace el Update
		$params = "CustomerKey=$customerkey2&NombreUsuario=$customernombre&Email=$email&Password=$Password2&Estado=$estado&Id=$id";
		$url = $urlServicios."api/usuario/update.php?$params";
		//echo "url...$url";
		//echo "<script>console.log(url......".$url.");</script>";
		
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