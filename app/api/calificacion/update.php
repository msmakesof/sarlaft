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

$data = $_GET['Id'];
$item->CAL_IdCalificacion = $data; 

$Nombre = trim($_GET['Nombre']);
$RangoIni = trim($_GET['RangoIni']);
$RangoFin = trim($_GET['RangoFin']);
$Color = trim($_GET['Color']);

$item->CAL_Nombre = $Nombre;
$item->CAL_RangoInicial = $RangoIni;
$item->CAL_RangoFinal = $RangoFin;
$item->CAL_Color = $Color;

if($item->update())
{
	echo 'S'; 
} 
else
{
	echo 'N';
}
?>