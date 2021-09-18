<?php
    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json; charset=UTF-8");
    header("Access-Control-Allow-Methods: POST");
    header("Access-Control-Max-Age: 3600");
    header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
    
    include_once '../../config/dbx.php';
    include_once '../../class/fortalezas/fortalezas.php';
    
    $database = new Database();
    $db = $database->getConnectionCli();
    
    $item = new Fortalezas($db);
	
	$data = $_GET['id'];
	$item->id = $data; 
    
    if($item->delete()){
        echo "S";  //json_encode("Borra Fortalezas.");
    } else{
        echo "N";  // json_encode("Fortalezas no puede ser Borrado");
    }
?>