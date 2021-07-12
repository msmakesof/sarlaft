    <div class="container">
        <div class="table-wrapper">
            <?php include("components/color.php");?>
                <div class="row">
                    <div class="col-sm-6">
                        <h2>Gestión de <b>Planes</b></h2>
                    </div>
                    <div class="col-sm-6">
                        <div>
                            <a href="" id="xpdf" class="btn btn-success">
                                <i class="fa fa-file-pdf-o"></i>
                                <span>Exportar</span>
                            </a>
                        </div>
                        <div>
                            <a href="#addPlanModal" class="btn btn-primary" data-toggle="modal"><i class="material-icons">&#xE147;</i> <span>Agregar nuevo plan</span></a>
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
    <?php include("modal/modal_add_plan.php");?>
    <!-- Edit Modal HTML -->
    <?php include("modal/modal_edit_plan.php");?>
    <?php include("modal/modal_newtarea_plan.php");?>
    <!-- Delete Modal HTML -->
    <?php include("modal/modal_delete_plan.php");?>
    <script src="js/planes/planes.js"></script>
	<!-- <script src="js/planes.js"></script>  -->
	