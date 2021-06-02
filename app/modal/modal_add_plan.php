
	<div id="addPlanModal" class="modal fade">
		<div class="modal-dialog">
			<div class="modal-content">
				<form name="add_plan" id="add_plan">
					<div class="modal-header">						
						<h4 class="modal-title">Agregar Plan</h4>
						<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
					</div>
					<div class="modal-body">				
						<div class="form-group">
							<label>Nombre Plan</label>
							<textarea class="form-control" id="PlanesName2" name="PlanesName2" rows="3" required></textarea>
						</div>	
						<div class="form-group">
							  <div class="form-group">
    							<label for="exampleFormControlSelect1">Responsable</label>
    								<select class="form-control" id="PlanesResponsable2" name="PlanesResponsable2" required>
      									<option value="">Seleccione una opción</option>    									
									<?php
										$query = sqlsrv_query($conn,"SELECT ResponsablesId,ResponsablesName FROM ResponsablesSarlaft WHERE CustomerKey='".$_SESSION['Keyp']."'");
										while($row = sqlsrv_fetch_array($query)){	
									?>   									
      									<option value="<?php echo $row['ResponsablesId'];?>"><?php echo $row['ResponsablesName'];?></option>
      								<?php
      									}
      								?>
    								</select>
  							  </div>
						</div>
						<div class="form-group">
							<label>Tarea</label>
							<textarea class="form-control" id="PlanesTarea2" name="PlanesTarea2" rows="3" required></textarea>
						</div>

						<div class="form-group">
							<label>Plazo</label>
							<input type="number" name="PlanesPlazo2" id="PlanesPlazo2" class="form-control" required>
						</div>
						<div class="form-group">
							  <div class="form-group">
    							<label for="exampleFormControlSelect1">Aprueba</label>
    								<select class="form-control" id="PlanesAprueba2" name="PlanesAprueba2" required>
      									<option value="">Seleccione una opción</option>    									
									<?php
										$query = sqlsrv_query($conn,"SELECT CargosId,CargosName FROM CargosSarlaft WHERE CustomerKey='".$_SESSION['Keyp']."'");
										while($row = sqlsrv_fetch_array($query)){	
									?>   									
      									<option value="<?php echo $row['CargosId'];?>"><?php echo $row['CargosName'];?></option>
      								<?php
      									}
      								?>
    								</select>
  							  </div>
						</div>
						<div class="form-group">
							  <div class="form-group">
    							<label for="exampleFormControlSelect1">Nivel de Prioridad</label>
    								<select class="form-control" id="PlanesNivelPrioridad2" name="PlanesNivelPrioridad2" required>
      									<option value="">Seleccione una opción</option>
      									<option value="Alto">Alto</option>
      									<option value="Medio">Medio</option>
      									<option value="Bajo">Bajo</option>
    								</select>
  							  </div>
						</div>

						<div class="form-group">
							  <div class="form-group">
    							<label for="exampleFormControlSelect1">Responsable del Seguimiento</label>
    								<select class="form-control" id="PlanesRespSeguimiento2" name="PlanesRespSeguimiento2" required>
      									<option value="">Seleccione una opción</option>    									
									<?php
										$query = sqlsrv_query($conn,"SELECT ResponsablesId, ResponsablesName FROM ResponsablesSarlaft WHERE CustomerKey='".$_SESSION['Keyp']."'");
										while($row = sqlsrv_fetch_array($query)){	
									?>   									
      									<option value="<?php echo $row['ResponsablesId'];?>"><?php echo $row['ResponsablesName'];?></option>
      								<?php
      									}
      								?>
    								</select>
  							  </div>
						</div>
						<div class="form-group">
							  <div class="form-group">
    							<label for="exampleFormControlSelect1">Responsable de la Aprobación</label>
    								<select class="form-control" id="PlanesRespAprobacion2" name="PlanesRespAprobacion2" required>
      									<option value="">Seleccione una opción</option>    									
									<?php
										$query = sqlsrv_query($conn,"SELECT ResponsablesId, ResponsablesName FROM ResponsablesSarlaft WHERE CustomerKey='".$_SESSION['Keyp']."'");
										while($row = sqlsrv_fetch_array($query)){	
									?>   									
      									<option value="<?php echo $row['ResponsablesId'];?>"><?php echo $row['ResponsablesName'];?></option>
      								<?php
      									}
      								?>
    								</select>
  							  </div>
						</div>
						<div class="form-group">
							<label>Fecha de Inicio</label>
							<input type="date" name="PlanesFInicio2" id="PlanesFInicio2" class="form-control" required>
						</div>						
						<div class="form-group">
							<label>Fecha de Seguimiento</label>
							<input type="date" name="PlanesFSeguimiento2" id="PlanesFSeguimiento2" class="form-control" required>
						</div>
						<div class="form-group">
							<label>Fecha de Terminacion</label>
							<input type="date" name="PlanesFTerminacion2" id="PlanesFTerminacion2" class="form-control" required>
						</div>
						<div class="form-group">
							<label>% Avance</label>
							<input type="number" name="PlanesAvance2" id="PlanesAvance2" class="form-control" required>
						</div>																			
					</div>
					<div class="modal-footer">
						<input type="button" class="btn btn-default" data-dismiss="modal" value="Cerrar">
						<input type="submit" class="btn btn-info" value="Guardar datos">
					</div>
				</form>
			</div>
		</div>
	</div>