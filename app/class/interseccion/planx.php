<?php
    class PlanesSarlaft{

        // Connection
        private $con;

        // Table
        private $db_table = "PlanesSarlaft";

        // Columns
		public $id;
		public $PlanesKey;
		public $PlanesName;
		public $PlanesResponsable;
		public $PlanesTarea;
		public $PlanesPlazo;
		public $PlanesAprueba;
		public $PlanesNivelPrioridad;
		public $PlanesRespSeguimiento;
		public $PlanesRespAprobacion;
		public $PlanesFInicio;
		public $PlanesFSeguimiento;
		public $PlanesFTerminacion;
		public $PlanesAvance;
		public $PlanesStatus;
		public $CustomerKey;
		public $UserKey;
		public $DateStamp;

        // Db connection
        public function __construct($db){
            $this->con = $db;
        }

        // GET ALL
        //public function getPlan($offset, $per_page){
		public function getPlan(){	
			//$sql = sqlsrv_query($this->con,"SELECT id
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
			
			
			//var_dump ( $con );
			//$stmt =  $sql ; //sqlsrv_query( $this->con, $sql );
			$stmt = sqlsrv_query( $conn, $sql );

			if($stmt === false)
			{
				echo "Error en la consulta: $sql ";
			}
			else
			{
				return $stmt;
			}
			//echo $sql;	//	OFFSET $offset ROWS FETCH NEXT $per_page ROWS ONLY	
			//$stmt->execute();
			
        }		
    }
?>
