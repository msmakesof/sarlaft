<?php
    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json; charset=UTF-8");
    header("Access-Control-Allow-Methods: POST");
    header("Access-Control-Max-Age: 3600");
    header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
    
    include_once '../../config/dbx.php';
    include_once '../../class/perfil/perfil.php';
    
    $database = new Database();
    $db = $database->getConnection();
    
    $item = new ProfileUsers($db);
	
	$data = $_GET['id'];
	$item->IdPerfil = $data; 
    
    if($item->deletePerfil()){
        echo "S";  //json_encode("Borra Cliente.");
    } else{
        echo "N";  // json_encode("Cliente no puede ser Borrado");
    }
?>