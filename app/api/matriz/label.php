<?php
    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json; charset=UTF-8");
    header("Access-Control-Allow-Methods: POST");
    header("Access-Control-Max-Age: 3600");
    header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
    
    include_once '../../config/dbx.php';
    include_once '../../class/matriz/matriz.php';

    $database = new Database();
    $db = $database->getConnectionCli();
    $items = new MatrizControl($db);	
	
    $items->MOV_CustomerKeyMRC = isset($_GET['ck']) ? $_GET['ck'] : die();
    $items->MOV_IdEventoMRC = isset($_GET['er']) ? $_GET['er'] : die();
	$items->MOV_IdMovimientoMRC = isset($_GET['nreg']) ? $_GET['nreg'] : die();
	
	$stmt = $items->getLabel();
    $itemCount = $stmt->rowCount();

    if($itemCount > 0){
        
        $estadoArr = array();
        $estadoArr["body"] = array();
        $estadoArr["itemCount"] = $itemCount;
        // create array
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
            extract($row);
            $e = array(
                "MOV_FilaMRC" => $MOV_FilaMRC,
				"MOV_ColumnaMRC" => $MOV_ColumnaMRC,
                "LBLProb" => $LBLProb,
                "LBLConsec" => $LBLConsec,
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