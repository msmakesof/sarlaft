<?php
include('../is_logged.php');	
/* Connect To Database*/
require_once '../../config/dbx.php';
$action = (isset($_REQUEST['action'])&& $_REQUEST['action'] !=NULL)?$_REQUEST['action']:'';
if($action == 'ajax'){
	$j=1;
	$usuario = $_SESSION['UserKey'];
	include('../../components/table.php');
?>
				<tr>
					<th class='text-center'>#</th>
					<th class='text-left'>Nombre Rol </th>
					<th class='text-center'>Estado</th>
					<th class='text-center'>Privilegios</th>
					<th class='text-left'>Acciones</th>						
				</tr>
			</thead>
			<tfoot>
				<tr>
					<th class='text-center'>#</th>
					<th class='text-left'>Nombre Rol </th>
					<th class='text-center'>Estado</th>
					<th class='text-center'>Privilegios</th>
					<th class='text-left'>Acciones</th>
				</tr>
			</tfoot>
			<tbody>	
				<?php
				include '../../curl/rol/listar.php';
				foreach($data as $key => $row) {}				
				if( $key == "message")
				{
					echo '<tr>
							<td colspan="5">'. $data["message"] .'</td>
						</tr>';
				}
				else
				{					
					if( $data["itemCount"] > 0)
					{
						include '../pagination.php'; //include pagination file
						//pagination variables
						$page = (isset($_REQUEST['page']) && !empty($_REQUEST['page']))?$_REQUEST['page']:1;
						$per_page = intval($_REQUEST['per_page']); //how much records you want to show
						$adjacents  = 4; //gap between pages after number of adjacents
						$offset = ($page - 1) * $per_page;						
						//						
						//Count the total number of row in your table*/
						$count_query = $data["itemCount"];
						$numrows = $data["itemCount"]; 
						$total_pages = ceil($numrows/$per_page);
						$reload = '../../Roles.php';
						
						for($i=0; $i<count($data['body']); $i++)
						{	
							$id= $data['body'][$i]['IdRol'];
							$RolNombre= trim($data['body'][$i]['RolNombre']);
							$UserStatus=$data['body'][$i]['IdEstado'];
							$STA_Nombre= trim($data['body'][$i]['STA_Nombre']);
						
							if($UserStatus=='1'){
								$Status="<a href='?st=0&id=".$id."' class='btn btn-default'><i class='far fa-check-circle'></i></a>";
							}
							else{
								$Status="<a href='?st=1&id=".$id."' class='btn btn-default'><i class='fas fa-arrow-circle-down'></i></a>";
							}													
				?>
							<tr class="<?php echo $text_class;?>">
								<td class='text-center'><?php echo $j++;?></td>
								<td class='text-left'><?php echo $RolNombre;?></td>
								<td class='text-center'><?php echo $STA_Nombre;?></td>
								<td class='text-center'>

									<a href="#" id="privilegio" onclick="mks(<?php echo $id; ?>,'C')" data-toggle="tooltip" data-placement="right" title="Asignar" ><i class='fas fa-user-plus'></i>
									<input id="Id" name="Id" type="hidden" value="<?php echo $id; ?>">
									</a>
									
								</td>
								<td class='text-right'>
									<a href="#" data-target="#editUserModal" class="edit" data-toggle="modal" data-name="<?php echo $RolNombre; ?>" data-estado="<?php echo $UserStatus; ?>" data-id="<?php echo $id; ?>"><i class="material-icons" data-toggle="tooltip" title="Editar" >&#xE254;</i></a>
									<a href="#deleteUserModal" class="delete" data-toggle="modal" data-id="<?php echo $id;?>"><i class="material-icons" data-toggle="tooltip" title="Eliminar">&#xE872;</i></a>
								</td>
							</tr>
				<?php 	}						
					}
				?>
			</tbody>			
		</table>
		<div class="table-pagination pull-right"></div>
		<?php
				}			
		?>
	</div>	
<?php	
}	
?>