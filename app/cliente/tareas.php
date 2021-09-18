<?php 
include '../ajax/is_logged.php';
require_once '../config/dbx.php';
$getConnectionCli2 = new Database();
$conn = $getConnectionCli2->getConnectionCli2($_SESSION['Keyp']);
$query_empresa=sqlsrv_query($conn,"SELECT CustomerName, CustomerLogo, CustomerColor FROM CustomerSarlaft WHERE CustomerKey=".$_SESSION['Keyp']."");
$reg=sqlsrv_fetch_array($query_empresa);
$CustomerKey = $_SESSION['Keyp'];
if (isset($_POST['id']) && $_POST['id'] != "" ){
    $IdPlan = $_POST['id'];
    //echo "<br>IdPlan...".$IdPlan;
}
else{
    header('Location: tables.php');
    die();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" type="image/png" href="../img/logo.ico"/>
    <title>As Riesgos || Sarlaft</title>

    <!-- Custom fonts for this template -->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">
    <!-- Custom styles for this template -->
    <link href="css/sb-admin-2.min.css" rel="stylesheet">
    <!-- Custom styles for this page -->
    <link href="vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/6.11.0/sweetalert2.css"/>
    <!-- Select2 -->
	<link rel="stylesheet" href="../plugins/select2/css/select2.min.css">
	<link rel="stylesheet" href="../plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css">
    <!-- expor pdf -->
    <script src="../plugins/pdf/jspdf.min.js"></script>
    <script src="../plugins/pdf/jspdf-autotable.js"></script>
    <!-- botones -->
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/1.6.2/css/buttons.dataTables.min.css">
</head>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
        <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar" style="background-color: <?php echo $reg['CustomerColor'];?> !important">

            <!-- Sidebar - Brand -->
            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.html">
                <!-- <div class="sidebar-brand-icon rotate-n-15">
                    <i class="fas fa-laugh-wink"></i>
                </div>
                <div class="sidebar-brand-text mx-3">SB Admin <sup>2</sup></div> -->
                <div ><img src="../../img/as riesgos.png" width="100%"></div>
            </a>

            <!-- Divider -->
            <hr class="sidebar-divider my-0">

            <!-- Nav Item - Dashboard -->
            <li class="nav-item">
                <a class="nav-link" href="index.html">
                    <i class="fas fa-fw fa-tachometer-alt"></i>
                    <span>Dashboard</span></a>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider">

            <?php include('menucli.php'); 
			//include('../components/menu_setting.php')
			?>
			

            <!-- Divider -->
            <hr class="sidebar-divider d-none d-md-block">

            <!-- Sidebar Toggler (Sidebar) -->
            <div class="text-center d-none d-md-inline">
                <button class="rounded-circle border-0" id="sidebarToggle"></button>
            </div>

        </ul>
        <!-- End of Sidebar -->

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <!-- Topbar -->
                <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

                    <!-- Sidebar Toggle (Topbar) -->
                    <form class="form-inline">
                        <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                            <i class="fa fa-bars"></i>
                        </button>
                    </form>

                    <!-- Topbar Search
                    <form
                        class="d-none d-sm-inline-block form-inline mr-auto ml-md-3 my-2 my-md-0 mw-100 navbar-search">
                        <div class="input-group">
                            <input type="text" class="form-control bg-light border-0 small" placeholder="Search for..."
                                aria-label="Search" aria-describedby="basic-addon2">
                            <div class="input-group-append">
                                <button class="btn btn-primary" type="button">
                                    <i class="fas fa-search fa-sm"></i>
                                </button>
                            </div>
                        </div>
                    </form> -->

                    <!-- Topbar Navbar -->
                    <ul class="navbar-nav ml-auto">

                        <!-- Nav Item - Search Dropdown (Visible Only XS) -->
                        <li class="nav-item dropdown no-arrow d-sm-none">
                            <a class="nav-link dropdown-toggle" href="#" id="searchDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fas fa-search fa-fw"></i>
                            </a>
                            <!-- Dropdown - Messages -->
                            <div class="dropdown-menu dropdown-menu-right p-3 shadow animated--grow-in"
                                aria-labelledby="searchDropdown">
                                <form class="form-inline mr-auto w-100 navbar-search">
                                    <div class="input-group">
                                        <input type="text" class="form-control bg-light border-0 small"
                                            placeholder="Search for..." aria-label="Search"
                                            aria-describedby="basic-addon2">
                                        <div class="input-group-append">
                                            <button class="btn btn-primary" type="button">
                                                <i class="fas fa-search fa-sm"></i>
                                            </button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </li>

                        <!-- Nav Item - Alerts -->
                        <li class="nav-item dropdown no-arrow mx-1">
                            <a class="nav-link dropdown-toggle" href="#" id="alertsDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fas fa-bell fa-fw"></i>
                                <!-- Counter - Alerts -->
                                <span class="badge badge-danger badge-counter">3+</span>
                            </a>
                            <!-- Dropdown - Alerts -->
                            <div class="dropdown-list dropdown-menu dropdown-menu-right shadow animated--grow-in"
                                aria-labelledby="alertsDropdown">
                                <h6 class="dropdown-header">
                                    Alerts Center
                                </h6>
                                <a class="dropdown-item d-flex align-items-center" href="#">
                                    <div class="mr-3">
                                        <div class="icon-circle bg-primary">
                                            <i class="fas fa-file-alt text-white"></i>
                                        </div>
                                    </div>
                                    <div>
                                        <div class="small text-gray-500">December 12, 2019</div>
                                        <span class="font-weight-bold">A new monthly report is ready to download!</span>
                                    </div>
                                </a>
                                <a class="dropdown-item d-flex align-items-center" href="#">
                                    <div class="mr-3">
                                        <div class="icon-circle bg-success">
                                            <i class="fas fa-donate text-white"></i>
                                        </div>
                                    </div>
                                    <div>
                                        <div class="small text-gray-500">December 7, 2019</div>
                                        $290.29 has been deposited into your account!
                                    </div>
                                </a>
                                <a class="dropdown-item d-flex align-items-center" href="#">
                                    <div class="mr-3">
                                        <div class="icon-circle bg-warning">
                                            <i class="fas fa-exclamation-triangle text-white"></i>
                                        </div>
                                    </div>
                                    <div>
                                        <div class="small text-gray-500">December 2, 2019</div>
                                        Spending Alert: We've noticed unusually high spending for your account.
                                    </div>
                                </a>
                                <a class="dropdown-item text-center small text-gray-500" href="#">Show All Alerts</a>
                            </div>
                        </li>

                        <!-- Nav Item - Messages -->
                        <li class="nav-item dropdown no-arrow mx-1">
                            <a class="nav-link dropdown-toggle" href="#" id="messagesDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fas fa-envelope fa-fw"></i>
                                <!-- Counter - Messages -->
                                <span class="badge badge-danger badge-counter">7</span>
                            </a>
                            <!-- Dropdown - Messages -->
                            <div class="dropdown-list dropdown-menu dropdown-menu-right shadow animated--grow-in"
                                aria-labelledby="messagesDropdown">
                                <h6 class="dropdown-header">
                                    Message Center
                                </h6>
                                <a class="dropdown-item d-flex align-items-center" href="#">
                                    <div class="dropdown-list-image mr-3">
                                        <img class="rounded-circle" src="img/undraw_profile_1.svg"
                                            alt="...">
                                        <div class="status-indicator bg-success"></div>
                                    </div>
                                    <div class="font-weight-bold">
                                        <div class="text-truncate">Hi there! I am wondering if you can help me with a
                                            problem I've been having.</div>
                                        <div class="small text-gray-500">Emily Fowler · 58m</div>
                                    </div>
                                </a>
                                <a class="dropdown-item d-flex align-items-center" href="#">
                                    <div class="dropdown-list-image mr-3">
                                        <img class="rounded-circle" src="img/undraw_profile_2.svg"
                                            alt="...">
                                        <div class="status-indicator"></div>
                                    </div>
                                    <div>
                                        <div class="text-truncate">I have the photos that you ordered last month, how
                                            would you like them sent to you?</div>
                                        <div class="small text-gray-500">Jae Chun · 1d</div>
                                    </div>
                                </a>
                                <a class="dropdown-item d-flex align-items-center" href="#">
                                    <div class="dropdown-list-image mr-3">
                                        <img class="rounded-circle" src="img/undraw_profile_3.svg"
                                            alt="...">
                                        <div class="status-indicator bg-warning"></div>
                                    </div>
                                    <div>
                                        <div class="text-truncate">Last month's report looks great, I am very happy with
                                            the progress so far, keep up the good work!</div>
                                        <div class="small text-gray-500">Morgan Alvarez · 2d</div>
                                    </div>
                                </a>
                                <a class="dropdown-item d-flex align-items-center" href="#">
                                    <div class="dropdown-list-image mr-3">
                                        <img class="rounded-circle" src="https://source.unsplash.com/Mv9hjnEUHR4/60x60"
                                            alt="...">
                                        <div class="status-indicator bg-success"></div>
                                    </div>
                                    <div>
                                        <div class="text-truncate">Am I a good boy? The reason I ask is because someone
                                            told me that people say this to all dogs, even if they aren't good...</div>
                                        <div class="small text-gray-500">Chicken the Dog · 2w</div>
                                    </div>
                                </a>
                                <a class="dropdown-item text-center small text-gray-500" href="#">Read More Messages</a>
                            </div>
                        </li>

                        <div class="topbar-divider d-none d-sm-block"></div>

                        <!-- Nav Item - User Information -->
                        <li class="nav-item dropdown no-arrow">
                            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <span class="mr-2 d-none d-lg-inline text-gray-600 small">William Díaz</span>
                                <img class="img-profile rounded-circle"
                                    src="img/undraw_profile.svg">
                            </a>
                            <!-- Dropdown - User Information -->
                            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in"
                                aria-labelledby="userDropdown">
                                <a class="dropdown-item" href="#">
                                    <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Profile
                                </a>
                                <a class="dropdown-item" href="#">
                                    <i class="fas fa-cogs fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Settings
                                </a>
                                <a class="dropdown-item" href="#">
                                    <i class="fas fa-list fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Activity Log
                                </a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">
                                    <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Logout
                                </a>
                            </div>
                        </li>

                    </ul>

                </nav>
                <!-- End of Topbar -->

                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- Page Heading -->
                    <h1 class="h3 mb-2 text-gray-800">Tareas por Planes</h1>
                    <p class="mb-4"></p>

                    <!-- DataTales Example -->
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <div style="float:left">
                                <h6 class="m-0 font-weight-bold text-primary">Empresa: <?php echo strtoupper($reg['CustomerName']); ?></h6>
								<h6 class="m-0 font-weight-bold text-primary">Plan: <?php echo strtoupper($_POST['np']); ?></h6>
                            </div>
                            <div style="float:right">
                                <a id="btn-AddDate" href="#" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
                                    <i class="fas fa-plus-circle"></i>
                                    <span>Crear Tarea</span>
                                </a>

                                <!-- a id="xpdf" href="#" class="btn btn-success">
                                    <i class="fa fa-file-pdf-o"></i>
                                    <span>Exportar</span>  -->

								<a id="btn-goDate" href="tables.php" class="btn btn-danger">
                                    <i class="fas fa-plus-circle"></i>
                                    <span>Volver a Planes</span>
                                </a>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <div id="tt"><?php //include 'tablatareas.php' ;?></div>
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
    <thead>
        <tr>
            <th class='text-center'>Tarea</th>
            <th class='text-left'>Acciones</th>
        </tr>
    </thead>
    <tfoot>
        <tr>
            <th class='text-center'>Tarea</th>
            <th class='text-left'>Acciones</th>
        </tr>
    </tfoot>
    <tbody>
    <?php
        //echo "<br>".$pid. ' --  '. $pck ;
        $pid = $IdPlan;
        $pck = $CustomerKey ;
        include '../curl/plan/listatareasplan.php';
        foreach($data as $key => $row) {}
        if( $key == "message"){	// No existen registros
            echo '<tr>
                    <td colspan="2">'. $data["message"] .'</td>
                </tr>';
        }
        else
        {							
            $j=1;
            for($i=0; $i<count($data['body']); $i++)
            {
                $TareaId=trim($data['body'][$i]['TPP_IdTareaxPlan']);
                $IdPlan=trim($data['body'][$i]['TPP_IdPlan']);
                $TareaName=trim($data['body'][$i]['TPP_NombreTarea']);
                $CustomerKey=trim($data['body'][$i]['TPP_CustomerKey']);
    ?>	
    <tr>
        <td class='text-left'><?php echo $TareaName;?></td>
        <td class='text-rigth'>
            <a href="#" data-target="#editModal" data-toggle="modal" data-name="<?php echo $TareaName; ?>"  data-idplan="<?php echo $IdPlan; ?>" data-ck="<?php echo $CustomerKey; ?>" data-id="<?php echo $TareaId; ?>">
                <i class="fas fa-pen" data-toggle="tooltip" title="Editar Tarea" style="color:orange"></i>
            </a>
            
            <a href="#" data-target="#deletePlanModal" class="delete" data-toggle="modal" data-id="<?php echo $TareaId;?>" data-idplan="<?php echo $IdPlan; ?>" data-ck="<?php echo $CustomerKey; ?>">
                <i class="fas fa-trash" data-toggle="tooltip" title="Eliminar Tarea" style="color:red"></i>
            </a>
        </td>
    </tr>
<?php }	
}
?>                                        
    </tbody>
</table>
                            </div>
                        </div>
                    </div>

                </div>
                <!-- /.container-fluid -->

                <!-- Button trigger modal
                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
                Launch demo modal
                </button>  -->

                <!-- Modal -->
                <div class="modal fade bd-example-modal-md" id="exampleModal" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-md" role="document">
                        <div class="modal-content">
                            <div class="modal-header">                            
                                <h5 class="modal-title" id="exampleModalLabel" style="color:blue;text-shadow: 0.1em 0.1em 0.2em black; font-size:24px">
                                    <i class="fas fa-address-card"></i>  Crear Tarea
                                </h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true" style="color:red">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <form id="f">
                                    <div class="form-group row">
                                        <div class="col-md-12">
                                            <label>Nombre Tarea</label>
                                            <textarea class="form-control" id="Name2" name="Name2" rows="7" placeholder="Digite descripción de la Tarea" required></textarea>
                                            <input type="hidden" name="CustomerKey" id="CustomerKey" value="<?php echo trim($_SESSION['Keyp']); ?>">
                                            <input type="hidden" name="IdPlan" id="IdPlan" value="<?php echo trim($IdPlan); ?>">
                                        </div>
                                    </div>
                                </form>    
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-primary" id="guardar">Guardar</button>
                                <button type="button" class="btn btn-danger" data-dismiss="modal" id="cerrar">Cerrar</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- End of Main Content -->

            <!-- Footer -->
            <footer class="sticky-footer bg-white">
                <div class="container my-auto">
                    <div class="copyright text-center my-auto">
                        Copyright &copy; Precision Tools sas 2021
                    </div>
                </div>
            </footer>
            <!-- End of Footer -->

        </div>
        <!-- End of Content Wrapper -->

    </div>
    <!-- End of Page Wrapper -->

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

    <!-- Logout Modal-->
    <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">Select "Logout" below if you are ready to end your current session.

                </div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                    <a class="btn btn-primary" href="login.html">Logout</a>
                </div>
            </div>
        </div>
    </div>

    <div id="emx"></div>

    <!-- Edit Modal -->
    <div class="modal fade bd-example-modal-md" id="editModal" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-md" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel" style="color:red;text-shadow: 0.1em 0.1em 0.2em black; font-size:24px">
                        <i class="far fa-edit"></i>   Editando Tarea
                    </h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true" style="color:red">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="ef">
                        <div class="form-group row">
                            <div class="col-md-12">
                                <label>Nombre Tarea</label>
                                <textarea class="form-control" id="eName2" name="eName2" rows="7" placeholder="Digite descripción de la Tarea" required></textarea>
                                <input type="hidden" name="eid" id="eid">
                                <input type="hidden" name="eCustomerKey" id="eCustomerKey">
                                <input type="hidden" name="eIdPlan" id="eIdPlan">
                            </div>
                        </div>
					</form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" id="eguardar">Guardar</button>
                    <button class="btn btn-danger" type="button" data-dismiss="modal" id="ecerrar">Salir</button>                  
                </div>
            </div>
        </div>
    </div>

    <!-- Delete Modal -->
    <div id="deletePlanModal" class="modal fade">
		<div class="modal-dialog">
			<div class="modal-content">
				<form name="delete_plan" id="delete_plan">
					<div class="modal-header">						
						<h4 class="modal-title">Eliminar Tarea</h4>
						<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
					</div>
					<div class="modal-body">					
						<p>¿Seguro que quieres eliminar este registro?</p>
						<p class="text-warning"><small>Esta acción no se puede deshacer.</small></p>
						<input type="hidden" name="delete_id" id="delete_id">
                        <input type="hidden" name="delCustomerKey" id="delCustomerKey">
                        <input type="hidden" name="delIdPlan" id="delIdPlan">
					</div>
					<div class="modal-footer">
						<input type="button" class="btn btn-default" data-dismiss="modal" value="Cerrar">
						<input type="button" class="btn btn-danger" id="borrar" value="Eliminar">
					</div>
				</form>
			</div>
		</div>
	</div>

    <!-- Bootstrap core JavaScript-->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- Core plugin JavaScript-->
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>
    <!-- Custom scripts for all pages-->
    <script src="js/sb-admin-2.min.js"></script>
    <!-- Page level plugins -->
    <script src="vendor/datatables/jquery.dataTables.min.js"></script>
    <script src="vendor/datatables/dataTables.bootstrap4.min.js"></script>
    <!-- Page level custom scripts -->
    <script src="js/demo/datatables-demo.js"></script>
    <!-- Select2 -->
	<script src="../plugins/select2/js/select2.full.min.js"></script>
    <!-- Alert -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/6.11.0/sweetalert2.js"></script>
    <!-- Buttons -->    
    <script src="https://cdn.datatables.net/buttons/1.6.2/js/dataTables.buttons.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.6.2/js/buttons.html5.min.js"></script>
    <script src="https://cdn.rawgit.com/bpampuch/pdfmake/0.1.53/build/pdfmake.min.js"></script>
    <script src="https://cdn.rawgit.com/bpampuch/pdfmake/0.1.53/build/vfs_fonts.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.6.2/js/buttons.flash.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.6.2/js/buttons.print.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>

    <script>
        function upd(){
                var idplan = <?php echo $IdPlan; ?>;
                var cky = "<?php echo $CustomerKey; ?>";
                parametros = "pid="+idplan+"&pck="+cky;
                $.ajax({
                    //async: false,
                    type: "POST",
                    url: "tablatareas.php",
                    data: parametros,
                    beforeSend: function(objeto){
                        /*swal({
							position: 'top-end',
							type: 'info',
							title: 'Actualizando información...Un momento',
							showConfirmButton: false,
							timer: 3000,
							imageUrl: '../img/ajax-loader.gif',
							imageAlt: 'Custom image',
						});*/
                    },
                    success: function(datos){
                        $("#tt").html(datos)
                    }
                });
                event.preventDefault();
            }

        $(document).ready(function(){
            $('.select2').select2()

            var table = $('#dataTable').DataTable();

            $('#exampleModal').on('show.bs.modal', function () {
                setTimeout(function (){
                    $('#Name2').focus()
                }, 500)
            })

            $('#editModal').on('show.bs.modal', function (event) {
                //get data-id attribute of the clicked element
                var button = $(event.relatedTarget)
                var name = button.data('name') 
			    $('#eName2').val(name)
         
                var ck = button.data('ck') 
			    $('#eCustomerKey').val(ck)

                var ip = button.data('idplan') 
			    $('#eIdPlan').val(ip)

                var id = button.data('id') 
			    $('#eid').val(id)
            });

            $("#save").on('click', function(event){
                //alert(45);
            });
			
            $("#guardar").on('click', function(event){
				let nombre = $("#Name2").val()
                if( nombre == "" ){
					swal({
						position: 'top-end',
						type: 'info',
						title: 'Debe ingresar informacion en la descripción de la Tarea.',
						showConfirmButton: true,
						timer: 5000,
						imageUrl: '../img/ajax-loader.gif',
						imageAlt: 'Custom image',
					});
				}
				else{
					var parametros = $('#f').serialize()
					$.ajax({
						type: "POST",
						url: "../ajax/tareas/guardar.php",
						data: parametros,
						beforeSend: function(objeto){
							swal({
								position: 'top-end',
								type: 'info',
								title: 'Verificando información...Un momento',
								showConfirmButton: false,
								timer: 5000,
								imageUrl: '../img/ajax-loader.gif',
								imageAlt: 'Custom image',
							});
						  },
						success: function(datos){
							let m= datos.trim();
							//$("#resultados").html(datos);
							$('#exampleModal').modal('hide');
							let msj = m.substr(0,1);
							let type;
							let txt;
							if(msj == 'O'){
								type = 'success';
								txt = 'Tarea ha sido guardada con éxito.';
							}
							else if(msj == 'E'){
								type= 'warning';
								txt = 'Ya existe un Registro grabado con el mismo Nombre.';
							}
							else if(msj == 'I'){
								type= 'warning';
								txt = 'Debe ingresar información en todos los campos.';
							}
							else if(msj == 'F'){
								type= 'error';
								txt = 'Lo sentimos, el registro falló. Por favor, regrese y vuelva a intentarlo.';
							}
							else if(msj == 'D'){
								type= 'error';
								txt ='Error Desconocido.';
							}
							else{
								type= 'error';
								txt = 'Lo sentimos, el registro falló. Por favor, regrese y vuelva a intentarlo.';
							}
							swal({
								position: 'top-end',
								type: ''+type,
								title: ''+txt,
								showConfirmButton: true,
								timer: 3000
							});
							setTimeout(function() {
								location.reload();
							}, 3000);
						}
					});
				}	
                event.preventDefault()				
            })

            $("#eguardar").on('click', function(event){
                var parametros = $('#ef').serialize()
                $.ajax({
					type: "POST",
					url: "../ajax/tareas/editar.php",
					data: parametros,
					beforeSend: function(objeto){
						swal({
							position: 'top-end',
							type: 'info',
							title: 'Verificando información...Un momento',
							showConfirmButton: false,
							timer: 5000,
							imageUrl: '../img/ajax-loader.gif',
							imageAlt: 'Custom image',
						});
					  },
					success: function(datos){
						let m= datos.trim();
						//$("#resultados").html(datos);
						$('#editModal').modal('hide');
						let msj = m.substr(0,1);
						let type;
						let txt;
						if(msj == 'U'){
							type = 'success';
							txt = 'Tarea ha sido actualizada con éxito.';
						}
						else if(msj == 'E'){
							type= 'warning';
							txt = 'Ya existe un Registro grabado con el mismo Nombre.';
						}
						else if(msj == 'I'){
							type= 'warning';
							txt = 'Debe ingresar información en todos los campos.';
						}
						else if(msj == 'F'){
							type= 'error';
							txt = 'Lo sentimos, el registro falló. Por favor, regrese y vuelva a intentarlo.';
						}
						else if(msj == 'D'){
							type= 'error';
							txt ='Error Desconocido.';
						}
						else{
							type= 'error';
							txt = 'Lo sentimos, el registro falló. Por favor, regrese y vuelva a intentarlo.';
						}
						swal({
							position: 'top-end',
							type: ''+type,
							title: ''+txt,
							showConfirmButton: true,
							timer: 3000
						});
                        setTimeout(function() {
							location.reload();
						}, 3000);
					}
			    });
                event.preventDefault()
            })

            $('#deletePlanModal').on('show.bs.modal', function (event) {
                var button = $(event.relatedTarget) // Button that triggered the modal
                var id = button.data('id') 
                $('#delete_id').val(id)

                var ck = button.data('ck') 
			    $('#delCustomerKey').val(ck)

                var ip = button.data('idplan') 
			    $('#delIdPlan').val(ip)
            })

            $( "#borrar" ).on('click', function( event ) {
                var parametros = $("#delete_plan").serialize();
                $.ajax({
                    type: "POST",
                    url: "../ajax/tareas/delete.php",
                    data: parametros,
                    beforeSend: function(objeto){
                        swal({
							position: 'top-end',
							type: 'info',
							title: 'Verificando información...Un momento',
							showConfirmButton: false,
							timer: 5000,
							imageUrl: '../img/ajax-loader.gif',
							imageAlt: 'Custom image',
						});
                    },
                    success: function(datos){
                        let m= datos.trim();
                        //$("#resultados").html(datos);
                        $('#deletePlanModal').modal('hide');
                        let msj = m.substr(0,1);
                        let type;
                        let txt;
                        if(msj == 'B'){
                            type = 'success';
                            txt = 'Tarea ha sido eliminada con éxito';
                        }
                        else if(msj == 'D'){
                            type= 'error';
                            txt ='Error Desconocido.';
                        }
                        else{
                            type= 'error';
                            txt = 'Lo sentimos, el registro falló. Por favor, regrese y vuelva a intentarlo.';
                        }
                        swal({
                            position: 'top-end',
                            type: ''+ type,
                            title: ''+ txt,
                            showConfirmButton: true,
                            timer: 3000
                        });
                        setTimeout(function() {
                            location.reload();
                        }, 3000);
                    }
                });
                event.preventDefault();
            });

            $("#cerrar").on('click', function(event){
                $('#exampleModal').modal('hide');
            })

            $("#ecerrar").on('click', function(){
                $('#editModal').modal('hide')
            })

            $(".close").on('click', function(){
                $('#exampleModal').modal('hide');
                $('#editModal').modal('hide')
            })

            $("#xpdf").on('click', function(event){
                let base64Img	
                base64Img = "img/edit.png"	
                    
                const { jsPDF } = window.jspdf            
                const doc = new jsPDF('p', 'pt', 'letter')
                var totalPagesExp = "{total_pages_count_string}"			
                
                doc.autoTable({ 
                    useCORS: true,
                    columns: [
                        { header: 'Nombre', dataKey: 'TPP_NombreTarea' },					
                    ],
                    
                    startY: doc.autoTable() + 70,
                    tableWidth: 'auto',
                    margin: {top: 80,
                    bottom: 60,
                    left: 40,
                    width: 522} ,
                    body: bodyRows(40),
                    beforePageContent: function(data) {
                        doc.text("Header", 170, 50);
                    },
                    styles: { overflow: "linebreak" },
                    bodyStyles: { valign: "top" },
                    theme: "striped",
                    showHead: "everyPage",
                    pageBreak: 'always',
                    didDrawPage: function (data) {					
                        // Header
                        doc.setFontSize(20);
                        doc.setTextColor(40);
                        doc.text("Reporte de Planes", data.settings.margin.left+190, 40);
                        
                        if (base64Img) {
                            doc.addImage(base64Img, 'PNG', data.settings.margin.left, 15, 140, 30);
                        }

                        // Footer
                        let nro = doc.internal.getNumberOfPages() -1
                        var str = "Página " + nro;
                        // Total page number plugin only available in jspdf v1.0+
                        if (typeof doc.putTotalPages === 'function') {
                            str = str + " de " + totalPagesExp;
                        }

                        doc.setFontSize(10);

                        // jsPDF 1.4+ uses getWidth, <1.4 uses .width
                        var pageSize = doc.internal.pageSize;
                        var pageHeight = pageSize.height
                        ? pageSize.height
                        : pageSize.getHeight();
                        doc.text(str, data.settings.margin.left, pageHeight - 10);
                        
                        doc.text("Usuario: ", data.settings.margin.left+400, pageHeight-10, 0);
                    },				
                    html: '#dataTable'
                })
                
                doc.deletePage(1) //Elimina primera hoja en blanco
                
                // Total page number plugin only available in jspdf v1.0+
                if (typeof doc.putTotalPages === 'function') {
                    doc.putTotalPages(totalPagesExp);
                }                
                doc.save('tareas.pdf')
            })
        })
    </script>
    <script>                
        var idioma= {
            "sProcessing":     "Procesando...",
            "sLengthMenu":     "Mostrar _MENU_ registros",
            "sZeroRecords":    "No se encontraron resultados",
            "sEmptyTable":     "Ningún dato disponible en esta tabla",
            "sInfo":           "Mostrando registros del _START_ al _END_.  Total de _TOTAL_ registros",
            "sInfoEmpty":      "Mostrando registros del 0 al 0 de un total de 0 registros",
            "sInfoFiltered":   "(filtrado de un total de _MAX_ registros)",
            "sInfoPostFix":    "",
            "sSearch":         "Buscar:",
            "sUrl":            "",
            "sInfoThousands":  ",",
            "sLoadingRecords": "Cargando...",
            "oPaginate": {
                "sFirst":    "Primero",
                "sLast":     "Ãšltimo",
                "sNext":     "Siguiente",
                "sPrevious": "Anterior"
            },
            "oAria": {
                "sSortAscending":  ": Activar para ordenar la columna de manera ascendente",
                "sSortDescending": ": Activar para ordenar la columna de manera descendente"
            },
            "buttons": {
                "copyTitle": 'Informacion copiada',
                "copyKeys": 'Use your keyboard or menu to select the copy command',
                "copySuccess": {
                    "_": '%d filas copiadas al portapapeles',
                    "1": '1 fila copiada al portapapeles'
                },

                "pageLength": {
                "_": "Mostrar %d filas",
                "-1": "Mostrar Todo"
                }
            }
        };

        $('#dataTable').DataTable({
            "dom": 'Bfrtip',
            "buttons": ['csv', 'excel', 'pdfHtml5', 'print'],
            "paging": true,
            "lengthChange": true,
            "searching": true,
            "ordering": true,
            "info": true,
            "autoWidth": true,
            "lengthMenu": [ [5, 10, 25, 50, -1], [5, 10,25, 50, "Mostrar Todo"] ],
            "language": idioma
        });    
    </script>
</body>
</html>