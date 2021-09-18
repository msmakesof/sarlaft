<?php
    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json; charset=UTF-8");
    
    include_once '../../config/dbx.php';
    include_once '../../class/metodologia/metodologia.php';

    $database = new Database();
    $db = $database->getConnectionCli();

    $items = new Metodologia($db);
	$items->MET_CustomerKey = isset($_GET['ck']) ? $_GET['ck'] : die();
    $stmt = $items->getCkAll();
    $itemCount = $stmt->rowCount();

    if($itemCount > 0){
        
        $estadoArr = array();
        $estadoArr["body"] = array();
        $estadoArr["itemCount"] = $itemCount;

        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
            extract($row);
            $e = array(
                "MET_IdMetodologia" => $MET_IdMetodologia,
				"MET_FactorRiesgo" => $MET_FactorRiesgo,
				"MET_Nombre" => $MET_Nombre,
				"MET_Descripcion" => $MET_Descripcion,
				"MET_Observaciones" => $MET_Observaciones,
                "MET_CustomerKey" => $MET_CustomerKey,
				"MET_MetodologiaKey" => $MET_MetodologiaKey,
                "MET_USerKey" => $MET_USerKey
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