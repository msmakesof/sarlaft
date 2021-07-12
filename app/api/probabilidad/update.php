<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

include_once '../../config/dbx.php';
include_once '../../class/probabilidad/probabilidad.php';

$database = new Database();
$db = $database->getConnectionCli();
$item = new Probabilidad($db);

$data = $_GET['Id'];
$item->PRO_IdProbabilidad = $data; 

$Nombre = trim($_GET['Nombre']);
$Escala = trim($_GET['Escala']);
$Color = trim($_GET['Color']);

$item->PRO_Nombre = $Nombre;
$item->PRO_Escala = $Escala;
$item->PRO_Color = $Color;

if($item->update())
{
	echo 'S'; 
} 
else
{
	echo 'N';
}
?>