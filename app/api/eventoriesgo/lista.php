<?php
    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json; charset=UTF-8");
    
    include_once '../../config/dbx.php';
    include_once '../../class/accion/accion.php';

    $database = new Database();
    $db = $database->getConnection();

    $items = new Action($db);

    $stmt = $items->getAccion();
    $itemCount = $stmt->rowCount();

    if($itemCount > 0){
        
        $estadoArr = array();
        $estadoArr["body"] = array();
        $estadoArr["itemCount"] = $itemCount;

        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
            extract($row);
            $e = array(
                "ACC_IdAccion" => $ACC_IdAccion,
                "ACC_Nombre" => $ACC_Nombre,
				"ACC_IdEstado" => $ACC_IdEstado,
                "STA_Nombre" => $STA_Nombre
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