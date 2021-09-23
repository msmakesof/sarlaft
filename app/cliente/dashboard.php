<?php include '../ajax/is_logged.php';
$UserKey=$_SESSION['UserKey'];
$CustomerKey = trim($_SESSION['Keyp']);
require_once '../config/dbx.php';

$getConnectionSL = new Database();
$con = $getConnectionSL->getConnectionSL($CustomerKey);

$query_empresa=sqlsrv_query($con,"SELECT id, CustomerName, CustomerLogo, CustomerColor FROM CustomerSarlaft WHERE CustomerKey='".$CustomerKey."'");
$reg=sqlsrv_fetch_array($query_empresa);

$getConnectionCli2 = new Database();
$conn = $getConnectionCli2->getConnectionCli2($_SESSION['Keyp']);

$query_titulo=sqlsrv_query($conn,"SELECT TIT_IdTitulo, TIT_Nombre FROM TIT_Titulo WHERE TIT_CustomerKey=".$_SESSION['Keyp']."");
$regtit=sqlsrv_fetch_array($query_titulo);
$IdTitulo = trim($regtit['TIT_IdTitulo']);
$NombreTitulo = trim($regtit['TIT_Nombre']);
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
	<style>
	form label {
		font-weight: bold;
		color: black; text-shadow: grey 0.1em 0.1em 0.2em
	}
	.titulo{
		font-weight: bold;
		color: white; text-shadow: grey 0.1em 0.1em 0.2em;
		font-size:2em;
	}
	
	.maytit{text-shadow: 1px 1px white, -1px -1px #333; font-family: fantasy}
	
	.loader {
		position: fixed;
		left: 0px;
		top: 0px;
		width: 100%;
		height: 100%;
		z-index: 9999;
		background: url('img/loader.gif') 50% 50% no-repeat rgb(249,249,249);
		opacity: .8;
	}	
	
	th, td {
	   width: 25%;
	   text-align: left;
	   vertical-align: top;
	   border: 1px solid #000;
	   border-spacing: 0;
	}
	
	.txt{
		font-size:0.8em;
	}
	
	.txtotal{
		font-size:0.8em;
		background-color: #AAAAAA;
		color:black;
	}
	
	.txty{
		background-color:#E3E3E3;
		font-size:0.9em;
		color:black;
	}
	
	.txtdiv{
		height: 60px;
		line-height: 20px;
		text-align: center;3
		vertical-align: middle;
		padding-top: 15px;
		padding-right: 10px;
		padding-bottom: 20px;
		padding-left: 10px;
	}
	
	.txtdivProm{
		height: 10px;
		line-height: 20px;
		text-align: center;3
		vertical-align: middle;
		padding-top: 10px;
		padding-right: 10px;
		padding-bottom: 20px;
		padding-left: 5px;
	}
	
	.divProm{
		height: 10px;
		/*line-height: 10px;
		text-align: center;*/
		vertical-align: middle;
		padding-top: 24px;
		padding-right: 10px;
		padding-bottom: 10px;
		padding-left: 5px;
	}
	
	.divPromNom{
		height: 10px;
		/*line-height: px;*/
		text-align: center;
		vertical-align: middle;
		padding-top: 10px;
		padding-right: 10px;
		padding-bottom: 20px;
		padding-left: 5px;
	}
	
	.txtx{
		color:black;
		padding-top: 8px;
		padding-bottom: 1px;
	}
	</style>
</head>

<body id="page-top">
	<div class="loader"></div>
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
                    <h1 class="h3 mb-2 text-gray-800 maytit">Herramientas</h1>
                    <p class="mb-4"></p>

                    <!-- DataTales Example -->
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <div style="float:left">
                                <h6 class="m-0 font-weight-bold text-primary titulo"><?php echo strtoupper($reg['CustomerName']); ?></h6>
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
								<input type="hidden" id="hder">
								<div class="form-group row">
									<div class="col-md-12">
										<table style="width:100%;">
											<tr>
												<td style="text-align:center; border: black 1px solid;"><img src="../img/edit.png" style="width:180px;"></td>
												<td style="background-color:red; text-align:center; border: red 1px solid;">
													<span class="titulo">Dashboard</span>
												</td>												
											</tr>
										</table>
									</div>
									<div style="margin:0.5em"></div>
								</div>	
									
								<div id="zonadata">
									<table width="100%" border="1" cellspacing="0" cellpadding="0">
										<tbody>
											<tr>
											  <td style="background-color:gray; color:white; text-align:center">RIESGO - PROCESO</td>
											  <td style="background-color:gray; color:white; text-align:center">TABLERO DE CONTROL</td>
											</tr>
											<tr>
											  <td><table width="100%" border="1" cellspacing="0" cellpadding="0">
												<tbody>
												  <tr>
													<td class="txty"><div class="txtdiv">Nivel de Riesgo</div></td>
													<td class="txty"><div class="txtdiv">Riesgo Absoluto</div></td>
													<td class="txty"><div class="txtdiv">Riesgo con Controles</div></td>
													<td rowspan="8">
														<!-- Bar Chart -->
														<div class="card shadow mb-4">
															<div class="card-body">
																<div class="chart-bar">
																	<canvas id="myBarChart"></canvas>
																</div>
															</div>
														</div>
													</td>
												  </tr>
												  <?php
													$queryint = sqlsrv_query($conn,"SELECT NIR_IdNivelRiesgo, NIR_Nombre, NIR_Color FROM NIR_NivelRiesgo WHERE NIR_CustomerKey = '$CustomerKey' ORDER BY NIR_IdNivelRiesgo DESC ");
													{
														if ( $queryint === false)
														{
															die(print_r(sqlsrv_errors(), true));
														}						
														while( $rowint = sqlsrv_fetch_array( $queryint, SQLSRV_FETCH_ASSOC) ) {
															$Id = $rowint['NIR_IdNivelRiesgo'];
															$Nombre = trim($rowint['NIR_Nombre']);
															$Color = trim($rowint['NIR_Color']);
												?>
														<tr>
															<td style="background-color:<?php echo $Color; ?>; color:black">
																<div class="divPromNom"><?php echo $Nombre; ?></div>
															</td>
															<td style="text-align:center">1</td>
															<td style="text-align:center">2</td>
														</tr>
												<?php
														}
													}
												?>
												  <tr>
													<td class="txtotal"><div class="txtdivProm">Total General</div></td>
													<td class="txtotal">&nbsp;</td>
													<td class="txtotal">&nbsp;</td>
													</tr>
												  <tr>
													<td><div class="txtx"># Controles</div></td>
													<td colspan="2">&nbsp;</td>
													</tr>
												  <tr>
													<td><div class="txtx"># Tratamientos</div></td>
													<td colspan="2">&nbsp;</td>
													</tr>
												</tbody>
											  </table></td>
											  <td>
												<!-- Bar Chart -->
												<div class="card shadow mb-4">
													<div class="card-body">
														<div class="chart-bar">
															<canvas id="myBarChart2"></canvas>
														</div>
													</div>
												</div>
											  </td>
											</tr>
											<tr>
											  <td style="background-color:gray; color:white; text-align:center">PROMEDIOS</td>
											  <td style="background-color:gray; color:white; text-align:center">INDICADORES</td>
											</tr>
											<tr>
											  <td><table width="100%" border="1" cellspacing="0" cellpadding="0">
												<tbody>
												  <tr>
													<td class="txt"><div class="divProm">Desv. Estandar</div></td>
													<td>&nbsp;</td>
													<td>&nbsp;</td>
													<td rowspan="6">
														<!-- Bar Chart -->
														<div class="card shadow mb-4">
															<div class="card-body">
																<div class="chart-bar">
																	<canvas id="myBarChart3"></canvas>
																</div>
															</div>
														</div>
													</td>
												  </tr>
												  <tr>
													<td class="txt"><div class="divProm">Mediana</div></td>
													<td>&nbsp;</td>
													<td>&nbsp;</td>
													</tr>
												  <tr>
													<td class="txt"><div class="divProm">Mínimo</div></td>
													<td>&nbsp;</td>
													<td>&nbsp;</td>
													</tr>
												  <tr>
													<td class="txt"><div class="divProm">Promedio</div></td>
													<td>&nbsp;</td>
													<td>&nbsp;</td>
													</tr>
												  <tr>
													<td class="txt"><div class="divProm">Varianza</div></td>
													<td>&nbsp;</td>
													<td>&nbsp;</td>
													</tr>
												  <tr>
													<td class="txt"><div class="divProm">Máximo</div></td>
													<td>&nbsp;</td>
													<td>&nbsp;</td>
													</tr>
												</tbody>
											  </table></td>
											  <td rowspan="3">
												<table width="100%" border="1" cellspacing="0" cellpadding="0">
												  <tbody>
													<tr>
													  <td style="background-color:#B5B5B5; color:white; text-align:center">EFICACIA</td>
													</tr>
													<tr>
													  <td>Grafica 5</td>
													</tr>
												  </tbody>
											  </table>
												<table width="100%" border="1" cellspacing="0" cellpadding="0">
												  <tbody>
													<tr>
													  <td style="background-color:#B5B5B5; color:white; text-align:center">EFICACIA TRATAMIENTOS</td>
													</tr>
													<tr>
													  <td>Grafica 6</td>
													</tr>
												  </tbody>
												</table>
												<table width="100%" border="1" cellspacing="0" cellpadding="0">
												  <tbody>
													<tr>
													  <td style="background-color:#B5B5B5; color:white; text-align:center">EFICACIA SARLAFT</td>
													</tr>
													<tr>
													  <td>Grafica 7</td>
													</tr>
												  </tbody>
												</table>
												<p>&nbsp;</p>
											  <p>&nbsp;</p></td>
											</tr>
											<tr>
											  <td style="background-color:gray; color:white; text-align:center">FUENTES RIESGOS</td>
											</tr>
											<tr>
												<td>
													<table width="100%" border="1" cellspacing="0" cellpadding="0">
														<tbody>
															<tr>
																<td style="background-color:#E3E3E3; color:black; text-align:center; font-size:0.8em">Fuentes de Riesgo</td>
																<td style="background-color:#E3E3E3; color:black; text-align:center; font-size:0.8em">Riesgos Asociados</td>
															</tr>
															<tr>
																<td>
																	<table width="100%" border="1" cellspacing="0" cellpadding="0">
																		<tbody>
																			<?php
																			$queryFR = sqlsrv_query($conn,"SELECT FAR_IdFactorRiesgo, FAR_Nombre FROM FAR_FactorRiesgo WHERE FAR_CustomerKey = '$CustomerKey' ORDER BY FAR_Nombre ");
																			{
																				if ( $queryFR === false)
																				{
																					die(print_r(sqlsrv_errors(), true));
																				}						
																				while( $rowFR = sqlsrv_fetch_array( $queryFR, SQLSRV_FETCH_ASSOC) ) {
																					$IdFR = $rowFR['FAR_IdFactorRiesgo'];
																					$NombreFR = trim($rowFR['FAR_Nombre']);
																			?>
																			<tr>	
																				<td><?php echo $NombreFR; ?></td>
																				<td></td>
																			</tr>
																			<?php
																				}
																			}
																			?>
																		</tbody>
																	</table>
																</td>
																<td>
																	<table width="100%" border="1" cellspacing="0" cellpadding="0">
																		<tbody>
																			<?php
																			$queryFR = sqlsrv_query($conn,"SELECT RIA_IdRiesgoAsociado, RIA_Nombre FROM RIA_RiesgoAsociado WHERE RIA_CustomerKey = '$CustomerKey' ORDER BY RIA_Nombre ");
																			{
																				if ( $queryFR === false)
																				{
																					die(print_r(sqlsrv_errors(), true));
																				}						
																				while( $rowFR = sqlsrv_fetch_array( $queryFR, SQLSRV_FETCH_ASSOC) ) {
																					$IdRA = $rowFR['RIA_IdRiesgoAsociado'];
																					$NombreRA = trim($rowFR['RIA_Nombre']);
																			?>
																			<tr>	
																				<td><?php echo $NombreRA; ?></td>
																				<td></td>
																			</tr>
																			<?php
																				}
																			}
																			?>
																		</tbody>
																	</table>
																</td>
															</tr>
														</tbody>
													</table>
												</td>
											</tr>
										</tbody>
									</table>									
									
								</div>
							</form>	
                            </div>
                        </div>						
                    </div>
                </div>
                <!-- /.container-fluid -->
              
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
	
	<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.maskedinput/1.4.1/jquery.maskedinput.min.js"></script>

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
	
	 <!-- Page level plugins -->
    <script src="vendor/chart.js/Chart.min.js"></script>

    <!-- Page level custom scripts -->
    <script src="js/demo/chart-bar-demo.js"></script>

    <script>
        $(document).ready(function(){
			$(".loader").fadeOut("slow");
			$('#sidebarToggle').click();			
  
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