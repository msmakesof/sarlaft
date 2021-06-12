<?php
    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json; charset=UTF-8");
    header("Access-Control-Allow-Methods: POST");
    header("Access-Control-Max-Age: 3600");
    header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
    
    include_once '../../config/dbx.php';
    include_once '../../class/privilegio/privilegio.php';

    $database = new Database();
    $db = $database->getConnection();

	$items = new PermisosxRol($db);
	$items->PER_IdRol = isset($_GET['id']) ? $_GET['id'] : die();
	
	$stmt = $items->getPrivilegioxIdRol();
	$itemCount = $stmt->rowCount();
	if($itemCount > 0){        
        $estadoArr = array();
        $estadoArr["body"] = array();
        $estadoArr["itemCount"] = $itemCount;

        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
            extract($row);
            $e = array(
                "PER_IdPermisoxRol" => $PER_IdPermisoxRol,
				"PER_IdRol" => $PER_IdRol,
				"PER_IdMenu" => $PER_IdMenu,
				"PER_IdAccion" => $PER_IdAccion,
				"PER_UserKey" => $PER_UserKey,
            );
            array_push($estadoArr["body"], $e);
        }
        echo json_encode($estadoArr);
    }	
    else{
        http_response_code(404);
        echo json_encode(
            array("message" => "Registro No Encontrado.")
        );
    }
?>