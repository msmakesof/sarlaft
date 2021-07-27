<?php
    class Planes{

        // Connection
        private $conn;

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
            $this->conn = $db;
        }

        // GET ALL
        //public function getPlan($offset, $per_page){
		public function getPlan(){	
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
			FROM sarlaft.dbo.PlanesSarlaft P, ResponsablesSarlaft R 
			WHERE R.ResponsablesId = P.PlanesResponsable			
			ORDER BY PlanesName  ";
			$stmt = $this->conn->prepare($sql, array(PDO::ATTR_CURSOR => PDO::CURSOR_SCROLL));
			//echo $sql;	//	OFFSET $offset ROWS FETCH NEXT $per_page ROWS ONLY	
			$stmt->execute();
			return $stmt;
        }
		
		// READ single ID
        public function getIdPlan(){
            $sql = "SELECT TOP 1 id, PlanesName FROM ". $this->db_table ." WHERE id = ? AND CustomerKey = ? ";			

            $stmt = $this->conn->prepare($sql);

            $stmt->bindParam(1, $this->id);
			$stmt->bindParam(2, $this->ck);

            $stmt->execute();

            $dataRow = $stmt->fetch(PDO::FETCH_ASSOC);
            
			$this->id = $dataRow['id'];
			$this->PlanesName = $dataRow['PlanesName'];
        }

        // Busca Nombre para controlar Duplicados
        public function getBuscaNombre(){
            $sql = "SELECT count(id) AS PlanesName
                      FROM ". $this->db_table ."
                    WHERE PlanesName = ? AND id <> ? ";

            $stmt = $this->conn->prepare($sql, array(PDO::ATTR_CURSOR => PDO::CURSOR_SCROLL));

            $stmt->bindParam(1, $this->PlanesName, PDO::PARAM_STR);
			$stmt->bindParam(2, $this->id, PDO::PARAM_INT);

            $stmt->execute();

            $dataRow = $stmt->fetch(PDO::FETCH_ASSOC);
            
            $this->PlanesName = $dataRow['PlanesName'];
        }
		
		// CREATE
		public function create(){
			$sqlQuery = "INSERT INTO ". $this->db_table ." (PlanesKey, PlanesName, PlanesResponsable, PlanesPlazo, PlanesAprueba, PlanesNivelPrioridad, PlanesRespSeguimiento, PlanesRespAprobacion, PlanesFInicio, PlanesFSeguimiento, PlanesFTerminacion, PlanesAvance, PlanesStatus, CustomerKey, UserKey, DateStamp ) VALUES ( :pk, :nombre, :responsable, :plazo, :aprueba, :nivelprioridad, :respseguimiento, :resaprobacion, :finicio, :fseguimiento, :fterminacion, :avance, :status, :ck, :uk, :ds )";
			//echo $sqlQuery ;
			
			$stmt = $this->conn->prepare($sqlQuery, array(PDO::ATTR_CURSOR => PDO::CURSOR_SCROLL));
		
			// sanitize
			$this->PlanesKey = htmlspecialchars(strip_tags($this->PlanesKey));
			$this->PlanesName = htmlspecialchars(strip_tags($this->PlanesName));
			$this->PlanesResponsable = htmlspecialchars(strip_tags($this->PlanesResponsable));
			$this->PlanesPlazo = htmlspecialchars(strip_tags($this->PlanesPlazo));
			$this->PlanesAprueba = htmlspecialchars(strip_tags($this->PlanesAprueba));
			$this->PlanesNivelPrioridad = htmlspecialchars(strip_tags($this->PlanesNivelPrioridad));
			$this->PlanesRespSeguimiento = htmlspecialchars(strip_tags($this->PlanesRespSeguimiento));
			$this->PlanesRespAprobacion = htmlspecialchars(strip_tags($this->PlanesRespAprobacion));
			$this->PlanesFInicio = htmlspecialchars(strip_tags($this->PlanesFInicio));
			$this->PlanesFSeguimiento = htmlspecialchars(strip_tags($this->PlanesFSeguimiento));
			$this->PlanesFTerminacion = htmlspecialchars(strip_tags($this->PlanesFTerminacion));
			$this->PlanesAvance = htmlspecialchars(strip_tags($this->PlanesAvance));
			$this->PlanesStatus = htmlspecialchars(strip_tags($this->PlanesStatus));
			$this->CustomerKey = htmlspecialchars(strip_tags($this->CustomerKey));
			$this->UserKey = htmlspecialchars(strip_tags($this->UserKey));
			$this->DateStamp = htmlspecialchars(strip_tags($this->DateStamp));
		
			// bind data
			$stmt->bindParam(":pk", $this->PlanesKey, PDO::PARAM_STR);
			$stmt->bindParam(":nombre", $this->PlanesName, PDO::PARAM_STR);
			$stmt->bindParam(":responsable", $this->PlanesResponsable, PDO::PARAM_STR);
			$stmt->bindParam(":plazo", $this->PlanesPlazo, PDO::PARAM_STR);
			$stmt->bindParam(":aprueba", $this->PlanesAprueba, PDO::PARAM_STR);
			$stmt->bindParam(":nivelprioridad", $this->PlanesNivelPrioridad, PDO::PARAM_STR);
			$stmt->bindParam(":respseguimiento", $this->PlanesRespSeguimiento, PDO::PARAM_STR);
			$stmt->bindParam(":resaprobacion", $this->PlanesRespAprobacion, PDO::PARAM_STR);
			$stmt->bindParam(":finicio", $this->PlanesFInicio, PDO::PARAM_STR);
			$stmt->bindParam(":fseguimiento", $this->PlanesFSeguimiento, PDO::PARAM_STR);
			$stmt->bindParam(":fterminacion", $this->PlanesFTerminacion, PDO::PARAM_STR);
			$stmt->bindParam(":avance", $this->PlanesAvance, PDO::PARAM_STR);
			$stmt->bindParam(":status", $this->PlanesStatus, PDO::PARAM_STR);
			$stmt->bindParam(":ck", $this->CustomerKey, PDO::PARAM_STR);
			$stmt->bindParam(":uk", $this->UserKey, PDO::PARAM_STR);
			$stmt->bindParam(":ds", $this->DateStamp, PDO::PARAM_STR);
		
			if($stmt->execute()){
				return true;
			}
			return false;
		}

		// UPDATE
        public function update(){
            $sqlQuery = "UPDATE ". $this->db_table ."
                    SET
                    PlanesName = :nombre,
					PlanesResponsable = :responsable,
					PlanesPlazo = :plazo,
					PlanesAprueba = :aprueba,
					PlanesNivelPrioridad = :nivelseguimiento,
					PlanesRespSeguimiento = :resposableseguimiento,
					PlanesRespAprobacion = :respaprobacion,
					PlanesFInicio = :fechainicio,
					PlanesFSeguimiento = :fechaseguimiento,
					PlanesFTerminacion = :fechaterminacion,
					PlanesAvance = :avance
                    WHERE id = :id ";
			//echo   $sqlQuery;
        
            $stmt = $this->conn->prepare($sqlQuery, array(PDO::ATTR_CURSOR => PDO::CURSOR_SCROLL));
        
            $this->PlanesName=htmlspecialchars(strip_tags($this->PlanesName));
			$this->PlanesResponsable=htmlspecialchars(strip_tags($this->PlanesResponsable));
			$this->PlanesPlazo=htmlspecialchars(strip_tags($this->PlanesPlazo));
			$this->PlanesAprueba=htmlspecialchars(strip_tags($this->PlanesAprueba));
			$this->PlanesNivelPrioridad=htmlspecialchars(strip_tags($this->PlanesNivelPrioridad));
			$this->PlanesRespSeguimiento=htmlspecialchars(strip_tags($this->PlanesRespSeguimiento));
			$this->PlanesRespAprobacion=htmlspecialchars(strip_tags($this->PlanesRespAprobacion));
			$this->PlanesFInicio=htmlspecialchars(strip_tags($this->PlanesFInicio));
			$this->PlanesFSeguimiento=htmlspecialchars(strip_tags($this->PlanesFSeguimiento));
			$this->PlanesFTerminacion=htmlspecialchars(strip_tags($this->PlanesFTerminacion));
			$this->PlanesAvance=htmlspecialchars(strip_tags($this->PlanesAvance));
            $this->id=htmlspecialchars(strip_tags($this->id));
        
            // bind data
            $stmt->bindParam(":nombre", $this->PlanesName, PDO::PARAM_STR);
			$stmt->bindParam(":responsable", $this->PlanesResponsable, PDO::PARAM_STR);
			$stmt->bindParam(":plazo", $this->PlanesPlazo, PDO::PARAM_STR);
			$stmt->bindParam(":aprueba", $this->PlanesAprueba, PDO::PARAM_STR);
			$stmt->bindParam(":nivelseguimiento", $this->PlanesNivelPrioridad, PDO::PARAM_STR);
			$stmt->bindParam(":resposableseguimiento", $this->PlanesRespSeguimiento, PDO::PARAM_STR);
			$stmt->bindParam(":respaprobacion", $this->PlanesRespAprobacion, PDO::PARAM_STR);
			$stmt->bindParam(":fechainicio", $this->PlanesFInicio, PDO::PARAM_STR);
			$stmt->bindParam(":fechaseguimiento", $this->PlanesFSeguimiento, PDO::PARAM_STR);
			$stmt->bindParam(":fechaterminacion", $this->PlanesFTerminacion, PDO::PARAM_STR);
			$stmt->bindParam(":avance", $this->PlanesAvance, PDO::PARAM_STR);
            $stmt->bindParam(":id", $this->id, PDO::PARAM_INT);
        
            if($stmt->execute()){
               return true;
            }
            return false;
        }        

        // DELETE
        function delete(){
            $sqlQuery = "DELETE FROM " . $this->db_table . " WHERE id = ? ";
            $stmt = $this->conn->prepare($sqlQuery, array(PDO::ATTR_CURSOR => PDO::CURSOR_SCROLL));
        
            $this->id = htmlspecialchars(strip_tags($this->id));

            // bind data
            $stmt->bindParam(1, $this->id, PDO::PARAM_INT);
        
            if($stmt->execute()){
                return true;
            }
            return false;
        }
    }
?>
