<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

include_once '../../config/dbx.php';
include_once '../../class/debilidades/debilidades.php';

$database = new Database();
$db = $database->getConnectionCli();
$item = new Debilidades($db);

date_default_timezone_set("America/Bogota");		
$dk=time();
$ds=date("Y-m-d H:i:s");
$Nombre = trim($_GET['Nombre']);
$ck = trim($_GET['ck']);
$uk = trim($_GET['uk']);
//$dk = trim($_GET['dk']);
//$ds = trim($_GET['ds']);

$item->DebilidadesName = $Nombre;
$item->CustomerKey = $ck;
$item->UserKey = $uk;
$item->DebilidadesKey = $dk;
$item->DateStamp = $ds;

if($item->create())
{
	echo 'S'; 
} 
else
{
	echo 'N';
}
?>