	<?php
				/* Connect To Database*/
	require_once ("../components/sql_server_login.php");
				sqlsrv_query($con,"SET NAMES 'utf8'");
				if (isset($_POST["CustomerColor"])){
	

					$id=$_GET['id'];
                    $sql = "UPDATE CustomerSarlaft SET CustomerColor='$CustomerColor' WHERE id='$id';";
                    $query_new_insert = sqlsrv_query($con,$sql);

                   
                    if ($query_new_insert) {
                        ?>
						
						<?php
                    } else {
                        $errors[] = "Lo sentimos, actualización falló. Intente nuevamente. ".sqlsrv_error($con);
                    }

		}	
				
				
				
		
	?>
	<?php 
		if (isset($errors)){
	?>
		<div class="alert alert-danger">
			<button type="button" class="close" data-dismiss="alert">&times;</button>
			<strong>Error! </strong>
		<?php
			foreach ($errors as $error){
				echo $error;
			}
		?>
		</div>	
	<?php
			}
	?>
