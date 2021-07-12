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

$item->PRO_Nombre = isset($_GET['nombre']) ? $_GET['nombre'] : die();
$item->PRO_IdProbabilidad = isset($_GET['id']) ? $_GET['id'] : die();

$item->getBuscaNombre();

if($item->PRO_Nombre != null){
	// create array
	$emp_arr = array(            
		"encontrados" => $item->PRO_Nombre
	);
  
	http_response_code(200);
	echo json_encode($emp_arr);
}      
else{
	http_response_code(404);
	echo json_encode("Nombre No Encontrado.");
}
?>