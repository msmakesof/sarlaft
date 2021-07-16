<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

include_once '../../config/dbx.php';
include_once '../../class/plan/plan.php';

$database = new Database();
$db = $database->getConnectionCli();
$item = new Planes($db);

date_default_timezone_set("America/Bogota");
$pk=time();
$Nombre = trim($_GET['Nombre']);
$responsable = trim($_GET['responsable']);
$plazo = trim($_GET['plazo']);
$aprueba = trim($_GET['aprueba']);
$respseguimiento = trim($_GET['respseguimiento']);
$nivelprioridad = trim($_GET['nivelprioridad']);
$respaprobacion = trim($_GET['respaprobacion']);
$fechainicio = trim($_GET['fechainicio']);
$fechaseguimiento = trim($_GET['fechaseguimiento']);
$fechaterminacion = trim($_GET['fechaterminacion']);
$avance = trim($_GET['avance']);
$ck = trim($_GET['ck']);
$uk = trim($_GET['uk']);
$status= 1;
$DateStamp=date("Y-m-d H:i:s");

$item->PlanesKey = $pk;
$item->PlanesName = $Nombre;
$item->PlanesResponsable = $responsable;
$item->PlanesPlazo = $plazo;
$item->PlanesAprueba = $aprueba;
$item->PlanesRespSeguimiento = $respseguimiento;
$item->PlanesNivelPrioridad = $nivelprioridad;
$item->PlanesRespAprobacion = $respaprobacion;
$item->PlanesFInicio = $fechainicio;
$item->PlanesFSeguimiento = $fechaseguimiento;
$item->PlanesFTerminacion = $fechaterminacion;
$item->PlanesAvance = $avance;
$item->CustomerKey = $ck;
$item->UserKey = $uk;
$item->PlanesStatus = $status;
$item->DateStamp = $DateStamp;

if($item->create())
{
	echo 'S'; 
} 
else
{
	echo 'N';
}
?>