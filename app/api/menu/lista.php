<?php
    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json; charset=UTF-8");
    
    include_once '../../config/dbx.php';
    include_once '../../class/menu/menu.php';

    $database = new Database();
    $db = $database->getConnection();

    $items = new OptionMenu($db);

    $stmt = $items->getMenu();
    $itemCount = $stmt->rowCount();

    if($itemCount > 0){
        
        $estadoArr = array();
        $estadoArr["body"] = array();
        $estadoArr["itemCount"] = $itemCount;

        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
            extract($row);
            $e = array(
                "OPC_Id" => $OPC_Id,
                "OPC_Nombre" => $OPC_Nombre,
				"OPC_IdEstado" => $OPC_IdEstado,
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