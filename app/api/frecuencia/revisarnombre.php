<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

include_once '../../config/dbx.php';
include_once '../../class/frecuencia/frecuencia.php';

$database = new Database();
$db = $database->getConnectionCli();
$item = new Frecuencia($db);

$item->FRE_Nombre = isset($_GET['nombre']) ? $_GET['nombre'] : die();
$item->FRE_CustomerKey = isset($_GET['ck']) ? $_GET['ck'] : die();
$item->FRE_IdFrecuencia = isset($_GET['id']) ? $_GET['id'] : die();

$item->getBuscaNombre();

if($item->FRE_Nombre != null){
	// create array
	$emp_arr = array(            
		"encontrados" => $item->FRE_Nombre
	);
  
	http_response_code(200);
	echo json_encode($emp_arr);
}      
else{
	http_response_code(404);
	echo json_encode("Nombre No Encontrado.");
}
?>