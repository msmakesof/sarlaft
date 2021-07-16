<?php
    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json; charset=UTF-8");
    
    include_once '../../config/dbx.php';
    include_once '../../class/cargos/cargos.php';

    $database = new Database();
    $db = $database->getConnectionCli();

    $items = new Cargos($db);
    $items->CustomerKey = $_GET['ck'];

    $stmt = $items->getAll();
    $itemCount = $stmt->rowCount();

    if($itemCount > 0){
        
        $estadoArr = array();
        $estadoArr["body"] = array();
        $estadoArr["itemCount"] = $itemCount;

        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
            extract($row);
            $e = array(
                "CargosId" => $CargosId,
                "CustomerKey" => $CustomerKey,
                "CargosKey" => $CargosKey,
				"CargosName" => $CargosName,
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