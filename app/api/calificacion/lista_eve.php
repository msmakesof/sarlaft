<?php
    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json; charset=UTF-8");
    
    include_once '../../config/dbx.php';
    include_once '../../class/calificacion/calificacion.php';

    $database = new Database();
    $db = $database->getConnectionCLi();

    $items = new Calificacion($db);
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
                "CAL_IdCalificacion" => $CAL_IdCalificacion,
                "CAL_RangoInicial" => $CAL_RangoInicial,
                "CAL_RangoFinal" => $CAL_RangoFinal,
                "CAL_Nombre" => $CAL_Nombre,
                "CAL_Color" => $CAL_Color,
				"CAL_CustomerKey" => $CAL_CustomerKey,
                "CAL_CalificacionKey" => $CAL_CalificacionKey,
                "CAL_UserKey" => $CAL_UserKey
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