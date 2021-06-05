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
	
	$item->UserEmail = isset($_GET['email']) ? $_GET['email'] : die();
	$item->Password = isset($_GET['passw']) ? $_GET['passw'] : die();
	
	$item->getBuscar();

    if($item->UserName != null){
        // create array		
        $emp_arr = array(
			"totregs" => $item->totregs,
			"UserKey" => $item->UserKey,			
			"CustomerKey" => $item->CustomerKey,            
			"UserEmail" => $item->UserEmail,
			"UserName" => $item->UserName,
			"UserTipo" => $item->UserTipo,
			"UserStatus" => $item->UserStatus
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