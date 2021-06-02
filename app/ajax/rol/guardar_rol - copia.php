<?php
//Archivo verifica que el usario que intenta acceder a la URL esta logueado
	if (empty($_POST['UserName2'])){
		$errors[] = "Ingresa el nombre del Rol.";
	} 
	elseif (!empty($_POST['UserName2']))
	{		
		//require_once ("../../components/sql_server_login.php");
		require_once '../../config/dbx.php';
		$getUrl = new Database();
		$urlServicios = $getUrl->getUrl();

		// escaping, additionally removing everything that could be (html/javascript-) code
		$rolnombre = trim($_POST["UserName2"]);
		$rolnombre = str_replace(' ','%20',strtoupper($rolnombre));
		$estado = $_POST["estado"];

		$query = "";
		$resultado = "";
		// Se verifica si el nombre existe para evitar duplicados.
		$url = $urlServicios."api/rol/revisarnombre.php?nombre=$rolnombre&id=0";
		
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
			$data = 'Ya existe un Registro grabado con el mismo Nombre.' ;
			$txtalert = "alert-warning";
			$type = "warning";
		}
		else
		{		
			// Si todo va bien se hace el Insert
			$params = "RolNombre=$rolnombre&Estado=$estado";
			$url = $urlServicios."api/rol/crear.php?$params";			

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
			$query = $mestado; //json_decode($mestado, true);
			
			$json_errors = array(
				JSON_ERROR_NONE => 'No se ha producido ningún error',
				JSON_ERROR_DEPTH => 'Maxima profundidad de pila ha sido excedida',
				JSON_ERROR_CTRL_CHAR => 'Error de carácter de control, posiblemente codificado incorrectamente',
				JSON_ERROR_SYNTAX => 'Error de Sintaxis',
			);
			$txtalert = "alert-success";
			$type = "success";

			//echo "query......$query";
			////$Salt=date("Y-m-d H:i:s");
			//$sql="INSERT INTO RolUsers (RolNombre, IdEstado) VALUES ('".$UserName."','".$Estado."')";
			//$query = sqlsrv_query($con,$sql);

			// if product has been added successfully
			if ($query) {
				$messages[] = "O";
				//$data = "El rol ha sido guardado con éxito.";
			} else {
				$errors[]= 'R';
				$data = "Lo sentimos, el registro falló. Por favor, regrese y vuelva a intentarlo.";
			}
		}		
	} 
	else 
	{
		$errors[] = "desconocido.";
	}
if (isset($errors)){
			
	?>
	<div class="alert alert-danger" role="alert">
		<button type="button" class="close" data-dismiss="alert">&times;</button>
		<strong>Error!</strong> 
		<?php
			foreach ($errors as $error) {
				echo trim($error);
			}
		?>
	</div>
	<?php
	}
	if (isset($messages)){	
	?>	
	<?php
			foreach ($messages as $message) {
				echo $message; 
			}
	?>	
<?php
	}
?>
