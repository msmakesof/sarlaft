    <div class="container">
        <div class="table-wrapper">
            <?php include("components/color.php");?>
                <div class="row">
                    <div class="col-sm-6">
                        <h2>Administrar <b>Controles</b></h2>
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
                            <a href="#addControlModal" class="btn btn-primary" data-toggle="modal">
                                <i class="material-icons">&#xE147;</i> <span>Agregar Control</span>
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
    <?php include("modal/modal_add_control.php");?>
    <!-- Edit Modal HTML -->
    <?php include("modal/modal_edit_control.php");?>
    <!-- Delete Modal HTML -->
    <?php include("modal/modal_delete_control.php");?>
    <script src="js/controls.js"></script>