<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

include_once '../../config/dbx.php';
include_once '../../class/titulo/titulo.php';

$database = new Database();
$db = $database->getConnectionCli();
$item = new Titulo($db);

$data = $_GET['Id'];
$item->TIT_IdTitulo = $data; 

$Nombre = trim($_GET['Nombre']);
$CustomerKey = trim($_GET['CK']);

$item->TIT_Nombre = $Nombre;
$item->TIT_CustomerKey = $CustomerKey;

if($item->update())
{
	echo 'S'; 
} 
else
{
	echo 'N';
}
?>