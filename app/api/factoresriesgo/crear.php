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

$Nombre = trim($_GET['Nombre']);
date_default_timezone_set("America/Bogota");
$CustomerKey = trim($_GET['CK']); //$_SESSION['Keyp'];
$FactorRiesgoKey = time();
$UserKey = trim($_GET['UK']); //$_SESSION['UserKey'];
$DateStamp = date("Y-m-d H:i:s");

$item->FAR_Nombre = $Nombre;
$item->FAR_CustomerKey = $CustomerKey;
$item->FAR_FactorRiesgoKey = $FactorRiesgoKey;
$item->FAR_UserKey = $UserKey;
$item->DateStamp = $DateStamp;

if($item->createFR())
{
	echo 'S'; 
} 
else
{
	echo 'N';
}
?>