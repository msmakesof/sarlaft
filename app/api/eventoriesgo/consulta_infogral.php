<?php
    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json; charset=UTF-8");
    
    include_once '../../config/dbx.php';
    include_once '../../class/eventoriesgo/eventosderiesgo.php';

    $database = new Database();
    $db = $database->getConnectionCLi();
    $items = new EventoRiesgo($db);	
	
	$items->EVRI_Consecutivo = isset($_GET['caso']) ? $_GET['caso'] : die();
	$items->EVRI_IdEvento = isset($_GET['evento']) ? $_GET['evento'] : die();
	$items->EVRI_IdProceso = isset($_GET['proceso']) ? $_GET['proceso'] : die();
	$items->EVRI_IdResponsable = isset($_GET['responsable']) ? $_GET['responsable'] : die();
	$items->ECAU_IdCausa = isset($_GET['causas']) ? $_GET['causas'] : die();
	$items->ECON_IdConsecuencia = isset($_GET['consecuencias']) ? $_GET['consecuencias'] : die();
	$items->ECTR_IdControl = isset($_GET['control']) ? $_GET['control'] : die();
	$items->ETRA_Id = isset($_GET['tratamiento']) ? $_GET['tratamiento'] : die();
	$items->id = isset($_GET['segclientes']) ? $_GET['segclientes'] : die();
	$items->EVRI_Consecutivo = isset($_GET['segproductos']) ? $_GET['segproductos'] : die();
	$items->EVRI_Consecutivo = isset($_GET['caso']) ? $_GET['caso'] : die();
	$items->EVRI_Consecutivo = isset($_GET['caso']) ? $_GET['caso'] : die();
	
	$items->EVRI_CustomerKey = isset($_GET['ck']) ? $_GET['ck'] : die();
    $stmt = $items->getInfoGral();
    $itemCount = $stmt->rowCount();

    if($itemCount > 0){
        
        $estadoArr = array();
        $estadoArr["body"] = array();
        $estadoArr["itemCount"] = $itemCount;

        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
            extract($row);
            $e = array(
                "EVRI_Id" => $EVRI_Id,
				"EVRI_Consecutivo" => $EVRI_Consecutivo,
				"EVRI_IdInterseccion" => $EVRI_IdInterseccion,
				"EVRI_CustomerKey" => $EVRI_CustomerKey,
				"EventosdeRiesgoName" => $EventosdeRiesgoName,
				"ProcesosName" => $ProcesosName,
				"CargosName" => $CargosName,
				"ResponsablesName" => $ResponsablesName,				
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