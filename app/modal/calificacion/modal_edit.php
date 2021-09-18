<div id="editCalificacionModal" class="modal fade">
	<div class="modal-dialog">
		<div class="modal-content">
			<form name="edit_calificacion" id="edit_calificacion">
				<div class="modal-header">						
					<h4 class="modal-title">Editar Calificación.</h4>
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				</div>
				<div class="modal-body">					
					<div class="form-group">
						<label>Nombre </label> <?php //echo 'ck...'. ; ?>
						<input type="text" name="edit_name" id="edit_name" class="form-control" maxlength="50" required>
						<input type="hidden" name="edit_id" id="edit_id" >
						<input type="hidden" name="edit_ck" id="edit_ck" >
					</div>
					<div class="form-group">
						<label>Rango Inicial </label>
						<input type="text" name="edit_rangoini" id="edit_rangoini" class="form-control" maxlength="3" required>
					</div>
					<div class="form-group">
						<label>Rango Final </label>
						<input type="text" name="edit_rangofin" id="edit_rangofin" class="form-control" maxlength="3" required>
					</div>
					<div class="form-group">
						<label>Color </label>
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
<script src="./plugins/jquery-numeric/jquery.numeric.js"></script>
<script>
	$("#edit_rangoini").numeric();
	$("#edit_rangofin").numeric();
</script>