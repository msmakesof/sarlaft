<?php include '../ajax/is_logged.php';?>
<?php require_once '../components/sql_server.php';
$query_empresa=sqlsrv_query($con,"SELECT CustomerName, CustomerLogo, CustomerColor FROM CustomerSarlaft WHERE CustomerKey=".$_SESSION['Keyp']."");
$reg=sqlsrv_fetch_array($query_empresa);
echo "sesion...".$_SESSION['Keyp']."<br>";
//echo "color". $reg['CustomerColor'];
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

    <!-- Select2 -->
	<link rel="stylesheet" href="../plugins/select2/css/select2.min.css">
	<link rel="stylesheet" href="../plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css">

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
                    <h1 class="h3 mb-2 text-gray-800">Planes</h1>
                    <p class="mb-4"></p>

                    <!-- DataTales Example -->
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <div style="float:left">
                                <h6 class="m-0 font-weight-bold text-primary"><?php echo strtoupper($reg['CustomerName']); ?></h6>
                            </div>
                            <div style="float:right">
                                <a id="btn-AddDate" href="#" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">                                    
                                    <i class="fas fa-plus-circle"></i>
                                    <span>Agregar nuevo Plan</span>
                                </a>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                        <th class='text-center'>Nombre Plan</th>
                                            <th class='text-center'>Nombre Responsable</th>
                                            <th class='text-left'>Plazo </th>
                                            <th class='text-left'>Cargos </th>
                                            <th class='text-center'>Nivel Prioridad</th>
                                            <th class='text-center'>Responsable Seguimiento</th>
                                            <th class='text-center'>Responsable Aprobación</th>
                                            <th class='text-center'>Fecha Inicio</th>
                                            <th class='text-center'>Fecha Seguimiento</th>
                                            <th class='text-center'>Fech Terminacion</th>
                                            <th class='text-center'>Avance</th>
                                            <th class='text-left'>Acciones</th>
                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <tr>
                                            <th class='text-center'>Nombre Plan</th>
                                            <th class='text-center'>Nombre Responsable</th>
                                            <th class='text-left'>Plazo </th>
                                            <th class='text-left'>Cargos </th>
                                            <th class='text-center'>Nivel Prioridad</th>
                                            <th class='text-center'>Responsable Seguimiento</th>
                                            <th class='text-center'>Responsable Aprobación</th>
                                            <th class='text-center'>Fecha Inicio</th>
                                            <th class='text-center'>Fecha Seguimiento</th>
                                            <th class='text-center'>Fech Terminacion</th>
                                            <th class='text-center'>Avance</th>
                                            <th class='text-left'>Acciones</th>
                                        </tr>
                                    </tfoot>
                                    <tbody>
                                    <?php
						include '../curl/plan/listarall.php';
						foreach($data as $key => $row) {}
						if( $key == "message"){	// No existen registros
							echo '<tr>
									<td colspan="15">'. $data["message"] .'</td>
								</tr>';
						}
						else
						{							
							$j=1;
							for($i=0; $i<count($data['body']); $i++)
							{
								$PlanesId=trim($data['body'][$i]['id']);
								$PlanesKey=trim($data['body'][$i]['PlanesKey']);
								$PlanesName=trim($data['body'][$i]['PlanesName']);
								$PlanesResponsable=trim($data['body'][$i]['PlanesResponsable']);
								$PlanesTarea=trim($data['body'][$i]['PlanesTarea']);
								$PlanesPlazo=trim($data['body'][$i]['PlanesPlazo']);
								$PlanesAprueba=trim($data['body'][$i]['PlanesAprueba']);
								$PlanesNivelPrioridad=trim($data['body'][$i]['PlanesNivelPrioridad']);	
								$PlanesRespSeguimiento=trim($data['body'][$i]['PlanesRespSeguimiento']);
								$PlanesRespAprobacion=trim($data['body'][$i]['PlanesRespAprobacion']);
								$PlanesFInicio=trim($data['body'][$i]['PlanesFInicio']);
								$PlanesFSeguimiento=trim($data['body'][$i]['PlanesFSeguimiento']);
								$PlanesFTerminacion=trim($data['body'][$i]['PlanesFTerminacion']);
								$PlanesAvance=trim($data['body'][$i]['PlanesAvance']);
								$PlanesStatus=trim($data['body'][$i]['PlanesStatus']);
								$NombreResponsable=trim($data['body'][$i]['NombreResponsable']);
								$CargosName=trim($data['body'][$i]['CargosName']);
								$NombreResponsableSeg=trim($data['body'][$i]['NombreResponsableSeg']);
								$NombreResponsableApr=trim($data['body'][$i]['NombreResponsableApr']);
								$CustomerKey=trim($data['body'][$i]['CustomerKey']);
						?>	
						<tr>
							<td class='text-left'><?php echo $PlanesName;?></td>							
							<td class='text-left' ><?php echo $NombreResponsable ;?></td>							
							<td class='text-center'><?php echo $PlanesPlazo;?></td>							
							<td class='text-left'><?php echo $CargosName ;?></td>							
							<td class='text-left'><?php echo $PlanesNivelPrioridad;?></td>							
							<td class='text-left'><?php echo $NombreResponsableSeg ;?></td>							
							<td class='text-left'><?php echo $NombreResponsableApr ;?></td>
							<td class='text-left'><?php echo $PlanesFInicio;?></td>
							<td class='text-left'><?php echo $PlanesFSeguimiento;?></td>
							<td class='text-left'><?php echo $PlanesFTerminacion;?></td>
							<td class='text-center'><?php echo $PlanesAvance;?></td>
							<td class='text-rigth'>
								<a href="#" data-target="#editPlanModal" class="edit" data-toggle="modal" data-name="<?php echo $PlanesName?>" data-responsable="<?php echo $PlanesResponsable?>" 
                                data-tarea="<?php echo $PlanesTarea?>" data-plazo="<?php echo $PlanesPlazo?>" data-aprueba="<?php echo $PlanesAprueba?>" 
                                data-nivelp="<?php echo $PlanesNivelPrioridad?>" data-resps="<?php echo $PlanesRespSeguimiento?>" data-respa="<?php echo $PlanesRespAprobacion?>" 
                                data-inicio="<?php echo $PlanesFInicio?>" data-fseg="<?php echo $PlanesFSeguimiento?>" data-termina="<?php echo $PlanesFTerminacion?>" 
                                data-avance="<?php echo $PlanesAvance?>" data-id="<?php echo $PlanesId; ?>">
                                    <i class="fas fa-pen" data-toggle="tooltip" title="Editar Plan" style="color:orange"></i>
                                </a>
								
								<a href="#deletePlanModal" class="delete" data-toggle="modal" data-id="<?php echo $PlanesId;?>">
                                    <i class="fas fa-trash" data-toggle="tooltip" title="Eliminar Plan" style="color:red"></i>
                                </a>
								<!-- newTareaPlanModal
								<a href="#" id="tareasplan" onclick="mks(<?php echo $PlanesId; ?>, <?php echo $CustomerKey; ?>)" data-target="#xnewTareaPlanModal" class="edit" data-toggle="modal" data-name="<?php echo $PlanesName?>" data-key="<?php echo $PlanesKey?>" data-responsable="<?php echo $PlanesResponsable?>" data-tarea="<?php echo $PlanesTarea?>" data-plazo="<?php echo $PlanesPlazo?>" data-aprueba="<?php echo $PlanesAprueba?>" data-nivelp="<?php echo $PlanesNivelPrioridad?>" data-resps="<?php echo $PlanesRespSeguimiento?>" data-respa="<?php echo $PlanesRespAprobacion?>" data-inicio="<?php echo $PlanesFInicio?>" data-fseg="<?php echo $PlanesFSeguimiento?>" data-termina="<?php echo $PlanesFTerminacion?>" data-avance="<?php echo $PlanesAvance?>" data-id="<?php echo $PlanesId; ?>"><i class="material-icons" data-toggle="tooltip" title="Crear Tarea" style="color:green">assignment</i></a>  -->
								
								<!-- <a href="#" id="tareasplan" onclick="mks(<?php echo $PlanesId; ?>, <?php echo $CustomerKey; ?>)">
									<i class="material-icons" data-toggle="tooltip" title="Crear Tarea" style="color:green">assignment</i>
								</a> -->
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
<div class="modal fade bd-example-modal-xl" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Crear Plan</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="f">                        

                    <div class="form-group row">
                        <div class="col-md-12">
                            <label>Nombre Plan</label>
                            <textarea class="form-control" id="Name2" name="Name2" rows="2" placeholder="Digite nombre del Plan" required></textarea>
                            <input type="hidden" name="CustomerKey" id="CustomerKey" value="<?php echo trim($_SESSION['Keyp']); ?>">
                        </div>                          
                    </div>

                    <div class="form-group row">
                        <div class="col-md-5">
                            <label for="exampleFormControlSelect1">Responsable</label>
                            <select class="form-control select2" id="responsable" name="responsable" required>
                                <option value="">Seleccione una opción</option>    									
                                <?php
                                    $query = sqlsrv_query($conn,"SELECT ResponsablesId,ResponsablesName FROM ResponsablesSarlaft WHERE CustomerKey='".$_SESSION['Keyp']."'");
                                    while($row = sqlsrv_fetch_array($query)){	
                                ?>   									
                                    <option value="<?php echo $row['ResponsablesId'];?>"><?php echo $row['ResponsablesName'];?></option>
                                <?php
                                    }
                                ?>
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
                                <?php
                                    $query = sqlsrv_query($conn,"SELECT CargosId,CargosName FROM CargosSarlaft WHERE CustomerKey='".$_SESSION['Keyp']."'");
                                    while($row = sqlsrv_fetch_array($query)){	
                                ?>   									
                                    <option value="<?php echo $row['CargosId'];?>"><?php echo $row['CargosName'];?></option>
                                <?php
                                    }
                                ?>
                            </select>
                        </div>
                    </div>

                    <div class="form-group row">
                        <div class="col-md-2">
                            <label for="exampleFormControlSelect1">Nivel de Prioridad</label>
                            <select class="form-control select2" id="PlanesNivelPrioridad2" name="PlanesNivelPrioridad2" required>
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
                                <?php
                                    $query = sqlsrv_query($conn,"SELECT ResponsablesId, ResponsablesName FROM ResponsablesSarlaft WHERE CustomerKey='".$_SESSION['Keyp']."'");
                                    while($row = sqlsrv_fetch_array($query)){	
                                ?>   									
                                    <option value="<?php echo $row['ResponsablesId'];?>"><?php echo $row['ResponsablesName'];?></option>
                                <?php
                                    }
                                ?>
                            </select>
                        </div>
                        
                        <div class="col-md-5">
                            <label for="exampleFormControlSelect1">Responsable de la Aprobación</label>
                            <select class="form-control select2" id="respaprobacion" name="respaprobacion" required>
                                <option value="">Seleccione una opción</option>    									
                                <?php
                                    $query = sqlsrv_query($conn,"SELECT ResponsablesId, ResponsablesName FROM ResponsablesSarlaft WHERE CustomerKey='".$_SESSION['Keyp']."'");
                                    while($row = sqlsrv_fetch_array($query)){	
                                ?>   									
                                    <option value="<?php echo $row['ResponsablesId'];?>"><?php echo $row['ResponsablesName'];?></option>
                                <?php
                                    }
                                ?>
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
                <button type="button" class="btn btn-secondary" data-dismiss="modal" id="cerrar">Cerrar</button>
                <button type="button" class="btn btn-primary" id="guardar">Guardar</button>
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
                <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                    <a class="btn btn-primary" href="login.html">Logout</a>
                </div>
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

    <!-- <script src="//cdn.datatables.net/plug-ins/1.10.25/i18n/Spanish.json"></script>-->

    <!-- Select2 -->
	<script src="../plugins/select2/js/select2.full.min.js"></script>

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
            "paging": true,
            "lengthChange": true,
            "searching": true,
            "ordering": true,
            "info": true,
            "autoWidth": true,
            "lengthMenu": [ [5, 10, 25, 50, -1], [5, 10,25, 50, "Mostrar Todo"] ],
            "language": idioma
        }); 
        
        
        /*$('#exampleModal').on('show.bs.modal', function (e) {
            alert("Modal Mostrada con Evento de Boostrap");
            $('#Name2').focus():
        })
        */
        $('.select2').select2();

        $("#guardar").on('click', function(){
            alert(7);
            //location.reload();
        })

        $("#cerrar").on('click', function(){
            location.reload();
        })

</script>

</body>

</html>