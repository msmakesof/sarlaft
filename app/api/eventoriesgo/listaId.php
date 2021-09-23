<?php
    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json; charset=UTF-8");
    
    include_once '../../config/dbx.php';
    include_once '../../class/eventoriesgo/eventosderiesgo.php';

    $database = new Database();
    $db = $database->getConnectionCLi();
    $items = new EventoRiesgo($db);
	
	$items->EVRI_CustomerKey = isset($_GET['ck']) ? $_GET['ck'] : die();	
    $stmt = $items->getAll();
    $itemCount = $stmt->rowCount();

    if($itemCount > 0){
        
        $estadoArr = array();
        $estadoArr["body"] = array();
        $estadoArr["itemCount"] = $itemCount;

        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
            extract($row);
            $e = array(
                "EVRI_Id" => $EVRI_Id,
                "EVRI_CustomerKey" => $EVRI_CustomerKey,
				"EVRI_Consecutivo" => $EVRI_Consecutivo,
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