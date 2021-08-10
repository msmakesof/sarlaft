<div id="addContextoModal" class="modal fade"  role="dialog" tabindex="-1" style="display: none !important;">
		<div class="modal-dialog modal-xl" role="document">
			<div class="modal-content">
				<form name="add_contexto" id="add_contexto">
					<div class="modal-header">						
						<h4 class="modal-title">Agregar Contexto</h4>
						<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
					</div>
					<div class="modal-body">					

						<div class="form-group row">
							<div class="col-md-12">
								<label>Contexto Interno</label>
								<textarea class="form-control" id="Interno" name="Interno" rows="3" required></textarea>
							</div>
						</div>

						<div class="form-group row">
							<div class="col-md-12">
								<label>Contexto Externo</label>
								<textarea class="form-control" id="Externo" name="Externo" rows="3" required></textarea>
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