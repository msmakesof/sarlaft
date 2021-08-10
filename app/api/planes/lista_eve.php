<?php
    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json; charset=UTF-8");
    
    include_once '../../config/dbx.php';
    include_once '../../class/plan/plan.php';

    $database = new Database();
    $db = $database->getConnectionCLi();
    $items = new Planes($db);
	
	$items->CustomerKey = isset($_GET['ck']) ? $_GET['ck'] : die();
    $stmt = $items->getCkAll();
    $itemCount = $stmt->rowCount();

    if($itemCount > 0){
        
        $estadoArr = array();
        $estadoArr["body"] = array();
        $estadoArr["itemCount"] = $itemCount;

        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
            extract($row);
            $e = array(
                "id" => $id,
				"PlanesKey" => $PlanesKey,
				"PlanesName" => $PlanesName,
				"PlanesTarea" => $PlanesTarea,
				"PlanesResponsable" => $PlanesResponsable,
				"PlanesPlazo" => $PlanesPlazo,
				"PlanesAprueba" => $PlanesAprueba,
				"PlanesNivelPrioridad" => $PlanesNivelPrioridad,
				"PlanesRespSeguimiento"=> $PlanesRespSeguimiento,
				"PlanesRespAprobacion" => $PlanesRespAprobacion,
				"PlanesFInicio" => $PlanesFInicio,
				"PlanesFSeguimiento" => $PlanesFSeguimiento,
				"PlanesFTerminacion" => $PlanesFTerminacion,
				"PlanesAvance" => $PlanesAvance,
				"PlanesStatus" => $PlanesStatus,
				"CustomerKey" => $CustomerKey,
				"UserKey" => $UserKey,
				"DateStamp" => $DateStamp,
				"NombreResponsable" => $NombreResponsable,
				"NombreResponsable" => $NombreResponsable,
				"CargosName" => $CargosName,
				"NombreResponsableSeg" => $NombreResponsableSeg,
				"NombreResponsableApr" => $NombreResponsableApr
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