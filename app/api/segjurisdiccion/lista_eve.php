<?php
    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json; charset=UTF-8");
    
    include_once '../../config/dbx.php';
    include_once '../../class/segjurisdiccion/segjurisdiccion.php';

    $database = new Database();
    $db = $database->getConnectionCLi();
    $items = new SegJurisdiccion($db);
	
	$items->CustomerKey = isset($_GET['ck']) ? $_GET['ck'] : die();
    $stmt = $items->getCkAll();
    $itemCount = $stmt->rowCount();

    if($itemCount > 0){
        
        $estadoArr = array();
        $estadoArr["body"] = array();
        $estadoArr["itemCount"] = $itemCount;

        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
            extract($row);
            $e = array(
                "id" => $id,
                "SegJurisdiccionName" => $SegJurisdiccionName,
				"CustomerKey" => $CustomerKey,
                "SegJurisdiccionKey" => $SegJurisdiccionKey,
                "UserKey" => $UserKey
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