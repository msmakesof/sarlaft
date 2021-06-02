<div id="editTratamientoModal" class="modal fade">
		<div class="modal-dialog">
			<div class="modal-content">
				<form name="edit_tratamiento" id="edit_tratamiento">
					<div class="modal-header">						
						<h4 class="modal-title">Editar Tratamiento</h4>
						<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
					</div>
					<div class="modal-body">					
						<div class="form-group">
							<label>Nombre Tratamiento</label>
							<textarea class="form-control" id="edit_name" name="edit_name" rows="3" required></textarea>
							<input type="hidden" name="edit_id" id="edit_id" >
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