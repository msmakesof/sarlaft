<?php
    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json; charset=UTF-8");
    
    include_once '../../config/dbx.php';
    include_once '../../class/probabilidad/probabilidad.php';

    $database = new Database();
    $db = $database->getConnectionCLi();

    $items = new Probabilidad($db);
	$items->PRO_CustomerKey = isset($_GET['ck']) ? $_GET['ck'] : die();

    $stmt = $items->getAllEscala();
    $itemCount = $stmt->rowCount();

    if($itemCount > 0){
        
        $estadoArr = array();
        $estadoArr["body"] = array();
        $estadoArr["itemCount"] = $itemCount;

        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
            extract($row);
            $e = array(
                "PRO_IdProbabilidad" => $PRO_IdProbabilidad,
                "PRO_Nombre" => $PRO_Nombre,
                "PRO_Escala" => $PRO_Escala,
                "PRO_Color" => $PRO_Color,
				"PRO_CustomerKey" => $PRO_CustomerKey,
                "PRO_UserKey" => $PRO_UserKey,
                "PRO_TipoRiesgoKey" => $PRO_TipoRiesgoKey
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