<?php
    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json; charset=UTF-8");
    
    include_once '../../config/dbx.php';
    include_once '../../class/categoria/categoria.php';

    $database = new Database();
    $db = $database->getConnectionCLi();

    $items = new Categoria($db);

    $stmt = $items->getAll();
    $itemCount = $stmt->rowCount();

    if($itemCount > 0){
        
        $estadoArr = array();
        $estadoArr["body"] = array();
        $estadoArr["itemCount"] = $itemCount;

        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
            extract($row);
            $e = array(
                "CAT_IdCategoria" => $CAT_IdCategoria,
                "CAT_Nombre" => $CAT_Nombre,
				"CAT_CustomerKey" => $CAT_CustomerKey,
                "CAT_UserKey" => $CAT_UserKey,
                "CAT_TipoRiesgoKey" => $CAT_TipoRiesgoKey
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