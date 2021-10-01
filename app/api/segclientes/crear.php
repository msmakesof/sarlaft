<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

include_once '../../config/dbx.php';
include_once '../../class/segclientes/segclientes.php';

$database = new Database();
$db = $database->getConnection();
$item = new SegClientes($db);

$SegClientesName = trim($_GET['SegClientesName']);
//$Estado = trim($_GET['Estado']);

$item->SegClientesName = $SegClientesName;
//$item->IdEstado = $Estado;

if($item->create())
{
	echo 'S'; 
} 
else
{
	echo 'N';
}
?>