<?php
    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json; charset=UTF-8");
    
    include_once '../../config/dbx.php';
    include_once '../../class/factoresriesgo/factoresriesgo.php';

    $database = new Database();
    $db = $database->getConnectionCLi();

    $items = new FactoresRiesgo($db);
    $items->FAR_CustomerKey = isset($_GET['ck']) ? $_GET['ck'] : die();

    $stmt = $items->getCkAll();
    $itemCount = $stmt->rowCount();

    if($itemCount > 0){
        
        $estadoArr = array();
        $estadoArr["body"] = array();
        $estadoArr["itemCount"] = $itemCount;

        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
            extract($row);
            $e = array(
                "FAR_IdFactorRiesgo" => $FAR_IdFactorRiesgo,
                "FAR_Nombre" => $FAR_Nombre,
				"FAR_CustomerKey" => $FAR_CustomerKey,
                "FAR_UserKey" => $FAR_UserKey,
                "FAR_FactorRiesgoKey" => $FAR_FactorRiesgoKey
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