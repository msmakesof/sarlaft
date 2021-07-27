<?php
    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json; charset=UTF-8");
    
    include_once '../../config/dbx.php';
    include_once '../../class/nivelriesgo/nivelriesgo.php';

    $database = new Database();
    $db = $database->getConnectionCLi();
    $items = new Nivelriesgo($db);
	
	$items->NIR_CustomerKey = isset($_GET['ck']) ? $_GET['ck'] : die();
    $stmt = $items->getCkAll();
    $itemCount = $stmt->rowCount();

    if($itemCount > 0){
        
        $estadoArr = array();
        $estadoArr["body"] = array();
        $estadoArr["itemCount"] = $itemCount;

        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
            extract($row);
            $e = array(
                "NIR_IdNivelRiesgo" => $NIR_IdNivelRiesgo,
                "NIR_Nombre" => $NIR_Nombre,
                "NIR_Color" => $NIR_Color,
				"NIR_CustomerKey" => $NIR_CustomerKey,
                "NIR_UserKey" => $NIR_UserKey,
                "NIR_TipoRiesgoKey" => $NIR_TipoRiesgoKey
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