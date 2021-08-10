<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

include_once '../../config/dbx.php';
include_once '../../class/calificacion/calificacion.php';

$database = new Database();
$db = $database->getConnectionCli();
$item = new Calificacion($db);

$Nombre = trim($_GET['Nombre']);
$RangoIni = trim($_GET['RangoIni']);
$RangoFin = trim($_GET['RangoFin']);
$Color = $_GET['Color'];
date_default_timezone_set("America/Bogota");
$CustomerKey = trim($_GET['CK']);  //$_SESSION['Keyp'];
$TipoRiesgoKey = time();
$UserKey = trim($_GET['UK']);  //$_SESSION['UserKey'];
$DateStamp = date("Y-m-d H:i:s");

$item->CAL_Nombre = $Nombre;
$item->CAL_RangoInicial = $RangoIni;
$item->CAL_RangoFinal = $RangoFin;
$item->CAL_Color = $Color;
$item->CAL_CustomerKey = $CustomerKey;
$item->CAL_CalificacionKey = $CalificacionKey;
$item->CAL_UserKey = $UserKey;
$item->CAL_DateStamp = $DateStamp;

if($item->create())
{
	echo 'S'; 
} 
else
{
	echo 'N';
}
?>