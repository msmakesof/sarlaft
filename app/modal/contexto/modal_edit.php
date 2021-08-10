<div id="editContextoModal" class="modal fade">
		<div class="modal-dialog">
			<div class="modal-content">
				<form name="edit_contexto" id="edit_contexto">
					<div class="modal-header">						
						<h4 class="modal-title">Editar Contexto</h4>
						<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
					</div>
					<div class="modal-body">					
						<div class="form-group row">
							<div class="col-md-12">
								<label>Contexto Interno</label>
								<textarea class="form-control" id="eInterno" name="eInterno" rows="3" required></textarea>
								<input type="hidden" name="edit_id" id="edit_id" >
							</div>							
						</div>
						<div class="form-group row">
							<div class="col-md-12">
								<label>Contexto Externo</label>
								<textarea class="form-control" id="eExterno" name="eExterno" rows="3" required></textarea>
							</div>
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