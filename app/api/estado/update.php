<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

include_once '../../config/dbx.php';
include_once '../../class/estado/estado.php';

$database = new Database();
$db = $database->getConnection();
$item = new State($db);

$data = $_GET['Id'];
$item->STA_IdEstado = $data; 

$NombreEstado = trim($_GET['NombreEstado']);

$item->STA_Nombre = $NombreEstado;

if($item->updateEstado())
{
	echo 'S'; 
} 
else
{
	echo 'N';
}
?>