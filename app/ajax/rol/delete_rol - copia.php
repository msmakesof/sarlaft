<?php
if (empty($_POST['delete_id'])){
	$errors[] = "Id vacío.";
} 
elseif (!empty($_POST['delete_id']))
{
	/*
	require_once ("../components/sql_server_login.php");
	// escaping, additionally removing everything that could be (html/javascript-) code
	$id=intval($_POST['delete_id']);

	// DELETE FROM  database
	$sql = "DELETE FROM  UsersAuth WHERE id='$id'";
	$query = sqlsrv_query($con,$sql);
	*/		
	
	require_once '../../config/dbx.php';
	$getUrl = new Database();
	$urlServicios = $getUrl->getUrl();
	
	$id=intval($_POST['delete_id']);
	$query="";
	
	$url = $urlServicios."api/rol/delete.php?id=$id";
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

	// if product has been added successfully
	if ($query) {
		$messages[] = "El Rol ha sido eliminado con éxito.";
	} else {
		$errors[] = "Lo sentimos, la eliminación falló. Por favor, regrese y vuelva a intentarlo.";
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
?>			