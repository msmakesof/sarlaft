<?php
    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json; charset=UTF-8");
    header("Access-Control-Allow-Methods: POST");
    header("Access-Control-Max-Age: 3600");
    header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
    
    include_once '../../config/dbx.php';
    include_once '../../class/estado/estado.php';
    
    $database = new Database();
    $db = $database->getConnection();
    
    $item = new State($db);
	
	$data = $_GET['id'];
	$item->STA_IdEstado = $data; 
    
    if($item->deleteEstado()){
        echo "S";  //json_encode("Borra Estado.");
    } else{
        echo "N";  // json_encode("Estado no puede ser Borrado");
    }
?>