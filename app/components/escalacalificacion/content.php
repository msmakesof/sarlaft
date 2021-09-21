
    <div class="container">
        <div class="table-wrapper">
            <?php include("components/color.php");?>
                <div class="row">
                    <div class="col-sm-6">
                        <h2>Administrar <b>Escala de Calificación Control</b></h2>                        
                    </div>
                    <div class="col-sm-6">
                        <div>
                            <a href="" id="xpdf" class="btn btn-success">
                                <i class="fa fa-file-pdf-o"></i>
                                <span>Exportar</span>
                            </a>
                        </div>
                        <div>
                            <a href="#addEscalacalificacionModal" class="btn btn-primary" data-toggle="modal">
                                <i class="material-icons">&#xE147;</i>
                                <span>Agregar Escala Calificación</span>
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
    <?php include("modal/escalacalificacion/modal_add.php");?>
    <!-- Edit Modal HTML -->
    <?php include("modal/escalacalificacion/modal_edit.php");?>
    <!-- Delete Modal HTML -->
    <?php include("modal/escalacalificacion/modal_delete.php");?>
    <script src="js/escalacalificacion/calificacion.js"></script>