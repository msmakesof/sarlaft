<?php
    class TiposRiesgo{

        // Connection
        private $conn;

        // Table
        private $db_table = "TIR_TipoRiesgo";

        // Columns
		public $TIR_IdTipoRiesgo;
		public $TIR_CustomerKey;
		public $TIR_Nombre;
        public $TIR_UserKey;
        public $TIR_TipoRiesgoKey;
        public $DateStamp;

        // Db connection
        public function __construct($db){
            $this->conn = $db;
        }

        // GET ALL
        public function getAll(){
            $sql = "SELECT TIR_IdTipoRiesgo, TIR_CustomerKey, TIR_Nombre, TIR_UserKey, TIR_TipoRiesgoKey, DateStamp 
            FROM ". $this->db_table ." ORDER BY TIR_Nombre ";
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
            $sql = "SELECT count(TIR_IdTipoRiesgo) AS TIR_Nombre
                      FROM ". $this->db_table ."
                    WHERE TIR_Nombre = ? AND TIR_IdTipoRiesgo <> ? ";

            $stmt = $this->conn->prepare($sql, array(PDO::ATTR_CURSOR => PDO::CURSOR_SCROLL));

            $stmt->bindParam(1, $this->TIR_Nombre, PDO::PARAM_STR);
			$stmt->bindParam(2, $this->TIR_IdTipoRiesgo, PDO::PARAM_INT);

            $stmt->execute();

            $dataRow = $stmt->fetch(PDO::FETCH_ASSOC);
            
            $this->TIR_Nombre = $dataRow['TIR_Nombre'];
        }
		
		// CREATE
		public function createTR(){
			$sqlQuery = "INSERT INTO ". $this->db_table ." (TIR_CustomerKey, TIR_UserKey, TIR_Nombre, TIR_TipoRiesgoKey, DateStamp) VALUES ( :ck, :uk, :nombre, :trk, :ds )";
			//echo $sqlQuery ;
			$stmt = $this->conn->prepare($sqlQuery, array(PDO::ATTR_CURSOR => PDO::CURSOR_SCROLL));
		
			// sanitize
			$this->TIR_CustomerKey = htmlspecialchars(strip_tags($this->TIR_CustomerKey));
			$this->TIR_UserKey = htmlspecialchars(strip_tags($this->TIR_UserKey));            
			$this->TIR_Nombre = htmlspecialchars(strip_tags($this->TIR_Nombre));
            $this->TIR_TipoRiesgoKey = htmlspecialchars(strip_tags($this->TIR_TipoRiesgoKey));
            $this->DateStamp = htmlspecialchars(strip_tags($this->DateStamp));
		
			// bind data
			$stmt->bindParam(":ck", $this->TIR_CustomerKey, PDO::PARAM_STR);
			$stmt->bindParam(":uk", $this->TIR_UserKey, PDO::PARAM_STR);            
			$stmt->bindParam(":nombre", $this->TIR_Nombre, PDO::PARAM_STR);
            $stmt->bindParam(":trk", $this->TIR_TipoRiesgoKey, PDO::PARAM_STR);
            $stmt->bindParam(":ds", $this->DateStamp, PDO::PARAM_STR);
		
			if($stmt->execute()){
				return true;
			}
			return false;
		}

		// UPDATE
        public function updateTR(){
            $sqlQuery = "UPDATE ". $this->db_table ."
                    SET
                    TIR_Nombre = :nombre
                    WHERE TIR_IdTipoRiesgo = :id ";
			//echo   $sqlQuery;
        
            $stmt = $this->conn->prepare($sqlQuery, array(PDO::ATTR_CURSOR => PDO::CURSOR_SCROLL));
        
            $this->TIR_Nombre=htmlspecialchars(strip_tags($this->TIR_Nombre));
            $this->TIR_IdTipoRiesgo=htmlspecialchars(strip_tags($this->TIR_IdTipoRiesgo));
        
            // bind data
            $stmt->bindParam(":nombre", $this->TIR_Nombre, PDO::PARAM_STR);
            $stmt->bindParam(":id", $this->TIR_IdTipoRiesgo, PDO::PARAM_INT);
        
            if($stmt->execute()){
               return true;
            }
            return false;
        }        

        // DELETE
        function deleteTR(){
            $sqlQuery = "DELETE FROM " . $this->db_table . " WHERE TIR_IdTipoRiesgo = ? ";
            $stmt = $this->conn->prepare($sqlQuery, array(PDO::ATTR_CURSOR => PDO::CURSOR_SCROLL));
        
            $this->TIR_IdTipoRiesgo = htmlspecialchars(strip_tags($this->TIR_IdTipoRiesgo));

            // bind data
            $stmt->bindParam(1, $this->TIR_IdTipoRiesgo, PDO::PARAM_INT);
        
            if($stmt->execute()){
                return true;
            }
            return false;
        }
    }
?>
