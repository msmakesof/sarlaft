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

    $items = new UsersAuth($db);	
	$items->UserEmail = isset($_GET['email']) ? $_GET['email'] : die();
	$items->Password = isset($_GET['passw']) ? $_GET['passw'] : die();
	
	$stmt = $items->getBuscar();
    $itemCount = $stmt->RowCount();
    
    if($itemCount > 0){
        
        $estadoArr = array();
        $estadoArr["body"] = array();
        $estadoArr["itemCount"] = $itemCount;
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
            extract($row);
            $e = array(
                "UserKey" => $UserKey,
                "CustomerKey" => $CustomerKey,
                "UserEmail" => $UserEmail,
                "UserName" => $UserName,
                "UserTipo" => $UserTipo,
                "Password" => $Password,
                "UserStatus" => $UserStatus
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