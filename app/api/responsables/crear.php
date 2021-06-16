<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

include_once '../../config/dbx.php';
include_once '../../class/accion/accion.php';

$database = new Database();
$db = $database->getConnection();
$item = new Action($db);

$NombreAccion = trim($_GET['NombreAccion']);
$Estado = trim($_GET['Estado']);

$item->ACC_Nombre = $NombreAccion;
$item->ACC_IdEstado = $Estado;

if($item->createAccion())
{
	echo 'S'; 
} 
else
{
	echo 'N';
}
?>