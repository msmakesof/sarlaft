<?php
	include('../is_logged.php');
	/* Connect To Database*/
	////require_once ("../components/sql_server.php");

$action = (isset($_REQUEST['action'])&& $_REQUEST['action'] !=NULL)?$_REQUEST['action']:'';
if($action == 'ajax'){
	/*
	include '../pagination.php'; //include pagination file
	//**pagination variables
	$page = (isset($_REQUEST['page']) && !empty($_REQUEST['page']))?$_REQUEST['page']:1;
	$per_page = intval($_REQUEST['per_page']); //how much records you want to show
	$adjacents  = 4; //gap between pages after number of adjacents
	$offset = ($page - 1) * $per_page;	
	$reload = '../../Planes.php';  //'index.php';
	$total_pages = 0;
	*/
	$reload = '../../Planes.php';  //'index.php';
	include('../../components/table.php');
	?>
				<tr id="miTablaAnswer">
					<th class='text-center'>#</th>
					<!--<th class='text-center'>Codigo</th>-->
					<th class='text-center'>Nombre del Plan </th>
					<th class='text-left'>Responsable </th>
					<th class='text-center'>Tarea </th>
					<th class='text-center'>Nueva Tarea </th>
					<th class='text-center'>Plazo </th>
					<th class='text-center'>Aprueba </th>
					<th class='text-center'>Nivel de Prioridad</th>
					<th class='text-center'>Responsable del Seguimiento </th>
					<th class='text-left'>Responsable de la Aprobación </th>
					<th class='text-left'>Fecha Inicio </th>
					<th class='text-center'>Fecha de Seguimiento </th>
					<th class='text-center'>Fecha de Terminación </th>
					<th class='text-center'>Porcentaje de Avance</th>						
					<th class='text-left'>Acciones</th>						
				</tr>
			</thead>
			<tbody style="font-size: 12px">	
					<?php	
						include '../../curl/plan/listar.php';
						foreach($data as $key => $row) {}
						if( $key == "message"){	// No existen registros
							echo '<tr>
									<td colspan="15">'. $data["message"] .'</td>
								</tr>';
						}
						else
						{							
							$j=1;
							for($i=0; $i<count($data['body']); $i++)
							{
								$PlanesId=trim($data['body'][$i]['id']);
								$PlanesKey=trim($data['body'][$i]['PlanesKey']);
								$PlanesName=trim($data['body'][$i]['PlanesName']);
								$PlanesResponsable=trim($data['body'][$i]['PlanesResponsable']);
								$PlanesTarea=trim($data['body'][$i]['PlanesTarea']);
								$PlanesPlazo=trim($data['body'][$i]['PlanesPlazo']);
								$PlanesAprueba=trim($data['body'][$i]['PlanesAprueba']);
								$PlanesNivelPrioridad=trim($data['body'][$i]['PlanesNivelPrioridad']);	
								$PlanesRespSeguimiento=trim($data['body'][$i]['PlanesRespSeguimiento']);
								$PlanesRespAprobacion=trim($data['body'][$i]['PlanesRespAprobacion']);
								$PlanesFInicio=trim($data['body'][$i]['PlanesFInicio']);
								$PlanesFSeguimiento=trim($data['body'][$i]['PlanesFSeguimiento']);
								$PlanesFTerminacion=trim($data['body'][$i]['PlanesFTerminacion']);
								$PlanesAvance=trim($data['body'][$i]['PlanesAvance']);
								$PlanesStatus=trim($data['body'][$i]['PlanesStatus']);
								$NombreResponsable=trim($data['body'][$i]['NombreResponsable']);
								$CargosName=trim($data['body'][$i]['CargosName']);
								$NombreResponsableSeg=trim($data['body'][$i]['NombreResponsableSeg']);
								$NombreResponsableApr=trim($data['body'][$i]['NombreResponsableApr']);
						?>	
						<tr>
							<td class='text-left'><?php echo $j++; ?></td>
							<!--<td class='text-left'><?php //echo $PlanesKey;?></td>-->
							<td class='text-left'><?php echo $PlanesName;?></td>
							<!-- <td class='text-left' ><?php //$query=sqlsrv_query($conn,"SELECT ResponsablesId, ResponsablesName FROM ResponsablesSarlaft WHERE ResponsablesId=".$PlanesResponsable."");$reg=sqlsrv_fetch_array($query); echo $reg['ResponsablesName'];?></td> -->
							
							<td class='text-left' ><?php echo $NombreResponsable ;?></td>
							
							<td class='text-left'><?php echo $PlanesTarea;?></td>
							<td class='text-center'><a href="#"  data-target="#newTareaPlanModal" class="edit" data-toggle="modal" data-name="<?php echo $PlanesName?>" data-key="<?php echo $PlanesKey?>" data-responsable="<?php echo $PlanesResponsable?>" data-tarea="<?php echo $PlanesTarea?>" data-plazo="<?php echo $PlanesPlazo?>" data-aprueba="<?php echo $PlanesAprueba?>" data-nivelp="<?php echo $PlanesNivelPrioridad?>" data-resps="<?php echo $PlanesRespSeguimiento?>" data-respa="<?php echo $PlanesRespAprobacion?>" data-inicio="<?php echo $PlanesFInicio?>" data-fseg="<?php echo $PlanesFSeguimiento?>" data-termina="<?php echo $PlanesFTerminacion?>" data-avance="<?php echo $PlanesAvance?>" data-id="<?php echo $PlanesId; ?>"><i class="material-icons" data-toggle="tooltip" title="Nuevo" >&#xE147;</i></a></td>
							<td class='text-center'><?php echo $PlanesPlazo;?></td>								
							<!--<td class='text-left'><?php //$query=sqlsrv_query($conn,"SELECT CargosName FROM CargosSarlaft WHERE CargosId=".$PlanesAprueba."");$reg=sqlsrv_fetch_array($query); echo $reg['CargosName'];?></td> -->
							
							<td class='text-left'><?php echo $CargosName ;?></td>
							
							<td class='text-left'><?php echo $PlanesNivelPrioridad;?></td>
							<!-- <td class='text-left' ><?php //$query=sqlsrv_query($conn,"SELECT ResponsablesName FROM ResponsablesSarlaft WHERE ResponsablesId=".$PlanesRespSeguimiento."");$reg=sqlsrv_fetch_array($query); echo $reg['ResponsablesName'];?></td> -->
							
							<td class='text-left' ><?php echo $NombreResponsableSeg ;?></td>
							
							<!-- <td class='text-left' ><?php //$query=sqlsrv_query($conn,"SELECT ResponsablesName FROM ResponsablesSarlaft WHERE ResponsablesId=".$PlanesRespAprobacion."");$reg=sqlsrv_fetch_array($query); echo $reg['ResponsablesName'];?></td>  -->
							
							<td class='text-left' ><?php echo$NombreResponsableApr ;?></td>
							
							<td class='text-left'><?php echo $PlanesFInicio;?></td>
							<td class='text-left'><?php echo $PlanesFSeguimiento;?></td>
							<td class='text-left'><?php echo $PlanesFTerminacion;?></td>
							<td class='text-center'><?php echo $PlanesAvance;?></td>
							<td class='text-rigth'>
								<a href="#"  data-target="#editPlanModal" class="edit" data-toggle="modal" data-name="<?php echo $PlanesName?>" data-responsable="<?php echo $PlanesResponsable?>" data-tarea="<?php echo $PlanesTarea?>" data-plazo="<?php echo $PlanesPlazo?>" data-aprueba="<?php echo $PlanesAprueba?>" data-nivelp="<?php echo $PlanesNivelPrioridad?>" data-resps="<?php echo $PlanesRespSeguimiento?>" data-respa="<?php echo $PlanesRespAprobacion?>" data-inicio="<?php echo $PlanesFInicio?>" data-fseg="<?php echo $PlanesFSeguimiento?>" data-termina="<?php echo $PlanesFTerminacion?>" data-avance="<?php echo $PlanesAvance?>" data-id="<?php echo $PlanesId; ?>"><i class="material-icons" data-toggle="tooltip" title="Editar" >&#xE254;</i></a>
								<a href="#deletePlanModal" class="delete" data-toggle="modal" data-id="<?php echo $PlanesId;?>"><i class="material-icons" data-toggle="tooltip" title="Eliminar">&#xE872;</i></a>
							</td>
						</tr>
					<?php }	
					}
					?>
				</tbody>			
			</table>
			<div class="table-pagination pull-right"></div>
		</div>	
	<?php
}
?>