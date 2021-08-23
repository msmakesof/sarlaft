<?php 
/*************************************************************************
Created : Mauricio Sánchez Sierra
Date: 2021-08-05
Description: Consulta un Evento de Riesgo
**************************************************************************/
if ( !isset($_POST['id']) || $_POST['id'] == "" )
{
	header('Location: eventosriesgo.php');
	exit;
}
$IdEvento = trim($_POST['id']);
$ck = trim($_POST['ck']);
echo "$IdEvento   - $ck  <br>";
include '../ajax/is_logged.php';
$UserKey=$_SESSION['UserKey'];
require_once '../config/dbx.php';
$getConnectionCli2 = new Database();
$conn = $getConnectionCli2->getConnectionCli2($_SESSION['Keyp']);

// Consulta el Evento de Riesgo
$query_er=sqlsrv_query($conn,"SELECT EVRI_Id, EVRI_Consecutivo, EVRI_IdEvento, EVRI_IdProceso, EVRI_IdCargo, EVRI_IdResponsable, EVRI_IdInterseccion,EVRI_CustomerKey, EVRI_UserKey, EVRI_EventoKey, EVRI_DateStamp FROM EVRI_EventoRiesgo WHERE EVRI_Id=".$IdEvento." AND EVRI_CustomerKey='" .$ck."'");
$reger=sqlsrv_fetch_array($query_er);
$Consecutivo = trim($reger['EVRI_Consecutivo']);
$IdEventoRiesgo = trim($reger['EVRI_IdEvento']);
$IdProceso = trim($reger['EVRI_IdProceso']);
$IdCargo = trim($reger['EVRI_IdCargo']);
$IdResponsable = trim($reger['EVRI_IdResponsable']);

$query_mri=sqlsrv_query($conn,"SELECT MOV_FilaMRI, MOV_ColumnaMRI, PRO_Nombre, CSC_Nombre FROM MOV_MatrizInherente JOIN PRO_Probabilidad ON PRO_Escala = MOV_FilaMRI AND PRO_CustomerKey = MOV_CustomerKeyMRI JOIN CSC_Consecuencia ON CSC_Escala = MOV_ColumnaMRI AND CSC_CustomerKey = MOV_CustomerKeyMRI WHERE MOV_IdEventoMRI=".$IdEvento." AND MOV_CustomerKeyMRI='" .$ck."' ORDER BY MOV_IdMovimientoMRI DESC ");
$regmri=sqlsrv_fetch_array($query_mri);
$FilaMRI = trim($regmri['MOV_FilaMRI']);
$ColumnaMRI = trim($regmri['MOV_ColumnaMRI']);
$PRO_Nombre = trim($regmri['PRO_Nombre']);
$CSC_Nombre = trim($regmri['CSC_Nombre']);
//echo $IdEventoRiesgo;

$query_mrc=sqlsrv_query($conn,"SELECT TOP 1 MOV_FilaMRC, MOV_ColumnaMRC, PRO_Nombre, CSC_Nombre FROM MOV_MatrizControl JOIN PRO_Probabilidad ON PRO_Escala = MOV_FilaMRC AND PRO_CustomerKey = MOV_CustomerKeyMRC JOIN CSC_Consecuencia ON CSC_Escala = MOV_ColumnaMRC AND CSC_CustomerKey = MOV_CustomerKeyMRC WHERE MOV_IdEventoMRC=".$IdEvento." AND MOV_CustomerKeyMRC='" .$ck."' ORDER BY MOV_IdMovimientoMRC DESC ");
$regmrc=sqlsrv_fetch_array($query_mrc);
$FilaMRC = trim($regmrc['MOV_FilaMRC']);
$ColumnaMRC = trim($regmrc['MOV_ColumnaMRC']);
$PRO_NombreC = trim($regmrc['PRO_Nombre']);
$CSC_NombreC = trim($regmrc['CSC_Nombre']);

///echo "$FilaMRC  -  $ColumnaMRC -  $PRO_NombreC -  $CSC_NombreC<br>";

$query_titulo=sqlsrv_query($conn,"SELECT TIT_IdTitulo, TIT_Nombre FROM TIT_Titulo WHERE TIT_CustomerKey=".$_SESSION['Keyp']."");
$regtit=sqlsrv_fetch_array($query_titulo);
$IdTitulo = trim($regtit['TIT_IdTitulo']);
$NombreTitulo = trim($regtit['TIT_Nombre']);

$query_escalacalificacion=sqlsrv_query($conn,"SELECT TOP 1 ESC_Valor FROM ESC_EscalaCalificacion WHERE ESC_CustomerKey=".$_SESSION['Keyp']."");
$regescala=sqlsrv_fetch_array($query_escalacalificacion);
$EscalaValor = trim($regescala['ESC_Valor']);

$ValorAplicado =0;
$ValorEfectivo =0;
$SumaAplicado_Efectivo = 0;
$Umbral = 0;
if ($EscalaValor == 5){
	$ValorAplicado =10;
	$ValorEfectivo =10;
	$Umbral = 50;
}
else {
	$ValorAplicado =2;
	$ValorEfectivo =2;
	$Umbral = 10;
}
$PosicioActualFils = 0;
$PosicioActualCols = 0;

$query_empresa=sqlsrv_query($conn,"SELECT id, CustomerName, CustomerLogo, CustomerColor FROM CustomerSarlaft WHERE CustomerKey=".$_SESSION['Keyp']."");
$reg=sqlsrv_fetch_array($query_empresa);
//echo "sesion...".$_SESSION['Keyp']."<br>";
$CustomerKey = $_SESSION['Keyp'];
//echo $CustomerKey;
/*
$consec2 = generarCodigo(6); // genera un código de 6 caracteres de longitud.
function generarCodigo($longitud) {
    $key = '';
    $pattern = '1234567890abcdefghijklmnopqrstuvwxyz';
    $max = strlen($pattern)-1;
    for($i=0;$i < $longitud;$i++) $key .= $pattern{mt_rand(0,$max)};
    return $key;
} 
$consecutivo = $reg['id'].'-'.$consec2;*/
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
	
	.xxheaderMatriz {
	  /* The important part: */
	  position: sticky !important;
	  top: 0 !important;
	  
	  /* misc styling */
	  padding: 5px;
	  margin-bottom: 5px;
	  /* */
	  background-color: lightgreen; 
	}
	
	.headerMatriz {
		position: -webkit-sticky; /* Safari */
		position: fixed;
		top: 80px;
		z-index:100;
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
                    <h1 class="h3 mb-2 text-gray-800 maytit">Unidad Evento de Riesgo - Consulta</h1>
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
								<input type="hidden" id="hder" value="<?php echo $IdEventoRiesgo ; ?>">
								<div class="form-group row">
									<div class="col-sm-2">
                                        <label>Consecutivo</label>
                                        <input type="input" name="consecutivo" id="consecutivo" class="form-control input-sm" maxlenght="8" value="<?php echo $Consecutivo; ?>" readonly>
                                    </div>
									<div class="col-md-10">
                                        <label>Evento</label>
                                        <select class="form-control select2" id="eventoriesgo" name="eventoriesgo" required>
                                            <option value="">Seleccione una opción</option>											
                                            <?php $IdEventoRiesgo = $IdEventoRiesgo ;
											include("../curl/eventosriesgo/listar.php"); ?>
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
												<?php $IdProceso = $IdProceso ;
												include("../curl/procesos/listar.php"); ?>
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
												<?php $IdCargo =$IdCargo;
												include("../curl/cargos/listar.php"); ?>
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
												<?php $IdResponsable =$IdResponsable;
												include("../curl/responsables/listar.php"); ?>
											</select>
										</div>
									</div>								
				
				
				 <div class="xheaderMatriz">
									<div class="form-group row" id="parmatriz">
										<div class="col-md-12">
										<?php 
$getUrl = new Database();
$urlServicios = $getUrl->getUrl();
if(function_exists('curl_init')) // Comprobamos si hay soporte para cURL
{
	// Lista de Probabilidad
	$url = $urlServicios."api/probabilidad/lista_eve.php?ck=$CustomerKey";
	//echo "url...$url<br>";
	$resultado="";
	$ch = curl_init();
    curl_setopt($ch, CURLOPT_VERBOSE, true);
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_TIMEOUT, 30);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
    curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
    curl_setopt($ch, CURLOPT_POST, 0);
    $resultado = curl_exec ($ch);
    curl_close($ch);
	$mestado =  preg_replace('/[\x00-\x1F\x80-\xFF]/', '', $resultado);    
	$dataprob = json_decode($mestado, true);	
	
	$json_errors = array(
		JSON_ERROR_NONE => 'No se ha producido ningún error',
		JSON_ERROR_DEPTH => 'Maxima profundidad de pila ha sido excedida',
		JSON_ERROR_CTRL_CHAR => 'Error de carácter de control, posiblemente codificado incorrectamente',
		JSON_ERROR_SYNTAX => 'Error de Sintaxis',
	);
	foreach($dataprob as $key => $row) {}
	
	if( $key == "message")
	{
		echo $dataprob["message"];
	}
	else
	{
		$sel_prob="<select class='form-control mprob' id='prob1' name='prob1' required style='font-size:12px'>";
		$sel_prob.="<option value=''>Seleccione opción</option>";
		for($i=0; $i<count($dataprob['body']); $i++)
		{				
			$condi = "";
			$id = $dataprob['body'][$i]["PRO_IdProbabilidad"];
			$nombre = trim($dataprob['body'][$i]["PRO_Nombre"]);
			$escala = trim($dataprob['body'][$i]["PRO_Escala"]);
			$color = trim($dataprob['body'][$i]["PRO_Color"]);
			//if( isset($IdItem) && $IdItem != "" && $id == $IdItem ){
			if( isset($FilaMRI) && $FilaMRI != "" && $escala == $FilaMRI ){
				$condi = ' selected="selected" ';
			}
			$sel_prob.= '<option value="'. $escala .'"'. $condi .'>'. $nombre .'</option>';
		}
		$sel_prob.= "</select>";
		
		// Este es para la imagen de la matriz de inherente a Control cuando es la primera vez
		$sel_prob11= "";
		$sel_prob11="<select class='form-control mprob' id='prob11' name='prob11' required style='font-size:12px'>";
		$sel_prob11.="<option value=''>Seleccione opción</option>";
		for($i=0; $i<count($dataprob['body']); $i++)
		{				
			$condi = "";
			$id = $dataprob['body'][$i]["PRO_IdProbabilidad"];
			$nombre = trim($dataprob['body'][$i]["PRO_Nombre"]);
			$escala = trim($dataprob['body'][$i]["PRO_Escala"]);
			$color = trim($dataprob['body'][$i]["PRO_Color"]);
			if( isset($IdItem) && $IdItem != "" && $id == $IdItem ){
				$condi = ' selected="selected" ';
			}
			$sel_prob11.= '<option value="'. $escala .'"'. $condi .'>'. $nombre .'</option>';
		}
		$sel_prob11.= "</select>";

		$sel_prob2="<select class='form-control mprob2' id='prob2' name='prob2' required style='font-size:12px'>";
		$sel_prob2.="<option value=''>Seleccione opción</option>";
		for($i=0; $i<count($dataprob['body']); $i++)
		{				
			$condi2 = "";
			$id = $dataprob['body'][$i]["PRO_IdProbabilidad"];
			$nombre = trim($dataprob['body'][$i]["PRO_Nombre"]);
			$escala = trim($dataprob['body'][$i]["PRO_Escala"]);
			$color = trim($dataprob['body'][$i]["PRO_Color"]);
			if( isset($IdItem) && $IdItem != "" && $id == $IdItem ){
				$condi2 = ' selected="selected" ';
			}
			$sel_prob2.= '<option value="'. $id .'"'. $condi .'>'. $nombre .'</option>';
		}
		$sel_prob2.= "</select>";
	}

	// Lista de Consecuencia
	$url = $urlServicios."api/consecuencia/lista_eve.php?ck=$CustomerKey";
	//echo "url...$url<br>";
	$resultado="";
	$ch = curl_init();
    curl_setopt($ch, CURLOPT_VERBOSE, true);
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_TIMEOUT, 30);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
    curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
    curl_setopt($ch, CURLOPT_POST, 0);
    $resultado = curl_exec ($ch);
    curl_close($ch);
	$mestado =  preg_replace('/[\x00-\x1F\x80-\xFF]/', '', $resultado);    
	$datacsc = json_decode($mestado, true);	
	
	$json_errors = array(
		JSON_ERROR_NONE => 'No se ha producido ningún error',
		JSON_ERROR_DEPTH => 'Maxima profundidad de pila ha sido excedida',
		JSON_ERROR_CTRL_CHAR => 'Error de carácter de control, posiblemente codificado incorrectamente',
		JSON_ERROR_SYNTAX => 'Error de Sintaxis',
	);
	foreach($datacsc as $key => $row) {}
	
	if( $key == "message")
	{
		echo $datacsc["message"];
	}
	else
	{
		$IdItemcsc="";
		$sel_csc="<select class='form-control mconsec' id='consec1' name='consec1' required style='font-size:12px'>";
		$sel_csc.="<option value=''>Seleccione opción</option>";
		for($i=0; $i<count($datacsc['body']); $i++)
		{				
			$condicsc = "";
			$idcsc = $datacsc['body'][$i]["CSC_IdConsecuencia"];
			$nombrecsc = trim($datacsc['body'][$i]["CSC_Nombre"]);
			$escalacsc = trim($datacsc['body'][$i]["CSC_Escala"]);
			$color = trim($datacsc['body'][$i]["CSC_Color"]);
			//if( isset($IdItemcsc) && $IdItemcsc != "" && $idcsc == $IdItemcsc ){
			if( isset($ColumnaMRI) && $ColumnaMRI != "" && $escalacsc == $ColumnaMRI ){
				$condicsc = ' selected="selected" ';
			}
			$sel_csc.= '<option value="'. $escalacsc .'"'. $condicsc .'>'. $nombrecsc .'</option>';
		}
		$sel_csc.= "</select>";
		
		// Para la matriz de control cuando es clonada 
		$sel_csc11="";
		$sel_csc11="<select class='form-control mconsec' id='consec11' name='consec11' required style='font-size:12px'>";
		$sel_csc11.="<option value=''>Seleccione opción</option>";
		for($i=0; $i<count($datacsc['body']); $i++)
		{				
			$condicsc = "";
			$idcsc = $datacsc['body'][$i]["CSC_IdConsecuencia"];
			$nombrecsc = trim($datacsc['body'][$i]["CSC_Nombre"]);
			$escalacsc = trim($datacsc['body'][$i]["CSC_Escala"]);
			$color = trim($datacsc['body'][$i]["CSC_Color"]);
			if( isset($IdItemcsc) && $IdItemcsc != "" && $idcsc == $IdItemcsc ){
				$condicsc = ' selected="selected" ';
			}
			$sel_csc11.= '<option value="'. $escalacsc .'"'. $condicsc .'>'. $nombrecsc .'</option>';
		}
		$sel_csc11.= "</select>";

		$IdItemcs2c="";
		$sel_csc2="<select class='form-control mconsec2' id='consec2' name='consec2' required style='font-size:12px'>";
		$sel_csc2.="<option value=''>Seleccione opción</option>";
		for($i=0; $i<count($datacsc['body']); $i++)
		{				
			$condicsc2 = "";
			$idcsc = $datacsc['body'][$i]["CSC_IdConsecuencia"];
			$nombrecsc = trim($datacsc['body'][$i]["CSC_Nombre"]);
			$escalacsc = trim($datacsc['body'][$i]["CSC_Escala"]);
			$color = trim($datacsc['body'][$i]["CSC_Color"]);
			if( isset($IdItemcsc2) && $IdItemcsc2 != "" && $idcsc == $IdItemcsc2 ){
				$condicsc2 = ' selected="selected" ';
			}
			$sel_csc2.= '<option value="'. $idcsc .'"'. $condicsc2 .'>'. $nombrecsc .'</option>';
		}
		$sel_csc2.= "</select>";
	}
	
?>
<style>
.vertical {
	writing-mode: vertical-lr;
	transform: rotate(180deg);
	text-align:center;
}
.tituloMat {color: black; text-shadow: black 0.1em 0.1em 0.2em; font-weight:bold; letter-spacing: 2px;}
.tituloMat2 {text-shadow: 1px 1px white, -1px -1px #333;}
.tituloMat3 {
	font-weight: bold;
	color: black; text-shadow: grey 0.1em 0.1em 0.2em;
	text-align:center;
}
.subtitMat{
	font-weight: bold;
	color: black; text-shadow: grey 0.1em 0.1em 0.2em;
}
</style>
<table style="width:100% !important">
	<tr>
		<td>	
			<table class="table table-bordered" style="width:100%">
				<tbody>
					<tr>
						<td colspan='4' class="tituloMat3" style="width:100%">MATRIZ RIESGO INHERENTE</td>
					</tr>
					<tr>
						<td class="subtitMat" style="width:35%">Probabilidad
						<?php echo $sel_prob;?>
						</td>
						<!-- <td> <div id="lblprob"></div> </td> -->
						<td rowspan="2" class="vertical tituloMat2" style="width:5%">PROBABILIDAD</td>
						<td rowspan="2" style="width:60%">
							<div class="tituloMat2" style="text-align:center"><?php echo strtoupper($NombreTitulo) ; ?></div>
							
							<div id="matrizz">
							<?php 
							$FilaMRI = $FilaMRI;
							$ColumnaMRI = $ColumnaMRI;
							$er=$IdEvento;
							//include('../curl/matriz/matrizconsulta.php'); 
							include('../curl/matriz/matrizquery.php'); ?>
							</div>	
							
							<div id="matrizz1"></div>
							
						</td>
					</tr>
					<tr>
						<td class="subtitMat" style="width:35%"><?php echo $NombreTitulo ; ?>
						<?php echo $sel_csc;?>
						</td>
						<!-- <td> <div id="lblconsec"></div> </td> -->
					</tr>
				</tbody>
			</table>
		</td>
		
		<td id="clonmatriz"> <!-- Matriz Control Imagen-->
			<table class="table table-bordered" style="width:100%">
				<tbody>
					<tr>
						<td colspan='4' class="tituloMat3" style="width:100%">MATRIZ RIESGO CONTROL</td>
					</tr>
					<tr>
						<td class="subtitMat" style="width:35%; background-color: #E1DFDF;">Probabilidad
						<?php //echo $sel_prob11;?>
						<div style="text-align:center; line-height: 50px;"><label id="lblprob2"></label></div>
						</td>
						<td rowspan="2" class="vertical tituloMat2" style="width:5%">PROBABILIDAD</td>
						<td rowspan="2" style="width:60%">
							<div class="tituloMat2" style="text-align:center"><?php echo strtoupper($NombreTitulo) ; ?></div>
							
							<div id="matrizzControl">
							<?php 
							$FilaMRC = $FilaMRC;
							$ColumnaMRC = $ColumnaMRC;
							$er=$IdEvento;
							include('../curl/matriz/matrizcontrolquery.php'); ?>
							</div>	
							
							<div id="matrizz1Control"></div>
							
						</td>
					</tr>
					<tr>
						<td class="subtitMat" style="width:35%; background-color: #E1DFDF;"><?php echo $NombreTitulo ; ?>
						<?php //echo $sel_csc11;?>
							<div style="text-align:center;">
								<label id="lblconsec2"></label>
							</div>
						</td>			
					</tr>
				</tbody>
			</table>
		</td>

	</tr>
</table> 

<?php	
}  // Fin Comprobamos si hay soporte para cURL
?>
										
</div>
	</div><!-- zona parmatriz -->
									
									</div><!-- zona freeze -->
									
									<div class="form-group row">
										<div class="col-md-12">
										<?php
										 	$CustomerKey = $ck;	include("../curl/controles/listar_eve_query.php"); ?>
										</div>
									</div>
									
									<div class="form-group row">
										<div class="col-md-12">
										<?php $CustomerKey = $ck; include("../curl/tiposriesgo/listar_eve_query.php"); ?>
										</div>
									</div>
									
									<div class="form-group row">
										<div class="col-md-12">
										<?php include("../curl/factoresriesgo/listar_eve_query.php"); ?>
										</div>
									</div>
									
									<div class="form-group row">
										<div class="col-md-12">
										<?php include("../curl/riesgoasociado/listar_eve_query.php"); ?>
										</div>
									</div>
									
									<div class="form-group row">
										<div class="col-md-12">
										<?php include("../curl/causas/listar_eve_query.php"); ?>
										</div>
									</div>
									
									<div class="form-group row">
										<div class="col-md-12">
										<?php include("../curl/consecuencias/listar_eve_query.php"); ?>
										</div>
									</div>
									
									<!-- Ubicacion ORIGINAL de Controles -->
									
									
									<div class="form-group row">
										<div class="col-md-12">
										<?php include("../curl/tratamientos/listar_eve_query.php"); ?>
										</div>
									</div>
									
									<div class="form-group row">
										<div class="col-md-12">
										<?php include("../curl/debilidades/listar_eve_query.php"); ?>
										</div>
									</div>
									
									<div class="form-group row">
										<div class="col-md-12">
										<?php include("../curl/oportunidades/listar_eve_query.php"); ?>
										</div>
									</div>
									
									<div class="form-group row">
										<div class="col-md-12">
										<?php include("../curl/fortalezas/listar_eve_query.php"); ?>
										</div>
									</div>
									
									<div class="form-group row">
										<div class="col-md-12">
										<?php include("../curl/amenazas/listar_eve_query.php"); ?>
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
		var categoria_regla1 = '';
		var moverfila_regla1 = 0;
		var movercosl_regla1 = 0;
		var realizado_regla2 = '';
		var suma_regla4 = 0;
		
		var PosicionInicialFils = 0;
		var PosicionInicialCols = 0;
		// Parametros a enviar para la matriz de control
		var moverbolita = "N";  //  Realizado S / N
		var moverfils = 0;      //  Categoria: Preventivo  mueve hacia Abajo
		var movercols = 0;		//  Categoria: Correctivo  mueve hacia Izquierda
		                        //  Categoria: Ambos       mueve hacia Abajo y a la Izquierda 
		var txtCat = "";
		var posicionesmover = 0;
		itemcontrol = 0;
		var valDoc = 0;
		var valApl = 0;
		var valEfe = 0;
		var valEva = 0;
		// Fin Parametros a enviar para la matriz de control
		
        function mks(p1,p2){
            //$.redirect("tareas.php", {id: p1, np : p2 });
		}		
		
		function fnCategoria(pValue){
			//alert('pValue....'+pValue.value);			
			var cadena = pValue.value;
			let posicion = cadena.indexOf('-');
			if (posicion !== -1){
				itemcontrol = cadena.substr(posicion+1) ;
			}
			////alert('itemcontrol...'+itemcontrol);
	
			// Para la Categoria
			txtCat = $("#ctrcategoria"+itemcontrol).children("option:selected").text();
			txtCat = txtCat.substr(0,1);
			
			moverfils = 0;
			movercols = 0;
			
			////alert('Categoria...'+txtCat);			
			if( txtCat == "P" ){  
				//alert('Cat:  mover Abajo');  
				movercols = 0;
				moverfils = 1;
			}
			else if( txtCat == "C" ){  
				//alert('Cat:  mover Izquierda');
				movercols = 1;
				moverfils = 0;
			}
			else { 
				//alert('Cat:  mover Abajo e Izquierda'); 
				movercols = 1;
				moverfils = 1;
			}
			
			//posicionesmover = 0;			
			let valorAplicado = <?php echo $ValorAplicado; ?>; //10
			let ValorEfectivo = <?php echo $ValorEfectivo; ?>; //10
			let sumaitems = valDoc + valApl + valEfe + valEva;
			
			if( valApl >= valorAplicado && valEfe >= ValorEfectivo ){				
				posicionesmover = 1;
				if( sumaitems >= <?php echo $Umbral; ?> ){
					posicionesmover = 2;
				}
			}
			else {
				posicionesmover = 0;
			}
			
			fnMatRiesgo(moverbolita,moverfils,movercols,posicionesmover,itemcontrol)
		}
		
		function fnRealizado(pValue){
			moverbolita = pValue.value;  // S o N
			itemcontrol = moverbolita.substr(2);
			////alert(itemcontrol);
			moverbolita = moverbolita.substr(0,1);			
			
			////alert('Categoria...'+txtCat);
			// Para la Categoria
			txtCat = $("#ctrcategoria"+itemcontrol).children("option:selected").text();
			txtCat = txtCat.substr(0,1);			
			if( txtCat == "P" ){  
				//alert('Cat:  mover Abajo');  
				movercols = 0;
				moverfils = 1;
			}
			else if( txtCat == "C" ){  
				//alert('Cat:  mover Izquierda');
				movercols = 1;
				moverfils = 0;
			}
			else { 
				//alert('Cat:  mover Abajo e Izquierda'); 
				movercols = 1;
				moverfils = 1;
			}
			
			let valorAplicado = <?php echo $ValorAplicado; ?>; //10
			let ValorEfectivo = <?php echo $ValorEfectivo; ?>; //10
			let sumaitems = valDoc + valApl + valEfe + valEva;
			
			if( valApl >= valorAplicado && valEfe >= ValorEfectivo ){				
				posicionesmover = 1;
				if( sumaitems >= <?php echo $Umbral; ?> ){
					posicionesmover = 2;
				}
			}
			else {
				posicionesmover = 0;
			}
			
			fnMatRiesgo(moverbolita,moverfils,movercols,posicionesmover,itemcontrol)
		}
		
		function fnRegla_3_4(parDoc, parApl, parEfe, parEva, parItemCtrl){
			valDoc = parDoc;
			if ( isNaN(valDoc) ){valDoc = 0;}
			//alert('valDoc...'+valDoc);
			valApl = parApl;
			if ( isNaN(valApl) ){valApl = 0;}
			//alert('valApl....'+valApl);
			valEfe = parEfe;
			if ( isNaN(valEfe) ){valEfe = 0;}
			//alert('valEfe....'+valEfe);
			valEva = parEva;
			if ( isNaN(valEva) ){valEva = 0;}
			//alert('valEva....'+valEva);
			let posicion = parItemCtrl.indexOf('-');
			if (posicion !== -1){
				itemcontrol = parItemCtrl.substr(posicion+1) ;
			}
			////alert('itemcontrol...'+itemcontrol);			
			// Para la Categoria
			txtCat = $("#ctrcategoria"+itemcontrol).children("option:selected").text();
			txtCat = txtCat.substr(0,1);
			//alert('Categoria en 3y4...'+txtCat);
			if( txtCat == "P" ){
				//alert('Cat:  mover Abajo');
				movercols = 0;
				moverfils = 1;
			}
			else if( txtCat == "C" ){
				//alert('Cat:  mover Izquierda');
				movercols = 1;
				moverfils = 0;
			}
			else { 
				//alert('Cat:  mover Abajo e Izquierda'); 
				movercols = 1;
				moverfils = 1;
			}
			
			//let posicionesmover = 0;
			let valorAplicado = <?php echo $ValorAplicado; ?>; //10
			let ValorEfectivo = <?php echo $ValorEfectivo; ?>; //10
			let sumaitems = valDoc + valApl + valEfe + valEva;
			
			if( valApl >= valorAplicado && valEfe >= ValorEfectivo ){				
				posicionesmover = 1;
				if( sumaitems >= <?php echo $Umbral; ?> ){
					posicionesmover = 2;
				}
			}
			else {
				posicionesmover = 0;
			}
			
			fnMatRiesgo(moverbolita,moverfils,movercols,posicionesmover,itemcontrol)
		}		
		
		function fnMatRiesgo(p1,p2,p3,p4,p5){
			var moverbolita = p1;
			var moverfils = p2;
			var movercols = p3;
			var posicionAmover = p4;
			itemcontrol = p5;
			var er = $("#hder").val();
			
			let paramet = "ck="+<?php echo $_SESSION['Keyp']; ?>+"&uk="+<?php echo $UserKey; ?>+"&er="+er+"&moverbol="+moverbolita+"&pmoverAbajo="+moverfils+"&pmoverIzquierda="+movercols+"&pposicionAmover="+posicionAmover+"&nrocontrol="+itemcontrol+"&ruta=../";
			////alert('params...'+paramet);
			$.ajax({
				async: false,
				type: "POST",
				url: "../curl/matriz/matrizcontrol.php",
				data: paramet,
				success: function(datos){
					posicionesmover =0 ;
					$("#matrizzControl").hide();
					$("#matrizz1Control").show();
					$("#matrizz1Control").html(datos);
					
					/* aki debo actualizar etiquetas para los labels de la MRC*/
					let parms = "ck="+<?php echo $_SESSION['Keyp']; ?>+"&uk="+<?php echo $UserKey; ?>+"&er="+er+"&nrocontrol="+itemcontrol+"&ruta=../";
					$.ajax({
						async: false,
						type: "POST",
						url: "../curl/matriz/label.php",
						data: parms,
						success: function(datos){
							let obj = JSON.parse(datos);
							let x = JSON.stringify(datos);
							x= x.substr(0,1);
							if( x != "R" ){
								$("#lblprob2").html(obj.body[0]['LBLProb']);
								$("#lblconsec2").html(obj.body[0]['LBLConsec']);
								$("#prob11").val(obj.body[0]['MOV_FilaMRC']);
								$("#consec11").val(obj.body[0]['MOV_ColumnaMRC']);
							}
						}
					})
				}
			})			
		}
		
		function fnControl(pinfprop,pinfejec,pinfefec,pinffrec,pParReg){
			//alert(pinfprop);
			let valinfprop = pinfprop;
			if ( isNaN(valinfprop) ){valinfprop = 0;}

			let valinfejec = pinfejec;
			if ( isNaN(valinfejec) ){valinfejec = 0;}

			let valpinfefec = pinfefec;
			if ( isNaN(valpinfefec) ){valpinfefec = 0;}

			let valpinffrec = pinffrec;
			if ( isNaN(valpinffrec) ){valpinffrec = 0;}
			
			let posicion = pParReg.indexOf('-');
			if (posicion !== -1){
				itemcontrol = pParReg.substr(posicion+1) ;
			}

			let er = $("#hder").val();			

			let paramet = "ck="+<?php echo $_SESSION['Keyp']; ?>+"&uk="+<?php echo $UserKey; ?>+"&prop="+valinfprop+"&ejec="+valinfejec+"&efec="+valpinfefec+"&frec="+valpinffrec+"&er="+er+"&nrocontrol="+itemcontrol;
			$.ajax({
				async: false,
				type: "POST",
				url: "../api/eventoriesgo/guardacontrol.php",
				data: paramet,
				success: function(datos){

				}
			})
		}
			
        $(document).ready(function(){
			$(".loader").fadeOut("slow")
			$("#zonadata").hide()
            $('.select2').select2()

			$("#matcon").hide()
			$('#clonmatriz').show()
			$("#zonadata").show()
			//$("#matrizcon").hide()

			$("#lblprob2").html("<?php echo $PRO_NombreC ;?>");
			$("#lblconsec2").html("<?php echo $CSC_NombreC; ?>");

			
            $('#exampleModal').on('show.bs.modal', function () {
                setTimeout(function (){
                    $('#PlanName2').focus()
                }, 500)
            })
			
			$("#eventoriesgo").on('change', function(){
				var er = $(this).val();
				var csc = $("#consecutivo").val();
				if (er != ""){
					$.ajax({
						type: "POST",
						url: "grabaerzero.php",
						data: {'csc': csc, 'er': er},
						success: function(datos){
							//alert(datos);
							////$("#hder").prop('value', datos);
						}
					})
					$("#zonadata").show()
				}
				else{
					$("#zonadata").hide()
				}
			})
			
			$("#matrizz1").hide();
			$("#matrizz1Control").hide();
			
			$("#prob1").on('change', function(){
				var txt = $(this).find('option:selected').val();
				var cols = $("#consec1").find('option:selected').val();
				var er = $("#hder").val();
				var afecta ="";
				
				$("#prob11").val(txt);
				$("#consec11").val(cols);				
				$("#prob11 option[value='']").remove();
				$("#prob1 option[value='']").remove();
				if( txt == "" ){
					$("#lblprob2").html();
				}
				else{
					$("#lblprob2").html( $(this).find('option:selected').text() );	
				}
				if( cols == ""){
					$("#lblconsec2").html();
				} 
				else{
					$("#lblconsec2").html( $("#consec1").find('option:selected').text() );
				}
				
				var params = "ck="+<?php echo $_SESSION['Keyp']; ?>+"&er="+er+"&ruta=../";
				$.ajax({
					async: false,
					type: "POST",
					url: "../curl/matriz/afecta.php",
					data: params,
					success: function(datos){
						//alert(datos);
						afecta = datos;
					}
				})
				
				if ( txt != "" && cols != "" ){	
					var paramet = "ck="+<?php echo $_SESSION['Keyp']; ?>+"&uk="+<?php echo $UserKey; ?>+"&er="+er+"&pfila="+txt+"&pcols="+cols+"&ruta=../";
					//alert(paramet);
					$.ajax({
						type: "POST",
						//url: "../curl/matriz/matriz.php",
						url: "../curl/matriz/matrizquery.php",
						data: paramet,
						success: function(datos){
							//alert(datos);
							$("#matrizz").hide();
							$("#matrizzControl").hide();
							$("#matrizz1").show();
							$("#matrizz1Control").show();
							$("#matrizz1").html(datos);
							//alert('afecta...'+afecta);
							if(afecta != "S"){
								$("#matrizz1Control").html(datos);							
							}
							else{
								paramet = "ck="+<?php echo $_SESSION['Keyp']; ?>+"&er="+er+"&ruta=../";
								$.ajax({
									type: "POST",
									url: "../curl/matriz/matriznewmrc.php",
									data: paramet,
									success: function(xdatos){
										$("#matrizz1Control").html(xdatos);
										
										/* aki debo actualizar etiquetas para los labels de la MRC*/
										let parms = "ck="+<?php echo $_SESSION['Keyp']; ?>+"&uk="+<?php echo $UserKey; ?>+"&er="+er+"&nrocontrol="+itemcontrol+"&ruta=../";
										$.ajax({
											async: false,
											type: "POST",
											url: "../curl/matriz/label.php",
											data: parms,
											success: function(datos){
												let obj = JSON.parse(datos);
												let x = JSON.stringify(datos);
												x= x.substr(0,1);
												if( x != "R" ){
													$("#lblprob2").html(obj.body[0]['LBLProb']);
													$("#lblconsec2").html(obj.body[0]['LBLConsec']);
													$("#prob11").val(obj.body[0]['MOV_FilaMRC']);
													$("#consec11").val(obj.body[0]['MOV_ColumnaMRC']);
												}
											}
										})
									}
								})
							}
						}
					})
				}
			})
			
			$("#consec1").on('change', function(){
				var txt = $(this).find('option:selected').val();
				var fila = $("#prob1").find('option:selected').val();
				var er = $("#hder").val();
				var afecta ="";
				$("#prob11").val(fila);
				$("#consec11").val(txt);
				$("#consec1 option[value='']").remove();
				$("#consec11 option[value='']").remove();
				if ( fila == "" ){
					$("#lblprob2").html();
				}
				else {
					$("#lblprob2").html( $("#prob1").find('option:selected').text() );	
				}
				
				if ( txt == "" ){
					$("#lblconsec2").html();
				}
				else {
					$("#lblconsec2").html( $(this).find('option:selected').text() );	
				}				

				var params = "ck="+<?php echo $_SESSION['Keyp']; ?>+"&er="+er+"&ruta=../";
				$.ajax({
					async: false,
					type: "POST",
					url: "../curl/matriz/afecta.php",
					data: params,
					success: function(datos){
						//alert(datos);
						afecta = datos;
					}
				})				
				
				if ( fila != "" && txt != ""){
					var paramet = "ck="+<?php echo $_SESSION['Keyp']; ?>+"&uk="+<?php echo $UserKey; ?>+"&er="+er+"&pfila="+fila+"&pcols="+txt+"&ruta=../";
					//alert(paramet);
					$.ajax({
						type: "POST",
						////url: "../curl/matriz/matriz.php",
						url: "../curl/matriz/matrizquery.php",
						data: paramet,
						success: function(datos){
							//alert(datos);
							$("#matrizz").hide();
							$("#matrizzControl").hide();
							$("#matrizz1").show();
							$("#matrizz1Control").show();
							$("#matrizz1").html(datos);
							if( afecta != "S"){
								$("#matrizz1Control").html(datos);
							}
							else{
								paramet = "ck="+<?php echo $_SESSION['Keyp']; ?>+"&er="+er+"&ruta=../";
								$.ajax({
									type: "POST",
									url: "../curl/matriz/matriznewmrc.php",
									data: paramet,
									success: function(xdatos){
										$("#matrizz1Control").html(xdatos);
										
										/* aki debo actualizar etiquetas para los labels de la MRC*/
										let parms = "ck="+<?php echo $_SESSION['Keyp']; ?>+"&uk="+<?php echo $UserKey; ?>+"&er="+er+"&nrocontrol="+itemcontrol+"&ruta=../";
										$.ajax({
											async: false,
											type: "POST",
											url: "../curl/matriz/label.php",
											data: parms,
											success: function(datos){
												let obj = JSON.parse(datos);
												let x = JSON.stringify(datos);
												x= x.substr(0,1);
												if( x != "R" ){
													$("#lblprob2").html(obj.body[0]['LBLProb']);
													$("#lblconsec2").html(obj.body[0]['LBLConsec']);
													$("#prob11").val(obj.body[0]['MOV_FilaMRC']);
													$("#consec11").val(obj.body[0]['MOV_ColumnaMRC']);
												}
											}
										})
									}
								})
							}
						}
					})
				}
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
				
				var mks = [];  // Array Ppal
				
				//alert('Nro EventoRiesgo...'+$("#hder").val());

				var nroeventoriesgo=[];
				tmp = {	'id' : $("#hder").val() }
				nroeventoriesgo.push(tmp)
				sof21 = {'IDE' : nroeventoriesgo }
				mks.push(sof21)
				
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
				window.location.href ="eventosriesgo.php";
            })

            $(".close").on('click', function(){
                location.reload();
            })
        })
    </script>
	
	<script> var global = { key: "<?php echo $CustomerKey; ?>" };</script>
	<script src="js/proceso.js"></script>
	<script src="js/cargo.js"></script>
	<script src="js/responsable.js"></script>
	<script src="js/tiporiesgo.js"></script>
	<script src="js/factorriesgo.js"></script>
	<script src="js/riesgoasociado.js"></script>
	<script src="js/causa.js"></script>
	<script src="js/consecuencia.js"></script>
	<script src="js/control.js"></script>
	<script src="js/tratamiento.js"></script>
	<script src="js/debilidad.js"></script>
	<script src="js/oportunidad.js"></script>
	<script src="js/fortaleza.js"></script>
	<script src="js/amenaza.js"></script>	
</body>
</html>