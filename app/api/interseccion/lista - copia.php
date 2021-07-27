<?php    
	header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json; charset=UTF-8");
    
    //include_once '../../config/dbx.php';
	require_once '../../components/sql_serverx.php';
	
	$query = sqlsrv_query( $conn,"SELECT id
			,PlanesKey
			,PlanesName
			,PlanesResponsable
			,PlanesTarea
			,PlanesPlazo
			,PlanesAprueba
			,PlanesNivelPrioridad
			,PlanesRespSeguimiento
			,PlanesRespAprobacion
			,PlanesFInicio
			,PlanesFSeguimiento
			,PlanesFTerminacion
			,PlanesAvance
			,PlanesStatus
			,P.CustomerKey
			,P.UserKey
			,P.DateStamp
			,R.ResponsablesName AS NombreResponsable
			,C.CargosName
			,RS.ResponsablesName AS NombreResponsableSeg
			,RA.ResponsablesName AS NombreResponsableApr
			FROM sarlaft.dbo.PlanesSarlaft P
			JOIN ResponsablesSarlaft R ON R.ResponsablesId = P.PlanesResponsable
			JOIN CargosSarlaft C ON C.CargosId = P.PlanesAprueba
			JOIN ResponsablesSarlaft RS ON RS.ResponsablesId = P.PlanesRespSeguimiento
			JOIN ResponsablesSarlaft RA ON RA.ResponsablesId = P.PlanesRespAprobacion 
			ORDER BY PlanesName" );

			if($query === false)
			{
				echo "Error en la consulta: $query ";
			}
			else
			{
				//return $stmt;
				//print_r ($stmt);}
				if ( $query === false)
				{
					die(print_r(sqlsrv_errors(), true));
				}						
				while( $row = sqlsrv_fetch_array( $query, SQLSRV_FETCH_ASSOC) ) {
					$PlanesId=$row['id'];
					echo $PlanesId."<br>";
				}
			}
    
	/*
	//include_once '../../class/plan/planx.php';

    //$database = new Database();
    //$db = $database->getConnection();
	//echo "db.....$db<br>";
    
	//$offset = isset($_GET['offset']) ? $_GET['offset'] : die();
	//$per_page = isset($_GET['per_page']) ? $_GET['per_page'] : die();
    //$stmt = $items->getPlan($offset, $per_page);
	$items = new PlanesSarlaft($db);
	$stmt = $items->getPlan();	
    $itemCount = sqlsrv_num_rows($stmt);  //$stmt->rowCount();
	
	//var_dump($stmt);
	echo "count....$itemCount";

    if($itemCount > 0){
        
        $estadoArr = array();
        $estadoArr["body"] = array();
        $estadoArr["itemCount"] = $itemCount;

        //while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
		foreach ($row = $stmt->fetch(PDO::FETCH_ASSOC) as $row)	{
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
				//"NombreResponsable" => $NombreResponsable
                //"CargosName" => $CargosName,
                //"NombreResponsableSeg" => $NombreResponsableSeg,
                //"NombreResponsableApr" => $NombreResponsableApr
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
	*/
?>