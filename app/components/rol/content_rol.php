    <div class="container">
        <div class="table-wrapper">
            <?php include("components/color.php");?>
                <div class="row">
                    <div class="col-sm-6">
                        <h2>Administrador de <b>Riesgos</b> - Rol</h2>
                    </div>
                    <div class="col-sm-6">
                        <div>
                            <a href="" id="xpdf" class="btn btn-success">
                                <i class="fa fa-file-pdf-o"></i>
                                <span>Exportar</span>
                            </a>
                        </div>
                        <div>
                            <a href="#addUserModal" class="btn btn-primary" data-toggle="modal">
                                <i class="material-icons">&#xE147;</i> 
                                <span>Agregar nuevo Rol</span>
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
    <!-- Add Modal HTML -->
    <?php include("./modal/rol/modal_add_rol.php");?>
    <!-- Edit Modal HTML -->
    <?php include("./modal/rol/modal_edit_rol.php");?>
    <!-- Delete Modal HTML -->
    <?php include("./modal/rol/modal_delete_rol.php");?>    
    <script src="js/rol/rol.js"></script>