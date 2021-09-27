<?php
include('is_logged.php');
$UserKey=$_SESSION['UserKey'];
$CustomerKey = trim($_SESSION['Keyp']);
/* Connect To Database*/
require_once '../config/dbx.php';
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
	
	if( $OPC_Nombre == "TRATAMIENTOS" ){
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
if($action == 'ajax'){

	$query = sqlsrv_query($conn,"SELECT id, CustomerKey, TratamientosKey, TratamientosName, UserKey FROM TratamientosSarlaft WHERE CustomerKey='".$_SESSION['Keyp']."'");
	{
	include('../components/table.php');
	?>
					<tr>
						<th class='text-center'>#</th>
						<th class='text-left'>Nombre Tratamiento </th>
						<th class='text-center'>Eventos</th>
						<th class='text-left'>Acciones</th>						
					</tr>
				</thead>
				<tbody>	
						<?php 
						$finales=0;
						$i=1;
						if ( $query === false)
						{
							die(print_r(sqlsrv_errors(), true));
						}						
						while( $row = sqlsrv_fetch_array( $query, SQLSRV_FETCH_ASSOC) ) {
							$id=$row['id'];
							$CustomerKey=$row['CustomerKey'];
							$TratamientosKey=$row['TratamientosKey'];
							$TratamientosName=$row['TratamientosName'];
							$UserKey=$row['UserKey'];					
							$finales++;
						?>	
						<tr class="<?php echo $text_class;?>">
							<td class='text-center'><?php echo $i++;?></td>
							<td class='text-left'><?php echo $TratamientosName;?></td>
							<td class='text-center'><a href="#" class='btn btn-default' title='Eventos'><i class="material-icons">&#xE147;</i></a></td>
							<td class='text-left'>
							<?php if( $modificar == 1 ) { ?>
								<a href="#"  data-target="#editTratamientoModal" class="edit" data-toggle="modal" data-name="<?php echo $TratamientosName?>"  data-id="<?php echo $id; ?>"><i class="material-icons" data-toggle="tooltip" title="Editar" >&#xE254;</i></a>
							<?php } 
							if( $eliminar == 1 ) { ?>
								<a href="#deleteTratamientoModal" class="delete" data-toggle="modal" data-id="<?php echo $id;?>"><i class="material-icons" data-toggle="tooltip" title="Eliminar">&#xE872;</i></a>
							<?php } ?>
                    		</td>
						</tr>
						<?php } ?>

				</tbody>			
			</table>
		</div>	
	<?php	
	}	
}
?>