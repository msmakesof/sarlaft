<?php
    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json; charset=UTF-8");
    
    include_once '../../config/dbx.php';
    include_once '../../class/realizado/realizado.php';

    $database = new Database();
    $db = $database->getConnectionCLi();

    $items = new Realizado($db);

    $stmt = $items->getAll();
    $itemCount = $stmt->rowCount();

    if($itemCount > 0){
        
        $estadoArr = array();
        $estadoArr["body"] = array();
        $estadoArr["itemCount"] = $itemCount;

        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
            extract($row);
            $e = array(
                "REA_IdRealizado" => $REA_IdRealizado,
                "REA_Nombre" => $REA_Nombre,
				"REA_CustomerKey" => $REA_CustomerKey,
                "REA_UserKey" => $REA_UserKey,
                "REA_TipoRiesgoKey" => $REA_TipoRiesgoKey
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