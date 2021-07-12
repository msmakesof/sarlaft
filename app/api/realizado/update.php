<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

include_once '../../config/dbx.php';
include_once '../../class/realizado/realizado.php';

$database = new Database();
$db = $database->getConnectionCli();
$item = new Realizado($db);

$data = $_GET['Id'];
$item->REA_IdRealizado = $data; 

$Nombre = trim($_GET['Nombre']);

$item->REA_Nombre = $Nombre;

if($item->update())
{
	echo 'S'; 
} 
else
{
	echo 'N';
}
?>