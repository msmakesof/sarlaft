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
					<th class='text-center'>Rango Inicial</th>
					<th class='text-center'>Rango Final</th>
					<th class='text-center'>Nombre</th>
					<th class='text-center'>Color</th>
					<th class='text-center'>Acciones</th>						
				</tr>
			</thead>
			<tbody>	
					<?php
					include '../../curl/calificacion/listar.php';
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
							$j = 1;
							for($i=0; $i<count($data['body']); $i++)
							{
								$id=$data['body'][$i]['CAL_IdCalificacion'];
								$rangoini=$data['body'][$i]['CAL_RangoInicial'];
								$rangofin=$data['body'][$i]['CAL_RangoFinal'];
								$Name= trim($data['body'][$i]['CAL_Nombre']);
								$color= trim($data['body'][$i]['CAL_Color']);
								$CustomerKey=$data['body'][$i]['CAL_CustomerKey'];
								$TipoRiesgoKey=$data['body'][$i]['CAL_CalificacionKey'];
								$UserKey=$data['body'][$i]['CAL_UserKey'];
					?>	
							<tr>
								<td class='text-center'><?php echo $j++;?></td>
								<td class='text-left'><?php echo $rangoini;?></td>
								<td class='text-left'><?php echo $rangofin;?></td>
								<td class='text-left'><?php echo $Name;?></td>
								<td class='text-left' style="text-align:center !important">
									<label style="background-color:<?php echo $color ;?>; width:25px; height:25px"></label>
									<div style="color:white; font-size:1px"><?php echo $color ;?></div>
								</td>
								<td class='text-left'>
									<a href="#" data-target="#editCalificacionModal" class="edit" data-toggle="modal" data-name="<?php echo $Name; ?>" data-rangoini="<?php echo $rangoini; ?>" data-rangofin="<?php echo $rangofin; ?>" data-color="<?php echo $color; ?>" data-id="<?php echo $id; ?>">
										<i class="material-icons" data-toggle="tooltip" title="Editar" >&#xE254;</i>
									</a>
									<a href="#deleteCalificacionModal" class="delete" data-toggle="modal" data-id="<?php echo $id;?>">
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