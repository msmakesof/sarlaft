<?php
    class Frecuencia{

        // Connection
        private $conn;

        // Table
        private $db_table = "FRE_Frecuencia";

        // Columns
		public $FRE_IdFrecuencia;
		public $FRE_Nombre;
		public $FRE_CustomerKey;
        public $FRE_FrecuenciaKey;
        public $FRE_UserKey;
        public $FRE_DateStamp;

        // Db connection
        public function __construct($db){
            $this->conn = $db;
        }

        // GET ALL
        public function getAll(){
            $sql = "SELECT FRE_IdFrecuencia, FRE_Nombre, FRE_CustomerKey, FRE_FrecuenciaKey, FRE_UserKey, FRE_DateStamp 
            FROM ". $this->db_table ." ORDER BY FRE_Nombre ";
            //echo $sql;
			$stmt = $this->conn->prepare($sql, array(PDO::ATTR_CURSOR => PDO::CURSOR_SCROLL));
			$stmt->execute();
			return $stmt;
        }

        // GET ALL por CK
        public function getCkAll(){
            $sql = "SELECT FRE_IdFrecuencia, FRE_Nombre, FRE_CustomerKey, FRE_FrecuenciaKey, FRE_UserKey, FRE_DateStamp 
            FROM ". $this->db_table ." WHERE FRE_CustomerKey = ? ORDER BY FRE_Nombre ";
            //echo $sql;
			$stmt = $this->conn->prepare($sql, array(PDO::ATTR_CURSOR => PDO::CURSOR_SCROLL));
			$stmt->bindParam(1, $this->FRE_CustomerKey);
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
            $sql = "SELECT count(FRE_IdFrecuencia) AS FRE_Nombre
                      FROM ". $this->db_table ."
                    WHERE FRE_Nombre = ? AND FRE_CustomerKey = ? AND FRE_IdFrecuencia <> ? ";

            $stmt = $this->conn->prepare($sql, array(PDO::ATTR_CURSOR => PDO::CURSOR_SCROLL));

            $stmt->bindParam(1, $this->FRE_Nombre, PDO::PARAM_STR); 
			$stmt->bindParam(2, $this->FRE_CustomerKey, PDO::PARAM_STR); 
			$stmt->bindParam(3, $this->FRE_IdFrecuencia, PDO::PARAM_INT);

            $stmt->execute();

            $dataRow = $stmt->fetch(PDO::FETCH_ASSOC);
            
            $this->FRE_Nombre = $dataRow['FRE_Nombre'];
        }
		
		// CREATE
		public function create(){
			$sqlQuery = "INSERT INTO ". $this->db_table ." (FRE_Nombre, FRE_CustomerKey, FRE_FrecuenciaKey, FRE_UserKey, FRE_DateStamp ) VALUES ( :nombre, :ck, :fk, :uk,  :ds )";
			//echo $sqlQuery ;
			$stmt = $this->conn->prepare($sqlQuery, array(PDO::ATTR_CURSOR => PDO::CURSOR_SCROLL));
		
			// sanitize
            $this->FRE_Nombre = htmlspecialchars(strip_tags($this->FRE_Nombre));
			$this->FRE_CustomerKey = htmlspecialchars(strip_tags($this->FRE_CustomerKey));
            $this->FRE_FrecuenciaKey = htmlspecialchars(strip_tags($this->FRE_FrecuenciaKey));
			$this->FRE_UserKey = htmlspecialchars(strip_tags($this->FRE_UserKey));
            $this->FRE_DateStamp = htmlspecialchars(strip_tags($this->FRE_DateStamp));
		
			// bind data
            $stmt->bindParam(":nombre", $this->FRE_Nombre, PDO::PARAM_STR);
			$stmt->bindParam(":ck", $this->FRE_CustomerKey, PDO::PARAM_STR);
            $stmt->bindParam(":fk", $this->FRE_FrecuenciaKey, PDO::PARAM_STR);
			$stmt->bindParam(":uk", $this->FRE_UserKey, PDO::PARAM_STR);
            $stmt->bindParam(":ds", $this->FRE_DateStamp, PDO::PARAM_STR);
		
			if($stmt->execute()){
				return true;
			}
			return false;
		}

		// UPDATE
        public function update(){
            $sqlQuery = "UPDATE ". $this->db_table ."
                    SET
                    FRE_Nombre = :nombre
                    WHERE FRE_IdFrecuencia = :id ";
			//echo   $sqlQuery;
        
            $stmt = $this->conn->prepare($sqlQuery, array(PDO::ATTR_CURSOR => PDO::CURSOR_SCROLL));
        
            $this->FRE_Nombre=htmlspecialchars(strip_tags($this->FRE_Nombre));
            $this->FRE_IdFrecuencia=htmlspecialchars(strip_tags($this->FRE_IdFrecuencia));
        
            // bind data
            $stmt->bindParam(":nombre", $this->FRE_Nombre, PDO::PARAM_STR);
            $stmt->bindParam(":id", $this->FRE_IdFrecuencia, PDO::PARAM_INT);
        
            if($stmt->execute()){
               return true;
            }
            return false;
        }        

        // DELETE
        function delete(){
            $sqlQuery = "DELETE FROM " . $this->db_table . " WHERE FRE_IdFrecuencia = ? ";
            $stmt = $this->conn->prepare($sqlQuery, array(PDO::ATTR_CURSOR => PDO::CURSOR_SCROLL));
        
            $this->FRE_IdFrecuencia = htmlspecialchars(strip_tags($this->FRE_IdFrecuencia));

            // bind data
            $stmt->bindParam(1, $this->FRE_IdFrecuencia, PDO::PARAM_INT);
        
            if($stmt->execute()){
                return true;
            }
            return false;
        }
    }
?>
