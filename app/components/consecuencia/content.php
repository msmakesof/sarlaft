
<style>
.let label {
    text-transform: lowercase !important;
}
.let label:first-letter {
    text-transform: uppercase !important;
}
</style>
    <div class="container">
        <div class="table-wrapper">
            <?php include("components/color.php");?>
                <div class="row">
                    <div class="col-sm-6">                       
                        <h2>Administrar <b><label id="edit_nametitulo" class="let"><?php echo $NombreTitulo; ?></label></b>
                        <a href="#" data-target="#editModiftituloModal" class="edit" data-toggle="modal" data-nametitulo="<?php echo $NombreTitulo; ?>" data-idtitulo="<?php echo $IdTitulo ; ?>">
                            <i class='fas fa-edit' style="cursor:pointer"  data-toggle="tooltip" title="Modificar Texto"></i>
                            <input type="hidden" id="edit_idtitulo" name="edit_idtitulo">
                        </a>                            
                    </h2>
                    </div>
                    <div class="col-sm-6">
                        <div>
                            <a href="" id="xpdf" class="btn btn-success">
                                <i class="fa fa-file-pdf-o"></i>
                                <span>Exportar</span>
                            </a>
                        </div>
                        <div>
                            <a href="#addConsecuenciaModal" class="btn btn-primary" data-toggle="modal">
                                <i class="material-icons">&#xE147;</i>
                                <span>Agregar <?php echo $NombreTitulo; ?></span>
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            <div class='clearfix'></div>

            <div id="loader"></div><!-- Carga de datos ajax aqui -->
            <div id="resultados"></div><!-- Carga de datos ajax aqui -->
            <div class='outer_div'></div><!-- Carga de datos ajax aqui -->
            
        </div>
    </div>
    <!-- Edit Modal HTML -->
    <?php include("modal/consecuenciar/modal_add.php");?>
    <!-- Edit Modal HTML -->
    <?php include("modal/consecuenciar/modal_edit.php");?>
    <!-- Edit Titulo Modal HTML -->
    <?php include("modal/consecuenciar/modal_edittitulo.php");?>
    <!-- Delete Modal HTML -->
    <?php include("modal/consecuenciar/modal_delete.php");?>
    <script src="js/consecuencia/consecuencia.js"></script>