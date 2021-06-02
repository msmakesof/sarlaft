<?php include 'ajax/is_logged.php';?>
<?php require_once 'components/sql_server.php';?>
<?php
if ($_POST['VariableTipo']==NULL||
	$_POST['VariableName']==NULL
){
$errors[] = "Campos vacios.";
}else{	
		$VariableTipo=$_POST['VariableTipo'];
		$VariableName=$_POST['VariableName'];
		$VariableObservacion=$_POST['VariableObservacion'];
		$CustomerKey=$_SESSION['Keyp'];
		$UserKey=$_SESSION['UserKey'];
		date_default_timezone_set("America/Bogota");
		$EventosdeRiesgoKey=$_POST['EventosdeRiesgoKey'];
		$DateStamp=date("Y-m-d H:i:s");

		$sql="INSERT INTO GestiondeRiesgoPSarlaft (VariableTipo, VariableName , VariableObservacion , EventosdeRiesgoKey, CustomerKey, UserKey, DateStamp) VALUES ('".$VariableTipo."','".$VariableName."','".$VariableObservacion."','".$EventosdeRiesgoKey."','".$CustomerKey."','".$UserKey."','".$DateStamp."')";
		$query = sqlsrv_query($conn,$sql);
    // if product has been added successfully
     if ($query) {
     	echo'<SCRIPT LANGUAGE="javascript">
     	location.href = "./UGR2-F?ERK='.$EventosdeRiesgoKey.'";
     	location.reload();
     	</SCRIPT>';
    } else {
        $errors[] = "Lo sentimos, el registro falló. Por favor, regrese y vuelva a intentarlo.";
    }
		
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