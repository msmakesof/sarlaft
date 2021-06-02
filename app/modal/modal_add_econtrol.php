<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Escala de Control</h5>
        <button type="button" class="close text-dark" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
     <form method="post" id="formulario" >
          <div class="form-group">
            <label for="EControlName" class="col-form-label ">Nombre:</label>
            <input name="EControlName" type="number" class="form-control" id="EControlName" autocomplete="off" required>
          </div>

          <div class="form-group">
            <label for="EControlValue" class="col-form-label ">Valor:</label>
      <input type="number" name="EControlValue" class="form-control" id="EControlValue" autocomplete="off" required>
          </div>          


        </form>
        <div id="resp" class=" text-primary"></div>
      </div>
      <div class="modal-footer">
        <a href="./Escalas" class="btn btn-secondary" >Cerrar</button></a>
        <button type="button" id="btn-ingresar" class="btn btn-info">Registrar</button>
      </div>
    </div>
  </div>
</div>
