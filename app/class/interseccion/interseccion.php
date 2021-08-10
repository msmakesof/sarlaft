<?php
    class Interseccion{

        // Connection
        private $conn;

        // Table
        private $db_table = "INT_Interseccion";

        // Columns
		public $INT_IdInterseccion;
		public $INT_Filas;
		public $INT_Columnas;
		public $INT_CustomerKey;
		public $INT_USerKey;
		public $INT_InterseccionKey;
		public $DateStamp;

        // Db connection
        public function __construct($db){
            $this->conn = $db;
        }

        // GET ALL
		public function getCkAll(){	
            $sql = "SELECT DISTINCT INT_IdInterseccion, INT_Filas, INT_Columnas, INT_CustomerKey
			,INT_USerKey, INT_InterseccionKey, DateStamp			
			FROM  ". $this->db_table ."
			JOIN INA_InterseccionArmar ON INA_IdInterseccion = INT_IdInterseccion
			WHERE INT_CustomerKey = ?			
			ORDER BY DateStamp, INT_Filas, INT_Columnas ";
			//echo $sql;
			$stmt = $this->conn->prepare($sql, array(PDO::ATTR_CURSOR => PDO::CURSOR_SCROLL));
				//	OFFSET $offset ROWS FETCH NEXT $per_page ROWS ONLY
			$stmt->bindParam(1, $this->INT_CustomerKey);	
			$stmt->execute();
			return $stmt;
        }
		
		// GET ALL
		public function getMovtoMatrizControl(){	
            $sql = "SELECT TOP 1 MOV_IdMovimientoMRC, MOV_IdEventoMRC, MOV_FilaMRC, MOV_ColumnaMRC, MOV_CustomerKeyMRC	
			FROM MOV_MatrizControl
			WHERE MOV_CustomerKeyMRC = ? AND MOV_IdEventoMRC = ? ORDER BY MOV_IdMovimientoMRC DESC ";
			//echo $sql;
			$stmt = $this->conn->prepare($sql, array(PDO::ATTR_CURSOR => PDO::CURSOR_SCROLL));
				//	OFFSET $offset ROWS FETCH NEXT $per_page ROWS ONLY
			$stmt->bindParam(1, $this->MOV_CustomerKeyMRC);
			$stmt->bindParam(2, $this->MOV_IdEventoMRC);			
			$stmt->execute();
			return $stmt;
        }
		
		// READ single ID
        public function getIdInterseccion(){
            $sql = "SELECT TOP 1 INT_IdInterseccion, INT_Filas, INT_Columnas, INT_CustomerKey, INT_USerKey, INT_InterseccionKey, DateStamp FROM ". $this->db_table ." WHERE INT_IdInterseccion = ? AND INT_CustomerKey = ? ";			

            $stmt = $this->conn->prepare($sql);

            $stmt->bindParam(1, $this->INT_IdInterseccion);
			$stmt->bindParam(2, $this->INT_CustomerKey);

            $stmt->execute();

            $dataRow = $stmt->fetch(PDO::FETCH_ASSOC);
            
			$this->INT_IdInterseccion = $dataRow['INT_IdInterseccion'];
			$this->INT_Filas = $dataRow['INT_Filas'];
			$this->INT_Columnas = $dataRow['INT_Columnas'];
			$this->INT_CustomerKey = $dataRow['INT_CustomerKey'];
			$this->INT_USerKey = $dataRow['INT_USerKey'];
			$this->INT_InterseccionKey = $dataRow['INT_InterseccionKey'];
			$this->DateStamp = $dataRow['DateStamp'];
        }

		// READ single Id para pintar la matriz coloreada
        public function getIdInterseccionMatriz(){
            $sql = "SELECT INT_IdInterseccion, INT_Filas, INT_Columnas, INT_CustomerKey, INA_Fila, INA_Color FROM ". $this->db_table ." JOIN INA_InterseccionArmar ON INA_IdInterseccion = INT_IdInterseccion WHERE INT_IdInterseccion = ? AND INT_CustomerKey = ? ";			

            $stmt = $this->conn->prepare($sql, array(PDO::ATTR_CURSOR => PDO::CURSOR_SCROLL));

            $stmt->bindParam(1, $this->INT_IdInterseccion);
			$stmt->bindParam(2, $this->INT_CustomerKey);

            $stmt->execute();
			return $stmt;
        }
		
		// READ single Id para pintar la matriz coloreada en el Evento de Riesgo
        public function getIdMatrizEventoRiesgo(){
            $sql = "SELECT INT_IdInterseccion, INT_Filas, INT_Columnas, INT_CustomerKey, INA_Fila, INA_Color FROM ". $this->db_table ." JOIN INA_InterseccionArmar ON INA_IdInterseccion = INT_IdInterseccion WHERE INT_CustomerKey = ? ";			

            $stmt = $this->conn->prepare($sql, array(PDO::ATTR_CURSOR => PDO::CURSOR_SCROLL));

            //$stmt->bindParam(1, $this->INT_IdInterseccion);
			$stmt->bindParam(1, $this->INT_CustomerKey);

            $stmt->execute();
			return $stmt;
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
            $sqlQuery = "DELETE FROM " . $this->db_table . " WHERE INT_IdInterseccion = ? ; DELETE FROM INA_InterseccionArmar WHERE INA_IdInterseccion = ? ";
            $stmt = $this->conn->prepare($sqlQuery, array(PDO::ATTR_CURSOR => PDO::CURSOR_SCROLL));
			//echo $sqlQuery;
            $this->INT_IdInterseccion = htmlspecialchars(strip_tags($this->INT_IdInterseccion));
			$this->INA_IdInterseccion = htmlspecialchars(strip_tags($this->INA_IdInterseccion));

            // bind data
            $stmt->bindParam(1, $this->INT_IdInterseccion, PDO::PARAM_INT);
			$stmt->bindParam(2, $this->INA_IdInterseccion, PDO::PARAM_INT);
        
            if($stmt->execute()){
                return true;
            }
            return false;
        }
    }
?>
