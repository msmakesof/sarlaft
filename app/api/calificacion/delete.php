<?php
    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json; charset=UTF-8");
    header("Access-Control-Allow-Methods: POST");
    header("Access-Control-Max-Age: 3600");
    header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
    
    include_once '../../config/dbx.php';
    include_once '../../class/consecuencia/consecuencia.php';
    
    $database = new Database();
    $db = $database->getConnectionCli();
    
    $item = new Consecuencia($db);
	
	$data = $_GET['id'];
	$item->CSC_IdConsecuencia = $data; 
    
    if($item->delete()){
        echo "S";  //json_encode("Borra Consecuencia.");
    } else{
        echo "N";  // json_encode("Consecuencia no puede ser Borrado");
    }
?>