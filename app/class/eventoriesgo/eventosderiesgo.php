<?php
    class EventoRiesgo{

        // Connection
        private $conn;

        // Table
        private $db_table = "EVRI_EventoRiesgo";

        // Columns
		public $EVRI_Id;
		public $EVRI_Consecutivo;
		public $EVRI_IdEvento;
		public $EVRI_IdProceso;
		public $EVRI_IdCargo;
		public $EVRI_IdResponsable;
        public $EVRI_IdInterseccion;
        public $EVRI_CustomerKey;
        public $EVRI_UserKey;
        public $EVRI_EventoKey;
        public $EVRI_DateStamp;

        // Db connection
        public function __construct($db){
            $this->conn = $db;
        }

        // GET ALL
        public function getAll(){
            $sql = "SELECT EVRI_Id, EVRI_Consecutivo, EVRI_IdEvento, EVRI_IdProceso, EVRI_IdCargo, EVRI_IdResponsable, EVRI_IdInterseccion, EVRI_CustomerKey, EVRI_UserKey,EVRI_EventoKey, EVRI_DateStamp FROM ". $this->db_table ." 
            WHERE EVRI_CustomerKey = ? ORDER BY EVRI_Id ";  
			//echo $sql;			
			$stmt = $this->conn->prepare($sql, array(PDO::ATTR_CURSOR => PDO::CURSOR_SCROLL));
			$stmt->bindParam(1, $this->EVRI_CustomerKey);
			
			$stmt->execute();
			return $stmt;
        }

        // GET ALL por CK
        public function getCkAll(){
            $sql = "SELECT EVRI_Id, EVRI_Consecutivo, EVRI_IdInterseccion, EVRI_CustomerKey, EventosdeRiesgoName,  ProcesosName, CargosName, ResponsablesName
            FROM ". $this->db_table ." 
            LEFT JOIN EventosdeRiesgoSarlaft ON EventosdeRiesgoSarlaft.id = EVRI_IdEvento
            LEFT JOIN ProcesosSarlaft ON ProcesosSarlaft.id = EVRI_IdProceso
            LEFT JOIN CargosSarlaft ON CargosSarlaft.CargosId = EVRI_IdCargo
            LEFT JOIN ResponsablesSarlaft ON ResponsablesSarlaft.ResponsablesId = EVRI_IdResponsable
            WHERE EVRI_CustomerKey = ? ORDER BY EVRI_Id ";
            //echo $sql;
			$stmt = $this->conn->prepare($sql, array(PDO::ATTR_CURSOR => PDO::CURSOR_SCROLL));
			$stmt->bindParam(1, $this->EVRI_CustomerKey);
			$stmt->execute();
			return $stmt;
        }
		
		// READ single ID
        public function getIdAccion(){
            $sql = "SELECT TOP 1 ACC_IdAccion, ACC_Nombre, ACC_IdEstado FROM ". $this->db_table ." WHERE ACC_IdAccion = ? ";			

            $stmt = $this->conn->prepare($sql);

            $stmt->bindParam(1, $this->IdPerfil);

            $stmt->execute();

            $dataRow = $stmt->fetch(PDO::FETCH_ASSOC);
            
			$this->IdPerfil = $dataRow['IdPerfil'];
			$this->NombrePerfil = $dataRow['NombrePerfil'];
			$this->IdEstado = $dataRow['IdEstado']; 
            $this->STA_Nombre = $dataRow['STA_Nombre'];         
        }

        // Busca Nombre para controlar Duplicados
        public function getBuscaNombre(){
            $sql = "SELECT count(ACC_IdAccion) AS ACC_Nombre
                      FROM ". $this->db_table ."
                    WHERE ACC_Nombre = ? AND ACC_IdAccion <> ? ";

            $stmt = $this->conn->prepare($sql, array(PDO::ATTR_CURSOR => PDO::CURSOR_SCROLL));

            $stmt->bindParam(1, $this->ACC_Nombre, PDO::PARAM_STR);
			$stmt->bindParam(2, $this->ACC_IdAccion, PDO::PARAM_INT);

            $stmt->execute();

            $dataRow = $stmt->fetch(PDO::FETCH_ASSOC);
            
            $this->ACC_Nombre = $dataRow['ACC_Nombre'];
        }
		
		// CREATE
		public function createAccion(){
			$sqlQuery = "INSERT INTO ". $this->db_table ." (ACC_Nombre, ACC_IdEstado ) VALUES ( :nombreaccion , :idestado )";
			//echo $sqlQuery ;
			
			$stmt = $this->conn->prepare($sqlQuery, array(PDO::ATTR_CURSOR => PDO::CURSOR_SCROLL));
		
			// sanitize
			$this->ACC_Nombre = htmlspecialchars(strip_tags($this->ACC_Nombre));
			$this->ACC_IdEstado = htmlspecialchars(strip_tags($this->ACC_IdEstado));
		
			// bind data
			$stmt->bindParam(":nombreaccion", $this->ACC_Nombre, PDO::PARAM_STR);
			$stmt->bindParam(":idestado", $this->ACC_IdEstado, PDO::PARAM_INT);
		
			if($stmt->execute()){
				return true;
			}
			return false;
		}

		// UPDATE
        public function updateAccion(){
            $sqlQuery = "UPDATE ". $this->db_table ."
                    SET
                    ACC_Nombre = :accionnombre,
                    ACC_IdEstado = :idestado
                    WHERE ACC_IdAccion = :id ";
			//echo   $sqlQuery;
        
            $stmt = $this->conn->prepare($sqlQuery, array(PDO::ATTR_CURSOR => PDO::CURSOR_SCROLL));
        
            $this->ACC_Nombre=htmlspecialchars(strip_tags($this->ACC_Nombre));
			$this->ACC_IdEstado=htmlspecialchars(strip_tags($this->ACC_IdEstado));
            $this->ACC_IdAccion=htmlspecialchars(strip_tags($this->ACC_IdAccion));
        
            // bind data
            $stmt->bindParam(":accionnombre", $this->ACC_Nombre, PDO::PARAM_STR);
			$stmt->bindParam(":idestado", $this->ACC_IdEstado, PDO::PARAM_INT);
            $stmt->bindParam(":id", $this->ACC_IdAccion, PDO::PARAM_INT);
        
            if($stmt->execute()){
               return true;
            }
            return false;
        }        

        // DELETE
        function deleteAccion(){
            $sqlQuery = "DELETE FROM " . $this->db_table . " WHERE ACC_IdAccion = ? ";
            $stmt = $this->conn->prepare($sqlQuery, array(PDO::ATTR_CURSOR => PDO::CURSOR_SCROLL));
        
            $this->ACC_IdAccion = htmlspecialchars(strip_tags($this->ACC_IdAccion));

            // bind data
            $stmt->bindParam(1, $this->ACC_IdAccion, PDO::PARAM_INT);
        
            if($stmt->execute()){
                return true;
            }
            return false;
        }
    }
?>
