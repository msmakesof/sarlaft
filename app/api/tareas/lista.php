<?php
    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json; charset=UTF-8");
    
    include_once '../../config/dbx.php';
    include_once '../../class/tiposriesgo/tiposriesgo.php';

    $database = new Database();
    $db = $database->getConnectionCLi();

    $items = new TiposRiesgo($db);

    $stmt = $items->getAll();
    $itemCount = $stmt->rowCount();

    if($itemCount > 0){
        
        $estadoArr = array();
        $estadoArr["body"] = array();
        $estadoArr["itemCount"] = $itemCount;

        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
            extract($row);
            $e = array(
                "TIR_IdTipoRiesgo" => $TIR_IdTipoRiesgo,
                "TIR_Nombre" => $TIR_Nombre,
				"TIR_CustomerKey" => $TIR_CustomerKey,
                "TIR_UserKey" => $TIR_UserKey,
                "TIR_TipoRiesgoKey" => $TIR_TipoRiesgoKey
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