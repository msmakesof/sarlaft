<div id="editPlanModal" class="modal fade">
		<div class="modal-dialog">
			<div class="modal-content">
				<form name="edit_plan" id="edit_plan">
					<div class="modal-header">						
						<h4 class="modal-title">Editar Plan</h4>
						<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
					</div>
					<div class="modal-body">					
						<div class="form-group">
							<label>Nombre Plan</label>
							<textarea class="form-control" id="edit_name" name="edit_name" rows="3" required></textarea>
							<input type="hidden" name="edit_id" id="edit_id" >
						</div>
						<div class="form-group">
							<label>Responsable</label>
    								<select class="form-control" id="edit_responsable" name="edit_responsable" required>
      									<option value="">Seleccione una opción</option>    									
									<?php
										$query = sqlsrv_query($conn,"SELECT ResponsablesName FROM ResponsablesSarlaft WHERE CustomerKey='".$_SESSION['Keyp']."'");
										while($row = sqlsrv_fetch_array($query)){	
									?>   									
      									<option value="<?php echo $row['ResponsablesName'];?>"><?php echo $row['ResponsablesName'];?></option>
      								<?php
      									}
      								?>
    								</select>
    					</div>
						<div class="form-group">
							<label>Tarea</label>
							<textarea class="form-control" id="edit_tarea" name="edit_tarea" rows="3" required></textarea>
						</div>
						<div class="form-group">
							<label>Plazo</label>
							<input type="number" name="edit_plazo" id="edit_plazo" class="form-control" required>
						</div>
						<div class="form-group">
							<label>Aprueba</label>
    								<select class="form-control" id="edit_aprueba" name="edit_aprueba" required>
      									<option value="">Seleccione una opción</option>    									
									<?php
										$query = sqlsrv_query($conn,"SELECT CargosName FROM CargosSarlaft WHERE CustomerKey='".$_SESSION['Keyp']."'");
										while($row = sqlsrv_fetch_array($query)){	
									?>   									
      									<option value="<?php echo $row['CargosName'];?>"><?php echo $row['CargosName'];?></option>
      								<?php
      									}
      								?>
    								</select>
    					</div>
						<div class="form-group">
							  <div class="form-group">
    							<label for="exampleFormControlSelect1">Nivel de Prioridad</label>
    								<select class="form-control" id="edit_nivelp" name="edit_nivelp" required>
      									<option value="">Seleccione una opción</option>
      									<option value="Alto">Alto</option>
      									<option value="Medio">Medio</option>
      									<option value="Bajo">Bajo</option>
    								</select>
  							  </div>
						</div>
						<div class="form-group">
							<label>Responsable de Seguimiento</label>
    								<select class="form-control" id="edit_resps" name="edit_resps" required>
      									<option value="">Seleccione una opción</option>    									
									<?php
										$query = sqlsrv_query($conn,"SELECT ResponsablesName FROM ResponsablesSarlaft WHERE CustomerKey='".$_SESSION['Keyp']."'");
										while($row = sqlsrv_fetch_array($query)){	
									?>   									
      									<option value="<?php echo $row['ResponsablesName'];?>"><?php echo $row['ResponsablesName'];?></option>
      								<?php
      									}
      								?>
    								</select>
    					</div>
 						<div class="form-group">
							<label>Responsable de Aprobación</label>
    								<select class="form-control" id="edit_respa" name="edit_respa" required>
      									<option value="">Seleccione una opción</option>    									
									<?php
										$query = sqlsrv_query($conn,"SELECT ResponsablesName FROM ResponsablesSarlaft WHERE CustomerKey='".$_SESSION['Keyp']."'");
										while($row = sqlsrv_fetch_array($query)){	
									?>   									
      									<option value="<?php echo $row['ResponsablesName'];?>"><?php echo $row['ResponsablesName'];?></option>
      								<?php
      									}
      								?>
    								</select>
    					</div>
						<div class="form-group">
							<label>Fecha de Inicio</label>
							<input type="date" name="edit_inicio" id="edit_inicio" class="form-control" required>
						</div>						
						<div class="form-group">
							<label>Fecha de Seguimiento</label>
							<input type="date" name="edit_fseg" id="edit_fseg" class="form-control" required>
						</div>
						<div class="form-group">
							<label>Fecha de Terminacion</label>
							<input type="date" name="edit_termina" id="edit_termina" class="form-control" required>
						</div>
						<div class="form-group">
							<label>% Avance</label>
							<input type="number" name="edit_avance" id="edit_avance" class="form-control" required>
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