<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

include_once '../../config/dbx.php';
include_once '../../class/rol/rol.php';

$database = new Database();
$db = $database->getConnection();
$item = new RolUsers($db);

$RolNombre = trim($_GET['RolNombre']);
$Estado = trim($_GET['Estado']);

$item->RolNombre = $RolNombre;
$item->IdEstado = $Estado;

if($item->createRol())
{
	echo 'S'; 
} 
else
{
	echo 'N';
}
?>