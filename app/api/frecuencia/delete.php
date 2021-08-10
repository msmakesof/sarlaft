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
	
	$data = $_GET['id'];
	$item->FRE_IdFrecuencia = $data; 
    
    if($item->delete()){
        echo "S";  //json_encode("Borra Frecuencia.");
    } else{
        echo "N";  // json_encode("Frecuencia no puede ser Borrado");
    }
?>