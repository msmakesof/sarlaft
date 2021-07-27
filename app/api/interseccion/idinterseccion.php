<?php
    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json; charset=UTF-8");
    header("Access-Control-Allow-Methods: POST");
    header("Access-Control-Max-Age: 3600");
    header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
    
    include_once '../../config/dbx.php';
    include_once '../../class/interseccion/interseccion.php';

    $database = new Database();
    $db = $database->getConnectionCli();
    $item = new Interseccion($db);
	
	$item->INT_IdInterseccion = isset($_GET['id']) ? $_GET['id'] : die();
    $item->INT_CustomerKey = isset($_GET['ck']) ? $_GET['ck'] : die();
	
	$item->getIdInterseccion();

    if($item->INT_Filas != null){
        // create array
        $emp_arr = array(
			"INT_IdInterseccion" => $item->INT_IdInterseccion,
			"INT_Filas" => $item->INT_Filas,
            "INT_Columnas" => $item->INT_Columnas,
            "INT_CustomerKey" => $item->INT_CustomerKey,
            "INT_USerKey" => $item->INT_USerKey,
            "INT_InterseccionKey" => $item->INT_InterseccionKey,
            "DateStamp" => $item->DateStamp,
		);            
		http_response_code(200);
        echo json_encode($emp_arr);
    }
    else{
        http_response_code(404);
        echo json_encode(
            array("message" => "Registro No Encontrado.")
        );
    }
?>