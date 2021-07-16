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

$Nombre = trim($_GET['Nombre']);
date_default_timezone_set("America/Bogota");
$CustomerKey = trim($_GET['CK']);  //$_SESSION['Keyp'];
$UserKey = trim($_GET['UK']);  //$_SESSION['UserKey'];
$IdPlan = trim($_GET['IdPlan']);
$TareasKey = time();
$DateStamp = date("Y-m-d H:i:s");

$item->TPP_NombreTarea = $Nombre;
$item->TPP_CustomerKey = $CustomerKey;
$item->TPP_UserKey = $UserKey;
$item->TPP_IdPlan = $IdPlan;
$item->TPP_TareasKey = $TareasKey;
$item->DateStamp = $DateStamp;

if($item->create())
{
	echo 'S'; 
} 
else
{
	echo 'N';
}
?>