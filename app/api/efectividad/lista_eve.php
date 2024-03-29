<?php
    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json; charset=UTF-8");
    
    include_once '../../config/dbx.php';
    include_once '../../class/efectividad/efectividad.php';

    $database = new Database();
    $db = $database->getConnectionCLi();
    $items = new Efectividad($db);
	
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
                "EFE_IdEfectividad" => $EFE_IdEfectividad,
                "EFE_Nombre" => $EFE_Nombre,
				"EFE_CustomerKey" => $EFE_CustomerKey,
				"EFE_TipoRiesgoKey" => $EFE_TipoRiesgoKey,
                "EFE_UserKey" => $EFE_UserKey,
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