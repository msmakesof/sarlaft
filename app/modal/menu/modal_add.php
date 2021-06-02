<div id="addUserModal" class="modal fade">
		<div class="modal-dialog">
			<div class="modal-content">
				<form name="add_user" id="add_user">
					<div class="modal-header">						
						<h4 class="modal-title">Agregar Menu</h4>
						<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
					</div>
					<div class="modal-body">
						<div class="form-group">
							<label>Nombre </label>
							<input type="text" name="UserName2" id="UserName2" class="form-control" maxlength="30" required>
						</div>
						<div class="form-group">
							<label>Estado</label>							
							<select class="form-control select2" name="estado" id="estado" style="width: 100%;" required>
								<option value="">Seleccione ...</option>								
								<?php include("./curl/estado/listar.php"); ?>
							</select>	
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
	