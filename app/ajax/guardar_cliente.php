<?php
	include 'is_logged.php';
	if (empty($_POST['CustomerName2'])){
		$errors[] = "Ingresa el nombre del cliente.";
	} elseif (!empty($_POST['CustomerName2'])){

	require_once ("../components/sql_server_login.php");
	// escaping, additionally removing everything that could be (html/javascript-) code
		$CustomerName=$_POST["CustomerName2"];
		$CustomerCity=$_POST["CustomerCity2"];
		$CustomerNit=$_POST["CustomerNit2"];
		$CustomerColor=$_POST["CustomerColor2"];
		$CustomerStatus='1';
		date_default_timezone_set("America/Bogota");
		$CustomerKey=time();
		$CustomerDB=time();
		$CustomerLogo='edit.png';
		$UserKey=$_SESSION['UserKey'];
		$DateStamp=date("Y-m-d H:i:s");
		$sql="INSERT INTO CustomerSarlaft (CustomerNit, CustomerDB,CustomerName, CustomerCity, CustomerStatus, CustomerColor, CustomerLogo, CustomerKey, UserKey, DateStamp) VALUES ('".$CustomerNit."','".$CustomerDB."','".$CustomerName."','".$CustomerCity."','".$CustomerStatus."','".$CustomerColor."','".$CustomerLogo."','".$CustomerKey."','".$UserKey."','".$DateStamp."')";
		$query = sqlsrv_query($con,$sql);
		$sqls = "CREATE DATABASE E".$CustomerDB."";
		$query = sqlsrv_query($con,$sqls);

    // if product has been added successfully
    if ($query) {
        $messages[] = "El cliente ha sido guardado con éxito.";
    } else {
        $errors[] = "Lo sentimos, el registro falló. Por favor, regrese y vuelva a intentarlo.";
    }
		
	} else 
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