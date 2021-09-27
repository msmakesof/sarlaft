
    <div class="container">
        <div class="table-wrapper">
            <?php include("components/color.php");?>
                <div class="row">
                    <div class="col-sm-6">
                        <h2>Administrar <b>Categorías</b></h2>                        
                    </div>
                    <div class="col-sm-6">
                        <div>
                        <?php if( $exportar == 1 ) { ?>
                            <a href="" id="xpdf" class="btn btn-success">
                                <i class="fa fa-file-pdf-o"></i>
                                <span>Exportar</span>
                            </a>
                        <?php } ?>
                        </div>
                        <div>
                        <?php if( $crear == 1 ) { ?>
                            <a href="#addDebilidadesModal" class="btn btn-primary" data-toggle="modal">
                                <i class="material-icons">&#xE147;</i>
                                <span>Agregar Categoría</span>
                            </a>
                        <?php } ?>
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
    <?php include("modal/categoria/modal_add.php");?>
    <!-- Edit Modal HTML -->
    <?php include("modal/categoria/modal_edit.php");?>
    <!-- Delete Modal HTML -->
    <?php include("modal/categoria/modal_delete.php");?>
    <script src="js/categoria/categoria.js"></script>