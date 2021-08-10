<?php
include('../is_logged.php');
$CustomerKey = $_SESSION['Keyp'];
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
					<th class='text-center'>Interno</th>
					<th class='text-center'>Externo</th>
					<th class='text-center'>Acciones</th>						
				</tr>
			</thead>
			<tbody>	
					<?php
					include '../../curl/contexto/listar.php';
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
								$id = $data['body'][$i]['CTX_IdContexto'];
								$Interno = trim($data['body'][$i]['CTX_Interno']);
								$Externo = trim($data['body'][$i]['CTX_Externo']);
								$CustomerKey = $data['body'][$i]['CTX_CustomerKey'];
								$USerKey = $data['body'][$i]['CTX_USerKey'];
					?>	
							<tr>
								<td style="text-align:justify !important; word-wrap: break-word;"><?php echo substr($Interno,0,50)?></td>
								<td style="text-align:justify !important; word-wrap: break-word;"><?php echo substr($Externo,0,50);?></td>
								<td class='text-left'>
									<a href="#" data-target="#editContextoModal" class="edit" data-toggle="modal" data-interno="<?php echo $Interno; ?>" data-externo="<?php echo $Externo; ?>" data-id="<?php echo $id; ?>">
										<i class="material-icons" data-toggle="tooltip" title="Editar" >&#xE254;</i>
									</a>
									<a href="#deleteContextoModal" class="delete" data-toggle="modal" data-id="<?php echo $id;?>">
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