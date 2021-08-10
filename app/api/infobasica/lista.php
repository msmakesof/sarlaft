<?php
    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json; charset=UTF-8");
    
    include_once '../../config/dbx.php';
    include_once '../../class/infobasica/infobasica.php';

    $database = new Database();
    $db = $database->getConnectionCLi();

    $items = new Infobasica($db);
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
                "CLI_IdInfoBasica" => $CLI_IdInfoBasica,
                "CLI_ActividadEconomica" => $CLI_ActividadEconomica,
				"CLI_ObjetoSocial" => $CLI_ObjetoSocial,
                "CLI_DescripcionGeneral" => $CLI_DescripcionGeneral,
                "CLI_Mision" => $CLI_Mision,
                "CLI_Vision" => $CLI_Vision,
                "CLI_ObjetivosEstrategicos" => $CLI_ObjetivosEstrategicos,
                "CLI_CustomerKey" => $CLI_CustomerKey,
                "CLI_USerKey" => $CLI_USerKey
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