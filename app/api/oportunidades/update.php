<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

include_once '../../config/dbx.php';
include_once '../../class/oportunidades/oportunidades.php';

$database = new Database();
$db = $database->getConnectionCli();
$item = new Oportunidades($db);

$data = $_GET['Id'];
$item->id = $data; 

$Nombre = trim($_GET['Nombre']);

$item->OportunidadesName = $Nombre;

if($item->update())
{
	echo 'S'; 
} 
else
{
	echo 'N';
}
?>