<?php
	include('is_logged.php');	
	/* Connect To Database*/
	require_once ("../components/sql_server_login.php");

$action = (isset($_REQUEST['action'])&& $_REQUEST['action'] !=NULL)?$_REQUEST['action']:'';
if($action == 'ajax'){
	$query = sqlsrv_query($con,"SELECT id, UserKey, Password, UserName, UserEmail, UserTipo, UserStatus FROM UsersAuth WHERE UserKey!=".$_SESSION['UserKey']." ");
	$i=1;
	?>
	<?php
	include('../components/table.php');
	?>
					<tr>
						<th class='text-center'>#</th>
						<th class='text-left'>Nombre Cliente </th>
						<th class='text-center'>Correo</th>
						<th class='text-center'>Password</th>
						<th class='text-center'>Status</th>
						<th class='text-left'>Acciones</th>
						
					</tr>
				</thead>
				<tbody>	
						<?php 
						
						while($row = sqlsrv_fetch_array($query)){	
							$id=$row['id'];
							$UserName=$row['UserName'];
							$UserEmail=$row['UserEmail'];
							$Password=$row['Password'];
							$UserKey=$row['UserKey'];
							$UserStatus=$row['UserStatus'];
						
							if($UserStatus=='1'){$Status="<a href='?st=0&id=".$id."' class='btn btn-default'><i class='far fa-check-circle'></i></a>";}else{$Status="<a href='?st=1&id=".$id."' class='btn btn-default'><i class='fas fa-arrow-circle-down'></i></a>";}
													
						?>	

						<tr class="<?php echo $text_class;?>">
							<td class='text-center'><?php echo $i++;?></td>
							<td class='text-left'><?php echo $UserName;?></td>
							<td class='text-left' ><?php echo $UserEmail;?></td>
							<td class='text-left'><?php echo $Password;?></td>
							<td class='text-center'><?php echo $Status;?></td>
							<td class='text-right'>
								<a href="#"  data-target="#editUserModal" class="edit" data-toggle="modal" data-name="<?php echo $UserName?>" data-email="<?php echo $UserEmail?>" data-pass="<?php echo $Password;?>" data-id="<?php echo $id; ?>"><i class="material-icons" data-toggle="tooltip" title="Editar" >&#xE254;</i></a>
								<a href="#deleteUserModal" class="delete" data-toggle="modal" data-key="<?php echo $UserKey?>" data-id="<?php echo $id;?>"><i class="material-icons" data-toggle="tooltip" title="Eliminar">&#xE872;</i></a>
                    		</td>
						</tr>
						<?php }?>

				</tbody>			
			</table>
		</div>	

	
	<?php	
	}
	
?>          
		  
