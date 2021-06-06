
    <div class="container">
        <div class="table-wrapper">
            <?php include("components/color.php");?>
                <div class="row">
                    <div class="col-sm-6">
                        <h2>Administrador de <b>Riesgos</b> - Usuarios</h2>
                    </div>
                    <div class="col-sm-6">
                        <a href="#addUserModal" class="btn btn-primary" data-toggle="modal"><i class="material-icons">&#xE147;</i> <span>Agregar nuevo usuario</span></a>
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
    <?php include("modal/modal_add_user.php");?>
    <!-- Edit Modal HTML -->
    <?php include("modal/modal_edit_user.php");?>
    <!-- Delete Modal HTML -->
    <?php include("modal/modal_delete_user.php");?>
    <script src="js/users.js"></script>