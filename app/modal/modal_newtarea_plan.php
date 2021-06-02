<div id="newTareaPlanModal" class="modal fade">
		<div class="modal-dialog">
			<div class="modal-content">
				<form name="new_plan" id="new_plan">
					<div class="modal-header">						
						<h4 class="modal-title">Nueva tarea Plan</h4>
						<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
					</div>
					<div class="modal-body">
								
						<div class="form-group">
							<label>Nombre Plan</label>
							<textarea class="form-control" id="new_name" name="new_name" rows="3" readonly=""></textarea>
							
						</div>
						<div class="form-group">
							<label>Tarea</label>
							<textarea class="form-control" id="PlanesTarea2" name="PlanesTarea2" rows="3" required></textarea>
						</div>
						<input type="hidden" id="new_key" name="new_key" >
						<input type="hidden" id="new_id" name="new_id" >						
						<input type="hidden" id="new_responsable" name="new_responsable" >
						<input type="hidden" id="new_plazo" name="new_plazo" >
						<input type="hidden" id="new_aprueba" name="new_aprueba" >
						<input type="hidden" id="new_nivelp" name="new_nivelp" >
						<input type="hidden" id="new_resps" name="new_resps" >
						<input type="hidden" id="new_respa" name="new_respa" >
						<input type="hidden" id="new_inicio" name="new_inicio" >
						<input type="hidden" id="new_fseg" name="new_fseg" >
						<input type="hidden" id="new_termina" name="new_termina" >
						<input type="hidden" id="new_avance" name="new_avance" >
					
	
					</div>
					<div class="modal-footer">
						<input type="button" class="btn btn-default" data-dismiss="modal" value="Cerrar">
						<input type="submit" class="btn btn-info" value="Guardar datos">
					</div>
				</form>
			</div>
		</div>
	</div>