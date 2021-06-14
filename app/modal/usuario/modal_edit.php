<div id="editUserModal" class="modal fade">
	<div class="modal-dialog">
		<div class="modal-content">
			<form name="edit_user" id="edit_user">
				<div class="modal-header">						
					<h4 class="modal-title">Editar Usuario.</h4>
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				</div>				
				<div class="modal-body">
					
					<div class="form-group">
						<label>Nombre </label>
						<input type="text" name="edit_name" id="edit_name" class="form-control" maxlength="30" required>
						<input type="hidden" name="edit_id" id="edit_id" >
					</div>
					<div class="form-group">
						<label>Email </label>
						<input type="text" name="edit_email" id="edit_email" class="form-control" maxlength="50" required>
					</div>
					<div class="form-group">
						<label>Password</label>
						<input type="Password" name="edit_password2" id="edit_password2" class="form-control"  maxlength="20" required>
					</div>
					<div class="form-group">
						<label>Compañía</label>
						<select name="edit_customerkey2" id="edit_customerkey2" class="select2"></select>					
					</div>
					<div class="form-group">
						<label>Rol ...</label>
						<select name="edit_rol" id="edit_rol" class="select2"></select>					
					</div>
					<div class="form-group">
						<label>Estado</label>						
						<select name="edit_estado" id="edit_estado" class="select2"></select>
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