<?php
    class RiesgoAsociado{

        // Connection
        private $conn;

        // Table
        private $db_table = "RIA_RiesgoAsociado";

        // Columns
		public $RIA_IdRiesgoAsociado;
		public $RIA_CustomerKey;
		public $RIA_Nombre;
        public $RIA_UserKey;
        public $RIA_TipoRiesgoKey;
        public $DateStamp;

        // Db connection
        public function __construct($db){
            $this->conn = $db;
        }

        // GET ALL
        public function getAll(){
            $sql = "SELECT RIA_IdRiesgoAsociado, RIA_CustomerKey, RIA_Nombre, RIA_UserKey, RIA_TipoRiesgoKey, DateStamp 
            FROM ". $this->db_table ." ORDER BY RIA_Nombre ";
            //echo $sql;
			$stmt = $this->conn->prepare($sql, array(PDO::ATTR_CURSOR => PDO::CURSOR_SCROLL));
			$stmt->execute();
			return $stmt;
        }

        // GET ALL por CK
        public function getCkAll(){
            $sql = "SELECT RIA_IdRiesgoAsociado, RIA_CustomerKey, RIA_Nombre, RIA_UserKey, RIA_TipoRiesgoKey, DateStamp 
            FROM ". $this->db_table ." WHERE RIA_CustomerKey = ? ORDER BY RIA_Nombre ";
            //echo $sql;
			$stmt = $this->conn->prepare($sql, array(PDO::ATTR_CURSOR => PDO::CURSOR_SCROLL));
            $stmt->bindParam(1, $this->RIA_CustomerKey);
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
            $sql = "SELECT count(RIA_IdRiesgoAsociado) AS RIA_Nombre
                      FROM ". $this->db_table ."
                    WHERE RIA_Nombre = ? AND RIA_IdRiesgoAsociado <> ? ";

            $stmt = $this->conn->prepare($sql, array(PDO::ATTR_CURSOR => PDO::CURSOR_SCROLL));

            $stmt->bindParam(1, $this->RIA_Nombre, PDO::PARAM_STR);
			$stmt->bindParam(2, $this->RIA_IdRiesgoAsociado, PDO::PARAM_INT);

            $stmt->execute();

            $dataRow = $stmt->fetch(PDO::FETCH_ASSOC);
            
            $this->RIA_Nombre = $dataRow['RIA_Nombre'];
        }
		
		// CREATE
		public function createRA(){
			$sqlQuery = "INSERT INTO ". $this->db_table ." (RIA_CustomerKey, RIA_UserKey, RIA_Nombre, RIA_TipoRiesgoKey, DateStamp) VALUES ( :ck, :uk, :nombre, :trk, :ds )";
			//echo $sqlQuery ;
			$stmt = $this->conn->prepare($sqlQuery, array(PDO::ATTR_CURSOR => PDO::CURSOR_SCROLL));
		
			// sanitize
			$this->RIA_CustomerKey = htmlspecialchars(strip_tags($this->RIA_CustomerKey));
			$this->RIA_UserKey = htmlspecialchars(strip_tags($this->RIA_UserKey));            
			$this->RIA_Nombre = htmlspecialchars(strip_tags($this->RIA_Nombre));
            $this->RIA_TipoRiesgoKey = htmlspecialchars(strip_tags($this->RIA_TipoRiesgoKey));
            $this->DateStamp = htmlspecialchars(strip_tags($this->DateStamp));
		
			// bind data
			$stmt->bindParam(":ck", $this->RIA_CustomerKey, PDO::PARAM_STR);
			$stmt->bindParam(":uk", $this->RIA_UserKey, PDO::PARAM_STR);            
			$stmt->bindParam(":nombre", $this->RIA_Nombre, PDO::PARAM_STR);
            $stmt->bindParam(":trk", $this->RIA_TipoRiesgoKey, PDO::PARAM_STR);
            $stmt->bindParam(":ds", $this->DateStamp, PDO::PARAM_STR);
		
			if($stmt->execute()){
				return true;
			}
			return false;
		}

		// UPDATE
        public function updateRA(){
            $sqlQuery = "UPDATE ". $this->db_table ."
                    SET
                    RIA_Nombre = :nombre
                    WHERE RIA_IdRiesgoAsociado = :id ";
			//echo   $sqlQuery;
        
            $stmt = $this->conn->prepare($sqlQuery, array(PDO::ATTR_CURSOR => PDO::CURSOR_SCROLL));
        
            $this->RIA_Nombre=htmlspecialchars(strip_tags($this->RIA_Nombre));
            $this->RIA_IdRiesgoAsociado=htmlspecialchars(strip_tags($this->RIA_IdRiesgoAsociado));
        
            // bind data
            $stmt->bindParam(":nombre", $this->RIA_Nombre, PDO::PARAM_STR);
            $stmt->bindParam(":id", $this->RIA_IdRiesgoAsociado, PDO::PARAM_INT);
        
            if($stmt->execute()){
               return true;
            }
            return false;
        }        

        // DELETE
        function deleteRA(){
            $sqlQuery = "DELETE FROM " . $this->db_table . " WHERE RIA_IdRiesgoAsociado = ? ";
            $stmt = $this->conn->prepare($sqlQuery, array(PDO::ATTR_CURSOR => PDO::CURSOR_SCROLL));
        
            $this->RIA_IdRiesgoAsociado = htmlspecialchars(strip_tags($this->RIA_IdRiesgoAsociado));

            // bind data
            $stmt->bindParam(1, $this->RIA_IdRiesgoAsociado, PDO::PARAM_INT);
        
            if($stmt->execute()){
                return true;
            }
            return false;
        }
    }
?>
