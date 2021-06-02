<div id="addUserModal" class="modal fade">
		<div class="modal-dialog">
			<div class="modal-content">
				<form name="add_user" id="add_user">
					<div class="modal-header">						
						<h4 class="modal-title">Agregar Usuario</h4>
						<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
					</div>
					<div class="modal-body">
						<div class="form-group">
							<label>Compañía</label>
    								<select class="form-control" id="CustomerKey2" name="CustomerKey2" required>
      									<option value="901106238">AsRiesgos</option>    									
									<?php
										$query = sqlsrv_query($con,"SELECT CustomerKey, CustomerName FROM CustomerSarlaft");
										while($row = sqlsrv_fetch_array($query)){	
									?>   									
      									<option value="<?php echo $row['CustomerKey'];?>"><?php echo $row['CustomerName'];?></option>
      								<?php
      									}
      								?>
    								</select>
    					</div>								

						<div class="form-group">
							<label>Nombre Usuario</label>
							<input type="text" name="UserName2" id="UserName2" class="form-control" required>
						</div>
						<div class="form-group">
							<label>Correo</label>
							<input type="email" name="UserEmail2" id="UserEmail2" class="form-control" required>
						</div>
						<div class="form-group">
							<label>Password</label>
							<input type="Password" name="Password2" id="Password2" class="form-control" required>
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