<div class="modal fade" id="exampleModal6" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel6">Escala de Categoria</h5>
        <button type="button" class="close text-dark" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
     <form method="post" id="formulario6" >
          <div class="form-group">
            <label for="ECategoriaName" class="col-form-label ">Nombre:</label>
            <input name="ECategoriaName" type="text" class="form-control" id="ECategoriaName" autocomplete="off" required>
          </div>

          <div class="form-group">
            <label for="ECategoriaValue" class="col-form-label ">Valor:</label>
      <input type="number" name="ECategoriaValue" class="form-control" id="ECategoriaValue" autocomplete="off" required>
          </div>          


        </form>
        <div id="resp6" class=" text-primary"></div>
      </div>
      <div class="modal-footer">
        <a href="./Escalas.php" class="btn btn-secondary" >Cerrar</button></a>
        <button type="button" id="btn-ingresar6" class="btn btn-info">Registrar</button>
      </div>
    </div>
  </div>
</div>
