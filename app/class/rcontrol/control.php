<?php
    class Control{

        // Connection
        private $conn;

        // Table
        private $db_table = "CON_Control";

        // Columns
		public $CON_IdControl;
		public $CON_CustomerKey;
		public $CON_Nombre;
        public $CON_UserKey;
        public $CON_TipoRiesgoKey;
        public $DateStamp;

        // Db connection
        public function __construct($db){
            $this->conn = $db;
        }

        // GET ALL
        public function getAll(){
            $sql = "SELECT CON_IdControl, CON_CustomerKey, CON_Nombre, CON_UserKey, CON_TipoRiesgoKey, DateStamp 
            FROM ". $this->db_table ." ORDER BY CON_Nombre ";
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
            $sql = "SELECT count(CON_IdControl) AS CON_Nombre
                      FROM ". $this->db_table ."
                    WHERE CON_Nombre = ? AND CON_IdControl <> ? ";

            $stmt = $this->conn->prepare($sql, array(PDO::ATTR_CURSOR => PDO::CURSOR_SCROLL));

            $stmt->bindParam(1, $this->CON_Nombre, PDO::PARAM_STR);
			$stmt->bindParam(2, $this->CON_IdControl, PDO::PARAM_INT);

            $stmt->execute();

            $dataRow = $stmt->fetch(PDO::FETCH_ASSOC);
            
            $this->CON_Nombre = $dataRow['CON_Nombre'];
        }
		
		// CREATE
		public function createControl(){
			$sqlQuery = "INSERT INTO ". $this->db_table ." (CON_CustomerKey, CON_UserKey, CON_Nombre, CON_TipoRiesgoKey, DateStamp) VALUES ( :ck, :uk, :nombre, :trk, :ds )";
			//echo $sqlQuery ;
			$stmt = $this->conn->prepare($sqlQuery, array(PDO::ATTR_CURSOR => PDO::CURSOR_SCROLL));
		
			// sanitize
			$this->CON_CustomerKey = htmlspecialchars(strip_tags($this->CON_CustomerKey));
			$this->CON_UserKey = htmlspecialchars(strip_tags($this->CON_UserKey));            
			$this->CON_Nombre = htmlspecialchars(strip_tags($this->CON_Nombre));
            $this->CON_TipoRiesgoKey = htmlspecialchars(strip_tags($this->CON_TipoRiesgoKey));
            $this->DateStamp = htmlspecialchars(strip_tags($this->DateStamp));
		
			// bind data
			$stmt->bindParam(":ck", $this->CON_CustomerKey, PDO::PARAM_STR);
			$stmt->bindParam(":uk", $this->CON_UserKey, PDO::PARAM_STR);            
			$stmt->bindParam(":nombre", $this->CON_Nombre, PDO::PARAM_STR);
            $stmt->bindParam(":trk", $this->CON_TipoRiesgoKey, PDO::PARAM_STR);
            $stmt->bindParam(":ds", $this->DateStamp, PDO::PARAM_STR);
		
			if($stmt->execute()){
				return true;
			}
			return false;
		}

		// UPDATE
        public function updateControl(){
            $sqlQuery = "UPDATE ". $this->db_table ."
                    SET
                    CON_Nombre = :nombre
                    WHERE CON_IdControl = :id ";
			//echo   $sqlQuery;
        
            $stmt = $this->conn->prepare($sqlQuery, array(PDO::ATTR_CURSOR => PDO::CURSOR_SCROLL));
        
            $this->CON_Nombre=htmlspecialchars(strip_tags($this->CON_Nombre));
            $this->CON_IdControl=htmlspecialchars(strip_tags($this->CON_IdControl));
        
            // bind data
            $stmt->bindParam(":nombre", $this->CON_Nombre, PDO::PARAM_STR);
            $stmt->bindParam(":id", $this->CON_IdControl, PDO::PARAM_INT);
        
            if($stmt->execute()){
               return true;
            }
            return false;
        }        

        // DELETE
        function deleteControl(){
            $sqlQuery = "DELETE FROM " . $this->db_table . " WHERE CON_IdControl = ? ";
            $stmt = $this->conn->prepare($sqlQuery, array(PDO::ATTR_CURSOR => PDO::CURSOR_SCROLL));
        
            $this->CON_IdControl = htmlspecialchars(strip_tags($this->CON_IdControl));

            // bind data
            $stmt->bindParam(1, $this->CON_IdControl, PDO::PARAM_INT);
        
            if($stmt->execute()){
                return true;
            }
            return false;
        }
    }
?>
