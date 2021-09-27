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
	
	if( $OPC_Nombre == "ESCALA CALIFICACION" ){
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
	//$query = sqlsrv_query($conn,"SELECT FAR_IdFactorRiesgo, FAR_CustomerKey, FAR_FactorRiesgoKey, FAR_Nombre, FAR_UserKey FROM FAR_FactorRiesgo WHERE //FAR_CustomerKey='".$_SESSION['Keyp']."'");	
	//{		
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
					$CustomerKey = trim($_SESSION['Keyp']);
					include '../../curl/escalacalificacion/listar_eveall.php';
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
								$CustomerKey=trim($data['body'][$i]['ESC_CustomerKey']);
								$EscalaKey=$data['body'][$i]['ESC_EscalaKey'];
								$Name= trim($data['body'][$i]['ESC_Valor']);
								$UserKey=$data['body'][$i]['ESC_UserKey'];
					?>	
							<tr>
								<td class='text-center'><?php echo $j++;?></td>
								<td class='text-left'><?php echo $Name;?></td>
								<td class='text-left'>
								<?php if( $modificar == 1 ) { ?>
									<a href="#" data-target="#editEscalacalificacionModal" class="edit" data-toggle="modal" data-name="<?php echo $Name; ?>" data-ck="<?php echo $CustomerKey; ?>" data-id="<?php echo $id; ?>">
										<i class="material-icons" data-toggle="tooltip" title="Editar" >&#xE254;</i>
									</a>
								<?php } 
								if( $eliminar == 1 ) { ?>
									<a href="#deleteEscalacalificacionModal" class="delete" data-toggle="modal" data-id="<?php echo $id;?>">
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
	//}	
}
?>