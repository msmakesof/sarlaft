<?php
    class Efectividad{

        // Connection
        private $conn;

        // Table
        private $db_table = "EFE_Efectividad";

        // Columns
		public $EFE_IdEfectividad;
		public $EFE_CustomerKey;
		public $EFE_Nombre;
        public $EFE_UserKey;
        public $EFE_TipoRiesgoKey;
        public $DateStamp;

        // Db connection
        public function __construct($db){
            $this->conn = $db;
        }

        // GET ALL
        public function getAll(){
            $sql = "SELECT EFE_IdEfectividad, EFE_CustomerKey, EFE_Nombre, EFE_UserKey, EFE_TipoRiesgoKey, DateStamp 
            FROM ". $this->db_table ." ORDER BY EFE_Nombre ";
            //echo $sql;
			$stmt = $this->conn->prepare($sql, array(PDO::ATTR_CURSOR => PDO::CURSOR_SCROLL));
			$stmt->execute();
			return $stmt;
        }

         // GET ALL por CK
         public function getCkAll(){
            $sql = "SELECT  EFE_IdEfectividad, EFE_CustomerKey, EFE_Nombre, EFE_UserKey, EFE_TipoRiesgoKey, DateStamp 
            FROM ". $this->db_table ." WHERE EFE_CustomerKey = ? ORDER BY EFE_Nombre ";
            //echo $sql;
			$stmt = $this->conn->prepare($sql, array(PDO::ATTR_CURSOR => PDO::CURSOR_SCROLL));
			$stmt->bindParam(1, $this->CustomerKey);
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
            $sql = "SELECT count(EFE_IdEfectividad) AS EFE_Nombre
                      FROM ". $this->db_table ."
                    WHERE EFE_Nombre = ? AND EFE_IdEfectividad <> ? ";

            $stmt = $this->conn->prepare($sql, array(PDO::ATTR_CURSOR => PDO::CURSOR_SCROLL));

            $stmt->bindParam(1, $this->EFE_Nombre, PDO::PARAM_STR);
			$stmt->bindParam(2, $this->EFE_IdEfectividad, PDO::PARAM_INT);

            $stmt->execute();

            $dataRow = $stmt->fetch(PDO::FETCH_ASSOC);
            
            $this->EFE_Nombre = $dataRow['EFE_Nombre'];
        }
		
		// CREATE
		public function create(){
			$sqlQuery = "INSERT INTO ". $this->db_table ." (EFE_CustomerKey, EFE_UserKey, EFE_Nombre, EFE_TipoRiesgoKey, DateStamp) VALUES ( :ck, :uk, :nombre, :trk, :ds )";
			//echo $sqlQuery ;
			$stmt = $this->conn->prepare($sqlQuery, array(PDO::ATTR_CURSOR => PDO::CURSOR_SCROLL));
		
			// sanitize
			$this->EFE_CustomerKey = htmlspecialchars(strip_tags($this->EFE_CustomerKey));
			$this->EFE_UserKey = htmlspecialchars(strip_tags($this->EFE_UserKey));            
			$this->EFE_Nombre = htmlspecialchars(strip_tags($this->EFE_Nombre));
            $this->EFE_TipoRiesgoKey = htmlspecialchars(strip_tags($this->EFE_TipoRiesgoKey));
            $this->DateStamp = htmlspecialchars(strip_tags($this->DateStamp));
		
			// bind data
			$stmt->bindParam(":ck", $this->EFE_CustomerKey, PDO::PARAM_STR);
			$stmt->bindParam(":uk", $this->EFE_UserKey, PDO::PARAM_STR);            
			$stmt->bindParam(":nombre", $this->EFE_Nombre, PDO::PARAM_STR);
            $stmt->bindParam(":trk", $this->EFE_TipoRiesgoKey, PDO::PARAM_STR);
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
                    EFE_Nombre = :nombre
                    WHERE EFE_IdEfectividad = :id ";
			//echo   $sqlQuery;
        
            $stmt = $this->conn->prepare($sqlQuery, array(PDO::ATTR_CURSOR => PDO::CURSOR_SCROLL));
        
            $this->EFE_Nombre=htmlspecialchars(strip_tags($this->EFE_Nombre));
            $this->EFE_IdEfectividad=htmlspecialchars(strip_tags($this->EFE_IdEfectividad));
        
            // bind data
            $stmt->bindParam(":nombre", $this->EFE_Nombre, PDO::PARAM_STR);
            $stmt->bindParam(":id", $this->EFE_IdEfectividad, PDO::PARAM_INT);
        
            if($stmt->execute()){
               return true;
            }
            return false;
        }        

        // DELETE
        function delete(){
            $sqlQuery = "DELETE FROM " . $this->db_table . " WHERE EFE_IdEfectividad = ? ";
            $stmt = $this->conn->prepare($sqlQuery, array(PDO::ATTR_CURSOR => PDO::CURSOR_SCROLL));
        
            $this->EFE_IdEfectividad = htmlspecialchars(strip_tags($this->EFE_IdEfectividad));

            // bind data
            $stmt->bindParam(1, $this->EFE_IdEfectividad, PDO::PARAM_INT);
        
            if($stmt->execute()){
                return true;
            }
            return false;
        }
    }
?>
