<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

include_once '../../config/dbx.php';
include_once '../../class/usuario/usuario.php';

$database = new Database();
$db = $database->getConnection();
$item = new UsersAuth($db);

$data = $_GET['Id'];
$item->id = $data; 

$CustomerKey = trim($_GET['CustomerKey']);
$NombreUsuario = trim($_GET['NombreUsuario']);
$Email = trim($_GET['Email']);
$Password = trim($_GET['Password']);
$IdRol = trim($_GET['IdRol']);
$Estado = trim($_GET['Estado']);

$item->CustomerKey = $CustomerKey;
$item->UserName = $NombreUsuario;
$item->UserEmail = $Email;
$item->Password = $Password;
$item->IdRol = $IdRol;
$item->UserStatus = $Estado;

if($item->updateUsuario())
{
	echo 'S'; 
} 
else
{
	echo 'N';
}
?>