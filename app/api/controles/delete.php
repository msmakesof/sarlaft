<?php
    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json; charset=UTF-8");
    header("Access-Control-Allow-Methods: POST");
    header("Access-Control-Max-Age: 3600");
    header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
    
    include_once '../../config/dbx.php';
    include_once '../../class/accion/accion.php';
    
    $database = new Database();
    $db = $database->getConnection();
    
    $item = new Action($db);
	
	$data = $_GET['id'];
	$item->ACC_IdAccion = $data; 
    
    if($item->deleteAccion()){
        echo "S";  //json_encode("Borra Accion.");
    } else{
        echo "N";  // json_encode("Accion no puede ser Borrado");
    }
?>