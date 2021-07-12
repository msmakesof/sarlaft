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
	
	$data = $_GET['id'];
	$item->REA_IdRealizado = $data; 
    
    if($item->delete()){
        echo "S";  //json_encode("Borra Realizado.");
    } else{
        echo "N";  // json_encode("Realizado no puede ser Borrado");
    }
?>