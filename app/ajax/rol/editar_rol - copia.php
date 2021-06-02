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
	$rolnombre = trim($_POST["edit_name"]);
	$rolnombre = str_replace(' ','%20',strtoupper($rolnombre));
	$estado = $_POST["edit_estado"];
	$id=intval($_POST['edit_id']);
	
	$query = "";
	$resultado = "";
	// Se verifica si el nombre existe para evitar duplicados.
	$url = $urlServicios."api/rol/revisarnombre.php?nombre=$rolnombre&id=$id";
	
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
		$messages[] = 'Ya existe un Registro grabado con el mismo Nombre.' ;
		$txtalert = "alert-warning";
	}
	else
	{		
		$query="";		
		// Si todo va bien se hace el Update
		$params = "RolNombre=$rolnombre&Estado=$estado&Id=$id";
		$url = $urlServicios."api/rol/update.php?$params";
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
	
		// // UPDATE data into database
		//$sql = "UPDATE UsersAuth SET UserName='".$UserName."', UserEmail='".$UserEmail."', Password='".$Password."' //WHERE id='".$id."' ";
		//$query = sqlsrv_query($con,$sql);
		
		// if rol has been updated successfully
		if ($query) {
			$messages[] = "El Rol ha sido actualizado con éxito.";
		} else {
			$errors[] = "Lo sentimos, la actualización falló. Por favor, regrese y vuelva a intentarlo.";
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
				echo $error;
			}
		?>
	</div>
	<?php
	}
	if (isset($messages)){
		
	?>
	<div class="alert <?php echo $txtalert; ?>" role="alert">
		<button type="button" class="close" data-dismiss="alert">&times;</button>
		<strong>¡Atención! </strong>
		<?php
		foreach ($messages as $message) {
				echo $message;
			}
		?>
	</div>
	<?php
	}
?>			