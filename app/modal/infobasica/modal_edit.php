<div id="editInfobasicaModal" class="modal fade">
		<div class="modal-dialog">
			<div class="modal-content">
				<form name="edit_infobasica" id="edit_infobasica">
					<div class="modal-header">						
						<h4 class="modal-title">Editar Información Básica</h4>
						<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
					</div>
					<div class="modal-body">					
						<div class="form-group row">
							<div class="col-md-6">
								<label>Actividad Económica</label>
								<textarea class="form-control" id="eActividadEconomica" name="eActividadEconomica" rows="3" required></textarea>
								<input type="hidden" name="edit_id" id="edit_id" >
							</div>
							<div class="col-md-6">
								<label>Objeto Social</label>
								<textarea class="form-control"  id="eObjetoSocial" name="eObjetoSocial" rows="3" required></textarea>
							</div>
						</div>
						<div class="form-group row">
							<div class="col-md-6">
								<label>Descripción General</label>
								<textarea class="form-control" id="eDescripcionGeneral" name="eDescripcionGeneral" rows="3" required></textarea>
							</div>
							<div class="col-md-6">
								<label>Objetivos Estratégicos</label>
								<textarea class="form-control" id="eObjetivosEstrategicos" name="eObjetivosEstrategicos" rows="3" required></textarea>

							</div>
						</div>

						<div class="form-group row">
							<div class="col-md-6">
								<label>Misión</label>
								<textarea class="form-control" id="eMision" name="eMision" rows="3" required></textarea>
							</div>
							<div class="col-md-6">
								<label>Visión</label>
								<textarea class="form-control" id="eVision" name="eVision" rows="3" required></textarea>
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