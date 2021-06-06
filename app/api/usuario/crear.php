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

$UsuarioCustomerKey = trim($_GET['UsuarioCustomerKey']);
$NombreUsuario = trim($_GET['NombreUsuario']);
$Email = trim($_GET['Email']);
$Password = trim($_GET['Password']);
$Estado = trim($_GET['Estado']);
//  Esto lo traigo tal como esta en el original
$UserColor='#1f77b4';
$UserTipo='A';
date_default_timezone_set("America/Bogota");
$UserKey=time();
$Salt=date("Y-m-d H:i:s");

$item->CustomerKey = $UsuarioCustomerKey;
$item->UserName = $NombreUsuario;
$item->UserEmail = $Email;
$item->Password = $Password;
$item->UserStatus = $Estado;
$item->UserColor = $UserColor;
$item->UserTipo = $UserTipo;
$item->UserKey = $UserKey;
$item->Salt = $Salt;

if($item->createUsuario())
{
	echo 'S'; 
} 
else
{
	echo 'N';
}
?>