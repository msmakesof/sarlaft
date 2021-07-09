<div id="editClienteModal" class="modal fade">
		<div class="modal-dialog">
			<div class="modal-content">
				<form name="edit_cliente" id="edit_cliente">
					<div class="modal-header">						
						<h4 class="modal-title">Editar Cliente</h4>
						<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
					</div>
					<div class="modal-body">					
						<div class="form-group">
							<label>Nombre Cliente</label>
							<input type="text" name="edit_name" id="edit_name" class="form-control" required>
							<input type="hidden" name="edit_id" id="edit_id" >
						</div>
						<div class="form-group">
							<label>Ciudad</label>
							<input type="text" name="edit_city" id="edit_city" class="form-control" required>
						</div>
						<div class="form-group">
							<label>Nit</label>
							<input type="number" name="edit_nit" id="edit_nit" class="form-control" required>
						</div>						
						<div class="form-group">
						</div>
						<div class="form-group">
							<label>Color</label>
							<input type="color" name="edit_color" id="edit_color" class="form-control" required>
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