<?php
    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json; charset=UTF-8");
    header("Access-Control-Allow-Methods: POST");
    header("Access-Control-Max-Age: 3600");
    header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
    
    include_once '../../config/dbx.php';
    include_once '../../class/usuario/usuario.php';
    
    $database = new Database();
    $db = $database->getConnection();
    
    $item = new UsersAuth($db);
	
	$data = $_GET['id'];
	$item->id = $data; 
    
    if($item->deleteUsuario()){
        echo "S";  //json_encode("Borra usuario.");
    } else{
        echo "N";  // json_encode("usuario no puede ser Borrado");
    }
?>