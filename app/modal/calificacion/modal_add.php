<div id="addCalificacionModal" class="modal fade">
		<div class="modal-dialog">
			<div class="modal-content">
				<form name="add_calificacion" id="add_calificacion">
					<div class="modal-header">						
						<h4 class="modal-title">Agregar Calificación</h4>
						<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
					</div>
					<div class="modal-body">					

						<div class="form-group">
							<label>Nombre</label>
							<input type="text" class="form-control" id="Name2" name="Name2"  maxlength="50" required>
						</div>
						
						<div class="form-group">
							<label>Rango Inicial</label>
							<input type="text" class="form-control" id="RangoIni" name="RangoIni"  maxlength="3" required>
						</div>
						
						<div class="form-group">
							<label>Rango Final</label>
							<input type="text" class="form-control" id="RangoFin" name="RangoFin"  maxlength="3" required>
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
	$("#RangoIni").numeric();
	$("#RangoFin").numeric();
	</script>