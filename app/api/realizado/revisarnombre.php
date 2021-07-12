<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

include_once '../../config/dbx.php';
include_once '../../class/realizado/realizado.php';

$database = new Database();
$db = $database->getConnectionCli();
$item = new Realizado($db);

$item->REA_Nombre = isset($_GET['nombre']) ? $_GET['nombre'] : die();
$item->REA_IdRealizado = isset($_GET['id']) ? $_GET['id'] : die();

$item->getBuscaNombre();

if($item->REA_Nombre != null){
	// create array
	$emp_arr = array(            
		"encontrados" => $item->REA_Nombre
	);
  
	http_response_code(200);
	echo json_encode($emp_arr);
}      
else{
	http_response_code(404);
	echo json_encode("Nombre No Encontrado.");
}
?>