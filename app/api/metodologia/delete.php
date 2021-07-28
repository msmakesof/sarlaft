<?php
    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json; charset=UTF-8");
    header("Access-Control-Allow-Methods: POST");
    header("Access-Control-Max-Age: 3600");
    header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
    
    include_once '../../config/dbx.php';
    include_once '../../class/metodologia/metodologia.php';
    
    $database = new Database();
    $db = $database->getConnectionCli();
    
    $item = new Metodologia($db);
	
	$data = $_GET['id'];
	$item->MET_IdMetodologia = $data; 
    
    if($item->delete()){
        echo "S";  //json_encode("Borra Metodologia.");
    } else{
        echo "N";  // json_encode("Metodologia no puede ser Borrado");
    }
?>