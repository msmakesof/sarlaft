<?php
include('is_logged.php');
/* Connect To Database*/
require_once '../config/dbx.php';
$getConnectionCli2 = new Database();
$conn = $getConnectionCli2->getConnectionCli2($_SESSION['Keyp']);

$action = (isset($_REQUEST['action'])&& $_REQUEST['action'] !=NULL)?$_REQUEST['action']:'';
if($action == 'ajax'){

	$query = sqlsrv_query($conn,"SELECT id, CustomerKey, ConsecuenciasKey, ConsecuenciasName, UserKey FROM ConsecuenciasSarlaft WHERE CustomerKey='".$_SESSION['Keyp']."'");
	{		
	?>
	<?php
	include('../components/table.php');
	?>
					<tr>
						<th class='text-center'>#</th>
						<th class='text-left'>Nombre Consecuencia </th>
						<th class='text-center'>Eventos</th>
						<th class='text-left'>Acciones</th>						
					</tr>
				</thead>
				<tbody>	
						<?php 
						$finales=0;
						$i=1;
						if ( $query === false)
						{
							die(print_r(sqlsrv_errors(), true));
						}						
						while( $row = sqlsrv_fetch_array( $query, SQLSRV_FETCH_ASSOC) ) {
							$id=$row['id'];
							$CustomerKey=$row['CustomerKey'];
							$ConsecuenciasKey=$row['ConsecuenciasKey'];
							$ConsecuenciasName=$row['ConsecuenciasName'];
							$UserKey=$row['UserKey'];					
							$finales++;
						?>	
						<tr class="<?php echo $text_class;?>">
							<td class='text-center'><?php echo $i++;?></td>
							<td class='text-left'><?php echo $ConsecuenciasName;?></td>
							<td class='text-center'><a href="#" class='btn btn-default' title='Eventos'><i class="material-icons">&#xE147;</i></a></td>
							<td class='text-left'>
								<a href="#"  data-target="#editConsecuenciaModal" class="edit" data-toggle="modal" data-name="<?php echo $ConsecuenciasName?>"  data-id="<?php echo $id; ?>"><i class="material-icons" data-toggle="tooltip" title="Editar" >&#xE254;</i></a>
								<a href="#deleteConsecuenciaModal" class="delete" data-toggle="modal" data-id="<?php echo $id;?>"><i class="material-icons" data-toggle="tooltip" title="Eliminar">&#xE872;</i></a>
                    		</td>
						</tr>
						<?php }	?>

				</tbody>			
			</table>
		</div>	

	
	<?php	
	}	
}
?>          
		  
