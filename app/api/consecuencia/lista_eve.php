<?php
    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json; charset=UTF-8");
    
    include_once '../../config/dbx.php';
    include_once '../../class/consecuencia/consecuencia.php';

    $database = new Database();
    $db = $database->getConnectionCLi();

    $items = new Consecuencia($db);
	$items->CSC_CustomerKey = isset($_GET['ck']) ? $_GET['ck'] : die();

    $stmt = $items->getCkAll();
    $itemCount = $stmt->rowCount();

    if($itemCount > 0){
        
        $estadoArr = array();
        $estadoArr["body"] = array();
        $estadoArr["itemCount"] = $itemCount;

        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
            extract($row);
            $e = array(
                "CSC_IdConsecuencia" => $CSC_IdConsecuencia,
                "CSC_Nombre" => $CSC_Nombre,
                "CSC_Escala" => $CSC_Escala,
                "CSC_Color" => $CSC_Color,
				"CSC_CustomerKey" => $CSC_CustomerKey,
                "CSC_UserKey" => $CSC_UserKey,
                "CSC_TipoRiesgoKey" => $CSC_TipoRiesgoKey
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