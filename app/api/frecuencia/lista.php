<?php
    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json; charset=UTF-8");
    
    include_once '../../config/dbx.php';
    include_once '../../class/frecuencia/frecuencia.php';

    $database = new Database();
    $db = $database->getConnectionCLi();

    $items = new Frecuencia($db);

    $stmt = $items->getAll();
    $itemCount = $stmt->rowCount();

    if($itemCount > 0){
        
        $estadoArr = array();
        $estadoArr["body"] = array();
        $estadoArr["itemCount"] = $itemCount;

        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
            extract($row);
            $e = array(
                "FRE_IdFrecuencia" => $FRE_IdFrecuencia,
                "FRE_Nombre" => $FRE_Nombre,
				"FRE_CustomerKey" => $FRE_CustomerKey,
                "FRE_FrecuenciaKey" => $FRE_FrecuenciaKey,
                "FRE_UserKey" => $FRE_UserKey
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