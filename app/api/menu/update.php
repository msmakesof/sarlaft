<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

include_once '../../config/dbx.php';
include_once '../../class/menu/menu.php';

$database = new Database();
$db = $database->getConnection();
$item = new OptionMenu($db);

$data = $_GET['Id'];
$item->OPC_Id = $data; 

$NombreMenu = trim($_GET['NombreMenu']);
$Estado = trim($_GET['Estado']);

$item->OPC_Nombre = $NombreMenu;
$item->OPC_IdEstado = $Estado;

if($item->updateMenu())
{
	echo 'S'; 
} 
else
{
	echo 'N';
}
?>