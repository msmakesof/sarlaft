<?php
    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json; charset=UTF-8");
    header("Access-Control-Allow-Methods: POST");
    header("Access-Control-Max-Age: 3600");
    header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
    
    include_once '../../config/dbx.php';
    include_once '../../class/calificacion/calificacion.php';
    
    $database = new Database();
    $db = $database->getConnectionCli();
    
    $item = new Calificacion($db);
	
	$data = $_GET['id'];
	$item->CAL_IdCalificacion = $data; 
    
    if($item->delete()){
        echo "S";  //json_encode("Borra Calificacion.");
    } else{
        echo "N";  // json_encode("Calificacion no puede ser Borrado");
    }
?>