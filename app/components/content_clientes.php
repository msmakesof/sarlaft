
    <div class="container">
        <div class="table-wrapper">
            <?php include("components/color.php");?>
                <div class="row">
                    <div class="col-sm-6">
                        <h2>Administrar <b>Clientes</b></h2>
                    </div>
                    <div class="col-sm-6">
                        <div>
                            <a href="" id="xpdf" class="btn btn-success">
                                <i class="fa fa-file-pdf-o"></i>
                                <span>Exportar</span>
                            </a>
                        </div>
                        <div>
                            <a href="#addClienteModal" class="btn btn-primary" data-toggle="modal">
                                <i class="material-icons">&#xE147;</i> <span>Agregar nuevo cliente</span>
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            <div class='clearfix'></div>
            <hr>
            <div id="loader"></div><!-- Carga de datos ajax aqui -->
            <div id="resultados"></div><!-- Carga de datos ajax aqui -->
            <div class='outer_div'></div><!-- Carga de datos ajax aqui -->
            
            
        </div>
    </div>
    <!-- Edit Modal HTML -->
    <?php include("modal/modal_add_cliente.php");?>
    <!-- Edit Modal HTML -->
    <?php include("modal/modal_edit_cliente.php");?>
    <!-- Delete Modal HTML -->
    <?php include("modal/modal_delete_cliente.php");?>
    <script src="js/clientes.js"></script>