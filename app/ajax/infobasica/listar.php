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
					<th class='text-center'>Actividad Económica</th>
					<th class='text-left'>Objeto Social</th>
					<th class='text-left'>Descripcion General</th>
					<th class='text-left'>Objetivos Estratégicos</th>
					<th class='text-center'>Misión</th>
					<th class='text-center'>Visión</th>
					<th class='text-left'>Acciones</th>						
				</tr>
			</thead>
			<tbody>	
					<?php
					include '../../curl/infobasica/listar.php';
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
								$id = $data['body'][$i]['CLI_IdInfoBasica'];
								$ActividadEconomica = trim($data['body'][$i]['CLI_ActividadEconomica']);
								$ObjetoSocial = trim($data['body'][$i]['CLI_ObjetoSocial']);
								$DescripcionGeneral = trim($data['body'][$i]['CLI_DescripcionGeneral']);
								$Mision = trim($data['body'][$i]['CLI_Mision']);
								$Vision = trim($data['body'][$i]['CLI_Vision']);
								$ObjetivosEstrategicos = trim($data['body'][$i]['CLI_ObjetivosEstrategicos']);
								$CustomerKey = $data['body'][$i]['CLI_CustomerKey'];
								$USerKey = $data['body'][$i]['CLI_USerKey'];
					?>	
							<tr>
								<td style="text-align:justify !important; word-wrap: break-word;"><?php echo substr($ActividadEconomica,0,50)?></td>
								<td style="text-align:justify !important; word-wrap: break-word;"><?php echo substr($ObjetoSocial,0,50);?></td>
								<td style="text-align:justify !important; word-wrap: break-word;"><?php echo substr($DescripcionGeneral,0,50);?></td>
								<td style="text-align:justify !important; word-wrap: break-word;"><?php echo substr($ObjetivosEstrategicos,0,50) ;?></td>
								<td style="text-align:justify !important; word-wrap: break-word;"><?php echo substr($Mision,0,50) ;?></td>
								<td style="text-align:justify !important; word-wrap: break-word;"><?php echo substr($Vision,0,50) ;?></td>
								<td class='text-left'>
									<a href="#" data-target="#editInfobasicaModal" class="edit" data-toggle="modal" data-name="<?php echo $ActividadEconomica; ?>" data-obssoc="<?php echo $ObjetoSocial; ?>" data-desgen="<?php echo $DescripcionGeneral; ?>" data-objest="<?php echo $ObjetivosEstrategicos; ?>" data-mision="<?php echo $Mision; ?>" data-vision="<?php echo $Vision; ?>" data-id="<?php echo $id; ?>">
										<i class="material-icons" data-toggle="tooltip" title="Editar" >&#xE254;</i>
									</a>
									<a href="#deleteInfobasicaModal" class="delete" data-toggle="modal" data-id="<?php echo $id;?>">
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