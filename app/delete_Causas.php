<?php include 'ajax/is_logged.php';?>
<?php require_once 'components/sql_server.php';?>
<?php
if ($_GET['id']==NULL
){
$errors[] = "Campos vacios.";
}else{	
		$id=$_GET['id'];
		$EventosdeRiesgoKey=$_GET['ERK'];
		$sql="DELETE FROM GestiondeRiesgoPSarlaft WHERE id=$id ";
		$query = sqlsrv_query($conn,$sql);
    // if product has been added successfully
     if ($query) {
     	echo'<SCRIPT LANGUAGE="javascript">
     	location.href = "./UGR2-F?ERK='.$EventosdeRiesgoKey.'";

     	</SCRIPT>';
    } else {
        $errors[] = "Lo sentimos, la acción falló. Por favor, regrese y vuelva a intentarlo.";
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

