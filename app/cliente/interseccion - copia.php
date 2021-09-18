<?php include '../ajax/is_logged.php';

require_once ("../config/dbx.php");
$getConnectionCli2 = new Database();
$conn = $getConnectionCli2->getConnectionCli2($_SESSION['Keyp']);
$query_empresa=sqlsrv_query($conn,"SELECT CustomerName, CustomerLogo, CustomerColor FROM CustomerSarlaft WHERE CustomerKey=".$_SESSION['Keyp']."");
$reg=sqlsrv_fetch_array($query_empresa);
$CustomerKey = $_SESSION['Keyp'];
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

            <?php include('menucli.php'); ?>

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
                    <h1 class="h3 mb-2 text-gray-800">Intersección</h1>
                    <p class="mb-4"></p>

                    <!-- DataTales Example -->
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <div style="float:left">
                                <h6 class="m-0 font-weight-bold text-primary"><?php echo strtoupper($reg['CustomerName']); ?></h6>
                            </div>
                            <div style="float:right">
                                <!-- <div style="float:left; margin-right:10px">
                                    <a id="btn-AddDate" href="#" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">                                    
                                        <i class="fas fa-plus-circle"></i>
                                        <span>Crear Plan</span>
                                    </a>
                                </div> -->
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="xtable-responsive">
								<form id="formap">
								
									<div class="form-group row" style="text-align:center">
										<div class="col-md-4">
											Número de Filas:
											<select id="fils">
												<option value="">Seleccione opción</option>
												<option value="1">1</option>
												<option value="2">2</option>
												<option value="3">3</option>
												<option value="4">4</option>
												<option value="5">5</option>
											</select>
										</div>
										<div class="col-md-4">
											Número de Columnas:
											<select id="cols">
												<option value="">Seleccione opción</option>
												<option value="1">1</option>
												<option value="2">2</option>
												<option value="3">3</option>
												<option value="4">4</option>
												<option value="5">5</option>
											</select>
										</div>										
                                        <div class="col-md-4">
											<button type="button" class="btn btn-success btn-sm" id="creatabla">Crear Matriz</button>&nbsp;&nbsp;&nbsp;
											<button type="button" class="btn btn-primary btn-sm" id="pguardar">Guardar</button>
										</div>
									</div>
									
									<div class="form-group row">
										<div class="col-md-12">
												<div id="filcol" style="text-align:center"></div>
										</div>
									</div>
								</form>	
                            </div>
                        </div>
						<div class="col-md-12" style="text-align:center">
							<!-- <button class="btn btn-danger btn-sm" type="button" data-dismiss="modal" id="ecerrar">Salir</button> -->
							<a id="btn-goDate" href="listainter.php" class="btn btn-danger">
								<!-- <i class="fas fa-plus-circle"></i> -->
								<span>Volver a Intersección</span>
							</a>
						</div>
                        <div><p></p></div>
                    </div>

                </div>
                <!-- /.container-fluid -->

                <!-- Button trigger modal
                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
                Launch demo modal
                </button>  -->

                <!-- Modal 
                <div class="modal fade bd-example-modal-xl" id="exampleModal" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-xl" role="document">
                        <div class="modal-content">
                            <div class="modal-header">                            
                                <h5 class="modal-title" id="exampleModalLabel" style="color:blue;text-shadow: 0.1em 0.1em 0.2em black; font-size:24px">
                                    <i class="fas fa-address-card"></i>  Crear Plan
                                </h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true" style="color:red">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <form id="f">

                                    <div class="form-group row">
                                        <div class="col-md-12">
                                            <label>Nombre Plan</label>
                                            <textarea class="form-control" id="PlanName2" name="PlanName2" rows="2" placeholder="Digite nombre del Plan" required></textarea>
                                            <input type="hidden" name="CustomerKey" id="CustomerKey" value="<?php echo trim($_SESSION['Keyp']); ?>">
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <div class="col-md-5">
                                            <label for="exampleFormControlSelect1">Responsable</label>
                                            <select class="form-control select2" id="responsable" name="responsable" required>
                                                <option value="">Seleccione una opción</option>    									
                                                <?php include("../curl/responsables/listar.php"); ?>
                                            </select>
                                        </div> 
                                        <div class="col-md-2">
                                            <label>Plazo</label>
                                            <input type="number" name="plazo" id="plazo" class="form-control" required>
                                        </div>
                                    
                                        <div class="col-md-5">
                                            <label for="exampleFormControlSelect1">Aprueba</label>
                                            <select class="form-control select2" id="aprueba" name="aprueba" required>
                                                <option value="">Seleccione una opción</option>    									
                                                <?php include("../curl/cargos/listar.php"); ?>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <div class="col-md-2">
                                            <label for="exampleFormControlSelect1">Nivel de Prioridad</label>
                                            <select class="form-control select2" id="nivelprioridad" name="nivelprioridad" required>
                                                <option value="">Seleccione una opción</option>
                                                <option value="Alto">Alto</option>
                                                <option value="Medio">Medio</option>
                                                <option value="Bajo">Bajo</option>
                                            </select>
                                        </div>
                                        <div class="col-md-5">
                                            <label for="exampleFormControlSelect1">Responsable del Seguimiento</label>
                                            <select class="form-control select2" id="respseguimiento" name="respseguimiento" required>
                                                <option value="">Seleccione una opción</option>
                                                <?php include("../curl/responsables/listar.php"); ?>
                                            </select>
                                        </div>
                                        
                                        <div class="col-md-5">
                                            <label for="exampleFormControlSelect1">Responsable de la Aprobación</label>
                                            <select class="form-control select2" id="respaprobacion" name="respaprobacion" required>
                                                <option value="">Seleccione una opción</option>
                                                <?php include("../curl/responsables/listar.php"); ?>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <div class="col-md-3">
                                            <label>Fecha de Inicio</label>
                                            <input type="date" name="fechainicio" id="fechainicio" class="form-control" required>
                                        </div>
                                        <div class="col-md-3">
                                            <label>Fecha de Seguimiento</label>
                                            <input type="date" name="fechaseguimiento" id="fechaseguimiento" class="form-control" required>
                                        </div>
                                        <div class="col-md-3">
                                            <label>Fecha de Terminación</label>
                                            <input type="date" name="fechaterminacion" id="fechaterminacion" class="form-control" required>
                                        </div>
                                        <div class="col-md-3">
                                            <label>% Avance</label>
                                            <input type="number" name="avance" id="avance" class="form-control" required>
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
                </div>  -->


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

    <!-- Edit Modal
    <div class="modal fade bd-example-modal-xl" id="editModal" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel" style="color:red;text-shadow: 0.1em 0.1em 0.2em black; font-size:24px">
                        <i class="far fa-edit"></i>   Editando Plan
                    </h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true" style="color:red">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="ef">
                        <div class="form-group row">
                            <div class="col-md-12">
                                <label>Nombre Plan</label>
                                <textarea class="form-control" id="eName2" name="eName2" rows="2" placeholder="Digite nombre del Plan" required></textarea>
                                <input type="hidden" name="eid" id="eid" >
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-md-5">
                                <label for="exampleFormControlSelect1">Responsable</label>
                                <select class="form-control select2" id="eresponsable" name="eresponsable" required></select>
                            </div> 
                            <div class="col-md-2">
                                <label>Plazo</label>
                                <input type="number" name="eplazo" id="eplazo" class="form-control" required>
                            </div>
                        
                            <div class="col-md-5">
                                <label for="exampleFormControlSelect1">Aprueba</label>
                                <select class="form-control select2" id="eaprueba" name="eaprueba" required></select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-md-2">
                                <label for="exampleFormControlSelect1">Nivel de Prioridad</label>
                                <select class="form-control select2" id="enivelprioridad" name="enivelprioridad" required>
                                    <option value="">Seleccione una opción</option>
                                    <option value="Alto">Alto</option>
                                    <option value="Medio">Medio</option>
                                    <option value="Bajo">Bajo</option>
                                </select>
                            </div>
                            <div class="col-md-5">
                                <label for="exampleFormControlSelect1">Responsable del Seguimiento</label>
                                <select class="form-control select2" id="erespseguimiento" name="erespseguimiento" required></select>
                            </div>
                            
                            <div class="col-md-5">
                                <label for="exampleFormControlSelect1">Responsable de la Aprobación</label>
                                <select class="form-control select2" id="erespaprobacion" name="erespaprobacion" required></select>
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col-md-3">
                                <label>Fecha de Inicio</label>
                                <input type="date" name="efechainicio" id="efechainicio" class="form-control" required>
                            </div>
                            <div class="col-md-3">
                                <label>Fecha de Seguimiento</label>
                                <input type="date" name="efechaseguimiento" id="efechaseguimiento" class="form-control" required>
                            </div>
                            <div class="col-md-3">
                                <label>Fecha de Terminación</label>
                                <input type="date" name="efechaterminacion" id="efechaterminacion" class="form-control" required>
                            </div>
                            <div class="col-md-3">
                                <label>% Avance</label>
                                <input type="number" name="eavance" id="eavance" class="form-control" required>
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
    </div>    -->

    <!-- Delete Modal -->
    <div id="deletePlanModal" class="modal fade">
		<div class="modal-dialog">
			<div class="modal-content">
				<form name="delete_plan" id="delete_plan">
					<div class="modal-header">						
						<h4 class="modal-title">Eliminar Plan</h4>
						<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
					</div>
					<div class="modal-body">					
						<p>¿Seguro que quieres eliminar este registro?</p>
						<p class="text-warning"><small>Esta acción no se puede deshacer.</small></p>
						<input type="hidden" name="delete_id" id="delete_id">
					</div>
					<div class="modal-footer">
						<input type="button" class="btn btn-default" data-dismiss="modal" value="Cerrar">
						<input type="button" class="btn btn-danger" id="borrar" value="Eliminar">
					</div>
				</form>
			</div>
		</div>
	</div>
	
	<?php include('erModal.php');?>

    <!-- Bootstrap core JavaScript-->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
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
    <!-- Redirect -->
	<script src="../plugins/redirect/jquery.redirect.js"></script>
    <!-- expor pdf -->
    <script src="../plugins/pdf/jspdf.min.js"></script>
    <script src="../plugins/pdf/jspdf-autotable.js"></script>
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
        function mks(p1,p2){
            $.redirect("tareas.php", {id: p1, np : p2 });
		}        
        
        $(document).ready(function(){
            $('.select2').select2()
            $('#exampleModal').on('show.bs.modal', function () {
                setTimeout(function (){
                    $('#PlanName2').focus()
                }, 500)
            })			
			
			$("#creatabla").on('click', function(){
				//alert(9);				
				let fil = $("#fils").val()
				let col = $("#cols").val()
				if(fil == "" || col == "")
				{
					swal({
						position: 'top-end',
						type: 'warning',
						title: 'Atención: Debe seleccionar cantidad de Filas y/o Columnas',
						showConfirmButton: true,
						timer: 5000
					});
				}
				else {
					$.post("tablaint.php", {f: fil, c: col }, function(result){
						$("#filcol").html(result)
					})
				}
			})
			
			$("#tr").on('change', function(){
				var sel_tr = $(this).val();
				alert($(this).val());
				if(sel_tr == ""){
					
				}
				else{					
				}
			})
			
			$("#prob").on('change', function(){				
				var txt = $(this).find('option:selected').text();
				$("#lblprob").html(txt);
			})

			$("#consec").on('change', function(){				
				var txt = $(this).find('option:selected').text();
				$("#lblconsec").html(txt);
			})

			$("#prob2").on('change', function(){				
				var txt = $(this).find('option:selected').text();
				$("#lblprob2").html(txt);
			})

			$("#consec2").on('change', function(){				
				var txt = $(this).find('option:selected').text();
				$("#lblconsec2").html(txt);
			})			

			// Lista Causas
			let itemcausa = 0
			$("#addcau").on('click', function(){
				let slct = '';
				$.get("../api/causas/lista_eve.php", {ck: <?php echo $CustomerKey; ?> }, function(result){
					let opc = "<option value=''>Seleccione opción</option>";
					$.each(result.body, function(i, item) {
						opc +="<option value='"+ item.id +"'>"+ item.CausasName +"</option>";
					});
                    slct = '<select class="form-control causa" id="causa" name="causa">';					
                    slct += opc;
                    slct += '</select>';
					itemcausa = itemcausa + 1;
					$("#tabcau").append('<tbody>');
					$("#tabcau").append('<tr id="CAU'+itemcausa+'"><td style="width:10%"></td><td style="width:80%">'+ slct +'</td><td style="width:10%"><div class="delete"><i class="fas fa-trash" style="color:red; cursor:pointer"></i></div></td></tr>');
					$("#tabcau").append('</tbody>');
					$('.delete').off().click(function(e) {
						$(this).parent('td').parent('tr').remove();
					});
                })
			})
			$('#addCausaModal').on('show.bs.modal', function (event) {
				setTimeout(function (){
					$('#CausasName2').focus()
				}, 1000)
			})
			
			$( "#add_causa" ).submit(function( event ) {
				var parametros = $(this).serialize();
					$.ajax({
						type: "POST",
						url: "../ajax/guardar_causa.php",
						data: parametros,
						 beforeSend: function(objeto){
							$("#resultados").html("Enviando...");
						},
						success: function(datos){
							$('#addCausaModal').modal('hide');
							//setTimeout(function (){
							//	load(1);location.reload();
							//}, 3000)
						}
					});
				event.preventDefault()
			});
			///////////////////////////   ///////////////////////////
			
			// Lista Riesgo Asociado
			let itemria = 0			
			$("#addiria").on('click', function(){
				let slct = '';
				$.get("../api/riesgoasociado/lista_eve.php", {ck: <?php echo $CustomerKey; ?> }, function(result){
					let opc = "<option value=''>Seleccione opción</option>";
					$.each(result.body, function(i, item) {
						opc +="<option value='"+ item.RIA_IdRiesgoAsociado +"'>"+ item.RIA_Nombre +"</option>";
					});
                    slct = '<select class="form-control ria" id="ra" name="ra">';					
                    slct += opc;
                    slct += '</select>';
					itemria = itemria + 1
					$("#tabria").append('<tr id="RIA'+itemria+'"><td style="width:10%"></td><td style="width:80%">'+ slct +'</td><td style="width:10%"><div class="delete"><i class="fas fa-trash" style="color:red; cursor:pointer"></i></div></td></tr>');
					$('.delete').off().click(function(e) {
						$(this).parent('td').parent('tr').remove();
					});
                })
			})
			
			$('#addRIAModal').on('show.bs.modal', function (event) {
				$('#Name2').val(' ')
				setTimeout(function (){
					$('#Name2').focus()
				}, 1000)
			})
			
			$( "#add_ria" ).submit(function( event ) {				
		  	var parametros = $(this).serialize();
			$.ajax({
				type: "POST",
				url: "../ajax/riesgoasociado/guardar.php",
				data: parametros,
				beforeSend: function(objeto){
					//$("#resultados").html("Enviando...");
				},
				success: function(datos){
					let m= datos.trim();
					//$("#resultados").html(datos);
					$('#addRIAModal').modal('hide');
					let msj = m.substr(0,1);
					let type;
					let txt;
					if(msj == 'O'){
						type = 'success';
						txt = 'Riesgo Asociado ha sido guardado con éxito.';
					}
					else if(msj == 'E'){
						type= 'warning';
						txt = 'En Riesgo Asociado Ya existe un Registro grabado con el mismo Nombre.';
					}
					else if(msj == 'I'){
						type= 'warning';
						txt = 'Ya existe un Registro grabado con el mismo Nit.';
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
						timer: 2000
					});
					//setTimeout(function (){
					//	load(1);location.reload();	
					//}, 3000)
				}
			});
		  event.preventDefault()
		});
			///////////////////////////   ///////////////////////////

            $('#editModal').on('show.bs.modal', function (event) {
                //get data-id attribute of the clicked element
                var button = $(event.relatedTarget)
                var name = button.data('name') 
			    $('#eName2').val(name)
                responsable = button.data('responsable')
                $('#eresponsable').val(responsable)
                let parametros = "idresponsable="+responsable+"&ck=<?php echo $CustomerKey; ?>";
                $.ajax({
                    async: false,
                    type: "POST",
                    url: "../ajax/planes/editarestado.php",
                    data: parametros,
                    success: function(datos){
                        let slct = '<select class="form-control" name="eresponsable" id="eresponsable" style="width: 100%;" required>';
                            slct += datos;
                            slct += '</select>';
                        $("#eresponsable").html(slct)
                    }	
                })
                var plazo = button.data('plazo') 
			    $('#eplazo').val(plazo)

                aprueba = button.data('aprueba')
                $('#eaprueba').val(aprueba)
                let pars = "idcargos="+aprueba+"&ck=<?php echo $CustomerKey; ?>";
                $.ajax({
                    async: false,
                    type: "POST",
                    url: "../ajax/cargos/editarestado.php",
                    data: pars,
                    success: function(datos){
                        let slct = '<select class="form-control" name="eaprueba" id="eaprueba" style="width: 100%;" required>';
                            slct += datos;
                            slct += '</select>';
                        $("#eaprueba").html(slct)
                    }	
                })

                nivelprioridad = button.data('nivelp')
                $('#enivelprioridad').val(nivelprioridad)
                let npa = ""; let npm = ""; let npb = "";
                if(nivelprioridad =="Alto"){ npa= " selected='selected'"}
                else if(nivelprioridad =="Medio"){ npm= " selected='selected'"} 
                else if(nivelprioridad =="Bajo"){ npb= " selected='selected'"}
                let slct = '<select class="form-control" name="enivelprioridad" id="enivelprioridad" style="width: 100%;" required>';
                    slct += '<option value="">Seleccione una opción</option>'
                    slct += '<option value="Alto"'+ npa +'>Alto</option>'
                    slct += '<option value="Medio"'+ npm +'>Medio</option>'
                    slct += '<option value="Bajo"'+ npb +'>Bajo</option>'
                    slct += '</select>';
                $("#enivelprioridad").html(slct)

                respseguimiento = button.data('resps')
                $('#erespseguimiento').val(respseguimiento)
                $.post("../ajax/responsables/respseguir.php", {idrespseguir: respseguimiento, ck: <?php echo $CustomerKey; ?> }, function(result){                   
                    let slct = '<select class="form-control" name="erespseguimiento" id="erespseguimiento" style="width: 100%;" required>';
                        slct += result;
                        slct += '</select>';
                    $("#erespseguimiento").html(slct)
                });

                respaprobacion = button.data('respa')
                $('#erespaprobacion').val(respaprobacion)
                let paramet = "idrespseguir="+respaprobacion+"&ck=<?php echo $CustomerKey; ?>";
                $.ajax({
                    async: false,
                    type: "POST",
                    url: "../ajax/responsables/respseguir.php",
                    data: paramet,
                    success: function(datos){
                        let slct = '<select class="form-control" name="erespaprobacion" id="erespaprobacion" style="width: 100%;" required>';
                            slct += datos;
                            slct += '</select>';
                        $("#erespaprobacion").html(slct)
                    }	
                })
                
                var finicio = button.data('inicio') 
			    $('#efechainicio').val(finicio)

                var fseguimiento = button.data('fseg') 
			    $('#efechaseguimiento').val(fseguimiento)

                var fterminacion = button.data('termina') 
			    $('#efechaterminacion').val(fterminacion)

                var avance = button.data('avance') 
			    $('#eavance').val(avance)
            
                var id = button.data('id') 
			    $('#eid').val(id)
            })

            $("#guardar").on('click', function(event){
                //alert(7);
                var $inputs = $('#f').find(':input[type="text"]') //INPUTS
                var $selects = $('#f').find('select') //SELECTS

                $inputs.each(function(index, element) {
                    if ($(element).val().length <= 0) {
                        $(element).css("border", "solid 2px #FA5858");
                    }
                })

                $selects.each(function(index, element) {
                    if ( $(element).val() ==0) {
                        $(element).css("border", "solid 2px #FA5858");
                    }
                })
                var parametros = $('#f').serialize()
                $.ajax({
					type: "POST",
					url: "../ajax/planes/guardar.php",
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
						$("#resultados").html(datos);
						$('#exampleModal').modal('hide');
						let msj = m.substr(0,1);
						let type;
						let txt;
						if(msj == 'O'){
							type = 'success';
							txt = 'Plan ha sido guardado con éxito.';
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
							timer: 5000
						});
						setTimeout(function() {
							location.reload();
						}, 3000);
					}
			    });
                event.preventDefault()
            })			
			
			$("#pguardar").on('click', function(event){
				var fils = $("#fils").val();
				var cols = $("#cols").val();
				if(fils == "" || cols == "")
				{
					swal({
						position: 'top-end',
						type: 'warning',
						title: 'Atención: Debe seleccionar cantidad de Filas y/o Columnas',
						showConfirmButton: true,
						timer: 5000
					});
				}
				else {
					var posicion = ""
					var color = ""
					var mss = []
					var cant = []
					tmp = { 'fil': fils, 'col': cols }
					cant.push(tmp)
					sof0 = {'cantidad' : cant }
					mss.push(sof0)
					//mss.push(tmp)
					
					var pos = []
					$(".celda").each(function() {
						posicion += $(this).attr('id');
						color += $(this).attr('style');
						//celdas += $(this).css("background");
						tmp = { 'pos': posicion, 'color': color }
						pos.push(tmp)
						posicion = ""
						color = ""
					})
					sof1 = {'posicion' : pos }
					mss.push(sof1)
					
					console.log(mss);
					//console.log(posicion);
					var controlcolor = "N"
					$.each(pos, function(key, item) 
					{
					   console.log(item.color);
					   if( item.color == 'undefined' || item.color == '' ){
						   controlcolor = "S"
					   }
					});
					if( controlcolor == "S"){
						swal({
							position: 'top-end',
							type: 'warning',
							title: 'Atención: No pueden haber celdas sin Color.',
							showConfirmButton: true,
							timer: 5000
						});
					}
					else {
						//alert('OK');
						var type="warning"
						var title="Matriz no ha sido grabada.  Intentelo nuevamente."
						$.ajax({
							//dataType:'json',
							type: "POST",
							url: "../ajax/planes/guardarinterseccion.php",
							//data:{'datos': JSON.stringify(mss)},
							data:{ 'datos':  mss },
							beforeSend: function(objeto){
							},
							success: function(datos){
								//alert(datos);
								let m = datos.trim();
								let msj = m.substr(0,1);
								//console.log(datos)
								if( msj == "S"){
									type="success";
									title="Matriz ha sido grabada correctamente.";
								}							
								swal({
									position: 'top-end',
									type: ''+type,
									title: ''+title,
									showConfirmButton: true,
									timer: 5000
								})
                                setTimeout(function() {
                                    $.redirect( "listainter.php" );
                                }, 3000);                                
							}
						})
					}
				}
			})
			
			$("#xpguardar").on('click', function(event){
                //alert(7);				
				var filas = [];
				$('#tabcau tbody tr').each(function() {
					var selopc = $(this).find('td').eq(0).text();
					var fila = { selopc	};
					filas.push(fila);
				})
				//console.log(filas);				
				//alert(filas);			
				
				var mks = [];
				var eri =[];
				tmp = {	'id' : $("#eventoriesgo").val() }
				eri.push(tmp)
				sof0 = {'ERI' : eri }
				mks.push(sof0)
				
				var pro =[];
				tmp = {	'id' : $("#proceso").val() }
				pro.push(tmp)
				sof1 = {'PRO' : pro }
				mks.push(sof1)
				
				var car =[];
				tmp = {	'id' : $("#cargo").val() }
				car.push(tmp)
				sof3 = {'CAR' : car }
				mks.push(sof3)
				
				var res =[];
				tmp = {	'id' : $("#responsable").val() }
				res.push(tmp)
				sof4 = {'RES' : res }
				mks.push(sof4)
				
				
				var Efilas = [];
				var cau = [];				
				let selCuasa = $('.causa');  
				selCuasa.each(function () {
					let select = $(this);
					var fila = { select	};
					Efilas.push(fila);
					////console.log(select.val());
					tmp ={ 'id' : select.val() }
					cau.push(tmp)
				});
				////console.log(Efilas);
				sof = {	'CAU': cau }
				mks.push(sof)
				////console.log(cau);
				//console.log(mks);				
				
				var ria = [];
				let selRia = $('.ria');  
				selRia.each(function () {
					let select = $(this);
					var fila = { select	};
					Efilas.push(fila);
					//console.log(select.val());
					tmp ={ 'id' : select.val() }
					ria.push(tmp)
				});
				sof2 = { 'RIA': ria	}
				mks.push(sof2)
				////console.log(obj);
				console.log(mks);
			})	

            $("#eguardar").on('click', function(event){
                //alert(7);
                var parametros = $('#ef').serialize()
                $.ajax({
					type: "POST",
					url: "../ajax/planes/editar.php",
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
						$("#resultados").html(datos);
						$('#editModal').modal('hide');
						let msj = m.substr(0,1);
						let type;
						let txt;
						if(msj == 'U'){
							type = 'success';
							txt = 'Plan ha sido actualizado con éxito.';
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
							timer: 5000
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
            })

            $( "#borrar" ).on('click', function( event ) {
                var parametros = $("#delete_plan").serialize();
                $.ajax({
                    type: "POST",
                    url: "../ajax/planes/delete.php",
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
                            txt = 'Plan ha sido eliminado con éxito';
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
                            timer: 5000
                        });
                        setTimeout(function() {
                            location.reload();
                        }, 13000);
                    }
                });
                event.preventDefault();
            });

            $("#cerrar").on('click', function(){
                location.reload();
            })

            $("#ecerrar").on('click', function(){
                location.reload();
            })

            $(".close").on('click', function(){
                location.reload();
            })
        })
    </script>
</body>
</html>