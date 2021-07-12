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

$data = $_GET['Id'];
$item->CSC_IdConsecuencia = $data; 

$Nombre = trim($_GET['Nombre']);
$Escala = trim($_GET['Escala']);
$Color = trim($_GET['Color']);

$item->CSC_Nombre = $Nombre;
$item->CSC_Escala = $Escala;
$item->CSC_Color = $Color;

if($item->update())
{
	echo 'S'; 
} 
else
{
	echo 'N';
}
?>