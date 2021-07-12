<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

include_once '../../config/dbx.php';
include_once '../../class/consecuencia/consecuencia.php';

$database = new Database();
$db = $database->getConnectionCli();
$item = new Consecuencia($db);

$Nombre = trim($_GET['Nombre']);
$Escala = trim($_GET['Escala']);
$Color = $_GET['Color'];
date_default_timezone_set("America/Bogota");
$CustomerKey = trim($_GET['CK']);  //$_SESSION['Keyp'];
$TipoRiesgoKey = time();
$UserKey = trim($_GET['UK']);  //$_SESSION['UserKey'];
$DateStamp = date("Y-m-d H:i:s");

$item->CSC_Nombre = $Nombre;
$item->CSC_Escala = $Escala;
$item->CSC_Color = $Color;
$item->CSC_CustomerKey = $CustomerKey;
$item->CSC_TipoRiesgoKey = $TipoRiesgoKey;
$item->CSC_UserKey = $UserKey;
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