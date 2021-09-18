<?php
    class Categoria{

        // Connection
        private $conn;

        // Table
        private $db_table = "CAT_Categoria";

        // Columns
		public $CAT_IdCategoria;
		public $CAT_CustomerKey;
		public $CAT_Nombre;
        public $CAT_UserKey;
        public $CAT_TipoRiesgoKey;
        public $DateStamp;

        // Db connection
        public function __construct($db){
            $this->conn = $db;
        }

        // GET ALL
        public function getAll(){
            $sql = "SELECT CAT_IdCategoria, CAT_CustomerKey, CAT_Nombre, CAT_UserKey, CAT_TipoRiesgoKey, DateStamp 
            FROM ". $this->db_table ." ORDER BY CAT_Nombre ";
            //echo $sql;
			$stmt = $this->conn->prepare($sql, array(PDO::ATTR_CURSOR => PDO::CURSOR_SCROLL));
			$stmt->execute();
			return $stmt;
        }

        // GET ALL por CK
        public function getCkAll(){
            $sql = "SELECT CAT_IdCategoria, CAT_CustomerKey, CAT_Nombre, CAT_UserKey, CAT_TipoRiesgoKey, DateStamp
            FROM ". $this->db_table ." WHERE CAT_CustomerKey = ? ORDER BY CAT_Nombre ";
            //echo $sql;
			$stmt = $this->conn->prepare($sql, array(PDO::ATTR_CURSOR => PDO::CURSOR_SCROLL));
			$stmt->bindParam(1, $this->CAT_CustomerKey);
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
            $sql = "SELECT count(CAT_IdCategoria) AS CAT_Nombre
                      FROM ". $this->db_table ."
                    WHERE CAT_Nombre = ? AND CAT_CustomerKey = ? AND CAT_IdCategoria <> ? ";

            $stmt = $this->conn->prepare($sql, array(PDO::ATTR_CURSOR => PDO::CURSOR_SCROLL));

            $stmt->bindParam(1, $this->CAT_Nombre, PDO::PARAM_STR);
			$stmt->bindParam(2, $this->CAT_CustomerKey, PDO::PARAM_STR);
			$stmt->bindParam(3, $this->CAT_IdCategoria, PDO::PARAM_INT);

            $stmt->execute();

            $dataRow = $stmt->fetch(PDO::FETCH_ASSOC);
            
            $this->CAT_Nombre = $dataRow['CAT_Nombre'];
        }
		
		// CREATE
		public function create(){
			$sqlQuery = "INSERT INTO ". $this->db_table ." (CAT_CustomerKey, CAT_UserKey, CAT_Nombre, CAT_TipoRiesgoKey, DateStamp) VALUES ( :ck, :uk, :nombre, :trk, :ds )";
			//echo $sqlQuery ;
			$stmt = $this->conn->prepare($sqlQuery, array(PDO::ATTR_CURSOR => PDO::CURSOR_SCROLL));
		
			// sanitize
			$this->CAT_CustomerKey = htmlspecialchars(strip_tags($this->CAT_CustomerKey));
			$this->CAT_UserKey = htmlspecialchars(strip_tags($this->CAT_UserKey));            
			$this->CAT_Nombre = htmlspecialchars(strip_tags($this->CAT_Nombre));
            $this->CAT_TipoRiesgoKey = htmlspecialchars(strip_tags($this->CAT_TipoRiesgoKey));
            $this->DateStamp = htmlspecialchars(strip_tags($this->DateStamp));
		
			// bind data
			$stmt->bindParam(":ck", $this->CAT_CustomerKey, PDO::PARAM_STR);
			$stmt->bindParam(":uk", $this->CAT_UserKey, PDO::PARAM_STR);            
			$stmt->bindParam(":nombre", $this->CAT_Nombre, PDO::PARAM_STR);
            $stmt->bindParam(":trk", $this->CAT_TipoRiesgoKey, PDO::PARAM_STR);
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
                    CAT_Nombre = :nombre
                    WHERE CAT_IdCategoria = :id ";
			//echo   $sqlQuery;
        
            $stmt = $this->conn->prepare($sqlQuery, array(PDO::ATTR_CURSOR => PDO::CURSOR_SCROLL));
        
            $this->CAT_Nombre=htmlspecialchars(strip_tags($this->CAT_Nombre));
            $this->CAT_IdCategoria=htmlspecialchars(strip_tags($this->CAT_IdCategoria));
        
            // bind data
            $stmt->bindParam(":nombre", $this->CAT_Nombre, PDO::PARAM_STR);
            $stmt->bindParam(":id", $this->CAT_IdCategoria, PDO::PARAM_INT);
        
            if($stmt->execute()){
               return true;
            }
            return false;
        }        

        // DELETE
        function deleteTR(){
            $sqlQuery = "DELETE FROM " . $this->db_table . " WHERE CAT_IdCategoria = ? ";
            $stmt = $this->conn->prepare($sqlQuery, array(PDO::ATTR_CURSOR => PDO::CURSOR_SCROLL));
        
            $this->CAT_IdCategoria = htmlspecialchars(strip_tags($this->CAT_IdCategoria));

            // bind data
            $stmt->bindParam(1, $this->CAT_IdCategoria, PDO::PARAM_INT);
        
            if($stmt->execute()){
                return true;
            }
            return false;
        }
    }
?>
