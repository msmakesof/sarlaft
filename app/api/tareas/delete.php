<?php
    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json; charset=UTF-8");
    header("Access-Control-Allow-Methods: POST");
    header("Access-Control-Max-Age: 3600");
    header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
    
    include_once '../../config/dbx.php';
    include_once '../../class/plan/tarea.php';
    
    $database = new Database();
    $db = $database->getConnectionCli();
    
    $item = new TareasPlan($db);
	
	$data = $_GET['id'];
	$ck = $_GET['ck'];
	$idplan = $_GET['idplan'];
	$item->TPP_IdTareaxPlan = $data;
	$item->TPP_CustomerKey = $ck;
	$item->TPP_IdPlan = $idplan;
    
    if($item->delete()){
        echo "S";  //json_encode("Borra Tarea.");
    } else{
        echo "N";  // json_encode("Tarea no puede ser Borrado");
    }
?>