  <?php
	include_once '../../components/sql_serverx.php';
    //include_once '../../class/plan/planx.php';

    //$database = new Database();
    //$db = $database->getConnection();
	//echo "db.....$db<br>";

    //$items = new PlanesSarlaft($db);
	//$stmt = $items->getPlan();

    //$con = 

    //
    $sql = "SELECT id
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
			ORDER BY PlanesName" ;
			//  OFFSET $offset ROWS FETCH NEXT $per_page ROWS ONLY
			//$stmt = $this->conn->prepare($sql, array(PDO::ATTR_CURSOR => PDO::CURSOR_SCROLL));
			//print_r($sql);
			
			
			//var_dump ($this->con);
			//$stmt =  $sql ; //sqlsrv_query( $this->con, $sql );
			$stmt = sqlsrv_query( $conn,"SELECT id
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

			if($stmt === false)
			{
				echo "Error en la consulta: $stmt ";
			}
			else
			{
				return $stmt;
			}
    //

    echo "stmt.....".$stmt;
?>