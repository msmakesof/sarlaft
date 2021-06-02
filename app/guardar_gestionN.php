<?php include 'ajax/is_logged.php';?>
<?php require_once 'components/sql_server.php';?>
<?php

       if (!empty($_POST['EventosdeRiesgoName'])){
		$ConsecutivoEventoRiesgoValue=$_POST['ConsecutivoEventoRiesgoValue'];
		$EventosdeRiesgoName=$_POST['EventosdeRiesgoName'];
		$ProcesosName=$_POST['ProcesosName'];
		$CargosName=$_POST['CargosName'];
		$ResponsablesName=$_POST['ResponsablesName'];
		$CustomerKey=$_SESSION['Keyp'];
		$UserKey=$_SESSION['UserKey'];
		date_default_timezone_set("America/Bogota");
		$EventosdeRiesgoKey=time();
		$DateStamp=date("Y-m-d H:i:s");



		$sql="INSERT INTO GestiondeRiesgoSarlaft (ConsecutivoEventoRiesgoValue, EventosdeRiesgoKey , EventosdeRiesgoName , ProcesosName, CargosName ,ResponsablesName, CustomerKey, UserKey, DateStamp) VALUES ('".$ConsecutivoEventoRiesgoValue."','".$EventosdeRiesgoKey."','".$EventosdeRiesgoName."','".$ProcesosName."','".$CargosName."','".$ResponsablesName."','".$CustomerKey."','".$UserKey."','".$DateStamp."')";
		$query = sqlsrv_query($conn,$sql);
    // if product has been added successfully
     if ($query) {
     	echo'<SCRIPT LANGUAGE="javascript">
     	location.href = "./UGR2-F?ERK='.$EventosdeRiesgoKey.'";
     	</SCRIPT>';
    } else {
        $errors[] = "Lo sentimos, el registro falló. Por favor, regrese y vuelva a intentarlo.";
    }
		
	} else  {
		$errors[] = "Evento de riesgo en uso.";
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