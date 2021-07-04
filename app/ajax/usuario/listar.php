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
					<th class='text-left'>Email </th>
					<th class='text-center'>Estado</th>
					<th class='text-center'>Compañía</th>
					<th class='text-left'>Rol </th>
					<th class='text-left'>Acciones</th>						
				</tr>
			</thead>
			<tfoot>
				<tr>
					<th class='text-center'>#</th>
					<th class='text-left'>Nombre </th>
					<th class='text-left'>Email </th>
					<th class='text-center'>Estado</th>
					<th class='text-center'>Compañía</th>
					<th class='text-left'>Rol </th>
					<th class='text-left'>Acciones</th>
				</tr>
			</tfoot>
			<tbody>	
				<?php
				$getUrl = new Database();
				$urlServicios = $getUrl->getUrl();
				// descifrar clave
				$url = $urlServicios."api/control/read.php";
				$query = "";
				$resultado = "";
				$ch = curl_init();
				curl_setopt($ch, CURLOPT_VERBOSE, true);
				curl_setopt($ch, CURLOPT_URL, $url);
				curl_setopt($ch, CURLOPT_TIMEOUT, 30);
				curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
				curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
				curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
				curl_setopt($ch, CURLOPT_POST, 0);
				$resultado = curl_exec ($ch);
				curl_close($ch);
				
				$mestado =  preg_replace('/[\x00-\x1F\x80-\xFF]/', '', $resultado);    
				$data = json_decode($mestado, true);
				$json_errors = array(
					JSON_ERROR_NONE => 'No se ha producido ningún error',
					JSON_ERROR_DEPTH => 'Maxima profundidad de pila ha sido excedida',
					JSON_ERROR_CTRL_CHAR => 'Error de carácter de control, posiblemente codificado incorrectamente',
					JSON_ERROR_SYNTAX => 'Error de Sintaxis',
				);
				
				$CON_LlaveAcceso ="";
				/*if( $data["itemCount"] > 0)
				{
					for($i=0; $i<count($data['body']); $i++)
					{
						$CON_IdControl = $data['body'][$i]['CON_IdControl'];
						$CON_LlaveAcceso = $data['body'][$i]['CON_LlaveAcceso'];
						$CON_LlaveInicial= $data['body'][$i]['CON_LlaveInicial'];
						$CON_LlaveIv = $data['body'][$i]['CON_LlaveIv'];
						$CON_MetodoEncriptacion = $data['body'][$i]['CON_MetodoEncriptacion'];
						$CON_TipoHash = $data['body'][$i]['CON_TipoHash'];
						$CON_Cookie = $data['body'][$i]['CON_Cookie'];
					}				
				}*/

				include '../../curl/usuario/listar.php';
				foreach($data as $key => $row) {}
				if( $key == "message")
				{
					echo '<tr>
							<td colspan="6">'. $data["message"] .'</td>
						</tr>';
				}
				else
				{	
					if( $data["itemCount"] > 0)
					{
						
						for($i=0; $i<count($data['body']); $i++)
						{
							$id = $data['body'][$i]['id'];
							$CustomerKey = trim($data['body'][$i]['CustomerKey']);
							$NombreUsuario = trim($data['body'][$i]['UserName']);
							$Email = $data['body'][$i]['UserEmail'];
							$UserStatus = $data['body'][$i]['UserStatus'];
							$Password = trim($data['body'][$i]['Password']);
							$STA_Nombre = trim($data['body'][$i]['STA_Nombre']);
							$CustomerName = trim($data['body'][$i]['CustomerName']);
							$RolNombre = trim($data['body'][$i]['RolNombre']);
							$IdRol = trim($data['body'][$i]['IdRol']);
							
							if($UserStatus=='1'){
								$Status="<a href='?st=0&id=".$id."' class='btn btn-default'><i class='far fa-check-circle'></i></a>";
							}
							else{
								$Status="<a href='?st=1&id=".$id."' class='btn btn-default'><i class='fas fa-arrow-circle-down'></i></a>";
							}
							
							include_once("gateway.php");
							$Password2 = encryptor('decrypt', $Password);							
				?>
						<tr class="<?php echo $text_class;?>">
							<td class='text-center'><?php echo $j++;?></td>
							<td class='text-left'><?php echo $NombreUsuario; ?></td>
							<td class='text-left'><?php echo $Email; ?></td>
							<td class='text-center'><?php echo $STA_Nombre; ?></td>
							<td class='text-left'><?php echo $CustomerName; ?></td>
							<td class='text-left'><?php echo $RolNombre; ?></td>							
							<td class='text-right'>
								<a href="#" data-target="#editUserModal" class="edit" data-toggle="modal" data-customerkey2="<?php echo $CustomerKey; ?>" data-name="<?php echo $NombreUsuario; ?>" data-email="<?php echo $Email; ?>" data-password2="<?php echo $Password2; ?>" data-idrol="<?php echo $IdRol; ?>" data-estado="<?php echo $UserStatus; ?>" data-id="<?php echo $id; ?>"><i class="material-icons" data-toggle="tooltip" title="Editar" >&#xE254;</i></a>
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