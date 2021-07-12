<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

include_once '../../config/dbx.php';
include_once '../../class/rcontrol/control.php';

$database = new Database();
$db = $database->getConnectionCli();
$item = new Control($db);

$data = $_GET['Id'];
$item->CON_IdControl = $data; 

$Nombre = trim($_GET['Nombre']);

$item->CON_Nombre = $Nombre;

if($item->updateControl())
{
	echo 'S'; 
} 
else
{
	echo 'N';
}
?>