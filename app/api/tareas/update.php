<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

include_once '../../config/dbx.php';
include_once '../../class/plan/tarea.php';

$database = new Database();
$db = $database->getConnectionCli();
$item = new TareasPlan($db);

$data = $_GET['Id'];
$item->TPP_IdTareaxPlan = $data; 

$Nombre = trim($_GET['Nombre']);
$ck = trim($_GET['CK']);
$idplan = trim($_GET['IdPlan']);

$item->TPP_NombreTarea = $Nombre;
$item->TPP_CustomerKey = $ck;
$item->TPP_IdPlan = $idplan;

if($item->update())
{
	echo 'S'; 
} 
else
{
	echo 'N';
}
?>