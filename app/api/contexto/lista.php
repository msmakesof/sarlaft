<?php
    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json; charset=UTF-8");
    
    include_once '../../config/dbx.php';
    include_once '../../class/contexto/contexto.php';

    $database = new Database();
    $db = $database->getConnectionCLi();

    $items = new Contexto($db);
    $items->CLI_CustomerKey = isset($_GET['ck']) ? $_GET['ck'] : die();
    //$stmt = $items->getCkAll();
    $stmt = $items->getAll();
    $itemCount = $stmt->rowCount();

    if($itemCount > 0){
        
        $estadoArr = array();
        $estadoArr["body"] = array();
        $estadoArr["itemCount"] = $itemCount;

        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
            extract($row);
            $e = array(
                "CTX_IdContexto" => $CTX_IdContexto,
                "CTX_Interno" => $CTX_Interno,
				"CTX_Externo" => $CTX_Externo,
                "CTX_CustomerKey" => $CTX_CustomerKey,
                "CTX_USerKey" => $CTX_USerKey
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