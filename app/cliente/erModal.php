<!-- 
******************************************************
**  Description:  Ventana modal para adición de items
**                desde la creación o consulta de un
**				  evento de Riesgo.
****************************************************** -->
<div id="addProcesoModal" class="modal fade">
	<div class="modal-dialog">
		<div class="modal-content">
			<form name="add_proceso" id="add_proceso">
				<div class="modal-header">						
					<h4 class="modal-title">Agregar Proceso</h4>
					<!-- <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button> -->
				</div>
				<div class="modal-body">					

					<div class="form-group">
						<label>Nombre Proceso</label>
						<textarea class="form-control" id="ProcesosName2" name="ProcesosName2" rows="3" required></textarea>
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

<div id="addCargoModal" class="modal fade">
	<div class="modal-dialog">
		<div class="modal-content">
			<form name="add_cargo" id="add_cargo">
				<div class="modal-header">						
					<h4 class="modal-title">Agregar Cargo</h4>
					<!-- <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>  -->
				</div>
				<div class="modal-body">					

					<div class="form-group">
						<label>Nombre Cargo</label>
						<textarea class="form-control" id="CargosName2" name="CargosName2" rows="3" required></textarea>
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

<div id="addResponsableModal" class="modal fade">
	<div class="modal-dialog">
		<div class="modal-content">
			<form name="add_responsable" id="add_responsable">
				<div class="modal-header">						
					<h4 class="modal-title">Agregar Responsable</h4>
					<!-- <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button> -->
				</div>
				<div class="modal-body">					

					<div class="form-group">
						<label>Nombre Responsable</label>
						<textarea class="form-control" id="ResponsablesName2" name="ResponsablesName2" rows="3" required></textarea>
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

<div id="addTipoRiesgoModal" class="modal fade">
	<div class="modal-dialog">
		<div class="modal-content">
			<form name="add_tiposriesgo" id="add_tiposriesgo">
				<div class="modal-header">						
					<h4 class="modal-title">Agregar Tipos de Riesgo</h4>
					<!-- <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button> -->
				</div>
				<div class="modal-body">					

					<div class="form-group">
						<label>Nombre</label>
						<input class="form-control" id="TipoRiesgoName2" name="TipoRiesgoName2" maxlength="50" required>
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

<div id="addFactorRiesgoModal" class="modal fade">
	<div class="modal-dialog">
		<div class="modal-content">
			<form name="add_factorriesgo" id="add_factorriesgo">
				<div class="modal-header">						
					<h4 class="modal-title">Agregar Factores de Riesgo</h4>
					<!-- <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button> -->
				</div>
				<div class="modal-body">					

					<div class="form-group">
						<label>Nombre Factor de Riesgo</label>
						<input class="form-control" id="FactorRiesgoName2" name="FactorRiesgoName2"  maxlength="50" required>
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

<div id="addCausaModal" class="modal fade">
	<div class="modal-dialog">
		<div class="modal-content">
			<form name="add_causa" id="add_causa">
				<div class="modal-header">						
					<h4 class="modal-title">Agregar Causa</h4>
					<!-- <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button> -->
				</div>
				<div class="modal-body">					

					<div class="form-group">
						<label>Nombre Causa</label>
						<textarea class="form-control" id="CausasName2" name="CausasName2" rows="3" required></textarea>
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

<div id="addRIAModal" class="modal fade">
	<div class="modal-dialog">
		<div class="modal-content">
			<form name="add_ria" id="add_ria">
				<div class="modal-header">						
					<h4 class="modal-title">Agregar Riesgo Asociado</h4>
					<!-- <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button> -->
				</div>
				<div class="modal-body">					

					<div class="form-group">
						<label>Nombre</label>
						<input class="form-control" id="Name2" name="Name2"  maxlength="50" required>
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

<div id="addConsecuenciaModal" class="modal fade">
	<div class="modal-dialog">
		<div class="modal-content">
			<form name="add_consecuencia" id="add_consecuencia">
				<div class="modal-header">						
					<h4 class="modal-title">Agregar Consecuencia</h4>
					<!-- <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button> -->
				</div>
				<div class="modal-body">					

					<div class="form-group">
						<label>Nombre Consecuencia</label>
						<textarea class="form-control" id="ConsecuenciasName2" name="ConsecuenciasName2" rows="3" required></textarea>
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

<div id="addControlModal" class="modal fade">
	<div class="modal-dialog">
		<div class="modal-content">
			<form name="add_control" id="add_control">
				<div class="modal-header">						
					<h4 class="modal-title">Agregar Control</h4>
					<!-- <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button> -->
				</div>
				<div class="modal-body">					

					<div class="form-group">
						<label>Nombre Control</label>
						<textarea class="form-control" id="ControlesName2" name="ControlesName2" rows="3" required></textarea>
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


<div id="addTratamientoModal" class="modal fade">
	<div class="modal-dialog">
		<div class="modal-content">
			<form name="add_tratamiento" id="add_tratamiento">
				<div class="modal-header">						
					<h4 class="modal-title">Agregar Tratamiento</h4>
					<!-- <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button> -->
				</div>
				<div class="modal-body">					

					<div class="form-group">
						<label>Nombre Tratamiento</label>
						<textarea class="form-control" id="TratamientosName2" name="TratamientosName2" rows="3" required></textarea>
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

<div id="addSegClientesModal" class="modal fade">
	<div class="modal-dialog">
		<div class="modal-content">
			<form name="add_segclientes" id="add_segclientes">
				<div class="modal-header">						
					<h4 class="modal-title">Agregar Segmento Cliente</h4>
					<!-- <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button> -->
				</div>
				<div class="modal-body">					

					<div class="form-group">
						<label>Nombre Segmento Cliente</label>
						<textarea class="form-control" id="SegClientesName2" name="SegClientesName2" rows="3" required></textarea>
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

<div id="addSegProductosModal" class="modal fade">
	<div class="modal-dialog">
		<div class="modal-content">
			<form name="add_segproductos" id="add_segproductos">
				<div class="modal-header">						
					<h4 class="modal-title">Agregar Segmento Producto</h4>
					<!-- <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>  -->
				</div>
				<div class="modal-body">					

					<div class="form-group">
						<label>Nombre Segmento Producto</label>
						<textarea class="form-control" id="SegProductosName2" name="SegProductosName2" rows="3" required></textarea>
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

<div id="addSegCanalesModal" class="modal fade">
	<div class="modal-dialog">
		<div class="modal-content">
			<form name="add_segcanales" id="add_segcanales">
				<div class="modal-header">						
					<h4 class="modal-title">Agregar Segmento Canal</h4>
					<!-- <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button> -->
				</div>
				<div class="modal-body">					

					<div class="form-group">
						<label>Nombre Segmento Canal</label>
						<textarea class="form-control" id="SegCanalesName2" name="SegCanalesName2" rows="3" required></textarea>
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

<div id="addSegJurisdiccionModal" class="modal fade">
	<div class="modal-dialog">
		<div class="modal-content">
			<form name="add_segjurisdiccion" id="add_segjurisdiccion">
				<div class="modal-header">						
					<h4 class="modal-title">Agregar Segmento Jurisdicción</h4>
					<!-- <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button> -->
				</div>
				<div class="modal-body">					

					<div class="form-group">
						<label>Nombre Segmento Jurisdicción</label>
						<textarea class="form-control" id="SegJurisdiccionName2" name="SegJurisdiccionName2" rows="3" required></textarea>
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

<div id="addDebilidadesModal" class="modal fade">
	<div class="modal-dialog">
		<div class="modal-content">
			<form name="add_debilidades" id="add_debilidades">
				<div class="modal-header">						
					<h4 class="modal-title">Agregar Debilidades</h4>
					<!-- <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button> -->
				</div>
				<div class="modal-body">					

					<div class="form-group">
						<label>Nombre Debilidades</label>
						<textarea class="form-control" id="DebilidadesName2" name="DebilidadesName2" rows="3" required></textarea>
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

<div id="addOportunidadesModal" class="modal fade">
	<div class="modal-dialog">
		<div class="modal-content">
			<form name="add_oportunidades" id="add_oportunidades">
				<div class="modal-header">						
					<h4 class="modal-title">Agregar Oportunidades</h4>
					<!-- <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button> -->
				</div>
				<div class="modal-body">

					<div class="form-group">
						<label>Nombre Oportunidades</label>
						<textarea class="form-control" id="OportunidadesName2" name="OportunidadesName2" rows="3" required></textarea>
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

<div id="addFortalezasModal" class="modal fade">
	<div class="modal-dialog">
		<div class="modal-content">
			<form name="add_fortalezas" id="add_fortalezas">
				<div class="modal-header">						
					<h4 class="modal-title">Agregar Fortalezas</h4>
					<!-- <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>  -->
				</div>
				<div class="modal-body">					

					<div class="form-group">
						<label>Nombre Fortalezas</label>
						<textarea class="form-control" id="FortalezasName2" name="FortalezasName2" rows="3" required></textarea>
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

<div id="addAmenazasModal" class="modal fade">
	<div class="modal-dialog">
		<div class="modal-content">
			<form name="add_amenazas" id="add_amenazas">
				<div class="modal-header">						
					<h4 class="modal-title">Agregar Amenazas</h4>
					<!-- <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>  -->
				</div>
				<div class="modal-body">					

					<div class="form-group">
						<label>Nombre Amenazas</label>
						<textarea class="form-control" id="AmenazasName2" name="AmenazasName2" rows="3" required></textarea>
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