<?php
    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json; charset=UTF-8");
    header("Access-Control-Allow-Methods: POST");
    header("Access-Control-Max-Age: 3600");
    header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
    
    include_once '../../config/dbx.php';
    include_once '../../class/plan/plan.php';

    $database = new Database();
    $db = $database->getConnectionCli();
    $item = new PlanesSarlaft($db);
	
	$item->id = isset($_GET['id']) ? $_GET['id'] : die();
    $item->ck = isset($_GET['ck']) ? $_GET['ck'] : die();
	
	$item->getIdPlan();

    if($item->PlanesName != null){
        // create array
        $emp_arr = array(
			"id" => $item->id,
			"PlanesName" => $item->PlanesName,
		);            
		http_response_code(200);
        echo json_encode($emp_arr);
    }
    else{
        http_response_code(404);
        echo json_encode(
            array("message" => "Registro No Encontrado.")
        );
    }
?>