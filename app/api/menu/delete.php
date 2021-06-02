<?php
    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json; charset=UTF-8");
    header("Access-Control-Allow-Methods: POST");
    header("Access-Control-Max-Age: 3600");
    header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
    
    include_once '../../config/dbx.php';
    include_once '../../class/menu/menu.php';
    
    $database = new Database();
    $db = $database->getConnection();
    
    $item = new OptionMenu($db);
	
	$data = $_GET['id'];
	$item->OPC_Id = $data; 
    
    if($item->deleteMenu()){
        echo "S";  //json_encode("Borra Menu.");
    } else{
        echo "N";  // json_encode("Menu no puede ser Borrado");
    }
?>