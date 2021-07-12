<?php
    class FactoresRiesgo{

        // Connection
        private $conn;

        // Table
        private $db_table = "FAR_FactorRiesgo";

        // Columns
		public $FAR_IdFactorRiesgo;
		public $FAR_CustomerKey;
		public $FAR_Nombre;
        public $FAR_UserKey;
        public $FAR_FactorRiesgoKey;
        public $DateStamp;

        // Db connection
        public function __construct($db){
            $this->conn = $db;
        }

        // GET ALL
        public function getAll(){
            $sql = "SELECT FAR_IdFactorRiesgo, FAR_CustomerKey, FAR_Nombre, FAR_UserKey, FAR_FactorRiesgoKey, DateStamp 
            FROM ". $this->db_table ." ORDER BY FAR_Nombre ";
            //echo $sql;
			$stmt = $this->conn->prepare($sql, array(PDO::ATTR_CURSOR => PDO::CURSOR_SCROLL));
			$stmt->execute();
			return $stmt;
        }
		
		// READ single ID
        public function getIdFR(){
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
            $sql = "SELECT count(FAR_IdFactorRiesgo) AS FAR_Nombre
                      FROM ". $this->db_table ."
                    WHERE FAR_Nombre = ? AND FAR_IdFactorRiesgo <> ? ";

            $stmt = $this->conn->prepare($sql, array(PDO::ATTR_CURSOR => PDO::CURSOR_SCROLL));

            $stmt->bindParam(1, $this->FAR_Nombre, PDO::PARAM_STR);
			$stmt->bindParam(2, $this->FAR_IdFactorRiesgo, PDO::PARAM_INT);

            $stmt->execute();

            $dataRow = $stmt->fetch(PDO::FETCH_ASSOC);
            
            $this->FAR_Nombre = $dataRow['FAR_Nombre'];
        }
		
		// CREATE
		public function createFR(){
			$sqlQuery = "INSERT INTO ". $this->db_table ." (FAR_CustomerKey, FAR_UserKey, DateStamp, FAR_Nombre, FAR_FactorRiesgoKey) VALUES ( :ck, :uk, :ds, :nombre, :frk )";
			//echo $sqlQuery ;
			$stmt = $this->conn->prepare($sqlQuery, array(PDO::ATTR_CURSOR => PDO::CURSOR_SCROLL));
		
			// sanitize
			$this->FAR_CustomerKey = htmlspecialchars(strip_tags($this->FAR_CustomerKey));
			$this->FAR_UserKey = htmlspecialchars(strip_tags($this->FAR_UserKey));
            $this->DateStamp = htmlspecialchars(strip_tags($this->DateStamp));
			$this->FAR_Nombre = htmlspecialchars(strip_tags($this->FAR_Nombre));
            $this->FAR_FactorRiesgoKey = htmlspecialchars(strip_tags($this->FAR_FactorRiesgoKey));
		
			// bind data
			$stmt->bindParam(":ck", $this->FAR_CustomerKey, PDO::PARAM_STR);
			$stmt->bindParam(":uk", $this->FAR_UserKey, PDO::PARAM_STR);
            $stmt->bindParam(":ds", $this->DateStamp, PDO::PARAM_STR);
			$stmt->bindParam(":nombre", $this->FAR_Nombre, PDO::PARAM_STR);
            $stmt->bindParam(":frk", $this->FAR_FactorRiesgoKey, PDO::PARAM_STR);
		
			if($stmt->execute()){
				return true;
			}
			return false;
		}

		// UPDATE
        public function updateFR(){
            $sqlQuery = "UPDATE ". $this->db_table ."
                    SET
                    FAR_Nombre = :nombre
                    WHERE FAR_IdFactorRiesgo = :id ";
			//echo   $sqlQuery;
        
            $stmt = $this->conn->prepare($sqlQuery, array(PDO::ATTR_CURSOR => PDO::CURSOR_SCROLL));
        
            $this->FAR_Nombre=htmlspecialchars(strip_tags($this->FAR_Nombre));
            $this->FAR_IdFactorRiesgo=htmlspecialchars(strip_tags($this->FAR_IdFactorRiesgo));
        
            // bind data
            $stmt->bindParam(":nombre", $this->FAR_Nombre, PDO::PARAM_STR);
            $stmt->bindParam(":id", $this->FAR_IdFactorRiesgo, PDO::PARAM_INT);
        
            if($stmt->execute()){
               return true;
            }
            return false;
        }        

        // DELETE
        function deleteFR(){
            $sqlQuery = "DELETE FROM " . $this->db_table . " WHERE FAR_IdFactorRiesgo = ? ";
            $stmt = $this->conn->prepare($sqlQuery, array(PDO::ATTR_CURSOR => PDO::CURSOR_SCROLL));
        
            $this->FAR_IdFactorRiesgo = htmlspecialchars(strip_tags($this->FAR_IdFactorRiesgo));

            // bind data
            $stmt->bindParam(1, $this->FAR_IdFactorRiesgo, PDO::PARAM_INT);
        
            if($stmt->execute()){
                return true;
            }
            return false;
        }
    }
?>
