    <style>
        .modal .modal-dialog {
		max-width: 80% !important;
	}
    </style> 
    <div class="container">
        <div class="table-wrapper">
            <?php include("components/color.php");?>
                <div class="row">
                    <div class="col-sm-6">
                        <h2>Administrar <b>Información Básica</b></h2>
                    </div>
                    <div class="col-sm-6">
                        <div>
                            <a href="" id="xpdf" class="btn btn-success">
                                <i class="fa fa-file-pdf-o"></i>
                                <span>Exportar</span>
                            </a>
                        </div>
                        <div>
                            <a href="#" class="btn btn-primary" data-toggle="modal"  data-target="#addInfobasicaModal">
                                <i class="material-icons">&#xE147;</i> <span>Agregar nueva Información</span>
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
    <?php include("modal/infobasica/modal_add.php");?>
    <!-- Edit Modal HTML -->
    <?php include("modal/infobasica/modal_edit.php");?>
    <!-- Delete Modal HTML -->
    <?php include("modal/infobasica/modal_delete.php");?>
    <script src="js/infobasica/infobasica.js"></script>