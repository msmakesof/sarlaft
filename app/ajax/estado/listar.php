<?php
include('../is_logged.php');	
/* Connect To Database*/
//require_once ("../../components/sql_server_login.php");
require_once '../../config/dbx.php';

$action = (isset($_REQUEST['action'])&& $_REQUEST['action'] !=NULL)?$_REQUEST['action']:'';
if($action == 'ajax'){	
//$query = sqlsrv_query($con,"SELECT IdRol, RolNombre, IdEstado FROM RolUsers ");
$j=1;
?>
<?php
include('../../components/table.php');
?>
				<tr>
					<th class='text-center'>#</th>
					<th class='text-left'>Nombre </th>
					<th class='text-left'>Acciones</th>						
				</tr>
			</thead>
			<tfoot>
				<tr>
					<th class='text-center'>#</th>
					<th class='text-left'>Nombre </th>
					<th class='text-left'>Acciones</th>
				</tr>
			</tfoot>
			<tbody>	
				<?php
				include '../../curl/estado/listado.php';
				foreach($data as $key => $row) {}
				if( $key == "message")
				{
					echo '<tr>
							<td>'. $data["message"] .'</td>
							<td></td>
							<td></td>
						</tr>';
				}
				else
				{	
					if( $data["itemCount"] > 0)
					{
						for($i=0; $i<count($data['body']); $i++)
						{
							$id = $data['body'][$i]['STA_IdEstado'];
							$NombreEstado = trim($data['body'][$i]['STA_Nombre']);

							$UserStatus="";
							if($UserStatus=='1'){
								$Status="<a href='?st=0&id=".$id."' class='btn btn-default'><i class='far fa-check-circle'></i></a>";
							}
							else{
								$Status="<a href='?st=1&id=".$id."' class='btn btn-default'><i class='fas fa-arrow-circle-down'></i></a>";
							}
				?>
				<tr class="<?php echo $text_class;?>">
					<td class='text-center'><?php echo $j++;?></td>
					<td class='text-left'><?php echo $NombreEstado; ?></td>
					<td class='text-right'>
						<a href="#" data-target="#editUserModal" class="edit" data-toggle="modal" data-name="<?php echo $NombreEstado; ?>" data-id="<?php echo $id; ?>"><i class="material-icons" data-toggle="tooltip" title="Editar" >&#xE254;</i></a>
						<a href="#deleteUserModal" class="delete" data-toggle="modal" data-id="<?php echo $id;?>"><i class="material-icons" data-toggle="tooltip" title="Eliminar">&#xE872;</i></a>
					</td>
				</tr>
				<?php 	
							}
						} 
					}
				?>
			</tbody>			
		</table>

		
	</div>	
<?php	
}	
?>