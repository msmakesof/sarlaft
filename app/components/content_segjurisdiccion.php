
    <div class="container">
        <div class="table-wrapper">
            <?php include("components/color.php");?>
                <div class="row">
                    <div class="col-sm-6">
                        <h2>Administrar <b>Segmento Jusrisdicción</b></h2>
                    </div>
                    <div class="col-sm-6">
                        <a href="#addSegJurisdiccionModal" class="btn btn-primary" data-toggle="modal"><i class="material-icons">&#xE147;</i> <span>Agregar nuevo Segmento</span></a>
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
    <?php include("modal/modal_add_segjurisdiccion.php");?>
    <!-- Edit Modal HTML -->
    <?php include("modal/modal_edit_segjurisdiccion.php");?>
    <!-- Delete Modal HTML -->
    <?php include("modal/modal_delete_segjurisdiccion.php");?>
    <script src="js/segjurisdiccion.js"></script>