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

$data = $_GET['Id'];
$item->id = $data; 

$DebilidadesName = trim($_GET['Nombre']);
$ck = trim($_GET['ck']);

$item->DebilidadesName = $DebilidadesName;
$item->CustomerKey = $ck;

if($item->update())
{
	echo 'U'; 
} 
else
{
	echo 'N';
}
?>