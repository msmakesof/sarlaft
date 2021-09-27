<?php
include('../is_logged.php');
$UserKey=$_SESSION['UserKey'];
$CustomerKey = trim($_SESSION['Keyp']);
/* Connect To Database*/

require_once '../../config/dbx.php';
$getConnectionSL = new Database();
$con = $getConnectionSL->getConnectionSL();
include '../../acceso.php';

$consultar=0;
$crear =0;
$modificar=0;
$eliminar=0;
$exportar=0;

if( $qry === false) {
    die( print_r( sqlsrv_errors(), true) );
}
while($row = sqlsrv_fetch_array( $qry, SQLSRV_FETCH_ASSOC ) ){
	$OPC_Nombre = trim($row['OPC_Nombre']);
	
	if( $OPC_Nombre == "CONTEXTO INTERNO Y EXTERNO" ){
		$ACC_Nombre = trim($row['ACC_Nombre']);
		if($ACC_Nombre == "CONSULTAR"){ $consultar=1 ;}
		if($ACC_Nombre == "CREAR"){ $crear=1 ;}
		if($ACC_Nombre == "MODIFICAR"){ $modificar=1 ;}
		if($ACC_Nombre == "ELIMINAR"){ $eliminar=1 ;}
		if($ACC_Nombre == "EXPORTAR"){ $exportar=1 ;}
	}
}

$getConnectionCli2 = new Database();
$conn = $getConnectionCli2->getConnectionCli2($_SESSION['Keyp']);

$action = (isset($_REQUEST['action'])&& $_REQUEST['action'] !=NULL)?$_REQUEST['action']:'';
if($action == 'ajax')
{	
		include('../../components/table.php');
?>
				<tr>
					<th class='text-center' style="width:45%">Interno</th>
					<th class='text-center' style="width:45%">Externo</th>
					<th class='text-center' style="width:10%">Acciones</th>						
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
								<td style="text-align:justify !important; word-wrap: break-word;"><?php echo substr($Interno,0,450)?></td>
								<td style="text-align:justify !important; word-wrap: break-word;"><?php echo substr($Externo,0,450);?></td>
								<td class='text-left'>
									<?php if( $modificar == 1 ) { ?>
									<a href="#" data-target="#editContextoModal" class="edit" data-toggle="modal" data-interno="<?php echo $Interno; ?>" data-externo="<?php echo $Externo; ?>" data-id="<?php echo $id; ?>">
										<i class="material-icons" data-toggle="tooltip" title="Editar" >&#xE254;</i>
									</a>
									<?php } 
									if( $eliminar == 1 ) { ?>
									<a href="#deleteContextoModal" class="delete" data-toggle="modal" data-id="<?php echo $id;?>">
										<i class="material-icons" data-toggle="tooltip" title="Eliminar">&#xE872;</i>
									</a>
									<?php } ?>
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
?>