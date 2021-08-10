<?php
    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json; charset=UTF-8");
    
    include_once '../../config/dbx.php';
    include_once '../../class/calificacion/calificacion.php';

    $database = new Database();
    $db = $database->getConnectionCLi();

    $items = new Calificacion($db);
	$items->CAL_CustomerKey = isset($_GET['ck']) ? $_GET['ck'] : die();
	$items->CAL_RangoInicial = isset($_GET['vr']) ? $_GET['vr'] : die();

    $stmt = $items->getDatoCalifica();
    $itemCount = $stmt->rowCount();

    if($itemCount > 0){
        
        $estadoArr = array();
        $estadoArr["body"] = array();
        $estadoArr["itemCount"] = $itemCount;

        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
            extract($row);
            $e = array(
                "CAL_IdCalificacion" => $CAL_IdCalificacion,
                "CAL_Nombre" => $CAL_Nombre,
                "CAL_Color" => $CAL_Color,
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