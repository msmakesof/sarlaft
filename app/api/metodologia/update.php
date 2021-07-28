<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

include_once '../../config/dbx.php';
include_once '../../class/metodologia/metodologia.php';

$database = new Database();
$db = $database->getConnectionCli();
$item = new Metodologia($db);

$data = $_GET['Id'];
$item->MET_IdMetodologia = $data; 

$Nombre = trim($_GET['Nombre']);
$FactorRiesgo = trim($_GET['FactorRiesgo']);
$Descripcion = trim($_GET['Descripcion']);
$Observaciones = trim($_GET['Observaciones']);

$item->MET_Nombre = $Nombre;
$item->MET_FactorRiesgo = $FactorRiesgo;
$item->MET_Descripcion = $Descripcion;
$item->MET_Observaciones = $Observaciones;

if($item->update())
{
	echo 'S'; 
} 
else
{
	echo 'N';
}
?>