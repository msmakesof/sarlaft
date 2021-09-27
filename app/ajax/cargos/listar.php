<?php
include('../is_logged.php');	
/* Connect To Database*/
require_once '../../config/dbx.php';

$getConnectionSL = new Database();
$con = $getConnectionSL->getConnectionSL();
include '../acceso.php';

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
	
	if( $OPC_Nombre == "CARGOS" ){
		$ACC_Nombre = trim($row['ACC_Nombre']);
		if($ACC_Nombre == "CONSULTAR"){ $consultar=1 ;}
		if($ACC_Nombre == "CREAR"){ $crear=1 ;}
		if($ACC_Nombre == "MODIFICAR"){ $modificar=1 ;}
		if($ACC_Nombre == "ELIMINAR"){ $eliminar=1 ;}
		if($ACC_Nombre == "EXPORTAR"){ $exportar=1 ;}
		echo "modificar...$modificar";
	}
}

$getConnectionCli2 = new Database();
$conn = $getConnectionCli2->getConnectionCli2($CustomerKey );

$action = (isset($_REQUEST['action'])&& $_REQUEST['action'] !=NULL)?$_REQUEST['action']:'';
if($action == 'ajax'){
$j=1;
include('../../components/table.php');
?>
				<tr>
					<th class='text-center'>#</th>
					<th class='text-left'>Nombre </th>					
					<th class='text-left'>Acciones</th>						
				</tr>
			</thead>
			<tbody>	
				<?php
				include '../../curl/estado/listado.php';
				foreach($data as $key => $row) {}
				echo '<tbody>';
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
					<?php if( $modificar == 1 ) { ?>
						<a href="#" data-target="#editUserModal" class="edit" data-toggle="modal" data-name="<?php echo $NombreEstado; ?>" data-id="<?php echo $id; ?>"><i class="material-icons" data-toggle="tooltip" title="Editar" >&#xE254;</i></a>
					<?php } 
						if( $eliminar == 1 ) { ?>
						<a href="#deleteUserModal" class="delete" data-toggle="modal" data-id="<?php echo $id;?>"><i class="material-icons" data-toggle="tooltip" title="Eliminar">&#xE872;</i></a>
					<?php } ?>
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