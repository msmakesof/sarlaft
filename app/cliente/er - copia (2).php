<?php include '../ajax/is_logged.php';?>
<?php require_once '../components/sql_server.php';
$query_empresa=sqlsrv_query($con,"SELECT id, CustomerName, CustomerLogo, CustomerColor FROM CustomerSarlaft WHERE CustomerKey=".$_SESSION['Keyp']."");
$reg=sqlsrv_fetch_array($query_empresa);
//echo "sesion...".$_SESSION['Keyp']."<br>";
$CustomerKey = $_SESSION['Keyp'];
$consec2 = generarCodigo(6); // genera un código de 6 caracteres de longitud.
function generarCodigo($longitud) {
    $key = '';
    $pattern = '1234567890abcdefghijklmnopqrstuvwxyz';
    $max = strlen($pattern)-1;
    for($i=0;$i < $longitud;$i++) $key .= $pattern{mt_rand(0,$max)};
    return $key;
} 
$consecutivo = $reg['id'].'-'.$consec2;
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
		color: black; text-shadow: grey 0.1em 0.1em 0.2em
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
                    <h1 class="h3 mb-2 text-gray-800 maytit">Unidad Evento de Riesgo</h1>
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
								
								<div class="form-group row">
									<div class="col-sm-2">
                                        <label>Consecutivo</label>
                                        <input type="input" name="consecutivo" id="consecutivo" class="form-control input-sm" maxlenght="8" value="<?php echo $consecutivo; ?>" readonly>
                                    </div>
									<div class="col-md-10">
                                        <label>Evento</label>
                                        <select class="form-control select2" id="eventoriesgo" name="eventoriesgo" required>
                                            <option value="">Seleccione una opción</option>
                                            <?php include("../curl/eventosriesgo/listar.php"); ?>
                                        </select>
                                    </div>
								</div>	
									
								<div id="zonadata">	
									<div class="form-group row">
										<div class="col-md-10">
											<div style="width:100px">
											<label>Proceso</label>
											<a href="#" id="mcreapro" style="padding-left:10px" data-target="#addProcesoModal" data-toggle="modal" data-ck="<?php echo $CustomerKey;?>">
												<i class="fas fa-file-alt fa-1x" data-toggle="tooltip" title="Crear Proceso" style="color:orange; cursor:pointer"></i>
											</a>
											</div>											
											<select class="form-control select2" id="proceso" name="proceso" required>
												<option value="">Seleccione una opción</option>
												<?php include("../curl/procesos/listar.php"); ?>
											</select>
										</div>
									</div>

									<div class="form-group row">
										<div class="col-md-10">
											<div style="width:100px">
											<label>Cargo</label>
											<a href="#" id="mcreacar" style="padding-left:10px" data-target="#addCargoModal" data-toggle="modal" data-ck="<?php echo $CustomerKey;?>">
												<i class="fas fa-file-alt fa-1x" data-toggle="tooltip" title="Crear Cargos" style="color:orange; cursor:pointer"></i>
											</a>
											</div>
											<select class="form-control select2" id="cargo" name="cargo" required>
												<option value="">Seleccione una opción</option>
												<?php include("../curl/cargos/listar.php"); ?>
											</select>
										</div>
									</div>

									<div class="form-group row">
										<div class="col-md-10">
											<div style="width:130px">
											<label>Responsable</label>
											<a href="#" id="mcreares" style="padding-left:10px" data-target="#addResponsableModal" data-toggle="modal" data-ck="<?php echo $CustomerKey;?>">
												<i class="fas fa-file-alt fa-1x" data-toggle="tooltip" title="Crear Responsable" style="color:orange; cursor:pointer"></i>
											</a>
											</div>
											<select class="form-control select2" id="responsable" name="responsable" required>
												<option value="">Seleccione una opción</option>
												<?php include("../curl/responsables/listar.php"); ?>
											</select>
										</div>
									</div>								
									
									<div class="form-group row">
										<div class="col-md-12">
										<?php include("../curl/matriz/listar_eve.php"); ?>
										</div>
									</div>
									
									<div class="form-group row">
										<div class="col-md-12">
										<?php include("../curl/tiposriesgo/listar_eve.php"); ?>
										</div>
									</div>
									
									<div class="form-group row">
										<div class="col-md-12">
										<?php include("../curl/factoresriesgo/listar_eve.php"); ?>
										</div>
									</div>
									
									<div class="form-group row">
										<div class="col-md-12">
										<?php include("../curl/riesgoasociado/listar_eve.php"); ?>
										</div>
									</div>
									
									<div class="form-group row">
										<div class="col-md-12">
										<?php include("../curl/causas/listar_eve.php"); ?>
										</div>
									</div>
									
									<div class="form-group row">
										<div class="col-md-12">
										<?php include("../curl/consecuencia/listar_eve.php"); ?>
										</div>
									</div>
									
									<div class="form-group row">
										<div class="col-md-12">
										<?php //include("../curl/control/listar_eve.php"); ?>
										</div>
									</div>
									
									<div class="form-group row">
										<div class="col-md-12">
										<?php include("../curl/tratamientos/listar_eve.php"); ?>
										</div>
									</div>
									
									<div class="form-group row">
										<div class="col-md-12">
										<?php include("../curl/debilidades/listar_eve.php"); ?>
										</div>
									</div>
									
									<div class="form-group row">
										<div class="col-md-12">
										<?php include("../curl/oportunidades/listar_eve.php"); ?>
										</div>
									</div>
									
									<div class="form-group row">
										<div class="col-md-12">
										<?php include("../curl/fortalezas/listar_eve.php"); ?>
										</div>
									</div>
									
									<div class="form-group row">
										<div class="col-md-12">
										<?php include("../curl/amenazas/listar_eve.php"); ?>
										</div>
									</div>
									
									<div class="form-group row">
										<div class="col-md-12">
										<?php //include("../curl/consecuencia/listar_eve.php"); ?>
										</div>
									</div>								
									
								</div>
							</form>	
                            </div>
							
							<div>
								<button type="button" class="btn btn-primary" id="pguardar">Guardar</button>
								<button class="btn btn-danger" type="button" data-dismiss="modal" id="ecerrar">Salir</button>
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
	
	<!--
	<script src="../plugins/inputmask/jquery.maskedinput-1.2.2-co.min.js"></script> -->
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

    <script>
        function mks(p1,p2){		
			//$.post("tareas.php",{ id: p1, np: p2 }).done(function( data ) { $( "body" ).html(data);})
            $.redirect("tareas.php", {id: p1, np : p2 });
		}        
        $(document).ready(function(){
			$(".loader").fadeOut("slow");			
			$("#zonadata").hide()	
            $('.select2').select2()			
			
            $('#exampleModal').on('show.bs.modal', function () {
                setTimeout(function (){
                    $('#PlanName2').focus()
                }, 500)
            })
			
			$("#eventoriesgo").on('change', function(){
				var er = $(this).val();
				if (er != ""){
					$("#zonadata").show()
				}
				else{
					$("#zonadata").hide()
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
			
			$("#pguardar").on('click', function(event){
                //alert(7);				
				var filas = [];
				$('#tabcau tbody tr').each(function() {
					var selopc = $(this).find('td').eq(0).text();
					var fila = { selopc	};
					filas.push(fila);
				})
				//console.log(filas);				
				//alert(filas);
				
				var mks = [];  // Array Ppal				
				var consecut =[];
				tmp = {	'id' : $("#consecutivo").val() }
				consecut.push(tmp)
				sof20 = {'ICO' : consecut }
				mks.push(sof20)
				
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
				
				var Efilas = []; // Este es el array ppal para los select anidados				
				var tir =[];
				let selTir = $('.tiporie');
				selTir.each(function (){
					let select = $(this);
					var fila = { select };
					Efilas.push(fila);
					if (select.val() != ""){
						tmp = { 'id' : select.val() }
						tir.push(tmp)
					}
				});
				sof5 = { 'TIR': tir }
				mks.push(sof5)
				
				var far=[];
				let selFar = $('.factorie');
				selFar.each(function () {
					let select = $(this);
					var fila = { select };
					Efilas.push(fila);
					if (select.val() != ""){
						tmp = { 'id' : select.val() }
						far.push(tmp)
					}
				})
				sof6 = { 'FAR': far }
				mks.push(sof6)							
				
				var ria = [];
				let selRia = $('.ria');  
				selRia.each(function () {
					let select = $(this);
					var fila = { select	};
					Efilas.push(fila);
					//console.log(select.val());
					if (select.val() != ""){
						tmp ={ 'id' : select.val() }
						ria.push(tmp)
					}
				});
				sof2 = { 'RIA': ria	}
				mks.push(sof2)
				
				var cau = [];				
				let selCuasa = $('.causa');  
				selCuasa.each(function () {
					let select = $(this);
					var fila = { select	};
					Efilas.push(fila);
					////console.log(select.val());
					if (select.val() != ""){
						tmp = { 'id' : select.val() }
						cau.push(tmp)
					}
				});
				sof = {	'CAU': cau }
				mks.push(sof)
				
				var con = []
				let selCon = $('.consec')
				selCon.each(function () {
					let select = $(this)
					var fila = { select }
					Efilas.push(fila)
					if (select.val() != ""){
						tmp = { 'id' : select.val() }
						con.push(tmp)
					}
				})
				sof7 = {'CON' : con }
				mks.push(sof7)
				
				var tra = []
				let selTra = $('.trata')
				selTra.each(function () {
					let select = $(this)
					var fila = { select }
					Efilas.push(fila)
					if (select.val() != ""){
						tmp = { 'id' : select.val() }
						tra.push(tmp)
					}
				})
				sof8 = { 'TRA' : tra }
				mks.push(sof8)
				
				var trastatus = []
				let selTrastatus = $('.tratastatus')
				selTrastatus.each(function () {
					let select = $(this)
					var fila = { select }
					Efilas.push(fila)
					if (select.val() != ""){
						tmp = { 'status' : select.val() }
						trastatus.push(tmp)
					}
				})
				sof8status = { 'TRA' : trastatus }
				mks.push(sof8status)
				
				
				
				
				
				var traprioridad = []
				let selTraprioridad = $('.tratapriori')
				selTraprioridad.each(function () {
					let select = $(this)
					var fila = { select }
					Efilas.push(fila)
					if (select.val() != ""){
						tmp = { 'id' : select.val() }
						traprioridad.push(tmp)
					}
				})
				sof8priori = { 'TRAPRI' : traprioridad }
				mks.push(sof8priori)
				
				var trafinicio = []
				let selTrafinicio = $('.tratafinicio')
				selTrafinicio.each(function () {
					let input = $(this)
					var fila = { input }
					console.log(fila)
					Efilas.push(fila)
					if (input.val() != ""){
						tmp = { 'id' : input.val() }
						trafinicio.push(tmp)
					}
				})
				sof8finicio = { 'TRAFIN' : trafinicio }
				mks.push(sof8finicio)
				
				var traffinal = []
				let selTraffinal = $('.trataffinal')
				selTraffinal.each(function () {
					let select = $(this)
					var fila = { select }
					Efilas.push(fila)
					if (select.val() != ""){
						tmp = { 'id' : select.val() }
						traffinal.push(tmp)
					}
				})
				sof8ffinal = { 'TRAFFI' : traffinal }
				mks.push(sof8ffinal)
				
				var trafseg = []
				let selTrafseg = $('.tratafseg')
				selTrafseg.each(function () {
					let select = $(this)
					var fila = { select }
					Efilas.push(fila)
					if (select.val() != ""){
						tmp = { 'id' : select.val() }
						trafseg.push(tmp)
					}
				})
				sof8fseg = { 'TRASEG' : trafseg }
				mks.push(sof8fseg)			
				
				
				var deb = []
				let selDeb = $('.debil')
				selDeb.each(function () {
					let select = $(this)
					var fila = { select }
					//console.log(fila)
					Efilas.push(fila)
					if (select.val() != ""){
						tmp = { 'id' : select.val() }
						deb.push(tmp)
					}
				})
				sof9 = { 'DEB' : deb }
				mks.push(sof9)
				
				var opo = []
				let selOpo = $('.opor')
				selOpo.each(function () {
					let select = $(this)
					var fila = { select }
					Efilas.push(fila)
					if(select.val() != ""){
						tmp = { 'id' : select.val() }
						opo.push(tmp)
					}
				})
				sof10 = { 'OPO' : opo }
				mks.push(sof10)
				
				var fortal = []
				let selFor = $('.fortal')
				selFor.each(function () {
					let select = $(this)
					var fila = { select }
					Efilas.push(fila)
					if(select.val() != ""){
						tmp = { 'id' : select.val() }
						fortal.push(tmp)
					}
				})
				sof11 = { 'FOR' : fortal } 
				mks.push(sof11)
				
				var ame = []
				let selAme = $('.ame')
				selAme.each(function (){
					let select = $(this)
					var fila = { select }
					Efilas.push(fila)
					if( select.val() != ""){
						tmp = { 'id' : select.val() }
						ame.push(tmp)
					}
				})
				sof12 = { 'AME' : ame }
				mks.push(sof12)				
				
				var mriprob =[];
				tmp = {	'id' : $("#prob1").val() }
				mriprob.push(tmp)
				sof13 = {'MIP' : mriprob }
				mks.push(sof13)
				
				var mricons =[];
				tmp = {	'id' : $("#consec1").val() }
				mricons.push(tmp)
				sof14 = {'MIC' : mricons }
				mks.push(sof14)
				
				var mcoprob =[];
				tmp = {	'id' : $("#prob2").val() }
				mcoprob.push(tmp)
				sof15 = {'MCP' : mcoprob }
				mks.push(sof15)
				
				var mcocons =[];
				tmp = {	'id' : $("#consec2").val() }
				mcocons.push(tmp)
				sof16 = {'MCC' : mcocons }
				mks.push(sof16)				
				
				////console.log(obj);
				console.log(mks);
				
				//var paramet = $('#formap').serialize()
				var paramet = mks
				alert(paramet);
				$.ajax({
                    type: "POST",
                    url: "grabaer.php",
					data: { js : mks },
                    success: function(datos){
                        alert(datos);
                    }	
                })
			})
  
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
		var global = { key: "<?php echo $CustomerKey; ?>" };
    </script>
	<script src="js/proceso.js"></script>
	<script src="js/cargo.js"></script>
	<script src="js/responsable.js"></script>
	<script src="js/tiporiesgo.js"></script>
	<script src="js/factorriesgo.js"></script>
	<script src="js/riesgoasociado.js"></script>
	<script src="js/causa.js"></script>
	<script src="js/consecuencia.js"></script>
	<script src="js/tratamiento.js"></script>
	<script src="js/debilidad.js"></script>
	<script src="js/oportunidad.js"></script>
	<script src="js/fortaleza.js"></script>
	<script src="js/amenaza.js"></script>
</body>
</html>