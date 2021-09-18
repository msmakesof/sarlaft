<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

include_once '../../config/dbx.php';
include_once '../../class/infobasica/infobasica.php';

$database = new Database();
$db = $database->getConnectionCli();
$item = new Infobasica($db);

$item->CLI_ActividadEconomica = isset($_GET['nombre']) ? $_GET['nombre'] : die();
$item->CLI_Mision = isset($_GET['Mision']) ? $_GET['Mision'] : die();
$item->CLI_Vision = isset($_GET['Vision']) ? $_GET['Vision'] : die();
$item->CLI_IdInfoBasica = isset($_GET['id']) ? $_GET['id'] : die();
$item->CI_CustomerKey = isset($_GET['ck']) ? $_GET['ck'] : die();

$item->getBuscaNombre();

if($item->CLI_ActividadEconomica != null){
	// create array
	$emp_arr = array(            
		"encontrados" => $item->CLI_ActividadEconomica
	);
  
	http_response_code(200);
	echo json_encode($emp_arr);
}      
else{
	http_response_code(404);
	echo json_encode("Nombre No Encontrado.");
}
?>