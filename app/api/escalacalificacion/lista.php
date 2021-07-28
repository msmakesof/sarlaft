<?php
    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json; charset=UTF-8");
    
    include_once '../../config/dbx.php';
    include_once '../../class/escalacalificacion/escalacalificacion.php';

    $database = new Database();
    $db = $database->getConnectionCLi();

    $items = new EscalaCalificacion($db);

    $stmt = $items->getAll();
    $itemCount = $stmt->rowCount();

    if($itemCount > 0){
        
        $estadoArr = array();
        $estadoArr["body"] = array();
        $estadoArr["itemCount"] = $itemCount;

        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
            extract($row);
            $e = array(
                "ESC_IdEscalaCalificacion" => $ESC_IdEscalaCalificacion,
                "ESC_Valor" => $ESC_Valor,
				"ESC_CustomerKey" => $ESC_CustomerKey,
                "ESC_EscalaKey" => $ESC_EscalaKey,
                "ESC_UserKey" => $ESC_UserKey
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