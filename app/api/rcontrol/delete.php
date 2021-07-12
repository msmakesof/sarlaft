<?php
    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json; charset=UTF-8");
    header("Access-Control-Allow-Methods: POST");
    header("Access-Control-Max-Age: 3600");
    header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
    
    include_once '../../config/dbx.php';
    include_once '../../class/rcontrol/control.php';
    
    $database = new Database();
    $db = $database->getConnectionCli();
    
    $item = new Control($db);
	
	$data = $_GET['id'];
	$item->CON_IdControl = $data; 
    
    if($item->deleteControl()){
        echo "S";  //json_encode("Borra Tipo Riesgo.");
    } else{
        echo "N";  // json_encode("Tipo Riesgo no puede ser Borrado");
    }
?>