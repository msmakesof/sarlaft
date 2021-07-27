<div class="modal fade" id="exampleModal5" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel5">Escala de Efectividad</h5>
        <button type="button" class="close text-dark" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
     <form method="post" id="formulario5" >
          <div class="form-group">
            <label for="EEfectividadName" class="col-form-label ">Nombre:</label>
            <input name="EEfectividadName" type="text" class="form-control" id="EEfectividadName" autocomplete="off" required>
          </div>

          <div class="form-group">
            <label for="EEfectividadValue" class="col-form-label ">Valor:</label>
      <input type="number" name="EEfectividadValue" class="form-control" id="EEfectividadValue" autocomplete="off" required>
          </div>          


        </form>
        <div id="resp5" class=" text-primary"></div>
      </div>
      <div class="modal-footer">
        <a href="./Escalas.php" class="btn btn-secondary" >Cerrar</button></a>
        <button type="button" id="btn-ingresar5" class="btn btn-info">Registrar</button>
      </div>
    </div>
  </div>
</div>
