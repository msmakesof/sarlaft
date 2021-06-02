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
	
	$item->UserKey = isset($_GET['userkey']) ? $_GET['userkey'] : die();
	
	$item->getUserKey();

    if($item->UserName != null){
        // create array
        $emp_arr = array(
			"id" => $item->id,
			"UserKey" => $item->UserKey,
			"IdUser" => $item->IdUser,
			"CustomerKey" => $item->CustomerKey,
            "UserKey" => $item->UserKey,
			"UserEmail" => $item->UserEmail,
			"UserName" => $item->UserName,
			"UserTipo" => $item->UserTipo,
			"UserStatus" => $item->UserStatus,
			"Password" => $item->Password,
			"Salt" => $item->Salt,
			"UserColor" => $item->UserColor
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