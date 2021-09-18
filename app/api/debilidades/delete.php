<?php
    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json; charset=UTF-8");
    header("Access-Control-Allow-Methods: POST");
    header("Access-Control-Max-Age: 3600");
    header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
    
    include_once '../../config/dbx.php';
    include_once '../../class/debilidades/debilidades.php';
    
    $database = new Database();
	$db = $database->getConnectionCli();
	$item = new Debilidades($db);
	
	$data = $_GET['id'];
	$item->id = $data; 
    
    if($item->delete()){
        echo "B";  //json_encode("Borra Debilidades.");
    } else{
        echo "N";  // json_encode("Debilidades no puede ser Borrado");
    }
?>