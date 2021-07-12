<?php
    class Realizado{

        // Connection
        private $conn;

        // Table
        private $db_table = "REA_Realizado";

        // Columns
		public $REA_IdRealizado;
		public $REA_CustomerKey;
		public $REA_Nombre;
        public $REA_UserKey;
        public $REA_TipoRiesgoKey;
        public $DateStamp;

        // Db connection
        public function __construct($db){
            $this->conn = $db;
        }

        // GET ALL
        public function getAll(){
            $sql = "SELECT REA_IdRealizado, REA_CustomerKey, REA_Nombre, REA_UserKey, REA_TipoRiesgoKey, DateStamp 
            FROM ". $this->db_table ." ORDER BY REA_Nombre ";
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
            $sql = "SELECT count(REA_IdRealizado) AS REA_Nombre
                      FROM ". $this->db_table ."
                    WHERE REA_Nombre = ? AND REA_IdRealizado <> ? ";

            $stmt = $this->conn->prepare($sql, array(PDO::ATTR_CURSOR => PDO::CURSOR_SCROLL));

            $stmt->bindParam(1, $this->REA_Nombre, PDO::PARAM_STR);
			$stmt->bindParam(2, $this->REA_IdRealizado, PDO::PARAM_INT);

            $stmt->execute();

            $dataRow = $stmt->fetch(PDO::FETCH_ASSOC);
            
            $this->REA_Nombre = $dataRow['REA_Nombre'];
        }
		
		// CREATE
		public function create(){
			$sqlQuery = "INSERT INTO ". $this->db_table ." (REA_CustomerKey, REA_UserKey, REA_Nombre, REA_TipoRiesgoKey, DateStamp) VALUES ( :ck, :uk, :nombre, :trk, :ds )";
			//echo $sqlQuery ;
			$stmt = $this->conn->prepare($sqlQuery, array(PDO::ATTR_CURSOR => PDO::CURSOR_SCROLL));
		
			// sanitize
			$this->REA_CustomerKey = htmlspecialchars(strip_tags($this->REA_CustomerKey));
			$this->REA_UserKey = htmlspecialchars(strip_tags($this->REA_UserKey));            
			$this->REA_Nombre = htmlspecialchars(strip_tags($this->REA_Nombre));
            $this->REA_TipoRiesgoKey = htmlspecialchars(strip_tags($this->REA_TipoRiesgoKey));
            $this->DateStamp = htmlspecialchars(strip_tags($this->DateStamp));
		
			// bind data
			$stmt->bindParam(":ck", $this->REA_CustomerKey, PDO::PARAM_STR);
			$stmt->bindParam(":uk", $this->REA_UserKey, PDO::PARAM_STR);            
			$stmt->bindParam(":nombre", $this->REA_Nombre, PDO::PARAM_STR);
            $stmt->bindParam(":trk", $this->REA_TipoRiesgoKey, PDO::PARAM_STR);
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
                    REA_Nombre = :nombre
                    WHERE REA_IdRealizado = :id ";
			//echo   $sqlQuery;
        
            $stmt = $this->conn->prepare($sqlQuery, array(PDO::ATTR_CURSOR => PDO::CURSOR_SCROLL));
        
            $this->REA_Nombre=htmlspecialchars(strip_tags($this->REA_Nombre));
            $this->REA_IdRealizado=htmlspecialchars(strip_tags($this->REA_IdRealizado));
        
            // bind data
            $stmt->bindParam(":nombre", $this->REA_Nombre, PDO::PARAM_STR);
            $stmt->bindParam(":id", $this->REA_IdRealizado, PDO::PARAM_INT);
        
            if($stmt->execute()){
               return true;
            }
            return false;
        }        

        // DELETE
        function delete(){
            $sqlQuery = "DELETE FROM " . $this->db_table . " WHERE REA_IdRealizado = ? ";
            $stmt = $this->conn->prepare($sqlQuery, array(PDO::ATTR_CURSOR => PDO::CURSOR_SCROLL));
        
            $this->REA_IdRealizado = htmlspecialchars(strip_tags($this->REA_IdRealizado));

            // bind data
            $stmt->bindParam(1, $this->REA_IdRealizado, PDO::PARAM_INT);
        
            if($stmt->execute()){
                return true;
            }
            return false;
        }
    }
?>
