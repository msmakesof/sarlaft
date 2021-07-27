<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

include_once '../../config/dbx.php';
include_once '../../class/procesos/procesos.php';

$database = new Database();
$db = $database->getConnectionCli();
$item = new Procesos($db);

$ProcesosName = trim($_GET['NombreAccion']);
//$Estado = trim($_GET['Estado']);

$item->ProcesosName = $ProcesosName;
//$item->ACC_IdEstado = $Estado;

if($item->create())
{
	echo 'S'; 
} 
else
{
	echo 'N';
}
?>