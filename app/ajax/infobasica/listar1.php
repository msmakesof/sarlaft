<?php
include('../is_logged.php');
$CustomerKey = $_SESSION['Keyp'];
/* Connect To Database*/
//require_once ("../../components/sql_server_login.php");
$ruta = (isset($_REQUEST['ruta']) && $_REQUEST['ruta'] != "")?$_REQUEST['ruta']:'';
require_once $ruta.'../config/dbx.php';

$action = (isset($_REQUEST['action'])&& $_REQUEST['action'] !=NULL)?$_REQUEST['action']:'';
if($action == 'ajax'){	
//$query = sqlsrv_query($con,"SELECT IdRol, RolNombre, IdEstado FROM RolUsers ");
$j=1;
?>
<?php
include('../../components/table.php');
?>
				<tr>
					<th class='text-center'>Actividad Económica</th>
					<th class='text-center'>Objeto Social </th>
					<th class='text-center'>Descripcion General</th>
					<th class='text-center'>Objetivos Estratégicos </th>
					<th class='text-center'>Misión</th>
					<th class='text-center'>Visión</th>
					<th class='text-center'>Acciones</th>
				</tr>
			</thead>
			<tbody>	
				<?php
				include '../../curl/infobasica/listar.php';
				foreach($data as $key => $row) {}
				echo '<tbody>';
				if( $key == "message")
				{
					echo '<tr>
							<td colspan="7">'. $data["message"] .'</td>
						</tr>';
				}
				else
				{	
					if( $data["itemCount"] > 0)
					{
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
							$UserStatus="";
				?>
				<tr class="<?php //echo $text_class;?>">
					<!-- <td class='text-center'><?php //echo $j++;?></td>  -->
					<td class='text-left'><?php echo $ActividadEconomica; ?></td>
					<td class='text-left'><?php echo $ObjetoSocial; ?></td>
					<td class='text-left'><?php echo $DescripcionGeneral; ?></td>
					<td class='text-left'><?php echo $Mision; ?></td>
					<td class='text-left'><?php echo $Vision; ?></td>
					<td class='text-left'><?php echo $ObjetivosEstrategicos; ?></td>
					<td class='text-right'>
						<a href="#" data-target="#editInfobasicaModal" class="edit" data-toggle="modal" data-name="<?php echo $ActividadEconomica; ?>" data-id="<?php echo $id; ?>" data-objetosocial="<?php echo $ObjetoSocial; ?>" data-descgral="<?php echo $DescripcionGeneral; ?>" data-mision="<?php echo $Mision;?>" data-vision="<?php echo $Vision;?>" data-objetivos="<?php echo $ObjetivosEstrategicos;?>"><i class="material-icons" data-toggle="tooltip" title="Editar" >&#xE254;</i></a>
						<a href="#deleteInfobasicaModal" class="delete" data-toggle="modal" data-id="<?php echo $id;?>"><i class="material-icons" data-toggle="tooltip" title="Eliminar">&#xE872;</i></a>
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