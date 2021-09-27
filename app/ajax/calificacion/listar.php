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
	
	if( $OPC_Nombre == "CALIFICACION" ){
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
					//include '../../curl/calificacion/listar.php';
					$CustomerKey = trim($_SESSION['Keyp']);
					//echo $CustomerKey;
					include '../../curl/calificacion/listar_eveall.php';
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
								$CustomerKey=trim($data['body'][$i]['CAL_CustomerKey']);
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
								<?php if( $modificar == 1 ) { ?>
									<a href="#" data-target="#editCalificacionModal" class="edit" data-toggle="modal" data-name="<?php echo $Name; ?>" data-rangoini="<?php echo $rangoini; ?>" data-rangofin="<?php echo $rangofin; ?>" data-color="<?php echo $color; ?>" data-ck="<?php echo $CustomerKey; ?>" data-id="<?php echo $id; ?>">
										<i class="material-icons" data-toggle="tooltip" title="Editar" >&#xE254;</i>
									</a>
								<?php } 
								if( $eliminar == 1 ) { ?>
									<a href="#deleteCalificacionModal" class="delete" data-toggle="modal" data-id="<?php echo $id;?>">
										<i class="material-icons" data-toggle="tooltip" title="Eliminar">&#xE872;</i>
									</a>
								<?php } ?>
								</td>
							</tr>
					<?php 	} 
						}	
					}
					?>
			</tbody>			
		</table>
	</div>
<?php
}
?>