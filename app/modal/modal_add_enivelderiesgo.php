<div class="modal fade" id="exampleModal4" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel4">Escala de Nivel de Riesgo</h5>
        <button type="button" class="close text-dark" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
     <form method="post" id="formulario4" >
          <div class="form-group">
            <label for="ENiveldeRiesgoName" class="col-form-label ">Nombre:</label>
            <input name="ENiveldeRiesgoName" type="text" class="form-control" id="ENiveldeRiesgoName" autocomplete="off" required>
          </div>

          <div class="form-group">
            <label for="ENiveldeRiesgoValue" class="col-form-label ">Valor:</label>
      <input type="number" name="ENiveldeRiesgoValue" class="form-control" id="ENiveldeRiesgoValue" autocomplete="off" required>
          </div>          


        </form>
        <div id="resp4" class=" text-primary"></div>
      </div>
      <div class="modal-footer">
        <a href="./Escalas.php" class="btn btn-secondary" >Cerrar</button></a>
        <button type="button" id="btn-ingresar4" class="btn btn-info">Registrar</button>
      </div>
    </div>
  </div>
</div>
