<?php
if (empty($_POST['edit_id'])){
	$errors[] = "ID está vacío.";
} elseif (!empty($_POST['edit_id'])){
	
	$id=intval($_POST['edit_id']);
	$CustomerName = trim($_POST["edit_name"]);
	require_once '../config/dbx.php';
	$getUrl = new Database();
	$urlServicios = $getUrl->getUrl();
	
	// Se verifica si el nombre existe para evitar duplicados.
	$url = $urlServicios."api/cliente/revisarnombre.php?nombre=$CustomerName&id=$id";
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
		$mks = "E";
	}
	else {		
			$getUrl = new Database();
			$urlServicios = $getUrl->getUrl();
			$CustomerNit = trim($_POST["edit_nit"]);
			
			// Se verifica si el nombre existe para evitar duplicados.
			$url = $urlServicios."api/cliente/revisarnit.php?nit=$CustomerNit&id=$id";
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
				$mks = "I";
			}
			else 
			{
				require_once ("../components/sql_server_login.php");
				// escaping, additionally removing everything that could be (html/javascript-) code
				$CustomerCity = $_POST["edit_city"];			
				$CustomerColor = $_POST["edit_color"];
				
				// UPDATE data into database
				$sql = "UPDATE CustomerSarlaft SET CustomerCity='".$CustomerCity."', CustomerName='".$CustomerName."', CustomerNit='".$CustomerNit."', CustomerColor='".$CustomerColor."' WHERE id='".$id."' ";
				$query = sqlsrv_query($con,$sql);
				// if product has been added successfully
				if ($query) {
					//$messages[] = "El Cliente ha sido actualizado con éxito.";
					//echo $sql."<br>";
					$mks = "U";
				} else {
					//$errors[] = "Lo sentimos, la actualización falló. Por favor, regrese y vuelva a intentarlo.";
					$mks = "F";
				}
			}
		}
} else 
{
	//$errors[] = "desconocido.";
	$mks = "D";
}
echo $mks;
/*
if (isset($errors)){			
	?>
	<div class="alert alert-danger" role="alert">
		<button type="button" class="close" data-dismiss="alert">&times;</button>
			<strong>Error!</strong> 
			<?php
				foreach ($errors as $error) {
						echo $error;
					}
				?>
	</div>
	<?php
}
if (isset($messages)){	
	?>
	<div class="alert alert-success" role="alert">
		<button type="button" class="close" data-dismiss="alert">&times;</button>
		<strong>¡Bien hecho!</strong>
		<?php
			foreach ($messages as $message) {
					echo $message;
				}
			?>
	</div>
	<?php
}
*/
?>			