<div id="addClienteModal" class="modal fade">
		<div class="modal-dialog">
			<div class="modal-content">
				<form name="add_cliente" id="add_cliente">
					<div class="modal-header">						
						<h4 class="modal-title">Agregar Cliente</h4>
						<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
					</div>
					<div class="modal-body">					

						<div class="form-group">
							<label>Nombre Cliente</label>
							<input type="text" name="CustomerName2" id="CustomerName2" class="form-control" required>
						</div>
						<div class="form-group">
							<label>Ciudad</label>
							<input type="text" name="CustomerCity2" id="CustomerCity2" class="form-control" required>
						</div>
						<div class="form-group">
							<label>Nit</label>
							<input type="input" name="CustomerNit2" id="CustomerNit2" class="form-control" maxlength="12" required>
						</div>
						<div class="form-group">
							<label>Color</label>
							<input type="color" name="CustomerColor2" id="CustomerColor2" class="form-control" required>
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
	<script src="./plugins/jquery-numeric/jquery.numeric.js"></script>
	<script>
	$("#CustomerNit2").numeric();
	</script>