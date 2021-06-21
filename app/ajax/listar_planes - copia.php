<?php
	include('is_logged.php');
	/* Connect To Database*/
	require_once ("../components/sql_server.php");

$action = (isset($_REQUEST['action'])&& $_REQUEST['action'] !=NULL)?$_REQUEST['action']:'';
if($action == 'ajax'){

	$query = sqlsrv_query($conn,"SELECT * FROM PlanesSarlaft ");
	{
	
	?>
		<div class="table-responsive">
			<table class="table table-striped table-hover">
				<thead style="font-size: 9px">
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
						$finales=0;
						$i=1;
						if ( $query === false)
						{
							die(print_r(sqlsrv_errors(), true));
						}						
						while( $row = sqlsrv_fetch_array( $query, SQLSRV_FETCH_ASSOC) ) {

								//$PlanesId=$row['PlanesId'];
								$PlanesId=$row['id'];
								$PlanesKey=$row['PlanesKey'];
								$PlanesName=$row['PlanesName'];
								$PlanesResponsable=$row['PlanesResponsable'];
								$PlanesTarea=$row['PlanesTarea'];
								$PlanesPlazo=$row['PlanesPlazo'];
								$PlanesAprueba=$row['PlanesAprueba'];
								$PlanesNivelPrioridad=$row['PlanesNivelPrioridad'];	
								$PlanesRespSeguimiento=$row['PlanesRespSeguimiento'];
								$PlanesRespAprobacion=$row['PlanesRespAprobacion'];
								$PlanesFInicio=$row['PlanesFInicio'];
								$PlanesFSeguimiento=$row['PlanesFSeguimiento'];
								$PlanesFTerminacion=$row['PlanesFTerminacion'];
								$PlanesAvance=$row['PlanesAvance'];
								$PlanesStatus=$row['PlanesStatus'];
								/////$CargosId=$row['CargosId'];                // este nombre no existe en la tabla , mks 20210615, Verificar
								$CargosId=  0;
								/////$ResponsablesId=$row['ResponsablesId'];	// este nombre no existe en la tabla , mks 20210615, Verificar		
								$ResponsablesId=0;
							?>	
							<tr >
								<td class='text-left'><?php echo $i++;?></td>
								<!--<td class='text-left'><?php //echo $PlanesKey;?></td>-->
								<td class='text-left'><?php echo $PlanesName;?></td>
								<td class='text-left' ><?php $query=sqlsrv_query($conn,"SELECT ResponsablesId, ResponsablesName FROM ResponsablesSarlaft WHERE ResponsablesId=".$PlanesResponsable."");$reg=sqlsrv_fetch_array($query); echo $reg['ResponsablesName'];?></td>
								<td class='text-left'><?php echo $PlanesTarea;?></td>
								<td class='text-center'><a href="#"  data-target="#newTareaPlanModal" class="edit" data-toggle="modal" data-name="<?php echo $PlanesName?>" data-key="<?php echo $PlanesKey?>" data-responsable="<?php echo $PlanesResponsable?>" data-tarea="<?php echo $PlanesTarea?>" data-plazo="<?php echo $PlanesPlazo?>" data-aprueba="<?php echo $PlanesAprueba?>" data-nivelp="<?php echo $PlanesNivelPrioridad?>" data-resps="<?php echo $PlanesRespSeguimiento?>" data-respa="<?php echo $PlanesRespAprobacion?>" data-inicio="<?php echo $PlanesFInicio?>" data-fseg="<?php echo $PlanesFSeguimiento?>" data-termina="<?php echo $PlanesFTerminacion?>" data-avance="<?php echo $PlanesAvance?>" data-id="<?php echo $PlanesId; ?>"><i class="material-icons" data-toggle="tooltip" title="Nuevo" >&#xE147;</i></a></td>
								<td class='text-center'><?php echo $PlanesPlazo;?></td>							
								<td class='text-left'><?php $query=sqlsrv_query($conn,"SELECT CargosName FROM CargosSarlaft WHERE CargosId=".$PlanesAprueba."");$reg=sqlsrv_fetch_array($query); echo $reg['CargosName'];?></td>
								<td class='text-left'><?php echo $PlanesNivelPrioridad;?></td>
								<td class='text-left' ><?php $query=sqlsrv_query($conn,"SELECT ResponsablesName FROM ResponsablesSarlaft WHERE ResponsablesId=".$PlanesRespSeguimiento."");$reg=sqlsrv_fetch_array($query); echo $reg['ResponsablesName'];?></td>
								<td class='text-left' ><?php $query=sqlsrv_query($conn,"SELECT ResponsablesName FROM ResponsablesSarlaft WHERE ResponsablesId=".$PlanesRespAprobacion."");$reg=sqlsrv_fetch_array($query); echo $reg['ResponsablesName'];?></td>
								<td class='text-left'><?php echo $PlanesFInicio;?></td>
								<td class='text-left'><?php echo $PlanesFSeguimiento;?></td>
								<td class='text-left'><?php echo $PlanesFTerminacion;?></td>
								<td class='text-center'><?php echo $PlanesAvance;?></td>
								<td class='text-rigth'>
									<a href="#"  data-target="#editPlanModal" class="edit" data-toggle="modal" data-name="<?php echo $PlanesName?>" data-responsable="<?php echo $PlanesResponsable?>" data-tarea="<?php echo $PlanesTarea?>" data-plazo="<?php echo $PlanesPlazo?>" data-aprueba="<?php echo $PlanesAprueba?>" data-nivelp="<?php echo $PlanesNivelPrioridad?>" data-resps="<?php echo $PlanesRespSeguimiento?>" data-respa="<?php echo $PlanesRespAprobacion?>" data-inicio="<?php echo $PlanesFInicio?>" data-fseg="<?php echo $PlanesFSeguimiento?>" data-termina="<?php echo $PlanesFTerminacion?>" data-avance="<?php echo $PlanesAvance?>" data-id="<?php echo $PlanesId; ?>"><i class="material-icons" data-toggle="tooltip" title="Editar" >&#xE254;</i></a>
									<a href="#deletePlanModal" class="delete" data-toggle="modal" data-id="<?php echo $PlanesId;?>"><i class="material-icons" data-toggle="tooltip" title="Eliminar">&#xE872;</i></a>
								</td>
							</tr>
						<?php }	?>

				</tbody>			
			</table>
		</div>	

	
	<?php	
	}	
}
?>          
		  
