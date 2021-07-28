<?php
include('../is_logged.php');
/* Connect To Database*/
//require_once ("../components/sql_server.php");	
require_once '../../config/dbx.php';
$getConnectionCli2 = new Database();
$conn = $getConnectionCli2->getConnectionCli2($_SESSION['Keyp']);

$action = (isset($_REQUEST['action'])&& $_REQUEST['action'] !=NULL)?$_REQUEST['action']:'';
if($action == 'ajax')
{
	$query = sqlsrv_query($conn,"SELECT FAR_IdFactorRiesgo, FAR_CustomerKey, FAR_FactorRiesgoKey, FAR_Nombre, FAR_UserKey FROM FAR_FactorRiesgo WHERE FAR_CustomerKey='".$_SESSION['Keyp']."'");	
	{		
		include('../../components/table.php');
?>
				<tr>
					<th class='text-center'>#</th>
					<th class='text-left'>Valor</th>						
					<th class='text-left'>Acciones</th>						
				</tr>
			</thead>
			<tbody>	
					<?php
					include '../../curl/escalacalificacion/listar.php';
					foreach($data as $key => $row) {}				
					if( $key == "message")
					{
						echo '<tr>
								<td colspan="3">'. $data["message"] .'</td>
							</tr>';
					}
					else
					{
						if( $data["itemCount"] > 0)
						{
							$j = 1;
							for($i=0; $i<count($data['body']); $i++)
							{
								$id=$data['body'][$i]['ESC_IdEscalaCalificacion'];
								$CustomerKey=$data['body'][$i]['ESC_CustomerKey'];
								$EscalaKey=$data['body'][$i]['ESC_EscalaKey'];
								$Name= trim($data['body'][$i]['ESC_Valor']);
								$UserKey=$data['body'][$i]['ESC_UserKey'];
					?>	
							<tr>
								<td class='text-center'><?php echo $j++;?></td>
								<td class='text-left'><?php echo $Name;?></td>
								<td class='text-left'>
									<a href="#" data-target="#editEscalacalificacionModal" class="edit" data-toggle="modal" data-name="<?php echo $Name; ?>" data-id="<?php echo $id; ?>">
										<i class="material-icons" data-toggle="tooltip" title="Editar" >&#xE254;</i>
									</a>
									<a href="#deleteEscalacalificacionModal" class="delete" data-toggle="modal" data-id="<?php echo $id;?>">
										<i class="material-icons" data-toggle="tooltip" title="Eliminar">&#xE872;</i>
									</a>
								</td>
							</tr>
					<?php } 
						}	
					}
					?>
			</tbody>			
		</table>
	</div>
<?php	
	}	
}
?>