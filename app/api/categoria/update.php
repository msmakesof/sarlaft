<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

include_once '../../config/dbx.php';
include_once '../../class/categoria/categoria.php';

$database = new Database();
$db = $database->getConnectionCli();
$item = new Categoria($db);

$data = $_GET['Id'];
$item->CAT_IdCategoria = $data; 

$Nombre = trim($_GET['Nombre']);

$item->CAT_Nombre = $Nombre;

if($item->update())
{
	echo 'S'; 
} 
else
{
	echo 'N';
}
?>