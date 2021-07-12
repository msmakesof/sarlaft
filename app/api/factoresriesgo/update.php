<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

include_once '../../config/dbx.php';
include_once '../../class/factoresriesgo/factoresriesgo.php';

$database = new Database();
$db = $database->getConnectionCli();
$item = new FactoresRiesgo($db);

$data = $_GET['Id'];
$item->FAR_IdFactorRiesgo = $data; 

$Nombre = trim($_GET['Nombre']);

$item->FAR_Nombre = $Nombre;

if($item->updateFR())
{
	echo 'S'; 
} 
else
{
	echo 'N';
}
?>