<div id="addConsecuenciaModal" class="modal fade">
		<div class="modal-dialog">
			<div class="modal-content">
				<form name="add_consecuencia" id="add_consecuencia">
					<div class="modal-header">						
						<h4 class="modal-title">Agregar <?php echo $NombreTitulo; ?></h4>
						<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
					</div>
					<div class="modal-body">					

						<div class="form-group">
							<label>Nombre</label>
							<input type="text" class="form-control" id="Name2" name="Name2"  maxlength="50" required>
						</div>

						<div class="form-group">
							<label>Escala</label>
							<input type="text" class="form-control" id="Escala" name="Escala"  maxlength="1" required>
						</div>

						<div class="form-group">
							<label>Color</label>
							<input type="color" class="form-control" id="Color" name="Color" required>
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
	$("#Escala").numeric();
	</script>