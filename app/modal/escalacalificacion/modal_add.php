<div id="addEscalacalificacionModal" class="modal fade">
	<div class="modal-dialog">
		<div class="modal-content">
			<form name="add_escalacalificacion" id="add_escalacalificacion">
				<div class="modal-header">						
					<h4 class="modal-title">Agregar Escala Calificación</h4>
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				</div>
				<div class="modal-body">					

					<div class="form-group">
						<label>Valor</label>
						<input class="form-control" id="Name2" name="Name2" maxlength="2" required>
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
$("#Name2").numeric();
</script>