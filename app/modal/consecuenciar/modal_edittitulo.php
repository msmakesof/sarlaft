<style>
.let h4 {
    text-transform: lowercase !important;
}
.let h4:first-letter {
    text-transform: uppercase !important;
}
</style>
<div id="editModiftituloModal" class="modal fade">
	<div class="modal-dialog">
		<div class="modal-content">
			<form name="fedit_titulo" id="fedit_titulo">
				<div class="modal-header">						
					<h4 class="modal-title let">Editar Texto <?php echo $NombreTitulo; ?>.</h4>
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				</div>
				<div class="modal-body">					
					<div class="form-group">
						<label>Nombre </label>
						<input type="text" name="edit_nametitulo" id="edit_nametitulo" class="form-control" maxlength="50" value="<?php echo $NombreTitulo ; ?>" required/>
						<input type="hidden" name="edit_idtitulo" id="edit_idtitulo" value="<?php echo $IdTitulo ; ?>"/>
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