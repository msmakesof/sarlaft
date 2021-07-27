<?php
include('../is_logged.php');//Archivo verifica que el usario que intenta acceder a la URL esta logueado
if (empty($_POST['TratamientosName2'])){
	$errors[] = "Ingresa el nombre del Tratamiento.";
} elseif (!empty($_POST['TratamientosName2'])){

	//require_once ("../components/sql_server.php");

	require_once ("../../config/dbx.php");
	$getConnectionCli2 = new Database();
	$conn = $getConnectionCli2->getConnectionCli2($_SESSION['Keyp']);
	
	$query=sqlsrv_query($conn,"SELECT count(id) as Total FROM TratamientosSarlaft WHERE CustomerKey=".$_SESSION['Keyp']." AND TratamientosName ='".trim($_POST['TratamientosName2'])."'");
	$reg=sqlsrv_fetch_array($query);
	if( $reg['Total'] > 0 ){
		echo "E";
	}
	else {
		// escaping, additionally removing everything that could be (html/javascript-) code
		$TratamientosName=trim(strtoupper($_POST["TratamientosName2"]));
		date_default_timezone_set("America/Bogota");
		$CustomerKey=$_SESSION['Keyp'];
		$TratamientosKey=time();
		$UserKey=$_SESSION['UserKey'];
		$DateStamp=date("Y-m-d H:i:s");
		$sql="INSERT INTO TratamientosSarlaft (CustomerKey, UserKey, DateStamp, TratamientosName, TratamientosKey) VALUES ('".$CustomerKey."','".$UserKey."','".$DateStamp."','".$TratamientosName."','".$TratamientosKey."')";
		$query = sqlsrv_query($conn,$sql);
		// if product has been added successfully
		if ($query) {
			//$messages[] = "El Tratamiento ha sido guardado con éxito.";
			echo "O";
		} else {
			//$errors[] = "Lo sentimos, el registro falló. Por favor, regrese y vuelva a intentarlo.";
			echo "F";
		}
	}
		
} 
else {
	//$errors[] = "desconocido.";
	echo "D";
}
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