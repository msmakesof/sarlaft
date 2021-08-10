<?php    
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
    
require_once '../../config/sql_serversp.php';

$ck = trim($_GET['ck']);
$params = array (
	array($ck , SQLSRV_PARAM_IN),
);
$spSQL = "{call dbo.sp_ListaPlan(?)}";
$REC = sqlsrv_prepare($conn, $spSQL, $params);

if(sqlsrv_execute($REC)){    

    $estadoArr = array();
    $estadoArr["body"] = array();

    $z = 0;
    while ($row= sqlsrv_fetch_array($REC))
    {
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
        $z ++;
    }
    if($z > 0){
        $estadoArr["itemCount"] = $z;
        echo json_encode($estadoArr);
    }
    else{
        http_response_code(404);
        echo json_encode(
            array("message" => "Registro No Encontrado.")
        );
    }    
}
else {
    die( print_r( sqlsrv_errors(), true));
}
?>