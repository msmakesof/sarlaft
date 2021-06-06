<div id="addUserModal" class="modal fade">
		<div class="modal-dialog">
			<div class="modal-content">
				<form name="add_user" id="add_user">
					<div class="modal-header">						
						<h4 class="modal-title">Agregar Usuario</h4>
						<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
					</div>
					<div class="modal-body">
						<div class="form-group">
							<label>Compañía</label>							
							<select class="form-control select2" name="CustomerKey2" id="CustomerKey2" style="width: 100%;" required>
								<option value="">Seleccione ...</option>								
								<?php include("./curl/cliente/listartodo.php"); ?>
							</select>	
						</div>
						<div class="form-group">
							<label>Nombre </label>
							<input type="text" name="UserName2" id="UserName2" class="form-control" maxlength="30" required>
						</div>
						<div class="form-group">
							<label>Email </label>
							<input type="text" name="Email" id="Email" class="form-control" maxlength="50" required>
						</div>
						<div class="form-group">
							<label>Password</label>
							<input type="Password" name="Password2" id="Password2" class="form-control"  maxlength="20" required>
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
	