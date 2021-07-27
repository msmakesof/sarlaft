<div class="modal fade" id="exampleModal3" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel3">Escala de Riesgos</h5>
        <button type="button" class="close text-dark" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
     <form method="post" id="formulario3" >
          <div class="form-group">
            <label for="ERiesgosName" class="col-form-label ">Nombre:</label>
            <input name="ERiesgosName" type="text" class="form-control" id="ERiesgosName" autocomplete="off" required>
          </div>

          <div class="form-group">
            <label for="ERiesgosValue" class="col-form-label ">Valor:</label>
      <input type="number" name="ERiesgosValue" class="form-control" id="ERiesgosValue" autocomplete="off" required>
          </div>          


        </form>
        <div id="resp3" class=" text-primary"></div>
      </div>
      <div class="modal-footer">
        <a href="./Escalas.php" class="btn btn-secondary" >Cerrar</button></a>
        <button type="button" id="btn-ingresar3" class="btn btn-info">Registrar</button>
      </div>
    </div>
  </div>
</div>
